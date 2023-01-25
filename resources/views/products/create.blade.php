@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach
                </ul>
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col col-md-12"><b>{{ __('Adicionar Produto') }}</b></div>
                        <div class="col col-md-12">
                            <a href="{{ route('products.index') }}" class="btn btn-success btn-sm float-end">
                                Retornar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Nome do produto</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" placeholder="Nome"/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Detalhe</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" style="height:150px" name="detail"
                                        placeholder="Detalhe"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Stock</label>
                            <div class="col-sm-10">
                                <input type="number" name="stock" class="form-control" placeholder="Stock"
                                    min="0" value="0"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-label-form">Imagem do Produto</label>
                            <div class="col-sm-10">
                                <input type="file" name="product_image"/>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="Submeter" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
