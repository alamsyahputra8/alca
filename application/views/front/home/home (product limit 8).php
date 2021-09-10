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
        <section id="clientslide" class="p-t-30">
            <div class="container">
                <div class="heading-text heading-section text-center">
                    <h2 class="">TOP BRAND</h2>
                    <!-- <span class=" lead">The awesome clients we've had the pleasure to work with! </span> -->
                </div>
                <div class="carousel" data-items="5" data-items-sm="4" data-items-xs="3" data-items-xxs="2" data-margin="20" data-arrows="false" data-autoplay="true" data-autoplay-timeout="3000" data-loop="true">
                    <?PHP
                    $qLink      = "select * from link order by id_link desc";
                    $getLink    = $this->query->getDatabyQ($qLink);
                    foreach ($getLink as $link) {
                    ?>
                    <div class="product">
                        <a href="<?PHP echo base_url(); ?>shop/brand/<?PHP echo $link['link']; ?>" title="<?PHP echo $link['title']; ?>"><img alt="" src="<?PHP echo base_url(); ?>images/link/<?PHP echo $link['picture']; ?>"> </a>
                        <div class="product-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-reviews"><a href="<?PHP echo base_url(); ?>shop/brand/<?PHP echo $link['link']; ?>" class="btn btn-dark btn-xs">SHOP NOW</a></div>
                    </div>
                    <?PHP } ?>
                </div>
            </div>

        </section>
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
                    <div class="shop">
                        <div class="grid-layout grid-4-columns" data-item="grid-item">
                            <?PHP
                            $qProduct
                                    = "
                                    select * from (
                                        select
                                            a.*,
                                            (select file from product_image where id_product=a.id_product and cover='1' limit 1) cover,
                                            (select file from product_image where id_product=a.id_product and cover!='1' order by id_image asc limit 1) back,
                                            (select name from product_category where id_category=a.id_category) namecategory,
                                            (select title from link where id_link=a.id_link) brand,
                                            (select xb.name from product_category xa left join product_type xb on xa.id_type=xb.id_type where id_category=a.id_category) nametype,
                                            (SELECT xb.name as  update_by FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
                                            WHERE xa.menu='Manage Product' AND xa.data = a.id_product ORDER BY xa.date_time DESC limit 1)as update_by,
                                            (SELECT DATE_FORMAT(xa.date_time, '%d-%b-%y %H:%i:%s') as last_update FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
                                            WHERE xa.menu='Manage Product' AND xa.data = a.id_product ORDER BY xa.date_time DESC limit 1)as last_update
                                        from
                                        product a
                                    ) as final
                                    order by last_update desc
                                    limit 8
                                    ";
                            $getProduct    = $this->query->getDatabyQ($qProduct);
                            foreach ($getProduct as $data) {
                                if ($data['diskon']>0) {
                                    $tagdiskon  = '<span class="product-hot">SALE</span>';

                                    $calcdisc   = ($data['price']*$data['diskon'])/100;
                                    $diskon     = '<del>IDR '.$this->formula->rupiah2($data['price']).'</del>';
                                    $price      = $this->formula->rupiah2($data['price']-$calcdisc);
                                } else {
                                    $tagdiskon  = '';
                                    $diskon     = '<del>&nbsp;</del>';
                                    $price      = $this->formula->rupiah2($data['price']);
                                }
                            ?>
                            <div class="grid-item">
                                <div class="product">
                                    <div class="product-image">
                                        <a href="<?PHP echo base_url(); ?>product/<?PHP echo $data['link']; ?>">
                                            <img alt="<?PHP echo $data['name']; ?>" src="<?PHP echo base_url(); ?>images/product/thumb_<?PHP echo $data['cover']; ?>">
                                        </a>
                                        <a href="<?PHP echo base_url(); ?>product/<?PHP echo $data['link']; ?>">
                                            <img alt="<?PHP echo $data['name']; ?>" src="<?PHP echo base_url(); ?>images/product/thumb_<?PHP echo $data['back']; ?>">
                                        </a>
                                        <?PHP echo $tagdiskon; ?>
                                        <!-- <div class="product-overlay">
                                            <a href="<?PHP echo base_url(); ?>quickview/<?PHP echo $data['link']; ?>" data-lightbox="ajax">Quick View</a>
                                        </div> -->
                                    </div>

                                    <div class="product-description">
                                        <div class="product-title">
                                            <h3>
                                                <a href="<?PHP echo base_url(); ?>product/<?PHP echo $data['link']; ?>">
                                                    <?PHP echo $data['name']; ?>
                                                </a>
                                            </h3>
                                        </div>
                                        <div class="product-category"><?PHP echo $data['nametype']; ?> - <?PHP echo $data['namecategory']; ?></div>
                                        <div class="product-price"><?PHP echo $diskon; ?><ins>IDR. <?PHP echo $price; ?></ins></div>
                                        <!-- <div class="product-rate">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product-reviews"><a href="#">6 customer reviews</a>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <?PHP } ?>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section id="" class="p-t-30">
            <div class="container">
                <div class="heading-text heading-section  text-center">
                    <h2>LOOKBOOK</h2>
                </div>
                <!-- Portfolio -->

                <div>
                    <?PHP
                    $qWork      = "
                    select
                        a.*,
                        (select menu from menu_site where id_menu=a.id_menu) as menu,
                        (SELECT xb.name as  update_by FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
                        WHERE xa.menu in ('Manage Photos','Manage Videos') AND xa.data = a.id_file ORDER BY xa.date_time DESC limit 1)as update_by,
                        (SELECT DATE_FORMAT(xa.date_time, '%d-%b-%y %H:%i:%s') as last_update FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
                        WHERE xa.menu in ('Manage Photos','Manage Videos') AND xa.data = a.id_file ORDER BY xa.date_time DESC limit 1)as last_update
                    from
                    (
                        select * from (
                            select id_video as id_file,id_menu, id_album, video as file, '2' as type from videos 
                            union 
                            select id_photo as id_file,id_menu, id_album, picture as file, '1' as type from photos
                        ) as base
                    ) as a
                    where 1=1
                    order by id_file desc
                    limit 10
                    ";
                    $cekWork        = $this->query->getNumRowsbyQ($qWork)->num_rows();
                    if ($cekWork>0) {
                    ?>
                    <div id="portfolio" class="grid-layout portfolio-3-columns" data-margin="20">
                        <?PHP
                        $x = 0;
                        $gWork      = $this->query->getDatabyQ($qWork);
                        foreach($gWork as $data) { $x++;
                            $id         = $data['id_file'];
                            $file       = $data['file'];
                            $type       = $data['type'];

                            if ($x==1) { $size = 'large-width'; } else { $size = ''; }

                            if ($type=='1') {
                                echo '
                                    <div class="portfolio-item '.$size.' img-zoom ct-foto">
                                        <div class="portfolio-item-wrap">
                                            <a title="DICLOFEST" data-lightbox="image" href="'.base_url().'images/gallery/'.$file.'">
                                            <div class="portfolio-image">
                                                <a title="DICLOFEST" data-lightbox="image" href="'.base_url().'images/gallery/'.$file.'"><img src="'.base_url().'images/gallery/'.$file.'" alt=""></a>
                                            </div>
                                            <!--div class="portfolio-description">
                                                <a title="DICLOFEST" data-lightbox="image" href="'.base_url().'images/gallery/'.$file.'">
                                                    <i class="fa fa-expand"></i>
                                                </a>
                                            </div-->
                                            </a>
                                        </div>
                                    </div>
                                ';
                            } else {
                                $embed      = str_replace('https://www.youtube.com/watch?v=','https://www.youtube.com/embed/',$file);

                                echo '
                                    <div class="portfolio-item '.$size.' img-zoom ct-video">
                                       <div class="portfolio-item-wrap">
                                            <div class="portfolio-image">
                                                <a href="#">
                                                    <iframe width="1280" height="720" src="'.$embed.'?rel=0&amp;showinfo=0" allowfullscreen></iframe>
                                                </a>
                                            </div>
                                            <div class="portfolio-description">
                                                <a title="Video Youtube" data-lightbox="iframe" href="'.$file.'"><i class="fa fa-play"></i></a>
                                                <a href="'.$file.'" target="_blank"><i class="fa fa-link"></i></a>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }
                        }
                        ?>
                    </div>
                    <?PHP
                    } else {
                        echo '
                        <div><h3 class="text-center text-white">We are sorry, No data available.</h3></div>
                        ';
                    }
                    ?>
                </div>
                
                <!-- end: Portfolio -->
                <!--div>
                    <center><button type="button" class="btn btn-rounded btn-dark">ALL WORKS</button></center>
                </div-->
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