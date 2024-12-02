@extends('admin.component.main')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create promotion</h2>             
        </div>         
    </div>

    <a href="{{ url()->previous() }}" class="btn btn-primary mt20">Back</a>
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="container">
                @if($errors->has('products'))
                    <div class="alert alert-danger">
                        {{ $errors->first('products') }}
                    </div>
                @endif
                <form action="{{ route('promotions.store') }}" method="POST">
                    @csrf
                    <div class="mb-3 mt20">
                        <label for="name">Program Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3 mt20">
                        <label for="start_date">Start date</label>
                        <input type="datetime-local" name="start_date" class="form-control" required>
                    </div>
                    <div class="mb-3 mt20">
                        <label for="end_date">End date</label>
                        <input type="datetime-local" name="end_date" class="form-control" required>
                    </div>
                    <div class="mb-3 mt20">
                        <label for="products">Select products for promotion</label>
                        <div class="product-list-horizontal" style="max-width: 100%; overflow-x: auto; white-space: nowrap; border: 1px solid #ddd; padding: 10px; border-radius: 8px;">
                            @foreach($products as $product)
                                <div class="product-item-horizontal d-inline-block text-center me-3" style="width: 150px;">
                                    <img 
                                        src="{{ $product->thumb }}" 
                                        alt="{{ $product->name }}" 
                                        style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px; margin-bottom: 5px;"
                                    >
                                    <div>{{ $product->name }}</div>
                                    <div>${{ $product->price }}</div>
                                    <input type="checkbox" name="products[{{ $product->id }}][selected]" value="1">
                                    <input 
                                        type="number" 
                                        step="0.01" 
                                        name="products[{{ $product->id }}][discount_price]" 
                                        placeholder="Enter new value"
                                        class="form-control mt-2"
                                    >
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt20">Create</button>
                </form>
            </div>
        </div>     
    </div>
@endsection()

