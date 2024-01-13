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

        var checkboxes = document.querySelectorAll('.checkboxIds');

        function countCheckbox() {
            var checkedCount = 0;
            var nav = document.querySelector('.deleteItemsNav');

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    checkedCount++;
                }
            });

            if(checkedCount !== 0) {
                nav.classList.add('active');
            }
            else {
                nav.classList.remove('active');
            }

            document.getElementById('count').innerText = 'items selected: ' + checkedCount;
        }

        document.addEventListener('change', countCheckbox);

        function checkAllcheckboxes() {
            var checkAll = document.getElementById('checkAll');
            var checkboxes = document.querySelectorAll('.checkboxIds');
            for(var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = checkAll.checked;
            }
        }

        function submitIdsForm() {
            document.getElementById('deleteIdsForm').submit();
        }
    </script>
@endpush
<x-layout>
    <div class="content">
        @if(count($customers) >= 1)
            <div class="content-header">
                <div style="font-size: 1.4rem;">Customers</div>
                <a id = "addButton" href="customers/create">
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
                                    <input type="text" name="search" placeholder="Search" value="{{request('search')}}">
                                </div>
                            </div>
                            <div class="nav-select">
                                <div class="nav-item">
                                    <label>Status</label>
                                    <select name="status" id="status" class="select-input" onchange="this.form.submit()">
                                        <option value="" {{(request('status') == 'all') ? 'selected' : ''}}>All</option>
                                        <option value="active" {{request('status') == 'active' ? 'selected' : ''}}>Active</option>
                                        <option value="deactive" {{request('status') == 'deactive' ? 'selected' : ''}}>Deactive</option>
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
                <table class = "content-table">
                    <thead>
                        <tr>
                            <th class="center-cell"><input type="checkbox"></th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th class = 'center-cell'>City</th>
                            <th class = "center-cell">Status</th>
                            <th class = "center-cell">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td class="center-cell"><input type="checkbox"></td>
                                <td>{{$customer->id}}</td>
                                <td>
                                    <div class="row-image">
                                        {{$customer->first_name . ' ' . $customer->last_name}}
                                    </div>
                                </td>
                                <td>{{$customer->email}}</td>
                                <td>{{$customer->phone}}</td>
                                <td class = 'center-cell'>{{$customer->address ? $customer->address->city->name : ''}}</td>
                                <td class = 'center-cell'>
                                    @if ($customer->active == 1)
                                        <span class = 'status-active'>Active</span>
                                    @else
                                        <span class = 'status-deactive'>Deactive</span>
                                    @endif
                                </td>
                                <td class = 'actions center-cell'>
                                    <a href = 'customers/{{$customer->id}}/edit'>
                                        <i class='bx bxs-edit-alt' style = 'color: #2a8c3f'></i>
                                    </a>
                                    <a class="openModalD" data-item-id='{{$customer->id}}'>
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
        @else
            <div class="empty-table">
                <div id="tittle-text">Start by adding a customer</div>
                <a href="/customers/create">
                    <button class="button-create" role="button">Add New Customer</button>
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
                    <input type="hidden" id="item_id" name="customer_delete_id">
                    <button id="logoutClose" type="button" class = "closeBtnModalD">Cancel</button>
                    <button id="deleteBtn" type="submit">Delete</button>
                </div>
            </form>
        </div>
    </dialog>
</x-layout>