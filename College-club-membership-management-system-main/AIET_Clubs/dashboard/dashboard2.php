
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
  
  <link rel="icon" href="../images/logoIU.png" />

    <title>Dashboard</title>
</head>
<body>
	<div class="navbarheader">
        <div class="flex justify-center ">
            <div class="self-center top-0 w-full max-w-7xl ">
                <div class="flex justify-between items-center text-gray-700">
                    <div class="mx-8 my-4 ">
                      <div class=" flex items-center space-x-4 ">
                        <img src="../images/logoIU.png" alt="Logo" class="h-14 w-auto object-contain" />
                      </div>
                    </div>
                    <ul class="hidden md:flex items-center text-[18px] font-semibold pr-10">
                     <li class="text-stone-600 hover:text-blue-600 hover:font-bold font-medium mx-4 my-1"><a
                                href="../home/home.php">Home</a></li>
                        <li class="text-stone-600 hover:text-blue-600 hover:font-bold font-medium mx-4 my-1"><a href="../dashboard/dashboard.php">
                                Dashboard</a></li>
                        <li class="text-stone-600 hover:text-blue-600 hover:font-bold font-medium mx-4 my-1"><a href="../home/clubs.php">Our
                                Clubs</a></li>
                        <li class="text-stone-600 hover:text-blue-600 hover:font-bold font-medium mx-4 my-1"><a
                                href="../home/event.php">Events</a></li>
                        <li class="text-stone-600 hover:text-blue-600 hover:font-bold font-medium mx-4 my-1"><a
                                href="contact.php">Contact</a></li>                     
                        <li class="text-stone-600 hover:text-blue-600 hover:font-bold font-medium mx-4 my-1"><a
                          href="../index.php">Sign out</a></li>
                                
                </div>
                
            </div>
           </div>
           <script src="https://cdn.tailwindcss.com"></script>
           <script src="https://use.fontawesome.com/03f8a0ebd4.js"></script>
           <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
           <script nomodule src="../images/logoIU.png"></script> 
    </div>
	<div  class="navbarheader navbarheader bg-[#082f49] text-white animate__animated animate__flipInX">
        <div class="flex justify-center ">
            <div class="self-center top-0 w-full max-w-7xl ">
                <div class="flex justify-between items-center text-gray-700">
                  
                    <ul class="hidden md:flex items-center text-[18px] font-semibold pr-10">
                        
                    <button type="button" class="text-stone-600 hover:text-blue-600 hover:font-bold font-medium mx-4 my-1"><a href="dashboard1.php"> Members</a></button>
                    <button type="button" class="text-stone-600 hover:text-blue-600 hover:font-bold font-medium mx-4 my-1"><a href="dashboard2.php"> Clubs</a></button>
                     <button type="button" class="text-stone-600 hover:text-blue-600 hover:font-bold font-medium mx-4 my-1"><a href="behavior.php"> Behavior Point</a></button>   
                    <hr>
                        <br>
                    
                    </ul> 
                    
                    <button class="block p-3 mx-10 md:hidden hover:bg-gray-200 rounded-xl group">
                        
                        <div class="w-5 my-[3px] h-[3px] bg-gray-600 mb-[2px]"></div>
                        <div class="w-5 my-[3px] h-[3px] bg-gray-600 mb-[2px]"></div>
                        <div class="w-5 my-[3px] h-[3px] bg-gray-600"></div>
                        <div
                            class="absolute top-0 -right-full opacity-0 h-screen w-[60%] border bg-white group-focus:right-0 group-focus:opacity-100 transition-all ease-in duration-300 ">
                            <ul class="flex flex-col items-center text-[18px] pt-[60px]">
                        <input type="button" value="MEMBERS" name="member" class="text-stone-600 hover:text-blue-600 hover:font-bold font-medium mx-4 my-1"/>
                        <input type="button" value="CLUBS" name="club" class="text-stone-600 hover:text-blue-600 hover:font-bold font-medium mx-4 my-1"/>
                                        
                              
                            </ul>
                        </div>
                    </button>
                </div>
                
            </div>
            
           </div>
           <script src="https://cdn.tailwindcss.com"></script>
           <script src="https://use.fontawesome.com/03f8a0ebd4.js"></script>
           <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
           <script nomodule src="../images/logoIU.png"></script> 
        </div>
    </div>
    <div class="flex justify-center">
             <?php
             include '../dbconnect.php';
                 include 'clubs.php';
                 
             ?>
             </div>
</body>
</html>