<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upcoming Delivery Reminder</title>
</head>

<body>
    <table
        style="background-color: #ffffff; font-family: Arial, Helvetica, sans-serif; font-size: 12px;border:1px double #76b73e;padding:5px"
        width="680" cellspacing="0" cellpadding="0" align="center">
        <tbody>
            <tr>
                <td>
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="width: 30%; background: #ffffff; padding: 10px;">
                                    <img style="width: 100%;object-fit:contain;"
                                        src="{{ asset('frontend/assets/images/logo.png') }}" width="120"
                                        height="113" />
                                </td>
                                <td style="width: 70%; background: #ffffff; font-family: Arial,Helvetica,sans-serif; font-size: 22px; color: #78a659; padding: 10px;"
                                    align="right">
                                    Upcoming Delivery Reminder<br />
                                    <span style="color: #000;">Total Order : {{ count($orders) }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 15px;" valign="top">
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr style="height: 29px;">
                                <td
                                    style="font-weight:500; background-color: #ffffff; font-family: Arial, Helvetica, sans-serif; font-size: 18px; color: #000000; padding: 7px 0px 6px 10px; height: 29px;">
                                    Upcoming Order Details</td>
                            </tr>
                            <tr style="height: 36.2px;">
                                <td style="height: 36.2px;" bgcolor="#FFFFFF">
                                    @if (!is_null($orders))
                                        <table border="0" cellpadding="0" bgcolor="#fff" cellspacing="0"
                                            width="100%">
                                            <tbody>
                                                <tr>
                                                    <td height="15"
                                                        style="width:10%;border-bottom:solid 1px #ebebeb;color:#fff;padding:10px;background-color:#76b73e;">
                                                        <strong>Order id</strong>
                                                    </td>
                                                    <td height="15"
                                                        style="width:18%;border-bottom:solid 1px #ebebeb;color:#fff;padding:10px;background-color:#76b73e;"
                                                        align="center">
                                                        <strong>Name</strong>
                                                    </td>
                                                    <td height="15"
                                                        style="width:14%;border-bottom:solid 1px #ebebeb;color:#fff;padding:10px;background-color:#76b73e;"
                                                        align="center">
                                                        <strong>Phone</strong>
                                                    </td>
                                                    <td height="15"
                                                        style="width:14%;border-bottom:solid 1px #ebebeb;color:#fff;padding:10px;background-color:#76b73e;"
                                                        align="center">
                                                        <strong>Delivery Type</strong>
                                                    </td>
                                                    <td height="15"
                                                        style="width:18%;border-bottom:solid 1px #ebebeb;color:#fff;padding:10px;background-color:#76b73e;"
                                                        align="center">
                                                        <strong>Order Date</strong>
                                                    </td>
                                                    <td height="15"
                                                        style="width:14%;border-bottom:solid 1px #ebebeb;color:#fff;padding:10px;background-color:#76b73e;"
                                                        align="center">
                                                        <strong>Location</strong>
                                                    </td>
                                                    <td height="15"
                                                        style="width:12%;border-bottom:solid 1px #ebebeb;color:#fff;padding:10px;background-color:#76b73e;"
                                                        align="center">
                                                        <strong>Action</strong>
                                                    </td>
                                                </tr>
                                                @foreach ($orders as $item)
                                                    <tr>
                                                        <td height="15"
                                                            style="border-bottom:solid 1px #ebebeb;padding:10px;background-color:#fff">
                                                            {{ $item->id }}
                                                        </td>
                                                        <td height="15"
                                                            style="border-bottom:solid 1px #ebebeb;padding:10px;background-color:#f6f6f6"
                                                            align="center">
                                                            {{ $item->first_name . ' ' . $item->last_name }}
                                                        </td>
                                                        <td height="15"
                                                            style="border-bottom:solid 1px #ebebeb;padding:10px;background-color:#fff"
                                                            align="center">{{ $item->phone }}
                                                        </td>
                                                        <td height="15"
                                                            style="border-bottom:solid 1px #ebebeb;padding:10px;background-color:#fff"
                                                            align="center">{{ $item->delivery_type }}
                                                        </td>
                                                        <td height="15"
                                                            style="border-bottom:solid 1px #ebebeb;padding:10px;background-color:#fff"
                                                            align="center">
                                                            {{ $item->created_at->format('d-m-Y h:i A') }}
                                                        </td>
                                                        <td height="15"
                                                            style="border-bottom:solid 1px #ebebeb;padding:10px;background-color:#fff"
                                                            align="center">
                                                            {{ $item?->deliveryCity?->city ?? 'Punjabi' }}
                                                        </td>
                                                        <td height="15"
                                                            style="border-bottom:solid 1px #ebebeb;padding:10px;background-color:#fff"
                                                            align="center">
                                                            <a href="{{ route('order.details', $item->id) }}"
                                                                style="padding:5px 10px;background:red;color:white;border-radius:5px;">View</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#ffffff;font-weight:normal;background:#76b73e;"
                    align="center" valign="middle" height="60">
                    <table border="0" width="94%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="color:#ffffff" width="50%">Call Us:
                                    <span
                                        style="color:#ffffff;font-family:Roboto,sans-serif;font-size:13px;font-style:normal;font-weight:400;">{{ $homesetting->phone }}</span><br>
                                    Email :
                                    <a href="mailto:{{ $homesetting->contact_email }}"
                                        target="_blank">{{ $homesetting->contact_email }}</a>
                                </td>
                                <td width="19%">&nbsp;</td>
                                <td style="color:#ffffff" align="left" width="45%">
                                    Address: {{ $homesetting->address }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="font-family: Arial,Helvetica,sans-serif; font-size: 13px; color: #ffffff; padding: 7px 0 6px 15px; text-align: center;"
                    align="left" bgcolor="#000;" height="20">All Rights Reserved &copy; {{ date('Y') }}
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
