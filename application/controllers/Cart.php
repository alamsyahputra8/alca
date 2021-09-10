<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		date_default_timezone_set("Asia/Bangkok");
        parent::__construct();
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-chace');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('auth'); 
		$this->load->model('query'); 
		$this->load->model('formula'); 
		$this->load->model('cart_model'); 
    }
	
	public function index(){
		// if(checkingsessionelopM()){
			// $this->load->view('panel/dashboard');
		// } else {
			// redirect('/panel');
		// }
		$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
		$data['products'] 		= $this->cart_model->retrieve_products();

    	$this->load->view('/front/shop/cart', $data);
	}

	function add_cart_item(){
	    if($this->cart_model->validate_add_cart_item() == TRUE){
	         
	        // Check if user has javascript enabled
	        if($this->input->post('ajax') != '1'){
	            redirect('cart'); // If javascript is not enabled, reload the page with new data
	        }else{
	            echo 'true'; // If javascript is enabled, return true, so the cart gets updated
	        }
	    }
	     
	}

	function update_cart(){
	    $this->cart_model->validate_update_cart();
	    redirect('cart');
	}

	function empty_cart(){
	    $this->cart->destroy(); // Destroy all cart data
	    redirect('cart'); // Refresh te page
	}
 	
 	function show_cart(){
	    $this->load->view('/front/shop/products_top');
	}    

	public function gotopayment(){
		$orderid	= trim(strip_tags(stripslashes($this->input->post('orderid',true))));
		$telp		= trim(strip_tags(stripslashes($this->input->post('telp',true))));
		$email		= trim(strip_tags(stripslashes($this->input->post('email',true))));
		$nama		= trim(strip_tags(stripslashes($this->input->post('nama',true))));
		$province	= trim(strip_tags(stripslashes($this->input->post('province',true))));
		$city		= trim(strip_tags(stripslashes($this->input->post('city',true))));
		$courier	= trim(strip_tags(stripslashes($this->input->post('courier',true))));
		$cost		= trim(strip_tags(stripslashes($this->input->post('amount_cost',true))));
		$total		= trim(strip_tags(stripslashes($this->input->post('grandtotal',true))));
		$alamat		= trim(strip_tags(stripslashes($this->input->post('alamat',true))));
		$note		= trim(strip_tags(stripslashes($this->input->post('note',true))));
		$date 		= date('Y-m-d H:i:s');

		$q 			= "
					insert into payment (id_payment,orderid,nama,notelp,email,province,city,courier,shipping_cost,total,alamat,note,payment_date) values 
					('','$orderid','$nama','$telp','$email','$province','$city','$courier','$cost','$total','$alamat','$note','$date')
					";
		$rows 		= $this->query->insertDatabyQ($q);

		if($rows) {
			foreach($this->cart->contents() as $items):
				$idproduct 	= $items['productid'];
				$price 		= $items['price'];
				$qty 		= $items['qty'];
				$size 		= $items['size'];

				$qDetail 	= "
					insert into payment_detail (id_detail,orderid,id_product,price,qty,size) values 
					('','$orderid','$idproduct','$price','$qty','$size')
					";
				$rowsDetail = $this->query->insertDatabyQ($qDetail);

				// UPDATE STOK
				$minStok 	= $this->query->updateData('product_stok',"stok=stok-$qty","WHERE id_product='$idproduct' and size='$size'");
			endforeach;
			print json_encode(array('success'=>true,'total'=>1));
		} else {
			echo "";
			//echo "insert into content (title,sub,headline,content,id_menu) values ('$title','',$menu,'$headline','$content')";
		}
	}
}
