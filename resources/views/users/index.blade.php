<x-layout :title="'Users | MyStoreSystem'">
    <div class="content">
        @if(count($userNumbers) >= 1)
            <div class="content-header">
                <div style="font-size: 1.4rem;">Users</div>
                <a id = "addButton" href="/users/create">
                    <span style="font-weight: 700;">+</span> New
                </a>
            </div>
            <div>
                <nav>
                    <form action="">
                        <div class="nav-content">
                            <div class="nav-item" id="item-input">
                                <label>Search for Users</label>
                                <div class="search-order">
                                    <i class='bx bx-search-alt-2'></i>
                                    <input type="text" name="search" value="{{request('search')}}" placeholder="Search">
                                </div>
                            </div>
                            <div class="nav-select">
                                <div class="nav-item">
                                    <label>Status</label>
                                    <select name="status" id="status" class="select-input" onchange="this.form.submit()">
                                        <option value="">All</option>
                                        <option value="active" {{request('status') == 'active' ? 'selected' : ''}}>Active</option>
                                        <option value="inactive" {{request('status') == 'inactive' ? 'selected' : ''}}>Deactive</option>
                                    </select>
                                </div>
                                <div class="nav-item">
                                    <label>Role</label>
                                    <select name="role" id="role" class="select-input" onchange="this.form.submit()">
                                        <option value="">All</option>
                                        @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </nav>
            </div>
            <div class = "table-container">
                <x-table.table
                :headers="[
                    ['name' => 'id', 'column_type' => 'sortable'],
                    ['name' => 'username', 'column_type' => 'sortable'],
                    ['name' => 'name', 'column_type' => 'sortable'],
                    ['name' => 'role', 'align' => 'center'],
                    ['name' => 'status', 'align' => 'center']
                ]"
                :sortAction="'/users'"
                :deleteAction="'/users/delete'"
                :confirmationText="'Are you sure you want to delete this user?'"
                >
                <form id="deleteIdsForm" action="/users/delete-users" method="POST">
                    @csrf
                        @foreach ($users as $user)
                            <tr>
                                <td class="center-cell">
                                    <x-checkbox>
                                        <input type="checkbox" name="ids[{{$user->id}}]" value="{{$user->id}}" class="checkboxIds">
                                    </x-checkbox>
                                </td>
                                <td>{{$user->id}}</td>
                                <td>
                                    <div class="row-image">
                                        <img class="table-image" src="{{$user->image ? asset('storage/' . $user->image) : asset('images/default-gray.png')}}" alt="">
                                        {{$user->username}}
                                    </div>
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->role}}</td>
                                <td class="flex-cell">
                                    @if ($user->status == 1)
                                    <div class="status active">
                                        <div></div>
                                        <span>Active</span>
                                    </div>
                                    @else
                                    <div class="status deactive">
                                        <div></div>
                                        <span>Inactive</span>
                                    </div>
                                    @endif
                                </td>
                                <td class = 'actions center-cell'>
                                    <a href = '/users/{{$user->id}}/edit'>
                                        <i class='bx bxs-edit-alt' style = 'color: #2a8c3f'></i>
                                    </a>
                                    <a class="openModalD" data-item-id="{{$user->id}}">
                                        <i class='bx bx-trash' style = 'color: #fa7878'></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                </form>
                </x-table.table>
            </div>
        @else
            <div class="empty-table">
                <div id="tittle-text">Start by adding a first user</div>
                <a href="/users/create">
                    <button class="button-create" role="button">Add New User</button>
                </a>
            </div>
        @endif
    </div>
</x-layout>