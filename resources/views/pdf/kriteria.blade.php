<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kriteria {{ $kriteria->id }} - {{ $kriteria->nama_kriteria ?? 'Kriteria' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        
        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #666;
        }
        
        .kriteria-info {
            margin-bottom: 25px;
            background-color: #f8f9fa;
            padding: 15px;
            border-left: 4px solid #007bff;
        }
        
        .kriteria-info h2 {
            margin: 0 0 10px 0;
            font-size: 16px;
            color: #007bff;
        }
        
        .subkriteria {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        
        .subkriteria-header {
            background-color: #e9ecef;
            padding: 10px;
            border: 1px solid #dee2e6;
            margin-bottom: 10px;
        }
        
        .subkriteria-header h3 {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
        }
        
        .subkriteria-content {
            border: 1px solid #dee2e6;
            padding: 15px;
            background-color: #fff;
        }
        
        .isian-content {
            line-height: 1.6;
        }
        
        .isian-content img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px 0;
            border: 1px solid #ddd;
        }
        
        .isian-content p {
            margin: 8px 0;
        }
        
        .isian-content ul, .isian-content ol {
            margin: 8px 0;
            padding-left: 20px;
        }
        
        .no-data {
            color: #6c757d;
            font-style: italic;
            text-align: center;
            padding: 20px;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        
        table th, table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }
        
        table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        
        .isian-content strong {
            font-weight: bold;
        }
        
        .isian-content em {
            font-style: italic;
        }
        
        .isian-content a {
            color: #007bff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN KRITERIA AKREDITASI</h1>
        <p>Kriteria {{ $kriteria->id }}: {{ $kriteria->nama_kriteria ?? 'Tidak Ada Nama' }}</p>
        <p>Tanggal Cetak: {{ date('d F Y, H:i') }} WIB</p>
    </div>

    <div class="kriteria-info">
        <h2>Informasi Kriteria</h2>
        <p><strong>ID Kriteria:</strong> {{ $kriteria->id }}</p>
        <p><strong>Nama Kriteria:</strong> {{ $kriteria->nama_kriteria ?? 'Tidak Ada Nama' }}</p>
        <p><strong>Deskripsi:</strong> {{ $kriteria->deskripsi ?? 'Tidak ada deskripsi' }}</p>
        <p><strong>Jumlah Sub-kriteria:</strong> {{ $kriteria->subkriteria->count() }}</p>
    </div>

    @if($kriteria->subkriteria->count() > 0)
        @foreach($kriteria->subkriteria as $index => $subkriteria)
            @if($index > 0)
                <div class="page-break"></div>
            @endif
            
            <div class="subkriteria">
                <div class="subkriteria-header">
                    <h3>{{ $index + 1 }}. {{ $subkriteria->nama_subkriteria }}</h3>
                </div>
                
                <div class="subkriteria-content">
                    @if($subkriteria->isian->count() > 0)
                        @foreach($subkriteria->isian as $isian)
                            <div class="isian-content">
                                @if(!empty($isian->nilai))
                                    {!! $isian->nilai !!}
                                @else
                                    <div class="no-data">
                                        Belum ada data yang diisi untuk sub-kriteria ini.
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="no-data">
                            Belum ada data yang diisi untuk sub-kriteria ini.
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div class="no-data">
            <p>Tidak ada sub-kriteria yang ditemukan untuk kriteria ini.</p>
        </div>
    @endif

    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis dari sistem akreditasi.</p>
        <p>Halaman dibuat pada {{ date('d F Y, H:i:s') }} WIB</p>
    </div>
</body>
</html>