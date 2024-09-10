<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Cancelled</title>
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
                                <td style="width: 70%; background: #ffffff; font-family: Arial,Helvetica,sans-serif; font-size: 16px; color: #f62020; padding: 10px;"
                                    align="right">
                                    Your order has been cancelled
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
                            <tr style="height: 20px;">
                                <td
                                    style="font-weight:500; background-color: #ffffff; font-family: Arial, Helvetica, sans-serif; font-size: 18px; color: #000000; padding: 7px 0px 6px 13px; height: 20px;">
                                    Customer Details</td>
                            </tr>
                            <tr style="height: 385px;">
                                <td style="height: 385px;border:1px solid #ebebeb;" bgcolor="#ffffff">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td valign="top">
                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr style="height: 30px; background: #fff; color: #484848;">
                                                                <td style="border-right: #ebebeb solid 1px; border-bottom: 1px solid #ebebeb; padding-left: 10px;"
                                                                    width="26%"><strong>Order No.</strong></td>
                                                                <td style="padding-left: 10px; border-bottom: 1px solid #ebebeb;"
                                                                    width="70%">#{{ $order->id }}</td>
                                                            </tr>
                                                            <tr style="height: 30px; background: #fff; color: #484848;">
                                                                <td
                                                                    style="border-bottom: 1px solid #ebebeb; border-right: #ebebeb solid 1px; padding-left: 10px; margin-right: 5px;">
                                                                    <strong>Pickup/Delivery Location </strong>
                                                                </td>
                                                                <td
                                                                    style="padding-left: 10px; border-bottom: 1px solid #ebebeb;">
                                                                    {{ $order->address?->address }}</td>
                                                            </tr>
                                                            {{-- <tr style="height: 30px; background: #fff; color: #484848;">
                                                            <td
                                                                style="border-bottom: 1px solid #ebebeb; border-right: #ebebeb solid 1px; padding-left: 10px; margin-right: 5px;">
                                                                <strong>Pickup/Delivery Time </strong>
                                                            </td>
                                                            <td
                                                                style="padding-left: 10px; border-bottom: 1px solid #ebebeb;">
                                                                @[delivery_pickup_time]</td>
                                                        </tr> --}}
                                                            <tr style="height: 30px; background: #fff; color: #484848;">
                                                                <td
                                                                    style="border-right: #ebebeb solid 1px; border-bottom: 1px solid #ebebeb; padding-left: 10px;">
                                                                    <strong>Name</strong>
                                                                </td>
                                                                <td
                                                                    style="padding-left: 10px; border-bottom: 1px solid #ebebeb;">
                                                                    {{ $order->first_name . ' ' . $order->last_name }}
                                                                </td>
                                                            </tr>
                                                            <tr style="height: 30px; background: #fff; color: #484848;">
                                                                <td
                                                                    style="border-right: #ebebeb solid 1px; border-bottom: 1px solid #ebebeb; padding-left: 10px;">
                                                                    <strong>Email </strong>
                                                                </td>
                                                                <td
                                                                    style="padding-left: 10px; border-bottom: 1px solid #ebebeb;">
                                                                    {{ $order->email }}</td>
                                                            </tr>
                                                            <tr style="height: 30px; background: #fff; color: #484848;">
                                                                <td
                                                                    style="border-right: #ebebeb solid 1px; border-bottom: 1px solid #ebebeb; padding-left: 10px;">
                                                                    <strong>Tel </strong>
                                                                </td>
                                                                <td
                                                                    style="padding-left: 10px; border-bottom: 1px solid #ebebeb;">
                                                                    {{ $order->phone }}</td>
                                                            </tr>
                                                            <tr style="height: 30px; background: #fff; color: #484848;">
                                                                <td style="border-right: #ebebeb solid 1px; border-bottom: 1px solid #ebebeb; padding-left: 10px;"
                                                                    width="26%"><strong>Address</strong></td>
                                                                <td
                                                                    style="padding-left: 10px; border-bottom: 1px solid #ebebeb;">
                                                                    {{ $order->address?->address }}
                                                                </td>
                                                            </tr>
                                                            <tr style="height: 30px; background: #fff; color: #484848;">
                                                                <td style="border-right: #ebebeb solid 1px; border-bottom: 1px solid #ebebeb; padding-left: 10px;"
                                                                    width="26%"><strong>City</strong></td>
                                                                <td
                                                                    style="padding-left: 10px; border-bottom: 1px solid #ebebeb;">
                                                                    {{ $order->address?->city }}
                                                                </td>
                                                            </tr>
                                                            <tr style="height: 30px; background: #fff; color: #484848;">
                                                                <td
                                                                    style="border-right: #ebebeb solid 1px; border-bottom: 1px solid #ebebeb; padding-left: 10px;">
                                                                    <strong>Payment Mode</strong>
                                                                </td>
                                                                <td
                                                                    style="padding-left: 10px; border-bottom: 1px solid #ebebeb;">
                                                                    {{ $order->shipping_method }}</td>
                                                            </tr>
                                                            <tr style="height: 30px; background: #fff; color: #484848;">
                                                                <td
                                                                    style="border-right: #ebebeb solid 1px; border-bottom: 1px solid #ebebeb; padding-left: 10px;">
                                                                    <strong>Order Creation Time</strong>
                                                                </td>
                                                                <td
                                                                    style="padding-left: 10px; border-bottom: 1px solid #ebebeb;">
                                                                    {{ $order->created_at->format('d-m-Y') }}</td>
                                                            </tr>
                                                            <tr style="height: 30px; background: #fff; color: #484848;">
                                                                <td
                                                                    style="border-right: #ebebeb solid 1px; border-bottom: 1px solid #ebebeb; padding-left: 10px;">
                                                                    <strong>Comments</strong>
                                                                </td>
                                                                <td
                                                                    style="padding-left: 10px; border-bottom: 1px solid #ebebeb;">
                                                                    {{ $order->note }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style="height: 17px;">
                                <td style="height: 17px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 29px;">
                                <td
                                    style="font-weight:500; background-color: #ffffff; font-family: Arial, Helvetica, sans-serif; font-size: 18px; color: #000000; padding: 7px 0px 6px 10px; height: 29px;">
                                    Order Details</td>
                            </tr>
                            <tr style="height: 36.2px;">
                                <td style="height: 36.2px;" bgcolor="#FFFFFF">
                                    @if (!is_null($order->items))
                                        <table border="0" cellpadding="0" bgcolor="#fff" cellspacing="0"
                                            width="100%">
                                            <tbody>
                                                <tr>
                                                    <td height="15"
                                                        style="width:30%;border-bottom:solid 1px #ebebeb;color:#fff;padding:10px;background-color:#76b73e;">
                                                        <strong>Item Name</strong>
                                                    </td>
                                                    <td height="15"
                                                        style="width:16.75%;border-bottom:solid 1px #ebebeb;color:#fff;padding:10px;background-color:#76b73e;"
                                                        align="center"><strong>Qty</strong></td>
                                                    <td height="15"
                                                        style="width:16.75%;border-bottom:solid 1px #ebebeb;color:#fff;padding:10px;background-color:#76b73e;"
                                                        align="center"><strong>Price</strong></td>
                                                    <td height="15"
                                                        style="border-bottom:solid 1px #ebebeb;color:#fff;width:16.75%;padding:10px;background-color:#76b73e;"
                                                        align="center"><strong>Total</strong></td>
                                                </tr>
                                                @foreach ($order->items as $item)
                                                    <tr>
                                                        <td height="15"
                                                            style="width:30%;border-bottom:solid 1px #ebebeb;padding:10px;background-color:#fff">
                                                            {{ $item->name }}
                                                        </td>
                                                        <td height="15"
                                                            style="width:16.75%;border-bottom:solid 1px #ebebeb;padding:10px;background-color:#f6f6f6"
                                                            align="center">
                                                            {{ $item->quantity }}
                                                        </td>
                                                        <td height="15"
                                                            style="width:16.75%;border-bottom:solid 1px #ebebeb;padding:10px;background-color:#fff"
                                                            align="center">$ {{ $item->price }}
                                                        </td>
                                                        <td height="15"
                                                            style="width:16.75%;border-bottom:solid 1px #ebebeb;padding:10px;background-color:#f6f6f6"
                                                            align="center">$ {{ $item->total_amount }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </td>
                            </tr>
                            <tr style="height: 191px;">
                                <td style="height: 191px;">
                                    <table style="right: 10px;" border="0" width="100%" cellspacing="0"
                                        cellpadding="0">
                                        <tbody>
                                            <tr style="background-color: #fff;">
                                                <td style="border-bottom: solid 1px #ebebeb; padding-left: 10px;"
                                                    height="30"><strong>Sub Total : </strong></td>
                                                <td style="border-bottom: solid 1px #ebebeb; background-color: #fff; padding-right: 10px;"
                                                    align="right">{{ $order->total_amount }}</td>
                                            </tr>
                                            {{-- <tr style="background-color: #fff;">
                                            <td style="border-bottom: solid 1px #ebebeb; padding-left: 10px;"
                                                height="30"><strong>Taxable Product SubTotal : </strong></td>
                                            <td style="border-bottom: solid 1px #ebebeb; padding-right: 10px;"
                                                align="right">{{$order->tax_total}}</td>
                                        </tr> --}}
                                            <tr class="tax-rates" style="background-color: #fff;">
                                                <td style="border-bottom: solid 1px #ebebeb; padding-left: 10px;"
                                                    height="30"><strong>Taxable Product SubTotal :</strong></td>
                                                <td style="border-bottom: solid 1px #ebebeb; padding-right: 10px;"
                                                    align="right">{{ $order->tax_total }}</td>
                                            </tr>
                                            <tr style="background-color: #fff;">
                                                <td style="border-bottom: solid 1px #ebebeb; padding-left: 10px;"
                                                    height="30"><strong>Coupon Discount : </strong></td>
                                                <td style="border-bottom: solid 1px #ebebeb; padding-right: 10px;"
                                                    align="right">{{ $order->discount_amount }}</td>
                                            </tr>
                                            <tr class="tax-rates" style="background-color: #fff;">
                                                <td style="border-bottom: solid 1px #ebebeb; padding-left: 10px;"
                                                    height="30"><strong>Tax 13% :</strong></td>
                                                <td style="border-bottom: solid 1px #ebebeb; padding-right: 10px;"
                                                    align="right">${{ number_format($order->tax ?? 0, 2) }}</td>
                                            </tr>
                                            <tr style="background-color: #fff;">
                                                <td style="border-bottom: solid 1px #ebebeb; padding-left: 10px;"
                                                    height="30"><strong>Shipping: &nbsp;</strong></td>
                                                <td style="border-bottom: solid 1px #ebebeb; padding-right: 10px;"
                                                    align="right">{{ $order->delivery_charge ?? 0 }}</td>
                                            </tr>
                                            <tr
                                                style="background-color: #76b73e; border: 1px solid #78a659; color: #fff;">
                                                <td style="border-bottom: solid 1px #ebebeb; padding-left: 10px;"
                                                    height="30"><strong>Grand Total : </strong></td>
                                                <td style="border-bottom: solid 1px #ebebeb; padding-right: 10px;"
                                                    align="right">{{ $order->grand_total }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                <td style="font-family: Arial,Helvetica,sans-serif; font-size: 13px; color: #000000; padding: 7px 0 6px 15px; text-align: center;"
                    align="left" height="20">All Rights Reserved &copy; {{ date('Y') }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
