@props([])

<div x-data="{ 
    open: false,
    validationStatus: null,
    note: ''
}">
    <!-- Trigger Button -->
    <button 
        @click="open = true" 
        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2"
    >
        Validasi
    </button>

    <!-- Dialog -->
    <div 
        x-show="open" 
        @click.away="open = false" 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" 
        style="display: none;"
    >
        <div class="bg-white rounded-lg max-w-md w-full mx-4">
            <div class="p-6">
                <h2 class="text-lg font-semibold">Validasi Sub-kriteria</h2>
                <p class="text-sm text-muted-foreground mt-1">
                    Berikan validasi untuk sub-kriteria ini. Jika tidak valid, berikan catatan untuk perbaikan.
                </p>

                <div class="grid gap-4 mt-6">
                    <div class="grid grid-cols-2 gap-4">
                        <button 
                            @click="validationStatus = 'valid'"
                            :class="{
                                'bg-green-600 hover:bg-green-700 text-white': validationStatus === 'valid',
                                'border border-input bg-background hover:bg-accent hover:text-accent-foreground': validationStatus !== 'valid'
                            }"
                            class="flex-1 flex items-center justify-center gap-2 rounded-md p-2"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                <path d="M7 10v12"></path>
                                <path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"></path>
                            </svg>
                            Valid
                        </button>
                        <button 
                            @click="validationStatus = 'revisi'"
                            :class="{
                                'bg-amber-600 hover:bg-amber-700 text-white': validationStatus === 'revisi',
                                'border border-input bg-background hover:bg-accent hover:text-accent-foreground': validationStatus !== 'revisi'
                            }"
                            class="flex-1 flex items-center justify-center gap-2 rounded-md p-2"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                <path d="M17 14V2"></path>
                                <path d="M9 18.12 10 14H4.17a2 2 0 0 1-1.92-2.56l2.33-8A2 2 0 0 1 6.5 2H20a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.76a2 2 0 0 0-1.79 1.11L12 22h0a3.13 3.13 0 0 1-3-3.88Z"></path>
                            </svg>
                            Perlu Revisi
                        </button>
                    </div>

                    <div class="grid gap-2">
                        <label class="text-sm font-medium">Catatan Validasi</label>
                        <textarea 
                            x-model="note"
                            placeholder="Berikan catatan untuk validasi ini..."
                            class="flex min-h-[100px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                        ></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <button 
                        @click="open = false" 
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2"
                    >
                        Batal
                    </button>
                    <button 
                        @click="
                            // Handle form submission here
                            open = false
                        " 
                        :disabled="!validationStatus"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2"
                    >
                        Simpan Validasi
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>