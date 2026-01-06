<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?= isset($title) ? $title : 'Default Title'; ?></title>
    <meta name="description" content="<?= isset($meta_description) ? $meta_description : 'Default description for the website.'; ?>" />

    <?= $this->renderSection('meta'); ?>

    <!-- Vendor CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<style>
    /* =========================
    1) Design tokens (global)
    ========================= */
    :root {
        --bs-primary: #6F4E37;        /* Coffee Bean untuk elemen utama */
        --bs-warning: #D99A6C;        /* Light Bronze untuk aksen */
        --bs-body-bg: #FED8B1;        /* Soft Apricot untuk background body */
        --c-primary: #6F4E37;          /* Coffee Bean */
        --c-accent: #D99A6C;           /* Light Bronze */
        --c-secondary: #A67B5B;        /* Faded Copper untuk elemen sekunder */
        --c-text: #2D1B10;            /* Deep Cocoa untuk teks */
        --c-white: #ffffff;           /* Pure White */

        --icon-size: 13px;
        --text-size: 13px;
        --nav-text-size: 17px;

        --flag-w: 20px;
        --flag-h: 14px;
        --lang-btn-w: 60px;
        --lang-btn-h: 25px;

        --footer-gap-h: 90px;
        --footer-gap-wrap: 91px;
    }

    /* =========================
    2) Layout helpers
    ========================= */
    .header .container,
    .navbar-custom .container,
    .footer .container,
    .bottom-footer .container {
        padding-left: calc(20px + env(safe-area-inset-left));
        padding-right: calc(20px + env(safe-area-inset-right));
    }

    .divider-vert {
        width: 1.5px;
        height: 40px;
        background: #fff;
        margin: 0 15px 0 0;
        flex: 0 0 auto;
    }

    .divider-vert--sm {
        height: 20px;
        margin: 0 16px;
        background: rgba(255, 255, 255, .8);
    }

    /* =========================
    3) Topbar (Light Bronze)
    ========================= */
    .topbar {
        background: var(--c-accent); /* Light Bronze */
        color: var(--c-white);
    }

    .topbar .head {
        min-height: 30px;
    }

    .topbar .icon {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .topbar .icon i,
    .topbar .icon p,
    .topbar .icon a {
        color: var(--c-white);
        text-decoration: none;
        font-size: var(--text-size);
    }

    .topbar .icon i {
        font-size: var(--icon-size);
    }

    .topbar .icon a:hover,
    .topbar .icon p:hover,
    .topbar .icon i:hover {
        color: var(--c-primary);
    }

    .topbar .sosmed {
        display: flex;
        align-items: center;
        gap: 6px;
        margin: 0;
        padding: 0;
    }

    .topbar .social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        color: var(--c-white);
        text-decoration: none;
        transition: transform .2s ease, color .2s ease;
    }

    .topbar .social-link:hover {
        color: var(--c-primary);
        transform: scale(1.1);
    }

    .topbar .language-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        width: var(--lang-btn-w);
        height: var(--lang-btn-h);
        padding: 0;
        background: transparent;
        border: 1px solid var(--c-white);
        border-radius: 6px;
        color: var(--c-white);
        transition: background .3s, border-color .3s, transform .2s;
    }

    .topbar .language-btn:hover {
        background: var(--c-primary); /* Coffee Bean */
        border-color: var(--c-primary);
        transform: translateY(-1px);
    }

    .topbar .flag-icon {
        width: var(--flag-w);
        height: var(--flag-h);
        object-fit: cover;
        display: block;
        transition: transform .3s;
    }

    .topbar .language-btn:hover .flag-icon {
        transform: scale(1.05);
    }

    #languageDropdown i {
        font-size: 12px;
        color: var(--c-white);
        line-height: 1;
    }

    .topbar .dropdown-menu {
        position: absolute;
        z-index: 1050;
        border-radius: 8px;
        overflow: hidden;
        right: 0;
        left: auto;
        top: 100%;
    }

    .topbar .dropdown-item {
        color: var(--c-text); /* Deep Cocoa */
        padding: 10px 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
        transition: color .2s, background .2s;
    }

    .topbar .dropdown-item img.flag-icon {
        width: var(--flag-w);
        height: var(--flag-h);
        object-fit: cover;
        flex: 0 0 auto;
    }

    .topbar .dropdown-item:hover {
        color: #ECB176; /* Light Caramel */
        background: rgba(0, 0, 0, .04);
    }

    /* =========================
    4) Navbar (Coffee Bean)
    ========================= */
    .navbar-custom {
        background: var(--c-primary); /* Coffee Bean */
        transition: background-color .3s, padding 1s;
    }

    .navbar-custom.scrolled {
        padding: 13px 0;
        border-bottom: inset;
        border-width: 5px;
        border-color: #ECB176; /* Light Caramel */
    }

    .navbar-custom .container {
        display: flex;
        align-items: center;
    }

    .navbar-custom .nav-link {
        color: var(--c-white);
    }

    .kei {
        margin-left: 0 !important;
        width: auto;
        max-width: 140px;
        cursor: pointer;
    }

    .navbar .navbar-nav .nav-link,
    .navbar .dropdown-item {
        color: var(--c-white);
        font-weight: 500;
        padding: 10px 15px;
        position: relative;
        transition: color .3s;
        font-size: var(--nav-text-size);
    }

    .navbar .navbar-nav .nav-link:hover,
    .navbar .dropdown-item:hover {
        color: #ECB176; /* Light Caramel */
    }

    /* underline animasi */
    .navbar .navbar-nav .nav-link::before,
    .navbar .dropdown-item::before {
        content: "";
        position: absolute;
        left: 50%;
        bottom: 0;
        width: 0;
        height: 3px;
        background: #ECB176; /* Light Caramel */
        visibility: hidden;
        transition: all .3s;
        transform: translateX(-50%);
    }

    .navbar .navbar-nav .nav-link:hover::before,
    .navbar .dropdown-item:hover::before {
        visibility: visible;
        width: 100%;
    }

    /* dropdown (desktop) */
    .navbar .dropdown-menu {
        position: absolute;
        z-index: 1050;
        border-radius: 8px;
        overflow: hidden;
        left: 0;
        right: auto;
        top: 100%;
        min-width: 0;
    }

    .navbar .dropdown-menu .dropdown-item {
        color: var(--c-text); /* Deep Cocoa */
        background: var(--c-white);
    }

    .navbar .dropdown-menu .dropdown-item:hover {
        color: #ECB176; /* Light Caramel */
        background: rgba(0, 0, 0, .04);
    }

    .login-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        width: 60px;
        height: 35px;
        padding: 0;
        background: transparent;
        border: 1px solid var(--c-white);
        border-radius: 6px;
        color: var(--c-white);
        font-weight: 500;
        text-decoration: none;
        font-size: var(--nav-text-size);
        transition: background .3s, border-color .3s, transform .2s;
    }

    .login-btn:hover {
        background: rgba(236, 177, 118, .12); /* Light Caramel dengan transparansi */
    }

    .navbar-toggler {
        border: 1px solid #fff;
        border-radius: 6px;
        background: transparent;
        width: var(--lang-btn-w);
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .navbar-toggler .navbar-toggler-icon {
        display: inline-block;
        width: 1em;
        height: 1.5em;
        background-image: var(--bs-navbar-toggler-icon-bg);
        background-repeat: no-repeat;
        background-position: center;
        background-size: 100%;
    }

    .navbar-toggler:hover {
        background: rgba(236, 177, 118, .12); /* Light Caramel dengan transparansi */
        border-color: var(--c-white);
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    /* =========================
    5) Footer (global)
    ========================= */
    .footer-wrap {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: var(--footer-gap-wrap);
    }

    .right-footer {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: var(--footer-gap-h);
    }

    .logo-footer {
        width: 180px;
    }

    .text-footer {
        margin: 20px 0;
        text-align: justify;
        font-weight: 500;
        width: 600px;
        font-size: var(--nav-text-size);
        color: var(--c-text); /* Deep Cocoa */
    }

    .social-big {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .Btn {
        border: none;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: width .4s ease, border-radius .4s ease, background .3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .Btn:hover {
        width: 110px;
        border-radius: 30px;
    }

    .Btn .text {
        position: absolute;
        color: #fff;
        width: 120px;
        font-weight: 600;
        opacity: 0;
        transition: opacity .4s ease;
        text-align: center;
    }

    .Btn .svgIcon {
        transition: opacity .3s ease;
    }

    .Btn:hover .text {
        opacity: 1;
    }

    .Btn:hover .svgIcon {
        opacity: 0;
    }

    .instagram {
        background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
    }

    .youtube {
        background: #ff0000;
    }

    .facebook {
        background: var(--c-primary); /* Coffee Bean */
    }

    .facebook:hover {
        background: #5a3e2c; /* Coffee Bean yang lebih gelap */
    }

    .bottom-footer-bar {
        background: var(--c-accent); /* Light Bronze */
        padding: 12px 0;
    }

    .bottom-footer-bar p {
        margin: 0;
        text-align: center;
        color: #fff;
        font-size: var(--nav-text-size);
        font-weight: 500;
    }

    /* =========================
    6) WhatsApp Float
    ========================= */
    .whatsapp-float {
        position: fixed;
        width: 50px;
        height: 50px;
        bottom: 20px;
        right: 30px;
        background: #25d366;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        box-shadow: 2px 2px 3px #999;
        z-index: 1100;
    }

    .whatsapp-float:hover {
        background: #128c7e;
        text-decoration: none;
    }

    /* =========================
    7) Footer links underline
    ========================= */
    .footer-link {
        color: #fff;
        text-decoration: none;
        position: relative;
        transition: color .3s;
    }

    .footer-link:hover {
        color: #ECB176; /* Light Caramel */
    }

    .footer-link::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 0;
        height: 2px;
        background: #ECB176; /* Light Caramel */
        transition: width .3s;
    }

    .footer-link:hover::after {
        width: 100%;
    }

    /* =========================
    8) Section helpers
    ========================= */
    .section--navbar {
        background: var(--c-primary); /* Coffee Bean */
    }

    .section--topbar {
        background: var(--c-accent); /* Light Bronze */
    }

    /* =========================================================
    9) BREAKPOINTS
    ========================================================= */

    /* ≤ 991px: mobile navbar dropdown + footer jadi kolom */
    @media (max-width: 991px) {
        :root {
            --footer-gap-h: 12px;
            --footer-gap-wrap: 14px;
        }

        .navbar .navbar-nav .nav-link {
            padding: 5px 5px;
        }

        .navbar .navbar-nav .nav-link::before,
        .navbar .dropdown-item::before {
            height: 1.5px;
        }

        /* Mobile dropdown navbar */
        .navbar .dropdown-menu {
            position: static !important;
            background: transparent !important;
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            text-align: center;
        }

        .navbar .dropdown-menu .dropdown-item {
            color: #ECB176 !important; /* Light Caramel */
            background: transparent !important;
            font-size: 13px !important;
            border-bottom: 1px solid rgba(255, 255, 255, .1);
            transition: color .25s ease, background .25s ease, transform .2s;
            justify-content: center;
        }

        .navbar .dropdown-menu .dropdown-item:hover {
            color: var(--c-white) !important;
            transform: translateY(-1px);
        }

        .navbar .dropdown-item::before,
        .navbar .dropdown-item:hover::before {
            display: none !important;
        }

        .navbar .dropdown-menu .dropdown-item:last-child {
            border-bottom: none;
        }

        .login-btn {
            margin-top: 10px;
        }

        /* Footer kolom */
        .footer-wrap {
            gap: var(--footer-gap-wrap) !important;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .left-footer,
        .right-footer {
            align-items: center !important;
            text-align: center !important;
        }

        .right-footer {
            gap: var(--footer-gap-h) !important;
            flex-direction: column !important;
            justify-content: center !important;
        }

        .menu-footer {
            text-align: center !important;
            max-width: 92vw;
            margin-inline: auto;
            font-size: var(--nav-text-size);
        }

        .menu-footer h5 {
            margin: 0 0 6px;
        }

        .menu-footer ul {
            padding: 0;
            margin: 0;
        }

        .menu-footer li {
            margin: 4px 0;
        }

        .social-big {
            flex-direction: row !important;
            flex-wrap: nowrap;
            gap: 8px;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .logo-footer {
            max-width: 120px;
            margin-inline: auto;
        }

        .text-footer {
            margin: 10px 0 8px;
            font-size: var(--nav-text-size);
            width: auto;
            max-width: 92vw;
            text-align: justify;
            color: var(--c-text); /* Deep Cocoa */
        }
    }

    /* ≤ 768px: sedikit kecilkan font & tombol bahasa */
    @media (max-width: 768px) {
        :root {
            --icon-size: 12px;
            --text-size: 12px;
            --nav-text-size: 15px;
            --flag-w: 18px;
            --flag-h: 12px;
            --lang-btn-w: 45px;
            --lang-btn-h: 20px;
            --footer-gap-h: 10px;
            --footer-gap-wrap: 10px;
        }

        .topbar .icon .d-flex {
            flex-direction: row;
            gap: 4px !important;
        }

        .topbar .icon .ms-2 {
            margin-left: 0 !important;
        }

        .divider-vert--sm {
            margin: 0 8px !important;
        }

        .topbar .language-btn {
            height: var(--lang-btn-h);
            padding: 0 6px;
            gap: 4px;
        }

        .topbar .dropdown-menu {
            right: 0;
            left: auto;
            min-width: 130px;
            max-width: 180px;
            padding: 6px;
            border-radius: 8px;
            transform-origin: top right;
            max-height: 50vh;
            overflow-y: auto;
        }

        .topbar .dropdown-item {
            padding: 6px 10px;
            font-size: 11px;
            line-height: 1.15;
            gap: 8px;
        }

        .topbar .dropdown-item .flag-icon {
            width: 16px;
            height: 11px;
        }
    }

    /* ≤ 576px: kompres icon, sosmed, dll */
    @media (max-width: 576px) {
        :root {
            --icon-size: 11px;
            --text-size: 11px;
            --nav-text-size: 13px;
            --flag-w: 16px;
            --flag-h: 10px;
            --lang-btn-w: 28px;
            --lang-btn-h: 20px;
            --footer-gap-h: 8px;
            --footer-gap-wrap: 10px;
        }

        .topbar .icon .d-flex {
            flex-direction: row;
            gap: 4px !important;
        }

        .topbar .sosmed {
            gap: 3px !important;
            margin-right: 8px !important;
        }

        .topbar .icon {
            align-items: center !important;
            gap: 4px !important;
        }

        .topbar .icon .ms-2 {
            margin-left: 0 !important;
        }

        .topbar .social-link {
            width: 19px !important;
            height: 19px !important;
            font-size: 14px !important;
        }

        .topbar .social-link i {
            font-size: 15px !important;
        }

        .divider-vert--sm {
            margin: 0 8px !important;
        }

        .divider-vert--sm,
        #languageDropdown .bi-chevron-down {
            display: none !important;
        }

        .kei {
            max-width: 110px;
        }

        .topbar .language-btn {
            height: var(--lang-btn-h);
            padding: 0 6px;
            gap: 4px;
        }

        .navbar .dropdown-menu .dropdown-item {
            font-size: 11px !important;
        }

        .navbar-toggler .navbar-toggler-icon {
            width: .7em;
            height: 1.2em;
        }

        .instagram,
        .youtube,
        .facebook {
            width: 40px;
            height: 40px;
        }
    }

    /* ≤ 425px: topbar kontak jadi bertumpuk, nav lebih rapat */
    @media (max-width: 425px) {
        :root {
            --icon-size: 9px;
            --text-size: 9px;
            --nav-text-size: 12px;
            --flag-w: 16px;
            --flag-h: 12px;
            --lang-btn-w: 28px;
            --lang-btn-h: 20px;
            --footer-gap-h: 12px;
        }

        .topbar .icon {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 0 !important;
        }

        .topbar .icon .d-flex {
            flex-direction: row;
            gap: 4px !important;
        }

        .topbar .icon .ms-2 {
            margin-left: 0 !important;
        }

        .kei {
            max-width: 90px;
        }

        .navbar .navbar-nav .nav-link {
            padding: 3px 5px;
        }

        .navbar .navbar-nav .nav-link::before,
        .navbar .dropdown-item::before {
            height: 1.5px;
        }

        /* underline parent nav saat dropdown mobile (diaktifkan via JS) */
        .navbar .nav-item.dropdown>.nav-link.is-open::before {
            visibility: visible;
            width: 100%;
        }

        .navbar .dropdown-menu .dropdown-item {
            font-size: 8px !important;
        }

        .login-btn {
            margin-top: 6px;
            max-width: 50px;
            max-height: 23px;
        }

        .navbar-toggler .navbar-toggler-icon {
            width: .7em;
            height: 1.2em;
        }

        /* Footer extra tweak */
        .social-big p {
            display: inline-block;
            margin: 0;
        }

        .instagram,
        .youtube,
        .facebook {
            width: 30px;
            height: 30px;
        }

        .logo-footer {
            max-width: 130px;
            margin-inline: auto;
        }
    }

    /* ≤ 360px: paling kecil, turunkan semua ukuran lagi */
    @media (max-width: 360px) {
        :root {
            --icon-size: 8px;
            --text-size: 8px;
            --nav-text-size: 10px;
            --flag-w: 14px;
            --flag-h: 10px;
            --lang-btn-w: 24px;
            --lang-btn-h: 18px;
            --footer-gap-h: 12px;
            --footer-gap-wrap: 14px;
        }

        .navbar-toggler .navbar-toggler-icon {
            width: .7em;
            height: 1.1em;
        }

        .logo-footer {
            max-width: 90px;
            margin-inline: auto;
        }
    }
</style>

</head>

<body>
    <?php
    // =======================
    // PHP: data & i18n links
    // =======================
    $lang = session()->get('lang') ?? 'id';

    $current_url  = uri_string();              // contoh: "id/about-us" atau "about-us"
    $query_string = $_SERVER['QUERY_STRING'] ?? '';

    // deteksi segmen bahasa di awal path
    $firstSlashPos = strpos($current_url, '/');
    $firstSegment  = $firstSlashPos !== false ? substr($current_url, 0, $firstSlashPos) : $current_url;
    $hasLangSeg    = in_array($firstSegment, ['id', 'en'], true);
    $lang_segment  = $hasLangSeg ? ($firstSegment . '/') : '';

    // Link statis by language
    $aboutLink          = ($lang_segment === 'en/') ? 'about-us'         : 'tentang-kami';
    $belajarEksporLink  = ($lang_segment === 'en/') ? 'lessons'          : 'materi';
    $pendaftaranLink    = ($lang_segment === 'en/') ? 'registration'     : 'pendaftaran';
    $videoTutorialLink  = ($lang_segment === 'en/') ? 'videos'           : 'video';
    $simulasiWawancaraLink = ($lang_segment === 'en/') ? 'interview-simulation' : 'simulasi-wawancara';
    $memberLink         = 'data-member';
    $buyersLink         = 'data-buyers';
    $SyaratKetentuanLink = ($lang_segment === 'en/') ? 'terms-conditions' : 'syarat-ketentuan';

    // Peta translasi segmen ketika toggle bahasa
    $replace_map = [
        'tentang-kami'     => 'about-us',
        'pendaftaran'      => 'registration',
        'materi'           => 'lessons',
        'kategori'         => 'category',
        'video'            => 'videos',
        'simulasi-wawancara' => 'interview-simulation',
        'syarat-ketentuan' => 'terms-conditions',
    ];

    // Buat url tanpa segmen bahasa awal
    $url_without_lang = $lang_segment ? substr($current_url, strlen($lang_segment)) : $current_url;

    // Tentukan segmen baru (toggle)
    $new_lang_segment = ($lang === 'en') ? 'id/' : 'en/';

    // Toggle peta segmen sesuai arah
    foreach ($replace_map as $id_seg => $en_seg) {
        if ($lang === 'en') {
            // dari EN ke ID
            $url_without_lang = str_replace($en_seg, $id_seg, $url_without_lang);
        } else {
            // dari ID ke EN
            $url_without_lang = str_replace($id_seg, $en_seg, $url_without_lang);
        }
    }

    // Susun url bersih untuk bahasa seberang
    $clean_url = ($new_lang_segment ?: '') . ltrim($url_without_lang, '/');
    if (!empty($query_string)) {
        $clean_url .= '?' . $query_string;
    }

    // Target final untuk dropdown
    // - Jika sekarang ID, maka:
    //     * "Indonesian" -> current_url (disabled)
    //     * "English"    -> base_url($clean_url)
    // - Jika sekarang EN, maka kebalikannya.
    $url_current_full = current_url(true); // CI uri object; otomatis gunakan string saat echo
    if ($lang === 'id') {
        $url_indonesia = (string)$url_current_full;
        $url_english   = base_url($clean_url);
    } else { // 'en'
        $url_english   = (string)$url_current_full;
        $url_indonesia = base_url($clean_url);
    }

    // Webprofile fallback
    $profile = $webprofile[0] ?? [
        'logo_web'        => 'logo.png',
        'footer_text'     => '',
        'nohp_web'        => '',
        'email_web'       => '',
        'link_ig_web'     => '#',
        'link_yt_web'     => '#',
        'link_fb_web'     => '#',
        'deskripsi_web'   => '',
        'deskripsi_web_en' => ''
    ];
    ?>

    <!-- ================= Header / Topbar ================= -->
    <header class="header topbar section--topbar">
        <div class="container">
            <div class="head d-flex justify-content-between align-items-center py-2" style="width:100%;">
                <!-- Kontak kiri -->
                <div class="icon">
                    <div class="d-flex align-items-center gap-1 icon-text text-light">
                        <i class="fas fa-phone"></i>
                        <a href="https://wa.me/<?= esc($profile['nohp_web']) ?>" target="_blank" rel="noopener">
                            <p class="mb-0"><?= esc($profile['nohp_web']) ?></p>
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-1 icon-text text-light ms-2">
                        <i class="fas fa-envelope"></i>
                        <p class="mb-0"><?= esc($profile['email_web']) ?></p>
                    </div>
                </div>

                <!-- Sosmed + Bahasa -->
                <div class="d-flex align-items-center">
                    <div class="sosmed">
                        <a href="<?= esc($profile['link_ig_web']) ?>" target="_blank" rel="noopener" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="<?= esc($profile['link_yt_web']) ?>" target="_blank" rel="noopener" class="social-link" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="<?= esc($profile['link_fb_web']) ?>" target="_blank" rel="noopener" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </div>

                    <div class="divider-vert divider-vert--sm"></div>

                    <!-- Dropdown Bahasa -->
                    <div class="dropdown">
                        <button class="btn text-light language-btn" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Change language">
                            <img src="/img/flag-<?= $lang === 'id' ? 'id' : 'en'; ?>.png"
                                alt="<?= $lang === 'id' ? 'Indonesian' : 'English'; ?>"
                                class="flag-icon mb-0">
                            <i class="bi bi-chevron-down ms-0"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            <!-- Indonesian -->
                            <li>
                                <a class="dropdown-item <?= $lang === 'id' ? 'disabled' : '' ?>"
                                    href="<?= $lang === 'id' ? '#' : $url_indonesia ?>"
                                    <?= $lang === 'id' ? 'style="pointer-events:none; opacity:0.5;"' : '' ?>>
                                    <img src="/img/flag-id.png" alt="Indonesian" class="flag-icon" <?= $lang === 'id' ? 'style="filter:grayscale(100%);"' : '' ?>>
                                    Indonesian
                                </a>
                            </li>
                            <!-- English -->
                            <li>
                                <a class="dropdown-item <?= $lang === 'en' ? 'disabled' : '' ?>"
                                    href="<?= $lang === 'en' ? '#' : $url_english ?>"
                                    <?= $lang === 'en' ? 'style="pointer-events:none; opacity:0.5;"' : '' ?>>
                                    <img src="/img/flag-en.png" alt="English" class="flag-icon" <?= $lang === 'en' ? 'style="filter:grayscale(100%);"' : '' ?>>
                                    English
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End kanan -->
            </div>
        </div>
    </header>

    <!-- ================= Navbar ================= -->
    <nav class="navbar navbar-custom navbar-expand-lg sticky-top section--navbar">
        <div class="container d-flex justify-content-between align-items-center py-1">
            <a href="/" class="d-inline-block">
                <img class="kei" onclick="window.location.href='/'" src="<?= base_url('img/' . $profile['logo_web']); ?>" alt="logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/') ?>"><?= lang('Blog.headerBeranda'); ?></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(($lang_segment ?: ($lang . '/')) . $aboutLink) ?>">
                            <?= lang('Blog.headerTentang'); ?>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <button class="btn nav-link" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= lang('Blog.headerArtikel'); ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-light">
                            <li>
                                <a class="dropdown-item nav-link d-flex" href="<?= base_url(($lang_segment ?: ($lang . '/')) . $belajarEksporLink) ?>">
                                    <?= lang('Blog.headerMateri'); ?>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link d-flex" href="<?= base_url(($lang_segment ?: ($lang . '/')) . $videoTutorialLink) ?>">
                                    <?= lang('Blog.headerVideo'); ?>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link d-flex" href="<?= base_url(($lang_segment ?: ($lang . '/')) . $simulasiWawancaraLink) ?>">
                                    <?= ($lang == 'id') ? 'Simulasi Wawancara' : 'Interview Simulation' ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('test-minat-bakat') ?>">
                                    <i class="fas fa-brain me-1"></i><?= ($lang == 'id') ? 'Test Minat & Bakat' : 'Interest & Talent Test' ?>
                                </a>
                            </li>
                            <!-- Tambahkan di navbar setelah test minat & bakat -->
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('smart-job-matching') ?>">
                                    <i class="fas fa-briefcase me-1"></i>
                                    <?php echo ($lang == 'id') ? 'Smart Job Matching' : 'Smart Job Matching'; ?>
                                </a>
                            </li>
                            <!-- Tambahkan di navbar setelah Smart Job Matching -->
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('position-fit-evaluation') ?>">
                                    <i class="fas fa-chart-line me-1"></i>
                                    <?php echo ($lang == 'id') ? 'Position Fit Evaluation' : 'Position Fit Evaluation'; ?>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(($lang_segment ?: ($lang . '/')) . $pendaftaranLink) ?>">
                            <?= lang('Blog.headerPendaftaran'); ?>
                        </a>
                    </li>

                    <div class="divider-vert d-none d-lg-block"></div>

                    <!-- Login -->
                    <li class="nav-item">
                        <a href="<?= base_url('/login') ?>" class="text-decoration-none">
                            <span class="login-btn"><?= lang('Blog.headerMasuk'); ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ================= Content ================= -->
    <div>
        <?= $this->renderSection('content'); ?>
    </div>
    <!-- ================= WhatsApp Float ================= -->
    <a href="https://wa.me/<?= esc($profile['nohp_web']) ?>" target="_blank" rel="noopener" class="whatsapp-float" aria-label="WhatsApp">
        <i class="fab fa-whatsapp whatsapp-icon"></i>
    </a>

<!-- ================= Footer ================= -->
<footer class="mt-5" style="color:#fff;">
    <div class="footer py-5" style="background-color:var(--c-primary);">
        <div class="container">
            <div class="row align-items-start">
                <!-- Logo dan Deskripsi (Kiri) -->
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="mb-4">
                        <img class="logo-footer" src="<?= base_url('img/' . $profile['logo_web']); ?>" alt="logo" style="max-width: 180px;">
                    </div>
                    <p class="text-light mb-0" style="opacity: 0.8; line-height: 1.6; font-size: 0.95rem;">
                        <?= ($lang === 'en') ? $profile['deskripsi_web_en'] : $profile['deskripsi_web']; ?>
                    </p>
                </div>
                
                <!-- Menu Links (Tengah) -->
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3" style="color: var(--c-accent); font-size: 1.1rem;">
                        <?= ($lang === 'en') ? 'Menu' : 'Menu' ?>
                    </h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="<?= base_url('/') ?>" 
                               class="footer-link" 
                               style="opacity: 0.8; text-decoration: none; font-size: 0.95rem; display: block; padding: 4px 0;">
                                <?= lang('Blog.headerBeranda'); ?>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="<?= base_url(($lang_segment ?: ($lang . '/')) . $aboutLink) ?>" 
                               class="footer-link" 
                               style="opacity: 0.8; text-decoration: none; font-size: 0.95rem; display: block; padding: 4px 0;">
                                <?= lang('Blog.headerTentang'); ?>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="<?= base_url(($lang_segment ?: ($lang . '/')) . $belajarEksporLink) ?>" 
                               class="footer-link" 
                               style="opacity: 0.8; text-decoration: none; font-size: 0.95rem; display: block; padding: 4px 0;">
                                <?= lang('Blog.headerMateri'); ?>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="<?= base_url(($lang_segment ?: ($lang . '/')) . $videoTutorialLink) ?>" 
                               class="footer-link" 
                               style="opacity: 0.8; text-decoration: none; font-size: 0.95rem; display: block; padding: 4px 0;">
                                <?= lang('Blog.headerVideo'); ?>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="<?= base_url(($lang_segment ?: ($lang . '/')) . $simulasiWawancaraLink) ?>" 
                               class="footer-link" 
                               style="opacity: 0.8; text-decoration: none; font-size: 0.95rem; display: block; padding: 4px 0;">
                                <?= ($lang == 'id') ? 'Simulasi Wawancara' : 'Interview Simulation' ?>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="<?= base_url(($lang_segment ?: ($lang . '/')) . $pendaftaranLink) ?>" 
                               class="footer-link" 
                               style="opacity: 0.8; text-decoration: none; font-size: 0.95rem; display: block; padding: 4px 0;">
                                <?= lang('Blog.headerPendaftaran'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Kontak Info (Tengah Kanan) -->
                <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3" style="color: var(--c-accent); font-size: 1.1rem;">
                        <?= ($lang === 'en') ? 'Contact Info' : 'Info Kontak' ?>
                    </h5>
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-phone me-3 mt-1" style="color: var(--c-accent); opacity: 0.8; min-width: 16px;"></i>
                            <span class="text-light" style="opacity: 0.8; font-size: 0.95rem; line-height: 1.4;">
                                <?= esc($profile['nohp_web']) ?>
                            </span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-envelope me-3" style="color: var(--c-accent); opacity: 0.8; min-width: 16px;"></i>
                            <span class="text-light" style="opacity: 0.8; font-size: 0.95rem; line-height: 1.4;">
                                <?= esc($profile['email_web']) ?>
                            </span>
                        </li>
                        <?php if (!empty($profile['alamat_web'])): ?>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-map-marker-alt me-3 mt-1" style="color: var(--c-accent); opacity: 0.8; min-width: 16px;"></i>
                            <span class="text-light" style="opacity: 0.8; line-height: 1.5; font-size: 0.95rem;">
                                <?= esc($profile['alamat_web']) ?>
                            </span>
                        </li>
                        <?php endif; ?>
                        <li class="d-flex align-items-center">
                            <i class="fas fa-clock me-3" style="color: var(--c-accent); opacity: 0.8; min-width: 16px;"></i>
                            <span class="text-light" style="opacity: 0.8; font-size: 0.95rem; line-height: 1.4;">
                                <?= ($lang === 'en') ? 'Mon-Fri: 9:00-17:00' : 'Sen-Jum: 09:00-17:00' ?>
                            </span>
                        </li>
                    </ul>
                </div>
                
                <!-- Social Media (Paling Kanan) -->
                <div class="col-lg-3 col-md-4">
                    <h5 class="fw-bold mb-3" style="color: var(--c-accent); font-size: 1.1rem;">
                        <?= ($lang === 'en') ? 'Follow Us' : 'Ikuti Kami' ?>
                    </h5>
                    <div class="social-big d-flex flex-column gap-3">
                        <a href="<?= esc($profile['link_ig_web']) ?>" target="_blank" rel="noopener" aria-label="Instagram" class="d-inline-block"> 
                            <button class="Btn instagram"> 
                                <svg class="svgIcon" viewBox="0 0 448 512" height="1.5em" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8z" fill="white"></path>
                                </svg> 
                                <span class="text">Instagram</span>
                            </button>
                        </a>
                        <a href="<?= esc($profile['link_yt_web']) ?>" target="_blank" rel="noopener" aria-label="YouTube" class="d-inline-block"> 
                            <button class="Btn youtube"> 
                                <svg class="svgIcon" viewBox="0 0 576 512" height="1.5em" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M549.655 148.28c-6.281-23.64-24.041-42.396-47.655-48.685C462.923 85 288 85 288 85S113.077 85 74 99.595c-23.614 6.289-41.374 25.045-47.655 48.685-12.614 47.328-12.614 147.717-12.614 147.717s0 100.39 12.614 147.718c6.281 23.64 24.041 42.396 47.655 48.684C113.077 427 288 427 288 427s174.923 0 214-14.595c23.614-6.289 41.374-25.045 47.655-48.685 12.614-47.328 12.614-147.718 12.614-147.718s0-100.389-12.614-147.717zM240 336V176l144 80-144 80z" fill="white"></path>
                                </svg> 
                                <span class="text">YouTube</span>
                            </button>
                        </a>
                        <a href="<?= esc($profile['link_fb_web']) ?>" target="_blank" rel="noopener" aria-label="Facebook" class="d-inline-block"> 
                            <button class="Btn facebook"> 
                                <svg class="svgIcon" viewBox="0 0 512 512" height="1.5em" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.5 90.7 225.9 209 240v-168h-63v-72h63v-55.2c0-62.2 37-96.8 93.6-96.8 27.1 0 55.4 4.8 55.4 4.8v61h-31.2c-30.8 0-40.4 19.1-40.4 38.7V256h68l-11 72h-57v168c118.3-14.1 209-116.5 209-240z" fill="white"></path>
                                </svg> 
                                <span class="text">Facebook</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Footer Bar -->
    <div class="bottom-footer-bar">
        <div class="container bottom-footer">
            <div style="margin: 0; text-align: center; color: #fff; font-size: var(--nav-text-size); font-weight: 500;">
                <?php 
                // Tampilkan footer text dari database (full dinamis)
                // Menghilangkan tag <p> jika ada di database
                $footer_text = !empty($profile['footer_text']) ? $profile['footer_text'] : '';
                
                // Hapus tag <p> jika ada
                $footer_text = strip_tags($footer_text);
                
                // Jika kosong, gunakan default
                if (empty($footer_text)) {
                    $footer_text = ($lang === 'en') 
                        ? '© 2024 Indonesian Export Community 24. All rights reserved.' 
                        : '© 2024 Komunitas Ekspor Indonesia 24. All rights reserved.';
                }
                
                echo esc($footer_text);
                ?>
            </div>
        </div>
    </div>
</footer>

    <!-- ================= Scripts ================= -->
    <script>
        (function() {
            // ===== 1) Navbar shrink on scroll (aman jika navbar tidak ada)
            const navbar = document.querySelector('.navbar-custom');
            if (navbar) {
                const onScroll = () => {
                    if (window.scrollY > 100) navbar.classList.add('scrolled');
                    else navbar.classList.remove('scrolled');
                };
                window.addEventListener('scroll', onScroll, {
                    passive: true
                });
                // jalankan sekali untuk state awal
                onScroll();
            }

            // ===== 2) Underline parent nav saat dropdown mobile (≤360px)
            const mq = window.matchMedia('(max-width: 360px)');

            function setUnderline(toggleEl, on) {
                if (toggleEl) toggleEl.classList.toggle('is-open', !!on);
            }

            function bindDropdownUnderline() {
                document.querySelectorAll('.navbar .dropdown').forEach(function(dd) {
                    const toggle = dd.querySelector('[data-bs-toggle="dropdown"]');
                    if (!toggle) return;

                    // Lepas listener lama bila ada
                    if (dd._onShowUnderline) dd.removeEventListener('show.bs.dropdown', dd._onShowUnderline);
                    if (dd._onHideUnderline) dd.removeEventListener('hide.bs.dropdown', dd._onHideUnderline);

                    dd._onShowUnderline = function() {
                        if (mq.matches) setUnderline(toggle, true);
                    };
                    dd._onHideUnderline = function() {
                        if (mq.matches) setUnderline(toggle, false);
                    };

                    dd.addEventListener('show.bs.dropdown', dd._onShowUnderline);
                    dd.addEventListener('hide.bs.dropdown', dd._onHideUnderline);
                });
            }

            // Pasang binding setelah DOM siap
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', bindDropdownUnderline);
            } else {
                bindDropdownUnderline();
            }

            // Bersihkan state saat keluar dari ≤360px
            const mqHandler = (e) => {
                if (!e.matches) {
                    document.querySelectorAll('.navbar .dropdown > [data-bs-toggle="dropdown"].is-open')
                        .forEach(el => el.classList.remove('is-open'));
                }
            };
            if (mq.addEventListener) mq.addEventListener('change', mqHandler);
            else if (mq.addListener) mq.addListener(mqHandler); // fallback browser lama

            // Tambahan defensif: saat resize ke lebar >360px
            window.addEventListener('resize', function() {
                if (!mq.matches) {
                    document.querySelectorAll('.navbar .dropdown > [data-bs-toggle="dropdown"].is-open')
                        .forEach(el => el.classList.remove('is-open'));
                }
            });
        })();
    </script>

    <!-- Vendor JS (letakkan di akhir body) -->
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <script src="https://vjs.zencdn.net/8.9.0/video.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>