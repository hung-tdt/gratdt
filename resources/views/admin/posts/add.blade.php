@extends('admin.component.main') 

@section('head')
  <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
  <form class="pb40" action="" method="POST">
    <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>{{ $title }}</h2>             
      </div>         
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-primary mt20">Back</a>
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
      <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="post">Title</label>
              <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="nhập tiêu đề">
            </div>                       
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>Category</label>
                <select class="form-control" name="post_category_id">
                
                @foreach($postCategories as $postCategory)
                <option value="{{$postCategory->id}}">{{$postCategory->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="author">Author</label>
              <input type="text" name="author" value="{{ old('author') }}" class="form-control" placeholder="nhập author">
            </div>           
          </div>
         
        </div>                

        <div class="form-group">
            <label for="abstract">Abstract</label>
            <input type="text" name="abstract" value="{{ old('abstract') }}" class="form-control" placeholder="nhập abstract">
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

        <div class="form-group">
          <label>Content</label>
          <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
        </div>
        
      </div>
    </div>

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Create</button>
    </div>
    @csrf
  </form>
@endsection

@section('footer')
    <script>            
        CKEDITOR.replace( 'content' );
    </script>
@endsection