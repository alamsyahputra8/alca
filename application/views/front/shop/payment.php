<?PHP 
$sitedata   = array_shift($getSiteData); 
// $qPage      = "

//             ";
// $gPage      = $this->query->getDatabyQ($qPage);
?>

<?PHP $this->load->view('theme/polo/plugin1'); ?>

        <?PHP $this->load->view('theme/polo/topbar'); ?>

        <?PHP $this->load->view('theme/polo/header'); ?>

        <?PHP 
        if ($status=='finish') { 
            $this->cart->destroy(); // Destroy all cart data
        ?>
        <!-- SHOP CHECKOUT COMPLETED -->
        <section id="shop-checkout-completed">
            <div class="container">
                <div class="p-t-30 m-b-20 text-center">
                    <div class="text-center">
                        <h3>Congratulations! Your order is completed!</h3>
                        <p>Your order number is <?PHP echo $_GET['order_id']; ?>. You can
                            <span class="text-underline">
                                <mark>view your detail order</mark>
                            </span> on your email account.</p>
                    </div>
                    <a class="btn icon-left" href="<?PHP echo base_url(); ?>"><span>Return To Shop</span></a>
                </div>
            </div>
        </section>
        <!-- end: SHOP CHECKOUT COMPLETED -->
        <?PHP } else { ?>
        <!-- SHOP CHECKOUT COMPLETED -->
        <section id="shop-checkout-completed">
            <div class="container">
                <div class="p-t-30 m-b-20 text-center">
                    <div class="text-center">
                        <h3>Oops! Order not found!</h3>
                        <!-- <p>You can
                            <span class="text-underline">
                                <mark>view your detail order</mark>
                            </span> on your email account.</p> -->
                    </div>
                    <a class="btn icon-left" href="<?PHP echo base_url(); ?>"><span>Return To Shop</span></a>
                </div>
            </div>
        </section>
        <!-- end: SHOP CHECKOUT COMPLETED -->
        <?PHP } ?>

        <?PHP $this->load->view('theme/polo/footer'); ?>