@extends('dashboard.template.base')

@section('title', $title)

@section('content')
    <form action="">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Nome Da Função</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Edit</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input placeholder">
        </div>
    </form>
@endsection
