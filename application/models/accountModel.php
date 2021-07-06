<?php

class accountModel extends database {


    public function checkEmail($email){

        if($this->fetch("email","users",$email)){

            if($this->rowCount('users',$email) > 0 ){
                return false;
            } else {
                return true;
            }
        }
        else
        {
            return true;
        }

    }

    public function createAccount($data){
        if($this->insert("users",$data)){
            return true;
        }

    }

    public function userLogin($email, $password){
                
        $email = $this->realEscapeString($email['email']); 
        $password = $this->realEscapeString($password['password']); 
        
        if($this->fetchAll("users",$email)){
            
            if($this->rowCount("users",$email) > 0 ){

                $row = $this->fetch('*',"users",$email);
                $dbPassword = $row->password;
                $userId = $row->id;
                if(password_verify($password, $dbPassword)){

                    return ['status' => 'ok', 'data' => $userId];

                } else {
                    return ['status' => 'passwordNotMacthed'];
                }

            } else {
                return ['status' => 'emailNotFound'];
            }

        }
        else
        {
            return ['status' => 'emailNotExists'];
        }


    }

}


?>