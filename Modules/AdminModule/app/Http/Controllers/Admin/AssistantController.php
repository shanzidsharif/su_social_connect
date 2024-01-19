<?php

namespace Modules\AdminModule\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AssistantController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $assistants = $this->user->Type(ADMIN[1])->when($request->has('search'), function ($query) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $query->Where('first_name', 'like', "%{$value}%");
            }
        })->latest()->paginate(10);

        return view('adminmodule::admin.assistant.list', compact('assistants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminmodule::admin.assistant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_image' => 'image',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        $user = $this->user;
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->password = bcrypt($request['password']);
        $user->user_type = ADMIN[1];
        if ($request->has('profile_image')) {
            $user->profile_image = image_uploader('users/profile_images/', 'png', $request['profile_image'], null);
        }
        $user->is_active = 1;
        $user->is_verified = 1;
        $user->save();

        return redirect()->route('admin.assistants.index')->with('success', DEFAULT_200_STORE['message']);
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
        $assistant = $this->user->Type(ADMIN[1])->findOrFail($id);
        return view('adminmodule::admin.assistant.edit', compact('assistant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'profile_image' => 'image',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required'
        ]);

        $user = $this->user->findOrFail($id);
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        if ($request->has('profile_image')) {
            $user->profile_image = image_uploader('users/profile_images/', 'png', $request['profile_image'], null);
        }
        $user->is_active = 1;
        $user->is_verified = 1;
        $user->save();

        return redirect()->route('admin.assistants.index')->with('success', DEFAULT_200_UPDATE['message']);
    }

    public function update_password(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        $user = $this->user->findOrFail($id);
        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('admin.assistants.index')->with('success', DEFAULT_200_PASSWORD_RESET['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = $this->user->where(['id' => $id])->first();
        if(!empty($user->profile_image)){
            file_remover('users/profile_images/', $user->profile_image);
        }
        $user->delete();
        session()->flash('success', DEFAULT_200_DELETE['message']);
        return back();
    }

    public function status_update(string $id): JsonResponse
    {
        $this->user->where('id', $id)->update(['is_active' => !$this->user->find($id)->is_active]);
        return response()->json(response_structure(DEFAULT_200_UPDATE), 200);
    }

    public function verification_update(string $id): JsonResponse
    {
        $this->user->where('id', $id)->update(['is_verified' => !$this->user->find($id)->is_active]);
        return response()->json(response_structure(DEFAULT_200_UPDATE), 200);
    }
}
