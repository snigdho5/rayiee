
<?php  
include('db.php');

$id = $_GET['id'];
$sql_select = "SELECT tbl_sale.* FROM tbl_sale WHERE id = '$id'";
$result = mysqli_query($conn, $sql_select);
$data_sale = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>
<body style="font-size: 15px; text-align:center; margin-left: auto; margin-right: auto;">

    <div style="border: 2px solid gray; border-radius: 8px; width: auto;">
        <a onClick="window.print();return false" style="border-style: groove;">Print</a><br><br>
        <span><b>Date:</b> <?php echo date('d/m/Y',strtotime($data_sale['created_at'])); ?> &middot; <b>Invoice No:</b> <?php echo $data_sale['invoice_no']; ?></span><br>
        <h1 style="margin:0;">Rayie Collection</h1>
        <span>Ground Floor, Dakshin Kumrakhali Post</span>, <span>Narendrapur,</span> <span>Ps - Sonarpur</span> <br>
        <span>Green Park,</span> <span>Kolkata,</span> <span>West Bengal - 700103</span> <br>
            <b>Estd.:</b> 2009 &middot; <b>Mobile:</b> 9090909090<br>
        &middot; <b>GST No.:</b> 19AAGCV0556R1ZK &middot;

        <br><br>

        <table cellspacing="0" cellpadding="3" border="1" style="text-align:center; width: auto; margin-left: auto; margin-right: auto;">
            <thead style="text-align: center;">
                <th>Sl</th>
                <th>Product</th>
                <th>Size</th>
                <th>MRP</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Dis. %</th>
                <th>Dis. Amt.</th>
                <th>Taxable Amt.</th>
                <th>SGST %</th>
                <th>SGST Amt.</th>
                <th>CGST %</th>
                <th>CGST Amt.</th>
                <th>Total</th>
            </thead>
            <tbody>

            <?php
            $sql_details = "SELECT * FROM tbl_sale_details WHERE sale_id = '$id'";
            $result_details = mysqli_query($conn, $sql_details);

            $icount = 0;
            while ($data_sale_details = mysqli_fetch_assoc($result_details)) {
                $icount = $icount +1;
            ?>
                <tr>
                    <td><?php echo $icount; ?></td>
                    <td><?php echo $data_sale_details['product_name']; ?></td>
                    <td><?php echo $data_sale_details['size']; ?></td>
                    <td>Rs. <?php echo number_format($data_sale_details['mrp'],2); ?></td>
                    <td><?php echo $data_sale_details['qty']; ?></td>
                    <td>Rs. <?php echo number_format($data_sale_details['rate'],2); ?></td>
                    <td><?php echo $data_sale_details['discount_percent']; ?>%</td>
                    <td>Rs. <?php echo number_format($data_sale_details['discount_amount'],2); ?></td>
                    <td>Rs. <?php echo number_format($data_sale_details['taxable_amount'],2); ?></td>
                    <td><?php echo $data_sale_details['sgst_percent']; ?>%</td>
                    <td>Rs. <?php echo number_format($data_sale_details['sgst_amount'],2); ?></td>
                    <td><?php echo $data_sale_details['cgst_percent']; ?>%</td>
                    <td>Rs. <?php echo number_format($data_sale_details['cgst_amount'],2); ?></td>
                    <td>Rs. <?php echo number_format($data_sale_details['total_amount'],2); ?></td>
                </tr>
            <?php } ?>
                <tr>
                    <td colspan="4">Total</td>
                    <td><?php echo $data_sale['total_qty']; ?></td>
                    <td colspan="2"></td>
                    <td>Rs. <?php echo number_format($data_sale['discount_amount'],2); ?></td>
                    <td>Rs. <?php echo number_format($data_sale['tax_amount'],2); ?></td>
                    <td></td>
                    <td>Rs. <?php echo number_format($data_sale['sgst_amount'],2); ?></td>
                    <td></td>
                    <td>Rs. <?php echo number_format($data_sale['cgst_amount'],2); ?></td>
                    <td>Rs. <?php echo number_format($data_sale['total_amount'],2); ?></td>
                </tr>
            </tbody>
        </table>
        <br />

        <div style="text-align:left;">
            <p>
                <b>Billing Details:</b><br /> 
                <?php if($data_sale['card_amount']!='0.00') { ?>
                    <span><b>Card: </b>Rs. <?php echo $data_sale['card_amount']; ?></span><br />
                <?php } ?>
                <?php if($data_sale['cash_amount']!='0.00') { ?>
                    <span><b>Cash: </b>Rs. <?php echo $data_sale['cash_amount']; ?></span><br />
                <?php } ?>
                <?php if($data_sale['online_amount']!='0.00') { ?>
                    <span><b>Online: </b>Rs. <?php echo $data_sale['online_amount']; ?></span><br />
                <?php } ?>

                <br /><span><b>Name: </b><?php echo $data_sale['cust_name']; ?> &middot;</span><br />
                <span><b>Email: </b><?php echo $data_sale['cust_email']; ?> &middot;</span><br />
                <span><b>Phone: </b><?php echo $data_sale['cust_mobile']; ?> &middot;</span><br />
                <span><b>Address: </b><?php echo $data_sale['cust_address']; ?></span><br />
               
            </p>

            <p>
                <b>Terms &amp; Conditions:</b><br />
                <span>1. Goods once sold can only be exchanged within three days from the date of purchase. No refunds shall be issued under any circumstances.</span><br />
                <span>2. Please check the items carefully before leaving the store.</span><br />
                <span>3. All disputes shall be subjected to Kolkata jurisdictions only.</span><br />
                <span>4. Exchange time - 12pm to 4pm (Monday to Friday)</span><br />
            </p>
        </div>
        
        <br /> <small >* This is a computer generated invoice, signature is not required.</small>

    </div>

    
</body>
</html>