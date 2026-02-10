<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ia Academy | Student Access</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .form-section { display: none; } 
        .form-section.active { display: block; }
        .error-msg { color: #f87171; font-size: 11px; font-weight: 700; margin-top: 4px; text-transform: uppercase; letter-spacing: 0.5px; }
        .success-msg { color: #34d399; font-size: 11px; font-weight: 700; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 0.5px; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 bg-[#0f172a]">
    <div class="w-full max-w-[420px]">
        <div class="glass-card p-12 flex flex-col items-center shadow-2xl border border-white/10 bg-white/5 backdrop-blur-lg rounded-3xl">
            
            <div class="w-16 h-16 bg-[#2563eb] rounded-2xl flex items-center justify-center font-black text-2xl mb-8 text-white shadow-lg shadow-blue-600/20">ia</div>
            
            <?php if(isset($_GET['msg']) && $_GET['msg'] == 'logged_out'): ?>
                <p class="success-msg">👋 Logged out successfully</p>
            <?php endif; ?>
            <?php if(isset($_GET['success']) && $_GET['success'] == 'registered'): ?>
                <p class="success-msg">✨ Account created! Please sign in</p>
            <?php endif; ?>

            <div id="login-form" class="form-section active w-full">
                <h2 class="text-3xl font-black text-center mb-1 uppercase text-white tracking-tighter">User Login</h2> 
                <p class="text-slate-400 text-center text-[10px] font-bold uppercase tracking-widest mb-8">Welcome To ia Academy</p>
                
                <form action="auth.php" method="POST" class="w-full space-y-5">
                    <div>
                        <input type="email" name="email" placeholder="Email Address" required 
                               class="w-full p-4 rounded-xl bg-[#0f172a]/60 border border-white/10 text-white outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                        <?php if(isset($_GET['error']) && $_GET['error'] == 'user_not_found'): ?>
                            <p class="error-msg">⚠️ User account not found</p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <input type="password" name="password" placeholder="Password" required 
                               class="w-full p-4 rounded-xl bg-[#0f172a]/60 border border-white/10 text-white outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                        <?php if(isset($_GET['error']) && $_GET['error'] == 'wrong_password'): ?>
                            <p class="error-msg">⚠️ Incorrect password. Try again.</p>
                        <?php endif; ?>
                    </div>

                    <button type="submit" name="login" class="w-full bg-[#2563eb] hover:bg-blue-600 py-4 rounded-xl font-black uppercase text-white transition-all transform active:scale-95 shadow-lg shadow-blue-600/10">
                        Sign In
                    </button> 
                </form>
                
                <p class="text-center text-[10px] mt-10 text-slate-400 uppercase tracking-widest font-bold">
                    No Account? <button onclick="showForm('register-form')" class="text-blue-400 hover:text-blue-300 transition-colors">Register Now</button>
                </p> 
            </div>

            <div id="register-form" class="form-section w-full">
                <h2 class="text-3xl font-black text-center mb-1 uppercase text-white tracking-tighter">Create Account</h2> 
                <p class="text-blue-400 text-center text-[10px] font-bold uppercase tracking-widest mb-8">Join the academy</p>

                <form action="auth.php" method="POST" class="w-full space-y-5">
                    <input type="text" name="name" placeholder="Full Name" required 
                           class="w-full p-4 rounded-xl bg-[#0f172a]/60 border border-white/10 text-white outline-none focus:border-blue-500 transition-all"> 
                    
                    <div>
                        <input type="email" name="email" placeholder="Email Address" required 
                               class="w-full p-4 rounded-xl bg-[#0f172a]/60 border border-white/10 text-white outline-none focus:border-blue-500 transition-all">
                        <?php if(isset($_GET['error']) && $_GET['error'] == 'email_taken'): ?>
                            <p class="error-msg">⚠️ This email is already registered</p>
                        <?php endif; ?>
                    </div>

                    <input type="password" name="password" placeholder="Create Password" required 
                           class="w-full p-4 rounded-xl bg-[#0f172a]/60 border border-white/10 text-white outline-none focus:border-blue-500 transition-all"> 
                    
                    <button type="submit" name="register" class="w-full bg-[#2563eb] hover:bg-blue-600 py-4 rounded-xl font-black uppercase text-white transition-all transform active:scale-95 shadow-lg shadow-blue-600/10">
                        Register Now
                    </button> 
                </form>
                
                <p class="text-center text-[10px] mt-10 text-slate-400 font-bold uppercase tracking-widest">
                    Already registered? <button onclick="showForm('login-form')" class="text-blue-400 hover:text-blue-300 transition-colors">Back to Login</button>
                </p> 
            </div>
        </div>
    </div>

    <script>
        // Smooth form switching
        function showForm(formId) {
            document.querySelectorAll('.form-section').forEach(f => {
                f.classList.remove('active');
            });
            document.getElementById(formId).classList.add('active');
        }

        // Optional: Auto-switch to Register if an email_taken error occurs
        <?php if(isset($_GET['error']) && $_GET['error'] == 'email_taken'): ?>
            showForm('register-form');
        <?php endif; ?>
    </script>
</body>
</html>