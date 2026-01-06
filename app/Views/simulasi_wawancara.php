<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<?php
// Tambahkan ini untuk mengakses $webprofile dari layout
$profile = $webprofile[0] ?? [
    'logo_web'        => 'logo.png',
    'footer_text'     => '',
    'nohp_web'        => '',
    'email_web'       => '',
    'link_ig_web'     => '#',
    'link_yt_web'     => '#',
    'link_fb_web'     => '#',
    'deskripsi_web'   => '',
    'deskripsi_web_en' => '',
    'alamat_web'      => ''
];

$this->setData([
    'title'            => ($lang == 'id') ? 'Simulasi Wawancara Kerja' : 'Job Interview Simulation',
    'meta_description' => ($lang == 'id') ? 'Persiapkan diri menghadapi HRD dengan simulasi wawancara kerja interaktif. Latihan berbasis kuesioner adaptif dengan kunci jawaban dan pembahasan mendalam.' : 'Prepare yourself for HR interviews with interactive job interview simulations. Adaptive questionnaire-based practice with answer keys and in-depth explanations.',
    'webprofile'       => [$profile] // Pastikan $webprofile tersedia
]);
?>

<style>
    /* ===================================================
       Simulasi Wawancara Page - FULL VERSION
       =================================================== */

    .simulasi-hero {
        background: var(--c-primary); /* Coffee Bean solid */
        color: white;
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
    }

    .simulasi-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--c-accent), var(--c-accent-light));
        /* Light Bronze ke Light Caramel */
        z-index: 1;
    }

    .simulasi-hero-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
    }

    .hero-badge {
        display: inline-block;
        background: var(--c-accent); /* Light Bronze */
        color: white;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 20px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .hero-title {
        font-family: "Poetsen One", sans-serif;
        font-size: 3.5rem;
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 25px;
        color: white;
    }

    .hero-subtitle {
        font-size: 1.8rem;
        font-weight: 300;
        line-height: 1.4;
        margin-bottom: 40px;
        color: rgba(255, 255, 255, 0.9);
        max-width: 800px;
    }

    .hero-features {
        list-style: none;
        padding: 0;
        margin: 0 0 40px 0;
    }

    .hero-features li {
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px;
        font-size: 1.1rem;
        line-height: 1.6;
        color: white;
    }

    .hero-features li::before {
        content: '✓';
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        background: var(--c-accent); /* Light Bronze */
        color: white;
        border-radius: 50%;
        margin-right: 12px;
        flex-shrink: 0;
        font-weight: bold;
        font-size: 0.9rem;
    }

    .cta-button-large {
        display: inline-block;
        background: var(--c-accent); /* Light Bronze */
        color: white;
        padding: 18px 45px;
        font-size: 1.2rem;
        font-weight: 600;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 8px 20px rgba(217, 154, 108, 0.3);
        /* Light Bronze shadow */
    }

    .cta-button-large:hover {
        background: var(--c-accent-light); /* Light Caramel */
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(217, 154, 108, 0.4);
        /* Light Bronze shadow */
        color: white;
    }

    /* Preview Section */
    .preview-section {
        padding: 80px 0;
        background: var(--c-background); /* Soft Apricot */
    }

    .preview-title {
        font-family: "Poetsen One", sans-serif;
        font-size: 2.8rem;
        text-align: center;
        color: var(--c-text); /* Deep Cocoa */
        margin-bottom: 20px;
    }

    .preview-subtitle {
        text-align: center;
        color: var(--c-text-light); /* Deep Cocoa lebih terang */
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto 50px;
        line-height: 1.6;
    }

    .preview-card {
        background: var(--c-white); /* Pure White */
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(111, 78, 55, 0.1);
        /* Coffee Bean shadow */
        transition: all 0.3s ease;
        border: 1px solid rgba(111, 78, 55, 0.1);
        /* Coffee Bean border */
    }

    .preview-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(111, 78, 55, 0.15);
        /* Coffee Bean shadow */
    }

    .preview-card-header {
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        /* Coffee Bean gradient */
        padding: 30px;
        text-align: center;
    }

    /* PERBAIKAN: "Contoh Soal Wawancara" jadi PUTIH karena background gelap */
    .preview-card-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
        color: #FFFFFF !important; /* Warna putih untuk kontras dengan background gelap */
    }

    .preview-card-body {
        padding: 40px;
    }

    .question-card {
        background: var(--c-background); /* Soft Apricot */
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        border-left: 4px solid var(--c-accent); /* Light Bronze */
    }

    .question-text {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--c-text); /* Deep Cocoa */
        margin-bottom: 15px;
    }

    .answer-options {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .answer-options li {
        background: var(--c-white); /* Pure White */
        padding: 15px 20px;
        margin-bottom: 10px;
        border-radius: 10px;
        border: 2px solid rgba(111, 78, 55, 0.1);
        /* Coffee Bean border */
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        color: var(--c-text); /* Deep Cocoa */
    }

    .answer-options li:hover {
        border-color: var(--c-primary-light);
        background: rgba(111, 78, 55, 0.02);
        /* Coffee Bean dengan opacity */
    }

    .answer-options li.selected {
        border-color: var(--c-accent); /* Light Bronze */
        background: rgba(217, 154, 108, 0.05);
        /* Light Bronze dengan opacity */
    }

    .answer-letter {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        background: var(--c-primary); /* Coffee Bean */
        color: white;
        border-radius: 50%;
        margin-right: 15px;
        font-weight: bold;
        flex-shrink: 0;
    }

    .feedback-card {
        background: var(--c-white); /* Pure White */
        border-radius: 15px;
        padding: 25px;
        margin-top: 20px;
        border: 2px solid var(--c-accent); /* Light Bronze */
        display: none;
    }

    .feedback-card.show {
        display: block;
        animation: fadeIn 0.5s ease;
    }

    .feedback-title {
        color: var(--c-text); /* Deep Cocoa */
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .feedback-title i {
        color: var(--c-accent); /* Light Bronze */
    }

    .feedback-content {
        color: var(--c-text-light); /* Deep Cocoa lebih terang */
        line-height: 1.6;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Features Section */
    .features-section {
        padding: 80px 0;
        background: var(--c-white); /* Pure White */
    }

    .features-title {
        font-family: "Poetsen One", sans-serif;
        font-size: 2.8rem;
        text-align: center;
        color: var(--c-text); /* Deep Cocoa */
        margin-bottom: 60px;
    }

    .feature-card {
        background: var(--c-background); /* Soft Apricot */
        border-radius: 15px;
        padding: 40px 30px;
        text-align: center;
        height: 100%;
        transition: all 0.3s ease;
        border: 1px solid rgba(111, 78, 55, 0.1);
        /* Coffee Bean border */
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(111, 78, 55, 0.1);
        /* Coffee Bean shadow */
        border-color: var(--c-accent); /* Light Bronze */
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        /* Coffee Bean gradient */
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        font-size: 2.5rem;
        color: white;
    }

    .feature-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--c-text); /* Deep Cocoa */
        margin-bottom: 15px;
    }

    .feature-description {
        color: var(--c-text-light); /* Deep Cocoa lebih terang */
        line-height: 1.6;
        font-size: 1rem;
    }

    /* SIMULASI SECTION - FULL FITUR */
    .simulasi-container {
        padding: 80px 0;
        background: var(--c-background); /* Soft Apricot */
    }

    .simulasi-wrapper {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .question-counter {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding: 15px 25px;
        background: var(--c-white); /* Pure White */
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(111, 78, 55, 0.05);
        /* Coffee Bean shadow */
    }

    .question-number {
        font-size: 1.5rem;
        font-weight: bold;
        color: var(--c-accent); /* Light Bronze */
    }

    .timer-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .timer {
        font-size: 1.8rem;
        font-weight: bold;
        color: var(--c-text); /* Deep Cocoa */
        font-family: monospace;
        background: rgba(111, 78, 55, 0.05);
        /* Coffee Bean dengan opacity */
        padding: 8px 15px;
        border-radius: 8px;
        min-width: 100px;
        text-align: center;
    }

    .timer-label {
        font-size: 0.9rem;
        color: var(--c-text-light); /* Deep Cocoa lebih terang */
    }

    .timer-warning {
        color: #EF4444 !important; /* Tetap merah untuk peringatan */
        animation: pulse 1s infinite;
    }

    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
    }

    /* Progress Bar */
    .progress-container {
        margin: 30px 0;
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 0.95rem;
        color: var(--c-text-light); /* Deep Cocoa lebih terang */
    }

    .progress-bar-custom {
        height: 10px;
        background: rgba(111, 78, 55, 0.1);
        /* Coffee Bean dengan opacity */
        border-radius: 5px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--c-accent), var(--c-accent-light));
        /* Light Bronze ke Light Caramel */
        border-radius: 5px;
        transition: width 0.5s ease;
        position: relative;
    }

    .progress-fill::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    /* Question Display */
    .question-display-card {
        background: var(--c-white); /* Pure White */
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(111, 78, 55, 0.08);
        /* Coffee Bean shadow */
        border: 1px solid rgba(111, 78, 55, 0.1);
        /* Coffee Bean border */
    }

    .question-category {
        display: inline-block;
        background: rgba(217, 154, 108, 0.1);
        /* Light Bronze dengan opacity */
        color: var(--c-accent); /* Light Bronze */
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .question-text-large {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--c-text); /* Deep Cocoa */
        line-height: 1.6;
        margin-bottom: 25px;
    }

    /* Answer Options */
    .answers-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .answer-option {
        background: var(--c-white); /* Pure White */
        border: 2px solid rgba(111, 78, 55, 0.2);
        /* Coffee Bean border */
        border-radius: 12px;
        padding: 18px 20px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .answer-option:hover {
        border-color: rgba(111, 78, 55, 0.3);
        /* Coffee Bean border */
        background: rgba(111, 78, 55, 0.05);
        /* Coffee Bean dengan opacity */
        transform: translateY(-2px);
    }

    .answer-option.selected {
        border-color: var(--c-accent); /* Light Bronze */
        background: rgba(217, 154, 108, 0.05);
        /* Light Bronze dengan opacity */
        box-shadow: 0 5px 15px rgba(217, 154, 108, 0.1);
        /* Light Bronze shadow */
    }

    .answer-option.correct {
        border-color: #10B981; /* Tetap hijau untuk benar */
        background: rgba(16, 185, 129, 0.05);
    }

    .answer-option.incorrect {
        border-color: #EF4444; /* Tetap merah untuk salah */
        background: rgba(239, 68, 68, 0.05);
    }

    .answer-letter-large {
        width: 40px;
        height: 40px;
        background: var(--c-primary); /* Coffee Bean */
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .answer-text {
        font-size: 1.1rem;
        color: var(--c-text); /* Deep Cocoa */
        line-height: 1.5;
        flex: 1;
    }

    /* Feedback Section */
    .feedback-section {
        background: var(--c-white); /* Pure White */
        border-radius: 15px;
        padding: 30px;
        margin-top: 25px;
        border-left: 5px solid var(--c-accent); /* Light Bronze */
        display: none;
        animation: slideDown 0.4s ease;
    }

    .feedback-section.show {
        display: block;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .feedback-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
    }

    .feedback-icon {
        width: 40px;
        height: 40px;
        background: var(--c-accent); /* Light Bronze */
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .feedback-title-large {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--c-text); /* Deep Cocoa */
        margin: 0;
    }

    .feedback-content-large {
        color: var(--c-text-light); /* Deep Cocoa lebih terang */
        line-height: 1.7;
        font-size: 1.05rem;
    }

    .feedback-tips {
        background: rgba(236, 177, 118, 0.1);
        /* Light Caramel dengan opacity */
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
        border-left: 4px solid var(--c-accent-light); /* Light Caramel */
    }

    .feedback-tips-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--c-text); /* Deep Cocoa */
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .feedback-tips-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .feedback-tips-list li {
        padding: 8px 0;
        color: var(--c-text-light); /* Deep Cocoa lebih terang */
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .feedback-tips-list li::before {
        content: '💡';
        flex-shrink: 0;
    }

    /* Navigation Buttons */
    .nav-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
        gap: 20px;
    }

    .nav-btn {
        padding: 14px 35px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-prev {
        background: transparent;
        border-color: rgba(111, 78, 55, 0.2);
        /* Coffee Bean border */
        color: var(--c-text-light); /* Deep Cocoa lebih terang */
    }

    .btn-prev:hover {
        background: rgba(111, 78, 55, 0.05);
        /* Coffee Bean dengan opacity */
        border-color: rgba(111, 78, 55, 0.3);
        /* Coffee Bean border */
        transform: translateY(-2px);
    }

    .btn-next {
        background: var(--c-accent); /* Light Bronze */
        color: white;
        box-shadow: 0 4px 12px rgba(217, 154, 108, 0.2);
        /* Light Bronze shadow */
    }

    .btn-next:hover {
        background: var(--c-accent-light); /* Light Caramel */
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(217, 154, 108, 0.3);
        /* Light Bronze shadow */
    }

    .btn-finish {
        background: var(--c-accent-light); /* Light Caramel */
        color: white;
        box-shadow: 0 4px 12px rgba(236, 177, 118, 0.2);
        /* Light Caramel shadow */
    }

    .btn-finish:hover {
        background: var(--c-accent); /* Light Bronze */
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(236, 177, 118, 0.3);
        /* Light Caramel shadow */
    }

    .btn-reset {
        background: transparent;
        border-color: var(--c-accent-light); /* Light Caramel */
        color: var(--c-accent-light); /* Light Caramel */
    }

    .btn-reset:hover {
        background: rgba(236, 177, 118, 0.1);
        /* Light Caramel dengan opacity */
        transform: translateY(-2px);
    }

    /* Result Section */
    .result-section {
        padding: 80px 0;
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        /* Coffee Bean gradient */
        color: white;
        text-align: center;
        display: none;
    }

    .result-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .result-badge {
        display: inline-block;
        background: var(--c-accent); /* Light Bronze */
        color: white;
        padding: 10px 25px;
        border-radius: 25px;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .score-display {
        font-size: 5rem;
        font-weight: bold;
        color: var(--c-accent); /* Light Bronze */
        margin: 20px 0;
        text-shadow: 0 5px 15px rgba(217, 154, 108, 0.3);
        /* Light Bronze shadow */
    }

    .score-label {
        font-size: 1.3rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 40px;
    }

    .score-breakdown {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        padding: 30px;
        margin: 40px 0;
        text-align: left;
    }

    .breakdown-item {
        display: flex;
        justify-content: space-between;
        padding: 15px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .breakdown-item:last-child {
        border-bottom: none;
    }

    .breakdown-label {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.1rem;
    }

    .breakdown-value {
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .breakdown-value.correct {
        color: #10B981; /* Tetap hijau untuk benar */
    }

    .breakdown-value.incorrect {
        color: #EF4444; /* Tetap merah untuk salah */
    }

    .result-actions {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 40px;
        flex-wrap: wrap;
    }

    /* Tips Section */
    .tips-section {
        padding: 60px 0;
        background: var(--c-white); /* Pure White */
    }

    .tips-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .tip-card {
        background: var(--c-background); /* Soft Apricot */
        border-radius: 15px;
        padding: 30px;
        transition: all 0.3s ease;
        border: 1px solid rgba(111, 78, 55, 0.1);
        /* Coffee Bean border */
    }

    .tip-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(111, 78, 55, 0.1);
        /* Coffee Bean shadow */
        border-color: var(--c-accent); /* Light Bronze */
    }

    .tip-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        /* Coffee Bean gradient */
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 1.8rem;
        color: white;
    }

    .tip-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--c-text); /* Deep Cocoa */
        margin-bottom: 15px;
    }

    .tip-description {
        color: var(--c-text-light); /* Deep Cocoa lebih terang */
        line-height: 1.6;
    }

    /* ===================================================
       Responsif - FULL VERSION
       =================================================== */

    /* Tablet (992px dan bawah) */
    @media (max-width: 992px) {
        .simulasi-hero {
            padding: 80px 0 60px;
        }

        .hero-title {
            font-size: 3rem;
        }

        .hero-subtitle {
            font-size: 1.6rem;
        }

        .preview-title,
        .features-title {
            font-size: 2.5rem;
        }

        .score-display {
            font-size: 4rem;
        }
    }

    /* Tablet Portrait (768px dan bawah) */
    @media (max-width: 768px) {
        .simulasi-hero {
            padding: 60px 0 50px;
        }

        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1.4rem;
        }

        .hero-features li {
            font-size: 1rem;
        }

        .cta-button-large {
            padding: 16px 35px;
            font-size: 1.1rem;
        }

        .preview-section,
        .features-section {
            padding: 60px 0;
        }

        .preview-title,
        .features-title {
            font-size: 2.2rem;
        }

        .preview-card-body {
            padding: 30px;
        }

        .feature-card {
            padding: 30px 20px;
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            font-size: 2rem;
        }

        .nav-buttons {
            flex-direction: column;
        }
        
        .nav-btn {
            width: 100%;
            justify-content: center;
        }

        .question-display-card {
            padding: 30px;
        }

        .question-text-large {
            font-size: 1.2rem;
        }

        .answer-text {
            font-size: 1rem;
        }

        .result-actions {
            flex-direction: column;
        }

        .result-actions .cta-button-large {
            width: 100%;
            margin: 5px 0;
        }
    }

    /* Mobile (576px dan bawah) */
    @media (max-width: 576px) {
        .simulasi-hero {
            padding: 50px 0 40px;
        }

        .hero-title {
            font-size: 2.2rem;
        }

        .hero-subtitle {
            font-size: 1.2rem;
        }

        .hero-badge {
            font-size: 0.8rem;
            padding: 6px 15px;
        }

        .hero-features li {
            font-size: 0.95rem;
        }

        .cta-button-large {
            padding: 14px 30px;
            font-size: 1rem;
            width: 100%;
            text-align: center;
            margin: 5px 0;
        }

        .preview-title,
        .features-title {
            font-size: 2rem;
        }

        .preview-subtitle {
            font-size: 1rem;
            margin-bottom: 30px;
        }

        .preview-card-body {
            padding: 20px;
        }

        .question-card {
            padding: 20px;
        }

        .feature-card {
            padding: 25px 15px;
        }

        .feature-title {
            font-size: 1.3rem;
        }

        .question-counter {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .timer {
            font-size: 1.5rem;
            min-width: 80px;
        }

        .score-display {
            font-size: 3.5rem;
        }

        .tips-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Small Mobile (425px dan bawah) */
    @media (max-width: 425px) {
        .hero-title {
            font-size: 1.9rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
        }

        .preview-title,
        .features-title {
            font-size: 1.8rem;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            font-size: 1.8rem;
        }

        .feature-title {
            font-size: 1.2rem;
        }

        .question-text {
            font-size: 1rem;
        }

        .answer-options li {
            padding: 12px 15px;
        }

        .question-display-card {
            padding: 20px;
        }

        .question-text-large {
            font-size: 1.1rem;
        }

        .answer-option {
            padding: 15px;
        }

        .answer-letter-large {
            width: 35px;
            height: 35px;
            font-size: 1rem;
        }

        .nav-btn {
            padding: 12px 20px;
            font-size: 1rem;
        }

        .score-display {
            font-size: 3rem;
        }
    }
</style>

<!-- Hero Section dengan background biru gelap solid -->
<section class="simulasi-hero">
    <div class="simulasi-hero-content">
        <span class="hero-badge"><?= ($lang == 'id') ? 'Baru: Persiapan Karir' : 'New: Career Preparation' ?></span>
        
        <h1 class="hero-title"><?= ($lang == 'id') ? 'Latihan Wawancara Kerja Interaktif' : 'Interactive Job Interview Practice' ?></h1>
        
        <p class="hero-subtitle">
            <?= ($lang == 'id') 
                ? 'Persiapkan dirimu menghadapi HRD dengan simulasi wawancara berbasis kuesioner. Hadapi pertanyaan profesional dengan percaya diri melalui sistem latihan kami.' 
                : 'Prepare yourself for HR interviews with questionnaire-based simulation. Face professional questions confidently through our training system.' ?>
        </p>
        
        <ul class="hero-features">
            <li>
                <?= ($lang == 'id') 
                    ? 'Kuesioner Adaptif: Pertanyaan standar industri profesional.' 
                    : 'Adaptive Questionnaire: Standard professional industry questions.' ?>
            </li>
            <li>
                <?= ($lang == 'id') 
                    ? 'Kunci Jawaban: Contoh jawaban terbaik untuk memukau pewawancara.' 
                    : 'Answer Keys: Best answer examples to impress interviewers.' ?>
            </li>
            <li>
                <?= ($lang == 'id') 
                    ? 'Pembahasan Mendalam: Penjelasan logika di balik setiap jawaban.' 
                    : 'In-depth Analysis: Explanation of the logic behind each answer.' ?>
            </li>
            <li>
                <?= ($lang == 'id') 
                    ? 'Timer Real-time: Latihan dengan batas waktu seperti wawancara sesungguhnya.' 
                    : 'Real-time Timer: Practice with time limits like real interviews.' ?>
            </li>
            <li>
                <?= ($lang == 'id') 
                    ? 'Analisis Hasil: Dapatkan laporan performa dan rekomendasi perbaikan.' 
                    : 'Result Analysis: Get performance reports and improvement recommendations.' ?>
            </li>
        </ul>
        
        <a href="#mulai-simulasi" class="cta-button-large">
            <?= ($lang == 'id') ? 'Mulai Simulasi Wawancara' : 'Start Interview Simulation' ?>
        </a>
    </div>
</section>

<!-- Preview Section -->
<section id="preview-modul" class="preview-section">
    <div class="container">
        <h2 class="preview-title"><?= ($lang == 'id') ? 'Preview Modul Wawancara' : 'Interview Module Preview' ?></h2>
        
        <p class="preview-subtitle">
            <?= ($lang == 'id') 
                ? 'Dapatkan pembahasan instan setiap selesai menjawab satu pertanyaan.' 
                : 'Get instant feedback after answering each question.' ?>
        </p>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="preview-card">
                    <div class="preview-card-header">
                        <!-- PERBAIKAN: "Contoh Soal Wawancara" jadi PUTIH karena background gelap -->
                        <h3 class="preview-card-title" style="color: white !important;">
                            <?= ($lang == 'id') ? 'Contoh Soal Wawancara' : 'Sample Interview Question' ?>
                        </h3>
                    </div>
                    
                    <div class="preview-card-body">
                        <!-- Question Card -->
                        <div class="question-card">
                            <p class="question-text">
                                <?= ($lang == 'id') 
                                    ? '"Ceritakan tentang diri Anda dan mengapa Anda tertarik dengan posisi ini?"' 
                                    : '"Tell me about yourself and why are you interested in this position?"' ?>
                            </p>
                            
                            <ul class="answer-options">
                                <li onclick="selectAnswer(this, 'A')">
                                    <span class="answer-letter">A</span>
                                    <span>
                                        <?= ($lang == 'id') 
                                            ? 'Saya lulusan S1 dengan IPK 3.5 dan mencari pekerjaan.' 
                                            : 'I am an S1 graduate with a 3.5 GPA looking for a job.' ?>
                                    </span>
                                </li>
                                <li onclick="selectAnswer(this, 'B')">
                                    <span class="answer-letter">B</span>
                                    <span>
                                        <?= ($lang == 'id') 
                                            ? 'Saya seorang profesional dengan pengalaman 5 tahun di bidang marketing dan tertarik dengan perusahaan Anda karena reputasinya yang baik.' 
                                            : 'I am a professional with 5 years experience in marketing and interested in your company due to its good reputation.' ?>
                                    </span>
                                </li>
                                <li onclick="selectAnswer(this, 'C')">
                                    <span class="answer-letter">C</span>
                                    <span>
                                        <?= ($lang == 'id') 
                                            ? 'Nama saya Budi, umur 25 tahun, dan saya butuh pekerjaan.' 
                                            : 'My name is Budi, 25 years old, and I need a job.' ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Feedback Card (hidden by default) -->
                        <div class="feedback-card" id="feedbackCard">
                            <div class="feedback-title">
                                <i class="fas fa-lightbulb"></i>
                                <span><?= ($lang == 'id') ? 'Pembahasan Jawaban' : 'Answer Analysis' ?></span>
                            </div>
                            <div class="feedback-content">
                                <p id="feedbackText">
                                    <?= ($lang == 'id') 
                                        ? 'Pilih salah satu jawaban di atas untuk melihat pembahasan...' 
                                        : 'Select one of the answers above to see the analysis...' ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <h2 class="features-title"><?= ($lang == 'id') ? 'Fitur Unggulan Simulasi' : 'Simulation Key Features' ?></h2>
        
        <div class="row g-4">
            <!-- Feature 1 -->
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3 class="feature-title">
                        <?= ($lang == 'id') ? 'Adaptif & Personal' : 'Adaptive & Personal' ?>
                    </h3>
                    <p class="feature-description">
                        <?= ($lang == 'id') 
                            ? 'Sistem menyesuaikan tingkat kesulitan berdasarkan kemampuan Anda. Setiap sesi dirancang khusus untuk perkembangan Anda.' 
                            : 'System adjusts difficulty based on your ability. Each session is specifically designed for your progress.' ?>
                    </p>
                </div>
            </div>
            
            <!-- Feature 2 -->
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="feature-title">
                        <?= ($lang == 'id') ? 'Analisis Performa' : 'Performance Analysis' ?>
                    </h3>
                    <p class="feature-description">
                        <?= ($lang == 'id') 
                            ? 'Dapatkan laporan detail tentang kekuatan dan area perbaikan Anda. Pantau perkembangan dari waktu ke waktu.' 
                            : 'Get detailed reports on your strengths and improvement areas. Track progress over time.' ?>
                    </p>
                </div>
            </div>
            
            <!-- Feature 3 -->
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3 class="feature-title">
                        <?= ($lang == 'id') ? 'Sertifikasi' : 'Certification' ?>
                    </h3>
                    <p class="feature-description">
                        <?= ($lang == 'id') 
                            ? 'Dapatkan sertifikat kelulusan yang dapat memperkuat CV Anda. Buktikan kemampuan wawancara kepada calon employer.' 
                            : 'Get completion certificates to strengthen your CV. Prove interview skills to potential employers.' ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SIMULASI INTERAKTIF SECTION -->
<section id="mulai-simulasi" class="simulasi-container">
    <div class="simulasi-wrapper">
        <!-- Progress Bar -->
        <div class="progress-container">
            <div class="progress-label">
                <span><?= ($lang == 'id') ? 'Pertanyaan' : 'Question' ?> <span id="currentQuestion">1</span>/10</span>
                <span id="progressPercentage">10%</span>
            </div>
            <div class="progress-bar-custom">
                <div class="progress-fill" id="progressFill" style="width: 10%"></div>
            </div>
        </div>

        <!-- Question Counter & Timer -->
        <div class="question-counter">
            <div class="question-number"><?= ($lang == 'id') ? 'Pertanyaan' : 'Question' ?> <span id="questionNumDisplay">1</span></div>
            <div class="timer-container">
                <div class="timer-label"><?= ($lang == 'id') ? 'Waktu Tersisa:' : 'Time Remaining:' ?></div>
                <div class="timer" id="countdown">10:00</div>
            </div>
        </div>

        <!-- Question Display -->
        <div class="question-display-card" id="questionDisplay">
            <div class="question-category" id="questionCategory">
                <?= ($lang == 'id') ? 'Pertanyaan Personal' : 'Personal Question' ?>
            </div>
            <p class="question-text-large" id="questionTextLarge">
                <?= ($lang == 'id') 
                    ? '"Apa kelemahan terbesar Anda dalam bekerja, dan bagaimana Anda mengatasinya?"' 
                    : '"What is your biggest weakness at work, and how do you overcome it?"' ?>
            </p>
            
            <!-- Answer Options -->
            <div class="answers-grid" id="answersGrid">
                <!-- Answers will be populated by JavaScript -->
            </div>
        </div>

        <!-- Feedback Section -->
        <div class="feedback-section" id="feedbackSection">
            <div class="feedback-header">
                <div class="feedback-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h3 class="feedback-title-large"><?= ($lang == 'id') ? 'Pembahasan Jawaban' : 'Answer Analysis' ?></h3>
            </div>
            <div class="feedback-content-large" id="feedbackContentLarge">
                <?= ($lang == 'id') 
                    ? 'Pilih salah satu jawaban di atas untuk melihat pembahasan...' 
                    : 'Select one of the answers above to see the analysis...' ?>
            </div>
            
            <div class="feedback-tips">
                <div class="feedback-tips-title">
                    <i class="fas fa-tips"></i>
                    <?= ($lang == 'id') ? 'Tips Wawancara:' : 'Interview Tips:' ?>
                </div>
                <ul class="feedback-tips-list" id="feedbackTipsList">
                    <!-- Tips will be populated by JavaScript -->
                </ul>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="nav-buttons">
            <button class="nav-btn btn-prev" onclick="prevQuestion()" id="prevBtn" disabled>
                <i class="fas fa-arrow-left"></i>
                <?= ($lang == 'id') ? 'Sebelumnya' : 'Previous' ?>
            </button>
            
            <div class="d-flex gap-2">
                <button class="nav-btn btn-reset" onclick="resetQuestion()" id="resetBtn">
                    <i class="fas fa-redo"></i>
                    <?= ($lang == 'id') ? 'Ulangi' : 'Reset' ?>
                </button>
                <button class="nav-btn btn-next" onclick="nextQuestion()" id="nextBtn">
                    <?= ($lang == 'id') ? 'Selanjutnya' : 'Next' ?>
                    <i class="fas fa-arrow-right"></i>
                </button>
                <button class="nav-btn btn-finish" onclick="finishSimulation()" id="finishBtn" style="display: none;">
                    <i class="fas fa-flag-checkered"></i>
                    <?= ($lang == 'id') ? 'Selesaikan' : 'Finish' ?>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Result Section (Hidden by Default) -->
<section class="result-section" id="resultSection">
    <div class="result-container">
        <div class="result-badge"><?= ($lang == 'id') ? 'Hasil Simulasi' : 'Simulation Results' ?></div>
        <h2 class="preview-title text-white"><?= ($lang == 'id') ? 'Selamat! Anda Telah Menyelesaikan Simulasi' : 'Congratulations! You Have Completed the Simulation' ?></h2>
        
        <div class="score-display" id="finalScore">0</div>
        <p class="score-label">
            <?= ($lang == 'id') 
                ? 'Skor Anda dari total 10 pertanyaan' 
                : 'Your score out of 10 questions' ?>
        </p>
        
        <!-- Score Breakdown -->
        <div class="score-breakdown">
            <div class="breakdown-item">
                <span class="breakdown-label"><?= ($lang == 'id') ? 'Pertanyaan Dijawab' : 'Questions Answered' ?></span>
                <span class="breakdown-value" id="totalQuestions">0</span>
            </div>
            <div class="breakdown-item">
                <span class="breakdown-label"><?= ($lang == 'id') ? 'Jawaban Benar' : 'Correct Answers' ?></span>
                <span class="breakdown-value correct" id="correctAnswers">0</span>
            </div>
            <div class="breakdown-item">
                <span class="breakdown-label"><?= ($lang == 'id') ? 'Jawaban Salah' : 'Incorrect Answers' ?></span>
                <span class="breakdown-value incorrect" id="incorrectAnswers">0</span>
            </div>
            <div class="breakdown-item">
                <span class="breakdown-label"><?= ($lang == 'id') ? 'Persentase' : 'Percentage' ?></span>
                <span class="breakdown-value" id="percentageScore">0%</span>
            </div>
            <div class="breakdown-item">
                <span class="breakdown-label"><?= ($lang == 'id') ? 'Waktu Tersisa' : 'Time Remaining' ?></span>
                <span class="breakdown-value" id="timeRemaining">00:00</span>
            </div>
        </div>
        
        <!-- Result Actions -->
        <div class="result-actions">
            <button class="cta-button-large" onclick="restartSimulation()">
                <i class="fas fa-redo me-2"></i><?= ($lang == 'id') ? 'Ulangi Simulasi' : 'Restart Simulation' ?>
            </button>
            <button class="cta-button-large" onclick="downloadCertificate()" style="background: transparent; border: 2px solid #06B6D4;">
                <i class="fas fa-download me-2"></i><?= ($lang == 'id') ? 'Unduh Sertifikat' : 'Download Certificate' ?>
            </button>
            <a href="<?= base_url('/') ?>" class="cta-button-large" style="background: #10B981;">
                <i class="fas fa-home me-2"></i><?= ($lang == 'id') ? 'Kembali ke Beranda' : 'Back to Home' ?>
            </a>
        </div>
    </div>
</section>

<!-- Tips Section -->
<section class="tips-section">
    <div class="container">
        <h2 class="features-title"><?= ($lang == 'id') ? 'Tips Sukses Wawancara Kerja' : 'Job Interview Success Tips' ?></h2>
        <p class="preview-subtitle">
            <?= ($lang == 'id') 
                ? 'Kiat-kiat profesional untuk menghadapi wawancara kerja dengan percaya diri' 
                : 'Professional tips for facing job interviews with confidence' ?>
        </p>
        
        <div class="tips-grid">
            <!-- Tip 1 -->
            <div class="tip-card">
                <div class="tip-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="tip-title"><?= ($lang == 'id') ? 'Riset Perusahaan' : 'Company Research' ?></h3>
                <p class="tip-description">
                    <?= ($lang == 'id') 
                        ? 'Pelajari visi, misi, budaya, dan produk perusahaan. Tunjukkan minat dan pengetahuan Anda tentang perusahaan tersebut.' 
                        : 'Study the company\'s vision, mission, culture, and products. Show interest and knowledge about the company.' ?>
                </p>
            </div>
            
            <!-- Tip 2 -->
            <div class="tip-card">
                <div class="tip-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h3 class="tip-title"><?= ($lang == 'id') ? 'Komunikasi Efektif' : 'Effective Communication' ?></h3>
                <p class="tip-description">
                    <?= ($lang == 'id') 
                        ? 'Gunakan bahasa yang jelas, percaya diri, dan profesional. Dengarkan dengan baik sebelum menjawab pertanyaan.' 
                        : 'Use clear, confident, and professional language. Listen carefully before answering questions.' ?>
                </p>
            </div>
            
            <!-- Tip 3 -->
            <div class="tip-card">
                <div class="tip-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3 class="tip-title"><?= ($lang == 'id') ? 'Penampilan Profesional' : 'Professional Appearance' ?></h3>
                <p class="tip-description">
                    <?= ($lang == 'id') 
                        ? 'Berpakaian rapi dan sesuai dengan budaya perusahaan. Perhatikan bahasa tubuh dan kontak mata.' 
                        : 'Dress neatly and according to company culture. Pay attention to body language and eye contact.' ?>
                </p>
            </div>
            
            <!-- Tip 4 -->
            <div class="tip-card">
                <div class="tip-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3 class="tip-title"><?= ($lang == 'id') ? 'Highlight Pencapaian' : 'Highlight Achievements' ?></h3>
                <p class="tip-description">
                    <?= ($lang == 'id') 
                        ? 'Siapkan contoh konkret dari pencapaian sebelumnya. Gunakan metode STAR (Situation, Task, Action, Result).' 
                        : 'Prepare concrete examples from previous achievements. Use the STAR method (Situation, Task, Action, Result).' ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="preview-section">
    <div class="container text-center">
        <h2 class="preview-title"><?= ($lang == 'id') ? 'Siap Tingkatkan Karir Anda?' : 'Ready to Boost Your Career?' ?></h2>
        
        <p class="preview-subtitle">
            <?= ($lang == 'id') 
                ? 'Bergabung dengan ribuan profesional yang telah meningkatkan kepercayaan diri dalam wawancara melalui sistem kami.' 
                : 'Join thousands of professionals who have boosted their interview confidence through our system.' ?>
        </p>
        
        <div class="mt-5">
            <a href="<?= base_url('/login') ?>" class="cta-button-large me-3">
                <?= ($lang == 'id') ? 'Mulai Sekarang' : 'Start Now' ?>
            </a>
            <a href="<?= base_url('/registration') ?>" class="cta-button-large" style="background: transparent; border: 2px solid #06B6D4; color: #0F172A;">
                <?= ($lang == 'id') ? 'Daftar Gratis' : 'Register Free' ?>
            </a>
        </div>
    </div>
</section>

<script>
    // Data pertanyaan hardcoded LENGKAP dengan 10 pertanyaan
    const questions = [
        {
            id: 1,
            category: '<?= ($lang == "id") ? "Pertanyaan Personal" : "Personal Question" ?>',
            question: '<?= ($lang == "id") ? "Apa kelemahan terbesar Anda dalam bekerja, dan bagaimana Anda mengatasinya?" : "What is your biggest weakness at work, and how do you overcome it?" ?>',
            answers: [
                { letter: 'A', text: '<?= ($lang == "id") ? "Saya tidak punya kelemahan. Saya sempurna dalam segala hal." : "I don\'t have any weaknesses. I\'m perfect at everything." ?>', correct: false },
                { letter: 'B', text: '<?= ($lang == "id") ? "Saya cenderung terlalu perfeksionis, tapi saya belajar menerima bahwa tidak semua harus sempurna." : "I tend to be too perfectionist, but I\'m learning to accept that not everything has to be perfect." ?>', correct: true },
                { letter: 'C', text: '<?= ($lang == "id") ? "Saya sering datang terlambat karena macet." : "I often come late because of traffic." ?>', correct: false },
                { letter: 'D', text: '<?= ($lang == "id") ? "Saya tidak bisa bekerja dalam tim." : "I cannot work in a team." ?>', correct: false }
            ],
            feedback: '<?= ($lang == "id") ? "Jawaban B paling tepat karena menunjukkan kesadaran diri dan upaya perbaikan. Hindari mengatakan tidak punya kelemahan (A) atau menyebutkan kelemahan fatal (C, D)." : "Answer B is best because it shows self-awareness and improvement efforts. Avoid saying you have no weaknesses (A) or mentioning fatal flaws (C, D)." ?>',
            tips: [
                '<?= ($lang == "id") ? "Pilih kelemahan yang tidak menghambat pekerjaan" : "Choose weaknesses that don\'t hinder the job" ?>',
                '<?= ($lang == "id") ? "Tunjukkan bagaimana Anda mengatasi kelemahan tersebut" : "Show how you overcome those weaknesses" ?>',
                '<?= ($lang == "id") ? "Fokus pada perbaikan dan perkembangan diri" : "Focus on improvement and self-development" ?>'
            ]
        },
        {
            id: 2,
            category: '<?= ($lang == "id") ? "Motivasi" : "Motivation" ?>',
            question: '<?= ($lang == "id") ? "Mengapa Anda ingin bekerja di perusahaan kami?" : "Why do you want to work for our company?" ?>',
            answers: [
                { letter: 'A', text: '<?= ($lang == "id") ? "Karena gajinya tinggi dan lokasinya dekat rumah." : "Because the salary is high and the location is close to home." ?>', correct: false },
                { letter: 'B', text: '<?= ($lang == "id") ? "Saya tertarik dengan produk inovatif perusahaan dan ingin berkontribusi dalam tim yang dinamis." : "I\'m interested in the company\'s innovative products and want to contribute to a dynamic team." ?>', correct: true },
                { letter: 'C', text: '<?= ($lang == "id") ? "Saya butuh pekerjaan apa saja." : "I need any job available." ?>', correct: false },
                { letter: 'D', text: '<?= ($lang == "id") ? "Saya mendengar perusahaan ini memberikan tunjangan yang bagus." : "I heard this company gives good benefits." ?>', correct: false }
            ],
            feedback: '<?= ($lang == "id") ? "Jawaban B menunjukkan Anda telah meneliti perusahaan dan memiliki motivasi yang tepat. Jawaban A, C, dan D terlalu fokus pada kepentingan pribadi." : "Answer B shows you\'ve researched the company and have proper motivation. Answers A, C, and D are too focused on personal interests." ?>',
            tips: [
                '<?= ($lang == "id") ? "Lakukan riset tentang perusahaan" : "Research the company" ?>',
                '<?= ($lang == "id") ? "Hubungkan dengan keahlian dan minat Anda" : "Connect with your skills and interests" ?>',
                '<?= ($lang == "id") ? "Tunjukkan nilai tambah yang bisa Anda berikan" : "Show the added value you can provide" ?>'
            ]
        },
        {
            id: 3,
            category: '<?= ($lang == "id") ? "Pencapaian" : "Achievement" ?>',
            question: '<?= ($lang == "id") ? "Apa pencapaian terbesar Anda dalam pekerjaan sebelumnya?" : "What is your greatest achievement in your previous job?" ?>',
            answers: [
                { letter: 'A', text: '<?= ($lang == "id") ? "Saya selalu datang tepat waktu." : "I always came on time." ?>', correct: false },
                { letter: 'B', text: '<?= ($lang == "id") ? "Saya berhasil meningkatkan penjualan sebesar 30% dalam 6 bulan dengan strategi baru." : "I successfully increased sales by 30% in 6 months with a new strategy." ?>', correct: true },
                { letter: 'C', text: '<?= ($lang == "id") ? "Saya tidak pernah mendapat teguran dari atasan." : "I never received a reprimand from my supervisor." ?>', correct: false },
                { letter: 'D', text: '<?= ($lang == "id") ? "Saya bertahan bekerja di perusahaan itu selama 3 tahun." : "I stayed working at that company for 3 years." ?>', correct: false }
            ],
            feedback: '<?= ($lang == "id") ? "Jawaban B terbaik karena menunjukkan pencapaian konkret dengan angka. Jawaban lainnya terlalu umum dan tidak menunjukkan nilai tambah." : "Answer B is best because it shows concrete achievements with numbers. Other answers are too general and don\'t show added value." ?>',
            tips: [
                '<?= ($lang == "id") ? "Gunakan angka untuk menunjukkan hasil" : "Use numbers to show results" ?>',
                '<?= ($lang == "id") ? "Jelaskan peran spesifik Anda" : "Explain your specific role" ?>',
                '<?= ($lang == "id") ? "Sebutkan tantangan yang dihadapi" : "Mention challenges faced" ?>'
            ]
        },
        {
            id: 4,
            category: '<?= ($lang == "id") ? "Situasional" : "Situational" ?>',
            question: '<?= ($lang == "id") ? "Apa yang akan Anda lakukan jika memiliki konflik dengan rekan kerja?" : "What would you do if you had a conflict with a coworker?" ?>',
            answers: [
                { letter: 'A', text: '<?= ($lang == "id") ? "Saya akan melaporkannya ke atasan langsung." : "I would report it directly to the supervisor." ?>', correct: false },
                { letter: 'B', text: '<?= ($lang == "id") ? "Saya akan berbicara langsung dengan rekan tersebut untuk menyelesaikan masalah." : "I would talk directly with the coworker to resolve the issue." ?>', correct: true },
                { letter: 'C', text: '<?= ($lang == "id") ? "Saya akan mengabaikannya dan fokus pada pekerjaan." : "I would ignore it and focus on work." ?>', correct: false },
                { letter: 'D', text: '<?= ($lang == "id") ? "Saya akan mencari pekerjaan di tempat lain." : "I would look for another job." ?>', correct: false }
            ],
            feedback: '<?= ($lang == "id") ? "Jawaban B menunjukkan kemampuan menyelesaikan konflik secara profesional. Jawaban A terlalu cepat, C menghindari masalah, D tidak profesional." : "Answer B shows professional conflict resolution skills. Answer A is too hasty, C avoids the problem, D is unprofessional." ?>',
            tips: [
                '<?= ($lang == "id") ? "Prioritaskan komunikasi langsung" : "Prioritize direct communication" ?>',
                '<?= ($lang == "id") ? "Fokus pada solusi, bukan menyalahkan" : "Focus on solutions, not blaming" ?>',
                '<?= ($lang == "id") ? "Libatkan atasan jika konflik tidak terselesaikan" : "Involve supervisor if conflict remains unresolved" ?>'
            ]
        },
        {
            id: 5,
            category: '<?= ($lang == "id") ? "Masa Depan" : "Future" ?>',
            question: '<?= ($lang == "id") ? "Di mana Anda melihat diri Anda dalam 5 tahun ke depan?" : "Where do you see yourself in 5 years?" ?>',
            answers: [
                { letter: 'A', text: '<?= ($lang == "id") ? "Saya ingin menjadi CEO perusahaan." : "I want to be the CEO of the company." ?>', correct: false },
                { letter: 'B', text: '<?= ($lang == "id") ? "Saya ingin mengembangkan keahlian dan berkontribusi lebih besar di perusahaan ini." : "I want to develop skills and contribute more to this company." ?>', correct: true },
                { letter: 'C', text: '<?= ($lang == "id") ? "Saya belum memikirkannya." : "I haven\'t thought about it." ?>', correct: false },
                { letter: 'D', text: '<?= ($lang == "id") ? "Saya ingin pindah ke perusahaan yang lebih besar." : "I want to move to a bigger company." ?>', correct: false }
            ],
            feedback: '<?= ($lang == "id") ? "Jawaban B realistis dan menunjukkan komitmen. Jawaban A tidak realistis, C tidak ambisius, D menunjukkan kurangnya loyalitas." : "Answer B is realistic and shows commitment. Answer A is unrealistic, C is not ambitious, D shows lack of loyalty." ?>',
            tips: [
                '<?= ($lang == "id") ? "Tunjukkan tujuan yang realistis" : "Show realistic goals" ?>',
                '<?= ($lang == "id") ? "Hubungkan dengan perkembangan perusahaan" : "Connect with company development" ?>',
                '<?= ($lang == "id") ? "Fokus pada kontribusi dan pembelajaran" : "Focus on contribution and learning" ?>'
            ]
        },
        {
            id: 6,
            category: '<?= ($lang == "id") ? "Teamwork" : "Teamwork" ?>',
            question: '<?= ($lang == "id") ? "Bagaimana Anda bekerja dalam tim?" : "How do you work in a team?" ?>',
            answers: [
                { letter: 'A', text: '<?= ($lang == "id") ? "Saya lebih suka bekerja sendiri." : "I prefer to work alone." ?>', correct: false },
                { letter: 'B', text: '<?= ($lang == "id") ? "Saya aktif berkomunikasi, mendengarkan masukan, dan berkontribusi sesuai keahlian." : "I actively communicate, listen to feedback, and contribute according to my expertise." ?>', correct: true },
                { letter: 'C', text: '<?= ($lang == "id") ? "Saya biasanya menjadi pemimpin tim." : "I usually become the team leader." ?>', correct: false },
                { letter: 'D', text: '<?= ($lang == "id") ? "Saya mengikuti apa yang dikatakan pemimpin." : "I follow what the leader says." ?>', correct: false }
            ],
            feedback: '<?= ($lang == "id") ? "Jawaban B menunjukkan kemampuan kolaborasi yang baik. Jawaban A individualis, C dominan, D pasif." : "Answer B shows good collaboration skills. Answer A is individualistic, C is dominant, D is passive." ?>',
            tips: [
                '<?= ($lang == "id") ? "Tunjukkan kemampuan komunikasi" : "Show communication skills" ?>',
                '<?= ($lang == "id") ? "Sebutkan contoh kolaborasi sukses" : "Mention examples of successful collaboration" ?>',
                '<?= ($lang == "id") ? "Highlight fleksibilitas dalam peran tim" : "Highlight flexibility in team roles" ?>'
            ]
        },
        {
            id: 7,
            category: '<?= ($lang == "id") ? "Problem Solving" : "Problem Solving" ?>',
            question: '<?= ($lang == "id") ? "Bagaimana Anda menangani tekanan deadline?" : "How do you handle deadline pressure?" ?>',
            answers: [
                { letter: 'A', text: '<?= ($lang == "id") ? "Saya akan bekerja lembur." : "I will work overtime." ?>', correct: false },
                { letter: 'B', text: '<?= ($lang == "id") ? "Saya akan memprioritaskan tugas, berkomunikasi dengan tim, dan mencari solusi efisien." : "I will prioritize tasks, communicate with the team, and find efficient solutions." ?>', correct: true },
                { letter: 'C', text: '<?= ($lang == "id") ? "Saya meminta deadline diperpanjang." : "I ask for the deadline to be extended." ?>', correct: false },
                { letter: 'D', text: '<?= ($lang == "id") ? "Saya merasa stres dan sulit bekerja." : "I feel stressed and find it difficult to work." ?>', correct: false }
            ],
            feedback: '<?= ($lang == "id") ? "Jawaban B menunjukkan manajemen waktu dan komunikasi yang baik. Jawaban A tidak sustainable, C menghindari, D menunjukkan ketidakmampuan mengelola stres." : "Answer B shows good time management and communication. Answer A is not sustainable, C avoids, D shows inability to manage stress." ?>',
            tips: [
                '<?= ($lang == "id") ? "Prioritaskan tugas yang penting" : "Prioritize important tasks" ?>',
                '<?= ($lang == "id") ? "Komunikasikan dengan tim dan atasan" : "Communicate with team and supervisor" ?>',
                '<?= ($lang == "id") ? "Gunakan tools manajemen waktu" : "Use time management tools" ?>'
            ]
        },
        {
            id: 8,
            category: '<?= ($lang == "id") ? "Kepemimpinan" : "Leadership" ?>',
            question: '<?= ($lang == "id") ? "Apa gaya kepemimpinan Anda?" : "What is your leadership style?" ?>',
            answers: [
                { letter: 'A', text: '<?= ($lang == "id") ? "Saya memberikan perintah dan mengharapkan kepatuhan." : "I give commands and expect obedience." ?>', correct: false },
                { letter: 'B', text: '<?= ($lang == "id") ? "Saya memotivasi tim, mendelegasikan dengan jelas, dan memberikan dukungan." : "I motivate the team, delegate clearly, and provide support." ?>', correct: true },
                { letter: 'C', text: '<?= ($lang == "id") ? "Saya membiarkan tim bekerja bebas tanpa pengawasan." : "I let the team work freely without supervision." ?>', correct: false },
                { letter: 'D', text: '<?= ($lang == "id") ? "Saya mengambil alih semua tugas penting." : "I take over all important tasks." ?>', correct: false }
            ],
            feedback: '<?= ($lang == "id") ? "Jawaban B menunjukkan kepemimpinan yang efektif dan mendukung. Jawaban A otoriter, C laissez-faire, D micromanagement." : "Answer B shows effective and supportive leadership. Answer A is authoritarian, C is laissez-faire, D is micromanagement." ?>',
            tips: [
                '<?= ($lang == "id") ? "Sesuaikan gaya kepemimpinan dengan situasi" : "Adapt leadership style to the situation" ?>',
                '<?= ($lang == "id") ? "Fokus pada pengembangan tim" : "Focus on team development" ?>',
                '<?= ($lang == "id") ? "Berikan contoh konkret dari pengalaman" : "Provide concrete examples from experience" ?>'
            ]
        },
        {
            id: 9,
            category: '<?= ($lang == "id") ? "Inisiatif" : "Initiative" ?>',
            question: '<?= ($lang == "id") ? "Kapan terakhir kali Anda mengambil inisiatif di tempat kerja?" : "When was the last time you took initiative at work?" ?>',
            answers: [
                { letter: 'A', text: '<?= ($lang == "id") ? "Saya hanya melakukan apa yang diperintahkan." : "I only do what I\'m told." ?>', correct: false },
                { letter: 'B', text: '<?= ($lang == "id") ? "Saya mengusulkan sistem baru yang meningkatkan efisiensi tim sebesar 20%." : "I proposed a new system that increased team efficiency by 20%." ?>', correct: true },
                { letter: 'C', text: '<?= ($lang == "id") ? "Saya mengambil tugas rekan yang tidak hadir." : "I took over tasks from an absent coworker." ?>', correct: false },
                { letter: 'D', text: '<?= ($lang == "id") ? "Saya tidak pernah mengambil inisiatif." : "I never take initiative." ?>', correct: false }
            ],
            feedback: '<?= ($lang == "id") ? "Jawaban B menunjukkan inisiatif proaktif dengan hasil terukur. Jawaban A pasif, C reaktif, D tidak memiliki inisiatif." : "Answer B shows proactive initiative with measurable results. Answer A is passive, C is reactive, D has no initiative." ?>',
            tips: [
                '<?= ($lang == "id") ? "Siapkan contoh konkret dengan hasil" : "Prepare concrete examples with results" ?>',
                '<?= ($lang == "id") ? "Tunjukkan dampak positif dari inisiatif" : "Show positive impact of initiative" ?>',
                '<?= ($lang == "id") ? "Highlight kemampuan identifikasi masalah" : "Highlight problem identification skills" ?>'
            ]
        },
        {
            id: 10,
            category: '<?= ($lang == "id") ? "Pertanyaan Terakhir" : "Final Question" ?>',
            question: '<?= ($lang == "id") ? "Apakah Anda memiliki pertanyaan untuk kami?" : "Do you have any questions for us?" ?>',
            answers: [
                { letter: 'A', text: '<?= ($lang == "id") ? "Tidak, semua sudah jelas." : "No, everything is clear." ?>', correct: false },
                { letter: 'B', text: '<?= ($lang == "id") ? "Bisa ceritakan tentang budaya kerja dan peluang pengembangan di perusahaan ini?" : "Can you tell me about the work culture and development opportunities in this company?" ?>', correct: true },
                { letter: 'C', text: '<?= ($lang == "id") ? "Berapa gaji dan tunjangannya?" : "What is the salary and benefits?" ?>', correct: false },
                { letter: 'D', text: '<?= ($lang == "id") ? "Kapan saya bisa mulai bekerja?" : "When can I start working?" ?>', correct: false }
            ],
            feedback: '<?= ($lang == "id") ? "Jawaban B menunjukkan minat mendalam pada perusahaan. Jawaban A kurang antusias, C terlalu fokus pada materi, D terlalu dini." : "Answer B shows deep interest in the company. Answer A lacks enthusiasm, C is too focused on material, D is too early." ?>',
            tips: [
                '<?= ($lang == "id") ? "Siapkan 2-3 pertanyaan cerdas" : "Prepare 2-3 intelligent questions" ?>',
                '<?= ($lang == "id") ? "Fokus pada perusahaan dan peran" : "Focus on company and role" ?>',
                '<?= ($lang == "id") ? "Tunjukkan minat dan penelitian Anda" : "Show your interest and research" ?>'
            ]
        }
    ];

    // Variabel simulasi
    let currentQuestion = 0;
    let score = 0;
    let userAnswers = [];
    let timeLeft = 600; // 10 menit dalam detik
    let timerInterval;
    let totalQuestions = questions.length;

    // Fungsi untuk memulai timer
    function startTimer() {
        clearInterval(timerInterval);
        updateTimerDisplay();
        
        timerInterval = setInterval(() => {
            timeLeft--;
            updateTimerDisplay();
            
            if (timeLeft <= 60) {
                document.getElementById('countdown').classList.add('timer-warning');
            }
            
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                endSimulation();
            }
        }, 1000);
    }

    function updateTimerDisplay() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        document.getElementById('countdown').textContent = 
            `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }

    // Fungsi untuk memuat pertanyaan
    function loadQuestion(index) {
        const question = questions[index];
        
        // Update display
        document.getElementById('questionNumDisplay').textContent = index + 1;
        document.getElementById('currentQuestion').textContent = index + 1;
        document.getElementById('questionCategory').textContent = question.category;
        document.getElementById('questionTextLarge').textContent = question.question;
        
        // Update progress bar
        const progress = ((index + 1) / totalQuestions) * 100;
        document.getElementById('progressFill').style.width = `${progress}%`;
        document.getElementById('progressPercentage').textContent = `${Math.round(progress)}%`;
        
        // Load jawaban
        const answersGrid = document.getElementById('answersGrid');
        answersGrid.innerHTML = '';
        
        question.answers.forEach(answer => {
            const answerDiv = document.createElement('div');
            answerDiv.className = 'answer-option';
            answerDiv.onclick = () => selectAnswer(answerDiv, answer.letter);
            
            const letterDiv = document.createElement('div');
            letterDiv.className = 'answer-letter-large';
            letterDiv.textContent = answer.letter;
            
            const textDiv = document.createElement('div');
            textDiv.className = 'answer-text';
            textDiv.textContent = answer.text;
            
            answerDiv.appendChild(letterDiv);
            answerDiv.appendChild(textDiv);
            answersGrid.appendChild(answerDiv);
        });
        
        // Reset feedback
        document.getElementById('feedbackSection').classList.remove('show');
        document.getElementById('feedbackContentLarge').textContent = 
            '<?= ($lang == "id") ? "Pilih salah satu jawaban di atas untuk melihat pembahasan..." : "Select one of the answers above to see the analysis..." ?>';
        
        // Update tombol navigasi
        document.getElementById('prevBtn').disabled = index === 0;
        
        if (index === questions.length - 1) {
            document.getElementById('nextBtn').style.display = 'none';
            document.getElementById('finishBtn').style.display = 'flex';
        } else {
            document.getElementById('nextBtn').style.display = 'flex';
            document.getElementById('finishBtn').style.display = 'none';
        }
    }

    // Fungsi untuk memilih jawaban
    function selectAnswer(element, answerLetter) {
        // Hapus semua kelas selected/correct/incorrect
        document.querySelectorAll('.answer-option').forEach(option => {
            option.classList.remove('selected', 'correct', 'incorrect');
        });
        
        // Tambah kelas selected ke opsi yang diklik
        element.classList.add('selected');
        
        // Tampilkan feedback
        const question = questions[currentQuestion];
        const selectedAnswer = question.answers.find(a => a.letter === answerLetter);
        
        // Tandai jawaban benar/salah
        if (selectedAnswer.correct) {
            element.classList.add('correct');
        } else {
            element.classList.add('incorrect');
            // Tampilkan jawaban yang benar
            const correctAnswer = question.answers.find(a => a.correct);
            if (correctAnswer) {
                document.querySelectorAll('.answer-option').forEach(option => {
                    if (option.querySelector('.answer-letter-large').textContent === correctAnswer.letter) {
                        option.classList.add('correct');
                    }
                });
            }
        }
        
        // Update feedback content
        document.getElementById('feedbackContentLarge').textContent = question.feedback;
        
        // Update tips
        const tipsList = document.getElementById('feedbackTipsList');
        tipsList.innerHTML = '';
        question.tips.forEach(tip => {
            const li = document.createElement('li');
            li.textContent = tip;
            tipsList.appendChild(li);
        });
        
        // Tampilkan feedback section
        document.getElementById('feedbackSection').classList.add('show');
        
        // Simpan jawaban user
        userAnswers[currentQuestion] = {
            questionId: question.id,
            answer: answerLetter,
            correct: selectedAnswer.correct
        };
        
        if (selectedAnswer.correct) {
            score++;
        }
        
        // Scroll ke feedback
        document.getElementById('feedbackSection').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    // Fungsi untuk pertanyaan berikutnya
    function nextQuestion() {
        if (currentQuestion < questions.length - 1) {
            currentQuestion++;
            loadQuestion(currentQuestion);
            // Scroll ke atas pertanyaan
            document.getElementById('questionDisplay').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    // Fungsi untuk pertanyaan sebelumnya
    function prevQuestion() {
        if (currentQuestion > 0) {
            currentQuestion--;
            loadQuestion(currentQuestion);
            // Scroll ke atas pertanyaan
            document.getElementById('questionDisplay').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    // Fungsi untuk mengulang pertanyaan
    function resetQuestion() {
        userAnswers[currentQuestion] = undefined;
        loadQuestion(currentQuestion);
        // Scroll ke atas pertanyaan
        document.getElementById('questionDisplay').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // Fungsi untuk menyelesaikan simulasi
    function finishSimulation() {
        endSimulation();
    }

    // Fungsi untuk mengakhiri simulasi
    function endSimulation() {
        clearInterval(timerInterval);
        
        // Hitung statistik
        const answered = userAnswers.filter(answer => answer !== undefined).length;
        const correct = userAnswers.filter(answer => answer && answer.correct).length;
        const incorrect = answered - correct;
        const percentage = totalQuestions > 0 ? Math.round((correct / totalQuestions) * 100) : 0;
        
        // Update hasil
        document.getElementById('finalScore').textContent = percentage;
        document.getElementById('totalQuestions').textContent = totalQuestions;
        document.getElementById('correctAnswers').textContent = correct;
        document.getElementById('incorrectAnswers').textContent = incorrect;
        document.getElementById('percentageScore').textContent = `${percentage}%`;
        
        // Format waktu tersisa
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        document.getElementById('timeRemaining').textContent = 
            `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
        // Sembunyikan simulasi, tampilkan hasil
        document.getElementById('mulai-simulasi').style.display = 'none';
        document.getElementById('resultSection').style.display = 'block';
        
        // Scroll ke hasil
        document.getElementById('resultSection').scrollIntoView({ behavior: 'smooth' });
    }

    // Fungsi untuk restart simulasi
    function restartSimulation() {
        currentQuestion = 0;
        score = 0;
        userAnswers = [];
        timeLeft = 600;
        
        // Reset tampilan
        document.getElementById('resultSection').style.display = 'none';
        document.getElementById('mulai-simulasi').style.display = 'block';
        document.getElementById('countdown').classList.remove('timer-warning');
        
        // Mulai ulang
        loadQuestion(0);
        startTimer();
        
        // Scroll ke simulasi
        document.getElementById('mulai-simulasi').scrollIntoView({ behavior: 'smooth' });
    }

    // Fungsi untuk download sertifikat (placeholder)
    function downloadCertificate() {
        alert('<?= ($lang == "id") ? "Fitur download sertifikat akan tersedia setelah login!" : "Certificate download feature will be available after login!" ?>');
    }

    // Fungsi untuk preview (section pertama)
    function selectAnswer(element, answer) {
        document.querySelectorAll('.answer-options li').forEach(li => {
            li.classList.remove('selected');
        });
        
        element.classList.add('selected');
        
        const feedbackCard = document.getElementById('feedbackCard');
        feedbackCard.classList.add('show');
        
        const feedbackText = document.getElementById('feedbackText');
        
        const feedbacks = {
            'A': '<?= ($lang == "id") ? "Jawaban ini terlalu sederhana dan fokus pada pencapaian akademik semata." : "This answer is too simple and focuses only on academic achievements." ?>',
            'B': '<?= ($lang == "id") ? "Jawaban terbaik! Anda menunjukkan pengalaman konkret dan menghubungkan dengan kebutuhan perusahaan." : "Best answer! You show concrete experience and connect with company needs." ?>',
            'C': '<?= ($lang == "id") ? "Jawaban ini terlalu pendek dan tidak profesional." : "This answer is too brief and unprofessional." ?>'
        };
        
        feedbackText.textContent = feedbacks[answer];
    }

    // Inisialisasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        loadQuestion(0);
        startTimer();
    });
</script>

<?= $this->endSection(); ?>