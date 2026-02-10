<?php 
include('db.php');
$id = mysqli_real_escape_string($conn, $_GET['id']);
$record = mysqli_query($conn, "SELECT * FROM teachers WHERE id = '$id'");
$teacher = mysqli_fetch_assoc($record);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ia Academy | Edit Full Faculty Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="p-10 bg-[#0f172a]">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-black uppercase tracking-tighter text-white mb-8">Edit Faculty Details</h2>

        <form action="save-data.php" method="POST" class="space-y-6">
            <input type="hidden" name="teacher_id" value="<?php echo $teacher['id']; ?>">

            <div class="glass-card p-8 space-y-6 bg-white/5 border border-white/10 rounded-2xl">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Full Name</label>
                        <input type="text" name="fullName" value="<?php echo htmlspecialchars($teacher['fullName']); ?>" class="w-full p-4 rounded-xl text-white bg-slate-900/50 border border-white/10" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Email Address</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($teacher['email'] ?? ''); ?>" class="w-full p-4 rounded-xl text-white bg-slate-900/50 border border-white/10">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Phone Number</label>
                        <input type="tel" name="phone" value="<?php echo htmlspecialchars($teacher['phone']); ?>" class="w-full p-4 rounded-xl text-white bg-slate-900/50 border border-white/10">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">National ID</label>
                        <input type="text" name="nationalId" value="<?php echo htmlspecialchars($teacher['nationalId'] ?? ''); ?>" class="w-full p-4 rounded-xl text-white bg-slate-900/50 border border-white/10">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Subject</label>
                        <select name="subject" class="w-full p-4 rounded-xl text-slate-400 bg-slate-900/50 border border-white/10">
                            <?php $subjs = ["Mathematics", "Science", "English", "History", "Computer Science"]; 
                            foreach($subjs as $s) {
                                $sel = ($teacher['subject'] == $s) ? 'selected' : '';
                                echo "<option value='$s' $sel>$s</option>";
                            } ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Class</label>
                        <select name="class" class="w-full p-4 rounded-xl text-slate-400 bg-slate-900/50 border border-white/10">
                            <?php for($i=1; $i<=12; $i++) {
                                $val = str_pad($i, 2, "0", STR_PAD_LEFT);
                                $sel = ($teacher['class'] == $val) ? 'selected' : '';
                                echo "<option value='$val' $sel>Grade $val</option>";
                            } ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Joining Date</label>
                        <input type="date" name="joiningDate" value="<?php echo $teacher['joiningDate'] ?? ''; ?>" class="w-full p-4 rounded-xl text-white bg-slate-900/50 border border-white/10">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Qualification</label>
                        <input type="text" name="qualification" value="<?php echo htmlspecialchars($teacher['qualification'] ?? ''); ?>" class="w-full p-4 rounded-xl text-white bg-slate-900/50 border border-white/10">
                    </div>
                </div>
            </div>

            <button type="submit" name="update_teacher_full" class="w-full bg-blue-600 py-5 rounded-2xl font-black uppercase text-white shadow-xl shadow-blue-600/20 transition-all">
                Update Full Faculty Record
            </button>
        </form>
    </div>
</body>
</html>