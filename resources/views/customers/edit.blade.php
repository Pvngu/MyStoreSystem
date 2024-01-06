<x-layout>
    <div class="content">
        <div class="content-header">
            <div class="header-text">
                <a href="/customers">Customers</a>
                <div class="animated-header">> Edit Customer</div>
            </div>
        </div>
        <form action="/customers/{{$customer->id}}" method="post">
            @csrf
            @method('PUT')
            <div class="item-info">
                <div class="item-fields">
                    <div class="content-items">
                        <label>First Name</label>
                        <input type="text" name="first_name" value="{{$customer->first_name}}">
                    </div>
                    <div class="content-items">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="{{$customer->last_name}}">
                    </div>
                    <div class="content-items">
                        <label>Email</label>
                        <input type="email" name="email" value="{{$customer->email}}">
                    </div>
                    <div class="content-items">
                        <label>Phone</label>
                        <input type="text" name="phone" value="{{$customer->phone}}">
                    </div>
                </div>
                <div>
                    <div class="content-items">
                        <label>Address</label>
                        <input type="text" name="address">
                    </div>
                    <div class="content-items">
                        <label>City</label>
                        <input type="text" name="city">
                    </div>
                    <div class="content-items">
                        <label>Country</label>
                        <select name="country">
                            <option value="mexico">Mexico</option>
                            <option value="united states">United States</option>
                            <option value="canada">Canada</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-buttons">
                <a href="/customers" style="text-decoration: none;">
                    <input class="newButton cancelButton" type="button" value="Cancel">
                </a>
                <input class="newButton" type="submit" value="Save">
            </div>
        </form>
    </div>
</x-layout>