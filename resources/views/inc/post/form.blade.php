<input class="form-control mb-3 @error('title') is-invalid @enderror" type="text"
            name="title" id="title" placeholder="Enter Title Here.." value="{{ old('title') ?? $post->title }}">
<textarea class="form-control" name="body" id="body">{{ old('body') ?? $post->body }}</textarea>