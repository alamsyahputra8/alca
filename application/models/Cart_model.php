<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model{
	function _construct(){
    	parent::_construct();
    	$this->load->model('query'); 
		$this->load->model('formula'); 
    }
	
	function retrieve_products(){
        $query = $this->db->get('product'); // Select the table products
        return $query->result_array(); // Return the results in a array.
    } 

    // Add an item to the cart
	function validate_add_cart_item(){
	    
	    $productid 	= $this->input->post('productid');
	    $cty 		= $this->input->post('qty');
	    $size 		= $this->input->post('size');
	    $price 		= $this->input->post('pricetotal');
	    $id 		= $productid.$size;

	    $q 					= "
        					select * from (
                                select
                                    a.*,
                                    (select file from product_image where id_product=a.id_product and cover='1' limit 1) cover,
                                    (select name from product_category where id_category=a.id_category) namecategory,
                                    (select link from product_category where id_category=a.id_category) linkcategory,
                                    (select title from link where id_link=a.id_link) brand,
                                    (select link from link where id_link=a.id_link) linkbrand,
                                    (select xb.name from product_category xa left join product_type xb on xa.id_type=xb.id_type where id_category=a.id_category) nametype,
                                    (select xc.menu from product_category xa left join product_type xb on xa.id_type=xb.id_type left join menu_site xc on xb.id_menu=xc.id_menu where id_category=a.id_category) menuname,
                                    (select xc.link from product_category xa left join product_type xb on xa.id_type=xb.id_type left join menu_site xc on xb.id_menu=xc.id_menu where id_category=a.id_category) linkmenu,
                                    (SELECT xb.name as  update_by FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
                                    WHERE xa.menu='Manage Product' AND xa.data = a.id_product ORDER BY xa.date_time DESC limit 1)as update_by,
                                    (SELECT DATE_FORMAT(xa.date_time, '%d-%b-%y %H:%i:%s') as last_update FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
                                    WHERE xa.menu='Manage Product' AND xa.data = a.id_product ORDER BY xa.date_time DESC limit 1)as last_update
                                from
                                product a
                            ) as final
                            where id_product='$productid'
        					";
        $all_content 		= $this->query->getDatabyQ($q);
        $jmlData 			= $this->query->getNumRowsbyQ($q)->num_rows();
	     
	    // Check if a row has matched our product id
	    if($jmlData > 0){
	     
	    // We have a match!
	        foreach ($all_content as $row)
	        {

	        	// $cek 			= $this->cart->get_item($id);
	        	// $coba 			= array_shift($cek);
	        	if(!$this->cart->contents()) {
	        		if ($row['diskon_special']>0 and $cty>1) {
		        		$valprice 	= $row['price']-$row['diskon_special'];
		        	} else {
		        		$valprice 	= $price;
		        	}
		        } else {
		        	foreach ($this->cart->contents() as $items) {
		        		if ($items['id']==$id) {
		        			if ($row['diskon_special']>0) {
				        		$valprice 	= $row['price']-$row['diskon_special'];
				        	} else {
				        		$valprice 	= $price;
				        	}
		        		} else {
		        			$valprice	= $price;
		        		}
		        	}
		        }
	            // Create an array with product information
	            $data = array(
	                'id'      	=> $id,
	                'cover' 	=> $row['cover'],
	                'productid'	=> $productid,
	                'link' 		=> $row['link'],
	                'brand' 	=> $row['brand'],
	                'menu'		=> $row['menuname'],
	                'category'	=> $row['namecategory'],
	                'weight'	=> $row['weight'],
	                'qty'     	=> $cty,
	                'size'   	=> $size,
	                'price'   	=> $valprice,
	                'name'    	=> $row['name']
	            );
	 
	            // Add the data to the cart using the insert function that is available because we loaded the cart library
	            $this->cart->insert($data); 
	             
	            return TRUE; // Finally return TRUE
	        }
	     
	    }else{
	        // Nothing found! Return FALSE! 
	        return FALSE;
	    }
	}

	// Updated the shopping cart
	function validate_update_cart(){
	     
	    // Get the total number of items in cart
	    $total 	= $this->cart->total_items();
	     
	    // Retrieve the posted information
	    $item 	= $this->input->post('rowid');
	    $qty 	= $this->input->post('qty');
	    $pid 	= $this->input->post('productid');
	 
	    // Cycle true all items and update them
	    for($i=0;$i < $total;$i++)
	    {
	    	$q 				= "
        					select * from (
                                select
                                    a.*,
                                    (select file from product_image where id_product=a.id_product and cover='1' limit 1) cover,
                                    (select name from product_category where id_category=a.id_category) namecategory,
                                    (select link from product_category where id_category=a.id_category) linkcategory,
                                    (select title from link where id_link=a.id_link) brand,
                                    (select link from link where id_link=a.id_link) linkbrand,
                                    (select xb.name from product_category xa left join product_type xb on xa.id_type=xb.id_type where id_category=a.id_category) nametype,
                                    (select xc.menu from product_category xa left join product_type xb on xa.id_type=xb.id_type left join menu_site xc on xb.id_menu=xc.id_menu where id_category=a.id_category) menuname,
                                    (select xc.link from product_category xa left join product_type xb on xa.id_type=xb.id_type left join menu_site xc on xb.id_menu=xc.id_menu where id_category=a.id_category) linkmenu,
                                    (SELECT xb.name as  update_by FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
                                    WHERE xa.menu='Manage Product' AND xa.data = a.id_product ORDER BY xa.date_time DESC limit 1)as update_by,
                                    (SELECT DATE_FORMAT(xa.date_time, '%d-%b-%y %H:%i:%s') as last_update FROM `data_log` xa LEFT JOIN user xb ON xa.userid=xb.userid 
                                    WHERE xa.menu='Manage Product' AND xa.data = a.id_product ORDER BY xa.date_time DESC limit 1)as last_update
                                from
                                product a
                            ) as final
                            where id_product='$pid[$i]'
        					";
	        $all_content 	= $this->query->getDatabyQ($q);
	        $row 			= array_shift($all_content);
	        $id 			= $row['id_product'];
	        $price 			= $row['price'];

	        foreach ($this->cart->contents() as $items) {
        		if ($items['productid']==$id) {
        			if ($row['diskon_special']>0 and $qty[$i]>1) {
		        		$valprice[$i] 	= $price-$row['diskon_special'];
		        	} else {
		        		if ($row['diskon']>0) {
		        			$valprice[$i] 	= $price-$row['diskon'];
		        		} else {
		        			$valprice[$i] 	= $price;
		        		}
		        	}
        		}
        	}

	        // Create an array with the products rowid's and quantities. 
	        $data = array(
	           'rowid' => $item[$i],
	           'qty'   => $qty[$i],
	           'price' => $valprice[$i]
	        );
	         
	        // Update the cart with the new information
	        $this->cart->update($data);
	    }
	 
	}
}