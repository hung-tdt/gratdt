<thead>
    <tr>                                                             
        <th>Customer code</th>
        <th>Name</th>
        <th>Username</th>
        <th>Avatar</th>                            
        <th>Phone</th>
        <th>Email</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @foreach($customers as $key => $customer) 

    <tr>
        <td>{{ $customer->id }}</td>                                    
        <td>{{ $customer->name }}</td>                                    
        <td>{{ $customer->username }}</td> 
        <td><a href="{{ $customer->thumb }}" target="_blank">
            <img src="{{ $customer->thumb }}" height="30px"></a>
        </td>                                   
        <td>{{ $customer->phone }}</td>
        <td>{{ $customer->email }}</td>
        <td style="text-align: center">{!! \App\Helpers\Helper::active($customer->active) !!}</td>   
        <td>                    
            <div class="button-row1">                       
                <a style="margin: 1px" class="btn btn-success dim" 
                    href="{{ route('customers.edit', ['id' => $customer->id]) }}">
                    <i class="fa fa-edit (alias)"></i>
                </a>    
                <a style="margin: 1px" class="btn btn-danger  dim " href="#"
                    onclick="removeRow({{ $customer->id }}, '{{ route('customers.destroy', ['id' => $customer->id]) }}')">
                    <i class="fa fa-trash"></i>
                </a>
            </div>  
        </td>
    </tr>
    @endforeach

</tbody>       