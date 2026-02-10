<?php 
include('db.php');
if(!isset($_GET['id'])) { header("Location: student-list.php"); exit(); }

$id = mysqli_real_escape_string($conn, $_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM students WHERE id = '$id'");
$student = mysqli_fetch_assoc($result);

if(!$student) { echo "Student not found."; exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ia Academy | Edit Full Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="p-10 bg-[#0f172a]">
    <div class="max-w-4xl mx-auto text-white">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-black uppercase tracking-tighter">Edit Student Profile</h2>
                <p class="text-blue-400 text-[10px] font-bold uppercase tracking-widest">Updating: <?php echo htmlspecialchars($student['firstName'] . ' ' . $student['lastName']); ?></p>
            </div>
            <a href="student-list.php" class="text-slate-400 text-xs font-bold hover:text-white transition-all">← CANCEL</a>
        </div>

        <form action="save-data.php" method="POST" class="space-y-6">
            <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
            
            <div class="glass-card p-8 space-y-4 bg-white/5 border border-white/10 rounded-2xl">
                <h3 class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Step 1: Personal Info</h3>
                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="firstName" value="<?php echo htmlspecialchars($student['firstName']); ?>" placeholder="First Name" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10" required>
                    <input type="text" name="lastName" value="<?php echo htmlspecialchars($student['lastName']); ?>" placeholder="Last Name" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10" required>
                    <input type="text" name="nation" value="<?php echo htmlspecialchars($student['nation'] ?? ''); ?>" placeholder="Nationality" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10">
                    <input type="tel" name="studentPhone" value="<?php echo htmlspecialchars($student['studentPhone'] ?? ''); ?>" placeholder="Student Phone" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10">
                </div>
                <input type="text" name="address" value="<?php echo htmlspecialchars($student['address'] ?? ''); ?>" placeholder="Home Address" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10">
            </div>

            <div class="glass-card p-8 space-y-4 bg-white/5 border border-white/10 rounded-2xl">
                <h3 class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Step 2: Guardian Details</h3>
                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="parentName" value="<?php echo htmlspecialchars($student['parentName'] ?? ''); ?>" placeholder="Guardian Name" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10">
                    <input type="text" name="relationship" value="<?php echo htmlspecialchars($student['relationship'] ?? ''); ?>" placeholder="Relationship" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10">
                    <input type="tel" name="parentContact" value="<?php echo htmlspecialchars($student['parentContact'] ?? ''); ?>" placeholder="Emergency Contact" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10">
                    <input type="email" name="parentEmail" value="<?php echo htmlspecialchars($student['parentEmail'] ?? ''); ?>" placeholder="Guardian Email" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10">
                </div>
            </div>

            <div class="glass-card p-8 space-y-4 bg-white/5 border border-white/10 rounded-2xl">
                <h3 class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Step 3: Academic History</h3>
                <div class="grid grid-cols-2 gap-4">
                    <select name="grade" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 outline-none">
                        <?php for($i=1; $i<=12; $i++) {
                            $val = str_pad($i, 2, "0", STR_PAD_LEFT);
                            $sel = ($student['grade'] == $val) ? 'selected' : '';
                            echo "<option value='$val' $sel>Grade $val</option>";
                        } ?>
                    </select>
                    <input type="text" name="prevSchool" value="<?php echo htmlspecialchars($student['prevSchool'] ?? ''); ?>" placeholder="Previous School" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10">
                </div>
            </div>

            <button type="submit" name="update_student_full" class="w-full bg-blue-600 hover:bg-blue-700 py-5 rounded-2xl font-black uppercase text-sm text-white tracking-widest shadow-xl shadow-blue-600/20 transition-all">
                Update Full Student Record
            </button>
        </form>
    </div>
</body>
</html>