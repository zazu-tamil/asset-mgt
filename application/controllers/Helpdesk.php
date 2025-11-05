<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Helpdesk extends CI_Controller {
    
    
   public function hd_category_list()
   {
        if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect();
        	    
        $data['js'] = 'helpdesk/hd_category.inc';  
        $data['s_url'] = 'hd-category-list/' . $this->uri->segment(2, 0);    
        $data['f_url'] = 'hd-category-list';    
        $data['title'] = 'Helpdesk Category List';    
        
        if($this->input->post('mode') == 'Add')
        {
            $ins = array(
                    'hd_category_name' => $this->input->post('hd_category_name'),  
                    'status' => $this->input->post('status')  ,                          
            );
            
            $this->db->insert('pyr_hd_category_info', $ins); 
            redirect($data['s_url']);
        }
        
        if($this->input->post('mode') == 'Edit')
        {
            $upd = array(
                    'hd_category_name' => $this->input->post('hd_category_name'),  
                    'status' => $this->input->post('status')  ,   
            );
            
            $this->db->where('pyr_hd_category_id', $this->input->post('hd_category_id'));
            $this->db->update('hd_category_info', $upd); 
                            
            redirect($data['s_url']); 
        } 
         
        
        $this->load->library('pagination'); 
        
        
        $this->db->where('status != ', 'Delete'); 
        $this->db->from('pyr_hd_category_info');         
        $data['total_records'] = $cnt  = $this->db->count_all_results();  
        
        $data['sno'] = $this->uri->segment(2, 0);		
        	
        $config['base_url'] = trim(site_url($data['s_url']));
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
                from pyr_hd_category_info as a  
                where a.status != 'Delete'
                order by a.status asc , a.hd_category_name asc 
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
        
        $this->load->view('page/helpdesk/'. $data['f_url'],$data); 
    
    } 
    
    public function ticket_list()
   {
        if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect();
        
       
        	    
        $data['js'] = 'helpdesk/ticket_list.inc';  
        $data['s_url'] = 'ticket-list/' . $this->uri->segment(2, 0);    
        $data['f_url'] = 'ticket-list';    
        $data['title'] = 'Support Ticket List';    
        
        if($this->session->userdata(SESS_HD .'user_type') == 'Staff') {
            $where = " ( a.to_user_id = '". $this->session->userdata(SESS_HD .'user_id') ."' 
                            or 
                         a.frm_user_id = '". $this->session->userdata(SESS_HD .'user_id') ."' 
                            or 
                         FIND_IN_SET('". $this->session->userdata(SESS_HD .'user_id') ."', a.share_to) 
                        )";
        }  else {
            $where = " 1=1";
        } 
         
        
        
        
        
        if($this->input->post('mode') == 'Add')
        {
            $config['upload_path'] = 'ticket-doc/';
    	    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            
            $this->load->library('upload', $config);
            
            if ($this->upload->do_upload('attach_doc'))
            {
                $file_array = $this->upload->data();	 
                $attach_doc	= 'ticket-doc/'. $file_array['file_name'];  
            }
            else
            {
                 $attach_doc = '';    
            }
            
            
            $ins = array(
                    'hd_category_id' => $this->input->post('hd_category_id'),  
                    'frm_user_id' => ( $this->session->userdata(SESS_HD .'user_id') != '' ? $this->session->userdata(SESS_HD .'user_id') : 0),  
                    'to_user_id' => $this->input->post('to_user_id'),   
                    'subject' => $this->input->post('subject'),  
                    'description' => $this->input->post('description'),  
                    'priority' => $this->input->post('priority'),  
                    'attach_doc' => $attach_doc,  
                    'status' => "Open",
                    'created_by' => $this->session->userdata(SESS_HD .'user_id'),                          
                    'created_date' => date('Y-m-d H:i:s') ,   
                    'updated_by' => $this->session->userdata(SESS_HD .'user_id'),                          
                    'updated_date' => date('Y-m-d H:i:s') ,                             
            );
            
            $this->db->insert('pyr_hd_ticket_info', $ins); 
            redirect($data['s_url']);
        }
        
        
        $this->load->library('pagination'); 
        
        
        $this->db->where('a.status != ', 'Delete'); 
         
        $this->db->where($where);  
        
        $this->db->from('pyr_hd_ticket_info as a');         
        $data['total_records'] = $cnt  = $this->db->count_all_results();  
        
        $data['sno'] = $this->uri->segment(2, 0);		
        	
        $config['base_url'] = trim(site_url($data['s_url']));
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
                a.* ,
                b.hd_category_name,
                c.user_name as to_user,
                d.user_name as frm_user, 
                count(e.hd_ticket_comment_id) as cnt
                from pyr_hd_ticket_info as a  
                left join pyr_hd_category_info as b on b.hd_category_id = a.hd_category_id   
                left join user_login as c on c.user_id = a.to_user_id   
                left join user_login as d on d.user_id = a.frm_user_id   
                left join pyr_hd_ticket_comment_info as e on e.hd_ticket_id = a.hd_ticket_id   
                where a.status != 'Delete'
                and $where
                group by a.hd_ticket_id
                order by  a.created_date desc 
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
                d.user_id,
                a.employee_id,
                a.employee_code,
                a.employee_name,
                a.employee_category,
                b.department_name as dept,
                c.designation_name as designation
                from pyr_employee_info as a
                left join pyr_department_info as b on b.department_id = a.department_id
                left join pyr_designation_info as c on c.designation_id = a.designation_id
                left join user_login as d on d.ref_id = a.employee_id  
                where a.`status` = 'Active'  and d.user_id != ''
                order by  a.employee_category,
                b.department_name,
                c.designation_name,
                a.employee_name asc 
            "; 
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['employee_opt'][$row['employee_category']][$row['user_id']] =  $row['dept'] . ' - ' . $row['designation'] .' [ ' . $row['employee_name']. ' ]';     
                
        } 
         
        
        
        $sql = "
                select 
                a.hd_category_id,                
                a.hd_category_name             
                from pyr_hd_category_info as a  
                where status = 'Active' 
                order by a.hd_category_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        $data['hd_category_opt'] = array();
       
       
        foreach ($query->result_array() as $row)
        {
            $data['hd_category_opt'][$row['hd_category_id']] = $row['hd_category_name'] ;     
        }
        
        
        $data['priority_opt'] = array('' => 'Select','High' => 'High','Medium' => 'Medium','Low' => 'Low');
        
        $data['pagination'] = $this->pagination->create_links(); 
        
        $this->load->view('page/helpdesk/'. $data['f_url'],$data); 
    
    } 
    
   public function ticket_info($ticket_id)
   {
        if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect();
        
       
        	    
        $data['js'] = 'helpdesk/ticket.inc';  
        $data['s_url'] = 'ticket/' . $this->uri->segment(2, 0);    
        $data['f_url'] = 'ticket';    
        $data['title'] = 'Support Ticket Information';    
        
        
        
        
        if($this->input->post('mode') == 'Add Ticket Comments')
        {
            $config['upload_path'] = 'ticket-doc/';
    	    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            
            $this->load->library('upload', $config);
            
            if ($this->upload->do_upload('attach_doc'))
            {
                $file_array = $this->upload->data();	 
                $attach_doc	= 'ticket-doc/'. $file_array['file_name'];  
            }
            else
            {
                 $attach_doc = '';    
            } 
            
            $ins = array(
                    'hd_ticket_id' => $this->input->post('hd_ticket_id'), 
                    'user_id' => $this->session->userdata(SESS_HD .'user_id'), 
                    'comment' => $this->input->post('comment'),   
                    'attach_doc' => $attach_doc,  
                    'status' => $this->input->post('status'),
                    'created_by' => $this->session->userdata(SESS_HD .'user_id'),                          
                    'created_date' => date('Y-m-d H:i:s') ,   
                    'updated_by' => $this->session->userdata(SESS_HD .'user_id'),                          
                    'updated_date' => date('Y-m-d H:i:s') ,                             
            );
            
            $this->db->insert('pyr_hd_ticket_comment_info', $ins); 
            
            $this->db->where('hd_ticket_id', $this->input->post('hd_ticket_id')); 
            $this->db->update('pyr_hd_ticket_info', array(  'status' => $this->input->post('status') , 
                                                            'updated_by' => $this->session->userdata(SESS_HD .'user_id'),                          
                                                            'updated_date' => date('Y-m-d H:i:s')
                                                          )
                              );  
            
            redirect($data['s_url']);
            
        }
        
        
         
        
         $sql = "
                select 
                a.* ,
                b.hd_category_name,
                c.user_name as to_user,
                d.user_name as frm_user 
                from pyr_hd_ticket_info as a  
                left join pyr_hd_category_info as b on b.hd_category_id = a.hd_category_id  
                left join user_login as c on c.user_id = a.to_user_id   
                left join user_login as d on d.user_id = a.frm_user_id   
                where a.status != 'Delete'
                and a.hd_ticket_id = $ticket_id
                order by  a.created_date desc                 
        "; 
        
        $query = $this->db->query($sql);
         $data['ticket_info'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['ticket_info'] = $row;     
        } 
        
        $sql = "
                select 
                a.*,
                c.user_name as reply_user          
                from pyr_hd_ticket_comment_info as a  
                left join user_login as c on c.user_id = a.user_id  
                where a.status != 'Delete' 
                and a.hd_ticket_id = $ticket_id
                order by a.created_date asc                 
        "; 
        
        $query = $this->db->query($sql);
        $data['ticket_comment_info'] = array();
       
       
        foreach ($query->result_array() as $row)
        {
            $data['ticket_comment_info'][] = $row ;     
        }
        
        $sql = "
                select 
                d.user_id,
                a.employee_id,
                a.employee_code,
                a.employee_name,
                a.employee_category,
                b.department_name as dept,
                c.designation_name as designation
                from pyr_employee_info as a
                left join pyr_department_info as b on b.department_id = a.department_id
                left join pyr_designation_info as c on c.designation_id = a.designation_id
                left join user_login as d on d.ref_id = a.employee_id  
                where a.`status` = 'Active' and d.user_id != ''
                order by  a.employee_category,
                b.department_name,
                c.designation_name,
                a.employee_name asc 
            "; 
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['employee_opt'][$row['employee_category']][$row['user_id']] =  $row['dept'] . ' - ' . $row['designation'] .' [ ' . $row['employee_name']. ' ]';     
                
        } 
         
        
         $data['priority_opt'] = array('' => 'Select','High' => 'High','Medium' => 'Medium','Low' => 'Low'); 
         $data['status_opt'] = array('Open' => 'Open','In-Progress' => 'In-Progress', 'Resolved' => 'Resolved', 'Closed' => 'Closed'); 
        
        $this->load->view('page/helpdesk/'. $data['f_url'],$data); 
    
    } 
    
    
}
?>    