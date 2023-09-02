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
        try {
            dd($request->file('photo'));

        } catch(Exception $err) {
            Session::flash('error', $err);
        }
    }
}
