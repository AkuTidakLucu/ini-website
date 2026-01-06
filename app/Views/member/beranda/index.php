<?= $this->extend('member/layout/app'); ?>

<?= $this->section('meta'); ?>
<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />

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

<style>
    :root {
        --font-size-title-cta: 38px;
        --font-size-desc-cta: 18px;

        /* Carousel default (desktop) */
        --font-size-title-carousel: 34px;
        --font-size-desc-carousel: 16px;

        /* WARNA DARI MEMBER YANG FINAL */
        --c-primary: #0A5C36; /* Green Emerald */
        --c-accent: #D4AF37; /* Gold/Mustard */
        --c-background: #F9F9F9; /* Off-White */
        --c-primary-light: #1C7A4D;
        --c-primary-dark: #084428;
        --c-accent-light: #E6C158;
        --c-text: #2D3748;
        --c-text-light: #4A5568;
        
        /* Bootstrap Overrides */
        --bs-primary: var(--c-primary);
        --bs-primary-rgb: 10, 92, 54;
    }

    /* ===================================================
       1. Global Reset - SAMA DENGAN VISITOR
       =================================================== */
    * {
        box-sizing: border-box;
    }

    body {
        background-color: var(--c-background);
        color: var(--c-text);
        font-family: 'Lato', sans-serif;
        line-height: 1.6;
        overflow-x: hidden;
    }

    .title-cta, .title-carousel {
        font-family: "Poetsen One", sans-serif;
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    .desc-cta, .desc-carousel {
        font-family: "Lato", sans-serif;
        font-weight: 400;
        line-height: 1.7;
    }

    /* ===================================================
    2. Slider (Carousel) - DENGAN OVERLAY TRANSPARAN
    =================================================== */
    #carouselExampleDark {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .carousel-inner {
        width: 100%;
    }

    .carousel-item {
        position: relative;
        height: 600px; /* Fixed height untuk desktop */
    }

    .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    /* OVERLAY HIJAU EMERALD TRANSPARAN (20%) */
    .carousel-item::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(10, 92, 54, 0.6); /* #0A5C36 dengan 20% opacity */
        z-index: 1;
    }

    /* Carousel caption - POSISI DI KIRI TANPA BACKGROUND */
    .carousel-caption {
        position: absolute;
        top: 50%;
        left: 10%;
        transform: translateY(-50%);
        right: auto;
        bottom: auto;
        text-align: left;
        width: 45%;
        max-width: 600px;
        padding: 0;
        background: transparent !important;
        border-radius: 0;
        box-shadow: none;
        z-index: 2; /* Pastikan di atas overlay */
    }

    /* TOMBOL PREV/NEXT INVISIBLE TAPI BISA DIKLIK */
    .carousel-control-prev,
    .carousel-control-next {
        display: flex !important;
        align-items: center;
        justify-content: center;
        width: 10%;
        height: 100%;
        opacity: 0 !important;
        cursor: pointer;
        transition: opacity 0.3s ease;
        z-index: 3; /* Pastikan di atas overlay dan caption */
    }

    /* Tampilkan sedikit saat hover */
    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 0.3 !important;
        background: rgba(0, 0, 0, 0.1);
    }

    /* Sembunyikan ikon panah */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        display: none !important;
    }

    /* Area klik kiri untuk previous */
    .carousel-control-prev {
        left: 0;
        background: linear-gradient(to right, rgba(0,0,0,0.05), transparent);
    }

    /* Area klik kanan untuk next */
    .carousel-control-next {
        right: 0;
        background: linear-gradient(to left, rgba(0,0,0,0.05), transparent);
    }

    /* Keep indicators visible */
    .carousel-indicators {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 15;
        display: flex;
        justify-content: center;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .carousel-indicators [data-bs-target] {
        box-sizing: content-box;
        flex: 0 1 auto;
        width: 10px;
        height: 10px;
        padding: 0;
        margin-right: 8px;
        margin-left: 8px;
        text-indent: -999px;
        cursor: pointer;
        background-color: rgba(255, 255, 255, 0.5);
        background-clip: padding-box;
        border: 0;
        border-radius: 50%;
        transition: all 0.3s ease;
        z-index: 4; /* Pastikan di atas overlay */
    }

    .carousel-indicators [data-bs-target].active {
        background-color: var(--c-accent);
        transform: scale(1.2);
    }

    .title-carousel {
        font-size: var(--font-size-title-carousel);
        color: white;
        margin-bottom: 20px;
        line-height: 1.2;
        /* Hapus text-shadow karena sudah ada overlay */
    }

    .desc-carousel {
        font-size: var(--font-size-desc-carousel);
        color: white;
        margin-bottom: 25px;
        line-height: 1.6;
        /* Hapus text-shadow karena sudah ada overlay */
    }

    /* Untuk Visitor: tombol di carousel */
    .centered-button-carousel {
        text-align: left;
        margin-top: 20px;
    }

    .centered-button-carousel .btn {
        background-color: var(--c-accent);
        color: var(--c-primary-dark);
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .centered-button-carousel .btn:hover {
        background-color: var(--c-accent-light);
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
    }

    /* ===================================================
       3. CTA "Daftar Sekarang" - DESAIN DARI VISITOR
       =================================================== */
    .daftar-section {
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        width: 90%;
        max-width: 1200px;
        margin: 80px auto 60px;
        padding: 50px 40px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(10, 92, 54, 0.2);
    }

    .daftar-section .row {
        align-items: center;
    }

    .title-cta {
        font-size: var(--font-size-title-cta);
        color: white;
        margin-bottom: 20px;
        position: relative;
        display: inline-block;
    }

    /* Garis emas dengan space */
    .title-cta::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 0;
        width: 100px;
        height: 4px;
        background-color: var(--c-accent);
        border-radius: 2px;
    }

    .desc-cta {
        font-size: var(--font-size-desc-cta);
        color: rgba(255, 255, 255, 0.9);
        margin-top: 40px;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .daftar-section img.daftar-img {
        width: 100%;
        max-width: 500px;
        height: auto;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        display: block;
        margin: 0 auto;
    }

    /* ===================================================
    4. Benefit Join - DESAIN DARI VISITOR (TAMBAHAN UNTUK TABS)
    =================================================== */

    /* Wrapper untuk seluruh section benefits */
    .benefits-section-wrapper {
        padding: 0 15px;
        margin: 40px 0;
    }

    .benefit-wrapper {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(10, 92, 54, 0.15);
    }

    /* Background hijau untuk section Benefit Join - DENGAN ROUNDED CORNERS */
    .benefit {
        background-color: var(--c-primary);
        padding: 60px 0 40px;
        text-align: center;
        margin-top: 0;
        position: relative;
    }

    /* Garis emas di atas section */
    .benefit::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--c-accent), var(--c-accent-light));
    }

    .benefit p.title-cta {
        color: white !important;
        font-size: 2.8rem;
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
    }

    .benefit .border-top-small {
        width: 80px;
        height: 4px;
        background-color: var(--c-accent);
        margin: 20px auto;
        border-radius: 2px;
        position: relative;
        z-index: 1;
    }

    .benefit .desc-cta {
        color: rgba(255, 255, 255, 0.9) !important;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        font-size: 1.1rem;
        position: relative;
        z-index: 1;
        padding: 0 20px;
    }

    /* Area tabs (setelah judul hijau) - background putih */
    .manfaat-tabs-container {
        padding: 40px 0 60px;
        background-color: var(--c-background);
        margin-top: 0;
    }

    /* Tabs Navigation Styling */
    .benefits-tabs-navigation {
        margin-bottom: 40px !important;
    }

    .benefit-tab-btn {
        background: white;
        border: 2px solid rgba(10, 92, 54, 0.15);
        color: var(--c-text);
        padding: 14px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 200px;
        margin: 5px;
        box-shadow: 0 4px 12px rgba(10, 92, 54, 0.08);
        font-family: "Lato", sans-serif;
    }

    .benefit-tab-btn:hover {
        border-color: var(--c-primary-light);
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(10, 92, 54, 0.12);
    }

    .benefit-tab-btn.active {
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-light) 100%);
        color: white;
        border-color: var(--c-primary);
        box-shadow: 0 6px 20px rgba(10, 92, 54, 0.2);
    }

    .benefit-tab-btn i {
        font-size: 1.2rem;
        margin-right: 10px;
    }

    /* Tabs Content Styling */
    .benefit-tab-pane {
        display: none;
        animation: fadeIn 0.5s ease;
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(10, 92, 54, 0.1);
        border: 1px solid rgba(10, 92, 54, 0.1);
    }

    .benefit-tab-pane.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Content Inside Tabs */
    .benefit-content-title {
        color: var(--c-primary);
        font-family: "Poetsen One", sans-serif;
        font-size: 2.2rem;
        margin-bottom: 20px;
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
        background-color: var(--c-accent);
        border-radius: 2px;
    }

    .benefit-content-desc {
        color: var(--c-text-light);
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 30px;
        font-family: "Lato", sans-serif;
    }

    .benefit-features-list {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }

    .benefit-features-list li {
        padding: 10px 0;
        padding-left: 35px;
        position: relative;
        color: var(--c-text);
        font-size: 1rem;
        line-height: 1.6;
        font-family: "Lato", sans-serif;
    }

    .benefit-features-list li::before {
        content: '✓';
        position: absolute;
        left: 0;
        top: 10px;
        width: 24px;
        height: 24px;
        background-color: var(--c-primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        font-weight: bold;
    }

    .benefit-image-wrapper {
        text-align: center;
        position: relative;
    }

    .benefit-image-wrapper img {
        width: 100%;
        max-width: 500px;
        height: auto;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease;
    }

    .benefit-image-wrapper:hover img {
        transform: scale(1.02);
    }

    /* Responsive Design for Tabs */
    /* Tablet Landscape (992px dan bawah) */
    @media (max-width: 992px) {
        .benefit-wrapper {
            border-radius: 18px;
            margin: 30px 0;
        }
        
        .benefit-tab-btn {
            min-width: 180px;
            padding: 12px 20px;
            font-size: 0.95rem;
        }
        
        .benefit-content-title {
            font-size: 1.9rem;
        }
        
        .benefit-tab-pane {
            padding: 30px;
        }
    }

    /* Tablet Portrait (768px dan bawah) */
    @media (max-width: 768px) {
        .benefits-section-wrapper {
            padding: 0 10px;
        }
        
        .benefit-wrapper {
            border-radius: 16px;
            margin: 25px 0;
        }
        
        .benefit {
            padding: 50px 0 30px;
        }
        
        .benefit p.title-cta {
            font-size: 2.2rem;
        }
        
        .benefit .desc-cta {
            font-size: 1rem;
            padding: 0 15px;
        }
        
        .benefit-tab-btn {
            min-width: 160px;
            padding: 10px 16px;
            font-size: 0.9rem;
        }
        
        .benefits-tabs-navigation {
            gap: 10px;
        }
        
        .benefit-content-title {
            font-size: 1.7rem;
            text-align: center;
        }
        
        .benefit-content-title::after {
            left: 50%;
            transform: translateX(-50%);
        }
        
        .benefit-content-desc {
            text-align: center;
        }
        
        .benefit-features-list li {
            padding-left: 30px;
        }
        
        .benefit-image-wrapper {
            margin-top: 30px;
        }
    }

    /* Mobile (576px dan bawah) */
    @media (max-width: 576px) {
        .benefits-section-wrapper {
            padding: 0 5px;
        }
        
        .benefit-wrapper {
            border-radius: 14px;
            margin: 20px 0;
        }
        
        .benefit {
            padding: 40px 0 25px;
        }
        
        .benefit p.title-cta {
            font-size: 1.8rem;
        }
        
        .benefit .desc-cta {
            font-size: 0.95rem;
            padding: 0 10px;
        }
        
        .benefit-tab-btn {
            min-width: 140px;
            padding: 8px 12px;
            font-size: 0.85rem;
        }
        
        .benefit-tab-btn i {
            font-size: 1rem;
            margin-right: 5px;
        }
        
        .benefit-content-title {
            font-size: 1.5rem;
        }
        
        .benefit-tab-pane {
            padding: 25px 20px;
            border-radius: 15px;
        }
        
        .benefit-features-list li {
            font-size: 0.95rem;
            padding-left: 28px;
        }
    }

    /* Small Mobile (425px dan bawah) */
    @media (max-width: 425px) {
        .benefits-section-wrapper {
            padding: 0;
        }
        
        .benefit-wrapper {
            border-radius: 12px;
            margin: 15px 0;
        }
        
        .benefit {
            padding: 35px 0 20px;
        }
        
        .benefit p.title-cta {
            font-size: 1.6rem;
        }
        
        .benefit .desc-cta {
            font-size: 0.9rem;
        }
        
        .benefit-tab-btn {
            min-width: 130px;
            padding: 6px 10px;
            font-size: 0.8rem;
        }
        
        .benefit-content-title {
            font-size: 1.4rem;
        }
        
        .benefit-tab-pane {
            padding: 20px 15px;
            border-radius: 12px;
        }
        
        .benefit-features-list li {
            font-size: 0.9rem;
            padding-left: 25px;
        }
    }

    /* Extra Small Mobile (375px dan bawah) */
    @media (max-width: 375px) {
        .benefit-wrapper {
            border-radius: 10px;
        }
        
        .benefit p.title-cta {
            font-size: 1.5rem;
        }
        
        .benefit-tab-btn {
            min-width: 120px;
            padding: 5px 8px;
            font-size: 0.75rem;
        }
        
        .benefit-content-title {
            font-size: 1.3rem;
        }
        
        .benefit-tab-pane {
            padding: 18px 12px;
        }
    }

    /* ===================================================
       5. Ajakan tengah (banner) - DESAIN DARI VISITOR
       =================================================== */
    .footer-custom {
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        margin-top: 60px;
        position: relative;
        overflow: hidden;
    }

    .background-image {
        max-width: 1200px;
        margin: 0 auto;
        padding: 80px 20px;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .background-image .title-cta {
        color: white;
        font-size: 3rem;
        margin-bottom: 25px;
        position: relative;
        display: inline-block;
    }

    /* Garis emas dengan space */
    .background-image .title-cta::after {
        content: '';
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 120px;
        height: 4px;
        background-color: var(--c-accent);
        border-radius: 2px;
    }

    .background-image .desc-cta {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.3rem;
        max-width: 800px;
        margin: 50px auto 40px;
        line-height: 1.6;
    }

    /* ===================================================
       6. Garis dekoratif - DESAIN DARI VISITOR
       =================================================== */
    .border-top6,
    .border-top7 {
        width: 60px;
        height: 4px;
        background-color: var(--c-primary);
        border-radius: 2px;
        opacity: 0.8;
    }

    /* ===================================================
       7. Paket Visitor / Member - DESAIN DARI VISITOR
       =================================================== */
    .kata1 {
        padding: 60px 0 40px;
        text-align: center;
    }

    .kata1 h5 {
        font-weight: 300;
        color: var(--c-text-light);
        font-size: 1.3rem;
        margin: 0 20px;
    }

    .kata1 .title-cta {
        font-size: 2.8rem;
        margin-top: 20px;
        color: var(--c-text);
    }

    .kata1 .title-cta span {
        color: var(--c-primary);
        position: relative;
    }

    .kata1 .title-cta span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--c-accent);
        border-radius: 2px;
    }

    .package-section {
        padding-bottom: 60px;
    }

    .package-section .card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(10, 92, 54, 0.1);
        transition: all 0.3s ease;
        max-width: 450px;
        margin: 0 auto 30px;
        background: white;
    }

    .package-section .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(10, 92, 54, 0.15);
    }

    .package-section .card-header {
        padding: 30px 20px;
        border-bottom: none;
    }

    .card.bg-secondary .card-header {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%) !important;
    }

    .card.bg-primary .card-header {
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-light) 100%) !important;
    }

    .package-section .card-header h5 {
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
        margin: 0;
    }

    .package-section .card-body {
        padding: 30px 25px;
    }

    .package-section .card-body i {
        font-size: 3.5rem;
        margin-bottom: 20px;
        display: block;
    }

    .package-section .card-body h6 {
        font-size: 1.3rem;
        margin-bottom: 10px;
        color: var(--c-text);
    }

    .package-section .card-body h6.fw-bold {
        font-weight: 700;
    }

    .package-section .card-body h6.text-secondary {
        color: #6c757d !important;
        font-size: 1.8rem;
        margin: 15px 0;
    }

    .package-section .card-body h6.text-primary {
        color: var(--c-primary) !important;
        font-size: 1.8rem;
        margin: 15px 0;
    }

    .package-section .card-body p {
        color: var(--c-text-light);
        margin-bottom: 20px;
        min-height: 60px;
        line-height: 1.6;
    }

    .benefits-list {
        max-height: 250px;
        overflow-y: auto;
        text-align: left;
        padding: 15px;
        background: var(--c-background);
        border-radius: 10px;
        border: 1px solid rgba(10, 92, 54, 0.1);
        margin: 20px 0;
    }

    .benefits-list hr {
        margin: 10px 0;
        opacity: 0.2;
    }

    .benefits-list p {
        color: var(--c-text);
        margin-bottom: 8px;
        padding-left: 5px;
    }

    .benefits-list::-webkit-scrollbar {
        width: 6px;
    }

    .benefits-list::-webkit-scrollbar-track {
        background: rgba(10, 92, 54, 0.05);
        border-radius: 3px;
    }

    .benefits-list::-webkit-scrollbar-thumb {
        background: var(--c-primary);
        border-radius: 3px;
    }

    .package-section .card-footer {
        padding: 25px 20px;
        background: white;
        border-top: 1px solid rgba(10, 92, 54, 0.1);
    }

    .recommended-label {
        position: absolute;
        top: 20px;
        right: -35px;
        background: var(--c-accent);
        color: var(--c-primary-dark);
        font-size: 0.85rem;
        font-weight: 800;
        padding: 8px 35px;
        transform: rotate(45deg);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        z-index: 10;
    }

    .package-section .btn {
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .package-section .btn-outline-secondary {
        border: 2px solid #6c757d;
        color: #6c757d;
        background: transparent;
    }

    .package-section .btn-outline-secondary:hover:not(:disabled) {
        background: #6c757d;
        color: white;
        transform: translateY(-3px);
    }

    .package-section .btn-primary {
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-light) 100%);
        border: none;
        color: white;
    }

    .package-section .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(10, 92, 54, 0.3);
    }

    /* ===================================================
       8. Peta Member - DESAIN DARI VISITOR
       =================================================== */
    .peta {
        padding: 60px 0 40px;
        text-align: center;
    }

    .peta h5 {
        font-weight: 300;
        color: var(--c-text-light);
        font-size: 1.3rem;
        margin: 0 20px;
    }

    .peta .title-cta {
        font-size: 2.8rem;
        margin-top: 20px;
        color: var(--c-text);
    }

    .peta .title-cta span {
        color: var(--c-primary);
        position: relative;
    }

    .peta .title-cta span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--c-accent);
        border-radius: 2px;
    }

    .peta2 {
        padding-bottom: 80px;
    }

    .peta2 .map {
        width: 100%;
        height: 600px;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(10, 92, 54, 0.15);
        border: 3px solid white;
    }

    /* ===================================================
       9. Responsif - DESAIN DARI VISITOR
       =================================================== */

    /* Tablet Landscape (992px dan bawah) */
    @media (max-width: 992px) {
        :root {
            --font-size-title-cta: 34px;
            --font-size-desc-cta: 17px;
            --font-size-title-carousel: 30px;
            --font-size-desc-carousel: 15px;
        }

        .carousel-item {
            height: 500px;
        }

        .carousel-caption {
            width: 55%;
            left: 5%;
        }

        .daftar-section {
            width: 95%;
            padding: 40px 30px;
            margin: 60px auto 50px;
        }

        .benefit .title-cta,
        .kata1 .title-cta,
        .peta .title-cta {
            font-size: 2.5rem;
        }

        .background-image {
            padding: 60px 20px;
        }

        .background-image .title-cta {
            font-size: 2.5rem;
        }

        .manfaat-item {
            max-width: 320px;
            padding: 25px 20px;
        }

        .peta2 .map {
            height: 500px;
        }
    }

    /* Tablet Portrait (768px dan bawah) */
    @media (max-width: 768px) {
        :root {
            --font-size-title-cta: 30px;
            --font-size-desc-cta: 16px;
            --font-size-title-carousel: 26px;
            --font-size-desc-carousel: 14px;
        }

        .carousel-item {
            height: 450px;
        }

        .carousel-caption {
            width: 70%;
            left: 5%;
            right: 5%;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 15%;
        }

        .daftar-section {
            padding: 35px 25px;
            margin: 50px auto 40px;
        }

        .benefit .title-cta,
        .kata1 .title-cta,
        .peta .title-cta {
            font-size: 2.2rem;
        }

        .background-image {
            padding: 50px 20px;
        }

        .background-image .title-cta {
            font-size: 2.2rem;
        }

        .background-image .desc-cta {
            font-size: 1.2rem;
            margin: 40px auto 30px;
        }

        .manfaat-item {
            max-width: 300px;
            padding: 20px;
        }

        .benefit-icon-box {
            width: 90px;
            height: 90px;
        }

        .peta2 .map {
            height: 450px;
        }

        .package-section .card {
            max-width: 400px;
        }
    }

    /* Mobile (576px dan bawah) */
    @media (max-width: 576px) {
        :root {
            --font-size-title-cta: 26px;
            --font-size-desc-cta: 15px;
            --font-size-title-carousel: 22px;
            --font-size-desc-carousel: 13px;
        }

        .carousel-item {
            height: 400px;
        }

        .carousel-caption {
            width: 85%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 20%;
        }

        .daftar-section {
            width: 98%;
            padding: 30px 20px;
            margin: 40px auto 30px;
            text-align: center;
        }

        .daftar-section .row {
            text-align: center;
        }

        .title-cta::after {
            left: 50%;
            transform: translateX(-50%);
        }

        .benefit .title-cta,
        .kata1 .title-cta,
        .peta .title-cta {
            font-size: 2rem;
        }

        .background-image {
            padding: 40px 15px;
        }

        .background-image .title-cta {
            font-size: 2rem;
        }

        .background-image .desc-cta {
            font-size: 1.1rem;
            margin: 35px auto 25px;
        }

        .manfaat-item {
            max-width: 280px;
            padding: 20px 15px;
        }

        .benefit-icon-box {
            width: 80px;
            height: 80px;
        }

        .manfaat h6 {
            font-size: 1.2rem;
        }

        .kata1 h5,
        .peta h5 {
            font-size: 1.1rem;
        }

        .border-top6,
        .border-top7 {
            width: 40px;
        }

        .package-section .card {
            max-width: 350px;
        }

        .package-section .card-header h5 {
            font-size: 1.6rem;
        }

        .peta2 .map {
            height: 350px;
        }

        .recommended-label {
            right: -30px;
            top: 15px;
            font-size: 0.75rem;
            padding: 6px 25px;
        }
    }

    /* Small Mobile (425px dan bawah) */
    @media (max-width: 425px) {
        :root {
            --font-size-title-cta: 24px;
            --font-size-desc-cta: 14px;
            --font-size-title-carousel: 20px;
            --font-size-desc-carousel: 12px;
        }

        .carousel-item {
            height: 350px;
        }

        .carousel-caption {
            width: 90%;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 25%;
        }

        .daftar-section {
            padding: 25px 15px;
        }

        .benefit .title-cta,
        .kata1 .title-cta,
        .peta .title-cta {
            font-size: 1.8rem;
        }

        .background-image .title-cta {
            font-size: 1.8rem;
        }

        .background-image .desc-cta {
            font-size: 1rem;
        }

        .manfaat-item {
            max-width: 260px;
        }

        .benefit-icon-box {
            width: 70px;
            height: 70px;
        }

        .package-section .card {
            max-width: 320px;
        }

        .peta2 .map {
            height: 300px;
        }
    }

    /* Extra Small Mobile (375px dan bawah) */
    @media (max-width: 375px) {
        :root {
            --font-size-title-cta: 22px;
            --font-size-desc-cta: 13px;
            --font-size-title-carousel: 18px;
            --font-size-desc-carousel: 11px;
        }

        .carousel-item {
            height: 300px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 30%;
        }

        .benefit .title-cta,
        .kata1 .title-cta,
        .peta .title-cta {
            font-size: 1.6rem;
        }

        .background-image .title-cta {
            font-size: 1.6rem;
        }

        .manfaat-item {
            max-width: 240px;
            padding: 15px 12px;
        }

        .benefit-icon-box {
            width: 60px;
            height: 60px;
        }

        .package-section .card {
            max-width: 300px;
        }

        .peta2 .map {
            height: 250px;
        }
    }
</style>

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
                        class="d-block w-100"
                        alt="Slide <?= $index + 1 ?>">
                    <div class="carousel-caption d-block text-light">
                        <div class="title-carousel fw-bold"><?= esc(($lang == 'en') ? $s['judul_slider_en'] : $s['judul_slider']); ?></div>
                        <div class="desc-carousel"><?= esc(strip_tags(($lang == 'en') ? $s['deskripsi_slider_en'] : $s['deskripsi_slider'])); ?></div>

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

<!-- CTA: Daftar -->
<section class="container-fluid text-dark daftar-section">
    <div class="row align-items-center text-center text-md-start">
        <!-- Teks -->
        <div class="col-md-6 mb-4 mb-md-0 d-flex flex-column align-items-center align-items-md-start">
            <div class="card-body p-0 p-md-3">
                <p class="text-light fw-bold mb-0 title-cta">
                    <?= ($lang == 'en') ? $webprofile[0]['judul_ajakan_en'] : $webprofile[0]['judul_ajakan'] ?>
                </p>
                <p class="text-light mb-0 desc-cta">
                    <?= ($lang == 'en') ? $webprofile[0]['deskripsi_ajakan_en'] : $webprofile[0]['deskripsi_ajakan'] ?>
                </p>

            </div>
        </div>

        <!-- Gambar -->
        <div class="col-md-6 d-flex justify-content-center">
            <img src="<?= base_url('img/slider-2.jpg'); ?>"
                class="rounded shadow daftar-img"
                alt="Image Description">
        </div>
    </div>
</section>

<!-- Benefits Tabs Section (Ganti section "Keuntungan" yang ada) -->
<section class="benefits-section-wrapper">
    <div class="container">
        <div class="benefit-wrapper">
            <!-- Background hijau dengan rounded top -->
            <div class="benefit container text-center py-5">
                <p class="fw-bold mb-0 title-cta">MANFAAT JOIN MEMBER</p>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="border-top-small"></div>
                </div>
                <p class="text-dark mb-0 desc-cta">
                    Menjadi anggota komunitas ekspor memberikan akses ke peluang yang lebih luas dan dukungan yang berharga.
                </p>
            </div>
            
            <!-- Area tabs dengan rounded bottom -->
            <div class="container manfaat-tabs-container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <!-- Tabs Navigation -->
                        <div class="benefits-tabs-navigation d-flex flex-wrap justify-content-center gap-3 mb-4">
                            <button class="benefit-tab-btn active" data-tab="simulasi">
                                <i class="fas fa-comments me-2"></i>
                                Simulasi Wawancara Kerja
                            </button>
                            <button class="benefit-tab-btn" data-tab="tes-minat">
                                <i class="fas fa-brain me-2"></i>
                                Tes Minat & Bakat
                            </button>
                            <button class="benefit-tab-btn" data-tab="job-matching">
                                <i class="fas fa-briefcase me-2"></i>
                                Smart Job Matching
                            </button>
                            <button class="benefit-tab-btn" data-tab="position-fit">
                                <i class="fas fa-chart-line me-2"></i>
                                Position Fit Evaluation
                            </button>
                        </div>
                        
                        <!-- Tabs Content Area -->
                        <div class="benefits-tabs-content">
                            <!-- Tab 1: Simulasi Wawancara Kerja (Active by default) -->
                            <div class="benefit-tab-pane active" id="tab-simulasi">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="benefit-content-wrapper">
                                            <h3 class="benefit-content-title">Simulasi Wawancara Kerja</h3>
                                            <p class="benefit-content-desc">
                                                Fitur simulasi wawancara kerja berkualitas tinggi yang dirancang menyerupai proses wawancara riil, membantu Anda mempersiapkan diri dengan lebih percaya diri.
                                            </p>
                                            <ul class="benefit-features-list">
                                                <li>Setiap soal dilengkapi kunci jawaban dan pembahasan</li>
                                                <li>Penilaian untuk membantu pengguna memahami kekuatan</li>
                                                <li>Meningkatkan kualitas jawaban saat wawancara kerja</li>
                                                <li>Membangun kepercayaan diri sebelum menghadapi wawancara sebenarnya</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="benefit-image-wrapper">
                                            <!-- Ganti dengan gambar yang sesuai -->
                                            <img src="https://via.placeholder.com/550x400/0A5C36/FFFFFF?text=Simulasi+Wawancara" 
                                                 alt="Simulasi Wawancara Kerja" 
                                                 class="img-fluid rounded shadow">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tab 2: Tes Minat & Bakat -->
                            <div class="benefit-tab-pane" id="tab-tes-minat">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="benefit-content-wrapper">
                                            <h3 class="benefit-content-title">Tes Minat & Bakat</h3>
                                            <p class="benefit-content-desc">
                                                Temukan potensi terbaik dalam diri Anda dengan tes minat dan bakat yang komprehensif, memberikan insight mendalam tentang karir yang sesuai.
                                            </p>
                                            <ul class="benefit-features-list">
                                                <li>Analisis mendalam tentang kepribadian dan minat</li>
                                                <li>Rekomendasi karir berdasarkan potensi terbaik</li>
                                                <li>Laporan detail dengan visualisasi yang mudah dipahami</li>
                                                <li>Konsultasi hasil tes dengan ahli karir</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="benefit-image-wrapper">
                                            <img src="https://via.placeholder.com/550x400/0A5C36/FFFFFF?text=Tes+Minat+Bakat" 
                                                 alt="Tes Minat & Bakat" 
                                                 class="img-fluid rounded shadow">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tab 3: Smart Job Matching -->
                            <div class="benefit-tab-pane" id="tab-job-matching">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="benefit-content-wrapper">
                                            <h3 class="benefit-content-title">Smart Job Matching</h3>
                                            <p class="benefit-content-desc">
                                                Sistem pintar yang menghubungkan Anda dengan peluang kerja terbaik berdasarkan skill, pengalaman, dan preferensi karir Anda.
                                            </p>
                                            <ul class="benefit-features-list">
                                                <li>Algoritma matching cerdas dengan akurasi tinggi</li>
                                                <li>Rekomendasi pekerjaan yang relevan dengan profil Anda</li>
                                                <li>Notifikasi real-time untuk lowongan terbaru</li>
                                                <li>Akses ke perusahaan partner yang berkualitas</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="benefit-image-wrapper">
                                            <img src="https://via.placeholder.com/550x400/0A5C36/FFFFFF?text=Job+Matching" 
                                                 alt="Smart Job Matching" 
                                                 class="img-fluid rounded shadow">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tab 4: Position Fit Evaluation -->
                            <div class="benefit-tab-pane" id="tab-position-fit">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="benefit-content-wrapper">
                                            <h3 class="benefit-content-title">Position Fit Evaluation</h3>
                                            <p class="benefit-content-desc">
                                                Evaluasi kesesuaian posisi yang membantu Anda dan perusahaan memahami seberapa baik Anda cocok dengan peran yang ditawarkan.
                                            </p>
                                            <ul class="benefit-features-list">
                                                <li>Analisis kesesuaian skill dengan kebutuhan posisi</li>
                                                <li>Prediksi performa berdasarkan karakteristik pribadi</li>
                                                <li>Rekomendasi pengembangan kompetensi yang dibutuhkan</li>
                                                <li>Laporan komprehensif untuk pengambilan keputusan</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="benefit-image-wrapper">
                                            <img src="https://via.placeholder.com/550x400/0A5C36/FFFFFF?text=Position+Fit" 
                                                 alt="Position Fit Evaluation" 
                                                 class="img-fluid rounded shadow">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Ajakan tengah -->
<section class="mt-5 footer-custom">
    <div class="background-image animated-element text-center">
        <div class="text-light title-cta">
            <b><?= ($lang == 'en') ? $webprofile[0]['judul_ajakan_en'] : $webprofile[0]['judul_ajakan'] ?></b>
        </div>
        <p class="text-light desc-cta">
            <?= ($lang == 'en') ? $webprofile[0]['deskripsi_ajakan_en'] : $webprofile[0]['deskripsi_ajakan'] ?>
        </p>

    </div>
</section>

<!-- Paket Visitor / Member -->
<section class="container mt-5">
    <div class="kata1 text-center">
        <div class="d-flex justify-content-center align-items-center">
            <div class="border-top6 mx-2"></div>
            <h5 class="fw-lighter"><?= lang('Blog.yourPackageTitle'); ?></h5>
            <div class="border-top7 ms-2"></div>
        </div>
        <div class="fw-bold title-cta">
            <?= lang('Blog.chooseTitle'); ?>
            <span style="color: #0A5C36;"><?= lang('Blog.forYouTitle'); ?></span>
        </div>
    </div>

    <div class="package-section row mt-3 g-4">
        <!-- Visitor Card -->
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-lg rounded text-center">
                <div class="card-header bg-secondary text-white py-4">
                    <h5 class="mb-0 fw-bold">Visitor</h5>
                </div>
                <div class="card-body">
                    <i class="fas fa-user-slash fa-3x text-secondary mb-4"></i>
                    <h6 class="fw-bold"><?= lang('Blog.basicAccess'); ?></h6>
                    <h6 class="fw-bold text-secondary"><?= lang('Blog.freeTitle'); ?></h6>
                    <p><?= lang('Blog.deskNonMember'); ?></p>
                    <div class="benefits-list">
                        <?php foreach ($fitur_visitor as $item): ?>
                            <hr>
                            <p class="mb-2">- <?= ($lang == 'en') ? $item['nama_fitur_en'] : $item['nama_fitur']; ?></p>
                        <?php endforeach; ?>
                        <hr>
                    </div>
                </div>
                <div class="card-footer bg-light py-3">
                    <button class="btn btn-primary btn-sm">
                        <?= lang('Blog.currentPackage'); ?>
                    </button>
                </div>
            </div>
        </div>

        <!-- Member Card -->
        <div class="col-md-6 position-relative">
            <div class="card h-100 border-0 shadow-lg rounded text-center">
                <div class="recommended-label position-absolute text-white px-3 py-1">
                    <?= lang('Blog.recommendedTitle'); ?>
                </div>
                <div class="card-header bg-primary text-white py-4">
                    <h5 class="mb-0 fw-bold">Member</h5>
                </div>
                <div class="card-body">
                    <i class="fas fa-crown fa-3x text-primary mb-4"></i>
                    <h6 class="fw-bold"><?= lang('Blog.fullAccess'); ?></h6>
                    <h6 class="fw-bold text-primary"><?= lang('Blog.packageRegistered'); ?></h6>
                    <p><?= lang('Blog.deskMemberFree'); ?></p>
                    <div class="benefits-list">
                        <?php foreach ($fitur_member as $item): ?>
                            <hr>
                            <p class="mb-2">- <?= ($lang == 'en') ? $item['nama_fitur_en'] : $item['nama_fitur']; ?></p>
                        <?php endforeach; ?>
                        <hr>
                    </div>
                </div>
                <div class="card-footer bg-light py-3">
                    <button class="btn btn-primary btn-sm"><?php echo lang('Blog.currentPackage'); ?></button>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Peta Member -->
<section class="container peta2">
    <div class="peta mt-5">
        <div class="d-flex justify-content-center align-items-center">
            <div class="border-top6 mx-2"></div>
            <h5 class="fw-lighter"><?= lang('Blog.memberMapTitle'); ?></h5>
            <div class="border-top7 ms-2"></div>
        </div>
        <div class="text-center fw-bold title-cta">
            <?= lang('Blog.communityMemberSpotlightTitle'); ?>
            <span><?= lang('Blog.communityMemberSpotlightTitle2'); ?></span>
        </div>
    </div>
    <div class="container mt-5 d-flex justify-content-center">
        <div id="map" class="map"></div>
    </div>
</section>

<script>
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

    document.addEventListener('DOMContentLoaded', function() {
        // Get all tab buttons
        const tabButtons = document.querySelectorAll('.benefit-tab-btn');
        const tabPanes = document.querySelectorAll('.benefit-tab-pane');
        
        // Function to switch tabs
        function switchTab(tabId) {
            // Remove active class from all buttons and panes
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));
            
            // Add active class to clicked button
            const activeButton = document.querySelector(`[data-tab="${tabId}"]`);
            if (activeButton) {
                activeButton.classList.add('active');
            }
            
            // Show corresponding content pane
            const activePane = document.getElementById(`tab-${tabId}`);
            if (activePane) {
                activePane.classList.add('active');
            }
        }
        
        // Add click event listeners to all tab buttons
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                switchTab(tabId);
            });
        });
        
        // Set first tab as active by default (if not already set)
        if (!document.querySelector('.benefit-tab-btn.active')) {
            switchTab('simulasi');
        }
    });
    
</script>

<?= $this->endSection(); ?>