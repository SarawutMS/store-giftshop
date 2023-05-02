<?php

defined('BASEPATH') or exit('No direct script access allowed');
class AppControllers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_function');
    }

    public function index()
	{
        exit('ทำไรอะเด็กฝึกหัด');
	}

    private function resizeImage($file,$width,$height){
        $image = $file;
        $config['image_library'] = 'gd2';
        $config['source_image'] = $image['full_path'];
        $config['maintain_ratio'] = TRUE; // ปรับขนาดโดยยังรักษาสัดส่วนของรูปไว้
        $config['quality'] = 100; // ความละเอียดของรูปใหม่สูงสุด 100
        $config['width'] = $width; // ความกว้างของรูปภาพ
        $config['height'] = $height; // ความสูงของรูปภาพ
        $image = base_url("assets/images/gift/".$image['file_name']);
        $this->load->library('image_lib', $config); 
        $this->image_lib->resize();
        return $image;
    }
    
    private function is_login()
    {
        if (!$this->session->userdata('login-state')) {
            return false;
        }else{
            $this->db->where("Email", $this->session->userdata('email'));
            $User_query = $this->db->get("tbl_users");
            return $User_query->result();
        }
    }

    public function AuthSignin(){
        if ($post = $this->input->post()) {
            extract($post);
            if (empty($Email)) {
                $notify['type'] = "error";
                $notify['alert'] = 'กรุณาอย่าเว้นช่องว่าง';
            } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                $notify['type'] = "error";
                $notify['alert'] = 'กรุณาใส่ "Email" ให้ถูกต้อง';
            }elseif (empty($Password)) {
                $notify['type'] = "error";
                $notify['alert'] = 'กรุณาอย่าเว้นช่องว่าง';
            } elseif (strlen($Password) < 6) {
                $notify['type'] = "error";
                $notify['alert'] = 'รหัสผ่านน้อยกว่า 6 ตัวอักษร';
            } else {
                $this->db->where("Email", $Email);
                $User_query = $this->db->get("tbl_users");
                if (!$User_query->num_rows()) {
                    $notify['type'] = "error";
                    $notify['alert'] = 'ไม่พบ "Email" นี้ในระบบ';
                } else {
                    $User_info = $User_query->result();
                    if ($User_info[0]->Password == md5($Password)) {
                        $newdata = array(
                            'login-state'  => true,
                            'UserID'  => $User_info[0]->UserID,
                            'email'     => $User_info[0]->Email
                        );
                        $this->session->set_userdata($newdata);
                        $notify['type'] = "success";
                        $notify['target'] = base_url('');
                    } else {
                        $notify['type'] = "error";
                        $notify['alert'] = 'รหัสผ่านไม่ถูกต้อง';
                    }
                }
            }
            exit(json_encode($notify));
        }else{
            exit('เสือกนักนะ ทำไรอะเด็กฝึกหัด');
        }
    }
    public function AuthSignup(){
        if ($post = $this->input->post()) {
            extract($post);
            if(isset($_POST['g-recaptcha-response'])){
                $secret = '6Lfscx8jAAAAAD6BtOfbuP4v04ScsnzUR4PqsOWg';
                $captcha = $_POST['g-recaptcha-response'];
                $verifyResponse = file_get_contents('https://google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captcha);
                $responseData = json_decode($verifyResponse);
                if(!$captcha){
                    $notify['type'] = "error";
                    $notify['alert'] = 'กรุณากรอก Recaptcah ให้ถูกต้อง';
                }elseif($responseData->success){
                    if (empty($Email)) {
                        $notify['type'] = "error";
                        $notify['alert'] = 'กรุณาอย่าเว้นช่องว่าง';
                    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                        $notify['type'] = "error";
                        $notify['alert'] = 'กรุณาใส่ "Email" ให้ถูกต้อง';
                    }elseif (empty($Password)) {
                        $notify['type'] = "error";
                        $notify['alert'] = 'กรุณาอย่าเว้นช่องว่าง';
                    } elseif (strlen($Password) < 6) {
                        $notify['type'] = "error";
                        $notify['alert'] = 'รหัสผ่านน้อยกว่า 6 ตัวอักษร';
                    } elseif (strlen($ConfirmPassword) < 6) {
                        $notify['type'] = "error";
                        $notify['alert'] = 'รหัสผ่านที่สองน้อยกว่า 6 ตัวอักษร';
                    } elseif ($Password != $ConfirmPassword) {
                        $notify['type'] = "error";
                        $notify['alert'] = 'รหัสผ่านทั้งสองอันไม่ตรงกัน';
                    } else {
                            $this->db->where("Email", $Email);
                            $User_query = $this->db->get("tbl_users");
                            if ($User_query->num_rows()) {
                                $notify['type'] = "error";
                                $notify['alert'] = '"Email" นี้มีอยู่ในระบบแล้วในระบบ';
                            } else {
                                $USER_REGISTER = array(
                                    'Email' => $Email,
                                    'Password' => md5($Password),
                                    'FullName' => 'Angelo - User',
                                );
                                if ($this->db->insert('tbl_users',$USER_REGISTER)) {
                                    $notify['type'] = "success";
                                    $notify['target'] = base_url('sign-in');
                                } else {
                                    $notify['type'] = "error";
                                    $notify['alert'] = 'เกิดข้อผิดพลาดบางอย่าง';
                                }
                            }
                    }
                }else{
                    $notify['type'] = "error";
                    $notify['alert'] = 'มีบางอย่างผิดพลาดเกี่ยวกับ Recaptcha';
                }
            }
            exit(json_encode($notify));
        }
    }

    public function AuthChangPassword(){
        if ($post = $this->input->post() and $this->is_login() != false) {
            $user = $this->is_login();
                extract($post);
                    if (empty($post)) {
                        $notify['type'] = "error";
                        $notify['alert'] = 'กรุณาอย่าเว้นช่องว่าง';
                        $notify['target'] = base_url('Profile/account');
                    } elseif (empty($Password)) {
                        $notify['type'] = "error";
                        $notify['alert'] = 'กรุณาอย่าเว้นช่องว่าง';
                        $notify['target'] = base_url('Profile/account');
                    } elseif (strlen($Password) < 6) {
                        $notify['type'] = "error";
                        $notify['alert'] = 'รหัสผ่านน้อยกว่า 6 ตัวอักษร';
                        $notify['target'] = base_url('Profile/account');
                    } elseif (empty($Address)) {
                        $notify['type'] = "error";
                        $notify['alert'] = 'กรุณาอย่าเว้นช่องว่าง';
                        $notify['target'] = base_url('Profile/account');
                    } elseif (empty($Telephone)) {
                        $notify['type'] = "error";
                        $notify['alert'] = 'กรุณาอย่าเว้นช่องว่าง';
                        $notify['target'] = base_url('Profile/account');
                    } else {
                        $config['upload_path']          = './assets/images/faces/';
                        $config['allowed_types']        = 'gif|jpg|png';
                        $config['max_size']             = 2000;
                        // $config['max_width']            = 150;
                        // $config['max_height']           = 150;

                        $this->load->library('upload', $config);
                        if(!empty($_FILES['avatar_image']['name'])){
                            
                            
                            if($this->upload->do_upload("avatar_image")){
                                
                                $data = array(
                                    'upload_data' => $this->upload->data()
                                );
                                
                                
                                $imgname = $data['upload_data']['file_name'];
                                $data = array(
                                    'Password' => md5($Password),
                                    'Address' => $Address,
                                    'Telephone'  => $Telephone,
                                    'Avatar'  => $imgname,
                                    'FullName'  => $FullName
                                );
                                
                                $this->db->set($data);
                                $this->db->where('Email',$this->session->userdata('email'));
                                if ($this->db->update('tbl_users',)) {
                                    
                                    $notify['type'] = "success";
                                    $notify['alert'] = 'เปลี่ยนรหัสผ่านสำเร็จ';
                                    $notify['target'] = base_url('Profile/account');
                                } else {
                                    
                                    $notify['type'] = "error";
                                    $notify['target'] = base_url('Profile/account');
                                    $notify['alert'] = 'เกิดข้อผิดพลาดบางอย่าง';
                                }
                                
                            }else{
                                
                                $notify['type'] = "error";
                                $notify['target'] = base_url('Profile/account');
                                $notify['alert'] = 'ประเภทรูปหรือขนาดไม่ถูกต้อง';
                            }
                            
                        } else {
                            $data = array(
                                'Password' => md5($Password),
                                'Address' => $Address,
                                'Telephone'  => $Telephone,
                                'FullName'  => $FullName
                            );
                            $this->db->set($data);
                            $this->db->where('Email',$this->session->userdata('email'));
                            if ($this->db->update('tbl_users',)) {
                                $notify['type'] = "success";
                                $notify['target'] = base_url('Profile/account');
                                $notify['alert'] = 'เปลี่ยนรหัสผ่านสำเร็จ';
                            } else {
                                $notify['type'] = "error";
                                $notify['alert'] = 'เกิดข้อผิดพลาดบางอย่าง';
                                $notify['target'] = base_url('Profile/account');
                            }
                        }
                        
                        
                    }
                    $this->main_function->alert($notify['alert'], $notify['type'], $notify['target']);
        }else{
            $notify['type'] = "error";
            $notify['alert'] = 'คุณยังไม่ได้เข้าสู่ระบบ หรือ เข้าลิงค์มาแบบไม่ถูกต้อง';
            $notify['target'] = base_url('sign-in');
            $this->main_function->alert($notify['alert'], $notify['type'], $notify['target']);
        }
    }

    public function InsertGift(){
        if ($post = $this->input->post() and $this->is_login() != false) {
            $user = $this->is_login();
            extract($post);
                    if (empty($post)) {
                        $notify['type'] = "error";
                        $notify['alert'] = 'กรุณาอย่าเว้นช่องว่าง';
                        $notify['target'] = base_url('Online');
                    }elseif(strlen($OnlineWish) < 1){
                        $notify['type'] = "error";
						$notify['alert'] = 'กรุณากรอกข้อมูลคำอวยพร';
                        //$notify['alert'] = 'ตัวอักษรห้ามต่ำกว่า 20 ตัวอักษร';
                        $notify['target'] = base_url('Online');
					 }elseif(strlen($OnlineSender) < 1){
                        $notify['type'] = "error";
						$notify['alert'] = 'กรุณากรอกข้อมูลชื่อผู้ส่ง';
                        //$notify['alert'] = 'ตัวอักษรห้ามต่ำกว่า 20 ตัวอักษร';
                        $notify['target'] = base_url('Online');
					}elseif(strlen($OnlineRev) < 1){
                        $notify['type'] = "error";
						$notify['alert'] = 'กรุณากรอกข้อมูลชื่อผู้รับ';
                        //$notify['alert'] = 'ตัวอักษรห้ามต่ำกว่า 20 ตัวอักษร';
                        $notify['target'] = base_url('Online');
                    /*}elseif(empty($Online_avatar)){
                        $notify['type'] = "error";
                        $notify['alert'] = 'กรุณาเลือกภาพ Avatar';
                        $notify['target'] = base_url('Online');*/
                    }else {
                        if (empty($OnlineLink)) {
                            $OnlineLink = '';
                        }
                        $config['upload_path'] = './assets/images/gift/';
                        //$config['max_size'] = '1028';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $this->load->library('upload', $config);
                        
                        if(!empty($_FILES['Online_img']['name'])){
                            if($this->upload->do_upload("Online_img")){
                                $data = array(
                                    'upload_data' => $this->upload->data()
                                );
                                $imgname = $data['upload_data']['file_name'];
                                $datas = array(
                                    'OnlineSender' => $OnlineSender,
                                    'OnlineRev' => $OnlineRev,
                                    'OnlineWish' => $OnlineWish,
                                    'OnlineLink' => $OnlineLink,
                                    'OnlineIMG' => $imgname,
                                    'OnlineAvatar' => $Online_avatar,
                                    'OnlineOwned' => $this->session->userdata('email'),
                                );
                                $cover_image = $this->resizeImage($data['upload_data'],150,150);
                            }else{
                                
                                $notify['type'] = "error";
                                $notify['target'] = base_url('Online');
                                $notify['alert'] = 'ประเภทรูปหรือขนาดไม่ถูกต้อง | '.$this->upload->display_errors();
                            }
                        } else {
                            $datas = array(
                                'OnlineSender' => $OnlineSender,
                                'OnlineRev' => $OnlineRev,
                                'OnlineWish' => $OnlineWish,
                                'OnlineLink' => $OnlineLink,
                                'OnlineAvatar' => $Online_avatar,
                                'OnlineOwned' => $this->session->userdata('email'),
                            );
                        }
                        if ($this->db->insert('tbl_online',$datas)) {
                            $notify['type'] = "success";
                            $notify['alert'] = 'ทำรายการสำเร็จ';
                            $notify['target'] = base_url('Online');
                        } else {
                            $notify['type'] = "error";
                            $notify['target'] = base_url('Online');
                            $notify['alert'] = 'เกิดข้อผิดพลาดบางอย่าง';
                        }
                        
                    }
                    $this->main_function->alert($notify['alert'], $notify['type'], $notify['target']);
        }else{
            $notify['type'] = "error";
            $notify['alert'] = 'คุณยังไม่ได้เข้าสู่ระบบ หรือ เข้าลิงค์มาแบบไม่ถูกต้อง';
            $notify['target'] = base_url('sign-in');
            $this->main_function->alert($notify['alert'], $notify['type'], $notify['target']);
            die();
        }
    }

    public function AuthSignout(){
        if(!empty($this->session->userdata('login-state'))){
            $array_items = array('login-state', 'email');
            $this->session->unset_userdata($array_items);
            redirect(base_url(''),'location');
        }
    }

    public function process_topup()
	{
        if($post = $this->input->post() and $this->is_login()){
            $user = $this->is_login();
			extract($post);
            if(empty($post)){
                $notify['type'] = "warning";
                $notify['target'] = '';
                $notify['alert'] = 'กรุณาอย่าเว้นช่องว่าง';
            }elseif(empty($amounts)){
                $notify['type'] = "warning";
                $notify['target'] = '';
                $notify['alert'] = 'กรุณาอย่าเว้นช่องว่าง';
            }elseif(empty($time)){
                $notify['type'] = "warning";
                $notify['target'] = '';
                $notify['alert'] = 'กรุณาอย่าเว้นช่องว่าง';
            }else{
                if(!empty($_FILES['files']['name'])){

                    $config_img = array(
                        'allowed_types' => 'jpg|png|jpeg',
                        'upload_path' => './assets/images/Payment/',
                        'file_name' => $_FILES['files']['name']
                    );
                    $this->load->library('upload', $config_img,'upload_img');
                    $this->upload_img->initialize($config_img);

                    if($this->upload_img->do_upload("files")){
                        
                        $data = array( 'upload_data' => $this->upload_img->data() );
                        $updates['Topup_img'] =  $data['upload_data']['file_name'];

                        $updates['Topup_User'] =  $user[0]->Email;
                        $updates['Topup_Amount'] =  $amounts;
                        $updates['Topup_Time'] =  $time;
                        $updates['Topup_order'] =  $order_id;
        
                        if($this->db->insert('tbl_paynment',$updates) and  $this->db->where('OrderID',$order_id)->set('Order_status',1)->update('tbl_order_detail')){
                            $notify['type'] = "success";
                            $notify['target'] = '';
                            $notify['alert'] = 'ทำรายการสำเร็จ';
                        }else{
                            $notify['type'] = "error";
                            $notify['target'] = '';
                            $notify['alert'] = 'เกิดข้อผิดพลาดทาง SQL';
                        }
                        
                    }else{
                        $notify['type'] = "error";
                        $notify['target'] = base_url('/topup');
                        $notify['alert'] = 'ประเภทรูปหรือขนาดไม่ถูกต้อง';
                    }
                }else{
                    $notify['type'] = "warning";
                    $notify['target'] = '';
                    $notify['alert'] = 'กรุณาอัพโหลดรูปภาพก่อนทำรายการ';
                }
            }
        }else{
            $notify['type'] = "error";
            $notify['target'] = base_url('sign-in');
            $notify['alert'] = 'เกิดข้อผิดพลาดกรุณา Login ก่อน';
        }
        exit(json_encode($notify));
	}

    public function cart_process_two(){
        if ($post = $this->input->post() and $this->is_login() != false) {
            $user = $this->is_login();
            extract($post);
            if(empty($post)){
                $notify['type'] = "error";
                $notify['alert'] = 'กรุณาอย่าเว้นช่องว่าง';
            }elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                $notify['type'] = "error";
                $notify['alert'] = 'กรุณาใส่ "Email" ให้ถูกต้อง';
            }else{
                
                $UNIQUEID = time() . mt_rand() . $this->session->userdata('UserID');
                //บันทึกการสั่งซื้อลงใน order_detail
                $INSERT_ORDER_DETAIL = array(
                    'Order_Email' => $Email,
                    'Order_FullName' => $FullName,
                    'Order_Address' => $Address,
                    'Order_Telephone' => $Telephone,
                    'Order_Dttm' => Date("Y-m-d G:i:s"),
                    'Order_QtyTotal' => $QTY_TOTAL,
                    'Order_PriceTotal' => $PRICE_TOTAL,
                    'Order_Number' => $UNIQUEID,
                    'Order_Owned' => $this->session->userdata('email'),
                );
                $this->db->insert('tbl_order_detail',$INSERT_ORDER_DETAIL);
                $INSERT_LASTID = $this->db->insert_id();
                foreach(@$_SESSION['CART'] as $ProductID => $QTY)
                {
                    $this->db->where('Product_id',$ProductID);
                    $ProductSQL = $this->db->get('tbl_product');
                    $peoductResult = $ProductSQL->result();
                    $SUM_PRICE	= $peoductResult[0]->Product_price * $QTY;

                    $INSERT_ORDER = array(
                        'Orders_OrderID' => $INSERT_LASTID,
                        'Orders_Product' => $ProductID,
                        'Orders_Qty' => $QTY,
                        'Orders_Price' => $SUM_PRICE,
                        'Orders_Number' => $UNIQUEID,
                    );
                    $this->db->insert('tbl_orders',$INSERT_ORDER);
                }
                unset($_SESSION['CART']);
                $notify['type'] = "success";
                $notify['target'] = base_url('Profile/myorder');
            }
        }else{
            $notify['type'] = "error";
            $notify['alert'] = 'คุณยังไม่ได้เข้าสู่ระบบ หรือ เข้าลิงค์มาแบบไม่ถูกต้อง';
            $notify['target'] = base_url('sign-in');
            $this->main_function->alert($notify['alert'], $notify['type'], $notify['target']);
            die();
        }
        exit(json_encode($notify));
    }

    public function product_cart_process(){
        if ($get = $this->input->get() and $this->is_login() != false) {
            $user = $this->is_login();
            extract($get);
            if(empty($productid)){
                $notify = array(
                    'alert' => 'error',
                    'text' => 'ERROR|productid_get',
                    'url' => false,
                );
            }elseif(empty($action)){
                $notify = array(
                    'alert' => 'error',
                    'text' => 'ERROR|action_get',
                    'url' => false,
                );
            }else{
                $notify = array(
                    'alert' => 'success',
                    'text' => 'SUCCESS|NOT_NULL',
                    'url' => false,
                );

                if($action=='add' && !empty($productid))
                {
                    
                    if(isset($_SESSION['CART'][$productid]))
                    {
                        $_SESSION['CART'][$productid]++;
                    }
                    else
                    {
                        $_SESSION['CART'][$productid]=1;
                    }
                    
                }
             
                if($action=='remove' && !empty($productid))  //ยกเลิกการสั่งซื้อ
                {
                    unset($_SESSION['CART'][$productid]);
                }
             
                if($action =='update' && !empty($amount))
                {
                    echo $amount;
                    if($amount == 0){
                        unset($_SESSION['CART'][$productid]); 
                    }else{
                        $amount_array = array($productid => $amount);
                        foreach($amount_array as $productid => $amounts)
                        {
                            $_SESSION['CART'][$productid]=$amounts;
                        }
                    }
                }
            }
            var_dump($_SESSION['CART']);
            //exit(var_dump($notify));
        }else{
            $notify['type'] = "error";
            $notify['alert'] = 'คุณยังไม่ได้เข้าสู่ระบบ หรือ เข้าลิงค์มาแบบไม่ถูกต้อง';
            $notify['target'] = base_url('sign-in');
            $this->main_function->alert($notify['alert'], $notify['type'], $notify['target']);
            die();
        }
    }
    
    public function get_total_price(){
        if ($post = $this->input->post() and $this->is_login() != false) {
            $user = $this->is_login();
            extract($post);
            $TOTAL_PRICE = 0;
            $TOTAL_QTY = 0;
            foreach($_SESSION['CART'] as $ProductID => $QTY)
            {
                $this->db->where('Product_id',$ProductID);
                $ProductSQL = $this->db->get('tbl_product');
                $peoductResult = $ProductSQL->result();
                $SUM_PRICE	= $peoductResult[0]->Product_price * $QTY;
                $TOTAL_PRICE	+= $SUM_PRICE;
                $TOTAL_QTY	+= $QTY;
            }
        }else{
            $notify['type'] = "error";
            $notify['alert'] = 'คุณยังไม่ได้เข้าสู่ระบบ หรือ เข้าลิงค์มาแบบไม่ถูกต้อง';
            $notify['target'] = base_url('sign-in');
            $this->main_function->alert($notify['alert'], $notify['type'], $notify['target']);
            die();
        }
        $print = array(
            'total_price' => number_format($TOTAL_PRICE,2),
            'total_qty' => $TOTAL_QTY
        );
        exit(json_encode($print));
    }

    public function product_edit(){
        if ($post = $this->input->post() and $this->is_login() != false) {
            $user = $this->is_login();
            extract($post);
            if($user[0]->Role == 'superadmin'){
                $config['upload_path']          = './assets/images/product/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2000;
                // $config['max_width']            = 150;
                // $config['max_height']           = 150;

                $this->load->library('upload', $config);
                if(!empty($_FILES['product_img']['name'])){
                    
                    if($this->upload->do_upload("product_img")){
                        
                        $data = array(
                            'upload_data' => $this->upload->data()
                        );
                        
                        $imgname = $data['upload_data']['file_name'];
                        $UPDATE_PEODUCTS = array(
                            'Product_youtube' => $youtube,
                            'Product_name' => $name_product,
                            'Product_detail' => $detail,
                            'Product_description' => $description,
                            'Product_price' => $price,
                            'Product_stocker' => $stocker,
                            'Product_img' => $imgname,
                            'Product_category' => $category,
                        );
                    
                    }else{
                        $notify['type'] = "error";
                        $notify['alert'] = 'เกิดข้อผืดพลาดในการอัพโหลดไฟล์ภาพ ขนาดอาจใหญ่เกินไป';
                        $notify['target'] = base_url('Backend/manager/product/edit/'.$Product_id);
                        $this->main_function->alert($notify['alert'], $notify['type'], $notify['target']);
                        die();
                    }
                }else{
                    $UPDATE_PEODUCTS = array(
                        'Product_youtube' => $youtube,
                        'Product_name' => $name_product,
                        'Product_detail' => $detail,
                        'Product_description' => $description,
                        'Product_price' => $price,
                        'Product_stocker' => $stocker,
                        'Product_category' => $category,
                        //'Product_img' => $images,
                    );
                }
                $this->db->where('Product_id',$Product_id);
                $this->db->set($UPDATE_PEODUCTS);
                if($this->db->update('tbl_product')){
                    $notify['type'] = "success";
                    $notify['alert'] = 'อัพเดทข้อมูลสำเร็จ';
                    $notify['target'] = base_url('Backend/manager/product/edit/'.$Product_id);
                }else{
                    $notify['type'] = "error";
                    $notify['alert'] = 'เกิดข้อผิดพลาดบางอย่าง';
                    $notify['target'] = base_url('Backend/manager/product/edit/'.$Product_id);
                }
            }else{
                $notify['type'] = "error";
                $notify['alert'] = 'คุณไม่ใช่ยศแอดมิน';
                $notify['target'] = base_url('sign-in');
            }
            
        }else{
            $notify['type'] = "error";
            $notify['alert'] = 'กรุณาเข้าสู่ระบบก่อน';
            $notify['target'] = base_url('sign-in');
        }
        $this->main_function->alert($notify['alert'], $notify['type'], $notify['target']);
    }

    public function product_add(){
        if ($post = $this->input->post() and $this->is_login() != false) {
            $user = $this->is_login();
            extract($post);
            if($user[0]->Role == 'superadmin'){
                $config['upload_path']          = './assets/images/product/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2000;
                // $config['max_width']            = 150;
                // $config['max_height']           = 150;

                $this->load->library('upload', $config);
                if(!empty($_FILES['product_img']['name'])){
                    
                    if($this->upload->do_upload("product_img")){
                        
                        $data = array(
                            'upload_data' => $this->upload->data()
                        );
                        
                        $imgname = $data['upload_data']['file_name'];
                        $INSERT_PEODUCTS = array(
                            'Product_youtube' => $youtube,
                            'Product_name' => $name_product,
                            'Product_detail' => $detail,
                            'Product_description' => $description,
                            'Product_price' => $price,
                            'Product_stocker' => $stocker,
                            'Product_img' => $imgname,
                            'Product_category' => $category,
                        );
                        if($this->db->insert('tbl_product',$INSERT_PEODUCTS)){
                            $notify['type'] = "success";
                            $notify['alert'] = 'เพิ่มสินค้าสำเร็จ';
                            $notify['target'] = base_url('Backend/manager/product/add');
                        }else{
                            $notify['type'] = "error";
                            $notify['alert'] = 'เกิดข้อผิดพลาดบางอย่าง';
                            $notify['target'] = base_url('Backend/manager/product/add');
                        }
                    }else{
                        $notify['type'] = "error";
                        $notify['alert'] = 'เกิดข้อผืดพลาดในการอัพโหลดไฟล์ภาพ ขนาดอาจใหญ่เกินไป';
                        $notify['target'] = base_url('Backend/manager/product/add');
                        $this->main_function->alert($notify['alert'], $notify['type'], $notify['target']);
                        die();
                    }
                    
                }else{
                    $notify['type'] = "error";
                    $notify['alert'] = 'กรุณาอัพโหลดไฟล์ภาพ';
                    $notify['target'] = base_url('Backend/manager/product/add');
                    $this->main_function->alert($notify['alert'], $notify['type'], $notify['target']);
                    die();
                }
            }else{
                $notify['type'] = "error";
                $notify['alert'] = 'คุณไม่ใช่ยศแอดมิน';
                $notify['target'] = base_url('sign-in');
            }
            
        }else{
            $notify['type'] = "error";
            $notify['alert'] = 'กรุณาเข้าสู่ระบบก่อน';
            $notify['target'] = base_url('sign-in');
        }
        $this->main_function->alert($notify['alert'], $notify['type'], $notify['target']);
    }
    public function product_delete(){
        if ($post = $this->input->post() and $this->is_login() != false) {
            $user = $this->is_login();
            extract($post);
            if($user[0]->Role == 'superadmin'){
                $this->db->where('Product_id',$id);
                if($this->db->delete('tbl_product')){
                    $notify['type'] = "success";
                    $notify['alert'] = 'ทำรายการสำเร็จ';
                    $notify['target'] = base_url('Backend/manager/product');
                }else{
                    $notify['type'] = "error";
                    $notify['alert'] = 'เกิดข้อผิดพลาดบางอย่าง';
                    $notify['target'] = base_url('Backend/manager/product');
                }
            }else{
                $notify['type'] = "error";
                $notify['alert'] = 'คุณไม่ใช่ยศแอดมิน';
                $notify['target'] = base_url('sign-in');
            }
            
        }else{
            $notify['type'] = "error";
            $notify['alert'] = 'กรุณาเข้าสู่ระบบก่อน';
            $notify['target'] = base_url('sign-in');
            
        }
        exit(json_encode($notify));
    }

    public function category_add(){
        if ($post = $this->input->post() and $this->is_login() != false) {
            $user = $this->is_login();
            extract($post);
            if($user[0]->Role == 'superadmin'){
                $INSERT_CATEGORYS = array(
                    'CategiryName' => $category_name,
                );
                if($this->db->insert('tbl_category',$INSERT_CATEGORYS)){
                    $notify['type'] = "success";
                    $notify['alert'] = 'อัพเดทข้อมูลสำเร็จ';
                    $notify['target'] = base_url('Backend/manager/category');
                }else{
                    $notify['type'] = "error";
                    $notify['alert'] = 'เกิดข้อผิดพลาดบางอย่าง';
                    $notify['target'] = base_url('Backend/manager/category');
                }
            }else{
                $notify['type'] = "error";
                $notify['alert'] = 'คุณไม่ใช่ยศแอดมิน';
                $notify['target'] = base_url('sign-in');
            }
            
        }else{
            $notify['type'] = "error";
            $notify['alert'] = 'กรุณาเข้าสู่ระบบก่อน';
            $notify['target'] = base_url('sign-in');
        }
        $this->main_function->alert($notify['alert'], $notify['type'], $notify['target']);
    }
    public function category_edit(){
        if ($post = $this->input->post() and $this->is_login() != false) {
            $user = $this->is_login();
            extract($post);
            if($user[0]->Role == 'superadmin'){
                $UPDATE_CATEGORYS = array(
                    'CategiryName' => $category_name,
                );
                $this->db->where('CategoryID',$category_id);
                $this->db->set($UPDATE_CATEGORYS);
                if($this->db->update('tbl_category')){
                    $notify['type'] = "success";
                    $notify['alert'] = 'อัพเดทข้อมูลสำเร็จ';
                    $notify['target'] = base_url('Backend/manager/category');
                }else{
                    $notify['type'] = "error";
                    $notify['alert'] = 'เกิดข้อผิดพลาดบางอย่าง';
                    $notify['target'] = base_url('Backend/manager/category');
                }
            }else{
                $notify['type'] = "error";
                $notify['alert'] = 'คุณไม่ใช่ยศแอดมิน';
                $notify['target'] = base_url('sign-in');
            }
            
        }else{
            $notify['type'] = "error";
            $notify['alert'] = 'กรุณาเข้าสู่ระบบก่อน';
            $notify['target'] = base_url('sign-in');
        }
        $this->main_function->alert($notify['alert'], $notify['type'], $notify['target']);
    }

    public function order_update(){
        if ($post = $this->input->post() and $this->is_login() != false) {
            $user = $this->is_login();
            extract($post);
            if($user[0]->Role == 'superadmin'){
                if($status_order == 'not'){
                    $notify['type'] = "error";
                    $notify['alert'] = 'กรุณาเลือกสถานะ';
                    $notify['target'] = base_url('Backend/manager/orders_detail/'.$order_id);
                }else{
                    $UPDATE_ORDERS = array(
                        'Order_status' => $status_order,
                    );
                    $this->db->where('OrderID',$order_id);
                    $this->db->set($UPDATE_ORDERS);
                    if($this->db->update('tbl_order_detail')){
                        if($status_order == 1){

                            $this->db->where('Orders_OrderID',$order_id);
                            $ORDER_SQL = $this->db->get('tbl_orders');
                            echo 'ID: '.$order_id;
                            foreach($ORDER_SQL->result() as $ORDER){
                                $this->db->where('Product_id',$ORDER->Orders_Product);
                                $PRODUCT_SQL = $this->db->get('tbl_product');
                                $PRODUCT = $PRODUCT_SQL->result();
                                if($PRODUCT[0]->Product_stocker >= 1){
                                    $this->db->set('Product_stocker',($PRODUCT[0]->Product_stocker - $ORDER->Orders_Qty));
                                    $this->db->where('Product_id',$ORDER->Orders_Product);
                                    $this->db->update('tbl_product');
                                }else{
                                    break;
                                }
                            }
                        }
                        $notify['type'] = "success";
                        $notify['alert'] = 'อัพเดทข้อมูลสำเร็จ';
                        $notify['target'] = base_url('Backend/manager/orders_detail/'.$order_id);
                    }else{
                        $notify['type'] = "error";
                        $notify['alert'] = 'เกิดข้อผิดพลาดบางอย่าง';
                        $notify['target'] = base_url('Backend/manager/orders_detail/'.$order_id);
                    }
                }
            }else{
                $notify['type'] = "error";
                $notify['alert'] = 'คุณไม่ใช่ยศแอดมิน';
                $notify['target'] = base_url('sign-in');
            }
            
        }else{
            $notify['type'] = "error";
            $notify['alert'] = 'กรุณาเข้าสู่ระบบก่อน';
            $notify['target'] = base_url('sign-in');
        }
        exit(json_encode($notify));
    }

    public function category_delete(){
        if ($post = $this->input->post() and $this->is_login() != false) {
            $user = $this->is_login();
            extract($post);
            if($user[0]->Role == 'superadmin'){
                $this->db->where('CategoryID',$id);
                if($this->db->delete('tbl_category')){
                    $notify['type'] = "success";
                    $notify['alert'] = 'ทำรายการสำเร็จ';
                    $notify['target'] = base_url('Backend/manager/category');
                }else{
                    $notify['type'] = "error";
                    $notify['alert'] = 'เกิดข้อผิดพลาดบางอย่าง';
                    $notify['target'] = base_url('Backend/manager/category');
                }
            }else{
                $notify['type'] = "error";
                $notify['alert'] = 'คุณไม่ใช่ยศแอดมิน';
                $notify['target'] = base_url('sign-in');
            }
            
        }else{
            $notify['type'] = "error";
            $notify['alert'] = 'กรุณาเข้าสู่ระบบก่อน';
            $notify['target'] = base_url('sign-in');
            
        }
        exit(json_encode($notify));
    }
    public function online_delete(){
        if ($post = $this->input->post() and $this->is_login() != false) {
            $user = $this->is_login();
            extract($post);
            if($user[0]->Role == 'superadmin'){
                $this->db->where('OnlineID',$id);
                if($this->db->delete('tbl_online')){
                    $notify['type'] = "success";
                    $notify['alert'] = 'ทำรายการสำเร็จ';
                    $notify['target'] = base_url('Backend/manager/online');
                }else{
                    $notify['type'] = "error";
                    $notify['alert'] = 'เกิดข้อผิดพลาดบางอย่าง';
                    $notify['target'] = base_url('Backend/manager/online');
                }
            }else{
                $notify['type'] = "error";
                $notify['alert'] = 'คุณไม่ใช่ยศแอดมิน';
                $notify['target'] = base_url('sign-in');
            }
            
        }else{
            $notify['type'] = "error";
            $notify['alert'] = 'กรุณาเข้าสู่ระบบก่อน';
            $notify['target'] = base_url('sign-in');
            
        }
        exit(json_encode($notify));
    }
    
    public function orders_delete(){
        if ($post = $this->input->post() and $this->is_login() != false) {
            $user = $this->is_login();
            extract($post);
            if($user[0]->Role == 'superadmin'){
                if($this->db->where('OrderID',$id)->delete('tbl_order_detail') and $this->db->where('Topup_order',$id)->delete('tbl_paynment')){
                    $notify['type'] = "success";
                    $notify['alert'] = 'ทำรายการสำเร็จ';
                    $notify['target'] = base_url('Backend/manager/orders');
                }else{
                    $notify['type'] = "error";
                    $notify['alert'] = 'เกิดข้อผิดพลาดบางอย่าง';
                    $notify['target'] = base_url('Backend/manager/orders');
                }
            }else{
                $notify['type'] = "error";
                $notify['alert'] = 'คุณไม่ใช่ยศแอดมิน';
                $notify['target'] = base_url('sign-in');
            }
            
        }else{
            $notify['type'] = "error";
            $notify['alert'] = 'กรุณาเข้าสู่ระบบก่อน';
            $notify['target'] = base_url('sign-in');
            
        }
        exit(json_encode($notify));
    }
}
