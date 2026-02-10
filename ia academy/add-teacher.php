<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ia Academy | Faculty Enrollment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="p-10 bg-[#0f172a]">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-black uppercase tracking-tighter text-white">Faculty Enrollment</h2>
                <p class="text-blue-400 text-[10px] font-bold uppercase tracking-widest">Register New Staff Member</p>
            </div>
            <a href="teacher-list.php" class="text-slate-400 text-xs font-bold hover:text-white transition-all">← GO BACK</a>
        </div>

        <form action="save-data.php" method="POST" class="space-y-6">
            
            <div class="glass-card p-8 space-y-4 bg-white/5 border border-white/10 rounded-2xl">
                <h3 class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Step 1: Personal & Contact</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Full Name</label>
                        <input type="text" name="fullName" placeholder="e.g. Dr. Alexander Smith" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 focus:border-blue-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Email Address</label>
                        <input type="email" name="email" placeholder="staff@ia-academy.com" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 focus:border-blue-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Primary Phone</label>
                        <input type="tel" name="phone" placeholder="+00 123 456 789" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 focus:border-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">National ID / Passport</label>
                        <input type="text" name="nationalId" placeholder="ID Number" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 focus:border-blue-500 outline-none">
                    </div>
                </div>
            </div>

            <div class="glass-card p-8 space-y-4 bg-white/5 border border-white/10 rounded-2xl">
                <h3 class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Step 2: Professional Assignment</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Primary Subject</label>
                        <select name="subject" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 outline-none focus:border-blue-500" required>
                            <option disabled selected>Select Subject...</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Science">Science</option>
                            <option value="English">English</option>
                            <option value="History">History</option>
                            <option value="Computer Science">Computer Science</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Assigned Home Room / Class</label>
                        <select name="class" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 outline-none focus:border-blue-500" required>
                            <option disabled selected>Select Grade...</option>
                            <?php for($i=1; $i<=12; $i++) {
                                $val = str_pad($i, 2, "0", STR_PAD_LEFT);
                                echo "<option value='$val'>Grade $val</option>";
                            } ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Joining Date</label>
                        <input type="date" name="joiningDate" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 focus:border-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Qualification</label>
                        <input type="text" name="qualification" placeholder="e.g. Master of Education" class="w-full p-4 rounded-xl text-sm text-white bg-slate-900/50 border border-white/10 focus:border-blue-500 outline-none">
                    </div>
                </div>
            </div>

            <button type="submit" name="add_teacher_full" class="w-full bg-blue-600 hover:bg-blue-700 py-5 rounded-2xl font-black uppercase text-sm text-white tracking-widest shadow-xl shadow-blue-600/20 transition-all transform active:scale-95">
                Finalize Faculty Registration
            </button>
        </form>
    </div>
</body>
</html>