@extends('admin.component.main') 


@section('content')
   
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Account information</h2>             
        </div>         
    </div>
    <div class="wrapper wrapper-content">
        <div class="row animated fadeInRight">
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Profile Detail</h5>
                    </div>
                    <div>
                        <div class="ibox-content no-padding border-left-right">
                            <img style="height: 150px" alt="image" class="img-responsive" src="{{$admin->thumb}}">
                        </div>
                        <div class="ibox-content profile-content">
                            <h4 style="margin-top: 20px"> Name :  {{$admin->name}}</h4>
                            <h4 style="margin-top: 20px"> UserName : {{$admin->username}}</h4>
                            <h4 style="margin-top: 20px"> Email : {{$admin->email}}</h4>
                            <h4 style="margin-top: 20px"> Phone : {{$admin->phone}}</h4>
                            <h4 style="margin-top: 20px">
                                Vai trò : {{$admin->roles->name}}
                            </h4>
                            
                        </div>
                </div>
            </div>
                </div>
            <div class="col-md-8">
                <div class="ibox float-e-margins">
                    <form action="{{ route('admins.editprofile', ['id' => $admin->id])}}" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $admin->name }}" name="name" placeholder="Enter your name">
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $admin->email }}" name="email" placeholder="Enter email">
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">UserName</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $admin->username }}" name="username" placeholder="Enter username">
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $admin->phone }}" name="phone" placeholder="Enter your phone">
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Address</label>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select name="province_id" id="province" class="form-control" required>
                                        <option value="">Select Province/City</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}" {{ $province->id == $admin->province_id ? 'selected' : '' }}>{{ $province->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select name="district_id" id="district" class="form-control" required>
                                        <option value="">Select district</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district->id }}" {{ $district->id == $admin->district_id ? 'selected' : '' }}>{{ $district->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select name="ward_id" id="ward" class="form-control" required>
                                        <option value="">Select Ward</option>
                                        @foreach($wards as $ward)
                                            <option value="{{ $ward->id }}" {{ $ward->id == $admin->ward_id ? 'selected' : '' }}>{{ $ward->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-10" style="margin-left: 142px">
                            <input type="text" class="form-control" value="{{ $admin->address }}" name="address" placeholder="Enter your address">
                        </div>
                        </div>  

                        <label for="thumb">Avatar</label>
                        <div class="form-group row">
                            <div style="margin-left: 155px" class="form-group">
                            
                                <input type="file" name="thumb" class="form-control" id="upload">
                                <div class="mt22" id="image_show">
                                    <a href="{{ $admin->thumb }}" target="_blank">
                                    <img src="{{ $admin->thumb }}" alt="" height="150px">
                                    </a>
                                </div>
                                <input type="hidden" name="thumb" value="{{ $admin->thumb }}" id="thumb">
                            </div>
                        </div>             
                
                        <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                        </div>
                    @csrf
                    </form>
                </div>

            </div>
        </div>
    </div>
        
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/admin/js/addressadmin/addressedit.js"></script>
