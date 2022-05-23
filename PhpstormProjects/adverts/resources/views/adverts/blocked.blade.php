<x-app-layout>
    <x-slot name="header">
        <h1>Вас заблокировали</h1>
    </x-slot>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Автор</th>
            <th>Подкатегория</th>
            <th>Название</th>
            <th>Описание</th>
        </tr>
    </table>
    <div style="text-align: center">
        Вас заблокировали, пожалуйста свяжитесь со службой поддержки сайта
    </div>
</x-app-layout>
