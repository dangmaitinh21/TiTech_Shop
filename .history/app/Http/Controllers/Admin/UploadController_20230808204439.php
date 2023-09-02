<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\uploadServices;
use Exception;
use Illuminate\Support\Facades\Session;

class UploadController extends Controller
{
    protected $upload;
    public function __construct(uploadServices $upload)
    {   
        $this->upload = $upload;
    }
    public function store (Request $request) {
        $url = $this->upload->store($request);
        if($url) {
            return response()->json([
                'error'=>false,
                'url'=>$url,
            ]);
        }
        return response()->json(['error'=>true]);
    }
}
