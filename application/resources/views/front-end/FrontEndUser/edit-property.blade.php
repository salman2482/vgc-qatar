@extends('front-end.layouts.master')

@section('front-end-content')
    <div class="auto-container">
        <div class="row clearfix">
            <!--Form Column-->
            <div class="form-column col-lg-12 col-md-12 col-sm-12">
                <div class="inner-column p-3">
                    <!--Sec Title-->
                    <div class="sec-title">
                        <h2>Edit Property</h2>
                    </div>
                    <div class="contact-form">
                        <form action="{{ route('front.user.property.update', $property->id) }}" method="POST"
                            enctype="multipart/form-data" id="contact-form" novalidate="novalidate">
                            @csrf
                            @method('PUT')
                            <div class="row clearfix">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="title" value="{{ $property->title }}"
                                        placeholder="Property title" required="">
                                </div>
                                @error('title')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <select name="rent_or_sale">
                                        <option value="sale" {{ $property->rent_or_sale == 'sale' ? 'selected' : '' }}>
                                            Sale</option>
                                        <option value="rent" {{ $property->rent_or_sale == 'rent' ? 'selected' : '' }}>
                                            Rent</option>
                                    </select>

                                    @error('rent_or_sale')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <select name="property_type">
                                        <option value="Apartment"
                                            {{ $property->property_type == 'Apartment' ? 'selected' : '' }}>
                                            Apartment</option>
                                        <option value="Commercial Building"
                                            {{ $property->property_type == 'Commercial Building' ? 'selected' : '' }}>
                                            Commercial Building</option>
                                        <option value="Commercial Villa"
                                            {{ $property->property_type == 'Commercial Villa' ? 'selected' : '' }}>
                                            Commercial Villa</option>
                                        <option value="Labour Camp"
                                            {{ $property->property_type == 'Labour Camp' ? 'selected' : '' }}>
                                            Labour
                                            Camp</option>
                                        <option value="Office"
                                            {{ $property->property_type == 'Office' ? 'selected' : '' }}>
                                            Office
                                        </option>
                                        <option value="Residential Building"
                                            {{ $property->property_type == 'Residential Building' ? 'selected' : '' }}>
                                            Residential Building</option>
                                        <option value="Retail"
                                            {{ $property->property_type == 'Retail' ? 'selected' : '' }}>
                                            Retail
                                        </option>
                                        <option value="Studio"
                                            {{ $property->property_type == 'Studio' ? 'selected' : '' }}>
                                            Studio
                                        </option>
                                        <option value="Townhouse"
                                            {{ $property->property_type == 'Townhouse' ? 'selected' : '' }}>
                                            Townhouse</option>
                                        <option value="Villa"
                                            {{ $property->property_type == 'Villa' ? 'selected' : '' }}>Villa
                                        </option>
                                    </select>

                                    @error('property_type')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <select name="bedrooms">
                                        <option value="0">Studio</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}"
                                                {{ $property->bedroom == $i ? 'selected' : '' }}>
                                                {{ $i }}</option>
                                        @endfor
                                    </select>

                                    @error('bedrooms')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="price" placeholder="Price" value="{{ $property->price }}">
                                    @error('price')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="builtup_area" placeholder="BuiltUp Area"
                                        value="{{ $property->builtup_area }}">
                                    @error('builtup_area')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="reference_no" placeholder="Reference Number"
                                        value="{{ $property->reference_no ?? '' }}">
                                    @error('reference_no')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="community" placeholder="Community"
                                        value="{{ $property->community ?? '' }}">
                                    @error('community')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="sub_community" placeholder="Sub Community"
                                        value="{{ $property->sub_community ?? '' }}">
                                    @error('sub_community')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="parking" placeholder="Parking"
                                        value="{{ $property->parking }}">
                                    @error('parking')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="primary_unit_view" placeholder="Primary Unit View"
                                        value="{{ $property->primary_unit_view }}">
                                    @error('primary_unit_view')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <select name="status">
                                        <option value="1" {{ $property->status == '1' ? 'selected' : '' }}>
                                            Vacant</option>
                                        <option value="0" {{ $property->status == '0' ? 'selected' : '' }}>
                                            Non
                                            Vacant</option>
                                    </select>

                                    @error('status')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <select name="property_status">
                                        <option value="recommended"
                                            {{ runtimePreselected($property->property_status, 'recommended') }}>
                                            Recommended</option>
                                        <option value="rented"
                                            {{ $property->property_status == 'rented' ? 'selected' : '' }}>
                                            Rented
                                        </option>
                                        <option value="sold out"
                                            {{ $property->property_status == 'sold out' ? 'selected' : '' }}>
                                            Sold Out
                                        </option>
                                    </select>

                                    @error('status')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <textarea name="description" cols="30" rows="7"
                                        placeholder="Description">{{ $property->description }} </textarea>
                                    @error('description')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <?php $opts = [
                                            '1 Month Free' => '1 Month Free',
                                            '2 Months Free' => '2 Months Free',
                                            '3 Months Free' => '3 Months Free',
                                            'Best Value' => 'Best Value',
                                            'Coming Soon' => 'Coming Soon',
                                            'Out Of Stock' => 'Out Of Stock',
                                            'Sold Out' => 'Sold Out',
                                        ] ?>
                                    <select name="property_status">
                                        @foreach ($opts as $item)
                                        <option value="{{$item}}" {{ $property->property_status == $item ? 'selected' : '' }}> 
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                    </select>

                                    @error('status')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" name="images[]" multiple placeholder="Images">
                                    @error('images')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                @php
                                    $cats = ['Balcony', 'Shared Pool', 'Shared Gym', 'Security', 'Concierge Service', 'Covered Parking', 'Built in Wardrobes', 'Built in Kitchen Appliances', 'View of Water', 'Bath/Toilet fixtures', 'Central a/c system', 'Childrens swimming pool', 'Closed kitchen', 'Conventional electric oven', 'Cooking hoods', 'Covered car ports', 'Eco friendly', 'Electric cooking hub', 'Electrical Fittings', 'Finished ceiling', 'Granite countertops', 'Guest washroom', 'Kitchen facilities', 'Leasehold', 'Light fittings', 'Microwave oven', 'Parking', 'Recreational facilities', 'Refrigerator', 'Secure play areas for children', 'Secure underground parking', 'Shared swimming pool', 'Tiled Flooring', 'Washing machine'];
                                @endphp
                                @php
                                    $property_cats = explode(',', $property->amminities);
                                @endphp
                                <div class="row ml-1">
                                    <div class="col-md-12">
                                        <label for="" class="d-block font-weight-bold">Amminities</label>
                                    </div>
                                    @foreach ($cats as $cat)
                                        <div class="col-md-6 col-sm-6" style="margin-top: 18px;">
                                            <input type="checkbox" value="{{ $cat }}" @foreach ($property_cats as $item) {{ $cat == $item ? 'checked' : '' }} @endforeach
                                                name="amminities[]">
                                            <span>
                                                {{ $cat }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" class="theme-btn btn-style-one"><span class="txt">Submit
                                            now</span></button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
