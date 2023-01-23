@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            @if($message = Session::get('success'))

            <div class="alert alert-success">
                {{ $message }}
            </div>

            @endif

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col col-lg-12"><b>{{ __('Dados de Papeis') }}</b></div>
                        <div class="col col-lg-12">
                            <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm float-end">
                                Adicionar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nº</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                        @if(count($roles) > 0)
                            @foreach($roles as $key => $role)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('roles.show',$role->id) }}">
                                            Ver</a>
                                        @can('role-edit')
                                        <a class="btn btn-warning btn-sm"
                                            href="{{ route('roles.edit',$role->id) }}">
                                            Editar</a>
                                        @endcan
                                        @can('role-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy',
                                                $role->id],'style'=>'display:inline']) !!}
                                             {!! Form::submit('Eliminar',
                                                ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                     </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No Data Found</td>
                            </tr>
                        @endif
                    </table>
                    {!! $roles->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
