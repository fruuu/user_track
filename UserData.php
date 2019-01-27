<?php


class UserData {
    
    private $os;
    private $browser;
    private $ip;
    private $user_agent;
    private $start_of_visit;
    private $duration;
    
    private $db;
    
    private $os_data= array(   'Windows 10 (Windows NT 10.0)' => 'windows nt 10.0',
                    'Windows 8.1 (Windows NT 6.3)' => 'windows nt 6.3',
                    'Windows 8 (Windows NT 6.2)' => 'windows nt 6.2',
                    'Windows 7 (Windows NT 6.1)' => 'windows nt 6.1',
                    'Windows Vista (Windows NT 6.0)' => 'windows nt 6.0',
                    'Windows Server 2003 (Windows NT 5.2)' => 'windows nt 5.2',
                    'Windows XP (Windows NT 5.1)' => 'windows nt 5.1',
                    'Windows 2000 sp1 (Windows NT 5.01)' => 'windows nt 5.01',
                    'Windows 2000 (Windows NT 5.0)' => 'windows nt 5.0',
                    'Windows NT 4.0' => 'windows nt 4.0',
                    'Windows Me  (Windows 9x 4.9)' => 'win 9x 4.9',
                    'Windows 98' => 'windows 98',
                    'Windows 95' => 'windows 95',
                    'Windows CE' => 'windows ce',
                    'Windows (version unknown)' => 'windows',
                    'Mac OS X Beta (Kodiak)' => 'Mac OS X beta',
                    'Mac OS X Cheetah' => 'Mac OS X 10.0',
                    'Mac OS X Puma' => 'Mac OS X 10.1',
                    'Mac OS X Jaguar' => 'Mac OS X 10.2',
                    'Mac OS X Panther' => 'Mac OS X 10.3',
                    'Mac OS X Tiger' => 'Mac OS X 10.4',
                    'Mac OS X Leopard' => 'Mac OS X 10.5',
                    'Mac OS X Snow Leopard' => 'Mac OS X 10.6',
                    'Mac OS X Lion' => 'Mac OS X 10.7',
                    'Mac OS X Mountain Lion' => 'Mac OS X 10.8',
                    'Mac OS X Mavericks' => 'Mac OS X 10.9',
                    'Mac OS X Yosemite' => 'Mac OS X 10.10',
                    'Mac OS X El Capitan' => 'Mac OS X 10.11',
                    'macOS Sierra' => 'Mac OS X 10.12',
                    'Mac OS X (version unknown)' => 'Mac OS X',
                    'Mac OS (classic)' => '(mac_powerpc)|(macintosh)',
                    'OpenBSD' => 'openbsd',
                    'SunOS' => 'sunos',
                    'Ubuntu' => 'ubuntu',
                    'Linux (or Linux based)' => '(linux)|(x11)',
                    'QNX' => 'QNX',
                    'BeOS' => 'beos',
                    'OS2' => 'os/2',
                    'iPhone' => '/iphone/i',
                    'iPod' => '/ipod/i',
                    'iPad' => '/ipad/i',
                    'Android' => '/android/i',
                    'BlackBerry' => '/blackberry/i');
    private $browser_data = array ('Internet Explorer' => '/msie/i',
                        'Firefox' => '/firefox/i',
                        'Chrome' => '/Chrome/i',
                        'Safari' => '/safari/i',
                        'Opera' => '/opera/i',
                        'Netscape' => '/netscape/i',
                        'Maxthon' => '/maxthon/i',
                        'Konqueror' => '/konqueror/i',
                        'Handheld Browser' => '/mobile/i');
    
    public function __construct() {
        
        $this->db = new db();
        $this->set_os();
        $this->set_browser();
        $this->set_ip();
        $this->set_user_agent();
        $this->set_start_of_visit();
        
        $this->insert_data();
        
    }
    
    private function set_os(){
        
        foreach($this->os_data as $k => $v){
            if(strpos($_SERVER['HTTP_USER_AGENT'], $k)){
                $this->os = $k;
            break;
            }
        }
    }
    
    private function set_browser(){
        
        foreach($this->browser_data as $k => $v){
            if(strpos($_SERVER['HTTP_USER_AGENT'], $k)){
                $this->browser = $k;
            break;
            }
        }
        
    }
    
    private function set_ip(){
        $this->ip = $_SERVER["REMOTE_ADDR"];
    }
    
    
    
    private function set_user_agent(){
        $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
    }
    
    private function set_start_of_visit(){
        $this->start_of_visit = date('d/m/Y h:i:s a', time());
    }
    
    private function insert_data(){

        $query = "select ip from visits where ip='$this->ip'";
        
        if(!$this->db->select($query)){        
             $ins = "insert users_ip (ip, num_of_visits) values ('$this->ip', '1');";  
             $this->db->insert($ins);
             
        }
            
        $insert = "insert into visits (ip, os, browser, user_agent, start_of_visit) values ('$this->ip', '$this->os', '$this->browser', '$this->user_agent', '$this->start_of_visit');";
        $this->db->insert($insert); 
        $update = "update users_ip set num_of_visits=num_of_visits+1 where ip='$this->ip';";  
        $this->db->insert($update); 
    }
 
}
