@extends('admin.component.main') 

@section('content')

  <form action="{{ route('sliders.store') }}" method="POST">
    <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>{{ $title }}</h2>             
      </div>         
    </div>
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
      <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="slider">Title</label>
              <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="nhập tên">
            </div>             
          </div>
    
        </div>                
        <div class="col-md-4">
          <div class="form-group">
            <label for="menu">Image</label>
            <input type="file" name="thumb" class="form-control" id="upload">
            <div class="mt22" id="image_show">
            </div>
            <input type="hidden" name="thumb" id="thumb">
          </div>     
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

        <div class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </div>
      </div>
    </div>

    @csrf
  </form>
@endsection
