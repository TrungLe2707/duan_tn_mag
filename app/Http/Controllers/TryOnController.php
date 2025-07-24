<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Http;

class TryOnController extends Controller
{
    public function showForm()
    {
        
        return view('tryon.form');
    }
    public function process(Request $request)
    {
        $request->validate([
            'person_image' => 'required|image',
            'cloth_image' => 'required|image',
            'instructions' => 'nullable|string|max:1000',
            'model_type' => 'nullable|string|in:top,bottom,full',
            'gender' => 'nullable|string|in:male,female,unisex',
            'garment_type' => 'nullable|string|in:shirt,pants,jacket,dress,tshirt',
            'style' => 'nullable|string|in:casual,formal,streetwear,traditional,sports',
        ]);

        $personPath = $request->file('person_image')->store('uploads', 'public');
        $clothPath = $request->file('cloth_image')->store('uploads', 'public');

        $personFull = storage_path("app/public/{$personPath}");
        $clothFull = storage_path("app/public/{$clothPath}");

        $instructions = $request->input('instructions', '');
        $modelType = $request->input('model_type', '');
        $gender = $request->input('gender', '');
        $garmentType = $request->input('garment_type', '');
        $style = $request->input('style', '');

        // 2. Gọi Python script (folder python/process_image.py)
        $client = new Client();
        try {
            $response = $client->post('http://localhost:8000/api/try-on', [
                'multipart' => [
                    [
                        'name' => 'person_image',
                        'contents' => fopen($personFull, 'r'),
                        'filename' => basename($personFull),
                    ],
                    [
                        'name' => 'cloth_image',
                        'contents' => fopen($clothFull, 'r'),
                        'filename' => basename($clothFull),
                    ],
                    // Các tham số khác nếu cần
                    [
                        'name' => 'instructions',
                        'contents' => $instructions,
                    ],
                    [
                        'name' => 'model_type',
                        'contents' => $modelType,
                    ],
                    [
                        'name' => 'gender',
                        'contents' => $gender,
                    ],
                    [
                        'name' => 'garment_type',
                        'contents' => $garmentType,
                    ],
                    [
                        'name' => 'style',
                        'contents' => $style,
                    ],
                ],
            ]);


            $result = json_decode($response->getBody(), true);

            $resultImage = $result['image'] ?? null;
            $description = $result['text'] ?? 'No description available';
            return view('tryon.form', [
                'personImage' => $personPath,
                'clothImage' => $clothPath,
                'resultImage' => $resultImage,
                'description' => $description,
            ]);




        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }



}
