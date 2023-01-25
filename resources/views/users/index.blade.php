@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($message = Session::get('success'))

            <div class="alert alert-success">
                {{ $message }}
            </div>

            @endif

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col col-md-12"><b>{{ __('Dados de Utilizadores') }}</b></div>
                        @can('role-create')
                        <div class="col col-md-12">
                            <a href="{{ route('users.create') }}" class="btn btn-success btn-sm float-end">
                                Adicionar</a>
                        </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nº</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Papeis</th>
                            <th>Ações</th>
                        </tr>
                        @if(count($data) > 0)
                            @foreach($data as $key => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $v)
                                                <label class="badge bg-secondary">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('users.show',$user->id) }}">
                                            Ver</a>
                                        @can('role-create')
                                        <a class="btn btn-warning btn-sm"
                                            href="{{ route('users.edit',$user->id) }}">
                                            Editar</a>
                                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy',
                                                $user->id],'style'=>'display:inline']) !!}
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
                    {!! $data->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
