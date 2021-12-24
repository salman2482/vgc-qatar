<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>
                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('Ttile')) }}</td>
                        <td colspan="2">{{ $subproduct->title }}</td>
                    </tr>
                    <!--client-->
                    <tr>
                        <td>{{ cleanLang(__('Description')) }}</td>
                        <td colspan="2">{{ $subproduct->description }}</td>
                    </tr>
                    <!--project-->
                    <tr>
                        <td>{{ cleanLang(__('Status')) }}</td>
                        <td colspan="2">{{ $subproduct->status }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Front Product')) }}</td>
                        <td colspan="2">{{ $subproduct->fproduct->title }}</td>
                    </tr>
                    <!--user-->
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
