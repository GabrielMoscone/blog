@extends('partials.layout')

@section('content')
<div class="container">
    <div class="row-mt-3">
        <div class="col-4 offset-4">
            <h1 class="text-center">LaraBlog</h1>
            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Digite o e-mail">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="password">Senha</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Digite a senha">
                    </div>
                </div>

                <button type="submit" class="btn btn-block btn-success">Entrar</button>

                <div class="m-auto text-center">
                    <a href="{{route('home')}}">Voltar</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection