<footer class="mt-auto bg-dark footer mt-5">
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled">
                    <li class="text-white"><a class="text-decoration-none link-light" href="https://github.com/DerexScript/stock-laravel" target="_blank">Repositório do projeto</a></li>
                    <li class="text-white"><a class="text-decoration-none link-light" href="{{asset('/assets/img/modelagem.png')}}" target="_blank">Modelagem da database</a></li>
                </ul>
            </div>
        </div>
        <hr class="bg-white">
        <div class="row mb-1">
            <div class="col-12 d-flex justify-content-center">
                <span class="text-white">© 2021 - {{ date('Y') }} {{ config('app.name') }}, Inc</span>
            </div>
        </div>
    </div>
</footer>
