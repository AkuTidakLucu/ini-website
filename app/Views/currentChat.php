<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Interview Assistant</title>

    <script src="https://code.responsivevoice.org/responsivevoice.js?key=YT8cCBCv"></script>
    <link href='https://cdn.boxicons.com/3.0.6/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<style>
    :root {
        --primary: #6366f1;
        --primary-dark: #4f46e5;
        --secondary: #8b5cf6;
        --accent: #06b6d4;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --light: #f8fafc;
        --dark: #1e293b;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --radius-sm: 8px;
        --radius: 12px;
        --radius-lg: 16px;
        --radius-xl: 24px;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        height: 100vh;
        overflow: hidden;
        color: var(--dark);
    }

    .app-container {
        display: flex;
        height: 100vh;
        max-width: 1600px;
        margin: 0 auto;
        box-shadow: var(--shadow-lg);
        background: var(--light);
        overflow: hidden;
    }

    /* SIDEBAR */
    .sidebar {
        width: 280px;
        background: white;
        border-right: 1px solid var(--gray-200);
        display: flex;
        flex-direction: column;
        z-index: 10;
        flex-shrink: 0;
    }

    .logo-container {
        padding: 24px;
        text-align: center;
        border-bottom: 1px solid var(--gray-200);
    }

    .logo {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        color: var(--primary);
        font-size: 20px;
        font-weight: 700;
    }

    .logo i {
        font-size: 28px;
        color: var(--primary);
    }

    .menu {
        padding: 16px;
        flex: 1;
        overflow-y: auto;
    }

    .menu-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px;
        border-radius: var(--radius);
        color: var(--gray-600);
        text-decoration: none;
        margin-bottom: 8px;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .menu-item:hover {
        background: var(--gray-100);
        color: var(--primary);
        transform: translateX(4px);
    }

    .menu-item.active {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        font-weight: 500;
        box-shadow: var(--shadow);
    }

    .menu-item i {
        font-size: 20px;
    }

    .user-profile {
        padding: 20px;
        border-top: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 16px;
    }

    .user-info {
        flex: 1;
    }

    .user-name {
        font-weight: 600;
        color: var(--dark);
        font-size: 14px;
    }

    .user-role {
        color: var(--gray-500);
        font-size: 12px;
    }

    /* MAIN CONTENT */
    .main-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: white;
        position: relative;
        min-width: 0;
    }

    .header {
        padding: 20px 32px;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: white;
        flex-shrink: 0;
    }

    .header-title h1 {
        font-size: 24px;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 4px;
    }

    .header-title p {
        color: var(--gray-500);
        font-size: 14px;
    }

    .header-actions {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .btn {
        padding: 10px 20px;
        border-radius: var(--radius);
        border: none;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .btn-outline {
        background: transparent;
        border: 2px solid var(--gray-300);
        color: var(--gray-600);
    }

    .btn-outline:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    .btn-icon {
        width: 40px;
        height: 40px;
        padding: 0;
        justify-content: center;
        border-radius: 50%;
    }

    /* CHAT CONTAINER */
    .chat-container {
        flex: 1;
        overflow-y: auto;
        background: linear-gradient(180deg, var(--gray-100) 0%, white 100%);
        display: flex;
        flex-direction: column;
        gap: 24px;
        min-height: 0;
        padding: 32px 48px;
    }

    /* Desktop Chat Width */
    @media (min-width: 1024px) {
        .chat-container {
            padding: 32px 120px;
        }
        
        .message {
            max-width: 75%;
        }
        
        .message.user {
            max-width: 75%;
        }
    }

    /* Large Desktop Chat Width */
    @media (min-width: 1440px) {
        .chat-container {
            padding: 32px 200px;
        }
        
        .message {
            max-width: 70%;
        }
        
        .message.user {
            max-width: 70%;
        }
    }

    /* Tablet */
    @media (max-width: 1023px) {
        .chat-container {
            padding: 24px 32px;
        }
        
        .message {
            max-width: 85%;
        }
    }

    /* Mobile */
    @media (max-width: 767px) {
        .chat-container {
            padding: 16px;
        }
        
        .message {
            max-width: 95%;
        }
    }

    .welcome-card {
        background: white;
        border-radius: var(--radius-xl);
        padding: 40px;
        text-align: center;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--gray-200);
        margin-bottom: 30px;
        animation: fadeIn 0.5s ease;
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
    }

    .welcome-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
    }

    .welcome-icon i {
        font-size: 48px;
        color: white;
    }

    .welcome-card h2 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 16px;
        color: var(--dark);
    }

    .welcome-card p {
        color: var(--gray-600);
        font-size: 18px;
        line-height: 1.6;
        margin-bottom: 32px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-top: 32px;
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
    }

    .feature {
        background: var(--gray-100);
        padding: 24px;
        border-radius: var(--radius-lg);
        text-align: center;
        transition: all 0.3s ease;
    }

    .feature:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow);
        background: white;
    }

    .feature i {
        font-size: 28px;
        color: var(--primary);
        margin-bottom: 16px;
    }

    .feature h4 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--dark);
    }

    .feature p {
        font-size: 15px;
        color: var(--gray-500);
    }

    /* MESSAGE STYLES */
    .message {
        display: flex;
        gap: 20px;
        animation: slideIn 0.3s ease;
    }

    .message.user {
        align-self: flex-end;
        flex-direction: row-reverse;
    }

    .message-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: white;
        font-size: 18px;
    }

    .message.user .message-avatar {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
    }

    .message.bot .message-avatar {
        background: linear-gradient(135deg, var(--accent), #3b82f6);
    }

    .message-content {
        flex: 1;
        min-width: 0;
    }

    .message-bubble {
        background: white;
        border-radius: var(--radius-xl);
        padding: 24px;
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        position: relative;
    }

    .message.user .message-bubble {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border-radius: var(--radius-xl) var(--radius-xl) 4px var(--radius-xl);
    }

    .message.bot .message-bubble {
        background: white;
        border-radius: var(--radius-xl) var(--radius-xl) var(--radius-xl) 4px;
    }

    .message-text {
        font-size: 16px;
        line-height: 1.7;
        color: var(--dark);
    }

    .message.user .message-text {
        color: white;
    }

    .message-text p {
        margin-bottom: 16px;
        font-size: 16px;
    }

    .message-text p:last-child {
        margin-bottom: 0;
    }

    .message-text ul,
    .message-text ol {
        padding-left: 24px;
        margin-bottom: 16px;
    }

    .message-text li {
        margin-bottom: 8px;
        font-size: 16px;
    }

    .message-text a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        border-bottom: 1px dashed var(--primary);
        font-size: 16px;
    }

    .message-text a:hover {
        border-bottom-style: solid;
    }

    .message-time {
        font-size: 13px;
        color: var(--gray-500);
        margin-top: 12px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .message.user .message-time {
        color: rgba(255, 255, 255, 0.8);
    }

    .message-actions {
        display: flex;
        gap: 10px;
        margin-top: 16px;
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .message-bubble:hover .message-actions {
        opacity: 1;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        background: var(--gray-100);
        color: var(--gray-600);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 18px;
    }

    .action-btn:hover {
        background: var(--primary);
        color: white;
        transform: scale(1.1);
    }

    /* INPUT AREA - DIUBAH UNTUK MEMENUHI LEBAR PENUH */
    .input-area {
        padding: 20px 32px; /* Padding lebih kecil untuk memenuhi lebar */
        border-top: 1px solid var(--gray-200);
        background: white;
        flex-shrink: 0;
        width: 100%; /* Pastikan lebar penuh */
    }

    /* HAPUS MEDIA QUERY UNTUK INPUT AREA PADDING YANG MEMBATASI LEBAR */
    /* .input-container akan mengikuti lebar parent */
    
    .input-container {
        display: flex;
        gap: 16px;
        align-items: flex-end;
        background: var(--gray-100);
        border-radius: var(--radius-xl);
        padding: 16px;
        width: 100%; /* Pastikan lebar penuh */
    }

    .input-tools {
        display: flex;
        flex-direction: column;
        gap: 12px;
        flex-shrink: 0; /* Mencegah tools mengecil */
    }

    .tool-btn {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: none;
        background: white;
        color: var(--gray-600);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: var(--shadow-sm);
        font-size: 20px;
    }

    .tool-btn:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .tool-btn.active {
        background: var(--primary);
        color: white;
        animation: pulse 2s infinite;
    }

    /* MESSAGE INPUT - DIUBAH UNTUK MEMENUHI RUANG YANG TERSEDIA */
    .message-input {
        flex: 1;
        background: white;
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-lg);
        padding: 16px 20px;
        font-size: 16px;
        font-family: inherit;
        resize: none;
        min-height: 56px;
        max-height: 160px;
        transition: all 0.3s ease;
        line-height: 1.6;
        width: 100%; /* Memastikan lebar penuh */
    }

    .message-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
    }

    .message-input::placeholder {
        color: var(--gray-400);
        font-size: 16px;
    }

    .send-btn {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        border: none;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: var(--shadow);
        font-size: 24px;
        flex-shrink: 0; /* Mencegah tombol mengecil */
    }

    .send-btn:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: var(--shadow-lg);
    }

    .send-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }

    /* Responsive adjustments untuk input area */
    @media (max-width: 768px) {
        .input-area {
            padding: 16px;
        }
        
        .input-container {
            padding: 12px;
            gap: 12px;
        }
        
        .tool-btn {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }
        
        .send-btn {
            width: 48px;
            height: 48px;
            font-size: 20px;
        }
        
        .message-input {
            padding: 14px 16px;
            min-height: 52px;
        }
    }

    /* Untuk tablet dan desktop yang lebih kecil */
    @media (max-width: 1024px) {
        .input-area {
            padding: 20px 24px;
        }
    }

    /* CALL MODE */
    .call-mode {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, #1e293b, #0f172a);
        z-index: 1000;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .call-mode.active {
        opacity: 1;
        visibility: visible;
    }

    .call-header {
        position: absolute;
        top: 40px;
        left: 40px;
        color: white;
    }

    .call-title {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .call-status {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--gray-400);
        font-size: 16px;
    }

    .status-dot {
        width: 10px;
        height: 10px;
        background: var(--success);
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    .call-content {
        text-align: center;
        color: white;
        padding: 40px;
    }

    .call-avatar {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        margin: 0 auto 40px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        border: 4px solid rgba(255, 255, 255, 0.1);
    }

    .call-avatar.speaking {
        animation: speaking 1.5s ease-in-out infinite;
        border-color: var(--primary);
    }

    .call-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .call-info {
        margin-bottom: 48px;
    }

    .call-name {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .call-role {
        font-size: 20px;
        color: var(--gray-400);
    }

    .call-controls {
        display: flex;
        gap: 24px;
        justify-content: center;
    }

    .control-btn {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 28px;
        color: white;
        box-shadow: var(--shadow-lg);
    }

    .control-btn.mute {
        background: var(--gray-600);
    }

    .control-btn.mute.active {
        background: var(--danger);
    }

    .control-btn.end-call {
        background: var(--danger);
    }

    .control-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }

    .sound-waves {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        height: 400px;
        opacity: 0.3;
    }

    .wave {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 2px solid var(--primary);
        border-radius: 50%;
        animation: wave 3s linear infinite;
    }

    .wave:nth-child(2) {
        animation-delay: 1s;
    }

    .wave:nth-child(3) {
        animation-delay: 2s;
    }

    /* ANIMATIONS */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes speaking {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.3);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 0 30px 60px rgba(99, 102, 241, 0.5);
        }
    }

    @keyframes wave {
        0% {
            width: 0;
            height: 0;
            opacity: 1;
        }
        100% {
            width: 400px;
            height: 400px;
            opacity: 0;
        }
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }

    /* LOADING STATES */
    .typing-indicator {
        display: flex;
        gap: 6px;
        padding: 16px;
    }

    .typing-dot {
        width: 10px;
        height: 10px;
        background: var(--gray-400);
        border-radius: 50%;
        animation: typing 1.4s infinite ease-in-out;
    }

    .typing-dot:nth-child(1) { animation-delay: -0.32s; }
    .typing-dot:nth-child(2) { animation-delay: -0.16s; }

    @keyframes typing {
        0%, 80%, 100% { transform: scale(0); }
        40% { transform: scale(1); }
    }

    /* SCROLLBAR */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--gray-100);
    }

    ::-webkit-scrollbar-thumb {
        background: var(--gray-300);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--gray-400);
    }

    /* RESPONSIVE */
    @media (max-width: 1024px) {
        .sidebar {
            width: 80px;
        }
        
        .menu-item span,
        .user-info {
            display: none;
        }
        
        .logo span {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .sidebar {
            display: none;
        }
        
        .header {
            padding: 16px;
        }
        
        .chat-container {
            padding: 16px;
        }
        
        .message {
            max-width: 95%;
        }
        
        .message-bubble {
            padding: 18px;
        }
        
        .message-text {
            font-size: 15px;
        }
    }
</style>

<?php
use League\CommonMark\CommonMarkConverter;
$converter = new CommonMarkConverter([
    'renderer' => [
        'soft_break' => "<br />\n",
    ],
]);
?>

<body>
    <!-- Call Mode Overlay -->
    <div class="call-mode" id="callMode">
        <div class="call-header">
            <div class="call-title">Live Interview</div>
            <div class="call-status">
                <span class="status-dot"></span>
                <span>Connected</span>
            </div>
        </div>
        
        <div class="call-content">
            <div class="call-avatar" id="callAvatar">
                <img src="<?= base_url('assets/img/bot-image.jpg') ?>" alt="AI Assistant">
                <div class="sound-waves">
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                </div>
            </div>
            
            <div class="call-info">
                <div class="call-name">AI Interviewer</div>
                <div class="call-role">Simulation Assistant</div>
            </div>
            
            <div class="call-controls">
                <button class="control-btn mute" id="muteBtn">
                    <i class='bx bx-microphone'></i>
                </button>
                <button class="control-btn end-call" id="endCallBtn">
                    <i class='bx bx-phone'></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Main App Container -->
    <div class="app-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo-container">
                <div class="logo">
                    <i class='bx bx-brain'></i>
                    <span>AI Interview</span>
                </div>
            </div>
            
            <div class="menu">
                <a href="#" class="menu-item active">
                    <i class='bx bx-conversation'></i>
                    <span>Interview</span>
                </a>
                <a href="#" class="menu-item">
                    <i class='bx bx-history'></i>
                    <span>History</span>
                </a>
                <a href="#" class="menu-item">
                    <i class='bx bx-analyse'></i>
                    <span>Analytics</span>
                </a>
                <a href="#" class="menu-item">
                    <i class='bx bx-cog'></i>
                    <span>Settings</span>
                </a>
                <a href="#" class="menu-item">
                    <i class='bx bx-help-circle'></i>
                    <span>Help</span>
                </a>
            </div>
            
            <div class="user-profile">
                <div class="avatar">JS</div>
                <div class="user-info">
                    <div class="user-name">John Smith</div>
                    <div class="user-role">Candidate</div>
                </div>
                <i class='bx bx-chevron-down'></i>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <div class="header-title">
                    <h1>Interview Simulation</h1>
                    <p>Practice with our AI assistant</p>
                </div>
                
                <div class="header-actions">
                    <button class="btn btn-outline" id="voiceModeBtn">
                        <i class='bx bx-microphone'></i>
                        Voice Mode
                    </button>
                    <button class="btn btn-primary" id="newInterviewBtn">
                        <i class='bx bx-plus'></i>
                        New Interview
                    </button>
                </div>
            </div>

            <!-- Chat Container -->
            <div class="chat-container" id="chatContainer">
                <?php if (empty($result)): ?>
                    <div class="welcome-card">
                        <div class="welcome-icon">
                            <i class='bx bx-conversation'></i>
                        </div>
                        <h2>Welcome to AI Interview Assistant</h2>
                        <p>Practice your interview skills with our AI-powered assistant. Get instant feedback and improve your responses.</p>
                        
                        <div class="features">
                            <div class="feature">
                                <i class='bx bx-message-rounded'></i>
                                <h4>Real-time Q&A</h4>
                                <p>Interactive interview simulation</p>
                            </div>
                            <div class="feature">
                                <i class='bx bx-voice'></i>
                                <h4>Voice Mode</h4>
                                <p>Practice speaking naturally</p>
                            </div>
                            <div class="feature">
                                <i class='bx bx-analyse'></i>
                                <h4>Instant Feedback</h4>
                                <p>Get tips and suggestions</p>
                            </div>
                            <div class="feature">
                                <i class='bx bx-history'></i>
                                <h4>Progress Tracking</h4>
                                <p>Monitor your improvement</p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($result as $msg): ?>
                        <div class="message <?= strtolower($msg['role']) ?>">
                            <div class="message-avatar">
                                <?= $msg['role'] === 'BOT' ? 'AI' : 'Y' ?>
                            </div>
                            <div class="message-content">
                                <div class="message-bubble">
                                    <div class="message-text">
                                        <?= $msg['role'] === 'BOT' 
                                            ? $converter->convert($msg['text'])
                                            : nl2br(htmlspecialchars($msg['text'])) ?>
                                    </div>
                                    <div class="message-time">
                                        <i class='bx bx-time'></i>
                                        <?= date('H:i') ?>
                                    </div>
                                    <div class="message-actions">
                                        <button class="action-btn" title="Copy">
                                            <i class='bx bx-copy'></i>
                                        </button>
                                        <button class="action-btn" title="Speak">
                                            <i class='bx bx-volume-full'></i>
                                        </button>
                                        <button class="action-btn" title="Save">
                                            <i class='bx bx-bookmark'></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Input Area - DIUBAH UNTUK MEMENUHI LEBAR -->
            <div class="input-area">
                <form action="/api/v1/send/<?= $id ?>/user" method="post" id="chatForm">
                    <div class="input-container">
                        <div class="input-tools">
                            <button class="tool-btn" id="voiceToggleBtn" title="Voice Input" type="button">
                                <i class='bx bx-microphone'></i>
                            </button>
                            
                        <textarea 
                            name="prompt" 
                            id="prompt" 
                            class="message-input" 
                            rows="1" 
                            placeholder="Type your message here... (Shift+Enter for new line)"
                            maxlength="500"
                        ></textarea>
                        
                        <button class="send-btn" type="submit">
                            <i class='bx bx-send'></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const chatContainer = document.getElementById('chatContainer');
            const promptInput = document.getElementById('prompt');
            const chatForm = document.getElementById('chatForm');
            const voiceToggleBtn = document.getElementById('voiceToggleBtn');
            const voiceModeBtn = document.getElementById('voiceModeBtn');
            const callMode = document.getElementById('callMode');
            const callAvatar = document.getElementById('callAvatar');
            const muteBtn = document.getElementById('muteBtn');
            const endCallBtn = document.getElementById('endCallBtn');
            
            // Auto-resize textarea
            promptInput.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 160) + 'px';
            });

            // Enter to submit, Shift+Enter for new line
            promptInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    chatForm.submit();
                }
            });

            // Auto-scroll to bottom
            function scrollToBottom() {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }

            // Add smooth message animation
            const messages = document.querySelectorAll('.message');
            messages.forEach((msg, index) => {
                msg.style.animationDelay = `${index * 0.1}s`;
            });

            // Voice toggle functionality
            let isListening = false;
            let recognition = null;

            voiceToggleBtn.addEventListener('click', function() {
                if (!isListening) {
                    startVoiceRecognition();
                } else {
                    stopVoiceRecognition();
                }
            });

            function startVoiceRecognition() {
                if (!('webkitSpeechRecognition' in window)) {
                    alert('Voice recognition is not supported in your browser. Please use Chrome or Edge.');
                    return;
                }

                recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
                recognition.lang = 'id-ID';
                recognition.continuous = false;
                recognition.interimResults = true;

                recognition.onstart = function() {
                    isListening = true;
                    voiceToggleBtn.classList.add('active');
                    voiceToggleBtn.innerHTML = '<i class="bx bx-microphone-off"></i>';
                };

                recognition.onresult = function(event) {
                    let transcript = '';
                    for (let i = event.resultIndex; i < event.results.length; i++) {
                        transcript += event.results[i][0].transcript;
                    }
                    promptInput.value += transcript + ' ';
                    promptInput.focus();
                };

                recognition.onend = function() {
                    stopVoiceRecognition();
                };

                recognition.onerror = function(event) {
                    console.error('Speech recognition error:', event.error);
                    stopVoiceRecognition();
                };

                recognition.start();
            }

            function stopVoiceRecognition() {
                if (recognition) {
                    recognition.stop();
                }
                isListening = false;
                voiceToggleBtn.classList.remove('active');
                voiceToggleBtn.innerHTML = '<i class="bx bx-microphone"></i>';
            }

            // Voice mode (call mode)
            voiceModeBtn.addEventListener('click', function() {
                callMode.classList.add('active');
                document.body.style.overflow = 'hidden';
            });

            // End call
            endCallBtn.addEventListener('click', function() {
                callMode.classList.remove('active');
                document.body.style.overflow = 'auto';
            });

            // Mute toggle
            muteBtn.addEventListener('click', function() {
                this.classList.toggle('active');
                const icon = this.querySelector('i');
                if (this.classList.contains('active')) {
                    icon.className = 'bx bx-microphone-off';
                } else {
                    icon.className = 'bx bx-microphone';
                }
            });

            // Speaking animation
            function startSpeakingAnimation() {
                callAvatar.classList.add('speaking');
            }

            function stopSpeakingAnimation() {
                callAvatar.classList.remove('speaking');
            }

            // Auto scroll when new messages are added
            const observer = new MutationObserver(scrollToBottom);
            observer.observe(chatContainer, { childList: true, subtree: true });

            // Initialize scroll
            scrollToBottom();

            <?php if (!empty($triggerAI)): ?>
                // Auto-trigger AI response
                setTimeout(() => {
                    window.location.href = "/api/v1/send/<?= $id ?>/bot";
                }, 100);
            <?php endif; ?>

            <?php if (!empty($speak)): ?>
                // Speak last bot message
                setTimeout(() => {
                    const lastBotMessage = document.querySelector('.message.bot:last-child .message-text');
                    if (lastBotMessage) {
                        const text = lastBotMessage.textContent;
                        if (responsiveVoice) {
                            responsiveVoice.speak(text, "Indonesian Female", {
                                rate: 1.2,
                                pitch: 1,
                                onstart: startSpeakingAnimation,
                                onend: stopSpeakingAnimation
                            });
                        }
                    }
                }, 500);
            <?php endif; ?>
        });
    </script>
</body>
</html>