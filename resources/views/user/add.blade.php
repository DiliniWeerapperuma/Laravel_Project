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
                   <form class= "custom-form"action="{{ route('user.store') }}" method="POST">


                       <h2>ADD USER</h2>


            @csrf


            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name"  required>
            </div>

            <div class="form-group">
                <label for="nic">NIC</label>
                <input type="text" class="form-control" name="nic" id="nic"  required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address"  required>
            </div>

            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" class="form-control" name="mobile" id="mobile"   required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="abc@gmail.com"   required>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" class="form-control" name="gender" required>
                    <option value="" selected >Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>


            <div class="form-group">
                <label for="territory">Territory</label>
                <select id="territory" class="form-control" name="territory" required>
                    <option value="" selected disabled>Select</option>
                    @if(isset($territories))
                        @foreach($territories as $territory)
                            <option value="{{ $territory->id }}">{{ $territory->territory_code }}</option>
                        @endforeach
                    @endif

                    {{-- <option value="A">A</option>
                    <option value="B">B</option> --}}
                </select>
            </div>


            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username"  required>
            </div>


            <div class="form-group">
                <label for="">Password</label>
                <input type="text" class="form-control" name="password" id="password" placeholder=".........." required>
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
