<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Slider\CreateFormRequest;
use App\Http\Requests\Slider\EditFormRequest;
use App\Http\Services\Slider\SliderService;
use App\Models\Slider;

class SliderController extends Controller
{
    protected $slider;
    public function __construct(SliderService $slider)
    {
        $this->slider = $slider;
    }
    
    public function list()
    {
        return view('admin.sliders.list',[
            'title' => 'List of Ads',
            'sliders' => $this->slider->list()
        ]);
    }

    public function add()
    {
        return view('admin.sliders.add',[
            'title' => 'Add new Ads '
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $this->slider->store($request);
    
        return redirect()->route('sliders.list');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit',[
            'title' => 'Edit Ads ' .$slider->name,
            'slider' => $slider
            
        ]);
    }

    public function update(EditFormRequest $request,Slider $slider)
    {
        $result= $this->slider->update($request, $slider);
        if($result){
            return redirect()->route('sliders.list');
        }
        return redirect()->back();
        
    }

    public function destroy(Request $request)//: JsonResponse
    {
        $result = $this->slider->delete($request);
        if($result)
        {
            return response()->json([
                'error' => false,
                'message' => 'Ads deleted successfully'
            ]);
        }
        return response()->json([
            'error' => true
           
        ]);
    }

}
