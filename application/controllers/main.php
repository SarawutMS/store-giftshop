<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function __construct()
    {
        parent::__construct();
    }
	
	public function index()
	{
		$this->db->order_by("Product_Trigger", "asc")->limit(1);

		$PRODUCT_TABLE = $this->db->get('tbl_product');
		$data = array(
			'PRODUCT_RESULT' => $PRODUCT_TABLE->result(),
		);
		$this->load->view('home',$data);
	}

	public function contact()
	{
		$this->load->view('frontend/page/page_contact');
	}

	#PRODUCT PAGE
	public function product_page()
	{
		$PRODUCT_TABLE = $this->db->get('tbl_product');
		$data = array(
			'PRODUCT_RESULT' => $PRODUCT_TABLE->result(),
		);
		$this->load->view('frontend/page/page_product',$data);
	}
	public function my_profile()
	{
		$this->load->view('frontend/page/page_myprofile');
	}

	public function product_category_page($category)
	{
		$data = array(
			'category' => $category,
		);
		$this->load->view('frontend/page/page_product',$data);
	}

	public function product_cart()
	{
		$this->load->view('frontend/page/page_basket');
	}

	public function page_topup($order_id)
	{
		$this->db->where('OrderID',$order_id);
		$ORDER_DETAIL_TABLE = $this->db->get('tbl_order_detail');
		$data = array(
			'ORDER_DETAIL_RESULT' => $ORDER_DETAIL_TABLE->result(),
			'order_id' => $order_id,
		);
		$this->load->view('frontend/page/page_topup',$data);
	}

	public function product_detail_page($id)
	{
		$this->db->where('Product_id',$id);
		$PRODUCT_TABLE = $this->db->get('tbl_product');
		$data = array(
			'PRODUCT_RESULT' => $PRODUCT_TABLE->result(),
		);
		$this->load->view('frontend/page/page_product_detail',$data);
	}

	public function product_order_detail($id)
	{
		$this->db->where('OrderID',$id);
		$ORDER_DETAIL_TABLE = $this->db->get('tbl_order_detail');
		$data = array(
			'ORDER_DETAIL_RESULT' => $ORDER_DETAIL_TABLE->result(),
		);
		$this->load->view('frontend/page/page_order_detail',$data);
	}

	#Account PAGE
	public function signin_page()
	{
		$this->load->view('frontend/page/page_signin');
	}
	public function signup_page()
	{
		$this->load->view('frontend/page/page_signup');
	}

	public function profile_order()
	{
		$this->load->view('frontend/page/profile_order');
	}

	public function online_index()
	{
		$this->load->view('frontend/online/page_online_index');
	}

	public function online_mygift()
	{
		$this->db->where('OnlineOwned',$this->session->userdata('email'));
		$ONLINE_TABLE = $this->db->get('tbl_online');
		$data = array(
			'ONLINE' => $ONLINE_TABLE->result(),
		);
		$this->load->view('frontend/online/page_online_mygift',$data);
	}
	public function online_gift($id)
	{
		$this->db->where('OnlineID',$id);
		$ONLINE_TABLE = $this->db->get('tbl_online');
		$data = array(
			'ONLINE' => $ONLINE_TABLE->result(),
		);
		$this->load->view('frontend/online/page_gift',$data);
	}


	public function backend_product()
	{
		$PRODUCT_TABLE = $this->db->get('tbl_product');
		$data = array(
			'PRODUCT_RESULT' => $PRODUCT_TABLE->result(),
		);
		$this->load->view('backend/page_product',$data);
	}
	public function backend_product_edit($id)
	{
		$this->db->where('Product_id',$id);
		$PRODUCT_TABLE = $this->db->get('tbl_product');
		$data = array(
			'PRODUCT_RESULT' => $PRODUCT_TABLE->result(),
		);
		$this->load->view('backend/page_product_edit',$data);
	}
	public function backend_product_add()
	{
		$this->load->view('backend/page_product_add');
	}

	public function backend_category()
	{
		$CATEGORY_TABLE = $this->db->get('tbl_category');
		$data = array(
			'CATEGORY_RESULT' => $CATEGORY_TABLE->result(),
		);
		$this->load->view('backend/page_category',$data);
	}
	public function backend_online()
	{
		$ONLINE_TABLE = $this->db->get('tbl_online');
		$data = array(
			'ONLINE_RESULT' => $ONLINE_TABLE->result(),
		);
		$this->load->view('backend/page_online',$data);
	}
	public function backend_orders()
	{
		$ORDER_DETAIL_TABLE = $this->db->get('tbl_order_detail');
		$data = array(
			'ORDER_DETAIL_RESULT' => $ORDER_DETAIL_TABLE->result(),
		);
		$this->load->view('backend/page_orders',$data);
	}

	public function backend_orders_detail($id)
	{
		$this->db->where('OrderID',$id);
		$ORDER_DETAIL_TABLE = $this->db->get('tbl_order_detail');

		$Billing_Checker = $this->db->where('Topup_order',$id)->get('tbl_paynment')->num_rows();
		$data = array(
			'ORDER_DETAIL_RESULT' => $ORDER_DETAIL_TABLE->result(),
			'Billing_Checker' => $Billing_Checker,
		);
		$this->load->view('backend/page_orders_detail',$data);
	}
	
	public function backend_billing()
	{
		$Billing = $this->db->get('tbl_paynment')->result();
		$data = array(
			'Billing' => $Billing,
		);
		$this->load->view('backend/page_billing',$data);
	}

}
