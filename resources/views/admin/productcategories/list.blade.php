@extends('admin.component.main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>{{ $title }}</h2>             
    </div>         
  </div>

    <button type="button" class="btn btn btn-primary mt20 ml0"> <i class="fa fa-plus"></i>
        <a class="font-white" href="{{ route('product_categories.add') }}"> Add new product category</a>
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
                
                @foreach($productCategories as $productCategory) 

                <tr>
                    <td>{{ $productCategory->id }}</td>                                    
                    <td>{{ $productCategory->name }}</td>
                    <td>{{ $productCategory->description }}</td>
                    <td style="text-align: center">{!! \App\Helpers\Helper::active($productCategory->active) !!}</td>   
                    <td>                    
                        <div class="button-row1">                       
                            <a style="margin: 1px" class="btn btn-success dim" 
                                href="{{ route('product_categories.edit', ['productCategory' => $productCategory->id]) }}">
                                <i class="fa fa-edit (alias)"></i>
                            </a>    
                            <a style="margin: 1px" class="btn btn-danger  dim " href="#"
                                onclick="removeRow({{ $productCategory->id }}, '{{ route('product_categories.destroy', ['productCategory' => $productCategory->id]) }}')">
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
