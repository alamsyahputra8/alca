<?PHP 
$sitedata   = array_shift($getSiteData); 

// $qPage      = "

//             ";
// $gPage      = $this->query->getDatabyQ($qPage);
?>

<?PHP $this->load->view('theme/polo/plugin1'); ?>

        <?PHP $this->load->view('theme/polo/topbar'); ?>

        <?PHP $this->load->view('theme/polo/header'); ?>

        <!-- Page title -->
        <section id="page-title">
            <div class="container">
                <div class="page-title">
                    <h1>Shopping Cart</h1>
                    <span>Shopping details</span>
                </div>
            </div>
        </section>
        <!-- end: Page title -->

        <!-- SHOP CART -->
        <section id="shop-cart">
            <div class="container">
                <?php $this->view('/front/shop/products'); ?>
            </div>
        </section>
        <!-- end: SHOP CART -->
        
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