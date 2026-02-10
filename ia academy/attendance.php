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
$today = date('Y-m-d');

// Capture search term
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ia Academy | Attendance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="flex bg-[#0f172a]">
    <?php include('sidebar.php'); ?>
    
    <main class="flex-1 ml-64 p-10">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h1 class="text-3xl font-black uppercase text-white tracking-tighter">Daily Attendance</h1>
                <p class="text-blue-400 text-[10px] font-bold uppercase tracking-widest mb-4">Today: <?php echo date('M d, Y'); ?></p>
                
                <form action="attendance.php" method="GET" class="flex gap-2">
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                           placeholder="Search student name..." 
                           class="bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white text-sm w-64 outline-none focus:border-blue-500">
                    <button type="submit" class="bg-blue-600 px-4 py-2 rounded-xl text-white text-[10px] font-black uppercase">Filter</button>
                    <?php if($search): ?>
                        <a href="attendance.php" class="text-slate-500 text-[10px] font-bold uppercase flex items-center px-2">Clear</a>
                    <?php endif; ?>
                </form>
            </div>
            <a href="attendance-history.php" class="bg-white/5 border border-white/10 px-6 py-3 rounded-xl text-white text-[10px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">
                View Full History →
            </a>
        </div>

        <div class="glass-card overflow-hidden bg-white/5 border border-white/10 rounded-2xl">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-slate-400 text-[10px] font-black uppercase">
                    <tr>
                        <th class="p-5">Student Name</th>
                        <th class="p-5 text-right">Today's Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
    <?php 
    // Query remains the same, fetching student info + today's attendance status
    $sql = "SELECT s.id, s.firstName, s.lastName, a.status 
            FROM students s 
            LEFT JOIN attendance a ON s.id = a.student_id AND a.date = '$today'
            WHERE s.firstName LIKE '%$search%' OR s.lastName LIKE '%$search%'";
    
    $res = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_assoc($res)): ?>
    <tr class="hover:bg-white/5 transition-all">
        <td class="p-5 font-bold text-white text-sm">
            <?php echo htmlspecialchars($row['firstName'] . " " . $row['lastName']); ?>
        </td>
        <td class="p-5 text-right">
            <?php if($row['status']): ?>
                <div class="flex justify-end items-center gap-4">
                    <span class="px-4 py-2 rounded-lg text-[10px] font-black uppercase <?php echo $row['status'] == 'Present' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-red-500/20 text-red-400'; ?>">
                        <?php echo $row['status']; ?>
                    </span>
                    
                    <form action="save-attendance.php" method="POST" class="inline">
                        <input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="edit_attendance" class="text-slate-500 hover:text-white text-[10px] font-bold uppercase tracking-widest border-b border-slate-700 hover:border-white transition-all">
                            Edit
                        </button>
                    </form>
                </div>
            <?php else: ?>
                <div class="flex justify-end gap-2">
                    <form action="save-attendance.php" method="POST" class="inline">
                        <input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="status" value="Present">
                        <button type="submit" name="mark_attendance" class="bg-emerald-600 hover:bg-emerald-500 px-4 py-2 rounded-lg text-[10px] font-black text-white transition-all">PRESENT</button>
                    </form>
                    <form action="save-attendance.php" method="POST" class="inline">
                        <input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="status" value="Absent">
                        <button type="submit" name="mark_attendance" class="bg-red-600 hover:bg-red-500 px-4 py-2 rounded-lg text-[10px] font-black text-white transition-all">ABSENT</button>
                    </form>
                </div>
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</tbody>
            </table>
        </div>
    </main>
</body>
</html>