@extends('layouts.article')

@section('main')
    <h1 class="font-thin text-4xl">Article Listing</h1>
    <a href="{{ route('articles.create') }}">Create</a>

    @foreach($articles as $article)
    <div class="border-t border-gray-300 my-1 p-2">
        <h2 class="font-bold text-lg">
            <a href="{{ route('articles.show', $article) }}">
                {{ $article->title }}
            </a>
        </h2>
        <p>
            posted by {{ $article->user->name }} @ {{ $article->created_at }}
        </p>
        <div class="flex">
            <a href="{{ route('articles.edit', $article) }}" class="mr-2">Edit</a>
            <form action="{{ route('articles.destroy', $article) }}" method="post">
                @csrf
                @method('delete')
                <Button type="submit" class="rounded px-2 bg-red-500 text-red-100">Delete</Button>
            </form>
        </div>

    </div>
    @endforeach

    {{ $articles->links() }}
@endsection
