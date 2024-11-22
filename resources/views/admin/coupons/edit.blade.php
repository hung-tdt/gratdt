@extends('admin.component.main') 


@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
      <h2>Edit new Coupon</h2>             
  </div>         
</div>

<a href="{{ url()->previous() }}" class="btn btn-primary mt20">Back</a>
<form action="{{ route('coupons.update', ['coupon' => $coupon->id]) }}" method="POST">
    @csrf
  <div class="wrapper wrapper-content animated fadeInRight ecommerce">
      <div class="ibox-content m-b-sm border-bottom">
          <div class="form-group">
              <label for="code">Coupon Code</label>
              <input type="text" value="{{ $coupon->code }}" class="form-control" id="code" name="code" required>
          </div>

          <div class="form-group">
            <label for="discount_type">Discount Type</label>
            <select class="form-control" id="discount_type" name="discount_type" required>
                <option value="0" {{ $coupon->discount_type == '0' ? 'selected' : '' }}>Fixed Amount</option>
                <option value="1" {{ $coupon->discount_type == '1' ? 'selected' : '' }}>Percentage</option>
            </select>
          </div>

          <div class="form-group">
              <label for="discount_value">Discount Value</label>
              <input type="number" value="{{ $coupon->discount_value }}" class="form-control" id="discount_value" name="discount_value" required>
          </div>

          <div class="form-group">
              <label for="max_uses">Max Uses</label>
              <input type="number" value="{{ $coupon->max_uses }}" class="form-control" id="max_uses" name="max_uses">
          </div>

          <div class="form-group">
              <label for="expiry_date">Expiry Date</label>
              <input type="date" value="{{ $coupon->expiry_date }}" class="form-control" id="expiry_date" name="expiry_date">
          </div>

          <div class="col-md-12">
            <!-- radio -->
            <label>Active</label>
            <div class="form-group clearfix">
              <div class="icheck-primary d-inline ml12">
                <input class="mt5" value="1" type="radio" id="radioPrimary1" name="active"
                {{ $coupon->active==1 ? 'checked=""':''}}>
                <label for="radioPrimary1">Yes</label>
              </div>
              <div class="icheck-primary d-inline ml12">
                <input value="0" type="radio" id="radioPrimary2" name="active" 
                {{ $coupon->active==0 ? 'checked=""':''}}>
                <label for="radioPrimary2">No</label>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Update</button>
      </div>
  </div>
</form>
@endsection
