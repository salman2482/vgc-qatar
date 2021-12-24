<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>
                  
                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('Ref No')) }}</td>
                        <td>{{ $lpo->ref_no }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Department')) }}</td>
                        <td>{{ $lpo->department }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Rfm Ref No')) }}</td>
                        <td>{{ $lpo->rfm_ref_no }}</td>
                    </tr>
                    <!--client-->
                    <tr>
                        <td>{{ cleanLang(__('Subject')) }}</td>
                        <td>{{ $lpo->subject }}</td>
                    </tr>
                    <!--project-->
                    <tr>
                        <td>{{ cleanLang(__('Site')) }}</td>
                        <td>{{ $lpo->site }}</td>
                    </tr>
                    <!--user-->
                    <tr>
                        <td>{{ cleanLang(__('Value')) }}</td>
                        <td>{{ $lpo->value }}</td>
                    </tr>
                    <!--description-->
                    <tr>
                        <td>{{ cleanLang(__('Date Requested')) }}</td>
                        <td>{{ runtimeDate($lpo->date_requested) }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Requestor')) }}</td>
                        <td>{{ $lpo->requestor }}</td>
                    </tr>
                  
                    <!--date-->
                    <!--description-->
                </tbody>
            </table>
        </div>
    </div>
</div>