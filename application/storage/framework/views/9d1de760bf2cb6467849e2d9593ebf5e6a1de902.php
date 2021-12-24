<?php $__env->startSection('styles'); ?>
    <style>
        .label-size {
            font-size: 22px;
            font-weight: 600;

        }

        .card.user-card {
            border-top: none;
            -webkit-box-shadow: 0 0 1px 2px rgba(0, 0, 0, 0.05), 0 -2px 1px -2px rgba(0, 0, 0, 0.04), 0 0 0 -1px rgba(0, 0, 0, 0.05);
            box-shadow: 0 0 1px 2px rgba(0, 0, 0, 0.05), 0 -2px 1px -2px rgba(0, 0, 0, 0.04), 0 0 0 -1px rgba(0, 0, 0, 0.05);
            -webkit-transition: all 150ms linear;
            transition: all 150ms linear;
        }

        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
            box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
            border: none;
            margin-bottom: 30px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .card .card-header {
            background-color: transparent;
            border-bottom: none;
            padding: 25px;
        }

        .card .card-header h5 {
            margin-bottom: 0;
            color: #222;
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
            margin-right: 10px;
            line-height: 1.4;
        }

        .card .card-header+.card-block,
        .card .card-header+.card-block-big {
            padding-top: 0;
        }

        .user-card .card-block {
            text-align: center;
        }

        .card .card-block {
            padding: 25px;
        }

        .user-card .card-block .user-image {
            position: relative;
            margin: 0 auto;
            display: inline-block;
            padding: 5px;
            width: 110px;
            height: 110px;
        }

        .user-card .card-block .user-image img {
            z-index: 20;
            position: absolute;
            top: 5px;
            left: 5px;
            width: 100px;
            height: 100px;
        }

        .img-radius {
            border-radius: 50%;
        }

        .f-w-600 {
            font-weight: 600;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .m-t-25 {
            margin-top: 25px;
        }

        .m-t-15 {
            margin-top: 15px;
        }

        .card .card-block p {
            line-height: 1.4;
        }

        .text-muted {
            color: #919aa3 !important;
        }

        .user-card .card-block .activity-leval li.active {
            background-color: #2ed8b6;
        }

        .user-card .card-block .activity-leval li {
            display: inline-block;
            width: 15%;
            height: 4px;
            margin: 0 3px;
            background-color: #ccc;
        }

        .user-card .card-block .counter-block {
            color: #fff;
        }

        .bg-c-blue {
            background: linear-gradient(45deg, #4099ff, #73b4ff);
        }

        .bg-c-green {
            background: linear-gradient(45deg, #2ed8b6, #59e0c5);
        }

        .bg-c-yellow {
            background: linear-gradient(45deg, #FFB64D, #ffcb80);
        }

        .bg-c-pink {
            background: linear-gradient(45deg, #FF5370, #ff869a);
        }

        .m-t-10 {
            margin-top: 10px;
        }

        .p-20 {
            padding: 20px;
        }

        .user-card .card-block .user-social-link i {
            font-size: 30px;
        }

        .text-facebook {
            color: #3B5997;
        }

        .text-twitter {
            color: #42C0FB;
        }

        .text-dribbble {
            color: #EC4A89;
        }

        .user-card .card-block .user-image:before {
            bottom: 0;
            border-bottom-left-radius: 50px;
            border-bottom-right-radius: 50px;
        }

        .user-card .card-block .user-image:after,
        .user-card .card-block .user-image:before {
            content: "";
            width: 100%;
            height: 48%;
            border: 2px solid #4099ff;
            position: absolute;
            left: 0;
            z-index: 10;
        }

        .user-card .card-block .user-image:after {
            top: 0;
            border-top-left-radius: 50px;
            border-top-right-radius: 50px;
        }

        .user-card .card-block .user-image:after,
        .user-card .card-block .user-image:before {
            content: "";
            width: 100%;
            height: 48%;
            border: 2px solid #4099ff;
            position: absolute;
            left: 0;
            z-index: 10;
        }

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('front-end-content'); ?>
    <div class="container px-1 px-md-4 mx-auto">
        <div class="row bg-light mb-2">
            <?php if(isset($service->price) && isset($service->description)): ?>
                <div class="col-md-6 m-2">
                    <div class="card p-1 m-1 bg-light">
                        <div class="card-header">
                            <h3>
                                Service Detail
                            </h3>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Name : <?php echo e($service->title); ?></h5>
                            <p><strong>Description : </strong> <?php echo e($service->service_description ?? 'not found'); ?></p>
                            <?php if(isset($service->rate_per_hour)): ?>
                            <p class="card-text">Rate Per hour : <?php echo e($service->rate_per_hour); ?></p>
                            <?php endif; ?>
                            <?php if(isset($service->rate_per_hour)): ?>
                            <p class="card-text">Minimum Charge : <?php echo e($service->minimum_charge); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <?php
                        $prices = explode('&&&', $service->price);
                        $descriptions = explode('&&&', $service->description);
                    ?>
                   
                    <form action="">
                        <h3 class="text-muted">Please Select A Package</h3>
                        <table class="table">
                            <?php $__currentLoopData = array_combine($prices, $descriptions); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price => $desc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <label class="checkbox-inline mr-4 label-size" for="">
                                            <input type="radio" value="<?php echo e($price); ?>" name="price"
                                                class="service_price">
                                            <input type="hidden" value="<?php echo e($desc); ?>" class="description">
                                            Price: <?php echo e($price); ?>

                                        </label>
                                    </td>
                                    <td>
                                        <?php echo e($desc); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    </form>
                </div>
            <?php endif; ?>

        </div>

        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4">
                    <div class="card user-card">
                        <div class="card-header">
                            <h5>Employee Detail</h5>
                        </div>
                        <div class="card-block">
                            <div class="user-image">
                                <?php $__currentLoopData = App\Models\Attachment::where('attachmentresource_type', 'employee')->where('attachmentresource_id', $user->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <img src="<?php echo e(asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename)); ?>"
                                        alt="" class="img-radius">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <!--<img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-radius"-->
                                <!--    alt="User-Profile-Image">-->
                            </div>
                            <h6 class="f-w-600 m-t-25 m-b-10">Name: <?php echo e(ucwords($user->first_name)); ?></h6>
                            <p class="text-muted">Email: <?php echo e($user->email); ?></p>
                            <p class="text-muted">Phone: <?php echo e($user->phone); ?></p>#
                            <hr>
                            <p class="m-t-15 text-muted"><?php echo e(str_limit($user->description, 10)); ?></p>
                            <hr>
                            <div class="row justify-content-center user-social-link">
                                <a class="btn btn-info btn-sm text-light booking-button">Book Your
                                    Service</a>
                                <button data-id="<?php echo e($user->id); ?>" data-email="<?php echo e($user->email); ?>"
                                    data-name="<?php echo e($user->first_name); ?>" data-last-name="<?php echo e($user->last_name); ?>"
                                    data-phone="<?php echo e($user->phone); ?>" data-description="<?php echo e($user->description); ?>"
                                    class="btn btn-primary btn-sm text-light ml-2 employee">View
                                    Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <h4 class="text-center text-muted">No employees found !!</h4>
            <?php endif; ?>

        </div>
    </div>

    <div class="modal fade" id="employee-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employee-modal">Employee Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h6 class="mb-3">Name</h6>
                            <h6 class="mb-3">Email</h6>
                            <h6 class="mb-3">Phone</h6>
                            <h6 class="mb-3">Description</h6>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3" id="e-name"></h6>
                            <h6 class="mb-3" id="e-email"></h6>
                            <h6 class="mb-3" id="e-phone"></h6>
                            <h6 class="mb-3" id="e-description"></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <div class="modal" id="services-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-danger">
                       <?php if(App::isLocale('ar')): ?>
                            <h4><?php echo $banner->title_ar; ?></h4>
                        <?php else: ?>
                            <h4><?php echo $banner->title; ?></h4>
                        <?php endif; ?>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <?php if(App::isLocale('ar')): ?>
                           <?php echo ($banner->description_ar); ?>

                            <?php else: ?>
                          <?php echo ($banner->description); ?>

                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(window).load(function() {
        if (! localStorage.getItem("servicesModal")) {
            $('#services-modal').modal('show');
        localStorage.setItem('servicesModal', 'true');
    }

    });

</script>
<script>
    $('body').on('click','.booking-button',function(){
            var x = document.getElementsByClassName("booking-button")[0].getAttribute("href");
           if (x == null) {
                alert('PLEASE SELECT PACKAGE FIRST');
                return false;
           }
    });
    $('body').on('click', '.employee', function() {
        $('#e-name').html('')
        $('#e-last-name').html('')
        $('#e-email').html('')
        $('#e-phone').html('')
        $('#e-description').html('')

        let id = $(this).data('id')
        let name = $(this).data('name')
        let last_name = $(this).data('last-name')
        let full_name = name + ' ' + last_name
        let email = $(this).data('email')
        let phone = $(this).data('phone')
        let description = $(this).data('description')
        // let rate_per_hr = $(this).data('rate_per_hr')
        // let min_charge = $(this).data('minimum_charge')

        $('#e-name').html(full_name)
        $('#e-email').html(phone)
        // $('#e-last-name').html(last_name)
        $('#e-phone').html(email)
        $('#e-description').html(description)

        $('#employee-modal').modal('show');
    });

    $('body').on('change', '.service_price', function() {
        let price = $(this).val();
        let desc = $('.description').val();
        var url = "<?php echo e(route('front.store.service', [':price', ':desc'])); ?>";
        url = url.replace(':price', price);
        url = url.replace(':desc', desc);
        let booking_url =
            "<?php echo e(route('front.employees.add-schedule', ['id' => $user->id ?? '', 'serviceid' => $service_id])); ?>";
        $.ajax({
            type: 'GET',
            url: url,
            // data: {
            //     price: price,
            // },
            success: function(data) {
                $('.booking-button').attr("href", booking_url);
            }
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/our-services/service-details.blade.php ENDPATH**/ ?>