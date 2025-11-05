<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

	 
	public function account_head_list()
	{
	    if(!$this->session->userdata('cr_logged_in'))  redirect();
        
        if($this->session->userdata('cr_user_type') != 'Admin' ) 
        { 
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }  
        	    
        $data['js'] = 'accounts/account-head.inc';  
        
        if($this->input->post('mode') == 'Add')
        {
            $ins = array(
                    'franchise_id' => ($this->session->userdata('cr_franchise_id') == '' ? 0 : $this->session->userdata('cr_franchise_id')),
                    'account_head_name' => $this->input->post('account_head_name'),
                    'type' => $this->input->post('type'),
                    'status' => $this->input->post('status'),
                    'created_by' => $this->session->userdata('cr_user_id'),                          
                    'created_datetime' => date('Y-m-d H:i:s')                            
            );
            
            //print_r($ins); exit;
            
            $this->db->insert('crit_account_head_info', $ins); 
            redirect('account-head-list');
        }
        
        if($this->input->post('mode') == 'Edit')
        {
            $upd = array(
                    'franchise_id' => ($this->session->userdata('cr_franchise_id') == '' ? 0 : $this->session->userdata('cr_franchise_id')),
                    'account_head_name' => $this->input->post('account_head_name'),
                    'type' => $this->input->post('type'),
                    'status' => $this->input->post('status'),
                    'updated_by' => $this->session->userdata('cr_user_id'),                          
                    'updated_datetime' => date('Y-m-d H:i:s')              
            );
            
            $this->db->where('account_head_id', $this->input->post('account_head_id'));
            $this->db->update('crit_account_head_info', $upd); 
                            
            redirect('account-head-list/' . $this->uri->segment(2, 0)); 
        } 
         
        
        $this->load->library('pagination'); 
        
        
        $this->db->where('status != ', 'Delete'); 
        $this->db->from('crit_account_head_info');         
        $data['total_records'] = $cnt  = $this->db->count_all_results();  
        
        $data['sno'] = $this->uri->segment(2, 0);		
        	
        $config['base_url'] = trim(site_url('account-head-list/'), '/'. $this->uri->segment(2, 0));
        $config['total_rows'] = $cnt;
        $config['per_page'] = 25;
        $config['uri_segment'] = 2;
        //$config['num_links'] = 2; 
        $config['attributes'] = array('class' => 'page-link');
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] =  "Prev";
        $config['next_link'] =  "Next";
        $this->pagination->initialize($config);   
        
        $sql = "
                select 
                a.*
                from crit_account_head_info as a 
                where status != 'Delete'
                order by a.status asc , a.account_head_name asc 
                limit ". $this->uri->segment(2, 0) .",". $config['per_page'] ."                
        ";
        
       
        
        $query = $this->db->query($sql);
        
        $data['record_list'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['record_list'][] = $row;     
        }
        
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('page/accounts/account-head-list',$data); 
	}
    
    
    public function sub_account_head_list()
	{
	   if(!$this->session->userdata('cr_logged_in'))  redirect();
        
       if($this->session->userdata('cr_user_type') != 'Admin' ) 
        { 
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }  
        	    
        $data['js'] = 'accounts/sub-account-head.inc';  
        
        if($this->input->post('mode') == 'Add')
        {
            $ins = array(
                    'franchise_id' => ($this->session->userdata('cr_franchise_id') == '' ? 0 : $this->session->userdata('cr_franchise_id')),
                    'account_head_id' => $this->input->post('account_head_id'),
                    'sub_account_head_name' => $this->input->post('sub_account_head_name'),
                    'type' => $this->input->post('type'),
                    'status' => $this->input->post('status'),
                    'created_by' => $this->session->userdata('cr_user_id'),                          
                    'created_datetime' => date('Y-m-d H:i:s')                            
            );
            
            //print_r($ins); exit;
            
            $this->db->insert('crit_sub_account_head_info', $ins); 
            redirect('sub-account-head-list');
        }
        
        if($this->input->post('mode') == 'Edit')
        {
            $upd = array(
                    'franchise_id' => ($this->session->userdata('cr_franchise_id') == '' ? 0 : $this->session->userdata('cr_franchise_id')),
                    'account_head_id' => $this->input->post('account_head_id'),
                    'sub_account_head_name' => $this->input->post('sub_account_head_name'),
                    'type' => $this->input->post('type'),
                    'status' => $this->input->post('status'),
                    'updated_by' => $this->session->userdata('cr_user_id'),                          
                    'updated_datetime' => date('Y-m-d H:i:s')              
            );
            
            $this->db->where('sub_account_head_id', $this->input->post('sub_account_head_id'));
            $this->db->update('crit_sub_account_head_info', $upd); 
                            
            redirect('sub-account-head-list/' . $this->uri->segment(2, 0)); 
        } 
         
          
         
        
        $this->load->library('pagination'); 
        
        
        $this->db->where('status != ', 'Delete'); 
        $this->db->from('crit_sub_account_head_info');         
        $data['total_records'] = $cnt  = $this->db->count_all_results();  
        
        $data['sno'] = $this->uri->segment(2, 0);		
        	
        $config['base_url'] = trim(site_url('sub-account-head-list/'), '/'. $this->uri->segment(2, 0));
        $config['total_rows'] = $cnt;
        $config['per_page'] = 25;
        $config['uri_segment'] = 2;
        //$config['num_links'] = 2; 
        $config['attributes'] = array('class' => 'page-link');
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] =  "Prev";
        $config['next_link'] =  "Next";
        $this->pagination->initialize($config);   
        
        $sql = "
                select 
                a.*,
                b.account_head_name
                from crit_sub_account_head_info as a 
                left join crit_account_head_info as b on b.account_head_id = a.account_head_id
                where a.status != 'Delete' and b.status != 'Delete'
                order by a.status asc , b.account_head_name , a.sub_account_head_name asc 
                limit ". $this->uri->segment(2, 0) .",". $config['per_page'] ."                
        "; 
        
        $query = $this->db->query($sql);
        
        $data['record_list'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['record_list'][] = $row;     
        }
        
        
        
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('page/accounts/sub-account-head-list',$data); 
	}
    
    public function account_head_for_list()
    {        
    
	   if(!$this->session->userdata('cr_logged_in'))  redirect();
        
       if($this->session->userdata('cr_user_type') != 'Admin' ) 
        { 
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }  
        	    
        $data['js'] = 'accounts/account-head-for-list.inc';  
        
        if($this->input->post('mode') == 'Add')
        {
            $ins = array(
                    'account_head_id' => $this->input->post('account_head_id'),
                    'sub_account_head_id' => $this->input->post('sub_account_head_id'),
                    'sub_account_headlvl3_name' => $this->input->post('sub_account_headlvl3_name'),
                    'type' => $this->input->post('type'),
                    'status' => $this->input->post('status'),
                    'created_by' => $this->session->userdata('cr_user_id'),                          
                    'created_datetime' => date('Y-m-d H:i:s')                            
            );
            
            //print_r($ins); exit;
            
            $this->db->insert('sub_account_head_lvl3_info', $ins); 
            redirect('account-head-for-list');
        }
        
        if($this->input->post('mode') == 'Edit')
        {
            $upd = array(
                    'account_head_id' => $this->input->post('account_head_id'),
                    'sub_account_head_id' => $this->input->post('sub_account_head_id'),
                    'sub_account_headlvl3_name' => $this->input->post('sub_account_headlvl3_name'),
                    'type' => $this->input->post('type'),
                    'status' => $this->input->post('status'),
                    'updated_by' => $this->session->userdata('cr_user_id'),                          
                    'updated_datetime' => date('Y-m-d H:i:s')              
            );
            
            $this->db->where('sub_account_headlvl3_id', $this->input->post('sub_account_headlvl3_id'));
            $this->db->update('sub_account_head_lvl3_info', $upd); 
                            
            redirect('account-head-for-list/' . $this->uri->segment(2, 0)); 
        } 
         
          
         
        
        $this->load->library('pagination'); 
        
        
        $this->db->where('status != ', 'Delete'); 
        $this->db->from('sub_account_head_lvl3_info');         
        $data['total_records'] = $cnt  = $this->db->count_all_results();  
        
        $data['sno'] = $this->uri->segment(2, 0);		
        	
        $config['base_url'] = trim(site_url('account-head-for-list/'), '/'. $this->uri->segment(2, 0));
        $config['total_rows'] = $cnt;
        $config['per_page'] = 25;
        $config['uri_segment'] = 2;
        //$config['num_links'] = 2; 
        $config['attributes'] = array('class' => 'page-link');
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] =  "Prev";
        $config['next_link'] =  "Next";
        $this->pagination->initialize($config);   
        
        $sql = "
                select 
                a.*,
                b.account_head_name,
                c.sub_account_head_name
                from sub_account_head_lvl3_info as a 
                left join crit_account_head_info as b on b.account_head_id = a.account_head_id
                left join crit_sub_account_head_info as c on c.sub_account_head_id = a.sub_account_head_id
                where a.status != 'Delete' and b.status != 'Delete'
                order by a.status asc , b.account_head_name , c.sub_account_head_name , a.sub_account_headlvl3_name asc 
                limit ". $this->uri->segment(2, 0) .",". $config['per_page'] ."                
        "; 
        
        $query = $this->db->query($sql);
        
        $data['record_list'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['record_list'][] = $row;     
        }
                
        
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('page/accounts/account-head-for-list',$data); 
        
    }

    public function cash_inward_list()
	{
	    if(!$this->session->userdata('cr_logged_in'))  redirect();
        
        /*if($this->session->userdata('m_is_admin') != USER_ADMIN) 
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }  */
        	    
        $data['js'] = 'accounts/cash-inward.inc';  
        
        if($this->input->post('mode') == 'Add')
        {
            $ins = array(
                    'franchise_id' => ($this->session->userdata('cr_franchise_id') == '' ? 0 : $this->session->userdata('cr_franchise_id')),
                   // 'agent_id' => $this->input->post('agent_id'),
                    'voucher_type_id' => $this->input->post('voucher_type_id'),
                    'inward_date' => $this->input->post('inward_date'),
                    'ac_type' => $this->input->post('ac_type'),
                    'account_head_id' => $this->input->post('account_head_id'),
                    'sub_account_head_id' => $this->input->post('sub_account_head_id'),
                    'sub_account_headlvl3_id' => $this->input->post('sub_account_headlvl3_id'),
                    'amount' => $this->input->post('amount'),
                    'remarks' => $this->input->post('remarks'),
                    'status' => $this->input->post('status'),
                    'created_by' => $this->session->userdata('cr_user_id'),                          
                    'created_datetime' => date('Y-m-d H:i:s')                            
            );
            
            //print_r($ins); exit;
            
            $this->db->insert('crit_cash_inward_info', $ins); 
            redirect('cash-inward-list');
        }
        
        if($this->input->post('mode') == 'Edit')
        {
            $upd = array(
                    'franchise_id' => ($this->session->userdata('cr_franchise_id') == '' ? 0 : $this->session->userdata('cr_franchise_id')),
                    //'agent_id' => $this->input->post('agent_id'),
                    'voucher_type_id' => $this->input->post('voucher_type_id'),
                    'inward_date' => $this->input->post('inward_date'),
                    'vno' => $this->input->post('vno'),
                    'ac_type' => $this->input->post('ac_type'),
                    'account_head_id' => $this->input->post('account_head_id'),
                    'sub_account_head_id' => $this->input->post('sub_account_head_id'),
                    'sub_account_headlvl3_id' => $this->input->post('sub_account_headlvl3_id'),
                    'amount' => $this->input->post('amount'),
                    'remarks' => $this->input->post('remarks'),
                    'status' => $this->input->post('status'),
                    'updated_by' => $this->session->userdata('cr_user_id'),                          
                    'updated_datetime' => date('Y-m-d H:i:s')              
            );
            
            $this->db->where('cash_inward_id', $this->input->post('cash_inward_id'));
            $this->db->update('crit_cash_inward_info', $upd); 
                            
            redirect('cash-inward-list/' . $this->uri->segment(2, 0)); 
        } 
        
        $where = " a.franchise_id = '". ($this->session->userdata('cr_franchise_id') == '' ? 0 : $this->session->userdata('cr_franchise_id')) ."'";
         
           
        if(isset($_POST['srch_from_date'])) {
           $data['srch_from_date'] = $srch_from_date = $this->input->post('srch_from_date'); 
           $data['srch_to_date'] = $srch_to_date = $this->input->post('srch_to_date');  
           $this->session->set_userdata('srch_from_date', $this->input->post('srch_from_date'));
           $this->session->set_userdata('srch_to_date', $this->input->post('srch_to_date')); 
           
        }
        elseif($this->session->userdata('srch_from_date')){
           $data['srch_from_date'] = $srch_from_date = $this->session->userdata('srch_from_date') ;
           $data['srch_to_date'] = $srch_to_date = $this->session->userdata('srch_to_date') ;  
        } else {
            $data['srch_from_date'] = $srch_from_date = date('Y-m-').'01';
            $data['srch_to_date'] = $srch_to_date = date('Y-m-d'); 
        } 
        
        if(!empty($srch_from_date) && !empty($srch_to_date)  ){
            $where .= " and a.inward_date between '" . $srch_from_date . "' and  '". $srch_to_date ."'";  
        }  
         
        
        $this->load->library('pagination'); 
        
        
        $this->db->where('a.status != ', 'Delete'); 
        $this->db->where($where); 
        $this->db->from('crit_cash_inward_info as a');         
        $data['total_records'] = $cnt  = $this->db->count_all_results();  
        
        $data['sno'] = $this->uri->segment(2, 0);		
        	
        $config['base_url'] = trim(site_url('cash-inward-list/'), '/'. $this->uri->segment(2, 0));
        $config['total_rows'] = $cnt;
        $config['per_page'] = 25;
        $config['uri_segment'] = 2;
        //$config['num_links'] = 2; 
        $config['attributes'] = array('class' => 'page-link');
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] =  "Prev";
        $config['next_link'] =  "Next";
        $this->pagination->initialize($config);   
        
        $sql = "
                select 
                a.*,
                b.account_head_name,
                c.sub_account_head_name,
                DATEDIFF(current_date(), a.inward_date) as days,
                d.voucher_type_name,
                d.prefix,
                e.sub_account_headlvl3_name as in_from
                from crit_cash_inward_info as a 
                left join crit_account_head_info as b on b.account_head_id = a.account_head_id and b.status != 'Delete'
                left join crit_sub_account_head_info as c on c.sub_account_head_id = a.sub_account_head_id and c.status != 'Delete'
                left join voucher_type_info as d on d.voucher_type_id = a.voucher_type_id and d.status != 'Delete'
                left join sub_account_head_lvl3_info as e on e.sub_account_headlvl3_id = a.sub_account_headlvl3_id and e.status != 'Delete'
                where a.status != 'Delete' and $where  
                order by  a.inward_date desc , a.cash_inward_id desc
                limit ". $this->uri->segment(2, 0) .",". $config['per_page'] ."                
        "; 
        
        $query = $this->db->query($sql);
        
        $data['record_list'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['record_list'][] = $row;     
        }
        
        
        
        $sql = "
                select 
                a.account_head_id,                
                a.account_head_name             
                from crit_account_head_info as a  
                where a.status = 'Active' and a.type = 'Inward'
                and a.franchise_id = '". ($this->session->userdata('cr_franchise_id') == '' ? 0 : $this->session->userdata('cr_franchise_id')) ."'
                order by a.account_head_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['account_head_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['account_head_opt'][$row['account_head_id']] = $row['account_head_name'];     
        }
        
        
        $sql = "
                select 
                a.voucher_type_id,                
                a.voucher_type_name ,
                a.prefix            
                from voucher_type_info as a  
                where a.status = 'Active' and a.h_type = 'Inward'
                order by a.voucher_type_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['voucher_type_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['voucher_type_opt'][$row['voucher_type_id']] = $row['voucher_type_name'] . "[ " . $row['prefix']. " ]";     
        }
        
        $data['pagination'] = $this->pagination->create_links();
        
        $data['ac_type_opt'] = array('Bank' => 'Bank' , 'Cash' => 'Cash');
        
        $this->load->view('page/accounts/cash-inward-list',$data); 
	}
    
    public function cash_outward_list()
	{
	    if(!$this->session->userdata('cr_logged_in'))  redirect();
        
        /*if($this->session->userdata('m_is_admin') != USER_ADMIN) 
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }  */
        	    
        $data['js'] = 'accounts/cash-outward.inc';  
        
        if($this->input->post('mode') == 'Add')
        {
            $config['upload_path'] = 'bill_photo/';
            $config['file_name'] =  "bill_". date('YmdHis');
    		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            
            $this->load->library('upload', $config); 
            
            
            if ($this->upload->do_upload('bill_photo'))
            {
                $file_array = $this->upload->data();	 
                $photo_path	= 'bill_photo/'. $file_array['file_name'];  
            }
            else
            {
                 $photo_path = '';    
            }
            
            $ins = array(
                    'franchise_id' => ($this->session->userdata('cr_franchise_id') == '' ? 0 : $this->session->userdata('cr_franchise_id')),
                  //  'agent_id' => $this->input->post('agent_id'),
                    'voucher_type_id' => $this->input->post('voucher_type_id'),
                    'outward_date' => $this->input->post('outward_date'),
                    'ac_type' => $this->input->post('ac_type'),
                    'account_head_id' => $this->input->post('account_head_id'),
                    'sub_account_head_id' => $this->input->post('sub_account_head_id'),
                    'sub_account_headlvl3_id' => $this->input->post('sub_account_headlvl3_id'),
                    'amount' => $this->input->post('amount'),
                    'remarks' => $this->input->post('remarks'),
                    'bill_photo' => $photo_path,
                    'status' => $this->input->post('status'),
                    'created_by' => $this->session->userdata('cr_user_id'),                          
                    'created_datetime' => date('Y-m-d H:i:s')                            
            );
            
            //print_r($ins); exit;
            
            $this->db->insert('crit_cash_outward_info', $ins); 
            redirect('cash-outward-list');
        }
        
        if($this->input->post('mode') == 'Edit')
        {
            
            $config['upload_path'] = 'bill_photo/';
            $config['file_name'] =  "bill_". date('YmdHis');
    		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            
            $this->load->library('upload', $config); 
            
            
            if ($this->upload->do_upload('bill_photo'))
            {
                $file_array = $this->upload->data();	 
                $photo_path	= 'bill_photo/'. $file_array['file_name'];  
            }
            else
            {
                 $photo_path = $this->input->post('bill_photo_path');    
            }
            
            $upd = array(
                    'franchise_id' => ($this->session->userdata('cr_franchise_id') == '' ? 0 : $this->session->userdata('cr_franchise_id')),
                    //'agent_id' => $this->input->post('agent_id'),
                    'voucher_type_id' => $this->input->post('voucher_type_id'),
                    'outward_date' => $this->input->post('outward_date'),
                    'ac_type' => $this->input->post('ac_type'),
                    'vno' => $this->input->post('vno'),
                    'account_head_id' => $this->input->post('account_head_id'),
                    'sub_account_head_id' => $this->input->post('sub_account_head_id'),
                    'sub_account_headlvl3_id' => $this->input->post('sub_account_headlvl3_id'),
                    'amount' => $this->input->post('amount'),
                    'remarks' => $this->input->post('remarks'),
                    'bill_photo' => $photo_path,
                    'status' => $this->input->post('status'),
                    'updated_by' => $this->session->userdata('cr_user_id'),                          
                    'updated_datetime' => date('Y-m-d H:i:s')              
            );
            
            $this->db->where('cash_outward_id', $this->input->post('cash_outward_id'));
            $this->db->update('crit_cash_outward_info', $upd); 
                            
            redirect('cash-outward-list/' . $this->uri->segment(2, 0)); 
        } 
        
        $where = " a.franchise_id = '". ($this->session->userdata('cr_franchise_id') == '' ? 0 : $this->session->userdata('cr_franchise_id')) ."'";
         
           
        if(isset($_POST['srch_from_date'])) {
           $data['srch_from_date'] = $srch_from_date = $this->input->post('srch_from_date'); 
           $data['srch_to_date'] = $srch_to_date = $this->input->post('srch_to_date');  
           $this->session->set_userdata('srch_from_date', $this->input->post('srch_from_date'));
           $this->session->set_userdata('srch_to_date', $this->input->post('srch_to_date')); 
           
        }
        elseif($this->session->userdata('srch_from_date')){
           $data['srch_from_date'] = $srch_from_date = $this->session->userdata('srch_from_date') ;
           $data['srch_to_date'] = $srch_to_date = $this->session->userdata('srch_to_date') ;  
        } else {
            $data['srch_from_date'] = $srch_from_date = date('Y-m-'. '01');
            $data['srch_to_date'] = $srch_to_date = date('Y-m-d'); 
        } 
        
        if(!empty($srch_from_date) && !empty($srch_to_date)  ){
            $where .= " and a.outward_date between '" . $srch_from_date . "' and  '". $srch_to_date ."'";  
        }  
         
        
        $this->load->library('pagination'); 
        
        
        $this->db->where('a.status != ', 'Delete'); 
        $this->db->where($where); 
        $this->db->from('crit_cash_outward_info as a');         
        $data['total_records'] = $cnt  = $this->db->count_all_results();  
        
        $data['sno'] = $this->uri->segment(2, 0);		
        	
        $config['base_url'] = trim(site_url('cash-outward-list/'), '/'. $this->uri->segment(2, 0));
        $config['total_rows'] = $cnt;
        $config['per_page'] = 25;
        $config['uri_segment'] = 2;
        //$config['num_links'] = 2; 
        $config['attributes'] = array('class' => 'page-link');
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] =  "Prev";
        $config['next_link'] =  "Next";
        $this->pagination->initialize($config);   
        
        $sql = "
                select 
                a.*,
                b.account_head_name,
                c.sub_account_head_name,
                DATEDIFF(current_date(), a.outward_date) as days ,
                d.voucher_type_name,
                d.prefix,
                e.sub_account_headlvl3_name as out_for
                from crit_cash_outward_info as a 
                left join crit_account_head_info as b on b.account_head_id = a.account_head_id and b.status != 'Delete'
                left join crit_sub_account_head_info as c on c.sub_account_head_id = a.sub_account_head_id and c.status != 'Delete'
                left join voucher_type_info as d on d.voucher_type_id = a.voucher_type_id and d.status != 'Delete'
                left join sub_account_head_lvl3_info as e on e.sub_account_headlvl3_id = a.sub_account_headlvl3_id and e.status != 'Delete'
                where a.status != 'Delete' and $where  
                order by a.outward_date desc , a.cash_outward_id desc
                limit ". $this->uri->segment(2, 0) .",". $config['per_page'] ."                
        "; 
        
        $query = $this->db->query($sql);
        
        $data['record_list'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['record_list'][] = $row;     
        }
        
        
         
        
        $sql = "
                select 
                a.account_head_id,                
                a.account_head_name             
                from crit_account_head_info as a  
                where a.status = 'Active' and a.type = 'Outward'
                and a.franchise_id = '". ($this->session->userdata('cr_franchise_id') == '' ? 0 : $this->session->userdata('cr_franchise_id')) ."'
                order by a.account_head_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['account_head_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['account_head_opt'][$row['account_head_id']] = $row['account_head_name'];     
        }
        
        $sql = "
                select 
                a.voucher_type_id,                
                a.voucher_type_name ,
                a.prefix            
                from voucher_type_info as a  
                where a.status = 'Active' and a.h_type = 'Outward'
                order by a.voucher_type_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['voucher_type_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['voucher_type_opt'][$row['voucher_type_id']] = $row['voucher_type_name'] . "[ " . $row['prefix']. " ]";     
        }
        
        $data['pagination'] = $this->pagination->create_links();
        
        $data['ac_type_opt'] = array('Bank' => 'Bank' , 'Cash' => 'Cash');
        
        $this->load->view('page/accounts/cash-outward-list',$data); 
	}
    
   public function print_voucher($cash_outward_id) 
   {
     
       $sql = "
                select 
                a.*,
                fiscal_year(a.outward_date) as fyr,
                b.account_head_name,
                c.sub_account_head_name,
                d.voucher_type_name,
                d.prefix 
                from crit_cash_outward_info as a 
                left join crit_account_head_info as b on b.account_head_id = a.account_head_id and b.status != 'Delete'
                left join crit_sub_account_head_info as c on c.sub_account_head_id = a.sub_account_head_id and c.status != 'Delete'
                left join voucher_type_info as d on d.voucher_type_id = a.voucher_type_id and d.status != 'Delete'
                where a.status != 'Delete' and   
                a.cash_outward_id = $cash_outward_id
                order by a.status asc , a.outward_date desc 
                              
        "; 
        
        $query = $this->db->query($sql);
        
        $data['record_list'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['record_list'] = $row;     
        }
        
        $this->load->view('page/accounts/print-voucher',$data); 
        
   }
   
   public function print_receipt($cash_inward_id) 
   {
     
       $sql = "
                select 
                a.*,
                fiscal_year(a.inward_date) as fyr,
                b.account_head_name,
                c.sub_account_head_name,
                d.voucher_type_name,
                d.prefix 
                from crit_cash_inward_info as a 
                left join crit_account_head_info as b on b.account_head_id = a.account_head_id and b.status != 'Delete'
                left join crit_sub_account_head_info as c on c.sub_account_head_id = a.sub_account_head_id and c.status != 'Delete'
                left join voucher_type_info as d on d.voucher_type_id = a.voucher_type_id and d.status != 'Delete'
                where a.status != 'Delete' and   
                a.cash_inward_id = $cash_inward_id
                order by a.status asc , a.inward_date desc 
                              
        "; 
        
        $query = $this->db->query($sql);
        
        $data['record_list'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['record_list'] = $row;     
        }
        
        $this->load->view('page/accounts/print-receipt',$data); 
        
   }
    
    public function cash_ledger()
	{
	    if(!$this->session->userdata('cr_logged_in'))  redirect();
        
        if($this->session->userdata('cr_user_type') != 'Admin' ) 
        { 
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }
        	    
        $data['js'] = 'accounts/cash-ledger.inc';  
        
        if(isset($_POST['srch_from_date'])) {
           $data['srch_from_date'] = $srch_from_date = $this->input->post('srch_from_date'); 
           $data['srch_to_date'] = $srch_to_date = $this->input->post('srch_to_date');  
           
        } else {
            $data['srch_from_date'] = $srch_from_date = date('Y-m-').'01';
            $data['srch_to_date'] = $srch_to_date = date('Y-m-d'); 
        } 
        
        
        if(isset($_POST['srch_ac_type'])) {
           $data['srch_ac_type'] = $srch_ac_type = $this->input->post('srch_ac_type');   
           
        } else {
            $data['srch_ac_type'] = $srch_ac_type = ''; 
        } 
        
        
         
        
         
        
        
        $data['record_list'] = array(); 
        
        //if(!empty($srch_agent_id)) 
        {
       
      /*  
      $sql_op = "

         select 

         '" . $srch_from_date . "' as t_date,
         
         '' as vno,

         'Opening Balance' as particular,

         (sum(z.cash_in) - sum(z.cash_out)) as cash_in,

         0 as cash_out

         from 

         (
             (
                select  
                sum(a.received_amount) as cash_in ,
                0 as cash_out
                from receipt_info as a 
                where a.`status` = 'Active'
                and a.receipt_date > '2023-10-01'
                and a.receipt_date < '" . $srch_from_date . "'  

             ) union all ( 
                select  
                sum(a.amount) as cash_in, 
                0 as cash_out 
                from crit_cash_inward_info as a  
                where a.inward_date < '" . $srch_from_date . "'   
                and a.status='Active'
             )   union all ( 
                select    
                0 as cash_in, 
                sum(a.amount) as cash_out 
                from crit_cash_outward_info as a   
                where a.outward_date < '" . $srch_from_date . "'  
                and a.status='Active' 
              )

          ) as z

                        

        ";


        $sql_tr = "

         select 

         z.t_date,
         
         z.vno,

         z.particular,

         (z.cash_in) as cash_in,

         (z.cash_out) as cash_out

         from 

         (

            (
                select 
                0 as sort,
                a.receipt_date as t_date,
                0 as vno,
                c.company_name as particular,
                sum(a.received_amount) as cash_in ,
                0 as cash_out
                from receipt_info as a
                left join invoice_info as b on b.invoice_id = a.invoice_id 
                left join client_info as c on c.client_id = b.client_id 
                where a.`status` = 'Active'
                and a.receipt_date > '2023-10-01'
                and a.receipt_date between '" . $srch_from_date . "' and  '" . $srch_to_date .  "'
                group by a.receipt_date , b.client_id
                order by a.receipt_date desc

             ) union all (

               select 

                1 as sort,

                a.inward_date as t_date,
                
                concat(d.prefix , a.vno) as vno,

                CONCAT(a.ac_type , ' : ', b.account_head_name,' - ', c.sub_account_head_name , '<br>', a.remarks ) as particular,

                a.amount as cash_in,

                0 as cash_out

                from crit_cash_inward_info as a

                left join crit_account_head_info as b on b.account_head_id = a.account_head_id

                left join crit_sub_account_head_info as c on c.sub_account_head_id  = a.sub_account_head_id
                
                left join voucher_type_info as d on d.voucher_type_id  = a.voucher_type_id

                where a.inward_date between '" . $srch_from_date . "' and  '" . $srch_to_date .  "'
                
                and a.status='Active'
                  
                order by a.inward_date asc , a.cash_inward_id 

             ) union all (

                select 

                4 as sort,

                a.outward_date as t_date,
                
                concat(d.prefix , a.vno) as vno,

                CONCAT(a.ac_type , ' : ', b.account_head_name,' - ', c.sub_account_head_name , '<br>', a.remarks ) as particular,

                0 as cash_in,

                a.amount as cash_out

                from crit_cash_outward_info as a

                left join crit_account_head_info as b on b.account_head_id = a.account_head_id

                left join crit_sub_account_head_info as c on c.sub_account_head_id  = a.sub_account_head_id
                
                left join voucher_type_info as d on d.voucher_type_id  = a.voucher_type_id

                where a.outward_date between '" . $srch_from_date . "' and  '" . $srch_to_date .  "' 
                
                and a.status='Active'
                
                order by a.outward_date asc , a.cash_outward_id 

              )

          ) as z

          order by z.t_date asc , z.sort asc             

        ";


       $sql = "

        select 

         q.t_date,
         
         q.vno,

         q.particular,

         (q.cash_in) as cash_in,

         (q.cash_out) as cash_out

         from (

                (" . $sql_op . ") union all (" . $sql_tr . ") 

              ) as q

         order by q.t_date asc      

            ";
            
         */
         
         
         if(!empty($srch_ac_type)){
            $where = " and a.ac_type = '" . $srch_ac_type ."'";
         }  else {
            $where = " and 1=1 ";
         }
        
        
        /*
         
         $sql_op = "

         select 
         
         z1.ac_type,

         '" . $srch_from_date . "' as t_date,
         
         '' as vno, 

         'Opening Balance' as particular,

         (sum(z1.cash_in) - sum(z1.cash_out)) as cash_in,

         0 as cash_out

         from 

         (
             ( 
                select  
                a.ac_type,
                sum(a.amount) as cash_in, 
                0 as cash_out 
                from crit_cash_inward_info as a  
                where a.inward_date < '" . $srch_from_date . "'   
                and a.status='Active'
                $where
                group by a.ac_type
             )   union all ( 
                select  
                a.ac_type, 
                0 as cash_in, 
                sum(a.amount) as cash_out 
                from crit_cash_outward_info as a   
                where a.outward_date < '" . $srch_from_date . "'  
                and a.status='Active' 
                $where
                group by a.ac_type
              )

          ) as z1

          group by z1.ac_type              

        "; */
        
        
        
        $sql_op = "

         select 
         
         z1.ac_type,

         '" . $srch_from_date . "' as t_date,
         
         '' as vno, 

         'Opening Balance' as particular,

         (sum(z1.cash_in) - sum(z1.cash_out)) as cash_in,

         0 as cash_out

         from 

         (
             (
                select  
                w1.ac_type,
                sum(w1.amount) as cash_in, 
                0 as cash_out 
                from opening_balance_info as w1
                where  w1.opening_balance_id  = (
                	ifnull((
                	select 
                	(w.opening_balance_id)
                	from opening_balance_info as w
                	where w.ac_type = w1.ac_type
                	and w.opening_date <= '" . $srch_from_date . "' order by w.opening_date desc  limit 1)
                	,'0') 
                ) 
                group by w1.ac_type 
             
             )   union all (  
                select  
                a.ac_type,
                sum(a.amount) as cash_in, 
                0 as cash_out 
                from crit_cash_inward_info as a  
                where a.inward_date between (
                	ifnull((
                	select max(w.opening_date)
                	from opening_balance_info as w
                	where w.ac_type = a.ac_type
                	and w.opening_date <= '" . $srch_from_date . "')
                	,'2024-04-01') 
                ) and DATE_SUB('" . $srch_from_date . "',INTERVAL 1 day)  
                and a.status='Active'
                $where
                group by a.ac_type
             )   union all ( 
                select  
                a.ac_type, 
                0 as cash_in, 
                sum(a.amount) as cash_out 
                from crit_cash_outward_info as a   
                where a.outward_date between (
                	ifnull((
                	select max(w.opening_date)
                	from opening_balance_info as w
                	where w.ac_type = a.ac_type
                	and w.opening_date <= '" . $srch_from_date . "')
                	,'2024-04-01') 
                ) and DATE_SUB('" . $srch_from_date . "',INTERVAL 1 day)    
                and a.status='Active' 
                $where
                group by a.ac_type
              )

          ) as z1

          group by z1.ac_type              

        ";


        $sql_tr = "

         select 
         
         z.ac_type,

         z.t_date,
         
         z.vno,

         z.particular,

         (z.cash_in) as cash_in,

         (z.cash_out) as cash_out

         from 

         (

             (

               select 

                1 as sort,
                
                a.ac_type,

                a.inward_date as t_date,
                
                concat(d.prefix , a.vno) as vno,

                CONCAT(b.account_head_name,' - ', c.sub_account_head_name , '<br>', ifnull(e.sub_account_headlvl3_name,\"-\") , '<br>', a.remarks  ) as particular,

                a.amount as cash_in,

                0 as cash_out

                from crit_cash_inward_info as a

                left join crit_account_head_info as b on b.account_head_id = a.account_head_id

                left join crit_sub_account_head_info as c on c.sub_account_head_id  = a.sub_account_head_id
                
                left join voucher_type_info as d on d.voucher_type_id  = a.voucher_type_id
                
                left join sub_account_head_lvl3_info as e on e.sub_account_headlvl3_id  = a.sub_account_headlvl3_id

                where a.inward_date between '" . $srch_from_date . "' and  '" . $srch_to_date .  "'
                
                and a.status='Active' 
                
                $where
                  
                order by a.ac_type , a.inward_date asc , a.cash_inward_id 

             ) union all (

                select 

                4 as sort,
                
                a.ac_type,

                a.outward_date as t_date,
                
                concat(d.prefix , a.vno) as vno,

                CONCAT( b.account_head_name,' - ', c.sub_account_head_name  , '<br>', ifnull(e.sub_account_headlvl3_name,\"-\") , '<br>', a.remarks ) as particular,

                0 as cash_in,

                a.amount as cash_out

                from crit_cash_outward_info as a

                left join crit_account_head_info as b on b.account_head_id = a.account_head_id

                left join crit_sub_account_head_info as c on c.sub_account_head_id  = a.sub_account_head_id
                
                left join voucher_type_info as d on d.voucher_type_id  = a.voucher_type_id
                
                left join sub_account_head_lvl3_info as e on e.sub_account_headlvl3_id  = a.sub_account_headlvl3_id

                where a.outward_date between '" . $srch_from_date . "' and  '" . $srch_to_date .  "' 
                
                and a.status='Active'
                
                $where
                
                order by a.ac_type , a.outward_date asc , a.cash_outward_id 

              )

          ) as z

          order by z.ac_type , z.t_date asc , z.sort asc             

        ";


       $sql = "

        select 

         q.ac_type, 
            
         q.t_date,
         
         q.vno,

         q.particular,

         (q.cash_in) as cash_in,

         (q.cash_out) as cash_out

         from (

                (" . $sql_op . ") union all (" . $sql_tr . ") 

              ) as q

         order by q.ac_type, q.t_date asc      

            ";
            
       
      
           


        $query = $this->db->query($sql);  
                
        

        foreach ($query->result_array() as $row) { 

            $data['record_list'][$row['ac_type']][] = $row;

        }
        
      // echo "<pre>";    
      // print_r($sql_tr);
      // print_r($data['record_list']); 
      // echo "</pre>";    
        
       } 
       
        $data['ac_type_opt'] = array('' => 'All' , 'Bank' => 'Bank' , 'Cash' => 'Cash');
        
        $this->load->view('page/accounts/cash-ledger',$data); 
    }
    
    public function cash_in_statement()
	{
	    if(!$this->session->userdata('cr_logged_in'))  redirect();
        
        /*if($this->session->userdata('m_is_admin') != USER_ADMIN) 
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }  */
        
        $data['js'] = 'accounts/cash-in-statement.inc';  
        
        if($this->session->userdata('cr_user_type') != 'Admin' )
        {
            $data['min_date'] =   date('Y-m-d', strtotime( date('Y-m-d'). ' - 2 days'));; 
            $data['max_date'] = date('Y-m-d');
        } else {
            $data['min_date'] = $data['max_date'] = '';
        }	    
        
        
        if(isset($_POST['srch_from_date'])) {
           $data['srch_from_date'] = $srch_from_date = $this->input->post('srch_from_date'); 
           $data['srch_to_date'] = $srch_to_date = $this->input->post('srch_to_date');  
           
        } else {
            if($this->session->userdata('cr_user_type') != 'Admin' )
                $data['srch_from_date'] = $srch_from_date = $data['min_date'];
            else    
                $data['srch_from_date'] = $srch_from_date = date('Y-m').'-01';
            $data['srch_to_date'] = $srch_to_date = date('Y-m-d'); 
        } 
        
        if(isset($_POST['srch_ac_type'])) {
           $data['srch_ac_type'] = $srch_ac_type = $this->input->post('srch_ac_type');  
        } else {
            $data['srch_ac_type'] = $srch_ac_type= ''; 
        }
        
        if(isset($_POST['srch_account_head_id'])) {
           $data['srch_account_head_id'] = $srch_account_head_id = $this->input->post('srch_account_head_id');  
        } else {
            $data['srch_account_head_id'] = $srch_account_head_id = ''; 
        } 
        
        if(isset($_POST['srch_sub_account_head_id'])) {
           $data['srch_sub_account_head_id'] = $srch_sub_account_head_id = $this->input->post('srch_sub_account_head_id');  
        } else {
            $data['srch_sub_account_head_id'] = $srch_sub_account_head_id = ''; 
        }
        
        if(isset($_POST['srch_inward_from'])) {
           $data['srch_inward_from'] = $srch_inward_from = $this->input->post('srch_inward_from');  
        } else {
            $data['srch_inward_from'] = $srch_inward_from = ''; 
        }
        
        
         
       $sql = "
                select 
                a.account_head_id,                
                a.account_head_name             
                from crit_account_head_info as a  
                where a.status = 'Active' and a.type = 'Inward'
                order by a.account_head_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['account_head_opt'] = array();
        $data['sub_account_head_opt'] = array();
        $data['inward_from_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['account_head_opt'][$row['account_head_id']] = $row['account_head_name'];     
        } 
        
        
        $data['ac_type_opt'] = array('Bank' => 'Bank' , 'Cash' => 'Cash');
         
        
        
        $data['record_list'] = array(); 
        
        $where = "";
        
        if(!empty($srch_account_head_id)){
            $where .= " and a.account_head_id = '". $srch_account_head_id ."'";
        } else {
            $where .= " and 1=1 ";
        }
        
        
        if(!empty($srch_sub_account_head_id)){
            $where .= " and a.sub_account_head_id = '". $srch_sub_account_head_id ."'";
        } else {
            $where .= " and 1=1 ";
        }
        
        if(!empty($srch_ac_type)){
            $where .= " and a.ac_type = '". $srch_ac_type ."'";
        } else {
            $where .= " and 1=1 ";
        }
        
        if(!empty($srch_inward_from)){
            $where .= " and a.sub_account_headlvl3_id = '". $srch_inward_from ."'";
        } else {
            $where .= " and 1=1 ";
        }
        
         

       $sql = "
            select 
            a.inward_date,
            a.ac_type,
            concat(d.prefix , a.vno) as vno,
            b.account_head_name as account_head,
            c.sub_account_head_name as sub_account_head,
            a.amount,
            a.remarks,
            e.sub_account_headlvl3_name
            from crit_cash_inward_info as a
            left join crit_account_head_info as b on b.account_head_id = a.account_head_id
            left join crit_sub_account_head_info as c on c.sub_account_head_id = a.sub_account_head_id
            left join voucher_type_info as d on d.voucher_type_id  = a.voucher_type_id
            left join sub_account_head_lvl3_info as e on e.sub_account_headlvl3_id  = a.sub_account_headlvl3_id
            where a.`status` = 'Active'
            and a.inward_date between '" . $srch_from_date . "' and  '" . $srch_to_date .  "' 
            $where
            order by a.inward_date , a.cash_inward_id asc  
            ";
            
           


        $query = $this->db->query($sql);  
                
        

        foreach ($query->result_array() as $row) { 

            $data['record_list'][$row['ac_type']][] = $row;

        }
        
       if(!empty($srch_account_head_id)) 
       { 
            $sql = "
                    select 
                    a.sub_account_head_id,
                    a.sub_account_head_name
                    from crit_sub_account_head_info as a
                    where a.`status` = 'Active'
                    and a.`type` = 'Inward'
                    and a.account_head_id = '". $srch_account_head_id ."'
                    order by a.sub_account_head_name asc                 
            "; 
            
            $query = $this->db->query($sql); 
           
            foreach ($query->result_array() as $row)
            {
                $data['sub_account_head_opt'][$row['sub_account_head_id']] = $row['sub_account_head_name'];     
            }
        
       } 
       
       if(!empty($srch_sub_account_head_id)) 
       { 
            $sql = "
                    select 
                    a.sub_account_headlvl3_id,
                    a.sub_account_headlvl3_name
                    from sub_account_head_lvl3_info as a
                    where a.`status` = 'Active'
                    and a.`type` = 'Inward'
                    and a.sub_account_head_id = '". $srch_sub_account_head_id ."'
                    order by a.sub_account_headlvl3_name asc                 
            "; 
            
            $query = $this->db->query($sql); 
           
            foreach ($query->result_array() as $row)
            {
                $data['inward_from_opt'][$row['sub_account_headlvl3_id']] = $row['sub_account_headlvl3_name'];     
            }
        
         } 
        
        $this->load->view('page/accounts/cash-in-statement',$data); 
    }
    
    
    public function cash_out_statement()
	{
	    if(!$this->session->userdata('cr_logged_in'))  redirect();
        
        /*if($this->session->userdata('m_is_admin') != USER_ADMIN) 
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }  */
        	    
        $data['js'] = 'accounts/cash-out-statement.inc';  
        
        if($this->session->userdata('cr_user_type') != 'Admin' )
        {
            $data['min_date'] =   date('Y-m-d', strtotime( date('Y-m-d'). ' - 2 days'));; 
            $data['max_date'] = date('Y-m-d');  
        } else {
            $data['min_date'] = $data['max_date'] = '';
        }	  
        
        
        	    
        
        
        if(isset($_POST['srch_from_date'])) {
           $data['srch_from_date'] = $srch_from_date = $this->input->post('srch_from_date'); 
           $data['srch_to_date'] = $srch_to_date = $this->input->post('srch_to_date');  
           
        } else {
            if($this->session->userdata('cr_user_type') != 'Admin' )
                $data['srch_from_date'] = $srch_from_date = $data['min_date'];
            else    
                $data['srch_from_date'] = $srch_from_date = date('Y-m').'-01';
            $data['srch_to_date'] = $srch_to_date = date('Y-m-d'); 
        } 
        
        if(isset($_POST['srch_ac_type'])) {
           $data['srch_ac_type'] = $srch_ac_type = $this->input->post('srch_ac_type');  
        } else {
            $data['srch_ac_type'] = $srch_ac_type= ''; 
        }
        
        if(isset($_POST['srch_account_head_id'])) {
           $data['srch_account_head_id'] = $srch_account_head_id = $this->input->post('srch_account_head_id');  
        } else {
            $data['srch_account_head_id'] = $srch_account_head_id = ''; 
        } 
        if(isset($_POST['srch_sub_account_head_id'])) {
           $data['srch_sub_account_head_id'] = $srch_sub_account_head_id = $this->input->post('srch_sub_account_head_id');  
        } else {
            $data['srch_sub_account_head_id'] = $srch_sub_account_head_id = ''; 
        } 
        
        if(isset($_POST['srch_outward_for'])) {
           $data['srch_outward_for'] = $srch_outward_for = $this->input->post('srch_outward_for');  
        } else {
            $data['srch_outward_for'] = $srch_outward_for = ''; 
        }
        
        
        
         
       $sql = "
                select 
                a.account_head_id,                
                a.account_head_name             
                from crit_account_head_info as a  
                where a.status = 'Active' and a.type = 'Outward'
                order by a.account_head_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['account_head_opt'] = array();
        $data['sub_account_head_opt'] = array();
        $data['outward_for_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['account_head_opt'][$row['account_head_id']] = $row['account_head_name'];     
        } 
         
        
        $data['ac_type_opt'] = array('Bank' => 'Bank' , 'Cash' => 'Cash'); 
        
        
        $data['record_list'] = array(); 
        
        $where = "";
        
        if(!empty($srch_account_head_id)){
            $where .= " and a.account_head_id = '". $srch_account_head_id ."'";
        } else {
             $where .= " and 1=1 ";
        }
        
        if(!empty($srch_sub_account_head_id)){
            $where .= " and a.sub_account_head_id = '". $srch_sub_account_head_id ."'";
        } else {
             $where .= " and 1=1 ";
        }
        
        if(!empty($srch_ac_type)){
            $where .= " and a.ac_type = '". $srch_ac_type ."'";
        } else {
            $where .= " and 1=1 ";
        }
        
        if(!empty($srch_outward_for)){
            $where .= " and a.sub_account_headlvl3_id = '". $srch_outward_for ."'";
        } else {
            $where .= " and 1=1 ";
        }
        
        
        
         

       $sql = "
            select 
            a.outward_date,
            a.ac_type,
            concat(d.prefix , a.vno) as vno,
            b.account_head_name as account_head,
            c.sub_account_head_name as sub_account_head,
            a.amount,
            a.remarks,
            a.bill_photo,
            e.sub_account_headlvl3_name as outward_for 
            from crit_cash_outward_info as a
            left join crit_account_head_info as b on b.account_head_id = a.account_head_id
            left join crit_sub_account_head_info as c on c.sub_account_head_id = a.sub_account_head_id
            left join voucher_type_info as d on d.voucher_type_id  = a.voucher_type_id
            left join sub_account_head_lvl3_info as e on e.sub_account_headlvl3_id  = a.sub_account_headlvl3_id
            where a.`status` = 'Active'
            and a.outward_date between '" . $srch_from_date . "' and  '" . $srch_to_date .  "' 
            $where
            order by a.outward_date , a.cash_outward_id asc  
            ";
            
           


        $query = $this->db->query($sql);  
                
        

        foreach ($query->result_array() as $row) { 

            $data['record_list'][$row['ac_type']][] = $row;

        }
        
        if(!empty($srch_account_head_id)) 
        {
        
        $sql = "
                select 
                a.sub_account_head_id,
                a.sub_account_head_name
                from crit_sub_account_head_info as a
                where a.`status` = 'Active'
                and a.`type` = 'Outward'
                and a.account_head_id = '". $srch_account_head_id ."'
                order by a.sub_account_head_name asc                 
        "; 
        
        $query = $this->db->query($sql); 
       
        foreach ($query->result_array() as $row)
        {
            $data['sub_account_head_opt'][$row['sub_account_head_id']] = $row['sub_account_head_name'];     
        }
        
        
       if(!empty($srch_sub_account_head_id)) 
       { 
            $sql = "
                    select 
                    a.sub_account_headlvl3_id,
                    a.sub_account_headlvl3_name
                    from sub_account_head_lvl3_info as a
                    where a.`status` = 'Active'
                    and a.`type` = 'Outward'
                    and a.sub_account_head_id = '". $srch_sub_account_head_id ."'
                    order by a.sub_account_headlvl3_name asc                 
            "; 
            
            $query = $this->db->query($sql); 
           
            foreach ($query->result_array() as $row)
            {
                $data['outward_for_opt'][$row['sub_account_headlvl3_id']] = $row['sub_account_headlvl3_name'];     
            }
        
         } 
        
       } 
        
        $this->load->view('page/accounts/cash-out-statement',$data); 
    }
    
    
    
    public function inward_summary()
	{
	    if(!$this->session->userdata('cr_logged_in'))  redirect();
        
        /*if($this->session->userdata('m_is_admin') != USER_ADMIN) 
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }  */
        	    
        $data['js'] = 'accounts/inward-summary.inc';  
        
        if(isset($_POST['srch_from_date'])) {
           $data['srch_from_date'] = $srch_from_date = $this->input->post('srch_from_date'); 
           $data['srch_to_date'] = $srch_to_date = $this->input->post('srch_to_date');  
           
        } else {
            $data['srch_from_date'] = $srch_from_date = date('Y-m');
            $data['srch_to_date'] = $srch_to_date = date('Y-m'); 
        } 
        
        if(isset($_POST['srch_ac_type'])) {
           $data['srch_ac_type'] = $srch_ac_type = $this->input->post('srch_ac_type');  
        } else {
            $data['srch_ac_type'] = $srch_ac_type= ''; 
        }
        
          
        
        $data['ac_type_opt'] = array('Bank' => 'Bank' , 'Cash' => 'Cash'); 
        
        
        $data['record_list'] = array(); 
        
        $where = "";
        
        
        if(!empty($srch_ac_type)){
            $where .= " and a.ac_type = '". $srch_ac_type ."'";
        } else {
            $where .= " and 1=1 ";
        }
        
       
        
        
         

       $sql = "  
            select 
            DATE_FORMAT(a.inward_date,'%Y%m') num_mon, 
            DATE_FORMAT(a.inward_date,'%b - %Y') as ap_mon, 
            a.ac_type ,  
            b.account_head_name as account_head,
            sum(a.amount) as inward 
            from crit_cash_inward_info as a
            left join crit_account_head_info as b on b.account_head_id = a.account_head_id
            where a.`status` != 'Delete' and b.`status` != 'Delete'
            and DATE_FORMAT(a.inward_date,'%Y-%m') between '".  $srch_from_date ."' and '". $srch_to_date."'
            $where
            group by DATE_FORMAT(a.inward_date,'%Y%m') , a.ac_type , a.account_head_id 
            order by DATE_FORMAT(a.inward_date,'%Y%m') , a.ac_type , a.account_head_id;
            
        ";
        $query = $this->db->query($sql); 
        
        $data['inward_rec'] = array();
        $data['ap_mon'] = array();

        foreach($query->result_array() as $row)
        {
            $data['inward_rec'][$row['ac_type']][$row['account_head']][$row['ap_mon']] = $row;       
            $data['ap_mon'][$row['num_mon']] = $row['ap_mon'];       
        }   
        
          
        $this->load->view('page/accounts/inward-summary',$data); 
    }
    
    
     public function outward_summary()
	{
	    if(!$this->session->userdata('cr_logged_in'))  redirect();
        
        /*if($this->session->userdata('m_is_admin') != USER_ADMIN) 
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }  */
        	    
        $data['js'] = 'accounts/outward-summary.inc';  
        
        if(isset($_POST['srch_from_date'])) {
           $data['srch_from_date'] = $srch_from_date = $this->input->post('srch_from_date'); 
           $data['srch_to_date'] = $srch_to_date = $this->input->post('srch_to_date');  
           
        } else {
            $data['srch_from_date'] = $srch_from_date = date('Y-m');
            $data['srch_to_date'] = $srch_to_date = date('Y-m'); 
        } 
        
        if(isset($_POST['srch_ac_type'])) {
           $data['srch_ac_type'] = $srch_ac_type = $this->input->post('srch_ac_type');  
        } else {
            $data['srch_ac_type'] = $srch_ac_type= ''; 
        }
        
          
        
        $data['ac_type_opt'] = array('Bank' => 'Bank' , 'Cash' => 'Cash'); 
        
        
        $data['record_list'] = array(); 
        
        $where = "";
        
        
        if(!empty($srch_ac_type)){
            $where .= " and a.ac_type = '". $srch_ac_type ."'";
        } else {
            $where .= " and 1=1 ";
        }
        
       
        
      $sql = " 
        
            select 
            DATE_FORMAT(a.outward_date,'%Y%m') num_mon, 
            DATE_FORMAT(a.outward_date,'%b - %Y') as ap_mon, 
            a.ac_type ,  
            b.account_head_name as account_head,
            sum(a.amount) as outward 
            from crit_cash_outward_info as a
            left join crit_account_head_info as b on b.account_head_id = a.account_head_id
            where a.`status` != 'Delete' and b.`status` != 'Delete'
            and DATE_FORMAT(a.outward_date,'%Y-%m') between '".  $srch_from_date ."' and '". $srch_to_date."'
            $where
            group by DATE_FORMAT(a.outward_date,'%Y%m') , a.ac_type , a.account_head_id 
            order by DATE_FORMAT(a.outward_date,'%Y%m') , a.ac_type , a.account_head_id;
            
        ";  
          
       
        $query = $this->db->query($sql); 
        
        $data['outward_rec'] = array();
        $data['ap_mon'] = array();

        foreach($query->result_array() as $row)
        {
            $data['outward_rec'][$row['ac_type']][$row['account_head']][$row['ap_mon']] = $row;       
            $data['ap_mon'][$row['num_mon']] = $row['ap_mon'];       
        }   
        
          
        $this->load->view('page/accounts/outward-summary',$data); 
    }
    
    public function voucher_type_list()
	{
	    if(!$this->session->userdata('cr_logged_in'))  redirect(); 
        
        if($this->session->userdata('cr_user_type') != 'Admin' ) 
        { 
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }  
        
        	    
        $data['js'] = 'accounts/voucher-type.inc';  
        
        if($this->input->post('mode') == 'Add')
        {
            $ins = array(
                    'voucher_type_name' => $this->input->post('voucher_type_name'),
                    'prefix' => $this->input->post('prefix'),
                    'h_type' => $this->input->post('h_type'),
                    'status' => $this->input->post('status')  ,                          
            );
            
            $this->db->insert('voucher_type_info', $ins); 
            redirect('voucher-type-list');
        }
        
        if($this->input->post('mode') == 'Edit')
        {
            $upd = array(
                    'voucher_type_name' => $this->input->post('voucher_type_name'),
                    'prefix' => $this->input->post('prefix'),
                    'h_type' => $this->input->post('h_type'),
                    'status' => $this->input->post('status')  ,                 
            );
            
            $this->db->where('voucher_type_id', $this->input->post('voucher_type_id'));
            $this->db->update('voucher_type_info', $upd); 
                            
            redirect('voucher-type-list/' . $this->uri->segment(2, 0)); 
        } 
         
        
        $this->load->library('pagination');
        
        
        $this->db->where('status != ', 'Delete'); 
        $this->db->from('voucher_type_info');         
        $data['total_records'] = $cnt  = $this->db->count_all_results();  
        
        $data['sno'] = $this->uri->segment(2, 0);		
        	
        $config['base_url'] = trim(site_url('voucher-type-list/'), '/'. $this->uri->segment(2, 0));
        $config['total_rows'] = $cnt;
        $config['per_page'] = 20;
        $config['uri_segment'] = 2;
        //$config['num_links'] = 2; 
        $config['attributes'] = array('class' => 'page-link');
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] =  "Prev";
        $config['next_link'] =  "Next";
        $this->pagination->initialize($config);   
        
        $sql = "
                select 
                a.voucher_type_id,
                a.voucher_type_name,   
                a.prefix,
                a.h_type,             
                a.status
                from voucher_type_info as a 
                where a.status != 'Delete'
                order by a.status asc , a.h_type, a.voucher_type_name asc 
                limit ". $this->uri->segment(2, 0) .",". $config['per_page'] ."                
        ";
        
        //a.status = 'Booked'  
        
        $query = $this->db->query($sql);
       
        $data['record_list'] = array();
        foreach ($query->result_array() as $row)
        {
            $data['record_list'][] = $row;     
        }
        
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('page/accounts/voucher-type-list',$data); 
	} 
    
    
    public function opening_balance_list()
	{
	    if(!$this->session->userdata('cr_logged_in'))  redirect(); 
        
        if($this->session->userdata('cr_user_type') != 'Admin' ) 
        { 
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }  
        
        	    
        $data['js'] = 'accounts/opening-balance.inc';  
        
        if($this->input->post('mode') == 'Add')
        {
            $ins = array(
                    'opening_date' => $this->input->post('opening_date'),
                    'ac_type' => $this->input->post('ac_type'),
                    'amount' => $this->input->post('amount'),                        
            );
            
            $this->db->insert('opening_balance_info', $ins); 
            redirect('opening-balance-list');
        }
        
        if($this->input->post('mode') == 'Edit')
        {
            $upd = array(
                    'opening_date' => $this->input->post('opening_date'),
                    'ac_type' => $this->input->post('ac_type'),
                    'amount' => $this->input->post('amount'),                
            );
            
            $this->db->where('opening_balance_id', $this->input->post('opening_balance_id'));
            $this->db->update('opening_balance_info', $upd); 
                            
            redirect('opening-balance-list/' . $this->uri->segment(2, 0)); 
        } 
         
        
        $this->load->library('pagination');
        
        
        $this->db->where('status != ', 'Delete'); 
        $this->db->from('opening_balance_info');         
        $data['total_records'] = $cnt  = $this->db->count_all_results();  
        
        $data['sno'] = $this->uri->segment(2, 0);		
        	
        $config['base_url'] = trim(site_url('opening-balance-list/'), '/'. $this->uri->segment(2, 0));
        $config['total_rows'] = $cnt;
        $config['per_page'] = 20;
        $config['uri_segment'] = 2;
        //$config['num_links'] = 2; 
        $config['attributes'] = array('class' => 'page-link');
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] =  "Prev";
        $config['next_link'] =  "Next";
        $this->pagination->initialize($config);   
        
        $sql = "
                select 
                a.*
                from opening_balance_info as a 
                where a.status != 'Delete'
                order by a.opening_date desc,  a.opening_balance_id desc 
                limit ". $this->uri->segment(2, 0) .",". $config['per_page'] ."                
        ";
        
        //a.status = 'Booked'  
        
        $query = $this->db->query($sql);
       
        $data['record_list'] = array();
        foreach ($query->result_array() as $row)
        {
            $data['record_list'][] = $row;     
        }
        
        $data['ac_type_opt'] = array('Bank' => 'Bank' , 'Cash' => 'Cash');
        
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('page/accounts/opening-balance-list',$data); 
	} 
    
 }
 ?>   