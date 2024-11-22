@extends('admin.component.main')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Coupons List </h2>             
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
                <a class="font-white" href="{{ route('coupons.add') }}"> Create</a>
            </button>              
            <table id="couponTable" style="margin-top:10px;" class="tbf table table-bordered"> 
                <thead>
                    <tr>                                   
                        <th>Code</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Max Uses</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                        <th>Actions</th>        
                    </tr>                       
                </thead>
                <tbody>
                    @foreach($coupons as $key => $coupon) 

                    <tr>
                        <td>{{ $coupon->code }}</td>
                        <td>@if($coupon->discount_type == 1)
                            Percentage
                            @elseif($coupon->discount_type == 0)
                                Fixed Amount
                            @endif
                        </td>
                        <td>{{ $coupon->discount_value }}</td>
                        <td>{{ $coupon->max_uses ?? 'Unlimited' }}</td>
                        <td>{{ $coupon->expiry_date ?? 'No Expiry' }}</td>
                        <td>{{ $coupon->active ? 'Active' : 'Inactive' }}</td>
                        <td>                    
                            <div class="button-row1">                       
                                <a style="margin: 1px" class="btn btn-success dim" 
                                    href="{{ route('coupons.edit', ['coupon' => $coupon->id]) }}">
                                    <i class="fa fa-edit (alias)"></i>
                                </a>    
                                <a style="margin: 1px" class="btn btn-danger  dim " href="#"
                                    onclick="removeRow({{ $coupon->id }}, '{{ route('coupons.destroy', ['coupon' => $coupon->id]) }}')">
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

@endsection