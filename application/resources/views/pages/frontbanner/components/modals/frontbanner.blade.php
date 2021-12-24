<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>
                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('ID')) }}</td>
                        <td>{{ $frontbanner->id }}</td>
                    </tr>
                    <!--client-->
                    <tr>
                        <td>{{ cleanLang(__('Title')) }}</td>
                        <td>{{ $frontbanner->title }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Title Arabic')) }}</td>
                        <td>{{ $frontbanner->title_ar }}</td>
                    </tr>
                    <!--project-->
                    <tr>
                        <td>{{ cleanLang(__('Description')) }}</td>
                        <td>{{ $frontbanner->description }}</td>
                    </tr>
                    <!--user-->
                    <tr>
                        <td>{{ cleanLang(__('Description Arabic')) }}</td>
                        <td>{{ $frontbanner->description_ar }}</td>
                    </tr>
                    <!--user-->
                    <!--description-->
                    
                    <!--Attchment-->
                    <tr>
                       <td>Image</td>
                        <td>
                            @foreach($attachments as $attachment)
                            @if ($attachment->attachment_unique_input == 'frontbanner') 
                            <ul class="p-l-0">
                                <li  id="fx-frontbanners-files-attached" style="list-style: none">
                                    {{-- <img src="{{asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename)}}"  width="500px" alt="">
                                    <br> --}}
                                    <a href="frontbanners/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
                                        {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                    </a>
                                </li>
                            </ul>
                            @endif
                            @endforeach
                        </td>
                    </tr>
                    <!--date-->

                </tbody>
            </table>
        </div>
    </div>
</div>