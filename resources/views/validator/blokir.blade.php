<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Dibatasi - Menunggu Validasi</title>
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #ec4899;
            --accent: #06b6d4;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #0f172a;
            --light: #f8fafc;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, var(--gray-50) 0%, #ffffff 100%);
            min-height: 100vh;
            color: var(--gray-800);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--gray-200);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            display: flex;
            align-items: center;
            gap: 1rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .back-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            background: var(--light);
            border: 1px solid var(--gray-200);
            border-radius: 0.75rem;
            color: var(--gray-600);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateX(-2px);
        }

        .header-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-900);
        }

        /* Main Content */
        .main-content {
            padding: 2rem 0;
        }

        .content-wrapper {
            max-width: 800px;
            margin: 0 auto;
        }

        /* Alert Card */
        .alert-card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--gray-100);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .alert-header {
            background: linear-gradient(135deg, var(--warning) 0%, #fbbf24 100%);
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .alert-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .warning-icon {
            width: 4rem;
            height: 4rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            position: relative;
            z-index: 1;
        }

        .warning-icon svg {
            width: 2rem;
            height: 2rem;
            color: white;
        }

        .alert-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .alert-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
            position: relative;
            z-index: 1;
        }

        .alert-body {
            padding: 2rem;
        }

        .alert-description {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--gray-600);
            margin-bottom: 2rem;
            text-align: center;
        }

        /* Info Card */
        .info-card {
            background: linear-gradient(135deg, var(--accent) 0%, #0891b2 100%);
            border-radius: 1rem;
            padding: 1.5rem;
            margin: 2rem 0;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }

        .info-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .info-icon {
            width: 1.5rem;
            height: 1.5rem;
            flex-shrink: 0;
        }

        .info-title {
            font-weight: 600;
            font-size: 1rem;
        }

        .info-details {
            display: grid;
            gap: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .info-item {
            font-size: 0.875rem;
            opacity: 0.95;
        }

        .info-label {
            font-weight: 500;
        }

        /* Action Buttons */
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 500;
            font-size: 0.875rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-secondary {
            background: var(--gray-100);
            color: var(--gray-700);
            border: 1px solid var(--gray-200);
        }

        .btn-secondary:hover {
            background: var(--gray-200);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        .btn svg {
            width: 1rem;
            height: 1rem;
        }

        /* Process Flow */
        .process-flow {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--gray-100);
        }

        .process-title {
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .process-steps {
            display: grid;
            gap: 1rem;
        }

        .process-step {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--gray-50);
            border-radius: 0.75rem;
            border-left: 4px solid var(--primary);
            transition: all 0.3s ease;
        }

        .process-step:hover {
            background: var(--light);
            transform: translateX(4px);
        }

        .step-number {
            width: 2rem;
            height: 2rem;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
            flex-shrink: 0;
        }

        .step-text {
            color: var(--gray-700);
            font-size: 0.875rem;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 0.5rem;
            }

            .header-content {
                padding: 0 1rem;
            }

            .alert-header {
                padding: 1.5rem;
            }

            .alert-title {
                font-size: 1.25rem;
            }

            .alert-body {
                padding: 1.5rem;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }

            .process-flow {
                padding: 1.5rem;
            }

            .info-card {
                padding: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .header-title {
                font-size: 1.125rem;
            }

            .alert-header {
                padding: 1.25rem;
            }

            .alert-body {
                padding: 1.25rem;
            }

            .process-flow {
                padding: 1.25rem;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <a href="#" onclick="window.history.back(); return false;" class="back-btn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="header-title">Akses Dibatasi</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="content-wrapper fade-in">
                <!-- Alert Card -->
                <div class="alert-card">
                    <div class="alert-header">
                        <div class="warning-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.982 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                        <h2 class="alert-title">Menunggu Validasi Level 1</h2>
                        <p class="alert-subtitle">Akses ditangguhkan sementara waktu</p>
                    </div>

                    <div class="alert-body">
                        <p class="alert-description">
                            Anda tidak dapat mengakses validasi untuk kriteria ini karena validator level 1 belum melakukan validasi atau belum memberikan status <strong style="color: var(--success);">"Valid"</strong>.
                        </p>

                        <!-- Info Card -->
                        <div class="info-card">
                            <div class="info-header">
                                <svg class="info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h4 class="info-title">Informasi Kriteria</h4>
                            </div>
                            <div class="info-details">
                                <div class="info-item">
                                    <span class="info-label">Kriteria:</span> Evaluasi Kinerja Sistem
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Level Validator Anda:</span> 2
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Menunggu Level:</span> 1
                                </div>
                            </div>
                        </div>

                        <p style="text-align: center; color: var(--gray-600); font-size: 0.875rem; margin-top: 1rem;">
                            Silakan hubungi validator level 1 atau tunggu hingga proses validasi sebelumnya selesai.
                        </p>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <button onclick="window.history.back()" class="btn btn-secondary">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Kembali
                            </button>
                        </div>
                    </div>
                </div>

                   
            </div>
        </div>
    </main>

    <script>
        function refreshPage() {
            const btn = document.querySelector('.btn-success');
            const text = btn.querySelector('.refresh-text');
            const originalText = text.textContent;
            
            // Show loading state
            text.innerHTML = '<span class="loading"></span> Memuat...';
            btn.style.pointerEvents = 'none';
            
            // Simulate refresh delay
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        }

        // Add smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';

        // Add loading states for buttons
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!this.classList.contains('btn-success')) {
                    this.style.opacity = '0.8';
                    setTimeout(() => {
                        this.style.opacity = '1';
                    }, 200);
                }
            });
        });
    </script>
</body>
</html>