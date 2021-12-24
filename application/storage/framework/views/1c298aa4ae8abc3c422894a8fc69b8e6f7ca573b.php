<style>
    .faa {
        border-right: 2px solid white;
        line-height: 5px;
        padding: 10px;
        color: white;
        font-family: 'Montserrat', sans-serif;
    }

    .faa:hover {
        color: #2ECC40;
    }

    .footer-anchors {
        line-height: 10px;
    }


    @media  screen and (max-width: 600px) {
        .fa-div {
            flex-direction: column !important;
        }

        .faa {
            line-height: 20px;
            text-align: center;
            border-bottom: 1px solid #2ECC40;
            border-right: none;
        }

        .inner {
            padding-bottom: 19px !important;
        }
    }

    @media  screen and (max-width: 1100px) {

        .faa {
            line-height: 20px;
        }

        .footer-logo-div2 {
            margin-bottom: 20px;
        }

    }

    .modal-body{
        padding-left: 45px !important;
        padding-right: 45px !important;
    }
    .modal ul li{
        /* list-style: disc !important ; */
    }
    .modal ol li{
        /* list-style: decimal !important ; */
    }

</style>

<div class="bottom-parallax">
    <footer class="main-footer" style="border-bottom: 2px solid rgba(255,255,255,0.10); ">
        <!--Widgets Section-->
        <div class="auto-container">

            <div class="widgets-section"
                style="border-bottom: none !important; border: none !important; box-shadow: none; ">
                <div class="row clearfix">

                    <!--Footer Column-->
                    <div class="footer-column col-lg-4 col-md-6 col-sm-12">
                        <!--About Widget-->
                        <div class="footer-widget logo-widget ">
                            <div class="logo mt-4">
                                <img src="<?php echo e(asset('public/front-end/images/resource/footer-logo1.png')); ?>">
                            </div>
                        </div>
                    </div>

                    <!--Footer Column-->
                    <div class="footer-column col-lg-4 col-md-6 col-sm-12">
                        <!--About Widget-->
                        <div class="footer-widget links-widget footer-logo-div1" style="height: 100.5% !important">
                            <h5><?php echo e(__('fl.Navigation')); ?>:</h5>
                            <div class="row clearfix">
                                <ul class="link-list col-md-6 col-sm-6 col-xs-12">
                                    <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('fl.Home')); ?></a></li>
                                    <li><a
                                            href="<?php echo e(route('front.know-us')); ?>"><?php echo e(__('fl.About Us')); ?></a>
                                    </li>
                                    <li><a href="<?php echo e(route('front.career')); ?>"><?php echo e(__('fl.Careers')); ?></a></li>
                                    <li><a href="<?php echo e(route('front.contact-us')); ?>"><?php echo e(__('fl.Contact us')); ?></a></li>
                                    <li style="display: flex"><a
                                            href="<?php echo e(route('front.footer.legal-regisatration')); ?>"><?php echo e(__('fl.Legal Registration & License')); ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!--Footer Column-->
                    <div class="footer-column col-lg-4 col-md-6 col-sm-12">
                        <!--About Widget-->
                        <div class="footer-widget news-widget footer-logo-div2">
                            <h5><?php echo e(__('fl.Contact us')); ?></h5>

                            <div class="news-widget-block">
                                <div class="inner pb-2"
                                    style="border-bottom: none !important; border: none !important; box-shadow: none; margin-bottom: -20px;">
                                    <div class="icon flaticon-world"></div>
                                    <div class="text">
                                        <a href="javaScript:void()">
                                            <?php echo e(__('fl.site_address')); ?>

                                        </a>
                                    </div>
                                </div>
                                <div class="inner mt-4">
                                    <div class="icon flaticon-call" style="top: -3px !important"></div>
                                    <div class="text"><a href="tel:+974 44441061">+974 44441061</a></div>
                                </div>
                                <div class="inner mt-4">
                                    <div class="icon fa fa-fax" style="top: -3px !important"></div>
                                    <div class="text"><a href="javaScript:void()">+974 44441062</a></div>
                                </div>
                                <div class="inner mt-4">
                                    <div class="icon fa fa-whatsapp" style="top: -3px !important"></div>
                                    <div class="text"><a href="https://wa.me/97474441060">Send Message</a></div>
                                </div>
                                <div class="inner mt-4">
                                    <div class="icon fa fa-envelope" style="top: -4px !important"></div>
                                    <div class="text">
                                        <a class="text-white"
                                            href="<?php echo e(route('front.contact-us')); ?>"><?php echo e(__('fl.Contact us')); ?></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </footer>

    <div class="d-flex justify-content-center faa fa-div" style="background-color: #1c1c1c;">
        
        <a class="faa" id="all-rights-reserved" href="#">
            <span class="footer-anchors">VETERAN GENERAL CONTRACTING 2021. All Rights Reserved</span>
        </a>
        
        <a class="faa" id="web-use" href="#">
            <span class="footer-anchors">Website Use Terms & Conditions</span>
        </a>
        
        <a class="faa" id="privacy-policy" href="#">
            <span class="footer-anchors">Privacy Policy</span>
        </a>
        
        <a class="faa" style="border-right: none !important;" id="cookies-policy" href="#">
            <span class="footer-anchors">Cookies Policy </span>
        </a>

        

    </div>
</div>


<?php $rec = \App\Models\FrontBanner::where('id', 46)->first(); ?>
<?php if(isset($rec)): ?>

    <div class="modal" id="copyright-policy-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-danger">
                        <?php if(App::isLocale('ar')): ?>
                            <h4><?php echo $rec->title_ar; ?></h4>
                        <?php else: ?>
                            <h4><?php echo $rec->title; ?></h4>
                        <?php endif; ?>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if(App::isLocale('ar')): ?>
                    <p><?php echo $rec->description_ar; ?></p>
                <?php else: ?>
                    <p><?php echo $rec->description; ?></p>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>



<?php $rec = \App\Models\FrontBanner::where('id', 54)->first(); ?>
<?php if(isset($rec)): ?>

    <div class="modal" id="privacy-policy-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-danger">
                        <?php if(App::isLocale('ar')): ?>
                            <h4><?php echo $rec->title_ar; ?></h4>
                        <?php else: ?>
                            <h4><?php echo $rec->title; ?></h4>
                        <?php endif; ?>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if(App::isLocale('ar')): ?>
                    <p><?php echo $rec->description_ar; ?></p>
                <?php else: ?>
                    <p><?php echo $rec->description; ?></p>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>



<?php $rec = \App\Models\FrontBanner::where('id', 45)->first(); ?>
<?php if(isset($rec)): ?>

    <div class="modal" id="web-use-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-danger">
                        <?php if(App::isLocale('ar')): ?>
                            <h4><?php echo $rec->title_ar; ?></h4>
                        <?php else: ?>
                            <h4><?php echo $rec->title; ?></h4>
                        <?php endif; ?>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if(App::isLocale('ar')): ?>
                    <p><?php echo $rec->description_ar; ?></p>
                <?php else: ?>
                    <p><?php echo $rec->description; ?></p>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>



<?php $rec = \App\Models\FrontBanner::where('id', 53)->first(); ?>
<?php if(isset($rec)): ?>

    <div class="modal" id="cookies-policy-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-danger">
                        <?php if(App::isLocale('ar')): ?>
                            <h4><?php echo $rec->title_ar; ?></h4>
                        <?php else: ?>
                            <h4><?php echo $rec->title; ?></h4>
                        <?php endif; ?>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if(App::isLocale('ar')): ?>
                    <p><?php echo $rec->description_ar; ?></p>
                <?php else: ?>
                    <p><?php echo $rec->description; ?></p>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php $rec = \App\Models\FrontBanner::where('id', 54)->first(); ?>
<?php if(isset($rec)): ?>

    <div class="modal" id="privacy-policy-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-danger">
                        <?php if(App::isLocale('ar')): ?>
                            <h2><?php echo $rec->title_ar; ?></h2>
                        <?php else: ?>
                            <h2><?php echo $rec->title; ?></h2>
                        <?php endif; ?>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if(App::isLocale('ar')): ?>
                    <p><?php echo $rec->description_ar; ?></p>
                <?php else: ?>
                    <p><?php echo $rec->description; ?></p>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH H:\wamp64\www\application\resources\views/front-end/partials/footer.blade.php ENDPATH**/ ?>