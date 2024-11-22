@extends('admin.component.main') 

@section('head')
  <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')

  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>{{ $title }}</h2>             
    </div>         
  </div>
  <a href="{{ url()->previous() }}" class="btn btn-primary mt20 mb20">Back</a>
  <form action="" method="POST" enctype="multipart/form-data">
      <div class="card-body pb40">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="product">Product name</label>
              <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="nhập tên">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Description</label>
              <input name="description" id="description" value="{{ $product->description }}" class="form-control">
            </div>
          </div>                              
        </div>           

        <div class="row">
          <div class="col-md-3">
            <label for="price">Price</label>
            <div class="input-group mb-3">
              <input class="form-control" type="number" name="price" value="{{ $product->price }}" placeholder="">
            </div>
          </div>
          <div class="col-md-3">
            <label for="price_sale">Price sale</label>
            <div class="input-group mb-3">
              <input class="form-control" type="number" name="price_sale" value="{{ $product->price_sale }}" placeholder="">
            </div>
          </div> 
          
          <div class="col-md-3">
            <label> Product Catalog</label>
              <select class="form-control" name="product_category_id">
                  @foreach($productCategories as $productCategory)
                  <option value="{{$productCategory->id}}" {{ $product->product_category_id == $productCategory->id ? 'selected':''}}>
                        {{$productCategory->name}}</option>
                  @endforeach
              </select>
          </div>   
          <div class="col-md-3">
            <!-- radio -->
            <label>Active</label>
            <div class="form-group clearfix">
              <div class="icheck-primary d-inline ml12">
                <input class="mt5" value="1" type="radio" id="radioPrimary1" name="active"
                {{ $product->active==1 ? 'checked=""':''}}>
                <label for="radioPrimary1">Yes</label>
              </div>
              <div class="icheck-primary d-inline ml12">
                <input value="0" type="radio" id="radioPrimary2" name="active" 
                {{ $product->active==0 ? 'checked=""':''}}>
                <label for="radioPrimary2">No</label>
              </div>
            </div>
          </div>
               
        </div>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="menu">Thumb</label>
              <input type="file" name="thumb" class="form-control" id="upload">
              <div class="mt22" id="image_show">
                  <a href="{{ $product->thumb }}" target="_blank">
                    <img src="{{ $product->thumb }}" alt="" width="200px">
                  </a>
              </div>
              <input type="hidden" name="thumb" value="{{ $product->thumb }}" id="thumb">
            </div>
          </div> 

          <div class="col-md-3">
            <div class="form-group">
              <label for="thumb2">Thumb2</label>
              <input type="file" name="thumb2" class="form-control" id="upload2">
              <div class="mt22" id="image_show2">
                  <a href="{{ $product->thumb2 }}" target="_blank">
                    <img src="{{ $product->thumb2 }}" alt="" width="200px">
                  </a>
              </div>
              <input type="hidden" name="thumb2" value="{{ $product->thumb2 }}" id="thumb2">
            </div>
          </div> 

          <div class="col-md-6">
            <div class="form-group" style="margin-top: 22px">
              <label for="images">Images</label> <br>       
              <input class="form-control" type="file" name="images[]" multiple onchange="previewImages(event.target.files)"><br>
              <div id="image-preview">
                @if($product->images)
                    @foreach($product->images as $image)
                        <img src="{{ url($image) }}" alt="Product Image" style="width : 200px; padding-right : 5px">
                    @endforeach
                @endif
              </div>
            </div>
          </div> 
          
        </div>

        <div class="form-group">
          <label>Content</label>
          <textarea name="content" id="content" class="form-control">{{ $product->content }}</textarea>
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
   
    @csrf
  </form>
@endsection

<script src="/admin/js/image.js"></script>

@section('footer')
    <script>            
        CKEDITOR.replace( 'content' );
    </script>
@endsection