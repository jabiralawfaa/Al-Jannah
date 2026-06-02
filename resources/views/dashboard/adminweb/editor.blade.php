@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Beranda', 'url' => '/adminweb', 'active' => 'adminweb'],
        ['label' => 'Posts', 'url' => '/adminweb/posts', 'active' => 'adminweb/posts*'],
        ['label' => 'Pages', 'url' => '/adminweb/pages', 'active' => 'adminweb/pages'],
        ['label' => 'Menus', 'url' => '/adminweb/menus', 'active' => 'adminweb/menus*'],
        ['label' => 'Files & Images', 'url' => '#', 'active' => 'adminweb/files'],
    ]
])

@push('styles')
    @filamentStyles
    <link rel="stylesheet" href="{{ asset('css/filament/filament/app.css') }}">
@endpush

@push('scripts')
    @filamentScripts
@endpush

@section('title', 'Editor')

@php $post ??= null; @endphp

@section('content')
<style>
    :root {
        --primary-100: #e4e7ef;
        --primary-200: #c9d0df;
        --primary-300: #adb8cf;
        --primary-400: #92a0bf;
        --primary-500: #7788af;
        --primary-600: #5f6d8c;
        --primary-700: #475269;
        --primary-800: #303646;
        --primary-900: #16423c;
    }

    .editor-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
    }

    .editor-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        color: #16423c;
        text-decoration: none;
        transition: background 0.2s;
    }

    .editor-back:hover {
        background-color: rgba(22, 66, 60, 0.08);
    }

    .editor-title {
        font-size: 24px;
        font-weight: 700;
        color: #16423c;
    }
</style>

<div class="editor-header">
    <a href="{{ route('adminweb.posts') }}" class="editor-back">
        <span class="material-icons">arrow_back</span>
    </a>
    <h1 class="editor-title">Editor</h1>
</div>

@livewire('post-editor', ['post' => $post ?? null], key($post ? 'edit-' . $post->id : 'create'))
@endsection
