@extends('admin.component.main') 

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
      <h2>{{ $title }}</h2>             
  </div>         
</div>
<a href="{{ url()->previous() }}" class="btn btn-primary mt20 mb20">Back</a>

  <form action="" method="POST">
    <div class="card-body pb40">
      <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="productCategory">Category name</label>
              <input type="text" name="name" class="form-control" placeholder="nhập tên">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Category</label>
              <select class="form-control" name="parent_id">
                  <option value="0">
                    Parent category
                  </option>
                  @foreach($productCategories as $productCategory)
                  <option value="{{$productCategory->id}}">{{$productCategory->name}}</option>
                  @endforeach
              </select>
            </div>
          </div>
      </div>

      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            <label for="menu">Image </label>
            <input type="file" name="thumb" class="form-control" id="upload">
            <div class="mt22" id="image_show">
            </div>
            <input type="hidden" name="thumb" id="thumb">
          </div>           
        </div>
      </div>
          
      <div class="form-group">
        <label>Describe</label>
        <textarea name="description" id="description" class="form-control"></textarea>
      </div>
          
      <div class="form-group">
        <label>Active</label>   
        <div class="custom-control custom-radio">
            <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
            <label for="active" class="custom-control-label">Yes</label>
        </div>
        <div class="custom-control custom-radio">
            <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
            <label for="no_active" class="custom-control-label">No</label>
        </div>            
      </div>

      <div class="form-group">
        <label>Show home</label>   
        <div class="custom-control custom-radio">
            <input class="custom-control-input" value="1" type="radio" id="showhome" name="showhome" checked="">
            <label for="showhome" class="custom-control-label">Yes</label>
        </div>
        <div class="custom-control custom-radio">
            <input class="custom-control-input" value="0" type="radio" id="no_active" name="showhome" >
            <label for="showhome" class="custom-control-label">No</label>
        </div>            
      </div>

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </div>
      @csrf
  </form>
@endsection
