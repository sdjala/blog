<?php

class Db
{
 
   protected function connect(){

            $conn = mysqli_connect("localhost","root","","blog_db") or die("Couldn't connect");
    
            return $conn;

    }
}
?>