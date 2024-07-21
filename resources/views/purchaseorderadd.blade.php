<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .detail-group {
            margin-bottom: 15px;
        }
        .detail-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .detail-group div,
        .detail-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .detail-group textarea {
            background-color: #fff;
        }
    </style>

</head>
<body>
    <div class="container">
        <center>
            <h3><p class="text-danger">ADD INDIVIDUAL PURCHASE ORDER</p></h3>
        </center>

        <div class="row">
            <div class="col-md-6 detail-group">
                <label for="zone">Zone</label>
                <div id="zone">{{ $users->zone_code }}</div>
                <input type="hidden" id="zone_id" name="zone_id" value="{{ $users->zone_id }}">
            </div>

            <div class="col-md-6 detail-group">
                <label for="region">Region</label>
                <div id="region">{{ $users->region_code }}</div>
                <input type="hidden" id="region_id" name="region_id" value="{{ $users->region_id }}">
            </div>
        </div>

        <!-- Second Row -->
        <div class="row">
            <div class="col-md-6 detail-group">
                <label for="territory">Territory</label>
                <div id="territory">{{ $users->territory_code }}</div>
                <input type="hidden" id="territory_id" name="territory_id" value="{{ $users->territory_id }}">
            </div>

            <div class="col-md-6 detail-group">
                <label for="distributor">Distributor</label>
                <div id="distributor">{{ $users->name }}</div>
                <input type="hidden" id="distributor_id" name="distributor_id" value="{{ $users->user_id }}">
            </div>

            <div class="col-md-6 detail-group">
                <label for="date">Today's Date</label>
                <div id="date">{{ \Carbon\Carbon::now()->format('Y-m-d') }}</div>
                <input type="hidden" id="date_value" name="date_value" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>

            <div class="col-md-6 detail-group">
                <label for="po_no">PO No</label>
                <div id="po_number">{{ $po_number }}</div>
                <input type="hidden" id="po_num_value" name="po_num_value" value="{{ $po_number }}">
            </div>

            <div class="col-md-6 detail-group">
                <label for="remarks">Remarks</label>
                <textarea id="remarks_value" name="remarks_value" rows="4" placeholder="Enter your remarks here..."></textarea>
            </div>
        </div>
    </div>

    <div class="container">
        <form id="purchaseOrderForm">
            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                        <th scope="col">SKU CODE</th>
                        <th scope="col">SKU NAME</th>
                        <th scope="col">UNIT PRICE</th>
                        <th scope="col">AVB QTY</th>
                        <th scope="col">ENTER QTY</th>
                        <th scope="col">TOTAL PRICE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="sku_code[]" value="{{ $product->sku_code }}" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="sku_name[]" value="{{ $product->sku_name }}" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control unit-price" name="unit_price[]" value="{{ $product->distributor_price }}" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="available_quantity[]" value="{{ $product->qty }}" readonly>
                        </td>
                        <td>
                            <input type="number" class="form-control enter-quantity" name="enter_quantity[]" value="0" oninput="calculateTotalPrice(this)">
                        </td>
                        <td>
                            <input type="text" class="form-control total-price" name="total_price[]" value="0" readonly>
                        </td>
                        <td>
                            <input type="hidden" name="product_id[]" value="{{ $product->id }}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="container">
                <button type="submit" class="btn btn-success">ADD PO</button>
            </div>
        </form>

        <input type="hidden" id="net_amount" name="net_amount" value="0">

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz4fnFO9gybBogGz1A3g8rK3ntk5ZPVQbnP9ep9JTVp5+7VwXU5RSYQGh+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-QF1U6jNA10z40mNudbW1Bqi3kkX1p7J4zI4E1mUpL7wqGVk6RJIFcGfIOMbFA58k" crossorigin="anonymous"></script>

    <script>

        function calculateTotalPrice(element) {
            var enterQuantity = element.value;
            var row = element.closest('tr');
            var unitPrice = row.querySelector('.unit-price').value;
            var totalPriceField = row.querySelector('.total-price');
            var totalPrice = enterQuantity * unitPrice;
            totalPriceField.value = totalPrice.toFixed(2);

            updateNetAmount();
        }


        function updateNetAmount() {
            var totalPrices = document.querySelectorAll('.total-price');
            var netAmount = 0;
            totalPrices.forEach(function(priceField) {
                netAmount += parseFloat(priceField.value) || 0;
            });
            document.getElementById('net_amount').value = netAmount.toFixed(2);
        }


        document.getElementById('purchaseOrderForm').addEventListener('submit', function(event) {
            event.preventDefault();


            console.log(document.getElementById('distributor_id').value); // Should log the distributor ID
            console.log(document.getElementById('po_number').value); // Should log the PO number


            var formData = new FormData(this);
            var entries = formData.entries();
            var productData = [];

            var productIds = formData.getAll('product_id[]');
            var enterQuantities = formData.getAll('enter_quantity[]');

            // Filter out rows with quantity < 1
            for (let i = 0; i < enterQuantities.length; i++) {
                if (parseInt(enterQuantities[i]) >= 1) {
                    productData.push({
                        product_id: productIds[i],
                        quantity: enterQuantities[i]
                    });
                }
            }

            var finalData = new FormData();
            finalData.append('distributor_id', document.getElementById('distributor_id').value);
            finalData.append('po_number', document.getElementById('po_num_value').value);
            finalData.append('remarks', document.getElementById('remarks_value').value);
            finalData.append('net_amount', document.getElementById('net_amount').value);
            finalData.append('products', JSON.stringify(productData));

            fetch('/purchaseorder/store', {
                method: 'POST',
                body: finalData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {

                console.log(data);
                window.location.href = '/purchaseorder/view'
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>

</body>
</html>
