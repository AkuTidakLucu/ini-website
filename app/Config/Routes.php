<?php

use App\Controllers\ApiController;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\KomunitasEkspor;
use App\Controllers\SimulasiController;
use App\Controllers\TestController;

/**
 * @var RouteCollection $routes
 */

// ===================================================
// 1. ROUTES PUBLIC (Tanpa Filter / Guest)
// ===================================================

//AI CHATBOT
$routes->get('/chat', [ApiController::class, "newChat"]);
$routes->get('/chat/c/(:num)', [ApiController::class, "index/$1"]);
$routes->group('api/v1', function () use ($routes) {
    $routes->post('send', [ApiController::class, 'sendAfterPrompt']);
    $routes->post('send/(:num)/user', [ApiController::class, 'sendAfterPrompt/$1']);
    $routes->get('send/(:num)/bot', [ApiController::class, 'send/$1']);
}
);

// Tambahkan di atas semua route lainnya
$routes->get('position-fit-evaluation', 'PositionFitController::index');
$routes->get('en/position-fit-evaluation', 'PositionFitController::index');

// Tambahkan di atas semua route lainnya
$routes->get('smart-job-matching', 'JobMatchingController::index');
$routes->get('en/smart-job-matching', 'JobMatchingController::index');

// ========== TEST MINAT & BAKAT ==========
$routes->get('test-minat-bakat', 'TestController::minatBakat');
$routes->get('test/minat-bakat', 'TestController::minatBakat');
$routes->get('id/test-minat-bakat', 'TestController::minatBakat');
$routes->get('en/interest-talent-test', 'TestController::minatBakat');

// ========== SIMULASI WAWANCARA ==========
$routes->get('simulasi-wawancara', 'SimulasiController::index');
$routes->get('en/interview-simulation', 'SimulasiController::index');
$routes->get('id/simulasi-wawancara', 'SimulasiController::index');

// ========== LOGOUT (Untuk Semua) ==========
$routes->get('logout', 'KomunitasEkspor::logout');
$routes->get('id/logout', 'KomunitasEkspor::logout');
$routes->get('en/logout', 'KomunitasEkspor::logout');

// ===================================================
// 2. ROUTES VISITOR (Filter: guest)
// ===================================================

// ========== BAHASA INDONESIA ==========
$routes->group('id', ['filter' => 'guest'], function ($routes) {
    $routes->get('/', 'KomunitasEkspor::index');
    $routes->get('tentang-kami', 'KomunitasEkspor::tentang_kami');
    $routes->get('landing-page/(:any)', 'KomunitasEkspor::visitor_landing_page/$1');

    // Belajar Ekspor (visitor)
    $routes->get('materi/keyword=(:any)', 'KomunitasEkspor::search_belajar_ekspor/$1');
    $routes->get('materi', 'KomunitasEkspor::belajar_ekspor');
    $routes->get('materi/kategori/(:segment)', 'KomunitasEkspor::kategori_belajar_ekspor/$1');
    $routes->get('materi/detail/(:segment)', 'KomunitasEkspor::belajar_ekspor_detail/$1');

    // Video (visitor)
    $routes->get('video/keyword=(:any)', 'KomunitasEkspor::search_video_tutorial/$1');
    $routes->get('video', 'KomunitasEkspor::video_tutorial');
    $routes->get('video/kategori/(:segment)', 'KomunitasEkspor::video_selengkapnya/$1');
    $routes->get('video/detail/(:segment)', 'KomunitasEkspor::video_tutorial_detail/$1');

    $routes->get('pendaftaran', 'KomunitasEkspor::pendaftaran');
    $routes->get('syarat-ketentuan', 'KomunitasEkspor::syarat_ketentuan');
    
    // Login & Registration (ID)
    $routes->get('login', 'KomunitasEkspor::login');
    $routes->post('auth/authenticate', 'KomunitasEkspor::authenticate');
    $routes->get('daftar-member', 'KomunitasEkspor::pendaftaran');
    $routes->post('daftar-member', 'KomunitasEkspor::registrasiMember');
});

// ========== BAHASA INGGRIS ==========
$routes->group('en', ['filter' => 'guest'], function ($routes) {
    $routes->get('/', 'KomunitasEkspor::index');
    $routes->get('about-us', 'KomunitasEkspor::tentang_kami');

    // Lessons (visitor)
    $routes->get('lessons/keyword=(:any)', 'KomunitasEkspor::search_belajar_ekspor/$1');
    $routes->get('lessons', 'KomunitasEkspor::belajar_ekspor');
    $routes->get('lessons/category/(:segment)', 'KomunitasEkspor::kategori_belajar_ekspor/$1');
    $routes->get('lessons/detail/(:segment)', 'KomunitasEkspor::belajar_ekspor_detail/$1');

    // Videos (visitor)
    $routes->get('videos/keyword=(:any)', 'KomunitasEkspor::search_video_tutorial/$1');
    $routes->get('videos', 'KomunitasEkspor::video_tutorial');
    $routes->get('videos/category/(:segment)', 'KomunitasEkspor::video_selengkapnya/$1');
    $routes->get('videos/detail/(:segment)', 'KomunitasEkspor::video_tutorial_detail/$1');

    $routes->get('registration', 'KomunitasEkspor::pendaftaran');
    $routes->get('terms-conditions', 'KomunitasEkspor::syarat_ketentuan');
    
    // Login & Registration (EN)
    $routes->get('login', 'KomunitasEkspor::login');
    $routes->post('auth/authenticate', 'KomunitasEkspor::authenticate');
    $routes->get('register-member', 'KomunitasEkspor::pendaftaran');
    $routes->post('register-member', 'KomunitasEkspor::registrasiMember');
});

// ========== TANPA PREFIX BAHASA ==========
$routes->group('', ['filter' => 'guest'], function ($routes) {
    $routes->get('login', 'KomunitasEkspor::login');
    $routes->post('auth/authenticate', 'KomunitasEkspor::authenticate');
    $routes->get('daftar-member', 'KomunitasEkspor::pendaftaran');
    $routes->post('daftar-member', 'KomunitasEkspor::registrasiMember');
});

// ===================================================
// 3. ROUTES MEMBER (Filter: auth, admin)
// ===================================================
$routes->group('', ['filter' => 'auth', 'admin'], function ($routes) {

    // Member - Beranda
    $routes->get('beranda', 'KomunitasEkspor::freeindex');
    $routes->get('id/beranda', 'KomunitasEkspor::freeindex');
    $routes->get('en/dashboard', 'KomunitasEkspor::freeindex');

    // Member - Tentang Kami
    $routes->get('tentang-kami', 'KomunitasEkspor::member_tentang_kami');
    $routes->get('en/about-us', 'KomunitasEkspor::member_tentang_kami');

    // Member - Edit Member
    $routes->get('edit-profile', 'KomunitasEkspor::edit_profile');
    $routes->get('id/edit-profile', 'KomunitasEkspor::edit_profile');
    $routes->get('en/edit-profile', 'KomunitasEkspor::edit_profile');
    
    $routes->post('update-foto-profil', 'KomunitasEkspor::updateFotoProfil');
    $routes->post('ubah-informasi-akun', 'KomunitasEkspor::ubah_informasi_akun');
    $routes->post('ubah-profil-perusahaan', 'KomunitasEkspor::ubah_profil_perusahaan');
    $routes->post('add-sertifikat', 'KomunitasEkspor::add_sertifikat');
    $routes->get('delete-sertifikat/(:num)', 'KomunitasEkspor::delete_sertifikat/$1');
    $routes->post('add-produk', 'KomunitasEkspor::add_produk');
    $routes->get('delete-produk/(:num)', 'KomunitasEkspor::delete_produk/$1');

    // Aplikasi Kalkulator Ekspor
    $routes->get('kalkulator-ekspor', 'KomunitasEkspor::index_kalkulator');
    $routes->get('id/kalkulator-ekspor', 'KomunitasEkspor::index_kalkulator');
    $routes->get('en/export-calculator', 'KomunitasEkspor::index_kalkulator');
    
    $routes->post('ganti-satuan/(:num)', 'KomunitasEkspor::ganti_satuan/$1');

    // EXWORK
    $routes->post('komponen-exwork/add', 'KomunitasEkspor::add_exwork');
    $routes->get('komponen-exwork/delete/(:num)', 'KomunitasEkspor::delete_exwork/$1');
    $routes->post('komponen-exwork/save-all', 'KomunitasEkspor::save_all_exwork');

    // FOB
    $routes->post('komponen-fob/add', 'KomunitasEkspor::add_fob');
    $routes->get('komponen-fob/delete/(:num)', 'KomunitasEkspor::delete_fob/$1');
    $routes->post('komponen-fob/save-all', 'KomunitasEkspor::save_all_fob');

    // CFR
    $routes->post('komponen-cfr/add', 'KomunitasEkspor::add_cfr');
    $routes->get('komponen-cfr/delete/(:num)', 'KomunitasEkspor::delete_cfr/$1');
    $routes->post('komponen-cfr/save-all', 'KomunitasEkspor::save_all_cfr');

    // CIF
    $routes->post('komponen-cif/add', 'KomunitasEkspor::add_cif');
    $routes->get('komponen-cif/delete/(:num)', 'KomunitasEkspor::delete_cif/$1');
    $routes->post('komponen-cif/save-all', 'KomunitasEkspor::save_all_cif');

    $routes->post('kalkulator-state/save', 'KomunitasEkspor::save_kalkulator_state');
    $routes->get('kalkulator-state/load', 'KomunitasEkspor::load_kalkulator_state');
    $routes->post('satuan/upsert-json', 'KomunitasEkspor::upsert_satuan_json');

    // Member - Pengumuman
    $routes->get('pengumuman', 'KomunitasEkspor::pengumuman');
    $routes->get('en/announcement', 'KomunitasEkspor::pengumuman');
    $routes->get('detail-pengumuman/(:segment)', 'KomunitasEkspor::detail_pengumuman/$1');
    $routes->get('en/announcement-detail/(:segment)', 'KomunitasEkspor::detail_pengumuman/$1');

    // MPM
    $routes->get('mpm', 'KomunitasEkspor::mpm');
    $routes->post('mpm-add', 'KomunitasEkspor::add_mpm');
    $routes->post('mpm-edit', 'KomunitasEkspor::edit_mpm');
    $routes->get('mpm/getEmailsByDate/(:num)/(:num)', 'KomunitasEkspor::getEmailsByDate/$1/$2');

    // Sosmed Planner
    $routes->get('sosmed-planner', 'KomunitasEkspor::planner');
    $routes->get('en/social-planner', 'KomunitasEkspor::planner');

    // === Content Pilar ===
    $routes->post('sosmed-planner/konten-pilar/tambah', 'KomunitasEkspor::tambah_kontenpilar');
    $routes->post('sosmed-planner/konten-pilar/update/(:num)', 'KomunitasEkspor::update_kontenpilar/$1');
    $routes->get('sosmed-planner/konten-pilar/hapus/(:num)', 'KomunitasEkspor::hapus_kontenpilar/$1');

    // === Content Type ===
    $routes->post('sosmed-planner/konten-type/tambah', 'KomunitasEkspor::tambah_kontentype');
    $routes->post('sosmed-planner/konten-type/update/(:num)', 'KomunitasEkspor::update_kontentype/$1');
    $routes->get('sosmed-planner/konten-type/hapus/(:num)', 'KomunitasEkspor::hapus_kontentype/$1');

    // === Content Platform ===
    $routes->post('sosmed-planner/konten-platform/tambah', 'KomunitasEkspor::tambah_kontenplatform');
    $routes->post('sosmed-planner/konten-platform/update/(:num)', 'KomunitasEkspor::update_kontenplatform/$1');
    $routes->get('sosmed-planner/konten-platform/hapus/(:num)', 'KomunitasEkspor::hapus_kontenplatform/$1');

    $routes->get('sosmed-planner/calendar-data', 'KomunitasEkspor::getCalendarData');
    $routes->post('sosmed-planner/konten-planner/tambah', 'KomunitasEkspor::tambah_kontenplanner');

    // Member - Data Member
    $routes->get('data-member', 'KomunitasEkspor::member_data_member');
    $routes->get('en/member-data', 'KomunitasEkspor::member_data_member');
    $routes->get('detail-member/(:any)', 'KomunitasEkspor::member_detail_member/$1');
    $routes->get('en/member-detail/(:any)', 'KomunitasEkspor::member_detail_member/$1');

    // Member - Belajar Ekspor
    $routes->get('materi/keyword=(:any)', 'KomunitasEkspor::member_search_belajar_ekspor/$1');
    $routes->get('materi', 'KomunitasEkspor::member_belajar_ekspor');
    $routes->get('materi/kategori/(:segment)', 'KomunitasEkspor::member_kategori_belajar_ekspor/$1');
    $routes->get('materi/detail/(:segment)', 'KomunitasEkspor::member_belajar_ekspor_detail/$1');
    
    $routes->get('en/lessons/keyword=(:any)', 'KomunitasEkspor::member_search_belajar_ekspor/$1');
    $routes->get('en/lessons', 'KomunitasEkspor::member_belajar_ekspor');
    $routes->get('en/lessons/category/(:segment)', 'KomunitasEkspor::member_kategori_belajar_ekspor/$1');
    $routes->get('en/lessons/detail/(:segment)', 'KomunitasEkspor::member_belajar_ekspor_detail/$1');

    // Member - Video Tutorial
    $routes->get('video/keyword=(:any)', 'KomunitasEkspor::member_search_video_tutorial/$1');
    $routes->get('video', 'KomunitasEkspor::member_video_tutorial');
    $routes->get('video/kategori/(:segment)', 'KomunitasEkspor::member_video_selengkapnya/$1');
    $routes->get('video/detail/(:segment)', 'KomunitasEkspor::member_video_tutorial_detail/$1');
    
    $routes->get('en/videos/keyword=(:any)', 'KomunitasEkspor::member_search_video_tutorial/$1');
    $routes->get('en/videos', 'KomunitasEkspor::member_video_tutorial');
    $routes->get('en/videos/category/(:segment)', 'KomunitasEkspor::member_video_selengkapnya/$1');
    $routes->get('en/videos/detail/(:segment)', 'KomunitasEkspor::member_video_tutorial_detail/$1');

    // Member - Test Minat & Bakat
    $routes->get('test-minat-bakat-member', 'TestController::minatBakat');
    $routes->get('en/interest-talent-test-member', 'TestController::minatBakat');

    // Member - Simulasi Wawancara
    $routes->get('simulasi-wawancara-member', 'SimulasiController::index');
    $routes->get('en/interview-simulation-member', 'SimulasiController::index');
});

// ===================================================
// 4. ROUTES PREMIUM MEMBER (Filter: premium)
// ===================================================
$routes->group('', ['filter' => 'premium'], function ($routes) {
    // Premium - Beranda
    $routes->get('beranda-premium', 'KomunitasEkspor::premiumindex');

    // Premium - Tentang Kami
    $routes->get('premium-tentang-kami', 'KomunitasEkspor::premium_tentang_kami');

    // Premium - Edit Member
    $routes->get('edit-profile-premium', 'KomunitasEkspor::edit_profile_premium');
    $routes->post('update-foto-profil-premium', 'KomunitasEkspor::updateFotoProfil_premium');
    $routes->post('ubah-informasi-akun-premium', 'KomunitasEkspor::ubah_informasi_akun_premium');
    $routes->post('ubah-profil-perusahaan-premium', 'KomunitasEkspor::ubah_profil_perusahaan_premium');
    $routes->post('add-sertifikat-premium', 'KomunitasEkspor::add_sertifikat_premium');
    $routes->get('delete-sertifikat-premium/(:num)', 'KomunitasEkspor::delete_sertifikat_premium/$1');
    $routes->post('add-produk-premium', 'KomunitasEkspor::add_produk_premium');
    $routes->get('delete-produk-premium/(:num)', 'KomunitasEkspor::delete_produk_premium/$1');
    $routes->post('ubah-warna-landing-premium', 'KomunitasEkspor::update_warna_landing_premium');

    // Premium - Aplikasi Kalkulator Ekspor
    $routes->get('kalkulator-ekspor-premium', 'KomunitasEkspor::index_kalkulator_premium');
    $routes->post('ganti-satuan-premium/(:num)', 'KomunitasEkspor::ganti_satuan_premium/$1');
    $routes->post('komponen-exwork-premium/add', 'KomunitasEkspor::add_exwork_premium');
    $routes->get('komponen-exwork-premium/delete/(:num)', 'KomunitasEkspor::delete_exwork_premium/$1');
    $routes->post('komponen-fob-premium/add', 'KomunitasEkspor::add_fob_premium');
    $routes->get('komponen-fob-premium/delete/(:num)', 'KomunitasEkspor::delete_fob_premium/$1');
    $routes->post('komponen-cfr-premium/add', 'KomunitasEkspor::add_cfr_premium');
    $routes->get('komponen-cfr-premium/delete/(:num)', 'KomunitasEkspor::delete_cfr_premium/$1');
    $routes->post('komponen-cif-premium/add', 'KomunitasEkspor::add_cif_premium');
    $routes->get('komponen-cif-premium/delete/(:num)', 'KomunitasEkspor::delete_cif_premium/$1');

    // Premium - Pengumuman
    $routes->get('pengumuman-premium', 'KomunitasEkspor::pengumuman_premium');
    $routes->get('detail-pengumuman-premium/(:segment)', 'KomunitasEkspor::detail_pengumuman_premium/$1');

    // MPM Premium
    $routes->get('mpm-premium', 'KomunitasEkspor::mpm_premium');
    $routes->post('mpm-add-premium', 'KomunitasEkspor::add_mpm_premium');
    $routes->post('mpm-edit-premium', 'KomunitasEkspor::edit_mpm_premium');
    $routes->get('mpm-premium/getEmailsByDate/(:num)/(:num)', 'KomunitasEkspor::getEmailsByDate_premium/$1/$2');

    // Premium - Website Audit
    $routes->get('website-audit', 'KomunitasEkspor::website_audit');
    $routes->post('add-website-audit', 'KomunitasEkspor::add_website_audit');
    $routes->get('delete-website-audit/(:num)', 'KomunitasEkspor::delete_website_audit/$1');

    // Premium - Kelayakan Investasi
    $routes->get('kelayakan-investasi', 'KomunitasEkspor::kelayakan_investasi');

    // Premium - Data Member
    $routes->get('premium-data-member', 'KomunitasEkspor::premium_data_member');
    $routes->get('premium-detail-member/(:any)', 'KomunitasEkspor::premium_detail_member/$1');

    // Premium - Data Buyers
    $routes->get('data-buyers', 'KomunitasEkspor::data_buyers');

    // Premium - Belajar Ekspor
    $routes->get('premium-belajar-ekspor', 'KomunitasEkspor::premium_belajar_ekspor');
    $routes->get('premium-belajar-ekspor-detail/(:segment)', 'KomunitasEkspor::premium_belajar_ekspor_detail/$1');
    $routes->get('premium-kategori/(:any)', 'KomunitasEkspor::premium_kategori_belajar_ekspor/$1');

    // Premium - Video Tutorial
    $routes->get('premium-video-tutorial', 'KomunitasEkspor::premium_video_tutorial');
    $routes->get('premium-video-tutorial-selengkapnya/(:segment)', 'KomunitasEkspor::premium_video_selengkapnya/$1');
    $routes->get('premium-video-tutorial-detail/(:segment)', 'KomunitasEkspor::premium_video_tutorial_detail/$1');

    // Premium - Test Minat & Bakat
    $routes->get('test-minat-bakat-premium', 'TestController::minatBakat');
    
    // Premium - Simulasi Wawancara
    $routes->get('simulasi-wawancara-premium', 'SimulasiController::index');
});

// ===================================================
// 5. ROUTES ADMIN (Filter: admin)
// ===================================================
$routes->group('', ['filter' => 'admin'], function ($routes) {
    // Admin - Dashboard
    $routes->get('admin-dashboard', 'KomunitasEkspor::admin_dashboard');

    // Admin - Member
    $routes->get('admin-member', 'KomunitasEkspor::admin_member');
    $routes->get('admin-search-member', 'KomunitasEkspor::admin_search_member');
    $routes->get('admin-add-member', 'KomunitasEkspor::admin_add_member');
    $routes->post('admin-create-member', 'KomunitasEkspor::admin_create_member');
    $routes->get('admin-edit-member/(:num)', 'KomunitasEkspor::admin_edit_member/$1');
    $routes->post('admin-update-member/(:num)', 'KomunitasEkspor::admin_update_member/$1');
    $routes->get('admin-delete-member/(:num)', 'KomunitasEkspor::admin_delete_member/$1');
    $routes->get('admin-member-baru', 'KomunitasEkspor::admin_calon_member');
    $routes->get('admin-calon-member', 'KomunitasEkspor::admin_calon_member');
    $routes->get('admin-detail-member/(:num)', 'KomunitasEkspor::admin_detail_member/$1');
    $routes->get('admin-konfirmasi-member/(:num)', 'KomunitasEkspor::admin_konfirmasi_member/$1');

    // Admin - Buyers
    $routes->get('admin-buyers', 'KomunitasEkspor::admin_buyers');
    $routes->get('admin-search-buyers', 'KomunitasEkspor::admin_search_buyers');
    $routes->get('admin-add-buyers', 'KomunitasEkspor::admin_add_buyers');
    $routes->post('admin-create-buyers', 'KomunitasEkspor::admin_create_buyers');
    $routes->get('admin-edit-buyers/(:num)', 'KomunitasEkspor::admin_edit_buyers/$1');
    $routes->post('admin-update-buyers/(:num)', 'KomunitasEkspor::admin_update_buyers/$1');
    $routes->get('admin-delete-buyers/(:num)', 'KomunitasEkspor::admin_delete_buyers/$1');

    // Admin - Belajar Ekspor
    $routes->get('admin-belajar-ekspor', 'KomunitasEkspor::admin_belajar_ekspor');
    $routes->get('admin-belajar-ekspor-search', 'KomunitasEkspor::admin_search_belajar');
    $routes->get('admin-belajar-ekspor-tambah', 'KomunitasEkspor::admin_belajar_ekspor_tambah');
    $routes->post('admin-belajar-ekspor-create', 'KomunitasEkspor::admin_belajar_ekspor_store');
    $routes->get('admin-belajar-ekspor-ubah/(:num)', 'KomunitasEkspor::admin_belajar_ekspor_ubah/$1');
    $routes->post('admin-belajar-ekspor-update/(:num)', 'KomunitasEkspor::admin_belajar_ekspor_update/$1');
    $routes->get('admin-belajar-ekspor-delete/(:num)', 'KomunitasEkspor::admin_belajar_ekspor_delete/$1');

    // Admin - Kategori Belajar Ekspor
    $routes->get('admin-kategori-belajar-ekspor', 'KomunitasEkspor::admin_kategori_belajar_ekspor');
    $routes->get('admin-kategori-belajar-ekspor-tambah', 'KomunitasEkspor::admin_kategori_belajar_ekspor_tambah');
    $routes->get('admin-kategori-belajar-ekspor-ubah/(:num)', 'KomunitasEkspor::admin_kategori_belajar_ekspor_ubah/$1');
    $routes->post('admin-kategori-belajar-ekspor-create', 'KomunitasEkspor::admin_kategori_belajar_ekspor_store/$1');
    $routes->post('admin-kategori-belajar-ekspor-update/(:num)', 'KomunitasEkspor::admin_kategori_belajar_ekspor_update/$1');
    $routes->get('admin-kategori-belajar-ekspor-delete/(:num)', 'KomunitasEkspor::admin_kategori_belajar_ekspor_delete/$1');

    // Admin - Video Tutorial
    $routes->get('admin-video-tutorial', 'KomunitasEkspor::admin_video_tutorial');
    $routes->get('admin-video-tutorial-tambah', 'KomunitasEkspor::admin_video_tutorial_tambah');
    $routes->post('admin-vidio-tutorial-create', 'KomunitasEkspor::admin_video_tutorial_store/$1');
    $routes->get('admin-video-tutorial-ubah/(:num)', 'KomunitasEkspor::admin_video_tutorial_ubah/$1');
    $routes->post('admin-video-tutorial-update/(:num)', 'KomunitasEkspor::admin_video_tutorial_update/$1');
    $routes->get('admin-video-tutorial-delete/(:num)', 'KomunitasEkspor::admin_video_tutorial_delete/$1');

    // Admin - Kategori Video Tutorial
    $routes->get('admin-kategori-video-tutorial', 'KomunitasEkspor::admin_kategori_video_tutorial');
    $routes->get('admin-kategori-video-tutorial-tambah', 'KomunitasEkspor::admin_kategori_video_tutorial_tambah');
    $routes->post('admin-kategori-vidio-tutorial-create', 'KomunitasEkspor::admin_kategori_vidio_tutorial_store/$1');
    $routes->get('admin-kategori-video-tutorial-ubah/(:num)', 'KomunitasEkspor::admin_kategori_video_tutorial_ubah/$1');
    $routes->post('admin-kategori-video-tutorial-update/(:num)', 'KomunitasEkspor::admin_kategori_video_tutorial_update/$1');
    $routes->get('admin-kategori-video-tutorial-delete/(:num)', 'KomunitasEkspor::admin_kategori_video_tutorial_delete/$1');

    // Admin - Kalkulator Ekspor
    // EXWORK
    $routes->get('admin-exwork', 'KomunitasEkspor::admin_exwork');
    $routes->get('admin-search-exwork', 'KomunitasEkspor::admin_search_exwork');
    $routes->get('admin-add-exwork', 'KomunitasEkspor::admin_add_exwork');
    $routes->post('admin-create-exwork', 'KomunitasEkspor::admin_create_exwork');
    $routes->get('admin-edit-exwork/(:num)', 'KomunitasEkspor::admin_edit_exwork/$1');
    $routes->post('admin-update-exwork/(:num)', 'KomunitasEkspor::admin_update_exwork/$1');
    $routes->get('admin-delete-exwork/(:num)', 'KomunitasEkspor::admin_delete_exwork/$1');
    
    // FOB
    $routes->get('admin-fob', 'KomunitasEkspor::admin_fob');
    $routes->get('admin-search-fob', 'KomunitasEkspor::admin_search_fob');
    $routes->get('admin-add-fob', 'KomunitasEkspor::admin_add_fob');
    $routes->post('admin-create-fob', 'KomunitasEkspor::admin_create_fob');
    $routes->get('admin-edit-fob/(:num)', 'KomunitasEkspor::admin_edit_fob/$1');
    $routes->post('admin-update-fob/(:num)', 'KomunitasEkspor::admin_update_fob/$1');
    $routes->get('admin-delete-fob/(:num)', 'KomunitasEkspor::admin_delete_fob/$1');
    
    // CFR
    $routes->get('admin-cfr', 'KomunitasEkspor::admin_cfr');
    $routes->get('admin-search-cfr', 'KomunitasEkspor::admin_search_cfr');
    $routes->get('admin-add-cfr', 'KomunitasEkspor::admin_add_cfr');
    $routes->post('admin-create-cfr', 'KomunitasEkspor::admin_create_cfr');
    $routes->get('admin-edit-cfr/(:num)', 'KomunitasEkspor::admin_edit_cfr/$1');
    $routes->post('admin-update-cfr/(:num)', 'KomunitasEkspor::admin_update_cfr/$1');
    $routes->get('admin-delete-cfr/(:num)', 'KomunitasEkspor::admin_delete_cfr/$1');
    
    // CIF
    $routes->get('admin-cif', 'KomunitasEkspor::admin_cif');
    $routes->get('admin-search-cif', 'KomunitasEkspor::admin_search_cif');
    $routes->get('admin-add-cif', 'KomunitasEkspor::admin_add_cif');
    $routes->post('admin-create-cif', 'KomunitasEkspor::admin_create_cif');
    $routes->get('admin-edit-cif/(:num)', 'KomunitasEkspor::admin_edit_cif/$1');
    $routes->post('admin-update-cif/(:num)', 'KomunitasEkspor::admin_update_cif/$1');
    $routes->get('admin-delete-cif/(:num)', 'KomunitasEkspor::admin_delete_cif/$1');
    
    // Satuan
    $routes->get('admin-satuan', 'KomunitasEkspor::admin_satuan');
    $routes->get('admin-search-satuan', 'KomunitasEkspor::admin_search_satuan');
    $routes->get('admin-edit-satuan/(:num)', 'KomunitasEkspor::admin_edit_satuan/$1');
    $routes->post('admin-update-satuan/(:num)', 'KomunitasEkspor::admin_update_satuan/$1');

    // Admin - MPM
    $routes->get('admin-mpm', 'KomunitasEkspor::admin_mpm');
    $routes->get('admin-search-mpm', 'KomunitasEkspor::admin_search_mpm');

    // Admin - Website Audit
    $routes->get('admin-website-audit', 'KomunitasEkspor::admin_website_audit');
    $routes->get('admin-search-website-audit', 'KomunitasEkspor::admin_search_website_audit');
    $routes->get('admin-process-website-audit/(:num)', 'KomunitasEkspor::admin_process_website_audit/$1');
    $routes->post('admin-done-website-audit/(:num)', 'KomunitasEkspor::admin_done_website_audit/$1');

    // Admin - Pengumuman
    $routes->get('admin-pengumuman', 'KomunitasEkspor::admin_pengumuman');
    $routes->get('admin-add-pengumuman', 'KomunitasEkspor::admin_add_pengumuman');
    $routes->post('admin-add-pengumuman-create', 'KomunitasEkspor::admin_add_pengumuman_create/$1');
    $routes->get('admin-edit-pengumuman/(:num)', 'KomunitasEkspor::admin_edit_pengumuman/$1');
    $routes->post('admin-update-pengumuman/(:num)', 'KomunitasEkspor::admin_update_pengumuman/$1');
    $routes->get('admin-delete-pengumuman/(:num)', 'KomunitasEkspor::admin_delete_pengumuman/$1');

    // Admin - Manfaat Join
    $routes->get('admin-manfaat-join', 'KomunitasEkspor::admin_manfaat_join');
    $routes->get('admin-edit-manfaat-join/(:num)', 'KomunitasEkspor::admin_edit_manfaat_join/$1');
    $routes->post('admin-manfaat-join-update/(:num)', 'KomunitasEkspor::admin_update_manfaat_join/$1');

    // Admin - Slider
    $routes->get('admin-slider', 'KomunitasEkspor::admin_slider');
    $routes->get('admin-edit-slider/(:num)', 'KomunitasEkspor::admin_edit_slider/$1');
    $routes->post('admin-update-slider/(:num)', 'KomunitasEkspor::admin_update_slider/$1');
    $routes->get('admin-delete-slider/(:num)', 'KomunitasEkspor::admin_delete_slider/$1');

    // Admin - Web Profile
    $routes->get('admin-web-profile', 'KomunitasEkspor::admin_web_profile');
    $routes->get('admin-edit-web-profile/(:num)', 'KomunitasEkspor::admin_edit_web_profile/$1');
    $routes->post('admin-update-webprofile/(:num)', 'KomunitasEkspor::admin_update_webprofile/$1');

    // Admin - tentang kami
    $routes->get('admin-tentang-kami', 'KomunitasEkspor::admin_tentang_kami');
    $routes->get('admin-edit-tentang-kami/(:num)', 'KomunitasEkspor::edit_admin_tentang_kami/$1');
    $routes->post('admin-update-tentang-kami/(:num)', 'KomunitasEkspor::update_admin_tentang_kami/$1');

    // Kategori Induk
    $routes->get('admin-kategori-induk', 'KomunitasEkspor::admin_kategori_induk');
    $routes->get('admin-kategori-induk-tambah', 'KomunitasEkspor::admin_kategori_induk_create');
    $routes->post('admin-kategori-induk-store', 'KomunitasEkspor::admin_kategori_induk_store/$1');
    $routes->get('admin-kategori-induk-edit/(:num)', 'KomunitasEkspor::admin_kategori_induk_edit/$1');
    $routes->post('admin-kategori-induk-update/(:num)', 'KomunitasEkspor::admin_kategori_induk_update/$1');
    $routes->get('admin-kategori-induk-delete/(:num)', 'KomunitasEkspor::admin_kategori_induk_destroy/$1');

    // Kategori Produk
    $routes->get('admin-kategori-produk', 'KomunitasEkspor::admin_kategori_produk');
    $routes->get('admin-kategori-produk-tambah', 'KomunitasEkspor::admin_kategori_produk_create');
    $routes->post('admin-kategori-produk-store', 'KomunitasEkspor::admin_kategori_produk_store/$1');
    $routes->get('admin-kategori-produk-edit/(:num)', 'KomunitasEkspor::admin_kategori_produk_edit/$1');
    $routes->post('admin-kategori-produk-update/(:num)', 'KomunitasEkspor::admin_kategori_produk_update/$1');
    $routes->get('admin-kategori-produk-delete/(:num)', 'KomunitasEkspor::admin_kategori_produk_destroy/$1');

    // Meta
    $routes->get('admin-meta', 'KomunitasEkspor::admin_meta');
    $routes->get('admin-edit-meta', 'KomunitasEkspor::admin_edit_meta');
    $routes->post('admin-update-meta', 'KomunitasEkspor::admin_update_meta');

    // Fitur
    $routes->get('admin-fitur', 'KomunitasEkspor::admin_fitur');
    $routes->get('admin-add-fitur', 'KomunitasEkspor::admin_fitur_add');
    $routes->post('admin-create-fitur', 'KomunitasEkspor::admin_fitur_create');
    $routes->get('admin-edit-fitur/(:num)', 'KomunitasEkspor::admin_fitur_edit/$1');
    $routes->post('admin-update-fitur/(:num)', 'KomunitasEkspor::admin_fitur_update/$1');
    $routes->get('admin-delete-fitur/(:num)', 'KomunitasEkspor::admin_fitur_delete/$1');

    // Keuntungan Daftar
    $routes->get('admin-keuntungan', 'KomunitasEkspor::admin_keuntungan');
    $routes->get('admin-add-keuntungan', 'KomunitasEkspor::admin_keuntungan_add');
    $routes->post('admin-create-keuntungan', 'KomunitasEkspor::admin_keuntungan_create');
    $routes->get('admin-edit-keuntungan/(:num)', 'KomunitasEkspor::admin_keuntungan_edit/$1');
    $routes->post('admin-update-keuntungan/(:num)', 'KomunitasEkspor::admin_keuntungan_update/$1');
    $routes->get('admin-delete-keuntungan/(:num)', 'KomunitasEkspor::admin_keuntungan_delete/$1');

    // Admin - Test Minat & Bakat (untuk melihat statistik)
    $routes->get('admin-test-minat-bakat', 'TestController::adminTestResults');
    
    // Admin - Simulasi Wawancara (untuk melihat statistik)
    $routes->get('admin-simulasi-wawancara', 'SimulasiController::adminResults');
});

// ===================================================
// 6. ROUTES SOSMED PLANNER (Universal)
// ===================================================
$routes->get('sosmed-planner/konten-planner/edit/(:segment)',    'KomunitasEkspor::edit_kontenplanner/$1');
$routes->get('sosmed-planner/konten-planner/preview/(:segment)', 'KomunitasEkspor::preview_kontenplanner/$1');
$routes->get('sosmed-planner/konten-planner/delete/(:segment)',  'KomunitasEkspor::hapus_kontenplanner/$1');
$routes->post('sosmed-planner/konten-planner/update/(:segment)', 'KomunitasEkspor::update_kontenplanner/$1');

$routes->get('en/social-planner/content/edit/(:segment)',    'KomunitasEkspor::edit_kontenplanner/$1');
$routes->get('en/social-planner/content/preview/(:segment)', 'KomunitasEkspor::preview_kontenplanner/$1');
$routes->get('en/social-planner/content/delete/(:segment)',  'KomunitasEkspor::hapus_kontenplanner/$1');
$routes->post('en/social-planner/content/update/(:segment)', 'KomunitasEkspor::update_kontenplanner/$1');

// ===================================================
// 7. DEFAULT CATCH-ALL ROUTE (Harus di akhir)
// ===================================================
$routes->get('(:any)', function($page = '') {
    // Redirect 404 atau ke halaman default
    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
});