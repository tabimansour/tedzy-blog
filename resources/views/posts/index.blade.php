@extends('layout.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @if($posts->count())
                @foreach($posts as $post)
                    <div class="mb-4 border-b-2">
                        <a href="" class="font-bold">{{$post->user->name}}</a> <span class="text-gray-600 text-sm">{{$post->created_at->diffForHumans()}}</span>
                        <p class="ml-3 mt-2 mb-6">{{$post->body}}</p>

                        <div class="flex items-center">
                            <form action="{{route('like', [$post->id, 'like'])}}" method="post" class="mx-2">
                                @csrf
                                <button type="submit" class="bg-green-500 p-1 px-3 text-xs text-white rounded-lg my-2">Like</button>
                            </form>

                            <form action="{{route('like', [$post->id, 'unlike'])}}" method="post" class="mx-2">
                                @csrf
                                <button type="submit" class="bg-red-500 p-1 px-3 text-xs text-white rounded-lg my-2">Unlike</button>
                            </form>

                            <span>{{$post->likes->count()}} {{ Str::plural('like', $post->likes->count()) }}</span>
                        </div>
                    </div>
                @endforeach

                {{$posts->links()}}
            @else
            <p class="mt-2">There are no posts submitted yet by {{auth()->user()->name}}</p>
            @endif
        </div>
    </div>
@endsection
