<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<?php
$lang = session()->get('lang') ?? 'id';

$profile = [
    'logo_web' => 'logo.png',
    'nohp_web' => '+62 812-3456-7890',
    'email_web' => 'info@komunitasekspor.com',
    'link_ig_web' => '#',
    'link_yt_web' => '#',
    'link_fb_web' => '#',
    'deskripsi_web' => 'Komunitas Ekspor Indonesia membantu pengusaha untuk berkembang.',
    'deskripsi_web_en' => 'Indonesian Export Community helps entrepreneurs to grow.',
    'alamat_web' => 'Jakarta, Indonesia'
];

$this->setData([
    'title' => ($lang == 'id') ? 'Position Fit Evaluation' : 'Position Fit Evaluation',
    'meta_description' => ($lang == 'id') ? 'Evaluasi kesesuaian posisi yang membantu memahami seberapa baik Anda cocok dengan peran yang ditawarkan.' : 'Position fit evaluation to understand how well you match with the offered role.',
    'webprofile' => [$profile]
]);
?>

<style>
    /* ===================================================
       Position Fit Evaluation - PROFESSIONAL DESIGN
       =================================================== */

    .fit-evaluation-hero {
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        /* Coffee Bean gradient */
        color: white;
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
    }

    .fit-evaluation-hero::before {
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

    .fit-hero-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
    }

    .hero-badge-fit {
        display: inline-block;
        background: var(--c-accent);
        /* Light Bronze */
        color: white;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 20px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .hero-title-fit {
        font-family: "Poetsen One", sans-serif;
        font-size: 3.5rem;
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 25px;
        color: white;
    }

    .hero-subtitle-fit {
        font-size: 1.8rem;
        font-weight: 300;
        line-height: 1.4;
        margin-bottom: 40px;
        color: rgba(255, 255, 255, 0.95);
        max-width: 800px;
    }

    .hero-features-fit {
        list-style: none;
        padding: 0;
        margin: 0 0 40px 0;
    }

    .hero-features-fit li {
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px;
        font-size: 1.1rem;
        line-height: 1.6;
        color: white;
    }

    .hero-features-fit li::before {
        content: '✓';
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        background: rgba(255, 255, 255, 0.2);
        color: var(--c-accent);
        /* Light Bronze */
        border-radius: 50%;
        margin-right: 12px;
        flex-shrink: 0;
        font-weight: bold;
        font-size: 0.9rem;
    }

    .cta-button-fit {
        display: inline-block;
        background: var(--c-accent);
        /* Light Bronze */
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

    .cta-button-fit:hover {
        background: var(--c-accent-light);
        /* Light Caramel */
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(217, 154, 108, 0.4);
        /* Light Bronze shadow */
        color: white;
    }

    /* Evaluation Process */
    .evaluation-process {
        padding: 80px 0;
        background: var(--c-background);
        /* Soft Apricot */
    }

    .section-title-fit {
        font-family: "Poetsen One", sans-serif;
        font-size: 2.8rem;
        text-align: center;
        color: var(--c-text);
        /* Deep Cocoa */
        margin-bottom: 20px;
    }

    .section-subtitle-fit {
        text-align: center;
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto 50px;
        line-height: 1.6;
    }

    /* Progress Steps */
    .progress-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin: 50px auto;
        max-width: 800px;
    }

    .progress-steps::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 4px;
        background: rgba(111, 78, 55, 0.1);
        /* Coffee Bean dengan opacity */
        transform: translateY(-50%);
        z-index: 1;
    }

    .progress-bar-fit {
        position: absolute;
        top: 50%;
        left: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--c-accent), var(--c-accent-light));
        /* Light Bronze ke Light Caramel */
        transform: translateY(-50%);
        z-index: 2;
        transition: width 0.5s ease;
    }

    .step {
        position: relative;
        z-index: 3;
        text-align: center;
        width: 100px;
    }

    .step-circle {
        width: 50px;
        height: 50px;
        background: var(--c-white);
        /* Pure White */
        border: 4px solid rgba(111, 78, 55, 0.1);
        /* Coffee Bean border */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
        margin: 0 auto 15px;
        transition: all 0.3s ease;
    }

    .step.active .step-circle {
        background: var(--c-accent);
        /* Light Bronze */
        border-color: var(--c-accent);
        /* Light Bronze */
        color: white;
        transform: scale(1.1);
    }

    .step.completed .step-circle {
        background: var(--c-accent-light);
        /* Light Caramel */
        border-color: var(--c-accent-light);
        /* Light Caramel */
        color: white;
    }

    .step-label {
        font-size: 0.9rem;
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
        font-weight: 500;
    }

    .step.active .step-label {
        color: var(--c-text);
        /* Deep Cocoa */
        font-weight: 600;
    }

    /* Evaluation Sections */
    .evaluation-section {
        display: none;
        padding: 40px;
        background: var(--c-white);
        /* Pure White */
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(111, 78, 55, 0.08);
        /* Coffee Bean shadow */
        margin: 30px auto;
        max-width: 900px;
        border: 1px solid rgba(111, 78, 55, 0.05);
        /* Coffee Bean border */
    }

    .evaluation-section.active {
        display: block;
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .section-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .section-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--c-accent), var(--c-accent-light));
        /* Light Bronze ke Light Caramel */
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2.5rem;
        color: white;
    }

    .section-heading {
        font-size: 2rem;
        font-weight: 700;
        color: var(--c-text);
        /* Deep Cocoa */
        margin-bottom: 10px;
    }

    .section-description {
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Form Elements */
    .evaluation-form {
        max-width: 700px;
        margin: 0 auto;
    }

    .form-group-fit {
        margin-bottom: 30px;
    }

    .form-label-fit {
        display: block;
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--c-text);
        /* Deep Cocoa */
        margin-bottom: 15px;
    }

    .form-input-fit {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid rgba(111, 78, 55, 0.1);
        /* Coffee Bean border */
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: var(--c-background);
        /* Soft Apricot */
        color: var(--c-text);
        /* Deep Cocoa */
    }

    .form-input-fit:focus {
        outline: none;
        border-color: var(--c-accent);
        /* Light Bronze */
        background: var(--c-white);
        /* Pure White */
        box-shadow: 0 0 0 3px rgba(217, 154, 108, 0.1);
        /* Light Bronze shadow */
    }

    /* Skill Evaluation Grid */
    .skill-evaluation-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .skill-card {
        background: var(--c-background);
        /* Soft Apricot */
        border-radius: 12px;
        padding: 20px;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .skill-card:hover {
        border-color: var(--c-accent);
        /* Light Bronze */
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(217, 154, 108, 0.1);
        /* Light Bronze shadow */
    }

    .skill-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .skill-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--c-text);
        /* Deep Cocoa */
    }

    .skill-importance {
        font-size: 0.9rem;
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
        font-weight: 500;
    }

    .skill-rating {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .rating-option {
        flex: 1;
        text-align: center;
    }

    .rating-input {
        display: none;
    }

    .rating-label {
        display: block;
        padding: 8px;
        background: rgba(111, 78, 55, 0.1);
        /* Coffee Bean dengan opacity */
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.9rem;
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
    }

    .rating-input:checked + .rating-label {
        background: var(--c-accent);
        /* Light Bronze */
        color: white;
        font-weight: 600;
    }

    /* Personality Assessment */
    .personality-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .trait-card {
        background: var(--c-background);
        /* Soft Apricot */
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .trait-card:hover {
        border-color: var(--c-accent);
        /* Light Bronze */
        transform: translateY(-5px);
    }

    .trait-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--c-accent), var(--c-accent-light));
        /* Light Bronze ke Light Caramel */
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 1.8rem;
        color: white;
    }

    .trait-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--c-text);
        /* Deep Cocoa */
        margin-bottom: 10px;
    }

    .trait-slider {
        width: 100%;
        height: 8px;
        background: rgba(111, 78, 55, 0.1);
        /* Coffee Bean dengan opacity */
        border-radius: 4px;
        margin: 15px 0;
        position: relative;
    }

    .trait-slider-fill {
        position: absolute;
        height: 100%;
        background: linear-gradient(90deg, var(--c-accent), var(--c-accent-light));
        /* Light Bronze ke Light Caramel */
        border-radius: 4px;
        width: 50%;
    }

    .trait-labels {
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
    }

    /* Results Section */
    .results-section {
        padding: 80px 0;
        background: linear-gradient(135deg, rgba(111, 78, 55, 0.06) 0%, rgba(90, 62, 44, 0.06) 100%);
        /* Coffee Bean gradient dengan opacity */
        display: none;
    }

    .results-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .fit-score-card {
        background: var(--c-white);
        /* Pure White */
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 20px 40px rgba(111, 78, 55, 0.1);
        /* Coffee Bean shadow */
        text-align: center;
        margin-bottom: 50px;
        position: relative;
        overflow: hidden;
    }

    .fit-score-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--c-accent), var(--c-accent-light));
        /* Light Bronze ke Light Caramel */
    }

    .fit-score-display {
        width: 200px;
        height: 200px;
        margin: 0 auto 30px;
        position: relative;
    }

    .fit-score-circle {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: conic-gradient(var(--c-accent) 0% 75%, rgba(111, 78, 55, 0.1) 75% 100%);
        /* Light Bronze gradient */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .fit-score-inner {
        width: 160px;
        height: 160px;
        background: var(--c-white);
        /* Pure White */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .fit-score-value {
        font-size: 3.5rem;
        font-weight: 700;
        color: var(--c-accent);
        /* Light Bronze */
        line-height: 1;
    }

    .fit-score-label {
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
        font-size: 1rem;
        margin-top: 5px;
    }

    .fit-category {
        font-size: 1.2rem;
        color: var(--c-text);
        /* Deep Cocoa */
        font-weight: 600;
        margin: 20px 0;
    }

    .fit-description {
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Breakdown Cards */
    .breakdown-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .breakdown-card {
        background: var(--c-white);
        /* Pure White */
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 20px rgba(111, 78, 55, 0.05);
        /* Coffee Bean shadow */
        transition: all 0.3s ease;
        border-left: 4px solid var(--c-accent);
        /* Light Bronze */
    }

    .breakdown-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 30px rgba(217, 154, 108, 0.1);
        /* Light Bronze shadow */
    }

    .breakdown-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .breakdown-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--c-accent), var(--c-accent-light));
        /* Light Bronze ke Light Caramel */
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }

    .breakdown-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--c-text);
        /* Deep Cocoa */
    }

    .breakdown-score {
        font-size: 2rem;
        font-weight: 700;
        color: var(--c-accent);
        /* Light Bronze */
        text-align: center;
        margin: 15px 0;
    }

    .breakdown-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .breakdown-list li {
        padding: 10px 0;
        border-bottom: 1px solid rgba(111, 78, 55, 0.1);
        /* Coffee Bean border */
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .breakdown-list li:last-child {
        border-bottom: none;
    }

    .skill-match {
        font-weight: 600;
        color: var(--c-text);
        /* Deep Cocoa */
    }

    /* Development Recommendations */
    .recommendations-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 25px;
        margin-top: 40px;
    }

    .recommendation-card {
        background: var(--c-white);
        /* Pure White */
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 10px 20px rgba(111, 78, 55, 0.05);
        /* Coffee Bean shadow */
        transition: all 0.3s ease;
        text-align: center;
        border: 2px solid transparent;
    }

    .recommendation-card:hover {
        border-color: var(--c-accent-light);
        /* Light Caramel */
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(236, 177, 118, 0.1);
        /* Light Caramel shadow */
    }

    .recommendation-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--c-accent), var(--c-accent-light));
        /* Light Bronze ke Light Caramel */
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 1.8rem;
        color: white;
    }

    .recommendation-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--c-text);
        /* Deep Cocoa */
        margin-bottom: 10px;
    }

    .recommendation-desc {
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* Navigation Buttons */
    .evaluation-nav {
        display: flex;
        justify-content: space-between;
        margin-top: 50px;
        padding-top: 30px;
        border-top: 1px solid rgba(111, 78, 55, 0.1);
        /* Coffee Bean border */
    }

    .nav-btn {
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-prev-fit {
        background: transparent;
        border-color: rgba(111, 78, 55, 0.2);
        /* Coffee Bean border */
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
    }

    .btn-prev-fit:hover {
        background: rgba(111, 78, 55, 0.05);
        /* Coffee Bean dengan opacity */
        border-color: rgba(111, 78, 55, 0.3);
        /* Coffee Bean border */
        transform: translateY(-2px);
    }

    .btn-next-fit {
        background: var(--c-accent);
        /* Light Bronze */
        color: white;
        box-shadow: 0 4px 12px rgba(217, 154, 108, 0.2);
        /* Light Bronze shadow */
    }

    .btn-next-fit:hover {
        background: var(--c-accent-light);
        /* Light Caramel */
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(217, 154, 108, 0.3);
        /* Light Bronze shadow */
    }

    .btn-finish-fit {
        background: var(--c-accent-light);
        /* Light Caramel */
        color: white;
        box-shadow: 0 4px 12px rgba(236, 177, 118, 0.2);
        /* Light Caramel shadow */
    }

    .btn-finish-fit:hover {
        background: var(--c-accent);
        /* Light Bronze */
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(236, 177, 118, 0.3);
        /* Light Caramel shadow */
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .fit-evaluation-hero {
            padding: 60px 0 50px;
        }

        .hero-title-fit {
            font-size: 2.5rem;
        }

        .hero-subtitle-fit {
            font-size: 1.4rem;
        }

        .section-title-fit {
            font-size: 2.2rem;
        }

        .progress-steps {
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .progress-steps::before {
            display: none;
        }

        .progress-bar-fit {
            display: none;
        }

        .evaluation-section {
            padding: 30px 20px;
        }

        .skill-evaluation-grid,
        .personality-grid,
        .breakdown-grid,
        .recommendations-grid {
            grid-template-columns: 1fr;
        }

        .fit-score-card {
            padding: 30px 20px;
        }

        .fit-score-display {
            width: 150px;
            height: 150px;
        }

        .fit-score-inner {
            width: 120px;
            height: 120px;
        }

        .fit-score-value {
            font-size: 2.5rem;
        }

        .evaluation-nav {
            flex-direction: column;
            gap: 15px;
        }

        .nav-btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .hero-title-fit {
            font-size: 2rem;
        }

        .hero-subtitle-fit {
            font-size: 1.2rem;
        }

        .cta-button-fit {
            padding: 14px 30px;
            font-size: 1rem;
        }

        .section-title-fit {
            font-size: 1.8rem;
        }

        .section-heading {
            font-size: 1.5rem;
        }

        .step {
            width: 80px;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="fit-evaluation-hero">
    <div class="fit-hero-content">
        <span class="hero-badge-fit" id="heroBadge">Professional Assessment</span>
        
        <h1 class="hero-title-fit" id="heroTitle">Position Fit Evaluation</h1>
        
        <p class="hero-subtitle-fit" id="heroSubtitle">
            Evaluasi kesesuaian posisi yang membantu Anda dan perusahaan memahami seberapa baik Anda cocok dengan peran yang ditawarkan.
        </p>
        
        <ul class="hero-features-fit" id="heroFeatures">
            <li><strong>Analisis kesesuaian skill</strong> dengan kebutuhan posisi</li>
            <li><strong>Prediksi performa</strong> berdasarkan karakteristik pribadi</li>
            <li><strong>Rekomendasi pengembangan</strong> kompetensi yang dibutuhkan</li>
            <li><strong>Laporan komprehensif</strong> untuk pengambilan keputusan</li>
        </ul>
        
        <button class="cta-button-fit" onclick="startEvaluation()" id="ctaButton">
            Mulai Evaluasi
        </button>
    </div>
</section>

<!-- Progress Steps -->
<section class="evaluation-process">
    <div class="container">
        <h2 class="section-title-fit" id="processTitle">Proses Evaluasi</h2>
        <p class="section-subtitle-fit" id="processSubtitle">
            Ikuti 4 langkah evaluasi komprehensif untuk memahami kesesuaian Anda dengan posisi
        </p>
        
        <div class="progress-steps">
            <div class="progress-bar-fit" id="progressBarFit" style="width: 25%;"></div>
            
            <div class="step active" id="step1">
                <div class="step-circle">1</div>
                <div class="step-label" id="step1Label">Informasi Posisi</div>
            </div>
            
            <div class="step" id="step2">
                <div class="step-circle">2</div>
                <div class="step-label" id="step2Label">Evaluasi Skill</div>
            </div>
            
            <div class="step" id="step3">
                <div class="step-circle">3</div>
                <div class="step-label" id="step3Label">Assessment Kepribadian</div>
            </div>
            
            <div class="step" id="step4">
                <div class="step-circle">4</div>
                <div class="step-label" id="step4Label">Hasil & Rekomendasi</div>
            </div>
        </div>
        
        <!-- Step 1: Position Information -->
        <div class="evaluation-section active" id="section1">
            <div class="section-header">
                <div class="section-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h2 class="section-heading" id="section1Title">Informasi Posisi</h2>
                <p class="section-description" id="section1Desc">
                    Masukkan detail posisi yang ingin Anda evaluasi untuk analisis yang lebih akurat
                </p>
            </div>
            
            <div class="evaluation-form">
                <div class="form-group-fit">
                    <label class="form-label-fit" for="positionTitle">Nama Posisi *</label>
                    <input type="text" id="positionTitle" class="form-input-fit" placeholder="Contoh: Frontend Developer, Marketing Manager, etc.">
                </div>
                
                <div class="form-group-fit">
                    <label class="form-label-fit" for="companyName">Nama Perusahaan</label>
                    <input type="text" id="companyName" class="form-input-fit" placeholder="Nama perusahaan (opsional)">
                </div>
                
                <div class="form-group-fit">
                    <label class="form-label-fit" for="positionLevel">Level Posisi *</label>
                    <select id="positionLevel" class="form-input-fit">
                        <option value="">Pilih Level</option>
                        <option value="entry">Entry Level / Fresh Graduate</option>
                        <option value="junior">Junior (1-3 Tahun)</option>
                        <option value="mid">Mid-Level (3-7 Tahun)</option>
                        <option value="senior">Senior (7+ Tahun)</option>
                        <option value="lead">Lead / Manager</option>
                        <option value="director">Director / Executive</option>
                    </select>
                </div>
                
                <div class="form-group-fit">
                    <label class="form-label-fit" for="jobDescription">Deskripsi Pekerjaan</label>
                    <textarea id="jobDescription" class="form-input-fit" rows="4" placeholder="Masukkan deskripsi pekerjaan atau tanggung jawab utama..."></textarea>
                </div>
            </div>
            
            <div class="evaluation-nav">
                <div></div> <!-- Empty div for spacing -->
                <button class="nav-btn btn-next-fit" onclick="nextSection(2)">
                    Lanjut ke Evaluasi Skill <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
        
        <!-- Step 2: Skills Evaluation -->
        <div class="evaluation-section" id="section2">
            <div class="section-header">
                <div class="section-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <h2 class="section-heading" id="section2Title">Evaluasi Keterampilan</h2>
                <p class="section-description" id="section2Desc">
                    Evaluasi tingkat kemahiran Anda pada skill yang dibutuhkan untuk posisi ini
                </p>
            </div>
            
            <div class="skill-evaluation-grid" id="skillsEvaluationGrid">
                <!-- Skill cards will be generated by JavaScript -->
            </div>
            
            <div class="form-group-fit" style="margin-top: 30px;">
                <label class="form-label-fit">Tambahkan Skill Lainnya</label>
                <div style="display: flex; gap: 10px;">
                    <input type="text" id="customSkillInput" class="form-input-fit" placeholder="Ketik skill baru..." style="flex: 1;">
                    <button class="cta-button-fit" onclick="addCustomSkill()" style="padding: 12px 20px; font-size: 0.9rem;">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
            </div>
            
            <div class="evaluation-nav">
                <button class="nav-btn btn-prev-fit" onclick="prevSection(1)">
                    <i class="fas fa-arrow-left"></i> Kembali
                </button>
                <button class="nav-btn btn-next-fit" onclick="nextSection(3)">
                    Lanjut ke Assessment Kepribadian <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
        
        <!-- Step 3: Personality Assessment -->
        <div class="evaluation-section" id="section3">
            <div class="section-header">
                <div class="section-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <h2 class="section-heading" id="section3Title">Assessment Kepribadian</h2>
                <p class="section-description" id="section3Desc">
                    Nilai karakteristik pribadi yang relevan dengan posisi dan lingkungan kerja
                </p>
            </div>
            
            <div class="personality-grid" id="personalityGrid">
                <!-- Personality traits will be generated by JavaScript -->
            </div>
            
            <div class="evaluation-nav">
                <button class="nav-btn btn-prev-fit" onclick="prevSection(2)">
                    <i class="fas fa-arrow-left"></i> Kembali
                </button>
                <button class="nav-btn btn-finish-fit" onclick="generateResults()">
                    <i class="fas fa-chart-bar"></i> Lihat Hasil Evaluasi
                </button>
            </div>
        </div>
        
        <!-- Loading State -->
        <div class="loading-container" id="loadingContainer" style="display: none;">
            <div class="loading-spinner"></div>
            <h3 style="color: #1F2937; margin-bottom: 10px;">Menganalisis Hasil...</h3>
            <p style="color: #6B7280;">Sistem kami sedang menghitung tingkat kesesuaian Anda dengan posisi</p>
        </div>
    </div>
</section>

<!-- Results Section -->
<section class="results-section" id="resultsSection">
    <div class="results-container">
        <!-- Fit Score -->
        <div class="fit-score-card">
            <h2 style="color: #1F2937; margin-bottom: 10px;" id="resultsTitle">Hasil Evaluasi Kesesuaian Posisi</h2>
            <p style="color: #6B7280; margin-bottom: 30px;" id="positionInfo"></p>
            
            <div class="fit-score-display">
                <div class="fit-score-circle">
                    <div class="fit-score-inner">
                        <div class="fit-score-value" id="fitScoreValue">75%</div>
                        <div class="fit-score-label">Match Score</div>
                    </div>
                </div>
            </div>
            
            <div class="fit-category" id="fitCategory">Sangat Sesuai</div>
            <p class="fit-description" id="fitDescription">
                Profil Anda menunjukkan kecocokan yang sangat baik dengan persyaratan posisi. Anda memiliki kompetensi dan karakteristik yang dibutuhkan untuk sukses dalam peran ini.
            </p>
        </div>
        
        <!-- Breakdown Analysis -->
        <h3 style="color: #1F2937; font-size: 1.8rem; margin-bottom: 30px; text-align: center;">Analisis Detail</h3>
        
        <div class="breakdown-grid">
            <!-- Skill Match -->
            <div class="breakdown-card">
                <div class="breakdown-header">
                    <div class="breakdown-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="breakdown-title">Kesesuaian Skill</div>
                </div>
                <div class="breakdown-score" id="skillMatchScore">85%</div>
                <ul class="breakdown-list" id="skillMatchList">
                    <!-- Skill matches will be populated here -->
                </ul>
            </div>
            
            <!-- Personality Fit -->
            <div class="breakdown-card">
                <div class="breakdown-header">
                    <div class="breakdown-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <div class="breakdown-title">Kesesuaian Kepribadian</div>
                </div>
                <div class="breakdown-score" id="personalityMatchScore">70%</div>
                <ul class="breakdown-list" id="personalityMatchList">
                    <!-- Personality matches will be populated here -->
                </ul>
            </div>
            
            <!-- Experience Level -->
            <div class="breakdown-card">
                <div class="breakdown-header">
                    <div class="breakdown-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="breakdown-title">Kesesuaian Level</div>
                </div>
                <div class="breakdown-score" id="levelMatchScore">90%</div>
                <ul class="breakdown-list">
                    <li>Level Pengalaman: <span class="skill-match" id="experienceLevelMatch">Sesuai</span></li>
                    <li>Tingkat Kompleksitas: <span class="skill-match" id="complexityMatch">Optimal</span></li>
                    <li>Potensi Pertumbuhan: <span class="skill-match" id="growthMatch">Tinggi</span></li>
                </ul>
            </div>
        </div>
        
        <!-- Development Recommendations -->
        <h3 style="color: #1F2937; font-size: 1.8rem; margin: 50px 0 30px; text-align: center;">Rekomendasi Pengembangan</h3>
        
        <div class="recommendations-grid" id="recommendationsGrid">
            <!-- Recommendations will be populated here -->
        </div>
        
        <!-- Action Buttons -->
        <div style="text-align: center; margin-top: 50px;">
            <button class="cta-button-fit" onclick="downloadReport()" style="margin-right: 15px;">
                <i class="fas fa-download"></i> Unduh Laporan Lengkap
            </button>
            <button class="cta-button-fit" onclick="startNewEvaluation()" style="background: #3B82F6;">
                <i class="fas fa-redo"></i> Evaluasi Posisi Lain
            </button>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="evaluation-process" style="background: white;">
    <div class="container">
        <h2 class="section-title-fit">Manfaat Evaluasi Kesesuaian Posisi</h2>
        <p class="section-subtitle-fit">
            Pahami bagaimana sistem evaluasi kami membantu karir Anda
        </p>
        
        <div class="breakdown-grid" style="margin-top: 50px;">
            <div class="breakdown-card" style="border-left-color: #10B981;">
                <div class="breakdown-header">
                    <div class="breakdown-icon" style="background: linear-gradient(135deg, #10B981, #34D399);">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <div class="breakdown-title">Target Karir yang Jelas</div>
                </div>
                <p style="color: #6B7280; line-height: 1.6;">
                    Identifikasi posisi yang benar-benar sesuai dengan kemampuan dan minat Anda, mengurangi trial-and-error dalam pencarian kerja.
                </p>
            </div>
            
            <div class="breakdown-card" style="border-left-color: #8B5CF6;">
                <div class="breakdown-header">
                    <div class="breakdown-icon" style="background: linear-gradient(135deg, #8B5CF6, #A78BFA);">
                        <i class="fasfa-chart-pie"></i>
                    </div>
                    <div class="breakdown-title">Analisis Data-Driven</div>
                </div>
                <p style="color: #6B7280; line-height: 1.6;">
                    Keputusan berdasarkan data analitik yang akurat, bukan hanya perasaan atau intuisi semata.
                </p>
            </div>
            
            <div class="breakdown-card" style="border-left-color: #F59E0B;">
                <div class="breakdown-header">
                    <div class="breakdown-icon" style="background: linear-gradient(135deg, #F59E0B, #FBBF24);">
                        <i class="fas fa-road"></i>
                    </div>
                    <div class="breakdown-title">Roadmap Pengembangan</div>
                </div>
                <p style="color: #6B7280; line-height: 1.6;">
                    Dapatkan panduan spesifik untuk mengembangkan kompetensi yang masih perlu ditingkatkan.
                </p>
            </div>
        </div>
    </div>
</section>

<script>
    // ==================== GLOBAL VARIABLES ====================
    let currentSection = 1;
    let positionData = {
        title: '',
        company: '',
        level: '',
        description: ''
    };
    
    let skillsData = [];
    let personalityData = [];
    
    // ==================== INITIALIZATION ====================
    document.addEventListener('DOMContentLoaded', function() {
        initializeSkills();
        initializePersonalityTraits();
        
        // Check language
        const lang = '<?= $lang ?>';
        if (lang === 'en') {
            translateToEnglish();
        }
        
        // Set up event listeners for form inputs
        setupFormListeners();
    });
    
    // ==================== TRANSLATION ====================
    function translateToEnglish() {
        // Hero Section
        document.getElementById('heroBadge').textContent = 'Professional Assessment';
        document.getElementById('heroTitle').textContent = 'Position Fit Evaluation';
        document.getElementById('heroSubtitle').textContent = 'Position suitability evaluation that helps you and the company understand how well you fit with the offered role.';
        
        const heroFeatures = document.getElementById('heroFeatures');
        heroFeatures.innerHTML = `
            <li><strong>Skill suitability analysis</strong> with position requirements</li>
            <li><strong>Performance prediction</strong> based on personal characteristics</li>
            <li><strong>Competency development</strong> recommendations</li>
            <li><strong>Comprehensive report</strong> for decision making</li>
        `;
        
        document.getElementById('ctaButton').textContent = 'Start Evaluation';
        
        // Process Title
        document.getElementById('processTitle').textContent = 'Evaluation Process';
        document.getElementById('processSubtitle').textContent = 'Follow 4 comprehensive evaluation steps to understand your suitability for the position';
        
        // Step Labels
        document.getElementById('step1Label').textContent = 'Position Info';
        document.getElementById('step2Label').textContent = 'Skills Evaluation';
        document.getElementById('step3Label').textContent = 'Personality Assessment';
        document.getElementById('step4Label').textContent = 'Results & Recommendations';
        
        // Section 1
        document.getElementById('section1Title').textContent = 'Position Information';
        document.getElementById('section1Desc').textContent = 'Enter details of the position you want to evaluate for more accurate analysis';
        
        // Form Labels
        document.querySelector('label[for="positionTitle"]').textContent = 'Position Name *';
        document.querySelector('#positionTitle').placeholder = 'Example: Frontend Developer, Marketing Manager, etc.';
        
        document.querySelector('label[for="companyName"]').textContent = 'Company Name';
        document.querySelector('#companyName').placeholder = 'Company name (optional)';
        
        document.querySelector('label[for="positionLevel"]').textContent = 'Position Level *';
        const levelSelect = document.querySelector('#positionLevel');
        levelSelect.innerHTML = `
            <option value="">Select Level</option>
            <option value="entry">Entry Level / Fresh Graduate</option>
            <option value="junior">Junior (1-3 Years)</option>
            <option value="mid">Mid-Level (3-7 Years)</option>
            <option value="senior">Senior (7+ Years)</option>
            <option value="lead">Lead / Manager</option>
            <option value="director">Director / Executive</option>
        `;
        
        document.querySelector('label[for="jobDescription"]').textContent = 'Job Description';
        document.querySelector('#jobDescription').placeholder = 'Enter job description or main responsibilities...';
        
        document.querySelector('#section1 .btn-next-fit').innerHTML = 'Continue to Skills Evaluation <i class="fas fa-arrow-right"></i>';
        
        // Section 2
        document.getElementById('section2Title').textContent = 'Skills Evaluation';
        document.getElementById('section2Desc').textContent = 'Evaluate your proficiency level on skills required for this position';
        
        document.querySelector('label[for="customSkillInput"]').textContent = 'Add Other Skills';
        document.querySelector('#customSkillInput').placeholder = 'Type new skill...';
        document.querySelector('#customSkillInput').nextElementSibling.innerHTML = '<i class="fas fa-plus"></i> Add';
        
        document.querySelector('#section2 .btn-prev-fit').innerHTML = '<i class="fas fa-arrow-left"></i> Back';
        document.querySelector('#section2 .btn-next-fit').innerHTML = 'Continue to Personality Assessment <i class="fas fa-arrow-right"></i>';
        
        // Section 3
        document.getElementById('section3Title').textContent = 'Personality Assessment';
        document.getElementById('section3Desc').textContent = 'Rate personal characteristics relevant to the position and work environment';
        
        document.querySelector('#section3 .btn-prev-fit').innerHTML = '<i class="fas fa-arrow-left"></i> Back';
        document.querySelector('#section3 .btn-finish-fit').innerHTML = '<i class="fas fa-chart-bar"></i> View Evaluation Results';
        
        // Initialize skills with English labels
        initializeSkills(true);
        initializePersonalityTraits(true);
    }
    
    // ==================== NAVIGATION FUNCTIONS ====================
    function startEvaluation() {
        document.getElementById('section1').scrollIntoView({ 
            behavior: 'smooth' 
        });
        document.getElementById('positionTitle').focus();
    }
    
    function nextSection(next) {
        // Validate current section
        if (!validateCurrentSection()) {
            return;
        }
        
        // Save current section data
        saveCurrentSectionData();
        
        // Update progress bar
        const progressPercentage = (next - 1) * 25;
        document.getElementById('progressBarFit').style.width = `${progressPercentage}%`;
        
        // Update step indicators
        document.querySelectorAll('.step').forEach(step => {
            step.classList.remove('active');
        });
        
        for (let i = 1; i <= next; i++) {
            if (i < next) {
                document.getElementById(`step${i}`).classList.add('completed');
            } else {
                document.getElementById(`step${i}`).classList.add('active');
            }
        }
        
        // Hide all sections
        document.querySelectorAll('.evaluation-section').forEach(section => {
            section.classList.remove('active');
        });
        
        // Show next section
        document.getElementById(`section${next}`).classList.add('active');
        
        // Scroll to section
        document.getElementById(`section${next}`).scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });
        
        currentSection = next;
    }
    
    function prevSection(prev) {
        // Update progress bar
        const progressPercentage = (prev - 1) * 25;
        document.getElementById('progressBarFit').style.width = `${progressPercentage}%`;
        
        // Update step indicators
        document.querySelectorAll('.step').forEach(step => {
            step.classList.remove('active');
            step.classList.remove('completed');
        });
        
        for (let i = 1; i <= prev; i++) {
            if (i < prev) {
                document.getElementById(`step${i}`).classList.add('completed');
            } else {
                document.getElementById(`step${i}`).classList.add('active');
            }
        }
        
        // Hide all sections
        document.querySelectorAll('.evaluation-section').forEach(section => {
            section.classList.remove('active');
        });
        
        // Show previous section
        document.getElementById(`section${prev}`).classList.add('active');
        
        // Scroll to section
        document.getElementById(`section${prev}`).scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });
        
        currentSection = prev;
    }
    
    function validateCurrentSection() {
        if (currentSection === 1) {
            const positionTitle = document.getElementById('positionTitle').value.trim();
            const positionLevel = document.getElementById('positionLevel').value;
            
            if (!positionTitle) {
                alert('<?= $lang == "id" ? "Harap isi nama posisi." : "Please fill in position name." ?>');
                document.getElementById('positionTitle').focus();
                return false;
            }
            
            if (!positionLevel) {
                alert('<?= $lang == "id" ? "Harap pilih level posisi." : "Please select position level." ?>');
                document.getElementById('positionLevel').focus();
                return false;
            }
        }
        
        if (currentSection === 2) {
            // Check if at least 3 skills are rated
            const ratedSkills = skillsData.filter(skill => skill.rating > 0);
            if (ratedSkills.length < 3) {
                alert('<?= $lang == "id" ? "Harap beri rating untuk minimal 3 keterampilan." : "Please rate at least 3 skills." ?>');
                return false;
            }
        }
        
        return true;
    }
    
    function saveCurrentSectionData() {
        if (currentSection === 1) {
            positionData = {
                title: document.getElementById('positionTitle').value.trim(),
                company: document.getElementById('companyName').value.trim(),
                level: document.getElementById('positionLevel').value,
                description: document.getElementById('jobDescription').value.trim()
            };
        }
    }
    
    // ==================== SKILLS MANAGEMENT ====================
    function initializeSkills(english = false) {
        const skills = english ? [
            { id: 'communication', name: 'Communication', importance: 'High' },
            { id: 'leadership', name: 'Leadership', importance: 'Medium' },
            { id: 'problemsolving', name: 'Problem Solving', importance: 'High' },
            { id: 'teamwork', name: 'Teamwork', importance: 'High' },
            { id: 'adaptability', name: 'Adaptability', importance: 'Medium' },
            { id: 'technical', name: 'Technical Skills', importance: 'High' }
        ] : [
            { id: 'communication', name: 'Komunikasi', importance: 'Tinggi' },
            { id: 'leadership', name: 'Kepemimpinan', importance: 'Sedang' },
            { id: 'problemsolving', name: 'Pemecahan Masalah', importance: 'Tinggi' },
            { id: 'teamwork', name: 'Kerja Tim', importance: 'Tinggi' },
            { id: 'adaptability', name: 'Adaptabilitas', importance: 'Sedang' },
            { id: 'technical', name: 'Keterampilan Teknis', importance: 'Tinggi' }
        ];
        
        skillsData = skills.map(skill => ({
            ...skill,
            rating: 0
        }));
        
        renderSkills();
    }
    
    function renderSkills() {
        const grid = document.getElementById('skillsEvaluationGrid');
        grid.innerHTML = '';
        
        skillsData.forEach(skill => {
            const card = document.createElement('div');
            card.className = 'skill-card';
            
            const ratingOptions = [
                { value: 1, label: '<?= $lang == "id" ? "Pemula" : "Beginner" ?>' },
                { value: 2, label: '<?= $lang == "id" ? "Menengah" : "Intermediate" ?>' },
                { value: 3, label: '<?= $lang == "id" ? "Mahir" : "Advanced" ?>' },
                { value: 4, label: '<?= $lang == "id" ? "Expert" : "Expert" ?>' }
            ];
            
            const ratingInputs = ratingOptions.map(option => `
                <div class="rating-option">
                    <input type="radio" 
                           name="skill_${skill.id}" 
                           value="${option.value}" 
                           id="skill_${skill.id}_${option.value}"
                           ${skill.rating === option.value ? 'checked' : ''}
                           onchange="updateSkillRating('${skill.id}', ${option.value})">
                    <label class="rating-label" for="skill_${skill.id}_${option.value}">
                        ${option.label}
                    </label>
                </div>
            `).join('');
            
            card.innerHTML = `
                <div class="skill-header">
                    <div class="skill-name">${skill.name}</div>
                    <div class="skill-importance">
                        <?= $lang == "id" ? "Penting:" : "Importance:" ?> ${skill.importance}
                    </div>
                </div>
                <div class="skill-rating">
                    ${ratingInputs}
                </div>
                <div style="font-size: 0.8rem; color: #6B7280; text-align: center;">
                    <?= $lang == "id" ? "Pilih tingkat kemahiran" : "Select proficiency level" ?>
                </div>
            `;
            
            grid.appendChild(card);
        });
    }
    
    function updateSkillRating(skillId, rating) {
        const skillIndex = skillsData.findIndex(s => s.id === skillId);
        if (skillIndex !== -1) {
            skillsData[skillIndex].rating = rating;
        }
    }
    
    function addCustomSkill() {
        const input = document.getElementById('customSkillInput');
        const skillName = input.value.trim();
        
        if (!skillName) {
            alert('<?= $lang == "id" ? "Masukkan nama skill." : "Enter skill name." ?>');
            return;
        }
        
        const skillId = skillName.toLowerCase().replace(/\s+/g, '_');
        
        // Check if skill already exists
        if (skillsData.some(s => s.id === skillId)) {
            alert('<?= $lang == "id" ? "Skill sudah ada dalam daftar." : "Skill already in the list." ?>');
            return;
        }
        
        const newSkill = {
            id: skillId,
            name: skillName,
            importance: '<?= $lang == "id" ? "Sedang" : "Medium" ?>',
            rating: 0
        };
        
        skillsData.push(newSkill);
        renderSkills();
        input.value = '';
        
        // Scroll to newly added skill
        setTimeout(() => {
            document.querySelector(`input[name="skill_${skillId}"]`)?.parentElement?.parentElement?.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }, 100);
    }
    
    // ==================== PERSONALITY ASSESSMENT ====================
    function initializePersonalityTraits(english = false) {
        const traits = english ? [
            { id: 'analytical', name: 'Analytical Thinking', low: 'Intuitive', high: 'Analytical' },
            { id: 'detail', name: 'Attention to Detail', low: 'Big Picture', high: 'Detail-Oriented' },
            { id: 'communication', name: 'Communication Style', low: 'Reserved', high: 'Expressive' },
            { id: 'leadership', name: 'Leadership Style', low: 'Collaborative', high: 'Directive' },
            { id: 'adaptability', name: 'Adaptability', low: 'Structured', high: 'Flexible' },
            { id: 'initiative', name: 'Initiative', low: 'Reactive', high: 'Proactive' }
        ] : [
            { id: 'analytical', name: 'Berpikir Analitis', low: 'Intuitif', high: 'Analitis' },
            { id: 'detail', name: 'Perhatian pada Detail', low: 'Big Picture', high: 'Detail-Oriented' },
            { id: 'communication', name: 'Gaya Komunikasi', low: 'Reserved', high: 'Ekspresif' },
            { id: 'leadership', name: 'Gaya Kepemimpinan', low: 'Kolaboratif', high: 'Direktif' },
            { id: 'adaptability', name: 'Adaptabilitas', low: 'Terstruktur', high: 'Fleksibel' },
            { id: 'initiative', name: 'Inisiatif', low: 'Reaktif', high: 'Proaktif' }
        ];
        
        personalityData = traits.map(trait => ({
            ...trait,
            score: 50 // Default middle position
        }));
        
        renderPersonalityTraits();
    }
    
    function renderPersonalityTraits() {
        const grid = document.getElementById('personalityGrid');
        grid.innerHTML = '';
        
        personalityData.forEach(trait => {
            const card = document.createElement('div');
            card.className = 'trait-card';
            
            card.innerHTML = `
                <div class="trait-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="trait-name">${trait.name}</div>
                <div class="trait-slider">
                    <div class="trait-slider-fill" style="width: ${trait.score}%"></div>
                    <input type="range" 
                           min="0" 
                           max="100" 
                           value="${trait.score}" 
                           class="slider-input"
                           oninput="updateTraitScore('${trait.id}', this.value)"
                           style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                </div>
                <div class="trait-labels">
                    <span>${trait.low}</span>
                    <span>${trait.high}</span>
                </div>
            `;
            
            grid.appendChild(card);
        });
    }
    
    function updateTraitScore(traitId, score) {
        const traitIndex = personalityData.findIndex(t => t.id === traitId);
        if (traitIndex !== -1) {
            personalityData[traitIndex].score = parseInt(score);
            
            // Update visual slider
            const sliderFill = document.querySelector(`input[value="${score}"]`).previousElementSibling;
            sliderFill.style.width = `${score}%`;
        }
    }
    
    // ==================== RESULTS GENERATION ====================
    function generateResults() {
        if (!validateCurrentSection()) {
            return;
        }
        
        // Save current section data
        saveCurrentSectionData();
        
        // Show loading
        document.getElementById('loadingContainer').style.display = 'block';
        
        // Simulate processing time
        setTimeout(() => {
            // Calculate scores
            const scores = calculateScores();
            
            // Update progress to step 4
            document.getElementById('progressBarFit').style.width = '100%';
            document.querySelectorAll('.step').forEach(step => {
                step.classList.remove('active');
                step.classList.add('completed');
            });
            
            // Hide evaluation sections and loading
            document.querySelectorAll('.evaluation-section').forEach(section => {
                section.style.display = 'none';
            });
            document.getElementById('loadingContainer').style.display = 'none';
            
            // Show results section
            document.getElementById('resultsSection').style.display = 'block';
            
            // Populate results
            populateResults(scores);
            
            // Scroll to results
            document.getElementById('resultsSection').scrollIntoView({ 
                behavior: 'smooth' 
            });
        }, 2000);
    }
    
    function calculateScores() {
        // Calculate skill match score
        const skillRatings = skillsData.filter(s => s.rating > 0);
        const skillScore = skillRatings.length > 0 ? 
            Math.round((skillRatings.reduce((sum, skill) => sum + skill.rating, 0) / (skillRatings.length * 4)) * 100) : 0;
        
        // Calculate personality match score (based on position level)
        const personalityScore = Math.round(personalityData.reduce((sum, trait) => sum + trait.score, 0) / personalityData.length);
        
        // Calculate level match score (simplified)
        let levelMatchScore = 75; // Default
        
        // Adjust based on position level (simplified logic)
        const levelWeights = {
            'entry': 90,
            'junior': 85,
            'mid': 80,
            'senior': 75,
            'lead': 70,
            'director': 65
        };
        
        if (levelWeights[positionData.level]) {
            levelMatchScore = levelWeights[positionData.level];
        }
        
        // Overall fit score (weighted average)
        const overallScore = Math.round(
            (skillScore * 0.5) + 
            (personalityScore * 0.3) + 
            (levelMatchScore * 0.2)
        );
        
        return {
            overall: overallScore,
            skill: skillScore,
            personality: personalityScore,
            level: levelMatchScore
        };
    }
    
    function populateResults(scores) {
        // Update position info
        const positionInfo = document.getElementById('positionInfo');
        const companyText = positionData.company ? ` at ${positionData.company}` : '';
        positionInfo.textContent = `<?= $lang == "id" ? "Posisi" : "Position" ?>: ${positionData.title}${companyText}`;
        
        // Update fit score
        document.getElementById('fitScoreValue').textContent = `${scores.overall}%`;
        
        // Update fit category
        const fitCategory = document.getElementById('fitCategory');
        let categoryText = '';
        let categoryDescription = '';
        
        if (scores.overall >= 85) {
            categoryText = '<?= $lang == "id" ? "Sangat Sesuai" : "Excellent Fit" ?>';
            categoryDescription = '<?= $lang == "id" ? "Profil Anda menunjukkan kecocokan yang sangat baik dengan persyaratan posisi. Anda memiliki kompetensi dan karakteristik yang dibutuhkan untuk sukses dalam peran ini." : "Your profile shows excellent alignment with position requirements. You have the competencies and characteristics needed to succeed in this role." ?>';
        } else if (scores.overall >= 70) {
            categoryText = '<?= $lang == "id" ? "Sesuai" : "Good Fit" ?>';
            categoryDescription = '<?= $lang == "id" ? "Profil Anda sesuai dengan posisi ini dengan beberapa area pengembangan. Dengan peningkatan di area tertentu, Anda dapat mencapai performa yang optimal." : "Your profile aligns well with this position with some development areas. With improvements in certain areas, you can achieve optimal performance." ?>';
        } else if (scores.overall >= 55) {
            categoryText = '<?= $lang == "id" ? "Cukup Sesuai" : "Moderate Fit" ?>';
            categoryDescription = '<?= $lang == "id" ? "Ada potensi kesesuaian tetapi membutuhkan pengembangan signifikan di beberapa area kunci. Pertimbangkan program pengembangan yang terstruktur." : "There is potential fit but requires significant development in some key areas. Consider a structured development program." ?>';
        } else {
            categoryText = '<?= $lang == "id" ? "Perlu Pengembangan" : "Needs Development" ?>';
            categoryDescription = '<?= $lang == "id" ? "Posisi ini mungkin membutuhkan pengembangan kompetensi yang lebih intensif. Pertimbangkan posisi alternatif atau program pengembangan jangka panjang." : "This position may require more intensive competency development. Consider alternative positions or long-term development programs." ?>';
        }
        
        fitCategory.textContent = categoryText;
        document.getElementById('fitDescription').textContent = categoryDescription;
        
        // Update breakdown scores
        document.getElementById('skillMatchScore').textContent = `${scores.skill}%`;
        document.getElementById('personalityMatchScore').textContent = `${scores.personality}%`;
        document.getElementById('levelMatchScore').textContent = `${scores.level}%`;
        
        // Populate skill matches
        const skillList = document.getElementById('skillMatchList');
        skillList.innerHTML = '';
        
        skillsData.filter(skill => skill.rating > 0).forEach(skill => {
            const li = document.createElement('li');
            const proficiency = getProficiencyText(skill.rating);
            li.innerHTML = `
                ${skill.name}: 
                <span class="skill-match">${proficiency}</span>
            `;
            skillList.appendChild(li);
        });
        
        // Populate personality matches
        const personalityList = document.getElementById('personalityMatchList');
        personalityList.innerHTML = '';
        
        personalityData.forEach(trait => {
            const li = document.createElement('li');
            let traitAssessment = '';
            
            if (trait.score >= 70) {
                traitAssessment = '<?= $lang == "id" ? "Kuat" : "Strong" ?>';
            } else if (trait.score >= 40) {
                traitAssessment = '<?= $lang == "id" ? "Sedang" : "Moderate" ?>';
            } else {
                traitAssessment = '<?= $lang == "id" ? "Perlu Pengembangan" : "Needs Development" ?>';
            }
            
            li.innerHTML = `
                ${trait.name}: 
                <span class="skill-match">${traitAssessment}</span>
            `;
            personalityList.appendChild(li);
        });
        
        // Update level match indicators
        document.getElementById('experienceLevelMatch').textContent = '<?= $lang == "id" ? "Sesuai" : "Appropriate" ?>';
        document.getElementById('complexityMatch').textContent = scores.overall >= 70 ? 
            '<?= $lang == "id" ? "Optimal" : "Optimal" ?>' : 
            '<?= $lang == "id" ? "Moderat" : "Moderate" ?>';
        document.getElementById('growthMatch').textContent = scores.overall >= 80 ? 
            '<?= $lang == "id" ? "Tinggi" : "High" ?>' : 
            '<?= $lang == "id" ? "Sedang" : "Moderate" ?>';
        
        // Generate recommendations
        generateRecommendations(scores);
    }
    
    function getProficiencyText(rating) {
        if ('<?= $lang ?>' === 'en') {
            switch(rating) {
                case 1: return 'Beginner';
                case 2: return 'Intermediate';
                case 3: return 'Advanced';
                case 4: return 'Expert';
                default: return 'Not Rated';
            }
        } else {
            switch(rating) {
                case 1: return 'Pemula';
                case 2: return 'Menengah';
                case 3: return 'Mahir';
                case 4: return 'Expert';
                default: return 'Belum Dinilai';
            }
        }
    }
    
    function generateRecommendations(scores) {
        const recommendationsGrid = document.getElementById('recommendationsGrid');
        recommendationsGrid.innerHTML = '';
        
        const recommendations = [];
        
        // Skill development recommendations
        if (scores.skill < 80) {
            recommendations.push({
                icon: 'fas fa-graduation-cap',
                title: '<?= $lang == "id" ? "Program Pelatihan Skill" : "Skill Training Program" ?>',
                desc: '<?= $lang == "id" ? "Ikuti kursus khusus untuk meningkatkan kompetensi teknis dan soft skill yang dibutuhkan." : "Enroll in specialized courses to improve required technical and soft skills competencies." ?>'
            });
        }
        
        // Personality development
        if (scores.personality < 70) {
            recommendations.push({
                icon: 'fas fa-users',
                title: '<?= $lang == "id" ? "Coaching Kepribadian" : "Personality Coaching" ?>',
                desc: '<?= $lang == "id" ? "Sesi coaching untuk mengembangkan karakteristik kepribadian yang mendukung keberhasilan dalam peran." : "Coaching sessions to develop personality characteristics that support success in the role." ?>'
            });
        }
        
        // Mentorship recommendation
        recommendations.push({
            icon: 'fas fa-user-graduate',
            title: '<?= $lang == "id" ? "Program Mentorship" : "Mentorship Program" ?>',
            desc: '<?= $lang == "id" ? "Cari mentor yang berpengalaman di bidang serupa untuk membimbing pengembangan karir." : "Find an experienced mentor in a similar field to guide career development." ?>'
        });
        
        // Networking recommendation
        recommendations.push({
            icon: 'fas fa-network-wired',
            title: '<?= $lang == "id" ? "Perluas Jaringan Profesional" : "Expand Professional Network" ?>',
            desc: '<?= $lang == "id" ? "Bergabung dengan komunitas profesional dan event industri untuk memperluas koneksi." : "Join professional communities and industry events to expand connections." ?>'
        });
        
        // Practical experience
        recommendations.push({
            icon: 'fas fa-hands-helping',
            title: '<?= $lang == "id" ? "Proyek Praktis" : "Practical Projects" ?>',
            desc: '<?= $lang == "id" ? "Ambil proyek sampingan atau freelance untuk mendapatkan pengalaman praktis." : "Take on side projects or freelance work to gain practical experience." ?>'
        });
        
        // Certification
        recommendations.push({
            icon: 'fas fa-award',
            title: '<?= $lang == "id" ? "Sertifikasi Profesional" : "Professional Certification" ?>',
            desc: '<?= $lang == "id" ? "Dapatkan sertifikasi yang diakui industri untuk meningkatkan kredibilitas dan kompetensi." : "Obtain industry-recognized certifications to enhance credibility and competency." ?>'
        });
        
        // Add recommendations to grid
        recommendations.forEach(rec => {
            const card = document.createElement('div');
            card.className = 'recommendation-card';
            
            card.innerHTML = `
                <div class="recommendation-icon">
                    <i class="${rec.icon}"></i>
                </div>
                <h4 class="recommendation-title">${rec.title}</h4>
                <p class="recommendation-desc">${rec.desc}</p>
            `;
            
            recommendationsGrid.appendChild(card);
        });
    }
    
    // ==================== UTILITY FUNCTIONS ====================
    function setupFormListeners() {
        // Auto-save position title
        document.getElementById('positionTitle').addEventListener('input', function() {
            positionData.title = this.value.trim();
        });
    }
    
    function downloadReport() {
        alert('<?= $lang == "id" ? "Laporan evaluasi akan segera tersedia untuk diunduh!" : "Evaluation report will be available for download soon!" ?>');
        
        // In real implementation, this would generate and download a PDF report
        // window.location.href = `/download-evaluation-report/${positionData.title}`;
    }
    
    function startNewEvaluation() {
        // Reset all data
        currentSection = 1;
        positionData = {
            title: '',
            company: '',
            level: '',
            description: ''
        };
        
        skillsData.forEach(skill => skill.rating = 0);
        personalityData.forEach(trait => trait.score = 50);
        
        // Reset form inputs
        document.getElementById('positionTitle').value = '';
        document.getElementById('companyName').value = '';
        document.getElementById('positionLevel').value = '';
        document.getElementById('jobDescription').value = '';
        
        // Reset progress bar and steps
        document.getElementById('progressBarFit').style.width = '25%';
        document.querySelectorAll('.step').forEach((step, index) => {
            step.classList.remove('active', 'completed');
            if (index === 0) step.classList.add('active');
        });
        
        // Show first section, hide results
        document.querySelectorAll('.evaluation-section').forEach(section => {
            section.style.display = 'none';
        });
        
        document.getElementById('section1').style.display = 'block';
        document.getElementById('section1').classList.add('active');
        document.getElementById('resultsSection').style.display = 'none';
        
        // Re-render skills and personality
        renderSkills();
        renderPersonalityTraits();
        
        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>

<?= $this->endSection(); ?>