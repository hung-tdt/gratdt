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
          <div class="col-sm-6">
            <div class="form-group">
              <label for="product">Product name</label>
              <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="">
            </div>          
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Description</label>
              <input type="text" name="description" value="{{ old('description') }}" class="form-control">
            </div>
          </div>
        </div>                

        <div class="row">
          <div class="col-sm-2">
            <label for="price">Price</label>
            <div class="input-group mb-3">
              <div class="custom-input-group">
                <input class="form-control" type="number" name="price" value="{{ old('price') }}" placeholder="">
                
              </div>
            </div>
          </div>
           
          <div class="col-sm-3">
            <div class="form-group">
              <label>Catalog</label>
                <select class="form-control" name="product_category_id">            
                @foreach($productCategories as $productCategory)
                <option value="{{$productCategory->id}}">{{$productCategory->name}}</option>
                @endforeach
              </select>
            </div>
          </div>  

          <div class="col-sm-3">
            <!-- radio -->
            <label>Active</label>
            <div class="form-group clearfix">
              <div class="icheck-primary d-inline ml12">
                <input class="mt5" type="radio" value="1" id="radioPrimary1" name="active" checked="">
                <label for="radioPrimary1">Yes</label>
              </div>
              <div class="icheck-primary d-inline ml12">
                <input type="radio" value="0" id="radioPrimary2" name="active">
                <label for="radioPrimary2">No</label>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label for="thumb">Avartar</label>
              <input type="file" name="thumb" class="form-control" id="upload">
              <div class="mt22" id="image_show">
              </div>
              <input type="hidden" name="thumb" id="thumb">
            </div>
          </div>
          
          <div class="col-sm-3">
            <div class="form-group">
              <label for="thumb2">Avatar 2</label>
              <input type="file" name="thumb2" class="form-control" id="upload2">
              <div class="mt22" id="image_show2">
              </div>
              <input type="hidden" name="thumb2" id="thumb2">
            </div>
          </div> 

          <div class="col-sm-6">
            <div class="form-group">
              <label for="images">Images</label> <br>       
              <input class="form-control" type="file" name="images[]" multiple onchange="previewImages(event.target.files)"><br>
              <div id="image-preview"></div>
            </div>
          </div> 
          
        </div>

        <div class="row">
          <div class="col-sm-12">         
            <div class="form-group">
              <label>Content</label>
              <textarea name="content" id="content">{{ old('content') }}</textarea>
            </div>
          </div>
        </div>
        <input type="hidden" name="sold_count" value="0">
        <input type="hidden" name="quantity" value="0">

      <div class="card-footer">
          <button type="submit" class="btn btn-primary">Continute</button>
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