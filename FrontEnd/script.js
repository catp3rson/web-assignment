const  handleMenuTab1 = async ()=>{
    const response = await fetch('https://617bd868d842cf001711c0fe.mockapi.io/item');
    const myJson = await response.json();
    let newJson = [];
    if(myJson.length>12)
        newJson = myJson.slice(0,12);
    const html = newJson.map((items) =>{
        // console.log(items);
    return `
    <div class="product-card">
                                <div class="product-card--image">
                                    <img src="./assets/images/coffee1.jpg" alt="">
                                </div>
                                <div class="product-card--info">
                                    <span id="product-name"><b>${items.name}</b></span>
                                    <div class="product-card--footer">
                                        <span>$${items.price}</span>
                                        <div class="product-card--button">
                                            <i class="fas fa-plus"></i>
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
    if(myJson.length>12)
        newJson = myJson.slice(0,12);
    const html = newJson.map((items) =>{
        // console.log(items);
    return `
    <div class="product-card">
                                <div class="product-card--image">
                                    <img src="./assets/images/coffee2.jpg" alt="">
                                </div>
                                <div class="product-card--info">
                                    <span id="product-name"><b>${items.name}</b></span>
                                    <div class="product-card--footer">
                                        <span>$${items.price}</span>
                                        <div class="product-card--button">
                                            <i class="fas fa-plus"></i>
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
    if(myJson.length>12)
        newJson = myJson.slice(0,12);
    const html = newJson.map((items) =>{
        // console.log(items);
    return `
    <div class="product-card">
                                <div class="product-card--image">
                                    <img src="./assets/images/coffee3.jpg" alt="">
                                </div>
                                <div class="product-card--info">
                                    <span id="product-name"><b>${items.name}</b></span>
                                    <div class="product-card--footer">
                                        <span>$${items.price}</span>
                                        <div class="product-card--button">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
    `;
                }).join(" ");
    let a = document.querySelector("#third-menu-tab");
    a.innerHTML = html;          
};

const  handleNews = async ()=>{
    const response = await fetch('https://617bd868d842cf001711c0fe.mockapi.io/news');
    const myJson = await response.json();
    let newJson = [];
    if(myJson.length>6)
        newJson = myJson.slice(0,6);
    const html = newJson.map((items) =>{
        // console.log(items);
    return `
    <div class="news-card">
                        <img src="./assets/images/news1.jpg" alt="news1">
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