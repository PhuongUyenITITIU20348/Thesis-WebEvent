<?php
// add_member.php
include('../dbconnect.php'); // Make sure you include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $club_name = $_POST['club_name'];
    $password = $_POST['password'];

    // Validate inputs
    if (empty($name) || empty($email) || empty($password)) {
        echo "All fields are required.";
    } else {
        // SQL query to insert the new member into the database
        $sql = "INSERT INTO members (name, email, club_name, password) VALUES ('$name', '$email', '$club_name', '$password')";

        if (mysqli_query($conn, $sql)) {
            header('location:dashboard1.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <title>Add Member</title>
</head>

<body>
 
    <div class="flex items-center justify-center min-h-screen bg-orange-100">
        <div class="px-8 py-6 mx-4 mt-4 text-left bg-white shadow-lg md:w-1/3 lg:w-1/3 sm:w-1/3 animate__animated animate__slideInDown">
            <div class="flex justify-center">

                
            </div>
            <h3 class="text-2xl font-bold text-center">Add Members</h3>
            <form  method="post">
            <div class="mt-4">
                        <label class="block">Name<label>
                                <input type="text" placeholder="Name" name="name" value="" required 
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" />
                    </div>
                <div class="mt-4">
                <div class="mt-4">
                    <label class="block">Email<label>

                    <input type="text" placeholder="Email" name="email" value="" required
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" />
            
            </div>
                    <div class="mt-4">
                    <label class="block">Club Name (option):<label>
                        
                                <input type="text" placeholder="Club Name (option):" name="club_name" value="" 
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" />
                    </div>
                    


                    </div>
                    <div class="mt-4">
                        <label class="block">Password<label>
                                <input type="number" placeholder="Password" name="password" value="" required max=9999 
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" />
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
                        <button type="submit" class="w-full px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900"  name="submit">ADD</button>
                    </div>
                    

                </div>
            </form>
        </div>
    </div>
</body>
</html>
