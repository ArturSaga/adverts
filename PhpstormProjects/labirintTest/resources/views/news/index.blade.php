@extends('layout.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Crud операции для новостей </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('news.create') }}"> Добавить новость </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Название</th>
            <th>Анонс</th>
            <th>Текст</th>
            <th>Теги</th>
            <th>Дата создания</th>
            <th>Действия</th>
        </tr>
        @foreach ($news as $elem)
            <tr>
                <td>{{ $elem->title }}</td>
                <td>{{ $elem->anons }}</td>
                <td>{{ $elem->text }}</td>
                <td>{{ $elem->tags }}</td>
                <td>{{ date_format($elem->created_at, 'd.m.y:h:m:s') }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('news.show',$elem->id) }}">Показать</a>
                    <a class="btn btn-primary" href="{{ route('news.edit',$elem->id) }}">Редактировать</a>
                    <form action="{{ route('news.destroy',$elem->id) }}" method="POST">

                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"> Удалить </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
