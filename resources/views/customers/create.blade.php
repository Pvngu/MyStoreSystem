<x-layout>
    <div class="content">
        <div class="content-header">
            <div class="header-text">
                <a href="/customers">Customers</a>
                <div class="animated-header">> New Customer</div>
            </div>
        </div>
        <form action="/customers" method="post">
            @csrf
            <div class="item-info">
                <div class="item-fields">
                    <div class="content-items">
                        <label>First Name</label>
                        <input type="text" name="first_name" value="{{old('first_name')}}">
                        @error('first_name')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="{{old('last_name')}}">
                        @error('last_name')
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
                        <label>Phone</label>
                        <input type="text" name="phone" value="{{old('phone')}}">
                        @error('phone')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <div class="content-items">
                        <label>Address 1</label>
                        <input type="text" name="address">
                    </div>
                    <div class="content-items">
                        <label>Address 2</label>
                        <input type="text" name="address2">
                    </div>
                    <div class="content-items">
                        <label>City</label>
                        <select name="city">
                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="content-items">
                        <label>Country</label>
                        <select name="country">
                            @foreach ($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="content-items">
                        <label>Zip Code</label>
                        <input type="text" pattern="[0-9]{5}" name="postal_code">
                    </div>
                </div>
            </div>
            <div class="form-buttons">
                <a href="/customers" style="text-decoration: none;">
                    <input class="newButton cancelButton" type="button" value="Cancel">
                </a>
                <input class="newButton" type="submit" value="Create">
            </div>
        </form>
    </div>
</x-layout>