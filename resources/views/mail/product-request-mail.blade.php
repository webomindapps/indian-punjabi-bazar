<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product request Mail</title>
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
                                        src="{{ asset('frontend/assets/images/logo.png') }}" width="120"
                                    height="113" /> --}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 15px;" valign="top">
                    <h3>Product request Details</h3>
                    <hr>
                    <p class="">
                        <strong>Name :</strong>
                        {{ $prequest->first_name . ' ' . $prequest->last_name }}
                    </p>
                    <p class=""><strong>Email :</strong>{{ $prequest->email }}</p>
                    <p class=""><strong>Telephone :</strong>{{ $prequest->phone }}</p>
                    <p class=""><strong>Brand :</strong>{{ $prequest->brand }}</p>
                    <p class=""><strong>Product :</strong>{{ $prequest->product_name }}</p>
                    <p class=""><strong>Comment :</strong>{{ $prequest->message }}</p>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
