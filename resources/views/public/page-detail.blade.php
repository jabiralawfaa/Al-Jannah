@extends('layouts.public')

@section('title', $page->title)

@section('content')
<div class="container" style="max-width:800px;margin:0 auto;padding:2rem 1rem;">
    <h1 style="font-family:'Poppins',sans-serif;font-size:2rem;font-weight:700;color:#16423c;margin-bottom:0.5rem;">{{ $page->title }}</h1>
    <hr style="border:none;border-top:2px solid #6A9C89;margin:1rem 0 2rem 0;">
    <div class="post-content" style="font-family:'Poppins',sans-serif;font-size:1.0625rem;line-height:1.9;color:#2b2b2b;">
        {!! str($page->content)->sanitizeHtml() !!}
    </div>
</div>
@endsection