<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Staff extends CI_Controller {

 
	public function index()
	{
		//$this->load->view('page/dashboard');
	}
    
    public function salary_bank_submission() 
    {
        if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect();
        
        if($this->session->userdata(SESS_HD . 'user_type') != 'Admin')
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }
        
        
        
        $data['js'] = 'staff/salary-bank-submission.inc';  
        $data['s_url'] = 'salary-bank-submission';  
        $data['title'] = 'Salary Bank Submission';  
        
         if($this->input->post('mode') == 'Add Bank Submission')
        {
            $ins = array(
                    'mgt_bank_id' => $this->input->post('mgt_bank_id'), 
                    'transaction_date' => $this->input->post('transaction_date'), 
                    'payslip_month' => $this->input->post('payslip_month'), 
                    'emp_category' => $this->input->post('emp_category'), 
                    'department' => $this->input->post('department'), 
                    'payslip_month' => $this->input->post('payslip_month'), 
                    'department' => $this->input->post('department'), 
                    'payslip_ids' => implode(',',$this->input->post('payslip_ids')), 
                    'remarks' => $this->input->post('remarks'),  
                    'status' => 'Active' ,
                    'created_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                    'created_date' => date('Y-m-d H:i:s') ,
                    'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                    'updated_date' => date('Y-m-d H:i:s')                                 
            );
            
            $this->db->insert('pyr_salary_bank_submit_info', $ins); 
            
            redirect('salary-bank-submission-report');
            
        }
         
        
        if(isset($_POST['srch_month'])) {
           $data['srch_month'] = $srch_month = $this->input->post('srch_month');
           $this->session->set_userdata('srch_month', $this->input->post('srch_month'));         
        } elseif($this->session->userdata('srch_month')) {
           $data['srch_month'] = $srch_month = $this->session->userdata('srch_month') ; 
        }  else {
            $data['srch_month'] =  $srch_month = date('Y-m'); 
        }  
        
        if(isset($_POST['srch_emp_category'])) {
           $data['srch_emp_category'] = $srch_emp_category = $this->input->post('srch_emp_category');
           $this->session->set_userdata('srch_emp_category', $this->input->post('srch_emp_category'));     
        } elseif($this->session->userdata('srch_emp_category')) {
           $data['srch_emp_category'] = $srch_emp_category = $this->session->userdata('srch_emp_category') ; 
        } else {
            $data['srch_emp_category'] =  $srch_emp_category = '';
        } 
        
        if(isset($_POST['srch_department'])) {
           $data['srch_department'] = $srch_department = $this->input->post('srch_department');
           $this->session->set_userdata('srch_department', $this->input->post('srch_department'));     
        } elseif($this->session->userdata('srch_department')) {
           $data['srch_department'] = $srch_department = $this->session->userdata('srch_department') ; 
        } else {
            $data['srch_department'] =  $srch_department = '';
        } 
        
      
        
        $where = "1=1"; 
        
          
        if($srch_department!= ''){
            $where .=" and (a.department_id = '". $srch_department."')"; 
        }
            
        if($srch_emp_category!= ''){
            $where .=" and (b.employee_category = '". $srch_emp_category."')";    
        }
        
        
       $sql = "
            select 
            a.emp_payslip_id,
            a.employee_id,
            a.employee_code,
            b.employee_name as emp_name,
            b.employee_category,
            a.department as dept,
            a.designation as design,
            a.payslip_month, 
            a.gross_salary,
            a.deduction,
            a.net_salary,
            a.ctc,
            ifnull(c.salary_bank_submit_id,0) as salary_bank_submit_id
            from pyr_emp_payslip_info as a
            left join pyr_employee_info as b on b.employee_id = a.employee_id 
            left join pyr_salary_bank_submit_info as c on c.payslip_month = a.payslip_month and FIND_IN_SET(a.emp_payslip_id, c.payslip_ids)
            where a.`status` = 'Active' 
            and $where 
            and a.payslip_month = '". $srch_month ."'
            order by a.payslip_month desc  , a.employee_code asc
        ";
        
        $data['payslip'] = array(); 
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['payslip'][$row['emp_payslip_id']] = $row;  
        }
        
        
        
        
        $sql = "
                select 
                a.emp_category_name             
                from pyr_emp_category_info as a  
                where a.status = 'Active'  
                order by a.emp_category_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['emp_category_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_category_opt'][$row['emp_category_name']] = $row['emp_category_name'];     
        }
        
        $sql = "
                select 
                a.department_id,             
                a.department_name             
                from pyr_department_info as a  
                where a.status = 'Active'  
                order by a.department_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['department_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['department_opt'][$row['department_id']] = $row['department_name'];     
        }  
        
        $sql = "
                select 
                a.mgt_bank_id,
                a.bank_name, 
                a.account_no              
                from pyr_mgt_bank_info as a  
                where a.status = 'Active'  
                order by a.bank_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['mgt_bank_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['mgt_bank_opt'][$row['mgt_bank_id']] = $row['bank_name'] . " || " . $row['account_no'];     
        }
          
       
        
        $this->load->view('page/staff/'. $data['s_url'] ,$data);
         
        
    }
    
    public function salary_bank_submission_report() 
    {
        if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect();
        
        if($this->session->userdata(SESS_HD . 'user_type') != 'Admin')
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }
        
        
        
        $data['js'] = 'staff/salary-bank-submission-report.inc';  
        $data['s_url'] = 'salary-bank-submission-report';  
        $data['title'] = 'Salary Bank Submission Report';  
        
        
        if(isset($_POST['srch_month'])) {
           $data['srch_month'] = $srch_month = $this->input->post('srch_month');  
           $this->session->set_userdata('srch_month', $this->input->post('srch_month'));      
        } elseif($this->session->userdata('srch_month')) {
           $data['srch_month'] = $srch_month = $this->session->userdata('srch_month') ; 
        }  else {
            $data['srch_month'] =  $srch_month = date('Y-m'); 
        }  
        
        if(isset($_POST['srch_emp_category'])) {
           $data['srch_emp_category'] = $srch_emp_category = $this->input->post('srch_emp_category');
           $this->session->set_userdata('srch_emp_category', $this->input->post('srch_emp_category'));     
        } elseif($this->session->userdata('srch_emp_category')) {
           $data['srch_emp_category'] = $srch_emp_category = $this->session->userdata('srch_emp_category') ; 
        } else {
            $data['srch_emp_category'] =  $srch_emp_category = '';
        } 
        
        if(isset($_POST['srch_department'])) {
           $data['srch_department'] = $srch_department = $this->input->post('srch_department');
           $this->session->set_userdata('srch_department', $this->input->post('srch_department'));     
        } elseif($this->session->userdata('srch_department')) {
           $data['srch_department'] = $srch_department = $this->session->userdata('srch_department') ; 
        } else {
            $data['srch_department'] =  $srch_department = '';
        } 
        
      
        
        $where = "1=1"; 
        
          
        if($srch_department!= ''){
            $where .=" and (a.department_id = '". $srch_department."')"; 
        }
            
        if($srch_emp_category!= ''){
            $where .=" and (a.emp_category = '". $srch_emp_category."')";   
        }
         
        
        $sql = "
                select  
                a.*,
                b.bank_name,
                b.account_no           
                from pyr_salary_bank_submit_info as a  
                left join pyr_mgt_bank_info as b on b.mgt_bank_id = a.mgt_bank_id
                where a.status = 'Active'  
                and $where
                and a.payslip_month = '". $srch_month ."'
                order by a.payslip_month desc , a.transaction_date  desc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['salary_bank_submit_info'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['salary_bank_submit_info'][] = $row;     
        }
        
        $sql = "
                select 
                a.emp_category_name             
                from pyr_emp_category_info as a  
                where a.status = 'Active'  
                order by a.emp_category_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['emp_category_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_category_opt'][$row['emp_category_name']] = $row['emp_category_name'];     
        }
        
        $sql = "
                select 
                a.department_id,             
                a.department_name             
                from pyr_department_info as a  
                where a.status = 'Active'  
                order by a.department_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['department_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['department_opt'][$row['department_id']] = $row['department_name'];     
        }  
        
        $sql = "
                select 
                a.mgt_bank_id,
                a.bank_name, 
                a.account_no              
                from pyr_mgt_bank_info as a  
                where a.status = 'Active'  
                order by a.bank_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['mgt_bank_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['mgt_bank_opt'][$row['mgt_bank_id']] = $row['bank_name'] . " || " . $row['account_no'];     
        }
          
       
        
        $this->load->view('page/staff/'. $data['s_url'] ,$data);
         
        
    }
    
    
    public function staff_salary() 
    {
        
        if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect();
        
        if($this->session->userdata(SESS_HD . 'user_type') != 'Admin')
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }
        
        $data['js'] = 'staff/staff-salary.inc';  
        $data['s_url'] = 'staff-salary';  
        $data['title'] = 'Staff Salary';  
        
         
        
        if(isset($_POST['srch_month'])) {
           $data['srch_month'] = $srch_month = $this->input->post('srch_month');   
           $this->session->set_userdata('srch_month', $this->input->post('srch_month'));    
        } elseif($this->session->userdata('srch_month')) {
           $data['srch_month'] = $srch_month = $this->session->userdata('srch_month') ; 
        }  else {
            $data['srch_month'] =  $srch_month = date('Y-m'); 
        }  
        
        if(isset($_POST['srch_emp_category'])) {
           $data['srch_emp_category'] = $srch_emp_category = $this->input->post('srch_emp_category');
           $this->session->set_userdata('srch_emp_category', $this->input->post('srch_emp_category'));     
        } elseif($this->session->userdata('srch_emp_category')) {
           $data['srch_emp_category'] = $srch_emp_category = $this->session->userdata('srch_emp_category') ; 
        } else {
            $data['srch_emp_category'] =  $srch_emp_category = '';
        } 
        
        if(isset($_POST['srch_department'])) {
           $data['srch_department'] = $srch_department = $this->input->post('srch_department');
           $this->session->set_userdata('srch_department', $this->input->post('srch_department'));     
        } elseif($this->session->userdata('srch_department')) {
           $data['srch_department'] = $srch_department = $this->session->userdata('srch_department') ; 
        } else {
            $data['srch_department'] =  $srch_department = '';
        } 
        
      
        
        $where = "1=1";
        $where1 = "1=1";
        
          
        if($srch_department!= ''){
            $where .=" and (a.department_id = '". $srch_department."')";
           // $where1 .=" and (a.department_id = '". $srch_department."')";
        }
            
        if($srch_emp_category!= ''){
            $where .=" and (a.employee_category = '". $srch_emp_category."')";   
            //$where1 .=" and (a.employee_category = '". $srch_emp_category."')";   
        }
         
        
        
        
        $sql = "
                select
                a.employee_id,
                a.employee_code,
                a.employee_name as emp_name,
                b.department_name as dept,
                c.designation_name as design,
                a.fixed_salary,
                `get_working_days`('". $srch_month ."-01', '". date('Y-m-t',strtotime($srch_month))."') as no_of_days_working,
                d.no_of_days_presents,
                d.tot_late_hrs,
                ifnull(e.cl,0) as cl,
                ifnull(f.ml,0) as ml,
                ifnull(g.lop,0) as lop , 
                ifnull(h.emp_payslip_id,0) as emp_payslip_id  ,
                ifnull(h.gross_salary,0) as gross_salary  ,
                ifnull(h.deduction,0) as deduction  ,
                ifnull(h.net_salary,0) as net_salary  , 
                ifnull(h.ctc,0) as ctc
                from pyr_employee_info as a  
                left join pyr_department_info as b on b.department_id = a.department_id
                left join pyr_designation_info as c on c.designation_id = a.designation_id 
                left join 
                (
                	select 
                	 q.employee_code,
                    sum(q.p_flg) as no_of_days_presents,
                    sum(TIME_FORMAT(q.late_time,'%H')) tot_late_hrs 
                	from pyr_emp_attendance_info as q
                	where q.`status` != 'Delete'
                	and DATE_FORMAT(q.in_time,'%Y-%m') = '". $srch_month ."'
                	group by q.employee_code
                	order by q.employee_code
                ) as d on d.employee_code= a.employee_code
                left join 
                (
                    select 
                    q.employee_id,
                    q.leave_type,
                    count(q.leave_request_id) as cl
                    from pyr_leave_request_info as q
                    left join pyr_leave_req_date_info as w on w.leave_request_id = q.leave_request_id
                    where q.`status` = 'Approved'
                    and DATE_FORMAT(w.leave_date,'%Y-%m') = '". $srch_month ."'
                    and q.leave_type = 'Casual Leave'
                    group by q.employee_id , q.leave_type
                    order by q.employee_id
                ) as e on e.employee_id = a.employee_id
                left join 
                (
                    select 
                    q.employee_id,
                    q.leave_type,
                    count(q.leave_request_id) as ml
                    from pyr_leave_request_info as q
                    left join pyr_leave_req_date_info as w on w.leave_request_id = q.leave_request_id
                    where q.`status` = 'Approved'
                    and DATE_FORMAT(w.leave_date,'%Y-%m') = '". $srch_month ."'
                    and q.leave_type = 'Medical Leave'
                    group by q.employee_id , q.leave_type
                    order by q.employee_id
                ) as f on f.employee_id = a.employee_id 
                left join 
                (
                    select 
                    q.employee_id,
                    q.leave_type,
                    count(q.leave_request_id) as lop
                    from pyr_leave_request_info as q
                    left join pyr_leave_req_date_info as w on w.leave_request_id = q.leave_request_id
                    where q.`status` = 'Approved'
                    and DATE_FORMAT(w.leave_date,'%Y-%m') = '". $srch_month ."'
                    and q.leave_type = 'LOP'
                    group by q.employee_id , q.leave_type
                    order by q.employee_id
                ) as g on g.employee_id = a.employee_id
                left join pyr_emp_payslip_info as h on h.employee_id = a.employee_id and h.payslip_month = '". $srch_month ."' and h.status = 'Active'
                where a.`status` != 'Delete' 
                order by a.employee_code asc
                             
        ";
        
        $data['attendance'] = array(); 
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['attendance'][$row['employee_code']] = $row;  
        }
        
        
        
        $sql = "
                select 
                a.emp_category_name             
                from pyr_emp_category_info as a  
                where a.status = 'Active'  
                order by a.emp_category_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['emp_category_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_category_opt'][$row['emp_category_name']] = $row['emp_category_name'];     
        }
        
        $sql = "
                select 
                a.department_id,             
                a.department_name             
                from pyr_department_info as a  
                where a.status = 'Active'  
                order by a.department_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['department_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['department_opt'][$row['department_id']] = $row['department_name'];     
        }  
          
       
        
        $this->load->view('page/staff/'. $data['s_url'] ,$data);
        
        
    }
    
    public function staff_attendance_chart() 
    {
        if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect();
        
        if($this->session->userdata(SESS_HD . 'user_type') != 'Admin')
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }
        
        $data['js'] = 'staff/staff-attendance-chart.inc';  
        $data['s_url'] = 'staff-attendance-chart';  
        $data['title'] = 'Staff Attendance Chart';  
        
        
        if(isset($_POST['srch_month'])) {
           $data['srch_month'] = $srch_month = $this->input->post('srch_month');     
        }  else {
            $data['srch_month'] =  $srch_month = date('Y-m'); 
        }  
        
        if(isset($_POST['srch_emp_category'])) {
           $data['srch_emp_category'] = $srch_emp_category = $this->input->post('srch_emp_category');
           $this->session->set_userdata('srch_emp_category', $this->input->post('srch_emp_category'));     
        } elseif($this->session->userdata('srch_emp_category')) {
           $data['srch_emp_category'] = $srch_emp_category = $this->session->userdata('srch_emp_category') ; 
        } else {
            $data['srch_emp_category'] =  $srch_emp_category = '';
        } 
        
        if(isset($_POST['srch_department'])) {
           $data['srch_department'] = $srch_department = $this->input->post('srch_department');
           $this->session->set_userdata('srch_department', $this->input->post('srch_department'));     
        } elseif($this->session->userdata('srch_department')) {
           $data['srch_department'] = $srch_department = $this->session->userdata('srch_department') ; 
        } else {
            $data['srch_department'] =  $srch_department = '';
        } 
        
      
        
        $where = "1=1";
        $where1 = "1=1";
        
          
        if($srch_department!= ''){
            $where .=" and (b.department_id = '". $srch_department."')";
            $where1 .=" and (a.department_id = '". $srch_department."')";
        }
            
        if($srch_emp_category!= ''){
            $where .=" and (b.employee_category = '". $srch_emp_category."')";   
            $where1 .=" and (a.employee_category = '". $srch_emp_category."')";   
        }
         
        
        
        
        $sql = "
                select 
                a.employee_code,
                a.in_time,
                a.out_time, 
                TIME_FORMAT(TIMEDIFF(a.out_time,a.in_time),'%h:%i') as hrs,
                b.employee_name as staff ,
                c.department_name as department,
                d.designation_name as designation             
                from pyr_emp_attendance_info as a  
                left join pyr_employee_info as b on b.employee_code = a.employee_code 
                left join pyr_department_info as c on c.department_id = b.department_id
                left join pyr_designation_info as d on d.designation_id = b.designation_id 
                where a.status != 'Delete'
                and $where
                order by b.employee_code , a.in_time asc 
                             
        ";
        
        $data['attendance'] = array(); 
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['attendance'][$row['employee_code']][ date('Y-m-d',strtotime($row['in_time']))] = $row;  
        }
        
        
        
        
        
        $sql = "
                select 
                a.employee_id,
                a.employee_code,
                a.employee_name,
                a.employee_category,
                a.department_id,
                a.designation_id,
                a.hire_date,
                a.casual_leave,
                a.medical_leave,
                a.salary_leave,
                a.permission,
                a.fixed_salary,
                a.increment_amt,
                a.basic_pay,
                a.da,
                a.hra,
                a.ta,
                a.esi,
                a.tds_it             
                from pyr_employee_info as a  
                where a.status = 'Active'
                and $where1  
                order by a.employee_code asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['emp_info'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_info'][$row['employee_code']] = $row;     
        }
        
        $sql = "
                select 
                a.emp_category_name             
                from pyr_emp_category_info as a  
                where a.status = 'Active'  
                order by a.emp_category_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['emp_category_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_category_opt'][$row['emp_category_name']] = $row['emp_category_name'];     
        }
        
        $sql = "
                select 
                a.department_id,             
                a.department_name             
                from pyr_department_info as a  
                where a.status = 'Active'  
                order by a.department_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['department_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['department_opt'][$row['department_id']] = $row['department_name'];     
        }  
          
       
        
        $this->load->view('page/staff/'. $data['s_url'] ,$data);  
    }
    
    public function staff_attendance_list() 
    {
       if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect();
        
       /* if($this->session->userdata(SESS_HD . 'user_type') != 'Admin' and $this->session->userdata(SESS_HD . 'user_type') != 'Manager')
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }   */
        	    
        $data['js'] = 'staff/staff-attendance.inc';  
        $data['s_url'] = 'staff-attendance-list';  
        $data['title'] = 'Staff Attendance List';  
        
         
         
        
        if($this->input->post('mode') == 'Edit')
        {
            $upd = array(
                     
                    'employee_code' => $this->input->post('employee_code'), 
                    'in_time' => $this->input->post('in_time'), 
                    'out_time' => $this->input->post('out_time'), 
                    'status' => 'Active'                  
            );
            
            $this->db->where('emp_attendance_id', $this->input->post('emp_attendance_id'));
            $this->db->update('pyr_emp_attendance_info', $upd); 
                            
            redirect($data['s_url']. '/' . $this->uri->segment(2, 0)); 
        } 
        
        if(isset($_POST['srch_from_date'])) {
           $data['srch_from_date'] = $srch_from_date = $this->input->post('srch_from_date');
           $data['srch_to_date'] = $srch_to_date = $this->input->post('srch_to_date');
           $this->session->set_userdata('srch_from_date', $this->input->post('srch_from_date'));     
           $this->session->set_userdata('srch_to_date', $this->input->post('srch_to_date'));     
        } elseif($this->session->userdata('srch_from_date')) {
           $data['srch_from_date'] = $srch_from_date = $this->session->userdata('srch_from_date') ; 
           $data['srch_to_date'] = $srch_to_date = $this->session->userdata('srch_to_date') ; 
        } else {
            $data['srch_from_date'] =  $srch_from_date = date('Y-m-01');
            $data['srch_to_date'] =  $srch_to_date = date('Y-m-d');
        }  
        
        if(isset($_POST['srch_emp_category'])) {
           $data['srch_emp_category'] = $srch_emp_category = $this->input->post('srch_emp_category');
           $this->session->set_userdata('srch_emp_category', $this->input->post('srch_emp_category'));     
        } elseif($this->session->userdata('srch_emp_category')) {
           $data['srch_emp_category'] = $srch_emp_category = $this->session->userdata('srch_emp_category') ; 
        } else {
            $data['srch_emp_category'] =  $srch_emp_category = '';
        } 
        
        if(isset($_POST['srch_department'])) {
           $data['srch_department'] = $srch_department = $this->input->post('srch_department');
           $this->session->set_userdata('srch_department', $this->input->post('srch_department'));     
        } elseif($this->session->userdata('srch_department')) {
           $data['srch_department'] = $srch_department = $this->session->userdata('srch_department') ; 
        } else {
            $data['srch_department'] =  $srch_department = '';
        } 
        
        
        
        if(isset($_POST['srch_key'])) {
           $data['srch_key'] = $srch_key = $this->input->post('srch_key');
           $this->session->set_userdata('srch_key', $this->input->post('srch_key'));     
        } elseif($this->session->userdata('srch_key')) {
           $data['srch_key'] = $srch_key = $this->session->userdata('srch_key') ; 
        } else {
            $data['srch_key'] =  $srch_key = '';
        } 
        
        $where = "date_format(a.in_time,'%Y-%m-%d') between '". $srch_from_date."' and '". $srch_to_date."'";
        
        if($srch_key!= '')
            $where .=" and (b.employee_code like '%". $srch_key."%' or  b.employee_name like '%". $srch_key."%' or  b.mobile like '%". $srch_key."%' or  b.alt_mobile like '%". $srch_key."%'  )";
        
        if($srch_department!= '')
            $where .=" and (b.department_id = '". $srch_department."')";
            
        if($srch_emp_category!= '')
            $where .=" and (b.employee_category = '". $srch_emp_category."')";   
         
        
        $this->load->library('pagination'); 
        
        $this->db->where('a.status != ', 'Delete'); 
        $this->db->where($where); 
        $this->db->from('pyr_emp_attendance_info as a');         
        $this->db->join('pyr_employee_info as b','a.employee_code = b.employee_code','left');         
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
                b.employee_name as staff ,
                c.department_name as department,
                d.designation_name as designation             
                from pyr_emp_attendance_info as a  
                left join pyr_employee_info as b on b.employee_code = a.employee_code 
                left join pyr_department_info as c on c.department_id = b.department_id
                left join pyr_designation_info as d on d.designation_id = b.designation_id
                where a.status != 'Delete'
                and $where
                order by a.in_time asc    
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
                a.emp_category_name             
                from pyr_emp_category_info as a  
                where a.status = 'Active'  
                order by a.emp_category_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['emp_category_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_category_opt'][$row['emp_category_name']] = $row['emp_category_name'];     
        }
        
        $sql = "
                select 
                a.department_id,             
                a.department_name             
                from pyr_department_info as a  
                where a.status = 'Active'  
                order by a.department_name asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['department_opt'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['department_opt'][$row['department_id']] = $row['department_name'];     
        }  
          
        
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('page/staff/'. $data['s_url'] ,$data);  
    }
    
    public function attendance_import() 
    {
        if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect();
        if($this->session->userdata(SESS_HD . 'user_type') != 'Admin')
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }
       
        	    
        $data['js'] = 'staff/attendance-import.inc';  
        $data['s_url'] = 'attendance-import';  
        $data['title'] = 'Attendance Import From Excel File';  
        
        
        $this->load->view('page/staff/'. $data['s_url'] ,$data); 
    }
    
    public function attendance_import_xls(){ 
        
        
         date_default_timezone_set("Asia/Calcutta");  
        
       // print_r($_FILES);
        
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        
        if(isset($_FILES['attendance_file']['name']) && in_array($_FILES['attendance_file']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['attendance_file']['name']);
            $extension = end($arr_file);
            if('csv' == $extension){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            }elseif('xls' == $extension){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['attendance_file']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
             
            
           
            
            for($i=1;$i<count($sheetData);$i++)
            {   //$ins1 = array();
                $ins['created_by'] = $this->session->userdata(SESS_HD . 'user_id');
                $ins['updated_by'] = $this->session->userdata(SESS_HD . 'user_id');
                $ins['created_date'] = date('Y-m-d H:i:s');
                $ins['updated_date'] = date('Y-m-d H:i:s');
                $ins['status'] = 'Active';
                foreach($sheetData[$i] as $j => $val){
                    //$ins1 .= $sheetData[0][$j] .  " => " . $val .',';
                    //$ins1[$sheetData[0][$j]] =  $this->db->escape($val);
                    $ins[$sheetData[0][$j]] =  $val ;
                }
                
                //$aa_ins[] = $ins1;
                
                $this->db->insert('pyr_emp_attendance_info', $ins); 
                
            }
            
            //echo implode(',',$sheetData[0]);
            
            //echo "<pre>";
            // print_r($sheetData);
            //print_r($ins);
            //print_r($aa_ins);
            //echo "</pre>";
            
            redirect('attendance-import');
            
        }
    }
    
    
    public function leave_request() 
	{
	    if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect();
        
       
        	    
        $data['js'] = 'staff/leave-request.inc';  
        $data['s_url'] = 'leave-request';  
        $data['title'] = 'Leave Request';  
        
      //  echo (strtotime('2024-09-11') - strtotime('2024-09-01')) / (60 * 60 * 24) + 1;
        
         
        if($this->input->post('mode') == 'Add')
        {
            $ins = array(
                    'req_date' =>  date('Y-m-d H:i:s'), 
                    'employee_id' => $this->session->userdata(SESS_HD . 'ref_id'), 
                    'leave_date' => $this->input->post('leave_date'),  
                    'leave_type' => $this->input->post('leave_type'), 
                    'reason' => $this->input->post('reason'), 
                    'status' => 'Pending'                                 
            );
            
            $this->db->insert('pyr_staff_leave_request_info', $ins); 
            redirect($data['s_url']);
        }
        
        if($this->input->post('mode') == 'Edit')
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
                    'leave_date' => $this->input->post('leave_date'),    
                    'leave_type' => $this->input->post('leave_type'), 
                    'reason' => $this->input->post('reason'), 
                    'status' => $this->input->post('status') ,                 
                    'comments' => $this->input->post('comments'),                   
                    'approved_by' => $approved_by,                   
                    'approved_date' => $approved_date,                   
            );
            
            $this->db->where('leave_request_id', $this->input->post('leave_request_id'));
            $this->db->update('pyr_staff_leave_request_info', $upd); 
                            
            redirect($data['s_url']. '/' . $this->uri->segment(2, 0)); 
        } 
         
        
        $this->load->library('pagination'); 
        
        $this->db->where('status != ', 'Delete'); 
        if($this->session->userdata(SESS_HD . 'user_type') == 'Staff' ) {
            $this->db->where('employee_id', $this->session->userdata(SESS_HD . 'ref_id')); 
        }
        $this->db->from('pyr_staff_leave_request_info');         
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
        
        
        if($this->session->userdata(SESS_HD . 'user_type') == 'Staff' ) {
            $sql = "
                    select 
                    a.*,
                    b.employee_name as staff  ,
                    c.department_name as department,
                    d.designation_name as designation         
                    from pyr_staff_leave_request_info as a  
                    left join pyr_employee_info as b on b.employee_id = a.employee_id
                    left join pyr_department_info as c on c.department_id = b.department_id
                    left join pyr_designation_info as d on d.designation_id = b.designation_id 
                    where a.status != 'Delete'
                    and a.employee_id = '". $this->session->userdata(SESS_HD . 'ref_id')."'
                    group by a.leave_request_id    
                    order by req_date desc    
                    limit ". $this->uri->segment(2, 0) .",". $config['per_page'] ."                
            ";
        } elseif($this->session->userdata(SESS_HD . 'user_type') == 'Admin' ) {
            $sql = "
                    select 
                    a.*,
                    b.employee_name as staff ,
                    c.department_name as department,
                    d.designation_name as designation          
                    from pyr_staff_leave_request_info as a  
                    left join pyr_employee_info as b on b.employee_id = a.employee_id
                    left join pyr_department_info as c on c.department_id = b.department_id
                    left join pyr_designation_info as d on d.designation_id = b.designation_id 
                    where a.status != 'Delete' 
                    group by a.leave_request_id 
                    order by req_date desc  , a.status  asc
                    limit ". $this->uri->segment(2, 0) .",". $config['per_page'] ."                
            ";
        }
        
       $data['record_list'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['record_list'][] = $row;     
        }
        
        $data['leave_type_opt'] = array('Casual Leave' => 'Casual Leave','Medical Leave' => 'Medical Leave', 'LOP' => 'Loss Of Pay') ;  
        
       
        if($this->session->userdata(SESS_HD . 'user_type') == 'Admin') 
        $data['leave_status_opt'] = array('Pending' => 'Pending','Approved' => 'Approved', 'Rejected' => 'Rejected', 'Revise' => 'Revise', 'Cancel' => 'Cancel') ;  
        else
        $data['leave_status_opt'] = array('Pending' => 'Pending', 'Cancel' => 'Cancel') ;  
       
       
         
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('page/staff/'. $data['s_url'] ,$data); 
	}
    
    public function staff_calender() 
	{
	    if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect(); 
        	    
        $data['js'] = 'staff/staff-calender.inc';  
        $data['s_url'] = 'staff-calender';  
        $data['title'] = 'Staff Calender'; 
        
        if($this->input->post('mode') == 'Add Leave Request')
        {
            $ins = array(
                    'req_date' =>  date('Y-m-d H:i:s'), 
                    'employee_id' => $this->session->userdata(SESS_HD . 'ref_id'), 
                    'leave_date' => $this->input->post('leave_date'), 
                    'leave_type' => $this->input->post('leave_type'), 
                    'reason' => $this->input->post('reason'), 
                    'status' => 'Pending'                                 
            );
            
            $this->db->insert('pyr_staff_leave_request_info', $ins); 
            redirect($data['s_url']);
        }
        
        if($this->input->post('mode') == 'Edit Leave Request')
        {
            $upd = array(
                    'leave_date' => $this->input->post('leave_date'), 
                    'leave_type' => $this->input->post('leave_type'), 
                    'reason' => $this->input->post('reason'), 
                    'status' => $this->input->post('status')                    
            );
            
            $this->db->where('leave_request_id', $this->input->post('leave_request_id'));
            $this->db->update('pyr_staff_leave_request_info', $upd); 
                            
            redirect($data['s_url']); 
        } 
        
       if($this->input->post('mode') == 'Add Salary Advance Request')
        {
            $ins = array(
                    'request_date' =>  date('Y-m-d H:i:s'), 
                    'employee_id' => $this->session->userdata(SESS_HD . 'ref_id'), 
                    'adv_required_date' => $this->input->post('adv_required_date'), 
                    'adv_amount' => $this->input->post('adv_amount'), 
                    'remarks' => $this->input->post('remarks'), 
                    'status' => 'Pending',   
                    'created_by' =>  $this->session->userdata(SESS_HD . 'ref_id'),
                    'created_date' =>  date('Y-m-d H:i:s'), 
                    'updated_by' =>  $this->session->userdata(SESS_HD . 'ref_id'),
                    'updated_date' =>  date('Y-m-d H:i:s'),                               
            );
            
            $this->db->insert('pyr_salary_adv_info', $ins); 
            redirect($data['s_url']);
        }
        
        
        if($this->input->post('mode') == 'Add Loan Request')
        {
            $ins = array(
                    'request_date' =>  date('Y-m-d H:i:s'), 
                    'employee_id' => $this->session->userdata(SESS_HD . 'ref_id'), 
                    'loan_required_date' => $this->input->post('loan_required_date'), 
                    'loan_tenure' => $this->input->post('loan_tenure'), 
                    'loan_amount' => $this->input->post('loan_amount'), 
                    'remarks' => $this->input->post('remarks'), 
                    'status' => 'Pending',   
                    'created_by' =>  $this->session->userdata(SESS_HD . 'ref_id'),
                    'created_date' =>  date('Y-m-d H:i:s'), 
                    'updated_by' =>  $this->session->userdata(SESS_HD . 'ref_id'),
                    'updated_date' =>  date('Y-m-d H:i:s'),                               
            );
            
            $this->db->insert('pyr_emp_loan_info', $ins); 
            redirect($data['s_url']);
        }
        
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
            where (a.`status` = 'Pending' or a.`status` = 'Approved' ) 
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
            where (a.`status` = 'Pending' or a.`status` = 'Approved' ) 
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
            where (a.`status` = 'Pending' or a.`status` = 'Approved' ) 
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
        
        
        
        $data['leave_type_opt'] = array('Casual Leave' => 'Casual Leave','Medical Leave' => 'Medical Leave', 'LOP' => 'Loss Of Pay') ;  
        
        
        
    
        $this->load->view('page/staff/'. $data['s_url'] ,$data); 
	}
    
    public function attendance_calender($emp_id,$mon) 
	{
	    if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect(); 
        
        if($this->session->userdata(SESS_HD . 'user_type') != 'Admin')
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        }  
        	    
        $data['js'] = 'staff/attendance-calender.inc';  
        $data['s_url'] = 'attendance-calender' ; 
        $data['f_url'] = 'attendance-calender' ."/". $emp_id. "/". $mon ; 
        $data['title'] = 'Staff Attendance Calender'; 
        
        $data['emp_id'] = $emp_id; 
        $data['c_mon'] = $mon; 
        
         
        
        if($this->input->post('mode') == 'Add Attendance')
        {
            $ins = array(
                    'employee_code' => $this->input->post('employee_code'), 
                    'in_time' => $this->input->post('in_time'), 
                    'out_time' => $this->input->post('out_time'), 
                    'status' => 'Active'                                
            );
            
            $this->db->insert('pyr_emp_attendance_info', $ins); 
            redirect($data['f_url']);
        }
        
        if($this->input->post('mode') == 'Add Employee Pay Slip')
        {
            $ins = array(
                    'employee_id' => $this->input->post('employee_id'), 
                    'employee_code' => $this->input->post('employee_code'), 
                    'esi_no' => $this->input->post('esi_no'), 
                    'pf_no' => $this->input->post('pf_no'), 
                    'uan_no' => $this->input->post('uan_no'), 
                    'payslip_month' => $this->input->post('payslip_month'), 
                    'department' => $this->input->post('department'), 
                    'designation' => $this->input->post('designation'), 
                    'fixed_salary' => $this->input->post('fixed_salary'), 
                    'working_days' => $this->input->post('working_days'), 
                    'days_presents' => $this->input->post('days_presents'), 
                    'cl' => $this->input->post('cl'), 
                    'ml' => $this->input->post('ml'), 
                    'lop_day' => $this->input->post('lop_day'), 
                    'per_day_salary' => $this->input->post('per_day_salary'), 
                    'gross_salary' => $this->input->post('gross_salary'), 
                    'deduction' => $this->input->post('deduction'), 
                    'net_salary' => $this->input->post('net_salary'), 
                    'ctc' => $this->input->post('ctc'), 
                    'status' => 'Active' ,
                    'created_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                    'created_date' => date('Y-m-d H:i:s') ,
                    'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),                          
                    'updated_date' => date('Y-m-d H:i:s')                                 
            );
            
            $this->db->insert('pyr_emp_payslip_info', $ins); 
            $emp_payslip_id = $this->db->insert_id();
            
            $salary_breakup_id = $this->input->post('salary_breakup_id');
            $salary_breakup_amt = $this->input->post('salary_breakup_amt');
            $breakup_name = $this->input->post('breakup_name');
            $breakup_calc = $this->input->post('breakup_calc');
            
            foreach($salary_breakup_id as $i => $ls)
            {
              $ins = array(
                    'emp_payslip_id' => $emp_payslip_id,  
                    'salary_breakup_id' => $ls,  
                    'salary_breakup_amt' => $salary_breakup_amt[$i],  
                    'breakup_name' => $breakup_name[$i],  
                    'breakup_calc' => $breakup_calc[$i],  
                    'status' => 'Active'                                
                    );  
              $this->db->insert('pyr_emp_payslip_brkup_info', $ins); 
            }       
            
            $deduction_name = $this->input->post('deduction_name');
            $deduction_amt = $this->input->post('deduction_amt');
            $deduction_details = $this->input->post('deduction_details'); 
            $emp_loan_ids = implode(',',$this->input->post('emp_loan_id')); 
            
            foreach($deduction_name as $i => $vl)
            {
              $ins = array(
                    'emp_payslip_id' => $emp_payslip_id,  
                    'emp_loan_id' => $emp_loan_ids,  
                    'deduction_name' => $vl,  
                    'deduction_amt' => $deduction_amt[$i],  
                    'deduction_details' => $deduction_details[$i], 
                    'status' => 'Active'                                
                    );  
              $this->db->insert('pyr_emp_payslip_ded_info', $ins); 
            }       
            
            
            $ctc_name = $this->input->post('ctc_name');
            $ctc_amt = $this->input->post('ctc_amt');
            $ctc_details = $this->input->post('ctc_details'); 
            
            foreach($ctc_name as $i => $vl1)
            {
              $ins = array(
                    'emp_payslip_id' => $emp_payslip_id,  
                    'ctc_name' => $vl1,  
                    'ctc_amt' => $ctc_amt[$i],  
                    'ctc_details' => $ctc_details[$i], 
                    'status' => 'Active'                                
                    );  
              $this->db->insert('pyr_emp_payslip_ctc_info', $ins); 
            } 
            
            $fld_name = $this->input->post('fld_name');
            $fld_value = $this->input->post('fld_value'); 
            
            foreach($fld_name as $i => $fld)
            {
              $ins = array(
                    'emp_payslip_id' => $emp_payslip_id,  
                    'fld_name' => $fld,  
                    'fld_value' => $fld_value[$i],  
                    'status' => 'Active'                                
              );  
              $this->db->insert('pyr_emp_payslip_bank_info', $ins); 
              
              
            } 
            
            $this->session->set_userdata('srch_month', $this->input->post('payslip_month')); 
            redirect('staff-salary');
        }
        
        if($this->input->post('mode') == 'Edit Attendance')
        {
            $upd = array(
                    'in_time' => $this->input->post('in_time'), 
                    'out_time' => $this->input->post('out_time'), 
                    'status' => 'Active'                       
            );
            
            $this->db->where('emp_attendance_id', $this->input->post('emp_attendance_id'));
            $this->db->update('pyr_emp_attendance_info', $upd); 
                            
             redirect($data['f_url']);
        } 
        
        if($this->input->post('mode') == 'Edit Holidays')
        {
            $upd = array(
                    'holiday_date' => $this->input->post('holiday_date'), 
                    'holiday_det' => $this->input->post('holiday_det'), 
                    'status' => $this->input->post('status')                    
            );
            
            $this->db->where('holiday_id', $this->input->post('holiday_id'));
            $this->db->update('pyr_holidays_info', $upd); 
                            
            redirect($data['f_url']); 
        } 
        
        
        $sql = "
                select
                a.employee_id,
                a.designation_id,
                a.emp_photo, 
                a.employee_code,
                a.employee_name as emp_name,
                a.emp_bank_def_ac,
                b.department_name as dept,
                c.designation_name as design, 
                a.is_esi_pf_req,
                a.esi_no,
                a.pf_no,
                a.uan_no,
                a.fixed_salary,
                `get_working_days`('". $mon ."-01', '". date('Y-m-t',strtotime($mon))."') as no_of_days_working1,
                ". DEF_WDS_MONTH ." as no_of_days_working,
                d.no_of_days_presents,
                d.tot_late_hrs,
                ifnull(e.cl,0) as cl,
                ifnull(f.ml,0) as ml,
                ifnull(g.lop,0) as lop,  
                ifnull(h.salary_adv,0) as salary_adv,
                i.emp_loan_id as emp_loan_id,
                ifnull(i.loan_amount,0) as loan_amount , 
                ifnull(i.loan_paid,0) as loan_paid , 
                ifnull(i.outstanding,0) as outstanding ,
                ifnull(i.pay_emi,0) as pay_emi  
                from pyr_employee_info as a  
                left join pyr_department_info as b on b.department_id = a.department_id
                left join pyr_designation_info as c on c.designation_id = a.designation_id 
                left join 
                (
                	select 
                	 q.employee_code,
                    sum(q.p_flg) as no_of_days_presents,
                    sum(TIME_FORMAT(q.late_time,'%H')) tot_late_hrs 
                	from pyr_emp_attendance_info as q
                	where q.`status` != 'Delete'
                	and DATE_FORMAT(q.in_time,'%Y-%m') = '". $mon ."'
                	group by q.employee_code
                	order by q.employee_code
                ) as d on d.employee_code= a.employee_code
                left join 
                (
                    select 
                    a.employee_id , 
                    a.leave_type, 
                    count(a.leave_request_id) as cl 
                    from pyr_staff_leave_request_info as a 
                    where a.`status` = 'Approved'
                    and a.employee_id = '". $emp_id ."'
                    and DATE_FORMAT(a.leave_date,'%Y-%m') = '". $mon ."' 
                    and a.leave_type = 'Casual Leave'
                    group by a.employee_id , a.leave_type 
                    order by a.employee_id , a.leave_type  
                ) as e on e.employee_id = a.employee_id
                left join 
                (
                    select 
                    a.employee_id , 
                    a.leave_type, 
                    count(a.leave_request_id) as ml 
                    from pyr_staff_leave_request_info as a 
                    where a.`status` = 'Approved'
                    and a.employee_id = '". $emp_id ."'
                    and DATE_FORMAT(a.leave_date,'%Y-%m') = '". $mon ."' 
                    and a.leave_type = 'Medical Leave'
                    group by a.employee_id , a.leave_type 
                    order by a.employee_id , a.leave_type  
                ) as f on f.employee_id = a.employee_id 
                left join 
                (
                    select 
                    a.employee_id , 
                    a.leave_type, 
                    count(a.leave_request_id) as lop 
                    from pyr_staff_leave_request_info as a 
                    where a.`status` = 'Approved'
                    and a.employee_id = '". $emp_id ."'
                    and DATE_FORMAT(a.leave_date,'%Y-%m') = '". $mon ."' 
                    and a.leave_type = 'Loss Of Pay'
                    group by a.employee_id , a.leave_type 
                    order by a.employee_id , a.leave_type 
                ) as g on g.employee_id = a.employee_id 
                left join 
                (
                            select 
                            z.employee_id,
                            sum(z.adv_amount) as salary_adv
                            from pyr_salary_adv_info as z
                            where z.status = 'Approved' 
                            and DATE_FORMAT(z.adv_required_date,'%Y-%m') = '". $mon ."'
                            and z.employee_id = '". $emp_id ."'
                            group by z.employee_id
                            order by z.employee_id
                ) as h on h.employee_id = a.employee_id   
                
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
                    	and a1.employee_id = '". $emp_id ."'
                    	and DATE_FORMAT(a1.loan_required_date,'%Y%m') <=  '". date('Ym',strtotime($mon)) ."'
                    	group by a1.emp_loan_id , a1.employee_id
                    	) as q 
                    group by q.employee_id	
                    order by q.employee_id	
                ) as i on i.employee_id = a.employee_id 
                
                where a.`status` != 'Delete' 
                and a.employee_id = '". $emp_id ."'
                order by a.employee_code asc
                             
        ";
        
        $data['attendance'] = array(); 
        
        $query = $this->db->query($sql);
        
        $designation_id = 0;
        $emp_bank_def_ac = '';
       
        foreach ($query->result_array() as $row)
        {
            $data['attendance'] = $row;  
            $designation_id = $row['designation_id'];
            $emp_bank_def_ac = $row['emp_bank_def_ac'];
        }
        
        
        $sql = "
            select 
            a.employee_fld_opt_id,
            b.dyn_fld_opt_name,
            b.dyn_fld_opt_type,
            a.dyn_fld_opt_values  ,
            GROUP_CONCAT(c.dyn_fld_opt_val_name) as dyn_val   ,
            if(b.dyn_fld_opt_type = 'checkbox', GROUP_CONCAT(c.dyn_fld_opt_val_name) , a.dyn_fld_opt_values)  as fld_value       
            from pyr_employee_fld_opt_info as a  
            left join pyr_dyn_fld_opt_info as b on b.dyn_fld_opt_id = a.dyn_fld_opt_id
            left join pyr_dyn_fld_opt_val_info as c on FIND_IN_SET(c.dyn_fld_opt_val_id,a.dyn_fld_opt_values) 
            where a.status = 'Active' 
            and b.dyn_fld_opt_id != ''
            and a.employee_id = '". $emp_id ."'
            and b.dyn_fld_opt_category = '". $emp_bank_def_ac ."'
            group by a.employee_fld_opt_id
            order by a.employee_fld_opt_id asc   
        ";
        
        $data['emp_bank_account'] = array(); 
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_bank_account'][] = $row;  
        }
        
        
        
        //concat(b.salary_breakup_name , " = ", a.salary_breakup_pct , "% of ( ", GROUP_CONCAT(c.salary_breakup_name), " )") as details,
        $sql = '
        select 
        a.desgn_salary_brk_id,
        a.salary_breakup_id,
        b.salary_breakup_name,
        a.salary_breakup_pct,
        concat( a.salary_breakup_pct , "% of ( ", GROUP_CONCAT(c.salary_breakup_name), " )") as details,
        a.pct_of_salary_breakup_id,
        a.sort_order 
        from pyr_desgn_salary_brk_info as a
        left join pyr_salary_breakup_info as b on b.salary_breakup_id = a.salary_breakup_id 
        left join pyr_salary_breakup_info as c on FIND_IN_SET(c.salary_breakup_id,a.pct_of_salary_breakup_id)
        where a.`status` = "Active" and b.`status` = "Active"
        and  a.designation_id = "'. $designation_id  .'" 
        group by a.designation_id , a.salary_breakup_id
        order by a.sort_order asc
        ';
        
        $data['salary_breakup'] = array(); 
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['salary_breakup'][$row['salary_breakup_id']] = $row;  
        }
        
         $sql = '
            select 
            a.*
            from pyr_esi_pf_info as a 
            where a.`status` = "Active"   
            order by a.esi_pf_id asc
        ';
        
        $data['esi_pf_info'] = array(); 
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['esi_pf_info'] = $row;  
        }
        
        
        
        
        $sql = "
            select  
            (a1.casual_leave - b1.leave_days) as casual_leave,
            (a1.medical_leave - ifnull(c1.leave_days,0))  as medical_leave,
            ifnull(d1.leave_days,0) as lop
            from pyr_employee_info as a1
            left join (
            select 
            a.employee_id , 
            a.leave_type, 
            count(a.leave_request_id) as leave_days 
            from pyr_staff_leave_request_info as a 
            where (a.`status` = 'Pending' or a.`status` = 'Approved' ) 
            and a.employee_id = '". $emp_id ."'
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
            where (a.`status` = 'Pending' or a.`status` = 'Approved' ) 
            and a.employee_id = '". $emp_id ."'
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
            where (a.`status` = 'Pending' or a.`status` = 'Approved' ) 
            and a.employee_id = '". $emp_id ."'
            and a.leave_date between '". ACADEMIC_YEAR_START."' and '". ACADEMIC_YEAR_END."' 
            and a.leave_type = 'Loss Of Pay'
            group by a.employee_id , a.leave_type 
            order by a.employee_id , a.leave_type 
            ) as d1 on d1.employee_id = a1.employee_id
            where a1.employee_id = '". $emp_id ."'
            order by a1.employee_id 
        ";
        
        $data['leave_available'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['leave_available'] = $row;     
        }  
        
        
        
        $data['leave_type_opt'] = array('Casual Leave' => 'Casual Leave','Medical Leave' => 'Medical Leave', 'LOP' => 'Loss Of Pay') ;  
        
        
        
    
        $this->load->view('page/staff/'. $data['s_url'] ,$data); 
	}
    
    public function print_payslip($payslip_id){ 
       
        $sql = '
            select 
            a.*,
            b.employee_name
            from pyr_emp_payslip_info as a 
            left join pyr_employee_info as b on b.employee_id = a.employee_id
            where a.`status` = "Active"  
            and  a.emp_payslip_id = "'. $payslip_id  .'"  
            order by a.emp_payslip_id asc
        ';
        
        $data['payslip_info'] = array(); 
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['payslip_info'] = $row;  
        }  
        
        $sql = '
            select 
            a.*
            from pyr_emp_payslip_brkup_info as a 
            where a.`status` = "Active"  
            and  a.emp_payslip_id = "'. $payslip_id  .'"  
            order by a.emp_payslip_brkup_id asc
        ';
        
        $data['payslip_brkup_info'] = array(); 
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['payslip_brkup_info'][] = $row;  
        } 
        
        $sql = '
            select 
            a.*
            from pyr_emp_payslip_ded_info as a 
            where a.`status` = "Active"  
            and  a.emp_payslip_id = "'. $payslip_id  .'"  
            order by a.emp_payslip_ded_id asc
        ';
        
        $data['payslip_ded_info'] = array(); 
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['payslip_ded_info'][] = $row;  
        } 
        
        $sql = '
            select 
            a.*
            from pyr_emp_payslip_ctc_info as a 
            where a.`status` = "Active"  
            and  a.emp_payslip_id = "'. $payslip_id  .'"  
            order by a.emp_payslip_ctc_id asc
        ';
        
        $data['payslip_ctc_info'] = array(); 
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['payslip_ctc_info'][] = $row;  
        }
        
      $this->load->view('page/staff/print-payslip' ,$data);   
    }
    
    public function print_bank_submission($salary_bank_submit_id){ 
       
        $sql =  "
                select  
                a.payslip_month,
                '1' as transfer_type,
                c.net_salary as amount,
                a.transaction_date,
                d.employee_name as name,
                f.fld_value as ac_no,
                b.account_no  as debit_ac_no,
                '' as fund_transf_data  ,
                g.fld_value as ifsc,
                '' as tran_code,
                a.payslip_month as descr
                from pyr_salary_bank_submit_info as a  
                left join pyr_mgt_bank_info as b on b.mgt_bank_id = a.mgt_bank_id
                left join pyr_emp_payslip_info as c on FIND_IN_SET(c.emp_payslip_id, a.payslip_ids) and c.`status` = 'Active'
                left join pyr_employee_info as d on d.employee_id = d.employee_id  and d.`status` = 'Active'
                left join pyr_emp_payslip_bank_info as f on f.emp_payslip_id = c.emp_payslip_id and f.fld_name = 'Account Number'
                left join pyr_emp_payslip_bank_info as g on g.emp_payslip_id = c.emp_payslip_id and g.fld_name = 'IFSC Code'
                where a.status = 'Active'  
                and a.salary_bank_submit_id = '". $salary_bank_submit_id."'
                order by d.employee_code asc
              ";
        
        $data['salary_bank_submit'] = array(); 
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['salary_bank_submit'][] = $row;  
        }   
        
      $this->load->view('page/staff/print-bank-submission' ,$data);   
    }
     
}