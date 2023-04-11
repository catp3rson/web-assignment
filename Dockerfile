ARG BASE_DEBIAN=buster
FROM debian:${BASE_DEBIAN}
ARG ROOT_PASSWD
LABEL maintainer="Tomas Jasek<tomsik68 (at) gmail (dot) com>"

ENV DEBIAN_FRONTEND noninteractive

# Set root password to root, format is 'user:password'.
RUN echo 'root:${ROOT_PASSWD}' | chpasswd

RUN apt-get update --fix-missing && \
  apt-get upgrade -y && \
  # curl is needed to download the xampp installer, net-tools provides netstat command for xampp
  apt-get -y install curl net-tools && \
  apt-get -yq install openssh-server supervisor && \
  # Few handy utilities which are nice to have
  apt-get -y install nano vim less --no-install-recommends && \
  apt-get clean

COPY xampp-linux-installer.run /xampp-linux-installer.run

RUN chmod 755 xampp-linux-installer.run && \
  bash -c './xampp-linux-installer.run' && \
  rm -f xampp-linux-installer.run && \
  ln -sf /opt/lampp/lampp /usr/bin/lampp && \
  sed -i.bak s'/Require local/Require all granted/g' /opt/lampp/etc/extra/httpd-xampp.conf && \
  # Enable error display in php (for debugging only)
  sed -i.bak s'/display_errors=Off/display_errors=On/g' /opt/lampp/etc/php.ini && \
  # Enable includes of several configuration files
  mkdir /opt/lampp/apache2/conf.d && \
  # Create a /www folder and a symbolic link to it in /opt/lampp/htdocs. It'll be accessible via http://localhost:[port]/www/
  # This is convenient because it doesn't interfere with xampp, phpmyadmin or other tools in /opt/lampp/htdocs
  mkdir /www && \
  ln -s /www /opt/lampp/htdocs && \
  # SSH server
  mkdir -p /var/run/sshd && \
  # Allow root login via password
  sed -ri 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/g' /etc/ssh/sshd_config

# copy website files
COPY src/FrontEnd /www/FrontEnd
COPY src/BackEnd /www/BackEnd

# copy config files
COPY httpd.conf /opt/lampp/etc/httpd.conf
# COPY config.inc.php /opt/lampp/phpmyadmin/config.inc.php

# copy supervisor config file to start openssh-server
COPY supervisord-openssh-server.conf /etc/supervisor/conf.d/supervisord-openssh-server.conf

# copy a startup script
COPY startup.sh /startup.sh

# mysql port (access from localhost only)
# EXPOSE 3306
# ssh port
EXPOSE 22
# http port (phpmyadmin accessed from localhost only)
EXPOSE 80

CMD ["sh", "/startup.sh"]
