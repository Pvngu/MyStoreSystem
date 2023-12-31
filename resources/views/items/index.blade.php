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
            @php
                $sort_column = request('sort_column');
                $sort_order = request('sort_order');
            @endphp
            <div class="nav-content flex-container">
                <div>Items selected: 20</div>
                <button class="deleteButton">Delete</button>
            </div>
            <div class = "table-container">
                <table class = "content-table">
                    <thead>
                        <tr>
                            <th class="center-cell">
                                <input type="checkbox" id="checkAll">
                            </th>
                            <th>
                                <div class="table-head">
                                    <div id="sortById">#</div>
                                    <div 
                                        class="sort-icon id 
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
                                    <div id="sortByName">name</div>
                                    <div 
                                        class="sort-icon name 
                                        {{(($sort_column == 'name') && ($sort_order == 'A')) ? 'up' : ''}}
                                        {{(($sort_column == 'name') && ($sort_order == 'D')) ? 'down' : ''}} 
                                    ">
                                    <i class='bx bxs-up-arrow'></i>
                                    <i class='bx bxs-down-arrow'></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="table-head">
                                    <div id="sortByStock">Stock</div>
                                    <div 
                                        class="sort-icon stock 
                                        {{(($sort_column == 'stock') && ($sort_order == 'A')) ? 'up' : ''}}
                                        {{(($sort_column == 'stock') && ($sort_order == 'D')) ? 'down' : ''}} 
                                    ">
                                    <i class='bx bxs-up-arrow'></i>
                                    <i class='bx bxs-down-arrow'></i>
                                </div>
                            </th>
                            <th>
                                <div class="table-head">
                                    <div id="sortByCP">Cost price</div>
                                    <div 
                                        class="sort-icon costP 
                                        {{(($sort_column == 'cost_price') && ($sort_order == 'A')) ? 'up' : ''}}
                                        {{(($sort_column == 'cost_price') && ($sort_order == 'D')) ? 'down' : ''}} 
                                    ">
                                    <i class='bx bxs-up-arrow'></i>
                                    <i class='bx bxs-down-arrow'></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="table-head">
                                    <div id="sortByUP">Unit price</div>
                                    <div 
                                    class="sort-icon unitP 
                                    {{(($sort_column == 'unit_price') && ($sort_order == 'A')) ? 'up' : ''}}
                                    {{(($sort_column == 'unit_price') && ($sort_order == 'D')) ? 'down' : ''}} 
                                ">
                                    <i class='bx bxs-up-arrow'></i>
                                    <i class='bx bxs-down-arrow'></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div id="sortByCategory">Category</div>
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