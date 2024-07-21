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
                   <form class= "custom-form"action="{{ route('territory.store') }}" method="POST">


                       <h2>ADD TERRITORY</h2>


            @csrf

            <div class="form-group">
                <label for="zone">Zone</label>
                <select id="zone" class="form-control" name="zone" required>
                    <option value="" selected disabled>Select</option>
                    @if(isset($zones))
                        @foreach($zones as $zone)
                            <option value="{{ $zone->id }}">{{ $zone->zone_code }}</option>
                        @endforeach
                    @endif

                </select>
            </div>

            <div class="form-group">
                <label for="region">Region</label>
                <select id="region" class="form-control" name="region" required>
                    <option value="" selected disabled>Select</option>
                    @if(isset($regions))
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->region_code }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="territory_code">Territory Code</label>
                <input type="text" class="form-control" name="territory_code" id="territory_code"  value="{{ $territory}}" readonly>
            </div>
            <div class="form-group">
                <label for="territory_name">Territory Name</label>
                <input type="text" class="form-control" name="territory_name" id="territory_name" placeholder="Ex. TERRITORY 1" required>
            </div>
            <button type="submit" class="btn btn-custom">SAVE</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



</center>
</body>
</html>
