<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
} else {

$eid=$_GET['editid'];
$ret=mysqli_query($con,"select * from tblexpense where ID='$eid'");
$row=mysqli_fetch_array($ret);

if(isset($_POST['update']))
{
$dateexpense=$_POST['dateexpense'];
$item=$_POST['item'];
$category=$_POST['category'];
$costitem=$_POST['costitem'];

$query=mysqli_query($con,"update tblexpense set 
ExpenseDate='$dateexpense',
ExpenseItem='$item',
ExpenseCategory='$category',
ExpenseCost='$costitem'
where ID='$eid'");

if($query){
echo "<script>alert('Expense updated successfully');</script>";
echo "<script>window.location.href='manage-expense.php'</script>";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Expense</title>
<link href="css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background:#f5f5f5;
}

.box{
width:500px;
margin:80px auto;
background:white;
padding:30px;
border-radius:5px;
box-shadow:0 0 10px #ccc;
}
</style>

</head>

<body>

<div class="box">

<h3>Edit Expense</h3>

<form method="post">

<label>Date</label>
<input type="date" name="dateexpense" class="form-control" value="<?php echo $row['ExpenseDate']; ?>" required>

<br>

<label>Item</label>
<input type="text" name="item" class="form-control" value="<?php echo $row['ExpenseItem']; ?>" required>

<br>

<label>Category</label>
<select name="category" class="form-control">
<option value="Food">Food</option>
<option value="Grocery">Grocery</option>
<option value="Travel">Travel</option>
<option value="Shopping">Shopping</option>
<option value="Bills">Bills</option>
<option value="Others">Others</option>
</select>

<br>

<label>Cost</label>
<input type="text" name="costitem" class="form-control" value="<?php echo $row['ExpenseCost']; ?>" required>

<br>

<button type="submit" name="update" class="btn btn-primary">Update</button>

</form>

</div>

</body>
</html>

<?php } ?>