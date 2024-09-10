<x-app-layout>
    <style>
        .success_message {
            border-radius: 15px;
            padding: 30px;
        }

        .success_message img {
            width: 60%
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="success_message border bg-white text-center">
                    <div class="row">
                        <div class="col-lg-9 mx-auto">
                            <img src="{{asset('frontend/assets/images/confirmed.gif')}}" class="img-fluid" style="height: " alt="">
                        </div>
                    </div>
                    <h5>Your order id is: <span class="text-success fw-bold"> #{{$id}}</span> </h5>
                    <h3>Your order has been confirmed</h3>
                    <p>
                        You will receive an order confirmation email with details of your order and a link to track your
                        process.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
