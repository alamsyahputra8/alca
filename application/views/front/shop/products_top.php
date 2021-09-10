<?PHP if(!$this->cart->contents()): ?>
<div class="p-t-30 m-b-30 text-center">
    <div class="heading-text heading-line text-center">
        <h4>Your cart is currently empty.</h4>
    </div>
</div>
<?PHP else: ?>
    <?php $i = 1; ?>
    <?php foreach($this->cart->contents() as $items): ?>
    <?php echo form_hidden('rowid[]', $items['rowid']); ?>
    <div class="cart-item">
        <div class="cart-image"> 
            <a href="#"><img src="<?PHP echo base_url(); ?>images/product/<?PHP echo $items['cover']; ?>"></a>
        </div>
        <div class="cart-product-meta"><a href="#"><?PHP echo $items['name']; ?> (<?PHP echo $items['size']; ?>)</a>
            <span><?PHP echo $items['qty']; ?> x IDR <?php echo $this->formula->rupiah2($items['price']); ?></span>
        </div>
        <div class="cart-item-remove"></div>
    </div>
    <?PHP endforeach; ?>
    <hr>
    <div class="cart-total">
        <div class="cart-total-labels">
            <span><strong>Subtotal</strong></span>
        </div>
        <div class="cart-total-prices">
            <span><strong>IDR <?php echo $this->formula->rupiah2($this->cart->total()); ?></strong></span>
        </div>

    </div>
    <div class="cart-buttons text-right">
        <a href="<?PHP echo base_url(); ?>cart/" class="btn btn-xs">Lanjut ke Pembayaran</a>

    </div>
<?php 
endif;
?>