<?php

namespace Modules\StudentModule\app\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\AdminModule\app\Models\Message;
use Modules\StudentModule\app\Models\FollowRequest;
use Pusher\Pusher;

class MessageController extends Controller
{
    private $follow_request;
    private $user;

    public function __construct(FollowRequest $follow_request, User $user)
    {
        $this->follow_request = $follow_request;
        $this->user = $user;
    }

    // show all groups that User is Follow
    public function index()
    {
        $admin_ids = $this->user->active()->whereIn('user_type', ADMIN)->pluck('id')->toArray();
        $follow_teachers_user_id = $this->follow_request
            ->where('student_user_id', auth()->user()->id)
            ->where('status', 'accepted')
            ->pluck('teacher_user_id')->toArray();
        $admin_teacher_ids = array_merge($admin_ids, $follow_teachers_user_id);
        // select all Users + count how many message are unread from the selected user
        $users = DB::table('users')
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.user_type', DB::raw('count(is_read) as unread'))
            ->leftJoin('messages', function ($join) {
                $join->on('users.id', '=', 'messages.from')
                    ->where('is_read', '=', 0)
                    ->where('messages.to', '=', auth()->id());
            })
            ->where('users.id', '!=', auth()->id())
            ->whereIn('users.id', $admin_teacher_ids)
            ->groupBy('users.id', 'users.first_name', 'users.last_name', 'users.user_type')
            ->orderByDesc(DB::raw('(SELECT MAX(created_at) FROM messages WHERE messages.to = users.id)'))
            ->get();

        return view('studentmodule::message.chat', ['users' => $users]);
    }
    // get all Messages
    public function getMessage($user_id)
    {
        $my_id = auth()->id();

        // Make read all unread message sent
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        return view('studentmodule::message.message', ['messages' => $messages]);
    }

    // send new message
    public function sendMessage(Request $request)
    {
        $from = auth()->id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        return $this->sendRequest($from, $message, $to);
    }
    public function sendRequest($from, $message, $to)
    {
        $users = DB::select("SELECT * FROM messages WHERE messages.to = " . auth()->id() . " ");
        if (isset($users)) {
            foreach ($users as $p) {
                $Data = $p->to;
            }
        }
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        // notification
        $data = ['from' => $from, 'to' => $to];
        $notify = 'notify-channel';
        $pusher->trigger($notify, 'App\\Events\\Notify', $data);
    }
}
