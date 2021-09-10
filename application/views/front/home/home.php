<?PHP $logo = array_shift($getSiteData); ?>

<?PHP $this->load->view('theme/polo/plugin1'); ?>

        <?PHP $this->load->view('theme/polo/topbar'); ?>

        <?PHP $this->load->view('theme/polo/header'); ?>

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
                        <!-- <a class="btn" href="#">Purchase Now</a>
                        <a class="btn btn-light">Purchase</a> -->
                        <!-- end: Captions -->
                    </div>
                </div>
            </div>
            <!-- end: Slide 1 -->
            <?PHP } ?>
        </div>
        <!--end: Inspiro Slider -->

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