<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Cột 1: Mô tả và Social -->
            <div class="footer-column">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php else : ?>
                    <p class="footer-description">Học viện Doanh nhân - Hệ sinh thái học tập và kết nối dành cho doanh nhân.</p>
                    <div class="footer-social">
                        <a href="#" class="footer-social-link" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="footer-social-link" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="footer-social-link" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="footer-social-link" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Cột 2: Liên kết nhanh -->
            <div class="footer-column">
                <?php if (is_active_sidebar('footer-2')) : ?>
                    <?php dynamic_sidebar('footer-2'); ?>
                <?php else : ?>
                    <h3 class="footer-heading">Liên Kết Nhanh</h3>
                    <ul class="footer-links">
                        <li><a href="#about" class="footer-link">Về READI</a></li>
                        <li><a href="#membership" class="footer-link">Quyền Lợi Thành Viên</a></li>
                        <li><a href="#schedule" class="footer-link">Hoạt Động Mới</a></li>
                        <li><a href="#announcements" class="footer-link">Thông Báo</a></li>
                        <li><a href="#contact" class="footer-link">Liên Hệ</a></li>
                    </ul>
                <?php endif; ?>
            </div>
            
            <!-- Cột 3: Thông tin liên hệ -->
            <div class="footer-column">
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php else : ?>
                    <h3 class="footer-heading">Thông Tin Liên Hệ</h3>
                    <p class="footer-contact-item"><i class="fas fa-map-marker-alt footer-contact-icon"></i> Tầng 5, Toà nhà Sài Gòn Centre, 65 Lê Lợi, Quận 1, TP.HCM</p>
                    <p class="footer-contact-item"><i class="fas fa-phone-alt footer-contact-icon"></i> 9999</p>
                    <p class="footer-contact-item"><i class="fas fa-envelope footer-contact-icon"></i> info@com</p>
                <?php endif; ?>
            </div>

        </div>
        
        <div class="footer-bottom">
            <p class="footer-copyright">© <?php echo date('Y'); ?> <?php echo esc_html(get_theme_mod('readi_company_name', 'Học viện Doanh nhân')); ?></p>
            <div class="footer-bottom-links">
                <a href="<?php echo esc_url(get_theme_mod('readi_terms_link', '#')); ?>" class="footer-bottom-link">
                    <?php echo esc_html(get_theme_mod('readi_terms_text', 'Điều khoản sử dụng')); ?>
                </a>
                <a href="<?php echo esc_url(get_theme_mod('readi_privacy_link', '#')); ?>" class="footer-bottom-link">
                    <?php echo esc_html(get_theme_mod('readi_privacy_text', 'Chính sách bảo mật')); ?>
                </a>
            </div>
        </div>


    </div>
</footer>


  <?php 
  // Include floating buttons
  $phone_number = get_theme_mod('readi_phone_number', '999999');
  $zalo_link = get_theme_mod('readi_zalo_link', 'https://zalo.me/');
  $messenger_link = get_theme_mod('readi_messenger_link', 'https://m.me/');
  ?>
  
  <div class="floating-buttons">
      <a href="tel:<?php echo esc_attr($phone_number); ?>" class="floating-button floating-button--phone" aria-label="Gọi điện thoại">
          <i class="fas fa-phone-alt"></i>
      </a>
      <a href="<?php echo esc_url($zalo_link); ?>" target="_blank" class="floating-button floating-button--zalo" aria-label="Chat Zalo">
          <img width="20" height="20" src="https://gfvn.updata.top/wp-content/uploads/2025/06/zalo.svg" alt="Zalo" class="floating-button-icon">
      </a>
      <a href="<?php echo esc_url($messenger_link); ?>" target="_blank" class="floating-button floating-button--messenger" aria-label="Chat Messenger">
          <i class="fab fa-facebook-messenger"></i>
      </a>
  </div>


  <script>
    // Mobile menu toggle
    document.querySelector('.header-mobile-toggle').addEventListener('click', function() {
      const mobileMenu = document.querySelector('.header-mobile-menu');
      mobileMenu.classList.toggle('show');
      // Toggle hamburger icon animation
      const mobileIcon = document.querySelector('.header-mobile-icon');
      mobileIcon.classList.toggle('active');
    });
    // Header scroll effect
    window.addEventListener('scroll', function() {
      const header = document.querySelector('.header');
      if (window.scrollY > 50) {
        header.classList.add('shadow-lg');
      } else {
        header.classList.remove('shadow-lg');
      }
    });
    // Close mobile menu when clicking on a link
    document.querySelectorAll('.header-mobile-link').forEach(link => {
      link.addEventListener('click', function() {
        const mobileMenu = document.querySelector('.header-mobile-menu');
        mobileMenu.classList.remove('show');
        const mobileIcon = document.querySelector('.header-mobile-icon');
        mobileIcon.classList.remove('active');
      });
    });
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
      const mobileMenu = document.querySelector('.header-mobile-menu');
      const mobileToggle = document.querySelector('.header-mobile-toggle');
      if (mobileMenu.classList.contains('show') &&
        !mobileMenu.contains(event.target) &&
        !mobileToggle.contains(event.target)) {
        mobileMenu.classList.remove('show');
        const mobileIcon = document.querySelector('.header-mobile-icon');
        mobileIcon.classList.remove('active');
      }
    });
    // Enhanced Smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
          targetElement.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
        // Close mobile menu if open
        const mobileMenu = document.querySelector('.header-mobile-menu');
        if (mobileMenu.classList.contains('show')) {
          mobileMenu.classList.remove('show');
          document.querySelector('.header-mobile-icon').classList.remove('active');
        }
      });
    });
    // Scroll animations with Intersection Observer
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animated');
        }
      });
    }, observerOptions);
    // Initialize all animations when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
      // Add animation classes to sections
      const sections = document.querySelectorAll('section');
      sections.forEach((section, index) => {
        section.classList.add('animate-on-scroll');
        observer.observe(section);
        section.style.animationDelay = `${index * 0.1}s`;
      });
      // Animate cards and containers
      const cards = document.querySelectorAll('.schedule-item, .announcements-container, .contact-info');
      cards.forEach((card, index) => {
        card.classList.add('animate-on-scroll');
        card.style.animationDelay = `${index * 0.2}s`;
        observer.observe(card);
      });
      // Animate images from left
      const images = document.querySelectorAll('.about-image');
      images.forEach(img => {
        img.classList.add('animate-on-scroll-left');
        observer.observe(img);
      });

      // Floating animation for floating buttons
      const floatingButtons = document.querySelectorAll('.floating-button');
      floatingButtons.forEach((btn, index) => {
        btn.style.animationDelay = `${index * 0.3}s`;
        btn.classList.add('animate-float');
      });
      // Add pulse animation to CTA buttons on hover
      const ctaButtons = document.querySelectorAll('.hero-button--primary, .membership-button, .announcements-button');
      ctaButtons.forEach(btn => {
        btn.addEventListener('mouseenter', () => {
          btn.classList.add('animate-pulse');
        });
        btn.addEventListener('mouseleave', () => {
          btn.classList.remove('animate-pulse');
        });
      });
      // Enhanced button interactions
      const allButtons = document.querySelectorAll('button, .hero-button, .membership-button, .announcements-button, .header-button');
      allButtons.forEach(button => {
        // Hover effects
        button.addEventListener('mouseenter', function() {
          this.style.transform = 'translateY(-2px) scale(1.02)';
          this.style.transition = 'all 0.3s ease';
        });
        button.addEventListener('mouseleave', function() {
          this.style.transform = 'translateY(0) scale(1)';
        });
        // Ripple effect on click
        button.addEventListener('click', function(e) {
          const ripple = document.createElement('span');
          const rect = this.getBoundingClientRect();
          const size = Math.max(rect.width, rect.height);
          const x = e.clientX - rect.left - size / 2;
          const y = e.clientY - rect.top - size / 2;
          ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: rgba(255,255,255,0.3);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
            z-index: 1;
          `;
          this.style.position = 'relative';
          this.style.overflow = 'hidden';
          this.appendChild(ripple);
          setTimeout(() => {
            ripple.remove();
          }, 600);
        });
      });
    });
    // Parallax effect for hero section (desktop only)
    window.addEventListener('scroll', () => {
      if (window.innerWidth > 768) {
        const scrolled = window.pageYOffset;
        const hero = document.querySelector('.hero');
        if (hero) {
          const rate = scrolled * -0.3;
          hero.style.transform = `translateY(${rate}px)`;
        }
      }
    });
    // Loading animation sequence
    window.addEventListener('load', () => {
      document.body.classList.add('loaded');
      // Animate header elements in sequence
      const elementsToAnimate = [{
          selector: '.header',
          delay: 0
        },
        {
          selector: '.hero-title',
          delay: 200
        },
        {
          selector: '.hero-subtitle',
          delay: 400
        },
        {
          selector: '.hero-buttons',
          delay: 600
        }
      ];
      elementsToAnimate.forEach(item => {
        const element = document.querySelector(item.selector);
        if (element) {
          setTimeout(() => {
            element.classList.add('animate-fade-in-up');
          }, item.delay);
        }
      });
    });
    // Add CSS for ripple effect and loading animations
    const style = document.createElement('style');
    style.textContent = `
      @keyframes ripple {
        to {
          transform: scale(4);
          opacity: 0;
        }
      }
      
      .loaded .header {
        animation: slideInDown 0.6s ease-out;
      }
      
      .loaded .hero-content > * {
        animation: fadeInUp 0.8s ease-out forwards;
        opacity: 0;
      }
      
      .loaded .hero-title {
        animation-delay: 0.2s;
      }
      
      .loaded .hero-subtitle {
        animation-delay: 0.4s;
      }
      
      .loaded .hero-buttons {
        animation-delay: 0.6s;
      }

      /* Smooth transitions for all interactive elements */
      * {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }

      /* Enhanced scroll indicator */
      .section-divider {
        animation: pulse 2s infinite;
      }

      /* Staggered animation for list items */
      .about-list-item {
        opacity: 0;
        animation: fadeInLeft 0.6s ease-out forwards;
      }

      .about-list-item:nth-child(1) { animation-delay: 0.1s; }
      .about-list-item:nth-child(2) { animation-delay: 0.2s; }
      .about-list-item:nth-child(3) { animation-delay: 0.3s; }
      .about-list-item:nth-child(4) { animation-delay: 0.4s; }

      /* Enhanced floating buttons */
      .floating-buttons {
        animation: slideInRight 0.8s ease-out 1s both;
      }

      @keyframes slideInRight {
        from {
          transform: translateX(100px);
          opacity: 0;
        }
        to {
          transform: translateX(0);
          opacity: 1;
        }
      }
    `;
    document.head.appendChild(style);
    // Add scroll progress indicator
    const progressBar = document.createElement('div');
    progressBar.style.cssText = `
      position: fixed;
      top: 0;
      left: 0;
      width: 0%;
      height: 3px;
      background: linear-gradient(90deg, #b91c1c, #991b1b);
      z-index: 9999;
      transition: width 0.3s ease;
    `;
    document.body.appendChild(progressBar);
    window.addEventListener('scroll', () => {
      const scrollTop = window.pageYOffset;
      const docHeight = document.body.scrollHeight - window.innerHeight;
      const scrollPercent = (scrollTop / docHeight) * 100;
      progressBar.style.width = scrollPercent + '%';
    });
  </script>

  <?php wp_footer(); ?>
  
    <!-- Lightbox Modal -->
    <div id="lightbox-modal" class="lightbox-modal">
        <div class="lightbox-backdrop"></div>
        <div class="lightbox-container">
            <button class="lightbox-close" aria-label="Đóng">&times;</button>
            <button class="lightbox-prev" aria-label="Ảnh trước">&#8249;</button>
            <button class="lightbox-next" aria-label="Ảnh sau">&#8250;</button>
            <div class="lightbox-content">
                <img src="" alt="" class="lightbox-image">
                <div class="lightbox-caption"></div>
                <div class="lightbox-counter">
                    <span class="lightbox-current">1</span> / <span class="lightbox-total">1</span>
                </div>
            </div>
        </div>
    </div>


</body>
</html>