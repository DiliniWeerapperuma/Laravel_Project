<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <center>
    <h1> ADMIN  WELCOME  PAGE </h1>


<a href = "{{ route('zone.index') }}" class="btn btn-primary mt-5">ZONE</a>
<a href = "{{ route('region.index') }}" class="btn btn-secondary mt-5">REGION</a>
<a href = "{{ route('territory.index') }}" class="btn btn-success mt-5">TERRITORY</a>
<a href = "{{ route('register') }}" class="btn btn-danger mt-5">USER</a>
<a href = "{{ route('product.index') }}" class="btn btn-warning mt-5">PRODUCT</a>

</center>
</body>
</html>
