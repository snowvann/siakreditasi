<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Landing Page | Sistem Informasi Bisnis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
    }

    .navbar-custom {
      position: absolute;
      top: 0;
      width: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 3;
      padding: 10px 40px;
    }

    .navbar-custom .navbar-nav {
      gap: 24px;
    }

    .navbar-custom .nav-link {
      color: white !important;
      font-weight: 700;
      font-size: 1.2rem;
      padding: 8px 16px;
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    .navbar-custom .nav-link.active {
      background-color: #9747FF;
    }

    /* Hero section */
    .hero {
      position: relative;
      background: url("{{ asset('images/grahaPolinema.png') }}") no-repeat center center / cover;
      height: 100vh;
      color: white;
    }

    .overlay-gradient {
      position: absolute;
      top: 0;
      right: 0;
      width: 60%;
      height: 100%;
      background: linear-gradient(135deg, #a1a8ff, #1b1464);
      clip-path: polygon(35% 0, 100% 0, 100% 100%, 0 100%);
      z-index: 1;
    }

    .content {
      position: relative;
      z-index: 2;
      padding-top: 15%;
      padding-left: 60px;
      max-width: 1000px;
    }

    .logo-container {
      display: flex;
      align-items: center;
      gap: 50px;
      margin-bottom: 40px;
    }

    .logo-container img {
      height: 160px;
    }

    h1.fw-bold {
      font-size: 4.5rem;
    }

    .lead.fw-semibold {
      font-size: 2rem;
      line-height: 1.7;
    }

    .btn-selengkapnya {
      background-color: #d7d9ff;
      color: #2325c5;
      font-weight: bold;
      border-radius: 8px;
      font-size: 1.3rem;
      padding: 12px 30px;
    }

    .btn-selengkapnya:hover {
      background-color: #bfc3ff;
    }

    /* FAQ Section */
   .faq-section {
  position: relative;
  background: url('{{ asset('images/grahaPolinema.png') }}') no-repeat center center / cover;
  height: 100vh;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1;
}

.faq-section::before {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.6); /* gelap semi-transparan */
  z-index: 1;
}

.faq-container {
  position: relative;
  z-index: 2;
  background: #fff;
  border-radius: 20px;
  padding: 40px;
  max-width: 800px;
  width: 100%;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.search-box input {
  padding: 14px 20px;
  font-size: 1.1rem;
  border-radius: 25px;
  border: none;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.accordion-item {
  margin-bottom: 15px;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.accordion-button {
  background-color: #f1f1f1;
  font-size: 1.1rem;
  font-weight: bold;
  padding: 15px 20px;
}

.accordion-button:focus {
  box-shadow: none;
}

.accordion-body {
  background-color: #fff;
  padding: 20px;
  font-size: 1rem;
  line-height: 1.6;
}

    @media (max-width: 768px) {
      .content {
        padding: 100px 20px 0;
        text-align: center;
      }

      .logo-container {
        flex-direction: column;
        gap: 20px;
        justify-content: center;
      }

      .logo-container img {
        height: 100px;
      }

      h1.fw-bold {
        font-size: 3rem;
      }

      .lead.fw-semibold {
        font-size: 1.2rem;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container-fluid justify-content-between">
      <div></div>
      <ul class="navbar-nav d-flex align-items-center">
        <li class="nav-item">
          <a class="nav-link active" href="#" onclick="showSection('home')">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="showSection('faq')">FAQ</a>
        </li>
        <li class="nav-item"><a class="nav-link icon-link" href="#"><i class="bi bi-x-lg"></i></a></li>
        <li class="nav-item"><a class="nav-link icon-link" href="#"><i class="bi bi-youtube"></i></a></li>
        <li class="nav-item"><a class="nav-link icon-link" href="#"><i class="bi bi-instagram"></i></a></li>
      </ul>
    </div>
  </nav>

  <!-- HOME Section -->
  <div id="home-section">
    <div class="hero">
      <div class="overlay-gradient"></div>
      <div class="content">
        <div class="logo-container">
          <img src="{{ asset('images/logo_polinema.png') }}" alt="Logo Polinema">
          <img src="{{ asset('images/logoJTI.png') }}" alt="Logo JTI">
        </div>
        <h1 class="fw-bold">SELAMAT DATANG</h1>
        <p class="lead fw-semibold">
          Di Akreditasi D4 Sistem Informasi Bisnis<br>
          Jurusan Teknologi Informasi<br>
          Politeknik Negeri Malang
        </p>
       <a href="{{ route('login') }}" class="btn btn-selengkapnya mt-3">
         Masuk <i class="bi bi-arrow-right"></i>
      </a>   
      </div>
    </div>
  </div>

  <!-- FAQ Section -->
  <div id="faq-section" style="display: none;">
  <div class="faq-section">
    <div class="faq-container">
      <div class="search-box text-center mb-4">
        <input type="text" class="form-control" placeholder="Search.....">
      </div>

      <div class="accordion" id="faqAccordion">
        @foreach ([
          ['Apa itu akreditasi program studi?', 'Akreditasi program studi adalah proses...'],
          ['Siapa yang melakukan akreditasi program studi di Indonesia?', 'Akreditasi dilakukan oleh...'],
          ['Apa tujuan dari akreditasi program studi?', 'Tujuan utama akreditasi adalah...'],
          ['Apa manfaat akreditasi bagi mahasiswa?', 'Mahasiswa dari program studi...'],
          ['Berapa lama masa berlaku akreditasi program studi?', 'Masa berlaku akreditasi...']
        ] as $index => [$question, $answer])
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ $index }}">
              <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}">
                {{ $index + 1 }}. {{ $question }}
              </button>
            </h2>
            <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}">
              <div class="accordion-body">
                {{ $answer }}
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
  <script>
    function showSection(section) {
      const home = document.getElementById('home-section');
      const faq = document.getElementById('faq-section');

      if (section === 'home') {
        home.style.display = 'block';
        faq.style.display = 'none';
      } else {
        home.style.display = 'none';
        faq.style.display = 'block';
      }

      // Update navbar active class
      const links = document.querySelectorAll('.nav-link');
      links.forEach(link => link.classList.remove('active'));
      if (section === 'home') {
        links[0].classList.add('active');
      } else {
        links[1].classList.add('active');
      }
    }
  </script>
</body>
</html>
