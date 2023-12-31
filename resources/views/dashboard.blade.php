<x-layout>
    <div class="content">
        <div class="dashboard-header">
            <span>Sales Report</span>
        </div>
        <div class="cards">
            <div class="left-content">
                <div class="card-container">
                    <div class="card-item">
                        <div class="card-header">
                            <span class="card-tittle">Total Earning</span>
                            <i class='bx bx-dollar'></i>
                        </div>
                        <div class="card-content">
                            <span class="card-number">$ 23,545</span>
                        </div>
                        <span class="card-date">Since last month</span>
                    </div>
                    <div class="card-item">
                        <div class="card-header">
                            <span class="card-tittle">Customers</span>
                            <i class='bx bx-group'></i>
                        </div>
                        <div class="card-content">
                            <span class="card-number">106</span>
                        </div>
                        <span class="card-date">Since last month</span>
                    </div>
                    <div class="card-item">
                        <div class="card-header">
                            <span class="card-tittle">Items</span>
                            <i class='bx bx-package'></i>
                        </div>
                        <div class="card-content">
                            <span class="card-number">{{$itemCount}}</span>
                        </div>
                        <span class="card-date">Since last month</span>
                    </div>
                    <div class="card-item">
                        <div class="card-header">
                            <span class="card-tittle">Orders</span>
                            <i class='bx bxs-shopping-bag'></i>
                        </div>
                        <div class="card-content">
                            <span class="card-number">205</span>
                        </div>
                        <span class="card-date">Since last month</span>
                    </div>
                </div>
                <div class="card-item last-card">
                </div>
            </div>
            <div class="right-content">
                <div class="card-table">
                    <div class="card-table-header">
                        <span>Top Selling Items</span>
                    </div>
                    <div class="card-table-content">
                        <table class = "content-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="center-cell">Sold</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="row-image">
                                            <img class="table-image" src="\assets\images\pencil-test.png" alt="">
                                            Pencil
                                        </div>
                                    </td>
                                    <td class="center-cell">23</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row-image">
                                            <img class="table-image" src="\assets\images\pencil-test.png" alt="">
                                            Pencil
                                        </div>
                                    </td>
                                    <td class="center-cell">23</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row-image">
                                            <img class="table-image" src="\assets\images\pencil-test.png" alt="">
                                            Pencil
                                        </div>
                                    </td>
                                    <td class="center-cell">23</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row-image">
                                            <img class="table-image" src="\assets\images\pencil-test.png" alt="">
                                            Pencil
                                        </div>
                                    </td>
                                    <td class="center-cell">23</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-table">
                    <div class="card-table-header">
                        <span>Recent Orders</span>
                    </div>
                    <div class="card-table-content">
                        <table class = "content-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="center-cell">Items</th>
                                    <th class="center-cell">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="row-image">
                                            Rodolfo El Reno
                                        </div>
                                    </td>
                                    <td class="center-cell">3</td>
                                    <td class="center-cell">$23</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row-image">
                                            Rodolfo El Reno
                                        </div>
                                    </td>
                                    <td class="center-cell">3</td>
                                    <td class="center-cell">$23</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row-image">
                                            Rodolfo El Reno
                                        </div>
                                    </td>
                                    <td class="center-cell">3</td>
                                    <td class="center-cell">$23</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row-image">
                                            Rodolfo El Reno
                                        </div>
                                    </td>
                                    <td class="center-cell">3</td>
                                    <td class="center-cell">$23</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row-image">
                                            Rodolfo El Reno
                                        </div>
                                    </td>
                                    <td class="center-cell">3</td>
                                    <td class="center-cell">$23</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>