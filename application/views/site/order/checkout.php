<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/26/2017
 * Time: 2:14 AM
 */
?>
<!--<script>
    function checkout() {
        alert("Đặt hàng thành công!");
    }
</script>-->
<script>
    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>
<div id="register">
    <h3>Thông tin nhận hàng</h3>
    <div class="container" style="width: 509px">
        <form action="<?php echo site_url('order/checkout')?>" method="post" >
            <b> Tổng đơn hàng: <p style="color: red"><?php echo number_format($total_amount)?>đ</p></b>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="email" type="text" class="form-control" name="email" placeholder="Email" value="<?php echo isset($user->email) ? $user->email : ''?>">
            </div>
            <div name="name_error" class="">
                <?php echo form_error('email')?>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                <input id="name" type="text" class="form-control" name="username" placeholder="Họ tên" value="<?php echo isset($user->name) ? $user->name : ''?>">
            </div>
            <div name="name_error" class="">
                <?php echo form_error('name')?>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                <input id="phone" type="text" class="form-control" name="phone" placeholder="Số điện thoại" value="<?php echo isset($user->phone) ? $user->phone : ''?>">
            </div>
            <div name="name_error" class="">
                <?php echo form_error('phone')?>
            </div>
            <br>
            <!--<div id="locationField">
                <input  placeholder="Enter your address"
                       onFocus="geolocate()" type="text">
            </div>-->
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                <input id="autocomplete" type="text" class="form-control" name="address" placeholder="Địa chỉ" value="<?php echo isset($user->address) ? $user->address : ''?>">
            </div>
            <div name="name_error" class="">
                <?php echo form_error('address')?>
            </div>
            <br>
            <div class="form-group">
                <label for="sel1">Hình thức thanh toán</label>
                <select class="form-control" id="sel1" name="payment">
                    <option value="shipcod">Thanh toán khi nhận hàng</option>
                    <option value="baokim">Bảo Kim</option>
                </select>
            </div>
            <div name="name_error" class="">
                <?php echo form_error('payment')?>
            </div>
            <button class="btn btn-warning">Xác nhận đặt hàng</button><span>&nbsp;</span>
        </form>
        <br>

    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnwQ5j20Ys1NrjWFq_yNSwyStnO2SNZ0k&libraries=places&callback=initAutocomplete"
        async defer></script>

