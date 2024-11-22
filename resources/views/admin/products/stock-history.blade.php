@extends('admin.component.main') 


@section('content')

    <a href="{{ url()->previous() }}" class="btn btn-primary mt50">Back</a>
  
    <div class="card-body mt50">
        <h1 class="text-center">Stock History for {{ $product->name }}</h1>
    
        @if($stockEntries->isEmpty())
            <p class="text-center">No stock entries available.</p>
        @else
            <table class="table table-bordered">
                <thead class="thead-dark mt20">
                    <tr>
                        <th class="text-center">Quantity Added</th>
                        <th class="text-center">Import Price</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stockEntries as $entry)
                        <tr>
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
    

@endsection

