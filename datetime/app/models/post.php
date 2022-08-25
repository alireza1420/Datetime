<?php 

    class Post extends Database{
        private $Db;

        public function __construct()
        {
            $this->Db=new Database;
        }

        public function GetPosts(){
            $this->Db->Query("SELECT * FROM posts");
            return $this->Db->ResultSet();
        }

    }

?>