@extends('dashboard.template.base')

@section('title', $title)

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Categorias de produtos</h1>
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
        @foreach($categories as $category)
            <form id="form_delete_{{$loop->iteration}}" action="{{route('destroyCategory',$category->id)}}" method="POST">
                @method('DELETE')
                @csrf
            </form>
            <form id="form_edit_{{$loop->iteration}}" action="{{route('editCategory', $category->id)}}" method="GET"></form>
            <tr>
                <th scope="row">{{$category->id}}</th>
                <td>{{$category->name}}</td>
                <td>
                    <button type="submit" form="form_edit_{{$loop->iteration}}" class="btn btn-sm btn-outline-primary">Edit</button>
                    <button type="submit" form="form_delete_{{$loop->iteration}}" class="btn btn-sm btn-outline-danger">Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <form action="{{route('storeCategory')}}" method="POST">
        <div class="mb-3">
            @error('name')
            <div class="alert alert-danger" role="alert">{{ $errors->first('name') }}</div>
            @enderror
            <label for="categoryName" class="form-label">Cadastrar nova categoria</label>
            <input type="text" class="form-control" name="name" id="categoryName" placeholder="Nome da categoria">
        </div>
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="switchCheckCategory" name="external">
            <label class="form-check-label" for="switchCheckCategory">Categoria Externa</label>
        </div>
        <button class="btn btn-outline-primary">Cadastrar</button>
        @CSRF
    </form>
@endsection
