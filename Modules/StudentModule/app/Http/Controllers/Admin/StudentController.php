<?php

namespace Modules\StudentModule\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\StudentModule\app\Models\Student;

class StudentController extends Controller
{
    private $user;
    private $student;

    public function __construct(User $user, Student $student)
    {
        $this->user = $user;
        $this->student = $student;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = $this->user->with('student')->Type(STUDENT)->when($request->has('search'), function ($query) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $query->Where('first_name', 'like', "%{$value}%");
            }
        })->latest()->paginate(10);

        return view('studentmodule::admin.student.list', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('studentmodule::admin.student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_image' => 'required|image',
            'student_id' => 'required|string|max:50',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:50',
            'department' => 'required|string|max:50',
            'subject' => 'required|string|max:50',
        ]);

        $user = $this->user;
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->user_type = 'student';
        $user->profile_image = image_uploader('users/profile_images/', 'png', $request['profile_image'], null);
        $user->is_active = 1;
        $user->is_verified = 1;
        $user->save();

        $student = $this->student;
        $student->user_id = $user->id;
        $student->student_id = $request['student_id'];
        $student->department = $request['department'];
        $student->subject = $request['subject'];
        $student->save();

        return redirect()->route('admin.students.index')->with('success',DEFAULT_200_STORE['message']);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('teachermodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = $this->user->with('student')->Type(STUDENT)->findOrFail($id);
        return view('studentmodule::admin.student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'profile_image' => 'image',
            'student_id' => 'required|string|max:50',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|string|max:50',
            'department' => 'required|string|max:50',
            'subject' => 'required|string|max:50',
        ]);

        $user = $this->user->findOrFail($id);
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        if($request->has('profile_image')){
            $user->profile_image = image_uploader('users/profile_images/', 'png', $request['profile_image'], $user->profile_image);
        }
        $user->save();

        $student = $this->student->where('user_id', $user->id)->first();
        $student->student_id = $request['student_id'];
        $student->department = $request['department'];
        $student->subject = $request['subject'];
        $student->save();


        return redirect()->route('admin.students.index')->with('success',DEFAULT_200_UPDATE['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = $this->user->where(['id' => $id])->first();
        file_remover('users/profile_images/', $user->profile_image);
        $user->student->delete();
        $user->delete();
        session()->flash('success', DEFAULT_200_DELETE['message']);
        return back();
    }

    public function status_update(string $id): JsonResponse
    {
        $this->user->where('id', $id)->update(['is_active' => !$this->user->find($id)->is_active]);
        return response()->json(response_structure(DEFAULT_200_UPDATE), 200);
    }

    public function verification_update(string $id): JsonResponse
    {
        $this->user->where('id', $id)->update(['is_verified' => !$this->user->find($id)->is_verified]);
        return response()->json(response_structure(DEFAULT_200_UPDATE), 200);
    }
}
