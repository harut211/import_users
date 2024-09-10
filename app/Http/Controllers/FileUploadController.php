<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:csv|max:2048',
        ]);
        if ($validated) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $fileName = sha1($fileName) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('/public', $fileName);
            $filename = pathinfo($fileName, PATHINFO_FILENAME);
            return $filename;
        } else {
            return 'No files found';
        }
    }

}
