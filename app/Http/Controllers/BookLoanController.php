<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\BookLoan;
use Illuminate\Http\Request;

class BookLoanController extends Controller
{
    // ... Existing methods ...

    public function borrowBook(Request $request)
    {
        // Validate the request
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date',
            'extended' => 'in:yes,no', // Example: Should be either 'yes' or 'no'
            'extension_date' => 'nullable|date', // Example: Should be a date if extension is provided
            'penalty_amount' => 'required|integer|min:0', // Example: Must be a non-negative integer
            'penalty_status' => 'in:paid,unpaid', // Example: Should be either 'paid' or 'unpaid'
            'status' => 'in:pending,approved,rejected', // Example: Should be one of these status values
            'added_by' => 'required|exists:users,id', // Example: Should be a valid user ID
        ]);

        // Check if the book is available
        // You may need to implement a method in your Book model to check availability
        $book = Book::findOrFail($request->input('book_id'));
        if (!$book->isAvailable()) {
            return response()->json(['message' => 'Book is not available for loan.'], 422);
        }

        // Create a new book loan
        $bookLoan = BookLoan::create($request->all());

        // Implement any additional logic, such as updating book availability

        return response()->json(['book_loan' => $bookLoan]);
    }

    public function approveLoan(Request $request, $id)
    {
        // Validate the request (you may want to add additional validation rules)
        $request->validate([
            'admin_approval_field' => 'required', // Add your own admin approval field
        ]);

        // Find the book loan
        $bookLoan = BookLoan::findOrFail($id);

        // Update the book loan with admin approval
        $bookLoan->update(['admin_approval_field' => $request->input('admin_approval_field')]);

        // Implement any additional logic, such as updating book status

        return response()->json(['message' => 'Book loan approved successfully.']);
    }

    public function extendLoan($id)
    {
        // Find the book loan
        $bookLoan = BookLoan::findOrFail($id);

        // Implement logic to check if the user is allowed to extend the loan
        // You may want to add additional checks here

        // Calculate the new due date (example: extending by 7 days)
        $newDueDate = now()->addDays(7);

        // Update the due date and extension details
        $bookLoan->update([
            'due_date' => $newDueDate,
            'extended' => 'yes',
            'extension_date' => now(),
        ]);

        return response()->json(['message' => 'Book loan extended successfully.']);
    }


    public function returnBook(Request $request, $id)
    {
        // Validate the request (you may want to add additional validation rules)
        $request->validate([
            'return_condition' => 'required', // Add your own return condition field
        ]);

        // Find the book loan
        $bookLoan = BookLoan::findOrFail($id);

        // Update the book loan with return details
        $bookLoan->update([
            'return_date' => now(),
            'return_condition' => $request->input('return_condition'),
            'status' => 'returned',
        ]);

        // Implement any additional logic, such as updating book status

        return response()->json(['message' => 'Book returned successfully.']);
    }

    // ... Existing methods ...
}
