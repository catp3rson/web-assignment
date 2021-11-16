<?php 
    include "config.php"
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
                    echo '{"course_code": "'.$row['course_code'].'","course_name": "'.$row['course_name'].'","course_fee": new Number('.$row['course_fee'].'),"brief": "'.$row['brief'].'"},';
                }
            }
        ?>
    ]
    const html = newJson.map((items) =>{
    return `
        <a href="./register/tutor.php?code=${items.course_code}" style="text-decoration:inherit; color:inherit;"><div class="product-card">
            <div class="product-card--image">
                <img margin-right: auto; width="256" height="256" src="https://w7.pngwing.com/pngs/339/877/png-transparent-chemistry-encapsulated-postscript-chemistry-icon-miscellaneous-biology-line.png" alt="User Icon free icon" title="User Icon free icon" class="loaded">
            </div>
            <div class="product-card--info">
                <span id="product-name"><b>${items.course_name}</b></span>
                </br>
                <span id="product-name"> ${items.course_fee.toLocaleString('en-VN', {style: 'currency',currency: 'VND', minimumFractionDigits: 0})} </span>
                <div class="info-tutor">
                    <p id="product-name"> ${items.brief} </p>
                </div>
                <div class="product-card--footer" style="width=100%">
                    <h4> <i class="far fa-clock"></i> 2 hours </h4>
                    <h4> <i class="far fa-calendar-alt"></i> 6 months </h4>
                    <h4> <i class="far fa-book"></i> 12 modules </h4>
                </div>
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
                    echo '{"course_code": "'.$row['course_code'].'","course_name": "'.$row['course_name'].'","course_fee": new Number('.$row['course_fee'].'),"brief": "'.$row['brief'].'"},';
                }
            }
        ?>
    ]
    const html = newJson.map((items) =>{
    return `
        <a href="./register/tutor.php?code=${items.course_code}" style="text-decoration:inherit; color:inherit;"><div class="product-card">
            <div class="product-card--image">
                <img margin-right: auto; width="256" height="256" src="https://w7.pngwing.com/pngs/339/877/png-transparent-chemistry-encapsulated-postscript-chemistry-icon-miscellaneous-biology-line.png" alt="User Icon free icon" title="User Icon free icon" class="loaded">
            </div>
            <div class="product-card--info">
                <span id="product-name"><b>${items.course_name}</b></span>
                </br>
                <span id="product-name"> ${items.course_fee.toLocaleString('en-VN', {style: 'currency',currency: 'VND', minimumFractionDigits: 0})} </span>
                <div class="info-tutor">
                    <p id="product-name"> ${items.brief} </p>
                </div>
                <div class="product-card--footer" style="width=100%">
                    <h4> <i class="far fa-clock"></i> 2 hours </h4>
                    <h4> <i class="far fa-calendar-alt"></i> 6 months </h4>
                    <h4> <i class="far fa-book"></i> 12 modules </h4>
                </div>
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
                    echo '{"course_code": "'.$row['course_code'].'","course_name": "'.$row['course_name'].'","course_fee": new Number('.$row['course_fee'].'),"brief": "'.$row['brief'].'"},';
                }
            }
        ?>
    ]
    const html = newJson.map((items) =>{
    return `
        <a href="./register/tutor.php?code=${items.course_code}" style="text-decoration:inherit; color:inherit;"><div class="product-card">
            <div class="product-card--image">
                <img margin-right: auto; width="256" height="256" src="https://w7.pngwing.com/pngs/339/877/png-transparent-chemistry-encapsulated-postscript-chemistry-icon-miscellaneous-biology-line.png" alt="User Icon free icon" title="User Icon free icon" class="loaded">
            </div>
            <div class="product-card--info">
                <span id="product-name"><b>${items.course_name}</b></span>
                </br>
                <span id="product-name"> ${items.course_fee.toLocaleString('en-VN', {style: 'currency',currency: 'VND', minimumFractionDigits: 0})} </span>
                <div class="info-tutor">
                    <p id="product-name"> ${items.brief} </p>
                </div>
                <div class="product-card--footer" style="width=100%">
                    <h4> <i class="far fa-clock"></i> 2 hours </h4>
                    <h4> <i class="far fa-calendar-alt"></i> 6 months </h4>
                    <h4> <i class="far fa-book"></i> 12 modules </h4>
                </div>
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
                    echo '{"course_code": "'.$row['course_code'].'","course_name": "'.$row['course_name'].'","course_fee": new Number('.$row['course_fee'].'),"brief": "'.$row['brief'].'"},';
                }
            }
        ?>
    ]
    const html = newJson.map((items) =>{
    return `
        <a href="./register/tutor.php?code=${items.course_code}" style="text-decoration:inherit; color:inherit;"><div class="product-card">
            <div class="product-card--image">
                <img margin-right: auto; width="256" height="256" src="https://w7.pngwing.com/pngs/339/877/png-transparent-chemistry-encapsulated-postscript-chemistry-icon-miscellaneous-biology-line.png" alt="User Icon free icon" title="User Icon free icon" class="loaded">
            </div>
            <div class="product-card--info">
                <span id="product-name"><b>${items.course_name}</b></span>
                </br>
                <span id="product-name"> ${items.course_fee.toLocaleString('en-VN', {style: 'currency',currency: 'VND', minimumFractionDigits: 0})} </span>
                <div class="info-tutor">
                    <p id="product-name"> ${items.brief} </p>
                </div>
                <div class="product-card--footer" style="width=100%">
                    <h4> <i class="far fa-clock"></i> 2 hours </h4>
                    <h4> <i class="far fa-calendar-alt"></i> 6 months </h4>
                    <h4> <i class="far fa-book"></i> 12 modules </h4>
                </div>
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
                    echo '{"course_code": "'.$row['course_code'].'","course_name": "'.$row['course_name'].'","course_fee": new Number('.$row['course_fee'].'),"brief": "'.$row['brief'].'"},';
                }
            }
        ?>
    ]
    const html = newJson.map((items) =>{
    return `
        <a href="./register/tutor.php?code=${items.course_code}" style="text-decoration:inherit; color:inherit;"><div class="product-card">
            <div class="product-card--image">
                <img margin-right: auto; width="256" height="256" src="https://w7.pngwing.com/pngs/339/877/png-transparent-chemistry-encapsulated-postscript-chemistry-icon-miscellaneous-biology-line.png" alt="User Icon free icon" title="User Icon free icon" class="loaded">
            </div>
            <div class="product-card--info">
                <span id="product-name"><b>${items.course_name}</b></span>
                </br>
                <span id="product-name"> ${items.course_fee.toLocaleString('en-VN', {style: 'currency',currency: 'VND', minimumFractionDigits: 0})} </span>
                <div class="info-tutor">
                    <p id="product-name"> ${items.brief} </p>
                </div>
                <div class="product-card--footer" style="width=100%">
                    <h4> <i class="far fa-clock"></i> 2 hours </h4>
                    <h4> <i class="far fa-calendar-alt"></i> 6 months </h4>
                    <h4> <i class="far fa-book"></i> 12 modules </h4>
                </div>
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



const clickLogin = ()=>{
    let loginbox = document.querySelector('.popup-login');
    
    loginbox.style.display = loginbox.style.display == "block" ? "none":"block";
}


const closeClickLogin = ()=>{
    let loginbox = document.querySelector('.popup-login');
    
    loginbox.style.display = "none";
}
</script>