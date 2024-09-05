<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        foreach ($request->file('files') as $file) {
            $fileName = $file->getClientOriginalName();
            $fileName = sha1($fileName) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('/public', $fileName);
        }
        return $fileName;
    }

}
