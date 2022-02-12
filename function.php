<?php
include('db.php');

class master {

    public $product_id;
    public $size;
    public $qty;
    public $rate;
    public $discount_percent;
    public $discount_amount;
    public $amount;
    public $sgst_percent;
    public $sgst_amount;
    public $cgst_percent;
    public $cgst_amount;
    public $total_amount;
    public $cust_name;
    public $cust_email;
    public $cust_mobile;
    public $cust_address;

    public function insert_tbl_sale() {

        $query = "SELECT max(id) as id FROM tbl_sale";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $data = $result['id'];

        $invoiceNo = '#RayieOrder'+($data+1);

        $sql = "INSERT INTO `tbl_sale`(
                    `invoice_no`, 
                    `product_id`, 
                    `size`, 
                    `qty`, 
                    `rate`, 
                    `discount_percent`, 
                    `discount_amount`, 
                    `amount`, 
                    `sgst_percent`, 
                    `sgst_amount`, 
                    `cgst_percent`, 
                    `cgst_amount`, 
                    `total_amount`, 
                    `cust_name`, 
                    `cust_email`, 
                    `cust_mobile`, 
                    `cust_address`
                ) VALUES (
                    '$invoiceNo',
                    '$this->product_id',
                    '$this->size',
                    '$this->qty',
                    '$this->rate',
                    '$this->discount_percent',
                    '$this->discount_amount',
                    '$this->amount',
                    '$this->sgst_percent',
                    '$this->sgst_amount',
                    '$this->cgst_percent',
                    '$this->cgst_amount',
                    '$this->total_amount',
                    '$this->cust_name',
                    '$this->cust_email',
                    '$this->cust_mobile',
                    '$this->cust_address'
                )";
      
      if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
}
?>