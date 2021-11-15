const  handleMenuTab1 = async ()=>{
    const response = await fetch('https://617bd868d842cf001711c0fe.mockapi.io/item');
    const myJson = await response.json();
    let newJson = [];
    if(myJson.length>10)
        newJson = myJson.slice(0,6);
    const html = newJson.map((items) =>{
        // console.log(items);
    return `
    <div class="product-card">
                                <div class="product-card--image">
                                    <img margin-right: auto; width="256" height="256" src="https://w7.pngwing.com/pngs/339/877/png-transparent-chemistry-encapsulated-postscript-chemistry-icon-miscellaneous-biology-line.png" alt="User Icon free icon" title="User Icon free icon" class="loaded">
                                </div>

                                <div class="content-stars">
                                    <div class="star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-h"></i>
                                        </div>
                                        </div>


                                <div class="product-card--info">
                                    <span id="product-name"><b>${items.name}</b></span>
                                    </br>
                                     <span id="product-name"> Age </span>
                                     <div class="info-tutor">

                                        <p id="product-name"> information </p>
                                        </div>
                                    <div class="product-card--footer">
                                    

                                       

                                        <h4> <i class="far fa-clock"></i> 2 hours </h4>
                                        <h4> <i class="far fa-calendar-alt"></i> 6 months </h4>
                                        <h4> <i class="far fa-book"></i> 12 modules </h4>
                                        <div class="product-card--button">
                                            
                                            <a href="./tutor.html"><i class="product-card--plus fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>

        
    `;
                }).join(" ");
    let a = document.querySelector("#first-menu-tab");
    a.innerHTML = html;          
};

const  handleMenuTab2 = async ()=>{
    const response = await fetch('https://617bd868d842cf001711c0fe.mockapi.io/item2');
    const myJson = await response.json();
    let newJson = [];
    if(myJson.length>10)
        newJson = myJson.slice(0,6);
    const html = newJson.map((items) =>{
        // console.log(items);
    return `
    <div class="product-card">
                              <div class="product-card--image">
                                    <img margin-right: auto; width="256" height="256" src="https://image.pngaaa.com/583/4863583-middle.png" alt="User Icon free icon" title="User Icon free icon" class="loaded">
                                </div>

                                <div class="content-stars">
                                    <div class="star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-h"></i>
                                        </div>
                                        </div>


                                <div class="product-card--info">
                                    <span id="product-name"><b>${items.name}</b></span>
                                    </br>
                                     <span id="product-name"> Age </span>
                                     <div class="info-tutor">

                                        <p id="product-name"> information </p>
                                        </div>
                                    <div class="product-card--footer">
                                    

                                       

                                        <h4> <i class="far fa-clock"></i> 2 hours </h4>
                                        <h4> <i class="far fa-calendar-alt"></i> 6 months </h4>
                                        <h4> <i class="far fa-book"></i> 12 modules </h4>
                                        <div class="product-card--button">
                                            
                                            <a href="./tutor.html"><i class="product-card--plus fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>

    `;
                }).join(" ");
    let a = document.querySelector("#second-menu-tab");
    a.innerHTML = html;          
};

const  handleMenuTab3 = async ()=>{
    const response = await fetch('https://617bd868d842cf001711c0fe.mockapi.io/item3');
    const myJson = await response.json();
    let newJson = [];
    if(myJson.length>10)
        newJson = myJson.slice(0,6);
    const html = newJson.map((items) =>{
        // console.log(items);
    return `
    <div class="product-card">
                             <div class="product-card--image">
                                    <img margin-right: auto; width="256" height="256" src="https://w7.pngwing.com/pngs/339/877/png-transparent-chemistry-encapsulated-postscript-chemistry-icon-miscellaneous-biology-line.png" alt="User Icon free icon" title="User Icon free icon" class="loaded">
                                </div>

                                <div class="content-stars">
                                    <div class="star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-h"></i>
                                        </div>
                                        </div>


                                <div class="product-card--info">
                                    <span id="product-name"><b>${items.name}</b></span>
                                    </br>
                                     <span id="product-name"> Age </span>
                                     <div class="info-tutor">

                                        <p id="product-name"> information </p>
                                        </div>
                                    <div class="product-card--footer">
                                    

                                       

                                        <h4> <i class="far fa-clock"></i> 2 hours </h4>
                                        <h4> <i class="far fa-calendar-alt"></i> 6 months </h4>
                                        <h4> <i class="far fa-book"></i> 12 modules </h4>
                                        <div class="product-card--button">
                                            
                                            <a href="./tutor.html"><i class="product-card--plus fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>

    `;
                }).join(" ");
    let a = document.querySelector("#third-menu-tab");
    a.innerHTML = html;          
};

const  handleMenuTab4 = async ()=>{
    const response = await fetch('https://619104b741928b001768ff0f.mockapi.io/chemistry/bi');
    const myJson = await response.json();
    let newJson = [];
    if(myJson.length>10)
        newJson = myJson.slice(0,6);
    const html = newJson.map((items) =>{
        // console.log(items);
    return `
    <div class="product-card">
                           <div class="product-card--image">
                                    <img margin-right: auto; width="256" height="256" src="https://image.similarpng.com/thumbnail/2020/12/Google-logo-design-clipart-PNG.png" alt="User Icon free icon" title="User Icon free icon" class="loaded">
                                </div>

                                <div class="content-stars">
                                    <div class="star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-h"></i>
                                        </div>
                                        </div>


                                <div class="product-card--info">
                                    <span id="product-name"><b>${items.name}</b></span>
                                    </br>
                                     <span id="product-name"> Age </span>
                                     <div class="info-tutor">

                                        <p id="product-name"> information </p>
                                        </div>
                                    <div class="product-card--footer">
                                    

                                       

                                        <h4> <i class="far fa-clock"></i> 2 hours </h4>
                                        <h4> <i class="far fa-calendar-alt"></i> 6 months </h4>
                                        <h4> <i class="far fa-book"></i> 12 modules </h4>
                                        <div class="product-card--button">
                                            
                                            <a href="./tutor.html"><i class="product-card--plus fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>

    `;
                }).join(" ");
    let a = document.querySelector("#fourth-menu-tab");
    a.innerHTML = html;          
};

const  handleMenuTab5 = async ()=>{
    const response = await fetch('https://617bd868d842cf001711c0fe.mockapi.io/item3');
    const myJson = await response.json();
    let newJson = [];
    if(myJson.length>10)
        newJson = myJson.slice(0,6);
    const html = newJson.map((items) =>{
        // console.log(items);
    return `
    <div class="product-card">
                            <div class="product-card--image">
                                    <img margin-right: auto; width="256" height="256" src="https://cdn-icons-png.flaticon.com/512/10/10938.png" alt="User Icon free icon" title="User Icon free icon" class="loaded">
                                </div>

                                <div class="content-stars">
                                    <div class="star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-h"></i>
                                        </div>
                                        </div>


                                <div class="product-card--info">
                                    <span id="product-name"><b>${items.name}</b></span>
                                    </br>
                                     <span id="product-name"> Age </span>
                                     <div class="info-tutor">

                                        <p id="product-name"> information </p>
                                        </div>
                                    <div class="product-card--footer">
                                    

                                       

                                        <h4> <i class="far fa-clock"></i> 2 hours </h4>
                                        <h4> <i class="far fa-calendar-alt"></i> 6 months </h4>
                                        <h4> <i class="far fa-book"></i> 12 modules </h4>
                                        <div class="product-card--button">
                                            
                                            <a href="./tutor.html"><i class="product-card--plus fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>

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
        newJson = myJson.slice(0,8);
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

handleMenuTab1();
handleMenuTab2();
handleMenuTab3();
handleMenuTab4();
handleMenuTab5();
handleNews();

var $li = $('#pills-tab li').click(function() {
    $li.removeClass('selected');
    $(this).addClass('selected');
});

const clickLogin = ()=>{
    let loginbox = document.querySelector('.popup-login');
    
    loginbox.style.display = loginbox.style.display == "block" ? "none":"block";
}


const closeClickLogin = ()=>{
    let loginbox = document.querySelector('.popup-login');
    
    loginbox.style.display = "none";
}

