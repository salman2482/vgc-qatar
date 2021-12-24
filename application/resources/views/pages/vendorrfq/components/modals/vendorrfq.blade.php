<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>
                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('RFQ Ref')) }}</td>
                        <td>{{ $vendorrfq->rfq_ref }}</td>
                    </tr>
                    <!--client-->
                    <tr>
                        <td>{{ cleanLang(__('Category')) }}</td>
                        <td>{{ $vendorrfq->category }}</td>
                    </tr>
                    <!--project-->
                    <tr>
                        <td>{{ cleanLang(__('Priority')) }}</td>
                        <td>{{ $vendorrfq->priority }}</td>
                    </tr>
                    <!--user-->
                    <tr>
                        <td>{{ cleanLang(__('Due Date Request')) }}</td>
                        <td>{{ $vendorrfq->due_date_request }}</td>
                    </tr>
                    
                    <tr>
                        <td>{{ cleanLang(__('REQ QTN Validity')) }}</td>
                        <td>{{ $vendorrfq->required_quotation_validity }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">{{ cleanLang(__('Response of All Vendors')) }}</td>
                    </tr>
                    @php
                        $statuses = App\EachRfq::where('vendor_rfq_id', $vendorrfq->id)
                            ->get();
                    @endphp
                    @forelse ($statuses as $item)
                        <tr>
                            @if ($item->status == 'APPROVED')
            <?php $qtn = App\Models\VendorQuotation::where('rfq_ref', $vendorrfq->rfq_ref)->first(); ?>
                            <td>   
                                @if($qtn)
                                <a href="{{ route('rfq.user.qtn', ['id'=>$item->user_id,'rfq'=>$vendorrfq->rfq_ref]) }}"
                                    title="{{ cleanLang(__('lang.view')) }}"
                                    class="data-toggle-action-tooltip ">
                                    {{ $item->user->fvendor->vendor_company_name ?? ''  }}
                                </a>                
                                @else
                                <span class="badge-font badge"> 
                                    {{ $item->user->fvendor->vendor_company_name ?? ''  }}    
                                </span>
                                @endif   
                            </td>   
                            @else
                                <td>
                                    <span class="badge-font badge"> 
                                        {{ $item->user->company_name ?? ''  }}
                                    </span>
                                </td>
                            @endif
                            <td>{{ $item->status }}</td>
                        <tr>
                        @empty
                        <td colspan="2" class="text-center">NO Vendors have Submitted Quotation</td>
                        @endforelse
                        <tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
