@push('scripts')
<script>
    window.onload = isImageSet();
    var imagediv = document.getElementById('preview');
    function getImagePreview() {
        var image = URL.createObjectURL(event.target.files[0]);
        var newimg = document.createElement('img');
        imagediv.innerHTML = '';
        newimg.src = image;
        imagediv.appendChild(newimg);
        isImageSet(image);
    }

    function isImageSet(jsImg){
        const fileContent = document.querySelector('.file-content');
        const fileIcon = document.querySelector('.file-icon');
        if(jsImg) {
            fileContent.classList.add('imgSet');
            fileIcon.classList.add('imgSet');
        }
    }

    const deleteImg = document.querySelector('.bxs-trash');
    deleteImg.addEventListener('click', () => {
        const file = document.getElementById('upload_file');
        const fileContent = document.querySelector('.file-content');
        const fileIcon = document.querySelector('.file-icon');
        file.value = '';
        imagediv.innerHTML = '';
        isImageSet();
        fileIcon.classList.remove('imgSet');
        fileContent.classList.remove('imgSet');
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
    const [itemName, itemValue] = value.split(',');

    const newOption = document.createElement('option');
    newOption.value = itemName + ',' + itemValue;
    newOption.text = itemName;

    nameInput.add(newOption);
    removedOptions = removedOptions.filter(option => option.value !== itemValue);
}
    
    let btnAdd = document.getElementById('addButton');
    let table = document.getElementById('addRow');
    let count = 0

    table.addEventListener('click', (event) => {
    if (event.target.id === 'addButton') {
        let nameInput = document.getElementById('name');
        if(nameInput.options.length > 0) {
            let value = nameInput.value;
            const item = value.split(',');
            count++;

            document.getElementById('itemCount').value = count;

            let template = `
                <tr data-item-value="${item[0]},${item[1]}">
                    <td>
                        <div>
                            ${item[0]}
                            <input type="hidden" name="item${count}" value="${item[1]}" />
                        </div>
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
<x-layout :title="'Add New Category | MyStoreSystem'">
    <div class="content">
        <div class="content-header">
            <div class="header-text">
                <a href="/inventory/categories">Categories</a>
                <div class="animated-header">> New Category</div>
            </div>
        </div>
        <form action="/inventory/categories" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="item-info">
                <div class="item-fields">
                    <div class="content-items">
                        <label>Name</label>
                        <input type="text" name="name">
                        @error('name')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Description</label>
                        <textarea spellcheck="false" name="description" rows="6" style="min-width: 300px;"></textarea>
                    </div>
                </div>
                <div class="file-content">
                    <div id="preview"></div>
                    <div class="file-icon">
                        <img src="{{asset('images/files-icon.png')}}" alt="file upload image">
                        <span>Drag an image or click to select a file</span>
                    </div>
                    <input type="file" name="image" accept="image/gif,image/jpeg,image/png,image/jpg" id="upload_file" onchange="getImagePreview(event)">
                    <i class='bx bxs-trash'></i>
                </div>
            </div>
            <div class = "table-container" style="margin-top: 20px;">
                <span>item table</span>
                <table class = "content-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class = "center-cell" style = "width: 200px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="addRow">
                        <tr>
                            <td>
                                <div class="row-image">
                                    <select id="name" class="input-box" style="max-width: 300px;">
                                        @foreach ($items as $item)
                                            <option value="{{$item->name}},{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td class = 'actions center-cell'>
                                <input id="addButton" class="newButton" type="button" value="Add">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="itemCount" id="itemCount">
            </div>
            <div class="form-buttons">
                <a href="/inventory/categories" style="text-decoration: none;">
                    <input class="newButton cancelButton" type="button" value="Cancel">
                </a>
                <input class="newButton" id="" type="submit" value="Save">
            </div>
        </form>
    </div>
</x-layout>