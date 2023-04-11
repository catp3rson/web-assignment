#!/bin/bash
if [ ! -f ./xampp-linux-installer.run ]; then
    curl -Lo xampp-linux-installer.run https://sourceforge.net/projects/xampp/files/XAMPP%20Linux/8.2.4/xampp-linux-x64-8.2.4-0-installer.run
fi
docker buildx build --platform=linux/amd64  --progress=plain -f Dockerfile -t catp3rson/tutor-booking-system:latest \
 $(for i in `cat .arg`; do out+="--build-arg $i " ; done; echo $out;out="") .
