<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
    // include_once 'C:/xampp/htdocs/web/shop/lib/database.php';
    // include_once 'C:/xampp/htdocs/web/shop/helpers/format.php';
?>
<?php
// Trong database đang có sẵn 1 tài khoản admin với user là ducadmin, pass là 123456
class category{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category($catName){
        $catName = $this->fm->validation($catName);

        $catName = mysqli_real_escape_string($this->db->link,$catName);

        if(empty($catName)){
            $alert = "<span class = 'error'>Category must be not empty</span>";
            return $alert;
        }else{
            $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span class = 'success'>Insert category successfully</span>";
                return $alert;
            }else{
                $alert = "<span class = 'error'>Insert category NOT success</span>";
                return $alert;
            }
        }
    }

    public function show_category(){
        $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_category_fe(){
        $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getCatById($id){
        $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_category($catName,$id){
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link,$catName);
        $id = mysqli_real_escape_string($this->db->link,$id);
        if(empty($catName)){
            $alert = "<span class = 'error'>Category must be not empty</span>";
            return $alert;
        }else{
            $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";
            $result = $this->db->update($query);
            if($result){
                $alert = "<span class = 'success'>Category updated successfully</span>";
                return $alert;
            }else{
                $alert = "<span class = 'error'>Category updated NOT success</span>";
                return $alert;
            }
        }
    }

    public function delete_category($id){
        $query = "DELETE FROM tbl_category WHERE catId = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert = "<span class = 'error'>Category deleted successfully</span>";
            return $alert;
        }else{
            $alert = "<span class = 'error'>Category deleted NOT success</span>";
            return $alert;
        }
    }

    //Lấy ra những sản phẩm mới nhất để đưa ra trang productbycat
    public function get_product_by_cat($id){
        $query = "SELECT * FROM tbl_product WHERE catId = '$id' ORDER BY catId DESC LIMIT 8";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_name_by_cat($id){
        $query = "SELECT tbl_product.*,tbl_category.catName,tbl_category.catId FROM tbl_product,tbl_category
        WHERE tbl_product.catId = tbl_category.catId AND  tbl_product.catId = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
}

?>