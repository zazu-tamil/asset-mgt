<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function staff_leave_summary()
	{
	    if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect(); 
        
       
        	    
        $data['js'] = 'reports/reports.inc'; 
        $data['s_url'] = 'staff-leave-summary'; 
        $data['submit_flg'] = false;
        
      /* if(isset($_POST['srch_from_date'])) {
            $data['srch_from_date'] = $srch_from_date = $this->input->post('srch_from_date'); 
            $data['srch_to_date'] = $srch_to_date = $this->input->post('srch_to_date');  
       } else {
            $data['srch_from_date'] = ACADEMIC_YEAR_START;
            $data['srch_to_date'] = date('Y-m-d'); 
       }*/
       
       if(isset($_POST['srch_emp_category'])) {
            $data['srch_emp_category'] = $srch_emp_category = $this->input->post('srch_emp_category');  
       }else {
            $data['srch_emp_category']  = $srch_emp_category = ''; 
       }
       
       if(isset($_POST['srch_department'])) {
            $data['srch_department'] = $srch_department = $this->input->post('srch_department');  
       }else {
            $data['srch_department']  = $srch_department = ''; 
       }
       
       if(isset($_POST['srch_keyword'])) {
            $data['srch_keyword'] = $srch_keyword = $this->input->post('srch_keyword');  
       }else {
            $data['srch_keyword']  = $srch_keyword = ''; 
       }
       
       $where = "and 1";
       
      /* if(!empty($srch_from_date) && !empty($srch_to_date)  ){
        $where1 = " and q.leave_date between '" . $srch_from_date . "' and  '". $srch_to_date ."'";  
        $data['submit_flg'] = true; 
       }    */
       
        $where1 = " and q.leave_date between '" . ACADEMIC_YEAR_START . "' and  '". ACADEMIC_YEAR_END ."'";  
        $data['submit_flg'] = true; 
        
        if($srch_department!= ''){
            $where .=" and (a.department_id = '". $srch_department."')"; 
        }
            
        if($srch_emp_category!= ''){
            $where .=" and (a.employee_category = '". $srch_emp_category."')";  
        }
        
        if($srch_keyword!= ''){
            $where .=" and (
                            a.employee_name like '%". $srch_keyword."%' or 
                            a.employee_code like  '%". $srch_keyword."%' or
                            a.mobile like '%". $srch_keyword."%' or
                            a.alt_mobile like '%". $srch_keyword."%'  
                            )";  
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
         
        
        if($data['submit_flg']) {
        
         
        $sql = "
                select
                a.*  ,
                ifnull(a.casual_leave,0) as casual_leave,
                ifnull(a.medical_leave,0) as medical_leave,
                c.department_name as dept
                from pyr_employee_info as a 
                left join pyr_department_info as c on c.department_id = a.department_id
                where a.`status` = 'Active'  
                $where 
                order by a.employee_category , c.department_name , a.employee_name  
                 
                              
        ";
         
        $query = $this->db->query($sql);
        
        $data['emp_list'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_list'][$row['employee_category']][$row['dept']][] = $row;     
        }
        
        
        $sql = "
                select
                a.employee_id , 
                b.l_num_month,
                b.l_alp_month,
                if(b.leave_type = 'Casual Leave', b.leave_days , 0) as casual_leave_taken,
                if(b.leave_type = 'Medical Leave', b.leave_days , 0) as medical_leave_taken  
                from pyr_employee_info as a
                left join 
                	(
                		select 
                		q.employee_id,
                		date_format(q.leave_date,'%Y%m') as l_num_month,
                		date_format(q.leave_date,'%Y-%m') as l_alp_month,
                		q.leave_type,
                		count(q.leave_request_id) as leave_days
                		from pyr_staff_leave_request_info as q
                		where q.`status` = 'Approved' 
                	    $where1
                		group by q.employee_id , date_format(q.leave_date,'%Y%m') ,  q.leave_type
                		order by q.employee_id , date_format(q.leave_date,'%Y%m') ,  q.leave_type
                	) as b on b.employee_id = a.employee_id 
                where a.`status` = 'Active'  
                $where
                group by a.employee_id , b.leave_type
                order by a.employee_id asc  
                 
                              
        ";
         
        $query = $this->db->query($sql);
        
        $data['leave_list'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['leave_list'][$row['employee_id']][$row['l_num_month']] = $row;     
        }
        
         
        }
        
        $this->load->view('page/reports/'. $data['s_url'],$data); 
	} 
    
    
    public function staff_salary_summary()
	{
	    if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect(); 
        
         
        	    
        $data['js'] = 'reports/reports.inc'; 
        $data['s_url'] = 'staff-salary-summary'; 
        $data['submit_flg'] = false;
        
        if(isset($_POST['srch_month'])) {
           $data['srch_month'] = $srch_month = $this->input->post('srch_month');    
        } else {
           $data['srch_month'] =  $srch_month = date('Y-m'); 
        }  
       
       if(isset($_POST['srch_emp_category'])) {
            $data['srch_emp_category'] = $srch_emp_category = $this->input->post('srch_emp_category');  
       }else {
            $data['srch_emp_category']  = $srch_emp_category = ''; 
       }
       
       if(isset($_POST['srch_department'])) {
            $data['srch_department'] = $srch_department = $this->input->post('srch_department');  
       }else {
            $data['srch_department']  = $srch_department = ''; 
       }
       
       if(isset($_POST['srch_keyword'])) {
            $data['srch_keyword'] = $srch_keyword = $this->input->post('srch_keyword');  
       }else {
            $data['srch_keyword']  = $srch_keyword = ''; 
       }
       
        $where = "and 1"; 
        
        if($srch_month!= ''){
            $where .=" and (b.payslip_month = '". $srch_month."')"; 
            
            $data['submit_flg'] = true;
        }
       
        if($srch_department!= ''){
            $where .=" and (a.department_id = '". $srch_department."')"; 
        }
            
        if($srch_emp_category!= ''){
            $where .=" and (a.employee_category = '". $srch_emp_category."')";  
        }
        
        if($srch_keyword!= ''){
            $where .=" and (
                            a.employee_name like '%". $srch_keyword."%' or 
                            a.employee_code like  '%". $srch_keyword."%' or
                            a.mobile like '%". $srch_keyword."%' or
                            a.alt_mobile like '%". $srch_keyword."%'  
                            )";  
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
         
        
        if($data['submit_flg']) 
        {
        
         
        $sql = "
                select
                a.employee_id ,
                a.employee_code ,
                a.employee_name , 
                a.employee_category, 
                c.department_name as dept,
                b.fixed_salary,
                b.lop_day,
                b.per_day_salary, 
                (b.lop_day * b.per_day_salary) as lop_amt,
                b.gross_salary,
                b.deduction,
                b.net_salary,
                b.ctc
                from pyr_employee_info as a 
                left join pyr_emp_payslip_info as b on b.employee_id = a.employee_id 
                left join pyr_department_info as c on c.department_id = a.department_id 
                where a.`status` = 'Active' and b.`status` = 'Active'   
                 $where 
                order by a.employee_category , c.department_name , a.employee_name  
                 
                              
        ";
         
        $query = $this->db->query($sql);
        
        $data['emp_list'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_list'][$row['employee_category']][$row['dept']][] = $row;     
        }
         
         
        }
        
        $this->load->view('page/reports/'. $data['s_url'],$data); 
	} 
    
    
    
    public function staff_identity_data()
	{
	    if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect(); 
        
       
        	    
        $data['js'] = 'reports/reports.inc'; 
        $data['s_url'] = 'staff-identity-data'; 
        $data['title'] = 'Staff Identity Information'; 
        $data['submit_flg'] = false;
        
   
       
       if(isset($_POST['srch_emp_category'])) {
            $data['srch_emp_category'] = $srch_emp_category = $this->input->post('srch_emp_category');  
       }else {
            $data['srch_emp_category']  = $srch_emp_category = ''; 
       }
       
       if(isset($_POST['srch_department'])) {
            $data['srch_department'] = $srch_department = $this->input->post('srch_department');  
       }else {
            $data['srch_department']  = $srch_department = ''; 
       }
       
       if(isset($_POST['srch_keyword'])) {
            $data['srch_keyword'] = $srch_keyword = $this->input->post('srch_keyword');  
       }else {
            $data['srch_keyword']  = $srch_keyword = ''; 
       }
       
       $where = "and 1";
       
      /* if(!empty($srch_from_date) && !empty($srch_to_date)  ){
        $where1 = " and q.leave_date between '" . $srch_from_date . "' and  '". $srch_to_date ."'";  
        $data['submit_flg'] = true; 
       }    */
       
        $data['submit_flg'] = true; 
        
        if($srch_department!= ''){
            $where .=" and (q.department_id = '". $srch_department."')"; 
        }
            
        if($srch_emp_category!= ''){
            $where .=" and (q.employee_category = '". $srch_emp_category."')";  
        }
        
        if($srch_keyword!= ''){
            $where .=" and (
                            q.employee_name like '%". $srch_keyword."%' or 
                            q.employee_code like  '%". $srch_keyword."%' or
                            q.mobile like '%". $srch_keyword."%' or
                            q.alt_mobile like '%". $srch_keyword."%'  
                            )";  
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
         
        
        if($data['submit_flg']) {
        
         
       
        
        $sql = "
        select 
        q.employee_id,
        q.employee_code,
        q.employee_name,
        q.employee_category,
        q.pf_no,
        q.uan_no,
        q.esi_no,
        d.department_name as dept,
        a.employee_fld_opt_id,
        b.dyn_fld_opt_name as fld_name, 
        if(b.dyn_fld_opt_type = 'checkbox', GROUP_CONCAT(c.dyn_fld_opt_val_name) , a.dyn_fld_opt_values)  as fld_value      
        from pyr_employee_info as q 
        left join pyr_employee_fld_opt_info as a  on a.employee_id = q.employee_id
        left join pyr_dyn_fld_opt_info as b on b.dyn_fld_opt_id = a.dyn_fld_opt_id  
        left join pyr_dyn_fld_opt_val_info as c on FIND_IN_SET(c.dyn_fld_opt_val_id,a.dyn_fld_opt_values) 
        left join pyr_department_info as d on d.department_id = q.department_id
        where q.status = 'Active' 
        and a.status = 'Active' 
        and b.status = 'Active' 
        and b.dyn_fld_opt_id != '' 
        and (b.dyn_fld_opt_category = q.emp_bank_def_ac  || b.dyn_fld_opt_category = 'Social Identity')
        $where
        group by q.employee_id  , a.employee_fld_opt_id
        order by q.employee_category , d.department_name , q.employee_name , b.dyn_fld_opt_category ,  b.fld_s_order asc   
        ";
         
        $query = $this->db->query($sql);
        
        $data['emp_list'] = array();
        $data['dyn_fld'] = array();
        $data['identity'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_list'][$row['employee_category']][$row['employee_id']] = array(
                                                                                        'employee_id' => $row['employee_id'], 
                                                                                        'employee_code' => $row['employee_code'], 
                                                                                        'employee_name' => $row['employee_name'], 
                                                                                        'employee_category' => $row['employee_category'], 
                                                                                        'uan_no' => $row['uan_no'], 
                                                                                        'esi_no' => $row['esi_no'], 
                                                                                        'dept' => $row['dept'], 
                                                                                        );     
            $data['dyn_fld'][$row['fld_name']] = $row['fld_value'];
            $data['identity'][$row['employee_id']][$row['fld_name']] = $row['fld_value'];
        }
         
         
        }
        
        $this->load->view('page/reports/'. $data['s_url'],$data); 
	} 
    
    
    public function staff_information($employee_id)
	{
	    if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect(); 
        
        
        if($this->session->userdata(SESS_HD . 'user_type') != 'Admin' and $this->session->userdata(SESS_HD . 'user_type') != 'Manager')
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        } 
        
        $sql = "
                select 
                a.*,
                b.department_name as department ,
                c.designation_name as designation              
                from pyr_employee_info as a  
                left join pyr_department_info as b on b.department_id = a.department_id
                left join pyr_designation_info as c on c.designation_id = a.designation_id 
                where a.status != 'Delete'
                and a.employee_id = '". $employee_id ."'
                order by a.status, a.employee_name asc                   
        ";
        
       $data['emp'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['emp'] = $row;     
        }
        
         
        
        $sql = "
            select  
            a.employee_fld_opt_id,
            b.dyn_fld_opt_category,
            b.dyn_fld_opt_name as fld_name, 
            if(b.dyn_fld_opt_type = 'checkbox', GROUP_CONCAT(c.dyn_fld_opt_val_name) , a.dyn_fld_opt_values)  as fld_value      
            from  pyr_employee_fld_opt_info as a   
            left join pyr_dyn_fld_opt_info as b on b.dyn_fld_opt_id = a.dyn_fld_opt_id  
            left join pyr_dyn_fld_opt_val_info as c on FIND_IN_SET(c.dyn_fld_opt_val_id,a.dyn_fld_opt_values) 
            where  a.status = 'Active' and b.status = 'Active' 
            and b.dyn_fld_opt_id != ''  
            and a.employee_id = '". $employee_id ."'
            group by a.employee_id  , a.employee_fld_opt_id
            order by b.dyn_fld_opt_category asc, b.fld_s_order  asc   
        ";
        
       $data['dyn_list'] = array();
        
        $query = $this->db->query($sql);
       
        foreach ($query->result_array() as $row)
        {
            $data['dyn_list'][$row['dyn_fld_opt_category']][] = $row;     
        }
        
        
         $sql = "
                select 
                a.*,
                b.doc_upload_type_name             
                from pyr_emp_doc_upload_info as a  
                left join pyr_doc_upload_type_info as b on b.doc_upload_type_id = a.doc_upload_type_id 
                where a.status = 'Active'  
                and a.employee_id = '". $employee_id ."'
                order by a.emp_doc_upload_id asc                 
        "; 
        
        $query = $this->db->query($sql);
        
        $data['emp_doc_list'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_doc_list'][] = $row;     
        }  
        
        
        
        $this->load->view('page/reports/staff-information',$data); 
	} 
    
    
    public function staff_profile()
	{
	    if(!$this->session->userdata(SESS_HD . 'logged_in'))  redirect(); 
        
        
        if($this->session->userdata(SESS_HD . 'user_type') != 'Admin' and $this->session->userdata(SESS_HD . 'user_type') != 'Manager')
        {
            echo "<h3 style='color:red;'>Permission Denied</h3>"; exit;
        } 
        
         
        	    
        $data['js'] = 'reports/reports.inc'; 
        $data['s_url'] = 'staff-profile'; 
        $data['title'] = 'Staff Profile'; 
        $data['submit_flg'] = false;
        
      /* if(isset($_POST['srch_from_date'])) {
            $data['srch_from_date'] = $srch_from_date = $this->input->post('srch_from_date'); 
            $data['srch_to_date'] = $srch_to_date = $this->input->post('srch_to_date');  
       } else {
            $data['srch_from_date'] = ACADEMIC_YEAR_START;
            $data['srch_to_date'] = date('Y-m-d'); 
       }*/
       
       if(isset($_POST['srch_emp_category'])) {
            $data['srch_emp_category'] = $srch_emp_category = $this->input->post('srch_emp_category');  
       }else {
            $data['srch_emp_category']  = $srch_emp_category = ''; 
       }
       
       if(isset($_POST['srch_department'])) {
            $data['srch_department'] = $srch_department = $this->input->post('srch_department');  
       }else {
            $data['srch_department']  = $srch_department = ''; 
       }
       
       if(isset($_POST['srch_keyword'])) {
            $data['srch_keyword'] = $srch_keyword = $this->input->post('srch_keyword');  
       }else {
            $data['srch_keyword']  = $srch_keyword = ''; 
       }
       
       $where = "and 1";
       
      /* if(!empty($srch_from_date) && !empty($srch_to_date)  ){
        $where1 = " and q.leave_date between '" . $srch_from_date . "' and  '". $srch_to_date ."'";  
        $data['submit_flg'] = true; 
       }    */
        
        $data['submit_flg'] = true; 
        
        if($srch_department!= ''){
            $where .=" and (a.department_id = '". $srch_department."')"; 
        }
            
        if($srch_emp_category!= ''){
            $where .=" and (a.employee_category = '". $srch_emp_category."')";  
        }
        
        if($srch_keyword!= ''){
            $where .=" and (
                            a.employee_name like '%". $srch_keyword."%' or 
                            a.employee_code like  '%". $srch_keyword."%' or
                            a.mobile like '%". $srch_keyword."%' or
                            a.alt_mobile like '%". $srch_keyword."%'  
                            )";  
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
         
        
        if($data['submit_flg']) {
        
         
        $sql = "
                select
                a.*, 
                b.department_name as dept,
                c.designation_name as designation              
                from pyr_employee_info as a  
                left join pyr_department_info as b on b.department_id = a.department_id
                left join pyr_designation_info as c on c.designation_id = a.designation_id 
                where a.status= 'Active' 
                $where 
                order by a.employee_category , b.department_name , a.employee_code  
                 
                              
        ";
         
        $query = $this->db->query($sql);
        
        $data['emp_list'] = array();
       
        foreach ($query->result_array() as $row)
        {
            $data['emp_list'][$row['employee_category']][] = $row;     
        }
        
        }
        
         $this->load->view('page/reports/'. $data['s_url'],$data);
	} 



   
    
}
?>