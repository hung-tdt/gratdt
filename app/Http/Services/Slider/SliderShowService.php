<?php

namespace App\Http\Services\Slider;

use App\Http\Controllers\Controller;
use App\Models\Slider;

class SliderShowService 
{
    public function show()
    {
        return Slider::where('active',1)->limit(2)->orderByDesc('id')->get();
    }

}
