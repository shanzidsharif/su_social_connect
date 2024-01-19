<?php

namespace Modules\TeacherModule\app\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\StudentModule\app\Models\FollowRequest;

class FollowRequestController extends Controller
{
    private $follow_request;

    public function __construct(FollowRequest $follow_request)
    {
        $this->follow_request = $follow_request;
    }
    /**
     * Display a listing of the resource.
     */
    public function get()
    {
        $follow_requests = $this->follow_request->with('student')
                            ->where('teacher_user_id', auth()->user()->id)
                            ->latest()->paginate(10);

        return view('teachermodule::follow-request', compact('follow_requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function accept($id)
    {
        $follow_request = $this->follow_request->find($id);
        $follow_request['status'] = 'accepted';
        $follow_request->save();

        return back()->with('success', 'Successfully accepted.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->follow_request->find($id)->delete();
        return back()->with('success', DEFAULT_200_DELETE['message']);
    }
}
