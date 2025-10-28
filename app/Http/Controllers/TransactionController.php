<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use App\Models\Book;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'book')->get();

        if ($transactions->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "Resource Data Not Found!"
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get All Resource",
            "data" => $transactions
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        $uniqueCode = "ORD-" . strtoupper(uniqid());
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized!'
            ], 401);
        }

        $book = Book::find($request->book_id);

        if ($book->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stok barang tidak cukup!'
            ], 400);
        }

        $totalAmount = $book->price * $request->quantity;
        $book->stock -= $request->quantity;
        $book->save();

        $transactions = Transaction::create([
            'order_number' => $uniqueCode,
            'customer_id' => $user->id,
            'book_id' => $request->book_id,
            'total_amount' => $totalAmount
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaction Created Successfully',
            'data' => $transactions
        ], 201);
    }

    public function show($id)
    {
        $transaction = Transaction::with('user', 'book')->find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction Not Found!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get Transaction Successfully',
            'data' => $transaction
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction Not Found!'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'book_id' => 'sometimes|exists:books,id',
            'quantity' => 'sometimes|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422);
        }

        $user = auth('api')->user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized!'
            ], 401);
        }

        $book = Book::find($request->book_id ?? $transaction->book_id);

        if ($request->has('quantity')) {
            $oldBook = Book::find($transaction->book_id);
            $oldBook->stock += $transaction->quantity ?? 1;
            $oldBook->save();

            if ($book->stock < $request->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok barang tidak cukup!'
                ], 400);
            }

            $book->stock -= $request->quantity;
            $book->save();

            $transaction->quantity = $request->quantity;
            $transaction->total_amount = $book->price * $request->quantity;
        }

        if ($request->has('book_id')) {
            $transaction->book_id = $request->book_id;
        }

        $transaction->save();

        return response()->json([
            'success' => true,
            'message' => 'Transaction Updated Successfully',
            'data' => $transaction
        ], 200);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction Not Found!'
            ], 404);
        }

        $book = Book::find($transaction->book_id);
        if ($book) {
            $book->stock += $transaction->quantity ?? 1;
            $book->save();
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction Deleted Successfully'
        ], 200);
    }
}
