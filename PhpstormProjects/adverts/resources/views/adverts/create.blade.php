<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Объявления
            <div class="pull-right">
                <a class="btn btn-primary" href="/adverts/category/all"> На главную </a>
            </div>
        </h2>
    </x-slot>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(isset($advert))
        <form action="{{ route('adverts.update',$advert->id) }}" method="POST">
            @csrf
            @method('PUT')
            @elseif(!isset($advert))
                <form action="{{ route('adverts.store') }}" method="POST">
                    @csrf
                    @endif
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Категория:</strong>
                                <select type="text" name="category" class="form-control">
                                    <option>clothis</option>
                                    <option>auto</option>
                                    <option>home</option>
                                    <option>sport</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Подкатегория:</strong>
                                <input type="text" name="subcategory" class="form-control" placeholder="Подкатегория"
                                       @if(isset($advert)) value="{{$advert->subcategory}}" @else value="" @endif>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Название:</strong>
                                <input type="text" name="title" class="form-control" placeholder="Название"
                                       @if(isset($advert)) value="{{$advert->title}}" @else value="" @endif>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Описание:</strong>
                                <textarea class="form-control" style="height:150px" name="description"
                                          placeholder="Текст">@if(isset($advert)) {{$advert->description}} @else {{''}} @endif</textarea>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </form>
        </form>
</x-app-layout>
