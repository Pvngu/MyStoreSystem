<x-layout :title="'Add New Role | MyStoreSystem'">
    <div class="content">
        <div class="content-header">
            <div class="header-text">
                <a href="/users/roles">Roles</a>
                <div class="animated-header">> New Role</div>
            </div>
        </div>
        <form action="/customers" method="post">
            @csrf
            <div class="item-info">
                <div class="item-fields">
                    <div class="content-items">
                        <label>name</label>
                        <input type="text" name="name" value="{{old('name')}}">
                        @error('name')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Inventory Management</label>
                        <x-checkbox>
                            <input type="checkbox">
                        </x-checkbox>
                    </div>
                </div>
            </div>
            <div class="form-buttons">
                <a href="/orders" style="text-decoration: none;">
                    <input class="newButton cancelButton" type="button" value="Cancel">
                </a>
                <input class="newButton" type="submit" value="Create">
            </div>
        </form>
    </div>
</x-layout>