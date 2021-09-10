<?PHP 
$sitedata   = array_shift($getSiteData); 

$qMinimum           = "select * from product_minimum where status='active'";
$gMinimum           = $this->query->getDatabyQ($qMinimum);
$dMinimum           = array_shift($gMinimum);
$minimumstok        = $dMinimum['minimum_stok'];

$qProd      = "
            select * from (
                select
                    a.*,
                    (select file from product_image where id_product=a.id_product and cover='1' limit 1) cover,
                    (select name from product_category where id_category=a.id_category) namecategory,
                    (select link from product_category where id_category=a.id_category) linkcategory,
                    (select id_link from link where id_link=a.id_link) idbrand,
                    (select title from link where id_link=a.id_link) brand,
                    (select link from link where id_link=a.id_link) linkbrand,
                    (select xb.name from product_category xa left join product_type xb on xa.id_type=xb.id_type where id_category=a.id_category) nametype,
                    (select xc.link from product_category xa left join product_type xb on xa.id_type=xb.id_type left join menu_site xc on xb.id_menu=xc.id_menu where id_category=a.id_category) linkmenu,
                    (select xc.menu from product_category xa left join product_type xb on xa.id_type=xb.id_type left join menu_site xc on xb.id_menu=xc.id_menu where id_category=a.id_category) menuname,
                    (SELECT xb.name as  update_by FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
                    WHERE xa.menu='Manage Product' AND xa.data = a.id_product ORDER BY xa.date_time DESC limit 1)as update_by,
                    (SELECT DATE_FORMAT(xa.date_time, '%d-%b-%y %H:%i:%s') as last_update FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
                    WHERE xa.menu='Manage Product' AND xa.data = a.id_product ORDER BY xa.date_time DESC limit 1)as last_update
                from
                product a
            ) as final
            where link='$link'
            ";
$gProd      = $this->query->getDatabyQ($qProd);
$data       = array_shift($gProd);
$idproduct  = $data['id_product'];
$linkcat    = $data['linkcategory'];
$brand      = $data['idbrand'];

if ($data['diskon']>0) {
    $tagdiskon  = '<span class="product-hot">SALE</span>';

    $calcdisc   = $data['diskon'];
    $diskon     = '<del>IDR '.$this->formula->rupiah2($data['price']).'</del>';
    $price      = $this->formula->rupiah2($data['price']-$calcdisc);
    $valprice   = $data['price']-$calcdisc;
} else {
    $tagdiskon  = '';
    $diskon     = '<del>&nbsp;</del>';
    $price      = $this->formula->rupiah2($data['price']);
    $valprice   = $data['price'];
}

$qImg       = "select * from product_image where id_product='$idproduct' and cover=0";
$gImg       = $this->query->getDatabyQ($qImg);

$qStok      = "select * from product_stok where id_product='$idproduct' and (stok!=0 and stok is not null) order by 1";
$gStok      = $this->query->getDatabyQ($qStok);

$qRelated   = "
            select * from (
                select
                    a.*,
                    (select file from product_image where id_product=a.id_product and cover='1' limit 1) cover,
                    (select name from product_category where id_category=a.id_category) namecategory,
                    (select link from product_category where id_category=a.id_category) linkcategory,
                    (select title from link where id_link=a.id_link) brand,
                    (select link from link where id_link=a.id_link) linkbrand,
                    (select xb.name from product_category xa left join product_type xb on xa.id_type=xb.id_type where id_category=a.id_category) nametype,
                    (select xc.link from product_category xa left join product_type xb on xa.id_type=xb.id_type left join menu_site xc on xb.id_menu=xc.id_menu where id_category=a.id_category) linkmenu,
                    (select xc.menu from product_category xa left join product_type xb on xa.id_type=xb.id_type left join menu_site xc on xb.id_menu=xc.id_menu where id_category=a.id_category) menuname,
                    (SELECT xb.name as  update_by FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
                    WHERE xa.menu='Manage Product' AND xa.data = a.id_product ORDER BY xa.date_time DESC limit 1)as update_by,
                    (SELECT DATE_FORMAT(xa.date_time, '%d-%b-%y %H:%i:%s') as last_update FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
                    WHERE xa.menu='Manage Product' AND xa.data = a.id_product ORDER BY xa.date_time DESC limit 1)as last_update
                from
                product a
            ) as final
            where id_product not in ($idproduct) and linkcategory='$linkcat'
            order by rand()
            limit 9
            ";
$gRelated   = $this->query->getDatabyQ($qRelated);
?>

<?PHP $this->load->view('theme/polo/plugin1'); ?>

        <?PHP $this->load->view('theme/polo/topbar'); ?>

        <?PHP $this->load->view('theme/polo/header'); ?>

        <style>
        #productdetail.product .product-price del { margin: -20px 0 -4px; }
        </style>

        <!-- SHOP PRODUCT PAGE -->
        <section id="product-page" class="product-page p-b-0 p-t-30">
            <div class="container">
                <div class="product" id="productdetail">
                    <form id="formaddtocart" action="<?PHP base_url(); ?>cart/add_cart_item">
                        <div class="row m-b-40">
                            <div class="col-lg-5">
                                <div class="product-image">
                                    <!-- Carousel slider -->
                                    <div class="carousel dots-inside dots-dark arrows-visible arrows-only arrows-dark" data-items="1" data-loop="true" data-autoplay="true" data-animate-in="fadeIn" data-animate-out="fadeOut" data-autoplay-timeout="2500" data-lightbox="gallery">
                                        <!-- <a href="<?PHP echo base_url(); ?>images/product/<?PHP echo $data['cover']; ?>" data-lightbox="image" title="<?PHP echo $data['name']; ?>"> -->
                                        <a href="<?PHP echo base_url(); ?>images/product/<?PHP echo $data['cover']; ?>" title="<?PHP echo $data['name']; ?>">
                                            <img alt="<?PHP echo $data['name']; ?>" src="<?PHP echo base_url(); ?>images/product/thumb_<?PHP echo $data['cover']; ?>">
                                        </a>
                                        <?PHP foreach ($gImg as $dataimg) { ?>
                                        <!-- <a href="<?PHP echo base_url(); ?>images/product/<?PHP echo $dataimg['file']; ?>" data-lightbox="image" title="<?PHP echo $data['name']; ?>"> -->
                                        <a href="<?PHP echo base_url(); ?>images/product/<?PHP echo $dataimg['file']; ?>" title="<?PHP echo $data['name']; ?>">
                                            <img alt="<?PHP echo $data['name']; ?>" src="<?PHP echo base_url(); ?>images/product/thumb_<?PHP echo $dataimg['file']; ?>">
                                        </a>
                                        <?PHP } ?>
                                    </div>
                                    <?PHP echo $tagdiskon; ?>
                                    <!-- Carousel slider -->
                                </div>
                            </div>


                            <div class="col-md-7">
                                <div class="product-description">
                                    <div class="product-category"><?PHP echo $data['menuname']; ?></div>
                                    <div class="product-title">
                                        <h3><a href="#"><?PHP echo $data['name']; ?></a></h3>
                                    </div>
                                    <div class="product-price">
                                        <?PHP echo $diskon; ?>
                                        <ins>IDR <?PHP echo $price; ?></ins>
                                        <input type="hidden" id="pricetotal" name="pricetotal" value="<?PHP echo $valprice; ?>">
                                    </div>
                                    <!-- <div class="product-rate">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product-reviews"><a href="#">3 customer reviews</a>
                                    </div> -->

                                    <div class="seperator m-b-10"></div>
                                    <p><?PHP echo $data['description']; ?></p>
                                    <!-- <div class="product-meta">
                                        <p>Tags: <a href="#" rel="tag">Clothing</a>, <a rel="tag" href="#">T-shirts</a></p>
                                    </div> -->
                                    <div class="seperator m-t-20 m-b-10"></div>

                                </div>
                                <div class="row">
                                    <div class="col-md-9">
                                        <h6><span style="color:#981212; font-size: 18px;">1.</span> Pilih Size * <img src="<?PHP echo base_url(); ?>images/arrowdown.jpeg" style="max-height: 30px; margin-top: 10px;"></h6>
                                        <ul class="product-size">
                                            <!-- <?PHP 
                                            // foreach ($gStok as $datastok) { 
                                            //     if ($datastok['size']=='ALL SIZE') { $width = 'style="width: 90px;"'; } else { $width = ''; }
                                            ?>
                                            <li>
                                                <label>
                                                    <input name="size" required type="radio" value="<?PHP echo $datastok['size']; ?>" name="product-size">
                                                    <span <?PHP echo $width; ?>><?PHP echo $datastok['size']; ?></span>
                                                </label>
                                            </li>
                                            <? //} ?> -->
                                            <?PHP
                                            $qSize  = "SELECT a.*, (select sum(stok) from product_stok where size=a.size and id_product=$idproduct) jml FROM `product_size` a order by sort";
                                            $dSize  = $this->query->getDatabyQ($qSize);
                                            foreach ($dSize as $size) { 
                                                if ($size['size']=='ALL SIZE') { $width = 'style="width: 90px;"'; } else { $width = ''; }
                                                if ($size['jml']<$minimumstok) {
                                                    $color      = 'light';
                                                    $labelsize  = '<del style="color: #d0cccc;">'.$size['size'].'</del>';
                                                    $disabled   = 'disabled';
                                                } else {
                                                    $color      = 'light';
                                                    $labelsize  = $size['size'];
                                                    $disabled   = '';
                                                }
                                                echo '
                                                <li>
                                                    <label>
                                                        <input '.$disabled.' name="size" required type="radio" value="'.$size['size'].'" name="product-size">
                                                        <span '.$width.'>'.$labelsize.'</span>
                                                    </label>
                                                </li>
                                                ';
                                            }
                                            ?>
                                            <li>
                                                <?PHP
                                                $qSC    = "select * from link where id_link='$brand'";
                                                $gSC    = $this->query->getDatabyQ($qSC);
                                                $dataSC = array_shift($gSC);
                                                ?>
                                                <a href="<?PHP echo base_url(); ?>images/other/<?PHP echo $dataSC['file']; ?>" data-lightbox="image" title="Size Chart" class="btn btn-light">
                                                    <i class="icon-help-circle"></i> Size Chart
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- <div class="col-lg-6">
                                        <h6>Select the color</h6>
                                        <label class="sr-only">Color</label>
                                        <select style="padding:10px">
                                            <option value="">Select color…</option>
                                            <option value="">White</option>
                                            <option value="" selected="selected">Green</option>
                                            <option value="">Brown</option>
                                            <option value="">Yellow</option>
                                            <option value="">Pink</option>
                                        </select>
                                    </div> -->
                                    
                                    <div class="col-md-3 text-right">
                                        <h6><span style="color:#981212; font-size: 18px;">2.</span> Pilih quantity *</h6>
                                        <div class="cart-product-quantity">
                                            <div class="quantity m-l-5">
                                                <img src="<?PHP echo base_url(); ?>images/arrowdown2.jpeg" style="max-height: 30px; margin-top: -10px; -webkit-transform: scaleX(-1); transform: scaleX(-1);">
                                                <!-- <input type="button" class="minus" value="-"> -->
                                                <input type="hidden" value="<?PHP echo $idproduct; ?>" name="productid">
                                                <input type="number" class="qty" value="1" name="qty">
                                                <!-- <input type="button" class="plus" value="+"> -->
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div role="alert" class="alert alert-success alert-dismissible" id="suksesinsert" style="display: none;">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span style="display: block!important;">×</span> 
                                            </button>
                                            <strong><i class="fa fa-check-circle"></i> "<?PHP echo $data['name']; ?>"</strong> was successfully added to your cart.
                                        </div>

                                        <div role="alert" class="alert alert-danger alert-dismissible" id="gagalinsert" style="display: none;">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span style="display: block!important;">×</span> 
                                            </button>
                                            <strong><i class="fa fa-times-circle"></i> Failed!</strong> Change a few things up and try submitting again.
                                        </div>

                                        <input type="hidden" name="ajax" value="1">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type='submit' name='addtocart' id="btnaddtocart" class="btn col-sm-12">
                                                    <i class="fa fa-shopping-cart"></i> Tambahkan ke Keranjang
                                                </button>
                                                <h6>
                                                    <img src="<?PHP echo base_url(); ?>images/arrowup.jpeg" style="max-height: 30px; margin-top: -10px;">
                                                    <span style="color:#981212; font-size: 18px;">3.</span> Klik disini untuk menambahkan ke keranjang.
                                                </h6>
                                            </div>
                                            <div class="col-md-6">
                                                <a href='<?PHP echo base_url(); ?>cart/' class="btn btn-light col-sm-12">
                                                    <i class="fa fa-shopping-cart"></i> Lanjut ke Pembayaran
                                                </a>
                                                <h6>
                                                    <img src="<?PHP echo base_url(); ?>images/arrowup.jpeg" style="max-height: 30px; margin-top: -10px;">
                                                    <span style="color:#981212; font-size: 18px;">4.</span> Klik untuk lanjut ke proses selanjutnya.
                                                </h6>
                                            </div>
                                        </div>
                                        <!-- <button class="btn" id="pay-button">Pay!</button> -->
                                    </div>
                                </div>

                          
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- end: SHOP PRODUCT PAGE -->

        <!-- SHOP WIDGET PRODUTCS -->
        <section class="p-t-30 p-b-30">
            <div class="container">
                <div class="heading-text heading-line text-center">
                    <h4>Related Products you may be interested!</h4>
                </div>
                <div class="row">
                    <?PHP 
                    foreach ($gRelated as $datarelated) { 
                    if ($datarelated['diskon']>0) {
                        $calcdiscrel   = $datarelated['diskon'];
                        $diskonrel     = '<del>IDR '.$this->formula->rupiah2($datarelated['price']).'</del>';
                        $pricerel      = $this->formula->rupiah2($datarelated['price']-$calcdiscrel);
                    } else {
                        $diskonrel     = '<del>&nbsp;</del>';
                        $pricerel      = $this->formula->rupiah2($datarelated['price']);
                    }
                    ?>
                    <div class="col-lg-4 p-b-30">
                        <div class="widget-shop">
                            <div class="product">
                                <div class="product-image">
                                    <a href="<?PHP echo base_url(); ?>product/<?PHP echo $datarelated['link']; ?>">
                                        <img src="<?PHP echo base_url(); ?>images/product/thumb_<?PHP echo $datarelated['cover']; ?>" alt="<?PHP echo $datarelated['name']; ?>">
                                    </a>
                                </div>
                                <div class="product-description">
                                    <div class="product-category"><?PHP echo $datarelated['menuname']; ?></div>
                                    <div class="product-title">
                                        <h3><a href="<?PHP echo base_url(); ?>product/<?PHP echo $datarelated['link']; ?>">
                                            <?PHP echo $datarelated['name']; ?>
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="product-price" style="width:100%;"><!-- <del>IDR </del> --><ins>IDR <?PHP echo $pricerel; ?></ins>
                                    </div>
                                    <div class="product-rate">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?PHP } ?>

                </div>
            </div>
        </section>
        <!-- end: SHOP WIDGET PRODUTCS -->

        <style>
            #progresloader {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 999999;
                background: rgba(255,255,255,.9);
            }
        </style>
        <div id="progresloader" style="display: none;">
            <div id="loaderpage" class="row">
                <div class="loader col-lg-12">
                    <div style="margin-top: 25%;"><div class="loader04"></div></div>
                </div>
            </div>
        </div>

        <?PHP $this->load->view('theme/polo/footer'); ?>

        <script>
            $(document).ready(function() { 

                /*place jQuery actions here*/ 
                $('#formaddtocart').submit(function() {
                            
                    var formdata = new FormData(this);
                    // console.log();
                    $.ajax({
                        url: "<?PHP echo base_url(); ?>cart/add_cart_item",
                        type: "POST",
                        data: formdata,
                        beforeSend: function(){ 
                            $("#progresloader").fadeIn('fast');
                        },
                        success: function(data) {
                            if(data) {
                                // alert(data);
                                $("#saveinsert").html('Save');
                                $('#suksesinsert').fadeIn('fast');
                                $('#gagalinsert').hide('fast');
                                $("#progresloader").fadeOut('fast');
                                if(data == 'true'){
                                    $.get("<?PHP echo base_url(); ?>cart/show_cart", function(cart){ // Get the contents of the url cart/show_cart
                                        $("#shopcart-top").html(cart); // Replace the information in the div #cart_content with the retrieved data
                                    });          
                                }else{
                                    alert("Product does not exist");
                                }
                            } else { 
                                $('#suksesinsert').hide('fast');
                                $('#gagalinsert').fadeIn('fast');
                                $("#saveinsert").html('Save');
                                $("#progresloader").fadeOut('fast');
                            }
                        },
                        error: function (error) {
                            $('#suksesinsert').hide('fast');
                            $('#gagalinsert').fadeIn('fast');
                            $("#saveinsert").html('Save');
                            $("#progresloader").fadeOut('fast');
                        },
                        contentType: false,
                        processData: false
                    });
                    return false;
                });
            });
        </script>