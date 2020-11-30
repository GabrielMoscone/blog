@extends('partials.layout')

@section('content')
@include('partials.menu')

<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <h1>LaraBlog - Categorias</h1>
            <a href="{{ route('categories.create') }}" class="btn btn-success">Inserir</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            @if(count($categories) > 0)
            <table class="table table-hover table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ativada</th>
                    <th>Ações</th>
                </tr>

                @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                    <td>{{($category->active ? 'Sim' : 'Não')}}</td>
                    <td>
                        <form action="{{ route('categories.destroy', ['id' => $category->id]) }}" method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <div class="btn-group">
                                <a href="{{ route('categories.edit', ['id' => $category->id]) }}" class="btn btn-info">Editar</a>
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            @else
            <h2 class="blog-post-title">Nenhuma categoria encontrada!</h2>
            @endif
        </div>
    </div>
</div>

@endsection