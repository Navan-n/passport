<?php

namespace App\Http\Controllers\Magazine;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\Magazine\Slider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SliderController extends BaseController
{
    public function index()
    {
        $slider = Slider::all();

        return $this->sendResponse(SliderResource::collection($slider),'slider success');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'alt' => 'required',
            'link' => 'required',
            'position' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('validation error', $validator->errors());
        }
        $slider = Slider::create($input);

        return $this->sendResponse(new SliderResource($slider), 'slider success');
    }

        public function show($id){
        $slider = Slider::find($id);

        if (is_null($slider)) {
            return $this->sendError('slider error');
        }
        return $this->sendResponse(new SliderResource($slider),'slider success');

    }
    public function update(Request $request, Slider $slider)
    {
        $input = $request->all();

        $validator = Validator::make($input,[
            'title' => 'required',
            'alt' => 'required',
            'link' => 'required',
            'position' => 'required'
        ]);
        if ($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $slider->title = $input['title'];
        $slider->alt = $input['alt'];
        $slider->link=$input['link'];
        $slider->position=$input['position'];
        $slider->save();

        return $this->sendResponse(new SliderResource($slider), 'slider update');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();

        return $this->sendResponse([], 'slider delete');
    }
}
