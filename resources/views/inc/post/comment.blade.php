<section class="post-commentbox">
    <h1 class="mb-5 font-weight-bold">Comments</h1>
    <div class="row">
        <div class="col">
            <div class="comment d-flex flex-column p-4">
                <h6>Write your comment</h6>
                <div class="row">
                    <div class="col">
                        <form action="{{ route('post.comment.store', ['post' => $post]) }}" method="post">
                            @csrf
                            <textarea class="form-control" name="comment" id="comment"></textarea>
                            <button type="submit" class="btn btn-outline-primary mt-3">Create Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($comments as $comment)
        <div class="row">
            <div class="col">
                <div class="comment d-flex p-4">
                    <div class="flex-shrink-1 mr-3 align-self-md-center">
                        <img class="rounded-circle" src="https://img.favpng.com/21/10/23/computer-icons-avatar-social-media-blog-font-awesome-png-favpng-jKXEv9rWhum7VbNKDbcELd6Di_t.jpg" alt="Profile Picture" width="64" height="64">
                    </div>
                    <div class="ml-2 text-justify text-secondary">
                        <h5 class="font-weight-bold">{{ $comment->user->name }}</h5>
                        <span>{{ $comment->text }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</section>