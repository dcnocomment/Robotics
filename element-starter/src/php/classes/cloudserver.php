<?php
class Cloudserver{

    private $_db;
    public $app;
    function __construct($db){
    	$this->_db = $db;
        $this->app = "robotapp-";
    }

	public function check_instance(){
        if(!isset($_SESSION['uuid'])){
            return "";
        }
        $uuid = $_SESSION['uuid'];
        $res = shell_exec("cd api; sh check_instance.sh $uuid");
        return $res;
	}
	public function create_instance(){
        if(!isset($_SESSION['uuid'])){
            return "";
        }
        $uuid = $_SESSION['uuid'];
        return shell_exec("cd api; sh create_instance.sh $uuid");
	}
	public function delete_instance(){
        if(!isset($_SESSION['uuid'])){
            return "";
        }
        $uuid = $_SESSION['uuid'];
        return shell_exec("cd api; sh delete_instance.sh $uuid");
	}


}

?>
