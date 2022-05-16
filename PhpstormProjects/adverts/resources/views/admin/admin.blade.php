<x-app-layout>
    <x-slot name="header">
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('admin')" :active="request()->routeIs('admin')">
                Объявления
            </x-nav-link>
            <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">
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
            <th>Автор</th>
            <th>Подкатегория</th>
            <th>Название</th>
            <th>Описание</th>
        </tr>
        @foreach ($adverts as $advert)
            <tr>
                <td>
                    @php
                        $name = App\Models\User::get()->where('id', $advert->user_id)->first();
                        echo $name->name;
                    @endphp
                </td>
                <td>{{ $advert->subcategory }}</td>
                <td>{{ $advert->title }}</td>
                <td>{{ $advert->description }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('adverts.show',$advert->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('adverts.edit',$advert->id) }}">Edit</a>
                    <form action="{{ route('adverts.destroy',$advert->id) }}" method="POST">

                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</x-app-layout>
