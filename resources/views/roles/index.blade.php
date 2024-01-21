<x-layout :title="'Roles | MyStoreSystem'">
    <div class="content">
            <div class="content-header">
                <div style="font-size: 1.4rem;">Roles</div>
                @can('create user')
                <a id = "addButton" href="/users/roles/create">
                    <span style="font-weight: 700;">+</span> New
                </a>
                @endcan
            </div>
            <div class = "table-container">
                <x-table.table
                :headers="['id', 'name']"
                :sortAction="'/roles'"
                :deleteAction="'users/roles/delete'"
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
                                    @can('edit user')
                                    <a href = '/users/roles/{{$role->id}}/edit'>
                                        <i class='bx bxs-edit-alt' style = 'color: #2a8c3f'></i>
                                    </a>
                                    @endcan
                                    @can('delete user')
                                    <a class="openModalD" data-item-id="{{$role->id}}">
                                        <i class='bx bx-trash' style = 'color: #fa7878'></i>
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                </form>
                </x-table.table>
            </div>
    </div>
</x-layout>