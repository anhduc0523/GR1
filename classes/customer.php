<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>
<?php
// Trong database đang có sẵn 1 tài khoản admin với user là ducadmin, pass là 123456
class customer{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_binhluan(){
        $product_id = $_POST['productId_binhluan'];
        $tenbinhluan = $_POST['tenNguoiBinhLuan'];
        $binhluan = $_POST['binhluan'];
        if($tenbinhluan=="" || $binhluan=="" ){
            $alert = "<span class = 'error'>Fields must be not empty</span>";
            return $alert;
        }else{
             $query = "INSERT INTO tbl_binhluan(tenbinhluan,binhluan,product_id) 
            VALUES('$tenbinhluan','$binhluan','$product_id')";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span class = 'success'>Create commnet successfully</span>";                    
                return $alert;
            }else{
                $alert = "<span class = 'error'>Create comment NOT success</span>";
                return $alert;
            }
        }
    }
    public function insert_customer($data){
        $name = mysqli_real_escape_string($this->db->link,$data['name']);
        $city = mysqli_real_escape_string($this->db->link,$data['city']);
        $zipcode = mysqli_real_escape_string($this->db->link,$data['zipcode']);
        $email = mysqli_real_escape_string($this->db->link,$data['email']);
        $address = mysqli_real_escape_string($this->db->link,$data['address']);
        $country = mysqli_real_escape_string($this->db->link,$data['country']);
        $phone = mysqli_real_escape_string($this->db->link,$data['phone']);
        $password = mysqli_real_escape_string($this->db->link,md5($data['password']));

        if($name=="" || $city=="" || $email==""|| $zipcode=="" || $address=="" || $country=="" || $phone=="" || $password==""){
            $alert = "<span class = 'error'>Fields must be not empty</span>";
            return $alert;
        }else{
            $check_email = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
            $result_check = $this->db->select($check_email);
            if($result_check){
                $alert = "<span class = 'error'>Email is already exists</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_customer(name,city,zipcode,email,address,country,phone,password) 
                VALUES('$name','$city','$zipcode','$email','$address','$country','$phone','$password')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class = 'success'>Create customer successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class = 'error'>Create customer NOT success</span>";
                    return $alert;
                }
            }
        }
    }

    public function login_customer($data){
        $email = mysqli_real_escape_string($this->db->link,$data['email']);
        $password = mysqli_real_escape_string($this->db->link,md5($data['password']));
        if($email==""|| $password==""){
            $alert = "<span class = 'error'>Fields must be not empty</span>";
            return $alert;
        }else{
            $check_login = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
            $result_check = $this->db->select($check_login);
            if($result_check != false){
                $value = $result_check->fetch_assoc();
                Session::set('customer_login',true);
                Session::set('customer_id',$value['id']);
                Session::set('customer_name',$value['name']);
                header('Location:order.php');
            }else{
                $alert = "<span class = 'error'>Email or Password is wrong</span>";
                return $alert;
            }
        }
    }

    public function show_customer($id){
        $query = "SELECT * FROM tbl_customer WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_customer($data,$id){
        $name = mysqli_real_escape_string($this->db->link,$data['name']);
        $zipcode = mysqli_real_escape_string($this->db->link,$data['zipcode']);
        $email = mysqli_real_escape_string($this->db->link,$data['email']);
        $address = mysqli_real_escape_string($this->db->link,$data['address']);
        $phone = mysqli_real_escape_string($this->db->link,$data['phone']);
         if($name=="" || $email=="" || $address=="" || $phone=="" || $zipcode==""){
            $alert = "<span class = 'error'>Fields must be not empty</span>";
            return $alert;
        }else{
            
            $query = "UPDATE tbl_customer SET name='$name',zipcode='$zipcode',email='$email',
                address='$address',phone='$phone' WHERE id = '$id'";
            $result = $this->db->update($query);
            if($result){
                $alert = "<span class = 'success'>Update customer successfully</span>";
                return $alert;
            }else{
                $alert = "<span class = 'error'>Update customer NOT success</span>";
                return $alert;
            }
            
        }
    }
}
?>