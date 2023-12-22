<?php

namespace App\Http\Controllers;

use App\Models\BookLoan;
use Illuminate\Http\Request;

class BookLoanController extends Controller
{
    public function index()
    {
        $bookLoans = BookLoan::all();
        return response()->json(['book_loans' => $bookLoans]);
    }

    public function show($id)
    {
        $bookLoan = BookLoan::findOrFail($id);
        return response()->json(['book_loan' => $bookLoan]);
    }

    public function store(Request $request)
    {
        // Validation and creation logic here
    }

    public function update(Request $request, $id)
    {
        // Update logic here
    }

    public function destroy($id)
    {
        // Deletion logic here
    }
}
