<?php

namespace App\Http\Controllers\API\Magazine;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequrst;
use App\Http\Resources\PageResource;
use App\Models\Magazine\Page;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index()
    {
        $page = Page::all();
        try {
            $response = [
                'success' => true,
                'data' => PageResource::collection($page),
                'message' => 'pedram success',
            ];
            return response()->json($response, 200);
        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: ' . $message);

            $code = $e->getCode();
            var_dump('Exception Code: ' . $code);

            $string = $e->__toString();
            var_dump('Exception String: ' . $string);

            exit;
        }
    }

    public function store(StorePageRequrst $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;
            $page = Page::create($input);
            $response = [
                'success' => true,
                'data' => new PageResource($page),
                'message' => 'slider success',
            ];
            return response()->json($response, 200);
        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: ' . $message);

            $code = $e->getCode();
            var_dump('Exception Code: ' . $code);

            $string = $e->__toString();
            var_dump('Exception String: ' . $string);

            exit;
        }
    }

    public function show($id)
    {
        $page = Page::find($id);
        try {
            if (!$page == null) {
                $response = [
                    'success' => true,
                    'data' => new PageResource($page),
                    'message' => 'pedram success',
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "not found",
                ];
                return response()->json($response, 401);
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: ' . $message);

            $code = $e->getCode();
            var_dump('Exception Code: ' . $code);

            $string = $e->__toString();
            var_dump('Exception String: ' . $string);

            exit;
        }
    }

    public function update(StorePageRequrst $request, Page $page)
    {
        $input = $request->all();
        try {
            $page->slug = $input['slug'];
            $page->title = $input['title'];
            $page->body = $input['body'];
            $page->createdBy = $request->user()->id;
            $page->editedBy = $request->user()->id;
            $page->save();

            $response = [
                'success' => true,
                'data' => new PageResource($page),
                'message' => 'tag success',
            ];
            return response()->json($response, 200);

        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: ' . $message);

            $code = $e->getCode();
            var_dump('Exception Code: ' . $code);

            $string = $e->__toString();
            var_dump('Exception String: ' . $string);

            exit;
        }
    }
    public function destroy(Page $page)
    {
        $page->delete();
        try {
            $response = [
                'success' => true,
                'data' => new PageResource($page),
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
