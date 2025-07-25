<?php

include '../dbconnect.php';
  
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $message = $_POST['message'];
  $query = "INSERT INTO `feedback` (`email`, `message`) VALUES ('$email', '$message')";
  
  if (mysqli_query($conn, $query)) {
    $noerror = "Message sent successfully";
  } else {
    $error = "Error: " . $query . "<br>" . mysqli_error($conn);
  }
}

mysqli_close($conn);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    
    <link rel="icon" href="../images/logoIU.png" />
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <title>Home</title>
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
                                href="home.php">Home</a></li>
                        <li class="text-stone-600 hover:text-blue-600 hover:font-bold font-medium mx-4 my-1"><a href="../dashboard/dashboard.php">
                                Dashboard</a></li>
                        <li class="text-stone-600 hover:text-blue-600 hover:font-bold font-medium mx-4 my-1"><a href="clubs.php">Our
                                Clubs</a></li>
                        <li class="text-stone-600 hover:text-blue-600 hover:font-bold font-medium mx-4 my-1"><a
                                href="event.php">Events</a></li>
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
           <script nomodule src="../images/aiet-logo.png"></script> 
    </div>

    <div class="posts animate__animated animate__fadeInUp">
        <div class="flex justify-center">
            <div class="flex flex-col justify-center">
                <div class="flex flex-col md:flex-row max-w-7xl justify-center items-center ">
                    <div class="overflow-hidden w-full m-4 shadow-sm flex flex-col md:flex-row justify-center">
                        <div class="flex flex-col md:flex-row items-center">
                            <div class=" w-full overflow-hidden"> <img class="animate__animated animate__fadeInUp" src="../images/IU.jpg" alt=""
                                    class="" /> </div>
                            <div class="md:w-2/3 m-4 ">
                                <div class="flex text-gray-500 text-sm m-2">
                                    <div class="m-1 font-bold"></div>
                                  
                                </div>
                                <div class="font-bold text-black text-xl m-2">NHIỀU THÀNH TỰU CHO CHẶNG ĐƯỜNG 20 NĂM THÀNH LẬP TRƯỜNG ĐẠI HỌC QUỐC TẾ</div>
                                <div class="text-sm text-gray-500 mt-4 m-2"><a href="#"> Sáng ngày 5/12/2023, trường Đại học Quốc tế – Đại học Quốc gia Thành phố Hồ Chí Minh (ĐHQT) long trọng tổ chức buổi lễ kỷ niệm 20 năm thành lập trường (5/12/2003-5/12/2023).

Trong buổi lễ, trường ĐHQT hân hạnh được đón chào các vị Nguyên lãnh đạo và lãnh đạo ĐHQG-HCM, lãnh đạo các trường thành viên khối ĐHQG-HCM, Nguyên lãnh đạo và lãnh đạo trường ĐHQT, đại diện các trường đại học đối tác của trường ĐHQT, đại diện Ban Giám đốc các doanh nghiệp đối tác, đại diện Ban Giám hiệu các trường THPT trên địa bàn thành phố và các tỉnh lân cận, cùng các vị khách quý và đội ngũ giảng viên, viên chức, người lao động và sinh viên trường đến tham gia.</a></div>
                                <div class="flex cursor-pointer">
                                   
                                    <div class="grid m-1">
                                        <div class="font-bold text-sm hover:text-gray-600 mt-2"><a href="https://hcmiu.edu.vn/nhieu-thanh-tuu-cho-chang-duong-20-nam-thanh-lap-truong-dai-hoc-quoc-te/">hcmiu.vn</a></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://use.fontawesome.com/03f8a0ebd4.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    </div>
    <div class="posts animate__animated animate__fadeInUp">
        <div class="flex justify-center">
            <div class="flex flex-col justify-center">
                <div class="flex flex-col md:flex-row max-w-7xl justify-center items-center ">
                    <div class="overflow-hidden w-full m-4 shadow-sm flex flex-col md:flex-row justify-center">
                        <div class="flex flex-col md:flex-row items-center">
                            <div class=" w-full overflow-hidden"> <img class="animate__animated animate__fadeInUp" src="../images/event1.jpg" alt=""
                                    class="" /> </div>
                            <div class="md:w-2/3 m-4 ">
                                <div class="flex text-gray-500 text-sm m-2">
                                 
                                </div>
                                <div class="font-bold text-black text-xl m-2">TIÊU CHÍ XÉT CHỌN “THANH NIÊN TIÊN TIẾN LÀM THEO LỜI BÁC” NĂM 2025</div>
                                <div class="text-sm text-gray-500 mt-4 m-2"><a href="#">
Danh hiệu “Thanh niên tiên tiến làm theo lời Bác” nhằm phát huy và vinh danh các cá nhân tiêu biểu trong  học tập và làm theo tư tưởng, đạo đức, phong cách đạo đức Chủ tịch Hồ Chí Minh; tạo hiệu ứng lan tỏa và ảnh hưởng tích cực đến Viên chức, Người lao động và Đoàn viên, Sinh viên toàn trường.
– Có thành tích tiêu biểu trong lao động, học tập, công tác, rèn luyện tại các địa phương, đơn vị:
+ Viên chức, người lao động phải được đánh giá ở mức hoàn thành tốt nhiệm vụ trở lên ở kỳ đánh giá gần nhất.
+ Sinh viên phải đạt học lực Khá trở lên trong 02 học kì gần nhất.
– Tích cực tham gia các hoạt động Đoàn, Hội, Đội, Nhóm; có uy tín và ảnh hưởng tốt trong đoàn viên, thanh thiếu niên; được cấp ủy, lãnh đạo đơn vị ghi nhận.
– Thành tích xét từ 01 tháng 6 năm 2024 đến 10 tháng 5 năm 2025.
– Tính tới thời điểm xét tuyên dương, cá nhân không quá 35 tuổi.

* Ưu tiên đối với cá nhân là cán bộ Đoàn – Hội; khuyến khích các gương tuyên dương là “Cán bộ Đoàn – Hội tiêu biểu”, “Cán bộ trẻ biểu cấp ĐHQG”, “Sinh viên 5 tốt” các năm trước, các cá nhân đạt giải thưởng cao trong các kỳ thi cấp thành, quốc gia, quốc tế trong các lĩnh vực…</a></div>
                                <div class="flex cursor-pointer">
                                  
                                    <div class="grid m-1">
                                        <div class="font-bold text-sm hover:text-gray-600 mt-2"><a href="https://iuyouth.edu.vn/tnttltlb2025/"></a>tnttltlb2025.com</div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://use.fontawesome.com/03f8a0ebd4.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    </div>
    <div class="posts animate__animated animate__fadeInUp">
        <div class="flex justify-center">
            <div class="flex flex-col justify-center">
                <div class="flex flex-col md:flex-row max-w-7xl justify-center items-center ">
                    <div class="overflow-hidden w-full m-4 shadow-sm flex flex-col md:flex-row justify-center">
                        <div class="flex flex-col md:flex-row items-center">
                            <div class=" w-full overflow-hidden"> <img class="animate__animated animate__fadeInUp" src="../images/event2.jpg" alt=""
                                    class="" /> </div>
                            <div class="md:w-2/3 m-4 ">
                                <div class="flex text-gray-500 text-sm m-2">
                                  
                                </div>
                                <div class="font-bold text-black text-xl m-2">[EE] CAMPING TRIP 2025</div>
                                <div class="text-sm text-gray-500 mt-4 m-2"><a href="#">Sau một thời gian dài gián đoạn bởi ảnh hưởng của dịch bệnh, chương trình dã ngoại truyền thống EE Camping 2025 đã chính thức quay trở lại, đánh dấu một bước ngoặt giàu cảm xúc và tràn đầy năng lượng. Tại Dambri, Lâm Đồng, EE Camping Trip 2025 đã diễn ra vô cùng tốt đẹp trong ngày 19-20/4/2025 cùng với sự nhiệt huyết của các bạn sinh viên trường đại học Quốc Tế-ĐHQG.Với chủ đề “Phượng hoàng lửa tái sinh”, hành trình năm nay không chỉ đơn thuần là một sự kiện dã ngoại mà còn là biểu tượng của sự hồi sinh, tái kết nối và khơi dậy tinh thần tuổi trẻ sau những tháng ngày bị kìm hãm. Trong hai ngày diễn ra tại khu du lịch Dambri, các sinh viên ở các khoa đã cùng nhau tham gia vào chuỗi hoạt động ý nghĩa – từ các trò chơi tập thể sôi động, teambuilding thử thách, cho đến đêm nhạc Rock & Roll và EDM rực lửa. Mỗi hoạt động không chỉ khơi dậy cảm xúc mãnh liệt mà còn là cơ hội để mỗi người khám phá lại bản thân, vượt qua giới hạn và cùng nhau viết nên những chương mới của thời thanh xuân. Tại đây, mọi người sẽ có thêm cơ hội gắn kết với nhau, cùng nhau đoàn kết vượt qua các thử thách ở các trạm để đưa đội mình đến đích chiến thắng. Hơn thế nữa, các bạn sinh viên có thể ngồi lại thưởng thức tiệc nướng BBQ hoành tráng và giao lưu gần gũi hơn cùng nhau, kết thêm bạn mới trong hành trình thanh xuân rực rỡ. Ánh lửa trại bập bùng giữa rừng núi Dambri không chỉ soi sáng khuôn mặt rạng rỡ của từng thành viên, mà còn thắp lên một biểu tượng tinh thần: phượng hoàng lửa – tái sinh từ tro tàn, vươn lên mạnh mẽ hơn, rực rỡ hơn.


                                </a></div>
                                <div class="flex cursor-pointer">
                                  
                                    <div class="grid m-1">
                                        <div class="font-bold text-sm hover:text-gray-600 mt-2"><a href="https://iuyouth.edu.vn/ee-camping-trip-2025/">EE Camping Trip 2025.com</a></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://use.fontawesome.com/03f8a0ebd4.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    </div>
    <div class="posts animate__animated animate__fadeInUp">
        <div class="flex justify-center">
            <div class="flex flex-col justify-center">
                <div class="flex flex-col md:flex-row max-w-7xl justify-center items-center ">
                    <div class="overflow-hidden w-full m-4 shadow-sm flex flex-col md:flex-row justify-center">
                        <div class="flex flex-col md:flex-row items-center">
                            <div class=" w-full overflow-hidden"> <img class="animate__animated animate__fadeInUp" src="../images/event5.jpg" alt=""
                                    class="" /> </div>
                            <div class="md:w-2/3 m-4 ">
                                <div class="flex text-gray-500 text-sm m-2">
                                   
                                </div>
                                <div class="font-bold text-black text-xl m-2">CUỘC THI MISTER & MISS ÁO DÀI 2025</div>
                                <div class="text-sm text-gray-500 mt-4 m-2"><a href="#">Cuộc thi Mr & Miss Áo dài 2025 là sân chơi văn hóa – nghệ thuật dành cho viên chức – người lao động và sinh viên đang công tác, học tập tại Trường Đại học Quốc tế – ĐHQG TP.HCM, nhằm tôn vinh vẻ đẹp truyền thống của tà áo dài Việt Nam và tạo cơ hội thể hiện phong thái, bản lĩnh cá nhân. Đối tượng dự thi
– Bảng A: viên chức – người lao động
– Bảng B: sinh viên đang học tập tại trường
Các mốc thời gian: 
– Thời gian đăng ký: Từ 14/04/2025 đến hết ngày 25/04/2025
– Vòng sơ khảo: 27/04/2025 – 06/05/2025
– Vòng Chung khảo: dự kiến 08/05/2025 – 16/05/2025  </a></div>
                                <div class="flex cursor-pointer">
                                   
                                    <div class="grid m-1">
                                        <div class="font-bold text-sm hover:text-gray-600 mt-2"><a href="https://iuyouth.edu.vn/cuoc-thi-mister-miss-ao-dai-2025/">misster.vn</a></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://use.fontawesome.com/03f8a0ebd4.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    </div>
    

</body>
</html>