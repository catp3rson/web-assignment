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
                        "image": "'.$row['image'].'",
                    },';
                }
            }
        ?>
    ]
    const html = newJson.map((items) =>{
    return `
        <a href="tutor.php?code=${items.course_code}" style="text-decoration:inherit; color:inherit;"><div class="product-card">
            <div class="product-card--image">
                <img margin-right: auto; width="256" height="256" src="image_course/math/${items.image}" alt="List of available math courses" title="User Icon free icon" class="loaded">
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
    const response = await fetch('https://617bd868d842cf001711c0fe.mockapi.io/item');
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
                        "image": "'.$row['image'].'",
                    },';
                }
            }
        ?>
    ]
    const html = newJson.map((items) =>{
        return `
        <a href="tutor.php?code=${items.course_code}" style="text-decoration:inherit; color:inherit;"><div class="product-card">
            <div class="product-card--image">
                <img margin-right: auto; width="256" height="256" src="image_course/physics/${items.image}" alt="User Icon free icon" title="User Icon free icon" class="loaded">
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
    const response = await fetch('https://617bd868d842cf001711c0fe.mockapi.io/item');
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
                        "image": "'.$row['image'].'",
                    },';
                }
            }
        ?>
    ]
    const html = newJson.map((items) =>{
        return `
        <a href="tutor.php?code=${items.course_code}" style="text-decoration:inherit; color:inherit;"><div class="product-card">
            <div class="product-card--image">
                <img margin-right: auto; width="256" height="256" src="image_course/chemistry/${items.image}" alt="User Icon free icon" title="User Icon free icon" class="loaded">
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
    const response = await fetch('https://617bd868d842cf001711c0fe.mockapi.io/item');
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
                        "image": "'.$row['image'].'",
                    },';
                }
            }
        ?>
    ]
    const html = newJson.map((items) =>{
        return `
        <a href="tutor.php?code=${items.course_code}" style="text-decoration:inherit; color:inherit;"><div class="product-card">
            <div class="product-card--image">
                <img margin-right: auto; width="256" height="256" src="image_course/biology/${items.image}" alt="User Icon free icon" title="User Icon free icon" class="loaded">
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
    const response = await fetch('https://617bd868d842cf001711c0fe.mockapi.io/item');
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
                        "image": "'.$row['image'].'",
                    },';
                }
            }
        ?>
    ]
    const html = newJson.map((items) =>{
        return `
        <a href="tutor.php?code=${items.course_code}" style="text-decoration:inherit; color:inherit;"><div class="product-card">
            <div class="product-card--image">
                <img margin-right: auto; width="256" height="256" src="image_course/english/${items.image}" alt="User Icon free icon" title="User Icon free icon" class="loaded">
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

menuTabMath();
menuTabPhysics();
menuTabChemistry();
menuTabBiology();
menuTabLanguages();

</script>