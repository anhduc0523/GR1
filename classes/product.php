<?php
    $filepath = realpath(dirname(__FILE__));
    // include_once 'C:/xampp/htdocs/web/shop/lib/database.php';
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>
<?php
// Trong database đang có sẵn 1 tài khoản admin với user là ducadmin, pass là 123456
class product{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_product($data,$files){
        $productName = mysqli_real_escape_string($this->db->link,$data['productName']);
        $category = mysqli_real_escape_string($this->db->link,$data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link,$data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link,$data['price']);
        $type = mysqli_real_escape_string($this->db->link,$data['type']);
        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode(".", $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if($productName=="" || $category=="" || $product_desc=="" || $price=="" || $type=="" || $file_name==""){
            $alert = "<span class = 'error'>Fields must be not empty</span>";
            return $alert;
        }else{
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "INSERT INTO tbl_product(productName,catId,product_desc,price,type,image) VALUES('$productName',
            '$category','$product_desc','$price','$type','$unique_image')";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span class = 'success'>Insert product successfully</span>";
                return $alert;
            }else{
                $alert = "<span class = 'error'>Insert product NOT success</span>";
                return $alert;
            }
        }
    }

    public function insert_slider($data,$files){
        $sliderName = mysqli_real_escape_string($this->db->link,$data['sliderName']);
        $type = mysqli_real_escape_string($this->db->link,$data['type']);

        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode(".", $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if($sliderName==""|| $type==""){
            $alert = "<span class = 'error'>Fields must be not empty</span>";
            return $alert;
        }else{
            if(!empty($file_name)){
                //Nếu người dùng chọn ảnh
                if($file_size > 1024000){
                    $alert = "<span class = 'error'>Image size should be less than 1000MB</span>";
                    return $alert;
                }elseif(in_array($file_ext, $permited) == false){
                    $alert = "<span class = 'error'> You can upload only:-".implode(',', $permited)."</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "INSERT INTO tbl_slider(sliderName,type,sliderImage) VALUES('$sliderName',
                '$type','$unique_image')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class = 'success'>Slider insert successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class = 'error'>Slider insert NOT success</span>";
                    return $alert;
                }
            }
        }
    }

    public function show_product(){
        $query = "SELECT tbl_product.*, tbl_category.catName 
        FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId  
        ORDER BY tbl_product.productId DESC";
        // $query = "SELECT * FROM tbl_product ORDER BY productId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getProductById($id){
        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data,$files,$id){
        $productName = mysqli_real_escape_string($this->db->link,$data['productName']);
        $category = mysqli_real_escape_string($this->db->link,$data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link,$data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link,$data['price']);
        $type = mysqli_real_escape_string($this->db->link,$data['type']);
        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode(".", $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if($productName=="" || $category=="" || $product_desc=="" || $price=="" || $type==""){
            $alert = "<span class = 'error'>Fields must be not empty</span>";
            return $alert;
        }else{
            if(!empty($file_name)){
                //Nếu người dùng chọn ảnh
                if($file_size > 1024000){
                    $alert = "<span class = 'error'>Image size should be less than 1000MB</span>";
                    return $alert;
                }elseif(in_array($file_ext, $permited) == false){
                    $alert = "<span class = 'error'> You can upload only:-".implode(',', $permited)."</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "UPDATE tbl_product SET 
                productName = '$productName' ,
                catId = '$category' ,
                type = '$type' ,
                price = '$price' ,
                image = '$unique_image' ,
                product_desc = '$product_desc' 
                WHERE productId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class = 'success'>Product updated successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class = 'error'>Product updated NOT success</span>";
                    return $alert;
                }
            }else{
                //Nếu người dùng không chọn update ảnh mới
                $query = "UPDATE tbl_product SET 
                productName = '$productName' ,
                catId = '$category' ,
                type = '$type' ,
                price = '$price' ,
                product_desc = '$product_desc' 
                WHERE productId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class = 'success'>Product updated successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class = 'error'>Product updated NOT success</span>";
                    return $alert;
                }
            }
        }
    }

    public function delete_product($id){
        $query = "DELETE FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert = "<span class = 'success'>Product deleted successfully</span>";
            return $alert;
        }else{
            $alert = "<span class = 'error'>Product deleted NOT success</span>";
            return $alert;
        }
    }
    //END BACKEND ABOUT PRODUCT


    //START FRONT END CODE TO SHOW PRODUCT

    //Lấy danh sách sản phẩm nổi bật
    public function getproduct_Featured(){
        $query = "SELECT * FROM tbl_product WHERE type = '0' ORDER BY productId asc LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }

    //Lấy 4 sản phẩm mới nhất
    public function getproduct_new(){
        $sp_tung_trang = 4;
        if(!isset($_GET['trang'])){
            $trang = 1;
        }else{
            $trang = $_GET['trang'];
        }
        $tung_trang = ($trang - 1 )*$sp_tung_trang;
        $query = "SELECT * FROM tbl_product ORDER BY productId desc LIMIT $tung_trang,$sp_tung_trang";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_all_product(){
        $query = "SELECT * FROM tbl_product";
        $result = $this->db->select($query);
        return $result;
    }

    //Lấy thông tin sản phẩm theo ID
    public function getproduct_details($id){
        $query = "SELECT tbl_product.*, tbl_category.catName 
        FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId  
        WHERE tbl_product.productId = '$id'";
        // $query = "SELECT * FROM tbl_product ORDER BY productId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    //Lấy sản phẩm CD/DVD mới nhất
    public function getLatestCD(){
        $query = "SELECT * FROM tbl_product WHERE catId = '10' ORDER BY productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    
    public function getLatestSale(){
        $query = "SELECT * FROM tbl_product WHERE catId = '15' ORDER BY productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    
    public function getLatestPreOrder(){
        $query = "SELECT * FROM tbl_product WHERE catId = '9' ORDER BY productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    } 

    public function getLatestSingle(){
        $query = "SELECT * FROM tbl_product WHERE catId = '13' ORDER BY productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    } 

    public function search_product($tukhoa){
        $tukhoa = $this->fm->validation($tukhoa);
        $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%'";
        $result = $this->db->select($query);
        return $result;
    }
}

?>