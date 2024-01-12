@push('scripts')
    <script>
        $(document).ready(function () {
            $('#country').on('change', function () {
                var countryId = this.value;
                $('#state').html('');
                $.ajax({
                    url: '{{ route('states') }}?country_id='+countryId,
                    type: 'get',
                    success: function (res) {
                        $('#state').html('<option value="" disabled selected>Select State</option>');
                        $.each(res, function (key, value) {
                            $('#state').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $('#city').html('<option value="">Select City</option>');
                    }
                });
            });
            $('#state').on('change', function () {
                var stateId = this.value;
                $('#city').html('');
                $.ajax({
                    url: '{{ route('cities') }}?state_id='+stateId,
                    type: 'get',
                    success: function (res) {
                        $('#city').html('<option value="" disabled selected>Select City</option>');
                        $.each(res, function (key, value) {
                            $('#city').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endpush
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
                        @error('address')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Address 2</label>
                        <input type="text" name="address2">
                    </div>
                    <div class="content-items">
                        <label>Country</label>
                        <select id="country">
                            <option value="" disabled selected>Select country</option>
                            @foreach ($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                        @error('country')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>State</label>
                        <select id="state">
                            <option value="" disabled selected>Select State</option>
                        </select>
                    </div>
                    <div class="content-items">
                        <label>City</label>
                        <select name="city_id" id="city">
                            <option value="" disabled selected>Select city</option>
                        </select>
                        @error('city_id')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Zip Code</label>
                        <input type="text" pattern="[0-9]{5}" name="postal_code">
                        @error('postal_code')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
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