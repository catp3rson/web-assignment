<?php 
    include "config.php";
    function retrieveTutor($tutor_id){
        global $mysql_addr, $mysql_user, $mysql_password, $mysql_db;
        
        $conn = mysqli_connect($mysql_addr, $mysql_user, $mysql_password, $mysql_db);
        $query_str = sprintf("SELECT * FROM users WHERE user_id = %s", $tutor_id);
        $query = mysqli_query($conn, $query_str);

        if (!$query){
            echo "<script>alert('Error executing query: " . mysqli_error($conn) . "')</script>";
            return NULL;
        }
    
        return mysqli_fetch_assoc($query);
    }
?> 
<script>
const menuTabMath = async ()=>{
    const response = await fetch('https://617bd868d842cf001711c0fe.mockapi.io/item');
    let newJson = [
        <?php
            $sql = "SELECT * FROM courses WHERE course_category = 'math'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '{
                        "course_code": "'.$row['course_code'].'",
                        "course_name": "'.$row['course_name'].'",
                        "course_fee": new Number('.$row['course_fee'].'),
                        "brief": "'.$row['brief'].'",
                        "tutor_name": "'.retrieveTutor($row['tutor_id'])['full_name'].'",
                        "start_date": "'.$row['start_date'].'",
                        "end_date": "'.$row['end_date'].'",
                    },';
                }
            }
        ?>
    ]
    console.log(newJson);
    const html = newJson.map((items) =>{
    return `
        <a href="tutor.php?code=${items.course_code}" style="text-decoration:inherit; color:inherit;"><div class="product-card">
            <div class="product-card--image">
                <img margin-right: auto; width="256" height="256" src="https://image.freepik.com/free-vector/math-background_23-2148146270.jpg" alt="User Icon free icon" title="User Icon free icon" class="loaded">
            </div>
            <div class="product-card--info">
    
                <span style="color:#EF6A3E;text-overflow:ellipsis;overflow:hidden;white-space: nowrap;" id="product-name"><b>${items.course_name}</b></span>
                </br>
                <span id="product-name">
                    <i class="fa fa-dollar"></i>
                    <b>Price</b>: ${items.course_fee.toLocaleString('en-VN', {style: 'currency',currency: 'VND', minimumFractionDigits: 0})}
                </span>
                <br>
                <span id="product-name">
                    <i class="fa fa-person" ></i>
                    <b>Teacher</b>: ${items.tutor_name}
                </span>
                <br>
                <span id="product-name">
                    <i class="fa fa-calendar"></i>
                    <b>From</b>: ${items.start_date} 
                </span>
                <br>
                <span id="product-name">
                    <i class="fa fa-calendar"></i>
                    <b>To</b>: ${items.end_date}
                </span>
            </div>
        </div></a>
    `;
                }).join(" ");
    let a = document.querySelector("#first-menu-tab");
    a.innerHTML = html;          
};

const menuTabPhysics = async ()=>{
    const response = await fetch('https://617bd868d842cf001711c0fe.mockapi.io/item2');
    let newJson = [
        <?php
            $sql = "SELECT * FROM courses WHERE course_category = 'physics'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '{
                        "course_code": "'.$row['course_code'].'",
                        "course_name": "'.$row['course_name'].'",
                        "course_fee": new Number('.$row['course_fee'].'),
                        "brief": "'.$row['brief'].'",
                        "tutor_name": "'.retrieveTutor($row['tutor_id'])['full_name'].'",
                        "start_date": "'.$row['start_date'].'",
                        "end_date": "'.$row['end_date'].'",
                    },';
                }
            }
        ?>
    ]
    const html = newJson.map((items) =>{
        return `
        <a href="tutor.php?code=${items.course_code}" style="text-decoration:inherit; color:inherit;"><div class="product-card">
            <div class="product-card--image">
                <img margin-right: auto; width="256" height="256" src="https://static.vecteezy.com/system/resources/thumbnails/003/297/662/small_2x/physics-concept-with-icon-set-with-big-word-free-vector.jpg" alt="User Icon free icon" title="User Icon free icon" class="loaded">
            </div>
            <div class="product-card--info">
    
                <span style="color:#EF6A3E;text-overflow:ellipsis;overflow:hidden;white-space: nowrap;" id="product-name"><b>${items.course_name}</b></span>
                </br>
                <span id="product-name">
                    <i class="fa fa-dollar"></i>
                    <b>Price</b>: ${items.course_fee.toLocaleString('en-VN', {style: 'currency',currency: 'VND', minimumFractionDigits: 0})}
                </span>
                <br>
                <span id="product-name">
                    <i class="fa fa-person" ></i>
                    <b>Teacher</b>: ${items.tutor_name}
                </span>
                <br>
                <span id="product-name">
                    <i class="fa fa-calendar"></i>
                    <b>From</b>: ${items.start_date} 
                </span>
                <br>
                <span id="product-name">
                    <i class="fa fa-calendar"></i>
                    <b>To</b>: ${items.end_date}
                </span>
            </div>
        </div></a>
    `;
                }).join(" ");
    let a = document.querySelector("#second-menu-tab");
    a.innerHTML = html;          
};

const menuTabChemistry = async ()=>{
    const response = await fetch('https://617bd868d842cf001711c0fe.mockapi.io/item3');
    const myJson = await response.json();
    let newJson = [
        <?php
            $sql = "SELECT * FROM courses WHERE course_category = 'chemistry'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '{
                        "course_code": "'.$row['course_code'].'",
                        "course_name": "'.$row['course_name'].'",
                        "course_fee": new Number('.$row['course_fee'].'),
                        "brief": "'.$row['brief'].'",
                        "tutor_name": "'.retrieveTutor($row['tutor_id'])['full_name'].'",
                        "start_date": "'.$row['start_date'].'",
                        "end_date": "'.$row['end_date'].'",
                    },';
                }
            }
        ?>
    ]
    const html = newJson.map((items) =>{
        return `
        <a href="tutor.php?code=${items.course_code}" style="text-decoration:inherit; color:inherit;"><div class="product-card">
            <div class="product-card--image">
                <img margin-right: auto; width="256" height="256" src="https://thumbs.dreamstime.com/b/chemistry-concept-modern-vector-horizontal-banner-creative-chemical-illustration-145532385.jpg" alt="User Icon free icon" title="User Icon free icon" class="loaded">
            </div>
            <div class="product-card--info">
    
                <span style="color:#EF6A3E;text-overflow:ellipsis;overflow:hidden;white-space: nowrap;" id="product-name"><b>${items.course_name}</b></span>
                </br>
                <span id="product-name">
                    <i class="fa fa-dollar"></i>
                    <b>Price</b>: ${items.course_fee.toLocaleString('en-VN', {style: 'currency',currency: 'VND', minimumFractionDigits: 0})}
                </span>
                <br>
                <span id="product-name">
                    <i class="fa fa-person" ></i>
                    <b>Teacher</b>: ${items.tutor_name}
                </span>
                <br>
                <span id="product-name">
                    <i class="fa fa-calendar"></i>
                    <b>From</b>: ${items.start_date} 
                </span>
                <br>
                <span id="product-name">
                    <i class="fa fa-calendar"></i>
                    <b>To</b>: ${items.end_date}
                </span>
            </div>
        </div></a>
    `;
                }).join(" ");
    let a = document.querySelector("#third-menu-tab");
    a.innerHTML = html;          
};

const menuTabBiology = async ()=>{
    const response = await fetch('https://619104b741928b001768ff0f.mockapi.io/chemistry/bi');
    const myJson = await response.json();
    let newJson = [
        <?php
            $sql = "SELECT * FROM courses WHERE course_category = 'biology'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '{
                        "course_code": "'.$row['course_code'].'",
                        "course_name": "'.$row['course_name'].'",
                        "course_fee": new Number('.$row['course_fee'].'),
                        "brief": "'.$row['brief'].'",
                        "tutor_name": "'.retrieveTutor($row['tutor_id'])['full_name'].'",
                        "start_date": "'.$row['start_date'].'",
                        "end_date": "'.$row['end_date'].'",
                    },';
                }
            }
        ?>
    ]
    const html = newJson.map((items) =>{
        return `
        <a href="tutor.php?code=${items.course_code}" style="text-decoration:inherit; color:inherit;"><div class="product-card">
            <div class="product-card--image">
                <img margin-right: auto; width="256" height="256" src="https://img.timviec.com.vn/2020/04/biology-la-gi.jpg" alt="User Icon free icon" title="User Icon free icon" class="loaded">
            </div>
            <div class="product-card--info">
    
                <span style="color:#EF6A3E;text-overflow:ellipsis;overflow:hidden;white-space: nowrap;" id="product-name"><b>${items.course_name.substr(0,40) + ' ...'}</b></span>
                </br>
                <span id="product-name">
                    <i class="fa fa-dollar"></i>
                    <b>Price</b>: ${items.course_fee.toLocaleString('en-VN', {style: 'currency',currency: 'VND', minimumFractionDigits: 0})}
                </span>
                <br>
                <span id="product-name">
                    <i class="fa fa-person" ></i>
                    <b>Teacher</b>: ${items.tutor_name}
                </span>
                <br>
                <span id="product-name">
                    <i class="fa fa-calendar"></i>
                    <b>From</b>: ${items.start_date} 
                </span>
                <br>
                <span id="product-name">
                    <i class="fa fa-calendar"></i>
                    <b>To</b>: ${items.end_date}
                </span>
            </div>
        </div></a>
    `;
                }).join(" ");
    let a = document.querySelector("#fourth-menu-tab");
    a.innerHTML = html;          
};

const  menuTabLanguages = async ()=>{
    const response = await fetch('https://617bd868d842cf001711c0fe.mockapi.io/item3');
    const myJson = await response.json();
    let newJson = [
        <?php
            $sql = "SELECT * FROM courses WHERE course_category = 'english'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '{
                        "course_code": "'.$row['course_code'].'",
                        "course_name": "'.$row['course_name'].'",
                        "course_fee": new Number('.$row['course_fee'].'),
                        "brief": "'.$row['brief'].'",
                        "tutor_name": "'.retrieveTutor($row['tutor_id'])['full_name'].'",
                        "start_date": "'.$row['start_date'].'",
                        "end_date": "'.$row['end_date'].'",
                    },';
                }
            }
        ?>
    ]
    const html = newJson.map((items) =>{
        return `
        <a href="tutor.php?code=${items.course_code}" style="text-decoration:inherit; color:inherit;"><div class="product-card">
            <div class="product-card--image">
                <img margin-right: auto; width="256" height="256" src="https://sandla.org/wp-content/uploads/2021/08/english-e1629469809834.jpg" alt="User Icon free icon" title="User Icon free icon" class="loaded">
            </div>
            <div class="product-card--info">
    
                <span style="color:#EF6A3E;text-overflow:ellipsis;overflow:hidden;white-space: nowrap;" id="product-name"><b>${items.course_name}</b></span>
                </br>
                <span id="product-name">
                    <i class="fa fa-dollar"></i>
                    <b>Price</b>: ${items.course_fee.toLocaleString('en-VN', {style: 'currency',currency: 'VND', minimumFractionDigits: 0})}
                </span>
                <br>
                <span id="product-name">
                    <i class="fa fa-person" ></i>
                    <b>Teacher</b>: ${items.tutor_name}
                </span>
                <br>
                <span id="product-name">
                    <i class="fa fa-calendar"></i>
                    <b>From</b>: ${items.start_date} 
                </span>
                <br>
                <span id="product-name">
                    <i class="fa fa-calendar"></i>
                    <b>To</b>: ${items.end_date}
                </span>
            </div>
        </div></a>
    `;
                }).join(" ");
    let a = document.querySelector("#fifth-menu-tab");
    a.innerHTML = html;          
};
const  handleNews = async ()=>{
    const response = await fetch('https://617bd868d842cf001711c0fe.mockapi.io/news');
    const myJson = await response.json();
    let newJson = [];
    if(myJson.length>6)
        newJson = myJson.slice(0,4);
    const html = newJson.map((items) =>{
        // console.log(items);
    return `
    <div class="news-card">
                        <img width="256" height="256" src="https://cdn-icons-png.flaticon.com/512/1074/1074106.png" alt="Newspaper free icon" title="Newspaper free icon" class="loaded">
                        <div class="news-content">
                            <h5>${items.title}</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium ex ac urna tempor, ac ultrices justo aliquet. Aenean viverra urna eu est tincidunt venenatis. </p>
                            <div class="more-button">
                                <button>
                                    <a href="#">More</a>
                                </button>
                            </div>
                        </div>
                    </div>
    `;
                }).join(" ");
    let a = document.querySelector(".news-container");
    a.innerHTML = html;          
};

menuTabMath();
menuTabPhysics();
menuTabChemistry();
menuTabBiology();
menuTabLanguages();
handleNews();
console.log(1);



const clickLogin = ()=>{
    let loginbox = document.querySelector('.popup-login');
    
    loginbox.style.display = loginbox.style.display == "block" ? "none":"block";
}


const closeClickLogin = ()=>{
    let loginbox = document.querySelector('.popup-login');
    
    loginbox.style.display = "none";
}

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
</script>
