<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
    // include_once 'C:/xampp/htdocs/web/shop/lib/database.php';
    // include_once 'C:/xampp/htdocs/web/shop/helpers/format.php';
?>
<?php
// Trong database đang có sẵn 1 tài khoản admin với user là ducadmin, pass là 123456
class post{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category_post($catName,$catDesc,$catStatus){
        $catName = $this->fm->validation($catName);
        $catDesc = $this->fm->validation($catDesc);
        $catStatus = $this->fm->validation($catStatus);
        $catName = mysqli_real_escape_string($this->db->link,$catName);
        $catDesc = mysqli_real_escape_string($this->db->link,$catDesc);
        $catStatus = mysqli_real_escape_string($this->db->link,$catStatus);

        if(empty($catName) | empty($catDesc)){
            $alert = "<span class = 'error'>Category Post must be not empty</span>";
            return $alert;
        }else{
            $query = "INSERT INTO tbl_category_post(title,description,status) VALUES('$catName','$catDesc','$catStatus')";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span class = 'success'>Insert category_post successfully</span>";
                return $alert;
            }else{
                $alert = "<span class = 'error'>Insert category_post NOT success</span>";
                return $alert;
            }
        }
    }

    public function show_category_post(){
        $query = "SELECT * FROM tbl_category_post ORDER BY cate_post_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getCatById($id){
        $query = "SELECT * FROM tbl_category_post WHERE cate_post_id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_category_post($catName,$catDesc,$catStatus,$id){
        $catName = $this->fm->validation($catName);
        $catDesc = $this->fm->validation($catDesc);
        $catStatus = $this->fm->validation($catStatus);
        $catName = mysqli_real_escape_string($this->db->link,$catName);
        $catDesc = mysqli_real_escape_string($this->db->link,$catDesc);
        $catStatus = mysqli_real_escape_string($this->db->link,$catStatus);
        $id = mysqli_real_escape_string($this->db->link,$id);
        if(empty($catName) | empty($catDesc)){
            $alert = "<span class = 'error'>Category must be not empty</span>";
            return $alert;
        }else{
            $query = "UPDATE tbl_category_post SET title = '$catName',description = '$catDesc',status='$catStatus' WHERE cate_post_id = '$id'";
            $result = $this->db->update($query);
            if($result){
                $alert = "<span class = 'success'>Category Post updated successfully</span>";
                return $alert;
            }else{
                $alert = "<span class = 'error'>Category Post updated NOT success</span>";
                return $alert;
            }
        }
    }

    public function delete_category_post($id){
        $query = "DELETE FROM tbl_category_post WHERE cate_post_id = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert = "<span class = 'success'>Category Post deleted successfully</span>";
            return $alert;
        }else{
            $alert = "<span class = 'error'>Category Post deleted NOT success</span>";
            return $alert;
        }
    }


}

?>