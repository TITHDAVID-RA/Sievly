<?php 
include('db.php'); 
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ia Academy | Attendance History</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="flex bg-[#0f172a]">
    <?php include('sidebar.php'); ?>
    <main class="flex-1 ml-64 p-10">
        <div class="flex justify-between items-end mb-10">
            <h1 class="text-3xl font-black uppercase text-white tracking-tighter">Attendance History</h1>
            
            <form action="attendance-history.php" method="GET" class="flex gap-2">
                <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                       placeholder="Search name or date (YYYY-MM-DD)..." 
                       class="bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white text-sm w-72 outline-none focus:border-blue-500">
                <button type="submit" class="bg-blue-600 px-4 py-2 rounded-xl text-white text-[10px] font-black uppercase">Search</button>
            </form>
        </div>
        
        <div class="glass-card overflow-hidden bg-white/5 border border-white/10 rounded-2xl">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-slate-400 text-[10px] font-black uppercase">
                    <tr>
                        <th class="p-5">Date</th>
                        <th class="p-5">Student</th>
                        <th class="p-5">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 text-slate-300 text-sm">
                    <?php 
                    $sql = "SELECT a.date, a.status, s.firstName, s.lastName 
                            FROM attendance a 
                            JOIN students s ON a.student_id = s.id 
                            WHERE s.firstName LIKE '%$search%' 
                            OR s.lastName LIKE '%$search%' 
                            OR a.date LIKE '%$search%'
                            ORDER BY a.date DESC";
                    
                    $res = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($res)): ?>
                    <tr>
                        <td class="p-5 font-mono text-xs"><?php echo $row['date']; ?></td>
                        <td class="p-5 font-bold text-white"><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
                        <td class="p-5">
                            <span class="px-3 py-1 rounded text-[10px] font-black uppercase <?php echo $row['status'] == 'Present' ? 'text-emerald-400' : 'text-red-400'; ?>">
                                <?php echo $row['status']; ?>
                            </span>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>