<table class = "content-table">
    <thead>
        <form action="{{$action}}" id="submitForm">
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
            <input type="hidden" name="sort_column" id="sort_column" value="{{old('sort_column', request()->input('sort_column'))}}">
            <input type="hidden" name="sort_order" id="sort_order" value="{{old('sort_order', request()->input('sort_order'))}}">
        </tr>
    </form>
    </thead>
    <tbody>
        {{ $slot }}
    </tbody>
</table>