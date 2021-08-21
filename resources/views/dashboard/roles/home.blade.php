@extends('dashboard.template.base')

@section('title', $title)

@section('content')

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Funções do usuario</h1>
    </div>

    @error('relationship')
    <div class="alert alert-warning" role="alert">{{ $errors->first('relationship') }}</div>
    @enderror

    {{$el=""}}
    @foreach($roles as $role)
        @php
            $el .= <<<html
                <tr>
                    <th scope="row">$role->id</th>
                    <td>$role->name</td>
                    <td>
                        <button type="submit" form="form_edit_$loop->iteration"
                                class="me-1 btn btn-sm btn-outline-primary">Edit
                        </button>
                        <button type="submit" form="form_delete_$loop->iteration"
                                class="btn btn-sm btn-outline-danger">Delete
                        </button>
                    </td>
                </tr>
            html;
        @endphp
        <form id="form_delete_{{$loop->iteration}}" action="{{route('role.destroy', $role->id)}}" method="POST">
            @method('DELETE')
            @csrf
        </form>
        <form id="form_edit_{{$loop->iteration}}" action="{{route('role.edit', $role->id)}}" method="GET"></form>
        @if ($loop->last)
            <table class="table table-striped table-hover mt-1 mb-5">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">ações</th>
                </tr>
                </thead>
                <tbody>

                {!! $el !!}

                </tbody>
            </table>
        @endif
    @endforeach

    <form action="{{route('role.store')}}" method="POST">
        <div class="mb-3">
            @error('name')
            <div class="alert alert-danger" role="alert">{{ $errors->first('name') }}</div>
            @enderror
            <label for="roleName" class="form-label">Cadastrar nova função</label>
            <input type="text" class="form-control" name="name" id="roleName" placeholder="Nome da função">
        </div>
        <button class="btn btn-outline-primary">Cadastrar</button>
        @CSRF
    </form>
@endsection
