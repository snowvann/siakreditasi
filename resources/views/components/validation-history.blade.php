@props(['logs' => []])

@if(count($logs) === 0)
    <div class="mt-2 text-sm text-muted-foreground">Belum ada riwayat validasi untuk sub-kriteria ini.</div>
@else
    <div class="mt-2 space-y-4">
        @foreach($logs as $log)
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <div class="p-4">
                <div class="flex items-start gap-3">
                    @if($log['status_sesudah'] === 'validated')
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-600 mt-0.5">
                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                            <path d="m9 12 2 2 4-4"></path>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-amber-600 mt-0.5">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="m15 9-6 6"></path>
                            <path d="m9 9 6 6"></path>
                        </svg>
                    @endif
                    <div class="flex-1">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">
                            <div class="font-medium">
                                {{ $log['peran_validator'] }} {{ $log['status_sesudah'] === 'validated' ? 'menyetujui' : 'meminta revisi' }}
                            </div>
                            <div class="text-sm text-muted-foreground">{{ $log['created_at'] }}</div>
                        </div>
                        @if($log['komentar'])
                            <div class="mt-2 text-sm">{{ $log['komentar'] }}</div>
                        @endif
                        <div class="mt-2 text-xs text-muted-foreground">
                            Status berubah dari
                            <span class="font-medium">
                                {{ $log['status_sebelum'] === 'menunggu_validasi' ? 'Menunggu Validasi' : $log['status_sebelum'] }}
                            </span>
                            menjadi
                            <span class="font-medium">
                                {{ $log['status_sesudah'] === 'validated' ? 'Tervalidasi' : $log['status_sesudah'] }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif