<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<h1> <center> VIEW ALL TERRITORY DETAILS </center> </h1>

<body class ="container">

    <a href = "{{ route('territory.add') }}" class="btn btn-primary mt-5">ADD TERRITORY</a>
<table class="table table-striped mt-5">
  <thead>
    <tr>
      <th scope="col">Zone </th>
      <th scope="col">Region </th>
      <th scope="col">Territory Code</th>
      <th scope="col">Territory Name</th>
      <th scope="col">Action</th>


    </tr>
  </thead>
  <tbody>

    @foreach ($territories as $territory )


    <tr>
      <th scope="row">{{ $territory->zone_code}}</th>
      <td>{{ $territory->region_code }}</td>
      <td>{{ $territory->territory_code }}</td>
      <td>{{ $territory->territory_name }}</td>
      <td><a button type="button" class="btn btn-success" href="{{ route('territory.show', $territory->territory_id) }}"> VIEW </button></td>
      <td><a button type="button" class="btn btn-warning" href="{{ route('territory.edit', $territory->territory_id) }}"> EDIT </button></td>
     <td><a button type="button" class="btn btn-danger" href="{{ route('territory.delete', $territory->territory_id) }}"> DELETE </button></td>
        {{-- <div class="alert alert-primary" role="alert">
            This is a primary alert—check it out!s
          </div> --}}



    </tr>

     @endforeach

  </tbody>
</table>

</body>
</html>
