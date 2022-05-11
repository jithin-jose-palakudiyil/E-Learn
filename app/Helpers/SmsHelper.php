<?php
 namespace App\Helpers;
 class SmsHelper
 {
     
     /**
     * send sms with in india using www.getlead.co.uk
     * param $to:string 
     * param $messages:string 
     * @return response
     */ 
    public static  function getlead_otp_sms($to,$otp)
    {   
       
      return true; 
      
           $curl ='https://app.getlead.co.uk/api/push-otp?';
           $data = [
                    'username'   => '917561020555',
                    'token'         => 'gl_1797a3b14fd270e86bcc', 
                    'sender'        => 'GTLEAD',
                    'to'            => $to,
                    'otp'           => $otp,
                    'purpose'       => 'registration', 
                    'company'       => 'Bharat Elearn',
                    'priority'      => 4
                ]; 
       
      
        $ch = curl_init($curl); 
        curl_setopt($ch, CURLOPT_POST, true); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        $response = curl_exec($ch); 
        curl_close($ch); 
        $sms = json_decode($response);  
        
        if(isset($sms->status) && $sms->status == 'success'): return true;  else:  return false;  endif;
          
   }
   
  
   
    /**
     * send sms with in india using www.getlead.co.uk
     * param $to:string 
     * param $messages:string 
     * @return response
     */ 
    public static  function getlead_sms($to,$message= null,$priority = null,$otp = null)
    {   
       if($priority == null):
           $priority =11;
       endif;
       $data =[];
       if($otp == null && $message != null):
            
            $curl ='https://app.getlead.co.uk/api/pushsms?';
            $data = [
                    'username'      => '917561020555',
                    'token'         => 'gl_1797a3b14fd270e86bcc', 
                    'sender'        => 'GTLEAD',
                    'to'            => $to,
                    'message'       => $message, 
                    'priority'      => $priority,
                    'message_type'  =>0
                ]; 
       else:
           $curl ='https://app.getlead.co.uk/api/push-otp?';
           $data = [
                    'username'   => '917561020555',
                    'token'         => 'gl_1797a3b14fd270e86bcc', 
                    'sender'        => 'GTLEAD',
                    'to'            => $to,
                    'otp'           => $otp,
                    'purpose'       => 'registration', 
                    'company'       => 'CPAS',
                    'priority'      => $priority
                ]; 
       endif;
      
        $ch = curl_init($curl); 
        curl_setopt($ch, CURLOPT_POST, true); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        $response = curl_exec($ch); 
        curl_close($ch); 
        $sms = json_decode($response); 
       
        if(isset($sms->status) && $sms->status == 'success'): return true;  else:  return false;  endif;
          
   }
   
  
       
    
  }