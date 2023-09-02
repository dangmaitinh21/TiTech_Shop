<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\uploadServices;

class UploadController extends Controller
{
    protected $upload;
    public function __construct(uploadServices $upload)
    {   
        $this->upload = $upload;
    }
    public function store (Request $request) {
        if($request->hasFile('file')) {
            return 'abc';
        }
    }
}
