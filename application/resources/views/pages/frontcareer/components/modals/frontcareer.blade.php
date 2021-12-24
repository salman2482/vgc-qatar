<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>
                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('Ttile')) }}</td>
                        <td colspan="2">{{ $frontcareer->title }}</td>
                    </tr>
                    <!--client-->
                    <tr>
                        <td>{{ cleanLang(__('Experience')) }}</td>
                        <td colspan="2">{{ $frontcareer->experience }}</td>
                    </tr>
                    <!--project-->
                    <tr>
                        <td>{{ cleanLang(__('Category')) }}</td>
                        <td colspan="2">{{ $frontcareer->category }}</td>
                    </tr>
                    <!--user-->
                    <tr>
                        <td>{{ cleanLang(__('Salary')) }}</td>
                        <td colspan="2">{{ $frontcareer->salary }}</td>
                    </tr>
                    
                    <tr>
                        <td>{{ cleanLang(__('Position')) }}</td>
                        <td colspan="2">{{ $frontcareer->position }}</td>
                    </tr>
                    
                    <tr>
                        <td>{{ cleanLang(__('Status')) }}</td>
                        <td colspan="2">{{ $frontcareer->status}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center">{{ cleanLang(__('List Of All Applies For This Career')) }}</td>
                    </tr>
                    @php
                        $applies = App\Models\CareerApply::where('field', $frontcareer->category)
                            ->get();
                    @endphp
                    @forelse ($applies as $item)
                        <tr>
                            <td>
                                {{$item->first_name.' '.$item->middle_name .''.$item->last_name}}
                            </td>
                            <td>{{ $item->primary_email  }}</td>
                            <td>
                                <a href="{{ route('careersapply.show', $item->id) }}"
                                    title="{{ cleanLang(__('lang.view')) }}"
                                    class="data-toggle-action-tooltip ">
                                    {{ 'View Apply Form'  }}
                                </a>                   
                            </td>   
                            @empty
                            <td colspan="2" class="text-center">NO Applies For This Career</td>
                            @endforelse
                            <tr>
                        </tbody>
                    </table>
        </div>
    </div>
</div>
