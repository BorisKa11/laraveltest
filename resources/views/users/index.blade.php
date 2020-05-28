@extends('layouts.app')

@section('content')
<div class="container bgWgite">
    <h3 class="captionForm">
        Пользователи
        <a href="/users/create" class="btn btn-primary btn-sm pull-right" title="Добавить пользователя"><i class="fa fa-plus"></i></a>
    </h3>
    @if (\Session::has('success'))
        <div class="success">        
            <div>{{ \Session::get('success') }}</div>
        </div>
    @endif
    @if (\Session::has('error'))
        <div class="errors">        
            <div class="errorItem">{{ \Session::get('error') }}</div>
        </div>
    @endif
    <table class="table table-striped">
        @foreach ($users as $user)
            <tr>
                <td class="">{{ $user->name }}</td>
                <td class="">{{ $user->email }}</td>
                <td class="">{{ $user->created_at }}</td>
                <td>
                    <a href="/users/edit/{{ $user->id }}" class="btn btn-sm btn-primary" title="Редактировать"><i class="fa fa-pencil"></i></a>
                    <a onClick="return confirm('Вы действительно хотите удалить пользователя {{ $user->name }}')" href="/users/delete/{{ $user->id }}" class="btn btn-sm btn-danger" title="Удалить"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $users->links() }}
</div>

@endsection
 
