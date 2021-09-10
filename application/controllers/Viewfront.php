<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewfront extends CI_Controller {

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
	private $perPage = 5;

	public function __construct(){
        parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-chace');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('query');
		$this->load->model('formula');
		
		$ip   		= $_SERVER['REMOTE_ADDR'];
		$tanggal 	= date("Ymd");
		$waktu  	= time();
		$bln		= date("m");
		$tgl		= date("d");
		$blan		= date("Y-m");
		$thn		= date("Y");
		$tglk		= $tgl-1;
		
		$s			= $this->query->getNumRows('konter','*',"WHERE ip='$ip' AND tanggal='$tanggal'")->num_rows();
		
		if($s == 0) {
			$this->query->insertData('konter',"ip, tanggal, hits, online","'$ip','$tanggal','1','$waktu'");
		} 
		else{
			$this->query->updateData('konter',"hits=hits+1, online='$waktu'","WHERE ip='$ip' AND tanggal='$tanggal'");
		}
		if($tglk=='1' | $tglk=='2' | $tglk=='3' | $tglk=='4' | $tglk=='5' | $tglk=='6' | $tglk=='7' | $tglk=='8' | $tglk=='9'){
			$kemarin = $this->query->getData('konter','*',"WHERE tanggal='$thn-$bln-0$tglk'");
		} else {
			$kemarin = $this->query->getData('konter','*',"WHERE tanggal='$thn-$bln-$tglk'");
		}
    }
	
	public function cekcounter(){
		$ip   		= $_SERVER['REMOTE_ADDR'];
		$tanggal 	= date("Ymd");
		$waktu  	= time();
		$bln		= date("m");
		$tgl		= date("d");
		$blan		= date("Y-m");
		$thn		= date("Y");
		$tglk		= $tgl-1;
		
		$s			= $this->query->getNumRows('konter','*',"WHERE ip='$ip' AND tanggal='$tanggal'")->num_rows();
		
		if($s == 0){
			$this->query->insertData('konter',"ip, tanggal, hits, online","'$ip','$tanggal','1','$waktu'");
		} 
		else{
			$this->query->updateData('konter',"hits=hits+1, online='$waktu'","WHERE ip='$ip' AND tanggal='$tanggal'");
		}
		if($tglk=='1' | $tglk=='2' | $tglk=='3' | $tglk=='4' | $tglk=='5' | $tglk=='6' | $tglk=='7' | $tglk=='8' | $tglk=='9'){
			$kemarin = $this->query->getData('konter','*',"WHERE tanggal='$thn-$bln-0$tglk'");
		} else {
			$kemarin = $this->query->getData('konter','*',"WHERE tanggal='$thn-$bln-$tglk'");
		}
		// $bulan				= mysql_query("SELECT * FROM konter WHERE tanggal LIKE '%$blan%'");
		// $bulan1				= mysql_num_rows($bulan);
		// $tahunini			= mysql_query("SELECT * FROM konter WHERE tanggal LIKE '%$thn%'");
		// $tahunini1			= mysql_num_rows($tahunini);
		// $pengunjung       	= mysql_num_rows(mysql_query("SELECT * FROM konter WHERE tanggal='$tanggal' GROUP BY ip"));
		// $totalpengunjung  	= mysql_result(mysql_query("SELECT COUNT(hits) FROM konter"), 0); 
		// $hits             	= mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM konter WHERE tanggal='$tanggal' GROUP BY tanggal")); 
		// $totalhits        	= mysql_result(mysql_query("SELECT SUM(hits) FROM konter"), 0); ;
		// $pengunjungonline 	= mysql_num_rows(mysql_query("SELECT * FROM konter WHERE online = '$waktu'"));
		// $kemarin1 			= mysql_num_rows($kemarin);
	}
	
	public function index(){
		$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
		//$data['getRoomCat'] 	= $this->query->getData('category_room','*',"order by id_cat ASC");
		
		$this->load->view('/front/home/home',$data);
	}
	
	public function about(){
		$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
		$data['getRoomCat'] 	= $this->query->getData('category_room','*',"order by id_cat ASC");
		
		$this->load->view('/front/about/about',$data);
	}
	
	public function category($id){
		$idcat					= str_replace('-',' ',$id);
		$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
		$data['getRoomCat'] 	= $this->query->getData('category_room','*',"order by id_cat ASC");
		$data['getRoomCatBy'] 	= $this->query->getData('category_room','*',"WHERE LOWER(name_cat)='$idcat' order by id_cat ASC");
		
		$this->load->view('/front/rooms/rooms',$data);
	}
	
	public function post($id){
		$name					= str_replace('-',' ',$id);
		$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
		$data['getRoomCat'] 	= $this->query->getData('category_room','*',"order by id_cat ASC");
		$data['getEventDet'] 	= $this->query->getData('event','*',"WHERE LOWER(title)='$name'");
		
		$this->load->view('/front/event/detail',$data);
	}
	
	public function gallery(){
		$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
		$data['getRoomCat'] 	= $this->query->getData('category_room','*',"order by id_cat ASC");
		
		$this->load->view('/front/gallery/all',$data);
	}
	
	public function contact(){
		$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
		$data['getRoomCat'] 	= $this->query->getData('category_room','*',"order by id_cat ASC");
		
		$this->load->view('/front/about/contact',$data);
	}
	
	public function reservation(){
		if(checkingbasket()){
			$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
			$data['getRoomCat'] 	= $this->query->getData('category_room','*',"order by id_cat ASC");
			$data['reserv'] 		= $this->session->userdata('basket');
			$data['member'] 		= $this->session->userdata('member');
			
			// $reserv  = $this->session->userdata('basket');
			// print json_encode($reserv);
			
			$this->load->view('/front/booking/reserv',$data);
		} else {
			redirect('/engine/booking');
		}
	}
	
	public function thankyou(){
		if(checkingmember()) {
			if(checkingbasket()){
				redirect('/engine/reservation');
			} else {
				$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
				$data['getRoomCat'] 	= $this->query->getData('category_room','*',"order by id_cat ASC");
				$data['reserv'] 		= $this->session->userdata('basket');
				$data['member'] 		= $this->session->userdata('member');
				
				$this->load->view('/front/booking/finish',$data);
			}
		} else {
			redirect('/login');
		}
	}
	
	public function login(){
		if(checkingmember()) {
			redirect('/profile');
		} else {
			$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
			$data['getRoomCat'] 	= $this->query->getData('category_room','*',"order by id_cat ASC");
				
			$this->load->view('/front/member/login',$data);
		}
	}
	
	public function profile(){
		if(checkingmember()) {
			$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
			$data['getRoomCat'] 	= $this->query->getData('category_room','*',"order by id_cat ASC");
			$chaceMember			= $this->session->userdata('member');
			$getMember 				= $this->query->getData('member','*',"WHERE id_member='".$chaceMember['id_member']."'");
			$data['member'] 		= array_shift($getMember);
			
			$sekarang	= date('Y-m-d H:i:s');
			$getData	= $this->query->getData('booking','*',"WHERE jatuhtempo<'".$sekarang."' AND status='0' AND id_member='".$chaceMember['id_member']."'");
			foreach($getData as $data){
				$updateBook		= $this->query->updateData('booking',"status='3'","WHERE kode_booking='".$data['kode_booking']."'");
			}
				
			$this->load->view('/front/member/profile',$data);
		} else {
			redirect('/login');
		}
	}
	
	public function history(){
		if(checkingmember()) {
			$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
			$data['getRoomCat'] 	= $this->query->getData('category_room','*',"order by id_cat ASC");
			$chaceMember			= $this->session->userdata('member');
			$getMember 				= $this->query->getData('member','*',"WHERE id_member='".$chaceMember['id_member']."'");
			$data['member'] 		= array_shift($getMember);
			
			$sekarang	= date('Y-m-d H:i:s');
			$getData	= $this->query->getData('booking','*',"WHERE jatuhtempo<'".$sekarang."' AND status='0' AND id_member='".$chaceMember['id_member']."'");
			foreach($getData as $data){
				$updateBook		= $this->query->updateData('booking',"status='3'","WHERE kode_booking='".$data['kode_booking']."'");
			}
				
			$this->load->view('/front/member/history',$data);
		} else {
			redirect('/login');
		}
	}
	
	public function confirmation(){
		if(checkingmember()) {
			$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
			$data['getRoomCat'] 	= $this->query->getData('category_room','*',"order by id_cat ASC");
			
			$chaceMember			= $this->session->userdata('member');
			$getMember 				= $this->query->getData('member','*',"WHERE id_member='".$chaceMember['id_member']."'");
			$data['member'] 		= array_shift($getMember);
			
			$data['getDataBook']	= $this->query->getData('booking','*',"WHERE id_member='".$chaceMember['id_member']."' and status='0'");
			$data['getDataBank']	= $this->query->getData('bank','*',"ORDER BY nama_bank ASC");
			
			$sekarang	= date('Y-m-d H:i:s');
			$getData	= $this->query->getData('booking','*',"WHERE jatuhtempo<'".$sekarang."' AND status='0' AND id_member='".$chaceMember['id_member']."'");
			foreach($getData as $data){
				$updateBook		= $this->query->updateData('booking',"status='3'","WHERE kode_booking='".$data['kode_booking']."'");
			}
				
			$this->load->view('/front/member/confirmation',$data);
		} else {
			redirect('/login');
		}
	}

	public function page($id){

		$qPage 		= "select * from menu_site where link='$id'";
		$gPage 		= $this->query->getDatabyQ($qPage);
		$dPage		= array_shift($gPage);
		$stylepage	= $dPage['style'];
		$background	= $dPage['background'];
		$menu		= $dPage['menu'];

		$data['idmenu']			= $dPage['id_menu'];
		$data['background']		= $background;
		$data['menu']			= $menu;
		$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
		
		if ($stylepage=='download') {
			$this->load->database();
			$count = $this->db->get('album')->num_rows();
			if(!empty($this->input->get("page"))){
				$start = ceil($this->input->get("page") * $this->perPage);
				$query = $this->db->limit($start, $this->perPage)->get("album");
				$data['posts'] = $query->result();
				$result = $this->load->view('front/content/downloadmore', $data);
				// echo json_encode($result);
			}else{
		      	$query = $this->db->limit(9, $this->perPage)->get("album");
	    	  	$data['posts'] = $query->result();
			  	$this->load->view('front/content/download', $data);
			}
		} else {
			$this->load->view('/front/content/'.$stylepage.'' ,$data);
		}
	}

	public function blog($id){
		$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
		$data['id'] 			= $id;
		
		$this->load->view('/front/content/detailblog' ,$data);
	}

	public function doc($id){
		$data['getSiteData'] 	= $this->query->getData('configsite','*',"");

		$qPage 		= "
					select
		                a.*,
		                (select link from menu_site where id_menu=a.id_menu) as menulink,
		                (select menu from menu_site where id_menu=a.id_menu) as menuname,
		                (SELECT xb.name as  update_by FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
		                WHERE xa.menu='Manage Document' AND xa.data = a.id_doc ORDER BY xa.date_time DESC limit 1)as update_by,
		                (SELECT DATE_FORMAT(xa.date_time, '%d-%b-%y %H:%i:%s') as last_update FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
		                WHERE xa.menu='Manage Document' AND xa.data = a.id_doc ORDER BY xa.date_time DESC limit 1)as last_update
		            from
		            document a
		            where link='$id'
					";
		$gPage 		= $this->query->getDatabyQ($qPage);
		$dPage		= array_shift($gPage);
		$folder		= $dPage['title'];

		$data['link']			= $id;
		$data['doclink']		= $dPage['menulink'];
		$data['menuname']		= $dPage['menuname'];
		$data['id_doc']			= $dPage['id_doc'];
		$data['folder']			= $folder;
		$data['update_by']		= $dPage['update_by'];
		$data['last_update']	= $dPage['last_update'];
		
		$this->load->view('/front/content/detaildoc' ,$data);
	}

	public function works($id){
		$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
		$data['id'] 			= $id;
		
		$this->load->view('/front/content/worksdetail' ,$data);
	}

	public function event($id){
		$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
		$data['id'] 			= $id;

		$qPage      = "select * from event where link='$id'";
		$gPage      = $this->query->getDatabyQ($qPage);
		$dPage      = array_shift($gPage);
		$idevent	= $dPage['id_event'];

		$gtotal_data 			= $this->query->getDatabyQ("select count(*) total from event_detail where id_event='$idevent'");
		$dtotal_data 			= array_shift($gtotal_data);
		$total_data 			= $dtotal_data['total'];
        $content_per_page 		= 9; 
        $data['total_data'] 	= ceil($total_data/$content_per_page);
		
		$this->load->view('/front/content/eventdetail' ,$data);
	}

	public function shop($type,$id){
		$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
		$data['id'] 			= $id;
		$data['type'] 			= $type;
		
		$this->load->view('/front/product/list' ,$data);
	}

	public function product($link){
		$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
		$data['link'] 			= $link;
		
		$this->load->view('/front/product/detail' ,$data);
	}

	public function quickview($link){
		$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
		$data['link'] 			= $link;
		
		$this->load->view('/front/product/quickview' ,$data);
	}

	public function checkout(){
		$this->load->view('/front/midtrans/checkout');
	}

	public function handle_notification(){
		// $this->load->view('/front/midtrans/handle_notification');
		
		// require_once(dirname(__FILE__) . '/Veritrans.php');
		require_once(APPPATH. 'views/front/midtrans/Veritrans.php');
		Veritrans_Config::$isProduction = true;
		Veritrans_Config::$serverKey = 'Mid-server-ojss1J65vvspWZN71qA4c9-E';



		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {


		 try {
		  $notif = new Veritrans_Notification();
		} catch (Exception $e) {
		  echo "Exception: ".$e->getMessage()."\r\n";
		  echo "Notification received: ".file_get_contents("php://input");
		  exit();
		} 
		$transaction = $notif->transaction_status;
		$type = $notif->payment_type;
		$order_id = $notif->order_id;
		$fraud = $notif->fraud_status;
		if ($transaction == 'capture') {
		  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		  if ($type == 'credit_card'){
		    if($fraud == 'challenge'){
		      // TODO set payment status in merchant's database to 'Challenge by FDS'
		      // TODO merchant should decide whether this transaction is authorized or not in MAP
		      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
		      $this->query->updateData('payment',"payment_status='Challenge by FDS'","WHERE orderid='".$order_id."'");
		      }
		      else {
		      // TODO set payment status in merchant's database to 'Success'
		      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
		      $this->query->updateData('payment',"payment_status='Success'","WHERE orderid='".$order_id."'");
		      }
		    }
		  }
		else if ($transaction == 'settlement'){
		  // TODO set payment status in merchant's database to 'Settlement'
		  echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
		  $this->query->updateData('payment',"payment_status='Settlement'","WHERE orderid='".$order_id."'");
		  }
		  else if($transaction == 'pending'){
		  // TODO set payment status in merchant's database to 'Pending'
		  echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		  $this->query->updateData('payment',"payment_status='Pending'","WHERE orderid='".$order_id."'");
		  }
		  else if ($transaction == 'deny') {
		  // TODO set payment status in merchant's database to 'Denied'
		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		  	$this->query->updateData('payment',"payment_status='Denied'","WHERE orderid='".$order_id."'");

		  	$qDetail 	= "select * from payment_detail where orderid='".$order_id."'";
		  	$gDetail 	= $this->query->getDatabyQ($qDetail);
		  	foreach ($gDetail as $items) {
		  		$idproduct 	= $items['id_product'];
				$price 		= $items['price'];
				$qty 		= $items['qty'];
				$size 		= $items['size'];

		  		$minStok 	= $this->query->updateData('product_stok',"stok=stok+$qty","WHERE id_product='$idproduct' and size='$size'");
		  	}
		  }
		  else if ($transaction == 'expire') {
			  	// TODO set payment status in merchant's database to 'expire'
			  	echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
			  	$this->query->updateData('payment',"payment_status='Expire'","WHERE orderid='".$order_id."'");

			  	$qDetail 	= "select * from payment_detail where orderid='".$order_id."'";
			  	$gDetail 	= $this->query->getDatabyQ($qDetail);
			  	foreach ($gDetail as $items) {
			  		$idproduct 	= $items['id_product'];
					$price 		= $items['price'];
					$qty 		= $items['qty'];
					$size 		= $items['size'];

			  		$minStok 	= $this->query->updateData('product_stok',"stok=stok+$qty","WHERE id_product='$idproduct' and size='$size'");
			  	}
		  }
		  else if ($transaction == 'cancel') {
	  		// TODO set payment status in merchant's database to 'Denied'
	  		echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
	  		$this->query->updateData('payment',"payment_status='Denied'","WHERE orderid='".$order_id."'");

	  		$qDetail 	= "select * from payment_detail where orderid='".$order_id."'";
		  	$gDetail 	= $this->query->getDatabyQ($qDetail);
		  	foreach ($gDetail as $items) {
		  		$idproduct 	= $items['id_product'];
				$price 		= $items['price'];
				$qty 		= $items['qty'];
				$size 		= $items['size'];

		  		$minStok 	= $this->query->updateData('product_stok',"stok=stok+$qty","WHERE id_product='$idproduct' and size='$size'");
		  	}
		}


		} else {


		    //
		    // order_id=776981683&status_code=200&transaction_status=capture

		    $order_id = $_GET['order_id'];
		    $statusCode = $_GET['status_code'];
		    $transaction  = $_GET['transaction_status'];


			if($transaction == 'capture') {
			  echo "<p>Transaksi berhasil.</p>";
			  echo "<p>Status transaksi untuk order id : " . $order_id;

			}
			// Deny
			else if($transaction == 'deny') {
			  	echo "<p>Transaksi ditolak.</p>";
			  	echo "<p>Status transaksi untuk order id .: " . $order_id;

			  	$qDetail 	= "select * from payment_detail where orderid='".$order_id."'";
			  	$gDetail 	= $this->query->getDatabyQ($qDetail);
			  	foreach ($gDetail as $items) {
			  		$idproduct 	= $items['id_product'];
					$price 		= $items['price'];
					$qty 		= $items['qty'];
					$size 		= $items['size'];

			  		$minStok 	= $this->query->updateData('product_stok',"stok=stok+$qty","WHERE id_product='$idproduct' and size='$size'");
			  	}

			}
			// Challenge
			else if($transaction == 'challenge') {
			  	echo "<p>Transaksi challenge.</p>";
			  	echo "<p>Status transaksi untuk order id : " . $order_id;

			}
			// Error
			else {
			  	echo "<p>Terjadi kesalahan pada data transaksi yang dikirim.</p>";
			  	echo "<p>Status message: [$response->status_code] " . $transaction;
			}
			
			$this->query->updateData('payment',"payment_status='".$transaction."'","WHERE orderid='".$order_id."'");


		}
	}

	public function payment($status){
		$data['getSiteData'] 	= $this->query->getData('configsite','*',"");
		$data['status'] 		= $status;
		
		$this->load->view('/front/shop/payment' ,$data);
	}

	public function handle_notification_test(){
		// $this->load->view('/front/midtrans/handle_notification');
		
		// require_once(dirname(__FILE__) . '/Veritrans.php');
		require_once(APPPATH. 'views/front/midtrans/Veritrans.php');
		Veritrans_Config::$isProduction = true;
		Veritrans_Config::$serverKey = 'Mid-server-ojss1J65vvspWZN71qA4c9-E';



		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {


	 	try {
		  $notif = new Veritrans_Notification();
		} catch (Exception $e) {
		  echo "Exception: ".$e->getMessage()."\r\n";
		  echo "Notification received: ".file_get_contents("php://input");
		  exit();
		} 
		$transaction = $notif->transaction_status;
		$type = $notif->payment_type;
		$order_id = $notif->order_id;
		$fraud = $notif->fraud_status;
		if ($transaction == 'capture') {
		  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		  if ($type == 'credit_card'){
		    if($fraud == 'challenge'){
		      // TODO set payment status in merchant's database to 'Challenge by FDS'
		      // TODO merchant should decide whether this transaction is authorized or not in MAP
		      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
		      $this->query->updateData('payment',"payment_status='Challenge by FDS'","WHERE orderid='".$order_id."'");
		      }
		      else {
		      // TODO set payment status in merchant's database to 'Success'
		      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
		      $this->query->updateData('payment',"payment_status='Success'","WHERE orderid='".$order_id."'");
		      }
		    }
		  }
		else if ($transaction == 'settlement'){
		  // TODO set payment status in merchant's database to 'Settlement'
		  echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
		  $this->query->updateData('payment',"payment_status='Settlement'","WHERE orderid='".$order_id."'");
		  }
		  else if($transaction == 'pending'){
		  // TODO set payment status in merchant's database to 'Pending'
		  echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		  $this->query->updateData('payment',"payment_status='Pending'","WHERE orderid='".$order_id."'");
		  }
		  else if ($transaction == 'deny') {
		  // TODO set payment status in merchant's database to 'Denied'
		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		  $this->query->updateData('payment',"payment_status='Denied'","WHERE orderid='".$order_id."'");
		  }
		  else if ($transaction == 'expire') {
		  // TODO set payment status in merchant's database to 'expire'
		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
		  $this->query->updateData('payment',"payment_status='Expire'","WHERE orderid='".$order_id."'");
		  }
		  else if ($transaction == 'cancel') {
		  // TODO set payment status in merchant's database to 'Denied'
		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
		  $this->query->updateData('payment',"payment_status='Denied'","WHERE orderid='".$order_id."'");
		}


		} else {


		    //
		    // order_id=776981683&status_code=200&transaction_status=capture

		    $order_id = $_GET['order_id'];
		    $statusCode = $_GET['status_code'];
		    $transaction  = $_GET['transaction_status'];


			if($transaction == 'capture') {
			  echo "<p>Transaksi berhasil.</p>";
			  echo "<p>Status transaksi untuk order id : " . $order_id;

			}
			// Deny
			else if($transaction == 'deny') {
			  echo "<p>Transaksi ditolak.</p>";
			  echo "<p>Status transaksi untuk order id .: " . $order_id;

			}
			// Challenge
			else if($transaction == 'challenge') {
			  echo "<p>Transaksi challenge.</p>";
			  echo "<p>Status transaksi untuk order id : " . $order_id;

			}
			// Error
			else {
			  echo "<p>Terjadi kesalahan pada data transaksi yang dikirim.</p>";
			  echo "<p>Status message: [$response->status_code] " . $transaction;
			}
			
			$this->query->updateData('payment',"payment_status='".$transaction."'","WHERE orderid='".$order_id."'");


		}
	}
	
}
