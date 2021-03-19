@extends('layouts.article')

@section('main')

    @if($errors->any())
        <div class="errors p-3 bg-red-500 text-red-100 font-thin rounded">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 class="font-thin text-4xl">{{ $article->title }}</h1>
    <p class="text-lg text-gray-700 p-2">
        {{ $article->content }}
    </p>

    <a href="{{ route('articles.index') }}">Back</a>


@endsection
