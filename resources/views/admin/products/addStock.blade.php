@extends('admin.component.main') 


@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ $title }}</h2>             
        </div>         
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-primary mt50">Back</a>
    <form action="{{ route('products.storeStock', $product->id) }}" method="POST">
    @csrf
    <div class="card-body mt50 pb40">

        <div class="row ml10">
            <div class="col-md-2">
                <div class="form-group">
                  <label for="product">Product code</label>
                  <input type="text" name="id" value="{{ $product->id }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="product">Product code</label>
                <input type="text" name="price" value="{{ $product->price }}" class="form-control" disabled>
              </div>
          </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="product">Name</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control" disabled>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Description</label>
                <input name="description" id="description" value="{{ $product->description }}" class="form-control" disabled>
              </div>
            </div>                              
        </div> 

        <div class="row ml10">
            <div class="col-md-3 mt50">
                <div class="form-group">
                    <label for="menu">Thumb</label>
                    <div id="image_show">
                        <a href="{{ $product->thumb }}" target="_blank">
                        <img src="{{ $product->thumb }}" alt="" width="140px">
                        </a>
                    </div>
                </div>
            </div> 
            <div class="col-md-6 mt50">
              <div class="form-group">
                <label for="images">Images</label> <br>       
               
                <div id="image-preview">
                  @if($product->images)
                      @foreach($product->images as $image)
                          <img src="{{ url($image) }}" alt="Product Image" style="width : 140px">
                      @endforeach
                  @endif
                </div>
              </div>
            </div> 
        </div>
        <div class="row mt50 ml20">
            <div class="input-group mb-3">
                <label for="quantity">Quantity:</label>
                <input class="form-control" type="number" name="quantity" id="quantity" required>               
            </div>   
            
            <div class="input-group mb-3">
              <label for="import_price">Import_price:</label>
              <input class="form-control" type="number" name="import_price" id="import_price" required>               
          </div> 
        </div>

        <button type="submit" class="btn btn btn-primary mt20 ml0 ml20"> <i class="fa fa-plus"></i>
             Add Stock
        </button>
    </div>

    </form>
@endsection

