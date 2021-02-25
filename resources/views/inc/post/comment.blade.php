@php
    function is_liked_or_disliked($comment) {
        $like = $comment->likes()->where('user_id', Auth::id())->first();
        if (!is_null($like)) {
            return $like->type;
        }
    }
@endphp

<section class="post-commentbox">
    @if ( auth()->check() || $comments->isNotEmpty() )
        <h1 class="mb-5 font-weight-bold">Comments</h1>
    @endif
    @auth      
        <div class="row">
            <div class="col">
                <div class="comment d-flex flex-column p-4">
                    <h6>Write your comment</h6>
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('comment.store', ['post' => $post]) }}" method="post">
                                @csrf
                                <textarea class="form-control" name="comment" id="comment"></textarea>
                                <button type="submit" class="btn btn-outline-primary mt-3">Create Comment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
    @foreach ($comments as $comment)
        <div class="comment d-flex flex-column p-4">
            <div class="comment-inner-wrapper d-flex flex-row">
                <div class="flex-shrink-1align-self-md-center mr-4">
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
                            <a>Reply</a>
                        </div>
                    @endauth
                </div>
            </div>

            @if ($comment->replies->isNotEmpty())

            <div class="my-2"></div>

            @foreach ($comment->replies as $reply)
                <div class="comment d-flex flex-column p-3 ml-5">
                    <div class="comment-inner-wrapper d-flex flex-row">
                        <div class="flex-shrink-1align-self-md-center mr-4">
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
                </div>
            @endforeach
                
            @endif

        </div>
    @endforeach
</section>