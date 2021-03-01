@php
    function is_liked_or_disliked($model) {
        $like = $model->likes()->where('user_id', Auth::id())->first();
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
                <textarea class="form-control" name="comment"></textarea>
                <button type="submit" class="btn btn-outline-primary mt-3">Comment</button>
            </form>
        </div>
    @endauth
    {{-- Comment Show Box --}}
    @foreach ($comments as $comment)
        <div id="comment-id-{{$comment->id}}" class="comment d-flex flex-column p-4">
            <div class="d-flex flex-row">
                <div class="mr-4">
                    <img class="rounded-circle" src="https://img.favpng.com/21/10/23/computer-icons-avatar-social-media-blog-font-awesome-png-favpng-jKXEv9rWhum7VbNKDbcELd6Di_t.jpg" alt="Profile Picture" width="64" height="64">
                </div>
                <div class="comment-content text-justify text-secondary">
                    <h5 class="font-weight-bold d-inline">{{ $comment->user->name }}</h5>
                    <small class="text-muted"> ({{ $comment->age }})</small>
                    <span class="d-block mt-1">{{ $comment->text }}</span>
                    @auth
                        <div class="comment-actionbox small mt-1" data-comment-id="{{ $comment->id }}">
                            <a class="comment-like {{ is_liked_or_disliked($comment) === 1 ? 'text-success' : '' }}">
                                <i class="far fa-thumbs-up"></i> <span>{{ is_liked_or_disliked($comment) === 1 ? 'Liked' : 'Like' }}</span>
                            </a>
                            <a class="comment-dislike ml-3 {{ is_liked_or_disliked($comment) === 0 ? 'text-danger' : '' }}">
                                <i class="far fa-thumbs-down"></i> <span>{{ is_liked_or_disliked($comment) === 0 ? 'Disliked' : 'Dislike' }}</span>
                            </a>
                            <a class="comment-reply ml-3"><i class="fas fa-reply"></i> <span>Reply</span></a>
                            @if ($comment->user_id == Auth::id())
                                <a class="comment-edit ml-3"><i class="fas fa-edit"></i> <span>Edit</span></a>
                                <form class="d-inline" action="{{ route('comment.destroy', ['comment' => $comment]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a class="comment-delete ml-3"><i class="fas fa-trash-alt"></i> <span>Delete</span></a>
                                </form>
                            @endif
                        </div>
                    @endauth
                </div>
                {{-- Comment Edit Box --}}
                @auth
                    <div class="comment-edit-box w-100">
                        <form action="{{ route('comment.update', ['comment' => $comment]) }}" method="post">
                            @csrf
                            @method('patch')
                            <textarea class="form-control" name="comment">{{ $comment->text }}</textarea>
                            <button type="submit" class="btn btn-outline-primary mt-3">Update</button>
                            <button type="button" class="btn btn-outline-danger mt-3 ml-2 comment-edit-box-cancel">Cancel</button>
                        </form>
                    </div>
                @endauth
            </div>
            {{-- Reply Create Box --}}
            @auth
                <div class="reply reply-box p-3 ml-5 mt-2">
                    <h6>Write your reply:</h6>
                    <form action="{{ route('reply.store', ['comment' => $comment]) }}" method="post">
                        @csrf
                        <textarea class="form-control" name="reply"></textarea>
                        <button type="submit" class="btn btn-outline-primary mt-3">Reply</button>
                    </form>
                </div>
            @endauth
            {{-- Reply Show Box --}}
            @foreach ($comment->replies()->orderBy('created_at', 'desc')->get() as $reply)
                <div id="reply-id-{{$reply->id}}" class="reply d-flex flex-row p-3 ml-5 mt-2">
                    <div class="mr-4">
                        <img class="rounded-circle" src="https://img.favpng.com/21/10/23/computer-icons-avatar-social-media-blog-font-awesome-png-favpng-jKXEv9rWhum7VbNKDbcELd6Di_t.jpg" alt="Profile Picture" width="64" height="64">
                    </div>
                    <div class="reply-content text-justify text-secondary">
                        <h5 class="font-weight-bold d-inline">{{ $reply->user->name }}</h5>
                        <small class="text-muted"> ({{ $reply->age }})</small>
                        <span class="d-block mt-1">{{ $reply->text }}</span>
                        @auth
                            <div class="reply-actionbox small mt-1" data-reply-id="{{ $reply->id }}">
                                <a class="reply-like {{ is_liked_or_disliked($reply) === 1 ? 'text-success' : '' }}">
                                    <i class="far fa-thumbs-up"></i> <span>{{ is_liked_or_disliked($reply) === 1 ? 'Liked' : 'Like' }}</span>
                                </a>
                                <a class="reply-dislike ml-3 {{ is_liked_or_disliked($reply) === 0 ? 'text-danger' : '' }}">
                                    <i class="far fa-thumbs-down"></i> <span>{{ is_liked_or_disliked($reply) === 0 ? 'Disliked' : 'Dislike' }}</span>
                                </a>
                                @if ($reply->user_id == Auth::id())
                                    <a class="reply-edit ml-3"><i class="fas fa-edit"></i> <span>Edit</span></a>
                                    <form class="d-inline" action="{{ route('reply.destroy', ['reply' => $reply]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a class="reply-delete ml-3"><i class="fas fa-trash-alt"></i> <span>Delete</span></a>
                                    </form>
                                @endif
                            </div>
                        @endauth
                    </div>
                    {{-- Reply Edit Box --}}
                    @auth
                        <div class="reply-edit-box w-100">
                            <form action="{{ route('reply.update', ['reply' => $reply]) }}" method="post">
                                @csrf
                                @method('patch')
                                <textarea class="form-control" name="reply">{{ $reply->text }}</textarea>
                                <button type="submit" class="btn btn-outline-primary mt-3">Update</button>
                                <button type="button" class="btn btn-outline-danger mt-3 ml-2 reply-edit-box-cancel">Cancel</button>
                            </form>
                        </div>
                    @endauth
                </div>
            @endforeach
        </div>
    @endforeach
</section>