<?php
include 'pdoconnection.php';
include 'header.php';
include 'functions.php';
session_start();
if(!isset($_SESSION['id'])){
    header("Location: login.php");
}

if (isset($_POST['status'])){
    $username = $_SESSION['id'];
    $status_update = $_POST['status_update'];
    $time = $_SERVER['REQUEST_TIME'];
    echo $status_update;
    $insert1 = mysqli_query($conn, "INSERT INTO status (username, status_update, time_stamp)
    VALUES ('$username', '$status_update', '$time')");
}
$getstatusupdate = mysqli_query($conn, "SELECT * FROM status WHERE username = '$username' ORDER BY time_stamp DESC");
if ($getstatusupdate -> num_rows > 0){
    $row = mysqli_fetch_array($getstatusupdate);
    $last_status = $row["status_update"];
    echo "<h1>QUERRY HAS RESULTS</h1>";
}else{
    echo "<h1>NO UPDATES</h1>";
}

?>
<body>
    <h2><?php echo "<p>Signed in as " . $_SESSION['id']  . ".</p>" ?></h2>
    	<div>
    	<form action="index.php" method="post">
    		<h3>Update Your Status</h3>
            <textarea name="status_update" cols="40" rows="5"></textarea>
    		<button type="submit" name="status"><span>Update</span></button><br><br><br>
    	</form>
    </div>
    <h3>Your latest status</h3>
    <?php echo getstatusupdate($conn, $username); ?>
</body>

<?php include 'footer.php' ?>
