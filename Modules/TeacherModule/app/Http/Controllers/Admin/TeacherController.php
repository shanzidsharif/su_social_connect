<?php

namespace Modules\TeacherModule\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\TeacherModule\app\Models\Teacher;

class TeacherController extends Controller
{
    private $user;
    private $teacher;

    public function __construct(User $user, Teacher $teacher)
    {
        $this->user = $user;
        $this->teacher = $teacher;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $teachers = $this->user->with('teacher')->Type(TEACHER)->when($request->has('search'), function ($query) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $query->Where('first_name', 'like', "%{$value}%");
            }
        })->latest()->paginate(10);

        return view('teachermodule::admin.teacher.list', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachermodule::admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_image' => 'required|image',
            'teacher_id' => 'required|string|max:50',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:50',
            'department' => 'required|string|max:50',
        ]);

        $user = $this->user;
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->user_type = 'teacher-admin';
        $user->profile_image = image_uploader('users/profile_images/', 'png', $request['profile_image'], null);
        $user->is_active = 1;
        $user->is_verified = 1;
        $user->save();

        $teacher = $this->teacher;
        $teacher->user_id = $user->id;
        $teacher->teacher_id = $request['teacher_id'];
        $teacher->department = $request['department'];
        $teacher->save();


        return redirect()->route('admin.teachers.index')->with('success',DEFAULT_200_STORE['message']);
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
        $teacher = $this->user->with('teacher')->Type(TEACHER)->findOrFail($id);
        return view('teachermodule::admin.teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'profile_image' => 'image',
            'teacher_id' => 'required|string|max:50',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|string|max:50',
            'department' => 'required|string|max:50',
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

        $teacher = $this->teacher->where('user_id', $user->id)->first();
        $teacher->teacher_id = $request['teacher_id'];
        $teacher->department = $request['department'];
        $teacher->save();


        return redirect()->route('admin.teachers.index')->with('success',DEFAULT_200_UPDATE['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = $this->user->where(['id' => $id])->first();
        file_remover('users/profile_images/', $user->profile_image);
        $user->teacher->delete();
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
        $this->user->where('id', $id)->update(['is_verified' => !$this->user->find($id)->is_active]);
        return response()->json(response_structure(DEFAULT_200_UPDATE), 200);
    }
}
