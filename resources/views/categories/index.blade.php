@push('scripts')
    <script src="{{asset('js/table.js')}}"></script>
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
                        <th>items</th>
                        <th>stock</th>
                        <th class = "center-cell">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="center-cell"><input type="checkbox"></td>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>?</td>
                            <td>?</td>
                            <td class = 'actions center-cell'>
                                <a href = '/inventory/categories/{{$category->id}}'>
                                    <i class='bx bxs-edit-alt' style = 'color: #2a8c3f'></i>
                                </a>
                                <a class="openModalD">
                                    <i class='bx bx-trash' style = 'color: #fa7878'></i>
                                </a>
                            </td>
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
                        <input type="hidden" id="item_id" name="item_delete_id">
                        <button id="logoutClose" class = "closeBtnModalD">Cancel</button>
                        <button id="deleteBtn" type="submit">Delete</button>
                    </div>
                </form>
            </div>
        </dialog>
</x-layout>