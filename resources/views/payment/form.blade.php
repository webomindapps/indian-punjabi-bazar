<html>

<head>
    <title>Moneris Payment Gateway</title>
</head>

<body>
    <div id="outerDiv" style="width:400px;height:300px">
        <div id="monerisCheckout"></div>
    </div>
    <script src="https://gatewayt.moneris.com/chktv2/js/chkt_v2.00.js"></script>
    <script>
        var myCheckout = new monerisCheckout();
        myCheckout.setMode("qa");
        myCheckout.setCheckoutDiv("monerisCheckout");
        myCheckout.startCheckout('{{ $token }}');

        var myPageLoad = function(data) {
            console.log(data);
            const obj = JSON.parse(data);
            console.log(obj.ticket);

        };

        var myCancelTransaction = function(data) {
            console.log(data);
            const obj = JSON.parse(data);
            console.log(obj.ticket);
            window.location.href = "{{ route('checkout') }}";
        };

        var myErrorEvent = function(data) {
            console.log(data);
            const obj = JSON.parse(data);
            console.log(obj.ticket);
        };

        var myPaymentReceipt = function(data) {
            console.log(data);
            const obj = JSON.parse(data);
            console.log(obj.ticket);
        };

        var myPaymentComplete = function(data) {
            console.log(data);
            const obj = JSON.parse(data);
            console.log(obj);
            window.location.href = "{{ route('payment.response') }}?ticket=" + obj.ticket +
                "&address_id={{ $address_id }}";
        };

        /**
         * Set callbacks in JavaScript:
         */
        myCheckout.setCallback("page_loaded", myPageLoad);
        myCheckout.setCallback("cancel_transaction", myCancelTransaction);
        myCheckout.setCallback("error_event", myErrorEvent);
        myCheckout.setCallback("payment_receipt", myPaymentReceipt);
        myCheckout.setCallback("payment_complete", myPaymentComplete);
    </script>
</body>

</html>
