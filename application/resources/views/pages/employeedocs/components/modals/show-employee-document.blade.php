<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>

                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('Employee No')) }}</td>
                        <td>{{ $employee->employee_no ?? '' }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Employee Name')) }}</td>
                        <td>{{ $employee->employee_name ?? '' }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Expiration')) }}</td>
                        <td>{{ runtimeDate($employee->expiration ?? '') }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Visa No')) }}</td>
                        <td>{{ $employee->visa_no ?? '' }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('ID No')) }}</td>
                        <td>{{ $employee->id_no ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Passport No')) }}</td>
                        <td>{{ $employee->passport_no ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Passport Expiration')) }}</td>
                        <td>{{ $employee->passport_expiration ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Contract No')) }}</td>
                        <td>{{ $employee->contract_no ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Contract Expiration')) }}</td>
                        <td>{{ $employee->id_no ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Arrival Date')) }}</td>
                        <td>{{ runtimeDate($employee->arrival_date ?? '') }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Working Starting Date')) }}</td>
                        <td>{{ runtimeDate($employee->working_starting_date ?? '') }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('PHCC No')) }}</td>
                        <td>{{ $employee->phcc_no ?? '' }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('PHCC Expiration')) }}</td>
                        <td>{{ runtimeDate($employee->expiration ?? '') }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Joining Visa No')) }}</td>
                        <td>{{ $employee->joining_visa_no ?? '' }}</td>
                    </tr>

                    <!--Attchment-->
                    <tr>
                        <td>{{ cleanLang(__('lang.attachement')) }}</td>
                        <td>
                            @forelse($attachments as $attachment)
                                <ul class="p-l-0">
                                    @if ($attachment->attachment_unique_input === 'id_copy')
                                        <span>ID Copy: </span>
                                        <li id="fx-expenses-files-attached">
                                            <a href="employeedocument/attachments/download/{{ $attachment->attachment_uniqiueid }}"
                                                download>
                                                {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if ($attachment->attachment_unique_input === 'passport_copy')
                                        <span>Passport Copy: </span>
                                        <li id="fx-expenses-files-attached">
                                            <a href="employeedocument/attachments/download/{{ $attachment->attachment_uniqiueid }}"
                                                download>
                                                {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if ($attachment->attachment_unique_input === 'employement_contract_copy')
                                        <span>Employement Contract Copy: </span>
                                        <li id="fx-expenses-files-attached">
                                            <a href="employeedocument/attachments/download/{{ $attachment->attachment_uniqiueid }}"
                                                download>
                                                {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($attachment->attachment_unique_input === 'hamad_card_copy')
                                        <span>Hamad Card Copy: </span>
                                        <li id="fx-expenses-files-attached">
                                            <a href="employeedocument/attachments/download/{{ $attachment->attachment_uniqiueid }}"
                                                download>
                                                {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($attachment->attachment_unique_input === 'other_documents')
                                        <span>Other Documents: </span>
                                        <li id="fx-expenses-files-attached">
                                            <a href="employeedocument/attachments/download/{{ $attachment->attachment_uniqiueid }}"
                                                download>
                                                {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            @empty
                                Not found !!
                            @endforelse
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
