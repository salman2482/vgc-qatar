<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>

                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('ID')) }}</td>
                        <td>{{ $user->id ?? '' }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Name')) }}</td>
                        <td>{{ $user->first_name ?? '' }} {{ $user->last_name }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Company')) }}</td>
                        <td>{{ $user->company_name ?? '' }}</td>
                    </tr>
                    <!--client-->
                    <tr>
                        <td>{{ cleanLang(__('Phone')) }}</td>
                        <td>{{ $user->phone ?? '' }}</td>
                    </tr>
                    <!--project-->
                    <tr>
                        <td>{{ cleanLang(__('Email')) }}</td>
                        <td>{{ $user->email ?? '' }}</td>
                    </tr>
                    <!--user-->
                    <tr>
                        <td>{{ cleanLang(__('Status')) }}</td>
                        <td>{{ $user->status ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Registration Date')) }}</td>
                        <td>{{ date('Y-m-d', strtotime($user->created)) }}</td>
                    </tr>
                    <!--description-->

                </tbody>
            </table>
        </div>
    </div>
</div>
