<?php

namespace App\Http\Controllers\API\Magazine;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSliderRequrst;
use App\Http\Resources\SliderResource;
use App\Models\Magazine\Slider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function index()
    {
        $slider = Slider::all();
        try {
            $response = [
                'success' => true,
                'data' => SliderResource::collection($slider),
                'message' => 'pedram success',
            ];
            return response()->json($response, 200);
        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);

            exit;
        }
    }

    public function store(StoreSliderRequrst $request)
    {
        $input = $request->all();

        try {
                $input['createdBy'] = $request->user()->id;
                $slider = Slider::create($input);
                $response = [
                    'success' => true,
                    'data' => new SliderResource($slider),
                    'message' => 'slider success',
                ];

                return response()->json($response, 200);

        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);

            exit;
        }

    }

    public function show($id)
    {
        $slider = Slider::find($id);
        try {
            if (!$slider==null) {
                $response = [
                    'success' => true,
                    'data' => new SliderResource($slider),
                    'message' => 'pedram success',
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => "not found",
                ];
                return response()->json($response, 401);
            }
        }catch (Exception $e){
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);

            exit;
        }
    }
    public function update(StoreSliderRequrst $request, Slider $slider)
    {
        $input = $request->all();

        try {

            $slider->title = $input['title'];
            $slider->alt = $input['alt'];
            $slider->link = $input['link'];
            $slider->position = $input['position'];
            $slider->createdBy = $request->user()->id;
            $slider->editedBy = $request->user()->id;;
            $slider->save();

            $response = [
                'success' => true,
                'data' => new SliderResource($slider),
                'message' => 'slider success',
            ];
            return response()->json($response, 200);
        }catch (Exception $e){
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);

            exit;
        }
    }
    public function destroy(Slider $slider)
    {
        $slider->delete();
        try {
            $response = [
                'success' => true,
                'data' => new SliderResource($slider),
                'message' => 'delete success',
            ];
            return response()->json($response, 200);
        }catch (Exception $e){
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);

            exit;
        }
    }
}
