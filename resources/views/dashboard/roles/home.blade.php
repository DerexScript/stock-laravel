@extends('dashboard.template.base')

@section('title', $title)

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Funções do usuario</h1>
    </div>

    <table class="table table-striped table-hover mt-1 mb-5">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">view</th>
            <th scope="col">edit</th>
            <th scope="col">delete</th>
            <th scope="col">ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $key => $role)
            <form id="form_{{$key}}" action="{{  route('destroyRole',  $role->id )  }}" method="post">
                @method('DELETE')
                @csrf
            </form>

            <tr>
                <th scope="row">{{$role->id}}</th>
                <td>{{$role->name}}</td>
                <td>{{$role->view}}</td>
                <td>{{$role->edit}}</td>
                <td>{{$role->delete}}</td>
                <td>
                    <button class="btn btn-sm btn-outline-primary">Edit</button>
                    <button type="submit" form="form_{{$key}}" class="btn btn-sm btn-outline-danger">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    <form action="{{route('storeRole')}}" method="POST">
        <div class="mb-3">
            <label for="roleName" class="form-label">Nome da função</label>
            <input type="text" class="form-control" name="name" id="roleName" placeholder="Nome da função">
        </div>
        <button class="btn btn-outline-primary">Cadastrar</button>
        @CSRF
    </form>
@endsection
