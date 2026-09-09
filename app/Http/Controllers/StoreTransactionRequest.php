<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreTransactionRequest extends Controller
{
    public function authorize(): bool {return true;}
    public function rules(): array {
        return [
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:255',
            'transaction_date' => 'required|date',
        ];
    }
}
