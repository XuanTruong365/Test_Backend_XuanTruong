<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class Test2Controller extends Controller
{
    public function getFile(Request $request)
    {
        try {
            // Validate dữ liệu đầu vào
            $request->validate([
                'file' => 'required|string',
                'app_env' => 'required|integer|in:0,1,2',
                'contract_server' => 'required|integer|in:0,1',
            ]);

            // Xác định thư mục dựa vào app_env và contract_server
            $directories = [
                0 => 'AWS',
                1 => 'K5',
                2 => 'T2',
            ];

            $servers = [
                0 => 'app1',
                1 => 'app2',
            ];

            $appEnv = $directories[$request->app_env];
            $contractServer = $servers[$request->contract_server];

            // Đường dẫn file trong storage
            $filePath = "imprints_html_file/{$appEnv}/{$contractServer}/{$request->file}.html";

            // Kiểm tra file có tồn tại không
            if (!Storage::exists($filePath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Seal Info response false',
                ], 404);
            }

            // Đọc nội dung file và chuyển sang base64
            $fileContent = Storage::get($filePath);
            $encodedContent = base64_encode($fileContent);

            return response()->json([
                'success' => true,
                'filename' => "{$request->file}.html",
                'content' => $encodedContent,
                'message' => 'Seal Info response successfully',
            ], 200);
        } catch (\Exception $e) {
            Log::error("Error getting file: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request.',
            ], 500);
        }
    }
}
