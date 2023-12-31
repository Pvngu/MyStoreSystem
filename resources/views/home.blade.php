<x-layout>
    <div class="content">
        <div class="welcome">
            <h1>Welcome to MyStore System</h1>
            <h2>Main menu</h2>
        </div>
            <div class="container">
                <a class="item-container" href="/dashboard">
                    <img src="{{asset('images\dashboard.png')}}" alt="dashboard image">
                    <h2>Dashboard</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, ea?</p>
                </a>
                <a class="item-container" href="inventory/items">
                    <img src="{{asset('images\inventory.png')}}" alt="inventory image">
                    <h2>Inventory</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, ea?</p>
                </a>
                <a class="item-container" href="inventory/items">
                    <img src="{{asset('images\inventory.png')}}" alt="inventory image">
                    <h2>Categories</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, ea?</p>
                </a>
                <a class="item-container" href="#">
                    <img src="{{asset('images\report.png')}}" alt="icon image">
                    <h2>Orders</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, ab.</p>
                </a>
                <a class="item-container" href="/customers">
                    <img src="{{asset('images\customers.png')}}" alt="icon image">
                    <h2>Customers</h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum, necessitatibus.</p>
                </a>
                <a class="item-container" href="#">
                    <img src="{{asset('images\userAdmin.png')}}" alt="icon image">
                    <h2>User Management</h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum, necessitatibus.</p>
                </a>
                <a class="item-container">
                    <img src="{{asset('images\settings-icon.png')}}" alt="icon image">
                    <h2>Settings</h2>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex, ab!</p>
                </a>
            </div>
    </div>
</x-layout>