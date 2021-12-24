@foreach($lineitems as $lineitem)
<tr>
    <!--description-->
    <td class="x-description">{{ $lineitem->lineitem_description }}</td>
                    {{-- trustech code starts here --}}
    {{-- receipt --}}
    <?php 
    $attachment = \App\Models\Attachment::Where('attachmentresource_id', $lineitem->lineitemresource_linked_id)
    ->Where('attachmentresource_type', 'expense')->first();
    ?>
        
    @if ($attachment)
    <td>
    <a href="{{route('download.Invoice',$lineitem->lineitemresource_linked_id)}}">
        Download <i class="ti-download"></i>
    </a>
    </td>
    @else
    <td>
        None
    </td>
    @endif  
                    {{-- trustech code ends here --}}

    <!--quantity-->
    @if($lineitem->lineitem_type == 'plain')
    <td class="x-quantity">{{ $lineitem->lineitem_quantity }}</td>
    @else
    <td class="x-quantity">
        @if($lineitem->lineitem_time_hours > 0)
        {{ $lineitem->lineitem_time_hours }}{{ strtolower(__('lang.hrs')) }}&nbsp;
        @endif
        @if($lineitem->lineitem_time_minutes > 0)
        {{ $lineitem->lineitem_time_minutes }}{{ strtolower(__('lang.mins')) }} 
        @endif
    </td>
    @endif
    <!--unit price-->
    <td class="x-unit">{{ $lineitem->lineitem_unit }}</td>
    <!--rate-->
    <td class="x-rate">{{ runtimeNumberFormat($lineitem->lineitem_rate) }}</td>
    <!--tax-->
    <td class="x-tax {{ runtimeVisibility('invoice-column-inline-tax', $bill->bill_tax_type) }}"></td>
    <!--total-->
    <td class="x-total text-right">{{ runtimeNumberFormat($lineitem->lineitem_total) }}</td>
</tr>
@endforeach