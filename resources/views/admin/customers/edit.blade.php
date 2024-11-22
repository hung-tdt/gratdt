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

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" for="name">Name</label>
                                <input type="text" name="name" value="{{ $customer->name }}" placeholder="" class="form-control">
                            </div>
                        </div> 

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" name="username" value="{{ $customer->username }}" placeholder="" class="form-control">
                            </div>
                        </div>   

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" for="email">Email</label>
                                <input type="text" name="email" value="{{ $customer->email }}" placeholder="" class="form-control">
                            </div>
                        </div> 

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" for="email">Description</label>
                                <input type="text" name="description" value="{{ $customer->description }}" placeholder="" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="thumb">Image</label>
                                    <input type="file" name="thumb" class="form-control" id="upload">
                                    <div class="mt22" id="image_show">
                                        <a href="{{ $customer->thumb }}" target="_blank">
                                        <img src="{{ $customer->thumb }}" alt="" width="200px">
                                        </a>
                                    </div>
                                    <input type="hidden" name="thumb" value="{{ $customer->thumb }}" id="thumb">
                                </div>
                            </div>
                        </div>

                        <p style="font-size: large; font-weight: bold" class="text-primary">Information </p>
        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" for="phone">Phone</label>
                                <input type="text" id="phone" name="phone" value="{{ $customer->phone }}" placeholder="" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                        <label>Status</label>   
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="1" type="radio" id="active" 
                                  name="active" {{ $customer->active ==1 ? 'checked=""' :''}}>
                            <label for="active" class="custom-control-label">Yes</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="0" type="radio" id="no_active" 
                                name="active" {{ $customer->active ==0 ? 'checked=""' :''}}>
                            <label for="no_active" class="custom-control-label">No</label>
                          </div>           
                        </div>
                    </div>   
                                             
                        <button type="submit" class="btn btn btn-primary"> <i class="fa fa-check"></i> Update</button>    
                
                    </div>

            </div>     
        </div>
        @csrf
    </form>
@endsection()