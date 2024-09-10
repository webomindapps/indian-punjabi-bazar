<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Application Mail</title>
</head>

<body>
    <table style="background-color: #ebebeb; font-family: Arial, Helvetica, sans-serif;" border="0" width="650"
        cellspacing="0" cellpadding="0" align="center">
        <tbody>
            <tr>
                <td>
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="width: 25%; background: #ffffff; padding: 10px;">
                                    {{-- <img style="width: 100%;"
                                        src="{{ asset('frontend/assets/images/Punjabi-logo.png') }}" width="120"
                                    height="113" /> --}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 15px;" valign="top">
                    <h3>Job Application Details</h3>
                    <hr>
                    <p class="">
                        <strong>Name :</strong>
                        {{ $career->first_name . ' ' . $career->last_name }}
                    </p>
                    <p class=""><strong>Email :</strong>{{ $career->email }}</p>
                    <p class=""><strong>Telephone :</strong>{{ $career->phone }}</p>
                    <p class=""><strong>Status in Canada :</strong>{{ $career->status }}</p>
                    <p class=""><strong>Position :</strong>{{ $career->position }}</p>
                    <p class=""><strong>Date of birth :</strong>{{ $career->dob }}</p>
                    <p class=""><strong>Address :</strong>{{ $career->address }}</p>
                    <p class=""><strong>City :</strong>{{ $career->city }}</p>
                    <p class=""><strong>Province :</strong>{{ $career->province }}</p>
                    <p class=""><strong>Pincode :</strong>{{ $career->pincode }}</p>
                    <p class=""><strong>Comments :</strong>{{ $career->comments }}</p>
                    <p class=""><strong>Resume :</strong><a href="{{ asset($career->resume) }}">Download</a></p>
                    <p class=""><strong>Availability :</strong></p>
                    <p>{!! $career->availability !!}</p>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
