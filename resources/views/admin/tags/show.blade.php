@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>{{$tag->name}}</h1>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <a href="{{route('admin.tags.index')}}" class="btn btn-primary">Visualizza tutti i tags</a>
            </div>
            @if (count($tag->posts) > 0)
                <div>
                    <h3>I posts associati</h3>
                    <ul>
                        @foreach ($tag->posts as $post)
                        <li>{{$post->title}}</li>                        
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection