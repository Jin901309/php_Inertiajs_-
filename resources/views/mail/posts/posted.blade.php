@component('mail::message')
# 누군가 게시글에 글을 작성했어요.

**{{  $user->username }}**님 누군가 타임라인에 글을 작성했어요.





@component('mail::button', ['url' => route('dashboard.index')])
확인하기
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
