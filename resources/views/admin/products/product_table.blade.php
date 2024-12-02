<thead>
    <tr>
        <th width='150px'>Code</th>
        <th>Name</th>
        <th>Catalog</th>
        <th>Image</th>
        <th>Price</th>
        <th width='320px'>Quantity</th>
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
        <td>{{ $product->price }}</td>                                    
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