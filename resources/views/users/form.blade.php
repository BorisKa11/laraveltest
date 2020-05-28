@extends('layouts.app')

@section('content')
<div class="container bgWgite">
    <h3 class="captionForm">{{ isset($user->id) ? 'Редактирование' : 'Добавление' }} пользователя</h3>
    <div class="errors">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="errorItem">{{ $error }}</div>
            @endforeach
        @endif        
    </div>
    <form action="/users/save" method="post">
        @csrf
        <div class="row">
            <div class="form-group col-xs-12 col-md-4">
                <label>Имя</label>
                <input type="text" required name="name" value="{{ isset($user->name) ? $user->name : '' }}" placeholder="Введите имя" class="form-control" />
            </div>
            <div class="form-group col-xs-12 col-md-4">
                <label>E-mail</label>
                <input type="email" required name="email" value="{{ isset($user->email) ? $user->email : '' }}" placeholder="Введите e-mail" class="form-control" />
            </div>
            <div class="form-group col-xs-12 col-md-4">
                <label>Пароль</label>
                <input type="password" required name="password" value="" placeholder="Введите пароль" class="form-control" />
            </div>
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Сохранить</button>
        </div>
        <input type="hidden" name="id" value="{{ isset($user->id) ? $user->id : 0 }}">
    </form>
</div>

@endsection