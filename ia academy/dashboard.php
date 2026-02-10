<?php 
session_start();

// 1. Prevent Browser Caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// 2. Security Gatekeeper
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();

}
include('db.php');

// 1. General Stats
$student_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM students"))['total'];
$teacher_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM teachers"))['total'];

// 2. Fetch Grades, Student Counts, and the Teacher assigned to that class
// We use a LEFT JOIN to ensure the Grade shows up even if no teacher is assigned yet
$class_query = "SELECT 
                    s.grade, 
                    COUNT(s.id) as student_total, 
                    t.fullName as teacher_name,
                    t.subject as teacher_subject
                FROM students s
                LEFT JOIN teachers t ON s.grade = t.class
                GROUP BY s.grade
                ORDER BY s.grade ASC";

$class_result = mysqli_query($conn, $class_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EMS | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="flex items-start justify-start bg-[#0f172a]">
    <?php include('sidebar.php'); ?>
    
    <main class="flex-1 p-10 ml-64">
        <h1 class="text-4xl font-black uppercase tracking-tighter text-white">System Overview</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
            <div class="p-6 bg-white/5 border border-white/10 rounded-2xl">
                <p class="text-blue-400 text-[10px] font-black uppercase tracking-widest">Total Students</p>
                <h3 class="text-4xl font-black text-white mt-2"><?php echo $student_count; ?></h3>
            </div>
            <div class="p-6 bg-white/5 border border-white/10 rounded-2xl text-right">
                <p class="text-emerald-400 text-[10px] font-black uppercase tracking-widest">Faculty Count</p>
                <h3 class="text-4xl font-black text-white mt-2"><?php echo $teacher_count; ?></h3>
            </div>
        </div>

        <h2 class="text-xl font-black uppercase tracking-tighter text-white mt-12 mb-6">Classroom Status</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php while($row = mysqli_fetch_assoc($class_result)): ?>
                <div class="p-6 bg-white/5 border border-white/10 rounded-3xl flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <span class="bg-blue-600 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase">Grade <?php echo $row['grade']; ?></span>
                            <span class="text-slate-500 text-[10px] font-bold uppercase"><?php echo $row['student_total']; ?> Students</span>
                        </div>
                        
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Class Teacher</p>
                        <h4 class="text-lg font-bold text-white mt-1">
                            <?php echo $row['teacher_name'] ? htmlspecialchars($row['teacher_name']) : '<span class="text-red-500/50 italic">Unassigned</span>'; ?>
                        </h4>
                        <p class="text-xs text-slate-500"><?php echo htmlspecialchars($row['teacher_subject'] ?? 'No Subject'); ?></p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-white/5 flex gap-3">
                        <a href="student-list.php?search=<?php echo $row['grade']; ?>" class="flex-1 text-center bg-white/5 hover:bg-white/10 py-2 rounded-xl text-[10px] text-white font-black uppercase tracking-widest transition-all">
                            Students
                        </a>
                        <a href="teacher-list.php?search=<?php echo $row['grade']; ?>" class="flex-1 text-center bg-blue-600/10 hover:bg-blue-600/20 py-2 rounded-xl text-[10px] text-blue-400 font-black uppercase tracking-widest transition-all">
                            Teacher
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </main>
</body>
</html>