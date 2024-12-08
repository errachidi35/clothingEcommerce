<?php
/**
 * Product Class
 * Created by PhpStorm.
 * User: Tushar Khan
 * Date: 9/10/2017
 * Time: 5:33 AM
 */
?>
<?php
    $filePath = realpath(dirname(__FILE__));
    include_once $filePath.'/../lib/Database.php';
    include_once $filePath.'/../helpers/Formate.php';

    class Product
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Formate();
        }

        public function insertProduct($data, $image)
        {
            $proName        = $this->fm->validation($data['product']);
            $category       = $this->fm->validation($data['category']);
            $brand          = $this->fm->validation($data['brand']);
            $proDescription = $this->fm->validation($data['prodis']);
            $proPrice       = $this->fm->validation($data['price']);
            $proType        = $this->fm->validation($data['gender']);
            $proQS        = $this->fm->validation($data['qs']);
            $proQM     = $this->fm->validation($data['qm']);
            $proQL       = $this->fm->validation($data['ql']);

            $proName        = mysqli_real_escape_string($this->db->link, $proName);
            $category       = mysqli_real_escape_string($this->db->link, $category);
            $brand          = mysqli_real_escape_string($this->db->link, $brand);
            $proDescription = mysqli_real_escape_string($this->db->link, $proDescription);
            $proPrice       = mysqli_real_escape_string($this->db->link, $proPrice);
            $proType        = mysqli_real_escape_string($this->db->link, $proType);
            $proQS        = mysqli_real_escape_string($this->db->link, $proQS);
            $proQM        = mysqli_real_escape_string($this->db->link, $proQM);
            $proQL        = mysqli_real_escape_string($this->db->link, $proQL);


            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $image['image']['name'];
            $file_size = $image['image']['size'];
            $file_temp = $image['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if (empty($proQS)){$proQS=0;}
            if (empty($proQL)){$proQL=0;}
            if (empty($proQM)){$proQM=0;}

            if (empty($file_name) || empty($proName) || empty($category) || empty($brand) || empty($proDescription) || empty($proPrice) || empty($proType))
            {
                echo "<div class='alert alert-danger alert-dismissable'>
                          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                          <strong>Warning !</strong> Fields Should not be Empty.
                      </div>";
            }
            else
            {
                $date = date('y-m-d');
                move_uploaded_file($file_temp, $uploaded_image);
                $this->db->insert("INSERT INTO ecom_product(proname, catid, brandid, body, price, image, gender, quant_S, quant_L, quant_M) VALUES ('$proName','$category','$brand','$proDescription','$proPrice','$uploaded_image','$proType','$proQS','$proQL','$proQM')");

                echo "<div class='alert alert-success alert-dismissable'>
                         <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                         <strong>Success! </strong>"; echo $proName; echo " Inserted successfully.";
                echo "</div>";
            }

        }

        /**
         * @return bool
         */
        public function allProducts()
        {
            return $this->db->select("SELECT * FROM ecom_product ORDER BY proid");
        }

        
        

        /**
         * @param $id
         * @return bool
         */


         
        public function getCategoryIdById($id)
        {
            return $this->db->select("SELECT * FROM ecom_category WHERE id = '$id' ");
        }


        /**
         * @param $id
         * @return bool
         */
        public function getBrandIdById($id)
        {
            return $this->db->select("SELECT * FROM ecom_brand WHERE id = '$id' ");
        }

        /**
         * @param $id
         */
        public function deleteProductById($id)
        {
            $this->db->delete("DELETE FROM ecom_product WHERE proid = '$id'");

            echo "<div class='alert alert-success alert-dismissable'>
                         <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                         <strong>Success! </strong> Delete successfully.";
            echo "</div>";
        }


        /**
         * @param $id
         * @return bool
         */
        public function allProductById($id)
        {
            return $this->db->select("SELECT * FROM ecom_product WHERE proid = '$id'");
        }

        /**
         * @param $id
         * @param $data
         * @param $image
         */
        public function updateProductById($id, $data, $image)
        {
            $proName        = $this->fm->validation($data['product']);
            $category       = $this->fm->validation($data['category']);
            $brand          = $this->fm->validation($data['brand']);
            $proDescription = $this->fm->validation($data['prodis']);
            $proPrice       = $this->fm->validation($data['price']);
            $proType        = $this->fm->validation($data['gender']);
            $proQS        = $this->fm->validation($data['qs']);
            $proQM     = $this->fm->validation($data['qm']);
            $proQL       = $this->fm->validation($data['ql']);

            $proName        = mysqli_real_escape_string($this->db->link, $proName);
            $category       = mysqli_real_escape_string($this->db->link, $category);
            $brand          = mysqli_real_escape_string($this->db->link, $brand);
            $proDescription = mysqli_real_escape_string($this->db->link, $proDescription);
            $proPrice       = mysqli_real_escape_string($this->db->link, $proPrice);
            $proType        = mysqli_real_escape_string($this->db->link, $proType);
          


            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $image['image']['name'];
            $file_size = $image['image']['size'];
            $file_temp = $image['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;
            $date = date('y-m-d');


            if (empty($proName) || empty($category) || empty($brand) || empty($proDescription) || empty($proPrice) || empty($proType))
            {
                echo "<div class='alert alert-warning alert-dismissable'>
                          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                          <strong>Warning !</strong> Fields Should not be Empty.
                      </div>";
            }
            //Image
            if (!empty($file_name))
            {
                move_uploaded_file($file_temp, $uploaded_image);
                $this->db->update("UPDATE ecom_product SET image = '$uploaded_image' WHERE proid = '$id'");
            }

            //Product Name
            if (!empty($proName))
            {
                $this->db->update("UPDATE ecom_product SET proname = '$proName' WHERE proid = '$id'");
            }

            //Category
            if (!empty($category))
            {
                $this->db->update("UPDATE ecom_product SET catid = '$category' WHERE proid = '$id'");
            }

            //Brand
            if (!empty($brand))
            {
                $this->db->update("UPDATE ecom_product SET brandid = '$brand' WHERE proid = '$id'");
            }

            //Description
            if (!empty($proDescription))
            {
                $this->db->update("UPDATE ecom_product SET body = '$proDescription' WHERE proid = '$id'");
            }

            //Price
            if (!empty($proPrice))
            {

                $this->db->update("UPDATE ecom_product SET price = '$proPrice' WHERE proid = '$id'");
            }

            //Type
            if (!empty($proType))
            {
                $this->db->update("UPDATE ecom_product SET gender = '$proType' WHERE proid = '$id'");
            }

            //Type
            if (!empty($proQS))
            {
                $this->db->update("UPDATE ecom_product SET quant_S = '$proQS' WHERE proid = '$id'");
            }

            //Type
            if (!empty($proQL))
            {
                $this->db->update("UPDATE ecom_product SET quant_L = '$proQL' WHERE proid = '$id'");
            }

            //Type
            if (!empty($proQM))
            {
                $this->db->update("UPDATE ecom_product SET quant_M = '$proQM' WHERE proid = '$id'");
            }

            echo "<div class='alert alert-info alert-dismissable'>
                         <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                         <strong>Success! </strong> Update successfully.";
            echo "</div>";
        }

        /**
         * @return bool
         */
        public function show_shirts()
        {
            return $this->db->select("SELECT * FROM ecom_product WHERE catid = 1 ORDER BY proid LIMIT 3");
        }

        /**
         * @return bool
         */
        public function show_T_shirts()
        {
            return $this->db->select("SELECT * FROM ecom_product WHERE catid = 2 ORDER BY proid LIMIT 3");
        }

        /**
         * @return bool
         */
        public function show_Pants()
        {
            return $this->db->select("SELECT * FROM ecom_product WHERE catid = 3 ORDER BY proid LIMIT 3");
        }

        /**
         * @return bool
         */
        public function show_jackets()
        {
            return $this->db->select("SELECT * FROM ecom_product WHERE catid = 4 ORDER BY proid LIMIT 3");
        }

        /**
         * @return bool
         */
        public function show_shoes()
        {
            return $this->db->select("SELECT * FROM ecom_product WHERE catid = 5 ORDER BY proid LIMIT 3");
        }

        /**
         * @param $id
         * @return bool
         */
        public function getProductById($id)
        {
            return $this->db->select("SELECT * FROM ecom_product WHERE proid = '$id'");
        }

        /**
         * @param $proRev
         * @return bool
         */
        public function rating($proRev)
        {
            return $this->db->select("SELECT * FROM ecom_product_review WHERE proid = '$proRev' ");
        }

        /**
         * @param $catId
         * @return bool
         */
        public function getProductByCategory($catId)
        {
            return $this->db->select("SELECT * FROM ecom_product WHERE catid = '$catId'");
        }

        /**
         * @param $customerId
         */
        public function orderProductByCustomerId($customerId)
        {
            // $sessionId = session_id();
            $cartResult = $this->db->select("SELECT * FROM ecom_cart WHERE sid = '$customerId' ");
            // $id = $this->db->select("SELECT * FROM ecom_cart WHERE sid = '$sessionId' ");
            // $cartResult = $this->db->select("SELECT * FROM ecom_customer_order WHERE sid = '$customerId' ");

            $d = new DateTime();
            $date = $d->format('Y-m-d H:i:s');

            $order_id = $this->db->insert("INSERT INTO ecom_customer_order (customerid, date, status) VALUES ('$customerId', NOW(), 0)");
            
            if ($cartResult)
            {
                while ($getProduct = $cartResult->fetch_assoc())
                {
                    $productName = $getProduct['proname'];
                    $productId = $getProduct['proid'];
                    $productPrice = $getProduct['price'];
                    $productQuantity = $getProduct['quantity'];
                    $productSize = $getProduct['size'];
                    
                    //Inserting Product to Order Table

                    //  $order_id = $this->db->insert_id;

                    $stmt = $this->db->insert("INSERT INTO product_order (order_id, product_id, quantity,size) VALUES ('$order_id','$productId', '$productQuantity', '$productSize')");
                    //$stmt->bind_param("iiis", $order_id,$productId, $productQuantity, $productSize);

                }
                echo "<script>window.location = 'success.php' </script>";
            }//Main if
        }

        public function allOrderProduct()
        {
            $query = "SELECT * FROM ecom_customer_order ORDER BY date";
            return $this->db->select($query);
        }

        public function customerOrderProduct($customerId = null)
        {
            $query = "SELECT * FROM ecom_customer_order";

            // If a customer ID is provided, add a WHERE clause to filter by customer
            if ($customerId !== null) {
                $query .= " WHERE customerid = '$customerId'";
            }

            $query .= " ORDER BY date";

            return $this->db->select($query);
        }
        
        public function getProductReviews($productId) {
            $sql = "SELECT * FROM ecom_product_review WHERE proid = '$productId' ORDER BY date DESC";
            return $this->db->select($sql);
        }

        public function allOrderProducts($orderid){

            $query = "SELECT p.proid ,p.proname, po.quantity, po.size, p.price
                        FROM product_order po
                        JOIN ecom_product p ON po.product_id = p.proid
                        WHERE po.order_id = '$orderid'";

            // Execute the query
            $result = $this->db->select($query);

            // Check if the query was successful
            if ($result !== false) {
                // Fetch and display the products
                // while ($row = $result->fetch_assoc()) {
                //     $productName = $row['proname'];
                //     $quantity = $row['quantity'];
                //     $size = $row['size'];
                //     $price = $row['price'];

                //     echo "Product: $productName, Quantity: $quantity, Size: $size, Price: $price<br>";
                // }
                return $result;
            } else {
                echo "Failed to fetch products for the order.";
            }
        }

        /**
         * @param $productId
         */
        public function shiftToInRoutegById($productId)
        {
            $this->db->update("UPDATE ecom_customer_order SET status = 1 WHERE id = '$productId' ");
            echo "<div class='alert alert-success alert-dismissable'>
                         <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                         <strong>Success! </strong> Product is added as Pending.";
            echo "</div>";
        }

        public function changeStatus($productId,$status)
        {
            $this->db->update("UPDATE ecom_customer_order SET status = '$status' WHERE id = '$productId' ");
            echo "<div class='alert alert-success alert-dismissable'>
                         <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                         <strong>Success! </strong> Product status updated successfuly.";
            echo "</div>";
        }

        /**
         * @param $productId
         */
        public function shiftToPendingById($productId)
        {
            $this->db->update("UPDATE ecom_customer_order SET status = 0 WHERE id = '$productId' ");
            echo "<div class='alert alert-warning alert-dismissable'>
                         <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                         <strong>Success! </strong> Product is added as Pending.";
            echo "</div>";
        }


        /**
         * @param $productId
         */
        public function pendingToShiftById($productId)
        {
            $this->db->update("UPDATE ecom_customer_order SET status = 1 WHERE id = '$productId' ");
            echo "<div class='alert alert-info alert-dismissable'>
                         <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                         <strong>Success! </strong> Product is added as Shifted.";
            echo "</div>";
        }

        /**
         * @param $proName
         * @return bool
         */
        public function searchProduct($proName)
        {
            return $this->db->select("SELECT * FROM ecom_product WHERE proname='$proName'");
        }

    }//Main Class
?>