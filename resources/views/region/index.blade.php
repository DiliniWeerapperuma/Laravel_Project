<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<h1> <center> VIEW ALL REGION DETAILS </center> </h1>

<body class ="container">

    <a href = "{{ route('region.add') }}" class="btn btn-primary mt-5">ADD REGION</a>
<table class="table table-striped mt-5">
  <thead>
    <tr>
      <th scope="col">Zone </th>
      <th scope="col">Region Code</th>
      <th scope="col">Region Name</th>
      <th scope="col">Action</th>


    </tr>
  </thead>
  <tbody>

    @foreach ($regions as $region )


    <tr>
      <th scope="row">{{ $region->zone_code}}</th>
      <td>{{ $region->region_code }}</td>
      <td>{{ $region->region_name }}</td>
      <td><a button type="button" class="btn btn-success" href="{{ route('region.show', $region->region_id) }}"> VIEW </button></td>
      <td><a button type="button" class="btn btn-warning" href="{{ route('region.edit', $region->region_id) }}"> EDIT </button></td>
     <td><a button type="button" class="btn btn-danger" href="{{ route('region.delete', $region->region_id) }}"> DELETE </button></td>
        {{-- <div class="alert alert-primary" role="alert">
            This is a primary alert—check it out!s
          </div> --}}



    </tr>

     @endforeach

  </tbody>
</table>

</body>
</html>
