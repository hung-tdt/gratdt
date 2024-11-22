@extends('admin.component.main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>{{ $title }}</h2>             
    </div>         
</div>

<div class="ibox-content mt20">               
    <form id="update-form">
        <table style="margin-top:10px;" class="tbf table table-bordered mg10">
            <thead>
                <tr>                                   
                    <th>Category code</th>
                    <th>Category name</th>
                    <th>Describe</th>
                    <th>Show in Catalog sidebar list</th>
                    <th>Show products in homepage</th>        
                </tr>                       
            </thead>
            <tbody>
                @foreach($productCategories as $productCategory) 
                <tr>
                    <td>{{ $productCategory->id }}</td>                                    
                    <td>{{ $productCategory->name }}</td>
                    <td>{{ $productCategory->description }}</td>
                    <td style="text-align: center">
                        <input type="checkbox" name="categories[{{ $productCategory->id }}][active]" class="toggle-active" {{ $productCategory->active ? 'checked' : '' }}>
                    </td>   
                    <td style="text-align: center">
                        <input type="checkbox" name="categories[{{ $productCategory->id }}][showhome]" class="toggle-showhome" {{ $productCategory->showhome ? 'checked' : '' }}>
                    </td>   
                </tr>
                @endforeach               
            </tbody>           
        </table>     
        <button type="button" id="update-button" class="btn btn-primary">Update</button>   
    </form>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/admin/js/homepages/showcatalog.js"></script>