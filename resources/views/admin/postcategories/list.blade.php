@extends('admin.component.main')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>List of post categories </h2>             
        </div>         
    </div>

    <button type="button" class="btn btn btn-primary mt20 ml0"> <i class="fa fa-plus"></i>
        <a class="font-white" href="{{ route('post_categories.add') }}"> Add new post category</a>
    </button> 

    <div class="ibox-content mt20">               
        <table style="margin-top:10px;" class="table table-bordered mg10">
            <thead>
                <tr>                                   
                    <th>Category code</th>
                    <th>Category name</th>
                    <th>Describe</th>
                    <th>Active</th>
                    <th class="width150">Action</th>        
                </tr>                       
            </thead>
            <tbody>
                @foreach($postCategories as $key => $postCategory) 

                <tr>
                    <td>{{ $postCategory->id }}</td>                                    
                    <td>{{ $postCategory->name }}</td>
                    <td>{{ $postCategory->description }}</td>
                    <td style="text-align: center">{!! \App\Helpers\Helper::active($postCategory->active) !!}</td>   
                    <td>                    
                        <div class="button-row1">                       
                            <a style="margin: 1px" class="btn btn-success dim" 
                                href="{{ route('post_categories.edit', ['postCategory' => $postCategory->id]) }}">
                                <i class="fa fa-edit (alias)"></i>
                            </a>    
                            <a style="margin: 1px" class="btn btn-danger  dim " href="#"
                                onclick="removeRow({{ $postCategory->id }}, '{{ route('post_categories.destroy', ['postCategory' => $postCategory->id]) }}')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>  
                    </td>
                </tr>
                @endforeach               
            </tbody>           
        </table>        
    </div>
@endsection