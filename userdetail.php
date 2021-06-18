  
<?php
include 'connection.php';

if(isset($_POST['submit']))
{
    $from = $_GET['SrNo'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from customers where SrNo=$from";
    $query = mysqli_query($con,$sql);
    $sql1 = mysqli_fetch_array($query); 
    // returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * from customers where SrNo=$to";
    $query = mysqli_query($con,$sql);
    $sql2 = mysqli_fetch_array($query);

    // constraint to check input of negative value by user
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }

    // constraint to check insufficient balance.
    else if($amount > $sql1['Balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }
    
    // constraint to check zero values
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {
        
                // deducting amount from sender's account
                $newbalance = $sql1['Balance'] - $amount;
                $sql = "UPDATE customers set Balance=$newbalance where SrNo=$from";
                mysqli_query($con,$sql);
             

                // adding amount to reciever's account
                $newbalance = $sql2['Balance'] + $amount;
                $sql = "UPDATE customers set Balance=$newbalance where SrNo=$to";
                mysqli_query($con,$sql);
                
                $sender = $sql1['Name'];
                $receiver = $sql2['Name'];
                $sql = "INSERT INTO transaction(`Sender`, `Receiver`, `Amount`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($con,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='alltransactions.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/userdetail.css">

    <style>
    	body{
 	
        height:800px;*/
        background-image: url(https://images.unsplash.com/photo-1462206092226-f46025ffe607?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8YmFua3xlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=80.png);
        background-size: cover;
        }
    </style>
</head>

<body>
<header class="container">
<nav class="navbar">
	<div class="logo">
		<i class="fa fa-bank" style="font-size:36px;margin:13px;color:darkgreen"></i>
		<p>Golden Horizon Bank</p>
	</div>
	<ul>
		<li><a href="index.php">Home</a></li>
	</ul>
</nav>

</header>
	<div class="container">
        <h2>Transaction</h2>
            <?php
                include 'connection.php';
                $sid=$_GET['SrNo'];
                $sql = "SELECT * FROM  customers where SrNo=$sid";
                $result=mysqli_query($con,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($con);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>

            <table>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Balance</th>
                </tr>
                <tr>
                    <td><?php echo $rows['SrNo'] ?></td>
                    <td><?php echo $rows['Name'] ?></td>
                    <td><?php echo $rows['Email'] ?></td>
                    <td><?php echo $rows['Balance'] ?></td>
                </tr>
            </table>
            <br>
            <form method="post"><br>
        <div>

        <label><b>Transfer To:</b></label>
        <br>
        <select name="to"  required>
            <option value="" disabled selected>Choose</option>
            <?php
                include 'connection.php';
                $sid=$_GET['SrNo'];
                $sql = "SELECT * FROM Customers where SrNo!=$sid";
                $result=mysqli_query($con,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($con);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option value="<?php echo $rows['SrNo'];?>" >
                <?php echo $rows['Name'] ;?> 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        <br>
        <br>
            <label><b>Amount:</b></label>
            <br>
            <input type="number"name="amount" required>   
            <br><br>
            <div>
            <button name="submit" type="submit" id="myBtn" >Transfer</button>
            </div>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</body>
</html>
