@extends('admin.component.main')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Customer List</h2>             
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
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label" for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
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
                
                <button type="button" class="btn btn-primary" id="searchBtn"> <i class="fa fa-search"></i> Search</button>
                <button type="button" class="btn btn-w-m btn-default" id="resetBtn"> <i class="fa fa-refresh"></i> Reset</button>
            </div>
        </div>

                        
            <div class="ibox-content">
                <button style="margin-left: 0px;" type="button" class="btn btn btn-primary"> <i class="fa fa-plus"></i>
                    <a class="font-white" href="{{ route('customers.create') }}"> Create</a>
                </button>

                <table id="customerTable" class="tbf footable table table-stripped toggle-arrow-tiny default breakpoint footable-loaded" data-page-size="15">
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
                </table>        
            </div>    
    </div>
@endsection()

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/admin/search/customer.js"></script>