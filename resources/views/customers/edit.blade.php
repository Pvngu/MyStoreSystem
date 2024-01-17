@push('scripts')
<script>
    $(document).ready(function () {
            var countryId = {{$customer-> address ? $customer->address->city->state->country->id : 0}};
            var laravelStateId = {{$customer-> address ? $customer->address->city->state->id : 0}};
            var laravelCityId = {{$customer-> address ? $customer->address->city->id : 0}};
            if(countryId ?? 0) {
                console.log('xxddxd');
                $.ajax({
                url: '{{ route('states') }}?country_id='+countryId,
                type: 'get',
                success: function (res) {
                    $('#state').html('<option value="" disabled>Select State</option>');
                    $.each(res, function (key, value) {
                        $('#state').append('<option value="' + value.id + '" ' + (value.id == laravelStateId ? 'selected' : '') + ' >' + value.name + '</option>');
                    });
                    $('#city').html('<option value="">Select City</option>');
                }
            });

            var stateId = {{$customer-> address ? $customer->address->city->state->id : 0}};
            $('#city').html('');
            $.ajax({
                url: '{{ route('cities') }}?state_id='+stateId,
                type: 'get',
                success: function (res) {
                    $('#city').html('<option value="" disabled selected>Select City</option>');
                    $.each(res, function (key, value) {
                        $('#city').append('<option value="' + value.id + '" ' + (value.id == laravelCityId ? 'selected' : '') + ' >' + value.name + '</option>');
                    });
                }
            });
            }
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
                        console.log(value);
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
<x-layout :title="'Edit Customers | MyStoreSystem'">
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
                        @error('first_name')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="{{$customer->last_name}}">
                        @error('last_name')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Email</label>
                        <input type="email" name="email" value="{{$customer->email}}">
                        @error('email')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Phone</label>
                        <input type="text" name="phone" value="{{$customer->phone}}">
                        @error('phone')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Status</label>
                        <select name="active">
                            <option value="1" {{$customer->active == 1 ? 'selected' : ''}}>Active</option>
                            <option value="0" {{$customer->active == 0 ? 'selected' : ''}}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div class="content-items">
                        <label>Address 1</label>
                        <input type="text" name="address" value="{{$customer->address ? $customer->address->address : ''}}">
                        @error('address')
                            <p class="errorMessage">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="content-items">
                        <label>Address 2</label>
                        <input type="text" name="address2" value="{{$customer->address ? $customer->address->address2 : ''}}">
                    </div>
                    <div class="content-items">
                        <label>Country</label>
                        <select id="country">
                            <option value="" disabled selected>Select country</option>
                            @foreach ($countries as $country)
                                <option value="{{$country->id}}" 
                                    @if ($customer->address)
                                        {{$customer->address->city->state->country->id == $country->id ? 'selected' : ''}}
                                    @endif
                                    >{{$country->name}}</option>
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
                        <input type="text" pattern="[0-9]{5}" name="postal_code" value="{{$customer->address ? $customer->address->postal_code : ''}}">
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
                <input class="newButton" type="submit" value="Save">
            </div>
        </form>
    </div>
</x-layout>