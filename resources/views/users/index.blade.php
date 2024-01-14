@push('scripts')
    <script src="{{asset('js/table.js')}}"></script>
    <script src="{{asset('js/tableSort.js')}}"></script>
    <script src="{{asset('js/checkboxes.js')}}"></script>
@endpush
<x-layout>
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
                                        <option value="deactive" {{request('status') == 'deactive' ? 'selected' : ''}}>Deactive</option>
                                    </select>
                                </div>
                                <div class="nav-item">
                                    <label>Role</label>
                                    <select name="role" id="role" class="select-input" onchange="this.form.submit()">
                                        <option value="">All</option>
                                        <option value="admin">Admin</option>
                                        <option value="inventory">Inventory</option>
                                        <option value="report">Report</option>
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
                :action="'/users'"
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
                                <td class = 'center-cell'>
                                    @if ($user->status == 1)
                                        <span class = 'status-active'>Active</span>
                                    @else
                                        <span class = 'status-deactive'>Deactive</span>
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
    <!-- Delete popup -->
    <dialog class="deleteModal modal">
        <div class="modalHeader">
            <h1>Delete</h1>
            <i class='bx bx-x closeBtnModalD modalX'></i>
        </div>
        <div class="modalContent DelModal">
            <form action="/users/delete" method="POST">
                @csrf
                @method('DELETE')
                <div class="logoutText">Are you sure you want to delete this item?</div>
                <div class="logoutButtons">
                    <input type="hidden" id="item_id" name="item_delete_id">
                    <button id="logoutClose" type="button" class = "closeBtnModalD">Cancel</button>
                    <button id="deleteBtn" type="submit">Delete</button>
                </div>
            </form>
        </div>
    </dialog>
</x-layout>