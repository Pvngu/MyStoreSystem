@push('scripts')
    <script src="{{asset('js/table.js')}}"></script>

    <script>
        const submitForm = document.getElementById('submitForm');
        const sort_order = document.getElementById('sort_order');

        const columnIds = ['sortById', 'sortByDate'];
        const columnNames = ['id', 'date'];

        columnIds.forEach((id, index) => {
            const element = document.getElementById(id);
            element.addEventListener('click', () => {
                sortBy(columnNames[index]);
            });
        });

        function sortBy(x){
            if(sort_order.value === 'D'){
                $(document).ready(function () {
                    $('#sort_column').val(x);
                    $('#sort_order').val('A');
                    sort_order.value == 'A';
                    submitForm.submit();
                });
            }
            else{
                $(document).ready(function () {
                    $('#sort_column').val(x);
                    $('#sort_order').val('D');
                    submitForm.submit();
                });
            }
        }

        $(document).ready(function () {
            
        });
    </script>
    <script src="{{asset('js/checkboxes.js')}}"></script>
@endpush
<x-layout>
    <div class="content">
        @if(count($customers) >= 1)
        <div class="content-header">
            <div style="font-size: 1.4rem;">Orders</div>
            <a id = "addButton" href="orders/create">
                <span style="font-weight: 700;">+</span> New
            </a>
        </div>
            <div>
                <nav>
                    <form action="/orders">
                        <div class="nav-content">
                            <div class="nav-item" id="item-input">
                                <label>Search for order</label>
                                <div class="search-order">
                                    <i class='bx bx-search-alt-2'></i>
                                    <input type="text" name="search" placeholder="Search" value="{{request('search')}}">
                                </div>
                            </div>
                            <div class="nav-select">
                                <div class="nav-item">
                                    <label>Status</label>
                                    <select name="status" id="status" class="select-input" onchange="this.form.submit()">
                                        <option value="">All</option>
                                        <option value="paid" {{request('status') == 'paid' ? 'selected' : ''}}>Paid</option>
                                        <option value="canceled" {{request('status') == 'canceled' ? 'selected' : ''}}>Canceled</option>
                                        <option value="pending" {{request('status') == 'pending' ? 'selected' : ''}}>Pending</option>
                                    </select>
                                </div>
                                <div class="nav-item">
                                    <label>Customer</label>
                                    <select name="customer" id="customer" class="select-input" onchange="this.form.submit()">
                                        <option value="">All</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{$customer->id}}" {{request('customer') == $customer->id ? 'selected' : ''}}>{{$customer->first_name}} {{$customer->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </nav>
            </div>
            <div class="deleteItemsNav">
                <div class="nav-content flex-container">
                    <div id="count"></div>
                    <input id="deleteIdsButton" type="button" class="deleteButton" value="Delete Customers" onclick="submitIdsForm()">
                </div>
            </div>
            <div class = "table-container">
                <table class = "content-table">
                    <thead>
                        <form action="/orders" id="submitForm">
                            @php
                                $sort_column = request('sort_column');
                                $sort_order = request('sort_order');
                            @endphp
                            <tr>
                                <th class="center-cell">
                                    <input type="checkbox" id="checkAll" onchange="checkAllcheckboxes()">
                                </th>
                                <th>
                                    <div class="table-head">
                                        <div id="sortById">#</div>
                                        <div 
                                            class="sort-icon one 
                                            {{(($sort_column == 'id') && ($sort_order == 'A')) ? 'up' : ''}}
                                            {{(($sort_column == 'id') && ($sort_order == 'D')) ? 'down' : ''}} 
                                        ">
                                            <i class='bx bxs-up-arrow'></i>
                                            <i class='bx bxs-down-arrow'></i>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="table-head">
                                        <div id="sortByDate">Date</div>
                                        <div 
                                            class="sort-icon two
                                            {{(($sort_column == 'date') && ($sort_order == 'A')) ? 'up' : ''}}
                                            {{(($sort_column == 'date') && ($sort_order == 'D')) ? 'down' : ''}} 
                                        ">
                                            <i class='bx bxs-up-arrow'></i>
                                            <i class='bx bxs-down-arrow'></i>
                                        </div>
                                    </div>
                                </th>
                                    <th class = "center-cell">Status</th>
                                    <th>Customer</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th class = "center-cell">Actions</th>
                                    
                            </tr>
                            <input type="hidden" name="sort_column" id="sort_column" value="{{old('sort_column', request()->input('sort_column'))}}">
                            <input type="hidden" name="sort_order" id="sort_order" value="{{old('sort_order', request()->input('sort_order'))}}">
                        </form>
                    </thead>
                    <tbody>
                        <form id="deleteIdsForm" action="/orders/delete-orders" method="POST">
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="center-cell">
                                        <input type="checkbox" name="ids[{{$order->id}}]" value="{{$order->id}}" class="checkboxIds">
                                    </td>
                                    <td>{{$order->id}}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->date)->format('M d, Y')}}</td>
                                    <td class = 'center-cell'>
                                        @if ($order->status == 'paid')
                                            <span class = 'status-active'>{{$order->status}}</span>
                                        @elseif($order->status == 'canceled')
                                            <span class = 'status-deactive'>{{$order->status}}</span>
                                        @else
                                            <span class = 'status-pending'>{{$order->status}}</span>
                                        @endif
                                    </td>
                                    <td>{{$order->customer->first_name}} {{$order->customer->last_name}}</td>
                                    <td>{{$order->items->count()}}</td>
                                    <td>${{$order->total_amount}}</td>
                                    <td class = 'actions center-cell'>
                                        <a href = 'orders/{{$order->id}}/edit'>
                                            <i class='bx bxs-edit-alt' style = 'color: #2a8c3f'></i>
                                        </a>
                                        <a class="openModalD" data-item-id='{{$order->id}}'>
                                            <i class='bx bx-trash' style = 'color: #fa7878'></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 15px;">
                {{$orders->links('pagination.default')}}
            </div>
        @else
        <div class="empty-table">
            <div id="tittle-text">Start by creating the first Order</div>
            <a href="/orders/create">
                <button class="button-create" role="button">Create New Order</button>
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
            <form action="customers/delete" method="POST">
                @csrf
                @method('DELETE')
                <div class="logoutText">Are you sure you want to delete this customer?</div>
                <div class="logoutButtons">
                    <input type="hidden" id="item_id" name="order_delete_id">
                    <button id="logoutClose" type="button" class = "closeBtnModalD">Cancel</button>
                    <button id="deleteBtn" type="submit">Delete</button>
                </div>
            </form>
        </div>
    </dialog>
</x-layout>