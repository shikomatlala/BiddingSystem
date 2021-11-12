<?php

    class Insert
    {
        //DB Connection]
        private $conn;
        public function __constructor($bd)
        {
            $this->conn = $db;
        }
        //Now I need something that is going to help me capture this information the bst thign to use to capture this information is to prepare an sql satement
        public function InsertliveStock($sql)
        {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
    }



?>