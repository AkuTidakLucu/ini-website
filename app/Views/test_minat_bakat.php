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
    'title'            => ($lang == 'id') ? 'Test Minat & Bakat' : 'Interest & Talent Test',
    'meta_description' => ($lang == 'id') ? 'Temukan potensi diri melalui test minat dan bakat psikologi. Identifikasi kecenderungan karir yang sesuai dengan kepribadian Anda.' : 'Discover your potential through psychological interest and talent tests. Identify career tendencies that match your personality.',
    'webprofile'       => [$profile]
]);
?>

<style>
    /* ===================================================
       Test Minat & Bakat Page - FULL VERSION
       =================================================== */

    .test-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
    }

    .test-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #F59E0B, #FBBF24);
        z-index: 1;
    }

    .test-hero-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
    }

    .hero-badge {
        display: inline-block;
        background: #F59E0B;
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
        color: rgba(255, 255, 255, 0.95);
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
        background: #F59E0B;
        color: white;
        border-radius: 50%;
        margin-right: 12px;
        flex-shrink: 0;
        font-weight: bold;
        font-size: 0.9rem;
    }

    .cta-button-large {
        display: inline-block;
        background: #F59E0B;
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
        box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
    }

    .cta-button-large:hover {
        background: #FBBF24;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(245, 158, 11, 0.4);
        color: white;
    }

    /* Test Types Section */
    .types-section {
        padding: 80px 0;
        background: #F9F9F9;
    }

    .types-title {
        font-family: "Poetsen One", sans-serif;
        font-size: 2.8rem;
        text-align: center;
        color: #1F2937;
        margin-bottom: 20px;
    }

    .types-subtitle {
        text-align: center;
        color: #4B5563;
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto 50px;
        line-height: 1.6;
    }

    .types-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 30px;
    }

    .type-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: 1px solid #E5E7EB;
        height: 100%;
    }

    .type-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        border-color: #F59E0B;
    }

    .type-header {
        background: linear-gradient(135deg, #1F2937 0%, #374151 100%);
        padding: 30px;
        text-align: center;
        color: white;
    }

    .type-icon {
        width: 80px;
        height: 80px;
        background: rgba(245, 158, 11, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2.5rem;
        color: #F59E0B;
    }

    .type-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0 0 10px 0;
        color: white;
    }

    .type-subtitle {
        font-size: 1rem;
        opacity: 0.9;
        margin: 0;
    }

    .type-body {
        padding: 30px;
    }

    .type-description {
        color: #4B5563;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .type-features {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .type-features li {
        padding: 8px 0;
        color: #6B7280;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        border-bottom: 1px solid #F3F4F6;
    }

    .type-features li:last-child {
        border-bottom: none;
    }

    .type-features li::before {
        content: '✓';
        color: #F59E0B;
        font-weight: bold;
        flex-shrink: 0;
    }

    /* Personality Types */
    .personality-section {
        padding: 80px 0;
        background: white;
    }

    .personality-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-top: 40px;
    }

    .personality-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        border: 2px solid transparent;
        transition: all 0.3s ease;
        text-align: center;
    }

    .personality-card:hover {
        border-color: #F59E0B;
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(245, 158, 11, 0.1);
    }

    .personality-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #F59E0B, #FBBF24);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 1.8rem;
        color: white;
    }

    .personality-type {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1F2937;
        margin-bottom: 10px;
    }

    .personality-label {
        display: inline-block;
        background: #FEF3C7;
        color: #92400E;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .personality-description {
        color: #6B7280;
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    .personality-traits {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: center;
        margin-top: 15px;
    }

    .trait-badge {
        background: #F3F4F6;
        color: #374151;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    /* Test Container */
    .test-container {
        padding: 80px 0;
        background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
    }

    .test-wrapper {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
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
        color: #6B7280;
    }

    .progress-bar-test {
        height: 10px;
        background: #E5E7EB;
        border-radius: 5px;
        overflow: hidden;
    }

    .progress-fill-test {
        height: 100%;
        background: linear-gradient(90deg, #F59E0B, #FBBF24);
        border-radius: 5px;
        transition: width 0.5s ease;
        position: relative;
    }

    .progress-fill-test::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        animation: shimmer 2s infinite;
    }

    /* Question Display */
    .question-display-test {
        background: white;
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border: 1px solid #E5E7EB;
    }

    .question-category-test {
        display: inline-block;
        background: rgba(245, 158, 11, 0.1);
        color: #92400E;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .question-text-test {
        font-size: 1.4rem;
        font-weight: 600;
        color: #1F2937;
        line-height: 1.6;
        margin-bottom: 25px;
    }

    /* Scale Options */
    .scale-container {
        background: #F9FAFB;
        border-radius: 15px;
        padding: 25px;
        margin: 30px 0;
    }

    .scale-labels {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 0.95rem;
        color: #6B7280;
        font-weight: 500;
    }

    .scale-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .scale-option {
        flex: 1;
        text-align: center;
    }

    .scale-radio {
        display: none;
    }

    .scale-label {
        display: block;
        background: white;
        border: 2px solid #D1D5DB;
        border-radius: 10px;
        padding: 15px 5px;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.9rem;
        color: #6B7280;
        font-weight: 500;
    }

    .scale-radio:checked + .scale-label {
        background: #FEF3C7;
        border-color: #F59E0B;
        color: #92400E;
        font-weight: 600;
        transform: scale(1.05);
    }

    .scale-label:hover {
        border-color: #9CA3AF;
        background: #F3F4F6;
    }

    /* Multiple Choice Options */
    .options-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .option-item {
        background: white;
        border: 2px solid #E5E7EB;
        border-radius: 12px;
        padding: 20px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .option-item:hover {
        border-color: #9CA3AF;
        background: #F9FAFB;
        transform: translateY(-2px);
    }

    .option-item.selected {
        background: #FEF3C7;
        border-color: #F59E0B;
        box-shadow: 0 5px 15px rgba(245, 158, 11, 0.1);
    }

    .option-letter {
        width: 40px;
        height: 40px;
        background: #1F2937;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .option-text {
        font-size: 1.1rem;
        color: #374151;
        line-height: 1.5;
        flex: 1;
    }

    /* Navigation Buttons */
    .nav-buttons-test {
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
        gap: 20px;
    }

    .nav-btn-test {
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

    .btn-prev-test {
        background: transparent;
        border-color: #D1D5DB;
        color: #6B7280;
    }

    .btn-prev-test:hover {
        background: #F3F4F6;
        border-color: #9CA3AF;
        transform: translateY(-2px);
    }

    .btn-next-test {
        background: #F59E0B;
        color: white;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.2);
    }

    .btn-next-test:hover {
        background: #D97706;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(245, 158, 11, 0.3);
    }

    .btn-finish-test {
        background: #10B981;
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }

    .btn-finish-test:hover {
        background: #0DA271;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(16, 185, 129, 0.3);
    }

    /* Result Section */
    .result-section-test {
        padding: 80px 0;
        background: linear-gradient(135deg, #1F2937 0%, #374151 100%);
        color: white;
        display: none;
    }

    .result-container-test {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .result-badge-test {
        display: inline-block;
        background: #F59E0B;
        color: white;
        padding: 10px 25px;
        border-radius: 25px;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .result-title-test {
        font-family: "Poetsen One", sans-serif;
        font-size: 2.8rem;
        text-align: center;
        color: white;
        margin-bottom: 10px;
    }

    .result-subtitle-test {
        text-align: center;
        color: #D1D5DB;
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto 40px;
        line-height: 1.6;
    }

    /* Personality Result */
    .personality-result {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        padding: 40px;
        margin: 40px 0;
    }

    .result-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .result-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #F59E0B, #FBBF24);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
    }

    .result-type {
        flex: 1;
    }

    .result-type-name {
        font-size: 2.2rem;
        font-weight: 700;
        color: white;
        margin-bottom: 5px;
    }

    .result-type-label {
        display: inline-block;
        background: rgba(245, 158, 11, 0.2);
        color: #FBBF24;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 1rem;
        font-weight: 600;
    }

    .result-description {
        color: #D1D5DB;
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 30px;
    }

    /* Trait Scores */
    .trait-scores {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin: 30px 0;
    }

    .trait-score {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        padding: 20px;
        text-align: center;
    }

    .trait-name {
        font-size: 1rem;
        color: #9CA3AF;
        margin-bottom: 10px;
        font-weight: 500;
    }

    .trait-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #F59E0B;
        margin-bottom: 10px;
    }

    .trait-bar {
        height: 8px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 10px;
    }

    .trait-fill {
        height: 100%;
        background: linear-gradient(90deg, #F59E0B, #FBBF24);
        border-radius: 4px;
    }

    .trait-label {
        font-size: 0.9rem;
        color: #9CA3AF;
        font-weight: 500;
    }

    /* Career Recommendations */
    .career-recommendations {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        padding: 40px;
        margin: 40px 0;
    }

    .career-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .career-title i {
        color: #F59E0B;
    }

    .career-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .career-card {
        background: rgba(255, 255, 255, 0.08);
        border-radius: 15px;
        padding: 25px;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .career-card:hover {
        border-color: #F59E0B;
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.12);
    }

    .career-icon {
        width: 50px;
        height: 50px;
        background: rgba(245, 158, 11, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        font-size: 1.5rem;
        color: #F59E0B;
    }

    .career-name {
        font-size: 1.3rem;
        font-weight: 600;
        color: white;
        margin-bottom: 10px;
    }

    .career-description {
        color: #D1D5DB;
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    .career-match {
        display: inline-block;
        background: rgba(16, 185, 129, 0.2);
        color: #10B981;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    /* Result Actions */
    .result-actions-test {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 40px;
        flex-wrap: wrap;
    }

    /* FAQ Section */
    .faq-section {
        padding: 80px 0;
        background: white;
    }

    .faq-title {
        font-family: "Poetsen One", sans-serif;
        font-size: 2.8rem;
        text-align: center;
        color: #1F2937;
        margin-bottom: 50px;
    }

    .faq-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .faq-item {
        background: #F9FAFB;
        border-radius: 15px;
        margin-bottom: 15px;
        overflow: hidden;
        border: 1px solid #E5E7EB;
    }

    .faq-question {
        padding: 25px;
        font-size: 1.2rem;
        font-weight: 600;
        color: #1F2937;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
    }

    .faq-question:hover {
        background: #F3F4F6;
    }

    .faq-question.active {
        background: #FEF3C7;
        color: #92400E;
    }

    .faq-icon {
        transition: transform 0.3s ease;
    }

    .faq-question.active .faq-icon {
        transform: rotate(180deg);
    }

    .faq-answer {
        padding: 0 25px;
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .faq-answer.show {
        padding: 0 25px 25px;
        max-height: 1000px;
    }

    .faq-answer-content {
        color: #6B7280;
        line-height: 1.7;
        font-size: 1.05rem;
    }

    /* ===================================================
       Responsif - Test Minat & Bakat
       =================================================== */

    /* Tablet (992px dan bawah) */
    @media (max-width: 992px) {
        .test-hero {
            padding: 80px 0 60px;
        }

        .hero-title {
            font-size: 3rem;
        }

        .hero-subtitle {
            font-size: 1.6rem;
        }

        .types-title,
        .faq-title,
        .result-title-test {
            font-size: 2.5rem;
        }

        .result-type-name {
            font-size: 2rem;
        }
    }

    /* Tablet Portrait (768px dan bawah) */
    @media (max-width: 768px) {
        .test-hero {
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

        .types-section,
        .personality-section {
            padding: 60px 0;
        }

        .types-title,
        .faq-title,
        .result-title-test {
            font-size: 2.2rem;
        }

        .type-body {
            padding: 20px;
        }

        .nav-buttons-test {
            flex-direction: column;
        }
        
        .nav-btn-test {
            width: 100%;
            justify-content: center;
        }

        .question-display-test {
            padding: 30px;
        }

        .question-text-test {
            font-size: 1.2rem;
        }

        .result-header {
            flex-direction: column;
            text-align: center;
        }

        .result-actions-test {
            flex-direction: column;
        }

        .result-actions-test .cta-button-large {
            width: 100%;
            margin: 5px 0;
        }
    }

    /* Mobile (576px dan bawah) */
    @media (max-width: 576px) {
        .test-hero {
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

        .types-title,
        .faq-title,
        .result-title-test {
            font-size: 2rem;
        }

        .types-subtitle {
            font-size: 1rem;
            margin-bottom: 30px;
        }

        .type-header {
            padding: 20px;
        }

        .type-icon {
            width: 60px;
            height: 60px;
            font-size: 2rem;
        }

        .type-title {
            font-size: 1.5rem;
        }

        .personality-grid {
            grid-template-columns: 1fr;
        }

        .question-display-test {
            padding: 20px;
        }

        .question-text-test {
            font-size: 1.1rem;
        }

        .scale-options {
            flex-wrap: wrap;
        }

        .scale-option {
            flex: 0 0 calc(50% - 10px);
        }

        .option-item {
            padding: 15px;
        }

        .option-letter {
            width: 35px;
            height: 35px;
            font-size: 1rem;
        }

        .nav-btn-test {
            padding: 12px 20px;
            font-size: 1rem;
        }

        .result-type-name {
            font-size: 1.8rem;
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

        .types-title,
        .faq-title,
        .result-title-test {
            font-size: 1.8rem;
        }

        .type-icon {
            width: 50px;
            height: 50px;
            font-size: 1.8rem;
        }

        .type-title {
            font-size: 1.3rem;
        }

        .personality-type {
            font-size: 1.2rem;
        }

        .question-text-test {
            font-size: 1rem;
        }

        .scale-option {
            flex: 0 0 100%;
        }

        .trait-scores {
            grid-template-columns: 1fr;
        }

        .career-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Hero Section -->
<section class="test-hero">
    <div class="test-hero-content">
        <span class="hero-badge"><?= ($lang == 'id') ? 'Psikologi Karir' : 'Career Psychology' ?></span>
        
        <h1 class="hero-title"><?= ($lang == 'id') ? 'Temukan Potensi Diri Anda' : 'Discover Your True Potential' ?></h1>
        
        <p class="hero-subtitle">
            <?= ($lang == 'id') 
                ? 'Identifikasi minat, bakat, dan kepribadian Anda melalui test psikologi terpercaya. Dapatkan rekomendasi karir yang sesuai dengan potensi terbaik Anda.' 
                : 'Identify your interests, talents, and personality through trusted psychological tests. Get career recommendations that match your best potential.' ?>
        </p>
        
        <ul class="hero-features">
            <li>
                <?= ($lang == 'id') 
                    ? 'Analisis Kepribadian Mendalam: Temukan tipe kepribadian Anda berdasarkan teori psikologi terkemuka.' 
                    : 'In-depth Personality Analysis: Discover your personality type based on leading psychological theories.' ?>
            </li>
            <li>
                <?= ($lang == 'id') 
                    ? 'Identifikasi Minat Karir: Ketahui bidang pekerjaan yang paling sesuai dengan minat dan bakat alami Anda.' 
                    : 'Career Interest Identification: Know the work fields most suitable for your natural interests and talents.' ?>
            </li>
            <li>
                <?= ($lang == 'id') 
                    ? 'Rekomendasi Karir Personal: Dapatkan saran karir yang disesuaikan dengan profil kepribadian unik Anda.' 
                    : 'Personal Career Recommendations: Get career suggestions tailored to your unique personality profile.' ?>
            </li>
            <li>
                <?= ($lang == 'id') 
                    ? 'Laporan Detail & Saran Pengembangan: Pahami kekuatan dan area pengembangan untuk karir yang lebih baik.' 
                    : 'Detailed Reports & Development Suggestions: Understand your strengths and development areas for a better career.' ?>
            </li>
        </ul>
        
        <a href="#mulai-test" class="cta-button-large">
            <?= ($lang == 'id') ? 'Mulai Test Sekarang' : 'Start Test Now' ?>
        </a>
    </div>
</section>

<!-- Test Types Section -->
<section class="types-section">
    <div class="container">
        <h2 class="types-title"><?= ($lang == 'id') ? 'Jenis Test yang Tersedia' : 'Available Test Types' ?></h2>
        
        <p class="types-subtitle">
            <?= ($lang == 'id') 
                ? 'Pilih jenis test yang sesuai dengan kebutuhan pengembangan diri Anda' 
                : 'Choose the test type that matches your self-development needs' ?>
        </p>
        
        <div class="types-grid">
            <!-- Test Type 1 -->
            <div class="type-card">
                <div class="type-header">
                    <div class="type-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3 class="type-title"><?= ($lang == 'id') ? 'Test Kepribadian' : 'Personality Test' ?></h3>
                    <p class="type-subtitle">MBTI & Big Five</p>
                </div>
                <div class="type-body">
                    <p class="type-description">
                        <?= ($lang == 'id') 
                            ? 'Identifikasi tipe kepribadian Anda berdasarkan teori psikologi yang diakui secara internasional.' 
                            : 'Identify your personality type based on internationally recognized psychological theories.' ?>
                    </p>
                    <ul class="type-features">
                        <li><?= ($lang == 'id') ? '16 Tipe Kepribadian MBTI' : '16 MBTI Personality Types' ?></li>
                        <li><?= ($lang == 'id') ? '5 Dimensi Besar Kepribadian' : '5 Big Personality Dimensions' ?></li>
                        <li><?= ($lang == 'id') ? 'Analisis Strengths & Weaknesses' : 'Strengths & Weaknesses Analysis' ?></li>
                        <li><?= ($lang == 'id') ? 'Saran Pengembangan Diri' : 'Self-Development Suggestions' ?></li>
                    </ul>
                </div>
            </div>
            
            <!-- Test Type 2 -->
            <div class="type-card">
                <div class="type-header">
                    <div class="type-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="type-title"><?= ($lang == 'id') ? 'Test Minat Karir' : 'Career Interest Test' ?></h3>
                    <p class="type-subtitle">Holland Code (RIASEC)</p>
                </div>
                <div class="type-body">
                    <p class="type-description">
                        <?= ($lang == 'id') 
                            ? 'Temukan minat karir Anda berdasarkan teori Holland Code yang digunakan secara global.' 
                            : 'Discover your career interests based on the globally used Holland Code theory.' ?>
                    </p>
                    <ul class="type-features">
                        <li><?= ($lang == 'id') ? '6 Tipe Lingkungan Kerja' : '6 Work Environment Types' ?></li>
                        <li><?= ($lang == 'id') ? 'Kesesuaian Profesi dengan Minat' : 'Profession-Interest Compatibility' ?></li>
                        <li><?= ($lang == 'id') ? 'Rekomendasi Jurusan Pendidikan' : 'Education Major Recommendations' ?></li>
                        <li><?= ($lang == 'id') ? 'Peluang Karir Terbaik' : 'Best Career Opportunities' ?></li>
                    </ul>
                </div>
            </div>
            
            <!-- Test Type 3 -->
            <div class="type-card">
                <div class="type-header">
                    <div class="type-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3 class="type-title"><?= ($lang == 'id') ? 'Test Bakat & Potensi' : 'Talent & Potential Test' ?></h3>
                    <p class="type-subtitle">Multiple Intelligences</p>
                </div>
                <div class="type-body">
                    <p class="type-description">
                        <?= ($lang == 'id') 
                            ? 'Identifikasi jenis kecerdasan dominan Anda berdasarkan teori Multiple Intelligences.' 
                            : 'Identify your dominant intelligence types based on Multiple Intelligences theory.' ?>
                    </p>
                    <ul class="type-features">
                        <li><?= ($lang == 'id') ? '8 Jenis Kecerdasan' : '8 Intelligence Types' ?></li>
                        <li><?= ($lang == 'id') ? 'Analisis Potensi Tersembunyi' : 'Hidden Potential Analysis' ?></li>
                        <li><?= ($lang == 'id') ? 'Pengembangan Skill Optimal' : 'Optimal Skill Development' ?></li>
                        <li><?= ($lang == 'id') ? 'Strategi Belajar Efektif' : 'Effective Learning Strategies' ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Personality Types Preview -->
<section class="personality-section">
    <div class="container">
        <h2 class="types-title"><?= ($lang == 'id') ? 'Tipe-Tipe Kepribadian' : 'Personality Types' ?></h2>
        
        <p class="types-subtitle">
            <?= ($lang == 'id') 
                ? 'Kenali berbagai tipe kepribadian yang mungkin cocok dengan diri Anda' 
                : 'Get to know various personality types that might suit you' ?>
        </p>
        
        <div class="personality-grid">
            <!-- Personality Type 1 -->
            <div class="personality-card">
                <div class="personality-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h4 class="personality-type">ENFJ</h4>
                <span class="personality-label"><?= ($lang == 'id') ? 'Sang Motivator' : 'The Motivator' ?></span>
                <p class="personality-description">
                    <?= ($lang == 'id') 
                        ? 'Karismatik, empatik, dan inspiratif. Pandai memotivasi orang lain.' 
                        : 'Charismatic, empathetic, and inspirational. Good at motivating others.' ?>
                </p>
                <div class="personality-traits">
                    <span class="trait-badge"><?= ($lang == 'id') ? 'Ekstrovert' : 'Extrovert' ?></span>
                    <span class="trait-badge"><?= ($lang == 'id') ? 'Intuitif' : 'Intuitive' ?></span>
                    <span class="trait-badge"><?= ($lang == 'id') ? 'Perasa' : 'Feeling' ?></span>
                    <span class="trait-badge"><?= ($lang == 'id') ? 'Penilai' : 'Judging' ?></span>
                </div>
            </div>
            
            <!-- Personality Type 2 -->
            <div class="personality-card">
                <div class="personality-icon">
                    <i class="fas fa-cogs"></i>
                </div>
                <h4 class="personality-type">ISTJ</h4>
                <span class="personality-label"><?= ($lang == 'id') ? 'Sang Organisator' : 'The Organizer' ?></span>
                <p class="personality-description">
                    <?= ($lang == 'id') 
                        ? 'Praktis, bertanggung jawab, dan terorganisir. Menyukai struktur dan rutinitas.' 
                        : 'Practical, responsible, and organized. Likes structure and routine.' ?>
                </p>
                <div class="personality-traits">
                    <span class="trait-badge"><?= ($lang == 'id') ? 'Introvert' : 'Introvert' ?></span>
                    <span class="trait-badge"><?= ($lang == 'id') ? 'Sensor' : 'Sensing' ?></span>
                    <span class="trait-badge"><?= ($lang == 'id') ? 'Pemikir' : 'Thinking' ?></span>
                    <span class="trait-badge"><?= ($lang == 'id') ? 'Penilai' : 'Judging' ?></span>
                </div>
            </div>
            
            <!-- Personality Type 3 -->
            <div class="personality-card">
                <div class="personality-icon">
                    <i class="fas fa-rocket"></i>
                </div>
                <h4 class="personality-type">ENTP</h4>
                <span class="personality-label"><?= ($lang == 'id') ? 'Sang Inovator' : 'The Innovator' ?></span>
                <p class="personality-description">
                    <?= ($lang == 'id') 
                        ? 'Kreatif, inovatif, dan suka tantangan. Pandai memecahkan masalah kompleks.' 
                        : 'Creative, innovative, and loves challenges. Good at solving complex problems.' ?>
                </p>
                <div class="personality-traits">
                    <span class="trait-badge"><?= ($lang == 'id') ? 'Ekstrovert' : 'Extrovert' ?></span>
                    <span class="trait-badge"><?= ($lang == 'id') ? 'Intuitif' : 'Intuitive' ?></span>
                    <span class="trait-badge"><?= ($lang == 'id') ? 'Pemikir' : 'Thinking' ?></span>
                    <span class="trait-badge"><?= ($lang == 'id') ? 'Persepsif' : 'Perceiving' ?></span>
                </div>
            </div>
            
            <!-- Personality Type 4 -->
            <div class="personality-card">
                <div class="personality-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h4 class="personality-type">ISFP</h4>
                <span class="personality-label"><?= ($lang == 'id') ? 'Sang Seniman' : 'The Artist' ?></span>
                <p class="personality-description">
                    <?= ($lang == 'id') 
                        ? 'Sensitif, artistik, dan fleksibel. Menghargai keindahan dan kebebasan.' 
                        : 'Sensitive, artistic, and flexible. Values beauty and freedom.' ?>
                </p>
                <div class="personality-traits">
                    <span class="trait-badge"><?= ($lang == 'id') ? 'Introvert' : 'Introvert' ?></span>
                    <span class="trait-badge"><?= ($lang == 'id') ? 'Sensor' : 'Sensing' ?></span>
                    <span class="trait-badge"><?= ($lang == 'id') ? 'Perasa' : 'Feeling' ?></span>
                    <span class="trait-badge"><?= ($lang == 'id') ? 'Persepsif' : 'Perceiving' ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TEST INTERAKTIF SECTION -->
<section id="mulai-test" class="test-container">
    <div class="test-wrapper">
        <!-- Progress Bar -->
        <div class="progress-container">
            <div class="progress-label">
                <span><?= ($lang == 'id') ? 'Pertanyaan' : 'Question' ?> <span id="currentQuestion">1</span>/30</span>
                <span id="progressPercentage">3%</span>
            </div>
            <div class="progress-bar-test">
                <div class="progress-fill-test" id="progressFill" style="width: 3%"></div>
            </div>
        </div>

        <!-- Question Display -->
        <div class="question-display-test" id="questionDisplay">
            <div class="question-category-test" id="questionCategory">
                <?= ($lang == 'id') ? 'Kepribadian' : 'Personality' ?>
            </div>
            <p class="question-text-test" id="questionText">
                <?= ($lang == 'id') 
                    ? '"Saya lebih suka menghabiskan waktu dengan banyak orang daripada sendirian."' 
                    : '"I prefer spending time with many people rather than alone."' ?>
            </p>
            
            <!-- Scale Options -->
            <div class="scale-container">
                <div class="scale-labels">
                    <span><?= ($lang == 'id') ? 'Sangat Tidak Setuju' : 'Strongly Disagree' ?></span>
                    <span><?= ($lang == 'id') ? 'Sangat Setuju' : 'Strongly Agree' ?></span>
                </div>
                <div class="scale-options" id="scaleOptions">
                    <!-- Scale options will be populated by JavaScript -->
                </div>
            </div>
            
            <!-- Multiple Choice Options (for some questions) -->
            <div class="options-grid" id="optionsGrid" style="display: none;">
                <!-- Options will be populated by JavaScript -->
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="nav-buttons-test">
            <button class="nav-btn-test btn-prev-test" onclick="prevQuestionTest()" id="prevBtnTest" disabled>
                <i class="fas fa-arrow-left"></i>
                <?= ($lang == 'id') ? 'Sebelumnya' : 'Previous' ?>
            </button>
            
            <div class="d-flex gap-2">
                <button class="nav-btn-test btn-next-test" onclick="nextQuestionTest()" id="nextBtnTest">
                    <?= ($lang == 'id') ? 'Selanjutnya' : 'Next' ?>
                    <i class="fas fa-arrow-right"></i>
                </button>
                <button class="nav-btn-test btn-finish-test" onclick="finishTest()" id="finishBtnTest" style="display: none;">
                    <i class="fas fa-flag-checkered"></i>
                    <?= ($lang == 'id') ? 'Selesaikan Test' : 'Finish Test' ?>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Result Section (Hidden by Default) -->
<section class="result-section-test" id="resultSectionTest">
    <div class="result-container-test">
        <div class="result-badge-test"><?= ($lang == 'id') ? 'Hasil Test Minat & Bakat' : 'Interest & Talent Test Results' ?></div>
        
        <h2 class="result-title-test"><?= ($lang == 'id') ? 'Selamat! Profil Anda Telah Teridentifikasi' : 'Congratulations! Your Profile Has Been Identified' ?></h2>
        
        <p class="result-subtitle-test">
            <?= ($lang == 'id') 
                ? 'Berdasarkan jawaban Anda, berikut adalah analisis kepribadian dan rekomendasi karir yang sesuai.' 
                : 'Based on your answers, here is your personality analysis and suitable career recommendations.' ?>
        </p>
        
        <!-- Personality Result -->
        <div class="personality-result" id="personalityResult">
            <div class="result-header">
                <div class="result-icon">
                    <i class="fas fa-users" id="resultIcon"></i>
                </div>
                <div class="result-type">
                    <h3 class="result-type-name" id="personalityType">ENFJ</h3>
                    <span class="result-type-label" id="personalityLabel"><?= ($lang == 'id') ? 'Sang Motivator' : 'The Motivator' ?></span>
                </div>
            </div>
            
            <p class="result-description" id="personalityDescription">
                <!-- Description will be populated by JavaScript -->
            </p>
            
            <!-- Trait Scores -->
            <div class="trait-scores" id="traitScores">
                <!-- Trait scores will be populated by JavaScript -->
            </div>
        </div>
        
        <!-- Career Recommendations -->
        <div class="career-recommendations">
            <h3 class="career-title">
                <i class="fas fa-briefcase"></i>
                <?= ($lang == 'id') ? 'Rekomendasi Karir untuk Anda' : 'Career Recommendations for You' ?>
            </h3>
            
            <div class="career-grid" id="careerGrid">
                <!-- Career recommendations will be populated by JavaScript -->
            </div>
        </div>
        
        <!-- Development Suggestions -->
        <div class="career-recommendations">
            <h3 class="career-title">
                <i class="fas fa-chart-line"></i>
                <?= ($lang == 'id') ? 'Saran Pengembangan Diri' : 'Self-Development Suggestions' ?>
            </h3>
            
            <div class="career-grid" id="developmentGrid">
                <!-- Development suggestions will be populated by JavaScript -->
            </div>
        </div>
        
        <!-- Result Actions -->
        <div class="result-actions-test">
            <button class="cta-button-large" onclick="restartTest()">
                <i class="fas fa-redo me-2"></i><?= ($lang == 'id') ? 'Ulangi Test' : 'Retake Test' ?>
            </button>
            <button class="cta-button-large" onclick="downloadReport()" style="background: transparent; border: 2px solid #F59E0B;">
                <i class="fas fa-download me-2"></i><?= ($lang == 'id') ? 'Unduh Laporan Lengkap' : 'Download Full Report' ?>
            </button>
            <a href="<?= base_url('/') ?>" class="cta-button-large" style="background: #10B981;">
                <i class="fas fa-home me-2"></i><?= ($lang == 'id') ? 'Kembali ke Beranda' : 'Back to Home' ?>
            </a>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <h2 class="faq-title"><?= ($lang == 'id') ? 'Pertanyaan yang Sering Diajukan' : 'Frequently Asked Questions' ?></h2>
        
        <div class="faq-container">
            <!-- FAQ 1 -->
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span><?= ($lang == 'id') ? 'Apa itu test minat dan bakat?' : 'What is an interest and talent test?' ?></span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <?= ($lang == 'id') 
                            ? 'Test minat dan bakat adalah alat psikologi yang dirancang untuk mengidentifikasi kecenderungan alami, minat, dan potensi seseorang. Test ini membantu memahami kepribadian, preferensi karir, dan area pengembangan diri.' 
                            : 'An interest and talent test is a psychological tool designed to identify natural tendencies, interests, and potential. This test helps understand personality, career preferences, and self-development areas.' ?>
                    </div>
                </div>
            </div>
            
            <!-- FAQ 2 -->
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span><?= ($lang == 'id') ? 'Berapa lama waktu yang dibutuhkan?' : 'How long does it take?' ?></span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <?= ($lang == 'id') 
                            ? 'Test ini terdiri dari 30 pertanyaan dan membutuhkan waktu sekitar 10-15 menit untuk diselesaikan. Anda dapat menyelesaikannya dalam satu sesi atau melanjutkan di lain waktu.' 
                            : 'This test consists of 30 questions and takes about 10-15 minutes to complete. You can finish it in one session or continue at another time.' ?>
                    </div>
                </div>
            </div>
            
            <!-- FAQ 3 -->
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span><?= ($lang == 'id') ? 'Apakah hasil test ini akurat?' : 'Are the test results accurate?' ?></span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <?= ($lang == 'id') 
                            ? 'Test ini dikembangkan berdasarkan teori psikologi yang diakui secara internasional (MBTI, Holland Code, Big Five). Meskipun hasilnya memberikan wawasan yang berharga, test ini sebaiknya digunakan sebagai panduan, bukan diagnosis mutlak.' 
                            : 'This test is developed based on internationally recognized psychological theories (MBTI, Holland Code, Big Five). While the results provide valuable insights, this test should be used as a guide, not an absolute diagnosis.' ?>
                    </div>
                </div>
            </div>
            
            <!-- FAQ 4 -->
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span><?= ($lang == 'id') ? 'Siapa yang bisa mengikuti test ini?' : 'Who can take this test?' ?></span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <?= ($lang == 'id') 
                            ? 'Test ini cocok untuk semua orang mulai dari pelajar, mahasiswa, pencari kerja, hingga profesional yang ingin memahami diri lebih dalam dan merencanakan karir yang sesuai.' 
                            : 'This test is suitable for everyone from students, university students, job seekers, to professionals who want to understand themselves better and plan suitable careers.' ?>
                    </div>
                </div>
            </div>
            
            <!-- FAQ 5 -->
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span><?= ($lang == 'id') ? 'Bagaimana cara mendapatkan hasil terbaik?' : 'How to get the best results?' ?></span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <?= ($lang == 'id') 
                            ? 'Jawablah dengan jujur sesuai dengan diri Anda, bukan seperti yang Anda inginkan. Pilih jawaban yang pertama kali terlintas di pikiran. Cari tempat yang tenang dan luangkan waktu untuk menyelesaikan test dengan fokus.' 
                            : 'Answer honestly according to yourself, not as you wish. Choose the answer that first comes to mind. Find a quiet place and take time to complete the test with focus.' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="types-section">
    <div class="container text-center">
        <h2 class="types-title"><?= ($lang == 'id') ? 'Siap Menemukan Jalan Karir Terbaik?' : 'Ready to Find Your Best Career Path?' ?></h2>
        
        <p class="types-subtitle">
            <?= ($lang == 'id') 
                ? 'Bergabung dengan ribuan orang yang telah menemukan potensi diri dan merencanakan karir dengan lebih baik melalui test kami.' 
                : 'Join thousands of people who have discovered their potential and planned their careers better through our test.' ?>
        </p>
        
        <div class="mt-5">
            <a href="<?= base_url('/login') ?>" class="cta-button-large me-3">
                <?= ($lang == 'id') ? 'Mulai Test Sekarang' : 'Start Test Now' ?>
            </a>
            <a href="<?= base_url('/registration') ?>" class="cta-button-large" style="background: transparent; border: 2px solid #F59E0B; color: #1F2937;">
                <?= ($lang == 'id') ? 'Daftar untuk Fitur Lengkap' : 'Register for Full Features' ?>
            </a>
        </div>
    </div>
</section>

<script>
    // Data pertanyaan test minat & bakat
    const testQuestions = [
        // Questions 1-5: Extraversion vs Introversion
        {
            id: 1,
            category: '<?= ($lang == "id") ? "Kepribadian" : "Personality" ?>',
            type: 'scale',
            question: '<?= ($lang == "id") ? "Saya lebih suka menghabiskan waktu dengan banyak orang daripada sendirian." : "I prefer spending time with many people rather than alone." ?>',
            trait: 'extraversion',
            scaleLabels: ['<?= ($lang == "id") ? "Sangat Tidak Setuju" : "Strongly Disagree" ?>', '<?= ($lang == "id") ? "Tidak Setuju" : "Disagree" ?>', '<?= ($lang == "id") ? "Netral" : "Neutral" ?>', '<?= ($lang == "id") ? "Setuju" : "Agree" ?>', '<?= ($lang == "id") ? "Sangat Setuju" : "Strongly Agree" ?>']
        },
        {
            id: 2,
            category: '<?= ($lang == "id") ? "Kepribadian" : "Personality" ?>',
            type: 'scale',
            question: '<?= ($lang == "id") ? "Saya merasa berenergi setelah bersosialisasi dengan banyak orang." : "I feel energized after socializing with many people." ?>',
            trait: 'extraversion',
            scaleLabels: ['<?= ($lang == "id") ? "Sangat Tidak Setuju" : "Strongly Disagree" ?>', '<?= ($lang == "id") ? "Tidak Setuju" : "Disagree" ?>', '<?= ($lang == "id") ? "Netral" : "Neutral" ?>', '<?= ($lang == "id") ? "Setuju" : "Agree" ?>', '<?= ($lang == "id") ? "Sangat Setuju" : "Strongly Agree" ?>']
        },
        {
            id: 3,
            category: '<?= ($lang == "id") ? "Kepribadian" : "Personality" ?>',
            type: 'scale',
            question: '<?= ($lang == "id") ? "Saya memerlukan waktu sendirian untuk mengisi kembali energi saya." : "I need alone time to recharge my energy." ?>',
            trait: 'introversion',
            scaleLabels: ['<?= ($lang == "id") ? "Sangat Tidak Setuju" : "Strongly Disagree" ?>', '<?= ($lang == "id") ? "Tidak Setuju" : "Disagree" ?>', '<?= ($lang == "id") ? "Netral" : "Neutral" ?>', '<?= ($lang == "id") ? "Setuju" : "Agree" ?>', '<?= ($lang == "id") ? "Sangat Setuju" : "Strongly Agree" ?>']
        },
        {
            id: 4,
            category: '<?= ($lang == "id") ? "Kepribadian" : "Personality" ?>',
            type: 'scale',
            question: '<?= ($lang == "id") ? "Saya lebih suka percakapan mendalam dengan satu orang daripada percakapan ringan dengan banyak orang." : "I prefer deep conversations with one person rather than light conversations with many people." ?>',
            trait: 'introversion',
            scaleLabels: ['<?= ($lang == "id") ? "Sangat Tidak Setuju" : "Strongly Disagree" ?>', '<?= ($lang == "id") ? "Tidak Setuju" : "Disagree" ?>', '<?= ($lang == "id") ? "Netral" : "Neutral" ?>', '<?= ($lang == "id") ? "Setuju" : "Agree" ?>', '<?= ($lang == "id") ? "Sangat Setuju" : "Strongly Agree" ?>']
        },
        // Questions 5-10: Sensing vs Intuition
        {
            id: 5,
            category: '<?= ($lang == "id") ? "Kepribadian" : "Personality" ?>',
            type: 'scale',
            question: '<?= ($lang == "id") ? "Saya lebih fokus pada fakta dan data konkret daripada teori dan kemungkinan." : "I focus more on concrete facts and data than theories and possibilities." ?>',
            trait: 'sensing',
            scaleLabels: ['<?= ($lang == "id") ? "Sangat Tidak Setuju" : "Strongly Disagree" ?>', '<?= ($lang == "id") ? "Tidak Setuju" : "Disagree" ?>', '<?= ($lang == "id") ? "Netral" : "Neutral" ?>', '<?= ($lang == "id") ? "Setuju" : "Agree" ?>', '<?= ($lang == "id") ? "Sangat Setuju" : "Strongly Agree" ?>']
        },
        {
            id: 6,
            category: '<?= ($lang == "id") ? "Kepribadian" : "Personality" ?>',
            type: 'multiple',
            question: '<?= ($lang == "id") ? "Ketika memecahkan masalah, saya biasanya:" : "When solving problems, I usually:" ?>',
            trait: 'intuition',
            options: [
                { letter: 'A', text: '<?= ($lang == "id") ? "Mengikuti langkah-langkah praktis yang sudah terbukti" : "Follow practical steps that have been proven" ?>' },
                { letter: 'B', text: '<?= ($lang == "id") ? "Mencari pola dan kemungkinan baru" : "Look for new patterns and possibilities" ?>' },
                { letter: 'C', text: '<?= ($lang == "id") ? "Menggunakan pengalaman masa lalu sebagai panduan" : "Use past experiences as a guide" ?>' },
                { letter: 'D', text: '<?= ($lang == "id") ? "Mencari solusi kreatif dan inovatif" : "Look for creative and innovative solutions" ?>' }
            ]
        },
        // Questions 11-15: Thinking vs Feeling
        {
            id: 7,
            category: '<?= ($lang == "id") ? "Kepribadian" : "Personality" ?>',
            type: 'scale',
            question: '<?= ($lang == "id") ? "Dalam membuat keputusan, saya lebih mengutamakan logika daripada perasaan orang lain." : "In making decisions, I prioritize logic over others\' feelings." ?>',
            trait: 'thinking',
            scaleLabels: ['<?= ($lang == "id") ? "Sangat Tidak Setuju" : "Strongly Disagree" ?>', '<?= ($lang == "id") ? "Tidak Setuju" : "Disagree" ?>', '<?= ($lang == "id") ? "Netral" : "Neutral" ?>', '<?= ($lang == "id") ? "Setuju" : "Agree" ?>', '<?= ($lang == "id") ? "Sangat Setuju" : "Strongly Agree" ?>']
        },
        {
            id: 8,
            category: '<?= ($lang == "id") ? "Kepribadian" : "Personality" ?>',
            type: 'multiple',
            question: '<?= ($lang == "id") ? "Dalam tim kerja, saya lebih menghargai:" : "In a work team, I value more:" ?>',
            trait: 'feeling',
            options: [
                { letter: 'A', text: '<?= ($lang == "id") ? "Efisiensi dan produktivitas" : "Efficiency and productivity" ?>' },
                { letter: 'B', text: '<?= ($lang == "id") ? "Harmoni dan hubungan baik" : "Harmony and good relationships" ?>' },
                { letter: 'C', text: '<?= ($lang == "id") ? "Keadilan dan kesetaraan" : "Fairness and equality" ?>' },
                { letter: 'D', text: '<?= ($lang == "id") ? "Kepuasan semua pihak" : "Satisfaction of all parties" ?>' }
            ]
        },
        // Questions 16-20: Judging vs Perceiving
        {
            id: 9,
            category: '<?= ($lang == "id") ? "Kepribadian" : "Personality" ?>',
            type: 'scale',
            question: '<?= ($lang == "id") ? "Saya lebih suka rencana yang terstruktur daripada fleksibilitas spontan." : "I prefer structured plans over spontaneous flexibility." ?>',
            trait: 'judging',
            scaleLabels: ['<?= ($lang == "id") ? "Sangat Tidak Setuju" : "Strongly Disagree" ?>', '<?= ($lang == "id") ? "Tidak Setuju" : "Disagree" ?>', '<?= ($lang == "id") ? "Netral" : "Neutral" ?>', '<?= ($lang == "id") ? "Setuju" : "Agree" ?>', '<?= ($lang == "id") ? "Sangat Setuju" : "Strongly Agree" ?>']
        },
        {
            id: 10,
            category: '<?= ($lang == "id") ? "Kepribadian" : "Personality" ?>',
            type: 'multiple',
            question: '<?= ($lang == "id") ? "Ketika menghadapi deadline, saya:" : "When facing a deadline, I:" ?>',
            trait: 'perceiving',
            options: [
                { letter: 'A', text: '<?= ($lang == "id") ? "Menyelesaikan jauh sebelum deadline" : "Finish long before the deadline" ?>' },
                { letter: 'B', text: '<?= ($lang == "id") ? "Bekerja dengan santai hingga mendekati deadline" : "Work leisurely until approaching the deadline" ?>' },
                { letter: 'C', text: '<?= ($lang == "id") ? "Membuat jadwal ketat dan mengikutinya" : "Make a strict schedule and follow it" ?>' },
                { letter: 'D', text: '<?= ($lang == "id") ? "Memanfaatkan tekanan deadline untuk kreativitas" : "Use deadline pressure for creativity" ?>' }
            ]
        },
        // Questions 21-25: Minat Karir (Holland Code)
        {
            id: 11,
            category: '<?= ($lang == "id") ? "Minat Karir" : "Career Interest" ?>',
            type: 'multiple',
            question: '<?= ($lang == "id") ? "Kegiatan apa yang paling menarik bagi Anda?" : "What activities interest you most?" ?>',
            trait: 'realistic',
            options: [
                { letter: 'A', text: '<?= ($lang == "id") ? "Memperbaiki mesin atau alat" : "Repairing machines or tools" ?>' },
                { letter: 'B', text: '<?= ($lang == "id") ? "Membantu orang memecahkan masalah pribadi" : "Helping people solve personal problems" ?>' },
                { letter: 'C', text: '<?= ($lang == "id") ? "Melakukan penelitian ilmiah" : "Conducting scientific research" ?>' },
                { letter: 'D', text: '<?= ($lang == "id") ? "Membuat karya seni" : "Creating artworks" ?>' }
            ]
        },
        {
            id: 12,
            category: '<?= ($lang == "id") ? "Minat Karir" : "Career Interest" ?>',
            type: 'multiple',
            question: '<?= ($lang == "id") ? "Saya paling senang bekerja di lingkungan:" : "I enjoy working most in an environment:" ?>',
            trait: 'investigative',
            options: [
                { letter: 'A', text: '<?= ($lang == "id") ? "Laboratorium atau tempat penelitian" : "Laboratory or research place" ?>' },
                { letter: 'B', text: '<?= ($lang == "id") ? "Kantor dengan struktur jelas" : "Office with clear structure" ?>' },
                { letter: 'C', text: '<?= ($lang == "id") ? "Luar ruangan dengan aktivitas fisik" : "Outdoors with physical activity" ?>' },
                { letter: 'D', text: '<?= ($lang == "id") ? "Studio kreatif atau teater" : "Creative studio or theater" ?>' }
            ]
        },
        // Questions 26-30: Bakat & Potensi
        {
            id: 13,
            category: '<?= ($lang == "id") ? "Bakat & Potensi" : "Talent & Potential" ?>',
            type: 'multiple',
            question: '<?= ($lang == "id") ? "Saya paling mudah belajar melalui:" : "I learn most easily through:" ?>',
            trait: 'linguistic',
            options: [
                { letter: 'A', text: '<?= ($lang == "id") ? "Membaca dan menulis" : "Reading and writing" ?>' },
                { letter: 'B', text: '<?= ($lang == "id") ? "Gambar dan diagram" : "Pictures and diagrams" ?>' },
                { letter: 'C', text: '<?= ($lang == "id") ? "Musik dan ritme" : "Music and rhythm" ?>' },
                { letter: 'D', text: '<?= ($lang == "id") ? "Praktik langsung" : "Direct practice" ?>' }
            ]
        },
        {
            id: 14,
            category: '<?= ($lang == "id") ? "Bakat & Potensi" : "Talent & Potential" ?>',
            type: 'scale',
            question: '<?= ($lang == "id") ? "Saya mudah memahami perasaan orang lain." : "I easily understand other people\'s feelings." ?>',
            trait: 'interpersonal',
            scaleLabels: ['<?= ($lang == "id") ? "Sangat Tidak Setuju" : "Strongly Disagree" ?>', '<?= ($lang == "id") ? "Tidak Setuju" : "Disagree" ?>', '<?= ($lang == "id") ? "Netral" : "Neutral" ?>', '<?= ($lang == "id") ? "Setuju" : "Agree" ?>', '<?= ($lang == "id") ? "Sangat Setuju" : "Strongly Agree" ?>']
        },
        {
            id: 15,
            category: '<?= ($lang == "id") ? "Bakat & Potensi" : "Talent & Potential" ?>',
            type: 'multiple',
            question: '<?= ($lang == "id") ? "Saya merasa paling berbakat dalam:" : "I feel most talented in:" ?>',
            trait: 'logical',
            options: [
                { letter: 'A', text: '<?= ($lang == "id") ? "Memecahkan masalah matematika" : "Solving mathematical problems" ?>' },
                { letter: 'B', text: '<?= ($lang == "id") ? "Memimpin dan mengorganisir" : "Leading and organizing" ?>' },
                { letter: 'C', text: '<?= ($lang == "id") ? "Menciptakan karya seni" : "Creating artworks" ?>' },
                { letter: 'D', text: '<?= ($lang == "id") ? "Memahami alam dan lingkungan" : "Understanding nature and environment" ?>' }
            ]
        }
        // Note: Untuk demo, kita gunakan 15 pertanyaan. Anda bisa tambahkan 15 pertanyaan lagi untuk total 30
    ];

    // Personality type descriptions
    const personalityTypes = {
        'ENFJ': {
            name: 'ENFJ',
            label: '<?= ($lang == "id") ? "Sang Motivator" : "The Motivator" ?>',
            icon: 'fa-users',
            description: '<?= ($lang == "id") ? "ENFJ adalah individu yang karismatik, empatik, dan inspiratif. Mereka pandai memahami orang lain dan memotivasi mereka untuk mencapai potensi terbaik. Sebagai pemimpin alami, ENFJ menciptakan harmoni dalam tim dan berkomitmen pada nilai-nilai yang mereka percayai." : "ENFJ are charismatic, empathetic, and inspirational individuals. They are good at understanding others and motivating them to achieve their best potential. As natural leaders, ENFJs create harmony in teams and are committed to the values they believe in." ?>',
            careers: [
                { name: '<?= ($lang == "id") ? "Konselor" : "Counselor" ?>', match: '95%', icon: 'fa-hands-helping' },
                { name: '<?= ($lang == "id") ? "Guru/Dosen" : "Teacher/Lecturer" ?>', match: '92%', icon: 'fa-chalkboard-teacher' },
                { name: '<?= ($lang == "id") ? "Manajer SDM" : "HR Manager" ?>', match: '90%', icon: 'fa-user-tie' },
                { name: '<?= ($lang == "id") ? "Event Planner" : "Event Planner" ?>', match: '88%', icon: 'fa-calendar-check' }
            ]
        },
        'ISTJ': {
            name: 'ISTJ',
            label: '<?= ($lang == "id") ? "Sang Organisator" : "The Organizer" ?>',
            icon: 'fa-cogs',
            description: '<?= ($lang == "id") ? "ISTJ adalah pribadi yang bertanggung jawab, praktis, dan terorganisir. Mereka menghargai struktur, tradisi, dan ketertiban. ISTJ sangat dapat diandalkan dalam menyelesaikan tugas dengan tepat waktu dan akurat, membuat mereka menjadi aset berharga dalam organisasi apa pun." : "ISTJ are responsible, practical, and organized individuals. They value structure, tradition, and order. ISTJs are highly reliable in completing tasks on time and accurately, making them valuable assets in any organization." ?>',
            careers: [
                { name: '<?= ($lang == "id") ? "Akuntan" : "Accountant" ?>', match: '96%', icon: 'fa-calculator' },
                { name: '<?= ($lang == "id") ? "Analis Data" : "Data Analyst" ?>', match: '94%', icon: 'fa-chart-bar' },
                { name: '<?= ($lang == "id") ? "Manajer Proyek" : "Project Manager" ?>', match: '91%', icon: 'fa-tasks' },
                { name: '<?= ($lang == "id") ? "Auditor" : "Auditor" ?>', match: '89%', icon: 'fa-search-dollar' }
            ]
        },
        'ENTP': {
            name: 'ENTP',
            label: '<?= ($lang == "id") ? "Sang Inovator" : "The Innovator" ?>',
            icon: 'fa-rocket',
            description: '<?= ($lang == "id") ? "ENTP adalah pemikir kreatif yang selalu mencari kemungkinan baru dan tantangan intelektual. Mereka cerdas, inovatif, dan pandai melihat pola yang tidak terlihat oleh orang lain. ENTP menikmati debat dan memecahkan masalah kompleks dengan solusi orisinal." : "ENTP are creative thinkers who are always looking for new possibilities and intellectual challenges. They are intelligent, innovative, and good at seeing patterns that others miss. ENTPs enjoy debates and solving complex problems with original solutions." ?>',
            careers: [
                { name: '<?= ($lang == "id") ? "Wirausaha" : "Entrepreneur" ?>', match: '97%', icon: 'fa-lightbulb' },
                { name: '<?= ($lang == "id") ? "Konsultan Strategi" : "Strategy Consultant" ?>', match: '95%', icon: 'fa-chess' },
                { name: '<?= ($lang == "id") ? "Pengembang Produk" : "Product Developer" ?>', match: '93%', icon: 'fa-cube' },
                { name: '<?= ($lang == "id") ? "Pengacara" : "Lawyer" ?>', match: '90%', icon: 'fa-gavel' }
            ]
        },
        'ISFP': {
            name: 'ISFP',
            label: '<?= ($lang == "id") ? "Sang Seniman" : "The Artist" ?>',
            icon: 'fa-heart',
            description: '<?= ($lang == "id") ? "ISFP adalah individu yang sensitif, artistik, dan fleksibel. Mereka hidup di saat ini dan menghargai pengalaman langsung. ISFP memiliki apresiasi mendalam terhadap keindahan dan sering mengekspresikan diri melalui seni atau kegiatan kreatif lainnya." : "ISFP are sensitive, artistic, and flexible individuals. They live in the present and value direct experiences. ISFPs have a deep appreciation for beauty and often express themselves through art or other creative activities." ?>',
            careers: [
                { name: '<?= ($lang == "id") ? "Desainer Grafis" : "Graphic Designer" ?>', match: '96%', icon: 'fa-palette' },
                { name: '<?= ($lang == "id") ? "Fotografer" : "Photographer" ?>', match: '94%', icon: 'fa-camera' },
                { name: '<?= ($lang == "id") ? "Konselor Seni" : "Art Therapist" ?>', match: '92%', icon: 'fa-paint-brush' },
                { name: '<?= ($lang == "id") ? "Florist" : "Florist" ?>', match: '90%', icon: 'fa-spa' }
            ]
        }
    };

    // Development suggestions
    const developmentSuggestions = [
        {
            title: '<?= ($lang == "id") ? "Pengembangan Soft Skills" : "Soft Skills Development" ?>',
            description: '<?= ($lang == "id") ? "Asah kemampuan komunikasi, kerja tim, dan adaptabilitas untuk meningkatkan performa karir." : "Sharpen communication, teamwork, and adaptability skills to improve career performance." ?>',
            icon: 'fa-comments'
        },
        {
            title: '<?= ($lang == "id") ? "Networking Strategis" : "Strategic Networking" ?>',
            description: '<?= ($lang == "id") ? "Bangun jaringan profesional di bidang yang sesuai dengan minat dan bakat Anda." : "Build professional networks in fields that match your interests and talents." ?>',
            icon: 'fa-network-wired'
        },
        {
            title: '<?= ($lang == "id") ? "Pendidikan Lanjutan" : "Further Education" ?>',
            description: '<?= ($lang == "id") ? "Pertimbangkan kursus atau sertifikasi untuk mengembangkan keahlian spesifik." : "Consider courses or certifications to develop specific expertise." ?>',
            icon: 'fa-graduation-cap'
        },
        {
            title: '<?= ($lang == "id") ? "Mentorship" : "Mentorship" ?>',
            description: '<?= ($lang == "id") ? "Cari mentor yang dapat membimbing pengembangan karir Anda." : "Find a mentor who can guide your career development." ?>',
            icon: 'fa-user-graduate'
        }
    ];

    // Variabel test
    let currentQuestionTest = 0;
    let userAnswersTest = [];
    const totalQuestionsTest = testQuestions.length;
    const traitScores = {
        extraversion: 0,
        introversion: 0,
        sensing: 0,
        intuition: 0,
        thinking: 0,
        feeling: 0,
        judging: 0,
        perceiving: 0,
        realistic: 0,
        investigative: 0,
        artistic: 0,
        social: 0,
        enterprising: 0,
        conventional: 0
    };

    // Fungsi untuk memuat pertanyaan
    function loadQuestionTest(index) {
        const question = testQuestions[index];
        
        // Update display
        document.getElementById('currentQuestion').textContent = index + 1;
        document.getElementById('questionCategory').textContent = question.category;
        document.getElementById('questionText').textContent = question.question;
        
        // Update progress bar
        const progress = ((index + 1) / totalQuestionsTest) * 100;
        document.getElementById('progressFill').style.width = `${progress}%`;
        document.getElementById('progressPercentage').textContent = `${Math.round(progress)}%`;
        
        // Load pertanyaan berdasarkan tipe
        if (question.type === 'scale') {
            document.getElementById('scaleOptions').style.display = 'flex';
            document.getElementById('optionsGrid').style.display = 'none';
            loadScaleOptions(question);
        } else if (question.type === 'multiple') {
            document.getElementById('scaleOptions').style.display = 'none';
            document.getElementById('optionsGrid').style.display = 'grid';
            loadMultipleOptions(question);
        }
        
        // Update tombol navigasi
        document.getElementById('prevBtnTest').disabled = index === 0;
        
        if (index === testQuestions.length - 1) {
            document.getElementById('nextBtnTest').style.display = 'none';
            document.getElementById('finishBtnTest').style.display = 'flex';
        } else {
            document.getElementById('nextBtnTest').style.display = 'flex';
            document.getElementById('finishBtnTest').style.display = 'none';
        }
        
        // Restore previous answer if exists
        restoreAnswer(index);
    }

    // Fungsi untuk memuat opsi skala
    function loadScaleOptions(question) {
        const scaleOptions = document.getElementById('scaleOptions');
        scaleOptions.innerHTML = '';
        
        question.scaleLabels.forEach((label, index) => {
            const scaleOption = document.createElement('div');
            scaleOption.className = 'scale-option';
            
            const input = document.createElement('input');
            input.type = 'radio';
            input.name = 'scaleOption';
            input.value = index + 1;
            input.className = 'scale-radio';
            input.id = `scale${index}`;
            input.onchange = () => selectScaleOption(index + 1, question.trait);
            
            const labelElement = document.createElement('label');
            labelElement.className = 'scale-label';
            labelElement.htmlFor = `scale${index}`;
            labelElement.textContent = label;
            
            scaleOption.appendChild(input);
            scaleOption.appendChild(labelElement);
            scaleOptions.appendChild(scaleOption);
        });
    }

    // Fungsi untuk memuat opsi multiple choice
    function loadMultipleOptions(question) {
        const optionsGrid = document.getElementById('optionsGrid');
        optionsGrid.innerHTML = '';
        
        question.options.forEach(option => {
            const optionItem = document.createElement('div');
            optionItem.className = 'option-item';
            optionItem.onclick = () => selectMultipleOption(optionItem, option.letter, question.trait);
            
            const letterDiv = document.createElement('div');
            letterDiv.className = 'option-letter';
            letterDiv.textContent = option.letter;
            
            const textDiv = document.createElement('div');
            textDiv.className = 'option-text';
            textDiv.textContent = option.text;
            
            optionItem.appendChild(letterDiv);
            optionItem.appendChild(textDiv);
            optionsGrid.appendChild(optionItem);
        });
    }

    // Fungsi untuk memilih opsi skala
    function selectScaleOption(value, trait) {
        userAnswersTest[currentQuestionTest] = {
            questionId: testQuestions[currentQuestionTest].id,
            type: 'scale',
            value: value,
            trait: trait
        };
        
        // Update trait score
        updateTraitScore(trait, value);
    }

    // Fungsi untuk memilih opsi multiple choice
    function selectMultipleOption(element, letter, trait) {
        // Remove selected class from all options
        document.querySelectorAll('.option-item').forEach(item => {
            item.classList.remove('selected');
        });
        
        // Add selected class to clicked option
        element.classList.add('selected');
        
        userAnswersTest[currentQuestionTest] = {
            questionId: testQuestions[currentQuestionTest].id,
            type: 'multiple',
            value: letter,
            trait: trait
        };
        
        // Update trait score (simplified)
        updateTraitScore(trait, 3); // Default value for multiple choice
    }

    // Fungsi untuk mengupdate skor trait
    function updateTraitScore(trait, value) {
        // For scale questions: 1-5 scale, for multiple: default 3
        const scoreValue = value;
        
        switch(trait) {
            case 'extraversion':
                traitScores.extraversion += scoreValue;
                break;
            case 'introversion':
                traitScores.introversion += scoreValue;
                break;
            case 'sensing':
                traitScores.sensing += scoreValue;
                break;
            case 'intuition':
                traitScores.intuition += scoreValue;
                break;
            case 'thinking':
                traitScores.thinking += scoreValue;
                break;
            case 'feeling':
                traitScores.feeling += scoreValue;
                break;
            case 'judging':
                traitScores.judging += scoreValue;
                break;
            case 'perceiving':
                traitScores.perceiving += scoreValue;
                break;
            case 'realistic':
                traitScores.realistic += scoreValue;
                break;
            case 'investigative':
                traitScores.investigative += scoreValue;
                break;
            case 'artistic':
                traitScores.artistic += scoreValue;
                break;
            case 'social':
                traitScores.social += scoreValue;
                break;
        }
    }

    // Fungsi untuk restore jawaban sebelumnya
    function restoreAnswer(index) {
        const answer = userAnswersTest[index];
        if (!answer) return;
        
        if (answer.type === 'scale') {
            const radio = document.querySelector(`input[value="${answer.value}"]`);
            if (radio) {
                radio.checked = true;
                radio.nextElementSibling.classList.add('selected');
            }
        } else if (answer.type === 'multiple') {
            const optionItems = document.querySelectorAll('.option-item');
            optionItems.forEach(item => {
                if (item.querySelector('.option-letter').textContent === answer.value) {
                    item.classList.add('selected');
                }
            });
        }
    }

    // Fungsi untuk pertanyaan berikutnya
    function nextQuestionTest() {
        if (currentQuestionTest < testQuestions.length - 1) {
            currentQuestionTest++;
            loadQuestionTest(currentQuestionTest);
            // Scroll ke atas pertanyaan
            document.getElementById('questionDisplay').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    // Fungsi untuk pertanyaan sebelumnya
    function prevQuestionTest() {
        if (currentQuestionTest > 0) {
            currentQuestionTest--;
            loadQuestionTest(currentQuestionTest);
            // Scroll ke atas pertanyaan
            document.getElementById('questionDisplay').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    // Fungsi untuk menyelesaikan test
    function finishTest() {
        calculateResults();
        showResults();
    }

    // Fungsi untuk menghitung hasil
    function calculateResults() {
        // Calculate MBTI type based on trait scores
        const mbtiType = determineMBTIType();
        return mbtiType;
    }

    // Fungsi untuk menentukan tipe MBTI
    function determineMBTIType() {
        // Simplified MBTI calculation
        let mbti = '';
        
        // E/I
        mbti += traitScores.extraversion > traitScores.introversion ? 'E' : 'I';
        
        // S/N
        mbti += traitScores.sensing > traitScores.intuition ? 'S' : 'N';
        
        // T/F
        mbti += traitScores.thinking > traitScores.feeling ? 'T' : 'F';
        
        // J/P
        mbti += traitScores.judging > traitScores.perceiving ? 'J' : 'P';
        
        return mbti;
    }

    // Fungsi untuk menampilkan hasil
    function showResults() {
        const mbtiType = determineMBTIType();
        const personality = personalityTypes[mbtiType] || personalityTypes['ENFJ'];
        
        // Update personality result
        document.getElementById('resultIcon').className = `fas ${personality.icon}`;
        document.getElementById('personalityType').textContent = personality.name;
        document.getElementById('personalityLabel').textContent = personality.label;
        document.getElementById('personalityDescription').textContent = personality.description;
        
        // Update trait scores display
        updateTraitScoresDisplay();
        
        // Update career recommendations
        updateCareerRecommendations(personality.careers);
        
        // Update development suggestions
        updateDevelopmentSuggestions();
        
        // Hide test, show results
        document.getElementById('mulai-test').style.display = 'none';
        document.getElementById('resultSectionTest').style.display = 'block';
        
        // Scroll to results
        document.getElementById('resultSectionTest').scrollIntoView({ behavior: 'smooth' });
    }

    // Fungsi untuk update trait scores display
    function updateTraitScoresDisplay() {
        const traitScoresElement = document.getElementById('traitScores');
        traitScoresElement.innerHTML = '';
        
        const traits = [
            { name: '<?= ($lang == "id") ? "Ekstraversi" : "Extraversion" ?>', key: 'extraversion', max: 25 },
            { name: '<?= ($lang == "id") ? "Intuisi" : "Intuition" ?>', key: 'intuition', max: 25 },
            { name: '<?= ($lang == "id") ? "Perasaan" : "Feeling" ?>', key: 'feeling', max: 25 },
            { name: '<?= ($lang == "id") ? "Penilaian" : "Judging" ?>', key: 'judging', max: 25 }
        ];
        
        traits.forEach(trait => {
            const traitScore = document.createElement('div');
            traitScore.className = 'trait-score';
            
            const score = traitScores[trait.key] || 0;
            const percentage = Math.min(100, Math.round((score / trait.max) * 100));
            
            traitScore.innerHTML = `
                <div class="trait-name">${trait.name}</div>
                <div class="trait-value">${score}</div>
                <div class="trait-bar">
                    <div class="trait-fill" style="width: ${percentage}%"></div>
                </div>
                <div class="trait-label">${percentage}%</div>
            `;
            
            traitScoresElement.appendChild(traitScore);
        });
    }

    // Fungsi untuk update career recommendations
    function updateCareerRecommendations(careers) {
        const careerGrid = document.getElementById('careerGrid');
        careerGrid.innerHTML = '';
        
        careers.forEach(career => {
            const careerCard = document.createElement('div');
            careerCard.className = 'career-card';
            
            careerCard.innerHTML = `
                <div class="career-icon">
                    <i class="fas ${career.icon}"></i>
                </div>
                <h4 class="career-name">${career.name}</h4>
                <p class="career-description">
                    <?= ($lang == "id") 
                        ? "Karir yang sangat cocok dengan profil kepribadian dan minat Anda." 
                        : "A career that highly matches your personality profile and interests." ?>
                </p>
                <span class="career-match">Kecocokan: ${career.match}</span>
            `;
            
            careerGrid.appendChild(careerCard);
        });
    }

    // Fungsi untuk update development suggestions
    function updateDevelopmentSuggestions() {
        const developmentGrid = document.getElementById('developmentGrid');
        developmentGrid.innerHTML = '';
        
        developmentSuggestions.forEach(suggestion => {
            const suggestionCard = document.createElement('div');
            suggestionCard.className = 'career-card';
            
            suggestionCard.innerHTML = `
                <div class="career-icon">
                    <i class="fas ${suggestion.icon}"></i>
                </div>
                <h4 class="career-name">${suggestion.title}</h4>
                <p class="career-description">${suggestion.description}</p>
            `;
            
            developmentGrid.appendChild(suggestionCard);
        });
    }

    // Fungsi untuk restart test
    function restartTest() {
        currentQuestionTest = 0;
        userAnswersTest = [];
        
        // Reset trait scores
        Object.keys(traitScores).forEach(key => {
            traitScores[key] = 0;
        });
        
        // Reset display
        document.getElementById('resultSectionTest').style.display = 'none';
        document.getElementById('mulai-test').style.display = 'block';
        
        // Restart
        loadQuestionTest(0);
        
        // Scroll to test
        document.getElementById('mulai-test').scrollIntoView({ behavior: 'smooth' });
    }

    // Fungsi untuk download report (placeholder)
    function downloadReport() {
        alert('<?= ($lang == "id") ? "Fitur download laporan lengkap akan tersedia setelah login!" : "Full report download feature will be available after login!" ?>');
    }

    // Fungsi untuk toggle FAQ
    function toggleFAQ(element) {
        const faqItem = element.parentElement;
        const faqAnswer = faqItem.querySelector('.faq-answer');
        
        // Toggle active class
        element.classList.toggle('active');
        
        // Toggle answer visibility
        if (faqAnswer.classList.contains('show')) {
            faqAnswer.classList.remove('show');
        } else {
            // Close other open FAQs
            document.querySelectorAll('.faq-answer.show').forEach(openAnswer => {
                openAnswer.classList.remove('show');
                openAnswer.previousElementSibling.classList.remove('active');
            });
            
            faqAnswer.classList.add('show');
        }
    }

    // Inisialisasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        loadQuestionTest(0);
    });
</script>

<?= $this->endSection(); ?>