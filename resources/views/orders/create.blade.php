@push('scripts')
<script>

window.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById("date").valueAsDate = new Date();
});

let removedOptions = [];

function removeSelectedOption(value) {
    let nameInput = document.getElementById('name');
    const name = value.split(',');

    Array.from(nameInput.options).forEach((option, index) => {
        if (option.value === value) {
            removedOptions.push(option);
            option.remove();
        }
    });
}

function restoreRemovedOptions(value) {
    let nameInput = document.getElementById('name');
    const [itemName, itemValue, itemStock] = value.split(',');

    const newOption = document.createElement('option');
    newOption.value = itemName + ',' + itemValue + ',' + itemStock;
    newOption.text = itemName + '- Stock: ' + itemStock;

    nameInput.add(newOption);
    removedOptions = removedOptions.filter(option => option.value !== itemValue);
}
    
    let btnAdd = document.getElementById('addButton');
    let table = document.getElementById('addRow');

    table.addEventListener('click', (event) => {
        let quantityInput = document.getElementById('quantity');
        let nameInput = document.getElementById('name');
        nameInput.addEventListener('change', () => {
            let values = nameInput.options[nameInput.selectedIndex].value.split(',');
            quantityInput.max = values[2];
            quantityInput.readOnly = false;
            quantityInput.value = 1;
        });

    if (event.target.id === 'addButton' && nameInput.value != 0) {
        quantityInput.readOnly = true;
        if(nameInput.options.length > 0) {
            let value = nameInput.value;
            const item = value.split(',');

            let template = `
                <tr data-item-value="${item[0]},${item[1]},${item[2]}">
                    <td>
                        <div>
                            ${item[0]}
                            <input type="hidden" name="ids[${item[1]}]" value="${item[1]}" />
                        </div>
                    </td>
                    <td class="center-cell">
			            <input class="input-box" type="number" value="${quantity.value}" name="quantities[${item[1]}]" style="max-width: 60px" min="1" max="${item[2]}">
                    </td>
                    <td class="center-cell">
                        $20
                    </td>
                    <td class='actions center-cell'>
                        <input class="newButton deleteButton" type="button" value="Delete">
                    </td>
                </tr>`;
            table.innerHTML += template;

            removeSelectedOption(value);
            nameInput.value = '';
        }
    }
    if (event.target.classList.contains('deleteButton')) {
        const row = event.target.closest('tr');
        const deletedItemValue = row.dataset.itemValue;

        row.remove();
        restoreRemovedOptions(deletedItemValue);
    }
});

    const deleteButtons = document.querySelectorAll('.bxs-trash');
    deleteButtons.forEach(deleteBtn => {
    deleteBtn.addEventListener('click', () => {
        // Your delete logic here
        const file = document.getElementById('upload_file');
        const fileContent = document.querySelector('.file-content');
        const fileIcon = document.querySelector('.file-icon');
        file.value = '';
        imagediv.innerHTML = '';
        isImageSet();
        fileIcon.classList.remove('imgSet');
        fileContent.classList.remove('imgSet');
    });
});
</script>
@endpush
<x-layout :title="'Add New Order | MyStoreSystem'">
    <div class="content">
        <div class="content-header">
            <div class="header-text">
                <a href="/orders">Orders</a>
                <div class="animated-header">> New Order</div>
            </div>
        </div>
        <form action="/orders" method="post">
            @csrf
            <div class="item-info">
                <div class="item-fields">
                    <div class="content-items">
                        <label>Date</label>
                        <input type="date" name="date" value="{{old('date')}}" id="date">
                        @error('date')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Customer</label>
                        <select name="customer_id">
                            <option value="" disabled selected>Select a customer</option>
                            @foreach ($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->first_name}} {{$customer->last_name}}</option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Status</label>
                        <select name="status" id="status" class="select-input">
                            <option value="paid">Paid</option>
                            <option value="pending">Pending</option>
                        </select>
                        @error('status')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class = "table-container" style="margin-top: 20px;">
                <span>items</span>
                <table class = "content-table">
                    <thead>
                        <tr>
                            <th>Item name</th>
                            <th class="center-cell">Quantity</th>
                            <th class="center-cell">Amount</th>
                            <th class = "center-cell" style = "width: 200px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="addRow">
                        <tr>
                            <td>
                                <div>
                                    <select id="name" class="input-box" style="max-width: 300px;">
                                        <option value="0" disabled selected>Select Item</option>
                                        @foreach ($items as $item)
                                            <option value="{{$item->name}},{{$item->id}},{{$item->stock}},{{$item->unit_price}}">{{$item->name}} - Stock: {{$item->stock}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td class="center-cell">
                                <input class="input-box" type="number" id="quantity" style="max-width: 60px" min="1" readonly>
                            </td>
                            <td></td>
                            <td class = 'actions center-cell'>
                                <input id="addButton" class="newButton" type="button" value="Add">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-buttons">
                <input class="newButton cancelButton" type="button" value="Cancel">
                <input class="newButton" type="submit" value="Save">
            </div>
        </form>
    </div>
</x-layout>