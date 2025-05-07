<?php

namespace App\Http\Controllers;

use App\Models\{
    Student,
    College,
    Specialization
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdmissionNotification;

class StudentController extends Controller
{
    public function create()
    {
        $colleges = College::all();
        return view('register', compact('colleges'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'family_name' => 'required|string|max:255',
            'national_id' => 'required|unique:students',
            'phone' => 'required',
            'baccalaureate_score' => 'required|numeric|max:240',
            'certificate_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'student_specialization' => 'required|array',
        ]);

        $imagePath = $request->file('certificate_image')->store('certificates', 'public');

        $student = Student::create([
            'name' => $request->full_name,
            'national_id' => $request->national_id,
            'phone' => $request->phone,
            'total_score' => $request->baccalaureate_score,
            'certificate_image' => $imagePath,
            'status' => 'Pending',
        ]);

        return redirect()->route('students.selectSpecializations', ['id' => $student->id]);
    }

    public function manger()
    {
        return view('manger', [
            'totalStudents' => Student::count(),
            'totalSpecializations' => Specialization::count(),
            'collegesCount' => College::count(),
            'totalSeats' => College::sum('seats'),
            'specializations' => Specialization::all(),
            'colleges' => College::all(),
        ]);
    }

    public function show($id)
    {
        $student = Student::with('selectedSpecializations')->findOrFail($id);
        $specializations = Specialization::whereNotIn('id', $student->selectedSpecializations->pluck('id'))->get();

        return view('student.show', compact('student', 'specializations'));
    }

    public function acceptStudent($id)
    {
        $student = Student::findOrFail($id);
        $student->status = 'Accepted';
        $student->save();

        if ($student->email) {
            Mail::to($student->email)->send(new AdmissionNotification($student));
        }

        return back()->with('success', 'تم قبول الطالب وإرسال الإيميل.');
    }

    public function rejectStudent($id)
    {
        $student = Student::findOrFail($id);
        if ($student->status === 'Rejected') {
            return back()->with('info', 'الطلب مُرفوض بالفعل.');
        }

        $student->status = 'Rejected';
        $student->save();

        return back()->with('success', 'تم رفض الطلب.');
    }

    public function showRequests()
    {
        $students = Student::orderByDesc('created_at')->paginate(10);
        $colleges = College::all();

        return view('admin.requests', compact('students', 'colleges'));
    }

    public function selectSpecializations($id)
    {
        $student = Student::with('selectedSpecializations')->findOrFail($id);
        $specializations = Specialization::whereNotIn('id', $student->selectedSpecializations->pluck('id'))->get();
        $colleges = College::all();
        return view('student.select-specializations', compact('student', 'specializations', 'colleges'));
    }

    public function addSpecialization(Request $request)
    {
        $student = Student::findOrFail($request->student_id);

        if ($student->selectedSpecializations()->count() < 10) {
            $student->selectedSpecializations()->attach($request->specialization_id);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'لا يمكنك اختيار أكثر من 10 تخصصات.']);
    }

    public function removeSpecialization(Request $request)
    {
        $student = Student::findOrFail($request->student_id);
        $student->selectedSpecializations()->detach($request->specialization_id);
        return response()->json(['success' => true]);
    }
}
