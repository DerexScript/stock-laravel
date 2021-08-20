@extends('dashboard.template.base')

@section('title', $title)

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar Produtos</h1>
    </div>

    <form action="{{route('updateProduct', $product->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <fieldset class="border border-1 border-dark rounded-2 p-1" style="background-color: #eeeeee;">
            <legend class="rounded-2 d-flex justify-content-center"
                    style="background-color: gray; color: white; padding: 5px 10px;">Editar Produto
            </legend>
            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label" for="selectCategory">Categoria</label>
                    <select class="form-select" id="selectCategory" name="category_id" required>
                        <option value="" selected>Escolha uma categoria</option>
                        @foreach($categories as $c)
                            <option
                                value="{{$c->id}}" {{($product->category_id === $c->id) ? "selected" : ""}} >{{$c->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label" for="selectProductType">Tipo do produto</label>
                    <select class="form-select" id="selectProductType" name="type_id" required>
                        <option value="" selected>Escolha o tipo do produto</option>
                        @foreach($types as $t)
                            <option
                                value="{{$t->id}}" {{($product->type_id === $t->id) ? "selected" : ""}}>{{$t->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 mb-3">
                    <label for="inputAmount" class="form-label">Quantidade</label>
                    <input type="number" class="form-control" name="amount" id="inputAmount"
                           aria-describedby="amountHelp" min="0"
                           step="1" placeholder="0" value="{{$product->amount}}" required>
                    <div id="amountHelp" class="form-text">Informe a quantidade de produtos.</div>
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label" for="inputFile">Upload</label>
                    <input type="file" name="images" value="{{$product->images}}" class="form-control"
                           id="inputFile">
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label" for="productDescription">Descrição do produto</label>
                    <textarea maxlength="800" class="form-control" id="productDescription" name="description" rows="3"
                              placeholder="Informe aqui o Nome/Modelo/Cor etc etc... do produto!"
                              required>{{$product->description}}</textarea>
                </div>
            </div> {{-- end row --}}
            <button type="submit" class="btn btn-primary w-100">Editar Produto</button>
        </fieldset>
    </form>
@endsection
