<?php

namespace App\Http\Controllers\API\Magazine;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequrst;
use App\Http\Resources\TagResource;
use App\Models\Magazine\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function index()
    {
        $tag = Tag::all();
        try {
            $response =[
                'success' => true,
                'data' => TagResource::collection($tag),
                'message' => 'pedram success',
            ];
            return response()->json($response, 200);

        }catch (Exception $e) {
            $message = $e->getMessage();
        }
    }

    public function store(StoreTagRequrst $request)
    {

        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;
            $tag = Tag::create($input);
            $response = [
                'success' => true,
                'data' => new TagResource($tag),
                'message' => 'tag success',
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
        $tag = Tag::find($id);
        try {
            if (!$tag==null) {
                $response = [
                    'success' => true,
                    'data' => new TagResource($tag),
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
    public function update(StoreTagRequrst $request,Tag $tag)
    {
        $input = $request->all();
        try {
            $tag->slug = $input['slug'];
            $tag->title = $input['title'];
            $tag->hot = $input['hot'];
            $tag->meta_desc = $input['meta_desc'];
            $tag->body = $input['body'];
            $tag->createdBy = $request->user()->id;
            $tag->editedBy = $request->user()->id;
            $tag->save();

            $response = [
                'success' => true,
                'data' => new TagResource($tag),
                'message' => 'tag success',
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

    public function destroy(Tag $tag)
    {
        $tag->delete();
        try {
            $response = [
                'success' => true,
                'data' => new TagResource($tag),
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
