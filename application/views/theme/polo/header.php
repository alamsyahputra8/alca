<?PHP 
$getSiteData    = $this->query->getData('configsite','*',"");
$site           = array_shift($getSiteData); 

$activepage = $this->uri->uri_string();
//if ($activepage=='page/blog') {
if (strpos( $activepage, 'blog' ) !== false) {
    $transparent    = '';
} else {
    $transparent    = '';
    // $transparent    = 'data-transparent="true"';
}
?>
<style>
.diclofest {
    background: #981212;
    border-radius: 3px;
}
#mainMenu nav > ul > li.mega-menu-item > .dropdown-menu {
    width: 30vw;
}
@media (max-width: 991px) {
    #logo { text-align: left!important; background: #1e1e1e!important; }
    #header .header-inner #logo a > img, #header #header-wrap #logo a > img { 
        /*max-width: 82%; height: auto; margin-top: 1rem;*/
        max-width: 240px;
        height: auto;
        margin-top: 10%;
        margin-left: 8%;
    }
    #header[data-transparent="true"] .header-inner .lines, #header[data-transparent="true"] .header-inner .lines:before, #header[data-transparent="true"] .header-inner .lines:after, #header[data-transparent="true"] #header-wrap .lines, #header[data-transparent="true"] #header-wrap .lines:before, #header[data-transparent="true"] #header-wrap .lines:after, #header.dark[data-transparent="true"] .header-inner .lines, #header.dark[data-transparent="true"] .header-inner .lines:before, #header.dark[data-transparent="true"] .header-inner .lines:after, #header.dark[data-transparent="true"] #header-wrap .lines, #header.dark[data-transparent="true"] #header-wrap .lines:before, #header.dark[data-transparent="true"] #header-wrap .lines:after, #header.dark.header-colored .header-inner .lines, #header.dark.header-colored .header-inner .lines:before, #header.dark.header-colored .header-inner .lines:after, #header.dark.header-colored #header-wrap .lines, #header.dark.header-colored #header-wrap .lines:before, #header.dark.header-colored #header-wrap .lines:after {
        background: #FFF!important;
    }
    /*#header[data-transparent="true"] .header-inner,#header.dark[data-transparent="true"] .header-inner {
        background-color: #1e1e1e!important;
    }
    #header[data-transparent="true"] .header-inner .lines, #header.dark[data-transparent="true"] .header-inner .lines {
        background-color: #FFF!important;
    }*/
}
</style>
<!-- Header -->
<header id="header" <?PHP echo $transparent; ?> data-fullwidth="true" class="dark">
    <div class="header-inner">
        <div class="container"> <!--Logo-->
            <div id="logo">
                <a href="<?PHP echo base_url(); ?>" class="logo" data-src-dark="<?PHP echo base_url(); ?>images/<?PHP echo $site['logo']; ?>">
                    <img src="<?PHP echo base_url(); ?>images/<?PHP echo $site['logo']; ?>" alt="<?PHP echo $site['name_site']; ?>">
                </a>
            </div>
            <!--End: Logo-->

            <!-- Search -->
            <div id="search">
                <div id="search-logo"><img src="<?PHP echo base_url(); ?>images/<?PHP echo $site['logo']; ?>" alt="<?PHP echo $site['name_site']; ?>"></div>
                <button id="btn-search-close" class="btn-search-close" aria-label="Close search form"><i
                        class="icon-x"></i>
                </button>
                <form class="search-form" action="search-results-page.html" method="get">
                    <input class="form-control" name="q" type="search" placeholder="Search..."
                        autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
                    <span class="text-muted">Start typing & press "Enter" or "ESC" to close</span>
                </form>
            </div>
            <!-- end: search -->

            <!--Header Extras
            <div class="header-extras">
                <ul>
                    <li>
                        <a id="btn-search" href="#"> <i class="icon-search1"></i></a>
                    </li>
                </ul>
            </div>
            end: Header Extras-->
            
            <!--Navigation Resposnive Trigger-->
            <div id="mainMenu-trigger" class="mainMenu-trigger">
                <button class="lines-button x"> <div class="lines"></div></button>
                <div class="text-white" style="
                    line-height: normal;
                    margin-top: -35px;
                    margin-left: -8px;
                ">MENU</div>
            </div>
            <!--end: Navigation Resposnive Trigger-->

            <!--Header Extras-->
            <div class="header-extras" style="display: none;">
                <ul>
                    <li>
                        <!--search icon-->
                        <!-- <a id="btn-search" href="#"> <i class="icon-search1"></i></a> -->
                        <!--end: search icon-->
                    </li>
                    <li class="d-sm-block">
                        <!--shopping cart-->
                        <div id="shopping-cart" class="p-dropdown">
                            <a href="#">
                                <!-- <span class="shopping-cart-items">0</span> -->
                                <i class="icon-shopping-cart1"></i>
                            </a>
                            <div class="p-dropdown-content ">
                                <div class="widget-mycart">
                                    <h4>My Cart</h4>
                                    <div id="shopcart-top"><?PHP $this->load->view('/front/shop/products_top'); ?></div>
                                </div>
                            </div>
                        </div>
                        <!--end: shopping cart-->
                    </li>
                </ul>
            </div>
            <!--end: Header Extras-->

            <!--Navigation-->
            <div id="mainMenu" class="">
                <div class="container">
                    <nav>
                        <ul>
                            <?PHP
                            $qMenu      = "select * from menu_site where parent='0' and style not in ('about','other','contact') order by sort asc";
                            $getMenu    = $this->query->getDatabyQ($qMenu);
                            foreach ($getMenu as $datamenu) {
                                $idmenu     = $datamenu['id_menu'];
                                $cekChild   = $this->query->getNumRows('menu_site','*',"where parent='$idmenu'")->num_rows();

                                if ($datamenu['style']!='product') {
                                    if ($cekChild>0) {
                                        $classChild = 'class="dropdown"';
                                    } else {
                                        $classChild = '';
                                    }
                                } else {
                                    $classChild = 'class="dropdown mega-menu-item"';
                                }

                                if ($datamenu['link']=='#' or $datamenu['link']=='') { $page   = ''; } 
                                else if ($datamenu['style']=='product') { $page = 'shop/list/'; } 
                                else if ($datamenu['style']=='promo') { $page = 'shop/promo/'; } 
                                else { $page   = 'page/'; }

                                if ($datamenu['style']=='promo') { $classdiclo = 'class="diclofest"'; } else { $classdiclo = ''; }
                            ?>
                            <li <?PHP echo $classChild; ?>>
                                <a href="<?PHP echo base_url(); ?><?PHP echo $page; ?><?PHP echo $datamenu['link']; ?>" <?PHP echo $classdiclo; ?>><?PHP echo $datamenu['menu']; ?></a>
                                <?PHP if ($datamenu['style']!='product') { ?>
                                    <?PHP if ($cekChild>0) { ?>
                                        <ul class="dropdown-menu">
                                            <?PHP
                                            $qChild     = "select * from menu_site where parent='$idmenu' order by sort asc";
                                            $getChild   = $this->query->getDatabyQ($qChild);
                                            foreach ($getChild as $datachild) {
                                                $idmenuC     = $datachild['id_menu'];
                                                $cekChild2   = $this->query->getNumRows('menu_site','*',"where parent='$idmenuC'")->num_rows();
                                                if ($cekChild2>0) {
                                                    $classChild2 = 'class="dropdown-submenu"';
                                                } else {
                                                    $classChild2 = '';
                                                }
                                                if ($datachild['link']=='#' or $datachild['link']=='') { $page   = ''; } else if ($datachild['style']=='product') { $page = 'shop/list/'; } else { $page   = 'page/'; }
                                            ?>
                                            <li <?PHP echo $classChild2; ?>><a href="<?PHP echo base_url(); ?><?PHP echo $page; ?><?PHP echo $datachild['link']; ?>"><?PHP echo $datachild['menu']; ?></a>
                                                <?PHP if ($cekChild2>0) { ?>
                                                <ul class="dropdown-menu">
                                                    <?PHP
                                                    $qChild2     = "select * from menu_site where parent='$idmenuC' order by sort asc";
                                                    $getChild2   = $this->query->getDatabyQ($qChild2);
                                                    foreach ($getChild2 as $datachild2) {
                                                        $idmenuC2     = $datachild2['id_menu'];
                                                        $cekChild3   = $this->query->getNumRows('menu_site','*',"where parent='$idmenuC2'")->num_rows();
                                                        if ($cekChild3>0) {
                                                            $classChild3 = 'class="dropdown-submenu"';
                                                        } else {
                                                            $classChild3 = '';
                                                        }
                                                        if ($datachild2['link']=='#' or $datachild2['link']=='') { $page   = ''; } else if ($datachild2['style']=='product') { $page = 'shop/list/'; } else { $page   = 'page/'; }
                                                    ?>
                                                    <li <?PHP echo $classChild3; ?>><a href="<?PHP echo base_url(); ?><?PHP echo $page; ?><?PHP echo $datachild2['link']; ?>"><?PHP echo $datachild2['menu']; ?></a>
                                                        <?PHP if ($cekChild3>0) { ?>
                                                        <ul class="dropdown-menu">
                                                            <?PHP
                                                            $qChild3     = "select * from menu_site where parent='$idmenuC2' order by sort asc";
                                                            $getChild3   = $this->query->getDatabyQ($qChild3);
                                                            foreach ($getChild3 as $datachild3) {
                                                                $idmenuC3     = $datachild3['id_menu'];
                                                                if ($datachild3['link']=='#' or $datachild3['link']=='') { $page   = ''; } else if ($datachild3['style']=='product') { $page = 'shop/list/'; } else { $page   = 'page/'; }
                                                            ?>
                                                            <li><a href="<?PHP echo base_url(); ?><?PHP echo $page; ?><?PHP echo $datachild3['link']; ?>"><?PHP echo $datachild3['menu']; ?></a></li>
                                                            <?PHP } ?>
                                                        </ul>
                                                        <?PHP } ?>
                                                    </li>
                                                    <?PHP } ?>
                                                </ul>
                                                <?PHP } ?>
                                            </li>
                                            <?PHP } ?>
                                        </ul>
                                    <?PHP } ?>
                                <?PHP } else { ?>
                                    <ul class="dropdown-menu">
                                        <li class="mega-menu-content">
                                            <div class="row">
                                                <?PHP
                                                $qT             = "
                                                                    select a.*, (select menu from menu_site where id_menu=a.id_menu) menu
                                                                    from product_type a
                                                                    where id_menu='$idmenu'
                                                                    order by id_menu, sort asc
                                                                    ";
                                                $getDataType    = $this->query->getDatabyQ($qT);
                                                foreach ($getDataType as $dataT) { $idtype = $dataT['id_type'];
                                                ?>
                                                <div class="col-lg-4">
                                                    <ul>
                                                        <li class="mega-menu-title"><?PHP echo $dataT['name']; ?></li>
                                                        <?PHP
                                                        $q                  = "
                                                                            select *
                                                                            from product_category
                                                                            where id_type='$idtype' order by 1 asc
                                                                            ";
                                                        $getDataCategory    = $this->query->getDatabyQ($q);
                                                        foreach ($getDataCategory as $data) { 
                                                        ?>
                                                            <li> <a href="<?PHP echo base_url(); ?>shop/product/<?PHP echo $data['link']; ?>"><?PHP echo $data['name']; ?></a> </li>
                                                        <?PHP } ?>
                                                    </ul>
                                                </div>
                                                <?PHP } ?>
                                            </div>
                                        </li>
                                    </ul>
                                <?PHP } ?>
                            </li>
                            <?PHP } ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <!--END: NAVIGATION-->
        </div>
    </div>
</header>
<!-- end: Header -->