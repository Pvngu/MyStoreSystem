<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{asset('css\sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css\table.css')}}">
    <link rel="stylesheet" href="{{asset('css\home.css')}}">
    @stack('css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        var savedTheme = getCookie('selected_theme');
        if (savedTheme) {
            document.getElementsByTagName('html')[0].classList.add(savedTheme);
        }
        function getCookie(name) {
        var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        if (match) return match[2];
}
    </script>

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <div class="logoContent">
            <div class="logo">
                <span>MyStore System</span>
                <div id="btn">
                    <label class="hamburger-menu">
                        <input type="checkbox" id="hamburger">
                    </label>
                </div>
            </div>
        </div>
        <ul class="nameList">
            <div class="topItems">
                <div class="itemsHeader">Menu</div>
                <li>
                    <a href="/home">
                        <i class='bx bx-home-alt-2'></i>
                        <span>Home</span>
                    </a>
                    <span class="tooltip">Home</span>
                </li>
                <li>
                    <a href="/dashboard">
                        <i class='bx bxs-dashboard'></i>
                        <span>Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>
                <li>
                    <a id="inventory">
                        <i class='bx bx-package'></i>
                        <span>Inventory</span>
                        <i class='bx bx-chevron-right submenuArrow invArrow'></i>
                    </a>
                    <span class="tooltip">inventory</span>
                    <ul class="submenu-items sm-inv">
                        <li>
                            <a href="/inventory/items">Items</a>
                        </li>
                        <li>
                            <a href="/inventory/items/create">New Items</a>
                        </li>
                        <li>
                            <a href="/inventory/categories">Categories</a>
                        </li>
                        <li>
                            <a href="/inventory/categories/create">New Category</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a id="orders">
                        <i class='bx bx-shopping-bag'></i>
                        <span>Orders</span>
                        <i class='bx bx-chevron-right submenuArrow ordersArrow'></i>
                    </a>
                    <span class="tooltip">Orders</span>
                    <ul class="submenu-items sm-orders">
                        <li>
                            <a href="/orders">View Orders</a>
                        </li>
                        <li>
                            <a href="/orders/create">New Order</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a id="customers">
                        <i class='bx bx-group'></i>
                        <span>Customers</span>
                        <i class='bx bx-chevron-right submenuArrow customersArrow'></i>
                    </a>
                    <span class="tooltip">Customers</span>
                    <ul class="submenu-items sm-customers">
                        <li>
                            <a href="/customers">View Customers</a>
                        </li>
                        <li>
                            <a href="/customers/create">New Customer</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a id="users">
                        <i class='bx bxs-user-account'></i>
                        <span>Users</span>
                        <i class='bx bx-chevron-right submenuArrow usersArrow'></i>
                    </a>
                    <span class="tooltip">Users</span>
                    <ul class="submenu-items sm-users">
                        <li>
                            <a href="/users">View Users</a>
                        </li>
                        <li>
                            <a href="/users/create">New Users</a>
                        </li>
                        <li>
                            <a href="/users/roles">View Roles</a>
                        </li>
                        <li>
                            <a href="/users/roles/create">New Role</a>
                        </li>
                    </ul>
                </li>
            </div>
            <div class="bottomItems">
                <div class="itemsHeader">Preferences</div>
                <li>
                    <a class="openModalS">
                        <i class='bx bx-cog'></i>
                        <span>Settings</span>
                    </a>
                    <span class="tooltip">Settings</span>
                </li>
                <li>
                    <a class="openModalL">
                        <i class='bx bx-log-out-circle'></i>
                        <span>Logout</span>
                    </a>
                    <span class="tooltip">Logout</span>
                </li>
            </div>
        </ul>
    </div>
    <div class="home">
        <header>
            <div class="headerContent">
                <div class="leftContent">
                    <h1 class="bizName">MyStore System</h1>
                </div>
                <div class="rightContent">
                    <i class='bx bx-bell'></i>
                    <div class="userProfile">
                        <div class="userText">
                            <div class="name">{{Auth::User()->username}}</div>
                            <div class="job">{{Auth::User()->role}}</div>
                        </div>
                        <div class="profilePicture">
                            <img src="{{Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/default-profile-picture.jpg')}}">
                        </div>
                    </div>
                </div>
            </div>
        </header>
        {{$slot}}
        <!-- settigns menu -->
        <dialog class="settingsModal modal">
            <div class="modalHeader">
                <h1>Settings</h1>
                <i class='bx bx-x closeBtnModalS modalX'></i>
            </div>
            <div class="modalContent stgModal">
                <div class="switchContainer">
                    <h2>Theme</h2>
                    <div class="theme-switcher">
                        <input type="radio" id="light-theme" name="themes">
                        <label for="light-theme">
                            <span>
                                <i class='bx bxs-sun'></i> Light
                            </span>
                        </label>
                        <input type="radio" id="dark-theme" name="themes">
                        <label for="dark-theme">
                            <span>
                                <i class='bx bxs-moon'></i> Dark
                            </span>
                        </label>
                        <span class="slider"></span>
                    </div>
                </div>
                <ul>
                    <li>
                        <a class="openModalAS">
                            <i class='bx bx-cog'></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <a class="openModalAU">
                            <i class='bx bx-info-circle'></i>
                            <span>About the page</span>
                        </a>
                    </li>
                </ul>
            </div>
        </dialog>
        <!-- Logout menu -->
        <dialog class="logoutModal modal">
            <div class="modalHeader">
                <h1>Logout</h1>
                <i class='bx bx-x closeBtnModalL modalX'></i>
            </div>
            <div class="modalContent lgtModal">
                <form action="/logout" method="get">
                    <div class="logoutText">Are you sure you want to logout?</div>
                    <div class="logoutButtons">
                        <button type="button" id="logoutClose" class = "closeBtnModalL">Cancel</button>
                        <input id="logoutOk" value="OK" type="submit">
                    </div>
                </form>
            </div>
        </dialog>
        <!-- Account settings -->
        <dialog class="accountStgModal modal">
            <div class="modalHeader">
                <h1>Account Settings</h1>
                <i class='bx bx-x closeBtnModalAS modalX'></i>
            </div>
            <div class="modalContent accStgModal">
                <ul>
                    <h2>Account Information</h2>
                    <li>
                        <i class='bx bx-hash'></i>
                        <span>User ID: {{Auth::user()->id}}</span>
                    </li>
                    <li>
                        <i class='bx bx-user'></i>
                        <span>Name: {{Auth::user()->name}}</span>
                    </li>
                    <li>
                        <i class='bx bx-user'></i>
                        <span>Username: {{Auth::user()->username}}</span>
                    </li>
                    <li>
                        <i class='bx bx-user'></i>
                        <span>Role: {{Auth::user()->role}}</span>
                    </li>
                </ul>
            </div>
        </dialog>
        <!-- About us -->
        <dialog class="aboutUsModal modal">
                <div class="modalHeader">
                    <h1>About the page</h1>
                    <i class='bx bx-x closeBtnModalAU modalX'></i>
                </div>
                <div class="modalContent AUModal">
                    <p>This page was created for educational purposes</p>
                </div>
        </dialog>
    </div>
    <x-flash-message />
</body>
<script src="{{asset('js/sidebar.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@stack('scripts')
</html>