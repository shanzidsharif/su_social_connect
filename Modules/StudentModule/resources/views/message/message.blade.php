<div class="card">
    <div class="card-body p-0">
        <div class="message-wrapper">
            <ul class="messages">
                @foreach ($messages as $message)
                    <li class="message clearfix">
                        {{-- if message from id is equal to auth id then it is sent by logged in user --}}
                        <div class="{{ $message->from == Auth::id() ? 'sent' : 'received' }}">
                            <p>{{ $message->message }}</p>
                            <p class="date">{{ date('d M y, h:i a', strtotime($message->created_at)) }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="card-footer">
        <div class="row aling-items-center">
            <div class="col-md-10">
                <input type="text" class="form-control message-input" id="message-input" name="message-input"
                    placeholder="Enter your message">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary send-btn float-end w-100" id="send-btn">Send</button>
            </div>
        </div>
    </div>
</div>
