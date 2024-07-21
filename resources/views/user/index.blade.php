<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<h1> <center> VIEW ALL USER DETAILS </center> </h1>

<body class ="container">

    <a href = "{{ route('user.add') }}" class="btn btn-primary mt-5">ADD USER</a>
<table class="table table-striped mt-5">
  <thead>
    <tr>
      <th scope="col">Name </th>
      <th scope="col">NIC</th>
      <th scope="col">Address</th>
      <th scope="col">Mobile</th>
      <th scope="col">E-Mail</th>
      <th scope="col">Gender</th>
      <th scope="col">Territory</th>
      {{-- <th scope="col">User Name</th>
      <th scope="col">Password</th>
      <th scope="col">Action</th> --}}


    </tr>
  </thead>
  <tbody>

    @foreach ($users as $user )


    <tr>
      <th scope="row">{{$user->name }}</th>
      <td>{{ $user->nic }}</td>
      <td>{{ $user->address }}</td>
      <td>{{ $user->mobile }}</td>
      <td>{{ $user->email}}</td>
      <td>{{ $user->gender }}</td>
      <td>{{ $user->territory_code }}</td>
      <td>{{ $user->username }}</td>
      <td>{{ $user->password}}</td>




    </tr>

     @endforeach

  </tbody>
</table>

</body>
</html>
