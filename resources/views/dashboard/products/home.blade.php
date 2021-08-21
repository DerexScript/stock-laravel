@extends('dashboard.template.base')

@section('title', $title)

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Produtos</h1>
    </div>

    @if ($errors->has('upload'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('upload') }}
        </div>
    @endif

    <table class="table table-striped table-hover mb-5">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">desc</th>
            <th scope="col">amount</th>
            <th scope="col">image</th>
            <th scope="col">categoria</th>
            <th scope="col">tipo</th>
            <th scope="col">Adicionado</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $p)
            <tr>
                @can('view', $p)
                    <th scope="row">{{$p->id}}</th>
                    <td>{{$p->description}}</td>
                    <td>{{$p->amount}}</td>
                    <td>{{$p->images}}</td>
                    <td>{{$p->category->name}}</td>
                    <td>{{$p->type->name}}</td>
                    <td>{{$p->user->username}}</td>
                    <td>
                        <form id="form_edit_{{$loop->index}}" action="{{route("product.edit", $p->id)}}" method="GET"></form>
                        <button type="submit" form="form_edit_{{$loop->index}}" class="btn btn-sm btn-outline-primary">Edit</button>
                        <button type="submit" form="form_delete_" class="btn btn-sm btn-outline-danger">Delete</button>
                    </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>

    <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
        <fieldset class="border border-1 border-dark rounded-2 p-1" style="background-color: #eeeeee;">
            <legend class="rounded-2 d-flex justify-content-center" style="background-color: gray; color: white; padding: 5px 10px;">Cadastrar
                Produtos
            </legend>
            <div class="row">

                <div class="col-6 mb-3">
                    <label class="form-label" for="selectCategory">Categoria</label>
                    <select class="form-select" id="selectCategory" name="category_id" required>
                        <option value="" selected>Escolha uma categoria</option>
                        @foreach($categories as $c)
                            <option
                                value="{{$c->id}}" {{($productTest["category_id"] === $loop->iteration) ? "selected" : ""}} >{{$c->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 mb-3">
                    <label class="form-label" for="selectProductType">Tipo do produto</label>
                    <select class="form-select" id="selectProductType" name="type_id" required>
                        <option value="" selected>Escolha o tipo do produto</option>
                        @foreach($types as $t)
                            <option
                                value="{{$t->id}}" {{($productTest["type_id"] === $loop->iteration) ? "selected" : ""}}>{{$t->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 mb-3">
                    <label for="inputAmount" class="form-label">Quantidade</label>
                    <input type="number" class="form-control" name="amount" id="inputAmount"
                           aria-describedby="amountHelp" min="0"
                           step="1" placeholder="0" value="{{$productTest["amount"]}}" required>
                    <div id="amountHelp" class="form-text">Informe a quantidade de produtos.</div>
                </div>

                <div class="col-6 mb-3">
                    <label class="form-label" for="inputFile">Upload</label>
                    <input type="file" name="images" value="{{$productTest["images"]}}" class="form-control"
                           id="inputFile">
                </div>


                <div class="col-12 mb-3">
                    <label class="form-label" for="productDescription">Descrição do produto</label>
                    <textarea maxlength="800" class="form-control" id="productDescription" name="description" rows="3"
                              placeholder="Informe aqui o Nome/Modelo/Cor etc etc... do produto!"
                              required>{{$productTest["description"]}}</textarea>
                </div>

            </div> {{-- end row --}}

            <button type="submit" class="btn btn-primary w-100">Cadastrar Produto</button>
            @csrf
        </fieldset>
    </form>



@endsection
