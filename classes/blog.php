<?php
    $filepath = realpath(dirname(__FILE__));
    // include_once 'C:/xampp/htdocs/web/shop/lib/database.php';
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>
<?php
// Trong database đang có sẵn 1 tài khoản admin với user là ducadmin, pass là 123456
class blog{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_product($data,$files){
        $title = mysqli_real_escape_string($this->db->link,$data['title']);
        $category = mysqli_real_escape_string($this->db->link,$data['category_post']);
        $desc = mysqli_real_escape_string($this->db->link,$data['desc']);
        $content = mysqli_real_escape_string($this->db->link,$data['content']);

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

        if($title=="" || $category=="" || $desc=="" || $content=="" || $type=="" || $file_name==""){
            $alert = "<span class = 'error'>Fields must be not empty</span>";
            return $alert;
        }else{
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "INSERT INTO tbl_blog(title,description,content,category_post,image,status) 
            VALUES('$title','$desc','$content','$category','$unique_image','$type')";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span class = 'success'>Insert blog successfully</span>";
                return $alert;
            }else{
                $alert = "<span class = 'error'>Insert blog NOT success</span>";
                return $alert;
            }
        }
    }


    public function show_blog(){
        $query = "SELECT tbl_blog.*, tbl_category_post.title 
        FROM tbl_blog INNER JOIN tbl_category_post ON tbl_blog.category_post = tbl_category_post.cate_post_id  
        ORDER BY tbl_blog.id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getBlogById($id){
        $query = "SELECT * FROM tbl_blog WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_blog($data,$files,$id){
        $title = mysqli_real_escape_string($this->db->link,$data['title']);
        $category = mysqli_real_escape_string($this->db->link,$data['category_post']);
        $desc = mysqli_real_escape_string($this->db->link,$data['desc']);
        $content = mysqli_real_escape_string($this->db->link,$data['content']);

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

        if($title=="" || $category=="" || $desc=="" || $content=="" || $type==""){
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
                $query = "UPDATE tbl_blog SET 
                title = '$title' ,
                description = '$desc' ,
                status = '$type' ,
                category_post = '$category' ,
                content = '$content' ,
                image = '$unique_image' 
                WHERE id = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class = 'success'>Blog updated successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class = 'error'>Blog updated NOT success</span>";
                    return $alert;
                }
            }else{
                //Nếu người dùng không chọn update ảnh mới
                $query = "UPDATE tbl_blog SET 
                title = '$title' ,
                description = '$desc' ,
                status = '$type' ,
                category_post = '$category' ,
                content = '$content'
                WHERE id = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class = 'success'>Blog updated successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class = 'error'>Blog updated NOT success</span>";
                    return $alert;
                }
            }
        }
    }

    public function delete_blog($id){
        $query = "DELETE FROM tbl_blog WHERE id = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert = "<span class = 'success'>Blog deleted successfully</span>";
            return $alert;
        }else{
            $alert = "<span class = 'error'>Blog deleted NOT success</span>";
            return $alert;
        }
    }   
}

?>