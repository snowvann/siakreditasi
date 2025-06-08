// js/main.js
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