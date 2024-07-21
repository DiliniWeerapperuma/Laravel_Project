<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<h1> <center> VIEW ALL ZONE DETAILS </center> </h1>

<body class ="container">

    <a href = "{{ route('zone.add') }}" class="btn btn-primary mt-5">ADD ZONE</a>

<table class="table table-striped mt-5">
  <thead>
    <tr>
      <th scope="col">Zone Code</th>
      <th scope="col">Zone Long Description</th>
      <th scope="col">Short Description</th>
      <th scope="col">Action</th>


    </tr>
  </thead>

  <tbody>

    @foreach ($zones as $zone )


    <tr>
      <th scope="row">{{ $zone->zone_code}}</th>
      <td>{{ $zone->zone_long_description }}</td>
      <td>{{ $zone->short_description }}</td>
      <td><a button type="button" class="btn btn-success" href="{{ route('zone.show', $zone->id) }}"> VIEW </button></td>
      <td><a button type="button" class="btn btn-warning" href="{{ route('zone.edit', $zone->id) }}"> EDIT </button></td>
     <td><a button type="button" class="btn btn-danger" href="{{ route('zone.delete', $zone->id) }}"> DELETE </button></td>
        {{-- <div class="alert alert-primary" role="alert">
            This is a primary alert—check it out!
          </div> --}}



    </tr>

    @endforeach

  </tbody>
</table>

</body>
</html>
