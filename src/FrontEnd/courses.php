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
                                <h4> Physics</h4>
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
                                <h4> English</h4>
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
</div>
<script type="text/JavaScript">
    var $li = $('#pills-tab li').click(function() {
        $li.removeClass('selected');
        $(this).addClass('selected');
    });
</script>