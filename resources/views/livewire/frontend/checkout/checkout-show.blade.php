<div>
    <div class="py-3 py-md-4 checkout">
        <div class="container">
            {{-- <h4>Checkout</h4>
            <hr> --}}
            @if ($totalProductAmount != '0')
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="shadow bg-white p-3">
                            <h4  style="color: #DF7857 ">
                                Item Total Amount :
                                <span class="float-end">{{$totalProductAmount}} DH</span>
                            </h4>
                            <hr>
                            <small>* Items will be delivered in 3 - 5 days.</small>
                            <br/>
                            <small>* Tax and other charges are included ?</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary"style="color: #DF7857 ">
                                Basic Information
                            </h4>
                            <hr>

                            {{-- <form action="" method="POST"> --}}
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Full Name</label>
                                        <input type="text" wire:model.defer="fullname" id="fullname"   class="form-control" placeholder="Enter Full Name" />
                                        @error('fullname') <small class="text-danger">{{$message}}</small>  @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Phone Number</label>
                                        <input type="number" wire:model.defer="phone"    id="phone" class="form-control" placeholder="Enter Phone Number" />
                                        @error('phone') <small class="text-danger">{{$message}}</small>  @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Email Address</label>
                                        <input type="email" wire:model.defer="email"  id="email" class="form-control" placeholder="Enter Email Address" />
                                        @error('email') <small class="text-danger">{{$message}}</small>  @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Pin-code (Zip-code)</label>
                                        <input type="number" wire:model.defer="zipcode"  id="zipcode"  class="form-control" placeholder="Enter Pin-code" />
                                        @error('zipcode') <small class="text-danger">{{$message}}</small>  @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Full Address</label>
                                        <textarea wire:model.defer="address"  id="address"  class="form-control" rows="2"></textarea>
                                        @error('address') <small class="text-danger">{{$message}}</small>  @enderror
                                    </div>
                                    <div class="col-md-12 mb-3" wire:ignore>
                                        <label>Select Payment Mode: </label>
                                        <div class="d-md-flex align-items-start">
                                            <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <button  wire:loading.attr="disable" class="nav-link active fw-bold" style="border:solid 2px " id="cashOnDeliveryTab-tab" data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button" role="tab" aria-controls="cashOnDeliveryTab" aria-selected="true">Cash on Delivery</button>
                                                <button  wire:loading.attr="disable" class="nav-link fw-bold"  style="border:solid 2px " id="onlinePayment-tab" data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button" role="tab" aria-controls="onlinePayment" aria-selected="false">Online Payment</button>
                                            </div>
                                            <div class="tab-content col-md-9" id="v-pills-tabContent">
                                                <div class="tab-pane active show fade" id="cashOnDeliveryTab" role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                                    <h6>Cash on Delivery Mode</h6>
                                                    <hr/>
                                                    <button  type="button" wire:loading.attr="disable" wire:click="codOrder" class="btn  pt-3  w-100 text-white" style="background-color: #F5A623">
                                                        <h4 wire:loading.remove wire:target="codOrder">
                                                            Place Order (Cash on Delivery)
                                                        </h4>
                                                        <h4 wire:loading wire:target="codOrder">
                                                            Placeing Order
                                                        </h4>
                                                    </button>
                                                </div>
                                                <div class="tab-pane fade" id="onlinePayment" role="tabpanel" aria-labelledby="onlinePayment-tab" tabindex="0">
                                                    <h6>Online Payment Mode</h6>
                                                    <hr/>
                                                    {{-- <button type="button"  wire:loading.attr="disable" wire:click='placeOrder' class="btn btn-warning">Pay Now (Online Payment)</button> --}}
                                                    <div >
                                                        <div id="paypal-button-container"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            {{-- </form> --}}

                        </div>
                    </div>

                </div>
            @else
            <div class="card card-body shadow text-center p-md-5">
                <h4>No Items in cart to chechout</h4>
                <a href="{{ url('/')}}" class="btn btn-warning">Shop Now</a>
            </div>
            @endif
        </div>
    </div>

</div>
@push('scripts')
<script src="https://www.paypal.com/sdk/js?client-id=AcO9aSjThfdBiQybKVCMDXC6zH0zlkbdQ5THTqbYus99naSuArETqsDh3qvdP9xryR8rUYJh3wF4mXSe&currency=USD"></script>
   
    <script>
        paypal.Buttons({
          // Order is created on the server and the order id is returned
          
           
          onClick: function()  {

            // Show a validation error if the checkbox is not checked
            if (!document.getElementById('fullname').value
            || !document.getElementById('phone').value
            || !document.getElementById('email').value
            || !document.getElementById('zipcode').value
            || !document.getElementById('address').value
            ) 
            {
                livewire.emit('validationForAll');
                return false;
            }else{
                @this.set('fullname',document.getElementById('fullname').value);
                @this.set('phone',document.getElementById('phone').value);
                @this.set('email',document.getElementById('email').value);
                @this.set('zipcode',document.getElementById('zipcode').value);
                @this.set('address',document.getElementById('address').value);
            }
        },  
        createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                    amount: {
                        value: '{{ $this->totalProductAmount }}'
                    }
                    }]
                });
            }, 
        //   createOrder() {
        //     return fetch("/checkout/create-paypal-order", {
        //       method: "POST",
        //       headers: {
        //         "Content-Type": "application/json",
        //       },
        //       // use the "body" param to optionally pass additional order information
        //       // like product skus and quantities
        //       body: JSON.stringify({
        //         cart: [
        //           {
        //             sku: "YOUR_PRODUCT_STOCK_KEEPING_UNIT",
        //             quantity: "YOUR_PRODUCT_QUANTITY",
        //           },
        //         ],
        //       }),
        //     })
        //     .then((response) => response.json())
        //     .then((order) => order.id);
        //   },
        // 
          // Finalize the transaction on the server after payer approval
          onApprove(data) {
            return fetch("http://127.0.0.1:8000/capture-paypal-order", {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify({
                orderID: data.orderID
              })
            })
            .then((response) => response.json())
            .then((orderData) => {
              // Successful capture! For dev/demo purposes:
              console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
              const transaction = orderData.purchase_units[0].payments.captures[0];
            //   alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            if(transaction.status == "COMPLETED"){
                livewire.emit('transactionEmit',transaction.id);
            }
              // When ready to go live, remove the alert and show a success message within this page. For example:
              // const element = document.getElementById('paypal-button-container');
              // element.innerHTML = '<h3>Thank you for your payment!</h3>';
              // Or go to another URL:  window.location.href = 'thank_you.html';
            });
          }
        }).render('#paypal-button-container');
      </script>

      {{-- <script>
        paypal.Buttons({
          // Order is created on the server and the order id is returned
          createOrder() {
            return fetch("/my-server/create-paypal-order", {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              // use the "body" param to optionally pass additional order information
              // like product skus and quantities
              body: JSON.stringify({
                cart: [
                  {
                    sku: "YOUR_PRODUCT_STOCK_KEEPING_UNIT",
                    quantity: "YOUR_PRODUCT_QUANTITY",
                  },
                ],
              }),
            })
            .then((response) => response.json())
            .then((order) => order.id);
          },
          // Finalize the transaction on the server after payer approval
          onApprove(data) {
            return fetch("/my-server/capture-paypal-order", {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify({
                orderID: data.orderID
              })
            })
            .then((response) => response.json())
            .then((orderData) => {
              // Successful capture! For dev/demo purposes:
              console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
              const transaction = orderData.purchase_units[0].payments.captures[0];
              alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
              // When ready to go live, remove the alert and show a success message within this page. For example:
              // const element = document.getElementById('paypal-button-container');
              // element.innerHTML = '<h3>Thank you for your payment!</h3>';
              // Or go to another URL:  window.location.href = 'thank_you.html';
            });
          }
        }).render('#paypal-button-container');
      </script> --}}

@endpush