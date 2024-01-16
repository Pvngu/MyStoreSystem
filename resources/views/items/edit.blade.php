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
            const img = document.getElementById('item-image');
            const fileContent = document.querySelector('.file-content');
            const fileIcon = document.querySelector('.file-icon');
            if(img) {
                fileContent.classList.add('imgSet');
                fileIcon.classList.add('imgSet');
                if(jsImg) {
                    img.style.display = "none";
                }
            }
            if(jsImg) {
                fileContent.classList.add('imgSet');
                fileIcon.classList.add('imgSet');
            }
        }

        const deleteImg = document.querySelector('.bxs-trash');
        deleteImg.addEventListener('click', () => {
            const img = document.getElementById('item-image');
            const file = document.getElementById('upload_file');
            const fileContent = document.querySelector('.file-content');
            const fileIcon = document.querySelector('.file-icon');
            file.value = '';
            imagediv.innerHTML = '';
            isImageSet();
            fileIcon.classList.remove('imgSet');
            fileContent.classList.remove('imgSet');
            img.style.display= 'none';
        });

        deleteImg.addEventListener('click', () => {
            document.getElementById('empty_image').value = 'yes';
        });
    </script>
@endpush
<x-layout :title="'Edit Item | MyStoreSystem'">
    <div class="content">
        <div class="content-header">
            <div class="header-text">
                <a href="/inventory/items">Inventory</a>
                <div class="animated-header">> Edit Item</div>
            </div>
        </div>
        <form action="/inventory/items/{{$item->id}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="item-info">
                <div class="item-fields">
                    <div class="content-items">
                        <label>Name</label>
                        <input type="text" name="name" value="{{$item->name}}">
                        @error('name')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Stock</label>
                        <input type="number" min="0" name="stock" value="{{$item->stock}}">
                        @error('stock')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Cost Price</label>
                        <input type="text" name="cost_price" value="{{$item->cost_price}}">
                        @error('cost_price')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Selling price</label>
                        <input type="text" name="unit_price" value="{{$item->unit_price}}">
                        @error('unit_price')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Category</label>
                        <select name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{($category->id == $item->category_id) ? 'selected' : ''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="file-content">
                        <div id="preview"></div>
                        @if($item->image)
                            <img id="item-image" src="{{asset('storage/' . $item->image)}}" alt="image">
                        @endif
                    <div class="file-icon">
                        <img src="{{asset('images/files-icon.png')}}" alt="file upload image">
                        <span>Drag an image or click to select a file</span>
                    </div>
                        <input type="file" name="image" accept="image/gif,image/jpeg,image/png,image/jpg" id="upload_file" onchange="getImagePreview(event)">
                        <i class='bx bxs-trash'></i>
                        <input type="hidden" id="empty_image" name="empty_image">
                </div>
            </div>
            <div class="form-buttons">
                <a href="/inventory/items" style="text-decoration: none;">
                    <input class="newButton cancelButton" type="button" value="Cancel">
                </a>
                <input class="newButton" type="submit" value="Save">
            </div>
        </form>
    </div>
</x-layout>