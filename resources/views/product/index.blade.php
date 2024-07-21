<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<h1> <center> VIEW ALL PRODUCT DETAILS </center> </h1>

<body class ="container">

    <a href = "{{ route('product.add') }}" class="btn btn-primary mt-5">ADD SKU</a>
<table class="table table-striped mt-5">
  <thead>
    <tr>
      <th scope="col">SKU ID</th>
      <th scope="col">SKU Code</th>
      <th scope="col">SKU Name</th>
      <th scope="col">MRP</th>
      <th scope="col">Distributor_Price</th>
      <th scope="col">Weight/Volume</th>



    </tr>
  </thead>
  <tbody>

    @foreach ($products as $product )


    <tr>
      <th scope="row">{{ $product->id}}</th>
      <td>{{ $product->sku_code }}</td>
      <td>{{ $product->sku_name }}</td>
      <td>{{ $product->mrp }}</td>
      <td>{{ $product->distributor_price }}</td>
      <td>{{ $product->weight }}</td>




    </tr>

    @endforeach

  </tbody>
</table>

</body>
</html>
