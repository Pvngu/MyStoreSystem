@push('scripts')
    <script src="{{asset('js/table.js')}}"></script>
    <script src="{{asset('js/tableSort.js')}}"></script>
    <script src="{{asset('js/checkboxes.js')}}"></script>
@endpush
<x-layout>
    <div class="content">
        @if(count($categoryNumbers) >= 1)
            <div class="content-header">
                <div style="font-size: 1.4rem;">Categories</div>
                <a id = "addButton" href="/inventory/categories/create">
                    <span style="font-weight: 700;">+</span> New
                </a>
            </div>
                <div>
                    <nav>
                        <form action="/inventory/categories">
                            <div class="nav-content" style="background: none;">
                                <div class="nav-select">
                                    <div class="nav-item" id="item-input">
                                        <label>Search for Category</label>
                                        <div class="search-order" style="flex-grow: 0; max-width: 500px;">
                                            <i class='bx bx-search-alt-2'></i>
                                            <input type="text" placeholder="Search" name="search" value="{{old('search', request()->input('search'))}}">
                                        </div>
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
                @php
                    $sort_column = request('sort_column');
                    $sort_order = request('sort_order');
                @endphp
                <div class = "table-container">
                    <x-table.table
                    :headers="[
                        ['name'=> 'id', 'column_type' => 'sortable'],
                        ['name' => 'name', 'column_type' => 'sortable'],
                        'description',
                        ['name' => 'items', 'align' => 'center']
                        ]"
                    :action="'/inventory/categories'"
                    >
                    <form id="deleteIdsForm" action="/inventory/categories/delete-categories" method="POST">
                        @csrf
                        @foreach ($categories as $category)
                            <tr>
                                <td class="center-cell">
                                    @if($category->id > 1)
                                    <x-checkbox>
                                        <input type="checkbox" name="ids[{{$category->id}}]" value="{{$category->id}}" class="checkboxIds">
                                    </x-checkbox>
                                    @endif
                                </td>
                                <td>{{$category->id}}</td>
                                <td>
                                    <div class="row-image">
                                        <img class="table-image" src="{{$category->image ? asset('storage/' . $category->image) : asset('images/default-gray.png')}}" alt="">
                                        {{$category->name}}
                                    </div>
                                </td>
                                <td>{{$category->description ? $category->description : 'No decription'}}</td>
                                <td class="center-cell">{{$category->items->count()}}</td>
                                <td class = 'actions center-cell'>
                                    @if($category->id > 1)
                                        <a href = '/inventory/categories/{{$category->id}}/edit'>
                                            <i class='bx bxs-edit-alt' style = 'color: #2a8c3f'></i>
                                        </a>
                                        <a class="openModalD" data-item-id='{{$category->id}}'>
                                            <i class='bx bx-trash' style = 'color: #fa7878'></i>
                                        </a>
                                    @endif
                                </td>           
                            </tr>
                        @endforeach
                    </form>
                    </x-table.table>
                </div>
        @else
            <div class="empty-table">
                <div id="tittle-text">Start by creating a category</div>
                <a href="/inventory/categories/create">
                    <button class="button-create" role="button">Create New Category</button>
                </a>
            </div>
        @endif
    </div>
        <!-- Delete popup -->
        <x-delete_confirmation>
            Are you sure you want to delete this category?
        </x-delete_confirmation>
</x-layout>