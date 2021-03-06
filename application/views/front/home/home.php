<?PHP
$logo       = array_shift($getSiteData);

$getLand    = $this->db->query("SELECT * FROM landingpage where id=1")->result_array();
$dLand      = array_shift($getLand);

$activepage = $this->uri->uri_string();
?>

<?PHP $this->load->view('theme/polo/plugin1'); ?>

        <?PHP $this->load->view('theme/polo/topbar'); ?>

        <?PHP $this->load->view('theme/polo/header'); ?>

        <style>
            .bglandalca {
                height: 100%;
                background: #FFF url('<?PHP echo base_url(); ?>images/<?PHP echo $dLand['back_desktop']; ?>') no-repeat center;
                background-size: auto 100%;
            }
            .btnlandingpage {
                width: 280px;
                opacity: 1;
                cursor: pointer;
            }
            .btnlandingpage img {
                width: 280px;
                margin-bottom: 10px;
            }
            .btnlandingpage:hover {
                opacity: 1;
            }
            .mbland {
                padding: 5rem;
            }
            @media (max-width: 481px) {
                .bglandalca {
                    height: 100%;
                    background: #FFF url('<?PHP echo base_url(); ?>images/<?PHP echo $dLand['back_mobile']; ?>') no-repeat center;
                    background-size: cover;
                }
                .mbland {
                    padding: 5rem 2rem;
                }
            }
        </style>

        <?PHP if (empty($activepage)) { ?>
        <div class="modal fade" id="modalfirst" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="max-width: 100%!important; margin: 0px; position: fixed; width: 100%; top: 0; bottom: 0; height: 100%; background:#FFF;">
                <div class="modal-content bglandalca">
                    <div class="modal-body kt-portlet kt-portlet--tabs mbland" style="margin-bottom: 0px;">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-center"></h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body text-center">
                            <img src="<?PHP echo base_url(); ?>images/alcalogoland.png" style="max-width: 150px;"><br><br><br>

                            <div>
                                <a href="#" class="btnlandingpage" id="spmall">
                                    <img src="<?PHP echo base_url(); ?>images/btnshopee.png">
                                </a>
                            </div>
                            <div>
                                <a href="<?PHP echo base_url(); ?>home" class="btnlandingpage">
                                    <img src="<?PHP echo base_url(); ?>images/btnwebsite.png">
                                </a>
                            </div>
                            <div>
                                <a href="#" class="btnlandingpage" id="btnwa">
                                    <img src="<?PHP echo base_url(); ?>images/btnwa.png">
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div> -->
                </div>
            </div>
        </div>
        <?PHP } ?>

        <!-- Inspiro Slider -->
        <div id="slider" class="inspiro-slider slider-fullscreen arrows-large arrows-creative dots-creative" data-height-xs="360">
            <?PHP
            $qSlides    = "select * from banner order by 1 desc";
            $getSlides  = $this->query->getDatabyQ($qSlides);
            foreach ($getSlides as $dataslides) {
            ?>
            <!-- Slide 1 -->
            <div class="slide kenburns" style="background-image:url('<?PHP echo base_url(); ?>images/slides/<?PHP echo $dataslides['img']; ?>');">
                <div class="container">
                    <div class="slide-captions text-center text-light">
                        <!-- Captions -->
                        <h2 class="text-dark"><?PHP echo $dataslides['title']; ?></h2>
                        <span class="strong"><?PHP echo $dataslides['sub']; ?></span>
                        <!-- <a class="btn-light" href="#">SHOP NOW</a> -->
                        <!-- <a class="btn btn-light">Purchase</a> -->
                        <!-- end: Captions -->
                    </div>
                </div>
            </div>
            <!-- end: Slide 1 -->
            <?PHP } ?>
        </div>
        <!--end: Inspiro Slider -->

        <section id="bannerhome" class="p-t-30">
            <div class="container">
                <div class="">
                     <div id="asdf" class="row">
                        <div class="col-lg-4">
                            <?PHP
                            $qadsL      = "SELECT * FROM ads where position='left' order by 1 desc";
                            $getadsL    = $this->query->getDatabyQ($qadsL);
                            foreach ($getadsL as $adsL) {
                            ?>
                            <a class="" href="<?PHP echo $adsL['link']; ?>" target="_blank">
                                <div class="shop-promo-box text-right" style="min-height: 180px; padding: 0px;">
                                    <img src="<?PHP echo base_url(); ?>images/ads/<?PHP echo $adsL['picture']; ?>" style="width: 100%;">
                                </div>
                            </a>
                            <?PHP } ?>
                        </div>
                        <div class="col-lg-4">
                            <?PHP
                            $qadsC      = "SELECT * FROM ads where position='center' order by 1 desc";
                            $getadsC    = $this->query->getDatabyQ($qadsC);
                            foreach ($getadsC as $adsC) {
                            ?>
                            <a class="" href="<?PHP echo $adsC['link']; ?>" target="_blank">
                                <div class="shop-promo-box text-right" style="padding: 0px; min-height: 390px;">
                                    <img src="<?PHP echo base_url(); ?>images/ads/<?PHP echo $adsC['picture']; ?>" style="width: 100%; min-height: 375px;">
                                </div>
                            </a>
                            <?PHP } ?>
                        </div>
                        <div class="col-lg-4">
                            <?PHP
                            $qadsR      = "SELECT * FROM ads where position='right' order by 1 desc";
                            $getadsR    = $this->query->getDatabyQ($qadsR);
                            foreach ($getadsR as $adsR) {
                            ?>
                            <a class="" href="<?PHP echo $adsR['link']; ?>" target="_blank">
                                <div class="shop-promo-box text-right" style="min-height: 180px; padding: 0px;">
                                    <img src="<?PHP echo base_url(); ?>images/ads/<?PHP echo $adsR['picture']; ?>" style="width: 100%;">
                                </div>
                            </a>
                            <?PHP } ?>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <style>
            #clientslide .product .product-rate {font-size: 12px;}
            #clientslide .product-reviews a {font-size: 9px!important;}
        </style>
        <!-- CLIENTS -->
        <!-- <section id="clientslide" class="p-t-30">
            <div class="container">
                <div class="heading-text heading-section text-center">
                    <h2 class="">TOP BRAND</h2>
                </div>
                <div class="carousel" data-items="5" data-items-sm="4" data-items-xs="3" data-items-xxs="2" data-margin="20" data-arrows="false" data-autoplay="true" data-autoplay-timeout="3000" data-loop="true">
                    <?PHP
                    $qLink      = "select * from link order by sort asc";
                    $getLink    = $this->query->getDatabyQ($qLink);
                    foreach ($getLink as $link) {
                        $ratingbrand    = $link['rating'];
                    ?>
                    <div class="product">
                        <a href="<?PHP echo base_url(); ?>shop/brand/<?PHP echo $link['link']; ?>" title="<?PHP echo $link['title']; ?>"><img alt="" src="<?PHP echo base_url(); ?>images/link/<?PHP echo $link['picture']; ?>"> </a>
                        <div class="product-rate">
                            <?PHP for($i=0; $i<$ratingbrand; $i++) { ?>
                            <i class="fa fa-star"></i>
                            <?PHP } ?>
                        </div>
                        <div class="product-reviews"><a href="<?PHP echo base_url(); ?>shop/brand/<?PHP echo $link['link']; ?>" class="btn btn-dark btn-xs">SHOP NOW</a></div>
                    </div>
                    <?PHP } ?>
                </div>
            </div>

        </section> -->
        <!-- end: CLIENTS -->

        <style>
            #producthome .product .product-price {
                width: 100%;
                margin-bottom: 5px;
                margin-top: 5px;
                text-align: left;
                float: none!important;
            }
        </style>
        <section id="producthome" class="p-t-30">
            <div class="container">
                <div class="heading-text heading-section text-center">
                    <h2 class="">POPULAR PRODUCT</h2>
                    <!-- <span class=" lead">The awesome clients we've had the pleasure to work with! </span> -->
                </div>
                <div class="">
                     <div id="results" class="loader row">
                    </div>
                    <div>
                        <div id="loaderpage" class="row">
                            <div class="loader col-lg-12">
                                <div style="padding: 30px;"><div class="loader04"></div></div>
                            </div>
                        </div>
                        <center id="loadmorebtn"><button type="button" class="btn btn-rounded btn-dark btnloadmore" id="idbuttonloadmore">LOAD MORE</button></center>
                    </div>
                </div>
            </div>

        </section>

        <!-- end: Content -->

        <!-- TEAM -->
        <section class="no-border">
            <div class="container">
                <div class="heading-text heading-section text-center">
                    <h2 class="">Get in touch</h2>
                    <p class="p-t-30">
                        <a href="<?PHP echo base_url(); ?>page/contact">Drop us a call or an E-mail for more informations.</a>
                    </p>
                </div>
            </div>
        </section>
        <!-- end: TEAM -->

        <style>
        .headershowreel {
            background: transparent;
            padding: 10px;
            border: none;
            z-index: 2;
        }
        .bodyshowreel {
            padding: 0px;
        }
        </style>

        <!-- <div class="modal fade show" id="modalshowreel" tabindex="-1" role="modal" aria-labelledby="modal-label-3">
            <div class="modal-dialog modal-lg" style="max-width: 80%;">
                <div class="modal-content">
                    <div class="modal-body bodyshowreel">
                        <div class="row">
                            <?PHP
                            $showreel   = str_replace('https://www.youtube.com/watch?v=','https://www.youtube.com/embed/',$logo['showreel']);
                            ?>
                            <iframe width="1280" height="720" src="<?PHP echo $showreel; ?>?rel=0&amp;showinfo=0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

       <?PHP $this->load->view('theme/polo/footer'); ?>

       <script>
            <?PHP if (empty($activepage)) { ?>
            $(window).on('load', function() {
                $('#modalfirst').modal('show');
            });
            <?PHP } ?>

            $('#spmall').click(function() {
                $("#progresloader").fadeIn('fast');

                //  TRACKING PIXEL
                fbq('track', 'Purchase', {content_ids: '0', content_name: 'Click Shopee Mall', content_type: 'product', currency: 'IDR', value: 0 });

                setTimeout(function() { 
                    $("#progresloader").fadeOut('fast');
                    window.location.href = "<?PHP echo $dLand['link_marketplace']; ?>";
                }, 300);
            });

            $('#btnwa').click(function() {
                $("#progresloader").fadeIn('fast');

                //  TRACKING PIXEL
                fbq('track', 'Purchase', {content_ids: '0', content_name: 'Click Whatsapp', content_type: 'product', currency: 'IDR', value: 0 });

                setTimeout(function() { 
                    $("#progresloader").fadeOut('fast');
                    window.location.href = "https://api.whatsapp.com/send?phone=<?PHP echo $logo['whatsapp_no']; ?>";
                }, 300);
            });

            <?PHP
            $gtotal_data        = $this->query->getDatabyQ("select count(*) total from product");
            $dtotal_data        = array_shift($gtotal_data);
            $gtotal_data        = $dtotal_data['total'];
            $content_per_page   = 8; 
            $total_data         = ceil($gtotal_data/$content_per_page);
            ?>
            $(document).ready(function() {
                var total_record = 0;
                var total_groups = <?PHP echo $total_data; ?>;  
                var type         = 'home';
                var id           = 'ALL';
                var category     = 'ALL';
                var brand        = 'ALL';
                var size         = 'ALL';
                var price        = 'ALL';

                $('#results').load("<?php echo base_url() ?>core/loadmoreProduct", {'type':type,'id':id,'category':category,'brand':brand,'size':size,'price':price,'group_no':total_record}, function(data) {
                    if (data != "") {
                        $('#loaderpage').fadeOut(); total_record++;
                    } else {
                        $('#loaderpage').fadeOut();
                        $('#loadmorebtn').html('');
                        $('#results').html(`
                            <div class="row" style="padding: 20px; width: 100%;">
                                <div class="col-sm-12 text-center">
                                    <div><img src="<?PHP echo base_url(); ?>images/icon/notfound.png"></div><br>
                                    <h5 class="text-center">Mohon maaf, Data product ini belum tersedia.</h5>
                                    <h6 class="text-center"></h6><br>
                                </div>
                            </div>
                        `);
                    }
                });

                $(document).on('click', '#idbuttonloadmore', function(e){
                    $('#idbuttonloadmore').fadeOut();
                    document.getElementById("idbuttonloadmore").disabled = true;

                    var type         = 'home';
                    var id           = 'ALL';
                    var category     = 'ALL';
                    var brand        = 'ALL';
                    var size         = 'ALL';
                    var price        = 'ALL';
                    if(total_record <= total_groups) {
                      loading = true; 
                      $('#loaderpage').fadeIn(); 
                      $.post('<?PHP echo site_url() ?>core/loadmoreProduct',{'type':type,'id':id,'category':category,'brand':brand,'size':size,'price':price,'group_no':total_record},
                        function(data){ 
                            if (data != "") {
                                $("#results").append(data);                 
                                $('#loaderpage').fadeOut();
                                $('#idbuttonloadmore').fadeIn();
                                document.getElementById("idbuttonloadmore").disabled = false;

                                total_record++;
                            } else {
                                $('#loaderpage').fadeOut();
                                $('#loadmorebtn').html('<button type="button" class="btn btn-rounded btn-default">NO MORE DATA</button>');
                            }
                        });     
                    }
                });

                $(window).on("scroll", function() {
                    if ($(window).scrollTop() + $(window).height() >= $('#producthome').offset().top + $('#producthome').height() - 100 ) {
                        $( "#idbuttonloadmore" ).trigger( "click" );
                    } 
                });
            });

            $(document).on('click', '.btndetailworks', function(e){
                e.preventDefault();

                var uid = $(this).data('id'); // get id of clicked row

                $('#dynamic-content').hide(); // hide dive for loader
                $('#modal-loader').show();  // load ajax loader

                $('#datadetailworks').html('<div class="loaderdetailworks"><center>Please Wait...</center></div>');
                
                $.ajax({
                    url: '<?PHP echo base_url(); ?>core/modaldetailworks',
                    type: 'POST',
                    data: 'id='+uid,
                    dataType: 'json'
                })
                .done(function(data){
                    $('#dynamic-content').hide(); // hide dynamic div
                    $('#dynamic-content').show(); // show dynamic div
                    
                    $('#titledetail').html(data.title);

                    $("#datadetailworks").load( "<?PHP echo base_url(); ?>works/"+data.id_album+"", function() {
                        $(".loaderdetailworks").fadeOut('slow');
                    });

                    $('#modal-loader').hide();    // hide ajax loader
                })
                .fail(function(){
                    $('.modal-body').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please refresh page...');
                });
            });
        </script>