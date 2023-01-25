@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col col-md-12"><b>{{ __('Detalhe de papel') }}</b></div>
                        <div class="col col-md-12">
                            <a href="{{ route('roles.index') }}"
                                class="btn btn-success btn-sm float-end">Retornar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form"><b>Nome</b></label>
                        <div class="col-sm-10">
                            {{ $role->name }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form"><b>Permissões</b></label>
                        <div class="col-sm-10">
                            @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $v)
                                    <label class="badge bg-secondary">{{ $v->name }}</label>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
