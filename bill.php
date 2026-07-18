<?php


include("db.php");

$month = $_POST['month'];
$name = $_POST['name'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];
$units = $_POST['units'];

$total = 0;

$remaining = $units;

/*
Slab Rates

First 50 = 3.5
Next 50 = 4.0
Next 150 = 5.2
Remaining = 6.5

*/

if($remaining > 0)
{
    $first = min($remaining,50);
    $total += $first * 3.5;
    $remaining -= $first;
}

if($remaining > 0)
{
    $second = min($remaining,50);
    $total += $second * 4.0;
    $remaining -= $second;
}

if($remaining > 0)
{
    $third = min($remaining,150);
    $total += $third * 5.2;
    $remaining -= $third;
}

if($remaining > 0)
{
    $total += $remaining * 6.5;
}

// Save bill details into the database
$stmt = $conn->prepare("INSERT INTO bills (month, name, address, mobile, units, amount) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssid", $month, $name, $address, $mobile, $units, $total);
$stmt->execute();
$stmt->close();
$consumerNo = rand(1000000000,9999999999);
$billNo = "EB".date("Ym").rand(1000,9999);
$meterNo = "MTR".rand(100000,999999);
$billDate = date("d-m-Y");
$dueDate = date("d-m-Y", strtotime("+10 days"));


?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Electricity Bill</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container mt-4 mb-4">

<div class="bill-paper">

<div class="bill-header">

<div class="row align-items-center">

<div class="col-2 text-center">
<h1>⚡</h1>
</div>

<div class="col-10">

<h2>Maharashtra State Electricity Distribution Co. Ltd.</h2>

<h5>Electricity Consumption Bill</h5>

<p>Customer Care : 1912</p>

</div>

</div>

</div>


<table class="table table-bordered bill-info">

<tr>

<td><b>Consumer No.</b><br><?php echo $consumerNo; ?></td>

<td><b>Bill No.</b><br><?php echo $billNo; ?></td>

<td><b>Meter No.</b><br><?php echo $meterNo; ?></td>

</tr>

<tr>

<td><b>Bill Date</b><br><?php echo $billDate; ?></td>

<td><b>Due Date</b><br><?php echo $dueDate; ?></td>

<td><b>Billing Month</b><br><?php echo $month; ?></td>

</tr>

</table>


<h5 class="section-title">CUSTOMER DETAILS</h5>

<table class="table table-bordered">

<tr>

<th width="25%">Name</th>

<td><?php echo $name; ?></td>

<th width="20%">Mobile</th>

<td><?php echo $mobile; ?></td>

</tr>

<tr>

<th>Address</th>

<td colspan="3">

<?php echo nl2br($address); ?>

</td>

</tr>

</table>



<h5 class="section-title">CONSUMPTION DETAILS</h5>

<table class="table table-bordered text-center">

<tr>

<th>Previous Reading</th>

<th>Current Reading</th>

<th>Units Consumed</th>

<th>Tariff</th>

</tr>

<tr>

<td>1250</td>

<td><?php echo 1250+$units; ?></td>

<td><?php echo $units; ?></td>

<td>Domestic</td>

</tr>

</table>


<?php

$u=$units;

$u1=min($u,50);

$a1=$u1*3.5;

$u-=$u1;

$u2=min($u,50);

$a2=$u2*4.0;

$u-=$u2;

$u3=min($u,150);

$a3=$u3*5.2;

$u-=$u3;

$u4=$u;

$a4=$u4*6.5;

?>


<h5 class="section-title">CHARGE DETAILS</h5>

<table class="table table-bordered text-center">

<thead>

<tr>

<th>Description</th>

<th>Units</th>

<th>Rate</th>

<th>Amount</th>

</tr>

</thead>

<tbody>

<tr>

<td>0 - 50 Units</td>

<td><?php echo $u1; ?></td>

<td>₹3.50</td>

<td>₹<?php echo number_format($a1,2); ?></td>

</tr>

<tr>

<td>51 - 100 Units</td>

<td><?php echo $u2; ?></td>

<td>₹4.00</td>

<td>₹<?php echo number_format($a2,2); ?></td>

</tr>

<tr>

<td>101 - 250 Units</td>

<td><?php echo $u3; ?></td>

<td>₹5.20</td>

<td>₹<?php echo number_format($a3,2); ?></td>

</tr>

<tr>

<td>Above 250 Units</td>

<td><?php echo $u4; ?></td>

<td>₹6.50</td>

<td>₹<?php echo number_format($a4,2); ?></td>

</tr>

</tbody>

</table>



<div class="row">

<div class="col-md-7">

<table class="table table-bordered">

<tr>

<th>Payment Status</th>

<td><span class="badge bg-danger">UNPAID</span></td>

</tr>

<tr>

<th>Due Date</th>

<td><?php echo $dueDate; ?></td>

</tr>

</table>

</div>


<div class="col-md-5">

<table class="table table-bordered">

<tr>

<th>Total Amount</th>

<td>

<h3 class="text-end text-success">

₹<?php echo number_format($total,2); ?>

</h3>

</td>

</tr>

</table>

</div>

</div>



<div class="row mt-4">

<div class="col-md-6 text-center">

<div class="fake-qr">

QR CODE

</div>

<small>Scan to Pay</small>

</div>

<div class="col-md-6 text-center">

<div class="barcode">

|||| |||| || ||||| |||| ||||

</div>

<small><?php echo $billNo; ?></small>

</div>

</div>



<hr>

<p class="text-center">

This is a computer generated electricity bill and does not require any signature.

</p>

<div class="text-center no-print">

<button class="btn btn-primary" onclick="window.print()">

Print / Save as PDF

</button>

<a href="index.php" class="btn btn-secondary">

Generate New Bill

</a>

</div>

</div>

</div>

</body>

</html>