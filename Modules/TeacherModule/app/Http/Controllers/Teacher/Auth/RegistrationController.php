<?php

namespace Modules\TeacherModule\app\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TeacherModule\app\Models\Teacher;

class RegistrationController extends Controller
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
    public function registration()
    {
        return view('teachermodule::auth.registration');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function submit(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'teacher_id' => 'required',
            'department' => 'required',
        ]);

        $user = $this->user;
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->password = bcrypt($request['password']);
        $user->user_type = TEACHER;
        if ($request->has('profile_image')) {
            $user->profile_image = image_uploader('users/profile_images/', 'png', $request['profile_image'], null);
        }
        $user->is_active = 0;
        $user->is_verified = 0;
        $user->save();

        $teacher = $this->teacher;
        $teacher['user_id'] = $user->id;
        $teacher['teacher_id'] = $request['teacher_id'];
        $teacher['department'] = $request['department'];
        $teacher->save();

        return redirect()->route('frontend.home')->with('success', DEFAULT_REGISTRATION_REQUEST_200['message']);
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
        return view('studentmodule::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
