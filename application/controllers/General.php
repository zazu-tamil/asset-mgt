<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {

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
	public function index()
	{
		//$this->load->view('page/dashboard');
        
	} 
    
    public function update_data()  
    {
        $timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
        
        
       $table = $this->input->post('tbl') ;
       $rec_id =$this->input->post('id');
       
       
       if($table == 'ticket-share')
       {
            $this->db->where('hd_ticket_id', $rec_id);
            $this->db->update('pyr_hd_ticket_info', array(   'share_to' => implode(',', $this->input->post('share_to')))); 
            
            echo "Ticket Successfully Shared!!!!"; 
       }
       
       
       if($table == 'approve-leave-request')
       { 
            
            $this->db->where('leave_request_id', $this->input->post('id'));
            $this->db->update('pyr_leave_request_info', 
                        array(
                                'status' => 'Approved',
                                'approved_by' => $this->session->userdata(SESS_HD . 'user_id'),                   
                                'approved_date' => date('Y-m-d H:i:s'),   
                                
                              )); 
                              
           echo 'Record Successfully Updated';  
       }
       
       if($table == 'approve-adv-request')
       { 
            
            $this->db->where('salary_adv_id', $this->input->post('id'));
            $this->db->update('pyr_salary_adv_info', 
                        array(
                                'status' => 'Approved',
                                'approved_by' => $this->session->userdata(SESS_HD . 'user_id'),                   
                                'approved_date' => date('Y-m-d H:i:s'), 
                                'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                   
                                'updated_date' => date('Y-m-d H:i:s'),  
                                
                              )); 
                              
           echo 'Record Successfully Updated';  
       }
       
       if($table == 'reject-adv-request')
       { 
            
            $this->db->where('salary_adv_id', $this->input->post('id'));
            $this->db->update('pyr_salary_adv_info', 
                        array(
                                'status' => 'Rejected',
                                'approved_by' => $this->session->userdata(SESS_HD . 'user_id'),                   
                                'approved_date' => date('Y-m-d H:i:s'), 
                                'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                   
                                'updated_date' => date('Y-m-d H:i:s'),  
                                
                              )); 
                              
           echo 'Record Successfully Updated';  
       }
       
       
       if($table == 'task-status-update')
       { 
            
            $this->db->where('task_id', $this->input->post('id'));
            $this->db->update('crit_task_info', 
                        array(
                                'task_status' => $this->input->post('task_status')
                              )); 
           echo 'Record Successfully Updated';  
       }
       
       if($table == 'customer-domestic-rate')
       {             
            $this->db->where('customer_domestic_rate_id', $rec_id);
            $this->db->update('crit_customer_domestic_rate_info', 
                        array(
                                'status' => 'In-Active' ,
                                'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                                'update_datetime' => date('Y-m-d H:i:s')   
                              )); 
            
            $ins = array(
                    'customer_id' => $this->input->post('customer_id'),
                    'flg_region' => $this->input->post('flg_region'),
                    'flg_state' => $this->input->post('flg_state'),
                    'flg_city' => $this->input->post('flg_city'),
                    'flg_metro' => $this->input->post('flg_metro'),
                    'min_weight' => $this->input->post('min_weight'),
                    'min_charges' => $this->input->post('min_charges'),
                    'addt_weight' => $this->input->post('addt_weight'),
                    'addt_charges' => $this->input->post('addt_charges'),              
                    'c_type' => $this->input->post('c_type'),              
                    'rate_as_on' => date('Y-m-d'),
                    'created_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                    'created_datetime' => date('Y-m-d H:i:s')             
            );
            
            $this->db->insert('crit_customer_domestic_rate_info', $ins);            
       }
       
       if($table == 'received-manifest')
         {       
            $sql = "
                select 
                a.manifest_no ,
                a.parcel_booking_id,
                b.hub_branch_code as dest_hub_code
                from crit_manifest_info as a
                left join crit_parcel_booking_info as c on c.parcel_booking_id = a.parcel_booking_id  
                left join crit_hub_branch_info as b on b.type = 'HUB' and b.state_code = c.dest_state  and b.city_code = c.dest_city
                where concat(c.prefix_lrno, c.lrno) = '".$rec_id ."' and 
                a.to_city_code = '".$this->input->post('city_code') ."' and
                a.m_status = 'Open Manifest' 
            ";
            $query = $this->db->query($sql);
            foreach ($query->result_array() as $row)
            {
                $parcel_booking_id = $row['parcel_booking_id'];
                $dest_hub_code = $row['dest_hub_code'];
                
            }
           $cnt = $query->num_rows($sql);
           
           if($cnt == 1) {
            
            $this->db->where('parcel_booking_id', $parcel_booking_id);
            $this->db->where('m_status', 'Open Manifest');
            $this->db->update('crit_manifest_info', array('received_by' => $this->session->userdata(SESS_HD . 'user_id'),'received_date' => date('Y-m-d H:i:s'),'m_status' => 'Received Manifest'));  
            
            $this->db->where('parcel_booking_id', $parcel_booking_id);
            
            if($dest_hub_code == $this->input->post('city_code')) {
                $tracking_status = $this->get_tracking_status_name('4');
                $this->db->where('parcel_booking_id', $parcel_booking_id);
                $this->db->update('crit_parcel_booking_info', array('status' => $this->get_tracking_status_name('4') ,'status_city_code' => $this->input->post('city_code') ));   
            } else {
                $tracking_status = $this->get_tracking_status_name('3');
                $this->db->where('parcel_booking_id', $parcel_booking_id);
                $this->db->update('crit_parcel_booking_info', array('status' => $this->get_tracking_status_name('3') ,'status_city_code' => $this->input->post('city_code') ));   
            }
           
            $ins = array(
                        'parcel_booking_id' => $parcel_booking_id,
                        'tracking_status' => $tracking_status ,                          
                        'city_code' => $this->input->post('city_code')  ,                          
                        'status_date' => date('Y-m-d')  ,                          
                        'status_time' => date('H:i:s'),                          
                        'remarks' => '', 
                        'created_by' =>  $this->session->userdata(SESS_HD . 'user_id')  ,
                        'created_datetime' => date('Y-m-d H:i:s')
                        );
             $this->db->insert('crit_parcel_tracking_info', $ins);  
           
             echo 'Record Successfully Updated'; 
             
            } else {
                echo 'Invalid LRNo'; 
            }
         }
         
         
         if($table == 'parcel-HUB-pickup'){
            
            $this->db->where('parcel_booking_id', $rec_id);
            $this->db->update('crit_parcel_booking_info', array('status' => $this->get_tracking_status_name('2') ,'status_city_code' => $this->input->post('hub_code') ));   
           
           
            $ins = array(
                        'parcel_booking_id' => $rec_id,
                        'tracking_status' => $this->get_tracking_status_name('2') ,                          
                        'city_code' => $this->input->post('hub_code')  ,                          
                        'status_date' => date('Y-m-d')  ,                          
                        'status_time' => date('H:i:s'),                          
                        'remarks' => 'HUB [ '. $this->input->post('hub_code').' ]', 
                        'created_by' =>  $this->session->userdata(SESS_HD . 'user_id')  ,
                        'created_datetime' => date('Y-m-d H:i:s')
                        );
             $this->db->insert('crit_parcel_tracking_info', $ins);  
             
              echo 'Record Successfully Updated'; 
         }
          
          if($table == 'parcel-despatch-h2B'){
            
            $this->db->where('parcel_booking_id', $rec_id);
            $this->db->update('crit_parcel_booking_info', array('status' => $this->get_tracking_status_name('5') ,'status_city_code' => $this->input->post('branch_code') ));   
           
           
            $ins = array(
                        'parcel_booking_id' => $rec_id,
                        'tracking_status' => $this->get_tracking_status_name('5') ,                          
                        'city_code' => $this->input->post('branch_code')  ,                          
                        'status_date' => date('Y-m-d')  ,                          
                        'status_time' => date('H:i:s'),                          
                        'remarks' => 'HUB to Branch [ '. $this->input->post('branch_code').' ]', 
                        'created_by' =>  $this->session->userdata(SESS_HD . 'user_id')  ,
                        'created_datetime' => date('Y-m-d H:i:s')
                        );
             $this->db->insert('crit_parcel_tracking_info', $ins);  
             
              echo 'Record Successfully Updated'; 
         }
         if($table == 'parcel-branch-inward'){
            
            $this->db->where('parcel_booking_id', $rec_id);
            $this->db->update('crit_parcel_booking_info', array('status' => $this->get_tracking_status_name('6') ,'status_city_code' => $this->input->post('branch_code') ));   
           
           
            $ins = array(
                        'parcel_booking_id' => $rec_id,
                        'tracking_status' => $this->get_tracking_status_name('6') ,                          
                        'city_code' => $this->input->post('branch_code')  ,                          
                        'status_date' => date('Y-m-d')  ,                          
                        'status_time' => date('H:i:s'),                          
                        'remarks' => ' Reached Branch Office [ '. $this->input->post('branch_code').' ]', 
                        'created_by' =>  $this->session->userdata(SESS_HD . 'user_id')  ,
                        'created_datetime' => date('Y-m-d H:i:s')
                        );
             $this->db->insert('crit_parcel_tracking_info', $ins);  
             
              echo 'Record Successfully Updated'; 
         }
         
         
        
    }
    
    public function franchises_enquiry()  {
        
        
          $ins = array(
                    'f_name' => $this->input->post('fname'), 
                    'mobile' => $this->input->post('mobile'), 
                    'city' => $this->input->post('city'), 
                    'msg' => $this->input->post('msg'), 
                    'office_space' => $this->input->post('office_space'), 
                    'work_experiance' => $this->input->post('work_experiance'),                       
                    'enqury_datetime' => date('Y-m-d H:i:s'),
                    'status' => 'Pending'            
            );
            
            $this->db->insert('crit_franchise_enquiry_info', $ins); 
            
            //return $this->db->insert_id();
            echo "Enquiry has been succesfully send...Our Execute will contact you soon !!!!!";
    }
    
    
    public function insert_data()  
    {
        //if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect();
        
        $timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
        
        
       $table = $this->input->post('tbl') ; 
       
       if($table == 'co-loader')
       {    
            $ins = array(
                    'co_loader_name' => $this->input->post('co_loader_name'), 
                    'created_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                    'created_datetime' => date('Y-m-d H:i:s')             
            );
            
            $this->db->insert('crit_co_loader_info', $ins); 
            
            return $this->db->insert_id();         
       } 
       
       if($table == 'open-manifest')
       {    
        
            $sql = "
                select 
                manifest_no 
                from crit_manifest_info where 
                manifest_date = '".$this->input->post('manifest_date') ."' and 
                from_city_code = '".$this->input->post('from_city_code') ."' and 
                to_city_code = '".$this->input->post('to_city_code') ."' and
                m_status = 'Open Manifest' 
            ";
            $query = $this->db->query($sql);

           $cnt = $query->num_rows($sql);

            if($cnt == 0) {
                 $ins = array(
                            'manifest_no' => $this->input->post('manifest_no'),
                            'manifest_date' => $this->input->post('manifest_date')  ,                          
                            'manifest_type' => $this->input->post('manifest_type')  ,                          
                            'from_city_code' => $this->input->post('from_city_code')  ,                          
                            'to_city_code' => $this->input->post('to_city_code'),                          
                            'co_loader_id' => $this->input->post('co_loader_id'),                          
                            'co_loader_awb_no' => $this->input->post('co_loader_awb_no'),                          
                            'co_loader_remarks' => $this->input->post('co_loader_remarks'),                          
                            'awbno' => $this->input->post('awbno') ,                          
                            'm_status' => 'Open Manifest',  
                            'despatch_by' =>  $this->session->userdata(SESS_HD . 'user_id')  
                            );
                 $this->db->insert('crit_manifest_info', $ins);  
             }   
            
                     
       } 
       if($table == 'awb_tracking_info')
       {    
             $ins = array(
                        'awbno' => $this->input->post('awbno'),
                        'tracking_status' => $this->input->post('tracking_status')  ,                          
                        'city_code' => $this->input->post('city_code')  ,                          
                        'status_date' => $this->input->post('status_date')  ,                          
                        'status_time' => $this->input->post('status_time'),                          
                        'remarks' => $this->input->post('remarks'), 
                        'created_by' =>  $this->session->userdata(SESS_HD . 'user_id') ,
                        'created_datetime' => date('Y-m-d H:i:s') 
                        );
             $this->db->insert('crit_awb_tracking_info', $ins);      
                     
       } 
        
        
    }
    
     
    
    public function get_parcel_charges()
    {
        $dest_state = $this->input->post('dest_state'); 
        $weight = $this->input->post('weight');
        
        $sql ="
                select
                 if(a.min_weight >= '". $weight ."', (a.min_weight * a.rate_per_kg) , ('". $weight ."' * a.rate_per_kg) ) as chrg_amount,
                 a.lr_charges,
                 a.loading_charges,
                 a.to_pay_charges
                from crit_parcel_rate_info as a
                where a.`status` = 'Active' 
                and a.destination_state = '". $dest_state ."' 
                order by a.parcel_rate_id desc 
        ";
        
        $query = $this->db->query($sql);
        
        $charges = array();
        
        foreach ($query->result_array() as $row)
        {
          $charges = $row ;    
        }  
        
        $charges['sql'] = $sql;
        
        header('Content-Type: application/x-json; charset=utf-8');
        
        echo (json_encode($charges)); 
        
    }
    
    public function get_calender_data()
    {
        $tbl = $this->input->post('custom_param1'); 
        $id = $this->input->post('custom_param2');
        $param3 = $this->input->post('custom_param3');
        $param4 = $this->input->post('custom_param4');
        //$id = 1; 
        
       if($tbl == 'leave-request-calender')
       {
         
          /*  
          $query = $this->db->query(" 
                select 
                a.leave_request_id as id,
                'A' as tbl,
                concat('L: ' , b.leave_type, a.leave_request_id) as title,
                b.leave_date as start ,
                concat('Reason : ',b.reason ,'<br>Status : ', b.status ,'<br>Comment : ', ifnull(b.comments,'-')) as description, 
                CASE
                    WHEN b.`status`=  'Pending' THEN 'Orange' 
                    WHEN b.`status`=  'Approved' THEN 'Green' 
                    WHEN b.`status`=  'Rejected' THEN 'Red' 
                    ELSE 'Black'
                END AS color
                from pyr_leave_request_info as a
                left join pyr_leave_req_date_info as b on b.leave_request_id = a.leave_request_id
                where a.employee_id = '". $id ."'  
                and a.`status` != 'Delete' and b.`status` != 'Delete'
                order by b.leave_date asc
                 
            ");  
            */
          if($param3 != '') 
          {
            $sql = " 
                select 
                a.leave_request_id as id,
                'L' as tbl,
                concat('L: ' , a.leave_type) as title,
                a.leave_date as start ,
                a.status as status,
                concat('Reason : ',a.reason ,'<br>Status : ', a.status ,'<br>Comment : ', ifnull(a.comments,'-')) as description, 
                CASE
                WHEN a.`status`=  'Pending' THEN 'Orange' 
                WHEN a.`status`=  'Approved' THEN 'Green' 
                WHEN a.`status`=  'Rejected' THEN 'Red' 
                ELSE 'Black'
                END AS color
                from pyr_staff_leave_request_info as a 
                where a.employee_id = '". $id ."'  
                and date_format(a.leave_date,'%Y-%m') = '". $param3 ."'  
                and a.`status` != 'Delete'  
                order by a.leave_date asc 
            ";
            } else {
                 $sql = " 
                    select 
                    a.leave_request_id as id,
                    'L' as tbl,
                    concat('L: ' , a.leave_type) as title,
                    a.leave_date as start ,
                    a.status as status,
                    concat('Reason : ',a.reason ,'<br>Status : ', a.status ,'<br>Comment : ', ifnull(a.comments,'-')) as description, 
                    CASE
                    WHEN a.`status`=  'Pending' THEN 'Orange' 
                    WHEN a.`status`=  'Approved' THEN 'Green' 
                    WHEN a.`status`=  'Rejected' THEN 'Red' 
                    ELSE 'Black'
                    END AS color
                    from pyr_staff_leave_request_info as a 
                    where a.employee_id = '". $id ."'   
                    and a.`status` != 'Delete'  
                    order by a.leave_date asc 
                ";
            }
            
             $query = $this->db->query($sql);  
               
             
           $rec_list = array();  
           //$rec_list['sql'] = $sql;  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[] = $row;      
            }            
       }   
        
      
       if($tbl == 'holidays-list')
       {
           
          $query = $this->db->query(" 
                select 
                a.holiday_id as id,
                'H' as tbl,
                concat('H: ' ,a.holiday_det) as title,
                a.holiday_date as start , 
                'Holiday' as description,
                'red' AS color
                from pyr_holidays_info as a 
                where  a.`status` != 'Delete'  
                order by a.holiday_date asc
                 
            ");  
               
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[] = $row;      
            }            
       } 
       
       if($tbl == 'salary-advance')
       {
          if($param3 != '') 
              $where = " date_format(a.adv_required_date,'%Y-%m') = '". $param3 ."' and a.`status` = 'Approved'";
          else    
              $where = " 1=1 ";
           
          $query = $this->db->query(" 
                select 
                a.salary_adv_id as id,
                'Adv' as tbl,
                concat('SAL-ADV',' : ' , a.adv_amount) as title,
                a.adv_required_date as start , 
                concat(a.adv_amount , '<br>', a.remarks ,'<br>',a.status) as description,
                (
                    CASE a.status 
                        when 'Pending' then 'Red'
                        when 'Approved' then 'Green'
                    else 
                        'black'
                    END  
                ) AS color
                from pyr_salary_adv_info as a 
                where  a.`status` != 'Delete'  
                and a.employee_id = '". $id ."'
                and $where
                order by a.adv_required_date asc
                 
            ");  
               
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[] = $row;      
            }            
       } 
       
       
       if($tbl == 'loan-request')
       {
           
          $query = $this->db->query(" 
                select 
                a.emp_loan_id as id,
                'Loan' as tbl,
                concat('Loan',' : ' , a.loan_amount) as title,
                a.loan_required_date as start , 
                concat('Percentage: ' , a.loan_pct , '%<br>Tenure: ', a.loan_tenure ,' Months<br>EMI : ',a.loan_emi,'<br>Status : ',a.status) as description,
                (
                    CASE a.status 
                        when 'Pending' then 'Red'
                        when 'Approved' then 'Green'
                    else 
                        'black'
                    END  
                ) AS color
                from pyr_emp_loan_info as a 
                where  a.`status` != 'Delete'  
                and a.employee_id = '". $id ."'
                order by a.loan_required_date asc
                 
            ");  
               
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[] = $row;      
            }            
       } 
       
       if($tbl == 'attendance')
       {
           
          if($param3 != '') 
          {
              $sql = "  
                    select 
                    a.emp_attendance_id as id,
                    'A' as tbl,
                    'A: In & Out' as title,
                    DATE_FORMAT(a.in_time,'%Y-%m-%d') as start ,
                    concat('In : ',TIME_FORMAT(a.in_time,'%h:%i %p') ,'<br>Out : ',TIME_FORMAT(a.out_time,'%h:%i %p') ,'<br>Late Hrs : ', TIME_FORMAT(a.late_time,'%H:%i') ) as description, 
                    'Blue' AS color
                    from pyr_emp_attendance_info as a
                    left join pyr_employee_info as b on b.employee_code = a.employee_code
                    where b.employee_id = '". $id ."'  
                    and date_format(a.in_time,'%Y-%m') between '". $param3 ."' and '". $param3 ."'   
                    and a.`status` != 'Delete' and b.`status` != 'Delete'
                    order by DATE_FORMAT(a.in_time,'%Y-%m-%d')  asc
                "; 
            } else {
                
                $sql = "  
                    select 
                    a.emp_attendance_id as id,
                    'A' as tbl,
                    'A: In & Out' as title,
                    DATE_FORMAT(a.in_time,'%Y-%m-%d') as start ,
                    concat('In : ',TIME_FORMAT(a.in_time,'%h:%i %p') ,'<br>Out : ',TIME_FORMAT(a.out_time,'%h:%i %p') ,'<br>Late Hrs : ', TIME_FORMAT(a.late_time,'%H:%i') ) as description, 
                    'Blue' AS color
                    from pyr_emp_attendance_info as a
                    left join pyr_employee_info as b on b.employee_code = a.employee_code
                    where b.employee_id = '". $id ."'   
                    and a.`status` != 'Delete' and b.`status` != 'Delete'
                    order by DATE_FORMAT(a.in_time,'%Y-%m-%d')  asc
                "; 
            }
           
          $query = $this->db->query($sql);  
               
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[] = $row;      
            }            
       } 
           
       // $charges['sql'] = $sql;
        
        header('Content-Type: application/x-json; charset=utf-8');
        
        echo (json_encode($rec_list)); 
         
    }
    
    public function get_international_rate_calc()
    {
        $country = $this->input->post('country'); 
        $pkg_type = $this->input->post('pkg_type'); 
        $weight = $this->input->post('weight');
        
        $sql ="
                select 
                a.international_service_provider_id,
                c.country_name as country,
                d.package_type_name as package_type,
                e.package_weight_range as package_weight,
                b.international_service_provider,
                b.logo_url,
                cast((a.rate + (a.rate * b.addt_percentage /100)) as decimal(12,2)) as service_provider_rate1 ,
                a.rate as service_provider_rate ,
                ((a.rate + (a.rate * b.addt_percentage /100))   * b.cp_percentage / 100) cp_charge1,
                (a.rate * b.cp_percentage / 100) cp_charge,
                ((a.rate + (a.rate * b.addt_percentage /100))   * b.dc_percentage / 100) dc_charge1  ,
                (a.rate  * b.dc_percentage / 100) dc_charge  ,
                cast(((a.rate + (a.rate * b.addt_percentage /100)) + ((a.rate + (a.rate * b.addt_percentage /100))   * b.cp_percentage / 100)) as decimal(12,2)) as cp_rate1,
                cast(a.rate  + (a.rate  * b.cp_percentage / 100 ) as decimal(12,2)) as cp_rate,
                cast(((a.rate + (a.rate * b.addt_percentage /100)) + ((a.rate + (a.rate * b.addt_percentage /100))   * b.dc_percentage / 100)) as decimal(12,2)) as dc_rate1, 
                cast(a.rate  + (a.rate  * b.dc_percentage / 100 ) as decimal(12,2)) as dc_rate 
                from crit_international_rate_info as a
                left join crit_international_service_provider_info as b on b.international_service_provider_id = a.international_service_provider_id
                left join crit_country_info as c on c.country_id = a.country_id
                left join crit_package_type_info as d on d.package_type_id = a.package_type_id
                left join crit_package_weight_info as e on e.package_weight_id = a.package_weight_id
                where a.country_id = $country
                and a.package_type_id = $pkg_type
                and a.package_weight_id = $weight
                and a.`status` = 'Active' and b.`status` = 'Active'
                order by service_provider_rate desc , b.international_service_provider 
        ";
        
        $query = $this->db->query($sql);
        
        $charges = array();
        
        foreach ($query->result_array() as $row)
        {
          $charges['charges'][] = $row ;    
        }  
        
        $charges['sql'] = $sql;
        
        header('Content-Type: application/x-json; charset=utf-8');
        
        echo (json_encode($charges));
        
        
    }
    
    public function get_international_rate_calc_v2()
    {
        $country = $this->input->post('country'); 
        $pkg_type = $this->input->post('pkg_type'); 
        $weight = $this->input->post('weight');
        //$channel = $this->input->post('channel');
        
        $sql =" 
                select 
                a.international_service_provider_id,
                b.international_service_provider,
                b.logo_url,
                b.fsc_percentage,
                b.gst_percentage,
                b.cp_percentage,
                b.dc_percentage,
                b.agent_percentage, 
                c.covid_chrg_per_kg,
                a.rate as base_rate,
                (e.package_weight_range * c.covid_chrg_per_kg) as covid_chrgs,
                round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2) as fsc_chrgs,
                round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2) as gst_chrgs,
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) as sp_chrgs,
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) + 
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) * b.cp_percentage / 100
                ),2)),2) as cp_rate,
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) + 
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) * b.agent_percentage / 100
                ),2) ),2) as agent_rate ,
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) + 
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) * b.dc_percentage / 100
                ),2) ),2) as dc_rate
                from crit_international_rate_info_v2 as a
                left join crit_international_service_provider_info as b on b.international_service_provider_id = a.international_service_provider_id
                left join crit_sp_zone_country_info as c on c.intl_sp_id = a.international_service_provider_id and c.zone_id = a.zone_id
                left join crit_package_type_info as d on d.package_type_id = a.package_type_id
                left join crit_package_weight_info as e on e.package_weight_id =  a.package_weight_id and e.package_type_id = a.package_type_id
                left join crit_country_info as f on FIND_IN_SET(f.country_id,c.country_ids)
                where a.`status` = 'Active' and b.`status` = 'Active' and c.`status` = 'Active' and d.`status` = 'Active' and e.`status` = 'Active'
                and f.`status` = 'Active' and a.rate > 0
                and a.package_type_id = '". $pkg_type . "' 
                and a.package_weight_id = '".$weight ."' 
                and f.country_id = '".$country ."'
                group by a.international_service_provider_id 
                order by b.international_service_provider 
        ";
        
        $query = $this->db->query($sql);
        
        $charges = array();
        
        foreach ($query->result_array() as $row)
        {
          $charges['charges'][] = $row ;    
        }  
        
        $charges['sql'] = $sql;
        
        header('Content-Type: application/x-json; charset=utf-8');
        
        echo (json_encode($charges));
        
        
    }
    
    public function get_international_rate_calc_v3()
    {
        $country = $this->input->post('country'); 
        $pkg_type = $this->input->post('pkg_type'); 
        $weight = $this->input->post('weight');
        $ch_type = $this->input->post('ch_type');
        $ch_id = $this->input->post('ch_id');
        if($ch_type == 'AG') {
            $sql =" 
                select 
                a.international_service_provider_id,
                b.international_service_provider,
                b.logo_url,
                b.fsc_percentage,
                b.gst_percentage,
                b.cp_percentage,
                b.dc_percentage,                 
                g.intl_percentage as agent_percentage, 
                c.covid_chrg_per_kg,
                a.rate as base_rate,
                (e.package_weight_range * c.covid_chrg_per_kg) as covid_chrgs,
                round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2) as fsc_chrgs,
                round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2) as gst_chrgs,
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) as sp_chrgs,
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) + 
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) * b.cp_percentage / 100
                ),2)),2) as cp_rate,
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) + 
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) * g.intl_percentage / 100
                ),2) ),2) as agent_rate ,
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) + 
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) * b.dc_percentage / 100
                ),2) ),2) as dc_rate
                from crit_international_rate_info_v2 as a
                left join crit_international_service_provider_info as b on b.international_service_provider_id = a.international_service_provider_id
                left join crit_sp_zone_country_info as c on c.intl_sp_id = a.international_service_provider_id and c.zone_id = a.zone_id
                left join crit_package_type_info as d on d.package_type_id = a.package_type_id
                left join crit_package_weight_info as e on e.package_weight_id =  a.package_weight_id and e.package_type_id = a.package_type_id
                left join crit_country_info as f on FIND_IN_SET(f.country_id,c.country_ids) 
                left join crit_intl_agent_info as g on g.agent_id = '" . $ch_id ."'  
                where a.`status` = 'Active' and b.`status` = 'Active' and c.`status` = 'Active' and d.`status` = 'Active' and e.`status` = 'Active'
                and f.`status` = 'Active' and a.rate > 0
                and a.package_type_id = '". $pkg_type . "' 
                and a.package_weight_id = '".$weight ."' 
                and f.country_id = '".$country ."'
                group by a.international_service_provider_id 
                order by b.international_service_provider 
        ";
        } else {
        $sql =" 
                select 
                a.international_service_provider_id,
                b.international_service_provider,
                b.logo_url,
                b.fsc_percentage,
                b.gst_percentage,
                b.cp_percentage,
                b.dc_percentage,
                 
                b.agent_percentage, 
                c.covid_chrg_per_kg,
                a.rate as base_rate,
                (e.package_weight_range * c.covid_chrg_per_kg) as covid_chrgs,
                round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2) as fsc_chrgs,
                round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2) as gst_chrgs,
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) as sp_chrgs,
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) + 
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) * b.cp_percentage / 100
                ),2)),2) as cp_rate,
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) + 
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) * b.agent_percentage / 100
                ),2) ),2) as agent_rate ,
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) + 
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) * b.dc_percentage / 100
                ),2) ),2) as dc_rate
                from crit_international_rate_info_v2 as a
                left join crit_international_service_provider_info as b on b.international_service_provider_id = a.international_service_provider_id
                left join crit_sp_zone_country_info as c on c.intl_sp_id = a.international_service_provider_id and c.zone_id = a.zone_id
                left join crit_package_type_info as d on d.package_type_id = a.package_type_id
                left join crit_package_weight_info as e on e.package_weight_id =  a.package_weight_id and e.package_type_id = a.package_type_id
                left join crit_country_info as f on FIND_IN_SET(f.country_id,c.country_ids) 
                where a.`status` = 'Active' and b.`status` = 'Active' and c.`status` = 'Active' and d.`status` = 'Active' and e.`status` = 'Active'
                and f.`status` = 'Active' and a.rate > 0
                and a.package_type_id = '". $pkg_type . "' 
                and a.package_weight_id = '".$weight ."' 
                and f.country_id = '".$country ."'
                group by a.international_service_provider_id 
                order by b.international_service_provider 
        ";
        }
        
        $query = $this->db->query($sql);
        
        $charges = array();
        
        foreach ($query->result_array() as $row)
        {
          $charges['charges'][] = $row ;    
        }  
        
        $charges['sql'] = $sql;
        
        header('Content-Type: application/x-json; charset=utf-8');
        
        echo (json_encode($charges));
        
        
    }
    
    public function get_international_rate_web()
    {
        $country = $this->input->post('country'); 
        $pkg_type = $this->input->post('pkg_type'); 
        $weight = $this->input->post('weight');
        $mobile = $this->input->post('mobile');
        
        $timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
        
       /* $sql ="
                select
                a.rate,
                b.international_service_provider,
                c.company,
                b.dc_percentage,
                b.agent_percentage,
                if(c.contact_person != ''  ,  b.agent_percentage , b.dc_percentage ) as pert,
                round((a.rate + (a.rate * (if( c.contact_person != ''   , b.agent_percentage , b.dc_percentage ) /100))),2) as charges
                from crit_international_rate_info as a
                left join crit_international_service_provider_info as b on b.international_service_provider_id = a.international_service_provider_id
                left join crit_agent_info as c on c.mobile = '7092889602' and c.`status` = 'Active'
                 where a.country_id = $country
                and a.package_type_id = $pkg_type
                and a.package_weight_id = $weight
                and a.`status` = 'Active' and b.`status` = 'Active'
                order by a.rate desc limit 1  
        "; */
        /*
        $sql ="
                select 
                round((a.rate + (a.rate * (if( c.contact_person != ''   , b.agent_percentage , b.dc_percentage ) /100))),2) as charges
                from crit_international_rate_info as a
                left join crit_international_service_provider_info as b on b.international_service_provider_id = a.international_service_provider_id
                left join crit_intl_agent_info as c on c.mobile = '". $mobile."' and c.`status` = 'Active'
                 where a.country_id = '".$country ."'
                and a.package_type_id = '".$pkg_type."'
                and a.package_weight_id = '".$weight ."'
                and a.`status` = 'Active' and b.`status` = 'Active'
                order by a.rate desc limit 1  
                
        "; */
        
        $sql = "
                select 
                a.international_service_provider_id as service_provider_id,
                b.international_service_provider as service_provider,
                if(g.agent_id is null, 'DC', 'AG') as channel_type,
                (ifnull(g.agent_id, 0)) as channel_id,
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) + 
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) * g.intl_percentage / 100
                ),2) ),2) as agent_rate ,
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) + 
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) * b.dc_percentage / 100
                ),2) ),2) as dc_rate,
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) + 
                round((
                (
                a.rate +
                (e.package_weight_range * c.covid_chrg_per_kg) +
                (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2)) +
                (round((
                (
                 (a.rate + (e.package_weight_range * c.covid_chrg_per_kg) + (round(((a.rate + (e.package_weight_range * c.covid_chrg_per_kg)) * b.fsc_percentage /100),2))) 
                ) * b.gst_percentage / 100
                ),2)) 
                ) * ( ifnull(g.intl_percentage, b.dc_percentage) )  / 100
                ),2) ),0) as amount
                from crit_international_rate_info_v2 as a
                left join crit_international_service_provider_info as b on b.international_service_provider_id = a.international_service_provider_id
                left join crit_sp_zone_country_info as c on c.intl_sp_id = a.international_service_provider_id and c.zone_id = a.zone_id
                left join crit_package_type_info as d on d.package_type_id = a.package_type_id
                left join crit_package_weight_info as e on e.package_weight_id =  a.package_weight_id and e.package_type_id = a.package_type_id
                left join crit_country_info as f on FIND_IN_SET(f.country_id,c.country_ids) 
                left join crit_intl_agent_info as g on g.mobile = '" . $mobile ."'  
                where a.`status` = 'Active' and b.`status` = 'Active' and c.`status` = 'Active' and d.`status` = 'Active' and e.`status` = 'Active'
                and f.`status` = 'Active' and a.rate > 0
                and a.package_type_id = '". $pkg_type . "' 
                and a.package_weight_id = '".$weight ."' 
                and f.country_id = '".$country ."'
                group by a.international_service_provider_id 
                order by b.international_service_provider 
        ";
        
        
        
        $query = $this->db->query($sql);
        
        $charges = array();
        $channel_type = '';
        $remarks = array(); 
        
        foreach ($query->result_array() as $row)
        {
          $charges[] = $row  ;   
          $channel_type = $row['channel_type']; 
          $channel_id = $row['channel_id']; 
          $remarks[] =  $row['service_provider'].' : Rs.' . number_format($row['amount'],2); 
        }  
        
        // $charges['sql'] = $sql;
        
        if(!empty($charges)) {
            $ins = array(
						  'country_id' => $country,
						  'package_type_id'  => $pkg_type,
						  'package_weight_id' => $weight, 
						  'channel_type' => $channel_type,
						  'channel_id' => $channel_id,
						  'created_date' => date('Y-m-d H:i:s'), 
						  'remarks'  => implode('<br>', $remarks),
						  'mobile'  => $mobile, 
						  );
			$this->db->insert('crit_visitor_intl_rate_check_list', $ins);
         }
        
        header('Content-Type: application/x-json; charset=utf-8');
        
        echo (json_encode($charges));
        
        
    }
    
    public function get_ts_charges()
    {
        $origin_pincode = $this->input->post('origin_pin');
        $dest_pincode = $this->input->post('dest_pin'); 
        $weight = $this->input->post('weight');
        $ts_mode = $this->input->post('ts_mode');
        
        $sql = "
             select 
            (d.min_charges * ceil('". $weight."')) as ts_amt ,
            (d.min_charges * ceil('". $weight."') * a.fsc_percentage /100 ) as fsc_amt,
            (
                (
                    (d.min_charges * ceil('". $weight."')) 
                     +
                    (d.min_charges * ceil('". $weight."') * a.fsc_percentage /100 )
                ) * (a.gst_percentage / 100)
            ) as gst_amt,
            round
            (
                (d.min_charges * ceil('". $weight."')) 
                +
                (
                    (d.min_charges * ceil('". $weight."') * a.fsc_percentage /100 )
                )
                +
                (
                    (
                        (d.min_charges * ceil('". $weight."')) 
                         +
                        (d.min_charges * ceil('". $weight."') * a.fsc_percentage /100 )
                    ) * (a.gst_percentage / 100)
                ) 
            ,2) as tot_ts_charges 
            from crit_cc_servicable_pincode_info as b  
            left join ( select z.fsc_percentage , z.gst_percentage from  crit_fsc_info as z where z.status = 'Active' order by z.as_on_date desc limit 1) as a on 1=1
            left join crit_cc_servicable_pincode_info as c on 1=1
            left join crit_transhipment_rate_info as d on 
            	d.flg_region = (if(b.zone = c.zone,1,0))
            	and d.flg_state = (if(b.state = c.state,1,0)) 
            	and d.flg_city = (if(b.district = c.district,1,0))             
            	and (if(b.zone = c.zone,1,d.flg_metro = (if(c.metro = 'Y',1,0)))) 
            	and d.from_weight <= '". $weight."' and d.to_weight >= '". $weight."'
            where b.pincode = '". $origin_pincode ."' and c.pincode = '". $dest_pincode ."' 
            and d.c_type = '". $ts_mode ."'
        
        ";
         
        $query = $this->db->query($sql);
        
        $charges = array();
        
        foreach ($query->result_array() as $row)
        {
          $charges = $row ;    
        }  
        
        //$charges['sql'] = $sql;
        
        header('Content-Type: application/x-json; charset=utf-8');
        
        echo (json_encode($charges));
        
    }
    
    public function get_to_pay_charges()
    {
        $charges = $this->input->post('charges');
         
        
        $sql = "
              select 
                a.to_pay_charges
                from crit_to_pay_charges_info as a
                where a.`status` = 'Active'
                and a.to_pay_amt_from <= '". $charges."' and a.to_pay_amt_to >= '". $charges."'  
        
        ";
         
        $query = $this->db->query($sql);
        
        $charges = array();
        
        foreach ($query->result_array() as $row)
        {
          $charges = $row ;    
        }  
        
       // $charges['sql'] = $sql;
        
        header('Content-Type: application/x-json; charset=utf-8');
        
        echo (json_encode($charges));
        
    }
    
    
    public function get_courier_charges()
    {
        //$booking_id = $this->input->post('booking_id');
        $origin_pincode = $this->input->post('origin_pincode');
        $dest_pincode = $this->input->post('dest_pincode');
        $consignor_id = $this->input->post('consignor_id');
        $weight = $this->input->post('weight');
        $c_type = $this->input->post('c_type');
        
       /* $sql = "
            select 
            a.booking_id,
            a.awbno,
            a.origin_pincode,
            a.origin_state_code,
            a.origin_city_code,
            a.dest_pincode,
            a.dest_state_code,
            a.origin_city_code,
            c.min_weight,
            c.min_charges,
            c.addt_weight,
            c.addt_charges,
            a.weight,
            a.no_of_pieces,
            if(c.min_weight <= a.weight, (a.weight - c.min_weight) , 0 ) as addt_wt,
            if(c.min_weight <= a.weight, CEILING((a.weight - c.min_weight) / c.addt_weight) , 0 ) as addt_no_of_wt,
            if(c.min_weight <= a.weight, CEILING((a.weight - c.min_weight) / c.addt_weight) * c.addt_charges  , 0 ) as addt_charges_value,
            (c.min_charges + (if(c.min_weight <= a.weight, CEILING((a.weight - c.min_weight) / c.addt_weight) * c.addt_charges  , 0 ))) as tot_charges
            from crit_booking_info as a
            left join crit_customer_domestic_rate_info as c on c.customer_id = a.consignor_id and c.flg_state = (if(a.origin_state_code = a.dest_state_code,1,0)) and c.flg_city = (if(a.origin_city_code = a.dest_city_code,1,0)) and c.`status` = 'Active'
            where a.booking_id = '". $booking_id ."'  and c.c_type = 'Air'
        
        "; */
        
        
        $this->db->query('SET SQL_BIG_SELECTS=1');
        
        /*
         $sql = "
            select 
            a.origin_state_code,
            a.origin_city_code, 
            b.dest_state_code,
            b.dest_city_code,
            c.min_weight,
            c.min_charges,
            c.addt_weight,
            c.addt_charges, 
            if(c.min_weight <= '".$weight."', ('".$weight."' - c.min_weight) , 0 ) as addt_wt,
            if(c.min_weight <= '".$weight."', CEILING(('".$weight."' - c.min_weight) / c.addt_weight) , 0 ) as addt_no_of_wt,
            if(c.min_weight <= '".$weight."', CEILING(('".$weight."' - c.min_weight) / c.addt_weight) * c.addt_charges  , 0 ) as addt_charges_value,
            (c.min_charges + (if(c.min_weight <= '".$weight."', CEILING(('".$weight."' - c.min_weight) / c.addt_weight) * c.addt_charges  , 0 ))) as tot_charges
            from (select q.state_code as origin_state_code, q.branch_code as origin_city_code  from crit_servicable_pincode_info as q where q.pincode = '". $origin_pincode ."'  and q.status = 'Active') as a  
            left join (select q1.state_code as dest_state_code, q1.branch_code as dest_city_code  from crit_servicable_pincode_info as q1 where q1.pincode = '". $dest_pincode ."'  and q1.status = 'Active') as b on 1=1
            left join crit_customer_domestic_rate_info as c on c.customer_id = '". $consignor_id ."' and c.flg_state = (if(b.dest_state_code = a.origin_state_code,1,0)) and c.flg_city = (if(b.dest_city_code = a.origin_city_code,1,0)) and c.`status` = 'Active'
            where 1 and c.c_type = '". $c_type ."'
        
        "; */
        
         $sql = "
            select 
            a.origin_state_code,
            a.origin_city_code, 
            b.dest_state_code,
            b.dest_city_code,
            c.min_weight,
            c.min_charges,
            c.addt_weight,
            c.addt_charges, 
            if(c.min_weight <= '".$weight."', ('".$weight."' - c.min_weight) , 0 ) as addt_wt,
            if(c.min_weight <= '".$weight."', CEILING(('".$weight."' - c.min_weight) / c.addt_weight) , 0 ) as addt_no_of_wt,
            if(c.min_weight <= '".$weight."', CEILING(('".$weight."' - c.min_weight) / c.addt_weight) * c.addt_charges  , 0 ) as addt_charges_value,
            (c.min_charges + (if(c.min_weight <= '".$weight."', CEILING(('".$weight."' - c.min_weight) / c.addt_weight) * c.addt_charges  , 0 ))) as tot_charges
            from (select q.state_code as origin_state_code, q.branch_code as origin_city_code, q.zone as origin_region, q.metro_city as origin_metro_city   from crit_servicable_pincode_info as q where q.pincode = '". $origin_pincode ."'  and q.status = 'Active') as a  
            left join (select q1.state_code as dest_state_code, q1.branch_code as dest_city_code ,q1.zone as dest_region, q1.metro_city as dest_metro_city  from crit_servicable_pincode_info as q1 where q1.pincode = '". $dest_pincode ."'  and q1.status = 'Active') as b on 1=1
            left join crit_customer_domestic_rate_info as c on c.customer_id = '". $consignor_id ."' 
            and c.flg_region = (if(b.dest_region = a.origin_region,1,0))
            and c.flg_state = (if(b.dest_state_code = a.origin_state_code,1,0)) 
            and c.flg_city = (if(b.dest_city_code = a.origin_city_code,1,0))             
            and (if(b.dest_region = a.origin_region,1,c.flg_metro = (if(b.dest_metro_city = 'Y',1,0))))
            and c.`status` = 'Active'
            where 1 and c.c_type = '". $c_type ."'
        
        ";
        //and c.flg_metro = (if(b.dest_metro_city = 'Y',1,0)) 
        
        $query = $this->db->query($sql);
        
        $charges = array();
        
        foreach ($query->result_array() as $row)
        {
          $charges = $row ;    
        }  
        
        $charges['sql'] = $sql;
        
        header('Content-Type: application/x-json; charset=utf-8');
        
        echo (json_encode($charges));
        
        //echo $sql;
        
    }
    
     public function get_tracking()  
	{
	    
        $timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
        
        $lrno = $this->input->post('lrno') ;
        
        
        
         $query = $this->db->query(" 
                
                select 
                a.parcel_booking_id,
                CONCAT(a.prefix_lrno , a.lrno)  as lrno, 
                a.origin_state,
                a.origin_city,
                a.origin_branch,
                a.no_of_pieces,
                a.weight,  
                a.sender_name,
                a.sender_mobile,
                a.sender_address,
                a.receiver_name,
                a.receiver_mobile,
                a.receiver_address, 
                ifnull(a.to_pay,0) as to_pay, 
                a.status,
                a.status_city_code
                from crit_parcel_booking_info  as a   
                where CONCAT(a.prefix_lrno , a.lrno) = '". $lrno ."'  
                and a.status !='Delete'
                order by CONCAT(a.prefix_lrno , a.lrno) asc 
              
            ");
            
            
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list['booking_info'] = $row;      
            }
         
         $sql = " 
            select 
            a.parcel_tracking_id,
            a.tracking_status,
            a.city_code,
            a.status_date,
            a.status_time,
            a.remarks 
            from crit_parcel_tracking_info as a 
            left join crit_parcel_booking_info as b on b.parcel_booking_id = a.parcel_booking_id
            where  CONCAT(b.prefix_lrno , b.lrno)  = '". $lrno ."'  
            order by a.status_date, a.status_time asc 
        "; 
        
        $query = $this->db->query($sql);  
        
        foreach ($query->result_array() as $row)
        {
            $rec_list['tracking_info'][] = $row;     
        }   
            
            
         $this->db->close();
       
         header('Content-Type: application/x-json; charset=utf-8');

         echo (json_encode($rec_list));     
            
    }
    
    
    public function get_data()  
	{
	   //if(!$this->session->userdata('zazu_logged_in'))  redirect();
       
        $timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
       
       $table = $this->input->post('tbl') ;
       $rec_id =$this->input->post('id');
       
        $this->db->query('SET SQL_BIG_SELECTS=1');
        
       if($table == 'asset_item_info')
       {
          $query = $this->db->query(" 
                select 
                a.*
                from ams_asset_item_info as a
                where a.asset_item_id = '". $rec_id ."'  
                order by a.asset_item_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }            
       }  
        
       if($table == 'asset_category_info')
       {
          $query = $this->db->query(" 
                select 
                a.*
                from ams_asset_category_info as a
                where a.asset_category_id = '". $rec_id ."'  
                order by a.asset_category_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }            
       } 
       
       if($table == 'asset_location_info')
       {
          $query = $this->db->query(" 
                select 
                a.*
                from ams_asset_location_info as a
                where a.asset_location_id = '". $rec_id ."'  
                order by a.asset_location_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }            
       }  
        
       
       if($table == 'get-asset-category-item')
       {
            $sql = "
                select 
                a.* 
                from ams_asset_item_info as a 
                where a.`status` = 'Active'
                and a.asset_category_id = '". $rec_id ."'
                order by a.asset_item_name asc
            ";
            $query = $this->db->query($sql);
             
            $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {  
                $rec_list[]  = $row;      
            }  
            
            
       }
       
       
       if($table == 'notice_board_info')
       {
          $query = $this->db->query("  
                select 
                a.*
                from pyr_notice_board_info as a
                where a.notice_board_id = '". $rec_id ."'
            ");
             
            $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {  
                $rec_list  = $row;      
            }  
          
       }
       
       if($table == 'emp_loan_info')
       {
            $query = $this->db->query(" 
                select 
                a.* 
                from pyr_emp_loan_info as a
                where  a.emp_loan_id = '". $rec_id ."'  
                order by a.emp_loan_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }   
       }
       
       if($table == 'mgt_bank_info')
       {
            $query = $this->db->query(" 
                select 
                a.* 
                from pyr_mgt_bank_info as a
                where  a.mgt_bank_id = '". $rec_id ."'  
                order by a.mgt_bank_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }   
       }
       
       if($table == 'designation-salary-breakup')
       {
            $query = $this->db->query(" 
                select 
                a.*,
                date_format(a.as_on_date,'%Y-%m') as as_on_date
                from pyr_desgn_salary_brk_info as a
                where  a.desgn_salary_brk_id = '". $rec_id ."'  
                order by a.desgn_salary_brk_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }   
       }
       
       if($table == 'esi_pf_info')
       {
            $query = $this->db->query(" 
                select 
                a.* 
                from pyr_esi_pf_info as a
                where  a.esi_pf_id = '". $rec_id ."'  
                order by a.esi_pf_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }   
       }
       
       
       if($table == 'salary_breakup_info')
       {
          $query = $this->db->query(" 
                select 
                a.*
                from pyr_salary_breakup_info as a
                where  a.salary_breakup_id = '". $rec_id ."'  
                order by a.salary_breakup_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }            
       } 
       
       if($table == 'holidays_info')
       {
          $query = $this->db->query(" 
                select 
                a.*
                from pyr_holidays_info as a
                where  a.holiday_id = '". $rec_id ."'  
                order by a.holiday_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }            
       }
       
       
       
       if($table == 'emp_doc_upload_info')
       {
          $query = $this->db->query(" 
                select 
                a.*
                from pyr_emp_doc_upload_info as a
                where  a.emp_doc_upload_id = '". $rec_id ."'  
                order by a.emp_doc_upload_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }            
       } 
       
        
       if($table == 'change-password')
       { 
            $sql = "
                select 
                a.user_id
                from user_login as a where  
                a.user_id = '".$rec_id ."' and 
                a.user_pwd = '". $this->input->post('old_pwd') ."'  
            ";
            $query = $this->db->query($sql);

           $cnt = $query->num_rows();
           
           if($cnt == 1) {
           
            $this->db->where('user_id', $rec_id);
            $this->db->update('user_login', array( 'user_pwd' => $this->input->post('new_pwd'))); 
            
             $rec_list['msg'] = "Successfully Password has been Changed !!!!";
             
             $rec_list['flg'] = 1;
           
           } else {
             
             $rec_list['msg'] = " Invalid Old Password!!! Try Again !!!!";
             
             $rec_list['flg'] = 0;
            
           } 
           
           
               
       }  
       
       if($table == 'get-login')
       {
          $query = $this->db->query(" 
                select 
                a.*
                from user_login as a
                where a.level = 'Staff' and 
                a.ref_id = '". $rec_id ."'  
                order by a.ref_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }            
       } 
       
       
      if($table == 'emp_attendance_info')
       {
           $sql = 
             " 
                select 
                a.*
                from pyr_emp_attendance_info as a
                where a.emp_attendance_id = '". $rec_id ."'  
                order by a.emp_attendance_id asc 
            ";  
          $query = $this->db->query($sql);
             
           $rec_list = array();  
           $rec_list['sql'] = $sql;  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }            
       } 
       
       
       
       if($table == 'department_info')
       {
          $query = $this->db->query(" 
                select 
                a.*
                from pyr_department_info as a
                where a.department_id = '". $rec_id ."'  
                order by a.department_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }            
       } 
       
       
       
       if($table == 'designation_info')
       {
          $query = $this->db->query(" 
                select 
                a.*
                from pyr_designation_info as a
                where a.designation_id = '". $rec_id ."'  
                order by a.designation_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }            
       } 
       
       if($table == 'staff_leave_request_info')
       {
          $query = $this->db->query(" 
                select 
                a.*
                from pyr_staff_leave_request_info as a
                where a.leave_request_id = '". $rec_id ."'  
                order by a.leave_request_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }            
       } 
       
       
       
       if($table == 'dyn_fld_opt_info')
       {
          $query = $this->db->query(" 
                select 
                a.*
                from pyr_dyn_fld_opt_info as a
                where a.dyn_fld_opt_id = '". $rec_id ."'  
                order by a.dyn_fld_opt_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }            
            
            
            $query = $this->db->query(" 
                select 
                a.*
                from pyr_dyn_fld_opt_val_info as a
                where a.dyn_fld_opt_id = '". $rec_id ."'  
                order by a.fld_val_s_order, a.dyn_fld_opt_val_name asc
                 
            ");
            
            $rec_list['opt_val'] = array();
           
            foreach($query->result_array() as $row)
            {
                $rec_list['opt_val'][] = $row;      
            }  
            
       } 
       
       
       if($table == 'get-designation')
       {
          $query = $this->db->query(" 
                select 
                a.*
                from pyr_designation_info as a
                where a.employee_category = '". $rec_id ."'  
                and a.status = 'Active'
                order by a.designation_name asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[] = $row;      
            }            
       } 
       
       if($table == 'designation_info')
       {
          $query = $this->db->query(" 
                select 
                a.*
                from pyr_designation_info as a
                where a.designation_id = '". $rec_id ."'  
                order by a.designation_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }            
       } 
       
       
       if($table == 'leave-request-calender')
       {
          $query = $this->db->query(" 
                select 
                a.leave_type as title,
                a.from_date as start,
                a.to_date as end 
                from pyr_leave_request_info as a
                where a.employee_id = '". $rec_id ."'  
                and a.`status` != 'Delete'
                order by a.from_date asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[] = $row;      
            }            
       } 
       
       
        
        if($table == 'get-account-head-type')
       {
          $query = $this->db->query(" 
                select 
                a.account_head_id,
                a.account_head_name 
                from crit_account_head_info as a
                where a.type = '". $rec_id ."' and a.franchise_id= '". $this->session->userdata(SESS_HD . 'franchise_id') ."'
                and a.`status` = 'Active' 
                order by a.account_head_name asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[]  = $row;      
            }            
       }
       
       if($table == 'sub_account_head_info')
       {
          $query = $this->db->query(" 
                select 
                a.*
                from crit_sub_account_head_info as a
                where a.sub_account_head_id = '". $rec_id ."' 
                and a.franchise_id= '". ($this->session->userdata(SESS_HD . 'franchise_id') == '' ? 0 : $this->session->userdata(SESS_HD . 'franchise_id')) ."'
                order by a.sub_account_head_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list = $row;      
            }            
       }
        
        
       if($table == 'get-district')
       {
          $query = $this->db->query(" 
                select 
                a.district
                from crit_state_district_info as a
                where a.state = '". $rec_id ."'
                and a.`status` = 'Active' 
                order by a.district asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[]  = $row;      
            }            
       } 
       
       if($table == 'get-agent-branch')
       {
          $query = $this->db->query(" 
                select 
                a.branch,
                a.agent_type
                from crit_agent_info as a
                where a.`status` = 'Active' and a.district = '". $rec_id ."'
                order by a.district , a.branch asc  
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[]  = $row;      
            }            
       } 
       
       if($table == 'state_district_info')
       {
          $query = $this->db->query(" 
                select 
                a.*
                from crit_state_district_info as a
                where a.state_district_id = '". $rec_id ."'
                and a.`status` != 'Delete' 
                order by a.state_district_id asc
                 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list  = $row;      
            }            
       }
       
       if($table == 'get-client')
       {
          $query = $this->db->query(" 
                select 
                a.*  
                from client_info as a  
                where a.client_id = '". $rec_id ."'
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {  
                $rec_list  = $row;      
            }  
          
       }
       
       if($table == 'get-company')
       {
          $query = $this->db->query(" 
                select 
                a.* 
                from company_info as a  
                where a.company_id = '". $rec_id ."'
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {  
                $rec_list  = $row;      
            }  
          
       }
       
       if($table == 'date-wise-invoice')
       {
          $query = $this->db->query(" 
                 select
                    date_format(a.invoice_date,'%b-%Y') as invoice_date,
                    round(if(a.is_gst_invoice = 1, (sum(b.amount) +  (sum(b.amount) * 18 /100)) ,sum(b.amount) ),2)as curr_mon_tot,
                    ifnull(sum(c.received_amount),0) as curr_mon_rec
                    from invoice_info as a
                    left join invoice_detail_info as b on b.invoice_id = a.invoice_id
                    left join receipt_info as c on c.invoice_id = a.invoice_id
                    where a.`status`!= 'Delete'
                    group by date_format(a.invoice_date,'%Y%m')
                    order by a.invoice_date desc
                    limit 20
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {  
                $rec_list[] = $row;      
            }  
          
       }
       
       if($table == 'user_login')
       {
          $query = $this->db->query(" 
                select 
                *
                from user_login as a
                where a.user_id = '". $rec_id ."'
                order by a.user_id asc 
            ");
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {  
                $rec_list = $row;      
            }  
          
       }
       
       if($table == 'get-parcel-charges')
       {
        
          /*
          select 
            a.min_weight,
            a.rate_per_kg,
            a.awb_charges, 
            a.gst_limit,
            a.gst_pert,
            a.fsc_pert,
            (if('4' < a.min_weight , a.min_weight , '4')) as chrg_wt,
            (if('4' < a.min_weight , a.min_weight , '4') * a.rate_per_kg ) as fr_chrges,
            (if((if('4' < a.min_weight , a.min_weight , '4') * a.rate_per_kg * a.loading_charges/100 ) <= 10, 10, (if('4' < a.min_weight , a.min_weight , '4') * a.rate_per_kg * a.loading_charges/100 ))) as loading_charges,
            (if((if('4' < a.min_weight , a.min_weight , '4') * a.rate_per_kg * a.unloading_charges/100 ) <= 10, 10, (if('4' < a.min_weight , a.min_weight , '4') * a.rate_per_kg * a.unloading_charges/100 ))) as unloading_charges,
            (
              (if('4' < a.min_weight , a.min_weight , '4') * a.rate_per_kg ) +
              +
              a.awb_charges  
              +
              (if((if('4' < a.min_weight , a.min_weight , '4') * a.rate_per_kg * a.loading_charges/100 ) <= 10, 10, (if('4' < a.min_weight , a.min_weight , '4') * a.rate_per_kg * a.loading_charges/100 ))) 
              +
              (if((if('4' < a.min_weight , a.min_weight , '4') * a.rate_per_kg * a.unloading_charges/100 ) <= 10, 10, (if('4' < a.min_weight , a.min_weight , '4') * a.rate_per_kg * a.unloading_charges/100 ))) 
              
              
            ) as sub_total
            from crit_branch_parcel_rate_info as a
            where a.src_branch = 'Ganapathy' 
            and a.dest_branch = 'Tirupur HUB' 
          */
          $sql = " select 
                    a.min_weight,
                    a.rate_per_kg,
                    a.awb_charges, 
                    a.gst_limit,
                    a.gst_pert,
                    a.fsc_pert,
                     (if('". $this->input->post('weight') ."' <= a.min_weight , a.min_weight , '". $this->input->post('weight') ."') * a.rate_per_kg ) as fr_chrges,
                    (if((if('". $this->input->post('weight') ."' < a.min_weight , a.min_weight , '". $this->input->post('weight') ."') * a.rate_per_kg * a.loading_charges/100 ) <= 10, 10, (if('". $this->input->post('weight') ."' < a.min_weight , a.min_weight , '". $this->input->post('weight') ."') * a.rate_per_kg * a.loading_charges/100 ))) as loading_charges,
                    (if((if('". $this->input->post('weight') ."' < a.min_weight , a.min_weight , '". $this->input->post('weight') ."') * a.rate_per_kg * a.unloading_charges/100 ) <= 10, 10, (if('". $this->input->post('weight') ."' < a.min_weight , a.min_weight , '". $this->input->post('weight') ."') * a.rate_per_kg * a.unloading_charges/100 ))) as unloading_charges,
                    (
                      (if('". $this->input->post('weight') ."' < a.min_weight , a.min_weight , '". $this->input->post('weight') ."') * a.rate_per_kg ) +
                      +
                      a.awb_charges  
                      +
                      (if((if('". $this->input->post('weight') ."' < a.min_weight , a.min_weight , '". $this->input->post('weight') ."') * a.rate_per_kg * a.loading_charges/100 ) <= 10, 10, (if('". $this->input->post('weight') ."' < a.min_weight , a.min_weight , '". $this->input->post('weight') ."') * a.rate_per_kg * a.loading_charges/100 ))) 
                      +
                      (if((if('". $this->input->post('weight') ."' < a.min_weight , a.min_weight , '". $this->input->post('weight') ."') * a.rate_per_kg * a.unloading_charges/100 ) <= 10, 10, (if('". $this->input->post('weight') ."' < a.min_weight , a.min_weight , '". $this->input->post('weight') ."') * a.rate_per_kg * a.unloading_charges/100 ))) 
                      
                      
                    ) as sub_total
                    from crit_branch_parcel_rate_info as a
                    where a.src_branch = '". $this->input->post('origin_branch') ."' 
                    and a.dest_branch = '". $this->input->post('dest_branch') ."' ";
             
            $query = $this->db->query($sql);
             
            $rec_list = array();  
          
    
            foreach($query->result_array() as $row)
            {  
                $rec_list  = $row;      
            } 
            
            // $rec_list['sql']  = $sql;     
          
       }
       
       
        
       $this->db->close();
       
       header('Content-Type: application/x-json; charset=utf-8');

       echo (json_encode($rec_list));  
	}
    
    
    public function get_content($table = '', $rec_id = '')
    {
       //if(!$this->session->userdata('zazu_logged_in'))  redirect();
       
       if(empty($table) && empty($rec_id)) {
           $table = $this->input->post('tbl') ;
           $rec_id = $this->input->post('id'); 
           $edit_mode = $this->input->post('edit_mode'); 
           $del_mode = $this->input->post('del_mode'); 
           $flg = true;
       } else {
        $flg = false;
       }
       
       
       
       
        if($table == 'designation-salary-breakup') {
        //date_format(a.as_on_date, "%M-%Y") as as_on_date, 
        $sql = ' 
            select 
            a.desgn_salary_brk_id as id, 
            concat(c.salary_breakup_name , " = ", a.salary_breakup_pct , "% of ( ", GROUP_CONCAT(b.salary_breakup_name), " )") as details,
            a.sort_order ,
            a.status
            from pyr_desgn_salary_brk_info as a 
            left join pyr_salary_breakup_info as b on FIND_IN_SET(b.salary_breakup_id,a.pct_of_salary_breakup_id)
            left join pyr_salary_breakup_info as c on c.salary_breakup_id = a.salary_breakup_id
            where a.designation_id = "'. $rec_id.'" 
            and a.`status` = "Active" and c.`status` = "Active" and b.`status` = "Active"
            group by a.desgn_salary_brk_id
            order by a.as_on_date desc, a.sort_order asc  
        ';
        
        $query = $this->db->query( $sql );  
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[] = $row; 
            } 
       }
       
       if($table == 'receipt_info') {
        
        $query = $this->db->query("
           select 
            a.receipt_date,
            a.received_amount,
            a.payment_type,
            a.remarks 
            from receipt_info as a 
            where a.invoice_id = '". $rec_id. "' 
            and a.`status` = 'Active'
            order by a.receipt_date asc
          "
          );  
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[] = $row; 
            } 
       }
       
       
       
       
       
       if($table == 'client_doc')
       {
          $query = $this->db->query("
             select 
                a.client_doc_id as id,
                a.upload_doc_type as upload_doc,
                concat('<a href=\"../../',a.doc_path,'\" target=\"_blank\">View</a>') as doc_view 
                from crit_client_doc_info as a
                where a.client_id = '". $rec_id. "' 
                and a.status != 'Delete'
                order by a.upload_doc_type asc   
          "
          ); 
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[] = $row; 
            }  
          
       } 
       
       if($table == 'dc_tracking_info')
       {
          $query = $this->db->query("
             select 
                a.dc_tracking_id as id, 
                a.tracking_status,
                a.location,
                a.status_date,
                a.`status_time`,
                a.remarks
                from crit_dc_tracking_info as a
                where a.dc_booking_id = '". $rec_id. "'  
                order by a.status_date ,a.status_time asc   
          "
          ); 
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[] = $row; 
            }  
          
       }
       
       if($table == 'intl_tracking_info'){
        
        $query = $this->db->query("
             select 
                a.intl_tracking_id as id, 
                a.tracking_status,
                a.location,
                a.status_date,
                a.`status_time`,
                a.remarks
                from crit_intl_tracking_info as a
                where a.international_consignment_id = '". $rec_id. "'  
                order by a.status_date ,a.status_time asc   
          "
          ); 
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[] = $row; 
            }
       } 
       
       
       if($table == 'gen_enquiry_details')
       {
          $query = $this->db->query("
             select   
                 a.name,                 
                 a.address,              
                 a.phone,                
                 a.email,                
                 a.remarks as message,   
                 a.enquiry_date 
                 from cf_enquiry as a    
                 left join cf_locations as b on b.id = a.location 
                 left join cf_states as c on c.id = b.state_id 
                 where a.id = '". $rec_id. "'   
          "
          ); 
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[] = $row; 
            }  
          
       }
       
              
        
       
       if($table == 'International-DC-Charges-list')
       {
          $query = $this->db->query("
             SELECT     
                CONVERT(
                    e.package_weight_range,
                    DECIMAL(12, 2)
                ) AS weight, 
                ROUND(
                    (
                        (
                            a.rate +(
                                e.package_weight_range * c.covid_chrg_per_kg
                            ) +(
                                ROUND(
                                    (
                                        (
                                            a.rate +(
                                                e.package_weight_range * c.covid_chrg_per_kg
                                            )
                                        ) * b.fsc_percentage / 100
                                    ),
                                    2
                                )
                            ) +(
                                ROUND(
                                    (
                                        (
                                            (
                                                a.rate +(
                                                    e.package_weight_range * c.covid_chrg_per_kg
                                                ) +(
                                                    ROUND(
                                                        (
                                                            (
                                                                a.rate +(
                                                                    e.package_weight_range * c.covid_chrg_per_kg
                                                                )
                                                            ) * b.fsc_percentage / 100
                                                        ),
                                                        2
                                                    )
                                                )
                                            )
                                        ) * b.gst_percentage / 100
                                    ),
                                    2
                                )
                            )
                        ) + ROUND(
                            (
                                (
                                    a.rate +(
                                        e.package_weight_range * c.covid_chrg_per_kg
                                    ) +(
                                        ROUND(
                                            (
                                                (
                                                    a.rate +(
                                                        e.package_weight_range * c.covid_chrg_per_kg
                                                    )
                                                ) * b.fsc_percentage / 100
                                            ),
                                            2
                                        )
                                    ) +(
                                        ROUND(
                                            (
                                                (
                                                    (
                                                        a.rate +(
                                                            e.package_weight_range * c.covid_chrg_per_kg
                                                        ) +(
                                                            ROUND(
                                                                (
                                                                    (
                                                                        a.rate +(
                                                                            e.package_weight_range * c.covid_chrg_per_kg
                                                                        )
                                                                    ) * b.fsc_percentage / 100
                                                                ),
                                                                2
                                                            )
                                                        )
                                                    )
                                                ) * b.gst_percentage / 100
                                            ),
                                            2
                                        )
                                    )
                                ) * b.dc_percentage / 100
                            ),
                            2
                        )
                    ),
                    2
                ) AS charges
            FROM
                crit_international_rate_info_v2 AS a
            LEFT JOIN crit_international_service_provider_info AS b
            ON
                b.international_service_provider_id = a.international_service_provider_id
            LEFT JOIN crit_sp_zone_country_info AS c
            ON
                c.intl_sp_id = a.international_service_provider_id AND c.zone_id = a.zone_id
            LEFT JOIN crit_package_type_info AS d
            ON
                d.package_type_id = a.package_type_id
            LEFT JOIN crit_package_weight_info AS e
            ON
                e.package_weight_id = a.package_weight_id AND e.package_type_id = a.package_type_id
            LEFT JOIN crit_country_info AS f
            ON
                FIND_IN_SET(f.country_id, c.country_ids)
            WHERE
                f.country_id = '". $rec_id ."' AND b.international_service_provider_id = '". $this->input->post('international_service_provider_id') ."' AND d.package_type_id = 2 and a.rate > 0
            ORDER BY
                CONVERT(
                    e.package_weight_range,
                    DECIMAL(12, 2)
                ) ASC
          "
          ); 
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[] = $row;
                /*foreach($row as $fld => $val){
                    $rec_list[$fld]  = $val;     
                }*/
            }  
          
       }
       
        if($table == 'franchise_enquiry')
       {
          $query = $this->db->query("
            select 
                DATE_FORMAT(a.franchise_enquiry_date,'%d-%m-%Y %h:%i %p') as enquiry_date,
                a.contact_person_name,
                a.email,
                a.mobile,
                a.interested_in,
                b.state_name as state,
                c.city_name as city,
                a.address,
                a.messages
                from rh_franchise_enquiry_info as a 
                left join rh_states_info as b on b.id = a.state_id
                left join rh_location_info as c on c.location_id = a.location_id
                where a.franchise_enquiry_id = '". $rec_id. "' 
                order by a.franchise_enquiry_id desc
          "
          ); 
             
           $rec_list = array();  
    
            foreach($query->result_array() as $row)
            {
                $rec_list[] = $row;
                /*foreach($row as $fld => $val){
                    $rec_list[$fld]  = $val;     
                }*/
            }  
          
       } 
       
       
       if($table == 'manifest-list')
       {
          /*
            a.manifest_no,
            a.manifest_date, 
            a.co_loader_awb_no,
            a.co_loader_remarks,
          */  
          $query = $this->db->query("
              select 
                concat(c.prefix_lrno, c.lrno) as LRNO,
                concat(c.origin_state, ' - ', c.origin_city, '<br>' , c.origin_branch) as origin,
                concat(c.dest_state, ' - ', c.dest_city, '<br>' , c.dest_branch) as destination,
                c.no_of_pieces,
                c.weight,
                a.m_status as status
                from crit_manifest_info  as a
                left join crit_parcel_booking_info as c on c.parcel_booking_id = a.parcel_booking_id 
                where a.manifest_no = '". $rec_id. "'  
                order by c.prefix_lrno, c.lrno asc
          "
          ); 
             
            $rec_list = array();  
    
            foreach($query->result_array() as $row)
            { 
                $rec_list[]  = $row;     
            }  
          
       } 
       
       
       if(!empty($rec_list)) {
        
        if(count($rec_list) > 1 ) {
       
           $content = '
           <table class="table table-bordered table-responsive table-striped" id="sts">
             <thead>
                <tr>';
                $content .= '<th>S.No</th>';
                foreach($rec_list[0] as $fld => $val) { 
                    if($fld != 'id' && $fld != 'tbl')
                        $content .= '<th class="text-capitalize">'.  str_replace('_',' ',$fld) .'</th>';
                } 
                if($edit_mode == 1)  
                   $content .= '<th>Edit</th>';
                if($del_mode == 1) 
                   $content .= '<th>Delete</th>'; 
           $content .= '</tr>
              </thead>  
              <tbody>';
                foreach($rec_list as $k => $info) {  
                   $content .= '<tr>
                      <td>'.($k+1).'</td>';
                    foreach($rec_list[0] as $fld => $val) { 
                        if($fld != 'id') {
                             if($fld != 'tbl')
                                $content .= '<td>'. $info[$fld]  .'</td>';
                        }
                            
                    } 
                    if($edit_mode == 1)                 
                        $content .= '<td><button type="button" class="btn btn-xs btn-info btn-sm btn_chld_edit" value="'. $info['id']  .'" data="'. $table  .'"><i class="fa fa-edit"></i></button></td>';    
                    if($del_mode == 1)  
                        $content .= '<td><button type="button" class="btn btn-xs btn-danger btn-sm btn_chld_del" value="'. $info['id']  .'" data="'. $table  .'"><i class="fa fa-remove"></i></button></td>';    
                   $content .= '</tr>';     
                  }  
              $content .= '
              </tbody>  
            </table>';
            } else
            {
                $content = ' <table class="table table-bordered table-responsive table-striped">  ';
                $content .= '<tr><th colspan="2">'.  strtoupper(str_replace('_',' ', $table)) .'</th></tr>';
                foreach($rec_list[0] as $fld => $val) { 
                    if($fld != 'id' && $fld != 'tbl')
                    {
                        $content .= '<tr>';      
                        $content .= '<th>'. strtoupper(str_replace('_',' ',$fld)) .'</th>';
                        $content .= '<td>'.  $val.'</td>';
                        $content .= '</tr>';  
                    }
                }   
                if($edit_mode == 1)                 
                        $content .= '<tr><th>Edit</th><td><button type="button" class="btn btn-xs btn-info btn-sm btn_chld_edit" value="'. $rec_list[0]['id']  .'" data="'. $table  .'"><i class="fa fa-edit"></i></button></td></tr>';    
                    if($del_mode == 1)  
                        $content .= '<tr><th>Delete</th><td><button type="button" class="btn btn-xs btn-danger btn-sm btn_chld_del" value="'. $rec_list[0]['id']  .'" data="'. $table  .'"><i class="fa fa-remove"></i></button></td></tr>';
                
                $content .= '</table>';              
            }
        } else {
            $content = "<strong>No Record Found</strong>";
        }
         
        if(!$flg)
            return $content;  
        else
            echo $content;    
       
    }
    
    public function delete_record()  
    {
        
        if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect(); 
        
        
        $table = $this->input->post('tbl') ;
        $rec_id =$this->input->post('id');
        
        
        if($table == 'asset_item_qrcode_gen_info')
        {
             $this->db->where('asset_item_qrcode_gen_id', $rec_id);
             $this->db->update('ams_asset_item_qrcode_gen_info',  array(
                                                          'status' => 'Delete' ,
                                                          'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                                                          'updated_date' => date('Y-m-d H:i:s')  , 
                                                          )); 
                                                          
             $this->db->where('asset_item_qrcode_gen_id', $rec_id);
             $this->db->update('ams_asset_item_qrcode_info',  array(
                                                          'status' => 'Delete' ,
                                                          'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                                                          'updated_date' => date('Y-m-d H:i:s')  , 
                                                          ));                                              
                                                          
                                                          
             echo 'Record Successfully deleted';  
        }
        
        if($table == 'asset_item_info')
        {
             $this->db->where('asset_item_id', $rec_id);
             $this->db->update('ams_asset_item_info',  array(
                                                          'status' => 'Delete' ,
                                                          'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                                                          'updated_date' => date('Y-m-d H:i:s')  , 
                                                          )); 
             echo 'Record Successfully deleted';  
        } 
        
        if($table == 'asset_category_info')
        {
             $this->db->where('asset_category_id', $rec_id);
             $this->db->update('ams_asset_category_info',  array(
                                                          'status' => 'Delete' ,
                                                          'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                                                          'updated_date' => date('Y-m-d H:i:s')  , 
                                                          )); 
             echo 'Record Successfully deleted';  
        } 
        
        if($table == 'asset_location_info')
        {
             $this->db->where('asset_location_id', $rec_id);
             $this->db->update('ams_asset_location_info',  array(
                                                          'status' => 'Delete' ,
                                                          'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                                                          'updated_date' => date('Y-m-d H:i:s')   
                                                          )); 
             echo 'Record Successfully deleted';  
        } 
        
        if($table == 'ticket')
        {
             $this->db->where('hd_ticket_id', $rec_id);
             $this->db->update('pyr_hd_ticket_info', array('status' => 'Delete'));
             
             $this->db->where('hd_ticket_id', $rec_id);
             $this->db->update('pyr_hd_ticket_comment_info', array('status' => 'Delete'));
               
             echo 'Record Successfully deleted';  
        } 
       
      
        
        if($table == 'notice_board_info')
         {            
            $this->db->where('notice_board_id', $rec_id);
            $this->db->update('pyr_notice_board_info', array('status' => 'Delete')); 
            echo 'Record Successfully deleted'; 
         }   
        
        
        if($table == 'emp_payslip_info')
         {            
            $this->db->where('emp_payslip_id', $rec_id);
            $this->db->update('pyr_emp_payslip_info', array(
                                                          'status' => 'Delete' ,
                                                          'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                                                          'updated_date' => date('Y-m-d H:i:s')   
                                                          ));  
            
            $this->db->where('emp_payslip_id', $rec_id);
            $this->db->update('pyr_emp_payslip_ded_info', array('status' => 'Delete'));
            
            $this->db->where('emp_payslip_id', $rec_id);
            $this->db->update('pyr_emp_payslip_ctc_info', array('status' => 'Delete'));
            
            $this->db->where('emp_payslip_id', $rec_id);
            $this->db->update('pyr_emp_payslip_brkup_info', array('status' => 'Delete'));
            
            echo 'Record Successfully deleted'; 
         } 
        
        
        if($table == 'designation-salary-breakup')
        {
            $this->db->where('desgn_salary_brk_id', $rec_id);
            $this->db->update('pyr_desgn_salary_brk_info', array(
                                                              'status' => 'Delete' ,
                                                              'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                                                              'updated_date' => date('Y-m-d H:i:s')   
                                                            ));     
            echo 'Record Successfully deleted'; 
        }
        
        if($table == 'salary_breakup_info')
         {            
            $this->db->where('salary_breakup_id', $rec_id);
            $this->db->update('pyr_salary_breakup_info', array('status' => 'Delete'));   
            echo 'Record Successfully deleted'; 
         }
         
         if($table == 'mgt_bank_info')
         {            
            $this->db->where('mgt_bank_id', $rec_id);
            $this->db->update('pyr_mgt_bank_info', array('status' => 'Delete'));   
            echo 'Record Successfully deleted'; 
         } 
         
        
        if($table == 'holidays_info')
         {            
            $this->db->where('holiday_id', $rec_id);
            $this->db->update('pyr_holidays_info', array('status' => 'Delete'));   
            echo 'Record Successfully deleted'; 
         }
         
        
        if($table == 'department_info')
         {            
            $this->db->where('department_id', $rec_id);
            $this->db->update('pyr_department_info', array('status' => 'Delete'));   
            echo 'Record Successfully deleted'; 
         }
        
        if($table == 'emp_attendance_info')
         {            
            $this->db->where('emp_attendance_id', $rec_id);
            $this->db->update('pyr_emp_attendance_info', array('status' => 'Delete'));   
            echo 'Record Successfully deleted'; 
         } 
         
         
        if($table == 'emp_category_info')
         {            
            $this->db->where('emp_category_id', $rec_id);
            $this->db->update('pyr_emp_category_info', array('status' => 'Delete'));   
            echo 'Record Successfully deleted'; 
         } 
         
         if($table == 'designation_info')
         {            
            $this->db->where('designation_id', $rec_id);
            $this->db->update('pyr_emp_category_info', array('status' => 'Delete')); 
            echo 'Record Successfully deleted'; 
         } 
         
         if($table == 'dyn_fld_opt_info')
         {            
            $this->db->where('dyn_fld_opt_id', $rec_id);
            $this->db->update('pyr_dyn_fld_opt_info', array('status' => 'Delete'));   
            
            $this->db->where('dyn_fld_opt_id', $rec_id);
            $this->db->update('pyr_dyn_fld_opt_val_info', array('status' => 'Delete'));
            echo 'Record Successfully deleted'; 
         } 
          
        
         
         if($table == 'employee_info')
         {            
            $this->db->where('employee_id', $rec_id);
            $this->db->update('pyr_employee_info', array('status' => 'Delete'));   
            echo 'Record Successfully deleted'; 
         }  
         
         if($table == 'employee_info')
         {            
            $this->db->where('employee_id', $rec_id);
            $this->db->update('pyr_employee_info', array('status' => 'Delete'));   
            echo 'Record Successfully deleted'; 
         }   
          
         
         if($table == 'staff_leave_request_info')
         {            
            $this->db->where('leave_request_id', $rec_id);
            $this->db->update('pyr_staff_leave_request_info', array('status' => 'Delete'));   
            echo 'Record Successfully deleted'; 
         }  
         
         
         
         if($table == 'cash_inward_info')
         {            
            $this->db->where('cash_inward_id', $rec_id);
            $this->db->update('crit_cash_inward_info', array(
                                                              'status' => 'Delete' ,
                                                              'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                                                              'updated_datetime' => date('Y-m-d H:i:s')   
                                                            ));   
            echo 'Record Successfully deleted'; 
         }  
         
         if($table == 'cash_outward_info')
         {            
            $this->db->where('cash_outward_id', $rec_id);
            $this->db->update('crit_cash_outward_info', array(
                                                              'status' => 'Delete' ,
                                                              'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                                                              'updated_datetime' => date('Y-m-d H:i:s')              
                                                              ));   
            echo 'Record Successfully deleted'; 
         }  
         
         if($table == 'account_head_info')
         {            
            $this->db->where('account_head_id', $rec_id);
            $this->db->update('crit_account_head_info', array(
                                                              'status' => 'Delete' ,
                                                              'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                                                              'updated_datetime' => date('Y-m-d H:i:s')              
                                                              ));   
            echo 'Record Successfully deleted'; 
         } 
         
         
         if($table == 'sub_account_head_info')
         {            
            $this->db->where('sub_account_head_id', $rec_id);
            $this->db->update('crit_sub_account_head_info', array(
                                                              'status' => 'Delete' ,
                                                              'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                                                              'updated_datetime' => date('Y-m-d H:i:s')              
                                                              ));   
            echo 'Record Successfully deleted'; 
         } 
         
         if($table == 'voucher_type_info')
         {            
            $this->db->where('voucher_type_id', $rec_id);
            $this->db->update('voucher_type_info', array('status' => 'Delete'));   
            
            echo 'Record Successfully deleted'; 
         }   
         
         
         if($table == 'opening_balance_info')
         {            
            $this->db->where('opening_balance_id', $rec_id);
            $this->db->update('opening_balance_info', array('status' => 'Delete'));   
            
            echo 'Record Successfully deleted'; 
         } 
         
         if($table == 'sub_account_head_lvl3_info')
         {            
            $this->db->where('sub_account_headlvl3_id', $rec_id);
            $this->db->update('sub_account_head_lvl3_info', array('status' => 'Delete'));   
            
            echo 'Record Successfully deleted'; 
         } 
         
         if($table == 'doc_upload_type_info')
         {            
            $this->db->where('doc_upload_type_id', $rec_id);
            $this->db->update('pyr_doc_upload_type_info', array('status' => 'Delete'));   
            
            echo 'Record Successfully deleted'; 
         } 
         
         if($table == 'emp_doc_upload_info')
         {            
            $this->db->where('emp_doc_upload_id', $rec_id);
            $this->db->update('pyr_emp_doc_upload_info', array('status' => 'Delete'));   
            
            echo 'Record Successfully deleted'; 
         } 
          
          
    } 
    
    
    public function get_notice(){
        
         $user_type = $this->input->post('user_type') ;
         $emp_id = $this->input->post('emp_id') ;
         $emp_category = $this->input->post('emp_category') ;
         $designation_id = $this->input->post('emp_designation') ;
        
         if($user_type == 'Admin'){   
             $sql = "  
                select 
                a.* 
                from pyr_notice_board_info as a
                where a.status = 'Active'
                and a.notice_start_date <= '". date("Y-m-d H:i:s") ."' 
                and a.notice_end_date >= '". date("Y-m-d H:i:s") ."' 
                order by a.notice_date desc
            "; 
          } else { 
            
            $sql = "  
                (
                    select 
                    a.* 
                    from pyr_notice_board_info as a
                    where a.status = 'Active'
                    and a.notice_start_date <= '". date("Y-m-d H:i:s") ."' 
                    and a.notice_end_date >= '". date("Y-m-d H:i:s") ."' 
                    and a.employee_category = '". $emp_category."' 
                    and a.designation_id = '". $designation_id."' 
                    and FIND_IN_SET('". $emp_id ."', a.employee_id) 
                    order by a.notice_date desc 
                ) union all (
                    select 
                    a.* 
                    from pyr_notice_board_info as a
                    where a.status = 'Active'
                    and a.notice_start_date <= '". date("Y-m-d H:i:s") ."' 
                    and a.notice_end_date >= '". date("Y-m-d H:i:s") ."' 
                    and a.employee_category = '". $emp_category."' 
                    and (a.designation_id = '0' || a.designation_id = '' || a.designation_id is null  )
                    order by a.notice_date desc 
                ) union all (
                    select 
                    a.* 
                    from pyr_notice_board_info as a
                    where a.status = 'Active'
                    and a.notice_start_date <= '". date("Y-m-d H:i:s") ."' 
                    and a.notice_end_date >= '". date("Y-m-d H:i:s") ."' 
                    and ( a.employee_category is null  or a.employee_category = '' ) 
                    order by a.notice_date desc 
                )
            "; 
            
             $sql = "  
                select 
                a.* 
                from pyr_notice_board_info as a
                where a.status = 'Active'
                and a.notice_start_date <= '". date("Y-m-d H:i:s") ."' 
                and a.notice_end_date >= '". date("Y-m-d H:i:s") ."' 
                order by a.notice_date desc
            "; 
          }
          
         
            
            $query = $this->db->query($sql);
             
           //$rec_list = $sql;  
           $rec_list = array();  
            $j = 0;
            $msg = '';
            foreach($query->result_array() as $row)
            {  
                $j++;    
                $notice_msg = str_replace("\n","\n<br>", $row['notice_msg']);
                if(($j % 2)== 0 ) {
                    $bc = "box-success";
                    $bg = "bg-success";
               } else {    
                    $bc = "box-danger";
                    $bg = "bg-danger";
               }
                $msg .='
                    <div class="box '.$bc.'">
                        <div class="box-header with-border '.$bg.'">
                          <h3 class="box-title text-black">'. $row['notice_title'] .'</h3> 
                          <div class="box-tools pull-right">
                            <i class="label label-info">'. date('d-m-Y', strtotime($row['notice_date']))  .'</i>
                          </div> 
                        </div> 
                        <div class="box-body">
                           '. $notice_msg .' 
                        </div> 
                      </div>
                ';
              
            }  
          $rec_list['msg'] = $msg;  
          $rec_list['cnt'] = $j ; 
          $rec_list['sql'] = $sql;  
        
        //echo $rec_list;
         header('Content-Type: application/x-json; charset=utf-8');

       echo (json_encode($rec_list));  
    }
    
    
    
    
    
    
}
