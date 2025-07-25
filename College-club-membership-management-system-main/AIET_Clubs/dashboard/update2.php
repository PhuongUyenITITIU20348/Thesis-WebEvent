<?php
include '../dbconnect.php';

$updateid = $_GET['updateid'] ?? null;
if (!$updateid || !is_numeric($updateid)) {
    die("Invalid or missing member ID.");
}

$query = "SELECT * FROM members WHERE member_id = $updateid";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$email = $row['email'];
$club = $row['club_name'];
$password =$row['password'];

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $club = $_POST['club_name'];
    $password =$_POST['password'];

    $sql = "update `members` set member_id=$updateid, name='$name', email='$email', club_name='$club' where member_id=$updateid";

    $result = mysqli_query($conn,$sql);
    if($result){
        // echo  'data inserted successfully';
        header('location:dashboard1.php');
    }else{
        // die(mysqli_error($conn));
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <title>UPDATE</title>
</head>
<body>
    
    <div class="flex items-center justify-center min-h-screen bg-orange-100">
        <div class="px-8 py-6 mx-4 mt-4 text-left bg-white shadow-lg md:w-1/3 lg:w-1/3 sm:w-1/3 animate__animated animate__slideInDown">
            <div class="flex justify-center">
             
                <?php 
    $gd='select club_name from members where name="' . $name .'" and email="' . $email .'"';
    $k=$conn->query($gd);
    foreach($k as $f){
        $clubName=$f['club_name'];
    }


?>
                <div class=" md:w-1/6 overflow-hidden ">
                    <img src="../images/logoIU.png" alt="" class="" />
                </div>
            </div>
            <h3 class="text-2xl font-bold text-center">UPDATE</h3>
            <form  method="post">
                <div class="mt-4">
                    <div>
                        <label class="block">Name<label>
                                <input type="text" placeholder="Name" name="name" value="<?php echo $name;  ?>"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"/>
                    </div>
                    <div class="mt-4">
                    <label class="block">Email<label>
                        <label class="block" for="email"><label>
                                <input type="text" placeholder="Email" name="email" value="<?php echo $email;  ?>"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" />
                    </div>
                    <div class="mt-4">
                    <label class="block">Club<label>
                    <div class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">

                    <?php


			        $query = "SELECT distinct * FROM clubinfo";
					$results = mysqli_query($conn, $query); ?>
			        <select name="club_name" id="club_name" title="choose a club" required>
					<option value="<?php echo $club_name;  ?>">Choose</option>
				<?php
			        echo '<option value="'.$clubName.'" selected>'.$clubName. '</option>';
                	while($row = mysqli_fetch_assoc($results)) {
			        echo '<option value="'.$row['club_name'].'">'.$row['club_name']. '</option>';
					//echo $row['id'];
					
					}
                    ?>
			   </select>
			
            </div>
            </div>
                  
                    </div>
                   
                    <div>
               <?php
                                                if (isset($error)) {
                                                    echo $error;
                                                        }
                                                    if(isset($noerror)){
                                                        echo $noerror;
                                                    }
                                                    ?>  
                                                    </div>  
                  
                    <div class="flex">
                        <button type="submit" class="w-full px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900"  name="submit">UPDATE</button>
                    </div>
                    
                
                </div>
            </form>
        </div>
    </div>
</body>
</html>