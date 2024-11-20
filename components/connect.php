<?php

   // Database credentials
   $db_host = 'bgimxmvo8kfsiwhyfzd2-mysql.services.clever-cloud.com';
   $db_name = 'bgimxmvo8kfsiwhyfzd2';
   $db_user_name = 'unbnyunl7vpnfg91';
   $db_user_pass = 'ZYmoyRHKXDwz1icKnexa';

   // Data Source Name (DSN) for PDO
   $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";

   try {
       // Create a new PDO connection
       $conn = new PDO($dsn, $db_user_name, $db_user_pass);
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
       echo "Database connection successful!";
   } catch (PDOException $e) {
       // Catch and display any connection errors
       echo "Connection failed: " . $e->getMessage();
   }

   // Function to generate a unique ID
   function create_unique_id(){
      $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
      $rand = array();
      $length = strlen($str) - 1;

      for($i = 0; $i < 20; $i++){
         $n = mt_rand(0, $length);
         $rand[] = $str[$n];
      }
      return implode($rand);
   }

?>
