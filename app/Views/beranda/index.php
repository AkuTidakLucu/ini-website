<!-- Tambahkan link font baru di meta section -->
<?= $this->extend('layout/app'); ?>

<?= $this->section('meta'); ?>
<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />

<!-- Font dari template Tailwind -->
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<?php
$this->setData([
    'title' => ($lang == 'id') ? $meta['title_beranda'] : $meta['title_beranda_en'],
    'meta_description' => ($lang == 'id') ? $meta['meta_description_beranda'] : $meta['meta_description_beranda_en']
]);
?>

<!-- CSS di atas sudah termasuk di bagian atas -->
<style>
    /* =========================
    1) Design tokens (global)
    ========================= */
    :root {
        --font-size-title-cta: 38px;
        --font-size-desc-cta: 18px;
        
        /* WARNA SESUAI TEMPLATE TAILWIND */
        --c-primary: #0D9488;          /* Teal 600 */
        --c-primary-dark: #0F766E;     /* Teal 700 */
        --c-accent: #D99A6C;           /* Accent warna emas/teal */
        --c-accent-light: #ECB176;     
        --c-background: #F8FAFC;       /* Slate 50 */
        --c-surface: #FFFFFF;
        --c-dark: #0F172A;             /* Slate 900 */
        --c-text: #0F172A;             /* Slate 900 */
        --c-text-light: #64748B;       /* Slate 500 */
        --c-border: #E2E8F0;           /* Slate 200 */
        
        /* Bootstrap Overrides */
        --bs-primary: var(--c-primary);
        --bs-primary-rgb: 13, 148, 136;
        --bs-warning: var(--c-accent);
        --bs-warning-rgb: 217, 154, 108;
    }

    /* ===================================================
       1. Global Reset
       =================================================== */
    * {
        box-sizing: border-box;
    }

    body {
        background-color: var(--c-background);
        color: var(--c-text);
        font-family: 'DM Sans', sans-serif;
        line-height: 1.6;
        overflow-x: hidden;
    }

    .title-cta, .title-carousel, h1, h2, h3, h4, h5, h6 {
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        letter-spacing: -0.01em;
    }

    .font-mono {
        font-family: 'Space Mono', monospace;
    }

    /* ===================================================
       ANIMATIONS & TRANSITIONS
       =================================================== */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes marquee {
        0% { transform: translateX(0%); }
        100% { transform: translateX(-50%); }
    }

    @keyframes pulse-slow {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-pulse-slow {
        animation: pulse-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    .animate-marquee {
        animation: marquee 30s linear infinite;
    }

    /* ===================================================
       UI COMPONENTS
       =================================================== */
    /* Bento Cards */
    .bento-card {
        background: var(--c-surface);
        border: 1px solid var(--c-border);
        border-radius: 16px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    }

    .bento-card:hover {
        border-color: var(--c-primary);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        transform: translateY(-4px);
    }

    /* Grid Background Pattern */
    .grid-pattern {
        background-size: 40px 40px;
        background-image: 
            linear-gradient(to right, var(--c-border) 1px, transparent 1px),
            linear-gradient(to bottom, var(--c-border) 1px, transparent 1px);
        mask-image: linear-gradient(to bottom, black 40%, transparent 100%);
    }

    /* Glass Effect */
    .glass-nav {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(226, 232, 240, 0.8);
    }

    /* ===================================================
       2. Slider (Carousel) - STYLE BARU
       =================================================== */
    #carouselExampleDark {
        position: relative;
        width: 100%;
        overflow: hidden;
        min-height: 90vh;
    }

    .carousel-inner {
        width: 100%;
        height: 100%;
    }

    .carousel-item {
        position: relative;
        height: 90vh;
    }

    .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 6s ease-out;
    }

    .carousel-item.active img {
        transform: scale(1);
    }

    /* Overlay untuk readability */
    .carousel-item::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(13, 148, 136, 0.1), rgba(15, 118, 110, 0.4));
        z-index: 1;
    }

    /* Carousel caption - POSISI TENGAH SEPERTI TEMPLATE */
    .carousel-caption {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        width: 90%;
        max-width: 800px;
        padding: 0;
        background: transparent !important;
        z-index: 2;
    }

    /* Badge Status */
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: var(--c-surface);
        border: 1px solid var(--c-border);
        border-radius: 50px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
        animation: fadeInUp 0.8s ease-out;
    }

    .hero-badge-dot {
        position: relative;
        width: 12px;
        height: 12px;
    }

    .hero-badge-dot::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 50%;
        background: var(--c-primary);
        animation: pulse 2s infinite;
    }

    .hero-badge-dot::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 50%;
        background: var(--c-primary);
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.5); opacity: 0.5; }
    }

    .title-carousel {
        font-size: 3.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 20px;
        line-height: 1.1;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    @media (min-width: 768px) {
        .title-carousel {
            font-size: 4.5rem;
        }
    }

    .desc-carousel {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 40px;
        line-height: 1.6;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    /* TOMBOL PREV/NEXT STYLE BARU */
    .carousel-control-prev,
    .carousel-control-next {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        transition: all 0.3s ease;
        margin: 0 20px;
    }

    #carouselExampleDark:hover .carousel-control-prev,
    #carouselExampleDark:hover .carousel-control-next {
        opacity: 1;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 24px;
        height: 24px;
        background-size: 100%;
        filter: invert(1);
    }

    /* Indicators style baru */
    .carousel-indicators {
        bottom: 40px;
        gap: 8px;
    }

    .carousel-indicators [data-bs-target] {
        width: 40px;
        height: 4px;
        border-radius: 2px;
        background: rgba(255, 255, 255, 0.5);
        border: none;
        transition: all 0.3s ease;
    }

    .carousel-indicators [data-bs-target].active {
        background: var(--c-primary);
        transform: scaleX(1.2);
    }

    /* ===================================================
       3. PARTNERS MARQUEE SECTION
       =================================================== */
    .partners-section {
        padding: 40px 0;
        background: var(--c-surface);
        border-top: 1px solid var(--c-border);
        border-bottom: 1px solid var(--c-border);
        overflow: hidden;
        position: relative;
    }

    .partners-marquee {
        display: flex;
        gap: 60px;
        align-items: center;
        white-space: nowrap;
        width: max-content;
    }

    .partner-item {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--c-text);
        opacity: 0.7;
        transition: all 0.3s ease;
    }

    .partner-item:hover {
        opacity: 1;
        color: var(--c-primary);
    }

    .partner-item i {
        font-size: 1.5rem;
        color: var(--c-primary);
    }

    /* Gradient overlay untuk marquee */
    .partners-section::before,
    .partners-section::after {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100px;
        z-index: 2;
        pointer-events: none;
    }

    .partners-section::before {
        left: 0;
        background: linear-gradient(to right, var(--c-surface), transparent);
    }

    .partners-section::after {
        right: 0;
        background: linear-gradient(to left, var(--c-surface), transparent);
    }

    /* ===================================================
       4. CTA "Daftar Sekarang" - STYLE BARU
       =================================================== */
    .daftar-section {
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        width: 90%;
        max-width: 1200px;
        margin: 100px auto;
        padding: 60px 50px;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(13, 148, 136, 0.2);
        position: relative;
        overflow: hidden;
    }

    .daftar-section::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(30%, -30%);
    }

    .daftar-section .row {
        align-items: center;
        position: relative;
        z-index: 1;
    }

    .title-cta {
        font-size: 3rem;
        color: white;
        margin-bottom: 20px;
        position: relative;
        display: inline-block;
    }

    @media (min-width: 768px) {
        .title-cta {
            font-size: 3.5rem;
        }
    }

    .desc-cta {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.9);
        margin-top: 30px;
        margin-bottom: 40px;
        line-height: 1.7;
    }

    .daftar-section img.daftar-img {
        width: 100%;
        max-width: 500px;
        height: auto;
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        transform: perspective(1000px) rotateY(-10deg);
        transition: transform 0.5s ease;
    }

    .daftar-section img.daftar-img:hover {
        transform: perspective(1000px) rotateY(0deg);
    }

    /* ===================================================
       5. Benefit Join - STYLE BARU (DIPERBAIKI)
       =================================================== */
    .benefit-main-section {
        margin: 100px 0;
    }

    .benefit-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .benefit-header .section-badge {
        display: inline-block;
        padding: 8px 16px;
        background: rgba(13, 148, 136, 0.1);
        color: var(--c-primary);
        font-family: 'Space Mono', monospace;
        font-size: 0.875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border-radius: 50px;
        border: 1px solid rgba(13, 148, 136, 0.2);
        margin-bottom: 20px;
    }

    .benefit-header .title-cta {
        color: var(--c-text);
        font-size: 3rem;
        margin-bottom: 20px;
    }

    .benefit-header .desc-cta {
        color: var(--c-text-light);
        font-size: 1.25rem;
        max-width: 700px;
        margin: 0 auto;
    }

    /* Bento Grid untuk manfaat - DIPERBAIKI */
    .benefits-bento-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 50px;
    }

    .benefit-item-bento {
        background: var(--c-surface);
        border: 1px solid var(--c-border);
        border-radius: 20px;
        padding: 40px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .benefit-item-bento::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--c-primary), var(--c-accent));
        border-radius: 4px 4px 0 0;
    }

    .benefit-item-bento:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }

    .benefit-icon-box {
        width: 80px;
        height: 80px;
        background: rgba(13, 148, 136, 0.1);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .benefit-item-bento:hover .benefit-icon-box {
        background: var(--c-primary);
        transform: rotate(5deg);
    }

    .benefit-item-bento:hover .benefit-icon-box i {
        color: white;
    }

    .benefit-icon-box i {
        font-size: 2rem;
        color: var(--c-primary);
        transition: all 0.3s ease;
    }

    .benefit-item-bento h6 {
        font-size: 1.5rem;
        color: var(--c-text);
        margin-bottom: 15px;
        font-weight: 700;
    }

    .benefit-item-bento p {
        color: var(--c-text-light);
        line-height: 1.7;
        margin-bottom: 0;
    }

    /* ===================================================
       6. TABS INTERAKTIF - STYLE BARU (DIPERBAIKI)
       =================================================== */
    .manfaat-tabs-section {
        margin: 100px 0;
        padding: 60px 0;
        background: var(--c-background);
        border-radius: 24px;
        position: relative;
        overflow: hidden;
    }

    .manfaat-tabs-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--c-border), transparent);
    }

    .benefits-tabs-navigation {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 50px;
    }

    .benefit-tab-btn {
        padding: 20px 30px;
        background: var(--c-surface);
        border: 2px solid var(--c-border);
        border-radius: 16px;
        color: var(--c-text);
        font-weight: 600;
        font-size: 1.125rem;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 250px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .benefit-tab-btn:hover {
        border-color: var(--c-primary);
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(13, 148, 136, 0.1);
    }

    .benefit-tab-btn.active {
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        color: white;
        border-color: var(--c-primary);
        box-shadow: 0 10px 25px rgba(13, 148, 136, 0.2);
    }

    .benefit-tab-btn i {
        font-size: 1.5rem;
        margin-right: 12px;
    }

    .benefit-tab-pane {
        display: none;
        animation: fadeInUp 0.5s ease;
        background: var(--c-surface);
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--c-border);
    }

    .benefit-tab-pane.active {
        display: block;
    }

    .benefit-content-title {
        font-size: 2.5rem;
        color: var(--c-text);
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 15px;
    }

    .benefit-content-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--c-primary), var(--c-accent));
        border-radius: 2px;
    }

    .benefit-content-desc {
        color: var(--c-text-light);
        font-size: 1.125rem;
        line-height: 1.7;
        margin-bottom: 35px;
    }

    .benefit-features-list {
        list-style: none;
        padding-left: 0;
        margin-bottom: 40px;
    }

    .benefit-features-list li {
        padding: 12px 0;
        padding-left: 40px;
        position: relative;
        color: var(--c-text);
        font-size: 1.125rem;
        line-height: 1.6;
    }

    .benefit-features-list li::before {
        content: '✓';
        position: absolute;
        left: 0;
        top: 12px;
        width: 28px;
        height: 28px;
        background: var(--c-primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        font-weight: bold;
    }

    .benefit-image-wrapper img {
        width: 100%;
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        transition: transform 0.5s ease;
    }

    .benefit-image-wrapper:hover img {
        transform: scale(1.02);
    }

    /* ===================================================
       6. TABS INTERAKTIF - STYLE BARU (DIPERBAIKI LAGI)
       =================================================== */
    .manfaat-tabs-section {
        margin: 100px 0;
        padding: 60px 0;
        background: var(--c-background);
        border-radius: 24px;
        position: relative;
        overflow: hidden;
    }

    .manfaat-tabs-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--c-border), transparent);
    }

    .tabs-header-wrapper {
        text-align: center;
        margin-bottom: 40px;
    }

    .tabs-title {
        font-size: 3rem;
        color: var(--c-text);
        margin-bottom: 15px;
        font-weight: 700;
    }

    .tabs-subtitle {
        color: var(--c-text-light);
        font-size: 1.25rem;
        max-width: 700px;
        margin: 0 auto 40px;
    }

    .benefits-tabs-navigation {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 50px;
    }

    /* ===================================================
       7. PAKET VISITOR / MEMBER - STYLE BARU (DIPERBAIKI)
       =================================================== */
    .package-section-title {
        text-align: center;
        margin-bottom: 60px;
    }

    .package-section-title .section-badge {
        display: inline-block;
        padding: 8px 20px;
        background: rgba(13, 148, 136, 0.1);
        color: var(--c-primary);
        font-family: 'Space Mono', monospace;
        font-size: 0.875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border-radius: 50px;
        border: 1px solid rgba(13, 148, 136, 0.2);
        margin-bottom: 20px;
    }

    .package-section-title h2 {
        font-size: 3rem;
        color: var(--c-text);
        margin-bottom: 20px;
    }

    .package-section-title h2 span {
        color: var(--c-primary);
        position: relative;
    }

    .package-section-title h2 span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--c-primary), var(--c-accent));
        border-radius: 2px;
    }

    .package-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .package-card {
        background: var(--c-surface);
        border: 1px solid var(--c-border);
        border-radius: 24px;
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .package-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }

    .package-card.featured {
        border: 2px solid var(--c-primary);
    }

    .package-card-header {
        padding: 40px 30px;
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
    }

    .package-card.visitor .package-card-header {
        background: linear-gradient(135deg, #64748B 0%, #475569 100%);
    }

    .package-card.member .package-card-header {
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
    }

    .package-card-header h3 {
        color: white;
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .featured-badge {
        position: absolute;
        top: 20px;
        right: -35px;
        background: var(--c-accent);
        color: white;
        font-size: 0.875rem;
        font-weight: 800;
        padding: 8px 40px;
        transform: rotate(45deg);
        box-shadow: 0 4px 15px rgba(217, 154, 108, 0.3);
        z-index: 10;
    }

    .package-card-body {
        padding: 40px 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .package-price {
        font-size: 3rem;
        font-weight: 700;
        color: var(--c-text);
        margin-bottom: 20px;
    }

    .package-price .currency {
        font-size: 2rem;
        vertical-align: super;
    }

    .package-price .period {
        font-size: 1rem;
        color: var(--c-text-light);
    }

    .package-description {
        color: var(--c-text-light);
        margin-bottom: 30px;
        line-height: 1.6;
        flex-grow: 1;
    }

    .package-features {
        list-style: none;
        padding: 0;
        margin: 0 0 30px 0;
        flex-grow: 1;
    }

    .package-features li {
        padding: 12px 0;
        color: var(--c-text);
        position: relative;
        padding-left: 35px;
    }

    .package-features li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: var(--c-primary);
        font-weight: bold;
    }

    .package-card-footer {
        padding: 30px;
        background: rgba(248, 250, 252, 0.5);
        border-top: 1px solid var(--c-border);
        flex-shrink: 0;
    }

    .btn-choose-plan {
        width: 100%;
        padding: 18px;
        font-size: 1.125rem;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.3s ease;
        min-height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-visitor {
        background: transparent;
        border: 2px solid var(--c-border);
        color: var(--c-text);
    }

    .btn-visitor:hover:not(:disabled) {
        background: var(--c-border);
        transform: translateY(-3px);
    }

    .btn-member {
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        border: none;
        color: white;
    }

    .btn-member:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(13, 148, 136, 0.3);
    }

    /* TOMBOL SEJAJAR - PERBAIKAN */
    .package-buttons-container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    /* ===================================================
       8. PETA MEMBER - STYLE BARU
       =================================================== */
    .map-section {
        margin: 100px 0;
    }

    .map-section-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .map-section-header .section-badge {
        display: inline-block;
        padding: 8px 20px;
        background: rgba(13, 148, 136, 0.1);
        color: var(--c-primary);
        font-family: 'Space Mono', monospace;
        font-size: 0.875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border-radius: 50px;
        border: 1px solid rgba(13, 148, 136, 0.2);
        margin-bottom: 20px;
    }

    .map-section-header h2 {
        font-size: 3rem;
        color: var(--c-text);
        margin-bottom: 20px;
    }

    .map-section-header h2 span {
        color: var(--c-primary);
        position: relative;
    }

    .map-section-header h2 span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--c-primary), var(--c-accent));
        border-radius: 2px;
    }

    #map {
        width: 100%;
        height: 600px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 3px solid white;
    }

    /* ===================================================
       9. AJAKAN TENGAH BANNER - STYLE BARU
       =================================================== */
    .cta-banner {
        margin: 100px 0;
        padding: 80px 0;
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        position: relative;
        overflow: hidden;
    }

    .cta-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&q=80') center/cover;
        opacity: 0.1;
    }

    .cta-banner-content {
        position: relative;
        z-index: 1;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
    }

    .cta-banner h2 {
        font-size: 3.5rem;
        color: white;
        margin-bottom: 30px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .cta-banner p {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 40px;
        line-height: 1.7;
    }

    .btn-cta-banner {
        padding: 18px 50px;
        background: var(--c-dark);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1.125rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .btn-cta-banner:hover {
        background: #1e293b;
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    }

    /* ===================================================
       10. RESPONSIVE
       =================================================== */

    /* Tablet */
    @media (max-width: 992px) {
        .title-carousel {
            font-size: 3rem;
        }
        
        .daftar-section {
            width: 95%;
            padding: 50px 40px;
        }
        
        .benefits-bento-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .package-grid {
            grid-template-columns: 1fr;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
    }

    /* Mobile */
    @media (max-width: 768px) {
        .title-carousel {
            font-size: 2.5rem;
        }
        
        .desc-carousel {
            font-size: 1.125rem;
        }
        
        .carousel-item {
            height: 80vh;
        }
        
        .daftar-section {
            padding: 40px 30px;
            margin: 80px auto;
        }
        
        .title-cta {
            font-size: 2.5rem;
        }
        
        .benefits-bento-grid {
            grid-template-columns: 1fr;
        }
        
        .benefits-tabs-navigation {
            flex-direction: column;
            align-items: center;
        }
        
        .benefit-tab-btn {
            width: 100%;
            max-width: 400px;
        }
        
        .benefit-tab-pane {
            padding: 30px;
        }
        
        .cta-banner h2 {
            font-size: 2.5rem;
        }
        
        #map {
            height: 400px;
        }
    }

    /* Small Mobile */
    @media (max-width: 576px) {
        .title-carousel {
            font-size: 2rem;
        }
        
        .hero-badge {
            padding: 6px 12px;
            font-size: 0.875rem;
        }
        
        .daftar-section {
            width: 98%;
            padding: 30px 20px;
        }
        
        .title-cta {
            font-size: 2rem;
        }
        
        .benefit-header .title-cta {
            font-size: 2rem;
        }
        
        .benefit-item-bento {
            padding: 30px;
        }
        
        .cta-banner {
            padding: 60px 20px;
        }
        
        .cta-banner h2 {
            font-size: 2rem;
        }
        
        .package-section-title h2,
        .map-section-header h2 {
            font-size: 2rem;
        }
    }

/* ===================================================
       STYLE UNTUK CHAT BUTTON DAN IFRAME - DIUBAH DIMENSI
    =================================================== */
    .chat-button-container {
        position: fixed;
        bottom: 90px; /* DIPOSISIKAN DI ATAS WHATSAPP (biasanya WhatsApp di 20-30px) */
        right: 30px;
        z-index: 1000;
    }

    .chat-toggle-button {
        width: 65px;
        height: 65px;
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        border: none;
        border-radius: 50%;
        color: white;
        font-size: 28px;
        cursor: pointer;
        box-shadow: 0 6px 20px rgba(111, 78, 55, 0.4);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .chat-toggle-button:hover {
        transform: scale(1.15);
        box-shadow: 0 8px 25px rgba(111, 78, 55, 0.5);
        background: linear-gradient(135deg, var(--c-primary-light) 0%, var(--c-primary) 100%);
    }

    .chat-toggle-button.active {
        background: linear-gradient(135deg, var(--c-accent) 0%, var(--c-accent-light) 100%);
        transform: scale(1.1);
    }

    .chat-iframe-container {
        position: fixed;
        bottom: 165px; /* DIPOSISIKAN DI ATAS TOMBOL CHAT (65px + 30px margin + 70px untuk jarak) */
        right: 30px;
        width: 380px; /* Lebar ditambah sedikit */
        height: 510px; /* TINGGI DIPERBESAR (dari 500px menjadi 650px) */
        background: white;
        border-radius: 18px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
        z-index: 999;
        overflow: hidden;
        display: none;
        opacity: 0;
        transform: translateY(20px) scale(0.95);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(111, 78, 55, 0.15);
    }

    .chat-iframe-container.active {
        display: block;
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    .chat-header {
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-light) 100%);
        color: white;
        padding: 18px 25px;
        border-radius: 18px 18px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid var(--c-accent-light);
    }

    .chat-header h5 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        font-family: "Poetsen One", sans-serif;
        letter-spacing: 0.5px;
    }

    .close-chat {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        font-size: 22px;
        cursor: pointer;
        padding: 0;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .close-chat:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    .chat-iframe {
        width: 100%;
        height: calc(100% - 68px); /* Disesuaikan dengan tinggi header */
        border: none;
        background: white;
    }

    /* Badge notifikasi (opsional) */
    .chat-notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #ff4757;
        color: white;
        font-size: 12px;
        font-weight: bold;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 3px 8px rgba(255, 71, 87, 0.4);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    /* Responsif untuk chat - DIMENSI DIUBAH */
    @media (max-width: 768px) {
        .chat-button-container {
            bottom: 85px;
            right: 20px;
        }

        .chat-toggle-button {
            width: 60px;
            height: 60px;
            font-size: 26px;
        }

        .chat-iframe-container {
            width: 350px;
            height: 420px; /* Tetap tinggi di mobile */
            right: 20px;
            bottom: 155px;
        }

        .chat-header {
            padding: 16px 20px;
        }

        .chat-header h5 {
            font-size: 16px;
        }
    }

    @media (max-width: 576px) {
        .chat-iframe-container {
            width: calc(100% - 40px);
            height: 420px; /* Masih cukup tinggi di mobile */
            max-height: 70vh; /* Maksimal 70% dari tinggi layar */
            right: 20px;
            left: 20px;
            margin: 0 auto;
            bottom: 140px;
        }

        .chat-button-container {
            bottom: 80px;
            right: 20px;
        }

        .chat-toggle-button {
            width: 58px;
            height: 58px;
            font-size: 24px;
        }
    }

    @media (max-width: 425px) {
        .chat-iframe-container {
            height: 420px;
            bottom: 135px;
        }

        .chat-button-container {
            bottom: 75px;
        }
    }

    /* Untuk layar sangat kecil, pertahankan usability */
    @media (max-height: 700px) {
        .chat-iframe-container {
            height: 380px;
            bottom: 130px;
        }
    }

        /* ===================================================
       CHATBOT STYLES FOR INDEX
       =================================================== */
    .chatbot-container-index {
        position: fixed;
        bottom: 100px;
        right: 30px;
        z-index: 1100;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .chatbot-toggle-index {
        width: 65px;
        height: 65px;
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        border: none;
        border-radius: 50%;
        color: white;
        font-size: 28px;
        cursor: pointer;
        box-shadow: 0 6px 20px rgba(13, 148, 136, 0.4);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 1101;
    }

    .chatbot-toggle-index:hover {
        transform: scale(1.15);
        box-shadow: 0 8px 25px rgba(13, 148, 136, 0.5);
        background: linear-gradient(135deg, var(--c-primary-dark) 0%, var(--c-primary) 100%);
    }

    .chatbot-toggle-index.active {
        background: linear-gradient(135deg, var(--c-accent) 0%, var(--c-accent-light) 100%);
        transform: scale(1.1);
    }

    .chatbot-window-index {
        position: absolute;
        bottom: 80px;
        right: 0;
        width: 380px;
        height: 510px;
        background: white;
        border-radius: 18px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
        z-index: 1100;
        overflow: hidden;
        display: none;
        opacity: 0;
        transform: translateY(20px) scale(0.95);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(13, 148, 136, 0.15);
    }

    .chatbot-window-index.active {
        display: block;
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    .chatbot-header-index {
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        color: white;
        padding: 18px 25px;
        border-radius: 18px 18px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid var(--c-accent-light);
    }

    .chatbot-header-index h5 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .close-chatbot-index {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        font-size: 22px;
        cursor: pointer;
        padding: 0;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .close-chatbot-index:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    .chatbot-iframe-index {
        width: 100%;
        height: calc(100% - 68px);
        border: none;
        background: white;
    }

    /* Notification badge */
    .chatbot-badge-index {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #ff4757;
        color: white;
        font-size: 12px;
        font-weight: bold;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 3px 8px rgba(255, 71, 87, 0.4);
        animation: pulse 2s infinite;
    }

    /* Responsive chatbot untuk index */
    @media (max-width: 768px) {
        .chatbot-container-index {
            bottom: 90px;
            right: 20px;
        }

        .chatbot-toggle-index {
            width: 60px;
            height: 60px;
            font-size: 26px;
        }

        .chatbot-window-index {
            width: 350px;
            height: 450px;
            right: 0;
            bottom: 75px;
        }

        .chatbot-header-index {
            padding: 16px 20px;
        }

        .chatbot-header-index h5 {
            font-size: 16px;
        }
    }

    @media (max-width: 576px) {
        .chatbot-window-index {
            width: calc(100% - 40px);
            height: 420px;
            right: 20px;
            left: 20px;
            margin: 0 auto;
            bottom: 70px;
        }

        .chatbot-container-index {
            bottom: 85px;
            right: 20px;
        }

        .chatbot-toggle-index {
            width: 58px;
            height: 58px;
            font-size: 24px;
        }
    }

    @media (max-width: 425px) {
        .chatbot-window-index {
            height: 420px;
            bottom: 65px;
        }

        .chatbot-container-index {
            bottom: 80px;
        }
    }

        /* ===================================================
       COMMUNITY SPOTLIGHT SECTION
       =================================================== */
    .community-spotlight-section {
        margin: 100px 0;
        padding: 80px 0;
        background: var(--c-background);
        border-radius: 24px;
    }

    .community-spotlight-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .community-spotlight-title {
        font-size: 3rem;
        color: var(--c-text);
        margin-bottom: 20px;
        font-weight: 700;
    }

    .community-spotlight-title .highlight-text {
        color: var(--c-primary);
        position: relative;
    }

    .community-spotlight-title .highlight-text::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--c-primary), var(--c-accent));
        border-radius: 2px;
    }

    .community-spotlight-desc {
        color: var(--c-text-light);
        font-size: 1.25rem;
        max-width: 800px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* Community Map Container */
    .community-map-container {
        position: relative;
        height: 500px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    /* Member List Container */
    .member-list-container {
        background: var(--c-surface);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--c-border);
        height: 500px;
        display: flex;
        flex-direction: column;
    }

    .member-list-title {
        font-size: 1.5rem;
        color: var(--c-text);
        margin-bottom: 25px;
        font-weight: 700;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--c-border);
    }

    .member-list-scroll {
        flex-grow: 1;
        overflow-y: auto;
        padding-right: 10px;
    }

    /* Member Card */
    .member-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid var(--c-border);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .member-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        border-color: var(--c-primary);
    }

    .member-card-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .member-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
    }

    .member-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .member-info {
        flex-grow: 1;
    }

    .member-name {
        font-size: 1.125rem;
        color: var(--c-text);
        margin-bottom: 5px;
        font-weight: 600;
    }

    .member-company {
        font-size: 0.875rem;
        color: var(--c-text-light);
        margin-bottom: 8px;
    }

    .member-badge {
        display: inline-block;
        padding: 4px 10px;
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        color: white;
        font-size: 0.75rem;
        font-weight: 700;
        border-radius: 4px;
    }

    .member-card-body {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .member-location {
        font-size: 0.875rem;
        color: var(--c-text-light);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .member-location i {
        color: var(--c-primary);
    }

    .btn-view-profile {
        padding: 8px 16px;
        background: transparent;
        border: 1px solid var(--c-primary);
        color: var(--c-primary);
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-view-profile:hover {
        background: var(--c-primary);
        color: white;
        transform: translateY(-2px);
    }

    /* Scrollbar styling */
    .member-list-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .member-list-scroll::-webkit-scrollbar-track {
        background: rgba(13, 148, 136, 0.05);
        border-radius: 3px;
    }

    .member-list-scroll::-webkit-scrollbar-thumb {
        background: var(--c-primary);
        border-radius: 3px;
    }

    /* Costum */
        /* Custom marker styling */
    .custom-marker-container {
        background: transparent;
        border: none;
    }

    .custom-marker {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        box-shadow: 0 4px 12px rgba(13, 148, 136, 0.3);
        border: 3px solid white;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .custom-marker:hover {
        transform: scale(1.2);
        box-shadow: 0 6px 20px rgba(13, 148, 136, 0.4);
    }

    /* Map popup styling */
    .map-popup {
        min-width: 250px;
        padding: 0;
        font-family: 'DM Sans', sans-serif;
    }

    .leaflet-popup-content-wrapper {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        border: 1px solid var(--c-border);
    }

    .leaflet-popup-content {
        margin: 0;
        padding: 20px;
    }

    .popup-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 15px;
        border: 3px solid var(--c-primary);
    }

    .popup-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .popup-content {
        text-align: center;
    }

    .popup-content h4 {
        color: var(--c-text);
        margin-bottom: 8px;
        font-size: 1.25rem;
        font-weight: 700;
    }

    .popup-content .company {
        color: var(--c-text-light);
        font-size: 0.875rem;
        margin-bottom: 8px;
    }

    .popup-content .location {
        color: var(--c-primary);
        font-size: 0.875rem;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .btn-popup-profile {
        display: inline-block;
        padding: 8px 20px;
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        color: white;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-popup-profile:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 148, 136, 0.3);
    }
</style>

<!-- ================= Chatbot untuk Index ================= -->
<div class="chatbot-container-index">
    <button class="chatbot-toggle-index" id="chatbotToggleIndex" aria-label="Open Chatbot">
        <i class="fas fa-comment-alt"></i>
        <!-- Optional notification badge -->
        <!-- <span class="chatbot-badge-index">3</span> -->
    </button>
    <div class="chatbot-window-index" id="chatbotWindowIndex">
        <div class="chatbot-header-index">
            <h5><?= ($lang == 'en') ? 'Live Chat Support' : 'Dukungan Chat Langsung' ?></h5>
            <button class="close-chatbot-index" id="closeChatbotIndex">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <iframe src="http://localhost:8080/chat/" class="chatbot-iframe-index" id="chatbotIframeIndex"></iframe>
    </div>
</div>

<!-- ================= WhatsApp Float ================= -->
<a href="https://wa.me/<?= !empty($webprofile[0]['nohp_web']) ? esc($webprofile[0]['nohp_web']) : '' ?>" target="_blank" rel="noopener" class="whatsapp-float" aria-label="WhatsApp">
    <i class="fab fa-whatsapp whatsapp-icon"></i>
</a>

<?php if (empty($slider)): ?>
    <div class="container">
        <div class="col-12 mt-2">
            <div class="alert alert-info text-center" role="alert">
                <?= lang('Blog.alertSliderBeranda'); ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <!-- Slider Dinamis -->
    <div id="carouselExampleDark" class="carousel carousel-dark slide">
        <div class="carousel-indicators">
            <?php foreach ($slider as $index => $s): ?>
                <button type="button"
                    data-bs-target="#carouselExampleDark"
                    data-bs-slide-to="<?= $index ?>"
                    class="<?= $index === 0 ? 'active' : '' ?>"
                    <?= $index === 0 ? 'aria-current="true"' : '' ?>
                    aria-label="Slide <?= $index + 1 ?>"></button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
            <?php foreach ($slider as $index => $s): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>"
                    data-bs-interval="<?= $index === 0 ? 10000 : 2000 ?>">
                    <img src="<?= base_url('img/' . $s['img_slider']); ?>"
                        class="d-block"
                        alt="Slide <?= $index + 1 ?>">
                    <div class="carousel-caption d-block text-light">
                        <div class="hero-badge animate-fade-in-up">
                            <span class="hero-badge-dot"></span>
                            <span class="font-mono text-dark fw-bold"><?= ($lang == 'en') ? 'System Online' : 'Sistem Online' ?></span>
                        </div>
                        <div class="title-carousel fw-bold"><?= esc(($lang == 'en') ? $s['judul_slider_en'] : $s['judul_slider']); ?></div>
                        <div class="desc-carousel"><?= esc(strip_tags(($lang == 'en') ? $s['deskripsi_slider_en'] : $s['deskripsi_slider'])); ?></div>
                        <div class="d-flex flex-column flex-sm-row justify-content-center gap-4 animate-fade-in-up" style="animation-delay: 0.2s;">
                            <a href="<?= ($lang == 'en') ? base_url('/en/registration') : base_url('/id/pendaftaran') ?>"
                                class="btn btn-dark btn-lg px-5 py-3 fw-bold rounded-3 shadow-lg">
                                <?= lang('Blog.btnCarousel'); ?>
                            </a>
                            <button class="btn btn-outline-light btn-lg px-5 py-3 fw-bold rounded-3 d-flex align-items-center justify-content-center gap-2">
                                <i class="fas fa-play"></i> <?= ($lang == 'en') ? 'Watch Showreel' : 'Tonton Showreel' ?>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<?php endif; ?>

<!-- PARTNERS MARQUEE SECTION -->
<section class="partners-section">
    <div class="partners-marquee animate-marquee">
        <div class="partner-item">
            <i class="fab fa-aws"></i>
            <span>AWS Partner</span>
        </div>
        <div class="partner-item">
            <i class="fab fa-google"></i>
            <span>Google Cloud</span>
        </div>
        <div class="partner-item">
            <i class="fab fa-microsoft"></i>
            <span>Microsoft Azure</span>
        </div>
        <div class="partner-item">
            <i class="fas fa-server"></i>
            <span>Cisco</span>
        </div>
        <div class="partner-item">
            <i class="fas fa-shield-alt"></i>
            <span>Fortinet</span>
        </div>
        <!-- Duplicate for seamless loop -->
        <div class="partner-item">
            <i class="fab fa-aws"></i>
            <span>AWS Partner</span>
        </div>
        <div class="partner-item">
            <i class="fab fa-google"></i>
            <span>Google Cloud</span>
        </div>
        <div class="partner-item">
            <i class="fab fa-microsoft"></i>
            <span>Microsoft Azure</span>
        </div>
        <div class="partner-item">
            <i class="fas fa-server"></i>
            <span>Cisco</span>
        </div>
    </div>
</section>

<!-- CTA: Daftar -->
<section class="container-fluid text-dark daftar-section">
    <div class="row align-items-center text-center text-md-start">
        <!-- Teks -->
        <div class="col-md-6 mb-4 mb-md-0 d-flex flex-column align-items-center align-items-md-start">
            <div class="card-body p-0 p-md-3">
                <span class="section-badge font-mono mb-3"><?= ($lang == 'en') ? 'Join Today' : 'Bergabung Sekarang' ?></span>
                <p class="text-light fw-bold mb-0 title-cta">
                    <?= ($lang == 'en') ? $webprofile[0]['judul_ajakan_en'] : $webprofile[0]['judul_ajakan'] ?>
                </p>
                <p class="text-light mb-0 desc-cta">
                    <?= ($lang == 'en') ? $webprofile[0]['deskripsi_ajakan_en'] : $webprofile[0]['deskripsi_ajakan'] ?>
                </p>
                <div class="d-flex gap-3 mt-4">
                    <a href="<?= ($lang == 'en') ? base_url('/en/registration') : base_url('/id/pendaftaran') ?>"
                        class="btn btn-light btn-lg px-4 py-3 fw-bold rounded-3 shadow-sm">
                        <?= lang('Blog.btnCarousel'); ?>
                    </a>
                </div>
            </div>
        </div>

        <!-- Gambar -->
        <div class="col-md-6 d-flex justify-content-center">
            <img src="/img/slider-2.jpg" class="rounded shadow daftar-img" alt="Image Description">
        </div>
    </div>
</section>

<!-- Keuntungan -->
<section class="benefit-main-section">
    <div class="container">
        <div class="benefit-header">
            <span class="section-badge"><?= lang('Blog.benefitsJoinTitle'); ?></span>
            <p class="fw-bold mb-0 title-cta"><?= lang('Blog.benefitsJoinTitle'); ?></p>
            <p class="text-dark mb-0 desc-cta">
                <?= lang('Blog.benefitsJoinDescription'); ?>
            </p>
        </div>
        
        <!-- 3 Kotak Manfaat (Bento Grid Style) -->
        <div class="benefits-bento-grid">
            <?php foreach ($manfaatjoin as $manfaat): ?>
                <div class="benefit-item-bento">
                    <div class="benefit-icon-box">
                        <?php if (!empty($manfaat['gambar'])): ?>
                            <img src="<?= base_url('img/' . esc($manfaat['gambar'], 'url')); ?>" 
                                 alt="Icon" 
                                 class="img-fluid" style="max-width: 50px; max-height: 50px;" />
                        <?php else: ?>
                            <i class="fas fa-star"></i>
                        <?php endif; ?>
                    </div>
                    <div>
                        <h6><b><?= ($lang == 'en') ? $manfaat['judul_manfaat_en'] : $manfaat['judul_manfaat']; ?></b></h6>
                        <p><?= ($lang == 'en') ? $manfaat['deskripsi_manfaat_en'] : $manfaat['deskripsi_manfaat']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Section 2: TABS INTERAKTIF -->
<section class="manfaat-tabs-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- Header Tabs -->
                <div class="tabs-header-wrapper">
                    <h2 class="tabs-title"><?= ($lang == 'en') ? 'Interactive Features' : 'Fitur Interaktif' ?></h2>
                    <p class="tabs-subtitle">
                        <?= ($lang == 'en') 
                            ? 'Explore our comprehensive tools designed to enhance your career journey' 
                            : 'Jelajahi alat komprehensif kami yang dirancang untuk meningkatkan perjalanan karir Anda' ?>
                    </p>
                </div>
                
                <!-- Tabs Navigation -->
                <div class="benefits-tabs-navigation mb-5">
                    <button class="benefit-tab-btn active" data-tab="simulasi">
                        <i class="fas fa-comments me-2"></i>
                        <?= ($lang == 'en') ? 'Job Interview Simulation' : 'Simulasi Wawancara Kerja' ?>
                    </button>
                    <button class="benefit-tab-btn" data-tab="tes-minat">
                        <i class="fas fa-brain me-2"></i>
                        <?= ($lang == 'en') ? 'Aptitude Test' : 'Tes Minat & Bakat' ?>
                    </button>
                    <button class="benefit-tab-btn" data-tab="job-matching">
                        <i class="fas fa-briefcase me-2"></i>
                        <?= ($lang == 'en') ? 'Smart Job Matching' : 'Smart Job Matching' ?>
                    </button>
                    <button class="benefit-tab-btn" data-tab="position-fit">
                        <i class="fas fa-chart-line me-2"></i>
                        <?= ($lang == 'en') ? 'Position Fit Evaluation' : 'Position Fit Evaluation' ?>
                    </button>
                </div>
                
                <!-- Tabs Content Area -->
                <div class="benefits-tabs-content">
                    <!-- Tab 1: Simulasi Wawancara Kerja -->
                    <div class="benefit-tab-pane active" id="tab-simulasi">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="benefit-content-wrapper">
                                    <h3 class="benefit-content-title"><?= ($lang == 'en') ? 'Job Interview Simulation' : 'Simulasi Wawancara Kerja' ?></h3>
                                    <p class="benefit-content-desc">
                                        <?= ($lang == 'en') 
                                            ? 'High-quality job interview simulation designed to resemble real interview processes, helping you prepare more confidently.' 
                                            : 'Fitur simulasi wawancara kerja berkualitas tinggi yang dirancang menyerupai proses wawancara riil, membantu Anda mempersiapkan diri dengan lebih percaya diri.' ?>
                                    </p>
                                    <ul class="benefit-features-list">
                                        <li><?= ($lang == 'en') ? 'Each question comes with answer keys and explanations' : 'Setiap soal dilengkapi kunci jawaban dan pembahasan' ?></li>
                                        <li><?= ($lang == 'en') ? 'Assessment to help users understand their strengths' : 'Penilaian untuk membantu pengguna memahami kekuatan' ?></li>
                                        <li><?= ($lang == 'en') ? 'Improves answer quality during job interviews' : 'Meningkatkan kualitas jawaban saat wawancara kerja' ?></li>
                                        <li><?= ($lang == 'en') ? 'Builds confidence before facing actual interviews' : 'Membangun kepercayaan diri sebelum menghadapi wawancara sebenarnya' ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="benefit-image-wrapper">
                                    <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&q=80" 
                                         alt="<?= ($lang == 'en') ? 'Interview Simulation' : 'Simulasi Wawancara' ?>" 
                                         class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tab 2: Tes Minat & Bakat -->
                    <div class="benefit-tab-pane" id="tab-tes-minat">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="benefit-content-wrapper">
                                    <h3 class="benefit-content-title"><?= ($lang == 'en') ? 'Aptitude Test' : 'Tes Minat & Bakat' ?></h3>
                                    <p class="benefit-content-desc">
                                        <?= ($lang == 'en')
                                            ? 'Discover your best potential with comprehensive aptitude tests, providing deep insights into suitable careers.'
                                            : 'Temukan potensi terbaik dalam diri Anda dengan tes minat dan bakat yang komprehensif, memberikan insight mendalam tentang karir yang sesuai.' ?>
                                    </p>
                                    <ul class="benefit-features-list">
                                        <li><?= ($lang == 'en') ? 'In-depth analysis of personality and interests' : 'Analisis mendalam tentang kepribadian dan minat' ?></li>
                                        <li><?= ($lang == 'en') ? 'Career recommendations based on best potential' : 'Rekomendasi karir berdasarkan potensi terbaik' ?></li>
                                        <li><?= ($lang == 'en') ? 'Detailed report with easy-to-understand visualization' : 'Laporan detail dengan visualisasi yang mudah dipahami' ?></li>
                                        <li><?= ($lang == 'en') ? 'Consultation of test results with career experts' : 'Konsultasi hasil tes dengan ahli karir' ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="benefit-image-wrapper">
                                    <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&q=80" 
                                         alt="<?= ($lang == 'en') ? 'Aptitude Test' : 'Tes Minat Bakat' ?>" 
                                         class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tab 3: Smart Job Matching -->
                    <div class="benefit-tab-pane" id="tab-job-matching">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="benefit-content-wrapper">
                                    <h3 class="benefit-content-title"><?= ($lang == 'en') ? 'Smart Job Matching' : 'Smart Job Matching' ?></h3>
                                    <p class="benefit-content-desc">
                                        <?= ($lang == 'en')
                                            ? 'Smart system that connects you with the best job opportunities based on your skills, experience, and career preferences.'
                                            : 'Sistem pintar yang menghubungkan Anda dengan peluang kerja terbaik berdasarkan skill, pengalaman, dan preferensi karir Anda.' ?>
                                    </p>
                                    <ul class="benefit-features-list">
                                        <li><?= ($lang == 'en') ? 'Intelligent matching algorithm with high accuracy' : 'Algoritma matching cerdas dengan akurasi tinggi' ?></li>
                                        <li><?= ($lang == 'en') ? 'Job recommendations relevant to your profile' : 'Rekomendasi pekerjaan yang relevan dengan profil Anda' ?></li>
                                        <li><?= ($lang == 'en') ? 'Real-time notifications for latest vacancies' : 'Notifikasi real-time untuk lowongan terbaru' ?></li>
                                        <li><?= ($lang == 'en') ? 'Access to quality partner companies' : 'Akses ke perusahaan partner yang berkualitas' ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="benefit-image-wrapper">
                                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80" 
                                         alt="<?= ($lang == 'en') ? 'Job Matching' : 'Job Matching' ?>" 
                                         class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tab 4: Position Fit Evaluation -->
                    <div class="benefit-tab-pane" id="tab-position-fit">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="benefit-content-wrapper">
                                    <h3 class="benefit-content-title"><?= ($lang == 'en') ? 'Position Fit Evaluation' : 'Position Fit Evaluation' ?></h3>
                                    <p class="benefit-content-desc">
                                        <?= ($lang == 'en')
                                            ? 'Evaluation of position suitability that helps you and companies understand how well you fit the offered role.'
                                            : 'Evaluasi kesesuaian posisi yang membantu Anda dan perusahaan memahami seberapa baik Anda cocok dengan peran yang ditawarkan.' ?>
                                    </p>
                                    <ul class="benefit-features-list">
                                        <li><?= ($lang == 'en') ? 'Analysis of skill compatibility with position needs' : 'Analisis kesesuaian skill dengan kebutuhan posisi' ?></li>
                                        <li><?= ($lang == 'en') ? 'Performance prediction based on personal characteristics' : 'Prediksi performa berdasarkan karakteristik pribadi' ?></li>
                                        <li><?= ($lang == 'en') ? 'Competency development recommendations needed' : 'Rekomendasi pengembangan kompetensi yang dibutuhkan' ?></li>
                                        <li><?= ($lang == 'en') ? 'Comprehensive report for decision making' : 'Laporan komprehensif untuk pengambilan keputusan' ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="benefit-image-wrapper">
                                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80" 
                                         alt="<?= ($lang == 'en') ? 'Position Fit Evaluation' : 'Position Fit Evaluation' ?>" 
                                         class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Banner -->
<section class="cta-banner">
    <div class="container">
        <div class="cta-banner-content">
            <h2><?= ($lang == 'en') ? $webprofile[0]['judul_ajakan_en'] : $webprofile[0]['judul_ajakan'] ?></h2>
            <p><?= ($lang == 'en') ? $webprofile[0]['deskripsi_ajakan_en'] : $webprofile[0]['deskripsi_ajakan'] ?></p>
            <a href="<?= ($lang == 'en') ? base_url('/en/registration') : base_url('/id/pendaftaran') ?>"
                class="btn btn-cta-banner">
                <?= lang('Blog.btnCarousel'); ?>
            </a>
        </div>
    </div>
</section>

<!-- Paket Visitor / Member -->
<section class="container py-5">
    <div class="package-section-title">
        <span class="section-badge"><?= ($lang == 'en') ? 'Our Plans' : 'Paket Kami' ?></span>
        <h2>
            <?= lang('Blog.chooseTitle'); ?>
            <span><?= lang('Blog.forYouTitle'); ?></span>
        </h2>
    </div>

    <div class="package-grid">
        <!-- Visitor Card -->
        <div class="package-card visitor">
            <div class="package-card-header">
                <h3>Visitor</h3>
            </div>
            <div class="package-card-body">
                <div class="package-price">
                    <span class="currency">$</span>0
                    <span class="period">/<?= ($lang == 'en') ? 'month' : 'bulan' ?></span>
                </div>
                <p class="package-description"><?= lang('Blog.basicAccess'); ?></p>
                <ul class="package-features">
                    <?php foreach ($fitur_visitor as $item): ?>
                        <li><?= ($lang == 'en') ? $item['nama_fitur_en'] : $item['nama_fitur']; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="package-card-footer">
                <div class="package-buttons-container">
                    <button class="btn btn-choose-plan btn-visitor" disabled>
                        <?= lang('Blog.currentPackage'); ?>
                    </button>
                </div>
            </div>
        </div>

        <!-- Member Card -->
        <div class="package-card member featured">
            <div class="featured-badge"><?= lang('Blog.recommendedTitle'); ?></div>
            <div class="package-card-header">
                <h3>Member</h3>
            </div>
            <div class="package-card-body">
                <div class="package-price">
                    <span class="currency">$</span>29
                    <span class="period">/<?= ($lang == 'en') ? 'month' : 'bulan' ?></span>
                </div>
                <p class="package-description"><?= lang('Blog.fullAccess'); ?></p>
                <ul class="package-features">
                    <?php foreach ($fitur_member as $item): ?>
                        <li><?= ($lang == 'en') ? $item['nama_fitur_en'] : $item['nama_fitur']; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="package-card-footer">
                <div class="package-buttons-container">
                    <a href="<?= ($lang == 'en') ? base_url('/en/registration') : base_url('/id/pendaftaran') ?>">
                        <button class="btn btn-choose-plan btn-member">
                            <?= lang('Blog.joinNow'); ?>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Peta Member -->
<!-- Sorotan Member Komunitas Ekspor Indonesia -->
<section class="community-spotlight-section">
    <div class="container">
        <div class="community-spotlight-header">
            <span class="section-badge"><?= ($lang == 'en') ? 'Community Spotlight' : 'Sorotan Komunitas' ?></span>
            <h2 class="community-spotlight-title">
                <?= lang('Blog.communityMemberSpotlightTitle'); ?>
                <span class="highlight-text"><?= lang('Blog.communityMemberSpotlightTitle2'); ?></span>
            </h2>
            <p class="community-spotlight-desc">
                <?= ($lang == 'en') 
                    ? 'Meet our successful members from across Indonesia who have transformed their businesses through our community'
                    : 'Temui anggota sukses kami dari seluruh Indonesia yang telah mentransformasi bisnis mereka melalui komunitas kami' ?>
            </p>
        </div>
        
        <!-- Container untuk peta dan member list -->
        <div class="row align-items-start">
            <!-- Peta Leaflet -->
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="community-map-container">
                    <div id="communityMap" style="height: 500px; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);"></div>
                </div>
            </div>
            
            <!-- Daftar Member -->
            <div class="col-lg-4">
                <div class="member-list-container">
                    <h4 class="member-list-title"><?= ($lang == 'en') ? 'Featured Members' : 'Anggota Unggulan' ?></h4>
                    <div class="member-list-scroll">
                        <?php $count = 0; ?>
                        <?php foreach ($member as $item): ?>
                            <?php if ($count < 5): ?>
                                <div class="member-card" data-lat="<?= !empty($item['latitude']) ? $item['latitude'] : '' ?>" 
                                     data-lng="<?= !empty($item['longitude']) ? $item['longitude'] : '' ?>">
                                    <div class="member-card-header">
                                        <div class="member-avatar">
                                            <?php if (!empty($item['foto_profil'])): ?>
                                                <img src="<?= base_url('img/' . esc($item['foto_profil'], 'url')); ?>" 
                                                     alt="<?= esc($item['username']); ?>">
                                            <?php else: ?>
                                                <div class="avatar-placeholder">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="member-info">
                                            <h5 class="member-name"><?= esc($item['username']); ?></h5>
                                            <p class="member-company"><?= esc($item['nama_perusahaan']); ?></p>
                                            <?php if ($item['role'] == 'premium'): ?>
                                                <span class="member-badge">PREMIUM</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="member-card-body">
                                        <p class="member-location">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <?= !empty($item['kota']) ? esc($item['kota']) : 'Indonesia' ?>
                                        </p>
                                        <?php if ($item['role'] == 'premium'): ?>
                                            <a href="<?= base_url($lang . '/detail-member/' . esc($item['slug'], 'url')) ?>" 
                                               class="btn-view-profile">
                                                <?= ($lang == 'en') ? 'View Profile' : 'Lihat Profil' ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php $count++; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // CHAT FUNCTIONALITY
    document.addEventListener('DOMContentLoaded', function() {
        const chatToggle = document.getElementById('chatToggle');
        const closeChat = document.getElementById('closeChat');
        const chatIframeContainer = document.getElementById('chatIframeContainer');
        const chatIframe = document.getElementById('chatIframe');

        chatToggle.addEventListener('click', function() {
            chatIframeContainer.classList.toggle('active');
            chatToggle.classList.toggle('active');
            if (chatIframeContainer.classList.contains('active')) {
                chatIframe.src = chatIframe.src;
            }
        });

        closeChat.addEventListener('click', function() {
            chatIframeContainer.classList.remove('active');
            chatToggle.classList.remove('active');
        });

        document.addEventListener('click', function(event) {
            if (!chatIframeContainer.contains(event.target) && 
                !chatToggle.contains(event.target) && 
                chatIframeContainer.classList.contains('active')) {
                chatIframeContainer.classList.remove('active');
                chatToggle.classList.remove('active');
            }
        });

        // TABS FUNCTIONALITY
        const tabButtons = document.querySelectorAll('.benefit-tab-btn');
        const tabPanes = document.querySelectorAll('.benefit-tab-pane');
        
        function switchTab(tabId) {
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));
            
            const activeButton = document.querySelector(`[data-tab="${tabId}"]`);
            if (activeButton) {
                activeButton.classList.add('active');
            }
            
            const activePane = document.getElementById(`tab-${tabId}`);
            if (activePane) {
                activePane.classList.add('active');
            }
        }
        
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                switchTab(tabId);
            });
        });
        
        if (!document.querySelector('.benefit-tab-btn.active')) {
            switchTab('simulasi');
        }

        // MAP FUNCTIONALITY
        var map = L.map('map').setView([-2.5489, 118.0149], 5);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        var markers = L.markerClusterGroup();

        <?php foreach ($member as $item): ?>
            <?php if (!empty($item['latitude']) && !empty($item['longitude'])): ?>
                (function() {
                    var marker = L.marker([<?= $item['latitude'] ?>, <?= $item['longitude'] ?>]);
                    marker.bindPopup(
                        '<div style="width: 200px; font-family: Arial, sans-serif;">' +
                        '<a href="<?= ($item['role'] == 'premium') ? base_url($lang . '/detail-member/' . esc($item['slug'], 'url')) : '#' ?>" style="text-decoration: none;">' +
                        '<div class="card h-100 shadow-sm" style="cursor: pointer; border-radius: 12px; overflow: hidden;">' +
                        '<img src="<?= base_url('img/' . esc($item['foto_profil'], 'url')); ?>" class="card-img-top" alt="Member Image" style="height: 120px; object-fit: cover;">' +
                        '<div class="card-body">' +
                        '<h6 class="card-title text-center" style="font-weight: bold; word-wrap: break-word; white-space: normal;"><?= esc($item['username']); ?></h6>' +
                        '<p class="card-text text-center text-muted" style="font-size: 0.9rem; word-wrap: break-word; white-space: normal;"><?= esc($item['nama_perusahaan']); ?></p>' +
                        <?php if ($item['role'] == 'premium'): ?> '<span class="btn btn-primary btn-sm mt-2" style="border-radius: 8px; width: 100%;"><?= lang("Blog.btndataMember") ?></span>' +
                        <?php endif; ?> '</div>' +
                        '</div>' +
                        '</a>' +
                        '</div>'
                    );
                    markers.addLayer(marker);
                })();
            <?php endif; ?>
        <?php endforeach; ?>

        map.addLayer(markers);

        // CAROUSEL FUNCTIONALITY
        var carousel = document.querySelector('#carouselExampleDark');
        if (carousel) {
            var carouselInstance = new bootstrap.Carousel(carousel, {
                interval: 2000,
                wrap: true,
                pause: false
            });
            carouselInstance.cycle();
        }
    });

        // ===== CHATBOT FUNCTIONALITY FOR INDEX
    const chatbotToggleIndex = document.getElementById('chatbotToggleIndex');
    const closeChatbotIndex = document.getElementById('closeChatbotIndex');
    const chatbotWindowIndex = document.getElementById('chatbotWindowIndex');
    const chatbotIframeIndex = document.getElementById('chatbotIframeIndex');

    if (chatbotToggleIndex && chatbotWindowIndex) {
        // Toggle chatbot window
        chatbotToggleIndex.addEventListener('click', function(e) {
            e.stopPropagation();
            chatbotWindowIndex.classList.toggle('active');
            chatbotToggleIndex.classList.toggle('active');
            
            // Reload iframe when opening
            if (chatbotWindowIndex.classList.contains('active')) {
                chatbotIframeIndex.src = chatbotIframeIndex.src;
            }
        });

        // Close chatbot
        closeChatbotIndex.addEventListener('click', function(e) {
            e.stopPropagation();
            chatbotWindowIndex.classList.remove('active');
            chatbotToggleIndex.classList.remove('active');
        });

        // Close chatbot when clicking outside
        document.addEventListener('click', function(event) {
            if (!chatbotWindowIndex.contains(event.target) && 
                !chatbotToggleIndex.contains(event.target) && 
                chatbotWindowIndex.classList.contains('active')) {
                chatbotWindowIndex.classList.remove('active');
                chatbotToggleIndex.classList.remove('active');
            }
        });

        // Prevent iframe clicks from closing the chat
        chatbotWindowIndex.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    }

        // ===== TABS FUNCTIONALITY
    const tabButtons = document.querySelectorAll('.benefit-tab-btn');
    const tabPanes = document.querySelectorAll('.benefit-tab-pane');
    
    function switchTab(tabId) {
        // Remove active class from all buttons and panes
        tabButtons.forEach(btn => btn.classList.remove('active'));
        tabPanes.forEach(pane => pane.classList.remove('active'));
        
        // Add active class to clicked button
        const activeButton = document.querySelector(`[data-tab="${tabId}"]`);
        if (activeButton) {
            activeButton.classList.add('active');
        }
        
        // Show corresponding pane
        const activePane = document.getElementById(`tab-${tabId}`);
        if (activePane) {
            activePane.classList.add('active');
        }
    }
    
    // Add click event to all tab buttons
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            switchTab(tabId);
        });
    });
    
    // Initialize first tab as active if none is active
    if (!document.querySelector('.benefit-tab-btn.active')) {
        switchTab('simulasi');
    }

        // ===== COMMUNITY MAP FUNCTIONALITY
    var communityMap = L.map('communityMap').setView([-2.5489, 118.0149], 5);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(communityMap);

    // Create marker cluster group
    var communityMarkers = L.markerClusterGroup({
        maxClusterRadius: 40,
        spiderfyOnMaxZoom: true,
        showCoverageOnHover: false,
        zoomToBoundsOnClick: true
    });

    // Custom icon for markers
    var memberIcon = L.divIcon({
        html: '<div class="custom-marker"><i class="fas fa-user"></i></div>',
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        className: 'custom-marker-container'
    });

    // Add markers from database
    <?php foreach ($member as $item): ?>
        <?php if (!empty($item['latitude']) && !empty($item['longitude'])): ?>
            var marker = L.marker(
                [<?= $item['latitude'] ?>, <?= $item['longitude'] ?>],
                { icon: memberIcon }
            );
            
            var popupContent = `
                <div class="map-popup">
                    <div class="popup-avatar">
                        <?php if (!empty($item['foto_profil'])): ?>
                            <img src="<?= base_url('img/' . esc($item['foto_profil'], 'url')); ?>" 
                                 alt="<?= esc($item['username']); ?>">
                        <?php else: ?>
                            <div class="avatar-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="popup-content">
                        <h4><?= esc($item['username']); ?></h4>
                        <p class="company"><?= esc($item['nama_perusahaan']); ?></p>
                        <?php if (!empty($item['kota'])): ?>
                            <p class="location"><i class="fas fa-map-marker-alt"></i> <?= esc($item['kota']); ?></p>
                        <?php endif; ?>
                        <?php if ($item['role'] == 'premium'): ?>
                            <a href="<?= base_url($lang . '/detail-member/' . esc($item['slug'], 'url')) ?>" 
                               class="btn-popup-profile">
                                <?= ($lang == 'en') ? 'View Profile' : 'Lihat Profil' ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            `;
            
            marker.bindPopup(popupContent);
            communityMarkers.addLayer(marker);
        <?php endif; ?>
    <?php endforeach; ?>

    communityMap.addLayer(communityMarkers);

    // Add click event to member cards
    document.querySelectorAll('.member-card').forEach(card => {
        card.addEventListener('click', function() {
            const lat = this.getAttribute('data-lat');
            const lng = this.getAttribute('data-lng');
            
            if (lat && lng) {
                communityMap.setView([lat, lng], 12);
                
                // Find and open the corresponding marker popup
                communityMap.eachLayer(function(layer) {
                    if (layer instanceof L.Marker) {
                        const markerLat = layer.getLatLng().lat;
                        const markerLng = layer.getLatLng().lng;
                        
                        if (Math.abs(markerLat - lat) < 0.01 && Math.abs(markerLng - lng) < 0.01) {
                            layer.openPopup();
                        }
                    }
                });
            }
        });
    });
</script>

<?= $this->endSection(); ?>