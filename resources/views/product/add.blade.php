<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .custom-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-custom {
            width: 100%;
            background-color: #28a745;
            color: white;
        }
    </style>

    <title>Document</title>
</head>




<body class= "container mt-5" >
    <center>
       <form class= "custom-form"action="{{ route('product.store') }}" method="POST">


           <h2>ADD SKU</h2>

@csrf

<div class="form-group">
    <label for="sku_id">SKU ID</label>
    <input type="text" class="form-control" name="sku_id" id="sku_id"  value="{{ $product }}" readonly>
</div>

           <div class="form-group">
               <label for="sku_code">SKU Code</label>
               <input type="text" class="form-control" name="sku_code" id="sku_code"  required>
           </div>
           <div class="form-group">
               <label for="sku_name">SKU Name</label>
               <input type="text" class="form-control" name="sku_name" id="sku_name" placeholder="Main Product Name/auto" required>
           </div>

           <div class="form-group">
            <label for="mrp">MRP</label>
            <input type="text" class="form-control" name="mrp" id="mrp"  required>
        </div>

        <div class="form-group">
            <label for="distributor_price">Distributor_Price</label>
            <input type="text" class="form-control" name="distributor_price" id="distributor_price"  required>
        </div>

        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="text" class="form-control" name="weight" id="weight"  required>
        </div>


           <button type="submit" class="btn btn-primary">SAVE</button>
        </div>
       </form>


   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</center>
</body>
</html>













