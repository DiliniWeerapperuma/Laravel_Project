{{-- <!-- @if(count($stock_products)>0)
@foreach ($stock_products as $stp) --> --}}
<div class="card">
    <div class="card-body">
        <table class="table table-bordered first">
            <thead class="thead-custom">
                <tr>
                    <th style="text-align: center"><input type="checkbox" id="selectAll" /></th>
                    <th style="text-align: center">Region</th>
                    <th style="text-align: center">Territory</th>
                    <th style="text-align: center">Distributor</th>
                    <th style="text-align: center">PO Number</th>
                    <th style="text-align: center">Date</th>
                    <th style="text-align: center">Time</th>
                    <th style="text-align: center">Total Amount</th>
                    <th style="text-align: center">View PO</th>
                    <th style="text-align: center">PRINT</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $data1 )

                <tr>
                    <td><input type="checkbox" name="select_item" value="{{ $data1->po_id }}" /></td>
                    <td>{{$data1->region}}</td>
                    <td>{{$data1->territory}}</td>
                    <td>{{$data1->dis}}</td>
                    <td>{{$data1->po_number}}</td>
                    <td>{{$data1->date}}</td>
                    <td>{{$data1->time}}</td>
                    <td>{{$data1->amount}}</td>
                    <td><a button type="button" class="btn btn-success" href="{{ route('purchaseorder.show', $data1->po_id) }}"> VIEW </button></td>
                    <td><a button type="button" class="btn btn-success" href="{{ route('purchaseorder.pdf', $data1->po_id) }}"> Print </button></td>


                </tr>
                @endforeach


            </tbody>
        </table>
    </div>
</div>
{{-- <!-- @endforeach
@else
@endif --> --}}



