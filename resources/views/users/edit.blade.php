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
<x-layout :title="'Edit User | MyStoreSystem'">
    <div class="content">
        <div class="content-header">
            <div class="header-text">
                <a href="/users">Users</a>
                <div class="animated-header">> Edit User</div>
            </div>
        </div>
        <form action="/users/{{$user->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="item-info">
                <div class="item-fields">
                    <div class="content-items">
                        <label>First Name</label>
                        <input type="text" name="first_name" value="{{$user->first_name}}">
                        @error('first_name')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="{{$user->last_name}}">
                        @error('last_name')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Username</label>
                        <input type="text" name="username" value="{{$user->username}}">
                        @error('username')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Email</label>
                        <input type="email" name="email" value="{{$user->email}}">
                        @error('email')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>New Password</label>
                        <input type="password" name="password">
                        @error('password')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation">
                        @error('password_confirmation')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Role</label>
                        <select name="role">
                            @foreach ($roles as $role)
                                <option value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Status</label>
                        <select name="status" value="active">
                            <option value="1" {{$user->status == 1 ? 'selected' :''}}>Active</option>
                            <option value="0" {{$user->status == 0 ? 'selected' : ''}}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="file-content">
                    <div id="preview"></div>
                    @if($user->image)
                        <img id="item-image" src="{{asset('storage/' . $user->image)}}" alt="image">
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
                <a href="/users" style="text-decoration: none;">
                    <input class="newButton cancelButton" type="button" value="Cancel">
                </a>
                <input class="newButton" type="submit" value="Save">
            </div>
        </form>
    </div>
</x-layout>