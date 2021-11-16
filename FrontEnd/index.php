<?php
	include ("create_locationsDB.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUBK</title>
    <link rel="icon" href="./assets/images/LOGO.png" type="image/x-icon" />
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"  rel="stylesheet"/>
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.0.0-beta2-web/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"  rel="stylesheet"/>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3rMarZKfKHtdqrkVk6XV3zBMgNyHfnAg&callback=initMap&libraries=&v=weekly" async></script>
    <script>
        function initMap() {
            var markers = new Array();
            var mapOptions = {
                zoom: 16,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: new google.maps.LatLng(10.760126435947619, 106.66319203208252)
            };
            <?php
                $sql = "SELECT * FROM locations";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo 'var locations = [';
                    $style = "'font-size: 15px; font-weight: 5px;'";
                    while($row = $result->fetch_assoc()) {
                        echo '[new google.maps.LatLng('. $row['latitude']. ','. $row['longtitude']. '), "'.$row['location_name'].'",'.'"<h1 style='.$style.'>'.$row['location_name'].'</h1><hr>'. '<p>Address: '.$row['location_description'].'</p>"'. '],';
                        
                    }
                    echo '];';
                }
            ?>
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);
            var infowindow = new google.maps.InfoWindow();
            for (var i = 0; i < locations.length; i++) {
                $('#markers').append('<a class="marker-link" data-markerid="' + i + '" href="#maps">' + locations[i][1] + '</a> ');
                var marker = new google.maps.Marker({
                    position: locations[i][0],
                    map: map,
                    title: locations[i][1],
                });
                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent(locations[i][2]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
                markers.push(marker);
            }

            $('.marker-link').on('click', function () {
                google.maps.event.trigger(markers[$(this).data('markerid')], 'click');
            });
        }

        initialize();
    </script>
</head>
<body>
    <div class="app">
        <header class="header">
            
            <div class="container">

                <nav class="header__nav">
                    <div class="header__info">
                        <a href=""class ="header__nav-logo--link hide-on-mobile">
                            <img src="./assets/images/LOGO.png" alt="logo" class ="header__nav-logo" >
                        </a>
                          
                        <ul class="header__nav-list ">
                            <li class="header__nav-item">
                                <a href="#" class="header__nav-item--link">HOME</a>
                            </li>
     
                            <li class="header__nav-item">
                                <a href="#courses" class="header__nav-item--link">COURSES</a>
                            </li>

                            <li class="header__nav-item"> 
                                <a href="#news" class="header__nav-item--link">NEWS</a>
                            </li>  
     
                            <li class="header__nav-item"> 
                                <a href="#contact" class="header__nav-item--link">CONTACT</a>
                            </li>       
                            <li class="header__nav-item"> 
                                <a href="#map_location" class="header__nav-item--link">LOCATION</a>
                            </li>   
                        </ul>


                        <!-- Mobile nav bar -->
                                                 
                            <!-- Logo mobile -->
                            <div class="nav-mobile-logo">
                                <a href="" class="nav-mobile-logo--link">
                                    <img class="nav-mobile-logo--icon" src="./assets/images/footer-logo.png" alt="logo" >
                                </a>        
                            </div>
                            <!--  -->
                            <label for="nav-mobile-input" class="nav__bars-btn">
                                <i class="nav__bars-btn--icon fas fa-bars"></i>
                            </label>

                            <input type="checkbox" hidden name="" id="nav-mobile-input" class="nav-input">
    
                            <label for="nav-mobile-input" class="nav__overlay"> </label>
                            <div class="nav__mobile">
                                <label for="nav-mobile-input" class="nav__mobile-close">
                                    <i class="nav__mobile-close--icon fas fa-times"></i>
                                </label>
                                <ul class="nav__mobile-list ">
                                    <li class="nav__mobile-item">
                                        <a href="#" class="nav__mobile-item--link">
                                            <i class="nav__mobile-icon fas fa-home"></i>
                                            Home
                                        </a>
                                    </li>
             
                                    <li class="nav__mobile-item">
                                        <a href="#courses" class="nav__mobile-item--link">
                                            <i class="nav__mobile-icon fas fa-book"></i>
                                            Course
                                        </a>
                                    </li>
             
                                    <li class="nav__mobile-item"> 
                                        <a href="#news" class="nav__mobile-item--link">
                                            <i class="nav__mobile-icon fas fa-newspaper"></i>
                                            News
                                        </a>
                                    </li>   

                                    <li class="nav__mobile-item"> 
                                        <a href="#contact" class="nav__mobile-item--link">
                                            <i class="nav__mobile-icon fas fa-envelope"></i>
                                            Contact
                                        </a>
                                    </li>  
                                    
                                    <li class="nav__mobile-item"> 
                                        <a href="#map_location" class="nav__mobile-item--link">
                                            <i class="nav__mobile-icon fas fa-map-marked-alt"></i>
                                            Map
                                        </a>
                                    </li> 
                                    <li class="nav__mobile-item"> 
                                        <a href="#" class="nav__mobile-item--link">
                                            <i class="nav__mobile-icon fas fa-user-circle"></i>
                                            Login
                                        </a>
                                    </li>   
                                    
                                    <li class="nav__mobile-item"> 
                                        <img src="./assets/images/footer-logo.png" alt="logo" class ="footer-logo" >
                                        <h1 >EDUCATION BK HCMC</h1>                      
                                    </li>     
                                </ul>
                            </div>
                        <!--  -->
                    </div>


                    
                    <ul class="header__nav-list">
                            <li class="header__nav-user"> 
                            
                                <img src="./assets/images/Login.70dc3d8.png" alt="login" onclick="clickLogin()" class="header__nav-login" >
                                <div class="popup-login">
                                    <img data-v-1c02541c="" onClick="closeClickLogin()" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTAgMTUuMzg0NkwxNS4zODQ2IDBMMTYgMC42MTUzODRMMC42MTUzODQgMTZMMCAxNS4zODQ2WiIgZmlsbD0iYmxhY2siLz4KPHBhdGggZD0iTTYuNjM5NzVlLTA2IDAuNjE1Mzk1TDE1LjM4NDYgMTZMMTYgMTUuMzg0NkwwLjYxNTM5MSAxLjAzNzQ2ZS0wNUw2LjYzOTc1ZS0wNiAwLjYxNTM5NVoiIGZpbGw9ImJsYWNrIi8+Cjwvc3ZnPgo=" class="icon-close-card">
                                    <ul>
                                        <li class="fas fa-history"> Courses history</li>
                                        
                                        <a href="./components/login/login.html"><li class="fas fa-sign-in-alt"> Login</li></a>
                                    </ul>
                                </div>
                            </li>       
     
                             <li class="header__nav-user">
                                <img data-v-1c02541c="" src="./assets/images/Carticon.373916c.png" alt="cart" class="header__nav-cart" >
                             </li>
                    </ul>
                </nav>
                
            </div>
        </header>
        
        

        <div class="body">
            <div class="promotion">
                <div class="promotion-container">
                <div
                id="carouselBasicExample"
                class="carousel slide carousel-fade"
                data-mdb-ride="carousel"
                >
                <!-- Indicators -->
                    <div class="carousel-indicators promotion-indicator">
                        <button
                            type="button"
                            data-mdb-target="#carouselBasicExample"
                            data-mdb-slide-to="0"
                            class="active"
                            aria-current="true"
                            aria-label="Slide 1"
                        ></button>
                        <button
                            type="button"
                            data-mdb-target="#carouselBasicExample"
                            data-mdb-slide-to="1"
                            aria-label="Slide 2"
                        ></button>
                     
                    </div>

                    <!-- Inner -->
                    <div class="carousel-inner">
                <!-- Single item -->
                    <div class="carousel-item promotion-carousel--item active">
                       <div class="index-container image1 new-bg">
                            <h1>21 Million<br> Sessions</h1>
                            <h2>Helping students achieve and persist<br> One learner at a time</h2>
                        </div>
                    </div>

                <!-- Single item -->
                    <div class="carousel-item promotion-carousel--item">
                        <div class="index-container image2 new-bg">
                            <h1>21 Million<br> Sessions</h1>
                            <h2>Helping students achieve and persist<br> One learner at a time</h2>
                        </div>
                        
                    </div>

                    </div>
                <!-- Inner -->

                <!-- Controls -->
                        <button
                        class="carousel-control-prev"
                        type="button"
                        data-mdb-target="#carouselBasicExample"
                        data-mdb-slide="prev"
                        >
                        <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
                        <i class="fas fa-chevron-left"></i>
                        <span class="visually-hidden">Previous</span>
                        </button>
                        <button
                        class="carousel-control-next"
                        type="button"
                        data-mdb-target="#carouselBasicExample"
                        data-mdb-slide="next"
                        >
                        <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
                        <i class="fas fa-chevron-right"></i>
                        <span class="visually-hidden">Next</span>
                        </button>
                        </div>
                <!-- Carousel wrapper -->
            </div>
        </div>

            <div id="courses"  class="product">
                <div  class="container">
                    <div class="product__heading">
                        <i class="product__heading-icon fas fa-book"></i>
                        <span class="heading-title" >Courses</span>
                    </div>

                    <div >
                        <div class="product-menu">
                            <ul class="nav  product__list"  id="pills-tab" role="tablist">
                                <li class="nav-item selected" role="presentation">
                                    <div class="nav-link active " id="pills-food-tab" data-bs-toggle="pill" data-bs-target="#pills-food" type="button" role="tab" aria-controls="pills-food" aria-selected="true">
                                        <div class="product__item-link"     >
                                            <div class="product__info">
                                                 <img src="https://cdn.iconscout.com/icon/free/png-256/math-1963506-1657007.png" srcset="https://cdn.iconscout.com/icon/free/png-512/math-1963506-1657007.png 2x" alt="Math Icon" width="80">
                                            </div>
                                        </div>
                                        <div class="Courses-name-math">
                                            <h4> Math</h4>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <div class="nav-link" id="pills-drink-tab" data-bs-toggle="pill" data-bs-target="#pills-drink" type="button" role="tab" aria-controls="pills-drink" aria-selected="false">
                                        <div class="product__item-link"     >
                                            <div class="product__info">
                                                <img width="60" height="55" src="https://cdn-icons-png.flaticon.com/512/3247/3247965.png" alt="Relativity free icon" title="Relativity free icon" class="loaded">
                                            </div>
                                        </div>
                                        <div class="Courses-name-physical">
                                            <h4> Physical</h4>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <div class="nav-link" id="pills-hamburger-tab" data-bs-toggle="pill" data-bs-target="#pills-hamburger" type="button" role="tab" aria-controls="pills-hamburger" aria-selected="false">
                                        <div class="product__item-link"     >
                                            <div class="product__info">
                                                <img width="60" height="60" src="https://cdn-icons-png.flaticon.com/512/1233/1233846.png" alt="Chemistry free icon" title="Chemistry free icon" class="loaded">
                                            </div>
                                        </div>
                                        <div class="Courses-name-chemistry">
                                            <h4> Chemistry</h4>
                                        </div>
                                    </div>
                                </li>
                                
                                <li class="nav-item" role="presentation">
                                    <div class="nav-link" id="pills-hamburger2-tab" data-bs-toggle="pill" data-bs-target="#pills-hamburger2" type="button" role="tab" aria-controls="pills-hamburger2" aria-selected="false">
                                        <div class="product__item-link"     >
                                            <div class="product__info">
                                               <img width="70" height="70" src="https://static.thenounproject.com/png/3633788-200.png" alt="Biology Icon 3633788">
                                            </div>
                                        </div>
                                        <div class="Courses-name-biology">
                                            <h4> Biology</h4>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <div class="nav-link" id="pills-hamburger2-tab" data-bs-toggle="pill" data-bs-target="#pills-hamburger3" type="button" role="tab" aria-controls="pills-hamburger2" aria-selected="false">
                                        <div class="product__item-link"     >
                                            <div class="product__info">
                                               <!-- <img width="60" height="60" src="https://cdn-icons.flaticon.com/png/512/3152/premium/3152672.png?token=exp=1636733515~hmac=be8670631df345cfe77173497a3ff544" alt="Belgium free icon" title="Belgium free icon" class="loaded"> -->
                                               <img width="60" height="60" src="https://cdn2.iconfinder.com/data/icons/electronic-line-3/64/global_Earth_language_international_interface_icon0A-512.png" alt="Belgium free icon" title="Belgium free icon" class="loaded">
                                            </div>
                                        </div>
                                        <div class="Courses-name-languages">
                                            <h4> Languages</h4>
                                        </div>
                                    </div>
                                </li>
                                
                            </ul>
                            
                        </div>
                        
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active " id="pills-food" role="tabpanel" aria-labelledby="pills-food-tab">
                            <div class="product-card--container" id="first-menu-tab">
                         
                        </div>
                        </div>

                        <div class="tab-pane fade" id="pills-drink" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="product-card--container" id="second-menu-tab">
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-hamburger" role="tabpanel" aria-labelledby="pills-hamburger-tab">
                            <div class="product-card--container" id="third-menu-tab">
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-hamburger2" role="tabpanel" aria-labelledby="pills-hamburger-tab">
                            <div class="product-card--container" id="fourth-menu-tab">
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-hamburger3" role="tabpanel" aria-labelledby="pills-hamburger-tab">
                            <div class="product-card--container" id="fifth-menu-tab">
                            </div>
                        </div>

                        
                    </div>
                    
                </div>
                <!-- <div class="read-all">
                    <a href="#">
                        <span>Read all</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>     -->
            </div>
                <!-- News -->
                <div id="news" class="news">
                    <div class="container">
                        <div class="product__heading">
                            <i class="product__heading-icon fas fa-newspaper"></i>
        
                            <span class="heading-title" >News</span>
                        </div>
                    
                    <div class="news-container">
                        <!-- ------------------------- -->
                        <!-- <div class="news-card">
                            <img src="./assets/images/news1.jpg" alt="news1">
                            <div class="news-content">
                                <h5>Title</h5>
                                <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium ex ac urna tempor, ac ultrices justo aliquet. Aenean viverra urna eu est tincidunt venenatis. </p>
                                <div class="more-button">
                                    <button>
                                        <a href="#">More</a>
                                    </button>
                                </div>
                            </div>
                        </div> -->
                        <!-- -------------------------- -->
                    </div>   
                    
                    </div>        
                    <!-- <div class="read-all">
                        <a href="#">
                            <span>Read all</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>     -->
                </div>
        </div>

        <div id="map_location" class="location">
            <div class="container">
                <!-- Google Map -->
                <div class="product__heading">
                    <i class="product__heading-icon fas fa-map-marked-alt"></i>
                    <span class="heading-title" >Location</span>
                </div>
                <div id="map"></div>
                <div class="map-menu">
                    <div id="markers"></div>
                </div>
            </div>
        </div>
        

        <div class="footer">
            <div id="contact" class="footer__content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 footer__text">
                            <ul class="footer__logo-list">
                                <li class="footer__logo-item">
                                    <img src="./assets/images/footer-logo.png" alt="logo" class ="footer-logo" >
                                </li>
                                <li class="footer__logo-item">
                                    <h1 >EDUCATION BK HCMC</h1>
                                </li>
                                <br>
                                <li class="footer__logo-item">
                                    Address: 268 Ly Thuong Kiet, Ward 14, District 10, Ho Chi Minh city 700910
                                </li>
                                <li class="footer__logo-item">
                                    Phone:
                                    <a class="footer__phone" href="tel:+02873004183">(028) 7300.4183</a> -
                                    <a class="footer__phone" href="tel:+03497989798">03.9798.9798</a>
                                </li>
                                <li class="footer__logo-item">
                                    Email: 
                                    <a class="footer__email" href="mailto:tuvan@oisp.edu.vn">tuvan@oisp.edu.vn</a>
                                </li>
                            </ul>
                            
                          
                        </div>

                        <div class="col-sm-6 footer__text">
                         <br>
                          <ul class="footer__logo-list">
                            <li class="footer__logo-item">
                                <h2 >STAY IN TOUCH</h2>
                                <h3>Follow #Edubk on social media</h3>
                            </li>
                            <li class="footer__logo-item">
                                <a href="https://www.facebook.com/bkquocte/" class="footer__icon-link">
                                    <i class="footer__icon-social fab fa-facebook-f"></i>
                                </a>
                                <a href="" class="footer__icon-link">
                                    <i class="footer__icon-social fab fa-twitter"></i>
                                </a>
                                <a href="" class="footer__icon-link">
                                    <i class="footer__icon-social fab fa-instagram"></i>
                                </a>
                                <a href="" class="footer__icon-link">
                                    <i class="footer__icon-social fab fa-linkedin-in"></i>
                                </a>
                                <a href="" class="footer__icon-link">
                                    <i class="footer__icon-social fab fa-youtube"></i>
                                </a>
                            </li>
                            <br>
                            
                            <li class="footer__logo-item">
                                <a class="footer__link" href="#">HOME</a>
                            </li>
     
                            <li class="footer__logo-item">
                                <a class="footer__link" href="#courses">COURSE</a>
                            </li>
     
                            <li class="footer__logo-item"> 
                                <a class="footer__link" href="#news">NEWS</a>
                            </li> 
                            <li class="footer__logo-item"> 
                                <a class="footer__link" href="#map_location">LOCATION</a>
                            </li>      
                        </ul>
                        </div>

                        
                    </div>
                </div>
            </div>

            <div class="footer__bottom">
                <div class="container">                   
                    <p class="footer__text">© 2021 - BK EDUCATION SYSTEM - INTERNATIONAL PROGRAM - HCM UNIVERSITY OF TECHNOLOGY</p>
            </div>
            </div>
        </div>
    </div>
    <script src="./script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>
</body>
</html>