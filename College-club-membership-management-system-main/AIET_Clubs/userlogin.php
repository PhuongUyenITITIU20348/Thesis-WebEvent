<?php
session_start();

$server = "localhost";
$username = "root";
$password = "";
$dbname = "aietclub";

$conn = mysqli_connect($server, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT member_id, email, interests FROM members WHERE name = ? AND password = ?");
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  if ($row) {
    $_SESSION['member_id'] = $row['member_id'];
    $_SESSION['email'] = $row['email'];

    if (empty($row['interests'])) {
      header("Location: ../AIET_Clubs/user/home.php");
    } else {
      header("Location: ../AIET_Clubs/user/event.php");
    }
    exit();
  } else {
    $error = "<script>alert('❌ Sai tên đăng nhập hoặc mật khẩu');</script>";
  }
}


if (isset($_POST['createacc'])) {
  header('location:create_account/create_account.php');
  exit();
}


?>


<!DOCTYPE html>
<html>
<head>
  <title>User Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    #container{
    margin: 14%;
}
  </style>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <link rel="icon" href="../images/sitelogo.png" />
</head>
<body class="h-full bg-[url('images/IU.jpg')] bg-cover bg-center bg-fixed">

  

    <form action="" method="post">
    <div class="flex justify-center animate__animated animate__jello" id="container">
            <div class="flex flex-col justify-center">
                <div class="flex flex-col md:flex-row max-w-7xl justify-center items-center ">
                    <div class="overflow-hidden w-full m-4 flex justify-center bg-gray-50 rounded-lg shadow-xl">
                        <div class="flex flex-col md:flex-row items-center shadow-md h-full  ">
                            <div class="  md:w-1/2 overflow-hidden ">
                                <div class="flex flex-col items-center justify-center text-stone-400">
                                    <!-- <ion-icon name="logo-amplify" class="text-5xl text-fuchsia-600"></ion-icon> -->
                                    <div class=" md:w-1/6 overflow-hidden ">
                                        <img src="images/logoIU.jpg" alt="" class="" />
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="m-2">USERNAME</div>
                                        <input class="border-b m-2  bg-gray-50 focus:outline-none" autofocus  title="Enter your Name" type="text" id="username" name="username" />
    
                                        <div class="m-2">PASSWORD</div>
                                        <input class="border-b m-2  bg-gray-50  focus:outline-none"  type="password"  title="enter password" id="password" name="password"/>
                                        <?php
                                                if (isset($error)) {
                                                echo $error;
                                                    }
                                                ?>
                                       
                                        <div class="flex m-2">
                                            <input
                                                class="bg-gradient-to-l from-fuchsia-600 to-cyan-400 px-6 py-1 rounded-2xl text-white font-medium" type="submit" name="login" value="Login" />
                                                
                                                
                                            <input 
                                                class="text-transparent  bg-clip-text bg-gradient-to-l from-fuchsia-600 to-cyan-400 font-bold ml-2 border-2 rounded-2xl px-6 border-cyan-400" name="createacc" type="submit" value="Create new Account" />
                                        </div>
                                      
                                        
    
                                    </div>
    
                                </div>
                            </div>
                            <div class=" md:w-1/2 overflow-hidden ">
                                <img src="images/IU_Banner.jpg" alt="" class="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    

    </form>




</body>
</html>
