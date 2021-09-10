<?PHP 
$sitedata   = array_shift($getSiteData); 

$qPage      = "
            select
                a.*,
                (SELECT xb.name as  update_by FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
                WHERE xa.menu in ('Live Streaming') AND xa.data = a.id_stream ORDER BY xa.date_time DESC limit 1)as update_by,
                (SELECT DATE_FORMAT(xa.date_time, '%d-%b-%y %H:%i:%s') as last_update FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
                WHERE xa.menu in ('Live Streaming') AND xa.data = a.id_stream ORDER BY xa.date_time DESC limit 1)as last_update
            from
            (
                select * from streaming
            ) as a
            ";
$gPage      = $this->query->getDatabyQ($qPage);
$data       = array_shift($gPage);
$file       = $data['embed'];
?>

<?PHP $this->load->view('theme/polo/plugin1'); ?>

        <?PHP $this->load->view('theme/polo/topbar'); ?>

        <?PHP $this->load->view('theme/polo/header'); ?>

        <script type="text/javascript">
            $( "#topbar" ).removeClass( "topbar-transparent" );
            $( "#header" ).removeAttr( "data-transparent" );
        </script>

        <section id="page-content">
            <div class="container">
                <div class="heading-text heading-section ">
                    <!-- <h3>Foto & Video Terbaru</h3> -->
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <?PHP
                        $embed      = str_replace('https://www.youtube.com/watch?v=','https://www.youtube.com/embed/',$file);
                        ?>
                        <iframe width="1280" height="720" src="<?PHP echo $embed; ?>?rel=0&amp;showinfo=0" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="post-item-description p-t-30">
                    <h2><?PHP echo $data['title']; ?></h2>
                </div>
                <div><?PHP echo $data['description']; ?></div>
                <!-- end: Portfolio -->
            </div>
        </section>
        <!-- end: Content -->

        <?PHP $this->load->view('theme/polo/footer'); ?>