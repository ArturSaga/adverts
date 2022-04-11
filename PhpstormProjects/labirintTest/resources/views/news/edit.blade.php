@extends('layout.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактирование новости</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('news.index') }}"> Назад </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('news.update',$news->id) }}" method="POST">
        @csrf

        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                        <strong>Название:</strong>
                        <input type="text" name="title" value="{{ $news->title }}" class="form-control" placeholder="Название">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Анонс:</strong>
                    <input type="text" name="anons" value="{{$news->anons}}" class="form-control" placeholder="Анонс">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Текст:</strong>
                    <textarea class="form-control" style="height:150px" name="text" placeholder="Текст">{{ $news->text }}</textarea>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Теги:</strong>
                    <input type="text" name="tags" value="{{$news->tags}}" class="form-control" placeholder="Теги">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Дата создания:</strong>
                    <input type="date" name="created_at" value="{{$news->created_at}}" class="form-control" placeholder="Дата создания">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Отправить</button>
            </div>
        </div>
    </form>
@endsection
