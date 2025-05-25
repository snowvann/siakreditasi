@props(['existingFile' => null, 'isDisabled' => false])

<div class="rounded-lg border bg-card text-card-foreground shadow-sm">
    <div class="p-6">
        <h2 class="text-lg font-semibold">Lampiran</h2>
        <p class="text-sm text-muted-foreground">Unggah dokumen pendukung untuk sub-kriteria ini.</p>
    </div>
    <div class="p-6 pt-0">
        @if($existingFile)
            <div class="rounded-lg border p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-blue-600">
                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                        </svg>
                        <div>
                            <div class="font-medium">Dokumen Pendukung</div>
                            <div class="text-sm text-muted-foreground">{{ basename($existingFile) }}</div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-3">
                            Lihat
                        </button>
                        @if(!$isDisabled)
                            <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-3 text-red-600 hover:text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1 h-4 w-4">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                                Hapus
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="flex items-center justify-center border-2 border-dashed rounded-lg p-12">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto h-12 w-12 text-muted-foreground">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                    <h3 class="mt-2 text-lg font-semibold">Unggah Lampiran</h3>
                    <p class="mt-1 text-sm text-muted-foreground">
                        Seret dan lepas file di sini, atau klik untuk memilih file
                    </p>
                    <button class="mt-4 inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2" {{ $isDisabled ? 'disabled' : '' }}>
                        Pilih File
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>