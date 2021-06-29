<?php 

class profile extends framework {

    public function __construct()
    {
      if(!$this->getSession('userId')){

        $this->redirect("accountController/loginForm");

      }
       $this->helper("link");
       $this->profileModel = $this->model("profileModel"); 
    }
    public function index(){
     $userId = ['userId'=>$this->getSession('userId')];
      $data = $this->profileModel->getData($userId);

      $this->view("profile", $data);

    }

    public function fruitForm(){
      $fruitData = [

        'name'           => '',
        'price'          => '',
        'quality'        => '',
        'nameError'      => '',
        'priceError'     => '',
        'qualityError'   => ''
 
       ];
      $this->view("addFruit",$fruitData);
    }

    public function fruitStore(){
      
      $fruitData = [

       'name'           => $this->input('name'),
       'price'          => $this->input('price'),
       'quality'        => $this->input('quality'),
       'nameError'      => '',
       'priceError'     => '',
       'qualityError'   => ''

      ];

      if(empty($fruitData['name'])){
        $fruitData['nameError'] = "Required";
      }
      if(empty($fruitData['price'])){
        $fruitData['priceError'] = "Required";
      }
      if(empty($fruitData['quality'])){
        $fruitData['qualityError'] = "Required";
      }

      if(empty($fruitData['nameError']) && empty($fruitData['priceError']) && empty($fruitData['qualityError'])){

        $data = ['name'=>$fruitData['name'],'price'=>$fruitData['price'], 'quality'=>$fruitData['quality'], 'userId'=>$this->getSESSION('userId')];
         if($this->profileModel->addFruit($data)){
                $this->setFlash("fruitAdded", "Fruit has been added successfuly");
                $this->redirect("user_profile");
         }


      } else {
        $this->view("addFruit", $fruitData);
      }

    }

    public function edit_fruit($id){
    
      $userId = $this->getSession('userId');
      $fruitEdit = $this->profileModel->edit_data($id, $userId);
      
      $data = [

        'data'    => $fruitEdit,
        'nameError' => '',
        'priceError' => '',
        'qualityError' => ''

      ];
      $this->view("edit_fruit", $data);

    }

    public function updateFruit(){

      $id = $this->input('hiddenId');
      $userId = $this->getSession('userId');
      $fruitEdit = $this->profileModel->edit_data($id, $userId);
      $fruitData = [

        'name'           => $this->input('name'),
        'price'          => $this->input('price'),
        'quality'        => $this->input('quality'),
        'data'           => $fruitEdit,
        'hiddenId'       => $this->input('hiddenId'),
        'nameError'      => '',
        'priceError'     => '',
        'qualityError'   => ''
        
 
       ];
 
       if(empty($fruitData['name'])){
         $fruitData['nameError'] = "Required";
       }
       if(empty($fruitData['price'])){
         $fruitData['priceError'] = "Required";
       }
       if(empty($fruitData['quality'])){
         $fruitData['qualityError'] = "Required";
       }

       if(empty($fruitData['nameError']) && empty($fruitData['priceError']) && empty($fruitData['qualityError'])){
       
        $updateData = ['name'=>$fruitData['name'], 'price'=>$fruitData['price'], 'quality'=>$fruitData['quality']];

        if($this->profileModel->updateFruit($updateData,['id'=>$fruitData['hiddenId'],'userId'=>$userId])){

          $this->setFlash('fruitUpdated', 'Fruit has been updated successfully');
          $this->redirect("user_profile");

        }

       } else {
        $this->view("edit_fruit", $fruitData);
       }

    }

    public function delete($id){

      $userId = $this->getSession('userId');
      if($this->profileModel->deleteFruit($id, $userId)){
        $this->setFlash('deleted', 'Fruit has been deleted successfully');
        $this->redirect('user_profile');
      }

    }



    public function logout(){

        $this->destroy();
        $this->redirect("accountController/loginForm");

    }

}


?>