<x-app-layout>
    <x-slot name="header">
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('admin')" :active="request()->routeIs('admin')">
                Объявления
            </x-nav-link>
            <x-nav-link :href="route('users.index')" :active="request()->routeIs('admin.users')">
                Список пользователей
            </x-nav-link>
        </div>
    </x-slot>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>Имя</th>
            <th>Почта</th>
            <th>Права</th>
            <th>Действия</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td>
{{--                    <a class="btn btn-info" href="{{ route('adverts.show',$advert->id) }}">Show</a>--}}
                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Редактировать</a>
                    <form action="{{ route('users.destroy',$user->id) }}" method="POST">

                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</x-app-layout>
