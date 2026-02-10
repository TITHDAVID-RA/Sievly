<?php 
include('db.php');
if(!isset($_GET['id'])) { header("Location: student-list.php"); exit(); }

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = "SELECT * FROM students WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);

if(!$student) { echo "Student not found."; exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ia Academy | Student Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="flex bg-[#0f172a]">
    <?php include('sidebar.php'); ?>

    <main class="flex-1 ml-64 p-10">
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-black uppercase tracking-tighter text-white">Student Profile</h1>
            <a href="student-list.php" class="text-slate-400 text-xs font-bold hover:text-white transition-all">← BACK TO LIST</a>
        </div>

        <div class="max-w-4xl grid grid-cols-3 gap-6">
            <div class="col-span-2 space-y-6">
                <div class="glass-card p-10 bg-white/5 border border-white/10 rounded-3xl text-white">
                    <p class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-1">Full Name</p>
                    <h2 class="text-4xl font-black uppercase mb-8"><?php echo htmlspecialchars($student['firstName'] . ' ' . $student['lastName']); ?></h2>
                    
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <p class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-1">Nationality</p>
                            <p class="font-bold"><?php echo htmlspecialchars($student['nation'] ?? 'N/A'); ?></p>
                        </div>
                        <div>
                            <p class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-1">Home Address</p>
                            <p class="font-bold text-sm"><?php echo htmlspecialchars($student['address'] ?? 'N/A'); ?></p>
                        </div>
                    </div>
                </div>

                <div class="glass-card p-10 bg-white/5 border border-white/10 rounded-3xl text-white">
                    <h3 class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-6 border-b border-white/5 pb-2">Guardian Information</h3>
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <p class="text-slate-400 text-[10px] uppercase font-bold mb-1">Name</p>
                            <p class="font-bold"><?php echo htmlspecialchars($student['parentName'] ?? 'N/A'); ?> (<?php echo htmlspecialchars($student['relationship'] ?? 'Guardian'); ?>)</p>
                        </div>
                        <div>
                            <p class="text-slate-400 text-[10px] uppercase font-bold mb-1">Emergency Contact</p>
                            <p class="font-bold"><?php echo htmlspecialchars($student['parentContact'] ?? 'N/A'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="glass-card p-8 bg-blue-600 rounded-3xl text-white text-center">
                    <p class="text-blue-200 text-[10px] font-black uppercase tracking-widest mb-2">Current Grade</p>
                    <h4 class="text-6xl font-black">G<?php echo htmlspecialchars($student['grade']); ?></h4>
                </div>
                <div class="glass-card p-8 bg-white/5 border border-white/10 rounded-3xl text-white">
                    <p class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-2">Previous School</p>
                    <p class="font-bold text-sm"><?php echo htmlspecialchars($student['prevSchool'] ?? 'First Enrollment'); ?></p>
                </div>
                <a href="edit-student.php?id=<?php echo $student['id']; ?>" class="block w-full bg-white/10 hover:bg-white/20 py-4 rounded-xl text-white font-black uppercase text-xs text-center tracking-widest transition-all">
                    Edit Profile
                </a>
            </div>
        </div>
    </main>
</body>
</html>