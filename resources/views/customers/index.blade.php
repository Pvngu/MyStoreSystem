<x-layout>
    <div class="content">
        <div class="content-header">
            <div style="font-size: 1.4rem;">Customers</div>
            <a id = "addButton" href="create.html">
                <span style="font-weight: 700;">+</span> New
            </a>
        </div>
        <div>
            <nav>
                <form action="">
                    <div class="nav-content">
                        <div class="nav-item" id="item-input">
                            <label>Search for Customer</label>
                            <div class="search-order">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" name="search" placeholder="Search">
                            </div>
                        </div>
                        <div class="nav-select">
                            <div class="nav-item">
                                <label>Status</label>
                                <select name="status" id="status" class="select-input">
                                    <option value="available">All</option>
                                    <option value="available">Active</option>
                                    <option value="low stock">Deactive</option>
                                </select>
                            </div>
                            <div class="nav-item">
                                <label>Country</label>
                                <select name="country" id="role" class="select-input">
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
            <table class = "content-table">
                <thead>
                    <tr>
                        <th class="center-cell"><input type="checkbox"></th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>address</th>
                        <th class = "center-cell">Status</th>
                        <th class = "center-cell">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        @php
                            $status = $customer->active;
                            $Fname = $customer->first_name . ' ' . $customer->last_name;
                        @endphp
                        <tr>
                            <td class="center-cell"><input type="checkbox"></td>
                            <td>{{$customer->id}}</td>
                            <td>
                                <div class="row-image">
                                    {{$Fname}}
                                </div>
                            </td>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->phone}}</td>
                            <td>{{$customer->address}}</td>
                            <td class = 'center-cell'>
                                @if ($status == 1)
                                    <span class = 'status-active'>Active</span>
                                @else
                                    <span class = 'status-deactive'>Deactive</span>
                                @endif
                            </td>
                            <td class = 'actions center-cell'>
                                <a href = 'edit.html'>
                                    <i class='bx bxs-edit-alt' style = 'color: #2a8c3f'></i>
                                </a>
                                <a class="openModalD">
                                    <i class='bx bx-trash' style = 'color: #fa7878'></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="margin-top: 15px;">
            {{$customers->links('pagination.default')}}
        </div>
    </div>
</x-layout>