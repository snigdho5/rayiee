<?php

include('db.php');
$mode = $_POST["mode"];

if($mode == 'get_product') {
    $category_id = $_POST["category_id"];
    echo $sql = "SELECT * FROM tbl_product where category_id = $category_id";
    $result = mysqli_query($conn, $sql); ?>
    <option>Select</option>
<?php
    while($row = mysqli_fetch_assoc($result)) {
    ?>
        <option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
    <?php
    }
}

if($mode == 'get_product_detail') {
    $product_id = $_POST["product_id"];
    $sql = "SELECT * FROM tbl_product where id = $product_id";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    echo $data['rate'].'-'.$data['qty'];
}

?>