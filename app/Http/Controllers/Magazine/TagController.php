<?php

namespace App\Http\Controllers\Magazine;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\TagResource;
use App\Models\Magazine\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends BaseController
{
    public function index()
    {
        $tag = Tag::all();
        return $this->sendResponse(TagResource::collection($tag),'tag done');
    }

    public function store(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make($input,[
           'slug'=>'required',
            'title'=>'required',
            'hot'=>'required',
            'meta_desc' => 'required',
            'body' =>'required'
        ]);
        if ($validator->fails()){
            return $this->sendError('validation error',$validator->errors());
        }
        $tag = Tag::create($input);
        return $this->sendResponse(new TagResource($tag),'tag created');
    }
    public function show($id)
    {
        $tag = Tag::find($id);
        if (is_null($tag)) {
            return $this->sendError('not found');
        }

        return $this->sendResponse(new TagResource($tag), 'tag success');
    }
    public function update(Request $request,Tag $tag)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'slug'=>'required',
            'title'=>'required',
            'hot'=>'required',
            'meta_desc' => 'required',
            'body' =>'required'
        ]);
        if ($validator->fails()){
            return $this->sendError('validation error',$validator->errors());
        }

        $tag->slug = $input['slug'];
        $tag->title = $input['title'];
        $tag->hot = $input['hot'];
        $tag->meta_desc = $input['meta_desc'];
        $tag->body = $input['body'];
        $tag->save();

        return $this->sendResponse(new TagResource($tag), 'tag update success');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return $this->sendResponse([],'tag delete success');
    }

}
