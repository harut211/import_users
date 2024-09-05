<?php

namespace App\Http\Controllers;

use App\Http\Requests\HeadersRequest;
use App\Models\People;
use Illuminate\Http\Request;
use League\Csv\Reader;
use League\Csv\Exception;

class ProcessFileController extends Controller
{
    public function index(Request $request){
        $filename = basename(url()->full());
        $fullPath = storage_path('app/public/' . $filename);
        $csv = Reader::createFromPath($fullPath, 'r');
        $csv->setHeaderOffset(0);
        $headers = $csv->getHeader();
        return view('select',compact('filename','headers'));
    }

    public function store(HeadersRequest $request){
        $filename = $request->filename;
        $fullPath = storage_path('app/public/' . $filename);

        if (file_exists($fullPath) && is_readable($fullPath)) {
            try {
                $csv = Reader::createFromPath($fullPath, 'r');
                $csv->setHeaderOffset(0);
                $records = $csv->getRecords();
                $header = $csv->getHeader();
                $collection = collect($records)->map(function ($record) use ($header) {
                        return array_combine($header, $record);
                })->filter(function ($record) {
                        return !in_array('', $record, true);
                });

                foreach ($collection as $record) {
                    People::updateOrCreate([
                        'firstname' => $record[$request->input('firstname')],
                        'lastname' =>  $record[$request->input('lastname')],
                        'gender' =>  $record[$request->input('gender')],
                        'age' =>  intval($record[$request->input('age')]),
                        'country' =>  $record[$request->input('country')],
                        'locale' =>  $record[$request->input('locale')],
                    ]);
                }

                return back()->with('success', 'Records saved');

            } catch (Exception $e) {
                dd('CSV parsing error: ' . $e->getMessage());
            }
        } else {
            dd('File not found or not readable');
        }

    }

    public function show(Request $request){
        $peoples= People::all();
        return view('show',compact('peoples'));
    }
}
