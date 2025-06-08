<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tabel users (without email fields)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['Validator', 'Anggota', 'SuperAdmin'])->default('Anggota');
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // Tabel kriteria
        Schema::create('kriteria', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kriteria');
            $table->enum('status', ['pending', 'needs_revision', 'validated'])->default('pending');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // Tabel subkriteria
        Schema::create('subkriteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_id')->constrained('kriteria')->onDelete('cascade');
            $table->string('nama_subkriteria');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // Tabel akreditasi
        Schema::create('akreditasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['diajukan', 'divalidasi', 'ditolak'])->default('diajukan');
            $table->timestamps();
        });

        // Tabel pivot kriteria_user
        Schema::create('kriteria_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kriteria_id')->constrained('kriteria')->onDelete('cascade');
            $table->timestamps();
        });

        // Tabel validasi_kriteria
        Schema::create('validasi_kriteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akreditasi_id')->constrained('akreditasi')->onDelete('cascade');
            $table->foreignId('kriteria_id')->constrained('kriteria')->onDelete('cascade');
            $table->enum('status', ['belum', 'valid', 'tidak valid'])->default('belum');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        // Tabel validasi_log
        Schema::create('validasi_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('validasi_kriteria_id')->constrained('validasi_kriteria')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        // Tabel notifikasi
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('judul');
            $table->text('pesan');
            $table->boolean('dibaca')->default(false);
            $table->timestamps();
        });

        // Tabel dokumen_template
        Schema::create('dokumen_template', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_id')->constrained('kriteria')->onDelete('cascade');
            $table->string('nama_file');
            $table->string('path');
            $table->timestamps();
        });

        // Tabel komentar_validasi
        Schema::create('komentar_validasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('validasi_kriteria_id')->constrained('validasi_kriteria')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('komentar');
            $table->timestamps();
        });

        // Tabel pengaturan_sistem
        Schema::create('pengaturan_sistem', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value');
            $table->timestamps();
        });

        // Tabel audit_logs
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('aksi');
            $table->text('deskripsi')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->timestamps();
        });

        // Tabel file_uploads
        Schema::create('file_uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akreditasi_id')->constrained('akreditasi')->onDelete('cascade');
            $table->string('nama_file');
            $table->string('path');
            $table->timestamps();
        });

        // Tabel sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('file_uploads');
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('pengaturan_sistem');
        Schema::dropIfExists('komentar_validasi');
        Schema::dropIfExists('dokumen_template');
        Schema::dropIfExists('notifikasi');
        Schema::dropIfExists('validasi_log');
        Schema::dropIfExists('validasi_kriteria');
        Schema::dropIfExists('kriteria_user');
        Schema::dropIfExists('akreditasi');
        Schema::dropIfExists('subkriteria');
        Schema::dropIfExists('kriteria');
        Schema::dropIfExists('users');
    }
};