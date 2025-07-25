
<?php
session_start();
include '../dbconnect.php';
if(isset($_POST['name'])) {
    $username = $_POST['name'];
    $query = "SELECT * FROM members WHERE name='$username'";
    $result = $conn->query($query);
    //if the username already exists
    if ($result->num_rows > 0) {
        echo "<script>
                alert('name already exists. Please choose a different one.');
              </script>";
    } else {
        if(isset($_POST['name'])) {
            $username = $_POST['email'];
            $query = "SELECT * FROM members WHERE email='$username'";
            $result = $conn->query($query);
            //if the username already exists
            if ($result->num_rows > 0) {
                echo "<script>
                        alert('Mail id already exists.');
                      </script>";
            } else {


                if(isset($_POST['name'])) {
                    $username = $_POST['password'];
                    $query = "SELECT * FROM members WHERE password='$username'";
                    $result = $conn->query($query);
                    //if the username already exists
                    if ($result->num_rows > 0) {
                        echo "<script>
                                alert('Password Already exists');
                              </script>";
                    } else {
                       
                       
                // code to insert into database goes here
                if(isset($_POST['password']) && isset($_POST['confirmpassword'])) {
                    $password = $_POST['password'];
                    $confirm_password = $_POST['confirmpassword'];
                    if($password == $confirm_password) {
                   
                        if(isset($_POST['submit'])){
                            $name = $_POST['name'];
                            $email = $_POST['email'];
                            $club = $_POST['club_name'];
                            $password =$_POST['password'];
                       
                           $avatar_name = 'uploads/avatars/default.png'; // fallback nếu không có ảnh
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $upload_dir = "../uploads/avatars/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $new_name = uniqid() . '.' . $ext;
        $upload_path = $upload_dir . $new_name;

        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_path)) {
            $avatar_name = 'uploads/avatars/' . $new_name;
        }
    }
                        }
    // Chèn dữ liệu vào bảng members
    $stmt = $conn->prepare("INSERT INTO members (name, email, club_name, password, avatar) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $club, $password, $avatar_name);

 if ($stmt->execute()) {
    // Gán thông tin vào session
    $_SESSION['member_id'] = $stmt->insert_id;
    $_SESSION['email'] = $email;

    // Chuyển sang trang chọn sở thích
    header("Location: ../user/select_interests.php");
    exit();
}

}
    }

    $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $new_name = uniqid() . '.' . $ext;
    $upload_path = $upload_dir . $new_name;

    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_path)) {
        $avatar_name = 'uploads/avatars/' . $new_name;
    }
}
            }
        }        
    }
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
    <title>CREATE NEW ACCOUNT</title>
</head>
<body  class="bg-[white]">
   
           <script src="https://cdn.tailwindcss.com"></script>
           <script src="https://use.fontawesome.com/03f8a0ebd4.js"></script>
           <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
           <script nomodule src="../images/logoIU.png"></script>
    </div>



    <div class="flex items-center justify-center min-h-screen bg-[#fdba74]-600 animate__animated animate__bounceInDown">
        <div class="px-8 py-6 mx-4 mt-4 text-left bg-white shadow-lg md:w-1/3 lg:w-1/3 sm:w-1/3">
            <div class="flex justify-center">
               
                <div class=" md:w-1/6 overflow-hidden ">
                    <img src="../images/logoIU.png" alt="" class="" />
                </div>
            </div>
            
            <form method="POST" enctype="multipart/form-data" action="">


                <div class="mt-4">
                    <div>
                        <label class="block" for="Name">Name<label>
                                <input type="text" placeholder="Name" name="name" required="" autofocus
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"/>
                    </div>
                    <div class="mt-4">
                    <label class="block" for="Name">Email<label>
                        <label class="block" for="email"><label>
                                <input type="email" placeholder="Email" name="email" required=""
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" />
                    </div>
                    <div class="mt-4">
                    <label class="block" for="Name">Club<label>
                    <div class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">


                    <?php
                   include '../dbconnect.php';




                    $query = "SELECT * FROM clubinfo";
                    $results = mysqli_query($conn, $query);


                   
                    echo '<select name="club_name" id="club_name" required>';
                    echo '<option value=""></option>';
                    while($row = mysqli_fetch_assoc($results)) {
                    echo '<option value="'.$row['club_name'].'">'.$row['club_name']. '</option>';
                    //echo $row['id'];
                   
                    }
               echo '</select>';


            ?>
            </div>
            </div>
                 
                    </div>
                    <div class="mt-4">
                        <label class="block">Password<label>
                                <input type="password" placeholder="Password" name="password" required="" minlength=8  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" />
                                <input type="password" placeholder="Confirm Password" name="confirmpassword" required="" minlength=8  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" />
                                    <h7 class="text-xs text-rose-600 font-thin">must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters </h7>
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
                        <button type="submit" class="w-full px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900"  name="submit">SUBMIT</button>
                    </div>
                   
                    <div class="mt-6 text-grey-dark">
                        Already have an account?
                        <a class="text-blue-600 hover:underline" href="../userlogin.php">
                            Log in
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>







