<?php 
/* 
* App Core Classes
* Creates URL & Load Core Controller
* URL FORMAT -/controller/method/params
*/
class Core{
    protected $CurrentController ="Pages";
    protected $CurrentMethod ="index";
    protected $Params =[];

    public function __construct()
    {
         //print_r($this->GetURL()) ;
        $Url=$this->GetURL();
        //Look in controllers for the first value
        
        if(!empty($Url[0])&&file_exists('../app/controllers/'.ucwords($Url[0]).'.php')){
            //if the file exists , set a controller
            $this->CurrentController=ucwords($Url[0]);
            //unset 0 index
            unset($Url[0]);
           
        }
        //require the controller
        
        require_once("../app/controllers/".$this->CurrentController.".php");

        //instantiate the contoller class
        $this->CurrentController= new $this->CurrentController;

        //check for second part of url
        if(!empty($Url[1])&&isset($Url[1])){
            //check to see if the Method exists in the controller
            if(method_exists($this->CurrentController,$Url[1])){
                $this->CurrentMethod=$Url[1];
                unset($Url[1]);
            }
           // echo $this->CurrentMethod;
         
        }
        
      //  print_r(array_values($Url)); 
        //get Params
        $this->Params =$Url ? array_values($Url) : [];
         call_user_func([$this->CurrentController,$this->CurrentMethod],$this->Params);        
    }


    public function GetURL(){
        
         if(isset($_GET['url'])){
       
            $Url=rtrim($_GET['url'],'/');
            $Url=filter_var($Url,FILTER_SANITIZE_URL);     
            $Url=explode('/',$Url);
            return $Url;

        }
    
    }

}

?>