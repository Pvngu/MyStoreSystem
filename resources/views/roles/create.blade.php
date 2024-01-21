@push('css')
<style>
    .content-items {
        justify-content: start;

        label {
            width: 70px;
        }

        input {
            width: 280px;
        }
    }
    .cards-header {
        font-size: 1.3rem; 
        font-weight: 500;
        margin: 0;
        padding: 0;
        transform: translateY(13px);
    }

    .flex-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
    }

    .cards {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    .checkbox-wrapper-16 *,
    .checkbox-wrapper-16 *:after,
    .checkbox-wrapper-16 *:before {
    box-sizing: border-box;
    display: inline-block;
    }

    .checkbox-wrapper-16 .checkbox-input {
    clip: rect(0 0 0 0);
    -webkit-clip-path: inset(100%);
    clip-path: inset(100%);
    height: 1px;
    overflow: hidden;
    white-space: nowrap;
    width: 1px;
    }

    .checkbox-wrapper-16 .checkbox-input:checked + .checkbox-tile {
    border-color: #2260ff;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    color: #2260ff;
    }

    .checkbox-wrapper-16 .checkbox-input:checked + .checkbox-tile:before {
    transform: scale(1);
    opacity: 1;
    background-color: #2260ff;
    border-color: #2260ff;
    }

    .checkbox-wrapper-16 .checkbox-input:checked + .checkbox-tile .checkbox-icon,
    .checkbox-wrapper-16 .checkbox-input:checked + .checkbox-tile .checkbox-label {
    color: #2260ff;
    }

    .checkbox-wrapper-16 .checkbox-input:focus + .checkbox-tile {
    border-color: #2260ff;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1), 0 0 0 4px #b5c9fc;
    }

    .checkbox-wrapper-16 .checkbox-input:focus + .checkbox-tile:before {
    transform: scale(1);
    opacity: 1;
    }

    .checkbox-wrapper-16 .checkbox-tile {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 7rem;
    min-height: 7rem;
    border-radius: 0.5rem;
    border: 2px solid #b5bfd9;
    background-color: #fff;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    transition: 0.15s ease;
    cursor: pointer;
    position: relative;
    }

    .checkbox-wrapper-16 .checkbox-tile:before {
    content: "";
    position: absolute;
    display: block;
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid #b5bfd9;
    background-color: #fff;
    border-radius: 50%;
    top: 0.25rem;
    left: 0.25rem;
    opacity: 0;
    transform: scale(0);
    transition: 0.25s ease;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='://www.w3.org/2000/svg' width='192' height='192' fill='%23FFFFFF' viewBox='0 0 256 256'%3E%3Crect width='256' height='256' fill='none'%3E%3C/rect%3E%3Cpolyline points='216 72.005 104 184 48 128.005' fill='none' stroke='%23FFFFFF' stroke-linecap='round' stroke-linejoin='round' stroke-width='32'%3E%3C/polyline%3E%3C/svg%3E");
    background-size: 12px;
    background-repeat: no-repeat;
    background-position: 50% 50%;
    }

    .checkbox-wrapper-16 .checkbox-tile:hover {
    border-color: #2260ff;
    }

    .checkbox-wrapper-16 .checkbox-tile:hover:before {
    transform: scale(1);
    opacity: 1;
    }

    .checkbox-wrapper-16 .checkbox-icon {
    transition: 0.375s ease;
    color: #494949;
    }

    .checkbox-wrapper-16 .checkbox-icon svg {
    width: 3rem;
    height: 3rem;
    }

    .checkbox-wrapper-16 .checkbox-label {
    color: #707070;
    transition: 0.375s ease;
    text-align: center;
    }
</style>
@endpush
@push('scripts')
@endpush
<x-layout :title="'Add New Role | MyStoreSystem'">
    <div class="content">
        <div class="content-header">
            <div class="header-text">
                <a href="/users/roles">Roles</a>
                <div class="animated-header">> New Role</div>
            </div>
        </div>
        <form action="/users/roles" method="post">
            @csrf
            <div>
                <div class="content-items">
                    <label>name</label>
                    <input style="flex-grow: 0;" type="text" name="name" value="{{old('name')}}">
                    @error('name')
                        <p class="errorMessage">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex-cards">
                    <div class="cards-content">
                        <div class="cards-header" style="">Inventory</div>
                        <div class="cards">
                            <div class="checkbox-wrapper-16">
                                <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="ids[0]" value="menu-inventory">
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <i class='bx bx-table' ></i>
                                    </span>
                                    <span class="checkbox-label">View</span>
                                </span>
                                </label>
                            </div>
                            <div class="checkbox-wrapper-16">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="ids[1]" value="create inventory">
                                <span class="checkbox-tile">
                                <span class="checkbox-icon">
                                    <i class='bx bx-layer-plus'></i>
                                </span>
                                <span class="checkbox-label">Create</span>
                                </span>
                            </label>
                            </div>
                            <div class="checkbox-wrapper-16">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="ids[2]" value="edit inventory">
                                <span class="checkbox-tile">
                                <span class="checkbox-icon">
                                    <i class='bx bxs-edit'></i>
                                </span>
                                <span class="checkbox-label">Edit</span>
                                </span>
                            </label>
                            </div>
                            <div class="checkbox-wrapper-16">
                                <label class="checkbox-wrapper">
                                    <input class="checkbox-input" type="checkbox" name="ids[3]" value="delete inventory">
                                    <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <i class='bx bxs-trash'></i>
                                    </span>
                                    <span class="checkbox-label">Delete</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="cards-content">
                        <div class="cards-header" style="">Customers</div>
                        <div class="cards">
                            <div class="checkbox-wrapper-16">
                                <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="ids[4]" value="menu-customers">
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <i class='bx bx-table' ></i>
                                    </span>
                                    <span class="checkbox-label">View</span>
                                </span>
                                </label>
                            </div>
                            <div class="checkbox-wrapper-16">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="ids[5]" value="create customer">
                                <span class="checkbox-tile">
                                <span class="checkbox-icon">
                                    <i class='bx bx-layer-plus'></i>
                                </span>
                                <span class="checkbox-label">Create</span>
                                </span>
                            </label>
                            </div>
                            <div class="checkbox-wrapper-16">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="ids[6]" value="edit customer">
                                <span class="checkbox-tile">
                                <span class="checkbox-icon">
                                    <i class='bx bxs-edit'></i>
                                </span>
                                <span class="checkbox-label">Edit</span>
                                </span>
                            </label>
                            </div>
                            <div class="checkbox-wrapper-16">
                                <label class="checkbox-wrapper">
                                    <input class="checkbox-input" type="checkbox" name="ids[7]" value="delete customer">
                                    <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <i class='bx bxs-trash'></i>
                                    </span>
                                    <span class="checkbox-label">Delete</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="cards-content">
                        <div class="cards-header" style="">Orders</div>
                        <div class="cards">
                            <div class="checkbox-wrapper-16">
                                <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="ids[8]" value="menu-orders">
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <i class='bx bx-table' ></i>
                                    </span>
                                    <span class="checkbox-label">View</span>
                                </span>
                                </label>
                            </div>
                            <div class="checkbox-wrapper-16">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="ids[9]" value="create order">
                                <span class="checkbox-tile">
                                <span class="checkbox-icon">
                                    <i class='bx bx-layer-plus'></i>
                                </span>
                                <span class="checkbox-label">Create</span>
                                </span>
                            </label>
                            </div>
                            <div class="checkbox-wrapper-16">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="ids[10]" value="edit order">
                                <span class="checkbox-tile">
                                <span class="checkbox-icon">
                                    <i class='bx bxs-edit'></i>
                                </span>
                                <span class="checkbox-label">Edit</span>
                                </span>
                            </label>
                            </div>
                            <div class="checkbox-wrapper-16">
                                <label class="checkbox-wrapper">
                                    <input class="checkbox-input" type="checkbox" name="ids[11]" value="delete order">
                                    <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <i class='bx bxs-trash'></i>
                                    </span>
                                    <span class="checkbox-label">Delete</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="cards-content">
                        <div class="cards-header" style="">Users</div>
                        <div class="cards">
                            <div class="checkbox-wrapper-16">
                                <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="ids[12]" value="menu-users">
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <i class='bx bx-table' ></i>
                                    </span>
                                    <span class="checkbox-label">View</span>
                                </span>
                                </label>
                            </div>
                            <div class="checkbox-wrapper-16">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="ids[13]" value="create user">
                                <span class="checkbox-tile">
                                <span class="checkbox-icon">
                                    <i class='bx bx-layer-plus'></i>
                                </span>
                                <span class="checkbox-label">Create</span>
                                </span>
                            </label>
                            </div>
                            <div class="checkbox-wrapper-16">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="ids[14]" value="edit user">
                                <span class="checkbox-tile">
                                <span class="checkbox-icon">
                                    <i class='bx bxs-edit'></i>
                                </span>
                                <span class="checkbox-label">Edit</span>
                                </span>
                            </label>
                            </div>
                            <div class="checkbox-wrapper-16">
                                <label class="checkbox-wrapper">
                                    <input class="checkbox-input" type="checkbox" name="ids[15]" value="delete user">
                                    <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <i class='bx bxs-trash'></i>
                                    </span>
                                    <span class="checkbox-label">Delete</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="cards-header" style="">Dashboard</div>
                        <div class="cards">
                            <div class="checkbox-wrapper-16">
                                <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="ids[16]" value="menu-dashboard">
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <i class='bx bx-table' ></i>
                                    </span>
                                    <span class="checkbox-label">View</span>
                                </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-buttons">
                    <a href="/orders" style="text-decoration: none;">
                        <input class="newButton cancelButton" type="button" value="Cancel">
                    </a>
                    <input class="newButton" type="submit" value="Create">
                </div>
            </div>
        </form>
    </div>
</x-layout>