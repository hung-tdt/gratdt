@extends('admin.component.main')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ $title }}</h2>             
        </div>         
    </div>

    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row mt20">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label" for="title">Product code</label>
                        <input type="text" id="id" name="id" class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label" for="abstract">Product name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label" for="quantity_min">Quantity Min</label>
                        <input type="text" id="quantity_min" name="quantity_min" class="form-control">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label" for="quantity_max">Quantity Max</label>
                        <input type="text" id="quantity_max" name="quantity_max" class="form-control">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Catalog</label>
                        <select name="product_category_id" id="product_category_id" class="form-control">
                            <option value="">Not selected</option>
                            @foreach($productCategories as $productCategory)
                            <option value="{{$productCategory->id}}">{{$productCategory->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" id="searchBtn"> <i class="fa fa-search"></i> Search</button>
                <button type="button" class="btn btn-w-m btn-default" id="resetBtn"> <i class="fa fa-refresh"></i> Reset</button>
            </div>
        </div>
        <div class="ibox-content"> 
            <button style="margin-left: 0px;" type="button" class="btn btn btn-primary mt20 ml0"> <i class="fa fa-plus"></i>
                <a class="font-white" href="{{ route('products.add') }}"> Add product</a>
            </button>

            <table id="productTable" class="tbf table mg10 mt20">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Catalog</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Price sale</th>
                        <th width='320px'>Quantity</th>
                        <th>Sold</th>              
                        <th>Active</th>              
                        <th width='120px'>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product) 

                    <tr>
                        <td>{{ $product->id }}</td>                                    
                        <td>{{ $product->name }}</td>                                    
                        <td>{{ $product->productCategory->name }}</td>                                                                       
                        <td><a href="{{ $product->thumb }}" target="_blank">
                            <img src="{{ $product->thumb }}" height="40px"></a>
                        </td>
                        <td>${{ $product->price }}</td>                                    
                        <td>${{ $product->price_sale }}</td> 
                        <td>{{ $product->quantity }} 
                            <div class="icon-add-quantity">
                                <i class="fa fa-plus"></i>
                                <a class="font-white" href="{{ route('products.addStock', ['product' => $product->id]) }}">
                                    Add quantity
                                </a>
                            </div>

                            <div class="icon-add-quantity">
                                <a class="font-white" href="{{ route('products.stockHistory', ['product' => $product->id]) }}">
                                    View Stock History
                                </a>
                            </div>
                            
                        </td> 
                        <td>{{ $product->sold_count }}</td> 
                        <td style="text-align: center">{!! \App\Helpers\Helper::active($product->active) !!}</td>   
                        <td>                    
                            <div class="button-row1">                       
                                <a style="margin: 1px" class="btn btn-success dim" 
                                    href="{{ route('products.edit', ['product' => $product->id]) }}">
                                    <i class="fa fa-edit (alias)"></i>
                                </a>    
                                <a style="margin: 1px" class="btn btn-danger  dim " href="#"
                                    onclick="removeRow({{ $product->id }}, '{{ route('products.destroy', ['product' => $product->id]) }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>  
                        </td>
                    </tr>
                    @endforeach               
                </tbody>      
            </table>
        </div>
        
        <div class="pro-pagination">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
          
    </div>
    
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/admin/search/product.js"></script>