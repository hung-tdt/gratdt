

<thead>
    <tr>                                   
        <th>Name</th>
        <th>UserName</th>
        <th>Avatar</th>
        <th>Role</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Status</th>
        <th>Action</th>        
    </tr>                       
</thead>
<tbody>
    @foreach($admins as $admin)
    <tr>
        <td>{{ $admin->name }}</td>
        <td>{{ $admin->username }}</td>
        <td><img src="{{ $admin->thumb }}" height="30px"></td>
        <td>{{ $admin->roles->name }}</td>
        <td>{{ $admin->phone }}</td>
        <td>{{ $admin->email }}</td>
        <td style="text-align: center">{!! \App\Helpers\Helper::status($admin->status) !!}</td>
        <td>
            <div class="button-row1">
                <a class="btn btn-success" href="{{ route('admins.edit', ['id' => $admin->id]) }}">
                    <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-danger" href="#" onclick="removeRow({{ $admin->id }}, '{{ route('admins.destroy', ['id' => $admin->id]) }}')">
                    <i class="fa fa-trash"></i>
                </a>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
    
            