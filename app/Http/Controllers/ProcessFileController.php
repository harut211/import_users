<?php

namespace App\Http\Controllers;

use App\Http\Requests\HeadersRequest;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Exception;

class ProcessFileController extends Controller
{
    public function index(Request $request, $filename)
    {
        $filename = $filename . ".csv";
        $fullPath = storage_path('app/public/' . $filename);

        if (!empty($filename) && file_exists($fullPath)) {
            $csv = Reader::createFromPath($fullPath, 'r');
            $csv->setHeaderOffset(0);
            $headers = $csv->getHeader();
            return view('select', compact('filename', 'headers'));
        }
        return back()->with('error', 'File not found');
    }

    public function store(HeadersRequest $request)
    {
        $filename = $request->filename;
        $fullPath = storage_path('app/public/' . $filename);

        if (file_exists($fullPath) && is_readable($fullPath)) {
            try {
                $csv = Reader::createFromPath($fullPath);
                $csv->setHeaderOffset(0);
                $records = $csv->getRecords();
                $header = $csv->getHeader();
                $collection = collect($records)->map(function ($record) use ($header) {
                    return array_combine($header, $record);
                });

                foreach ($collection as $record) {
                    if ($record['First name'] && $record['Lastname'] && $record['Gender'] && $record['Age'] && $record['Country']) {
                        try {
                            People::updateOrCreate([
                                'firstname' => $record[$request->input('firstname')],
                                'lastname' => $record[$request->input('lastname')],
                                'gender' => $record[$request->input('gender')],
                                'age' => $record[$request->input('age')],
                                'country' => $record[$request->input('country')],
                                'locale' => $record[$request->input('locale')] == "am" | $record[$request->input('locale')] == "en" ? $record[$request->input('locale')] : "am",
                            ]);
                        } catch (\Exception $exception) {
                            return back()->with('error', 'Your fields is invalid');
                        }
                    } else {
                        $fileName = 'unsaved.txt';
                        $record = serialize($record);
                        Storage::disk('local')->put($fileName, $record);
                    }

                }

                return back()->with('success', 'Records saved');

            } catch (Exception $e) {
                return back()->with('error', 'CSV parsing error: ' . $e->getMessage());
            }
        } else {
            return back()->with('error', 'File not found or not readable');
        }

    }

    public function show(Request $request)
    {
        $peoples = People::all();
        return view('show', compact('peoples'));
    }
}
