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
</script>
@endpush
<x-layout>
    <div class="content">
        <div class="content-header">
            <div class="header-text">
                <a href="/inventory/categories">Categories</a>
                <div class="animated-header">> New Category</div>
            </div>
        </div>
        <form action="/inventory/categories/" method="post" enctype="multipart/form-data">
            <div class="item-info">
                <div class="item-fields">
                    <div class="content-items">
                        <label>Name</label>
                        <input type="text" name="name">
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
                            <th class="center-cell"><input type="checkbox"></th>
                            <th>Name</th>
                            <th class="center-cell">Stock</th>
                            <th class = "center-cell">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="center-cell"><input type="checkbox"></td>
                            <td>
                                <div class="row-image">
                                    <img class="table-image" src="\assets\images\pencil-test.png" alt="">
                                    Pencil
                                </div>
                            </td>
                            <td class="center-cell">20</td>
                            <td class = 'actions center-cell'>
                                <a class="openModalD">
                                    <i class='bx bx-trash' style = 'color: #fa7878'></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="center-cell"><input type="checkbox"></td>
                            <td>
                                <div class="row-image">
                                    <img class="table-image" src="\assets\images\default-gray.png" alt="">
                                    <select class="input-box" name="item" style="max-width: 300px;">
                                        @foreach ($items as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td class="center-cell">{{$item->stock}}</td>
                            <td class = 'actions center-cell'>
                                <input class="newButton" type="submit" value="Add">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-buttons">
                <input class="newButton cancelButton" type="button" value="Cancel">
                <input class="newButton" type="button" value="Save">
            </div>
        </form>
    </div>
</x-layout>