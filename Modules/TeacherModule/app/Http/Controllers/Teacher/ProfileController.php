<?php

namespace Modules\TeacherModule\app\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Modules\TeacherModule\app\Models\Teacher;

class ProfileController extends Controller
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
    public function get()
    {
        $user = $this->user->with('teacher')->find(auth()->id());
        return view('teachermodule::profile.show', compact('user'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = auth()->id();

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required',
            'teacher_id' => 'required',
            'department' => 'required',
        ]);

        $user = $this->user->find($id);
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        if ($request->has('profile_image')) {
            $user->profile_image = image_uploader('users/profile_images/', 'png', $request['profile_image'], $user['profile_image'] ?? NULL);
        }
        $user->is_active = 1;
        $user->is_verified = 1;
        $user->save();

        $teacher = $this->teacher->where('user_id', $id)->first();
        $teacher['teacher_id'] = $request['teacher_id'];
        $teacher['department'] = $request['department'];
        $teacher->save();

        return back()->with('success', DEFAULT_PROFILE_UPDATE_200['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function update_password(Request $request)
    {
        $request->validate([
            'old_pass' => 'required|min:8',
            'new_pass' => 'required|min:8',
            'confirm_pass' => 'required|same:new_pass',
        ]);

        $user = $this->user->find(auth()->id());

        if(!Hash::check($request->old_pass, $user->password))
        {
            return back()->withErrors(DEFAULT_200_PASSWORD_NOT_MATCH['message']);
        }

        $user['password'] = bcrypt($request['new_pass']);
        $user->save();

        return back()->with('success', DEFAULT_200_PASSWORD_RESET['message']);
    }
}
