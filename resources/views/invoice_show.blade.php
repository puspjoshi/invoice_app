<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased">
<div class="container">
    <!--==================== SHOW INVOICE ====================-->
    <div class="invoices">


        <div class="table invoice">
            <div class="logo">
                <img src="assets/img/logo.png" alt="" style="width: 200px;">
            </div>
            <div class="invoice__header--title">
                <p></p>
                <p class="invoice__header--title-1">Invoice</p>
                <p></p>
            </div>


            <div class="invoice__header--item">
                <div>
                    <h2>Invoice To:</h2>
                    <p v-if="form.customer"> Jhon Doe </p>
                    <p v-else></p>
                </div>
                <div>
                    <div class="invoice__header--item1">
                        <p>Invoice#</p>
                        <span>#{{ $invoice->number }} </span>
                    </div>
                    <div class="invoice__header--item2">
                        <p>Date</p>
                        <span>{{ $invoice->date }} </span>
                    </div>
                    <div class="invoice__header--item2">
                        <p>Due Date</p>
                        <span>{{ $invoice->due_date }} </span>
                    </div>
                    <div class="invoice__header--item2">
                        <p>Reference</p>
                        <span>{{ $invoice->reference }} </span>
                    </div>

                </div>
            </div>

            <div class="table py1">

                <div class="table--heading3">
                    <p>#</p>
                    <p>Item Description</p>
                    <p>Unit Price</p>
                    <p>Qty</p>
                    <p>Total</p>
                </div>

                <!-- item 1 -->
                @foreach ($invoice->invoice_items as $item)
                <div class="table--items3" >
                    <p>{{ $item->id+1 }}</p>
                    <p>#{{ $item->item_code }} {{ $item->description }}</p>

                    <p>$ {{ $item->unit_price }}</p>
                    <p>{{ $item->quantity }}</p>
                    <p>$ {{ ($item->unit_price)*($item->quantity) }}</p>
                </div>
                @endforeach



            </div>

            <div  class="invoice__subtotal">
                <div>
                    <h2>Thank you for your business</h2>
                </div>
                <div>
                    <div class="invoice__subtotal--item1">
                        <p>Sub Total</p>
                        <span> $ {{ $invoice->sub_total }} </span>
                    </div>
                    <div class="invoice__subtotal--item2">
                        <p>Discount</p>
                        <span>$ {{ $invoice->discount }}</span>
                    </div>

                </div>
            </div>

            <div class="invoice__total">
                <div>
                    <h2>Terms and Conditions</h2>
                    <p>{{ $invoice->terms_and_conditions}}. </p>
                </div>
                <div>
                    <div class="grand__total" >
                        <div class="grand__total--items">
                            <p>Grand Total</p>
                            <span>$ {{ $invoice->total }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>
</body>
</html>
