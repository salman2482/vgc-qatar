<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>
                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('Ttile')) }}</td>
                        <td colspan="2">{{ $subcorporateservice->title }}</td>
                    </tr>
                    <!--client-->
                    <tr>
                        <td>{{ cleanLang(__('Description')) }}</td>
                        <td colspan="2">{{ $subcorporateservice->description }}</td>
                    </tr>
                    <!--project-->
                    <tr>
                        <td>{{ cleanLang(__('Corporate Service')) }}</td>
                        <td colspan="2">{{ $subcorporateservice->corporateservice->title }}</td>
                    </tr>
                    <!--user-->
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
