<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../userlogin.php");
    exit();
}

include '../dbconnect.php';

$email = $_SESSION['email'];
$query = "SELECT name, avatar, interests FROM members WHERE email = '$email'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Tách danh sách sở thích đã chọn
$interests_arr = isset($user['interests']) ? array_map('trim', explode(',', $user['interests'])) : [];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Hobby?</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-100">
  <div class="flex items-center justify-center min-h-screen">
    <div class="flex bg-white shadow-lg rounded-3xl overflow-hidden w-4/5">
      <!-- LEFT: Avatar -->
      <div class="w-1/2 p-6 flex items-center justify-center bg-gradient-to-bl from-orange-300 via-white to-blue-300">
       


      </div>

      <!-- RIGHT: Form -->
      <div class="w-1/2 p-10">
        <h1 class="text-4xl font-bold mb-2">Xin chào,</h1>
        <h2 class="text-4xl font-bold mb-6">mình là <?php echo htmlspecialchars($user['name']); ?>.</h2>
        <form action="save_interests.php" method="POST">
         <?php
$all_interests = ['tình nguyện', 'học thuật', 'giải trí', 'nghệ thuật', 'lịch sử', 'thể thao', 'kỹ năng mềm', 'kịch nói'];
foreach ($all_interests as $tag):
  $checked = in_array($tag, $interests_arr) ? 'checked' : '';
?>
  <div class="mb-3">
    <label class="inline-flex items-center space-x-3">
      <input type="checkbox" name="interests[]" value="<?= $tag ?>" <?= $checked ?>
        class="form-checkbox h-5 w-5 text-blue-600">
      <span class="text-lg text-gray-800"><?= ucfirst($tag) ?></span>
    </label>
  </div>
<?php endforeach; ?>

          
          <button type="submit"
            class="bg-blue-600 hover:bg-blue-800 text-white font-semibold px-6 py-2 rounded-lg mt-4">
            Lưu sở thích
          </button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
