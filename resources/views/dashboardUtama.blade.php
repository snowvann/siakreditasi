@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#EDEDED]">
    @include('components.dashboard-header')

   <!-- Hero Section -->
    <section class="bg-[#F2F2F2] py-12 border-b border-gray-300 relative">
     <!-- Bar Welcome To -->
     <div class="bg-white border-y border-gray-300 w-full py-2 px-4">
        <p class="text-base md:text-lg font-semibold text-black">Welcome To</p>
    </div>

    <div class="text-center max-w-6xl mx-auto px-4">
    <h1 class="text-5xl md:text-7xl font-extrabold text-black tracking-widest mb-4">
            AKREDITASI
        </h1>

    <p class="text-xl md:text-xl font-semibold text-black tracking-wide uppercase mb-6">
            Program Studi D4 Sistem Informasi Bisnis
    </p>
</div>

    <!-- Bar Jurusan Teknologi Informasi -->
    <div class="bg-white border-y border-gray-300 w-full py-1 px-4">
        <p class="md:text-lg text-center font-semibold text-black">JURUSAN TEKNOLOGI INFORMASI | POLITEKNIK NEGERI MALANG</p>
    </div>
</section>



{{-- Carousel Gedung TI --}}
<div x-data="{ activeSlide: 0, slides: ['sipil.jpg', 'ti.jpg'] }" class="relative w-full overflow-hidden rounded shadow-lg">

    {{-- Slides --}}
    <template x-for="(slide, index) in slides" :key="index">
        <div
            x-show="activeSlide === index"
            class="w-full h-[650px] bg-cover bg-center transition-all duration-700 ease-in-out"
            :style="`background-image: url('/images/${slide}')`"
        >
           <div class="absolute inset-0 bg-black bg-opacity-30 flex items-end p-6">
            <h2 class="text-white text-4xl font-bold leading-tight">
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

    {{-- Title --}}
    <h2 class="md:text-3xl font-bold leading-tight text-purple-800 mb-6">INFORMASI AKREDITASI</h2>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    {{-- Card 1 --}}
    <div class="bg-gradient-to-b from-[#EFDDFF] to-[#C1C1C2] p-6 rounded-lg shadow">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-base font-semibold text-gray-800">Total Kriteria</p>
                <h3 class="text-2xl font-bold text-black">9</h3>
                <p class="text-sm text-gray-600">9 kriteria harus diisi</p>
            </div>
            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h10m-7 4h7M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
            </svg>
        </div>
    </div>

    {{-- Card 2 --}}
    <div class="bg-gradient-to-b from-[#EFDDFF] to-[#C1C1C2] p-6 rounded-lg shadow">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-base font-semibold text-gray-800">Kriteria Terisi</p>
                <h3 class="text-2xl font-bold text-black">4</h3>
                <p class="text-sm text-gray-600">Dari 9 kriteria</p>
            </div>
            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h10m-7 4h7M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
            </svg>
        </div>
    </div>

    {{-- Card 3 --}}
    <div class="bg-gradient-to-b from-[#EFDDFF] to-[#C1C1C2] p-6 rounded-lg shadow">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-base font-semibold text-gray-800">Kriteria Tervalidasi</p>
                <h3 class="text-2xl font-bold text-black">3</h3>
                <p class="text-sm text-gray-600">Dari 9 kriteria</p>
            </div>
            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4-4" />
                <circle cx="12" cy="12" r="10" />
            </svg>
        </div>
    </div>

    {{-- Card 4 --}}
    <div class="bg-gradient-to-b from-[#EFDDFF] to-[#C1C1C2] p-6 rounded-lg shadow">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-base font-semibold text-gray-800">Total Anggota</p>
                <h3 class="text-2xl font-bold text-black">7</h3>
                <p class="text-sm text-gray-600">9 kriteria harus diisi</p>
            </div>
            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1m-6 6H4v-2a4 4 0 014-4h1m5-4a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
    </div>
</div>



<div class="bg-purple-100 p-6 rounded-lg mt-10">
    {{-- Judul Utama --}}
    <h2 class="text-2xl md:text-3xl font-bold leading-tight text-purple-800 mb-6">
        INFORMASI UMUM POLITEKNIK NEGERI MALANG
    </h2>

    <div class="grid md:grid-cols-2 gap-6 items-center">
        {{-- Teks --}}
        <div>
            <h3 class="inline-block px-4 py-1 bg-purple-300 text-purple-900 text-2xl font-bold leading-tight rounded-md mb-4">
                PROFIL KAMPUS
            </h3>
            <p class="text-justify text-gray-800 leading-relaxed text-lg md:text-xl">
                Polinema adalah institusi pendidikan tinggi vokasi yang terletak di kota Malang. Malang 
                adalah kota terbesar kedua di Jawa Timur, Indonesia. Malang merupakan tempat yang nyaman 
                untuk belajar karena udaranya yang sejuk dan populasi yang tidak begitu padat (sekitar 
                800 ribu penduduk). Di Malang terdapat banyak sekolah, universitas dan institusi pendidikan 
                lainnya dengan kualitas yang bagus. Selain itu, Malang merupakan tempat yang mudah dijangkau. 
                Kota ini dapat ditempuh dalam waktu 1 jam dari bandara internasional Juanda, Surabaya. Fasilitas 
                transportasi umum dalam kota yang bisa digunakan untuk menuju ke Polinema juga sangat memadai.
            </p>

        </div>

        {{-- Gambar --}}
        <div>
            <img src="{{asset('images/as.jpg') }}"
                alt="Gedung Polinema"
                class="rounded-2xl shadow-lg w-full object-cover"
            >
        </div>
    </div>
</div>

<div class="shadow-md p-6 rounded-lg mt-10 space-y-10">
    {{-- Judul Utama --}}
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4">
            PROFILE PROGRAM STUDI
        </h2>
        <span class="inline-block bg-blue-800 text-white text-xl font-semibold px-4 py-2 rounded-md mb-6">
            Sistem Informasi Bisnis
        </span>
        <div class="text-gray-800 text-lg md:text-xl leading-relaxed space-y-4 text-justify">
            <p>
                Program Studi Manajemen Informatika berdiri 24 Juni 2005 berdasarkan SK Mendiknas Nomor: 2001/D/T/2005 di bawah Jurusan Teknik Elektro Politeknik Negeri Malang. Dalam surat keputusan tersebut Politeknik Negeri Malang diberikan ijin untuk menyelenggarakan pendidikan Program Studi Manajemen Informatika untuk jenjang program Diploma (DIII) Politeknik. Program Studi Manajemen Informatika melakukan perubahan pada sebagian kurikulumnya menyesuaikan perkembangan teknologi informasi dan kebutuhan dunia kerja saat ini. Mulai tahun akademik 2006/2007, kurikulum Program Studi Manajemen Informatika menggunakan kurikulum 5-1 (lima semester di kampus dan satu semester di industri) yang ditawarkan dengan jumlah total 120 SKS. Pada tahun 2022, Program Studi Manajemen Informatika mengikuti program upgrading prodi yang dilaksanakan oleh Kemendikbudristek.
            </p>
            <p>
                Program Upgrading merupakan peningkatan program studi dari Diploma Tiga menjadi Diploma Empat atau Sarjana Terapan. Berdasarkan pada Surat Keputusan Mendikbudristek Nomor 33/D/OT/2022, izin pembukaan Program Studi Sarjana Terapan Sistem Informasi Bisnis secara resmi disetujui. Selanjutnya pada Semester Ganjil Tahun Ajaran 2022/2023, Prodi Sarjana Terapan Sistem Informasi Bisnis Jurusan Teknologi Informasi Politeknik Negeri Malang menerima mahasiswa baru.
            </p>
            <p>
                Program Studi Manajemen Informatika berdiri 24 Juni 2005 berdasarkan SK Mendiknas Nomor: 2001/D/T/2005 di bawah Jurusan Teknik Elektro Politeknik Negeri Malang. Dalam surat keputusan tersebut Politeknik Negeri Malang diberikan ijin untuk menyelenggarakan pendidikan Program Studi Manajemen Informatika untuk jenjang program Diploma (DIII) Politeknik.
            </p>
        </div>

    </div>

    {{-- Visi dan Misi --}}
    <div>
        <h2 class="bg-blue-900 text-white px-4 py-2 rounded-md text-xl font-semibold inline-block mb-4">
            Visi dan Misi
        </h2>
        <div class="text-gray-800 text-lg md:text-xl space-y-4 text-justify">
            <p><strong>VISI :</strong><br>
            Menjadi Program Studi Unggul dalam Bidang Sistem Informasi Bisnis di Tingkat Nasional dan Internasional.
        </p>
        <p><strong>MISI :</strong></p>
        <ul class="list-disc list-inside space-y-2">
            <li>Melaksanakan pendidikan vokasi yang inovatif berdasarkan pada sistem pendidikan terapan dengan memanfaatkan kemajuan teknologi, sehingga mampu menghasilkan lulusan yang memiliki kompetensi di bidang sistem informasi bisnis dan siap bersaing di tingkat nasional dan global.</li>
            <li>Melaksanakan penelitian terapan berbasis produk dan jasa bidang Sistem Informasi Bisnis.</li>
            <li>Melaksanakan pengabdian masyarakat dengan menggunakan kemajuan Sistem Informasi Bisnis untuk meningkatkan kesejahteraan.</li>
            <li>Mewujudkan kerja sama yang saling menguntungkan dengan berbagai pihak baik di dalam maupun di luar negeri pada bidang Sistem Informasi Bisnis.</li>
        </ul>
        </div>
    </div>

    {{-- Tujuan Program Studi --}}
    <div>
        <h2 class="bg-blue-900 text-white px-4 py-2 rounded-md text-xl font-semibold inline-block mb-4">
            Tujuan Program Studi
        </h2>
        <div class="text-gray-800 text-lg md:text-xl space-y-4 text-justify">
        <p><strong>Tujuan Program Studi Sistem Informasi Bisnis sebagai berikut:</strong></p>
        <ul class="list-disc list-inside space-y-2">
            <li>Menghasilkan lulusan bidang Sistem Informasi Bisnis yang berketuhanan, beretika dan bermoral baik, berpengetahuan dan berketerampilan tinggi, siap bekerja dan/atau berwirausaha yang mampu bersaing dalam skala nasional maupun internasional.</li>
            <li>Menghasilkan penelitian terapan bidang Sistem Informasi Bisnis yang berskala nasional dan internasional, meningkatkan efektivitas, efisiensi, dan produktivitas dalam dunia usaha dan industri, serta mengarah pada pencapaian Hak atas Kekayaan Intelektual (HaKI), perolehan paten, dan kesejahteraan masyarakat.</li>
            <li>Menghasilkan pengabdian kepada masyarakat yang dilaksanakan melalui penerapan dan penyebarluasan ilmu pengetahuan dan teknologi serta pemberian layanan jasa secara profesional dalam bidang Sistem Informasi Bisnis sehingga bermanfaat secara langsung dalam meningkatkan kesejahteraan masyarakat.</li>
            <li>Terwujudnya kerja sama yang saling menguntungkan dengan berbagai pihak baik di dalam maupun di luar negeri pada bidang Sistem Informasi Bisnis untuk meningkatkan daya saing.</li>
        </ul>
    </div>
    </div>
</div>
@endsection
