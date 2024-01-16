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
<x-layout :title="'Add New User | MyStoreSystem'">
    <div class="content">
        <div class="content-header">
            <div class="header-text">
                <a href="/users">Users</a>
                <div class="animated-header">> New User</div>
            </div>
        </div>
        <form action="/users" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="item-info">
                <div class="item-fields">
                    <div class="content-items">
                        <label>Name</label>
                        <input type="text" name="name" value="{{old('name')}}">
                        @error('name')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Username</label>
                        <input type="text" name="username" value="{{old('username')}}">
                        @error('username')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Email</label>
                        <input type="email" name="email" value="{{old('email')}}">
                        @error('email')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Password</label>
                        <input type="password" name="password" value="{{old('password')}}">
                        @error('password')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}">
                        @error('password_confirmation')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>User type</label>
                        <select name="role">
                            <option value="" disabled selected>Select a role</option>
                            <option value="admin">Admin</option>
                            <option value="customerMgmt">Customer Management</option>
                            <option value="InventoryMgmt">Inventory Management</option>
                            <option value="OrderMgmt">Order Management</option>
                            <option value="Reporting">Reporting</option>
                        </select>
                        @error('role')
                        <p class="errorMessage">{{$message}}</p>
                    @enderror
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
            <div class="form-buttons">
                <a href="/users" style="text-decoration: none;">
                    <input class="newButton cancelButton" type="button" value="Cancel">
                </a>
                <input class="newButton" type="submit" value="Save">
            </div>
        </form>
    </div>
</x-layout>