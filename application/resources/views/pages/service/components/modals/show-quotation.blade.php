<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>

                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('ID')) }}</td>
                        <td>{{ $service->id }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Service Title')) }}</td>
                        <td>{{ $service->title }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Rate Per Hour')) }}</td>
                        <td>{{ $service->rate_per_hour ?? 'not found' }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Minimum Charge')) }}</td>
                        <td>{{ $service->minimum_charge ?? 'not found' }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Service Description')) }}</td>
                        <td>{{ $service->service_description ?? 'not found' }}</td>
                    </tr>


                    <!--Attchment-->
                    <tr>
                        <td>{{ cleanLang(__('lang.attachement')) }}</td>
                        <td>
                            @foreach ($attachments as $attachment)
                                <ul class="p-l-0">
                                    @if ($attachment->attachment_unique_input === 'service_image')
                                        <span>Contract Attachments: </span>
                                        <li id="fx-expenses-files-attached">
                                            <a href="services/attachments/download/{{ $attachment->attachment_uniqiueid }}"
                                                download>
                                                {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                            @endforeach
                        </td>
                    </tr>
                    <!--date-->
                    <!--description-->
                </tbody>
            </table>
        </div>
    </div>
</div>
