<?PHP 
if ($type=='product') {
    $qTitle     = 
                "select a.*, b.name as nametype, 
                (select menu from menu_site where id_menu=b.id_menu) menu 
                from product_category a left join product_type b on a.id_type=b.id_type 
                where link='$id'";
    $gTitle     = $this->query->getDatabyQ($qTitle);
    $dtitle     = array_shift($gTitle);
    $title      = $dtitle['name'];
    $sub        = $dtitle['menu'].' - '.$dtitle['nametype'];
} else if ($type=='brand') {
    $qTitle     = 
                "
                select * from link
                where link='$id'";
    $gTitle     = $this->query->getDatabyQ($qTitle);
    $dtitle     = array_shift($gTitle);
    $title      = $dtitle['title'];
    $sub        = '';
} else if ($type=='promo') {
    $qTitle     = 
                "
                select * from menu_site
                where link='$id'";
    $gTitle     = $this->query->getDatabyQ($qTitle);
    $dtitle     = array_shift($gTitle);
    $title      = $dtitle['menu'];
    $sub        = '';
} else {
    $qTitle     = 
                "
                select * from menu_site
                where link='$id'";
    $gTitle     = $this->query->getDatabyQ($qTitle);
    $dtitle     = array_shift($gTitle);
    $title      = $dtitle['menu'];
    $sub        = $dtitle['description'];
}

$qBrand             = "
                    select * 
                    from link 
                    order by title asc
                    ";
$getDataBrand       = $this->query->getDatabyQ($qBrand);

$qT                 = "
                    select a.*, (select menu from menu_site where id_menu=a.id_menu) menu
                    from product_type a
                    order by id_menu, sort asc
                    ";
$getDataType        = $this->query->getDatabyQ($qT);

$sitedata           = array_shift($getSiteData); 
$gtotal_data        = $this->query->getDatabyQ("select count(*) total from product");
$dtotal_data        = array_shift($gtotal_data);
$gtotal_data        = $dtotal_data['total'];
$content_per_page   = 20; 
$total_data         = ceil($gtotal_data/$content_per_page);

if ($type=='promo') { $classcol = "col-lg-3"; } else { $classcol = "col-lg-4"; }
?>
<?PHP $this->load->view('theme/polo/plugin1'); ?>

        <?PHP $this->load->view('theme/polo/topbar'); ?>

        <?PHP $this->load->view('theme/polo/header'); ?>

        <style>
            #results .product .product-rate {font-size: 12px;}
            #results .product-reviews a {font-size: 9px!important;}
        </style>

        <section id="page-title">
            <div class="container">
                <div class="page-title">
                    <h1><?PHP echo $title; ?></h1>
                    <span><?PHP echo $sub; ?></span>
                </div>
                <div class="breadcrumb">
                </div>
            </div>
        </section>

        <section id="page-content" class="no-border">

            <div class="container">
                <form id="filterproduct">
                    <div class="row m-b-20">
                        <?PHP if ($type!='product' and $type!='list' and $type=='promo') { ?>
                            <div class="<?PHP echo $classcol; ?>">
                                <div class="order-select">
                                    <h6>Filter by Category</h6>
                                    <select class="form-control select2norm" name="filcategory" id="filcategory">
                                        <option value="ALL">ALL</option>
                                        <?PHP foreach ($getDataType as $dataT) { $idtype = $dataT['id_type']; ?>
                                            <optgroup label="<?PHP echo $dataT['menu']; ?> - <?PHP echo $dataT['name']; ?>">
                                                <?PHP
                                                $q                  = "
                                                                    select *
                                                                    from product_category
                                                                    where id_type='$idtype' order by 1 asc
                                                                    ";
                                                $getDataCategory    = $this->query->getDatabyQ($q);
                                                foreach ($getDataCategory as $data) { 
                                                ?>
                                                <option value="<?PHP echo $data['link']; ?>"><?PHP echo $data['name']; ?></option>
                                                <?PHP } ?>
                                            </optgroup>
                                        <?PHP } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="<?PHP echo $classcol; ?>">
                                <div class="order-select">
                                    <h6>Filter by Brands</h6>
                                    <input type="hidden" name="filcategory" id="filcategory" value="ALL">
                                    <select class="form-control select2norm" name="filbrand" id="filbrand">
                                        <option value="ALL">ALL</option>
                                        <?PHP foreach ($getDataBrand as $data) { ?>
                                            <option value="<?PHP echo $data['id_link']; ?>"><?PHP echo $data['title']; ?></option>
                                        <?PHP } ?>
                                    </select>
                                </div>
                            </div> -->
                        <?PHP } else if ($type=='brand') { ?>
                            <div class="<?PHP echo $classcol; ?>">
                                <div class="order-select">
                                    <h6>Filter by Category</h6>
                                    <select class="form-control select2norm" name="filcategory" id="filcategory">
                                        <option value="ALL">ALL</option>
                                        <?PHP foreach ($getDataType as $dataT) { $idtype = $dataT['id_type']; ?>
                                            <optgroup label="<?PHP echo $dataT['menu']; ?> - <?PHP echo $dataT['name']; ?>">
                                                <?PHP
                                                $q                  = "
                                                                    select *
                                                                    from product_category
                                                                    where id_type='$idtype' order by 1 asc
                                                                    ";
                                                $getDataCategory    = $this->query->getDatabyQ($q);
                                                foreach ($getDataCategory as $data) { 
                                                ?>
                                                <option value="<?PHP echo $data['link']; ?>"><?PHP echo $data['name']; ?></option>
                                                <?PHP } ?>
                                            </optgroup>
                                        <?PHP } ?>
                                    </select>
                                    <input type="hidden" name="filbrand" id="filbrand" value="ALL">
                                </div>
                            </div>
                        <?PHP } else { ?>
                            <div class="<?PHP echo $classcol; ?>">
                                <div class="order-select">
                                    <h6>Filter by Category</h6>
                                    <select class="form-control select2norm" name="filcategory" id="filcategory">
                                        <option value="ALL">ALL</option>
                                        <?PHP foreach ($getDataType as $dataT) { $idtype = $dataT['id_type']; ?>
                                            <optgroup label="<?PHP echo $dataT['menu']; ?> - <?PHP echo $dataT['name']; ?>">
                                                <?PHP
                                                $q                  = "
                                                                    select *
                                                                    from product_category
                                                                    where id_type='$idtype' order by 1 asc
                                                                    ";
                                                $getDataCategory    = $this->query->getDatabyQ($q);
                                                foreach ($getDataCategory as $data) { 
                                                ?>
                                                <option value="<?PHP echo $data['link']; ?>"><?PHP echo $data['name']; ?></option>
                                                <?PHP } ?>
                                            </optgroup>
                                        <?PHP } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="<?PHP echo $classcol; ?>">
                                <div class="order-select">
                                    <h6>Filter by Brands</h6>
                                    <input type="hidden" name="filcategory" id="filcategory" value="ALL">
                                    <select class="form-control select2norm" name="filbrand" id="filbrand">
                                        <option value="ALL">ALL</option>
                                        <?PHP foreach ($getDataBrand as $data) { ?>
                                            <option value="<?PHP echo $data['id_link']; ?>"><?PHP echo $data['title']; ?></option>
                                        <?PHP } ?>
                                    </select>
                                </div>
                            </div> -->
                        <?PHP } ?>
                        <div class="<?PHP echo $classcol; ?>">
                            <div class="order-select">
                                <h6>Filter by Size</h6>
                                <select class="form-control select2norm" name="filsize" id="filsize">
                                    <option value="ALL">ALL</option>
                                    <option value="ALL SIZE">ALL SIZE</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </div>
                        </div>
                        <div class="<?PHP echo $classcol; ?>">
                            <div class="order-select">
                                <h6>Sort by Price</h6>
                                <select class="form-control select2norm" name="filprice" id="filprice">
                                    <option value="ALL">Default sorting</option>
                                    <option value="LTH">Low to High</option>
                                    <option value="HTL">High to Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>

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
        </section>

        <?PHP $this->load->view('theme/polo/footer'); ?>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

        <script type="text/javascript">
        $(document).ready(function() {
            $('.select2norm').select2({
                placeholder: "Default Sorting"
            });

            var total_record = 0;
            var total_groups = <?PHP echo $total_data; ?>;  
            var type         = '<?PHP echo $type; ?>';
            var id           = '<?PHP echo $id; ?>';
            var category     = $('#filcategory').val();
            var brand        = $('#filbrand').val();
            var size         = $('#filsize').val();
            var price        = $('#filprice').val();

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

            $('#filcategory').change(function() {
                var total_record = 0;
                var total_groups = <?PHP echo $total_data; ?>;  
                var category     = $('#filcategory').val();
                var brand        = $('#filbrand').val();
                var size         = $('#filsize').val();
                var price        = $('#filprice').val();

                $('#results').html(`</div>
                <div id="loaderpage" class="col-lg-12">
                    <div class="loader col-lg-12">
                        <div style="padding: 30px;"><div class="loader04"></div></div>
                    </div>
                </div>`);

                 $.post('<?PHP echo site_url() ?>core/loadmoreProduct',{'type':type,'id':id,'category':category,'brand':brand,'size':size,'price':price,'group_no':total_record},
                function(data){ 
                    if (data != "") {
                        $("#results").html(data);
                        $('#loadmorebtn').html('<button type="button" class="btn btn-rounded btn-dark btnloadmore">LOAD MORE</button>');
                        total_record++;
                    } else {
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
            });

            $('#filbrand').change(function() {
                var total_record = 0;
                var total_groups = <?PHP echo $total_data; ?>;  
                var category     = $('#filcategory').val();
                var brand        = $('#filbrand').val();
                var size         = $('#filsize').val();
                var price        = $('#filprice').val();

                $('#results').html(`</div>
                <div id="loaderpage" class="col-lg-12">
                    <div class="loader col-lg-12">
                        <div style="padding: 30px;"><div class="loader04"></div></div>
                    </div>
                </div>`);

                 $.post('<?PHP echo site_url() ?>core/loadmoreProduct',{'type':type,'id':id,'category':category,'brand':brand,'size':size,'price':price,'group_no':total_record},
                function(data){ 
                    if (data != "") {
                        $("#results").html(data);
                        $('#loadmorebtn').html('<button type="button" class="btn btn-rounded btn-dark btnloadmore">LOAD MORE</button>');
                        total_record++;
                    } else {
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
            });

            $('#filsize').change(function() {
                var total_record = 0;
                var total_groups = <?PHP echo $total_data; ?>;  
                var category     = $('#filcategory').val();
                var brand        = $('#filbrand').val();
                var size         = $('#filsize').val();
                var price        = $('#filprice').val();

                $('#results').html(`</div>
                <div id="loaderpage" class="col-lg-12">
                    <div class="loader col-lg-12">
                        <div style="padding: 30px;"><div class="loader04"></div></div>
                    </div>
                </div>`);

                 $.post('<?PHP echo site_url() ?>core/loadmoreProduct',{'type':type,'id':id,'category':category,'brand':brand,'size':size,'price':price,'group_no':total_record},
                function(data){ 
                    if (data != "") {
                        $("#results").html(data);
                        $('#loadmorebtn').html('<button type="button" class="btn btn-rounded btn-dark btnloadmore">LOAD MORE</button>');
                        total_record++;
                    } else {
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
            });

            $('#filprice').change(function() {
                var total_record = 0;
                var total_groups = <?PHP echo $total_data; ?>;  
                var category     = $('#filcategory').val();
                var brand        = $('#filbrand').val();
                var size         = $('#filsize').val();
                var price        = $('#filprice').val();

                $('#results').html(`</div>
                <div id="loaderpage" class="col-lg-12">
                    <div class="loader col-lg-12">
                        <div style="padding: 30px;"><div class="loader04"></div></div>
                    </div>
                </div>`);

                 $.post('<?PHP echo site_url() ?>core/loadmoreProduct',{'type':type,'id':id,'category':category,'brand':brand,'size':size,'price':price,'group_no':total_record},
                function(data){ 
                    if (data != "") {
                        $("#results").html(data);
                        $('#loadmorebtn').html('<button type="button" class="btn btn-rounded btn-dark btnloadmore">LOAD MORE</button>');
                        total_record++;
                    } else {
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
            });

            $(document).on('click', '.btnloadmore', function(e){
                $('.btnloadmore').fadeOut();
                document.getElementById("idbuttonloadmore").disabled = true;


                var category     = $('#filcategory').val();
                var brand        = $('#filbrand').val();
                var size         = $('#filsize').val();
                var price        = $('#filprice').val();
                if(total_record <= total_groups) {
                  loading = true; 
                  $('#loaderpage').fadeIn(); 
                  $.post('<?PHP echo site_url() ?>core/loadmoreProduct',{'type':type,'id':id,'category':category,'brand':brand,'size':size,'price':price,'group_no':total_record},
                    function(data){ 
                        if (data != "") {
                            $("#results").append(data);                 
                            $('#loaderpage').fadeOut();
                            $('.btnloadmore').fadeIn();
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
                if ($(window).scrollTop() + $(window).height() >= $('#page-content').offset().top + $('#page-content').height() - 200 ) {
                    $( ".btnloadmore" ).trigger( "click" );
                } 
            });

            // $(window).on("scroll", function() {
            //     if ($(window).scrollTop() + $(window).height() >= $('#page-content').offset().top + $('#page-content').height() + 200 ) {
                    
            //         var category     = $('#filcategory').val();
            //         var brand        = $('#filbrand').val();
            //         var size         = $('#filsize').val();
            //         var price        = $('#filprice').val();
            //         if(total_record <= total_groups) {
            //             loading = true; 
            //             $('#loaderpage').fadeIn();
            //             setTimeout(function(){
            //               $.post('<?PHP echo site_url() ?>core/loadmoreProduct',{'type':type,'id':id,'category':category,'brand':brand,'size':size,'price':price,'group_no':total_record},
            //                 function(data){ 
            //                     if (data != "") {
            //                         $("#results").append(data);                 
            //                         $('#loaderpage').fadeOut();
            //                         total_record++;
            //                     } else {
            //                         $('#loaderpage').fadeOut();
            //                         $('#loadmorebtn').html('<button type="button" class="btn btn-rounded btn-default">NO MORE DATA</button>');
            //                     }
            //                 });
            //             }, 3000);
            //         }
            //     } 
            // });
        });
        </script>