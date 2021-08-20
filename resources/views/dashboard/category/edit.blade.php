@extends('dashboard.template.base')

@section('title', $title)

@section('content')
    <div
        class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar nome da função</h1>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-6">
            <form method="POST" action="{{route('updateCategory', $category->id)}}" class="needs-validation mt-2"
                  novalidate>
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="categoryName" class="form-label">Novo nome da categoria</label>
                    <input type="text" class="form-control" name="name" id="categoryName" value="{{$category->name}}"
                           required>
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
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="switchCheckCategory"
                           name="external" {{((bool) $category->external === true) ? "checked" : "" }}>
                    <label class="form-check-label" for="switchCheckCategory">Categoria Externa</label>
                </div>
                <div class="mb-3">
                    <button class="btn btn-outline-primary" type="submit">Editar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
