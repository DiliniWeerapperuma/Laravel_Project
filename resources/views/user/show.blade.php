

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


<a href = "{{ route('region.index') }}" class="btn btn-primary mt-5">BACK</a>

<body class= "container mt-5" >
    <center>
       {{-- <form class= "custom-form"action="{{ route('zone.store') }}" method="POST"> --}}




@csrf
<div class="container mt-5">
    <form class="custom-form">
        <h2>SHOW REGION DETAILS</h2>

        <div class="form-group">
            <label for="zone">Zone</label>
            <input type="text" class="form-control" name="zone" id="zone" value="{{ $regions->zone_code }}" readonly>
        </div>



        <div class="form-group">
            <label for="region_code">Region Code</label>
            <input type="text" class="form-control" name="region_code" id="region_code"  value="{{ $regions->region_code  }}" readonly>
        </div>
        <div class="form-group">
            <label for="region_name">Region Name</label>
            <input type="text" class="form-control" name="region_name" id="region_name" value="{{ $regions->region_name }}" readonly>
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







