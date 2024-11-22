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
            <input type="text" name="name" value="{{ $productCategory->name }}" class="form-control" placeholder="nhập tên">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="parent_id">
                <option value="0" {{ $productCategory->parent_id == 0 ? 'selected' : '' }} >
                    Parent category
                </option>
                @foreach($productCategories as $productCategoryParent)
                <option value="{{$productCategoryParent->id}}"
                    {{$productCategory->parent_id == $productCategoryParent->id ? 'selected' : ''}}>
                    {{$productCategoryParent->name}}

                </option>
                @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="productCategory">Image</label>
        <input type="file" name="thumb" class="form-control" id="upload">
        <div id="image_show">
            <a href="{{ $productCategory->thumb }}" target="_blank">
              <img src="{{ $productCategory->thumb }}" alt="" width="200px">
            </a>
        </div>
        <input type="hidden" name="thumb" value="{{ $productCategory->thumb }}" id="thumb">
      </div>

      <div class="form-group">
        <label>Describe</label>
        <textarea name="description" id="description" class="form-control">{{ $productCategory->description}}</textarea>
      </div>
            
      <div class="form-group">
        <label>Active</label>   
          <div class="custom-control custom-radio">
            <input class="custom-control-input" value="1" type="radio" id="active" 
                  name="active" {{ $productCategory->active ==1 ? 'checked=""' :''}}>
            <label for="active" class="custom-control-label">Yes</label>
          </div>
          <div class="custom-control custom-radio">
            <input class="custom-control-input" value="0" type="radio" id="no_active" 
                name="active" {{ $productCategory->active ==0 ? 'checked=""' :''}}>
            <label for="no_active" class="custom-control-label">No</label>
          </div>           
      </div>

      <div class="form-group">
        <label>Show home</label>   
          <div class="custom-control custom-radio">
            <input class="custom-control-input" value="1" type="radio" id="active" 
                  name="showhome" {{ $productCategory->showhome ==1 ? 'checked=""' :''}}>
            <label for="active" class="custom-control-label">Yes</label>
          </div>
          <div class="custom-control custom-radio">
            <input class="custom-control-input" value="0" type="radio" id="no_active" 
                name="showhome" {{ $productCategory->showhome ==0 ? 'checked=""' :''}}>
            <label for="no_active" class="custom-control-label">No</label>
          </div>           
      </div>

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </div>
    @csrf
  </form>
@endsection
