@extends('admin.component.main')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ $title }}</h2>             
        </div>         
    </div>
    <button type="button" class="btn btn btn-primary mt20 ml0"> <i class="fa fa-plus"></i>
        <a class="font-white" href="{{ route('sliders.add') }}"> Create Ads</a>
    </button>
    <div class="ibox-content mt20">               
        <table style="margin-top:10px;" class="table table-bordered mg10">
            <thead>
                <tr>                                   
                    <th>Ads code</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Active</th>
                    <th class="width150">Action</th>        
                </tr>                       
            </thead>
            <tbody>
                @foreach($sliders as $key => $slider) 

                <tr>
                    <td>{{ $slider->id }}</td>                                    
                    <td>{{ $slider->name }}</td>
                    <td><a href="{{ $slider->thumb }}" target="_blank">
                        <img src="{{ $slider->thumb }}" height="60px"></a>
                    </td>
                    <td style="text-align: center">{!! \App\Helpers\Helper::active($slider->active) !!}</td>   
                    <td>                    
                        <div class="button-row1">                       
                            <a style="margin: 1px" class="btn btn-success dim" 
                                href="{{ route('sliders.edit', ['slider' => $slider->id]) }}">
                                <i class="fa fa-edit (alias)"></i>
                            </a>    
                            <a style="margin: 1px" class="btn btn-danger  dim " href="#"
                                onclick="removeRow({{ $slider->id }}, '{{ route('sliders.destroy', ['slider' => $slider->id]) }}')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>  
                    </td>
                </tr>
                @endforeach               
            </tbody>           
        </table>        
    </div>
@endsection