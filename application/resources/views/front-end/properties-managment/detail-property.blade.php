@extends('front-end.layouts.master')
@section('styles')
    <link href="{{ asset('public/front-end/css/owl.css') }}" rel="stylesheet">
@endsection
@section('front-end-content')

@if ($attachment->attachment_unique_input === 'frontbanner')
<img class="img-fluid" src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" style="height: " alt="">
@endif
    

    <section class="shop-single-section">
        <h2 class="text-muted text-center mb-5">Property Details</h2>
        <div class="auto-container">
            @php
                $attachments = explode(',', $property->images);
            @endphp
            <!--Shop Single-->
            <div class="shop-page product-details">

                <!--Basic Details-->
                <div class="basic-details">
                    <div class="row clearfix">

                        <div class="image-column col-lg-7 col-md-12 col-sm-12">
                            <div class="carousel-outer">
                                <ul class="image-carousel owl-carousel owl-theme">
                                    @if (isset($attachments))
                                        @foreach ($attachments as $attachment)
                                            <li>
                                                <a href="{{ asset('storage/public/frontuser/' . $attachment) }}"
                                                    class="lightbox-image" title="Image Caption Here">
                                                    <img src="{{ asset('storage/public/frontuser/' . $attachment) }}"
                                                        alt="">
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>

                                <ul class="thumbs-carousel owl-carousel owl-theme">
                                    @if (isset($attachments))
                                        @foreach ($attachments as $attachment)
                                            <li><img src="{{ asset('storage/public/frontuser/' . $attachment) }}" alt="">
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>

                            </div>
                        </div>

                        <!--Info Column-->
                        <div class="info-column col-lg-5 col-md-12 col-sm-12">
                            <div class="details-header">
                                <h2>{{ $property->title }}</h2>
                                <div class="item-price">Price: {{ $property->price }} QAR</div>
                                <div class="item-price" style="font-size:21px;">Reference no:
                                    {{ $property->reference_no }}</div>
                                <div class="item-price" style="font-size:21px;">Builtup Area:
                                    {{ $property->builtup_area }} Sq.Mts</div>
                                <div class="item-price" style="font-size:21px;">Property Type:
                                    {{ $property->property_type }}</div>
                                <div class="item-price" style="font-size:21px;">Rent Or Sale:
                                    {{ $property->rent_or_sale }}</div>
                                <div class="item-price" style="font-size:21px;">Community: {{ $property->community }}
                                </div>
                                <div class="item-price" style="font-size:21px;">Sub Community:
                                    {{ $property->sub_community }}</div>
                                <div class="item-price" style="font-size:21px;">Bedrooms: {{ $property->bedroom }}</div>
                                <div class="item-price" style="font-size:21px;">Parking : {{ $property->parking }}</div>
                                <div class="item-price" style="font-size:21px;">Primary Unit View :
                                    {{ $property->primary_unit_view }}</div>
                            </div>

                        </div>

                    </div>
                </div>
                <!--Basic Details-->
                @php
                    $amminities = explode(',', $property->amminities);
                @endphp

                <!--Product Info Tabs-->
                <div class="product-info-tabs">
                    <!--Product Tabs-->
                    <div class="prod-tabs tabs-box">

                        <!--Tab Btns-->
                        <ul class="tab-btns tab-buttons clearfix">
                            <li data-tab="#prod-details" class="tab-btn active-btn">Description</li>
                            <li data-tab="#prod-info" class="tab-btn">Additional Information</li>
                        </ul>

                        <!--Tabs Container-->
                        <div class="tabs-content">

                            <!--Tab / Active Tab-->
                            <div class="tab active-tab" id="prod-details" style="display: block;">
                                <div class="content">
                                    <p>{{ $property->description }}</p>
                                </div>
                            </div>

                            <!--Tab / Active Tab-->
                            <div class="tab" id="prod-info" style="display: none;">
                                <div class="content">
                                    <div class="row mb-3">
                                        <div class="col-md-8 col-sm-12 col-lg-8">
                                            <h5>Contact Details</h5>
                                            <ul class="list-group">
                                                <li class="list-group-item"><span class="text-info">Name</span> :
                                                    {{ $property->user->first_name ?? 'no data' }}</li>
                                                <li class="list-group-item"><span class="text-info">Email</span> :
                                                    {{ $property->user->email ?? 'no data' }}</li>
                                                <li class="list-group-item disabled"><span class="text-info">Phone</span> :
                                                    {{ $property->user->phone ?? 'no data' }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h5>Amminities</h5><br>
                                    <div class="row">
                                        @foreach ($amminities as $item)
                                            <div class="col-md-6 col-xs-12 col-sm-12">
                                                <div class="my-2">
                                                    <img src="https://www.bhomesqatar.com/images/check.png" alt="">
                                                    {{ $item }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!--End Product Info Tabs-->

            </div>

        </div>
    </section>

@endsection
