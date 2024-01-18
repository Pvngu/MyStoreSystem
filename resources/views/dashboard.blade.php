@push('css')
    <link rel="stylesheet" href="{{asset('css\home.css')}}">
@endpush
@push('scripts')
    <script>
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter=>{
            let initial_count = 0;
            const final_count = counter.dataset.count;

            const counting = setInterval(updateCounting, 1);

            function updateCounting() {
                if (initial_count < 1000 && final_count > 1000) {
                    initial_count += 4;
                    counter.innerText = initial_count;
                }
                else if(initial_count < 1000){
                    initial_count += 1;
                    counter.innerText = initial_count;
                }

                if (initial_count >= 1000) {
                    initial_count += 1000;
                    counter.innerText = initial_count / 1000 + 'K+';
                }

                if (initial_count >= 1_000_000) {
                    initial_count += 50000;
                    counter.innerText = initial_count / 1_000_000 + 'M+';
                }

                if(initial_count >= final_count) {
                clearInterval(counting);
            }
            }
        })
    </script>
@endpush
<x-layout :title="'Dashboard | MyStoreSystem'">
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
                            <span class="card-number">$</span>
                            <span class="card-number counter money" data-count="{{$totalEarning}}">0</span>
                        </div>
                        <span class="card-date">Since last month</span>
                    </div>
                    <div class="card-item">
                        <div class="card-header">
                            <span class="card-tittle">Customers</span>
                            <i class='bx bx-group'></i>
                        </div>
                        <div class="card-content">
                            <span class="card-number counter" data-count="{{$customerCount}}">0</span>
                        </div>
                        <span class="card-date">Since last month</span>
                    </div>
                    <div class="card-item">
                        <div class="card-header">
                            <span class="card-tittle">Items</span>
                            <i class='bx bx-package'></i>
                        </div>
                        <div class="card-content">
                            <span class="card-number counter" data-count="{{$itemCount}}">0</span>
                        </div>
                        <span class="card-date">Since last month</span>
                    </div>
                    <div class="card-item">
                        <div class="card-header">
                            <span class="card-tittle">Orders</span>
                            <i class='bx bxs-shopping-bag'></i>
                        </div>
                        <div class="card-content">
                            <span class="card-number counter" data-count="{{$orderCount}}">0</span>
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
                        <span>Top Selling Items 🏆</span>
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
                                @foreach ($topItems as $item)
                                    <tr>
                                        <td>
                                            <div class="row-image">
                                                <img class="table-image" src="{{$item->image ? asset('storage/' . $item->image) : asset('images/default-gray.png')}}" alt="">
                                                {{$item->name}}
                                            </div>
                                        </td>
                                        <td class="center-cell">{{$item->sold}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-table">
                    <div class="card-table-header">
                        <span>Recent Orders 🛒</span>
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
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{$order->customer->first_name}} {{$order->customer->last_name}}</td>
                                        <td class="center-cell">{{$order->items->count()}}</td>
                                        <td class="center-cell">${{$order->total_amount}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>