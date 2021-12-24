<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>
                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('Ttile')) }}</td>
                        <td colspan="2">{{ $corporateservice->title }}</td>
                    </tr>
                    <!--client-->
                    <tr>
                        <td>{{ cleanLang(__('description')) }}</td>
                        <td colspan="2">{{ $corporateservice->description }}</td>
                    </tr>
                    <!--project-->
                   
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
