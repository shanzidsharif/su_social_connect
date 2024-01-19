<?php

namespace Modules\TeacherModule\app\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\AdminModule\app\Models\Blog;
use Modules\AdminModule\app\Models\BlogComment;

class BlogController extends Controller
{
    private $blog;
    private $blog_comment;

    public function __construct(Blog $blog, BlogComment $blog_comment)
    {
        $this->blog = $blog;
        $this->blog_comment = $blog_comment;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $blogs = $this->blog->with('owner')->where('created_by', auth()->id())
            ->when($request->has('search'), function ($query) use ($request) {
                $key = explode(' ', $request['search']);
                foreach ($key as $value) {
                    $query->Where('title', 'like', "%{$value}%");
                }
            })->latest()->paginate(10);

        return view('teachermodule::blog.list', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachermodule::blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:10000',
            'title' => 'required|string',
            'description' => 'required',
        ]);

        $blog = $this->blog;
        $blog->image = image_uploader('blog/images/', 'png', $request['image'], null, 900, 560);
        $blog->title = $request['title'];
        $blog->description = $request['description'];
        $blog->created_by = auth()->user()->id;
        $blog->is_active = 1;
        $blog->save();

        return redirect()->route('teacher.blogs.index')->with('success', DEFAULT_200_STORE['message']);
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
        $blog = $this->blog->findOrFail($id);
        return view('teachermodule::blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
            'title' => 'required|string',
            'description' => 'required',
        ]);

        $blog = $this->blog->find($id);
        if ($blog['created_by'] == auth()->user()->id) {
            if ($request->has('image')) {
                $blog->image = image_uploader('blog/images/', 'png', $request['image'], $blog['image'], 900, 560);
            }
            $blog->title = $request['title'];
            $blog->description = $request['description'];
            $blog->save();
        } else {
            return redirect()->route('teacher.blogs.index')->with('error', 'Access denied !');
        }

        return redirect()->route('teacher.blogs.index')->with('success', DEFAULT_200_UPDATE['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = $this->blog->with('comments')->where(['id' => $id])->first();
        if (!empty($blog->image)) {
            file_remover('blog/images/', $blog->image);
        }
        $blog->comments->each(function ($item, $key) {
            $item->delete();
        });
        $blog->delete();
        session()->flash('success', DEFAULT_200_DELETE['message']);
        return back();
    }

    public function status_update(string $id): JsonResponse
    {
        $this->blog->where('id', $id)->update(['is_active' => !$this->blog->find($id)->is_active]);
        return response()->json(response_structure(DEFAULT_200_UPDATE), 200);
    }

    public function comment_get($id)
    {
        $blog_id = $id;
        $comments = $this->blog_comment->with('owner')->where('blog_id', $id)->latest()->paginate(10);

        return view('teachermodule::blog.comment.list', compact('comments', 'blog_id'));
    }

    public function comment_store(Request $request, $id)
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

    public function comment_destroy($id)
    {
        $this->blog_comment->find($id)->delete();
        session()->flash('success', DEFAULT_200_DELETE['message']);
        return back();
    }
}
