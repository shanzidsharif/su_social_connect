<?php

namespace Modules\AdminModule\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\AdminModule\app\Models\Notice;

class NoticeController extends Controller
{
    private $notice;

    public function __construct(Notice $notice)
    {
        $this->notice = $notice;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $notices = $this->notice->when($request->has('search'), function ($query) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $query->Where('title', 'like', "%{$value}%");
            }
        })->latest()->paginate(10);

        return view('adminmodule::notice.list', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminmodule::notice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $notice = $this->notice;
        $notice->title = $request['title'];
        $notice->description = $request['description'];
        $notice->is_active = 1;
        $notice->save();

        return redirect()->route('admin.notices.index')->with('success', DEFAULT_200_STORE['message']);
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
        $notice = $this->notice->findOrFail($id);
        return view('adminmodule::notice.edit', compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $notice = $this->notice->find($id);
        $notice->title = $request['title'];
        $notice->description = $request['description'];
        $notice->save();

        return redirect()->route('admin.notices.index')->with('success', DEFAULT_200_UPDATE['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $notice = $this->notice->where(['id' => $id])->first();
        $notice->delete();
        session()->flash('success', DEFAULT_200_DELETE['message']);
        return back();
    }

    public function status_update(string $id): JsonResponse
    {
        $this->notice->where('id', $id)->update(['is_active' => !$this->notice->find($id)->is_active]);
        return response()->json(response_structure(DEFAULT_200_UPDATE), 200);
    }
}
