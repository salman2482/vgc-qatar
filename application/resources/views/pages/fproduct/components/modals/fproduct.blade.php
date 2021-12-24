<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>
                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('ID')) }}</td>
                        <td>{{ $fproduct->id }}</td>
                    </tr>
                    <!--client-->
                    <tr>
                        <td>{{ cleanLang(__('Title')) }}</td>
                        <td>{{ $fproduct->title }}</td>
                    </tr>
                    <!--project-->
                    <tr>
                        <td>{{ cleanLang(__('Description')) }}</td>
                        <td>{{ $fproduct->description }}</td>
                    </tr>

                    {{-- <tr>
                        <td>{{ cleanLang(__('Status')) }}</td>
                        <td>{{ $fproduct->status }}</td>
                    </tr> --}}

                    <!--user-->
                    <tr>
                        <td>{{ cleanLang(__('Category')) }}</td>
                        <td>{{ $fproduct->category->name }}</td>
                    </tr>
                    <!--description-->
                    
                    <!--Attchment-->
                    <tr>
                        <td>{{ cleanLang(__('Image')) }}</td>
                        <td>
                            @foreach($attachments as $attachment)
                            @if ($attachment->attachment_unique_input == 'fproduct') 
                            <ul class="p-l-0">
                                <li  id="fx-fproducts-files-attached" style="list-style: none">
                                    <a href="fproducts/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
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