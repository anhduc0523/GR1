<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>
<?php
// Trong database đang có sẵn 1 tài khoản admin với user là ducadmin, pass là 123456
class cart{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    //Đưa 1 sản phẩm mới vào giỏ hàng
    public function add_to_cart($quantity,$id){
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link,$quantity);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $sId = session_id();

        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select($query)->fetch_assoc();
        $image = $result['image'];
        $price = $result['price'];
        $productName = $result['productName'];
        //Kiểm tra xem sản phẩm thêm vào đã có trong cart chưa
        $query_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sid = '$sId'";
        $check_cart =  $this->db->select($query_cart); 
        if($check_cart){
            $msg = "Product has been already added";
            return $msg;
        }else{
            $query_insert = "INSERT INTO tbl_cart(productId,quantity,sId,image,price,productName) 
            VALUES('$id','$quantity','$sId','$image','$price','$productName')";
            $insert_cart = $this->db->insert($query_insert);
            if($insert_cart){
                header('Location:cart.php');
            }else{
                header('Location:404.php');
            }
        }
    }
    //Lấy ra thông tin sản phẩm đã có trong cart để đưa ra trang giao diện
    public function get_product_cart(){
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }
    //Update số lượng(quantity) của sản phẩm khi người dùng thay đổi giá trị số lượng trên trang giỏ hàng
    public function update_quantity_cart($quantity,$cartId){
        $quantity = mysqli_real_escape_string($this->db->link,$quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
        $result = $this->db->update($query);
        return $result;
        if($result){
            header('Location:cart.php');
        }else{
            $alert = "<span class = 'error'>Product quantity updated not success</span>";
            return $alert;
        }
    }

    //Xóa 1 sản phẩm khỏi giỏ hàng
    public function del_product_cart($cartid){
        $query = "DELETE FROM tbl_cart WHERE cartId = '$cartid'";
        $result = $this->db->delete($query);
        if($result){
            header('Location:cart.php');
            // echo "<script type='text/javascript'>window.location.href = 'cart.php'</script>";
        }else{
            $alert = "<span class = 'error'>Product deleted from cart NOT success</span>";
            return $alert;
        }
    }

    //Kiểm tra xem trong giỏ hàng có rỗng không
    public function check_cart(){
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function check_order($customer_id){
        $sId = session_id();
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }

    //Xóa thông tin giỏ hàng
    public function del_all_data(){
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertOrder($customer_id){
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $get_product = $this->db->select($query);
        if($get_product){
            while($result = $get_product->fetch_assoc()){
                $productId = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price'] * $quantity;
                $image = $result['image'];
                $query_order = "INSERT INTO tbl_order(productId,productName,quantity,price,image,customer_id) 
                VALUES('$productId','$productName','$quantity','$price','$image','$customer_id')";
                $insert_order = $this->db->insert($query_order);
            }
        }
    }

    public function get_amount_price($customer_id){

        $query = "SELECT price FROM tbl_order WHERE customer_id = '$customer_id'";
        $get_price = $this->db->select($query);
        return $get_price;
    }

    public function get_cart_ordered($customer_id){
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
        $get_price = $this->db->select($query);
        return $get_price;
    }

    
}

?>