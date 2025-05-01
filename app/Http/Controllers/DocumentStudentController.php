<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\College;
use App\Models\Program;
use App\Models\Student;
use App\Models\Adviser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class DocumentStudentController extends Controller
{
    public function setTable()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized action.');
        }

        $role = $user->role;
        $documents = [];
        $students = null;
        $advisers = null;
        $college = null;
        $program = null;

        if ($role == 'student') {
            $documents = $this->setTableForStudent();
        } elseif ($role == 'adviser') {
            $documents = $this->setTableForAdviser();
        } elseif ($role == 'admin') {
            $program = $this->fetchProgram();
            $college = $this->fetchCollege();
            $advisers = $this->fetchAdviser();
            $students = $this->fetchStudents();
            $documents = $this->setTableForAdmin();
        }

        return view('dashboard', [
            'documents' => $documents,
            'students' => $students ?? null,
            'advisers' => $advisers ?? null,
            'college' => $college ?? null,
            'program' => $program ?? null
        ]);
    }

    public function setTableForAdviser(){
        $adviser_id = DB::table('adviser')
            ->where('user_id', '=', Auth::user()->id)
            ->value('id');

        $documents = DB::table('document_student')
            ->join('documents', 'document_student.document_id', '=', 'documents.id')
            ->join('student', 'document_student.student_id', '=', 'student.id')
            ->join('document_statuses', 'documents.document_status_id', '=', 'document_statuses.id')
            ->join('document_adviser', 'documents.id', '=', 'document_adviser.document_id')
            ->join('adviser', 'document_adviser.adviser_id', '=', 'adviser.id')
            ->select('documents.id', 'documents.title', 'documents.abstract', 'documents.keyword', 
            'document_statuses.name', 'student.first_name', 'student.last_name', 'documents.document_status_id')
            ->where('adviser_id', '=', $adviser_id)
            ->paginate(6);

        return $documents;
    }

    public function setTableForStudent(){
        $student_id = DB::table('student')
            ->where('user_id', '=', Auth::user()->id)
            ->value('id');

        $documents = DB::table('document_student')
            ->join('documents', 'document_student.document_id', '=', 'documents.id')
            ->join('student', 'document_student.student_id', '=', 'student.id')
            ->join('document_statuses', 'documents.document_status_id', '=', 'document_statuses.id')
            ->join('document_adviser', 'documents.id', '=', 'document_adviser.document_id')
            ->join('adviser', 'document_adviser.adviser_id', '=', 'adviser.id')
            ->select('documents.id', 'documents.title', 'documents.abstract', 'documents.keyword', 
            'document_statuses.name', 'adviser.first_name', 'adviser.last_name')
            ->where('student_id', '=', $student_id)
            ->paginate(6);

        return $documents;
    }
    public function setTableForAdmin(){
        $documents = DB::table('documents')
            ->join('document_student', 'documents.id', '=', 'document_student.document_id')
            ->join('student', 'document_student.student_id', '=', 'student.id')
            ->join('document_statuses', 'documents.document_status_id', '=', 'document_statuses.id')
            ->join('document_adviser', 'documents.id', '=', 'document_adviser.document_id')
            ->join('adviser', 'document_adviser.adviser_id', '=', 'adviser.id')
            ->select('documents.id', 'documents.title', 'student.first_name as student_first_name', 
            'student.last_name as student_last_name', 'adviser.first_name as adviser_first_name', 
            'adviser.last_name as adviser_last_name', 'document_statuses.name as status', 'documents.document_status_id') 
            ->get();

        return $documents;
    }
    public function fetchStudents()
    {
        $students = DB::table('student')
            ->join('users', 'student.user_id', '=', 'users.id')
            ->join('program', 'student.program_id', '=', 'program.id')
            ->join('college', 'program.college_id', '=', 'college.id')
            ->select('student.id', 'student.first_name', 'student.last_name', 'users.email', 'program.name as program', 'college.name as college')
            ->get();

        return $students;
    }
    public function fetchAdviser()
    {
        $advisers = DB::table('adviser')
            ->join('users', 'adviser.user_id', '=', 'users.id')
            ->join('college', 'college_id', '=', 'college.id')
            ->select('adviser.id', 'adviser.first_name', 'adviser.last_name', 'users.email', 'college.name as college')
            ->get();

        return $advisers;
    }public function fetchCollege()
    {
        $college = College::with('program')->get(); // Load programs within each college
        return $college;
    }
    public function fetchProgram()
    {
        $program = DB::table('program')
            ->select('id', 'name', 'abbreviation')
            ->get();

        return $program;
    }
    public function updateStudent(Request $request) {
        $student = Student::findOrFail($request->student_id);
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->program_id = $request->program_id;
        $student->section_id = $request->section_id;
        $student->year_id = $request->year_id;
        $student->college_id = $request->college_id;
        $student->save();

        $user = User::findOrFail($student->user_id);
        $user->email = $request->email;
        $user->save();
    
        return redirect()->back()->with('success', 'Student updated successfully!');
    }

    public function updateAdviser(Request $request) {
        $adviser = Adviser::findOrFail($request->adviser_id);
        $adviser->first_name = $request->first_name;
        $adviser->last_name = $request->last_name;
        $adviser->college_id = $request->college_id;
        $adviser->save();

        $user = User::findOrFail($adviser->user_id);
        $user->email = $request->email;
        $user->save();
    
        return redirect()->back()->with('success', 'Adviser updated successfully!');
    }

    public function filterProgram(Request $request) {
        $collegeId = $request->input('college_id');
    
        // Fetch programs only for the selected college
        $programs = Program::where('college_id', $collegeId)->get();
    
        return response()->json($programs);
    }
    public function storeCollege(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    College::create([
        'name' => $request->name,
    ]);

    return redirect()->back()->with('success', 'College added successfully!');
}

public function updateCollege(Request $request)
{
    $college = College::findOrFail($request->college_id);
    $college->name = $request->name;
    $college->save();

    return redirect()->back()->with('success', 'College updated successfully!');
}

public function destroyCollege($id)
{
    $college = College::findOrFail($id);
    $college->delete();

    return redirect()->back()->with('success', 'College deleted successfully!');
}

public function storeProgram(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'abbreviation' => 'required|string|max:10',
        'college_id' => 'required|exists:college,id',
    ]);

    Program::create([
        'name' => $request->name,
        'abbreviation' => $request->abbreviation,
        'college_id' => $request->college_id,
    ]);

    return redirect()->back()->with('success', 'Program added successfully!');
}

public function updateProgram(Request $request)
{
    $program = Program::findOrFail($request->program_id);
    $program->name = $request->name;
    $program->abbreviation = $request->abbreviation;
    $program->college_id = $request->college_id;
    $program->save();

    return redirect()->back()->with('success', 'Program updated successfully!');
}

public function destroyProgram($id)
{
    $program = Program::findOrFail($id);
    $program->delete();

    return redirect()->back()->with('success', 'Program deleted successfully!');
}

// Store a new student
public function storeStudent(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'college_id' => 'required|exists:college,id',
        'program_id' => 'nullable|exists:program,id',
    ]);

    User::create([
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'email' => $validated['email'],
        'role' => 'student',
        'password' => bcrypt('defaultpassword'), // Default password
    ]);

    Student::create([
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'user_id' => User::where('email', $validated['email'])->first()->id,
        'college_id' => $validated['college_id'],
        'program_id' => $validated['program_id'] ?? null,
    ]);

    return redirect()->back()->with('success', 'Student added successfully!');
}

public function storeAdviser(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'college_id' => 'required|exists:college,id',
    ]);

    User::create([
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'email' => $validated['email'],
        'role' => 'adviser',
        'college_id' => $validated['college_id'],
        'password' => bcrypt('defaultpassword'),
    ]);

    Adviser::create([
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'user_id' => User::where('email', $validated['email'])->first()->id,
        'college_id' => $validated['college_id'],
    ]);

    return redirect()->back()->with('success', 'Adviser added successfully!');
}

// Delete a student
public function destroyStudent($id)
{
    $student = Student::findOrFail($id);
    $student->delete();

    return redirect()->back()->with('success', 'Student deleted successfully.');
}

// Delete an adviser
public function destroyAdviser($id)
{
    $adviser = Adviser::findOrFail($id);
    $adviser->delete();

    return redirect()->back()->with('success', 'Adviser deleted successfully.');
}
}
