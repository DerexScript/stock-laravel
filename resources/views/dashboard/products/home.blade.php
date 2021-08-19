@extends('dashboard.template.base')

@section('title', $title)

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Produtos</h1>
    </div>
    <table class="table table-dark table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">desc</th>
            <th scope="col">amount</th>
            <th scope="col">image</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $p)
            <tr>
                @can('update', $p)
                    <th scope="row">{{$p->id}}</th>
                    <td>{{$p->description}}</td>
                    <td>{{$p->amount}}</td>
                    <td>{{$p->images}}</td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
