<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	 
	public function index()
	{
	   
        if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect(); 
        
        /*if($this->session->userdata(SESS_HD . 'user_type') != 'Admin' and $this->session->userdata(SESS_HD . 'user_type') != 'Manager')
        { 
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }  */
        
        date_default_timezone_set("Asia/Calcutta");  
        
        $data = array(); 
         
        $data['js'] = 'dash.inc';  
        
        
        if($this->input->post('mode') == 'Leave Approval')
        {
            $l_status = $this->input->post('status');
            if($l_status == 'Approved')
            {
                $approved_by = $this->session->userdata(SESS_HD . 'user_id');
                $approved_date = date('Y-m-d H:i:s');
            } else {
                $approved_by = '';
                $approved_date = '';
            }
            
            $upd = array( 
                   // 'req_date' =>  date('Y-m-d H:i:s'), 
                    //'employee_id' => $this->session->userdata(SESS_HD . 'ref_id'), 
                    //'leave_date' => $this->input->post('leave_date'),    
                    //'leave_type' => $this->input->post('leave_type'), 
                    //'reason' => $this->input->post('reason'), 
                    'status' => $this->input->post('status') ,                 
                    'comments' => $this->input->post('comments'),                   
                    'approved_by' => $approved_by,                   
                    'approved_date' => $approved_date,                   
            );
            
            $this->db->where('leave_request_id', $this->input->post('leave_request_id'));
            $this->db->update('pyr_staff_leave_request_info', $upd); 
                            
            redirect('dash'); 
        } 
        
        if($this->input->post('mode') == 'Loan Approval')
        {
            $l_status = $this->input->post('status');
            if($l_status == 'Approved')
            {
                $approved_by = $this->session->userdata(SESS_HD . 'user_id');
                $approved_date = date('Y-m-d H:i:s');
            } else {
                $approved_by = '';
                $approved_date = '';
            }
            
            $upd = array(  
                    'loan_pct' => $this->input->post('loan_pct'), 
                    'loan_tenure' => $this->input->post('loan_tenure'), 
                    'loan_emi' => $this->input->post('loan_emi'), 
                    'status' => $this->input->post('status') ,                 
                    'remarks' => $this->input->post('remarks'),                   
                    'approved_by' => $approved_by,                   
                    'approved_date' => $approved_date,                   
            );
            
            $this->db->where('emp_loan_id', $this->input->post('emp_loan_id'));
            $this->db->update('pyr_emp_loan_info', $upd); 
                            
            redirect('dash'); 
        } 
        
        
          
        
        $data['current_date'] =  $srch_from_date = date('Y-m-d'); 
        
        
        $sql = "select 
                a.*,
                b.employee_name as staff,
                b.employee_category,
                c.department_name as department,
                d.designation_name as designation                     
                from pyr_staff_leave_request_info as a   
                left join pyr_employee_info as b on b.employee_id = a.employee_id
                left join pyr_department_info as c on c.department_id = b.department_id
                left join pyr_designation_info as d on d.designation_id = b.designation_id  
                where a.status = 'Pending' or a.status = 'Revise' 
                group by a.leave_request_id 
                order by a.req_date asc , b.employee_name asc ";
                
         
        $data['emp_leave_request'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_leave_request'][] = $row;     
        } 
        
         $sql = "select 
                a.*,
                b.employee_name as staff,
                b.employee_category,
                c.department_name as department,
                d.designation_name as designation                       
                from pyr_emp_loan_info as a  
                left join pyr_employee_info as b on b.employee_id = a.employee_id
                left join pyr_department_info as c on c.department_id = b.department_id
                left join pyr_designation_info as d on d.designation_id = b.designation_id  
                where a.status = 'Pending'  
                group by a.emp_loan_id
                order by a.loan_required_date asc  , b.employee_name asc ";
                
         //and date_format(a.adv_required_date,'%Y-%m') = '". date('Y-m') ."'        
                
         
        $data['emp_loan_request'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_loan_request'][] = $row;     
        }  
          
        
        
        $sql = "select 
                a.*,
                b.employee_name as staff,
                b.employee_category,
                c.department_name as department,
                d.designation_name as designation                     
                from pyr_salary_adv_info as a   
                left join pyr_employee_info as b on b.employee_id = a.employee_id
                left join pyr_department_info as c on c.department_id = b.department_id
                left join pyr_designation_info as d on d.designation_id = b.designation_id  
                where a.status = 'Pending' 
                order by a.adv_required_date asc , b.employee_name asc ";
                
         
        $data['emp_adv_request'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_adv_request'][] = $row;     
        }  
        
        
        $sql = "select 
                a.employee_id,
                a.employee_name as staff,
                a.dob , 
                a.photo_img,
                DATE_FORMAT(a.dob, '%d-%m-". date('Y')."') as dob_date,
                DATEDIFF(DATE_FORMAT(a.dob, '". date('Y')."-%m-%d'),'". date('Y-m-d H:i:s')."')  as days ,
                TIMESTAMPDIFF(YEAR, a.dob, CURDATE()) AS age,
                b.department_name as department,
                c.designation_name as designation  
                from pyr_employee_info as a   
                left join pyr_department_info as b on b.department_id = a.department_id
                left join pyr_designation_info as c on c.designation_id = a.designation_id
                where a.status = 'Active'  
                and MONTH(a.dob) = MONTH('". date('Y-m-d H:i:s')."')
                and (DATEDIFF(DATE_FORMAT(a.dob, '". date('Y')."-%m-%d'),'". date('Y-m-d H:i:s')."') >= 0 )
                order by DATE_FORMAT(a.dob, '". date('Y')."-%m-%d') asc
                 ";
                 
        $data['upcoming_staff_birthday'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['upcoming_staff_birthday'][] = $row;     
        }   
        
        $sql = "
                select 
                a.payslip_month,
                sum(a.net_salary) as paid_salary,
                sum(a.ctc) as ctc
                from pyr_emp_payslip_info as a
                where a.`status` = 'Active'
                group by a.payslip_month
                order by a.payslip_month desc
                limit 6
            ";
        
        $data['salary_paid'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['salary_paid'][] = $row;     
        }   
        
        
        $sql = 
            "  
            select
            count(a.hd_ticket_id) as cnt
            from pyr_hd_ticket_info as a
            where a.`status` != 'Delete'
            and a.`status` != 'Close' 
            ";
                
        $query = $this->db->query($sql);
   
        $data['ticket'] = 0;
   
        foreach($query->result_array() as $row)
        {                 
            $data['ticket'] = $row['cnt'];
        }
        
         $sql =  
           "  
            select 
            a.employee_category,
            count(a.employee_id) as cnt
            from pyr_employee_info as a 
            where a.`status` = 'Active'
            group by a.employee_category
            order by  a.employee_category 
            ";
                
        $query = $this->db->query($sql);
   
        $data['staff'] = array();
   
        foreach($query->result_array() as $row)
        {                 
            $data['staff'][$row['employee_category']] = $row['cnt'];
        }
         
        
        
        $data['leave_status_opt'] = array('Pending' => 'Pending','Approved' => 'Approved', 'Rejected' => 'Rejected', 'Revise' => 'Revise', 'Cancel' => 'Cancel') ;       
        $data['loan_status_opt'] = array('Pending' => 'Pending','Approved' => 'Approved', 'Rejected' => 'Rejected',  'Cancel' => 'Cancel') ;       
             
        $this->load->view('page/dashboard' , $data);
	} 
    
    public function staff_dashboard()
	{
	   
        if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect();
        
        if($this->session->userdata(SESS_HD . 'user_type') == 'Admin' and $this->session->userdata(SESS_HD . 'user_type') == 'Manager') 
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }
         
        $data = array(); 
         
        $data['js'] = 'staff/staff-dash.inc';  
        
        
        $data['current_date'] =  $srch_from_date = date('Y-m-d');
        
        $sql = "select 
                a.*,
                b.department_name as department,
                c.designation_name as designation,
                sum(d.p_flg) as no_of_days_present,  
                round(((a.fixed_salary / ". DEF_WDS_MONTH ." ) * sum(d.p_flg)),2) as pay,
                ifnull(i.outstanding,0) as outstanding              
                from pyr_employee_info as a  
                left join pyr_department_info as b on b.department_id = a.department_id
                left join pyr_designation_info as c on c.designation_id = a.designation_id 
                left join pyr_emp_attendance_info as d on d.employee_code = a.employee_code 
                    and date_format(d.in_time,'%Y-%m') = '". date('Y-m') ."' 
                    and d.status = 'Active'
                left join (
                    select 
                    q.employee_id,
                    GROUP_CONCAT(q.emp_loan_id) as emp_loan_id,
                    sum(q.loan_amount) as loan_amount,
                    sum(q.loan_paid) as loan_paid,
                    sum(q.outstanding) as outstanding, 
                    sum(q.pay_emi) as pay_emi
                    from
                    	(
                    	select 
                    	a1.emp_loan_id,
                    	a1.employee_id,
                    	a1.loan_amount,
                    	a1.loan_required_date,
                    	a1.loan_emi,
                    	sum(ifnull(b1.deduction_amt,0)) as loan_paid,
                    	(a1.loan_amount - sum(ifnull(b1.deduction_amt,0))) as outstanding,
                    	if((a1.loan_amount - sum(ifnull(b1.deduction_amt,0))) > 0 , a1.loan_emi, 0) as pay_emi
                    	from pyr_emp_loan_info as a1
                    	left join pyr_emp_payslip_ded_info as b1 on FIND_IN_SET(a1.emp_loan_id,b1.emp_loan_id) and b1.`status` = 'Active'
                    	where a1.`status` = 'Approved'
                    	and a1.employee_id = '". $this->session->userdata(SESS_HD . 'ref_id') ."'
                    	and DATE_FORMAT(a1.loan_required_date,'%Y%m') <=  '". date('Ym') ."'
                    	group by a1.emp_loan_id , a1.employee_id
                    	) as q 
                    group by q.employee_id	
                    order by q.employee_id	
                ) as i on i.employee_id = a.employee_id     
                where a.status != 'Delete'
                and a.employee_id = '". $this->session->userdata(SESS_HD . 'ref_id') ."'
                group by a.employee_id
                order by a.status, a.employee_name asc ";
         
        $data['emp_info'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_info'] = $row;    
            
            defined('ENB_LOAN')       OR define('ENB_LOAN', $row['enable_loan']);
            defined('ENB_ADVANCE')    OR define('ENB_ADVANCE', $row['enable_advance']); 
        }       
        
        
        $sql = "select
                a.employee_id , 
                a.leave_type,
                count(a.leave_request_id) as leave_days
                from pyr_staff_leave_request_info as a
                where a.`status` = 'Approved'
                and a.employee_id = '". $this->session->userdata(SESS_HD . 'ref_id') ."'
                and a.leave_date between '". ACADEMIC_YEAR_START."' and  '". ACADEMIC_YEAR_END ."'
                group by a.employee_id , a.leave_type
                order by a.employee_id , a.leave_type 
                ";
         
        $data['staff_leave_taken'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['staff_leave_taken'][$row['leave_type']] = $row['leave_days'];     
        }   
        
        
        $sql = "select 
                a.*                     
                from pyr_staff_leave_request_info as a   
                where a.status != 'Delete'
                and a.employee_id = '". $this->session->userdata(SESS_HD . 'ref_id') ."'
                and a.leave_date >= '". $srch_from_date ."'
                group by a.leave_request_id 
                order by a.req_date asc ";
                
         
        $data['emp_leave_request'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_leave_request'][] = $row;     
        }    
        
        
        $sql = "select 
                a.*                     
                from pyr_salary_adv_info as a   
                where a.status != 'Delete'
                and a.employee_id = '". $this->session->userdata(SESS_HD . 'ref_id') ."'  
                and a.adv_required_date >= '". $srch_from_date ."'
                order by a.adv_required_date asc ";
                
         //and date_format(a.adv_required_date,'%Y-%m') = '". date('Y-m') ."'        
                
         
        $data['emp_adv_request'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_adv_request'][] = $row;     
        }    
        
        
        $sql = "select 
                a.*                     
                from pyr_emp_loan_info as a   
                where a.status != 'Delete' 
                and a.loan_required_date >= '". $srch_from_date ."'
                and a.employee_id = '". $this->session->userdata(SESS_HD . 'ref_id') ."'   
                order by a.loan_required_date asc ";
                
         //and date_format(a.adv_required_date,'%Y-%m') = '". date('Y-m') ."'        
                
         
        $data['emp_loan_request'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_loan_request'][] = $row;     
        }    
         
         
        $sql = "select 
                a.* ,
                TIME_TO_SEC(a.late_time) as late_sec
                from pyr_emp_attendance_info as a 
                where a.status != 'Delete' 
                and a.employee_code = '". $data['emp_info']['employee_code']."'
                and date_format(a.in_time,'%Y-%m') = '". date('Y-m')."'
                order by a.in_time desc
                ";
                
                //and date_format(a.in_time,'%Y-%m') = '". date('Y-m')."'
                
         
        $data['attendance'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['attendance'][] = $row;     
        }   
        
        $sql = "
            select 
            a.emp_payslip_id,
            a.employee_id,
            a.employee_code,
            a.payslip_month,
            a.working_days,
            a.days_presents,
            a.cl,
            a.ml,
            a.lop_day,
            a.per_day_salary,
            a.net_salary
            from pyr_emp_payslip_info as a
            where a.`status` = 'Active'
            and a.employee_id = '". $data['emp_info']['employee_id']."'
            order by a.payslip_month desc 
            limit 6
        ";
        
        $data['payslip'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['payslip'][] = $row;     
        }   
        
        
        $sql = 
           "  
            select
            count(a.hd_ticket_id) as cnt
            from pyr_hd_ticket_info as a
            where a.`status` != 'Delete'
            and a.`status` != 'Close' 
            and ( 
                a.frm_user_id = '". $this->session->userdata(SESS_HD .'user_id') ."' 
                or 
                a.to_user_id = '". $this->session->userdata(SESS_HD .'user_id') ."' 
                or 
                 FIND_IN_SET('". $this->session->userdata(SESS_HD .'user_id') ."', a.share_to) 
                )
            ";
                
        $query = $this->db->query($sql);
   
        $data['ticket'] = 0;
   
        foreach($query->result_array() as $row)
        {                 
            $data['ticket'] = $row['cnt'];
        }   
        
        /*
        $sql = "
            select  
            (a1.casual_leave - ifnull(b1.leave_days,0)) as casual_leave,
            (a1.medical_leave - ifnull(c1.leave_days,0))  as medical_leave,
            ifnull(d1.leave_days,0) as lop
            from pyr_employee_info as a1
            left join (
            select 
            a.employee_id , 
            a.leave_type, 
            count(a.leave_request_id) as leave_days 
            from pyr_staff_leave_request_info as a 
            where (a.`status` = 'Approved' ) 
            and a.employee_id = '". $this->session->userdata(SESS_HD . 'ref_id')."'
            and a.leave_date between '". ACADEMIC_YEAR_START."' and '". ACADEMIC_YEAR_END."' 
            and a.leave_type = 'Casual Leave'
            group by a.employee_id , a.leave_type 
            order by a.employee_id , a.leave_type 
            ) as b1 on b1.employee_id = a1.employee_id
            left join (
            select 
            a.employee_id , 
            a.leave_type, 
            count(a.leave_request_id) as leave_days 
            from pyr_staff_leave_request_info as a 
            where (a.`status` = 'Approved' ) 
            and a.employee_id = '". $this->session->userdata(SESS_HD . 'ref_id')."'
            and a.leave_date between '". ACADEMIC_YEAR_START."' and '". ACADEMIC_YEAR_END."'
            and a.leave_type = 'Medical Leave'
            group by a.employee_id , a.leave_type 
            order by a.employee_id , a.leave_type 
            ) as c1 on c1.employee_id = a1.employee_id 
            left join (
            select 
            a.employee_id , 
            a.leave_type, 
            count(a.leave_request_id) as leave_days 
            from pyr_staff_leave_request_info as a 
            where (a.`status` = 'Approved' ) 
            and a.employee_id = '". $this->session->userdata(SESS_HD . 'ref_id')."' 
            and a.leave_date between '". ACADEMIC_YEAR_START."' and '". ACADEMIC_YEAR_END."' 
            and a.leave_type = 'Loss Of Pay'
            group by a.employee_id , a.leave_type 
            order by a.employee_id , a.leave_type 
            ) as d1 on d1.employee_id = a1.employee_id
            where a1.employee_id = '". $this->session->userdata(SESS_HD . 'ref_id')."'
            order by a1.employee_id 
        ";
        
        $data['leave_available'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['leave_available'] = $row;     
        }   
        */ 
        
         
        /*if(date('m') <= '05')
         echo (date('Y') - 1) . '-06-01 to ' . date('Y'). '-05-31';
        else 
          echo date('Y'). '-06-01 to ' . (date('Y')+ 1 ). '-05-31' ;   */
             
        $this->load->view('page/staff-dashboard' , $data);
	} 
    
}
