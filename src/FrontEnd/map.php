<?php 
    require_once dirname(__FILE__) . "/../BackEnd/getmap.php";
?>

<div id="map_location" class="location">
    <div class="container">
        <!-- Google Map -->
        <div class="product__heading">
            <h1 style="font-size: 28px;font-weight: 600;" class="heading-title" >
                <i class="product__heading-icon fas fa-map-marked-alt"></i>
                Locations
            </h1>
        </div>
        <div id="map"></div>
        <div class="map-menu">
            <div id="markers"></div>
        </div>
    </div>
</div>