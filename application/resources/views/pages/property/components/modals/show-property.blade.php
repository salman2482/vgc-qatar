<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>

                    <tr>
                        <td>{{ cleanLang(__('Reference No')) }}</td>
                        <td>{{ $property->reference_no }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Title')) }}</td>
                        <td>{{ $property->title }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Rent Or Sale')) }}</td>
                        <td>{{ ucfirst($property->rent_or_sale) }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Property Type')) }}</td>
                        <td>{{ ucfirst($property->property_type) }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Bedroom')) }}</td>
                        <td>{{ ucfirst($property->bedroom) }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Price')) }}</td>
                        <td>QAR {{ $property->price }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Builtup Area')) }}</td>
                        <td>{{ $property->builtup_area }} Sq.Mts</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Decscription')) }}</td>
                        <td>{{ $property->description }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Community')) }}</td>
                        <td >{{ $property->community ?? 'not found' }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Sub Community')) }}</td>
                        <td >{{ $property->sub_community ?? 'not found' }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Parking')) }}</td>
                        <td >{{ $property->parking ?? 'not found' }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Primary Unit View')) }}</td>
                        <td >{{ $property->primary_unit_view ?? 'not found' }}</td>
                    </tr>


                    <tr>
                        @php
                            $amminities = explode(',',$property->amminities)
                        @endphp
                        <td>{{ cleanLang(__('Amminities')) }}</td>
                        <td>
                            <div class="row">
                                @foreach ($amminities as $item)
                                    <div class="col-md-6">
                                        <span
                                            class="mt-1 label {{ runtimeRfmStatusLabel('assigned') }}">{{ runtimeLang($item) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>

                    @php
                        $images = explode(',',$property->images);
                    @endphp

                    <tr>
                        <td>{{ cleanLang(__('Property Images')) }}</td>
                        <td>
                            <div class="row">
                                @foreach($images as $image)
                                <ul class="p-l-5">
                                    <li  id="fx-expenses-files-attached">
                                        <img src="{{asset('storage/public/frontuser/'.$image)}}" alt="" width="200" height="200" class="mb-2">
                                    </li>
                                </ul>
                                @endforeach
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>