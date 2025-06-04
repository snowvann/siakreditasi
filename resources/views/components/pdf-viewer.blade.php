    <!-- PDF Preview -->
    <div class="rounded-lg border shadow bg-white overflow-hidden">
        <iframe
            src="{{ route('validator.kriteria.preview', $kriteria->id) }}"
            class="w-full h-[80vh]"
            frameborder="0"
        ></iframe>
    </div>
</div>
