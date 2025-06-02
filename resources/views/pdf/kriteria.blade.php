<!DOCTYPE html>
<html>
<head>
    <title>Detail{{ $kriteria->nama_kriteria }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; }
        th { background-color: #f0f0f0; }
        .subkriteria-name { font-weight: bold; margin-top: 15px; }
        .nilai { white-space: pre-wrap; } /* biar newline tetap muncul */
    </style>
</head>
<body>
    <h1>Detail {{ $kriteria->nama_kriteria }}</h1>
    <p>{{ $kriteria->deskripsi }}</p>

    @foreach($kriteria->subkriteria as $sub)
        <div class="subkriteria-name">{{ $sub->nama_subkriteria }}</div>
        <p>{{ $sub->deskripsi }}</p>

        <table>
            <thead>
                <tr>
                    <th>Isian</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sub->isian as $isian)
                <tr>
                    <td class="nilai">{!! nl2br(e($isian->nilai)) !!}</td>
                </tr>
                @empty
                <tr>
                    <td>Tidak ada isian</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    @endforeach
</body>
</html>
