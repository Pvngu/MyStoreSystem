<x-layout :title="'Roles | MyStoreSystem'">
    <div class="content">
            <div class="content-header">
                <div style="font-size: 1.4rem;">Roles</div>
                <a id = "addButton" href="/users/roles/create">
                    <span style="font-weight: 700;">+</span> New
                </a>
            </div>
            <div>
                <nav>
                    <form action="">
                        <div class="nav-content">
                            <div class="nav-item" id="item-input">
                                <label>Search for Role</label>
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
                            </div>
                        </div>
                    </form>
                </nav>
            </div>
            <div class = "table-container">
                <x-table.table
                :headers="['id', 'name']"
                :sortAction="'/roles'"
                :deleteAction="'/roles/delete'"
                :confirmationText="'Are you sure you want to delete this role?'"
                >
                <form id="deleteIdsForm" action="/roles/delete-users" method="POST">
                    @csrf
                        @foreach ($roles as $role)
                            <tr>
                                <td class="center-cell">
                                    <x-checkbox>
                                        <input type="checkbox" name="ids[{{$role->id}}]" value="{{$role->id}}" class="checkboxIds">
                                    </x-checkbox>
                                </td>
                                <td>{{$role->id}}</td>
                               
                                <td>{{$role->name}}</td>
                                <td class = 'actions center-cell'>
                                    <a href = '/users/role/{{$role->id}}/edit'>
                                        <i class='bx bxs-edit-alt' style = 'color: #2a8c3f'></i>
                                    </a>
                                    <a class="openModalD" data-item-id="{{$role->id}}">
                                        <i class='bx bx-trash' style = 'color: #fa7878'></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                </form>
                </x-table.table>
            </div>
    </div>
</x-layout>