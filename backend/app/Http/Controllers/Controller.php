<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

class Controller
{
    public function validing($request, $items)
    {
        $validate = Validator::make($request, $items);
        if ($validate->fails()) return abort(400, implode(',', $validate->errors()->all()));
        return null;
    }
    public function successList($message,  $data, $property, $notification = null, $filter = null, $searchby = null, $other = null)
    {
        return response()->json([
            'message' => $message,
            'property' => $data->perPage() == 1000 ? null : [
                'total' => $data->total(),
                'count' => $data->count(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'total_pages' => $data->lastPage()
            ],
            'column' => $property,
            'data' => $data->getCollection(),
            'notification' => $notification,
            'filter' => $filter,
            'searchby' => $searchby,
            'other' => $other
        ]);
    }
    public function resSuccess($data, $notification = null)
    {
        return response()->json([
            'error_code' => 0,
            'error_message' => "",
            'data' => $data,
            'notification' => $notification,
        ]);
    }
    public function resFailed($code, $error, $notification = null)
    {
        if (is_array($error)) $error = implode(",", $error);
        return response()->json([
            'error_code' => $code,
            'error_message' => $error,
            'notification' => $notification,
        ]);
    }
    public function unlink_filex($dir, $name)
    {
        if ($name == null) return;
        $file_loc = public_path($dir . "\\") . $name;
        if (file_exists($file_loc)) unlink($file_loc);
    }
}