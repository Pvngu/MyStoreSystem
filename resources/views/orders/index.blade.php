@push('scripts')
    <script>
        const modalShow = document.querySelector('.showModal');
        const itemOrder = document.getElementById('itemOrder');
        $(document).ready(function () {
            $('.openModalShow').click(function (e) {
                order_id = $(this).data('order-id');
                    $.ajax({
                    url: '{{ route('items') }}?order_id='+order_id,
                    type: 'get',
                    success: function (res) {
                        $.each(res, function (key, value) {
                            $('#itemOrder').append('<div class="left">' + value.name + '</div>');
                            $('#itemOrder').append('<div>' + value.quantity + '</div>');
                            $('#itemOrder').append('<div>$' + value.quantity * value.unit_price + '</div>');
                        });
                        modalShow.showModal();
                    }
                });
            });
        });

        document.querySelector('.closeBtnModalShow').addEventListener('click', () => {
            modalShow.close();
        })

        document.querySelector('.showModal').addEventListener('close', () => {
            itemOrder.innerHTML = '';
        })
    </script>
@endpush
<x-layout :title="'Orders | MyStoreSystem'">
    <div class="content">
        @if(count($orderCount) >= 1)
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
                                    <select name="customer" class="select-input" onchange="this.form.submit()">
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
                <x-table.table
                :headers="[
                    ['name' => 'id', 'column_type' => 'sortable'],
                    ['name' => 'date', 'column_type' => 'sortable'],
                    ['name' => 'customer', 'column_type' => 'sortable'],
                    ['name' => 'status', 'align' => 'center'],
                    ['name' => 'items', 'align' => 'center'],
                    ['name' => 'total', 'align' => 'center']
                ]"
                :sortAction="'/orders'"
                :deleteAction="'/orders/delete'"
                :confirmationText="'Are you sure you want to delete this order?'"
                >
                <form id="deleteIdsForm" action="/orders/delete-orders" method="POST">
                    @csrf
                    @foreach ($orders as $order)
                        <tr>
                            <td class="center-cell">
                                <x-checkbox>
                                    <input type="checkbox" name="ids[{{$order->id}}]" value="{{$order->id}}" class="checkboxIds">
                                </x-checkbox>
                            </td>
                            <td>{{$order->id}}</td>
                            <td>{{ \Carbon\Carbon::parse($order->date)->format('M d, Y')}}</td>
                            <td>{{$order->customer->first_name}} {{$order->customer->last_name}}</td>
                            <td class="flex-cell">
                                @if ($order->status == 'paid')
                                <div class="status active">
                                    <div></div>
                                    <span>{{ucfirst($order->status)}}</span>
                                </div>
                                @else
                                <div class="status deactive">
                                    <div></div>
                                    <span>{{ucfirst($order->status)}}</span>
                                </div>
                                @endif
                            </td>
                            <td class = 'center-cell'>{{$order->items->count()}}</td>
                            <td class = 'center-cell'>${{$order->total_amount}}</td>
                            <td class = 'actions center-cell'>
                                <a class="openModalShow {{$order->total_amount > 0 ? '' : 'inactive'}}" data-order-id='{{$order->id}}'>
                                    <i class='bx bx-show' style = 'color: #5993ff'></i>
                                </a>
                                <a href ='orders/{{$order->id}}/edit'>
                                    <i class='bx bxs-edit-alt' style = 'color: #2a8c3f'></i>
                                </a>
                                <a class="openModalD" data-item-id='{{$order->id}}'>
                                    <i class='bx bx-trash' style = 'color: #fa7878'></i>
                                </a>
                            </td>
                            <style>
                                .openModalShow.inactive{
                                    opacity: 0;
                                    pointer-events: none;
                                }
                            </style>
                        </tr>
                    @endforeach
                </form>
                </x-table.table>
            </div>
            <div style="margin-top: 15px;">
                {{$orders->links('pagination.default')}}
            </div>
        @else
        <div class="empty-table">
            <div id="tittle-text">Start by creating an order</div>
            <a href="/orders/create">
                <button class="button-create" role="button">Create New Order</button>
            </a>
        </div>
        @endif
    </div>
    <!-- Show order items popup -->
    <dialog class="showModal modal">
        <div class="modalHeader">
            <h1>Items</h1>
            <i class='bx bx-x closeBtnModalShow modalX'></i>
        </div>
        <div class="modalContent">
            <style>
                .previewItemsTable{
                    
                }
            </style>
            <div id="head">
                <div>Name</div>
                <div>Quantity</div>
                <div>Amount</div>
            </div>
            <div id="itemOrder">

            </div>
            <style>
                .modalContent {
                    #head, #itemOrder {
                        display: flex;
                        justify-content: center;
                        flex-wrap: wrap;
                    }

                    #head {
                        font-weight: 600;
                    }

                    #itemOrder {
                        font-weight: 300;
                    }

                    #head div:first-of-type {
                        text-align: left;
                    }

                    #itemOrder div.left {
                        text-align: left;
                    }

                    #head div, #itemOrder div {
                        text-align: center;
                        width: 140px;
                        margin-block: 4px;
                    }
                }
            </style>
        </div>
    </dialog>
</x-layout>