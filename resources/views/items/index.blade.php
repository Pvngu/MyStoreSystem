@push('scripts')
    <script src="{{asset('js/table.js')}}"></script>
@endpush
<x-layout>
    <div class="content">
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
                </form>
            </nav>
        </div>
        <div class = "table-container">
            <table class = "content-table">
                <thead>
                    <tr>
                        <form action="inventory/items">
                            <th class="center-cell"><input type="checkbox"></th>
                            <th>#</th>
                            <th>Name</th>
                            <th>stock</th>
                            <th>cost price</th>
                            <th>unit price</th>
                            <th>category</th>
                            <th class = "center-cell">Status</th>
                            <th class = "center-cell">Actions</th>
                        </form>
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