<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<?php
$lang = session()->get('lang') ?? 'id';

// Data dummy untuk webprofile
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
    'title' => ($lang == 'id') ? 'Smart Job Matching' : 'Smart Job Matching',
    'meta_description' => ($lang == 'id') ? 'Sistem pintar yang menghubungkan Anda dengan peluang kerja terbaik.' : 'Smart system connecting you with the best job opportunities.',
    'webprofile' => [$profile]
]);
?>

<style>
    /* ===================================================
       Smart Job Matching Page - MODERN DESIGN
       =================================================== */

    .matching-hero {
        background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-dark) 100%);
        /* Coffee Bean gradient */
        color: white;
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
    }

    .matching-hero::before {
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

    .matching-hero-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
    }

    .hero-badge-job {
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

    .hero-title-job {
        font-family: "Poetsen One", sans-serif;
        font-size: 3.5rem;
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 25px;
        color: white;
    }

    .hero-subtitle-job {
        font-size: 1.8rem;
        font-weight: 300;
        line-height: 1.4;
        margin-bottom: 40px;
        color: rgba(255, 255, 255, 0.95);
        max-width: 800px;
    }

    .hero-features-job {
        list-style: none;
        padding: 0;
        margin: 0 0 40px 0;
    }

    .hero-features-job li {
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px;
        font-size: 1.1rem;
        line-height: 1.6;
        color: white;
    }

    .hero-features-job li::before {
        content: '⚡';
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

    .cta-button-job {
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

    .cta-button-job:hover {
        background: var(--c-accent-light);
        /* Light Caramel */
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(217, 154, 108, 0.4);
        /* Light Bronze shadow */
        color: white;
    }

    /* How It Works Section */
    .how-it-works {
        padding: 80px 0;
        background: var(--c-background);
        /* Soft Apricot */
    }

    .section-title {
        font-family: "Poetsen One", sans-serif;
        font-size: 2.8rem;
        text-align: center;
        color: var(--c-text);
        /* Deep Cocoa */
        margin-bottom: 20px;
    }

    .section-subtitle {
        text-align: center;
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto 50px;
        line-height: 1.6;
    }

    .steps-container {
        display: flex;
        justify-content: center;
        gap: 40px;
        margin-top: 50px;
        flex-wrap: wrap;
    }

    .step-card {
        flex: 1;
        min-width: 250px;
        max-width: 300px;
        background: var(--c-white);
        /* Pure White */
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(111, 78, 55, 0.08);
        /* Coffee Bean shadow */
        position: relative;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .step-card:hover {
        transform: translateY(-10px);
        border-color: var(--c-accent);
        /* Light Bronze */
        box-shadow: 0 20px 40px rgba(217, 154, 108, 0.15);
        /* Light Bronze shadow */
    }

    .step-number {
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 40px;
        background: var(--c-accent);
        /* Light Bronze */
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .step-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--c-primary), var(--c-primary-dark));
        /* Coffee Bean gradient */
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        font-size: 2.5rem;
        color: white;
    }

    .step-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--c-text);
        /* Deep Cocoa */
        margin-bottom: 15px;
    }

    .step-description {
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
        line-height: 1.6;
        font-size: 1rem;
    }

    /* Matching Form Section */
    .matching-form-section {
        padding: 80px 0;
        background: var(--c-white);
        /* Pure White */
    }

    .matching-form-container {
        max-width: 800px;
        margin: 0 auto;
        background: var(--c-white);
        /* Pure White */
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 15px 40px rgba(111, 78, 55, 0.1);
        /* Coffee Bean shadow */
        border: 1px solid rgba(111, 78, 55, 0.1);
        /* Coffee Bean border */
    }

    .form-title {
        text-align: center;
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--c-text);
        /* Deep Cocoa */
        margin-bottom: 40px;
    }

    /* Form Groups */
    .form-group-job {
        margin-bottom: 30px;
    }

    .form-label {
        display: block;
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--c-text);
        /* Deep Cocoa */
        margin-bottom: 10px;
    }

    .form-input {
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

    .form-input:focus {
        outline: none;
        border-color: var(--c-accent);
        /* Light Bronze */
        background: var(--c-white);
        /* Pure White */
        box-shadow: 0 0 0 3px rgba(217, 154, 108, 0.1);
        /* Light Bronze shadow */
    }

    /* Skills Tags */
    .skills-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .skill-tag {
        background: rgba(236, 177, 118, 0.2);
        /* Light Caramel dengan opacity */
        color: var(--c-text);
        /* Deep Cocoa */
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .skill-tag:hover {
        background: rgba(236, 177, 118, 0.3);
        /* Light Caramel dengan opacity lebih tinggi */
        transform: scale(1.05);
    }

    .skill-tag.selected {
        background: var(--c-accent);
        /* Light Bronze */
        color: white;
    }

    .skill-tag .remove-skill {
        font-size: 0.8rem;
        opacity: 0.7;
    }

    .skill-tag.selected .remove-skill {
        color: white;
        opacity: 1;
    }

    /* Experience Slider */
    .experience-slider {
        padding: 20px 0;
    }

    .slider-container {
        position: relative;
        padding: 20px 0;
    }

    .slider-track {
        height: 6px;
        background: rgba(111, 78, 55, 0.1);
        /* Coffee Bean dengan opacity */
        border-radius: 3px;
        position: relative;
    }

    .slider-fill {
        position: absolute;
        height: 100%;
        background: linear-gradient(90deg, var(--c-accent), var(--c-accent-light));
        /* Light Bronze ke Light Caramel */
        border-radius: 3px;
    }

    .slider-thumb {
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 24px;
        height: 24px;
        background: var(--c-accent);
        /* Light Bronze */
        border: 3px solid var(--c-white);
        /* Pure White */
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(111, 78, 55, 0.2);
        /* Coffee Bean shadow */
        cursor: pointer;
        z-index: 2;
    }

    .slider-labels {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
        font-size: 0.9rem;
    }

    /* Job Cards */
    .job-results-section {
        padding: 80px 0;
        background: linear-gradient(135deg, rgba(111, 78, 55, 0.06) 0%, rgba(90, 62, 44, 0.06) 100%);
        /* Coffee Bean gradient dengan opacity */
        display: none;
    }

    .results-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--c-text);
        /* Deep Cocoa */
        margin-bottom: 40px;
        text-align: center;
    }

    .job-cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
        margin-top: 30px;
    }

    .job-card {
        background: var(--c-white);
        /* Pure White */
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(111, 78, 55, 0.08);
        /* Coffee Bean shadow */
        transition: all 0.3s ease;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .job-card:hover {
        transform: translateY(-10px);
        border-color: var(--c-accent);
        /* Light Bronze */
        box-shadow: 0 20px 40px rgba(217, 154, 108, 0.15);
        /* Light Bronze shadow */
    }

    .job-card.featured {
        border: 2px solid var(--c-accent-light);
        /* Light Caramel */
    }

    .featured-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--c-accent-light);
        /* Light Caramel */
        color: white;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .job-header {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 20px;
    }

    .company-logo {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--c-primary), var(--c-primary-dark));
        /* Coffee Bean gradient */
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        font-weight: bold;
        flex-shrink: 0;
    }

    .job-info {
        flex: 1;
    }

    .job-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--c-text);
        /* Deep Cocoa */
        margin-bottom: 5px;
    }

    .company-name {
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .job-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 15px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
        font-size: 0.9rem;
    }

    .meta-item i {
        color: var(--c-accent);
        /* Light Bronze */
    }

    .job-skills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 20px 0;
    }

    .job-skill {
        background: rgba(236, 177, 118, 0.2);
        /* Light Caramel dengan opacity */
        color: var(--c-text);
        /* Deep Cocoa */
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .job-match {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid rgba(111, 78, 55, 0.1);
        /* Coffee Bean border */
    }

    .match-percentage {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--c-accent);
        /* Light Bronze */
    }

    .match-label {
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
        font-size: 0.9rem;
    }

    .apply-btn {
        background: var(--c-accent);
        /* Light Bronze */
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .apply-btn:hover {
        background: var(--c-accent-light);
        /* Light Caramel */
        transform: translateY(-2px);
    }

    /* Loading Animation */
    .loading-container {
        display: none;
        text-align: center;
        padding: 40px;
    }

    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 5px solid rgba(111, 78, 55, 0.1);
        /* Coffee Bean dengan opacity */
        border-top-color: var(--c-accent);
        /* Light Bronze */
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 20px;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Match Score */
    .match-score-container {
        text-align: center;
        padding: 40px;
        background: var(--c-white);
        /* Pure White */
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(111, 78, 55, 0.08);
        /* Coffee Bean shadow */
        margin-bottom: 40px;
        display: none;
    }

    .match-score-circle {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: conic-gradient(var(--c-accent) 0% 85%, rgba(111, 78, 55, 0.1) 85% 100%);
        /* Light Bronze gradient */
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        position: relative;
    }

    .match-score-inner {
        width: 120px;
        height: 120px;
        background: var(--c-white);
        /* Pure White */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .match-score-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--c-accent);
        /* Light Bronze */
    }

    .match-score-label {
        color: var(--c-text-light);
        /* Deep Cocoa lebih terang */
        font-size: 0.9rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .matching-hero {
            padding: 60px 0 50px;
        }

        .hero-title-job {
            font-size: 2.5rem;
        }

        .hero-subtitle-job {
            font-size: 1.4rem;
        }

        .section-title {
            font-size: 2.2rem;
        }

        .steps-container {
            flex-direction: column;
            align-items: center;
        }

        .step-card {
            max-width: 100%;
        }

        .matching-form-container {
            padding: 30px 20px;
        }

        .form-title {
            font-size: 1.8rem;
        }

        .job-cards-container {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .hero-title-job {
            font-size: 2rem;
        }

        .hero-subtitle-job {
            font-size: 1.2rem;
        }

        .cta-button-job {
            padding: 14px 30px;
            font-size: 1rem;
        }

        .section-title {
            font-size: 1.8rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="matching-hero">
    <div class="matching-hero-content">
        <span class="hero-badge-job" id="heroBadge">AI-Powered Matching</span>
        
        <h1 class="hero-title-job" id="heroTitle">Smart Job Matching</h1>
        
        <p class="hero-subtitle-job" id="heroSubtitle">
            Sistem pintar yang menghubungkan Anda dengan peluang kerja terbaik berdasarkan skill, pengalaman, dan preferensi karir Anda.
        </p>
        
        <ul class="hero-features-job" id="heroFeatures">
            <li><strong>Algoritma matching cerdas</strong> dengan akurasi tinggi</li>
            <li><strong>Rekomendasi pekerjaan</strong> yang relevan dengan profil Anda</li>
            <li><strong>Notifikasi real-time</strong> untuk lowongan terbaru</li>
            <li><strong>Akses eksklusif</strong> ke perusahaan partner berkualitas</li>
        </ul>
        
        <button class="cta-button-job" onclick="startMatching()" id="ctaButton">
            Mulai Matching Sekarang
        </button>
    </div>
</section>

<!-- How It Works -->
<section class="how-it-works">
    <div class="container">
        <h2 class="section-title" id="howItWorksTitle">Cara Kerja Sistem</h2>
        <p class="section-subtitle" id="howItWorksSubtitle">
            Temukan pekerjaan impian Anda dalam 3 langkah mudah
        </p>
        
        <div class="steps-container">
            <!-- Step 1 -->
            <div class="step-card">
                <div class="step-number">1</div>
                <div class="step-icon">
                    <i class="fas fa-user-edit"></i>
                </div>
                <h3 class="step-title" id="step1Title">Buat Profil</h3>
                <p class="step-description" id="step1Desc">
                    Isi informasi skill, pengalaman, dan preferensi karir Anda. Sistem akan menganalisis profil Anda secara mendalam.
                </p>
            </div>
            
            <!-- Step 2 -->
            <div class="step-card">
                <div class="step-number">2</div>
                <div class="step-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <h3 class="step-title" id="step2Title">AI Matching</h3>
                <p class="step-description" id="step2Desc">
                    Algoritma AI kami akan mencocokkan profil Anda dengan ribuan lowongan kerja berdasarkan kecocokan terbaik.
                </p>
            </div>
            
            <!-- Step 3 -->
            <div class="step-card">
                <div class="step-number">3</div>
                <div class="step-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3 class="step-title" id="step3Title">Dapatkan Pekerjaan</h3>
                <p class="step-description" id="step3Desc">
                    Terima rekomendasi pekerjaan yang sesuai dan langsung terhubung dengan perusahaan yang merekrut.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Matching Form -->
<section class="matching-form-section" id="matchingForm">
    <div class="container">
        <div class="matching-form-container">
            <h2 class="form-title" id="formTitle">Profil Karir Anda</h2>
            
            <!-- Form Input -->
            <div class="form-group-job">
                <label class="form-label" for="jobTitle">Posisi yang Dicari *</label>
                <input type="text" id="jobTitle" class="form-input" placeholder="Contoh: Frontend Developer, Marketing Manager, etc.">
            </div>
            
            <div class="form-group-job">
                <label class="form-label">Level Pengalaman *</label>
                <div class="experience-slider">
                    <div class="slider-container">
                        <div class="slider-track">
                            <div class="slider-fill" id="sliderFill"></div>
                            <div class="slider-thumb" id="sliderThumb"></div>
                        </div>
                        <div class="slider-labels">
                            <span>Fresh Graduate</span>
                            <span>1-2 Tahun</span>
                            <span>3-5 Tahun</span>
                            <span>6-10 Tahun</span>
                            <span>10+ Tahun</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group-job">
                <label class="form-label">Keahlian (Skills) *</label>
                <input type="text" id="skillInput" class="form-input" placeholder="Ketik skill dan tekan Enter (contoh: JavaScript, Photoshop, etc.)">
                <div class="skills-container" id="skillsContainer">
                    <!-- Skills akan ditambahkan di sini -->
                </div>
            </div>
            
            <div class="form-group-job">
                <label class="form-label" for="industry">Industri yang Diminati</label>
                <select id="industry" class="form-input">
                    <option value="">Pilih Industri</option>
                    <option value="tech">Teknologi & IT</option>
                    <option value="finance">Keuangan & Perbankan</option>
                    <option value="marketing">Marketing & Digital</option>
                    <option value="healthcare">Kesehatan</option>
                    <option value="education">Pendidikan</option>
                    <option value="manufacturing">Manufaktur</option>
                    <option value="retail">Retail & E-commerce</option>
                </select>
            </div>
            
            <div class="form-group-job">
                <label class="form-label" for="location">Lokasi Preferensi</label>
                <input type="text" id="location" class="form-input" placeholder="Contoh: Jakarta, Remote, Bandung, etc.">
            </div>
            
            <div class="form-group-job">
                <label class="form-label" for="salary">Ekspektasi Gaji (IDR)</label>
                <input type="text" id="salary" class="form-input" placeholder="Contoh: 8.000.000 - 12.000.000">
            </div>
            
            <div class="text-center mt-4">
                <button class="cta-button-job" onclick="findMatchingJobs()" id="findJobsBtn">
                    <i class="fas fa-search me-2"></i>Cari Pekerjaan Tepat
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Loading State -->
<div class="loading-container" id="loadingContainer">
    <div class="loading-spinner"></div>
    <h3 style="color: var(--c-text); margin-bottom: 10px;">Mencari Pekerjaan Terbaik...</h3>
    <p style="color: var(--c-text-light);">Algoritma AI kami sedang menganalisis profil Anda</p>
</div>

<!-- Match Score -->
<div class="container match-score-container" id="matchScoreContainer">
    <h2 style="color: var(--c-text); margin-bottom: 30px;">Tingkat Kecocokan Profil</h2>
    <div class="match-score-circle">
        <div class="match-score-inner">
            <div class="match-score-value" id="matchScore">85%</div>
            <div class="match-score-label">Match Score</div>
        </div>
    </div>
    <p style="color: var(--c-text-light); max-width: 500px; margin: 20px auto;">
        Profil Anda cocok dengan <strong id="jobCount">12</strong> lowongan pekerjaan berdasarkan skill dan pengalaman.
    </p>
</div>

<!-- Job Results -->
<section class="job-results-section" id="jobResults">
    <div class="container">
        <h2 class="results-title" id="resultsTitle">Rekomendasi Untuk Anda</h2>
        
        <div class="job-cards-container" id="jobCardsContainer">
            <!-- Job cards akan diisi oleh JavaScript -->
        </div>
        
        <div class="text-center mt-5">
            <button class="cta-button-job" onclick="loadMoreJobs()" id="loadMoreBtn">
                <i class="fas fa-sync-alt me-2"></i>Tampilkan Lebih Banyak
            </button>
        </div>
    </div>
</section>

<!-- Companies Section -->
<section class="how-it-works" style="background: var(--c-white);">
    <div class="container">
        <h2 class="section-title">Perusahaan Partner Kami</h2>
        <p class="section-subtitle">
            Terhubung dengan perusahaan-perusahaan terkemuka yang mencari talenta seperti Anda
        </p>
        
        <div class="steps-container" style="margin-top: 30px;">
            <div class="step-card" style="min-width: 200px;">
                <div class="company-logo" style="background: linear-gradient(135deg, #FF6B6B, #FF8E53);">G</div>
                <h3 class="step-title">Gojek</h3>
                <p class="step-description">Perusahaan teknologi terkemuka di Indonesia</p>
            </div>
            
            <div class="step-card" style="min-width: 200px;">
                <div class="company-logo" style="background: linear-gradient(135deg, var(--c-primary), var(--c-primary-dark));">T</div>
                <h3 class="step-title">Tokopedia</h3>
                <p class="step-description">Platform e-commerce terbesar di Indonesia</p>
            </div>
            
            <div class="step-card" style="min-width: 200px;">
                <div class="company-logo" style="background: linear-gradient(135deg, var(--c-accent), var(--c-accent-light));">B</div>
                <h3 class="step-title">Bank Mandiri</h3>
                <p class="step-description">Bank terbesar di Indonesia</p>
            </div>
            
            <div class="step-card" style="min-width: 200px;">
                <div class="company-logo" style="background: linear-gradient(135deg, var(--c-secondary), #8C6B51);">U</div>
                <h3 class="step-title">Unilever</h3>
                <p class="step-description">Perusahaan consumer goods global</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="how-it-works" style="background: linear-gradient(135deg, var(--c-primary), var(--c-primary-dark));">
    <div class="container text-center">
        <h2 class="section-title" style="color: var(--c-white);">Siap Berkarir Lebih Baik?</h2>
        
        <p class="section-subtitle" style="color: rgba(255, 255, 255, 0.9); max-width: 600px;">
            Daftar sekarang untuk mendapatkan akses ke lowongan eksklusif dan notifikasi real-time
        </p>
        
        <div class="mt-5">
            <button class="cta-button-job" onclick="registerForUpdates()" style="background: var(--c-white); color: var(--c-primary); margin-right: 15px;">
                <i class="fas fa-bell me-2"></i>Daftar Notifikasi
            </button>
            <button class="cta-button-job" onclick="uploadCV()" style="background: transparent; border: 2px solid var(--c-white); color: var(--c-white);">
                <i class="fas fa-upload me-2"></i>Upload CV
            </button>
        </div>
    </div>
</section>

<script>
    // ==================== VARIABLES ====================
    let userSkills = [];
    let sliderValue = 2; // Default: 3-5 tahun
    let currentJobs = [];
    let displayedJobs = 3;
    
    // ==================== INITIALIZATION ====================
    document.addEventListener('DOMContentLoaded', function() {
        setupExperienceSlider();
        setupSkillInput();
        
        // Check language
        const lang = '<?= $lang ?>';
        if (lang === 'en') {
            translateToEnglish();
        }
        
        // Auto-scroll to form when CTA clicked
        window.startMatching = function() {
            document.getElementById('matchingForm').scrollIntoView({ 
                behavior: 'smooth' 
            });
            document.getElementById('jobTitle').focus();
        };
    });
    
    // ==================== TRANSLATION ====================
    function translateToEnglish() {
        // Hero Section
        document.getElementById('heroBadge').textContent = 'AI-Powered Matching';
        document.getElementById('heroTitle').textContent = 'Smart Job Matching';
        document.getElementById('heroSubtitle').textContent = 'Smart system connecting you with the best job opportunities based on your skills, experience, and career preferences.';
        
        const heroFeatures = document.getElementById('heroFeatures');
        heroFeatures.innerHTML = `
            <li><strong>Intelligent matching algorithm</strong> with high accuracy</li>
            <li><strong>Job recommendations</strong> relevant to your profile</li>
            <li><strong>Real-time notifications</strong> for new vacancies</li>
            <li><strong>Exclusive access</strong> to quality partner companies</li>
        `;
        
        document.getElementById('ctaButton').textContent = 'Start Matching Now';
        
        // How It Works
        document.getElementById('howItWorksTitle').textContent = 'How It Works';
        document.getElementById('howItWorksSubtitle').textContent = 'Find your dream job in 3 easy steps';
        
        document.getElementById('step1Title').textContent = 'Create Profile';
        document.getElementById('step1Desc').textContent = 'Fill in your skills, experience, and career preferences. Our system will analyze your profile in depth.';
        
        document.getElementById('step2Title').textContent = 'AI Matching';
        document.getElementById('step2Desc').textContent = 'Our AI algorithm will match your profile with thousands of job vacancies based on the best fit.';
        
        document.getElementById('step3Title').textContent = 'Get Hired';
        document.getElementById('step3Desc').textContent = 'Receive suitable job recommendations and connect directly with hiring companies.';
        
        // Form Section
        document.getElementById('formTitle').textContent = 'Your Career Profile';
        
        // Update form labels
        document.querySelector('label[for="jobTitle"]').textContent = 'Desired Position *';
        document.querySelector('#jobTitle').placeholder = 'Example: Frontend Developer, Marketing Manager, etc.';
        
        document.querySelector('label[for="industry"]').textContent = 'Preferred Industry';
        document.querySelector('#industry option[value=""]').textContent = 'Select Industry';
        document.querySelector('#industry option[value="tech"]').textContent = 'Technology & IT';
        document.querySelector('#industry option[value="finance"]').textContent = 'Finance & Banking';
        document.querySelector('#industry option[value="marketing"]').textContent = 'Marketing & Digital';
        document.querySelector('#industry option[value="healthcare"]').textContent = 'Healthcare';
        document.querySelector('#industry option[value="education"]').textContent = 'Education';
        document.querySelector('#industry option[value="manufacturing"]').textContent = 'Manufacturing';
        document.querySelector('#industry option[value="retail"]').textContent = 'Retail & E-commerce';
        
        document.querySelector('label[for="location"]').textContent = 'Preferred Location';
        document.querySelector('#location').placeholder = 'Example: Jakarta, Remote, Bandung, etc.';
        
        document.querySelector('label[for="salary"]').textContent = 'Salary Expectation (IDR)';
        document.querySelector('#salary').placeholder = 'Example: 8,000,000 - 12,000,000';
        
        document.querySelector('label[for="skillInput"]').textContent = 'Skills *';
        document.querySelector('#skillInput').placeholder = 'Type skill and press Enter (example: JavaScript, Photoshop, etc.)';
        
        document.querySelector('.slider-labels').innerHTML = `
            <span>Fresh Graduate</span>
            <span>1-2 Years</span>
            <span>3-5 Years</span>
            <span>6-10 Years</span>
            <span>10+ Years</span>
        `;
        
        document.getElementById('findJobsBtn').innerHTML = '<i class="fas fa-search me-2"></i>Find Matching Jobs';
        
        // Results Section
        document.getElementById('resultsTitle').textContent = 'Recommendations For You';
        
        document.getElementById('loadMoreBtn').innerHTML = '<i class="fas fa-sync-alt me-2"></i>Show More';
    }
    
    // ==================== EXPERIENCE SLIDER ====================
    function setupExperienceSlider() {
        const sliderTrack = document.querySelector('.slider-track');
        const sliderThumb = document.getElementById('sliderThumb');
        const sliderFill = document.getElementById('sliderFill');
        
        // Set initial position
        updateSliderPosition(sliderValue);
        
        // Mouse drag functionality
        let isDragging = false;
        
        sliderThumb.addEventListener('mousedown', (e) => {
            isDragging = true;
            document.addEventListener('mousemove', onMouseMove);
            document.addEventListener('mouseup', onMouseUp);
        });
        
        function onMouseMove(e) {
            if (!isDragging) return;
            
            const rect = sliderTrack.getBoundingClientRect();
            let x = e.clientX - rect.left;
            x = Math.max(0, Math.min(x, rect.width));
            
            const percentage = x / rect.width;
            sliderValue = Math.round(percentage * 4); // 0 to 4
            
            updateSliderPosition(sliderValue);
        }
        
        function onMouseUp() {
            isDragging = false;
            document.removeEventListener('mousemove', onMouseMove);
            document.removeEventListener('mouseup', onMouseUp);
        }
        
        // Click on track
        sliderTrack.addEventListener('click', (e) => {
            const rect = sliderTrack.getBoundingClientRect();
            let x = e.clientX - rect.left;
            x = Math.max(0, Math.min(x, rect.width));
            
            const percentage = x / rect.width;
            sliderValue = Math.round(percentage * 4);
            
            updateSliderPosition(sliderValue);
        });
        
        // Touch events for mobile
        sliderThumb.addEventListener('touchstart', (e) => {
            isDragging = true;
            document.addEventListener('touchmove', onTouchMove);
            document.addEventListener('touchend', onTouchEnd);
        });
        
        function onTouchMove(e) {
            if (!isDragging) return;
            
            const rect = sliderTrack.getBoundingClientRect();
            let x = e.touches[0].clientX - rect.left;
            x = Math.max(0, Math.min(x, rect.width));
            
            const percentage = x / rect.width;
            sliderValue = Math.round(percentage * 4);
            
            updateSliderPosition(sliderValue);
        }
        
        function onTouchEnd() {
            isDragging = false;
            document.removeEventListener('touchmove', onTouchMove);
            document.removeEventListener('touchend', onTouchEnd);
        }
    }
    
    function updateSliderPosition(value) {
        const percentage = (value / 4) * 100;
        const sliderThumb = document.getElementById('sliderThumb');
        const sliderFill = document.getElementById('sliderFill');
        
        sliderThumb.style.left = `${percentage}%`;
        sliderFill.style.width = `${percentage}%`;
        
        // Update experience labels
        const experiences = ['Fresh Graduate', '1-2 Tahun', '3-5 Tahun', '6-10 Tahun', '10+ Tahun'];
        if ('<?= $lang ?>' === 'en') {
            const experiencesEN = ['Fresh Graduate', '1-2 Years', '3-5 Years', '6-10 Years', '10+ Years'];
            sliderValue = value;
        }
    }
    
    // ==================== SKILLS MANAGEMENT ====================
    function setupSkillInput() {
        const skillInput = document.getElementById('skillInput');
        const skillsContainer = document.getElementById('skillsContainer');
        
        skillInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const skill = skillInput.value.trim();
                if (skill && !userSkills.includes(skill)) {
                    addSkill(skill);
                    skillInput.value = '';
                }
            }
        });
        
        // Initial skills
        const initialSkills = ['JavaScript', 'HTML/CSS', 'Communication', 'Project Management'];
        initialSkills.forEach(skill => addSkill(skill));
    }
    
    function addSkill(skill) {
        userSkills.push(skill);
        
        const skillsContainer = document.getElementById('skillsContainer');
        const skillTag = document.createElement('div');
        skillTag.className = 'skill-tag';
        skillTag.innerHTML = `
            ${skill}
            <span class="remove-skill" onclick="removeSkill('${skill}')">×</span>
        `;
        
        skillsContainer.appendChild(skillTag);
    }
    
    function removeSkill(skill) {
        userSkills = userSkills.filter(s => s !== skill);
        renderSkills();
    }
    
    function renderSkills() {
        const skillsContainer = document.getElementById('skillsContainer');
        skillsContainer.innerHTML = '';
        
        userSkills.forEach(skill => {
            const skillTag = document.createElement('div');
            skillTag.className = 'skill-tag';
            skillTag.innerHTML = `
                ${skill}
                <span class="remove-skill" onclick="removeSkill('${skill}')">×</span>
            `;
            skillsContainer.appendChild(skillTag);
        });
    }
    
    // ==================== JOB MATCHING ALGORITHM ====================
    function findMatchingJobs() {
        const jobTitle = document.getElementById('jobTitle').value;
        const industry = document.getElementById('industry').value;
        const location = document.getElementById('location').value;
        
        // Validation
        if (!jobTitle || userSkills.length === 0) {
            alert('<?= $lang == "id" ? "Harap isi posisi yang dicari dan keahlian minimal 1 skill." : "Please fill in desired position and at least 1 skill." ?>');
            return;
        }
        
        // Show loading
        document.getElementById('loadingContainer').style.display = 'block';
        document.getElementById('jobResults').style.display = 'none';
        document.getElementById('matchScoreContainer').style.display = 'none';
        
        // Simulate API call
        setTimeout(() => {
            // Generate job matches based on input
            const matchedJobs = generateJobMatches(jobTitle, industry, location);
            currentJobs = matchedJobs;
            displayedJobs = 3;
            
            // Calculate match score
            const matchScore = calculateMatchScore(matchedJobs);
            
            // Hide loading, show results
            document.getElementById('loadingContainer').style.display = 'none';
            document.getElementById('matchScoreContainer').style.display = 'block';
            document.getElementById('jobResults').style.display = 'block';
            
            // Update match score
            document.getElementById('matchScore').textContent = `${matchScore}%`;
            document.getElementById('jobCount').textContent = matchedJobs.length;
            
            // Display jobs
            displayJobs(matchedJobs.slice(0, displayedJobs));
            
            // Scroll to results
            document.getElementById('matchScoreContainer').scrollIntoView({ 
                behavior: 'smooth' 
            });
        }, 1500);
    }
    
    function calculateMatchScore(jobs) {
        if (jobs.length === 0) return 0;
        
        // Simple algorithm: average of top 3 matches
        const topMatches = jobs.slice(0, 3);
        const total = topMatches.reduce((sum, job) => sum + job.matchPercentage, 0);
        return Math.round(total / Math.min(3, jobs.length));
    }
    
    function generateJobMatches(jobTitle, industry, location) {
        // Sample job database
        const allJobs = [
            {
                id: 1,
                title: 'Frontend Developer',
                company: 'Tech Startup Indonesia',
                logo: 'T',
                industry: 'tech',
                location: 'Jakarta',
                salary: 'Rp 10-15 juta',
                experience: '3-5 Tahun',
                type: 'Full-time',
                skills: ['JavaScript', 'React', 'HTML/CSS', 'Vue.js'],
                matchPercentage: 92,
                featured: true
            },
            {
                id: 2,
                title: 'Digital Marketing Specialist',
                company: 'E-commerce Platform',
                logo: 'E',
                industry: 'marketing',
                location: 'Remote',
                salary: 'Rp 8-12 juta',
                experience: '2-4 Tahun',
                type: 'Full-time',
                skills: ['Digital Marketing', 'SEO', 'Social Media', 'Analytics'],
                matchPercentage: 85,
                featured: true
            },
            {
                id: 3,
                title: 'Data Analyst',
                company: 'Fintech Company',
                logo: 'F',
                industry: 'finance',
                location: 'Jakarta',
                salary: 'Rp 12-18 juta',
                experience: '3-5 Tahun',
                type: 'Full-time',
                skills: ['Python', 'SQL', 'Data Visualization', 'Statistics'],
                matchPercentage: 78,
                featured: false
            },
            {
                id: 4,
                title: 'UX Designer',
                company: 'Design Agency',
                logo: 'D',
                industry: 'tech',
                location: 'Bandung',
                salary: 'Rp 9-14 juta',
                experience: '2-5 Tahun',
                type: 'Contract',
                skills: ['UI/UX', 'Figma', 'Prototyping', 'User Research'],
                matchPercentage: 88,
                featured: false
            },
            {
                id: 5,
                title: 'Project Manager',
                company: 'Consulting Firm',
                logo: 'C',
                industry: 'consulting',
                location: 'Jakarta',
                salary: 'Rp 15-25 juta',
                experience: '5-8 Tahun',
                type: 'Full-time',
                skills: ['Project Management', 'Agile', 'Leadership', 'Communication'],
                matchPercentage: 82,
                featured: true
            },
            {
                id: 6,
                title: 'Backend Developer',
                company: 'Banking Technology',
                logo: 'B',
                industry: 'finance',
                location: 'Jakarta',
                salary: 'Rp 13-20 juta',
                experience: '4-7 Tahun',
                type: 'Full-time',
                skills: ['Java', 'Spring Boot', 'Microservices', 'AWS'],
                matchPercentage: 75,
                featured: false
            },
            {
                id: 7,
                title: 'Content Writer',
                company: 'Media Company',
                logo: 'M',
                industry: 'media',
                location: 'Remote',
                salary: 'Rp 6-10 juta',
                experience: '1-3 Tahun',
                type: 'Freelance',
                skills: ['Writing', 'SEO', 'Content Strategy', 'Editing'],
                matchPercentage: 90,
                featured: false
            },
            {
                id: 8,
                title: 'HR Specialist',
                company: 'Manufacturing Group',
                logo: 'H',
                industry: 'manufacturing',
                location: 'Surabaya',
                salary: 'Rp 8-13 juta',
                experience: '3-6 Tahun',
                type: 'Full-time',
                skills: ['Recruitment', 'HR Management', 'Communication', 'Training'],
                matchPercentage: 80,
                featured: false
            }
        ];
        
        // Filter jobs based on user input
        let filteredJobs = allJobs.filter(job => {
            // Match by job title (basic keyword matching)
            const titleMatch = jobTitle.toLowerCase().split(' ').some(word => 
                job.title.toLowerCase().includes(word)
            );
            
            // Match by industry if specified
            const industryMatch = !industry || job.industry === industry;
            
            // Match by location if specified
            const locationMatch = !location || 
                job.location.toLowerCase().includes(location.toLowerCase()) ||
                (location.toLowerCase() === 'remote' && job.location === 'Remote');
            
            return titleMatch && industryMatch && locationMatch;
        });
        
        // Calculate match percentage for each job
        filteredJobs.forEach(job => {
            const skillMatch = calculateSkillMatch(job.skills);
            const experienceMatch = calculateExperienceMatch(job.experience);
            
            // Weighted average: 70% skill match, 30% experience match
            job.matchPercentage = Math.round((skillMatch * 0.7) + (experienceMatch * 0.3));
        });
        
        // Sort by match percentage (highest first)
        filteredJobs.sort((a, b) => b.matchPercentage - a.matchPercentage);
        
        return filteredJobs;
    }
    
    function calculateSkillMatch(jobSkills) {
        if (userSkills.length === 0) return 0;
        
        const matchedSkills = jobSkills.filter(skill => 
            userSkills.some(userSkill => 
                userSkill.toLowerCase().includes(skill.toLowerCase()) ||
                skill.toLowerCase().includes(userSkill.toLowerCase())
            )
        );
        
        return Math.round((matchedSkills.length / jobSkills.length) * 100);
    }
    
    function calculateExperienceMatch(jobExperience) {
        const experienceMap = {
            'Fresh Graduate': 0,
            '1-2 Tahun': 1,
            '3-5 Tahun': 2,
            '6-10 Tahun': 3,
            '10+ Tahun': 4
        };
        
        if ('<?= $lang ?>' === 'en') {
            experienceMap['Fresh Graduate'] = 0;
            experienceMap['1-2 Years'] = 1;
            experienceMap['3-5 Years'] = 2;
            experienceMap['6-10 Years'] = 3;
            experienceMap['10+ Years'] = 4;
        }
        
        const jobExpLevel = experienceMap[jobExperience] || 2;
        const diff = Math.abs(jobExpLevel - sliderValue);
        
        // Calculate match percentage based on difference
        return Math.max(0, 100 - (diff * 25));
    }
    
    // ==================== DISPLAY JOBS ====================
    function displayJobs(jobs) {
        const container = document.getElementById('jobCardsContainer');
        container.innerHTML = '';
        
        jobs.forEach(job => {
            const jobCard = createJobCard(job);
            container.appendChild(jobCard);
        });
        
        // Update load more button visibility
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        loadMoreBtn.style.display = displayedJobs >= currentJobs.length ? 'none' : 'block';
    }
    
    function createJobCard(job) {
        const card = document.createElement('div');
        card.className = `job-card ${job.featured ? 'featured' : ''}`;
        
        let featuredBadge = '';
        if (job.featured) {
            featuredBadge = '<div class="featured-badge">Featured</div>';
        }
        
        const skillsHTML = job.skills.map(skill => 
            `<span class="job-skill">${skill}</span>`
        ).join('');
        
        card.innerHTML = `
            ${featuredBadge}
            <div class="job-header">
                <div class="company-logo">${job.logo}</div>
                <div class="job-info">
                    <h3 class="job-title">${job.title}</h3>
                    <p class="company-name">${job.company}</p>
                    <div class="job-meta">
                        <span class="meta-item">
                            <i class="fas fa-map-marker-alt"></i> ${job.location}
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-money-bill-wave"></i> ${job.salary}
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-briefcase"></i> ${job.type}
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="job-skills">
                ${skillsHTML}
            </div>
            
            <div class="job-match">
                <div>
                    <div class="match-percentage">${job.matchPercentage}%</div>
                    <div class="match-label">Match</div>
                </div>
                <button class="apply-btn" onclick="applyForJob(${job.id})">
                    <i class="fas fa-paper-plane me-2"></i>Apply Now
                </button>
            </div>
        `;
        
        return card;
    }
    
    function loadMoreJobs() {
        displayedJobs += 3;
        displayJobs(currentJobs.slice(0, displayedJobs));
    }
    
    // ==================== UTILITY FUNCTIONS ====================
    function applyForJob(jobId) {
        const job = currentJobs.find(j => j.id === jobId);
        alert(`<?= $lang == "id" ? "Berhasil apply untuk" : "Successfully applied for" ?>: ${job.title} at ${job.company}`);
        
        // In real implementation, this would redirect to application page
        // window.location.href = `/apply/${jobId}`;
    }
    
    function registerForUpdates() {
        const email = prompt('<?= $lang == "id" ? "Masukkan email Anda untuk notifikasi lowongan:" : "Enter your email for job notifications:" ?>');
        if (email) {
            alert(`<?= $lang == "id" ? "Terima kasih! Anda akan menerima notifikasi lowongan terbaru." : "Thank you! You will receive notifications for new job openings." ?>`);
        }
    }
    
    function uploadCV() {
        alert('<?= $lang == "id" ? "Fitur upload CV akan segera tersedia!" : "CV upload feature coming soon!" ?>');
        
        // In real implementation:
        // const input = document.createElement('input');
        // input.type = 'file';
        // input.accept = '.pdf,.doc,.docx';
        // input.onchange = handleCVUpload;
        // input.click();
    }
</script>

<?= $this->endSection(); ?>