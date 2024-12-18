@extends('admin.component.main')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Employee list </h2>             
        </div>         
    </div>

    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label" for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label" for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label" for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="email">Email</label>
                        <input type="text" id="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label" for="role">Role</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="">Chưa chọn</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" id="searchBtn"> <i class="fa fa-search"></i> Search</button>
                <button type="button" class="btn btn-w-m btn-default" id="resetBtn"> <i class="fa fa-refresh"></i> Reset</button>
            </div>
        </div>
                     
        <div class="ibox-content">     
            <button style="margin-left: 0px;" type="button" class="btn btn btn-primary"> <i class="fa fa-plus"></i>
                <a class="font-white" href="{{ route('admins.create') }}"> Create</a>
            </button>              
            <table id="adminTable" style="margin-top:10px;" class="tbf table table-bordered"> 
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
                    @foreach($admins as $key => $admin) 

                    <tr>
                        <td>{{ $admin->name }}</td>                                    
                        <td>{{ $admin->username }}</td>
                        <td><a href="{{ $admin->thumb }}" target="_blank">
                            <img src="{{ $admin->thumb }}" height="30px"></a>
                        </td>
                        <td>{{ $admin->role->name }}</td>
                        <td>{{ $admin->phone }}</td>
                        <td>{{ $admin->email }}</td>
                        <td style="text-align: center">{!! \App\Helpers\Helper::status($admin->status) !!}</td>   
                        <td>                    
                            <div class="button-row1">                       
                                <a style="margin: 1px" class="btn btn-success dim" 
                                    href="{{ route('admins.edit', ['id' => $admin->id]) }}">
                                    <i class="fa fa-edit (alias)"></i>
                                </a>    
                                <a style="margin: 1px" class="btn btn-danger  dim " href="#"
                                    onclick="removeRow({{ $admin->id }}, '{{ route('admins.destroy', ['id' => $admin->id]) }}')">
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
@endsection()

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/admin/search/admin.js"></script>