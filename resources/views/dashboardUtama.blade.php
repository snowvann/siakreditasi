@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#EDEDED]">
    @include('components.dashboard-header')

<!-- Hero Section -->
<section class="bg-[#F2F2F2] pt-0 pb-0 border-b border-gray-300 relative">

    <!-- Bar Welcome To -->
<div class="bg-white border-y border-gray-300 w-full py-2 px-4">
    <p class="text-base md:text-lg font-medium text-black text-left pl-8">
        Welcome To
    </p>
</div>

    <!-- Konten Tengah -->
    <div class="relative bg-cover bg-center bg-no-repeat min-h-[250px] flex items-center justify-center" 
         style="background-image: url('{{ asset('images/bg1.png') }}');">
        
        <!-- Background overlay untuk memastikan text terlihat jelas -->
        
        <div class="relative z-10 text-center max-w-6xl mx-auto px-4 py-8">
            <h1 class="text-4xl md:text-5xl lg:text-8xl font-extrabold text-white tracking-[0.3em] mb-4 drop-shadow-2xl">
                AKREDITASI
            </h1>
            
            <p class="text-lg md:text-xl lg:text-3xl font-medium text-white tracking-wider uppercase mb-6 drop-shadow-lg">
                Program Studi D4 Sistem Informasi Bisnis
            </p>
        </div>
    </div>

    <!-- Bar Jurusan Teknologi Informasi -->
    <div class="bg-white border-y border-gray-300 w-full py-2 px-4">
        <p class="text-base md:text-lg text-center font-medium text-black">
            <strong>JURUSAN TEKNOLOGI INFORMASI | POLITEKNIK NEGERI MALANG</strong>
        </p>
    </div>

</section>


{{-- Carousel Gedung TI --}}
<div x-data="{ activeSlide: 0, slides: ['sipil.jpg', 'ti.jpg'] }" class="relative w-full overflow-hidden rounded shadow-lg">

    {{-- Slides --}}
    <template x-for="(slide, index) in slides" :key="index">
        <div
            x-show="activeSlide === index"
            class="w-full h-[650px] bg-cover bg-center transition-all duration-700 ease-in-out"
:style="`background-image: url('{{ asset('images') }}/${slide}')`"
        >
           <div class="absolute inset-0 bg-black bg-opacity-30 flex items-end p-6">
            <h2 class="text-white text-2xl md:text-3xl font-semibold leading-snug">
                GEDUNG JURUSAN<br>TEKNOLOGI INFORMASI
            </h2>
            
        </div>
        </div>
    </template>

    {{-- Left Arrow --}}
    <button @click="activeSlide = (activeSlide - 1 + slides.length) % slides.length"
        class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-60 hover:bg-opacity-90 rounded-full p-2">
        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    {{-- Right Arrow --}}
    <button @click="activeSlide = (activeSlide + 1) % slides.length"
        class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-60 hover:bg-opacity-90 rounded-full p-2">
        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M9 5l7 7-7 7" />
        </svg>
    </button>

    {{-- Dots --}}
    <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 flex space-x-2">
        <template x-for="(slide, index) in slides" :key="index">
            <button
                @click="activeSlide = index"
                :class="{
                    'bg-white': activeSlide === index,
                    'bg-gray-400': activeSlide !== index
                }"
                class="w-3 h-3 rounded-full transition duration-700"
            ></button>
        </template>
    </div>
</div>

<div class="bg-gray-100 px-6 py-10 rounded-md">
    {{-- Search Bar --}}
    <div class="flex justify-center mb-8">
        <div class="relative w-full max-w-xl">
            <input
                type="text"
                placeholder="Search....."
                class="text-center placeholder:text-center w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500"
            >
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5"
                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
            </svg>
        </div>
    </div>


<div class="bg-purple-100 p-6 rounded-lg mt-10">
    {{-- Judul Utama --}}
    <h2 class="text-xl md:text-2xl font-bold text-purple-800 mb-4">
        INFORMASI UMUM POLITEKNIK NEGERI MALANG
    </h2>
    

    <div class="grid md:grid-cols-2 gap-8 items-start">
        {{-- Gambar --}}
        <div class="order-1 md:order-1">
            <img src="{{ asset('images/as.jpg') }}"
                alt="Gedung Polinema"
                class="rounded-2xl shadow-lg w-full object-cover">
        </div>

        {{-- Teks --}}
        <div class="order-2 md:order-2">
            <h3 class="inline-block px-4 py-1 bg-purple-300 text-purple-900 text-2xl font-bold leading-tight rounded-md mb-4">
                PROFIL KAMPUS
            </h3>
            <p class="text-gray-800 leading-relaxed text-base md:text-lg text-justify">
                Polinema adalah institusi pendidikan tinggi vokasi yang terletak di kota Malang. Malang 
                adalah kota terbesar kedua di Jawa Timur, Indonesia. Malang merupakan tempat yang nyaman 
                untuk belajar karena udaranya yang sejuk dan populasi yang tidak begitu padat (sekitar 
                800 ribu penduduk). Di Malang terdapat banyak sekolah, universitas dan institusi pendidikan 
                lainnya dengan kualitas yang bagus. Selain itu, Malang merupakan tempat yang mudah dijangkau. 
                Kota ini dapat ditempuh dalam waktu 1 jam dari bandara internasional Juanda, Surabaya. Fasilitas 
                transportasi umum dalam kota yang bisa digunakan untuk menuju ke Polinema juga sangat memadai.
            </p>
            <p class="text-gray-800 leading-relaxed text-base md:text-lg text-justify mt-4">
                Polinema terus berkembang untuk menjadi institusi pendidikan vokasi yang superior dan siap 
                bersaing di dunia global. Polinema memiliki sistem pendidikan yang inovatif dan ketrampilan 
                kompetitif yang secara global dibutuhkan oleh industri, badan pemerintahan dan masyarakat. 
                Polinema mendukung penelitian terapan dan pengabdian masyarakat dalam bidang ilmu pengetahuan 
                dan pengembangan teknologi serta kesejahteraan masyarakat. Polinema juga berkomitmen untuk 
                melaksanakan sistem manajemen pendidikan dengan prinsip pemerintahan yang baik. Polinema juga 
                yakin bahwa atmosfer akademik yang kondusif sangat penting untuk memperbaiki kualitas sumber 
                daya manusia dan pengajaran yang mendukung belajar sepanjang hayat dan pertumbuhan jiwa wirausaha.
            </p>
        </div>
    </div>
</div>

<!-- sekat -->
    <div class="bg-[#413260] border-y border-gray-300 w-full py-2 px-4">
    <p class="text-base md:text-lg text-center font-medium text-[#413260]">
        <strong>.</strong>
    </p>
</div>


<div class="shadow-md p-6 rounded-lg mt-10 space-y-10">
    {{-- Judul Utama --}}
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-blue-900 mb-4">
                    PROFILE PROGRAM STUDI
        </h2>
        <span class="inline-block bg-blue-800 text-white text-xl font-semibold px-4 py-2 rounded-md mb-6">
            Sistem Informasi Bisnis
        </span>
        <!-- Grid Konten Utama -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
            <!-- Kolom Gambar -->
           <div class="flex justify-center items-center h-full mt-6 md:mt-0">
    <img src="{{ asset('images/atasan.jpg') }}" alt="Foto Prodi" class="rounded-md shadow-lg w-full max-w-2xl">
</div>

            <!-- Kolom Teks -->
            <div class="text-gray-800 text-lg md:text-xl leading-relaxed space-y-6 text-justify pr-2">
                <p>
                    Program Studi Manajemen Informatika berdiri 24 Juni 2005 berdasarkan SK Mendiknas Nomor: 2001/D/T/2005 di bawah Jurusan Teknik Elektro Politeknik Negeri Malang. Dalam surat keputusan tersebut Politeknik Negeri Malang diberikan ijin untuk menyelenggarakan pendidikan Program Studi Manajemen Informatika untuk jenjang program Diploma (DIII) Politeknik. Program Studi Manajemen Informatika melakukan perubahan pada sebagian kurikulumnya menyesuaikan perkembangan teknologi informasi dan kebutuhan dunia kerja saat ini. Mulai tahun akademik 2006/2007, kurikulum Program Studi Manajemen Informatika menggunakan kurikulum 5-1 (lima semester di kampus dan satu semester di industri) yang ditawarkan dengan jumlah total 120 SKS. Pada tahun 2022, Program Studi Manajemen Informatika mengikuti program upgrading prodi yang dilaksanakan oleh Kemendikbudristek.
                </p>
                <p>
                    Program Upgrading merupakan peningkatan program studi dari Diploma Tiga menjadi Diploma Empat atau Sarjana Terapan. Berdasarkan pada Surat Keputusan Mendikbudristek Nomor 33/D/OT/2022, izin pembukaan Program Studi Sarjana Terapan Sistem Informasi Bisnis secara resmi disetujui. Selanjutnya pada Semester Ganjil Tahun Ajaran 2022/2023, Prodi Sarjana Terapan Sistem Informasi Bisnis Jurusan Teknologi Informasi Politeknik Negeri Malang menerima mahasiswa baru.
                </p>
                
            </div>
        </div>
    </div>
</div>

    {{-- Visi dan Misi --}}
    <div>
        <div class="bg-[#EDE9F7] py-10 px-6">
            <h2 class="bg-blue-900 text-white px-4 py-2 rounded-md text-xl font-semibold inline-block mb-4">
            Visi dan Misi
        </h2>
    <div class="max-w-6xl mx-auto text-center space-y-6">
        
        <!-- VISI -->
<div>
    <p class="bg-[#3C2464] text-white font-bold py-2 px-6 inline-block rounded-full mb-3">VISI</p>
    <p class="text-gray-800 text-lg md:text-xl font-medium">
        Menjadi Program Studi Unggul dalam Bidang Sistem Informasi Bisnis di Tingkat Nasional dan Internasional.
    </p>
</div>

<!-- MISI -->
<p class="bg-[#3C2464] text-white font-bold py-2 px-6 inline-block rounded-full mb-6">MISI</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start text-left">
        <!-- Gambar -->
<div class="flex justify-center h-full">
    <img src="{{ asset('images/jti.jpeg') }}"
         alt="Foto JTI"
         class="rounded-lg shadow-lg w-full h-[500px] object-cover object-center">
</div>

        <!-- List Misi -->
        <div class="space-y-6 text-gray-800 text-lg md:text-xl">
            <!-- Misi 1 -->
            <div class="flex items-start gap-4">
                <div class="bg-[#3C2464] p-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-white w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2" />
                    </svg>
                </div>
                <p>
                    Melaksanakan pendidikan vokasi yang inovatif berdasarkan pada sistem pendidikan terapan dengan memanfaatkan kemajuan teknologi, sehingga mampu menghasilkan lulusan yang memiliki kompetensi di bidang sistem informasi bisnis dan siap bersaing di tingkat nasional dan global.
                </p>
            </div>

            <!-- Misi 2 -->
            <div class="flex items-start gap-4">
                <div class="bg-[#3C2464] p-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-white w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </div>
                <p>
                    Melaksanakan penelitian terapan berbasis produk dan jasa bidang Sistem Informasi Bisnis.
                </p>
            </div>

            <!-- Misi 3 -->
            <div class="flex items-start gap-4">
                <div class="bg-[#3C2464] p-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-white w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3 10h8l3-10h4" />
                    </svg>
                </div>
                <p>
                    Melaksanakan pengabdian masyarakat dengan menggunakan kemajuan Sistem Informasi Bisnis untuk meningkatkan kesejahteraan.
                </p>
            </div>

            <!-- Misi 4 -->
            <div class="flex items-start gap-4">
                <div class="bg-[#3C2464] p-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-white w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.1 0 2 .9 2 2s-.9 2-2 2m0 0c-1.1 0-2-.9-2-2s.9-2 2-2zm0 0v6" />
                    </svg>
                </div>
                <p>
                    Mewujudkan kerja sama yang saling menguntungkan dengan berbagai pihak baik di dalam maupun di luar negeri pada bidang Sistem Informasi Bisnis.
                </p>
            </div>
        </div>
    </div>
</div>

    </div>
</div>

   <div class="bg-[#E6DDF8] py-10 px-4">
  <h2 class="text-white bg-[#3C2464] inline-block px-4 py-2 rounded-md font-bold mb-10 text-lg">Tujuan Program Studi</h2>
  <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
           <!-- CARD 1 -->
        <div class="relative bg-white rounded-2xl shadow-md p-5 pt-10 flex flex-col text-center">
            <div class="absolute -top-4 left-4 bg-[#3C2464] text-white w-10 h-10 flex items-center justify-center rounded-full text-lg font-bold z-10">1</div>
            <p class="text-base md:text-lg text-gray-800 mb-4 leading-relaxed">
            Menghasilkan lulusan bidang Sistem Informasi Bisnis yang berketuhanan, beretika dan bermoral baik, berpengetahuan dan berketerampilan tinggi, siap bekerja dan/atau berwirausaha yang mampu bersaing dalam skala nasional maupun internasional.
            </p>
            <div class="w-full h-[130px] overflow-hidden rounded-xl">
            <img src="images/1.jpg" alt="Tujuan 1" class="w-full h-full object-cover object-center">
            </div>
        </div>

        <!-- CARD 2 -->
        <div class="relative bg-white rounded-2xl shadow-md p-5 pt-10 flex flex-col text-center">
            <div class="absolute -top-4 left-4 bg-[#3C2464] text-white w-10 h-10 flex items-center justify-center rounded-full text-lg font-bold z-10">2</div>
            <p class="text-base md:text-lg text-gray-800 mb-4 leading-relaxed">
            Menghasilkan penelitian terapan bidang Sistem Informasi Bisnis yang berskala nasional dan internasional, meningkatkan efektivitas, efisiensi, dan produktivitas dalam dunia usaha dan industri, serta mengarah pada pencapaian Hak atas Kekayaan Intelektual (HaKI), perolehan paten, dan kesejahteraan masyarakat.
            </p>
            <div class="w-full h-[130px] overflow-hidden rounded-xl">
            <img src="images/2.jpg" alt="Tujuan 2" class="w-full h-full object-cover object-center">
            </div>
        </div>

        <!-- CARD 3 -->
        <div class="relative bg-white rounded-2xl shadow-md p-5 pt-10 flex flex-col text-center">
            <div class="absolute -top-4 left-4 bg-[#3C2464] text-white w-10 h-10 flex items-center justify-center rounded-full text-lg font-bold z-10">3</div>
            <p class="text-base md:text-lg text-gray-800 mb-4 leading-relaxed">
            Menghasilkan pengabdian kepada masyarakat yang dilaksanakan melalui penerapan dan penyebarluasan ilmu pengetahuan dan teknologi serta pemberian layanan jasa secara profesional dalam bidang Sistem Informasi Bisnis sehingga bermanfaat secara langsung dalam meningkatkan kesejahteraan masyarakat.
            </p>
            <div class="w-full h-[130px] overflow-hidden rounded-xl">
            <img src="images/3.jpg" alt="Tujuan 3" class="w-full h-full object-cover object-center">
            </div>
        </div>

        <!-- CARD 4 -->
        <div class="relative bg-white rounded-2xl shadow-md p-5 pt-10 flex flex-col text-center">
            <div class="absolute -top-4 left-4 bg-[#3C2464] text-white w-10 h-10 flex items-center justify-center rounded-full text-lg font-bold z-10">4</div>
            <p class="text-base md:text-lg text-gray-800 mb-4 leading-relaxed">
            Terwujudnya kerjasama yang saling menguntungkan dengan berbagai pihak baik di dalam maupun di luar negeri pada bidang Sistem Informasi Bisnis untuk meningkatkan daya saing.
            </p>
            <div class="w-full h-[130px] overflow-hidden rounded-xl">
            <img src="images/4.jpg" alt="Tujuan 4" class="w-full h-full object-cover object-center">
            </div>
        </div>

</div>
</div>

</div>
@endsection
