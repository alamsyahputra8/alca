<?PHP 
$sitedata           = array_shift($getSiteData); 
$gtotal_data        = $this->query->getDatabyQ("select count(*) total from link");
$dtotal_data        = array_shift($gtotal_data);
$gtotal_data        = $dtotal_data['total'];
$content_per_page   = 12; 
$total_data         = ceil($gtotal_data/$content_per_page);
$qPage      = "
            select
                a.*,
                (SELECT xb.name as  update_by FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
                WHERE xa.menu='Manage Link' AND xa.data = a.id_link ORDER BY xa.date_time DESC limit 1)as update_by,
                (SELECT DATE_FORMAT(xa.date_time, '%d-%b-%y %H:%i:%s') as last_update FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
                WHERE xa.menu='Manage Link' AND xa.data = a.id_link ORDER BY xa.date_time DESC limit 1)as last_update
            from
            link a
            ";
$gPage      = $this->query->getDatabyQ($qPage);
$dPage      = array_shift($gPage);
?>
<?PHP $this->load->view('theme/polo/plugin1'); ?>

        <?PHP $this->load->view('theme/polo/topbar'); ?>

        <?PHP $this->load->view('theme/polo/header'); ?>

        <style>
            #results .product .product-rate {font-size: 12px;}
            #results .product-reviews a {font-size: 9px!important;}
        </style>

        <section id="page-content" class="no-border">

            <div class="container">

                <div id="results" class="loader row">
                </div>
                <div>
                    <div id="loaderpage" class="row">
                        <div class="loader col-lg-12">
                            <div style="padding: 30px;"><div class="loader04"></div></div>
                        </div>
                    </div>
                    <center id="loadmorebtn"><button type="button" class="btn btn-rounded btn-dark btnloadmore">LOAD MORE</button></center>
                </div>
            </div>
        </section>

        <?PHP $this->load->view('theme/polo/footer'); ?>

        <script type="text/javascript">
        $(document).ready(function() {
            var total_record = 0;
            var total_groups = <?PHP echo $total_data; ?>;  
            var id           = <?PHP echo $idmenu; ?>;
            $('#results').load("<?php echo base_url() ?>core/loadmoreBrand", {'id':id,'group_no':total_record}, function() {$('#loaderpage').fadeOut(); total_record++;});
            // $(window).scroll(function() {       
            //     if($(window).scrollTop() + $(window).height() == $(document).height()) {
            $(document).on('click', '.btnloadmore', function(e){
                    if(total_record <= total_groups) {
                      loading = true; 
                      $('#loaderpage').fadeIn(); 
                      $.post('<?PHP echo site_url() ?>core/loadmoreBrand',{'id':id,'group_no': total_record},
                        function(data){ 
                            if (data != "") {
                                $("#results").append(data);                 
                                $('#loaderpage').fadeOut();
                                total_record++;
                            } else {
                                $('#loaderpage').fadeOut();
                                $('#loadmorebtn').html('<button type="button" class="btn btn-rounded btn-default">NO MORE DATA</button>');
                            }
                        });     
                    }
            //     }
            });
        });
        </script>