@push('scripts')
    <script src="{{asset('js/table.js')}}"></script>

    <script>
        const submitForm = document.getElementById('submitForm');
        const sortID = document.getElementById('sortById');
        const sortName = document.getElementById('sortByName');
        const sortStock = document.getElementById('sortByStock');
        const sortCP = document.getElementById('sortByCP');
        const sortUP = document.getElementById('sortByUP');
        const sortCategory = document.getElementById('sortByCategory');
        const sort_order = document.getElementById('sort_order');

        sortID.addEventListener('click', () => {
            sortBy('id');
        });

        sortName.addEventListener('click', () => {
            sortBy('name');
        });

        sortStock.addEventListener('click', () => {
            sortBy('stock');
        });

        sortCP.addEventListener('click', () => {
            sortBy('cost_price');
        });

        sortUP.addEventListener('click', () => {
            sortBy('unit_price');
        });

        sortCategory.addEventListener('click', () => {
            sortBy('category');
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
        <form action="/inventory/items" id="submitForm">
            <div class="content-header">
                <div style="font-size: 1.4rem;">Inventory</div>
                <a id = "addButton" href="/inventory/items/create">
                    <span style="font-weight: 700;">+</span> New
                </a>
            </div>
            <div>
                <nav>
                    <div class="nav-content">
                        <div class="nav-item" id="item-input">
                            <label>Search for item</label>
                            <div class="search-order">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="text" placeholder="Search" name="search" value="{{old('search', request()->input('search'))}}">
                            </div>
                        </div>
                        <div class="nav-select">
                            @php
                            $status = request('status');
                            $categoryID = request('category');
                            @endphp
                            <div class="nav-item">
                                <label>Status</label>
                                <select name="status" id="status" class="select-input" onchange="this.form.submit()">
                                    <option value="" {{($status == 'all') ? 'selected' : ''}}>All</option>
                                    <option value="InStock" {{($status == 'InStock') ? 'selected' : ''}}>In Stock</option>
                                    <option value="OutStock" {{($status == 'OutStock') ? 'selected' : ''}}>Out of Stock</option>
                                </select>
                            </div>
                            <div class="nav-item">
                                <label>Category</label>
                                <select name="category" id="category" class="select-input" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" {{($category->id == $categoryID) ? 'selected' : ''}}>{{$category->name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class = "table-container">
                <table class = "content-table">
                    <thead>
                        <tr>
                            <th class="center-cell">
                                <input type="checkbox">
                            </th>
                            <th>
                                <div class="table-head">
                                    <div id="sortById">#</div>
                                    <div class="sort-icon">
                                        <i class='bx bxs-up-arrow'></i>
                                        <i class='bx bxs-down-arrow'></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="table-head">
                                    <div id="sortByName">name</div>
                                    <div class="sort-icon">
                                        <i class='bx bxs-up-arrow'></i>
                                        <i class='bx bxs-down-arrow'></i>
                                    </div>
                                </div>
                                <style>
                                    .sort-icon{
                                        display: flex;
                                        flex-direction: column;
                                        font-size: 4px;
                                    }

                                    .table-head{
                                        display: flex;
                                        gap: 8px;
                                    }
                                </style>
                            </th>
                            <th>
                                <div class="table-head">
                                    <div id="sortByStock">Stock</div>
                                    <div class="sort-icon">
                                        <i class='bx bxs-up-arrow'></i>
                                        <i class='bx bxs-down-arrow'></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="table-head">
                                    <div id="sortByCP">Cost price</div>
                                    <div class="sort-icon">
                                        <i class='bx bxs-up-arrow'></i>
                                        <i class='bx bxs-down-arrow'></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="table-head">
                                    <div id="sortByUP">Unit price</div>
                                    <div class="sort-icon">
                                        <i class='bx bxs-up-arrow'></i>
                                        <i class='bx bxs-down-arrow'></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="table-head">
                                    <div id="sortByCategory">Category</div>
                                    <div class="sort-icon">
                                        <i class='bx bxs-up-arrow'></i>
                                        <i class='bx bxs-down-arrow'></i>
                                    </div>
                                </div>
                            </th>
                            <th class = "center-cell">Status</th>
                            <th class = "center-cell">Actions</th>
                            <input type="hidden" name="sort_column" id="sort_column" value="{{old('sort_column', request()->input('sort_column'))}}">
                            <input type="hidden" name="sort_order" id="sort_order" value="{{old('sort_order', request()->input('sort_order'))}}">
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        @php
                        $stock = $item->stock;
                        @endphp
                            <tr>
                                <td class="center-cell"><input type="checkbox"></td>
                                <td>{{$item->id}}</td>
                                <td>
                                    <div class="row-image">
                                        <img class="table-image" src="{{$item->image ? asset('storage/' . $item->image) : asset('images/default-gray.png')}}" alt="">
                                        {{$item->name}}
                                    </div>
                                </td>
                                <td>{{$item->stock}}</td>
                                <td>${{$item->cost_price}}</td>
                                <td>${{$item->unit_price}}</td>
                                <td>{{$item->category->name}}</td>
                                <td class = 'center-cell'>
                                    @if ($stock >= 1)
                                        <span class = 'status-active'>InStock</span>
                                    @else
                                        <span class = 'status-deactive'>OutStock</span>
                                    @endif
                                </td>
                                <td class = 'actions center-cell'>
                                    <a href='/inventory/items/{{$item->id}}/edit'>
                                        <i class='bx bxs-edit-alt' style = 'color: #2a8c3f'></i>
                                    </a>
                                    <a class="openModalD" data-item-id="{{$item->id}}">
                                        <i class='bx bx-trash' style = 'color: #fa7878'></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 15px;">
                    {{ $items->links('pagination.default') }}
                </div>
            </div>
        </form>
    </div>
            <!-- Delete popup -->
            <dialog class="deleteModal modal">
                <div class="modalHeader">
                    <h1>Delete</h1>
                    <i class='bx bx-x closeBtnModalD modalX'></i>
                </div>
                <div class="modalContent DelModal">
                    <form action="/inventory/items/delete" method="POST">
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