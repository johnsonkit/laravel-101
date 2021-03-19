@extends('layouts.article')

@section('main')
    <h1 class="font-thin text-4xl">Article > Edit</h1>

    @if($errors->any())
        <div class="errors p-3 bg-red-500 text-red-100 font-thin rounded">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.update', $article) }}" method="post">
        @csrf
        @method('patch')
        <div class="field my-2">
            <label for="">Title</label>
            <input type="text" name="title" class="border border-gray-300 p-2" value="{{ $article->title }}">
        </div>

        <div class="field my-2">
            <label for="">Content</label>
            <textarea name="content" id="" cols="30" rows="10" class="border border-gray-300 p-2">{{ $article->content }}</textarea>
        </div>

        <div class="actions">
            <button type="submit" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">Update</button>
        </div>
    </form>

@endsection
