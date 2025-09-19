<?php
/**
 * Template part: Columns Section
 */

$title = get_sub_field('title');
$columns = get_sub_field('cot');
?>

<section id="columns" class="section section--white">
    <div class="container">
        <?php if ($title) : ?>
            <div class="section-header">
                <h2 class="section-title animate-on-scroll"><?php echo esc_html($title); ?></h2>
                <div class="section-divider"></div>
            </div>
        <?php endif; ?>
        
        <?php if ($columns && is_array($columns)) : ?>
            <div class="columns-container animate-on-scroll">
<?php $col_count = count($columns); ?>
<div class="columns-grid columns-<?php echo $col_count; ?>" 
     data-columns="<?php echo $col_count; ?>" 
     data-total="<?php echo $col_count; ?>">
    <?php foreach ($columns as $index => $column) { ?>
        <div class="column-item" data-aos-delay="<?php echo $index * 200; ?>">
            <div class="column-content">
                <?php if (!empty($column['cot'])) {
                    echo $column['cot'];
                } ?>
            </div>
        </div>
    <?php } ?>
</div>

            </div>
        <?php endif; ?>
    </div>
</section>

<style>
/* Columns Section Styles */
.columns-container {
    margin-top: 2rem;
}

.columns-grid {
    display: grid;
    gap: 2rem;
    align-items: start;
}

.columns-1 {
    grid-template-columns: 1fr;
	max-width: 800px;
    margin: 0 auto;
}

.columns-2 {
    grid-template-columns: repeat(2, 1fr);
}

.columns-3 {
    grid-template-columns: repeat(3, 1fr);
}

.columns-4,
.columns-5,
.columns-6,
.columns-7,
.columns-8,
.columns-9,
.columns-10,
.columns-11,
.columns-12 {
    grid-template-columns: repeat(3, 1fr);
}

/* Column Item */
.column-item {
    position: relative;
    transition: all 0.3s ease;
    opacity: 0;
    transform: translateY(30px);
}

.column-item.animated {
    opacity: 1;
    transform: translateY(0);
}

.column-content {
    padding: 0;
    background-color: var(--color-white);
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

/* Wrapper cho video */
.column-content iframe {
    width: 100%;
    height: 100%;
    border: 0;
    position: absolute;
    top: 0;
    left: 0;
}

/* Container để giữ tỷ lệ 16:9 */
.column-content p {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 ratio (9/16*100) */
    height: 0;
    overflow: hidden;
    margin: 0; /* loại bỏ margin mặc định của <p> */
}

.column-content::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(185, 28, 28, 0.05), transparent);
    transition: left 0.5s;
    will-change: left;
}

.column-item:hover .column-content {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.column-item:hover .column-content::before {
    left: 100%;
}

/* Content styling within columns */
.column-content h1,
.column-content h2,
.column-content h3,
.column-content h4,
.column-content h5,
.column-content h6 {
    color: var(--color-primary);
    margin-bottom: 1rem;
    font-weight: var(--font-weight-bold);
}

.column-content h1 { font-size: 2rem; }
.column-content h2 { font-size: 1.75rem; }
.column-content h3 { font-size: 1.5rem; }
.column-content h4 { font-size: 1.25rem; }
.column-content h5 { font-size: 1.125rem; }
.column-content h6 { font-size: 1rem; }

.column-content p {
    color: var(--color-text-light);
    line-height: 1.6;
    margin-bottom: 1rem;
}

.column-content p:last-child {
    margin-bottom: 0;
}

.column-content ul,
.column-content ol {
    color: var(--color-text-light);
    margin-bottom: 1rem;
    padding-left: 1.5rem;
}

.column-content li {
    margin-bottom: 0.5rem;
    line-height: 1.5;
}

.column-content strong,
.column-content b {
    color: var(--color-text);
    font-weight: var(--font-weight-semibold);
}

.column-content a {
    color: var(--color-primary);
    text-decoration: underline;
    transition: color 0.3s ease;
}

.column-content a:hover {
    color: var(--color-primary-dark);
}

.column-content img {
    border-radius: var(--border-radius);
    margin: 1rem 0;
    box-shadow: var(--shadow-md);
    transition: transform 0.3s ease;
}

.column-content img:hover {
    transform: scale(1.02);
}

.column-content blockquote {
    border-left: 4px solid var(--color-primary);
    padding-left: 1rem;
    margin: 1rem 0;
    font-style: italic;
    color: var(--color-text-light);
    background-color: var(--color-gray-50);
    padding: 1rem;
    border-radius: 0 var(--border-radius) var(--border-radius) 0;
}

/* Special styling for equal height columns */
.columns-grid.equal-height {
    align-items: stretch;
}

.columns-grid.equal-height .column-content {
    height: 100%;
    display: flex;
    flex-direction: column;
}

/* Responsive Design */
@media (max-width: 1024px) {
    /* Tablet: 4 cột -> 3 cột, 3 cột giữ nguyên, 2 cột giữ nguyên */
    .columns-grid[data-columns="4"],
    .columns-grid[data-total="5"],
    .columns-grid[data-total="6"],
    .columns-grid[data-total="7"],
    .columns-grid[data-total="8"],
    .columns-grid[data-total="9"],
    .columns-grid[data-total="10"],
    .columns-grid[data-total="11"],
    .columns-grid[data-total="12"] {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .columns-container {
        margin-top: 1rem;
    }
    
    .columns-grid {
        gap: 1.5rem;
    }
    
    /* Mobile: Tất cả về 2 cột trừ 1 cột */
    .columns-grid[data-columns="2"],
    .columns-grid[data-columns="3"],
    .columns-grid[data-columns="4"],
    .columns-grid[data-total="5"],
    .columns-grid[data-total="6"],
    .columns-grid[data-total="7"],
    .columns-grid[data-total="8"],
    .columns-grid[data-total="9"],
    .columns-grid[data-total="10"],
    .columns-grid[data-total="11"],
    .columns-grid[data-total="12"] {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .column-content {
        padding: 1.25rem;
    }
    
    .column-content h1 { font-size: 1.75rem; }
    .column-content h2 { font-size: 1.5rem; }
    .column-content h3 { font-size: 1.25rem; }
    .column-content h4 { font-size: 1.125rem; }
}

@media (max-width: 480px) {
    .columns-grid {
        gap: 1rem;
    }
    
    /* Small Mobile: Tất cả về 1 cột */
    .columns-grid[data-columns="1"],
    .columns-grid[data-columns="2"],
    .columns-grid[data-columns="3"],
    .columns-grid[data-columns="4"],
    .columns-grid[data-total="5"],
    .columns-grid[data-total="6"],
    .columns-grid[data-total="7"],
    .columns-grid[data-total="8"],
    .columns-grid[data-total="9"],
    .columns-grid[data-total="10"],
    .columns-grid[data-total="11"],
    .columns-grid[data-total="12"] {
        grid-template-columns: 1fr;
    }
    
    .column-content {
        padding: 1rem;
    }
    
    .column-content h1 { font-size: 1.5rem; }
    .column-content h2 { font-size: 1.375rem; }
    .column-content h3 { font-size: 1.25rem; }
}

/* Animation delays for staggered effect */
.column-item:nth-child(1) { animation-delay: 0.1s; }
.column-item:nth-child(2) { animation-delay: 0.2s; }
.column-item:nth-child(3) { animation-delay: 0.3s; }
.column-item:nth-child(4) { animation-delay: 0.4s; }
.column-item:nth-child(5) { animation-delay: 0.5s; }
.column-item:nth-child(6) { animation-delay: 0.6s; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation on scroll for columns
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add staggered animation
                const columns = entry.target.querySelectorAll('.column-item');
                columns.forEach((column, index) => {
                    setTimeout(() => {
                        column.classList.add('animated');
                    }, index * 200);
                });
            }
        });
    }, observerOptions);
    
    const columnsContainer = document.querySelector('.columns-container');
    if (columnsContainer) {
        observer.observe(columnsContainer);
    }
});
</script>