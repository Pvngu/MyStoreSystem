@push('scripts')
    <script src="{{asset('js/crudTable.js')}}"></script>
@endpush
<div class="deleteItemsNav">
    <div class="nav-content flex-container">
        <div id="count"></div>
        <input id="deleteIdsButton" type="button" class="deleteButton" value="Delete Items" onclick="submitIdsForm()">
    </div>
</div>
<table class = "content-table">
    <thead>
        <form action="{{$sortAction}}" id="submitForm">
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
                @foreach ($headers as $header)
                @if($header['column_type'] == 'sortable')
                <th>
                    <div class="table-head" id="{{$header['name']}}">
                        <div>{{ucfirst(str_replace('_', ' ', $header['name']))}}</div>
                        <div 
                            class="sort-icon
                            {{(($sort_column == $header['name']) && ($sort_order == 'A')) ? 'up' : ''}}
                            {{(($sort_column == $header['name']) && ($sort_order == 'D')) ? 'down' : ''}} 
                        ">
                            <i class='bx bxs-up-arrow'></i>
                            <i class='bx bxs-down-arrow'></i>
                        </div>
                    </div>
                </th>
                @else
                <th class="{{$header['classes']}}">{{$header['name']}}</th>
                @endif
                @endforeach
                <th class = "center-cell">Actions</th>
                <input type="hidden" name="sort_column" id="sort_column" value="{{request('sort_column') ?? ''}}">
                <input type="hidden" name="sort_order" id="sort_order" value="{{request('sort_order') ?? ''}}">
            </tr>
        </form>
    </thead>
    <tbody>
        {{ $slot }}
    </tbody>
</table>

<!-- Delete popup -->
<dialog class="deleteModal modal">
    <div class="modalHeader">
        <h1>Delete</h1>
        <i class='bx bx-x closeBtnModalD modalX'></i>
    </div>
    <div class="modalContent DelModal">
        <form action="{{$deleteAction}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="logoutText">{{$confirmationText}}</div>
            <div class="logoutButtons">
                <input type="hidden" id="item_id" name="row_delete_id">
                <button id="logoutClose" type="button" class = "closeBtnModalD">Cancel</button>
                <button id="deleteBtn" type="submit">Delete</button>
            </div>
        </form>
    </div>
</dialog>