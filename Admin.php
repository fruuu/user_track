<?php


class Admin {
    
    
    private $db;
    
     public function __construct() {
        
        $this->db = new db();
        $this->select_ips();
        $this->select_data();
    }
    
    private function select_data(){
        echo "<br><br><br><br><br>";
        echo "All logs";
        
        $query = "select ip, os, browser, user_agent, start_of_visit, duration from visits";
        $get = $this->db->select_data_admin($query);
        
        echo "<table width=1200px>";
        echo "<th> IP adress </th>";
        echo "<th> OS </th>";
        echo "<th> Browser </th>";
        echo "<th> User agent </th>";
        echo "<th> Start of visit </th>";
        echo "<th> Duration </th>";
        
        while($row = $get->fetch_row()){
            echo "<tr>";
            echo "<td>";
                echo $row[0];
            echo "</td>";
            echo "<td>";
                echo $row[1];
            echo "</td>";
            echo "<td>";
                echo $row[2];
            echo "</td>";
            echo "<td>";
                echo $row[3];
            echo "</td>";
            echo "<td>";
                echo $row[4];
            echo "</td>";
            echo "<td>";
                echo $row[5];
            echo "</td>";
            
            echo "</tr>";
        }       
        
        echo "</table>";
               
    }
    
    private function select_ips(){
        
        echo "Number of visits";
        
        $query = "select ip, num_of_visits from users_ip";
        $get = $this->db->select_data_admin($query);
        
        echo "<table width=300px>";
        echo "<th> IP adress </th>";
        echo "<th> Number of visits </th>";   
        
        while($row = $get->fetch_row()){
            echo "<tr>";
            echo "<td>";
                echo $row[0];
            echo "</td>";
            echo "<td>";
                echo $row[1];
            echo "</td>";
            
            echo "</tr>";
        }       
        
        echo "</table>";
    }
    
    
}
