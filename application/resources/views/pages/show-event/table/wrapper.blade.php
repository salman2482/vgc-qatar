@foreach ($events as $event)
    <div class="col-md-4 col-sm-6">
        <div class="card" style="
        background:rgb(146 164 150 / 31%);
        border-radius:2%;
        height:30vh">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <h3 class="text-info">{{ ucfirst($event->first_name ?? 'not available') }}</h3>
                        <h4 id="stats-widget-value-1">{{ ucfirst($event->event_parent_title) }}
                            ({{ ucfirst($event->event_parent_type) }})</h4>
                        <div class="card-subtitle text-dark">
                            <small>{{ \Carbon\Carbon::parse($event->event_created)->diffForHumans() }}</small>
                        </div>
                        <div class="card-subtitle text-dark">
                            <small>{{ cleanLang(__('lang.' . $event->event_item_lang)) }}</small>
                        </div>
                        <!--attachment-->
                        @if ($event->event_item == 'attachment')
                            <div class="x-description"><a
                                    href="{{ url($event->event_item_content2) }}">{{ $event->event_item_content }}</a>
                            </div>
                        @endif

                        <!--comment-->
                        @if ($event->event_item == 'comment')
                            <div class="x-description">{!! clean($event->event_item_content) !!}</div>
                        @endif

                        <!--status-->
                        @if ($event->event_item == 'status')
                            <div class="x-description"><strong>{{ cleanLang(__('lang.new_status')) }}:</strong>
                                {{ runtimeLang($event->event_item_content) }}
                            </div>
                        @endif

                        <!--file-->
                        @if ($event->event_item == 'file')
                            <div class="x-description"><a
                                    href="{{ url($event->event_item_content2) }}">{{ $event->event_item_content }}</a>
                            </div>
                        @endif

                        <!--task-->
                        @if ($event->event_item == 'task')
                            <div class="x-description">
                                <a
                                    href="{{ url('/tasks/v/' . $event->event_item_id . '/' . str_slug($event->event_parent_title)) }}">{{ $event->event_item_content }}</a>
                            </div>
                        @endif

                        <!--tickets-->
                        @if ($event->event_item == 'ticket')
                            <div class="x-description"><a
                                    href="{{ url('tickets/' . $event->event_item_id) }}">{!! clean($event->event_item_content) !!}</a>
                            </div>
                        @endif

                        <!--invoice-->
                        @if ($event->event_item == 'invoice')
                            <div class="x-description"><a
                                    href="{{ url('invoices/' . $event->event_item_id) }}">{!! clean($event->event_item_content) !!}</a>
                            </div>
                        @endif


                        <!--estimate-->
                        @if ($event->event_item == 'estimate')
                            <div class="x-description"><a
                                    href="{{ url('estimates/' . $event->event_item_id) }}">{!! clean($event->event_item_content) !!}</a>
                            </div>
                        @endif

                        <!--project (..but do not show on project timeline)-->
                        @if ($event->event_item == 'new_project' && request('timelineresource_type') != 'project')
                            <div class="x-description"><a
                                    href="{{ url('projects/' . $event->event_parent_id) }}">{{ $event->event_parent_title }}</a>
                            </div>
                        @endif

                        <!--contract -->
                        @if ($event->event_item == 'contract_created' || $event->event_item == 'contract_updated' || $event->event_item == 'contract_viewed')
                            <div class="x-description">
                                <a
                                    href="{{ url('contractsmgt/show-event/' . $event->event_parent_id) }}">{{ $event->event_parent_title }}</a>
                            </div>
                        @endif

                        <!--quotation -->
                        @if ($event->event_item == 'quotation_created' || $event->event_item == 'quotation_updated' || $event->event_item == 'quotation_viewed' || $event->event_item == 'quotation_downloaded')
                            <div class="x-description">
                                <a
                                    href="{{ url('quotations/show-event/' . $event->event_parent_id) }}">{{ $event->event_parent_title }}</a>
                            </div>
                        @endif
                        <!--document -->
                        @if ($event->event_item == 'document_created' || $event->event_item == 'document_updated' || $event->event_item == 'document_viewed' || $event->event_item == 'document_downloaded')
                            <div class="x-description">
                                <a
                                    href="{{ url('documents/show-event/' . $event->event_parent_id) }}">{{ $event->event_parent_title }}</a>
                            </div>
                        @endif
                        
                        
                        <!--govtdocument link to show event-->
                        @if ($event->event_item == 'govtdocument_created' || $event->event_item == 'govtdocument_updated')
                            <div class="x-description">
                                <a
                                    href="{{ url('govtdocuments/show-event/' . $event->event_parent_id) }}">
                                    {{ 'View' }}</a>
                            </div>
                        @endif

                        <!--vendorinvoice link to show event-->
                        @if ($event->event_item == 'vendor_invoice_created' || $event->event_item == 'vendor_invoice_updated')
                            <div class="x-description">
                                <a
                                    href="{{ url('vendorinvoices/show-event/' . $event->event_parent_id) }}">
                                    {{ 'View' }}</a>
                            </div>
                        @endif

                        <!--vendorpo link to show event-->
                        @if ($event->event_item == 'vendorpo_created' || $event->event_item == 'vendorpo_updated')
                            <div class="x-description">
                                <a
                                    href="{{ url('vendorpos/show-event/' . $event->event_parent_id) }}">
                                    {{ 'View' }}</a>
                            </div>
                        @endif

                        <!--vendorqtn link to show event-->
                        @if ($event->event_item == 'vendor_quotation_created' || $event->event_item == 'vendor_quotation_updated')
                            <div class="x-description">
                                <a
                                    href="{{ url('vendorqtns/show-event/' . $event->event_parent_id) }}">
                                    {{ 'View' }}</a>
                            </div>
                        @endif

                        <!--vendorrfq link to show event-->
                        @if ($event->event_item == 'vendorrfq_created' || $event->event_item == 'vendorrfq_updated')
                            <div class="x-description">
                                <a
                                    href="{{ url('vendorrfqs/show-event/' . $event->event_parent_id) }}">
                                    {{ 'View' }}</a>
                            </div>
                        @endif

                        <!--vendor profile link to show event-->
                        @if ($event->event_item == 'vendor_created' || $event->event_item == 'vendor_updated' || $event->event_item == 'vendor_profile_updated')
                            <div class="x-description">
                                <a
                                    href="{{ url('vusers/show-event/' . $event->event_parent_id) }}">
                                    {{ 'View' }}</a>
                            </div>
                        @endif

                         <!--front project  link to show event-->
                        @if ($event->event_item == 'frontproject_created' || $event->event_item == 'frontproject_updated' )
                            <div class="x-description">
                                <a
                                    href="{{ url('frontprojects/show-event/' . $event->event_parent_id) }}">
                                    {{ 'View' }}</a>
                            </div>
                        @endif

                        <!--front client link to show event-->
                        @if ($event->event_item == 'frontclient_created' || $event->event_item == 'frontclient_updated' )
                            <div class="x-description">
                                <a
                                    href="{{ url('frontclients/show-event/' . $event->event_parent_id) }}">
                                    {{ 'View' }}</a>
                            </div>
                        @endif
                        
                        <!--frontbanner link to show event-->
                        @if ($event->event_item == 'frontbanner_created' || $event->event_item == 'frontbanner_updated' )
                            <div class="x-description">
                                <a
                                    href="{{ url('frontbanners/show-event/' . $event->event_parent_id) }}">
                                    {{ 'View' }}</a>
                            </div>
                        @endif

                        
                        <!--front career link to show event-->
                        @if ($event->event_item == 'frontcareer_created' || $event->event_item == 'frontcareer_updated' )
                            <div class="x-description">
                                <a
                                    href="{{ url('frontcareers/show-event/' . $event->event_parent_id) }}">
                                    {{ 'View' }}</a>
                            </div>
                        @endif

                        <!--front careerapply career apply link to show event-->
                        @if ($event->event_item == 'careerapply_created' || $event->event_item == 'frontcareer_updated' )
                            <div class="x-description">
                                <a
                                    href="{{ url('careersapply/show-event/' . $event->event_parent_id) }}">
                                    {{ 'View' }}</a>
                            </div>
                        @endif
                        
                        <!--front corporateservice career apply link to show event-->
                        @if($event->event_item == 'corporateservice_created' || $event->event_item == 'corporateservice_updated' )
                            <div class="x-description">
                                <a href="{{ url('corporateservices/show-event/' . $event->event_parent_id) }}">
                                    {{ 'View' }}</a>
                            </div>
                        @endif

                        <!--front subcorporateservice career apply link to show event-->
                        @if ($event->event_item == 'subcorporateservice_created' || $event->event_item == 'subcorporateservice_updated' )
                            <div class="x-description">
                                <a href="{{ url('subcorporateservices/show-event/' . $event->event_parent_id) }}">
                                    {{ 'View' }}</a>
                            </div>
                        @endif
                        
                        <!--front subproduct career apply link to show event-->
                        @if ($event->event_item == 'subproduct_created' || $event->event_item == 'subproduct_updated' )
                            <div class="x-description">
                                <a href="{{ url('subproducts/show-event/' . $event->event_parent_id) }}">
                                    {{ 'View' }}</a>
                            </div>
                        @endif
                        
                        <!--property -->
                        @if ($event->event_item == 'property_created' || $event->event_item == 'property_updated')
                            <div class="x-description">
                                <a
                                    href="{{ url('properties/show-event/' . $event->event_parent_id) }}">{{ $event->event_parent_title }}</a>
                            </div>
                        @endif
                        <!--rfm -->
                        @if ($event->event_item == 'new_rfm' || $event->event_item == 'updated_rfm' || $event->event_item == 'status_change_rfm' || $event->event_item == 'status_change_rfm' || $event->event_item == 'viewed_rfm' || $event->event_item == 'download_rfm' || $event->event_item == 'rfm_attachment_downloaded')
                            <div class="x-description">
                                <a href="{{ url('rfms/show-event/' . $event->event_parent_id) }}">{{ $event->event_parent_title }}
                                </a>
                            </div>
                        @endif
                        <!--lpo -->
                        @if ($event->event_item == 'po_created' || $event->event_item == 'po_updated' || $event->event_item == 'po_downloaded' || $event->event_item == 'po_viewed')
                            <div class="x-description">
                                <a
                                    href="{{ url('lpos/show-event/' . $event->event_parent_id) }}">{{ $event->event_parent_title }}</a>
                            </div>
                        @endif

                        <!--rfm materials -->
                        @if ($event->event_item == 'material_rfm_added')
                            <div class="x-description">
                                <a
                                    href="{{ url('rfms/' . $event->event_parent_id . '/edit-rfm') }}">{{ $event->event_parent_title }}</a>
                            </div>
                        @endif


                        <!-- materials -->
                        @if ($event->event_item == 'material_created' || $event->event_item == 'material_updated')
                            <div class="x-description">
                                <a
                                    href="{{ url('materials/show-event/' . $event->event_parent_id) }}">{{ $event->event_parent_title }}</a>
                            </div>
                        @endif

                       <!-- employee legal docs -->
                        @if ($event->event_item == 'employee_legal_document_created' || $event->event_item == 'employee_legal_document_updated' || $event->event_item == 'employee_legal_document_downloaded')
                            <div class="x-description">
                                <a
                                    href="{{ url('employeedocument/show-event/' . $event->event_parent_id) }}">{{ $event->event_parent_title }}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
