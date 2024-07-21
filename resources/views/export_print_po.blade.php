<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <style>
        html{
        height: 100%;
        width: 100%;
        }



        .container{
        width: auto;
        height: 842px;
        background-color: rgba(245, 245, 248, 0.323);
        box-shadow: rgba(0, 0, 0, 0) 0px 5px 15px !important;
        border-radius: 10px !important;
        padding: 20px 30px;
        }

        .title{
            padding: 20px;
        text-align: center;
        font-size: 28px;
        font-weight: 800;
        color: black;
        font-family: sans-serif;
        }

        .btn{
        padding: 12px 15px;
        border: none;
        outline: none;
        cursor: pointer;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .table th, td{
            padding: 20px !important;
        }






    </style>
</head>

<body>





        <h1 class="title">Invoice {{$inv_number}} </h1>

        <div class="mb-3">
            <label for="customerName" class="form-label">Distributor Name : {{$distributor->name}}</label>
        </div>



        <div class="mb-3">
            <label for="orderNumber" class="form-label">Purchase Order Number : {{$purchase_order->po_number}}</label>
        </div>



        <table class="table table-borderless mt-5">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Code</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Amount</th>

                </tr>
            </thead>
            <tbody>


                @foreach ($data as $dat)

                <tr>
                    <th scope="row">{{$dat->sku_name}}</th>
                    <td >{{$dat->sku_code}}</td>
                    <td align="right">{{ number_format($dat->price, 2) }}</td>
                    <td >{{$dat->qty}}</td>
                    <td align="right">{{ number_format($dat->total_amount, 2) }}</td>


                </tr>

                @endforeach


                <tr>
                    <th scope="row" colspan="4" >Net Amount:</td>
                    <td scope="row" align="right">{{$purchase_order->total_amount}}</td>
                  </tr>

            </tbody>


            </table>

</body>
</html>
