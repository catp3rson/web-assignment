<header class="header">
    <div class="container">
        <nav class="header__nav">
            <div class="header__info">
                <a href=""class ="header__nav-logo--link hide-on-mobile-tablet">
                    <img  src="./assets/images/LOGO.png" alt="logo" class ="header__nav-logo" >
                </a>
                    
                <ul class="header__nav-list ">
                    <li class="header__nav-item">
                        <a href="index.php?page=home" class="header__nav-item--link">HOME</a>
                    </li>

                    <li class="header__nav-item">
                        <a href="index.php?page=courses" class="header__nav-item--link">COURSES</a>
                    </li>

                    <li class="header__nav-item"> 
                        <a href="index.php?page=map" class="header__nav-item--link">LOCATIONS</a>
                    </li>  

                    <li class="header__nav-item"> 
                        <a href="#contact" class="header__nav-item--link">CONTACT</a>
                    </li>  
                    <?php
                        if(isset($_SESSION["role"])) {
                            if($_SESSION["role"] == 0) {
                                echo '<li class="header__nav-item"> 
                                    <a href="index.php?page=manage" class="header__nav-item--link">MANAGE</a>
                                </li>';   
                            }
                        }
                    ?> 
                </ul>


                <!-- Mobile nav bar -->
                                            
                    <!-- Logo mobile -->
                    <div class="nav-mobile-logo">
                        <a href="#" class="nav-mobile-logo--link">
                            <img style="position: absolute;top: 10px;left: 10px;" class="nav-mobile-logo--icon" src="./assets/images/footer-logo.png" alt="logo" >
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
                                <a href="index.php?page=home" class="nav__mobile-item--link">
                                    <i class="nav__mobile-icon fas fa-home"></i>
                                    Home
                                </a>
                            </li>
        
                            <li class="nav__mobile-item">
                                <a href="index.php?page=courses" class="nav__mobile-item--link">
                                    <i class="nav__mobile-icon fas fa-book"></i>
                                    Course
                                </a>
                            </li>
        
                            <li class="nav__mobile-item"> 
                            </li>   

                            <li class="nav__mobile-item"> 
                                <a href="#contact" class="nav__mobile-item--link">
                                    <i class="nav__mobile-icon fas fa-envelope"></i>
                                    Contact
                                </a>
                            </li>  
                            
                            <li class="nav__mobile-item"> 
                                <a href="index.php?page=map" class="nav__mobile-item--link">
                                    <i class="nav__mobile-icon fas fa-map-marked-alt"></i>
                                    Locations
                                </a>
                            </li>
                            <?php
                                if(isset($_SESSION["role"])) {
                                    if($_SESSION["role"] == 0) {
                                        echo '<li class="nav__mobile-item"> 
                                            <a href="index.php?page=manage" class="nav__mobile-item--link">
                                                <i class="nav__mobile-icon fas fa-tasks"></i>
                                                Manage 
                                            </a>
                                        </li>';
                                    }
                                }
                            ?>
                            <li class="nav__mobile-item"> 
                                
                                <?php
                                    if(isset($_SESSION["email"])) {
                                        echo '<li class="header__nav-user" style=" color: var(--white-color);">
                                            <p style="margin-left: 8px; padding-top: 15px; font-size: 1.8rem;">Hello '.$_SESSION["email"].'</p>
                                        </li>';
                                    }
                                    else {
                                        echo '<li class="header__nav-user" style=" color: var(--white-color);">
                                            <p style="margin-left: 8px; padding-top: 15px; font-size: 1.8rem;">You are not signed in.</p>
                                        </li>';
                                    }
                                ?>
                                
                            </li> 
                            <li class="nav__mobile-item"> 
                                
                                <?php 
                                            // session_start();
                                        if (!isset($_SESSION["user_id"])) { ?>
                                        <a href="index.php?page=login" class="nav__mobile-item--link"><i class="nav__mobile-icon fas fa-user-circle"></i>
                                    Login</a>
                                    <?php } ?>

                                    <?php 
                                            // session_start();
                                        if (isset($_SESSION["user_id"])) { ?>
                                        <a href="index.php?page=logout" class="nav__mobile-item--link"><i class="nav__mobile-icon fas fa-user-circle"></i>
                                    Logout</a>
                                    <?php } ?>
                                
                            </li>   
                            
                            <!-- <li class="nav__mobile-item"> 
                                <img src="./assets/images/footer-logo.png" alt="logo" class ="footer-logo" >
                                <h1 >EDUCATION BK HCMC</h1>                      
                            </li>      -->
                        </ul>
                    </div>
                <!--  -->
            </div>


            
            <ul class="header__nav-list">
                <?php
                    if(isset($_SESSION["email"])) {
                        echo '<li class="header__nav-user" style="margin-right: 20px">
                            <p>Hello '.$_SESSION["email"].'</p>
                        </li>';
                    }
                    else {
                        echo '<li class="header__nav-user" style="margin-right: 20px">
                            <p>You are not signed in.</p>
                        </li>';
                    }
                ?>
                    <li class="header__nav-user"> 
                
                    <img src="./assets/images/Login.70dc3d8.png" alt="login" onclick="clickLogin()" class="header__nav-login" >
                    <div class="popup-login">
                        <img data-v-1c02541c="" onClick="closeClickLogin()" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTAgMTUuMzg0NkwxNS4zODQ2IDBMMTYgMC42MTUzODRMMC42MTUzODQgMTZMMCAxNS4zODQ2WiIgZmlsbD0iYmxhY2siLz4KPHBhdGggZD0iTTYuNjM5NzVlLTA2IDAuNjE1Mzk1TDE1LjM4NDYgMTZMMTYgMTUuMzg0NkwwLjYxNTM5MSAxLjAzNzQ2ZS0wNUw2LjYzOTc1ZS0wNiAwLjYxNTM5NVoiIGZpbGw9ImJsYWNrIi8+Cjwvc3ZnPgo=" class="icon-close-card">
                        <ul>
                            <?php 
                            if (!isset($_SESSION["user_id"])) { ?>
                            <a href="index.php?page=login"><li class="fas fa-sign-in-alt"> Login</li></a>
                            <?php } ?>
                            
                            <?php 
                                if (isset($_SESSION["user_id"]))
                                echo $_SESSION['user_id'];
                            if (isset($_SESSION["user_id"])) { ?>
                            <a href="index.php?page=logout"><li class="fas fa-sign-in-alt"> Logout</li></a>
                            <?php } ?>
                            
                        </ul>
                    </div>
                </li>       

                
            </ul>
        </nav>
        
    </div>
</header>
