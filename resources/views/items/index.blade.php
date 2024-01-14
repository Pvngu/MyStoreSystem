@push('scripts')
    <script src="{{asset('js/table.js')}}"></script>
    <script src="{{asset('js/tableSort.js')}}"></script>
    <script src="{{asset('js/checkboxes.js')}}"></script>
@endpush
<x-layout>
    <div class="content">
        @if(count($itemCount) >= 1)
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
                                    <select name="category" class="select-input" onchange="this.form.submit()">
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
                    <x-table.table 
                    :headers="[
                        ['name' => 'id', 'column_type' => 'sortable'], 
                        ['name' => 'name', 'column_type' => 'sortable'], 
                        ['name' => 'category', 'column_type' => 'sortable'], 
                        ['name' => 'stock', 'column_type' => 'sortable'], 
                        ['name' => 'cost_price', 'column_type' => 'sortable'], 
                        ['name' => 'unit_price', 'column_type' => 'sortable'], 
                        ['name' => 'status', 'align' => 'center']]"
                    :action="'/inventory/items/'"
                    >
                    <form id="deleteIdsForm" action="/inventory/items/delete-items" method="POST">
                        @csrf
                        @foreach ($items as $item)
                            <tr>
                                <td class="center-cell">
                                    <x-checkbox>
                                        <input type="checkbox" name="ids[{{$item->id}}]" value="{{$item->id}}" class="checkboxIds">
                                    </x-checkbox>
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
                    </x-table.table>
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
    <x-delete_confirmation>
        Are you sure you want to delete this item?
    </x-delete_confirmation>
</x-layout>