<nav aria-label="breadcrumb">
    <ol class="breadcrumb lead" style="font-size:0.9rem">
        <li class="breadcrumb-item"><a href="{{ route('page.index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Post</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
    </ol>
</nav>