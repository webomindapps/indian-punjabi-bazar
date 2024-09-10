<x-admin-layout>
    <div class="main shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <a onclick="history.length > 1 ? history.go(-1) : window.location = window.location.origin;">
                                <i class="fas fa-chevron-left fs-5"></i>
                            </a>
                            <x-utility.additional.title title="Candidates Details" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mx-auto">
                    <div class="form-section mt-3 show-details">
                        <table>
                            <tr>
                                <th class="p-2">
                                    First Name
                                </th>
                                <td class="p-2">
                                    : {{ $applicant->first_name }}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-2">
                                    Last Name
                                </th>
                                <td class="p-2">
                                    : {{ $applicant->last_name }}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-2">
                                    Email
                                </th>
                                <td class="p-2">
                                    : {{ $applicant->email }}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-2">
                                    Phone
                                </th>
                                <td class="p-2">
                                    : {{ $applicant->phone }}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-2">
                                    Dob
                                </th>
                                <td class="p-2">
                                    : @if ($applicant->dob)
                                        {{ \Carbon\Carbon::parse($applicant->dob)->format('d-m-Y') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="p-2">
                                    position
                                </th>
                                <td class="p-2">
                                    : {{ $applicant->position }}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-2">
                                    Availability
                                </th>
                                <td class="p-2">
                                    <p> {!! $applicant->availability !!}</p>
                                </td>
                            </tr>
                            <tr>
                                <th class="p-2">
                                    Status
                                </th>
                                <td class="p-2">
                                    : {{ $applicant->status }}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-2">
                                    City
                                </th>
                                <td class="p-2">
                                    : {{ $applicant->city }}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-2">
                                    Province
                                </th>
                                <td class="p-2">
                                    : {{ $applicant->province }}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-2">
                                    Pincode
                                </th>
                                <td class="p-2">
                                    : {{ $applicant->pincode }}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-2">
                                    Address
                                </th>
                                <td class="p-2">
                                    : {{ $applicant->address }}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-2">
                                    comments
                                </th>
                                <td class="p-2">
                                    : {{ $applicant->comments }}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-2">
                                    Applied at
                                </th>
                                <td class="p-2">
                                    : @if ($applicant->applied_at)
                                        {{ \Carbon\Carbon::parse($applicant->applied_at)->format('d-m-Y') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="p-2">
                                    Resume
                                </th>
                                <td class="p-2">
                                    : <a href="{{ asset($applicant->resume) }}">View Resume</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
