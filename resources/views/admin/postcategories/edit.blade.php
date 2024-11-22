@extends('admin.component.main') 


@section('content')
  <form action="" method="POST">
    <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>{{ $title }}</h2>             
      </div>         
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-primary mt20">Back</a>
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
      <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="postCategory">Category name</label>
                <input type="text" name="name" value="{{ $postCategory->name }}" class="form-control" placeholder="nhập tên">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="parent_id">
                    <option value="0" {{ $postCategory->parent_id == 0 ? 'selected' : '' }} >
                        Parent category
                    </option>
                    @foreach($postCategories as $postCategoryParent)
                    <option value="{{$postCategory->id}}"
                        {{$postCategory->parent_id == $postCategoryParent->id ? 'selected' : ''}}>
                        {{$postCategoryParent->name}}

                    </option>
                    @endforeach
                </select>
              </div>
            </div>
        </div>

        <div class="form-group">
          <label>Describe</label>
          <textarea name="description" id="description" class="form-control">{{ $postCategory->description}}</textarea>
        </div>
              
        <div class="form-group">
        <label>Active</label>   
          <div class="custom-control custom-radio">
            <input class="custom-control-input" value="1" type="radio" id="active" 
                  name="active" {{ $postCategory->active ==1 ? 'checked=""' :''}}>
            <label for="active" class="custom-control-label">Yes</label>
          </div>
          <div class="custom-control custom-radio">
            <input class="custom-control-input" value="0" type="radio" id="no_active" 
                name="active" {{ $postCategory->active ==0 ? 'checked=""' :''}}>
            <label for="no_active" class="custom-control-label">No</label>
          </div>
                
        </div>
        
      </div>
    </div>             
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
    @csrf
  </form>
@endsection

