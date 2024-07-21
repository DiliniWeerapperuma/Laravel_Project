

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


<a href = "{{ route('zone.index') }}" class="btn btn-primary mt-5">BACK</a>

<body class= "container mt-5" >
    <center>
       {{-- <form class= "custom-form"action="{{ route('zone.store') }}" method="POST"> --}}




@csrf
<div class="container mt-5">
    <form class="custom-form">
        <h2>SHOW ZONE DETAILS</h2>
        <div class="form-group">
            <label for="zone_code">Zone Code</label>
            <input type="text" class="form-control" name="zone_code" id="zone_code"  value="{{ $zone->zone_code  }}" readonly>
        </div>
        <div class="form-group">
            <label for="zone_long_description">Zone Long Description</label>
            <input type="text" class="form-control" name="zone_long_description" id="zone_long_description" value="{{ $zone->zone_long_description }}" readonly>
        </div>
        <div class="form-group">
            <label for="short_description">Short Description</label>
            <input type="text" class="form-control" name="short_description" id="short_description" value="{{ $zone->short_description }}" readonly>
        </div>
    </form>
</div>


       </form>


   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</center>
</body>
</html>







