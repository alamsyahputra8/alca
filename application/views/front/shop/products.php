<?PHP if(!$this->cart->contents()): ?>
<div class="p-t-30 m-b-30 text-center">
    <div class="heading-text heading-line text-center">
        <h4>Your cart is currently empty.</h4>
    </div>
    <a class="btn icon-left" href="<?PHP echo base_url(); ?>"><span>Return To Shop</span></a>
</div>
<?PHP else: ?>
<div class="shop-cart p-t-30 m-b-30" style="padding-top: 80px!important;">
    <form id="formupdatecart" method="POST" action="<?PHP echo base_url(); ?>cart/update_cart">
        <div class="table table-sm table-striped table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="cart-product-remove"></th>
                        <th class="cart-product-thumbnail">Product</th>
                        <th class="cart-product-name">Description</th>
                        <th class="cart-product-price">Unit Price</th>
                        <th class="cart-product-quantity">Quantity</th>
                        <th class="cart-product-subtotal">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($this->cart->contents() as $items): ?>
                     
                    <?php echo form_hidden('rowid[]', $items['rowid']); ?>
                    <tr>
                        <td class="cart-product-remove">
                        </td>

                        <td class="cart-product-thumbnail">
                            <a href="<?PHP echo base_url(); ?>product/<?PHP echo $items['link']; ?>">
                                <img src="<?PHP echo base_url(); ?>images/product/thumb_<?PHP echo $items['cover']; ?>" alt="<?PHP echo $items['name']; ?>">
                            </a>
                            <div class="cart-product-thumbnail-name"><a href="<?PHP echo base_url(); ?>product/<?PHP echo $items['link']; ?>">
                                <?php echo $items['name']; ?></a></div>
                        </td>

                        <td class="cart-product-description">

                            <p><span><?PHP echo $items['brand']; ?></span>
                                <span>Size: <?PHP echo $items['size']; ?></span>
                                <span>Category: <?PHP echo $items['category']; ?></span>
                            </p>
                        </td>

                        <td class="cart-product-price">
                            <input type="hidden" name="productid[]" value="<?PHP echo $items['productid']; ?>">
                            <span class="amount">IDR <?php echo $this->formula->rupiah2($items['price']); ?></span>
                        </td>

                        <td class="cart-product-quantity">
                            <div class="quantity">
                                <?php echo form_input(array('name' => 'qty[]', 'value' => $items['qty'], 'maxlength' => '3', 'class' => 'qty')); ?>
                            </div>
                        </td>

                        <td class="cart-product-subtotal">
                            <span class="amount">IDR <?php echo $this->formula->rupiah2($items['subtotal']); ?></span>
                        </td>
                    </tr>
                    <?PHP endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-lg-12 text-right">
                <button type="submit" name="updatecart" id="updatecart" class="btn">Update Cart</button>
                <button type="button" name="emptycart" id="emptycart" class="btn empty btn-light">Empty Cart</button>
                <p><small>If the quantity is set to zero, the item will be removed from the cart.</small></p>
            </div>
        </div>
    </form>

    <form id="gotopayment">
        <div class="row">
            <hr class="space">
            <div class="col-md-6">
                <h4>Data & Alamat Kirim</h4>
                
                <div class="col-lg-12 m-b-20">
                    <input type="text" class="form-control" name="orderid" id="orderid" readonly required>
                </div>
                <div class="col-lg-12 m-b-20">
                    <input type="text" class="form-control" name="telp" id="telp" placeholder="No. Telepon" required>
                </div>
                <div class="col-lg-12 m-b-20">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="col-lg-12 m-b-20">
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required>
                </div>
                <div class="col-lg-12 m-b-20">
                    <select class="form-control select2norm" name="province" id="province" style="width:100%;" required>
                        <option value="">Choose</option>
                    </select>
                    <script>
                        $('#province').on ('change', function() {
                            var province  = $('#province').val();
                            $('#city').html('');

                            $.ajax({
                                url: '<?PHP echo base_url(); ?>core/getCity',
                                type: 'POST',
                                data: 'province='+province,
                                dataType: 'json'
                            })
                            .done(function(datax){
                                //.html(data);
                                $('#city').select2({ data: datax });
                                $('#city').trigger('change');
                            })
                            .fail(function(){
                                $('#city').html('');
                            });
                        });
                    </script>
                </div>
                <div class="col-lg-6 form-group">
                    <select class="form-control select2norm" name="city" id="city" style="width:100%;" required>
                        <option value="">Choose</option>
                    </select>
                    <script>
                        $('#city').on ('change', function() {
                            var city        = $('#city').val();
                            var weight      = $('#weight').val();
                            var courier     = $('#courier').val();
                            $('#cost').html('');

                            $.ajax({
                                url: '<?PHP echo base_url(); ?>core/getCost',
                                type: 'POST',
                                data: 'city='+city+'&weight='+weight+'&courier='+courier,
                                dataType: 'json'
                            })
                            .done(function(datax){
                                //.html(data);
                                $('#cost').select2({ data: datax });
                                $('#cost').trigger('change');
                            })
                            .fail(function(){
                                $('#cost').html('');
                            });
                        });
                    </script>
                </div>

                <div class="col-lg-12 form-group">
                    <select class="form-control select2norm" name="courier" id="courier" style="width:100%;" required>
                        <option value="jne">JNE</option>
                        <option value="tiki">TIKI</option>
                        <option value="pos">POS</option>
                    </select>
                    <script>
                        $('#courier').on ('change', function() {
                            var city        = $('#city').val();
                            var weight      = $('#weight').val();
                            var courier     = $('#courier').val();
                            $('#cost').html('');

                            $.ajax({
                                url: '<?PHP echo base_url(); ?>core/getCost',
                                type: 'POST',
                                data: 'city='+city+'&weight='+weight+'&courier='+courier,
                                dataType: 'json'
                            })
                            .done(function(datax){
                                //.html(data);
                                $('#cost').select2({ data: datax });
                                $('#cost').trigger('change');
                            })
                            .fail(function(){
                                $('#cost').html('');
                            });
                        });
                    </script>
                </div>

                <div class="col-lg-6  form-group">
                    <select class="form-control select2norm" name="cost" id="cost" style="width:100%;" required>
                        <option value="">Choose</option>
                    </select>
                    <script>
                        function convertToRupiah(angka)
                        {
                            var rupiah = '';        
                            var angkarev = angka.toString().split('').reverse().join('');
                            for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
                            return 'IDR. '+rupiah.split('',rupiah.length-1).reverse().join('');
                        }

                        $('#cost').on ('change', function() {
                            var cost    = $('#cost').val();

                            $('#amount_cost').val(cost);
                            $('#amount_cost_text').html(convertToRupiah(cost));

                            var gT      = $('#subtotalhidden').val();
                            var Total   = parseInt(gT) + parseInt(cost);
                            $('#grandtotal').val(Total);
                            $('#grandtotal_text').html(convertToRupiah(Total));
                        });
                    </script>
                </div>
                <div class="col-lg-12 m-b-20">
                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" required>
                </div>
                <div class="col-lg-12 m-b-20">
                    <textarea class="form-control" name="note" id="note" placeholder="Catatan"></textarea>
                </div>
            </div>
            <div class="col-md-6 p-r-10 ">
                <div class="table-responsive">
                    <h4>Cart Subtotal</h4>

                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="cart-product-name">
                                    <strong>Cart Subtotal</strong>
                                </td>

                                <td class="cart-product-name text-right">
                                    <input type="hidden" name="subtotalhidden" id="subtotalhidden" value="<?PHP echo $this->cart->total(); ?>">
                                    <span class="amount">IDR <?php echo $this->formula->rupiah2($this->cart->total()); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart-product-name">
                                    <strong>Shipping</strong>
                                </td>

                                <td class="cart-product-name  text-right">
                                    <input type="hidden" id="amount_cost" name="amount_cost">
                                    <span id="amount_cost_text" class="amount">IDR 0</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart-product-name">
                                    <strong>Total</strong>
                                </td>

                                <td class="cart-product-name text-right">
                                    <input type="hidden" name="grandtotal" id="grandtotal" value="<?PHP echo $this->cart->total(); ?>">
                                    <span class="amount color lead"><strong id="grandtotal_text">IDR <?PHP echo $this->formula->rupiah2($this->cart->total()); ?></strong></span>
                                </td>
                            </tr>
                        </tbody>

                    </table>

                </div>

                <button name="saveinsert" type="submit" id="saveinsert" class="btn icon-left float-right"><span>Pilih Pembayaran</span></button>
            </div>
        </div>
    </form>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2norm').select2({
            placeholder: "Choose..."
        });

        $('#emptycart').click(function() {
            $.get("<?PHP echo base_url(); ?>cart/empty_cart", function(){
                $.get("<?PHP echo base_url(); ?>cart/show_cart", function(cart){
                    window.location.href = '<?PHP echo base_url(); ?>cart/';
                });
            });
        });
    });
    $(window).bind("load", function() {
        
        $.ajax({
            url: '<?PHP echo base_url(); ?>core/getProvince',
            type: 'GET',
            // data: 'divisi='+divisi,
            dataType: 'json'
        })
        .done(function(datax){
            //.html(data);
            $('#orderid').val('ZNS-'+Math.round((new Date()).getTime() / 1000) );
            $('#province').select2({ data: datax });
        })
        .fail(function(){
            $('#province').html('');
        });
    });
</script>
<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-8PzUxGr4kjTfICav"></script>
<!-- <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-3t5sGuEXnkMjC5wQ"></script> -->
<script type="text/javascript">
    $(document).ready(function() { 
        /*place jQuery actions here*/ 
        $('#gotopayment').submit(function() {
                    
            var formdata = new FormData(this);
            // console.log();
            var nama    = $('#nama').val();
            var email   = $('#email').val();
            var phone   = $('#telp').val();
            var address = $('#alamat').val();

            $.ajax({
                url: "<?PHP echo base_url(); ?>cart/gotopayment",
                type: "POST",
                data: formdata,
                beforeSend: function(){ 
                    $("#progresloader").fadeIn('fast');
                    $("#saveinsert").html('Processing..');
                },
                success: function(data) {
                    if(data) {
                        $("#progresloader").fadeOut('fast');
                        $("#saveinsert").html('Pilih Pembayaran');
                        // This is minimal request body as example.
                        // Please refer to docs for all available options: https://snap-docs.midtrans.com/#json-parameter-request-body
                        // TODO: you should change this gross_amount and order_id to your desire. 
                        var amounttotal = $('#grandtotal').val();
                        var orderid     = $('#orderid').val();
                        var shippingcost= $('#amount_cost').val();
                        var province    = getSelectedText('province');
                        var city        = getSelectedText('city');
                        var courier     = getSelectedText('courier');
                        var paket       = getSelectedText('cost');

                        var requestBody = 
                        {
                          transaction_details: {
                            gross_amount: amounttotal,
                            // as example we use timestamp as order ID
                            // order_id: 'DCL-'+Math.round((new Date()).getTime() / 1000) 
                            order_id: orderid
                          },
                          "item_details": [
                            <?php foreach($this->cart->contents() as $items): ?>
                            {
                                "id": "<?PHP echo $items['id']; ?>",
                                "price": "<?PHP echo $items['price']; ?>",
                                "quantity": "<?PHP echo $items['qty']; ?>",
                                "name": "<?PHP echo $items['name']; ?> (<?PHP echo $items['size']; ?>)",
                                "brand": "<?PHP echo $items['brand']; ?>",
                                "category": "<?PHP echo $items['category']; ?>",
                                "merchant_name": "Diclofest"
                            },
                            <?PHP endforeach; ?>
                            {
                                "id": "SHIPPING",
                                "price": ""+shippingcost+"",
                                "quantity": 1,
                                "name": ""+courier+" - "+paket+"",
                                "brand": ""+courier+"",
                                "category": "Shipping",
                                "merchant_name": "Diclofest"
                            },
                          ],
                           "customer_details": {
                            "first_name": ""+nama+"",
                            "last_name": "",
                            "email": ""+email+"",
                            "phone": ""+phone+"",
                            "billing_address": {
                              "first_name": ""+nama+"",
                              "last_name": "",
                              "email": ""+email+"",
                              "phone": ""+phone+"",
                              "address": ""+address+"",
                              "city": ""+province+" - "+city+"",
                              "postal_code": "",
                              "country_code": "IDN"
                            },
                            "shipping_address": {
                              "first_name": ""+nama+"",
                              "last_name": "",
                              "email": ""+email+"",
                              "phone": ""+phone+"",
                              "address": ""+address+"",
                              "city": ""+province+" - "+city+"",
                              "postal_code": "",
                              "country_code": "IDN"
                            }
                          },
                        }
                        
                        getSnapToken(requestBody, function(response){
                          var response = JSON.parse(response);
                          console.log("new token response", response);
                          // Open SNAP payment popup, please refer to docs for all available options: https://snap-docs.midtrans.com/#snap-js
                          snap.pay(response.token);
                        })
                    } else { 
                        $('#suksesinsert').hide('fast');
                        $('#gagalinsert').fadeIn('fast');
                        $("#saveinsert").html('Pilih Pembayaran');
                        $("#progresloader").fadeOut('fast');
                    }
                },
                error: function (error) {
                    $('#suksesinsert').hide('fast');
                    $('#gagalinsert').fadeIn('fast');
                    $("#saveinsert").html('Pilih Pembayaran');
                    $("#progresloader").fadeOut('fast');
                },
                contentType: false,
                processData: false
            });
            return false;
        });
        /**
        * Send AJAX POST request to checkout.php, then call callback with the API response
        * @param {object} requestBody: request body to be sent to SNAP API
        * @param {function} callback: callback function to pass the response
        */
        function getSnapToken(requestBody, callback) {
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function() {
              if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                callback(xmlHttp.responseText);
              }
            }
            xmlHttp.open("post", "<?PHP echo base_url(); ?>checkout");
            xmlHttp.send(JSON.stringify(requestBody));
        }
        function getSelectedText(elementId) {
            var elt = document.getElementById(elementId);

            if (elt.selectedIndex == -1)
                return null;

            return elt.options[elt.selectedIndex].text;
        }
    });
</script>
<?php 
echo form_close(); 
endif;
?>