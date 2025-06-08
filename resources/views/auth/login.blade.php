<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Page</title>
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Bootstrap Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet" />

  <!-- AOS Animation -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />

  <style>
    :root {
      --primary: #6366f1;
      --primary-dark: #4f46e5;
      --secondary: #ec4899;
      --accent: #06b6d4;
      --success: #10b981;
      --warning: #f59e0b;
      --danger: #ef4444;
      --dark: #0f172a;
      --light: #f8fafc;
      --gray-50: #f9fafb;
      --gray-100: #f3f4f6;
      --gray-200: #e5e7eb;
      --gray-300: #d1d5db;
      --gray-400: #9ca3af;
      --gray-500: #6b7280;
      --gray-600: #4b5563;
      --gray-700: #374151;
      --gray-800: #1f2937;
      --gray-900: #111827;
    }

    /* Gradient Background Animasi */
    .gradient-bg {
      min-height: 100vh;
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
      background-size: 400% 400%;
      animation: gradientShift 8s ease infinite;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 1rem;
      opacity: 0;
      transition: opacity 0.8s ease;
      font-family: sans-serif, Inter, sans-serif;
      position: relative;
    }

    .gradient-bg.visible {
      opacity: 1;
    }

    @keyframes gradientShift {
      0% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
      100% {
        background-position: 0% 50%;
      }
    }

    /* Login wrapper */
    .login-wrapper {
      background: var(--light);
      border-radius: 1rem;
      max-width: 420px;
      width: 100%;
      padding: 2.5rem 2rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      position: relative;
      font-family: sans-serif, Inter, sans-serif;
    }

    /* Logo container dengan logo kiri & kanan */
    .logo-container {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .logo-container img {
      max-height: 60px;
      object-fit: contain;
      user-select: none;
    }

    /* Judul */
    .login-wrapper h1 {
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 0.5rem;
      font-family: sans-serif, Inter, sans-serif;
    }

    .login-wrapper p {
      color: var(--gray-600);
      margin-bottom: 2rem;
      font-weight: 500;
      font-family: sans-serif, Inter, sans-serif;
    }

    /* Form labels */
    label.form-label {
      font-weight: 600;
      color: var(--gray-700);
    }

    /* Button style */
    .btn-login {
      background: var(--primary);
      color: white;
      font-weight: 600;
      padding: 0.6rem 1.2rem;
      border-radius: 0.5rem;
      border: none;
      transition: background-color 0.3s ease;
    }

    .btn-login:hover {
      background: var(--primary-dark);
      color: #fff;
    }

    /* Tombol kembali beranda kiri atas dalam bentuk logo/icon */
    .btn-back-home {
      position: fixed; /* supaya selalu di pojok walau scroll */
  top: 1rem;
  left: 1rem;
  width: 50px; /* ukuran lingkaran */
  height: 50px;
  background: var(--light); /* warna lingkaran, bisa disesuaikan */
  border-radius: 50%; /* bikin lingkaran */
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 0 0 8px rgba(0,0,0,0.15);
  cursor: pointer;
  z-index: 1000;
  transition: background-color 0.3s ease;
  text-decoration: none;
    }

    .btn-back-home:hover {
      background: var(---gray-900);

    }

    .btn-back-home img {
  max-width: 60%;
  max-height: 60%;
  object-fit: contain;
  user-select: none;
  pointer-events: none; /* supaya klik logo tetap ke <a> */
}

  </style>
</head>
<body>
  <div class="gradient-bg" id="mainContent">
    <a href="{{ route('landing') }}" class="btn-back-home" title="Kembali ke Beranda" aria-label="Kembali ke Beranda">
      <i class="bi bi-arrow-left"></i>
    </a>

    <div class="login-wrapper" data-aos="fade-up" data-aos-duration="1000">
      <div class="logo-container">
        <img src="{{ asset('images/logo_polinema.png') }}" alt="Logo Polinema" />
        <img src="{{ asset('images/logoJTI.png') }}" alt="Logo JTI" />
      </div>

      <h1>Selamat Datang!</h1>
      <p>Silahkan masuk ke akun anda</p>

      @if ($errors->any())
  <div class="alert alert-danger">
    {{ $errors->first() }}
  </div>
@endif


      <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-3 text-start">
          <label for="username" class="form-label">Username :</label>
          <input type="text" class="form-control" id="username" name="username" required autocomplete="username" />
        </div>
        <div class="mb-3 text-start">
          <label for="role" class="form-label">Role :</label>
          <select class="form-select" id="role" name="role" required>
            <option selected disabled>Pilih Role</option>
            <option value="anggota">Anggota</option>
            <option value="validator">Validator</option>
            <option value="SuperAdmin">SuperAdmin</option>
          </select>
        </div>
        <div class="mb-4 text-start">
          <label for="password" class="form-label">Password :</label>
          <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password" />
        </div>
        <button type="submit" class="btn btn-login w-100">Masuk</button>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- AOS Animation JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
    AOS.init();

    // Fade-in konten tanpa spinner, buat terasa cepat dan smooth
    document.addEventListener('DOMContentLoaded', () => {
      const mainContent = document.getElementById('mainContent');
      mainContent.classList.add('visible');
    });
  </script>
</body>
</html>
