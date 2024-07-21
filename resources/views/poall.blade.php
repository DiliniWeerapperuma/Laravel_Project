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
            max-width: 1500px;
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

        .form-group-small {
            margin-bottom: 15px;
        }

        .form-control-sm {
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: .2rem;
        }
    </style>

    <title>Document</title>
</head>

<body class="container mt-5">
    <form class="custom-form" action="" method="POST">
        {{-- {{ route('territory.store') }} --}}
        <h2>PURCHASE ORDER VIEW</h2>

        @csrf

        <div class="row">
            <div class="col-md-2 form-group-small">
                <label for="zone">Zone</label>
                <select id="zone" class="form-control form-control-sm" name="zone" required>
                    <option value="" selected disabled>Select</option>
                    @if (isset($zones))
                        @foreach ($zones as $zone)
                            <option value="{{ $zone->id }}">{{ $zone->zone_code }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="col-md-2 form-group-small">
                <label for="region">Region</label>
                <select id="region" class="form-control form-control-sm" name="region">
                    <option value="" selected disabled>Select</option>
                    @if (isset($regions))
                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->region_code }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="col-md-2 form-group-small">
                <label for="territory">Territory</label>
                <select id="territory" class="form-control form-control-sm" name="territory">
                    <option value="" selected disabled>Select</option>
                    @if (isset($territories))
                        @foreach ($territories as $territory)
                            <option value="{{ $territory->id }}">{{ $territory->territory_code }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="col-md-2 form-group-small">
                <label for="po_number">PO Number</label>
                <input type="text" class="form-control form-control-sm" name="po_number" id="po_number"
                    placeholder="Ex. PO01">
            </div>

            <div class="col-md-2 form-group-small">
                <label for="datePickerFrom" class="form-label">Date From</label>
                <input type="date" id="from" name="from" class="form-control form-control-sm">
            </div>

            <div class="col-md-2 form-group-small">
                <label for="datePickerTo" class="form-label">Date To</label>
                <input type="date" id="to" name="to" class="form-control form-control-sm">
            </div>
        </div>

        <button class="btn btn-primary btn-sm" type="button" onclick="get_data();">Search</button>
        <button class="btn btn-secondary btn-sm mt-2" type="button" onclick="exportSelected();">Export All</button>

    </form>

    <div id="purchase_orders"></div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        function get_data() {
            $.ajax({
                type: "POST",
                url: "{{ url('/purchaseorder/po_data') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'zone': $('#region').val(),
                    'region': $('#zone').val(),
                    'territory': $('#territory').val(),
                    'po_number': $('#po_number').val(),
                    'from': $('#from').val(),
                    'to': $('#to').val(),
                },
                cache: false,
                success: function(html) {
                    $("#purchase_orders").html(html);
                    // Call the function to attach event listeners after loading the data
                    attachSelectAll();
                },
                complete: function(data) {
                }
            });
        }

        function attachSelectAll() {
            var selectAllCheckbox = document.getElementById('selectAll');
            if (selectAllCheckbox) {
                var checkboxes = document.querySelectorAll('input[name="select_item"]');
                selectAllCheckbox.addEventListener('change', function() {
                    checkboxes.forEach((checkbox) => {
                        checkbox.checked = this.checked;
                    });
                });
            }
        }


        function exportSelected() {
            // Collect IDs of all checked checkboxes
            var selectedIds = [];
            document.querySelectorAll('input[name="select_item"]:checked').forEach(function(checkbox) {
                selectedIds.push(checkbox.value);
            });

            if (selectedIds.length > 0) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('/purchaseorder/export') }}", // Adjust this URL based on your route
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'ids': selectedIds,
                    },
                    success: function(response) {
                        // Handle success response here, e.g., show a message or redirect
                        alert('Export successful!');
                    },
                    error: function(xhr) {
                        // Handle error response here
                        alert('An error occurred while exporting.');
                    }
                });
            } else {
                alert('No items selected for export.');
            }
        }
    </script>



</body>

</html>
