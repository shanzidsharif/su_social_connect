<?php

namespace Modules\StudentModule\app\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\StudentModule\app\Models\Student;

class RegistrationController extends Controller
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
    public function registration()
    {
        return view('studentmodule::auth.registration');
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
            'student_id' => 'required',
            'department' => 'required',
            'subject' => 'required',
        ]);

        $user = $this->user;
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->password = bcrypt($request['password']);
        $user->user_type = STUDENT;
        if ($request->has('profile_image')) {
            $user->profile_image = image_uploader('users/profile_images/', 'png', $request['profile_image'], null);
        }
        $user->is_active = 0;
        $user->is_verified = 0;
        $user->save();

        $student = $this->student;
        $student['user_id'] = $user->id;
        $student['student_id'] = $request['student_id'];
        $student['department'] = $request['department'];
        $student['subject'] = $request['subject'];
        $student->save();

        return redirect()->route('frontend.home')->with('success', DEFAULT_REGISTRATION_REQUEST_200['message']);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('studentmodule::show');
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
