@extends('templates.base')

@section('title', $title)

@section('content')
    <div class="container mt-5 mb-2">
        <div class="row">

            @foreach($products as $product)



                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header text-center text-white"
                             style="background: linear-gradient(to right,#451710,#20384f) !important;">
                            {{$product->type->name}}
                        </div>
                        <img class="card-img-top text-white"
                             src="{{asset('storage/product_images/')."/".$product->images}}" alt="{{$product->images}}"
                             style="background: linear-gradient(to right,#451710,#20384f) !important;">

                        <div class="card-img-overlay mt-5 text-white" style="display: none;">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                additional content. This content is a little bit longer.</p>
                            <p class="card-text">Last updated 3 mins ago</p>
                        </div>

                        <div class="card-body text-black"
                             style="background: linear-gradient(to right,#4510,#2038) !important;">

                            <h5 class="card-title">Descrição</h5>

                            <p class="card-text">{{$product->description}}</p>
                            <p class="card-text text-primary">Categoria: {{$product->category->name}}</p>

                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button"
                                            class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                        Ação
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="btnGroupDrop1">
                                        <li><a class="dropdown-item" href="{{route('product.create')}}">Ver</a></li>
                                        <li><a class="dropdown-item" href="{{route('product.edit', $product->id)}}">Editar</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{route('product.create')}}">Deletar</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop2" type="button"
                                            class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                        Baixa
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end"
                                        aria-labelledby="btnGroupDrop2">
                                        @foreach($categories as $category)
                                            @if($category->name !== $product->category->name)
                                                <li><a class="dropdown-item" href="#">{{$category->name}}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>


                        </div>

                        <div class="card-footer text-end text-white"
                             style="background: linear-gradient(to right,#451710,#20384f) !important;">
                            Adicionado por: {{$product->user->username}}
                        </div>

                    </div>
                </div>
            @endforeach


        </div>
    </div>
@endsection
