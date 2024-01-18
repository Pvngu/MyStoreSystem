@push('css')
    <link rel="stylesheet" href="{{asset('css\home.css')}}">
@endpush
<x-layout :title="'MyStoreSystem'">
    <div class="content">
        <div class="welcome">
            <h1>Welcome to MyStore System</h1>
            <h2>Main menu</h2>
        </div>
            <div class="container">
                <a class="item-container" href="/dashboard">
                    <img src="{{asset('images\dashboard.png')}}" alt="dashboard image">
                    <h2>Dashboard</h2>
                    <p>View your inventory stats in a single page.</p>
                </a>
                <a class="item-container" href="inventory/items">
                    <img src="{{asset('images\inventory.png')}}" alt="inventory image">
                    <h2>Inventory</h2>
                    <p>Have a better control of your items.</p>
                </a>
                <a class="item-container" href="inventory/categories">
                    <img src="{{asset('images\categories.png')}}" alt="inventory image">
                    <h2>Categories</h2>
                    <p>Enhance the organizarion of your items by establishing new categories for your items.</p>
                </a>
                <a class="item-container" href="/orders">
                    <img src="{{asset('images\order.png')}}" alt="icon image">
                    <h2>Orders</h2>
                    <p>Have a control of your orders.</p>
                </a>
                <a class="item-container" href="/customers">
                    <img src="{{asset('images\customers.png')}}" alt="icon image">
                    <h2>Customers</h2>
                    <p>Create customers to have all the information you need from them and create new orders in the future.</p>
                </a>
                <a class="item-container" href="/users">
                    <img src="{{asset('images\userAdmin.png')}}" alt="icon image">
                    <h2>User Management</h2>
                    <p>Manage your users to give them access to whatever you want.</p>
                </a>
                <a class="item-container openModalS">
                    <img src="{{asset('images\settings-icon.png')}}" alt="icon image">
                    <h2>Settings</h2>
                    <p>Change theme color or see additional information about the page</p>
                </a>
            </div>
    </div>
</x-layout>