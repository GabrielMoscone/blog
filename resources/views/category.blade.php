@extends('partials.layout')

@section('content')
@include('partials.menu')

<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <h1>LaraBlog - Categorias</h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            @include('partials.errors')

            @if($category->id)
            <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="POST">
                {{ method_field('PUT') }}
                @else
                <form action="{{ route('categories.store') }}" method="POST">
                    @endif
                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="name">Nome</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nome da categoria" value="{{ $category->name }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="description">Descrição</label>
                            <textarea name="description" id="description" rows="5" class="form-control" placeholder="Digite a descrição da categoria">{{$category->description}}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="custom-control custom-switch">
                                @if($category->active)
                                <input type="checkbox" name="active" id="active" class="custom-control-input" value="S" checked>
                                @else
                                <input type="checkbox" name="active" id="active" class="custom-control-input" value="S">
                                @endif
                                <label for="active" class="custom-control-label">Ativada</label>
                                <span title="Invativar um categoria afetará todas publicações vinculadas a mesma">
                                    <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-question-circle-fill" fill="blue" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033a.237.237 0 0 1-.24-.247C5.35 4.091 6.737 3.5 8.005 3.5c1.396 0 2.672.73 2.672 2.24 0 1.08-.635 1.594-1.244 2.057-.737.559-1.01.768-1.01 1.486v.105a.25.25 0 0 1-.25.25h-.81a.25.25 0 0 1-.25-.246l-.004-.217c-.038-.927.495-1.498 1.168-1.987.59-.444.965-.736.965-1.371 0-.825-.628-1.168-1.314-1.168-.803 0-1.253.478-1.342 1.134-.018.137-.128.25-.266.25h-.825zm2.325 6.443c-.584 0-1.009-.394-1.009-.927 0-.552.425-.94 1.01-.94.609 0 1.028.388 1.028.94 0 .533-.42.927-1.029.927z" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
        </div>
    </div>
</div>

@endsection