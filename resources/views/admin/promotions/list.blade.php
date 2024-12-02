@extends('admin.component.main')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Employee list </h2>             
        </div>         
    </div>

    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
             
        <div class="ibox-content">     
            <button style="margin-left: 0px;" type="button" class="btn btn btn-primary"> <i class="fa fa-plus"></i>
                <a class="font-white" href="{{ route('promotions.add') }}"> Create</a>
            </button>              
            <table style="margin-top:10px;" class="tbf table table-bordered"> 
                <thead>
                    <tr>                                   
                        <th style="width: 350px">Name</th>
                        <th>start_date</th>
                        <th>end_date</th>
                        <th>active</th>
                        <th>created at</th>
                        <th>Action</th>        
                    </tr>                       
                </thead>
                <tbody>
                    @foreach($promotions as $key => $promotion) 

                    <tr>
                        <td>{{ $promotion->name }}</td>                                    
                        <td>{{ $promotion->start_date }}</td>
                        <td>{{ $promotion->end_date }}</td>
                        <td>{{ $promotion->active }}</td>
                        <td>{{ $promotion->created_at }}</td>
                        
                        <td>                    
                            <div class="button-row1">                       
                                <a style="margin: 1px" class="btn btn-success dim" 
                                    href="{{ route('promotions.edit', ['id' => $promotion->id]) }}">
                                    <i class="fa fa-edit (alias)"></i>
                                </a>    
                                <a style="margin: 1px" class="btn btn-danger  dim " href="#"
                                    onclick="removeRow({{ $promotion->id }}, '{{ route('promotions.destroy', ['id' => $promotion->id]) }}')">
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
@endsection()

