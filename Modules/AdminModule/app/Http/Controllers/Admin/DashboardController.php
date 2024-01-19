<?php

namespace Modules\AdminModule\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\AdminModule\app\Models\Blog;

class DashboardController extends Controller
{
    private $user;
    private $blog;

    public function __construct(User $user, Blog $blog)
    {
        $this->user = $user;
        $this->blog = $blog;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_count = $this->user->active()->count();
        $teacher_count = $this->user->active()->type(TEACHER)->count();
        $student_count = $this->user->active()->type(STUDENT)->count();
        $blog_count = $this->blog->active()->count();
        $blogs = $this->blog->with('owner')->latest()->paginate(5);
        return view('adminmodule::dashboard', compact('user_count', 'teacher_count', 'student_count', 'blog_count', 'blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminmodule::create');
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
        return view('adminmodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('adminmodule::edit');
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
