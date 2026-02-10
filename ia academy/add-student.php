<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ia Academy | Student Enrollment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="p-10 bg-[#0f172a]">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-black uppercase tracking-tighter text-white">Student Enrollment</h2>
                <p class="text-blue-400 text-[10px] font-bold uppercase tracking-widest">Register New Student Profile</p>
            </div>
            <a href="student-list.php" class="text-slate-400 text-xs font-bold hover:text-white transition-all">← GO BACK</a>
        </div>

        <form action="save-data.php" method="POST" class="space-y-6">
            
            <div class="glass-card p-8 space-y-4 bg-white/5 border border-white/10 rounded-2xl">
                <h3 class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Step 1: Personal Information</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">First Name</label>
                        <input type="text" name="firstName" placeholder="First Name" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 outline-none focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Last Name</label>
                        <input type="text" name="lastName" placeholder="Last Name" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 outline-none focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Nationality</label>
                        <input type="text" name="nation" placeholder="e.g. Cambodian" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Student Phone (Optional)</label>
                        <input type="tel" name="studentPhone" placeholder="+855..." class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 outline-none focus:border-blue-500">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Home Address</label>
                    <input type="text" name="address" placeholder="Current residential address" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="glass-card p-8 space-y-4 bg-white/5 border border-white/10 rounded-2xl">
                <h3 class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Step 2: Parent / Guardian Details</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Guardian Name</label>
                        <input type="text" name="parentName" placeholder="Full Name" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Relationship</label>
                        <input type="text" name="relationship" placeholder="e.g. Father, Mother" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Emergency Contact</label>
                        <input type="tel" name="parentContact" placeholder="Phone Number" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Guardian Email</label>
                        <input type="email" name="parentEmail" placeholder="email@example.com" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 outline-none focus:border-blue-500">
                    </div>
                </div>
            </div>

            <div class="glass-card p-8 space-y-4 bg-white/5 border border-white/10 rounded-2xl">
                <h3 class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Step 3: Academic Background</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Enrollment Grade</label>
                        <select name="grade" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 outline-none focus:border-blue-500">
                            <?php for($i=1; $i<=12; $i++) {
                                $val = str_pad($i, 2, "0", STR_PAD_LEFT);
                                echo "<option value='$val'>Grade $val</option>";
                            } ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Previous School</label>
                        <input type="text" name="prevSchool" placeholder="Name of last school attended" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 outline-none focus:border-blue-500">
                    </div>
                </div>
            </div>

            <button type="submit" name="add_student_full" class="w-full bg-blue-600 hover:bg-blue-700 py-5 rounded-2xl font-black uppercase text-sm text-white tracking-widest shadow-xl shadow-blue-600/20 transition-all transform active:scale-95">
                Complete Student Enrollment
            </button>
        </form>
    </div>
</body>
</html>