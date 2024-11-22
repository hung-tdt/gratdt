@extends('admin.component.main')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Add new customer</h2>             
                </div>         
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                    <div class="row">                   

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" for="name">Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="" class="form-control">
                            </div>
                        </div> 

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="" class="form-control">
                            </div>
                        </div>   

                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="pasword">Password</label>
                                    <input type="password" name="password" placeholder="" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="password_confirmation">Confirm password</label>
                                <input type="password" name="password_confirmation" value="" placeholder="" class="form-control">
                                </div>
                            </div>
                            
                        </div>                  

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" for="email">Email</label>
                                <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="" class="form-control">
                            </div>
                        </div> 

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" for="email">Description</label>
                                <input type="text" name="description" value="{{ old('description') }}" placeholder="" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="thumb">Image</label>
                                    <input type="file" name="thumb" class="form-control" id="upload">
                                    <div class="mt22" id="image_show">
                                    </div>
                                    <input type="hidden" name="thumb" id="thumb">
                                </div>
                            </div>    
                            
                        </div>

                        <p style="font-size: large; font-weight: bold" class="text-primary">Information </p>
        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" for="phone">Phone</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="" class="form-control">
                            </div>
                        </div>
                                         
                        <input type="hidden" name="active" value="1">           

                        <button type="submit" class="btn btn btn-primary"> <i class="fa fa-check"></i> Create</button>    
                
                    </div>

            </div>     
        </div>
        @csrf
    </form>
@endsection()