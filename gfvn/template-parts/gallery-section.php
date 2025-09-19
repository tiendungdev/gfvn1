<?php
/**
 * Template part: Gallery Section with Dynamic ID
 * Thêm field section_id vào ACF Gallery layout
 */

$title = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
$gallery = get_sub_field('gallery');

// Tạo ID động cho section
$section_id = get_sub_field('section_id'); // Field mới cần thêm vào ACF
if (empty($section_id)) {
    // Fallback nếu không nhập ID
    global $gallery_counter;
    if (!isset($gallery_counter)) {
        $gallery_counter = 0;
    }
    $gallery_counter++;
    $section_id = 'gallery-' . $gallery_counter;
}

// Đảm bảo ID hợp lệ
$section_id = sanitize_title($section_id);
?>

<section id="<?php echo esc_attr($section_id); ?>" class="section section--white gallery-section">
    <div class="container">
        <?php if ($title || $sub_title) : ?>
            <div class="section-header">
                <?php if ($title) : ?>
                    <h2 class="section-title animate-on-scroll"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                
                <?php if ($sub_title) : ?>
                    <p class="section-subtitle animate-on-scroll"><?php echo esc_html($sub_title); ?></p>
                <?php endif; ?>
                
                <div class="section-divider"></div>
            </div>
        <?php endif; ?>
        
        <?php if ($gallery && is_array($gallery)) : ?>
            <div class="gallery-container animate-on-scroll">
                <div class="gallery-grid">
                    <?php foreach ($gallery as $index => $image) : ?>
                        <div class="gallery-item" data-aos-delay="<?php echo $index * 100; ?>">
                            <a href="<?php echo esc_url($image['url']); ?>" 
                               class="gallery-link" 
                               data-lightbox="<?php echo esc_attr($section_id); ?>" 
                               data-title="<?php echo esc_attr($image['alt']); ?>">
                                <div class="gallery-image-wrapper">
                                    <img src="<?php echo esc_url($image['sizes']['medium_large'] ?? $image['url']); ?>" 
                                         alt="<?php echo esc_attr($image['alt']); ?>" 
                                         class="gallery-image"
                                         loading="lazy">
                                    <div class="gallery-overlay">
                                        <i class="fas fa-search-plus gallery-zoom-icon"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
<style>
/* Gallery Styles */
.gallery-container {
    margin-top: 2rem;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.gallery-item {
    position: relative;
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
    background-color: var(--color-white);
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.gallery-link {
    display: block;
    position: relative;
    aspect-ratio: 4/3;
    overflow: hidden;
}

.gallery-image-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-item:hover .gallery-image {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(185, 28, 28, 0.8), rgba(153, 27, 27, 0.9));
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-zoom-icon {
    color: var(--color-white);
    font-size: 2rem;
    animation: pulse 2s infinite;
}

/* Lightbox Styles */
.lightbox-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
}

.lightbox-modal.show {
    display: flex;
    animation: fadeIn 0.3s ease;
}

.lightbox-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    backdrop-filter: blur(5px);
}

.lightbox-container {
    position: relative;
    max-width: 90vw;
    max-height: 90vh;
    z-index: 10;
}

.lightbox-content {
    position: relative;
    background-color: var(--color-white);
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-xl);
}

.lightbox-image {
    max-width: 100%;
    max-height: 80vh;
    width: auto;
    height: auto;
    display: block;
}

.lightbox-caption {
    position: absolute;
    bottom: -60px;
    left: 50%;
    transform: translateX(-50%);
    padding: 1rem 2rem;
    background-color: rgba(0, 0, 0, 0.8);
    color: var(--color-white);
    font-weight: var(--font-weight-medium);
    text-align: center;
    border-radius: 9999px;
    min-width: 200px;
    font-size: 0.875rem;
}

.lightbox-counter {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background-color: rgba(0, 0, 0, 0.7);
    color: var(--color-white);
    padding: 0.5rem 1rem;
    border-radius: 9999px;
    font-size: 0.875rem;
    font-weight: var(--font-weight-medium);
}

.lightbox-close,
.lightbox-prev,
.lightbox-next {
    position: fixed !important;
    background-color: rgba(0, 0, 0, 0.8) !important;
    color: var(--color-white) !important;
    border: none !important;
    width: 3.5rem !important;
    height: 3.5rem !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 1.5rem !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    z-index: 1000000 !important;
    backdrop-filter: blur(5px);
    margin: 0 !important;
    padding: 0 !important;
}

.lightbox-close {
    top: 2rem !important;
    right: 2rem !important;
    font-size: 2rem !important;
    width: 4rem !important;
    height: 4rem !important;
}

.lightbox-prev {
    left: 2rem !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
}

.lightbox-next {
    right: 2rem !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
}

.lightbox-close:hover,
.lightbox-prev:hover,
.lightbox-next:hover {
    background-color: var(--color-primary);
    transform: scale(1.1);
}

.lightbox-prev:hover {
    transform: translateY(-50%) scale(1.1);
}

.lightbox-next:hover {
    transform: translateY(-50%) scale(1.1);
}

/* Responsive */
@media (max-width: 768px) {
    .gallery-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1rem;
    }
    
    .lightbox-container {
        max-width: 95vw;
        max-height: 95vh;
    }
    
    .lightbox-close,
    .lightbox-prev,
    .lightbox-next {
        width: 2.5rem;
        height: 2.5rem;
        font-size: 1.25rem;
    }
    
    .lightbox-close {
        top: -0.5rem;
        right: -0.5rem;
    }
    
    .lightbox-prev {
        left: -1rem;
    }
    
    .lightbox-next {
        right: -1rem;
    }
    
    .lightbox-counter {
        font-size: 0.75rem;
        padding: 0.25rem 0.75rem;
    }
}

@media (max-width: 480px) {
    .gallery-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    }
    
    .lightbox-image {
        max-height: 70vh;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const galleryLinks = document.querySelectorAll('.gallery-link');
    const lightbox = document.getElementById('lightbox-modal');
    const lightboxImage = lightbox.querySelector('.lightbox-image');
    const lightboxCaption = lightbox.querySelector('.lightbox-caption');
    const lightboxCurrent = lightbox.querySelector('.lightbox-current');
    const lightboxTotal = lightbox.querySelector('.lightbox-total');
    const closeBtn = lightbox.querySelector('.lightbox-close');
    const prevBtn = lightbox.querySelector('.lightbox-prev');
    const nextBtn = lightbox.querySelector('.lightbox-next');
    const backdrop = lightbox.querySelector('.lightbox-backdrop');
    
    let currentIndex = 0;
    let images = [];
    
    // Khởi tạo gallery
    function initGallery() {
        images = Array.from(galleryLinks).map(link => ({
            src: link.href,
            alt: link.dataset.title || link.querySelector('img').alt
        }));
        
        lightboxTotal.textContent = images.length;
        
        galleryLinks.forEach((link, index) => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                openLightbox(index);
            });
        });
    }
    
    // Mở lightbox
    function openLightbox(index) {
        currentIndex = index;
        updateLightbox();
        lightbox.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    // Đóng lightbox
    function closeLightbox() {
        lightbox.classList.remove('show');
        document.body.style.overflow = '';
    }
    
    // Cập nhật nội dung lightbox
    function updateLightbox() {
        const image = images[currentIndex];
        lightboxImage.src = image.src;
        lightboxImage.alt = image.alt;
        lightboxCaption.textContent = image.alt || '';
        lightboxCurrent.textContent = currentIndex + 1;
        
        // Ẩn/hiện nút prev/next
        prevBtn.style.display = images.length > 1 ? 'flex' : 'none';
        nextBtn.style.display = images.length > 1 ? 'flex' : 'none';
    }
    
    // Ảnh trước
    function prevImage() {
        currentIndex = currentIndex > 0 ? currentIndex - 1 : images.length - 1;
        updateLightbox();
    }
    
    // Ảnh sau
    function nextImage() {
        currentIndex = currentIndex < images.length - 1 ? currentIndex + 1 : 0;
        updateLightbox();
    }
    
    // Event listeners
    closeBtn.addEventListener('click', closeLightbox);
    backdrop.addEventListener('click', closeLightbox);
    prevBtn.addEventListener('click', prevImage);
    nextBtn.addEventListener('click', nextImage);
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (!lightbox.classList.contains('show')) return;
        
        switch(e.key) {
            case 'Escape':
                closeLightbox();
                break;
            case 'ArrowLeft':
                prevImage();
                break;
            case 'ArrowRight':
                nextImage();
                break;
        }
    });
    
    // Touch/swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    lightbox.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    });
    
    lightbox.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;
        
        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                nextImage(); // Swipe left - next image
            } else {
                prevImage(); // Swipe right - previous image
            }
        }
    }
    
    // Khởi tạo
    if (galleryLinks.length > 0) {
        initGallery();
    }
    
    // Animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
});
</script>