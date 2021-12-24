@extends('front-end.layouts.master')
@section('styles')
{!! NoCaptcha::renderJs() !!}
@endsection

@section('front-end-content')
    <div class="auto-container">
        <div class="row clearfix">
            <!--Form Column-->
            <div class="form-column col-lg-12 col-md-12 col-sm-12">
                <div class="inner-column p-3">
                    <!--Sec Title-->
                    <div class="sec-title">
                        <h2>Create Property</h2>
                    </div>
                    <div class="contact-form">
                        <form action="{{ route('front.property.store') }}" method="POST" enctype="multipart/form-data"
                            id="contact-form" novalidate="novalidate">
                            @csrf
                            <div class="row clearfix">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="title" value="{{ old('title') }}"
                                        placeholder="Property title" required="">
                                </div>
                                @error('title')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <select name="rent_or_sale">
                                        <option value="sale">Sale</option>
                                        <option value="rent">Rent</option>
                                    </select>

                                    @error('rent_or_sale')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <select name="property_type">
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

                                    @error('property_type')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <select name="bedrooms">
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

                                    @error('bedrooms')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="price" placeholder="Price">
                                    @error('price')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="builtup_area" placeholder="BuiltUp Area">
                                    @error('builtup_area')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="reference_no" placeholder="Reference Number">
                                    @error('reference_no')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="community" placeholder="Community">
                                    @error('community')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="sub_community" placeholder="Sub Community">
                                    @error('sub_community')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="parking" placeholder="Parking">
                                    @error('parking')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="primary_unit_view" placeholder="Primary Unit View">
                                    @error('primary_unit_view')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <select name="status">
                                        <option value="1">Vacant</option>
                                        <option value="0">Non Vacant</option>
                                    </select>

                                    @error('status')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <textarea name="description" cols="30" rows="7" placeholder="Description"></textarea>
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
                                        <option value="{{$item}}">
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
                                <div class="row ml-1">
                                    <div class="col-md-12">
                                        <label for="" class="d-block font-weight-bold">Amminities</label>
                                    </div>
                                    @foreach ($cats as $cat)
                                        <div class="col-md-6">
                                            <input type="checkbox" class="font-weight-bold" value="{{ $cat }}"
                                                name="amminities[]">
                                            <span class="font-weight-bold m-1">
                                                {{ $cat }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row ml-1">
                                    <div class="form-group my-3 ml-3">
                                        @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                            <strong class="text-danger">
                                                {{ $errors->first('g-recaptcha-response') }}
                                            </strong>
                                        </span>
                                        @endif
                                        {!! app('captcha')->display() !!}
                                    </div>
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
