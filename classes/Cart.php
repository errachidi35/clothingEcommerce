<?php
/**
 * Cart Class
 * Created by PhpStorm.
 * User: Tushar Khan
 * Date: 9/12/2017
 * Time: 1:56 AM
 */
?>
<?php
$filePath = realpath(dirname(__FILE__));
include_once $filePath.'/../lib/Database.php';
include_once $filePath.'/../helpers/Formate.php';

    class Cart
    {
        private $db;
        private $fm;

        /**
         * Cart constructor.
         */
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Formate();
        }

        /**
         * @param $quantity
         * @param $id
         */
        public function addToCart($size, $quantity, $id)
        {
            $userId = Session::get("userId");
            
            
            $result = $this->db->select("SELECT * FROM ecom_product WHERE proid = '$id' ");
            $product = $result->fetch_assoc();
            $proName = $product['proname'];
            $price   = $product['price'];
            $image   = $product['image'];

            $check = $this->db->select("SELECT * FROM ecom_cart WHERE proid = '$id' AND sid = '$userId' AND size ='$size' ");

            if ($check)
            {
                echo "<div class='alert alert-danger alert-dismissable'>
                          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                          <strong>Warning !</strong> Product Already Added in the same size.
                      </div>";
            }
            else
            {
                $insert = $this->db->insert("INSERT INTO ecom_cart(sid, proid, proname, price,size, quantity, image) VALUES ('$userId', '$id','$proName','$price','$size','$quantity','$image')");

                if ($insert)
                {
                    echo "<script>window.location = 'cart.php'</script>";
                }
                else
                {
                    echo "<script>window.location = 'single.php'</script>";
                }
            }
        }


        /**
         * @return bool
         */
        public function allProductBySessionId()
        {
            $userId = Session::get("userId");
            return $this->db->select("SELECT * FROM ecom_cart WHERE sid = '$userId' ");
        }

        /**
         * @param $id
         */
        public function delCartById($id)
        {
            $this->db->delete("DELETE FROM ecom_cart WHERE cartid = '$id' ");

            echo "<div class='alert alert-success alert-dismissable'>
                         <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                         <strong>Success! </strong> Delete successfully.";
            echo "</div>";
        }

        public function updateQuantity($cartId, $quantity)
        {
            $userId = Session::get("userId");
            $this->db->update("UPDATE ecom_cart SET quantity = '$quantity' WHERE sid = '$userId' AND cartid = '$cartId' ");

            echo "<div class='alert alert-success alert-dismissable'>
                         <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                         <strong>Success! </strong> Update successfully.";
            echo "</div>";
        }

        /**
         * @return bool
         */
        public function allProduct()
        {
            $userId = Session::get("userId");
            return $this->db->select("SELECT * FROM ecom_cart WHERE sid = '$userId' LIMIT 8");
        }

        /**
         * @return bool
         */
        public function deleteCart()
        {
            $userId = Session::get("userId");
            $this->db->delete("DELETE FROM ecom_cart WHERE sid = '$userId'");
        }

        /**
         * @param $userId
         * @return bool
         */
        public function getOrderedProductByUserId($userId)
        {
            return $this->db->select("SELECT * FROM ecom_customer_order WHERE customerid = '$userId' ");
        }

        public function removeOrderedProductById($id)
        {
            $this->db->delete("DELETE FROM ecom_customer_order WHERE id = '$id' ");
        }
    }//Main Class
?>