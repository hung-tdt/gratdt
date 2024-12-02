@extends('admin.component.main') 

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add new Coupon</h2>             
    </div>         
</div>

<a href="{{ url()->previous() }}" class="btn btn-primary mt20">Back</a>
  <form action="{{ route('coupons.store') }}" method="POST">
      @csrf
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="form-group">
                <label for="code">Coupon name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="code">Coupon Code</label>
                <input type="text" class="form-control" id="code" name="code" required>
            </div>

            <div class="form-group">
                <label for="discount_type">Discount Type</label>
                <select class="form-control" id="discount_type" name="discount_type" required>
                    <option value="0">Fixed Amount</option>
                    <option value="1">Percentage</option>
                </select>
            </div>

            <div class="form-group">
                <label for="discount_value">Discount Value</label>
                <input type="number" class="form-control" id="discount_value" name="discount_value" required>
            </div>

            <div class="form-group">
                <label for="max_uses">Max Uses</label>
                <input type="number" class="form-control" id="max_uses" name="max_uses">
            </div>

            <div class="col-sm-12">
                <!-- radio -->
                <label>Active</label>
                <div class="form-group clearfix">
                  <div class="icheck-primary d-inline ml12">
                    <input class="mt5" type="radio" value="1" id="radioPrimary1" name="active" checked="">
                    <label for="radioPrimary1">Yes</label>
                  </div>
                  <div class="icheck-primary d-inline ml12">
                    <input type="radio" value="0" id="radioPrimary2" name="active">
                    <label for="radioPrimary2">No</label>
                  </div>
                </div>
            </div>

            <div class="col-sm-12">
                <!-- radio -->
                <label>For user is special</label>
                <div class="form-group clearfix">
                  <div class="icheck-primary d-inline ml12">
                    <input class="mt5" type="radio" value="1" id="radioPrimary3" name="forspecial" checked="">
                    <label for="radioPrimary1">Yes</label>
                  </div>
                  <div class="icheck-primary d-inline ml12">
                    <input type="radio" value="0" id="radioPrimary4" name="forspecial">
                    <label for="radioPrimary2">No</label>
                  </div>
                </div>
            </div>

            <div class="form-group">
                <label for="expiry_date">Expiry Date</label>
                <input type="date" class="form-control" id="expiry_date" name="expiry_date">
            </div>

            <button type="submit" class="btn btn-primary">Create Coupon</button>
        </div>
    </div>
  </form>

@endsection
