<?php $__env->startSection('styles'); ?>
    <style>
        .status-img {
            z-index: 1000;
            top: -1px !important;
            left: 13px;
            position: absolute;
            display: inline !important;
            width: 160px;
        }

    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('front-end-content'); ?>

<?php if($attachment->attachment_unique_input === 'frontbanner'): ?>
<img class="img-fluid" src="<?php echo e(asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename)); ?>" style="height: " alt="">
<?php endif; ?>

    <div class="sidebar-page-container" style="padding: 20px 0px 0px !important;">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="sec-title">
                    <?php if(App::isLocale('ar')): ?>
                        <h2><?php echo $banner->title_ar; ?></h2>
                    <?php else: ?>
                        <h2><?php echo $banner->title; ?></h2>
                    <?php endif; ?>
                </div>
                         <div class="text">
                            <?php if(App::isLocale('ar')): ?>
                            <p><?php echo $banner->description_ar; ?></p>
                            <?php else: ?>
                            <p><?php echo $banner->description; ?></p>
                            <?php endif; ?>
                        </div>
                <!--Form Column-->
                <div class="form-column col-lg-12 col-md-12 col-sm-12 mt-3">
                    <div class="inner-column p-3">

                        <div class="sec-title">
                            <h2>Search Property </h2>
                        </div>
                        <div class="contact-form">
                            <form action="<?php echo e(route('front.properties.search')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <select name="rent_or_sale" id="">
                                            <option value="rent">Rent</option>
                                            <option value="sale">Sale</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <select name="property_type" class="wpcf7-form-control">
                                            <option value="" disabled selected>Property Type</option>
                                            <option value="Apartment">Apartment</option>
                                            <option value="Commercial Building">Commercial Building</option>
                                            <option value="Commercial Villa">Commercial Villa</option>
                                            <option value="Labour Camp">Labour Camp</option>
                                            <option value="Office">Office</option>
                                            <option value="Residential Building">Residential Building</option>
                                            <option value="Retail">Retail</option>
                                            <option value="Studio">Studio</option>
                                            <option value="Townhouse">Townhouse</option>
                                            <option value="Villa">Villa</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <select name="bedrooms" class="wpcf7-form-control">
                                            <option value="" selected disabled>Bedrooms</option>
                                            <option value="0">Studio</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <select name="price_from">
                                            <option value="">Price From</option>
                                            <option value="1000">1,000</option>
                                            <option value="2000">2,000</option>
                                            <option value="3000">3,000</option>
                                            <option value="4000">4,000</option>
                                            <option value="5000">5,000</option>
                                            <option value="6000">6,000</option>
                                            <option value="7000">7,000</option>
                                            <option value="8000">8,000</option>
                                            <option value="9000">9,000</option>
                                            <option value="10000">10,000</option>
                                            <option value="11000">11,000</option>
                                            <option value="12000">12,000</option>
                                            <option value="13000">13,000</option>
                                            <option value="14000">14,000</option>
                                            <option value="15000">15,000</option>
                                            <option value="16000">16,000</option>
                                            <option value="17000">17,000</option>
                                            <option value="18000">18,000</option>
                                            <option value="19000">19,000</option>
                                            <option value="20000">20,000</option>
                                            <option value="21000">21,000</option>
                                            <option value="22000">22,000</option>
                                            <option value="23000">23,000</option>
                                            <option value="24000">24,000</option>
                                            <option value="25000">25,000</option>
                                            <option value="26000">26,000</option>
                                            <option value="27000">27,000</option>
                                            <option value="28000">28,000</option>
                                            <option value="29000">29,000</option>
                                            <option value="30000">30,000</option>
                                            <option value="31000">31,000</option>
                                            <option value="32000">32,000</option>
                                            <option value="33000">33,000</option>
                                            <option value="34000">34,000</option>
                                            <option value="35000">35,000</option>
                                            <option value="36000">36,000</option>
                                            <option value="37000">37,000</option>
                                            <option value="38000">38,000</option>
                                            <option value="39000">39,000</option>
                                            <option value="40000">40,000</option>
                                            <option value="41000">41,000</option>
                                            <option value="42000">42,000</option>
                                            <option value="43000">43,000</option>
                                            <option value="44000">44,000</option>
                                            <option value="45000">45,000</option>
                                            <option value="46000">46,000</option>
                                            <option value="47000">47,000</option>
                                            <option value="48000">48,000</option>
                                            <option value="49000">49,000</option>
                                            <option value="50000">50,000</option>
                                            <option value="51000">51,000</option>
                                            <option value="52000">52,000</option>
                                            <option value="53000">53,000</option>
                                            <option value="54000">54,000</option>
                                            <option value="55000">55,000</option>
                                            <option value="56000">56,000</option>
                                            <option value="57000">57,000</option>
                                            <option value="58000">58,000</option>
                                            <option value="59000">59,000</option>
                                            <option value="60000">60,000</option>
                                            <option value="61000">61,000</option>
                                            <option value="62000">62,000</option>
                                            <option value="63000">63,000</option>
                                            <option value="64000">64,000</option>
                                            <option value="65000">65,000</option>
                                            <option value="66000">66,000</option>
                                            <option value="67000">67,000</option>
                                            <option value="68000">68,000</option>
                                            <option value="69000">69,000</option>
                                            <option value="70000">70,000</option>
                                            <option value="71000">71,000</option>
                                            <option value="72000">72,000</option>
                                            <option value="73000">73,000</option>
                                            <option value="74000">74,000</option>
                                            <option value="75000">75,000</option>
                                            <option value="76000">76,000</option>
                                            <option value="77000">77,000</option>
                                            <option value="78000">78,000</option>
                                            <option value="79000">79,000</option>
                                            <option value="80000">80,000</option>
                                            <option value="81000">81,000</option>
                                            <option value="82000">82,000</option>
                                            <option value="83000">83,000</option>
                                            <option value="84000">84,000</option>
                                            <option value="85000">85,000</option>
                                            <option value="86000">86,000</option>
                                            <option value="87000">87,000</option>
                                            <option value="88000">88,000</option>
                                            <option value="89000">89,000</option>
                                            <option value="90000">90,000</option>
                                            <option value="91000">91,000</option>
                                            <option value="92000">92,000</option>
                                            <option value="93000">93,000</option>
                                            <option value="94000">94,000</option>
                                            <option value="95000">95,000</option>
                                            <option value="96000">96,000</option>
                                            <option value="97000">97,000</option>
                                            <option value="98000">98,000</option>
                                            <option value="99000">99,000</option>
                                            <option value="100000">100,000</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <select name="price_to">
                                            <option value="">Price To</option>
                                            <option value="1000">1,000</option>
                                            <option value="2000">2,000</option>
                                            <option value="3000">3,000</option>
                                            <option value="4000">4,000</option>
                                            <option value="5000">5,000</option>
                                            <option value="6000">6,000</option>
                                            <option value="7000">7,000</option>
                                            <option value="8000">8,000</option>
                                            <option value="9000">9,000</option>
                                            <option value="10000">10,000</option>
                                            <option value="11000">11,000</option>
                                            <option value="12000">12,000</option>
                                            <option value="13000">13,000</option>
                                            <option value="14000">14,000</option>
                                            <option value="15000">15,000</option>
                                            <option value="16000">16,000</option>
                                            <option value="17000">17,000</option>
                                            <option value="18000">18,000</option>
                                            <option value="19000">19,000</option>
                                            <option value="20000">20,000</option>
                                            <option value="21000">21,000</option>
                                            <option value="22000">22,000</option>
                                            <option value="23000">23,000</option>
                                            <option value="24000">24,000</option>
                                            <option value="25000">25,000</option>
                                            <option value="26000">26,000</option>
                                            <option value="27000">27,000</option>
                                            <option value="28000">28,000</option>
                                            <option value="29000">29,000</option>
                                            <option value="30000">30,000</option>
                                            <option value="31000">31,000</option>
                                            <option value="32000">32,000</option>
                                            <option value="33000">33,000</option>
                                            <option value="34000">34,000</option>
                                            <option value="35000">35,000</option>
                                            <option value="36000">36,000</option>
                                            <option value="37000">37,000</option>
                                            <option value="38000">38,000</option>
                                            <option value="39000">39,000</option>
                                            <option value="40000">40,000</option>
                                            <option value="41000">41,000</option>
                                            <option value="42000">42,000</option>
                                            <option value="43000">43,000</option>
                                            <option value="44000">44,000</option>
                                            <option value="45000">45,000</option>
                                            <option value="46000">46,000</option>
                                            <option value="47000">47,000</option>
                                            <option value="48000">48,000</option>
                                            <option value="49000">49,000</option>
                                            <option value="50000">50,000</option>
                                            <option value="51000">51,000</option>
                                            <option value="52000">52,000</option>
                                            <option value="53000">53,000</option>
                                            <option value="54000">54,000</option>
                                            <option value="55000">55,000</option>
                                            <option value="56000">56,000</option>
                                            <option value="57000">57,000</option>
                                            <option value="58000">58,000</option>
                                            <option value="59000">59,000</option>
                                            <option value="60000">60,000</option>
                                            <option value="61000">61,000</option>
                                            <option value="62000">62,000</option>
                                            <option value="63000">63,000</option>
                                            <option value="64000">64,000</option>
                                            <option value="65000">65,000</option>
                                            <option value="66000">66,000</option>
                                            <option value="67000">67,000</option>
                                            <option value="68000">68,000</option>
                                            <option value="69000">69,000</option>
                                            <option value="70000">70,000</option>
                                            <option value="71000">71,000</option>
                                            <option value="72000">72,000</option>
                                            <option value="73000">73,000</option>
                                            <option value="74000">74,000</option>
                                            <option value="75000">75,000</option>
                                            <option value="76000">76,000</option>
                                            <option value="77000">77,000</option>
                                            <option value="78000">78,000</option>
                                            <option value="79000">79,000</option>
                                            <option value="80000">80,000</option>
                                            <option value="81000">81,000</option>
                                            <option value="82000">82,000</option>
                                            <option value="83000">83,000</option>
                                            <option value="84000">84,000</option>
                                            <option value="85000">85,000</option>
                                            <option value="86000">86,000</option>
                                            <option value="87000">87,000</option>
                                            <option value="88000">88,000</option>
                                            <option value="89000">89,000</option>
                                            <option value="90000">90,000</option>
                                            <option value="91000">91,000</option>
                                            <option value="92000">92,000</option>
                                            <option value="93000">93,000</option>
                                            <option value="94000">94,000</option>
                                            <option value="95000">95,000</option>
                                            <option value="96000">96,000</option>
                                            <option value="97000">97,000</option>
                                            <option value="98000">98,000</option>
                                            <option value="99000">99,000</option>
                                            <option value="100000">100,000</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <select name="builtup_area">
                                            <option value="">Size</option>
                                            <option value="0-1000">0 to 1000 Sq.Mts</option>
                                            <option value="1001-3000">1001 to 3000 Sq.Mts</option>
                                            <option value="3001-5000">3001 to 5000 Sq.Mts</option>
                                            <option value="5001-15000">5001 to 15000 Sq.Mts</option>
                                            <option value="15001-100000">15001 to 100000 Sq.Mts</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input class="theme-btn btn-style-one" type="submit" value="Search"
                                            style="padding:12px 20px !important">
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row clearfix mt-3">
                
                <!--Content Side-->
                <div class="content-side col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 0px !important;">
                    <!--Shop Single-->
                    <?php if(session()->has('message')): ?>
                        <div class="alert alert-success" style="color:#28a745;"><?php echo e(session('message')); ?></div>
                    <?php endif; ?>
                    <div class="shop-section">
                        <div class="our-shops" style="margin-bottom: 30px !important; padding-bottom: 22px !important;">
                            <div class="row clearfix">
                                <!--Shop Item-->
                                <div class="mixitup-gallery">
                                    <!--Filter-->
                                    <div class="filters clearfix">
                                        <div class="filter-list row clearfix">
                                            <!--Case block-->
                                            <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <?php
                                                    $attachment = explode(',', $item->images);
                                                ?>

                                                <div
                                                    class="case-block mix planning col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-2">
                                                    <div class="inner-box" style="overflow: hidden !important;">
                                                        <div class="image">
                                                            <?php if(isset($attachment)): ?>
                                                                <img src="<?php echo e(asset('storage/public/frontuser/' . $attachment[0])); ?>"
                                                                    alt="" style="height:350px !important">
                                                            <?php else: ?>
                                                                <img src="#" alt="No found">
                                                            <?php endif; ?>
                                                            <div class="overlay-box">
                                                                <div class="overlay-inner">
                                                                    <div class="content">
                                                                        <h3>
                                                                            <a
                                                                                href="<?php echo e(route('front.property.details', $item->id)); ?>"><?php echo e($item->title); ?></a>
                                                                        </h3>
                                                                        <div class="text">
                                                                            
                                                                        </div>
                                                                        <a href="<?php echo e(route('front.property.details', $item->id)); ?>"
                                                                            class="btn btn-veteran read-more">View Details
                                                                            <span class="fa fa-long-arrow-right"></span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <img class="status-img"
                                                        src="<?php echo e(asset('storage/public/product_status/' . $item->property_status . '.png')); ?>"
                                                        alt="" style="display:inline !important;">

                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <!--Styled Pagination-->
                        <?php echo e($properties->links()); ?>


                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/properties-managment/front-properties.blade.php ENDPATH**/ ?>