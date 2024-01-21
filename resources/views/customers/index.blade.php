<x-layout :title="'Customers | MyStoreSystem'">
    <div class="content">
        @if(count($customerCount) >= 1)
            <div class="content-header">
                <div style="font-size: 1.4rem;">Customers</div>
                @can('delete inventory')
                <a id = "addButton" href="customers/create">
                    <span style="font-weight: 700;">+</span> New
                </a>
                @endcan
            </div>
            <div>
                <nav>
                    <form action="">
                        <div class="nav-content">
                            <div class="nav-item" id="item-input">
                                <label>Search for Customer</label>
                                <div class="search-order">
                                    <i class='bx bx-search-alt-2'></i>
                                    <input type="text" name="search" placeholder="Search" value="{{request('search')}}">
                                </div>
                            </div>
                            <div class="nav-select">
                                <div class="nav-item">
                                    <label>Status</label>
                                    <select name="status" id="status" class="select-input" onchange="this.form.submit()">
                                        <option value="" {{(request('status') == 'all') ? 'selected' : ''}}>All</option>
                                        <option value="active" {{request('status') == 'active' ? 'selected' : ''}}>Active</option>
                                        <option value="inactive" {{request('status') == 'inactive' ? 'selected' : ''}}>Inactive</option>
                                    </select>
                                </div>
                                <div class="nav-item">
                                    <label>Country</label>
                                    <select name="country" id="role" class="select-input" onchange="this.form.submit()">
                                        <option value="all">All</option>
                                        @foreach ($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
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
                    ['name' => 'name', 'column_type' => 'sortable'],
                    ['name' => 'email', 'column_type' => 'sortable'],
                    'phone',
                    ['name' => 'city', 'align' => 'center'],
                    ['name' => 'status', 'align' => 'center'],
                ]"
                :sortAction="'/customers'"
                :deleteAction="'/customers/delete'"
                :confirmationText="'Are you sure you want to delete this customer?'"
                >
                <form id="deleteIdsForm" action="/customers/delete-customers" method="POST">
                @csrf
                @foreach ($customers as $customer)
                    <tr>
                        <td class="center-cell">
                            <x-checkbox>
                                <input type="checkbox" name="ids[{{$customer->id}}]" value="{{$customer->id}}" class="checkboxIds">
                            </x-checkbox>
                        </td>
                        <td>{{$customer->id}}</td>
                        <td>{{$customer->first_name . ' ' . $customer->last_name}}</td>
                        <td>{{$customer->email}}</td>
                        <td>{{$customer->phone}}</td>
                        <td class = 'center-cell'>{{$customer->address ? $customer->address->city->name : ''}}</td>
                        <td class="flex-cell">
                            @if ($customer->active == 1)
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
                            @can('edit customer')
                            <a href = 'customers/{{$customer->id}}/edit'>
                                <i class='bx bxs-edit-alt' style = 'color: #2a8c3f'></i>
                            </a>
                            @endcan
                            @can('delete customer')
                            <a class="openModalD" data-item-id='{{$customer->id}}'>
                                <i class='bx bx-trash' style = 'color: #fa7878'></i>
                            </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </form>
                </x-table.table>
            </div>
            <div style="margin-top: 15px;">
                {{$customers->links('pagination.default')}}
            </div>
        @else
            <div class="empty-table">
                <div id="tittle-text">Start by adding a customer</div>
                <a href="/customers/create">
                    <button class="button-create" role="button">Add New Customer</button>
                </a>
            </div>
        @endif
    </div>
</x-layout>