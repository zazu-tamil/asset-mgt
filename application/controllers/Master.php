<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

 
	public function category_list() 
	{
	    if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect();
        
        if($this->session->userdata(SESS_HD . 'user_type') != 'Admin' and $this->session->userdata(SESS_HD . 'user_type') != 'Manager')
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }   
        	    
        $data['js'] = 'ams-category.inc';  
        $data['s_url'] = 'ams-category-list';  
        $data['title'] = 'Asset Category List';  
        
         
        if($this->input->post('mode') == 'Add')
        {
            $ins = array(
                    'asset_category_name' => $this->input->post('asset_category_name'), 
                    'asset_category_code' => $this->input->post('asset_category_code'), 
                    'status' => $this->input->post('status'),
                    'created_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                    'created_date' => date('Y-m-d H:i:s') ,
                    'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                    'updated_date' => date('Y-m-d H:i:s')                                    
            );
            
            $this->db->insert('ams_asset_category_info', $ins); 
            redirect($data['s_url']. '/' . $this->uri->segment(2, 0)); 
        }
        
        if($this->input->post('mode') == 'Edit')
        {
            $upd = array(
                    'asset_category_name' => $this->input->post('asset_category_name'), 
                    'asset_category_code' => $this->input->post('asset_category_code'), 
                    'status' => $this->input->post('status'), 
                    'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                    'updated_date' => date('Y-m-d H:i:s'),                       
            );
            
            $this->db->where('asset_category_id', $this->input->post('asset_category_id'));
            $this->db->update('ams_asset_category_info', $upd);  
                            
           redirect($data['s_url']. '/' . $this->uri->segment(2, 0)); 
        } 
         
        
        $this->load->library('pagination'); 
        
        $this->db->where('status != ', 'Delete'); 
        $this->db->from('ams_asset_category_info');         
        $data['total_records'] = $cnt  = $this->db->count_all_results();  
        
        $data['sno'] = $this->uri->segment(2, 0);		
        	
        $config['base_url'] = trim(site_url($data['s_url']), '/'. $this->uri->segment(2, 0));
        $config['total_rows'] = $cnt;
        $config['per_page'] = 50;
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
                from ams_asset_category_info as a  
                where a.status != 'Delete'
                order by a.status, a.asset_category_name asc    
                limit ". $this->uri->segment(2, 0) .",". $config['per_page'] ."                
        ";
        
       $data['record_list'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['record_list'][] = $row;     
        } 
        
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('page/master/'. $data['s_url'] ,$data); 
	}
    
    public function location_list() 
	{
	    if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect();
        
        if($this->session->userdata(SESS_HD . 'user_type') != 'Admin' and $this->session->userdata(SESS_HD . 'user_type') != 'Manager')
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }   
        	    
        $data['js'] = 'ams-location.inc';  
        $data['s_url'] = 'ams-location-list';  
        $data['title'] = 'Asset Location List';  
        
         
        if($this->input->post('mode') == 'Add')
        {
            $ins = array(
                    'asset_location_name' => $this->input->post('asset_location_name'), 
                    'asset_location_code' => $this->input->post('asset_location_code'), 
                    'status' => $this->input->post('status'),
                    'created_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                    'created_date' => date('Y-m-d H:i:s') ,
                    'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                    'updated_date' => date('Y-m-d H:i:s')                                    
            );
            
            $this->db->insert('ams_asset_location_info', $ins); 
            redirect($data['s_url']. '/' . $this->uri->segment(2, 0)); 
        }
        
        if($this->input->post('mode') == 'Edit')
        {
            $upd = array(
                    'asset_location_name' => $this->input->post('asset_location_name'), 
                    'asset_location_code' => $this->input->post('asset_location_code'),
                    'status' => $this->input->post('status'), 
                    'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                    'updated_date' => date('Y-m-d H:i:s'),                       
            );
            
            $this->db->where('asset_location_id', $this->input->post('asset_location_id'));
            $this->db->update('ams_asset_location_info', $upd);  
                            
           redirect($data['s_url']. '/' . $this->uri->segment(2, 0)); 
        } 
         
        
        $this->load->library('pagination'); 
        
        $this->db->where('status != ', 'Delete'); 
        $this->db->from('ams_asset_location_info');         
        $data['total_records'] = $cnt  = $this->db->count_all_results();  
        
        $data['sno'] = $this->uri->segment(2, 0);		
        	
        $config['base_url'] = trim(site_url($data['s_url']), '/'. $this->uri->segment(2, 0));
        $config['total_rows'] = $cnt;
        $config['per_page'] = 50;
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
                from ams_asset_location_info as a  
                where a.status != 'Delete'
                order by a.status, a.asset_location_name asc    
                limit ". $this->uri->segment(2, 0) .",". $config['per_page'] ."                
        ";
        
       $data['record_list'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['record_list'][] = $row;     
        } 
        
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('page/master/'. $data['s_url'] ,$data); 
	}
    
    
    public function asset_item_list() 
	{
	    if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect();
        
        if($this->session->userdata(SESS_HD . 'user_type') != 'Admin' and $this->session->userdata(SESS_HD . 'user_type') != 'Manager')
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }   
        	    
        $data['js'] = 'ams-asset-item.inc';  
        $data['s_url'] = 'ams-asset-item-list';  
        $data['title'] = 'Asset Item List';  
        
         
        if($this->input->post('mode') == 'Add')
        {
            $ins = array(
                    'asset_category_id' => $this->input->post('asset_category_id'), 
                    'asset_item_name' => $this->input->post('asset_item_name'), 
                    'asset_item_code' => $this->input->post('asset_item_code'), 
                    'status' => $this->input->post('status'),
                    'created_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                    'created_date' => date('Y-m-d H:i:s') ,
                    'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                    'updated_date' => date('Y-m-d H:i:s')                                    
            );
            
            $this->db->insert('ams_asset_item_info', $ins); 
            redirect($data['s_url']. '/' . $this->uri->segment(2, 0)); 
        }
        
        if($this->input->post('mode') == 'Edit')
        {
            $upd = array(
                    'asset_category_id' => $this->input->post('asset_category_id'), 
                    'asset_item_name' => $this->input->post('asset_item_name'), 
                    'asset_item_code' => $this->input->post('asset_item_code'), 
                    'status' => $this->input->post('status'), 
                    'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                    'updated_date' => date('Y-m-d H:i:s'),                       
            );
            
            $this->db->where('asset_item_id', $this->input->post('asset_item_id'));
            $this->db->update('ams_asset_item_info', $upd);  
                            
           redirect($data['s_url']. '/' . $this->uri->segment(2, 0)); 
        } 
         
        
        $this->load->library('pagination'); 
        
        $this->db->where('status != ', 'Delete'); 
        $this->db->from('ams_asset_item_info');         
        $data['total_records'] = $cnt  = $this->db->count_all_results();  
        
        $data['sno'] = $this->uri->segment(2, 0);		
        	
        $config['base_url'] = trim(site_url($data['s_url']), '/'. $this->uri->segment(2, 0));
        $config['total_rows'] = $cnt;
        $config['per_page'] = 50;
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
                a.* ,
                b.*            
                from ams_asset_item_info as a  
                left join ams_asset_category_info as b on b.asset_category_id = a.asset_category_id
                where a.status != 'Delete'
                order by a.status,b.asset_category_name, a.asset_item_name asc    
                limit ". $this->uri->segment(2, 0) .",". $config['per_page'] ."                
        ";
        
       $data['record_list'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['record_list'][] = $row;     
        } 
        
        
         $sql = "
                select 
                a.asset_category_id,
                a.asset_category_name             
                from ams_asset_category_info as a  
                where a.status = 'Active'  
                order by a.asset_category_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['asset_category_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['asset_category_opt'][$row['asset_category_id']] = $row['asset_category_name'];     
        }
        
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('page/master/'. $data['s_url'] ,$data); 
	} 
    
    public function asset_qrcode_list() 
	{
	    if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect();
        
        if($this->session->userdata(SESS_HD . 'user_type') != 'Admin' and $this->session->userdata(SESS_HD . 'user_type') != 'Manager')
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }   
        	    
        $data['js'] = 'ams-asset-qrcode.inc';  
        $data['s_url'] = 'ams-asset-qrcode-list';  
        $data['title'] = 'Asset QRCode Generate List';  
        
         
        if($this->input->post('mode') == 'Add')
        {
            $ins = array(
                    'asset_category_id' => $this->input->post('asset_category_id'), 
                    'asset_item_id' => $this->input->post('asset_item_id'), 
                    'asset_location_id' => $this->input->post('asset_location_id'), 
                    'asset_item_qty' => $this->input->post('asset_item_qty'), 
                    'status' => $this->input->post('status'),
                    'created_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                    'created_date' => date('Y-m-d H:i:s') ,
                    'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                    'updated_date' => date('Y-m-d H:i:s')                                    
            );
            
            $this->db->insert('ams_asset_item_qrcode_gen_info', $ins); 
            
            $asset_item_qrcode_gen_id = $this->db->insert_id();
            
            $qty = $this->input->post('asset_item_qty');
            
            $sql = "select 
                        ifnull(max(a.asset_item_serial_no),0) as sno  
                        from ams_asset_item_qrcode_info as a  
                        where a.status != 'Delete' 
                        and a.asset_category_id = '".$this->input->post('asset_category_id')."'
                        and a.asset_item_id = '".$this->input->post('asset_item_id')."'
                        and a.asset_location_id = '".$this->input->post('asset_location_id')."'
                    ";
                    
             $query = $this->db->query($sql);
             $sno = 0; 
             foreach($query->result_array() as $row)
             {
                $sno = $row['sno'];      
             }         
            
            for($k = 1; $k<=$qty;$k++){ 
                
                $location_code = $this->input->post('location_code');
                $category_code = $this->input->post('category_code');
                $item_code = $this->input->post('item_code');
                
                $sno1 = str_pad(($sno + $k),3,"0",STR_PAD_LEFT ); 
                
                $qr_code_ctnt = $location_code .'-'. $category_code .'-' . $item_code . '-'. ($sno1);
                $asset_item_serial_no =  ($sno + $k);
                
                $qr = $this->asset_model->generate_qrcode($qr_code_ctnt , 'asset-qr/');
                
                
                $ins = array(
                        'asset_item_qrcode_gen_id' => $asset_item_qrcode_gen_id, 
                        'asset_category_id' => $this->input->post('asset_category_id'), 
                        'asset_item_id' => $this->input->post('asset_item_id'), 
                        'asset_location_id' => $this->input->post('asset_location_id'),  
                        'qr_code_ctnt' => $qr_code_ctnt,
                        'asset_item_serial_no' => $asset_item_serial_no,
                        'qr_path' => $qr['file'],
                        'status' => $this->input->post('status'),
                        'created_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                        'created_date' => date('Y-m-d H:i:s') ,
                        'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                        'updated_date' => date('Y-m-d H:i:s')                                    
                );
                
                $this->db->insert('ams_asset_item_qrcode_info', $ins); 
                
            }
            
            
            redirect($data['s_url']. '/' . $this->uri->segment(2, 0)); 
        }
        
        
        
        $this->load->library('pagination'); 
        
        $this->db->where('status != ', 'Delete'); 
        $this->db->from('ams_asset_item_qrcode_gen_info');         
        $data['total_records'] = $cnt  = $this->db->count_all_results();  
        
        $data['sno'] = $this->uri->segment(2, 0);		
        	
        $config['base_url'] = trim(site_url($data['s_url']), '/'. $this->uri->segment(2, 0));
        $config['total_rows'] = $cnt;
        $config['per_page'] = 50;
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
                a.* ,
                b.* ,
                c.*,
                d.*           
                from ams_asset_item_qrcode_gen_info as a  
                left join ams_asset_category_info as b on b.asset_category_id = a.asset_category_id
                left join ams_asset_item_info as c on c.asset_item_id = a.asset_item_id
                left join ams_asset_location_info as d on d.asset_location_id = a.asset_location_id
                where a.status != 'Delete'
                order by a.status,b.asset_category_name, c.asset_item_name asc    
                limit ". $this->uri->segment(2, 0) .",". $config['per_page'] ."                
        ";
        
       $data['record_list'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['record_list'][] = $row;     
        } 
        
        
        $sql = "
                select 
                a.asset_category_id,
                a.asset_category_name   ,
                a.asset_category_code          
                from ams_asset_category_info as a  
                where a.status = 'Active'  
                order by a.asset_category_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['asset_category_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            //$data['asset_category_opt'][$row['asset_category_id']] = $row['asset_category_name'] . ' - ' . $row['asset_category_code'];     
            $data['asset_category_opt'][] = $row ;     
        }
        
        $sql = "
                select 
                a.asset_location_id,
                a.asset_location_name,
                a.asset_location_code             
                from ams_asset_location_info as a  
                where a.status = 'Active'  
                order by a.asset_location_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['asset_location_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            //$data['asset_location_opt'][$row['asset_location_id']] = $row['asset_location_name'] . ' - ' . $row['asset_location_code'];     
            $data['asset_location_opt'][] = $row ;          
        }
        
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('page/master/'. $data['s_url'] ,$data); 
	}
    
    public function print_qrcode($asset_item_qrcode_gen_id)
	{
	    if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect(); 
        
        
        if($this->session->userdata(SESS_HD . 'user_type') != 'Admin' and $this->session->userdata(SESS_HD . 'user_type') != 'Manager')
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        } 
        
       // $data['js'] = 'ams-asset-qrcode.inc';  
        $data['s_url'] = 'print-qrcode';  
        $data['title'] = 'Asset QRCode Print'; 
        
       $sql = "
                select 
                a.*           
                from ams_asset_item_qrcode_info as a   
                where a.status != 'Delete'
                and a.asset_item_qrcode_gen_id = $asset_item_qrcode_gen_id
                order by a.asset_item_serial_no asc                   
        ";
        
       $data['qrcode'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['qrcode'][] = $row;     
        }
         
        
        $this->load->view('page/master/'. $data['s_url'] ,$data); 
	} 
     
}