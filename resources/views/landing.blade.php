@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white">
<!-- Navigation yang lebih kompak -->
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 py-3 transition-all duration-300 backdrop-blur-xl bg-white/95 border-b border-gray-100">
  <div class="max-w-6xl mx-auto px-6 flex justify-between items-center">
      <div class="flex items-center gap-3">
          <img src="{{ asset('images/logo_polinema.png') }}" alt="Logo Polinema" class="h-9 w-auto transition-all duration-300 drop-shadow-lg hover:scale-110">
          <img src="{{ asset('images/logoJTI.png') }}" alt="Logo JTI" class="h-9 w-auto transition-all duration-300 drop-shadow-lg hover:scale-110">
      </div>
      
      <ul id="navLinks" class="hidden lg:flex gap-4 items-center py-2">
        <li>
            <a href="#beranda" 
               data-target="beranda"
               class="nav-link text-gray-700 font-medium px-4 py-2 rounded-lg transition-all duration-300 hover:bg-gray-50 hover:-translate-y-0.5 hover:text-blue-900 text-sm">
                Beranda
            </a>
        </li>
   

        <li>
            <a href="#profile" 
               data-target="profile"
               class="nav-link text-gray-700 font-medium px-4 py-2 rounded-lg transition-all duration-300 hover:bg-gray-50 hover:-translate-y-0.5 hover:text-blue-900 text-sm">
                About
            </a>
        </li>
        <li>
            <a href="#faq" 
               data-target="faq"
               class="nav-link text-gray-700 font-medium px-4 py-2 rounded-lg transition-all duration-300 hover:bg-gray-50 hover:-translate-y-0.5 hover:text-blue-900 text-sm">
                FAQ
            </a>
        </li>
        <li>
            <a href="#denah" 
               data-target="denah"
               onclick="openModal()" 
               class="text-gray-700 font-medium px-4 py-2 rounded-lg transition-all duration-300 hover:bg-gray-50 hover:-translate-y-0.5 hover:text-blue-900 text-sm">
                Denah
            </a>
        </li>
        <li>
            <a href="https://www.polinema.ac.id/" 
               target="_blank" 
               class="text-gray-700 font-medium px-4 py-2 rounded-lg transition-all duration-300 hover:bg-gray-50 hover:-translate-y-0.5 hover:text-blue-900 text-sm">
                Website Polinema
            </a>
        </li>
        <li>
          <a href="{{ route('login') }}" 
          class="text-white px-4 py-2 rounded-lg font-semibold text-sm inline-flex items-center gap-1 transition-all duration-300 ease-in-out hover:scale-105 hover:shadow-lg"
          style="background-color: #4B5CAD;">
           Login
       </a>
        </li>
    </ul>
      
      <button class="lg:hidden p-2 rounded-lg transition-all duration-300 hover:bg-gray-100" onclick="toggleMobileMenu()">
          <i class="bi bi-list text-2xl text-gray-700"></i>
      </button>
  </div>
</nav>

<!-- Hero Section -->
<section id="beranda" class="min-h-screen flex items-center justify-center relative overflow-hidden pt-20 md:pt-24 lg:pt-24 animated-bg">
  <!-- Floating Shapes dengan Animasi Custom -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <!-- Shape 1 - Floating Circle -->
      <div class="absolute top-1/5 left-1/10 w-20 h-20 bg-purple-400/30 rounded-full float-animation"></div>
      
      <!-- Shape 2 - Bouncing Rectangle -->
      <div class="absolute top-3/5 right-1/10 w-32 h-32 bg-blue-300/25 rounded-2xl float-reverse"></div>
      
      <!-- Shape 3 - Pulsing Circle -->
      <div class="absolute bottom-1/5 left-1/5 w-16 h-16 bg-purple-300/35 rounded-full animate-pulse"></div>
      
      <!-- Shape 4 - Sliding Shape -->
      <div class="absolute top-1/2 left-1/3 w-24 h-24 bg-indigo-400/20 rounded-full slide-animation"></div>
      
      <!-- Shape 5 - Spinning Square -->
      <div class="absolute bottom-1/3 right-1/4 w-12 h-12 bg-cyan-300/30 rounded-lg animate-spin" style="animation-duration: 12s;"></div>
      
      <!-- Shape 6 - Floating Triangle -->
      <div class="absolute top-1/4 right-1/3 w-0 h-0 float-animation" 
           style="border-left: 15px solid transparent; border-right: 15px solid transparent; border-bottom: 25px solid rgba(139, 92, 246, 0.2);"></div>
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10 w-full">
      <div class="grid lg:grid-cols-2 gap-8 lg:gap-16 items-center justify-items-center py-8 lg:py-12">
          <div class="text-white text-center lg:text-left" data-aos="fade-right" data-aos-duration="1000">
              <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-black mb-6 leading-tight drop-shadow-lg">
                  Sistem Akreditasi<br class="hidden sm:block"> D4 Sistem<br class="hidden sm:block"> Informasi Bisnis
              </h1>
              <p class="text-lg sm:text-xl mb-6 lg:mb-8 leading-relaxed text-white/90 drop-shadow-sm max-w-lg mx-auto lg:mx-0">
                  Revolusi pengelolaan akreditasi D4 Sistem Informasi Bisnis dengan teknologi terdepan. 
                  Pengalaman yang seamless, modern, dan efisien untuk institusi pendidikan.
              </p>
              <div class="flex flex-col sm:flex-row flex-wrap gap-4 justify-center lg:justify-start">
                  <a href="{{ route('login') }}" class="bg-white text-purple-700 px-6 sm:px-8 py-3 sm:py-4 rounded-2xl font-semibold text-base sm:text-lg inline-flex items-center justify-center gap-2 transition-all duration-300 shadow-xl shadow-purple-500/30 hover:-translate-y-1 hover:shadow-2xl hover:shadow-purple-500/40 hover:bg-purple-100">
                      Mulai Sekarang <i class="bi bi-rocket-takeoff"></i>
                  </a>
                  <a href="#profile" 
                    class="nav-link text-white !text-white px-6 sm:px-8 py-3 sm:py-4 rounded-2xl font-semibold text-base sm:text-lg inline-flex items-center justify-center gap-2 border-2 border-white/30 backdrop-blur-sm transition-all duration-300 hover:bg-white/30 hover:-translate-y-1 bg-white/20"
                    style="color: white;"
                    data-target="profile">
                    Lihat Profile <i class="bi bi-arrow-down"></i>
                    </a>
              </div>
          </div>

          <div class="flex items-center justify-center w-full" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
              <div class="bg-white/15 backdrop-blur-xl border border-white/20 rounded-3xl p-8 text-center text-white transform rotate-6 transition-all duration-300 shadow-2xl hover:rotate-0 hover:scale-105 max-w-sm w-full">
                <div class="text-5xl mb-4" style="color: #FFBF47;">

                      <i class="bi bi-award-fill"></i>
                  </div>
                  <h3 class="text-2xl font-bold mb-2">SIAKREDITASI</h3>
                  <p class="text-white/90">Platform terintegrasi untuk pengelolaan akreditasi yang efisien dan modern</p>
              </div>
          </div>
      </div>
  </div>
</section>
    <!-- Profile Section -->
    <section id="profile" class="py-24 bg-gray-50 relative">
        <!-- Polinema Profile -->
        <div class="max-w-7xl mx-auto px-8">
            <div class="bg-white rounded-3xl p-12 shadow-2xl shadow-blue-900/8 mb-16 border border-gray-100">
                <h2 class="text-4xl font-black text-center mb-12 bg-gradient-to-r from-[#5282BA] to-[#7E28B1] bg-clip-text text-transparent">
                  INFORMASI UMUM POLITEKNIK NEGERI MALANG
              </h2>
            
                
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-blue-900/15">
                        <img src="images/as.jpg" alt="Gedung Polinema" class="w-full h-96 object-cover transition-all duration-300 hover:scale-105">
                    </div>
                    
                    <div class="py-4">
                        <h3 class="text-2xl font-bold mb-6 bg-gradient-to-r from-[#5282BA] to-[#7E28B1] bg-clip-text text-transparent relative">
                          PROFIL KAMPUS
                          <div class="absolute -bottom-2 left-0 w-15 h-1 bg-gradient-to-r from-[#5282BA] to-[#7E28B1] rounded-full"></div>
                      </h3>
                    
                        <p class="text-lg leading-relaxed text-gray-600 mb-6">
                            Polinema adalah institusi pendidikan tinggi vokasi yang terletak di kota Malang. Malang 
                            adalah kota terbesar kedua di Jawa Timur, Indonesia. Malang merupakan tempat yang nyaman 
                            untuk belajar karena udaranya yang sejuk dan populasi yang tidak begitu padat (sekitar 
                            800 ribu penduduk). Di Malang terdapat banyak sekolah, universitas dan institusi pendidikan 
                            lainnya dengan kualitas yang bagus.
                        </p>
                        <p class="text-lg leading-relaxed text-gray-600">
                            Polinema terus berkembang untuk menjadi institusi pendidikan vokasi yang superior dan siap 
                            bersaing di dunia global. Polinema memiliki sistem pendidikan yang inovatif dan ketrampilan 
                            kompetitif yang secara global dibutuhkan oleh industri, badan pemerintahan dan masyarakat.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Program Studi Profile -->
        <div class="bg-white py-16 border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-8">
              <h2 class="text-4xl font-black text-center mb-8 bg-gradient-to-r from-[#5282BA] to-[#7E28B1] bg-clip-text text-transparent">
                PROFILE PROGRAM STUDI
            </h2>
                <div class="bg-gradient-to-r from-[#5282BA] to-[#7E28B1] text-white px-8 py-3 rounded-3xl font-semibold text-lg mx-auto w-fit mb-12 shadow-lg shadow-blue-900/30">
                    Sistem Informasi Bisnis
                </div>
                
                <div class="grid lg:grid-cols-2 gap-12 items-center mt-12">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-blue-900/15">
                        <img src="images/atasan.jpg" alt="Foto Prodi" class="w-full h-80 object-cover transition-all duration-300 hover:scale-105">
                    </div>
                    
                    <div>
                        <p class="text-lg leading-relaxed text-gray-600 mb-6">
                            Program Studi Manajemen Informatika berdiri 24 Juni 2005 berdasarkan SK Mendiknas Nomor: 2001/D/T/2005 
                            di bawah Jurusan Teknik Elektro Politeknik Negeri Malang. Mulai tahun akademik 2006/2007, kurikulum 
                            Program Studi Manajemen Informatika menggunakan kurikulum 5-1 (lima semester di kampus dan satu semester di industri).
                        </p>
                        <p class="text-lg leading-relaxed text-gray-600">
                            Program Upgrading merupakan peningkatan program studi dari Diploma Tiga menjadi Diploma Empat atau Sarjana Terapan. 
                            Berdasarkan pada Surat Keputusan Mendikbudristek Nomor 33/D/OT/2022, izin pembukaan Program Studi Sarjana Terapan 
                            Sistem Informasi Bisnis secara resmi disetujui.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visi Misi Section -->
        <div class="bg-gray-50 py-16">
            <div class="max-w-7xl mx-auto px-8">
              <h2 class="text-4xl font-black text-center mb-12 bg-gradient-to-r from-[#5282BA] to-[#7E28B1] bg-clip-text text-transparent">
                VISI dan Misi
            </h2>
          
                
                <!-- Visi -->
                <div class="bg-white rounded-2xl p-12 mb-12 shadow-xl shadow-blue-900/8 border border-gray-100">
                    <div class="bg-gradient-to-r from-[#5282BA] to-[#7E28B1] text-white px-6 py-2 rounded-2xl font-bold text-sm w-fit mb-6 tracking-wider">
                        VISI
                    </div>
                    <p class="text-xl leading-relaxed text-gray-700 font-medium">
                        Menjadi Program Studi Unggul dalam Bidang Sistem Informasi Bisnis di Tingkat Nasional dan Internasional.
                    </p>
                </div>

                <!-- Misi -->
                <div class="bg-white rounded-2xl p-12 shadow-xl shadow-blue-900/8 border border-gray-100">
                    <div class="bg-gradient-to-r from-[#5282BA] to-[#7E28B1] text-white px-6 py-2 rounded-2xl font-bold text-sm w-fit mb-8 tracking-wider">
                        MISI
                    </div>
                    
                    <div class="flex flex-col gap-8">
                        <div class="flex gap-6 items-start p-6 bg-gray-50 rounded-2xl border-l-4 border-blue-900 transition-all duration-300 hover:bg-white hover:shadow-lg hover:shadow-blue-900/8 hover:translate-x-2">
                            <div class="bg-gradient-to-r from-[#5282BA] to-[#7E28B1] text-white w-12 h-12 rounded-xl flex items-center justify-center text-2xl flex-shrink-0 shadow-lg shadow-blue-900/30">
                                <i class="bi bi-mortarboard"></i>
                            </div>
                            <p class="text-base leading-relaxed text-gray-600">
                                Melaksanakan pendidikan vokasi yang inovatif berdasarkan pada sistem pendidikan terapan dengan 
                                memanfaatkan kemajuan teknologi, sehingga mampu menghasilkan lulusan yang berkompeten di bidang 
                                sistem informasi bisnis.
                            </p>
                        </div>
                        
                        <div class="flex gap-6 items-start p-6 bg-gray-50 rounded-2xl border-l-4 border-blue-900 transition-all duration-300 hover:bg-white hover:shadow-lg hover:shadow-blue-900/8 hover:translate-x-2">
                            <div class="bg-gradient-to-r from-[#5282BA] to-[#7E28B1] text-white w-12 h-12 rounded-xl flex items-center justify-center text-2xl flex-shrink-0 shadow-lg shadow-blue-900/30">
                                <i class="bi bi-search"></i>
                            </div>
                            <p class="text-base leading-relaxed text-gray-600">
                                Melaksanakan penelitian terapan berbasis produk dan jasa bidang Sistem Informasi Bisnis.
                            </p>
                        </div>
                        
                        <div class="flex gap-6 items-start p-6 bg-gray-50 rounded-2xl border-l-4 border-blue-900 transition-all duration-300 hover:bg-white hover:shadow-lg hover:shadow-blue-900/8 hover:translate-x-2">
                            <div class="bg-gradient-to-r from-[#5282BA] to-[#7E28B1] text-white w-12 h-12 rounded-xl flex items-center justify-center text-2xl flex-shrink-0 shadow-lg shadow-blue-900/30">
                                <i class="bi bi-people"></i>
                            </div>
                            <p class="text-base leading-relaxed text-gray-600">
                                Melaksanakan pengabdian masyarakat dengan menggunakan kemajuan Sistem Informasi Bisnis 
                                untuk meningkatkan kesejahteraan.
                            </p>
                        </div>
                        
                        <div class="flex gap-6 items-start p-6 bg-gray-50 rounded-2xl border-l-4 border-blue-900 transition-all duration-300 hover:bg-white hover:shadow-lg hover:shadow-blue-900/8 hover:translate-x-2">
                            <div class="bg-gradient-to-r from-[#5282BA] to-[#7E28B1] text-white w-12 h-12 rounded-xl flex items-center justify-center text-2xl flex-shrink-0 shadow-lg shadow-blue-900/30">
                                <i class="bi bi-globe"></i>
                            </div>
                            <p class="text-base leading-relaxed text-gray-600">
                                Mewujudkan kerja sama yang saling menguntungkan dengan berbagai pihak baik di dalam 
                                maupun di luar negeri pada bidang Sistem Informasi Bisnis.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tujuan Program Studi -->
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-8">
              <h2 class="text-4xl font-black text-center mb-12 bg-gradient-to-r from-[#5282BA] to-[#7E28B1] bg-clip-text text-transparent">
                Tujuan Program Studi
            </h2>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white rounded-2xl p-8 shadow-xl shadow-blue-900/8 border border-gray-100 hover:shadow-2xl hover:shadow-blue-900/15 transition-all duration-300 hover:-translate-y-2">
                        <div class="bg-gradient-to-r from-[#5282BA] to-[#7E28B1] text-white w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-black mb-6">
                            1
                        </div>
                        <p class="text-base leading-relaxed text-gray-600">
                            Menghasilkan lulusan bidang Sistem Informasi Bisnis yang berketuhanan, beretika dan bermoral baik, 
                            berpengetahuan dan berketerampilan tinggi, siap bekerja dan/atau berwirausaha yang mampu bersaing 
                            dalam skala nasional maupun internasional.
                        </p>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-8 shadow-xl shadow-blue-900/8 border border-gray-100 hover:shadow-2xl hover:shadow-blue-900/15 transition-all duration-300 hover:-translate-y-2">
                        <div class="bg-gradient-to-r from-[#5282BA] to-[#7E28B1] text-white w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-black mb-6">
                            2
                        </div>
                        <p class="text-base leading-relaxed text-gray-600">
                            Menghasilkan penelitian terapan bidang Sistem Informasi Bisnis yang berskala nasional dan internasional, 
                            meningkatkan efektivitas, efisiensi, dan produktivitas dalam dunia usaha dan industri.
                        </p>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-8 shadow-xl shadow-blue-900/8 border border-gray-100 hover:shadow-2xl hover:shadow-blue-900/15 transition-all duration-300 hover:-translate-y-2">
                        <div class="bg-gradient-to-r from-[#5282BA] to-[#7E28B1] text-white w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-black mb-6">
                            3
                        </div>
                        <p class="text-base leading-relaxed text-gray-600">
                            Menghasilkan pengabdian kepada masyarakat yang dilaksanakan melalui penerapan dan penyebarluasan 
                            ilmu pengetahuan dan teknologi serta pemberian layanan jasa secara profesional.
                        </p>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-8 shadow-xl shadow-blue-900/8 border border-gray-100 hover:shadow-2xl hover:shadow-blue-900/15 transition-all duration-300 hover:-translate-y-2">
                        <div class="bg-gradient-to-r from-[#5282BA] to-[#7E28B1] text-white w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-black mb-6">
                            4
                        </div>
                        <p class="text-base leading-relaxed text-gray-600">
                            Terwujudnya kerjasama yang saling menguntungkan dengan berbagai pihak baik di dalam maupun 
                            di luar negeri pada bidang Sistem Informasi Bisnis untuk meningkatkan daya saing.
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl p-8 shadow-xl shadow-blue-900/8 border border-gray-100 hover:shadow-2xl hover:shadow-blue-900/15 transition-all duration-300 hover:-translate-y-2">
                        <div class="bg-gradient-to-r from-[#5282BA] to-[#7E28B1] text-white w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-black mb-6">
                            5
                        </div>
                        <p class="text-base leading-relaxed text-gray-600">
                            Menghasilkan sistem manajemen pendidikan bidang sistem informasi bisnis yang memenuhi prinsip-prinsip tata kelola yang baik
                        </p>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-8 shadow-xl shadow-blue-900/8 border border-gray-100 hover:shadow-2xl hover:shadow-blue-900/15 transition-all duration-300 hover:-translate-y-2">
                        <div class="bg-gradient-to-r from-[#5282BA] to-[#7E28B1] text-white w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-black mb-6">
                            6
                        </div>
                        <p class="text-base leading-relaxed text-gray-600">
                            Meningkatkan efektivitas, efisiensi, dan produktivitas dalam dunia usaha dan industri, serta mengarah pada pencapaian Hak atas Kekayaan Intelektual (HaKI), perolehan paten, dan kesejahteraan masyarakat;
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
<section id="faq" class="bg-gradient-to-br from-gray-50 to-blue-50 py-12">
  <div class="container mx-auto px-4 max-w-6xl">
      <div class="text-center mb-8">
          <h2 class="text-4xl font-black text-center mb-12 bg-gradient-to-r from-[#5282BA] to-[#7E28B1] bg-clip-text text-transparent">
            Frequently Asked Questions
        </h2>
          <p class="text-gray-600 text-lg max-w-2xl mx-auto">
              Temukan jawaban atas pertanyaan yang sering ditanyakan seputar akreditasi program studi
          </p>
      </div>
      
      <div class="max-w-4xl mx-auto">

          <!-- FAQ Accordion -->
          <div class="space-y-4" id="faqAccordion">
              <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden border border-gray-100">
                  <button class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-50 transition-all duration-300 group" 
                          onclick="toggleFAQ(this)">
                      <span class="font-semibold text-gray-800 text-lg pr-4">1. Apa itu akreditasi program studi?</span>
                      <svg class="w-6 h-6 text-blue-500 transform transition-transform duration-300 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                      </svg>
                  </button>
                  <div class="hidden px-6 pb-5 text-gray-600 leading-relaxed border-t border-gray-100 bg-gray-50">
                      <div class="pt-4">
                          Akreditasi program studi adalah proses evaluasi dan penilaian terhadap kualitas program studi yang dilakukan oleh lembaga akreditasi yang berwenang untuk memastikan bahwa program studi tersebut memenuhi standar kualitas yang telah ditetapkan.
                      </div>
                  </div>
              </div>

              <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden border border-gray-100">
                  <button class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-50 transition-all duration-300 group" 
                          onclick="toggleFAQ(this)">
                      <span class="font-semibold text-gray-800 text-lg pr-4">2. Siapa yang melakukan akreditasi program studi di Indonesia?</span>
                      <svg class="w-6 h-6 text-blue-500 transform transition-transform duration-300 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                      </svg>
                  </button>
                  <div class="hidden px-6 pb-5 text-gray-600 leading-relaxed border-t border-gray-100 bg-gray-50">
                      <div class="pt-4">
                          Akreditasi dilakukan oleh Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT) untuk program studi di perguruan tinggi umum, dan oleh lembaga akreditasi mandiri (LAM) untuk program studi tertentu seperti teknik, kesehatan, dan lainnya.
                      </div>
                  </div>
              </div>

              <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden border border-gray-100">
                  <button class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-50 transition-all duration-300 group" 
                          onclick="toggleFAQ(this)">
                      <span class="font-semibold text-gray-800 text-lg pr-4">3. Apa tujuan dari akreditasi program studi?</span>
                      <svg class="w-6 h-6 text-blue-500 transform transition-transform duration-300 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                      </svg>
                  </button>
                  <div class="hidden px-6 pb-5 text-gray-600 leading-relaxed border-t border-gray-100 bg-gray-50">
                      <div class="pt-4">
                          Tujuan utama akreditasi adalah untuk menjamin kualitas pendidikan, meningkatkan daya saing lulusan, memberikan perlindungan kepada masyarakat, dan mendorong peningkatan kualitas program studi secara berkelanjutan.
                      </div>
                  </div>
              </div>

              <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden border border-gray-100">
                  <button class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-50 transition-all duration-300 group" 
                          onclick="toggleFAQ(this)">
                      <span class="font-semibold text-gray-800 text-lg pr-4">4. Apa manfaat akreditasi bagi mahasiswa?</span>
                      <svg class="w-6 h-6 text-blue-500 transform transition-transform duration-300 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                      </svg>
                  </button>
                  <div class="hidden px-6 pb-5 text-gray-600 leading-relaxed border-t border-gray-100 bg-gray-50">
                      <div class="pt-4">
                          Mahasiswa dari program studi terakreditasi mendapatkan jaminan kualitas pendidikan, pengakuan ijazah di pasar kerja, kemudahan dalam melanjutkan studi ke jenjang yang lebih tinggi, dan kepercayaan dari dunia industri.
                      </div>
                  </div>
              </div>

              <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden border border-gray-100">
                  <button class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-50 transition-all duration-300 group" 
                          onclick="toggleFAQ(this)">
                      <span class="font-semibold text-gray-800 text-lg pr-4">5. Berapa lama masa berlaku akreditasi program studi?</span>
                      <svg class="w-6 h-6 text-blue-500 transform transition-transform duration-300 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                      </svg>
                  </button>
                  <div class="hidden px-6 pb-5 text-gray-600 leading-relaxed border-t border-gray-100 bg-gray-50">
                      <div class="pt-4">
                          Masa berlaku akreditasi program studi adalah 5 tahun. Setelah masa berlaku habis, program studi harus mengajukan re-akreditasi untuk mempertahankan status akreditasinya.
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
   <!-- Modal Denah Gedung -->
<div id="denahModal" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm">
  <div class="flex items-center justify-center min-h-screen p-4">
      <div class="bg-white rounded-3xl shadow-2xl max-w-lg w-full">
          <div class="flex justify-between items-center p-6 border-b border-gray-100 bg-gradient-to-r from-[#5282BA] to-[#7E28B1] rounded-t-3xl">
              <h3 class="text-xl font-bold text-white">Pilih Denah Gedung</h3>
              <button onclick="closeModal()" class="p-2 hover:bg-white/20 rounded-xl transition-colors">
                  <i class="bi bi-x text-2xl text-white"></i>
              </button>
          </div>
          <div class="p-6 space-y-4">
              <a href="https://my.matterport.com/show/?m=xufa7UrDLJe" target="_blank" class="flex items-center gap-4 p-4 rounded-xl border border-gray-200 hover:border-[#A26CD5] hover:bg-[#A26CD5]/10 transition-all duration-300 group">
                  <i class="bi bi-building text-2xl text-[#A26CD5] group-hover:text-[#8B5AC6]"></i>
                  <div>
                      <div class="font-semibold text-gray-900">Denah Lantai 5</div>
                      <div class="text-sm text-gray-500">Virtual Tour 360°</div>
                  </div>
              </a>
              <a href="https://my.matterport.com/show/?m=Fj8fbnjLjQq" target="_blank" class="flex items-center gap-4 p-4 rounded-xl border border-gray-200 hover:border-[#A26CD5] hover:bg-[#A26CD5]/10 transition-all duration-300 group">
                  <i class="bi bi-building text-2xl text-[#A26CD5] group-hover:text-[#8B5AC6]"></i>
                  <div>
                      <div class="font-semibold text-gray-900">Denah Lantai 6</div>
                      <div class="text-sm text-gray-500">Virtual Tour 360°</div>
                  </div>
              </a>
              <a href="https://my.matterport.com/show/?m=fAgiViGeZaB" target="_blank" class="flex items-center gap-4 p-4 rounded-xl border border-gray-200 hover:border-[#A26CD5] hover:bg-[#A26CD5]/10 transition-all duration-300 group">
                  <i class="bi bi-building text-2xl text-[#A26CD5] group-hover:text-[#8B5AC6]"></i>
                  <div>
                      <div class="font-semibold text-gray-900">Denah Lantai 7</div>
                      <div class="text-sm text-gray-500">Virtual Tour 360°</div>
                  </div>
              </a>
          </div>
      </div>
  </div>
</div>



    <!-- Footer -->
<footer class="bg-[#14031F] text-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Brand Section -->
          <div class="space-y-4">
            <div class="flex items-center gap-3">
              <img src="{{ asset('images/logo_polinema.png') }}" alt="Logo Polinema" class="h-9 w-auto transition-all duration-300 drop-shadow-lg hover:scale-110">
              <img src="{{ asset('images/logoJTI.png') }}" alt="Logo JTI" class="h-9 w-auto transition-all duration-300 drop-shadow-lg hover:scale-110">
          </div>
              <h3 class="text-2xl font-bold text-white">SIAKREDITASI</h3>
              <p class="text-gray-300 text-sm leading-relaxed">
                  Revolusi digital dalam pengelolaan akreditasi D4 Sistem Informasi Bisnis. 
                  Bergabunglah dengan masa depan pendidikan tinggi.
              </p>
          </div>

          <!-- Kontak Kami Section -->
          <div class="space-y-4">
              <h4 class="text-lg font-semibold text-white">Kontak Kami</h4>
              <div class="space-y-3">
                  <div class="flex items-start space-x-3">
                      <svg class="w-5 h-5 text-gray-300 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                      </svg>
                      <span class="text-gray-300 text-sm">Jl. Soekarno Hatta No.9, Malang</span>
                  </div>
                  <div class="flex items-center space-x-3">
                      <svg class="w-5 h-5 text-gray-300 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                      </svg>
                      <span class="text-gray-300 text-sm">(0341) 404424</span>
                  </div>
                  <div class="flex items-center space-x-3">
                      <svg class="w-5 h-5 text-gray-300 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                          <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                      </svg>
                      <a href="mailto:humas@polinema.ac.id" class="text-gray-300 text-sm hover:text-white transition-colors">
                          humas@polinema.ac.id
                      </a>
                  </div>
                  <div class="flex items-center space-x-3">
                      <svg class="w-5 h-5 text-gray-300 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.559-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.559.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd"></path>
                      </svg>
                      <a href="https://www.polinema.ac.id" target="_blank" class="text-gray-300 text-sm hover:text-white transition-colors">
                          www.polinema.ac.id
                      </a>
                  </div>
              </div>
          </div>

          <!-- Lokasi Kampus Section -->
          <div class="space-y-4">
              <h4 class="text-lg font-semibold text-white">Lokasi Kampus</h4>
              <div class="bg-gray-800 rounded-lg overflow-hidden">
                  <iframe 
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.5026830854117!2d112.6161209!3d-7.946891200000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78827687d272e7%3A0x789ce9a636cd3aa2!2sPoliteknik%20Negeri%20Malang!5e0!3m2!1sid!2sid!4v1749398256498!5m2!1sid!2sid"
                  width="100%" 
                      height="200" 
                      style="border:0;" 
                      allowfullscreen="" 
                      loading="lazy" 
                      referrerpolicy="no-referrer-when-downgrade"
                      class="w-full">
                  </iframe>
              </div>
          </div>
      </div>

      <!-- Copyright Section -->
      <div class="border-t border-gray-700 mt-8 pt-6">
          <p class="text-center text-gray-400 text-sm">
              © 2025 Jurusan Teknologi Informasi - Politeknik Negeri Malang. All rights reserved.
          </p>
      </div>
  </div>
</footer>
</div>


<style>
@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.bg-gradient-to-br {
    background-size: 400% 400%;
    animation: gradientShift 12s ease infinite;
}

@keyframes gradientMove {
            0%, 100% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }
        
        @keyframes floatReverse {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(20px) rotate(-180deg);
            }
        }
        
        @keyframes slideInOut {
            0%, 100% {
                transform: translateX(-100px) scale(0.8);
                opacity: 0.3;
            }
            50% {
                transform: translateX(100px) scale(1.2);
                opacity: 0.8;
            }
        }
        
        .animated-bg {
            background: linear-gradient(135deg, #AFCAED 0%, #587CAA 25%, #77419C 50%, #4B5CAD 75%, #AFCAED 100%);
            background-size: 400% 400%;
            animation: gradientMove 8s ease infinite;
        }
        
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .float-reverse {
            animation: floatReverse 8s ease-in-out infinite;
        }
        
        .slide-animation {
            animation: slideInOut 10s ease-in-out infinite;
        }
</style>
<script>
// Tunggu sampai DOM siap
document.addEventListener('DOMContentLoaded', function() {
    
    // Kelas untuk navigation aktif
    const activeClasses = ['bg-purple-600', 'text-white', 'shadow-lg', 'shadow-purple-600/30'];
    const inactiveClasses = ['text-gray-700', 'hover:bg-gray-50', 'hover:text-blue-900'];

    // Fungsi untuk set active navigation
    function setActiveNav(targetId) {
        // Reset semua navigation links
        document.querySelectorAll('.nav-link').forEach(link => {
            // Remove active classes
            link.classList.remove(...activeClasses);
            link.classList.remove('bg-blue-100', 'text-blue-900'); // Remove konflik class
            // Add inactive classes
            link.classList.add(...inactiveClasses);
        });

        // Set active untuk link yang sesuai
        const activeLink = document.querySelector(`[data-target="${targetId}"]`);
        if (activeLink) {
            // Remove inactive classes
            activeLink.classList.remove(...inactiveClasses);
            // Add active classes
            activeLink.classList.add(...activeClasses);
        }
        
        // Debug log
        console.log('Active navigation set to:', targetId);
    }

    // Event listener untuk click navigation - UNIFIED HANDLING
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = this.getAttribute('data-target');
            if (target) {
                // Update navigation state
                setActiveNav(target);
                
                // Scroll to target section smoothly
                const targetSection = document.getElementById(target);
                if (targetSection) {
                    targetSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
                
                // Update URL hash
                history.replaceState(null, null, `#${target}`);
            }
        });
    });

    // Intersection Observer dengan pengaturan yang lebih fleksibel
    const sections = document.querySelectorAll('section[id]');
    
    if (sections.length > 0) {
        const observerOptions = {
            threshold: [0.1, 0.3, 0.5], // Multiple thresholds untuk lebih akurat
            rootMargin: '-80px 0px -80px 0px' // Margin yang lebih kecil
        };

        const observer = new IntersectionObserver((entries) => {
            // Cari section yang paling terlihat
            let mostVisible = null;
            let maxRatio = 0;
            
            entries.forEach(entry => {
                if (entry.isIntersecting && entry.intersectionRatio > maxRatio) {
                    maxRatio = entry.intersectionRatio;
                    mostVisible = entry.target;
                }
            });
            
            // Update navigasi untuk section yang paling terlihat
            if (mostVisible) {
                setActiveNav(mostVisible.id);
                // Update URL hash
                history.replaceState(null, null, `#${mostVisible.id}`);
            }
        }, observerOptions);

        // Observe semua sections
        sections.forEach(section => {
            observer.observe(section);
            console.log('Observing section:', section.id); // Debug log
        });
    }

    // Alternative: Manual scroll detection sebagai backup
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            const scrollPos = window.scrollY + 150; // Offset untuk navbar
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;
                const sectionBottom = sectionTop + sectionHeight;
                
                // Check if current scroll position is within this section
                if (scrollPos >= sectionTop && scrollPos < sectionBottom) {
                    const currentActive = document.querySelector('.nav-link.bg-purple-600');
                    const shouldBeActive = document.querySelector(`[data-target="${section.id}"]`);
                    
                    // Only update if different from current
                    if (currentActive !== shouldBeActive) {
                        setActiveNav(section.id);
                        history.replaceState(null, null, `#${section.id}`);
                    }
                }
            });
        }, 100);
    });

    // Set active navigation berdasarkan URL hash saat halaman load
    function initializeNavigation() {
        const hash = window.location.hash.replace('#', '');
        const targetId = hash || 'beranda'; // Default ke beranda
        
        setActiveNav(targetId);
        
        // Scroll ke section jika ada hash
        if (hash) {
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                setTimeout(() => {
                    targetSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 100);
            }
        }
    }

    // Initialize navigation
    initializeNavigation();

    // Update active navigation saat hash berubah (browser back/forward)
    window.addEventListener('hashchange', () => {
        const hash = window.location.hash.replace('#', '');
        const targetId = hash || 'beranda';
        setActiveNav(targetId);
        
        // Scroll ke section
        const targetSection = document.getElementById(targetId);
        if (targetSection) {
            targetSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });

    // Smooth scrolling untuk anchor links (jika ada link dengan href="#...")
    document.querySelectorAll('a[href^="#"]:not(.nav-link)').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').replace('#', '');
            const target = document.getElementById(targetId);
            if (target) {
                // Scroll smoothly ke section
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                // Update navigation dan hash
                setActiveNav(targetId);
                history.replaceState(null, null, `#${targetId}`);
            }
        });
    });
    
}); // End DOMContentLoaded

// Mobile menu toggle
function toggleMobileMenu() {
    const navLinks = document.getElementById('navLinks');
    if (navLinks) {
        navLinks.classList.toggle('hidden');
    }
}

// Modal functions
function openModal() {
    const modal = document.getElementById('denahModal');
    if (modal) {
        modal.classList.remove('hidden');
    }
}

function closeModal() {
    const modal = document.getElementById('denahModal');
    if (modal) {
        modal.classList.add('hidden');
    }
}

// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    if (navbar) {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }
});
  
  // Close modal when clicking outside
  document.addEventListener('DOMContentLoaded', function() {
      const modal = document.getElementById('denahModal');
      if (modal) {
          modal.addEventListener('click', function(e) {
              if (e.target === this) {
                  closeModal();
              }
          });
      }
  });
  
  // FAQ Functions
  function toggleFAQ(button) {
      const answer = button.nextElementSibling;
      const icon = button.querySelector('svg');
      
      // Close all other FAQ items
      document.querySelectorAll('.bg-white').forEach(item => {
          const itemAnswer = item.querySelector('div.hidden, div:not(.hidden)');
          const itemIcon = item.querySelector('svg');
          if (itemAnswer && itemAnswer !== answer && !itemAnswer.classList.contains('hidden')) {
              itemAnswer.classList.add('hidden');
              if (itemIcon) itemIcon.classList.remove('rotate-180');
          }
      });
      
      // Toggle current FAQ item
      answer.classList.toggle('hidden');
      if (icon) icon.classList.toggle('rotate-180');
  }
  
  // FAQ Search Function
  document.addEventListener('DOMContentLoaded', function() {
      const faqSearch = document.getElementById('faqSearch');
      if (faqSearch) {
          faqSearch.addEventListener('input', function(e) {
              const searchTerm = e.target.value.toLowerCase();
              const faqItems = document.querySelectorAll('#faqAccordion > div');
              
              faqItems.forEach(item => {
                  const questionElement = item.querySelector('span');
                  const answerElement = item.querySelector('div:last-child div');
                  
                  const question = questionElement ? questionElement.textContent.toLowerCase() : '';
                  const answer = answerElement ? answerElement.textContent.toLowerCase() : '';
                  
                  if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                      item.style.display = 'block';
                  } else {
                      item.style.display = 'none';
                  }
              });
          });
      }
  });
  </script>
@endsection