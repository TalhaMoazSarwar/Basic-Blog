@component('mail::message')
# You have created a New Post

<b>Title</b>: {{ $post->title }}
<br>
<b>Date</b>: {{ $post->created_at }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
