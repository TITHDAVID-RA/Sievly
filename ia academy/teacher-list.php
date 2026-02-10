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

// 1. Capture the search term from the URL
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// 2. Build the dynamic SQL query to filter teachers
if ($search != '') {
    // Searches by Full Name, Subject, or Qualification
    $query = "SELECT * FROM teachers WHERE 
              fullName LIKE '%$search%' OR 
              subject LIKE '%$search%' OR 
              qualification LIKE '%$search%' 
              ORDER BY id DESC";
} else {
    $query = "SELECT * FROM teachers ORDER BY id DESC";
}
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ia Academy | Faculty Directory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="flex bg-[#0f172a]">
    <?php include('sidebar.php'); ?>

    <main class="flex-1 ml-64 p-10">
        <?php if (isset($_GET['success'])): ?>
            <div id="alert-box" class="mb-8 flex items-center justify-between p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl">
                <p class="text-emerald-400 text-xs font-black uppercase tracking-widest">
                    ✨ <?php echo ($_GET['success'] == 'saved') ? "Faculty record saved successfully" : "System update completed"; ?>
                </p>
                <button onclick="this.parentElement.remove()" class="text-emerald-400 text-xs font-bold">✕</button>
            </div>
        <?php endif; ?>

        <div class="flex justify-between items-end mb-10">
            <div>
                <h1 class="text-3xl font-black uppercase tracking-tighter text-white">Faculty Members</h1>
                
                <form action="teacher-list.php" method="GET" class="flex gap-2 mt-4">
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                           placeholder="Search name, subject, or degree..." 
                           class="bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white text-sm w-72 outline-none focus:border-blue-500">
                    <button type="submit" class="bg-blue-600 px-6 py-2 rounded-xl text-white text-xs font-bold uppercase hover:bg-blue-700 transition-all">Filter</button>
                    <?php if($search != ''): ?>
                        <a href="teacher-list.php" class="bg-white/10 px-4 py-2 rounded-xl text-white text-xs font-bold uppercase flex items-center">Reset</a>
                    <?php endif; ?>
                </form>
            </div>
            
            <a href="add-teacher.php" class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-xl font-black text-xs text-white uppercase tracking-widest transition-all shadow-lg shadow-blue-600/20">
                + Add Teacher
            </a>
        </div>

        <div class="glass-card overflow-hidden bg-white/5 border border-white/10 rounded-2xl">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                    <tr>
                       <th class="p-5">Name & Qualification</th> 
                       <th class="p-5">Subject</th> 
                       <th class="p-5">Grade</th> 
                       <th class="p-5">Email / Contact</th> 
                       <th class="p-5 text-right">Actions</th> 
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?> 
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="p-5">
                                <div class="font-bold text-white"><?php echo htmlspecialchars($row['fullName']); ?></div> 
                                <div class="text-[10px] text-slate-500 uppercase font-bold"><?php echo htmlspecialchars($row['qualification'] ?? 'Faculty'); ?></div>
                            </td> 
                            <td class="p-5 text-slate-400"><?php echo htmlspecialchars($row['subject']); ?></td> 
                            <td class="p-5 text-slate-400">Class <?php echo htmlspecialchars($row['class']); ?></td> 
                            <td class="p-5">
                                <div class="text-white text-xs"><?php echo htmlspecialchars($row['email'] ?? 'N/A'); ?></div>
                                <div class="text-slate-500 text-[10px]"><?php echo htmlspecialchars($row['phone']); ?></div> 
                            </td> 
                            <td class="p-5 text-right space-x-2">
                                <a href="view-teacher.php?id=<?php echo $row['id']; ?>" class="text-blue-400 text-[10px] font-black uppercase hover:underline">View</a> 
                                <a href="edit-teacher.php?id=<?php echo $row['id']; ?>" class="text-emerald-500 text-[10px] font-black uppercase hover:underline">Edit</a> 
                                <a href="delete-teacher.php?id=<?php echo $row['id']; ?>" 
                                   onclick="return confirm('Remove this faculty member?');" 
                                   class="text-red-500 text-[10px] font-black uppercase hover:underline">Delete</a> 
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="p-10 text-center text-slate-500 text-sm uppercase font-bold tracking-widest">No faculty found matching "<?php echo htmlspecialchars($search); ?>"</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>