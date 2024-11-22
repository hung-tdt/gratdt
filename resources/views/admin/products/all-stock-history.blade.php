@extends('admin.component.main') 


@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Stock History</h2>             
        </div>         
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-primary mt20">Back</a>
  
    <div class="card-body mt50">

        @if($stockEntries->isEmpty())
            <p class="text-center">No stock entries available.</p>
        @else
            <table class="table table-bordered mt20">
                <thead class="thead-dark mt20">
                    <tr>
                        <th class="text-center">Product code</th>
                        <th class="text-center">Product Name</th>
                        <th class="text-center">Quantity Added</th>
                        <th class="text-center">Import Price</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stockEntries as $entry)
                        <tr>
                            <td class="text-center">{{ $entry->product->id }}</td>
                            <td class="text-center">{{ $entry->product->name }}</td>
                            <td class="text-center">{{ $entry->quantity_added }}</td>
                            <td class="text-center">${{ $entry->import_price }}</td>
                            <td class="text-center">${{ $entry->total }}</td>
                            <td class="text-center">{{ $entry->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <div class="pro-pagination">
        {{ $stockEntries->links('pagination::bootstrap-4') }}
    </div>

@endsection

