<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InmateModel extends CI_Model 
{  
	/**
     * Model function to handle the inmate login
     * @param  array $credentials
     * @return mixed[]  
	**/
  public function getMedicineScheduleSearch($credentials)
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
                inmate_medicines.time
                '
              );
      //$this->db->where('inmate_medicines.time >=', $credentials['time']);
      $this->db->where('medicine_schedule_history.medicine_date >=', $credentials['from_date']);
      $this->db->where('medicine_schedule_history.medicine_date <=', $credentials['to_date']);
       $this->db->where('medicine_schedule_history.inmate_id', $credentials['id']);
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
     public function getMedicineScheduleWithoutTime($credentials)
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
                inmate_medicines.time
                '
              );
      //$this->db->where('inmate_medicines.time >=', $credentials['time']);
      $this->db->where('medicine_schedule_history.medicine_date ', $credentials['date']);
      
       $this->db->where('medicine_schedule_history.inmate_id', $credentials['id']);
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
   public function isInmateExist($credentials)
   {
   	    $this->db->select('*');
        $this->db->where('email', $credentials['email']);
        $this->db->where('password_hash' , $credentials['password']);
        $query=$this->db->get('inmate');
        if($query->num_rows()==1){
          return true;
        }else{
          return false;
        }
    }

  /**
  * Model function to get the name of the inmate
  */
  public function getInmateDetails($credentials)
    {
    	 $this->db->where('email',$credentials['email']);
    	 $query = $this->db->get('inmate')->result();
    	 return $query;
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
                staff.name,
                inmate.name,
              ');
      $this->db->from('message_table');
      $this->db->where('message_table.id' , $messageId);
      $this->db->join('inmate','message_table.from_id=inmate.id','left');
      $this->db->join('staff','message_table.from_id=staff.id','left');
      $this->db->join('guardian','message_table.from_id=guardian.id','left');
      $query=$this->db->get();
      return $query->result();
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
    public function medicineInmate($id)
    {
      $this->db->select('
                inmate_medicines.id,
                inmate_medicines.quantity,
                inmate_medicines.time,
                inmate_medicines.medicine_id,
                inmate_medicines.inmate_id,
                medicines.medicine_name,
                inmate.name,
                inmate_medicines.start_date
              ');
      $this->db->from('inmate_medicines');
      $this->db->where('inmate_medicines.inmate_id' , $id);
      $this->db->join('inmate','inmate_medicines.inmate_id=inmate.id','left');
      $this->db->join('medicines','inmate_medicines.medicine_id=medicines.id','left');
      $query=$this->db->get();
      return $query->result();

    }
    public function getMedicineSearch($search)
    {
      $this->db->select('*');
      $this->db->from('medicines');
      $this->db->like('medicine_name', $search, 'both');
      $query=$this->db->get();
      if($query->num_rows()==0)
      {
        return false;
              
          } 
          else
          {
              return $query->result();
          }

    }
    public function getMedicineSearchExist($search)
    {
      $this->db->select('*');
      $this->db->from('medicines');
      $this->db->like('medicine_name', $search, 'both');
      $query=$this->db->get();
      if($query->num_rows()==0)
      {
        return false;
              
          } 
          else
          {
              foreach ($query->result() as $row)
        {
              $id=$row->id;
        }
        return $id;
          }

    }
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
          } 
          else
          {
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
    public function getSearchInmateList($search)
    {
      $this->db->select('*');
      $this->db->from('inmate');
      $this->db->like('name', $search, 'both');
      $this->db->or_like('present_address', $search, 'both');
      $this->db->or_like('permanent_address', $search, 'both');
      $this->db->or_like('mobile', $search, 'both');
      $this->db->or_like('email', $search, 'both');
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
    public function listAllStaffType()
    {
      $this->db->select('*');
      $query=$this->db->get('staff_type');
      if(!empty($query->result()))
      {
              return $query->result();
          } 
          else
          {
              return false;
          }
    }

    public function registerSessionForAdmin($credentials)
    {
      $this->db->select('*');
      $this->db->where('id' , $credentials['id']);
      $query=$this->db->get('admin');
      foreach ($query->result() as $row)
      {
            $credentials2['id']=$row->id;
            $credentials2['name']=$row->fullname;
            $credentials2['email']=$row->email;
            $credentials2['type']="admin";
      }
      $this->session->set_userdata($credentials2);
      return $credentials2;
    }
    public function checkReset($credentials)
    {
      $this->db->select('*');
      $this->db->from('admin');
      $this->db->where('email' ,$credentials['email']);
      $this->db->where('password_reset' ,$credentials['message_new']);
      $query=$this->db->get();
      if($query->num_rows()==0)
      {
        return FALSE;
      }
      else
      {
        return TRUE;
      }
    }
    public function adminChangePasswordLink($credentials)
    {
      $this->db->set('password',$credentials['password']);
      $this->db->where('email', $credentials['email']);
      if($this->db->update('admin'))
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
    public function adminChangePassword($credentials)
    {
      $this->db->set('password',$credentials['password']);
      $this->db->where('id', $credentials['id']);
      if($this->db->update('admin'))
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
    public function updateStaffType($credentials)
    {
      $this->db->set('staff_type',$credentials['staff_type']);
      $this->db->where('id', $credentials['staff_type_id']);
      if($this->db->update('staff_type'))
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
    public function updateStaff($credentials)
    {
      $this->db->set($credentials);
      $this->db->where('id', $credentials['id']);
      if($this->db->update('staff'))
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
    public function createStaff($credentials)
    {
      if($this->db->insert('staff',$credentials))
      {
        return true;
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
    public function notInAdmin($message)
    {
      $this->db->select('*');
      $this->db->from('admin');
      $this->db->where('password_reset' , $message);
      $query=$this->db->get();
      if($query->num_rows()==0)
      {
        return FALSE;
      }
      else
      {
        return TRUE;
      }
    }
    public function updatePasswordReset($credentials)
    {
      $this->db->set('password_reset',$credentials['message']);
      $this->db->where('email' , $credentials['email']);
      $this->db->update('admin');
      
    }
    public function alreadySendAdmin($email)
    {
      $this->db->select('*');
      $this->db->from('admin');
      $this->db->where('email' , $email);
      $this->db->where('password_reset is NOT NULL' ,NULL,FALSE);
      $query=$this->db->get();
      if($query->num_rows()==0)
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
    public function passwordResetMessage($email)
    {
      $this->db->select('*');
      $this->db->from('admin');
      $this->db->where('email' , $email);
      $query=$this->db->get();
      if($query->num_rows()==1)
      {
        foreach ($query->result() as $row)
        {
          $message=$row->password_reset;
        }
        return $message;
      }
      else
      {
        return FALSE;
      }
    }
    public function notEmailAdmin($email)
    {
      $this->db->select('*');
      $this->db->from('admin');
      $this->db->where('email' , $email);
      $query=$this->db->get();
      if($query->num_rows()==1)
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
    public function editStaff($id)
    {
      $this->db->select('staff.id,
                staff.email,
                staff.date_of_joining,
                staff.mobile,
                staff_type.staff_type,
                staff.name,
                staff.staff_type_id,
                staff.gender,
                staff.date_of_birth,
                staff.permanent_address,
                staff.can_view_inmate_medicine_schedule,
                staff.present_address'
              );
      $this->db->from('staff');
      $this->db->join('staff_type','staff_type.id=staff.staff_type_id');
      $this->db->where('staff.id' , $id);
      $query=$this->db->get();
      foreach ($query->result() as $row)
      {
            $credentials2['staff_id']=$row->id;
            $credentials2['staff_name']=$row->name;
            $credentials2['staff_email']=$row->email;
            $credentials2['date_of_birth']=$row->date_of_birth;
            $credentials2['mobile']=$row->mobile;
            $credentials2['gender']=$row->gender;
            $credentials2['date_of_joining']=$row->date_of_joining;
            $credentials2['present_address']=$row->present_address;
            $credentials2['staff_type_id']=$row->staff_type_id;
            $credentials2['staff_type']=$row->staff_type;
            $credentials2['permanent_address']=$row->permanent_address;
            $credentials2['can_view_inmate']=$row->can_view_inmate_medicine_schedule;
      }
      return $credentials2;
    }
    public function editStaffType($id)
    {
      $this->db->select('*');
      $this->db->where('id' , $id);
      $query=$this->db->get('staff_type');
      foreach ($query->result() as $row)
      {
            $credentials2['staff_id']=$row->id;
            $credentials2['staff_type']=$row->staff_type;
      }
      return $credentials2;
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
    public function getShiftList()
    {
      $this->db->select('*');
      $this->db->from('shifts');
      $query=$this->db->get();
      return $query->result();

    }
    public function getMedicineList()
    {
      $this->db->select('*');
      $this->db->from('medicines');
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
    public function createShift($credentials)
    {
      if($this->db->insert('shifts',$credentials))
      {
        return true;
      } 
      else 
      {
        return false;
      }
    }
    public function createInmate($credentials)
    {
      if($this->db->insert('inmate',$credentials))
      {
        return true;
      } 
      else 
      {
        return false;
      }
    }
    public function deleteShift($id)
    {
      $this->db->where('id', $id);
      if($this->db->delete('shifts'))
      {
        return TRUE;
      } 
      else
      {
        return FALSE;
      }
    }
    public function deleteInmate($id)
    {
      $this->db->where('id', $id);
      if($this->db->delete('inmate'))
      {
        return TRUE;
      } 
      else
      {
        return FALSE;
      }
    }
    public function editInmate($id)
    {
      $this->db->select('*');
      $this->db->from('inmate');
      $this->db->where('id' , $id);
      $query=$this->db->get();
      foreach ($query->result() as $row)
      {
            $credentials2['id']=$row->id;
            $credentials2['name']=$row->name;
            $credentials2['email']=$row->email;
            $credentials2['payment_per_month']=$row->payment_per_month;
            $credentials2['date_of_birth']=$row->date_of_birth;
            $credentials2['date_of_joining']=$row->date_of_joining;
            $credentials2['emergency_contact_person']=$row->emergency_contact_person;
            $credentials2['emergency_contact_number']=$row->emergency_contact_number;
            $credentials2['mobile']=$row->mobile;
            $credentials2['gender']=$row->gender;
            $credentials2['date_of_joining']=$row->date_of_joining;
            $credentials2['present_address']=$row->present_address;
            $credentials2['permanent_address']=$row->permanent_address;
      }
      return $credentials2;
    }
    public function editShift($id)
    {
      $this->db->select('*');
      $this->db->from('shifts');
      $this->db->where('id' , $id);
      $query=$this->db->get();
      foreach ($query->result() as $row)
      {
            $credentials2['id']=$row->id;
            $credentials2['shift_name']=$row->shift_name;
            $credentials2['shift_start_time']=$row->shift_start_time;
            $credentials2['shift_end_time']=$row->shift_end_time;
      }
      return $credentials2;
    }
    public function updateShift($credentials)
    {
      $this->db->set($credentials);
      $this->db->where('id', $credentials['id']);
      if($this->db->update('shifts'))
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
    public function updateInmate($credentials)
    {
      $this->db->set($credentials);
      $this->db->where('id', $credentials['id']);
      if($this->db->update('inmate'))
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
    public function deleteMedicine($id)
    {
      $this->db->where('id', $id);
      if($this->db->delete('medicines'))
      {
        return TRUE;
      } 
      else
      {
        return FALSE;
      }
    }
    public function editMedicine($id)
    {
      $this->db->select('*');
      $this->db->where('id' , $id);
      $query=$this->db->get('medicines');
      foreach ($query->result() as $row)
      {
        $credentials2['medicine_id']=$row->id;
            $credentials2['medicine_name']=$row->medicine_name;
            $credentials2['available_medicine_stock_count']=$row->available_medicine_stock_count;
            $credentials2['medical_rep_name']=$row->medical_rep_name;
            $credentials2['medical_rep_mobile']=$row->medical_rep_mobile;
      }
      return $credentials2;
    }
    public function isAssigned($current_date)
    {
      $this->db->select('*');
      $this->db->where('date' , $current_date);
      $query=$this->db->get('duty_assigned');
      if($query->num_rows()==1)
      {
        
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
    public function inmateMedicines()
    {
      $this->db->select('*');
      $query=$this->db->get('inmate_medicines');
      return $query->result();

    }
    public function inmateMedicinesDate($date)
    {
      $this->db->select('medicine_schedule_history.id,inmate_medicines.time');
      $this->db->join('inmate_medicines','inmate_medicines.id=medicine_schedule_history.inmate_medicine_id');
      $this->db->where('medicine_date' , $date);
      $query=$this->db->get('medicine_schedule_history');
      return $query->result();

    }
    public function staffCareTaker($staff_type)
    {
      $this->db->select('id');
      $this->db->where('staff_type' , $staff_type);
      $query=$this->db->get('staff_type');
      foreach ($query->result() as $row)
      {
        return $row->id;
      }
      

    }
    public function getMinStaff($credentials)
    {
      $this->db->select('staff_work_shift.staff_id,staff_work_shift.id');
      $this->db->join('staff','staff.id=staff_work_shift.staff_id');
      $this->db->join('staff_type','staff_type.id=staff.staff_type_id');
      $this->db->join('shifts','shifts.id=staff_work_shift.shift_id');
      $this->db->where('staff_work_shift.date' , $credentials['date']);
      $this->db->where('staff_work_shift.date' , $credentials['date']);
      $this->db->where('staff_type.id' , $credentials['careTakerId']);
      $this->db->where('shifts.shift_start_time <=' , $credentials['time']);
      $this->db->where('shifts.shift_end_time >=' , $credentials['time']);
      $this->db->order_by('staff_work_shift.no_duty ASC');
      $query=$this->db->get('staff_work_shift');
      foreach ($query->result() as $row)
      {
        $data['staff_id']=$row->staff_id;
        $data['id']=$row->id;
        return $data;
      }
      

    }
    public function updateNoDuty($id)
    {
      $this->db->select('no_duty');
      $this->db->from('staff_work_shift');
      $this->db->where('id' , $id);
      $query=$this->db->get();
      foreach ($query->result() as $row)
      {
        $count=$row->no_duty;
      }
      $count=$count+1;
      $this->db->set('no_duty',$count);
      $this->db->where('id', $id);
      $this->db->update('staff_work_shift');

    }
    public function isDutyDateAssign($credentials)
    {
      $this->db->insert('duty_assigned',$credentials);
    }
    public function assignDuty($credentials)
    {
      $this->db->insert('staff_work_shift',$credentials);
    }
    public function medicineSchedule($credentials)
    {
      $this->db->insert('medicine_schedule_history',$credentials);
    }
    public function updateSchedule($credentials)
    {
      $this->db->set('staff_id',$credentials['staff_id']);
      $this->db->where('id',$credentials['id']);
      $this->db->update('medicine_schedule_history');
    }
    public function checkCurrentDate($date)
    {
      $this->db->set('status','1');
      $this->db->where('date', $date);
      $this->db->update('staff_work_shift');
      $this->db->set('status','-1');
      $this->db->where('date <', $date);
      $this->db->update('staff_work_shift');
      $this->db->set('status','0');
      $this->db->where('date >', $date);
      $this->db->update('staff_work_shift');
    }
    public function updateMedicine($credentials)
    {
      $this->db->set($credentials);
      $this->db->where('id', $credentials['id']);
      if($this->db->update('medicines'))
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
    public function getStaffDuty($date)
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
      $this->db->where('staff_work_shift.date', $date);
      $this->db->join('staff','staff.id=staff_work_shift.staff_id');
      $this->db->join('staff_type','staff.staff_type_id=staff_type.id');
      $this->db->join('shifts','staff_work_shift.shift_id=shifts.id');
      $this->db->order_by('shifts.shift_start_time','ASC');
      $query=$this->db->get();
       return $query->result();
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
                inmate_medicines.time
                '
              );
      $this->db->where('inmate_medicines.time >=', $credentials['time']);
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
    public function createGuardian($credentials)
    {
      if($this->db->insert('guardian',$credentials))
      {
        return true;
      } 
      else 
      {
        return false;
      }
    }
    public function deleteGuardian($id)
    {
      $this->db->where('id', $id);
      if($this->db->delete('guardian'))
      {
        return TRUE;
      } 
      else
      {
        return FALSE;
      }
    }
    public function updateGuardian($credentials)
    {
      $this->db->set($credentials);
      $this->db->where('id', $credentials['id']);
      if($this->db->update('guardian'))
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
    public function adminPasswordResetNull($credentials)
    {
       $this->db->set('password_reset', 'NULL', false);
        $this->db->where('email', $credentials['email']);
        $this->db->update('admin');
    }
    public function isValidReset($credentials)
    {
      $this->db->select('*');
      $this->db->from('admin');
      $this->db->where('email' , $credentials['email']);
      $this->db->where('password_reset' , $credentials['reset']);
      $query=$this->db->get();
      if($query->num_rows()==0)
      {
        return FALSE;
      }
      else
      {
        return TRUE;
      }
    }
    public function editGuardian($id)
    {
      $this->db->select('
                guardian.id,
                guardian.email,
                guardian.inmate_id,
                guardian.mobile,
                guardian.gender,
                guardian.date_of_birth,
                guardian.permanent_address,
                guardian.present_address,
                inmate.name,
                inmate.date_of_joining,
                guardian.guardian_name'
              );
      $this->db->from('guardian');
      $this->db->join('inmate','guardian.inmate_id=inmate.id');
      $this->db->where('guardian.id' , $id);
      $query=$this->db->get();
      foreach ($query->result() as $row)
      {
            $credentials2['id']=$row->id;
            $credentials2['guardian_name']=$row->guardian_name;
            $credentials2['email']=$row->email;
            $credentials2['date_of_birth']=$row->date_of_birth;
            $credentials2['date_of_joining']=$row->date_of_joining;
            $credentials2['mobile']=$row->mobile;
            $credentials2['gender']=$row->gender;
            $credentials2['present_address']=$row->present_address;
            $credentials2['inmate_id']=$row->inmate_id;
            $credentials2['permanent_address']=$row->permanent_address;
      }
      return $credentials2;
    }
    public function getInmateDashboardDetails($credentials)
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
                inmate_medicines.time
                '
              );
     $this->db->where('inmate_medicines.time >=', $credentials['time']);
      $this->db->where('medicine_schedule_history.inmate_id', $credentials['id']);
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
  /**
    * Model function to get the  inmate profile 
   */
    public function getInmateProfileDetails($credentials)
    {
      $this->db->select("*");
      $this->db->from('inmate');
      $this->db->where('id',$credentials['id']);
      $query = $this->db->get()->result();
      foreach ($query as $row){
          $credentials2['name']=$row->name;
          $credentials2['mobile']=$row->mobile;
          $credentials2['email']=$row->email;
          $credentials2['permanent_address']=$row->permanent_address;
          $credentials2['present_address']=$row->present_address;
          $credentials2['gender']=$row->gender;
          $credentials2['date_of_joining']=$row->date_of_joining;
          $credentials2['payment_per_month']=$row->payment_per_month;
          $credentials2['date_of_birth']=$row->date_of_birth;
          $credentials2['emergency_contact_number']=$row->emergency_contact_number;
          $credentials2['emergency_contact_person']=$row->emergency_contact_person;

      }
      return $credentials2;
    }
    /**
  * Model function to edit the staff profile 
  */
  public function editProileDetails($credentials)
    {
      $this->db->select("*");
      $this->db->from('inmate');
      $this->db->where('id',$credentials['id']);
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
      }
      return $credentials2;
    }
    /**
    * Model function to update the inmate 
    */  
  public function updateInmateProfileDetails($credentials)
   { 
     $this->db->set( $credentials);
     $this->db->where('email', $credentials['email']);
     if($this->db->update('inmate',$credentials))
     {
         return true;
      }else{
        return false;
      }
    }

}