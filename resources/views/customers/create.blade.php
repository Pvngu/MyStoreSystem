<x-layout>
    <div class="content">
        <div class="content-header">
            <div class="header-text">
                <a href="customers.html">Customers</a>
                <div class="animated-header">> New Customer</div>
            </div>
        </div>
        <form action="">
            <div class="item-info">
                <div class="item-fields">
                    <div class="content-items">
                        <label>First Name</label>
                        <input type="text" name="first_name">
                    </div>
                    <div class="content-items">
                        <label>Last Name</label>
                        <input type="text" name="last_name">
                    </div>
                    <div class="content-items">
                        <label>Email</label>
                        <input type="email" name="email">
                    </div>
                    <div class="content-items">
                        <label>Phone</label>
                        <input type="text" name="phone">
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
                    <div class="content-items">
                        <label>Zip Code</label>
                        <input type="text" pattern="[0-9]{5}" name="postal_code">
                    </div>
                </div>
            </div>
            <div class="form-buttons">
                <input class="newButton cancelButton" type="button" value="Cancel">
                <input class="newButton" type="button" value="Save">
            </div>
        </form>
    </div>
</x-layout>