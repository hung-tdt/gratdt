<?php

namespace App\Http\Services\Slider;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class SliderService 
{
    public function list()
    {
        return Slider::orderbyDesc('id')->paginate(15);
    }

    public function store($request) 
    {       
        try{
            $request->except('_token');
            Slider::create($request->input());
            Session::flash('success','Tạo slider thành công');
        }catch(\Exception $err){
            Session::flash('error', $err->getMessage());               
            return false;
        }
        
    }

    public function update($request, $slider)
    {

        try{
            $slider->fill($request->input());
            $slider->save();
            Session::flash('success','Cập nhật slider thành công');
           
        }catch(\Exception $err){
             Session::flash('error', $err->getMessage());               
            return false;
        }
        return true;
    }

    public function delete($request)
    {        
        $slider = Slider::where('id', $request->input('id'))->first();
        if($slider) {
            $path = str_replace('storage','public', $slider->thumb);
            Storage::delete($path);
            $slider->delete();
            return true;
        }
        return false;
       
    }

}
