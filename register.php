<?php
require('koneksi.php');

$pesan_error = "";
$pesan_sukses = "";

if (isset($_POST['register'])) {
    $nama     = mysqli_real_escape_string($conn, $_POST['name']);
    $password = $_POST['password']; // Disimpan langsung atau bisa pakai password_hash($_POST['password'], PASSWORD_DEFAULT)

    // Cek apakah nama pengguna sudah terdaftar
    $cek = mysqli_query($conn, "SELECT * FROM pengguna WHERE nama = '$nama'");
    if (mysqli_num_rows($cek) > 0) {
        $pesan_error = "Nama pengguna sudah terdaftar!";
    } else {
        // Buat ID unik untuk user
        $id_user = 'USER_' . time();
        
        // Simpan ke database (tabel pengguna)
        $query = "INSERT INTO pengguna (id_user, nama, password) VALUES ('$id_user', '$nama', '$password')";
        
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
        } else {
            $pesan_error = "Registrasi gagal: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AIIRRR Monitoring Ikan Koi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        darkBg: '#0f0c1b',
                        cardBg: '#1b1429',
                        cyanCustom: '#00c3ff',
                    }
                }
            }
        }

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('passwordInput');
            const toggleBtn = document.getElementById('toggleBtn');
            const toggleCircle = document.getElementById('toggleCircle');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleBtn.classList.remove('bg-gray-700');
                toggleBtn.classList.add('bg-[#00c3ff]');
                toggleCircle.classList.remove('bg-gray-400');
                toggleCircle.classList.add('translate-x-3.5', 'bg-white');
            } else {
                passwordInput.type = 'password';
                toggleBtn.classList.remove('bg-[#00c3ff]');
                toggleBtn.classList.add('bg-gray-700');
                toggleCircle.classList.remove('translate-x-3.5', 'bg-white');
                toggleCircle.classList.add('bg-gray-400');
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body style="font-family: 'Space Grotesk', sans-serif;"
      class="bg-darkBg min-h-screen flex items-center justify-center p-4 relative overflow-hidden select-none">

    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat z-0" style="background-image: url('bacground .jpeg');"></div>
    <div class="absolute inset-0 bg-[#0f0c1b]/30 backdrop-blur-[-1px] z-0"></div>

    <div class="w-full max-w-6xl flex flex-col lg:flex-row items-center justify-center gap-12 lg:gap-24 z-10 px-4">
        
        <!-- Bagian Kiri (Logo & Info) -->
        <div class="w-full lg:w-auto flex flex-col items-start text-left text-white space-y-6 lg:-translate-x-[140px]">
            <div class="flex items-center justify-start gap-6 mb-10">
                <img src="polije.png" alt="Logo Polije" class="w-[94px] h-[82px] object-contain">
                <img src="TRK.png" alt="Logo TRK" class="w-[94px] h-[82px] object-contain">
            </div>

            <div class="space-y-1">
                <h1 class="w-full max-w-[460px] text-[30px] md:text-[40px] font-bold tracking-[0.35em] text-cyanCustom uppercase flex items-center justify-center leading-none mx-auto mb-6">
                    Welcome To
                </h1>
                <h2 class="w-full max-w-[460px] text-[36px] md:text-[40px] font-light text-[#5ce1e6] uppercase tracking-[0.35em] flex items-center justify-center text-center leading-none mx-auto mb-6 drop-shadow-[0_0_8px_rgba(92,225,230,0.5)]">
                    AIIRRR
                </h2>
            </div>

             <div class="relative flex items-center justify-center w-[240px] h-[240px] my-6 rounded-full border border-[#5ce1e6]/30 bg-[#5ce1e6]/5 backdrop-blur-md shadow-[0_0_40px_rgba(92,225,230,0.15)] mx-auto">
                <svg class="w-32 h-32 text-[#5ce1e6]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 6c.6.5 1.2 1 2.5 1s1.9-.5 2.5-1c.6-.5 1.2-1 2.5-1s1.9.5 2.5 1c.6.5 1.2 1 2.5 1s1.9-.5 2.5-1c.6-.5 1.2-1 2.5-1s1.9.5 2.5 1"></path>
                    <path d="M2 12c.6.5 1.2 1 2.5 1s1.9-.5 2.5-1c.6-.5 1.2-1 2.5-1s1.9.5 2.5 1c.6.5 1.2 1 2.5 1s1.9-.5 2.5-1c.6-.5 1.2-1 2.5-1s1.9.5 2.5 1"></path>
                    <path d="M2 18c.6.5 1.2 1 2.5 1s1.9-.5 2.5-1c.6-.5 1.2-1 2.5-1s1.9.5 2.5 1c.6.5 1.2 1 2.5 1s1.9-.5 2.5-1c.6-.5 1.2-1 2.5-1s1.9.5 2.5 1"></path>
                </svg>
            </div>

            <p class="text-base md:text-lg font-medium tracking-[0.25em] text-center text-gray-300 uppercase pt-2 w-full max-w-[460px] mx-auto">
                Monitoring Ikan Koi
            </p>

            <div class="flex items-center justify-between w-full pt-2 flex-wrap text-xs font-medium">
                <div class="flex items-center gap-2 bg-white/[0.03] border border-white/10 px-4 py-2 rounded-xl text-gray-300">
                    <span>🌡️</span> SUHU 24,5 °C
                </div>
                <div class="flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/20 px-4 py-2 rounded-xl text-emerald-400">
                    <span>🧪</span> PH 7,4 OPTIMAL
                </div>
            </div>
        </div>

        <!-- Bagian Kanan (Form Register) -->
        <div class="w-full lg:w-[380px] min-h-[580px] lg:h-[580px] bg-cardBg/90 border border-white/[0.06] rounded-2xl p-8 flex flex-col justify-center shadow-[0_25px_50px_-12px_rgba(0,0,0,0.5)] backdrop-blur-xl transition-all lg:translate-x-[180px]">
            
            <h3 class="w-full max-w-[460px] text-[26px] md:text-[26px] font-light text-[#5ce1e6] uppercase tracking-[0.35em] flex items-center justify-center text-center leading-none mx-auto mb-6 drop-shadow-[0_0_8px_rgba(92,225,230,0.5)]">
                register 
            </h3>

            <?php if (!empty($pesan_error)): ?>
                <div class="mb-4 p-2 bg-red-500/20 border border-red-500 text-red-300 text-xs rounded text-center">
                    <?php echo $pesan_error; ?>
                </div>
            <?php endif; ?>

            <!-- Form Menggunakan Metode POST -->
            <form action="" method="POST" class="space-y-6">
                <div class="space-y-2">
                    <label class="text-[11px] font-bold uppercase tracking-wider text-gray-400 block">Name</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 font-medium text-sm">@</span>
                        <input type="text" name="name" required placeholder="Username / Name" class="w-full bg-[#e3dede] text-gray-900 placeholder-gray-500 font-medium rounded-lg pl-10 pr-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-cyanCustom transition-all">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-bold uppercase tracking-wider text-gray-400 block">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 text-sm">🔒</span>
                        <input type="password" name="password" id="passwordInput" required placeholder="••••••••" class="w-full bg-[#e3dede] text-gray-900 placeholder-gray-500 font-medium rounded-lg pl-10 pr-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-cyanCustom transition-all">
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="button" id="toggleBtn" onclick="togglePasswordVisibility()" class="w-8 h-4 bg-gray-700 rounded-full relative transition-all duration-300">
                        <div id="toggleCircle" class="absolute top-[2px] left-[2px] bg-gray-400 rounded-full h-3 w-3 transition-all duration-300"></div>
                    </button>
                    <span class="text-xs text-gray-400 font-medium select-none">Show password</span>
                </div>

                <!-- Tombol Submit dengan type="submit" -->
                <button type="submit" name="register" class="w-full bg-cyanCustom hover:bg-cyan-400 text-gray-950 font-extrabold tracking-widest py-4 px-4 rounded-lg flex items-center justify-center gap-2 shadow-[0_4px_20px_rgba(0,195,255,0.25)] transition-all transform active:scale-[0.99] mt-4 text-center cursor-pointer">
                    <span class="text-xs">SAVE</span>
                    <span class="text-sm">➔</span>
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="login.php" class="text-xs text-gray-400 hover:text-cyanCustom">Sudah punya akun? Login di sini</a>
            </div>

        </div>

    </div>

</body>
</html>