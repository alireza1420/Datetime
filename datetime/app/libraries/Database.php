<?php 
/*
* PDO Database class
* create prepare statment
* Bind Values
* Return rows and results
*/

//create dataabase 



class Database{
    private $Host=DB_HOST;
    private $User=DB_USER;
    private $Pass=DB_PASS;
    private $Dbname=DB_NAME;


    private $Dbh;
    private $Stmt;
    private $Error;


    public function __construct()
    {
        $Dsn='mysql:host='.$this->Host.';dbname='.$this->Dbname;
        $Options=array(
        PDO::ATTR_PERSISTENT=>true,
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
  

        );

    

        //Create PDO instance
        try{
            $this->Dbh=new PDO($Dsn,$this->User,$this->Pass,$Options);
            $this->Dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
           
        }catch(PDOException $e){
            $this->error=$e->getMessage();
            echo $this->error;

        }
        
    }

    //prepare statment with query 

    public  function Query($sql)
    {
      $this->stmt=$this->Dbh->prepare($sql);
    }

    //Bind values
    public function Bind($Param,$Value,$Type=null){
        if(is_null($Type)){
            switch(true){
                case is_int($Value):
                    $type=PDO::PARAM_INT;
                    break;
                case is_bool($Value):
                    $type=PDO::PARAM_BOOL;
                    break;
                case is_null($Value):
                    $type=PDO::PARAM_NULL;    
                    break;
                    default:
                    $type=PDO::PARAM_STR;    
                  
            }
        }
        $this->stmt->bindValue($Param,$Value);
    }
  
        //Execute  the prepared statment

        public function Execute(){
           return $this->stmt->execute();
        }

        //Get results as array of objects

        public function ResultSet(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        //Get single record as object

        public function Single(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        //Get row count

        public function Rowcount(){
            return $this->stmt->Rowcount();
        }

} 



?>