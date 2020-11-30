@extends('partials.layout')

@section('content')
@include('partials.menu')

<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <h1>LaraBlog</h1>
            <p class="lead">Veja aqui as últimas publicações!</p>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            @if(count($posts) > 0)
            @foreach($posts as $post)
            <div class="row mb-4 border rounded">
                <div class="col-12 p-4">
                    <strong class="d-inline-block text-primary mb-2">{{$post->category->name}}</strong>
                    <h2 class="blog-post-title">{{$post->title}}</h2>
                    <p class="mb-1 text-muted">
                        {{strftime('%d/%m/%Y', strtotime($post->created_at))}}
                    </p>

                    <p class="card-text mb-2 pb-2 border-bottom">{{$post->summary}}</p>

                    <p class="card-text mb-auto">{{$post->text}}</p>
                </div>
            </div>
            @endforeach
            @else
            <div class="row mb-4 border rounded">
                <div class="col-12 p-4">
                    <h2 class="blog-post-title">Nenhuma publicação encontrada!</h2>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

@endsection