<?php

    //The question that came to my mind is if we are aleary reading from the databse why should we try to create a newer database connection - cant we just use the same connection?
    //But yet again we are not intended to do a lot of this with this database we just want to do some simple things, so then we can use this connection an another thing all together
    //So that we do not interefere with the connection which we have once created

    class database
    {
        private $hostname = "localhost";
        private $db_name = "biddingsystem";
        private $username = "root";
        private $password = "";
        //Now the interesting thing about this connection is that when we want to work we will alway just refere to this connection and then we will be connected at once
        public function connect()
        {
            $this->conn = null;
            try
            {
                $this->conn = new PDO("mysql:host=". $this->hostname . "; dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                echo "Connection Error: " . $e->getMessage();
            }
            return $this->conn;
        }
    }

?>