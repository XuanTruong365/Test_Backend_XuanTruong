<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
{
    // Lấy danh sách accounts có phân trang
    public function index(Request $request)
    {
        $accounts = Account::paginate($request->input('per_page', 10));
        return response()->json($accounts);
    }

    // Lấy thông tin 1 account
    public function show($id)
    {
        $account = Account::find($id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }
        return response()->json($account);
    }

    // Tạo mới account
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'login' => 'required|string|max:20|unique:accounts,login',
                'password' => 'required|string|min:6|max:40',
                'phone' => 'nullable|string|max:20',
            ]);

            $validatedData['password'] = Hash::make($validatedData['password']);

            $account = Account::create($validatedData);

            Log::info("New account created: " . $account->login);

            return response()->json($account, 201);
        } catch (ValidationException $e) {
            Log::error("Validation failed: " . json_encode($e->errors()));
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    // Cập nhật account
    public function update(Request $request, $id)
    {
        $account = Account::find($id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }

        try {
            $validatedData = $request->validate([
                'login' => 'sometimes|string|max:20|unique:accounts,login,' . $id . ',registerID',
                'password' => 'sometimes|string|min:6|max:40',
                'phone' => 'nullable|string|max:20',
            ]);

            if (isset($validatedData['password'])) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            }

            $account->update($validatedData);

            Log::info("Account updated: " . $account->login);

            return response()->json($account);
        } catch (ValidationException $e) {
            Log::error("Validation failed: " . json_encode($e->errors()));
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    // Xóa account
    public function destroy($id)
    {
        $account = Account::find($id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }

        $account->delete();
        Log::warning("Account deleted: " . $id);
        return response()->json(['message' => 'Account deleted successfully']);
    }
}


