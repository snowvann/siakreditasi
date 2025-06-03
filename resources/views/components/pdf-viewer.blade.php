<div class="rounded-lg border bg-card text-card-foreground shadow-sm p-6 h-full">
    <h2 class="text-lg font-semibold mb-4">Pratinjau Dokumen PDF</h2>
    @if($pdfUrl)
        <div class="pdf-viewer-container" style="width: 100%; height: 600px; border: 1px solid #ccc; overflow: auto;">
            <embed src="{{ $pdfUrl }}#toolbar=0" type="application/pdf" width="100%" height="100%">
        </div>
        <div class="mt-4 flex gap-2">
            <a href="{{ $pdfUrl }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
                Lihat di Tab Baru
            </a>
        </div>
    @else
        <p class="text-gray-500">Belum ada dokumen PDF yang tersedia untuk pratinjau. Silakan minta anggota untuk mengisi dan mengunggah PDF terlebih dahulu.</p>
    @endif
</div>