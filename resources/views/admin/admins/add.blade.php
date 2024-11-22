@extends('admin.component.main')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Create employee</h2>             
                </div>         
    </div>

    <a href="{{ url()->previous() }}" class="btn btn-primary mt20">Back</a>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                    <div class="row">                   
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="name">Employee name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="" class="form-control">
                            </div>
                        </div> 

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="" class="form-control">
                            </div>
                        </div>   

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="role">Role</label>
                                <select name="role_id" class="form-control">
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="pasword">Password</label>
                                <input type="password" name="password" placeholder="" class="form-control">
                            </div>
                        </div>                  

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="password_confirmation">Confirm password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="" class="form-control">
                            </div>
                        </div> 
                    </div>

                    <div class="row">  
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="phone">Phone</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="email">Email</label>
                                <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="" class="form-control">
                            </div>
                        </div> 
                    </div>

                    <div class="row">                         
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="thumb">Avatar</label>
                                <input type="file" name="thumb" class="form-control" id="upload">
                                <div class="mt22" id="image_show">
                                </div>
                                <input type="hidden" name="thumb" id="thumb">
                            </div>
                        </div>    
                    </div>

                    <label class="control-label" for="email">Address</label>
                    <div class="row">
                        <!-- Province -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select name="province_id" id="province" class="form-control" required>
                                    <option value="">Select Province/City</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- District -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select name="district_id" id="district" class="form-control" required style="display: none;">
                                    <option value="">Select district</option>
                                </select>
                            </div>
                        </div>

                        <!-- Ward -->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select name="ward_id" id="ward" class="form-control" required style="display: none;">
                                    <option value="">Select Ward</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">                             
                                <input type="text" name="address" value="{{ old('address') }}" placeholder="Enter specific address" class="form-control">
                            </div>
                        </div>         
                    </div>
                    <input type="hidden" name="status" value="0">                     
                    <button style="margin-left: 0px;" type="submit" class="btn btn btn-primary"> 
                        <i class="fa fa-check"></i> Create
                    </button> 
            </div>     
        </div>
        @csrf
    </form>
@endsection()

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/admin/js/addressadmin/addressadd.js"></script>