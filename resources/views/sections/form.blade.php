@extends('layouts.app')

@section('content')
<div class="container bgWgite">
    <h3 class="captionForm">{{ isset($user->id) ? 'Редактирование' : 'Добавление' }} отдела</h3>
    <div class="errors">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="errorItem">{{ $error }}</div>
            @endforeach
        @endif        
    </div>
    <form action="/sections/save" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <label>Название</label>
                    <input type="text" required name="name" value="{{ isset($section->name) ? $section->name : '' }}" placeholder="Введите название" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Описание</label>
                    <textarea name="description" class="form-control" placeholder="Введите описание отдела">{{ isset($section->description) ? $section->description : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Логотип</label>
                    <input type="file" name="logo" class="form-control" />
                </div>
            </div>
            <div class="col-md-6 col-xs-12 userList">
                @foreach ($users as $user)
                    <div class="userListItem">
                        <input type="checkbox" {{ in_array($user->id, $section->users()->get()->pluck('id')->toArray()) ? 'checked' : '' }} value="{{ $user->id }}" name="users[]" id="user{{ $user->id }}" />
                        <label for="user{{ $user->id }}">
                            {{ $user->name }} (<a href="mailto:{{ $user->email }}">{{ $user->email }}</a>)
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Сохранить</button>
        </div>
        <input type="hidden" name="id" value="{{ isset($section->id) ? $section->id : 0 }}">
    </form>
</div>

@endsection 