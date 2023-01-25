@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col col-md-12"><b>{{ __('Detalhe de utilizador') }}</b></div>
                        <div class="col col-md-12">
                            <a href="{{ route('users.index') }}"
                                class="btn btn-success btn-sm float-end">Retornar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form"><b>Nome</b></label>
                        <div class="col-sm-10">
                                {{ $user->name }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form"><b>Email</b></label>
                        <div class="col-sm-10">
                                {{ $user->email }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form"><b>Papeis</b></label>
                        <div class="col-sm-10">
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="badge bg-secondary">{{ $v }}</label>
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
