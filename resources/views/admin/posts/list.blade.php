@extends('admin.component.main')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>List of posts </h2>             
    </div>         
</div>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="control-label" for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="control-label" for="abstract">Abstract</label>
                    <input type="text" id="abstract" name="abstract" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="author">Author</label>
                    <input type="text" id="author" name="author" class="form-control">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Danh mục</label>
                    <select name="post_category_id" id="post_category_id" class="form-control">
                        <option value="">Chưa chọn</option>
                        @foreach($postCategories as $postCategory)
                        <option value="{{$postCategory->id}}">{{$postCategory->name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="searchBtn"> <i class="fa fa-search"></i> Search</button>
            <button type="button" class="btn btn-w-m btn-default" id="resetBtn"> <i class="fa fa-refresh"></i> Reset</button>
        </div>

        <button style="margin-left: 0px;" type="button" class="btn btn btn-primary mt20 ml0"> <i class="fa fa-plus"></i>
            <a class="font-white" href="{{ route('posts.add') }}"> Create post</a>
        </button> 

        <table id="postTable" class="tbf table mg10 mt20">
            <thead>
                <tr>
                    <th width='120px'>Post code</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Image</th>
                    <th>Active</th>
                    <th>Created date</th>              
                    <th width='120px'>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $key => $post) 

                <tr>
                    <td>{{ $post->id }}</td>                                    
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->postCategory->name }}</td>
                    <td>{{ $post->author }}</td>
                    <td><a href="{{ $post->thumb }}" target="_blank">
                        <img src="{{ $post->thumb }}" height="60px"></a>
                    </td>
                    <td style="text-align: center">{!! \App\Helpers\Helper::active($post->active) !!}</td>  
                    <td>{{ $post->created_at }}</td>
                    <td>                    
                        <div class="button-row1">                       
                            <a style="margin: 1px" class="btn btn-success dim" 
                                href="{{ route('posts.edit', ['post' => $post->id]) }}">
                                <i class="fa fa-edit (alias)"></i>
                            </a>    
                            <a style="margin: 1px" class="btn btn-danger  dim " href="#"
                                onclick="removeRow({{ $post->id }}, '{{ route('posts.destroy', ['post' => $post->id]) }}')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>  
                    </td>
                </tr>
                @endforeach               
            </tbody>      
        </table>
    </div>    
</div>
<div class="pro-pagination">
    {{ $posts->links('pagination::bootstrap-4') }}
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/admin/search/post.js"></script>