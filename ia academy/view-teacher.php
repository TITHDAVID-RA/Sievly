<?php 
include('db.php');
if(!isset($_GET['id'])) { header("Location: teacher-list.php"); exit(); }

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = "SELECT * FROM teachers WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$teacher = mysqli_fetch_assoc($result);

if(!$teacher) { echo "Teacher not found."; exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ia Academy | Faculty Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="flex bg-[#0f172a]">
    <?php include('sidebar.php'); ?>

    <main class="flex-1 ml-64 p-10">
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-black uppercase tracking-tighter text-white">Faculty Profile</h1>
            <a href="teacher-list.php" class="text-slate-400 text-xs font-bold hover:text-white transition-all">← BACK TO LIST</a>
        </div>

        <div class="max-w-4xl">
            <div class="glass-card p-10 space-y-8 bg-white/5 border border-white/10 rounded-3xl shadow-2xl text-white">
                
                <div class="border-b border-white/10 pb-6">
                    <p class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-1">Full Name</p>
                    <h2 class="text-4xl font-black uppercase tracking-tighter"><?php echo htmlspecialchars($teacher['fullName']); ?></h2>
                </div>

                <div class="grid grid-cols-3 gap-8">
                    <div class="space-y-6">
                        <div>
                            <p class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-1">Assigned Subject</p>
                            <p class="font-bold"><?php echo htmlspecialchars($teacher['subject']); ?></p>
                        </div>
                        <div>
                            <p class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-1">Assigned Class</p>
                            <p class="font-bold">Grade <?php echo htmlspecialchars($teacher['class']); ?></p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <p class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-1">Email Address</p>
                            <p class="font-bold"><?php echo htmlspecialchars($teacher['email'] ?? 'N/A'); ?></p>
                        </div>
                        <div>
                            <p class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-1">Contact Number</p>
                            <p class="font-bold"><?php echo htmlspecialchars($teacher['phone']); ?></p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <p class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-1">Joining Date</p>
                            <p class="font-bold"><?php echo htmlspecialchars($teacher['joiningDate'] ?? 'N/A'); ?></p>
                        </div>
                        <div>
                            <p class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-1">National ID</p>
                            <p class="font-bold"><?php echo htmlspecialchars($teacher['nationalId'] ?? 'N/A'); ?></p>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-white/10">
                    <p class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-1">Qualification / Education</p>
                    <p class="font-bold text-lg"><?php echo htmlspecialchars($teacher['qualification'] ?? 'Not Specified'); ?></p>
                </div>

                <div class="pt-6 flex gap-4">
                    <a href="edit-teacher.php?id=<?php echo $teacher['id']; ?>" class="flex-1 bg-blue-600 hover:bg-blue-700 py-4 rounded-xl font-black uppercase text-xs text-center tracking-widest transition-all">
                        Edit Full Profile
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>