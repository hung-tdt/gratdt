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
          <div class="col-md-6">
              <div class="form-group">
                <label for="post">Title</label>
                <input type="text" name="title" value="{{ $post->title }}" class="form-control" placeholder="nhập tiêu đề">
              </div>                   
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Category</label>
                <select class="form-control" name="post_category_id">
                
                @foreach($postCategories as $postCategory)
                <option value="{{$postCategory->id}}">{{$postCategory->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>                

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="author">Author</label>
              <input type="text" name="author" value="{{ $post->author }}" class="form-control" placeholder="nhập author">
            </div>
          </div>
          
        </div>
      
        <div class="form-group">
          <label for="abstract">Abstract</label>
          <input type="text" name="abstract" value="{{ $post->abstract }}" class="form-control" placeholder="nhập abstract">
        </div>
          
        <div class="form-group">
          <label for="post">Image</label>
          <input type="file" name="thumb" class="form-control" id="upload">
          <div id="image_show">
              <a href="{{ $post->thumb }}" target="_blank">
                <img src="{{ $post->thumb }}" alt="" width="200px">
              </a>
          </div>
          <input type="hidden" name="thumb" value="{{ $post->thumb }}" id="thumb">
        </div>

        <div class="form-group">
              <label>Content</label>
              <textarea name="content" id="content" class="form-control">{{ $post->content }}</textarea>
        </div>
        
        <div class="form-group">
          <label>Active</label>   
          <div class="custom-control custom-radio">
            <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                {{ $post->active==1 ? 'checked=""':''}}>
            <label for="active" class="custom-control-label">Có</label>
          </div>
          <div class="custom-control custom-radio">
            <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" 
                {{ $post->active==0 ? 'checked=""':''}}>
            <label for="no_active" class="custom-control-label">Không</label>
          </div>
                
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
    @csrf
  </form>
@endsection

@section('footer')
    <script>             
        CKEDITOR.replace( 'content' );
    </script>
@endsection