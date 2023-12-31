<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
    include_once ($filepath.'/../lib/session.php');
    // include 'C:/xampp/htdocs/web/shop/lib/session.php';
    Session::checkLogin();
    // include 'C:/xampp/htdocs/web/shop/lib/database.php';
    // include 'C:/xampp/htdocs/web/shop/helpers/format.php';
?>
<?php
// Trong database đang có sẵn 1 tài khoản admin với user là ducadmin, pass là 123456
class adminlogin{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function login_admin($adminUser,$adminPass){
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);

        $adminUser = mysqli_real_escape_string($this->db->link,$adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link,$adminPass);

        if(empty($adminUser)||empty($adminPass)){
            $alert = "User and Password must be not empty";
            return $alert;
        }else{
            $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
            $result = $this->db->select($query);

            if($result != false){
                $value = $result->fetch_assoc();
                Session::set('adminLogin', true);
                Session::set('adminId',$value['adminId']);
                Session::set('adminUser',$value['adminUser']);
                Session::set('adminName',$value['adminName']);
                header('Location:index.php');
            }else{
                $alert = "User and Password not true";
                return $alert;
            }
        }
    }
}

?>