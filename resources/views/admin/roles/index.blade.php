@extends('admin.component.main')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ $title }}</h2>             
        </div>         
    </div>
    <button type="button" class="btn btn btn-primary mt20 ml0"> <i class="fa fa-plus"></i>
        <a class="font-white" href="{{ route('roles.create') }}"> Add roles</a>
    </button>
    <table class="table table-bordered mt20" style="width: 50%;">
        <thead>
            <tr>
                <th width='100px'>Role code</th>
                <th>Role name</th>
                <th>Describe</th>             
                <th width='100px'>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $key => $role) 
            <tr>
                
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->description }}</td>
                <td>
                   <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', ['id' => $role->id]) }}">                      
                    <i class="fa fa-edit (alias)"></i>
                   </a>

                   <a href="#" class="btn btn-danger btn-sm" 
                   onclick="removeRow({{ $role->id }}, '{{ route('roles.destroy', ['id' => $role->id]) }}')">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
                
             </tr>
             @endforeach
       
        </tbody>
    </table>
    {{ $roles->links() }}
@endsection