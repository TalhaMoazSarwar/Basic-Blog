@php
    function is_liked_or_disliked($comment) {
        $like = $comment->likes()->where('user_id', Auth::id())->first();
        if (!is_null($like)) {
            return $like->type;
        }
    }
@endphp
{{-- Main Comment Box --}}
<section class="post-commentbox">
    @if ( auth()->check() || $comments->isNotEmpty() )
        <h1 class="mb-5 font-weight-bold">Comments</h1>
    @endif
    {{-- Comment Create Box --}}
    @auth      
        <div class="comment p-4">
            <h6>Write your comment:</h6>
            <form action="{{ route('comment.store', ['post' => $post]) }}" method="post">
                @csrf
                <textarea class="form-control" name="comment" id="comment"></textarea>
                <button type="submit" class="btn btn-outline-primary mt-3">Comment</button>
            </form>
        </div>
    @endauth
    {{-- Comment Show Box --}}
    @foreach ($comments as $comment)
        <div class="comment d-flex flex-column p-4">
            <div class="d-flex flex-row">
                <div class="mr-4">
                    <img class="rounded-circle" src="https://img.favpng.com/21/10/23/computer-icons-avatar-social-media-blog-font-awesome-png-favpng-jKXEv9rWhum7VbNKDbcELd6Di_t.jpg" alt="Profile Picture" width="64" height="64">
                </div>
                <div class="text-justify text-secondary">
                    <h5 class="font-weight-bold d-inline">{{ $comment->user->name }}</h5>
                    <small class="text-muted"> ({{ $comment->age }})</small>
                    <span class="d-block mt-1">{{ $comment->text }}</span>
                    @auth
                        <div class="comment-actionbox small mt-1" data-comment-id="{{ $comment->id }}">
                            <a class="comment-like {{ is_liked_or_disliked($comment) === 1 ? 'text-primary' : '' }}"><span>{{ is_liked_or_disliked($comment) === 1 ? 'Liked' : 'Like' }}</span></a>
                            <a class="comment-dislike mx-3 {{ is_liked_or_disliked($comment) === 0 ? 'text-primary' : '' }}"><span>{{ is_liked_or_disliked($comment) === 0 ? 'Disliked' : 'Dislike' }}</span></a>
                            <a class="comment-reply">Reply</a>
                        </div>
                    @endauth
                </div>
            </div>
            {{-- Modify This Start --}}
            <div class="my-2"></div>
            {{-- Modify This End --}}

            {{-- Reply Show Box --}}
            <div class="reply reply-box p-3 ml-5">
                <h6>Write your reply:</h6>
                <textarea class="form-control" name="reply" id="reply"></textarea>
                <button type="submit" class="btn btn-outline-primary mt-3">Reply</button>
            </div>

            @foreach ($comment->replies()->orderBy('created_at', 'desc')->get() as $reply)
                <div class="reply d-flex flex-row p-3 ml-5">
                    <div class="mr-4">
                        <img class="rounded-circle" src="https://img.favpng.com/21/10/23/computer-icons-avatar-social-media-blog-font-awesome-png-favpng-jKXEv9rWhum7VbNKDbcELd6Di_t.jpg" alt="Profile Picture" width="64" height="64">
                    </div>
                    <div class="text-justify text-secondary">
                        <h5 class="font-weight-bold d-inline">{{ $reply->user->name }}</h5>
                        <small class="text-muted"> ({{ $reply->age }})</small>
                        <span class="d-block mt-1">{{ $reply->text }}</span>
                        @auth
                            <div class="reply-actionbox small mt-1" data-reply-id="{{ $reply->id }}">
                                <a class="reply-like {{ is_liked_or_disliked($reply) === 1 ? 'text-primary' : '' }}"><span>Like</span></a>
                                <a class="reply-dislike ml-3 {{ is_liked_or_disliked($reply) === 0 ? 'text-primary' : '' }}"><span>Dislike</span></a>
                            </div>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</section>