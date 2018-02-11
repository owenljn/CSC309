<?php
class email_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
		

    function order_confirmation()
    {
            
        
        $msg    = '<P> Dear '. $this->session->userdata('first').'</p>';
        $msg    .='<p> Thank you for placing order online at the baseball store. Your order has been received and will be processed shortly</p>';
        $msg    .='<p>Your order ID :'.$this->session->userdata('order_id').'</p>';
        $msg    .='<p><a href="'.base_url().'index.php/front/login">Login & Check Order Details Online</a></p>';
        $msg    .='<p> Thank You<br /> the baseball cards store</p>';
        $subject = "Thank you for your order @ the baseball store";
        $this->send_email($this->session->userdata('email'),$subject,$msg);
        
    }
    
    
	
    
    
	function send_email($email,$subject,$msg)
{
    $config = Array(
  'protocol' => 'smtp',
  'smtp_host' => 'ssl://smtp.googlemail.com',
  'smtp_port' => 465,
  'smtp_user' => 'thebaseballcardstore@gmail.com', 
  'smtp_pass' => 'bhui@234', 
  'mailtype' => 'html',
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE
);

       
        $this->load->library('email', $config);
      $this->email->set_newline("\r\n");
      $this->email->from('xxx@gmail.com'); 
      $this->email->to($email);
      $this->email->subject($subject);
      $this->email->message($msg);
      if($this->email->send())
     {
      echo 'Email sent.';
     }
     else
    {
     show_error($this->email->print_debugger());
    }

}	
}