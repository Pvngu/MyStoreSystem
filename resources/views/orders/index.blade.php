@push('scripts')
    <script src="{{asset('js/table.js')}}"></script>

    <script>
        const submitForm = document.getElementById('submitForm');
        const sort_order = document.getElementById('sort_order');

        const columnIds = ['sortById', 'sortByName', 'sortByStock', 'sortByCP', 'sortByUP'];
        const columnNames = ['id', 'name', 'stock', 'cost_price', 'unit_price'];

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
    </script>
@endpush
<x-layout>
    <div class="content">
        <div class="content-header">
            <div style="font-size: 1.4rem;">Orders</div>
            <a id = "addButton" href="orders/create">
                <span style="font-weight: 700;">+</span> New
            </a>
        </div>
        <div>
            <nav>
                <form action="">
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
                                    <option value="refunded" {{request('status') == 'refunded' ? 'selected' : ''}}>Refunded</option>
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
        <div class = "table-container">
            <table class = "content-table">
                <thead>
                    <tr>
                        <th class="center-cell"><input type="checkbox"></th>
                            <th>#</th>
                            <th>Date</th>
                            <th class = "center-cell">Status</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th class = "center-cell">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="center-cell"><input type="checkbox"></td>
                            <td>{{$order->id}}</td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y')}}</td>
                            <td class = 'center-cell'>
                                @if ($order->status == 'paid' || $order->status == 'refunded')
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
                                <a href = 'customers/{{$order->id}}/edit'>
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
                    <input type="hidden" id="item_id" name="customer_delete_id">
                    <button id="logoutClose" type="button" class = "closeBtnModalD">Cancel</button>
                    <button id="deleteBtn" type="submit">Delete</button>
                </div>
            </form>
        </div>
    </dialog>
</x-layout>