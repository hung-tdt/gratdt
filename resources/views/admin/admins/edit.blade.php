@extends('admin.component.main')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>{{ $title }}</h2>             
                </div>         
    </div>

    <a href="{{ url()->previous() }}" class="btn btn-primary mt20">Back</a>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                    <div class="row">                   
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="name">Employee Name</label>
                                <input type="text" id="name" name="name" value="{{ $admin->name }}" placeholder="" class="form-control">
                            </div>
                        </div> 

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" id="username" name="username" value="{{ $admin->username }}" placeholder="" class="form-control">
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="role">Role</label>
                                <select name="role_id" class="form-control">
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}" {{ $admin->role_id == $role->id ? 'selected':''}}>
                                        {{$role->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="pasword">Pasword</label>
                                <input type="password" name="password" value="" placeholder="" class="form-control">
                            </div>
                        </div>                  
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="password_confirmation">Confirm pasword</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" value="" placeholder="" class="form-control">
                            </div>
                        </div>  
                    </div>

                    <div class="row"> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="phone">Phone</label>
                                <input type="text" id="phone" name="phone" value="{{ $admin->phone }}" placeholder="" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="email">Email</label>
                                <input type="text" id="email" name="email" value="{{ $admin->email }}" placeholder="" class="form-control">
                            </div>
                        </div> 
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="thumb">Avatar</label>
                                <input type="file" name="thumb" class="form-control" id="upload">
                                <div class="mt22" id="image_show">
                                    <a href="{{ $admin->thumb }}" target="_blank">
                                    <img src="{{ $admin->thumb }}" alt="" width="200px">
                                    </a>
                                </div>
                                <input type="hidden" name="thumb" value="{{ $admin->thumb }}" id="thumb">
                            </div>
                        </div>                    
                    </div>

                    <label class="control-label">Your address</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select name="province_id" id="province" class="form-control" required>
                                    <option value="">Select Province/City</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->id }}" {{ $province->id == $admin->province_id ? 'selected' : '' }}>{{ $province->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select name="district_id" id="district" class="form-control" required>
                                    <option value="">Select district</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}" {{ $district->id == $admin->district_id ? 'selected' : '' }}>{{ $district->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select name="ward_id" id="ward" class="form-control" required>
                                    <option value="">Select Ward</option>
                                    @foreach($wards as $ward)
                                        <option value="{{ $ward->id }}" {{ $ward->id == $admin->ward_id ? 'selected' : '' }}>{{ $ward->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">                     
                                <input type="text" name="address" value="{{ $admin->address }}" placeholder="Enter specific address" class="form-control">
                            </div>
                        </div>  
                    </div>      

                    <div class="form-group">
                        <label>Status</label>   
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="1" type="radio" id="status" 
                                  name="status" {{ $admin->status ==1 ? 'checked=""' :''}}>
                            <label for="status" class="custom-control-label">Yes</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="0" type="radio" id="no_status" 
                                name="status" {{ $admin->status ==0 ? 'checked=""' :''}}>
                            <label for="no_status" class="custom-control-label">No</label>
                          </div>           
                        </div>
                    </div>   

                    <button style="margin-left: 0px;" type="submit" class="btn btn btn-primary"> 
                        <i class="fa fa-check"></i> Submit
                    </button> 
            </div>     
        </div>
        @csrf
    </form>
@endsection()

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/admin/js/addressadmin/addressedit.js"></script>