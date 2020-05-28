@extends('layouts.app')

@section('content')
<div class="container bgWgite">
    <h3 class="captionForm">
        Отделы
        <a href="/sections/create" class="btn btn-primary btn-sm pull-right" title="Добавить отдел"><i class="fa fa-plus"></i></a>
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
        @foreach ($sections as $section)
            <tr>
                <td class="image">
                    @if ($section->logo && file_exists(storage_path() . '/app/public/logo/' . $section->logo))
                        <img src="{{ asset('/storage/logo/' . $section->logo) }}" title="{{ $section->name }}" alt="" />
                    @else
                        <img src="/images/noscr.png" title="Нет изображения" alt="" />
                    @endif
                </td>
                <td class="itemCaption">{{ $section->name }}</td>
                <td>
                    @if ($section->users()->count())
                        <h5>Пользователи</h5>
                        @foreach($section->users()->get() as $user)
                            <div class="itemUser">{{ $user->name }}</div>
                        @endforeach
                    @endif
                </td>
                <td>
                    <a href="/sections/edit/{{ $section->id }}" class="btn btn-primary btn-sm" title="Редактировать"><i class="fa fa-pencil"></i></a>
                    <a onClick="return confirm('Вы действительно хотите удалить отдел {{ $section->name }}')" href="/sections/delete/{{ $section->id }}" class="btn btn-danger btn-sm" title="Удалить"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $sections->links() }}
</div>

@endsection
 
