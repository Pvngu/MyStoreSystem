@push('scripts')
    <script src="{{asset('js/table.js')}}"></script>

    <script>
        const submitForm = document.getElementById('submitForm');
        const sort_order = document.getElementById('sort_order');
        const sort_column = document.getElementById('sort_column');

        const columnIds = ['sortById', 'sortByName', 'sortByStock', 'sortByCP', 'sortByUP', 'sortByCategory'];
        const columnNames = ['id', 'name', 'stock', 'cost_price', 'unit_price', 'category_id'];

        columnIds.forEach((id, index) => {
            const element = document.getElementById(id);
            element.addEventListener('click', () => {
                sortBy(columnNames[index]);
            });
        });

        function sortBy(x){
            if(sort_order.value === 'D'){
                sort_column.value = x;
                sort_order.value = 'A';
                submitForm.submit();
            }
            else{
                sort_column.value = x;
                sort_order.value = "D";
                submitForm.submit();
            }
        }
    </script>
    <script src="{{asset('js/checkboxes.js')}}"></script>
@endpush
<x-layout>
    <div class="content">
        @if(count($itemNumbers) >= 1)
                <div class="content-header">
                    <div style="font-size: 1.4rem;">Inventory</div>
                    <a id = "addButton" href="/inventory/items/create">
                        <span style="font-weight: 700;">+</span> New
                    </a>
                </div>
                <div>
                    <nav>
                        <form action="/inventory/items">
                            <div class="nav-content">
                                <div class="nav-item" id="item-input">
                                    <label>Search for item</label>
                                    <div class="search-order">
                                        <i class='bx bx-search-alt-2'></i>
                                        <input type="text" placeholder="Search" name="search" value="{{old('search', request()->input('search'))}}">
                                    </div>
                                </div>
                                <div class="nav-select">
                                    <div class="nav-item">
                                        <label>Status</label>
                                        <select name="status" id="status" class="select-input" onchange="this.form.submit()">
                                            <option value="" {{(request('status') == 'all') ? 'selected' : ''}}>All</option>
                                            <option value="InStock" {{(request('status') == 'InStock') ? 'selected' : ''}}>In Stock</option>
                                            <option value="OutStock" {{(request('status') == 'OutStock') ? 'selected' : ''}}>Out of Stock</option>
                                        </select>
                                    </div>
                                    <div class="nav-item">
                                        <label>Category</label>
                                        <select name="category" id="category" class="select-input" onchange="this.form.submit()">
                                            <option value="">All</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" {{($category->id == request('category')) ? 'selected' : ''}}>{{$category->name}}</option>
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
                        <input id="deleteIdsButton" type="button" class="deleteButton" value="Delete Items" onclick="submitIdsForm()">
                    </div>
                </div>
                    <div class = "table-container">
                        <table class = "content-table">
                            <thead>
                                <form action="/inventory/items" id="submitForm">
                                    @php
                                        $sort_column = request('sort_column');
                                        $sort_order = request('sort_order');
                                    @endphp
                                <tr>
                                    <th class="center-cell">
                                        <label class="checkbox-container">
                                            <input type="checkbox" id="checkAll" class="custom-checkbox" onchange="checkAllcheckboxes()">
                                            <span class="checkmark"></span>
                                        </label>
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
                                            <div id="sortByName">Name</div>
                                            <div 
                                                class="sort-icon two
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
                                            <div id="sortByCategory">Category</div>
                                            <div 
                                                class="sort-icon six
                                                {{(($sort_column == 'category_id') && ($sort_order == 'A')) ? 'up' : ''}}
                                                {{(($sort_column == 'category_id') && ($sort_order == 'D')) ? 'down' : ''}} 
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
                                                class="sort-icon three
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
                                                class="sort-icon four
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
                                            class="sort-icon five 
                                            {{(($sort_column == 'unit_price') && ($sort_order == 'A')) ? 'up' : ''}}
                                            {{(($sort_column == 'unit_price') && ($sort_order == 'D')) ? 'down' : ''}} 
                                        ">
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
                            </form>
                            </thead>
                            <tbody>
                                <form id="deleteIdsForm" action="/inventory/items/delete-items" method="POST">
                                    @csrf
                                    @foreach ($items as $item)
                                        <tr>
                                            <td class="center-cell">
                                                <label class="checkbox-container">
                                                    <input type="checkbox" name="ids[{{$item->id}}]" value="{{$item->id}}" class="checkboxIds custom-checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>{{$item->id}}</td>
                                            <td>
                                                <div class="row-image">
                                                    <img class="table-image" src="{{$item->image ? asset('storage/' . $item->image) : asset('images/default-gray.png')}}" alt="">
                                                    {{$item->name}}
                                                </div>
                                            </td>
                                            <td>{{$item->category->name}}</td>
                                            <td>{{$item->stock}}</td>
                                            <td>${{$item->cost_price}}</td>
                                            <td>${{$item->unit_price}}</td>
                                            <td class = 'center-cell'>
                                                @if ($item->stock >= 1)
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
                                </form>
                            </tbody>
                        </table>
                    <div style="margin-top: 15px;">
                        {{ $items->links('pagination.default') }}
                    </div>
                </div>
        @else
            <div class="empty-table">
                <div id="tittle-text">Start by adding an item</div>
                <a href="/inventory/items/create">
                    <button class="button-create" role="button">Add New Item</button>
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