<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class FinanceController extends Controller
{
    public function finance_admin()
    {
        $students = Student::where('status', 'Accepted')->get();
        return view('finance.admin', compact('students'));
    }

    public function confirmPayment($id)
    {
        $student = Student::findOrFail($id);
        $student->payment_status = 'Paid';
        $student->status = 'Final Accepted'; 
        $student->save();

        return back()->with('success', 'تم تأكيد الدفع والقبول النهائي.');
    }
}
