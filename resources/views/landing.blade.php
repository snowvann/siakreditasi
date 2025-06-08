<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Akreditasi D4 SIB - Polinema</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    
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
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      line-height: 1.6;
      color: var(--gray-800);
      overflow-x: hidden;
      background: var(--light);
  }

  /* Utility Classes */
  .gradient-bg {
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
      background-size: 400% 400%;
      animation: gradientShift 8s ease infinite;
  }

  @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
  }

  /* Navigation Styles */
  .navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      padding: 1rem 0;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      backdrop-filter: blur(20px);
      background: rgba(255, 255, 255, 0.9);
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
  }

  .navbar.scrolled {
      background: rgba(255, 255, 255, 0.95);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
  }

  .nav-container {
      max-width: 1260px;
      margin: 0 auto;
      padding: 0 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
  }

  .logo-section {
      display: flex;
      align-items: center;
      gap: 1rem;
  }

  .logo-section img {
      height: 45px;
      width: auto;
      transition: all 0.3s ease;
      filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
  }

  .logo-section img:hover {
      transform: scale(1.1);
  }

  .nav-links {
      display: flex;
      gap: 2rem;
      align-items: center;
      list-style: none;
  }

  .nav-links a {
      color: var(--gray-700);
      text-decoration: none;
      font-weight: 500;
      padding: 0.75rem 1.5rem;
      border-radius: 12px;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      font-size: 0.95rem;
  }

  .nav-links a:hover {
      background: var(--gray-100);
      transform: translateY(-2px);
      color: var(--primary);
  }

  .nav-links a.active {
      background: var(--primary);
      color: white;
      box-shadow: 0 4px 16px rgba(99, 102, 241, 0.3);
  }

  .btn-primary {
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 12px;
      font-weight: 600;
      font-size: 0.95rem;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 4px 16px rgba(99, 102, 241, 0.3);
  }

  .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 32px rgba(99, 102, 241, 0.4);
  }

  .mobile-menu-btn {
      display: none;
      background: none;
      border: none;
      color: var(--gray-700);
      font-size: 1.5rem;
      cursor: pointer;
      padding: 0.5rem;
      border-radius: 8px;
      transition: all 0.3s ease;
  }

  .mobile-menu-btn:hover {
      background: var(--gray-100);
  }

  /* Hero Section */
  .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      position: relative;
      overflow: hidden;
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
      background-size: 400% 400%;
      animation: gradientShift 12s ease infinite;
  }

  .floating-shapes {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      pointer-events: none;
  }

  .shape {
      position: absolute;
      opacity: 0.1;
      animation: float 6s ease-in-out infinite;
  }

  .shape:nth-child(1) {
      top: 20%;
      left: 10%;
      width: 80px;
      height: 80px;
      background: var(--primary);
      border-radius: 50%;
      animation-delay: 0s;
  }

  .shape:nth-child(2) {
      top: 60%;
      right: 10%;
      width: 120px;
      height: 120px;
      background: var(--secondary);
      border-radius: 20px;
      animation-delay: 2s;
  }

  .shape:nth-child(3) {
      bottom: 20%;
      left: 20%;
      width: 60px;
      height: 60px;
      background: var(--accent);
      border-radius: 50%;
      animation-delay: 4s;
  }

  @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(180deg); }
  }

  .hero-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 3rem;
      position: relative;
      z-index: 2;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: center;
  }

  .hero-content h1 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: clamp(2.5rem, 5vw, 4rem);
      font-weight: 800;
      color: white;
      margin-top: 2 rem;
      margin-bottom: 1.5rem;
      line-height: 1.1;
      text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  .hero-content p {
      font-size: 1.25rem;
      color: rgba(255, 255, 255, 0.9);
      margin-bottom: 2rem;
      line-height: 1.6;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .hero-buttons {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
  }

  .btn-hero {
      padding: 1rem 2rem;
      border-radius: 16px;
      font-weight: 600;
      font-size: 1.1rem;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      text-shadow: none;
  }

  .btn-hero.primary {
      background: white;
      color: var(--primary);
      box-shadow: 0 8px 32px rgba(255, 255, 255, 0.3);
  }

  .btn-hero.primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 48px rgba(255, 255, 255, 0.4);
  }

  .btn-hero.secondary {
      background: rgba(255, 255, 255, 0.2);
      color: white;
      border: 2px solid rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(10px);
  }

  .btn-hero.secondary:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: translateY(-3px);
  }

  .hero-visual {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
  }

  .hero-card {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 24px;
      padding: 2rem;
      text-align: center;
      color: white;
      transform: rotate(5deg);
      transition: all 0.3s ease;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
  }

  .hero-card:hover {
      transform: rotate(0deg) scale(1.05);
  }

  .hero-card .icon {
      font-size: 3rem;
      margin-bottom: 1rem;
      color: var(--warning);
  }

  /* Profile Section */
  .profile-section {
      padding: 6rem 0;
      background: var(--light);
      position: relative;
  }

  .profile-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 2rem;
  }

  .profile-card {
      background: white;
      border-radius: 24px;
      padding: 3rem;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
      margin-bottom: 4rem;
      border: 1px solid var(--gray-100);
  }

  .profile-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 2.5rem;
      font-weight: 800;
      color: var(--gray-900);
      text-align: center;
      margin-bottom: 3rem;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
  }

  .profile-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 3rem;
      align-items: center;
  }

  .profile-image {
      position: relative;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
  }

  .main-image {
      width: 100%;
      height: 400px;
      object-fit: cover;
      transition: all 0.3s ease;
  }

  .main-image:hover {
      transform: scale(1.05);
  }

  .profile-text {
      padding: 1rem 0;
  }

  .profile-subtitle {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 1.5rem;
      position: relative;
  }

  .profile-subtitle::after {
      content: '';
      position: absolute;
      bottom: -0.5rem;
      left: 0;
      width: 60px;
      height: 3px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      border-radius: 2px;
  }

  .profile-text p {
      font-size: 1.1rem;
      line-height: 1.8;
      color: var(--gray-600);
      margin-bottom: 1.5rem;
  }

  /* Program Profile */
  .program-profile {
      background: white;
      padding: 4rem 0;
      border-top: 1px solid var(--gray-100);
  }

  .section-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 2.5rem;
      font-weight: 800;
      text-align: center;
      color: var(--gray-900);
      margin-bottom: 1rem;
  }

  .program-badge {
      display: inline-block;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      padding: 0.75rem 2rem;
      border-radius: 25px;
      font-weight: 600;
      font-size: 1.1rem;
      margin: 0 auto 3rem;
      display: block;
      text-align: center;
      width: fit-content;
      box-shadow: 0 8px 32px rgba(99, 102, 241, 0.3);
  }

  .program-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 3rem;
      align-items: center;
      margin-top: 3rem;
  }

  .program-image {
      position: relative;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
  }

  .program-img {
      width: 100%;
      height: 350px;
      object-fit: cover;
      transition: all 0.3s ease;
  }

  .program-img:hover {
      transform: scale(1.05);
  }

  .program-text p {
      font-size: 1.1rem;
      line-height: 1.8;
      color: var(--gray-600);
      margin-bottom: 1.5rem;
  }

  /* Vision Mission */
  .vision-mission {
      background: var(--gray-50);
      padding: 4rem 0;
  }

  .vm-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 2.5rem;
      font-weight: 800;
      text-align: center;
      color: var(--gray-900);
      margin-bottom: 3rem;
  }

  .vision-section {
      background: white;
      border-radius: 20px;
      padding: 3rem;
      margin-bottom: 3rem;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
      border: 1px solid var(--gray-100);
  }

  .vm-badge {
      display: inline-block;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      padding: 0.5rem 1.5rem;
      border-radius: 20px;
      font-weight: 700;
      font-size: 0.9rem;
      margin-bottom: 1.5rem;
      letter-spacing: 0.5px;
  }

  .vision-text {
      font-size: 1.3rem;
      line-height: 1.8;
      color: var(--gray-700);
      font-weight: 500;
  }

  .mission-section {
      background: white;
      border-radius: 20px;
      padding: 3rem;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
      border: 1px solid var(--gray-100);
  }

  .mission-content {
      display: grid;
      grid-template-columns: 300px 1fr;
      gap: 3rem;
      align-items: start;
      margin-top: 2rem;
  }

  .mission-image {
      position: relative;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 15px 45px rgba(0, 0, 0, 0.15);
  }

  .jti-image {
      width: 100%;
      height: 250px;
      object-fit: cover;
      transition: all 0.3s ease;
  }

  .jti-image:hover {
      transform: scale(1.05);
  }

  .mission-list {
      display: flex;
      flex-direction: column;
      gap: 2rem;
  }

  .mission-item {
      display: flex;
      gap: 1.5rem;
      align-items: flex-start;
      padding: 1.5rem;
      background: var(--gray-50);
      border-radius: 16px;
      border-left: 4px solid var(--primary);
      transition: all 0.3s ease;
  }

  .mission-item:hover {
      background: white;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
      transform: translateX(8px);
  }

  .mission-icon {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      width: 48px;
      height: 48px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      flex-shrink: 0;
      box-shadow: 0 8px 24px rgba(99, 102, 241, 0.3);
  }

  .mission-item p {
      font-size: 1rem;
      line-height: 1.7;
      color: var(--gray-600);
      margin: 0;
  }

  /* Goals Section */
  .goals-section {
      background: white;
      padding: 2rem 0;
  }

  .goals-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 2.5rem;
      font-weight: 800;
      text-align: center;
      color: var(--gray-900);
      margin-bottom: 3rem;
  }

  .goals-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
      margin-top: 3rem;
  }

  .goal-card {
      background: white;
      border-radius: 24px;
      padding: 2rem;
      box-shadow: 0 15px 45px rgba(0, 0, 0, 0.08);
      border: 1px solid var(--gray-100);
      position: relative;
      transition: all 0.3s ease;
      overflow: hidden;
  }

  .goal-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
  }

  .goal-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
  }

  .goal-number {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      width: 60px;
      height: 60px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      font-weight: 800;
      margin-bottom: 1.5rem;
      box-shadow: 0 8px 24px rgba(99, 102, 241, 0.3);
  }

  .goal-text {
      font-size: 1rem;
      line-height: 1.7;
      color: var(--gray-600);
      margin-bottom: 1.5rem;
  }

  .goal-image {
      border-radius: 12px;
      overflow: hidden;
      margin-top: 1rem;
  }

  .goal-image img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      transition: all 0.3s ease;
  }

  .goal-image img:hover {
      transform: scale(1.05);
  }

  /* Modal Styles */
  .modal {
      display: none;
      position: fixed;
      z-index: 10000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.8);
      backdrop-filter: blur(8px);
  }

  .modal-content {
      background: white;
      margin: 5% auto;
      padding: 0;
      border-radius: 24px;
      width: 90%;
      max-width: 500px;
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
      overflow: hidden;
      animation: modalSlideIn 0.3s ease;
  }

  @keyframes modalSlideIn {
      from {
          opacity: 0;
          transform: translateY(-50px) scale(0.9);
      }
      to {
          opacity: 1;
          transform: translateY(0) scale(1);
      }
  }

  .modal-header {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      padding: 2rem;
      position: relative;
  }

  .modal-header h3 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.5rem;
      font-weight: 700;
      margin: 0;
  }

  .close-btn {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: rgba(255, 255, 255, 0.2);
      border: none;
      color: white;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 1.2rem;
  }

  .close-btn:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: rotate(90deg);
  }

  .modal-body {
      padding: 2rem;
  }

  .floor-btn {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1.5rem;
      margin-bottom: 1rem;
      background: var(--gray-50);
      border-radius: 16px;
      text-decoration: none;
      color: var(--gray-700);
      transition: all 0.3s ease;
      border: 2px solid transparent;
  }

  .floor-btn:hover {
      background: var(--primary);
      color: white;
      transform: translateX(8px);
      box-shadow: 0 8px 32px rgba(99, 102, 241, 0.3);
  }

  .floor-btn i {
      font-size: 2rem;
      color: var(--primary);
      transition: all 0.3s ease;
  }

  .floor-btn:hover i {
      color: white;
  }

  .floor-btn div strong {
      display: block;
      font-size: 1.1rem;
      margin-bottom: 0.25rem;
  }

  .floor-btn div small {
      color: var(--gray-500);
      font-size: 0.9rem;
  }

  .floor-btn:hover div small {
      color: rgba(255, 255, 255, 0.8);
  }

  /* Footer Styles */
  .footer {
      background: var(--gray-900);
      color: white;
      padding: 4rem 0 2rem;
      position: relative;
  }

  .footer::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
  }

  .footer-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 2rem;
  }

  .footer-content {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 3rem;
      margin-bottom: 3rem;
  }

  .footer-section h4 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.3rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      color: white;
  }

  .footer-logos {
      display: flex;
      gap: 1rem;
      margin-bottom: 1.5rem;
  }

  .footer-logos img {
    height: 50px;
    width: auto;
    transition: all 0.3s ease;
}

.footer-logos img:hover {
    transform: scale(1.1);
    filter: drop-shadow(0 0 10px rgba(0, 0, 0, 0.3));
}


  .footer-desc {
      color: var(--gray-300);
      line-height: 1.6;
      margin-bottom: 2rem;
  }

  .social-links {
      display: flex;
      gap: 1rem;
  }

  .social-link {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 44px;
      height: 44px;
      border-radius: 12px;
      text-decoration: none;
      transition: all 0.3s ease;
      font-size: 1.2rem;
  }

  .social-link.facebook {
      background: #1877f2;
      color: white;
  }

  .social-link.instagram {
      background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
      color: white;
  }

  .social-link.youtube {
      background: #f21d1d;
      color: white;
  }

  .social-link:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
  }

  .contact-info {
      display: flex;
      flex-direction: column;
      gap: 1rem;
  }

  .contact-item {
      display: flex;
      align-items: center;
      gap: 1rem;
      color: var(--gray-300);
      transition: all 0.3s ease;
  }

  .contact-item:hover {
      color: white;
      transform: translateX(8px);
  }

  .contact-item i {
      color: var(--primary);
      font-size: 1.2rem;
      width: 20px;
      text-align: center;
  }

  .map-container {
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
  }

  .footer-bottom {
      border-top: 1px solid var(--gray-700);
      padding-top: 2rem;
      text-align: center;
      color: var(--gray-400);
  }

  /* Responsive Design */
  @media (max-width: 1024px) {
      .hero-container {
          grid-template-columns: 1fr;
          gap: 3rem;
          text-align: center;
      }
      
      .profile-content,
      .program-content {
          grid-template-columns: 1fr;
          gap: 2rem;
      }
      
      .mission-content {
          grid-template-columns: 1fr;
          gap: 2rem;
      }
      
      .goals-grid {
          grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      }
  }

  @media (max-width: 768px) {
      .nav-links {
          display: none;
      }
      
      .mobile-menu-btn {
          display: block;
      }
      
      .hero-content h1 {
          font-size: 2.5rem;
      }
      
      .profile-title,
      .section-title,
      .vm-title,
      .goals-title {
          font-size: 2rem;
      }
      
      .profile-card,
      .vision-section,
      .mission-section {
          padding: 2rem;
      }
      
      .modal-content {
          width: 95%;
          margin: 10% auto;
      }
      
      .footer-content {
          grid-template-columns: 1fr;
          gap: 2rem;
      }
  }

  /* Bagian yang terpotong di akhir file main.css */
  @media (max-width: 480px) {
      .nav-container {
          padding: 0 1rem;
      }
      
      .hero-container {
          padding: 1rem;
      }
      
      .profile-container {
          padding: 0 1rem;
      }
      
      .hero-content h1 {
          font-size: 2rem;
      }
      
      .hero-content p {
          font-size: 1.1rem;
      }
      
      .hero-buttons {
          flex-direction: column;
          width: 100%;
      }
      
      .btn-hero {
          justify-content: center;
          width: 100%;
      }
      
      .profile-card,
      .vision-section,
      .mission-section {
          padding: 1.5rem;
      }
      
      .profile-title,
      .section-title,
      .vm-title,
      .goals-title {
          font-size: 1.8rem;
      }
      
      .goal-card {
          padding: 1.5rem;
      }
      
      .mission-item {
          padding: 1rem;
          flex-direction: column;
          text-align: center;
      }
      
      .mission-icon {
          align-self: center;
      }
      
      .modal-content {
          width: 98%;
          margin: 5% auto;
      }
      
      .modal-header,
      .modal-body {
          padding: 1.5rem;
      }
      
      .floor-btn {
          padding: 1rem;
      }
  }

  /* Mobile Navigation Menu */
  .mobile-nav-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      background: rgba(0, 0, 0, 0.8);
      backdrop-filter: blur(10px);
      z-index: 9999;
      display: none;
      opacity: 0;
      transition: all 0.3s ease;
  }

  .mobile-nav-overlay.active {
      display: block;
      opacity: 1;
  }

  .mobile-nav-menu {
      position: absolute;
      top: 0;
      right: -100%;
      width: 300px;
      height: 100%;
      background: white;
      padding: 2rem;
      box-shadow: -10px 0 30px rgba(0, 0, 0, 0.1);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      overflow-y: auto;
  }

  .mobile-nav-menu.active {
      right: 0;
  }

  .mobile-nav-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid var(--gray-200);
  }

  .mobile-nav-close {
      background: none;
      border: none;
      font-size: 1.5rem;
      color: var(--gray-700);
      cursor: pointer;
      padding: 0.5rem;
      border-radius: 8px;
      transition: all 0.3s ease;
  }

  .mobile-nav-close:hover {
      background: var(--gray-100);
  }

  .mobile-nav-links {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
  }

  .mobile-nav-links a {
      display: block;
      padding: 1rem;
      color: var(--gray-700);
      text-decoration: none;
      border-radius: 12px;
      transition: all 0.3s ease;
      font-weight: 500;
  }

  .mobile-nav-links a:hover {
      background: var(--gray-100);
      color: var(--primary);
      transform: translateX(8px);
  }

  .mobile-nav-links a.active {
      background: var(--primary);
      color: white;
  }

  /* Smooth Scrolling */
  html {
      scroll-behavior: smooth;
  }

  /* Custom Scrollbar */
  ::-webkit-scrollbar {
      width: 8px;
  }

  ::-webkit-scrollbar-track {
      background: var(--gray-100);
  }

  ::-webkit-scrollbar-thumb {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      border-radius: 4px;
  }

  ::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(135deg, var(--primary-dark), var(--secondary));
  }

  /* Loading Animation */
  .loading {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: white;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 10000;
      transition: opacity 0.5s ease;
  }

  .loading.hide {
      opacity: 0;
      pointer-events: none;
  }

  .loading-spinner {
      width: 50px;
      height: 50px;
      border: 4px solid var(--gray-200);
      border-top: 4px solid var(--primary);
      border-radius: 50%;
      animation: spin 1s linear infinite;
  }

  @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
  }

  /* Accessibility */
  .sr-only {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      white-space: nowrap;
      border: 0;
  }

  /* Focus Styles */
  *:focus {
      outline: 2px solid var(--primary);
      outline-offset: 2px;
  }

  /* Print Styles */
  @media print {
      .navbar,
      .footer,
      .hero-buttons,
      .social-links,
      .mobile-menu-btn {
          display: none !important;
      }
      
      .hero {
          min-height: auto;
          padding: 2rem 0;
      }
      
      .hero-content h1 {
          color: var(--gray-900) !important;
      }
      
      .hero-content p {
          color: var(--gray-700) !important;
      }
      
      body {
          background: white !important;
          color: var(--gray-900) !important;
      }
  }

  /* Utility Classes */
  .text-center { text-align: center; }
  .text-left { text-align: left; }
  .text-right { text-align: right; }

  .d-none { display: none; }
  .d-block { display: block; }
  .d-flex { display: flex; }
  .d-grid { display: grid; }

  .position-relative { position: relative; }
  .position-absolute { position: absolute; }
  .position-fixed { position: fixed; }

  .w-100 { width: 100%; }
  .h-100 { height: 100%; }

  .m-0 { margin: 0; }
  .m-1 { margin: 0.25rem; }
  .m-2 { margin: 0.5rem; }
  .m-3 { margin: 1rem; }
  .m-4 { margin: 1.5rem; }
  .m-5 { margin: 3rem; }

  .p-0 { padding: 0; }
  .p-1 { padding: 0.25rem; }
  .p-2 { padding: 0.5rem; }
  .p-3 { padding: 1rem; }
  .p-4 { padding: 1.5rem; }
  .p-5 { padding: 3rem; }

  .mt-0 { margin-top: 0; }
  .mt-1 { margin-top: 0.25rem; }
  .mt-2 { margin-top: 0.5rem; }
  .mt-3 { margin-top: 1rem; }
  .mt-4 { margin-top: 1.5rem; }
  .mt-5 { margin-top: 3rem; }

  .mb-0 { margin-bottom: 0; }
  .mb-1 { margin-bottom: 0.25rem; }
  .mb-2 { margin-bottom: 0.5rem; }
  .mb-3 { margin-bottom: 1rem; }
  .mb-4 { margin-bottom: 1.5rem; }
  .mb-5 { margin-bottom: 3rem; }

  .pt-0 { padding-top: 0; }
  .pt-1 { padding-top: 0.25rem; }
  .pt-2 { padding-top: 0.5rem; }
  .pt-3 { padding-top: 1rem; }
  .pt-4 { padding-top: 1.5rem; }
  .pt-5 { padding-top: 3rem; }

  .pb-0 { padding-bottom: 0; }
  .pb-1 { padding-bottom: 0.25rem; }
  .pb-2 { padding-bottom: 0.5rem; }
  .pb-3 { padding-bottom: 1rem; }
  .pb-4 { padding-bottom: 1.5rem; }
  .pb-5 { padding-bottom: 3rem; }

  /* Animation Classes */
  .fade-in {
      opacity: 0;
      animation: fadeIn 0.6s ease forwards;
  }

  @keyframes fadeIn {
      to {
          opacity: 1;
      }
  }

  .slide-up {
      opacity: 0;
      transform: translateY(30px);
      animation: slideUp 0.6s ease forwards;
  }

  @keyframes slideUp {
      to {
          opacity: 1;
          transform: translateY(0);
      }
  }

  .slide-in-left {
      opacity: 0;
      transform: translateX(-30px);
      animation: slideInLeft 0.6s ease forwards;
  }

  @keyframes slideInLeft {
      to {
          opacity: 1;
          transform: translateX(0);
      }
  }

  .slide-in-right {
      opacity: 0;
      transform: translateX(30px);
      animation: slideInRight 0.6s ease forwards;
  }

  @keyframes slideInRight {
      to {
          opacity: 1;
          transform: translateX(0);
      }
  }

  .bounce-in {
      opacity: 0;
      transform: scale(0.3);
      animation: bounceIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
  }

  @keyframes bounceIn {
      to {
          opacity: 1;
          transform: scale(1);
      }
  }

  /* Hover Effects */
  .hover-lift {
      transition: all 0.3s ease;
  }

  .hover-lift:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
  }

  .hover-glow {
      transition: all 0.3s ease;
  }

  .hover-glow:hover {
      box-shadow: 0 0 20px rgba(99, 102, 241, 0.4);
  }

  /* Error States */
  .error {
      color: var(--danger);
      border-color: var(--danger);
  }

  .success {
      color: var(--success);
      border-color: var(--success);
  }

  .warning {
      color: var(--warning);
      border-color: var(--warning);
  }

  /* Dark Mode Support */
  @media (prefers-color-scheme: dark) {
      :root {
          --light: #1f2937;
          --gray-50: #374151;
          --gray-100: #4b5563;
          --gray-200: #6b7280;
          --gray-300: #9ca3af;
          --gray-400: #d1d5db;
          --gray-500: #e5e7eb;
          --gray-600: #f3f4f6;
          --gray-700: #f9fafb;
          --gray-800: #ffffff;
          --gray-900: #ffffff;
      }
      
      body {
          background: var(--gray-900);
          color: var(--gray-100);
      }
      
      .navbar {
          background: rgba(31, 41, 55, 0.9);
      }
      
      .profile-card,
      .vision-section,
      .mission-section,
      .goal-card {
          background: var(--gray-800);
          border-color: var(--gray-700);
      }
  }
        </style>

            <script>
      document.addEventListener('DOMContentLoaded', function() {
          // Initialize AOS
          AOS.init({
              duration: 1000,
              once: true,
              offset: 100,
              easing: 'ease-out-cubic'
          });

          // Navbar scroll effect
          const navbar = document.getElementById('navbar');
          window.addEventListener('scroll', function() {
              if (window.scrollY > 50) {
                  navbar.classList.add('scrolled');
              } else {
                  navbar.classList.remove('scrolled');
              }
          });

          // Smooth scrolling for navigation links
          document.querySelectorAll('a[href^="#"]').forEach(anchor => {
              anchor.addEventListener('click', function (e) {
                  e.preventDefault();
                  const target = document.querySelector(this.getAttribute('href'));
                  if (target) {
                      target.scrollIntoView({
                          behavior: 'smooth',
                          block: 'start'
                      });
                  }
              });
          });

          // Active navigation highlighting
          const sections = document.querySelectorAll('section[id]');
          const navLinks = document.querySelectorAll('.nav-links a[href^="#"]');
          
          window.addEventListener('scroll', () => {
              let current = '';
              sections.forEach(section => {
                  const sectionTop = section.offsetTop;
                  const sectionHeight = section.clientHeight;
                  if (scrollY >= sectionTop - 200) {
                      current = section.getAttribute('id');
                  }
              });

              navLinks.forEach(link => {
                  link.classList.remove('active');
                  if (link.getAttribute('href') === `#${current}`) {
                      link.classList.add('active');
                  }
              });
          });
      });

      // Mobile menu functions
      function toggleMobileMenu() {
          const overlay = document.getElementById('mobileNavOverlay');
          const menu = document.getElementById('mobileNavMenu');
          
          if (!overlay) {
              createMobileMenu();
              return;
          }
          
          overlay.classList.toggle('active');
          menu.classList.toggle('active');
          document.body.style.overflow = overlay.classList.contains('active') ? 'hidden' : '';
      }

      function createMobileMenu() {
          const overlay = document.createElement('div');
          overlay.id = 'mobileNavOverlay';
          overlay.className = 'mobile-nav-overlay';
          
          const menu = document.createElement('div');
          menu.id = 'mobileNavMenu';
          menu.className = 'mobile-nav-menu';
          
          menu.innerHTML = `
              <div class="mobile-nav-header">
                  <h3>Menu</h3>
                  <button class="mobile-nav-close" onclick="toggleMobileMenu()">
                      <i class="bi bi-x"></i>
                  </button>
              </div>
              <ul class="mobile-nav-links">
                  <li><a href="#beranda" onclick="toggleMobileMenu()">Beranda</a></li>
                  <li><a href="https://www.polinema.ac.id/" target="_blank">Website Polinema</a></li>
                  <li><a href="#profile" onclick="toggleMobileMenu()">About Us</a></li>
                  <li><a href="#" onclick="toggleMobileMenu(); openModal();">Denah Gedung</a></li>
                  <li><a href="#" class="btn-primary">Login <i class="bi bi-box-arrow-in-right"></i></a></li>
              </ul>
          `;
          
          overlay.appendChild(menu);
          document.body.appendChild(overlay);
          
          // Close on overlay click
          overlay.addEventListener('click', function(e) {
              if (e.target === overlay) {
                  toggleMobileMenu();
              }
          });
          
          // Show menu
          setTimeout(() => {
              overlay.classList.add('active');
              menu.classList.add('active');
              document.body.style.overflow = 'hidden';
          }, 10);
      }

      // Modal functions
      function openModal() {
          const modal = document.getElementById('denahModal');
          modal.style.display = 'block';
          document.body.style.overflow = 'hidden';
          
          // Close on outside click
          modal.addEventListener('click', function(e) {
              if (e.target === modal) {
                  closeModal();
              }
          });
      }

      function closeModal() {
          const modal = document.getElementById('denahModal');
          modal.style.display = 'none';
          document.body.style.overflow = '';
      }

      // Keyboard navigation
      document.addEventListener('keydown', function(e) {
          if (e.key === 'Escape') {
              closeModal();
              const overlay = document.getElementById('mobileNavOverlay');
              if (overlay && overlay.classList.contains('active')) {
                  toggleMobileMenu();
              }
          }
      });

      // Loading screen
      window.addEventListener('load', function() {
          const loading = document.querySelector('.loading');
          if (loading) {
              loading.classList.add('hide');
              setTimeout(() => {
                  loading.remove();
              }, 500);
          }
      });

      // Image lazy loading
      function lazyLoadImages() {
          const images = document.querySelectorAll('img[data-src]');
          const imageObserver = new IntersectionObserver((entries, observer) => {
              entries.forEach(entry => {
                  if (entry.isIntersecting) {
                      const img = entry.target;
                      img.src = img.dataset.src;
                      img.classList.add('fade-in');
                      imageObserver.unobserve(img);
                  }
              });
          });

          images.forEach(img => imageObserver.observe(img));
      }

      // Initialize lazy loading if needed
      if ('IntersectionObserver' in window) {
          lazyLoadImages();
      }

      // Parallax effect for hero shapes
      window.addEventListener('scroll', function() {
          const scrolled = window.pageYOffset;
          const shapes = document.querySelectorAll('.shape');
          
          shapes.forEach((shape, index) => {
              const rate = scrolled * -0.5 * (index + 1);
              shape.style.transform = `translateY(${rate}px)`;
          });
      });

      // Form validation (if you add forms later)
      function validateForm(form) {
          const inputs = form.querySelectorAll('input[required], textarea[required]');
          let isValid = true;
          
          inputs.forEach(input => {
              if (!input.value.trim()) {
                  input.classList.add('error');
                  isValid = false;
              } else {
                  input.classList.remove('error');
              }
          });
          
          return isValid;
      }

      // Utility functions
      function debounce(func, wait) {
          let timeout;
          return function executedFunction(...args) {
              const later = () => {
                  clearTimeout(timeout);
                  func(...args);
              };
              clearTimeout(timeout);
              timeout = setTimeout(later, wait);
          };
      }

      function throttle(func, limit) {
          let inThrottle;
          return function() {
              const args = arguments;
              const context = this;
              if (!inThrottle) {
                  func.apply(context, args);
                  inThrottle = true;
                  setTimeout(() => inThrottle = false, limit);
              }
          }
      }

      // Optimized scroll handler
      const optimizedScrollHandler = throttle(function() {
          // Your scroll handling code here
      }, 16); // ~60fps

      window.addEventListener('scroll', optimizedScrollHandler);

      // Print functionality
      function printPage() {
          window.print();
      }

      // Dark mode toggle (if needed)
      function toggleDarkMode() {
          document.body.classList.toggle('dark-mode');
          localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
      }

      // Check for saved dark mode preference
      if (localStorage.getItem('darkMode') === 'true') {
          document.body.classList.add('dark-mode');
      }

      // Performance monitoring
      function measurePerformance() {
          if ('performance' in window) {
              window.addEventListener('load', function() {
                  setTimeout(function() {
                      const perfData = performance.getEntriesByType('navigation')[0];
                      console.log('Page Load Time:', perfData.loadEventEnd - perfData.fetchStart + 'ms');
                  }, 0);
              });
          }
      }

      measurePerformance();
            </script>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <div class="logo-section">
                <img src="{{ asset('images/logo_polinema.png') }}" alt="Logo Polinema">
                <img src="{{ asset('images/logoJTI.png') }}" alt="Logo JTI">
            </div>
            
            <ul class="nav-links" id="navLinks">
                <li><a href="#beranda" class="active">Beranda</a></li>
                <li><a href="https://www.polinema.ac.id/" target="_blank">Website Polinema</a></li>
                <li><a href="#profile">About Us</a></li>
                <li><a href="#" onclick="openModal()">Denah Gedung</a></li>
                <li><a href="{{ route('login') }}" class="btn-primary">Login <i class="bi bi-box-arrow-in-right"></i></a></li>
            </ul>
            
            <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        
        <div class="hero-container">
            <div class="hero-content" data-aos="fade-right" data-aos-duration="1000">
                <h1>Sistem Akreditasi D4 Sistem Informasi Bisnis</h1>
                <p>
                    Revolusi pengelolaan akreditasi D4 Sistem Informasi Bisnis dengan teknologi terdepan. 
                    Pengalaman yang seamless, modern, dan efisien untuk institusi pendidikan.
                </p>
                <div class="hero-buttons">
                    <a href="{{ route('login') }}" class="btn-hero primary">
                        Mulai Sekarang <i class="bi bi-rocket-takeoff"></i>
                    </a>
                    <a href="#profile" class="btn-hero secondary">
                        Lihat Profile <i class="bi bi-arrow-down"></i>
                    </a>
                </div>
            </div>
            
            <div class="hero-visual" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="hero-card">
                    <div class="icon">
                        <i class="bi bi-award-fill"></i>
                    </div>
                    <h3>SIAKREDITASI</h3>
                    <p>Platform terintegrasi untuk pengelolaan akreditasi yang efisien dan modern</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Profile Section -->
    <section class="profile-section" id="profile">
        <!-- Polinema Profile -->
        <div class="profile-container">
            <div class="profile-card">
                <h2 class="profile-title">INFORMASI UMUM POLITEKNIK NEGERI MALANG</h2>
                
                <div class="profile-content">
                    <div class="profile-image">
                        <img src="images/as.jpg" alt="Gedung Polinema" class="main-image">
                    </div>
                    
                    <div class="profile-text">
                        <h3 class="profile-subtitle">PROFIL KAMPUS</h3>
                        <p>
                            Polinema adalah institusi pendidikan tinggi vokasi yang terletak di kota Malang. Malang 
                            adalah kota terbesar kedua di Jawa Timur, Indonesia. Malang merupakan tempat yang nyaman 
                            untuk belajar karena udaranya yang sejuk dan populasi yang tidak begitu padat (sekitar 
                            800 ribu penduduk). Di Malang terdapat banyak sekolah, universitas dan institusi pendidikan 
                            lainnya dengan kualitas yang bagus.
                        </p>
                        <p>
                            Polinema terus berkembang untuk menjadi institusi pendidikan vokasi yang superior dan siap 
                            bersaing di dunia global. Polinema memiliki sistem pendidikan yang inovatif dan ketrampilan 
                            kompetitif yang secara global dibutuhkan oleh industri, badan pemerintahan dan masyarakat.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Program Studi Profile -->
        <div class="program-profile">
            <div class="profile-container">
                <h2 class="section-title">PROFILE PROGRAM STUDI</h2>
                <span class="program-badge">Sistem Informasi Bisnis</span>
                
                <div class="program-content">
                    <div class="program-image">
                        <img src="images/atasan.jpg" alt="Foto Prodi" class="program-img">
                    </div>
                    
                    <div class="program-text">
                        <p>
                            Program Studi Manajemen Informatika berdiri 24 Juni 2005 berdasarkan SK Mendiknas Nomor: 2001/D/T/2005 
                            di bawah Jurusan Teknik Elektro Politeknik Negeri Malang. Mulai tahun akademik 2006/2007, kurikulum 
                            Program Studi Manajemen Informatika menggunakan kurikulum 5-1 (lima semester di kampus dan satu semester di industri).
                        </p>
                        <p>
                            Program Upgrading merupakan peningkatan program studi dari Diploma Tiga menjadi Diploma Empat atau Sarjana Terapan. 
                            Berdasarkan pada Surat Keputusan Mendikbudristek Nomor 33/D/OT/2022, izin pembukaan Program Studi Sarjana Terapan 
                            Sistem Informasi Bisnis secara resmi disetujui.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visi Misi Section -->
        <div class="vision-mission">
            <div class="profile-container">
                <h2 class="vm-title">Visi dan Misi</h2>
                
                <!-- Visi -->
                <div class="vision-section">
                    <div class="vm-badge">VISI</div>
                    <p class="vision-text">
                        Menjadi Program Studi Unggul dalam Bidang Sistem Informasi Bisnis di Tingkat Nasional dan Internasional.
                    </p>
                </div>

                <!-- Misi -->
                <div class="mission-section">
                    <div class="vm-badge">MISI</div>
                    
                        
                        <div class="mission-list">
                            <div class="mission-item">
                                <div class="mission-icon">
                                    <i class="bi bi-mortarboard"></i>
                                </div>
                                <p>
                                    Melaksanakan pendidikan vokasi yang inovatif berdasarkan pada sistem pendidikan terapan dengan 
                                    memanfaatkan kemajuan teknologi, sehingga mampu menghasilkan lulusan yang berkompeten di bidang 
                                    sistem informasi bisnis.
                                </p>
                            </div>
                            
                            <div class="mission-item">
                                <div class="mission-icon">
                                    <i class="bi bi-search"></i>
                                </div>
                                <p>
                                    Melaksanakan penelitian terapan berbasis produk dan jasa bidang Sistem Informasi Bisnis.
                                </p>
                            </div>
                            
                            <div class="mission-item">
                                <div class="mission-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <p>
                                    Melaksanakan pengabdian masyarakat dengan menggunakan kemajuan Sistem Informasi Bisnis 
                                    untuk meningkatkan kesejahteraan.
                                </p>
                            </div>
                            
                            <div class="mission-item">
                                <div class="mission-icon">
                                    <i class="bi bi-globe"></i>
                                </div>
                                <p>
                                    Mewujudkan kerja sama yang saling menguntungkan dengan berbagai pihak baik di dalam 
                                    maupun di luar negeri pada bidang Sistem Informasi Bisnis.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tujuan Program Studi -->
        <div class="goals-section">
            <div class="profile-container">
                <h2 class="goals-title">Tujuan Program Studi</h2>
                
                <div class="goals-grid">
                    <div class="goal-card">
                        <div class="goal-number">1</div>
                        <p class="goal-text">
                            Menghasilkan lulusan bidang Sistem Informasi Bisnis yang berketuhanan, beretika dan bermoral baik, 
                            berpengetahuan dan berketerampilan tinggi, siap bekerja dan/atau berwirausaha yang mampu bersaing 
                            dalam skala nasional maupun internasional.
                        </p>
                 
                    </div>
                    
                    <div class="goal-card">
                        <div class="goal-number">2</div>
                        <p class="goal-text">
                            Menghasilkan penelitian terapan bidang Sistem Informasi Bisnis yang berskala nasional dan internasional, 
                            meningkatkan efektivitas, efisiensi, dan produktivitas dalam dunia usaha dan industri.
                        </p>
            
                    </div>
                    
                    <div class="goal-card">
                        <div class="goal-number">3</div>
                        <p class="goal-text">
                            Menghasilkan pengabdian kepada masyarakat yang dilaksanakan melalui penerapan dan penyebarluasan 
                            ilmu pengetahuan dan teknologi serta pemberian layanan jasa secara profesional.
                        </p>
      
                    </div>
                    
                    <div class="goal-card">
                        <div class="goal-number">4</div>
                        <p class="goal-text">
                            Terwujudnya kerjasama yang saling menguntungkan dengan berbagai pihak baik di dalam maupun 
                            di luar negeri pada bidang Sistem Informasi Bisnis untuk meningkatkan daya saing.
                        </p>

                    </div>

                    <div class="goal-card">
                      <div class="goal-number">5</div>
                      <p class="goal-text">
                        Menghasilkan sistem manajemen pendidikan bidang sistem informasi bisnis yang memenuhi prinsip-prinsip tata kelola yang baik
                      </p>

                  </div>
                  <div class="goal-card">
                    <div class="goal-number">6</div>
                    <p class="goal-text">
                      Meningkatkan efektivitas, efisiensi, dan produktivitas dalam dunia usaha dan industri, serta mengarah pada pencapaian Hak atas Kekayaan Intelektual (HaKI), perolehan paten, dan kesejahteraan masyarakat;        </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Denah Gedung -->
    <div id="denahModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Pilih Denah Gedung</h3>
                <button class="close-btn" onclick="closeModal()">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <a href="https://my.matterport.com/show/?m=xufa7UrDLJe" target="_blank" class="floor-btn">
                    <i class="bi bi-building"></i>
                    <div>
                        <strong>Denah Lantai 5</strong>
                        <small>Virtual Tour 360°</small>
                    </div>
                </a>
                <a href="https://my.matterport.com/show/?m=Fj8fbnjLjQq" target="_blank" class="floor-btn">
                    <i class="bi bi-building"></i>
                    <div>
                        <strong>Denah Lantai 6</strong>
                        <small>Virtual Tour 360°</small>
                    </div>
                </a>
                <a href="https://my.matterport.com/show/?m=fAgiViGeZaB" target="_blank" class="floor-btn">
                    <i class="bi bi-building"></i>
                    <div>
                        <strong>Denah Lantai 7</strong>
                        <small>Virtual Tour 360°</small>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section" data-aos="fade-up" data-aos-delay="100">
                    <div class="footer-logos">
                        <img src="{{ asset('images/logo_polinema.png')}}" alt="Logo Polinema">
                        <img src="{{ asset('images/logoJTI.png') }}" alt="Logo JTI">
                    </div>
                    <h4>SIAKREDITASI</h4>
                    <p class="footer-desc">
                        Revolusi digital dalam pengelolaan akreditasi D4 Sistem Informasi Bisnis. 
                        Bergabunglah dengan masa depan pendidikan tinggi.
                    </p>
                    <div class="social-links">
                        <a href="https://www.facebook.com/polinema/?locale=id_ID" class="social-link facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/polinema_campus/" class="social-link instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="http://www.youtube.com/@PoliteknikNegeriMalangOfficial" class="social-link youtube">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>
                
                <div class="footer-section" data-aos="fade-up" data-aos-delay="200">
                    <h4>Kontak Kami</h4>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>Jl. Soekarno Hatta No.9, Malang</span>
                        </div>
                        <div class="contact-item">
                            <i class="bi bi-telephone-fill"></i>
                            <span>(0341) 404424</span>
                        </div>
                        <div class="contact-item">
                            <i class="bi bi-envelope-fill"></i>
                            <span>humas@polinema.ac.id</span>
                        </div>
                        <div class="contact-item">
                            <i class="bi bi-globe"></i>
                            <span>www.polinema.ac.id</span>
                        </div>
                    </div>
                </div>
                
                <div class="footer-section" data-aos="fade-up" data-aos-delay="300">
                    <h4>Lokasi Kampus</h4>
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.4736746987033!2d112.61375931477563!3d-7.946115894275598!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78827687d272e7%3A0x789ce9a636cd3aa2!2sPoliteknik%20Negeri%20Malang!5e0!3m2!1sen!2sid!4v1647854123456!5m2!1sen!2sid"
                            width="100%" 
                            height="250" 
                            style="border:0; border-radius: 12px;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 Jurusan Teknologi Informasi - Politeknik Negeri Malang. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="js/main.js"></script>

</body>
</html>

