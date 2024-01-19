<?php

namespace Modules\StudentModule\app\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\StudentModule\app\Models\FollowRequest;
use Modules\TeacherModule\app\Models\Teacher;

class FrontendController extends Controller
{
    private $teacher;
    private $user;
    private $follow_request;

    public function __construct(Teacher $teacher, User $user, FollowRequest $follow_request)
    {
        $this->teacher = $teacher;
        $this->user = $user;
        $this->follow_request = $follow_request;
    }
    /**
     * Display a listing of the resource.
     */
    public function teachers_list()
    {
        $teachers = $this->user->with('teacher')->active()->type(TEACHER)->latest()->paginate(10);
        $follow_requests = $this->follow_request->where('student_user_id', auth()->user()->id)->get();
        return view('studentmodule::frontend.teachers-list', compact('teachers', 'follow_requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function send_follow_request($teacher_user_id)
    {
        $follow_request = $this->follow_request;
        $follow_request['teacher_user_id'] = $teacher_user_id;
        $follow_request['student_user_id'] = auth()->user()->id;
        $follow_request['status'] = 'pending';
        $follow_request->save();

        return back()->with('success', DEFAULT_FOLLOW_REQUEST_200['message']);
    }

    public function delete_follow_request($teacher_user_id)
    {
        $this->follow_request->where('teacher_user_id', $teacher_user_id)
            ->where('student_user_id', auth()->id())
            ->first()->delete();

        return back()->with('success', DEFAULT_200_UPDATE['message']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
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
