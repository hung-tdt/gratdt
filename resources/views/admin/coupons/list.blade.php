@extends('admin.component.main')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Coupons List </h2>             
        </div>         
    </div>

    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        
                    
        <div class="ibox-content">     
            <button style="margin-left: 0px;" type="button" class="btn btn btn-primary"> <i class="fa fa-plus"></i>
                <a class="font-white" href="{{ route('coupons.add') }}"> Create</a>
            </button>              
            <table id="couponTable" style="margin-top:10px;" class="tbf table table-bordered"> 
                <thead>
                    <tr>                                   
                        <th>Name</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Max Uses</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                        <th>For special</th>
                        <th>Actions</th>        
                    </tr>                       
                </thead>
                <tbody>
                    @foreach($coupons as $key => $coupon) 

                    <tr>
                        <td>{{ $coupon->name }}</td>
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
                        <td>{{ $coupon->forspecial ? 'Yes' : 'No' }}</td>
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