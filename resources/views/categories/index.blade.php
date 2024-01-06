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
            <div style="font-size: 1.4rem;">Categories</div>
            <a id = "addButton" href="/inventory/categories/create">
                <span style="font-weight: 700;">+</span> New
            </a>
        </div>
        <div>
            <nav>
                <form action="/inventory/categories">
                    @csrf
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
        <div class = "table-container">
            <table class = "content-table">
                <thead>
                    <tr>
                        <th class="center-cell"><input type="checkbox"></th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>items</th>
                        <th class = "center-cell">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="center-cell"><input type="checkbox"></td>
                            <td>{{$category->id}}</td>
                            <td>
                                <div class="row-image">
                                    <img class="table-image" src="{{$category->image ? asset('storage/' . $category->image) : asset('images/default-gray.png')}}" alt="">
                                    {{$category->name}}
                                </div>
                            </td>
                            <td>{{$category->description ? $category->description : 'No decription'}}</td>
                            <td>{{$category->items->count()}}</td>
                            @if($category->id > 1)
                                <td class = 'actions center-cell'>
                                    <a href = '/inventory/categories/{{$category->id}}/edit'>
                                        <i class='bx bxs-edit-alt' style = 'color: #2a8c3f'></i>
                                    </a>
                                    <a class="openModalD" data-item-id='{{$category->id}}'>
                                        <i class='bx bx-trash' style = 'color: #fa7878'></i>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        <!-- Delete popup -->
        <dialog class="deleteModal modal">
            <div class="modalHeader">
                <h1>Delete</h1>
                <i class='bx bx-x closeBtnModalD modalX'></i>
            </div>
            <div class="modalContent DelModal">
                <form action="/inventory/categories/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="logoutText">Are you sure you want to delete this category?</div>
                    <div class="logoutButtons">
                        <input type="hidden" id="item_id" name="category_delete_id">
                        <button id="logoutClose" type="button" class = "closeBtnModalD">Cancel</button>
                        <button id="deleteBtn" type="submit">Delete</button>
                    </div>
                </form>
            </div>
        </dialog>
</x-layout>