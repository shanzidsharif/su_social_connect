<?php

namespace Modules\TeacherModule\app\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\AdminModule\app\Models\Blog;
use Modules\StudentModule\app\Models\FollowRequest;

class DashboardController extends Controller
{
    private $follow_request;
    private $blog;

    public function __construct(FollowRequest $follow_request, Blog $blog)
    {
        $this->follow_request = $follow_request;
        $this->blog = $blog;
    }
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $follow_count = $this->follow_request->where('teacher_user_id', auth()->id())->where('status', 'accepted')->count();
        $blog_count = $this->blog->active()->where('created_by', auth()->id())->count();
        $blogs = $this->blog->with('owner')->latest()->paginate(5);
        return view('teachermodule::dashboard', compact('follow_count', 'blog_count', 'blogs'));
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
        return view('teachermodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('teachermodule::edit');
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
