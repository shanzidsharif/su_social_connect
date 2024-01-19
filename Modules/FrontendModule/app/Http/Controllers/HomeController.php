<?php

namespace Modules\FrontendModule\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\AdminModule\app\Models\Blog;
use Modules\AdminModule\app\Models\BlogComment;
use Modules\AdminModule\app\Models\Notice;
use Modules\StudentModule\app\Models\FollowRequest;

class HomeController extends Controller
{
    private $notice;
    private $blog;
    private $follow_request;
    private $user;
    private $blog_comment;

    public function __construct(Notice $notice, Blog $blog, FollowRequest $follow_request, User $user, BlogComment $blog_comment)
    {
        $this->notice = $notice;
        $this->blog = $blog;
        $this->follow_request = $follow_request;
        $this->user = $user;
        $this->blog_comment = $blog_comment;
    }
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $admin_ids = $this->user->active()->whereIn('user_type', ADMIN)->pluck('id')->toArray();

        $blogs = $this->blog->with('owner')->active();

        if (auth()->check() && auth()->user()->user_type === STUDENT) {
            $follow_teachers_user_id = $this->follow_request
                ->where('student_user_id', auth()->user()->id)
                ->where('status', 'accepted')
                ->pluck('teacher_user_id')->toArray();
            $admin_teacher_ids = array_merge($admin_ids, $follow_teachers_user_id);

            $blogs = $blogs->whereIn('created_by', $admin_teacher_ids);
        } else {

            $blogs = $blogs->whereIn('created_by', $admin_ids);
        }
        $blogs = $blogs->latest()->paginate(5);
        $notices = $this->notice->active()->latest()->get();
        return view('frontendmodule::home', compact('notices', 'blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function all_notices()
    {
        $notices = $this->notice->active()->latest()->paginate(5);
        return view('frontendmodule::all-notices', compact('notices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function blog_details($id)
    {
        $blog = $this->blog->with('owner', 'comments.owner')->find($id);
        return view('frontendmodule::blog-details', compact('blog'));
    }

    /**
     * Show the specified resource.
     */
    public function blog_comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        $blog_comment = $this->blog_comment;
        $blog_comment['blog_id'] = $id;
        $blog_comment['comment'] = $request['comment'];
        $blog_comment['created_by'] = auth()->id();
        $blog_comment->save();

        return back()->with('success', DEFAULT_200_STORE['message']);
    }
}
