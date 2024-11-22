<div class="comment-container">
    <div class="comment-header">
        <strong>{{ $comment->customer->name }}</strong>
        <span class="comment-date">{{ $comment->created_at->format('d/m/Y') }}</span>
    </div>
    <div class="comment-content">
        <p>{{ $comment->content }}</p>
    </div>

    <!-- Hiển thị các bình luận con (replies) -->
    @if($comment->replies->count())
        <div class="replies-container">
            @foreach($comment->replies as $reply)
                @include('customer.posts.comment', ['comment' => $reply])
            @endforeach
        </div>
    @endif

    <!-- Nút Reply cho bình luận -->
    @auth('customer')
        <div class="reply-button-container">
            <button class="btn-reply" onclick="toggleReplyForm('reply-form-{{ $comment->id }}')">Reply</button>

            <!-- Form trả lời cho bình luận -->
            <div id="reply-form-{{ $comment->id }}" class="reply-form" style="display: none;">
                <form action="{{ url('posts/'.$post->id.'/comments') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" rows="2" name="content" placeholder="Reply to {{ $comment->customer->name }}..."></textarea>
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    </div>
                    <button type="submit" class="btn-submit">Submit Reply</button>
                </form>
            </div>
        </div>
    @endauth
</div>
