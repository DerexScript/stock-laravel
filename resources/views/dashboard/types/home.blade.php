@extends('dashboard.template.base')

@section('title', $title)

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tipos de produto</h1>
    </div>
    @error('relationship')
    <div class="alert alert-warning" role="alert">{{ $errors->first('relationship') }}</div>
    @enderror
    <table class="table table-striped table-hover mt-1 mb-5">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($types as $key => $type)
            <form id="form_delete_{{$key}}" action="{{route('type.destroy',$type->id)}}" method="POST">
                @method('DELETE')
                @csrf
            </form>
            <form id="form_edit_{{$key}}" action="{{route('type.edit', $type->id)}}" method="GET"></form>
            <tr>
                <th scope="row">{{$type->id}}</th>
                <td>{{$type->name}}</td>
                <td>
                    <button type="submit" form="form_edit_{{$key}}" class="btn btn-sm btn-outline-primary">Edit</button>
                    <button type="submit" form="form_delete_{{$key}}" class="btn btn-sm btn-outline-danger">Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <form action="{{route('type.store')}}" method="POST">
        <div class="mb-3">
            @error('name')
            <div class="alert alert-danger" role="alert">{{ $errors->first('name') }}</div>
            @enderror
            <label for="roleName" class="form-label">Cadastrar novo tipo de produto</label>
            <input type="text" class="form-control" name="name" id="roleName" placeholder="Nome do tipo de produto">
        </div>
        <button class="btn btn-outline-primary">Cadastrar</button>
        @CSRF
    </form>
@endsection
