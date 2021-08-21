@extends('dashboard.template.base')

@section('title', $title)

@section('content')
    <div
        class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar nome do tipo de produto</h1>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-6">
            <form method="POST" action="{{route('type.update', $type->id)}}" class="needs-validation mt-2" novalidate>
                <div class="mb-3">
                    <label for="roleName" class="form-label">Novo nome do tipo de produto</label>
                    <input type="text" class="form-control" name="name" id="roleName" value="{{$type->name}}" required>
                    @error('name')
                    <div class="alert alert-danger" role="alert">{{ $errors->first('name') }}</div>
                    @enderror
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please choose a username.
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-outline-primary" type="submit">Editar</button>
                </div>
                @method('PUT')
                @csrf
            </form>
        </div>
    </div>
@endsection
