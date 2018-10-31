<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StaffModel extends CI_Model 
{

   /**
     * Model function to handle the staff login
     * @param  array $credentials
     * @return mixed[]  
  **/
   public function getStaffDuty($id)
    {
      $this->db->select('
                shifts.shift_name,
                staff_work_shift.id,
                staff_work_shift.date,
                staff_type.staff_type,
                shifts.shift_start_time,
                shifts.shift_end_time,
                staff.name'
              );
      $this->db->from('staff_work_shift');
      $this->db->where('staff_work_shift.staff_id', $id);
      $this->db->join('staff','staff.id=staff_work_shift.staff_id');
      $this->db->join('staff_type','staff.staff_type_id=staff_type.id');
      $this->db->join('shifts','staff_work_shift.shift_id=shifts.id');
      //$this->db->order_by('shifts.shift_start_time','ASC');
      $this->db->order_by('staff_work_shift.date','DESC');
      $query=$this->db->get();
       return $query->result();
    }
    public function getStaffDutySearch($credentials)
    {
      $this->db->select('
                shifts.shift_name,
                staff_work_shift.id,
                staff_work_shift.date,
                staff_type.staff_type,
                shifts.shift_start_time,
                shifts.shift_end_time,
                staff.name'
              );
      $this->db->from('staff_work_shift');
      $this->db->where('staff_work_shift.date >=', $credentials['from_date']);
      $this->db->where('staff_work_shift.date <=', $credentials['to_date']);
      $this->db->join('staff','staff.id=staff_work_shift.staff_id');
      $this->db->join('staff_type','staff.staff_type_id=staff_type.id');
      $this->db->join('shifts','staff_work_shift.shift_id=shifts.id');
      $this->db->order_by('staff_work_shift.date','dsc');
      //$this->db->order_by('shifts.shift_start_time','ASC');
      $query=$this->db->get();
       return $query->result();
    }
   public function getMedicineSchedule($credentials)
    {
      
      $this->db->select('
                medicine_schedule_history.id,
                medicine_schedule_history.medicine_date,
                medicine_schedule_history.staff_id,
                medicine_schedule_history.inmate_id,
                medicine_schedule_history.medicine_id,
                staff.name as staff_name,
                inmate.name,
                medicines.medicine_name,
                inmate_medicines.quantity,
                inmate_medicines.time
                '
              );
      $this->db->where('inmate_medicines.time >=', $credentials['time']);
      $this->db->where('medicine_schedule_history.staff_id', $credentials['id']);
      $this->db->where('medicine_schedule_history.medicine_date', $credentials['date']);
      $this->db->from('medicine_schedule_history');
      $this->db->join('staff','staff.id=medicine_schedule_history.staff_id');
      $this->db->join('medicines','medicines.id=medicine_schedule_history.medicine_id');
      $this->db->join('inmate','inmate.id=medicine_schedule_history.inmate_id');
      $this->db->join('inmate_medicines','inmate_medicines.id=medicine_schedule_history.inmate_medicine_id');
      
      //$this->db->order_by('medicine_schedule_history.medicine_date ASC');
      $this->db->order_by('inmate_medicines.time ASC');
      $query=$this->db->get();
      return $query->result();

    }
    
    public function getInmateDetails($credentials)
    {
       $this->db->select('*');
       $this->db->where('email',$credentials['email']);
        $this->db->from('inmate');
       $query = $this->db->get();
       return $query->result();
    }
    public function getInmateDetailsAll()
    {
      $this->db->select('*');
       //$this->db->where('email',$credentials['email']);
        $this->db->from('inmate');
       $query = $this->db->get();
       return $query->result();
    }
    /**
  * Model function to get the inmate dashboard
  */

    public function getMessage($credentials)
    {
      //var_dump($credentials);
      //  die;
      $this->db->select('
                message_table.id,
                message_table.status,
                message_table.to_id,
                message_table.subject,
                message_table.to_type,
                message_table.from_id,
                message_table.from_type,
                message_table.date_created,
                guardian.guardian_name,
                admin.fullname,
                staff.name,
                inmate.name,
              ');
      $this->db->from('message_table');
      $this->db->where('message_table.to_id' , $credentials['id']);
      $this->db->where('message_table.to_type' , $credentials['type']);
      $this->db->join('inmate','message_table.from_id=inmate.id','left');
      $this->db->join('staff','message_table.from_id=staff.id','left');
      $this->db->join('guardian','message_table.from_id=guardian.id','left');
      $this->db->join('admin','message_table.from_id=admin.id','left');
      $this->db->order_by('date_created','DSC');
      $query=$this->db->get();
      if(!empty($query->result()))
      {
              return $query->result();
          } 
          else
          {
              return false;
          }
    
   
    }
    public function getStaffList()
    {
      $this->db->select('staff.id,staff.email,staff.date_of_joining,staff.mobile,staff_type.staff_type,staff.name');
      $this->db->from('staff');
      $this->db->join('staff_type','staff_type.id=staff.staff_type_id');
      $query=$this->db->get();
      if(!empty($query->result()))
      {
              return $query->result();
          } 
          else
          {
              return false;
          }
    }

    public function getSearchStaffList($search)
    {
      $this->db->select('staff.id,staff.email,staff.date_of_joining,staff.mobile,staff_type.staff_type,staff.name');
      $this->db->from('staff');
      $this->db->join('staff_type','staff_type.id=staff.staff_type_id');
      $this->db->like('staff.name', $search, 'both');
      $this->db->or_like('staff_type.staff_type', $search, 'both');
      $this->db->or_like('staff.email', $search, 'both');
      $this->db->or_like('staff.id', $search, 'both');
      $this->db->or_like('staff.mobile', $search, 'both');
      $query=$this->db->get();
      if(!empty($query->result()))
      {
              return $query->result();
          } 
          else
          {
              return false;
          }
    }
   
public function createMessage($credentials)
    {
      if($this->db->insert('message_table',$credentials))
      {
        return true;
      } 
      else 
      {
        return false;
      }
    }

    public function getMessageCount($credentials)
    {
      //var_dump($credentials);
      //  die;
      $this->db->select('
                message_table.id,
                message_table.to_id,
                message_table.subject,
                message_table.to_type,
                message_table.from_id,
                message_table.from_type,
                message_table.date_created,
                guardian.guardian_name,
                staff.name,
                inmate.name,
              ');
      $this->db->from('message_table');
      $this->db->where('message_table.to_id' , $credentials['id']);
      $this->db->where('message_table.to_type' , $credentials['type']);
      $this->db->where('message_table.status' , '0');
      $this->db->join('inmate','message_table.from_id=inmate.id','left');
      $this->db->join('staff','message_table.from_id=staff.id','left');
      $this->db->join('guardian','message_table.from_id=guardian.id','left');
      $this->db->order_by('date_created','ASC');
      $query=$this->db->get();
      return $query->num_rows();
    }
    
    public function getMessageDetailsStatus($messageId)
    {
      $this->db->set('status','1');
      $this->db->where('id', $messageId);
      if($this->db->update('message_table'))
      {

      }
    }
    public function getMessageDetails($messageId)
    {
      //var_dump($credentials);
      //  die;
      $this->db->select('
                message_table.id,
                message_table.to_id,
                message_table.subject,
                message_table.to_type,
                message_table.from_id,
                message_table.from_type,
                message_table.message,
                message_table.date_created,
                guardian.guardian_name,
                admin.fullname,
                staff.name,
                inmate.name,
              ');
      $this->db->from('message_table');
      $this->db->where('message_table.id' , $messageId);
      $this->db->join('inmate','message_table.from_id=inmate.id','left');
      $this->db->join('staff','message_table.from_id=staff.id','left');
      $this->db->join('admin','message_table.from_id=admin.id','left');
      $this->db->join('guardian','message_table.from_id=guardian.id','left');
      $query=$this->db->get();
      return $query->result();
    }
   public function isStaffExist($credentials)
   {
      //var_dump($credentials['password']);
      //die;
        $this->db->select('*');
        $this->db->where('email', $credentials['email']);
        $this->db->where('password_hash' , $credentials['password']);
        $query=$this->db->get('staff');
        if($query->num_rows()==1){
          return true;
        }else{
          return false;
        }
    }
    /*Modal function to verofy email exist or not
    */
    public function notInStaff($message)
    {
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where('password_reset' , $message);
        $query=$this->db->get();
        if($query->num_rows()==0){
          return FALSE;
        }else{
          return TRUE;
        }
    }
    public function updatePasswordReset($credentials)
    {
      $this->db->set('password_reset',$credentials['message']);
      $this->db->where('email' , $credentials['email']);
      $this->db->update('staff');
      
    }
    public function alreadySendStaff($email)
    {
      $this->db->select('*');
      $this->db->from('staff');
      $this->db->where('email' , $email);
      $this->db->where('password_reset is NOT NULL' ,NULL,FALSE);
      $query=$this->db->get();
      if($query->num_rows()==0){
        return TRUE;
      }else{
        return FALSE;
      }
    }
    public function passwordResetMessage($email)
    {
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where('email' , $email);
        $query=$this->db->get();
        if($query->num_rows()==1){

          foreach ($query->result() as $row){
            $message=$row->password_reset;
          }
          return $message;
        }else{
          return FALSE;
        }
    }
  public function notEmailStaff($email)
    {
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where('email' , $email);
        $query=$this->db->get();
        if($query->num_rows()==1){
          return TRUE;
        }else{
          return FALSE;
        }
    }
    public function checkReset($credentials)
    {
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where('email' ,$credentials['email']);
        $this->db->where('password_reset' ,$credentials['message_new']);
        $query=$this->db->get();
        if($query->num_rows()==0){
          return FALSE;
        }else{
          return TRUE;
        }
    }
    public function staffChangePasswordLink($credentials)
    {
        $this->db->set('password_hash',$credentials['password']);
        $this->db->where('email', $credentials['email']);
        if($this->db->update('staff')){
          return TRUE;
        }else{
          return FALSE;
        }
    }
    
  /*Modal function to change password
  */
  public function staffChangePassword($credentials)
    {
        $this->db->set('password_hash',$credentials['password']);
        $this->db->where('id', $credentials['id']);
        if($this->db->update('staff')){
          return TRUE;
        }else
        {
          return FALSE;
        }
    }
  /**
  * Model function to get the name of the staff
  */
    public function getStaffDetails($credentials)
    {
      $this->db->where('email',$credentials['email']);
      $query = $this->db->get('staff')->result();
      return $query;
    }
   /**
  * Model function to handle
  */
    public function getStaffDashboardDetails($credentials)
    {
      $this->db->where('name',$credentials['name']);
      $query = $this->db->get('staff')->result();
      return $query;
    }
   /**
    * Model function to get the staff profile 
   */
    public function getStaffProfileDetails($credentials)
    {
      $this->db->select("*");
      $this->db->from('staff');
      $this->db->where('staff.id',$credentials['id']);
      $this->db->join('staff_type', 'staff.staff_type_id = staff_type.id');
      $query = $this->db->get()->result();
      foreach ($query as $row){
          $credentials2['name']=$row->name;
          $credentials2['mobile']=$row->mobile;
          $credentials2['email']=$row->email;
         
          $credentials2['permanent_address']=$row->permanent_address;
          $credentials2['present_address']=$row->present_address;
          $credentials2['gender']=$row->gender;
          $credentials2['date_of_joining']=$row->date_of_joining;
          $credentials2['date_of_birth']=$row->date_of_birth;
          $credentials2['staff_type']=$row->staff_type;

      }
      return $credentials2;
    }
  /**
  * Model function to edit the staff profile 
  */
  public function geteditProileDetails($credentials)
    {
      $this->db->select("*");
      $this->db->from('staff');
      $this->db->where('id',$credentials['id']);
      $query = $this->db->get()->result();
      foreach ($query as $row){
          $credentials2['staffid']=$row->id;
          $credentials2['name']=$row->name;
          $credentials2['mobile']=$row->mobile;
          $credentials2['email']=$row->email;
          $credentials2['permanent_address']=$row->permanent_address;
          $credentials2['present_address']=$row->present_address;
          $credentials2['gender']=$row->gender;
          $credentials2['date_of_joining']=$row->date_of_joining;
          $credentials2['date_of_birth']=$row->date_of_birth;
      }
      return $credentials2;
    }
    /*
     Model Function to handle profile photo
    */
    public function uploadUserPhoto($data)
  {
    if($this->db->insert('staff',$data))
    {
      return true;
    }else {
      return false;
    }

  }

  /**
  *Model Function to handle the Search 
  */
  public function getSearchMedicineList($search)
    {
      $this->db->select('*');
      $this->db->from('medicines');
      $this->db->like('medicine_name', $search, 'both');
      $this->db->or_like('id', $search, 'both');
      $this->db->or_like('medical_rep_name', $search, 'both');
      $this->db->or_like('available_medicine_stock_count', $search, 'both');
      $this->db->or_like('medical_rep_mobile', $search, 'both');
      $query=$this->db->get();
      if(!empty($query->result()))
      {
              return $query->result();
      }else{
              return false;
      }
    }
    public function getSearchGuardianList($search)
    {
      $this->db->select('
                guardian.id,
                guardian.email,
                guardian.inmate_id,
                guardian.mobile,
                inmate.name,
                guardian.guardian_name'
              );
      $this->db->from('guardian');
      $this->db->join('inmate','guardian.inmate_id=inmate.id');
      $this->db->or_like('guardian.id', $search, 'both');
      $this->db->or_like('guardian.inmate_id', $search, 'both');
      $this->db->or_like('inmate.name', $search, 'both');
      $this->db->or_like('inmate.name', $search, 'both');
      $this->db->or_like('guardian.guardian_name', $search, 'both');
      $query=$this->db->get();
      //var_dump($query->result());
      //die;
      if(!empty($query->result()))
      {
              return $query->result();
       }else{
              return false;
       }
    }
    public function getSearchInmateList($search)
    {
      $this->db->select('*');
      $this->db->from('inmate');
      $this->db->like('name', $search, 'both');
      $this->db->or_like('present_address', $search, 'both');
      $this->db->or_like('permanent_address', $search, 'both');
      $this->db->or_like('mobile', $search, 'both');
      $this->db->or_like('email', $search, 'both');
      $this->db->or_like('gender', $search, 'both');
      $query=$this->db->get();
      if(!empty($query->result()))
      {
              return $query->result();
          } 
          else
          {
              return false;
          }
    }
    /**
    * Model function to update the inmate 
    */  
  public function updateStaffProfileDetails($credentials)
   { 
     $this->db->set( $credentials);
     $this->db->where('email', $credentials['email']);
     if($this->db->update('staff',$credentials))
     {
         return true;
      }else{
        return false;
      }
    }
   /* Model function to list the inmate 
  */
  
    /**
    * Model function to get the  inmate profile 
   */
    public function getInmateProfileDetails($id)
    { 
      $this->db->select("*");
      $this->db->from('inmate');
      $this->db->where('id',$id);
      $query = $this->db->get();
      foreach ($query->result() as $row){
          $credentials2['id']=$row->id;
          $credentials2['name']=$row->name;
          $credentials2['mobile']=$row->mobile;
          $credentials2['email']=$row->email;
          $credentials2['permanent_address']=$row->permanent_address;
          $credentials2['present_address']=$row->present_address;
          $credentials2['gender']=$row->gender;
          $credentials2['date_of_joining']=$row->date_of_joining;
          $credentials2['date_of_birth']=$row->date_of_birth;
          $credentials2['emergency_contact_number']=$row->emergency_contact_number;
          $credentials2['emergency_contact_person']=$row->emergency_contact_person;

      }
      return $credentials2;
    }  

   /**
  * Model function to add the inmate by the staff
  */
  public function saveInmateRegistrationDetails($credentials)
    {
      if($this->db->insert('inmate',$credentials)){
        return true;
      }else{
        return false;
      }

    }
  /**
  * Model function to delete the inmate 
  */
  public function deleteInmateRegistrationDetails($id)
    {
      $this->db->where('id',$id);
      if($this->db->delete('inmate'))
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
   /**
  * Model function to edit the inmate 
  */
   public function getInmateEditDetails($id)
    {
      $this->db->select('inmate.*, medicines.medicine_name,inmate_medicines.*');
      $this->db->from('inmate_medicines');
      $this->db->join('medicines','inmate_medicines.medicine_id=medicines.id');
      $this->db->join('inmate','inmate_medicines.inmate_id=inmate.id');
      //$this->db->where('id',$id);
      $query = $this->db->get();
      foreach ($query->result() as $row){
          $credentials2['inmateid']=$row->id;
          $credentials2['name']=$row->name;
          $credentials2['mobile']=$row->mobile;
          $credentials2['email']=$row->email;
          $credentials2['permanent_address']=$row->permanent_address;
          $credentials2['present_address']=$row->present_address;
          $credentials2['gender']=$row->gender;
          $credentials2['date_of_joining']=$row->date_of_joining;
          $credentials2['date_of_birth']=$row->date_of_birth;
          $credentials2['emergency_contact_number']=$row->emergency_contact_number;
          $credentials2['emergency_contact_person']=$row->emergency_contact_person;
          $credentials2['payment_per_month']=$row->payment_per_month;
          $credentials2['time']=$row->time;
          $credentials2['quantity']=$row->quantity;
          $credentials2['medicine_name']=$row->medicine_name;
      }
      return $credentials2;
    }
   /**
  * Model function to update the inmate 
  */  
   public function updateInmateRegistrationDetails($credentials)
   { 
     $this->db->set( $credentials);
     $this->db->where('id', $credentials['id']);
     if($this->db->update('inmate',$credentials))
     {
         return true;
      }else{
        return false;
      }
     
   }
    /* Model function to list the guardian 
  */
  public function getGuardianDetails()
    {
      $this->db->select('guardian.*, inmate.name');
      $this->db->from('guardian');
      $this->db->join('inmate', 'guardian.inmate_id =inmate.id');
      $query = $this->db->get()->result();
        return $query;

    }
   /**
  * Model function to add the guardian by the staff
  */
  public function getGuardianInmateDetails()
    {

      $this->db->select('name ,id');
      $this->db->from('inmate');
      $query = $this->db->get()->result();
      return $query;
      
    }
  public function saveGuardianRegistrationDetails($credentials)
    {
      if($this->db->insert('guardian',$credentials)){
        return true;
      }else{
        return false;
      }

    }
    /**
  * Model function to edit the guardian 
  */
  public function getGuardianEditDetails($id)
    {
      $this->db->select("*");
      $this->db->from('guardian');
      $this->db->where('id',$id);
      $query = $this->db->get();
      foreach ($query->result() as $row){
          $credentials2['guardianid']=$row->id;
          $credentials2['name']=$row->guardian_name;
          $credentials2['mobile']=$row->mobile;
          $credentials2['email']=$row->email;
          $credentials2['permanent_address']=$row->permanent_address;
          $credentials2['present_address']=$row->present_address;
          $credentials2['gender']=$row->gender;
      }
      return $credentials2;
    }
  /**
  * Model function to update the inmate 
  */  
   public function updateGuardianRegistrationDetails($credentials)
   { 
     $this->db->set( $credentials);
     $this->db->where('id', $credentials['id']);
     if($this->db->update('guardian',$credentials))
     {
         return true;
      }else{
        return false;
      }
     
   }
   /**
  * Model function to delete the guardian 
  */
  public function deleteGuardianRegistrationDetails($id)
    {
      $this->db->where('id',$id);
      $this->db->delete('guardian');
    }

  /* Model function to list the guardian 
  */
  public function getMedicineDetails()
    {
      $this->db->select("*");
      $this->db->from('medicines');
      $query = $this->db->get()->result();
      //var_dump($query);die;
        return $query;

    }   
  /**
  * Model function to add the medicine by the staff
  */
  public function saveMedicineRegistrationDetails($credentials)
    {
      if($this->db->insert('medicines',$credentials)){
        return true;
      }else{
        return false;
      }

    }
  /**
  * Model function to edit the medicine 
  */
  public function getMedicineEditDetails($id)
    {
      $this->db->select("*");
      $this->db->from('medicines');
      $this->db->where('id',$id);
      $query = $this->db->get();
      foreach ($query->result() as $row){
          $credentials2['medicineid']=$row->id;
          $credentials2['medicine_name']=$row->medicine_name;
          $credentials2['available_stock']=$row->available_medicine_stock_count;
          $credentials2['medical_rep']=$row->medical_rep_name;
          $credentials2['rep_mobile']=$row->medical_rep_mobile;

      }
      return $credentials2;
    }
    /**
  * Model function to update the medicine
  */  
   public function updateMedicineRegistrationDetails($credentials)
   { 
     $this->db->set( $credentials);
     $this->db->where('id', $credentials['id']);
     if($this->db->update('medicines',$credentials))
     {
         return true;
      }else{
        return false;
      }
     
   }
    public function getGuardianList()
    {
      $this->db->select('
                guardian.id,
                guardian.email,
                guardian.inmate_id,
                guardian.mobile,
                inmate.name,
                guardian.guardian_name'
              );
      $this->db->from('guardian');
      $this->db->join('inmate','guardian.inmate_id=inmate.id');
      $query=$this->db->get();
      //var_dump($query->result());
      //die;
      if(!empty($query->result()))
      {
              return $query->result();
          } 
          else
          {
              return false;
          }
    }

    public function getAdminList()
    {
      $this->db->select('*');
      $this->db->from('admin');
      $query=$this->db->get();
      if(!empty($query->result()))
      {
              return $query->result();
          } 
          else
          {
              return false;
          }
    }
   public function getInmateList()
    {
      $this->db->select('*');
      $this->db->from('inmate');
      $query=$this->db->get();
      if(!empty($query->result()))
      {
              return $query->result();
          } 
          else
          {
              return false;
          }
    }
  /**
  * Model function to delete the medicines 
  */
  public function deleteMedicineRegistrationDetails($id)
    {
      $this->db->where('id',$id);
      $this->db->delete('medicines');
    }

}  
	