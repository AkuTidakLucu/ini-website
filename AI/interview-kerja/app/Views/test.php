<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    /* RESET */
    * {
        box-sizing: border-box;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    body {
        background: #f4f6f8;
        margin: 0;
        padding: 0;
    }

    /* CHAT WRAPPER */
    .chat-container {
        max-width: 800px;
        margin: 40px auto 100px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    /* BUBBLE BASE */
    .bubble {
        max-width: 75%;
        padding: 12px 16px;
        border-radius: 16px;
        line-height: 1.5;
        font-size: 15px;
        word-wrap: break-word;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    /* USER */
    .bubble.user {
        align-self: flex-end;
        background: #2563eb;
        color: #ffffff;
        border-bottom-right-radius: 4px;
    }

    /* bot */
    .bubble.bot {
        align-self: flex-start;
        background: #ffffff;
        color: #1f2937;
        border-bottom-left-radius: 4px;
    }

    /* MARKDOWN INSIDE bot */
    .bubble.bot p {
        margin: 0 0 8px;
    }

    .bubble.bot p:last-child {
        margin-bottom: 0;
    }

    .bubble.bot ul {
        padding-left: 18px;
        margin: 6px 0;
    }

    .bubble.bot li {
        margin-bottom: 4px;
    }

    /* INPUT AREA */
    .chat-input {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: #ffffff;
        border-top: 1px solid #e5e7eb;
        padding: 14px;
        display: flex;
        gap: 10px;
    }

    .chat-input textarea {
        flex: 1;
        resize: none;
        padding: 12px 14px;
        font-size: 15px;
        border-radius: 10px;
        border: 1px solid #d1d5db;
        outline: none;
        max-height: 160px;
    }

    .chat-input button {
        padding: 0 20px;
        border-radius: 10px;
        border: none;
        background: #2563eb;
        color: #ffffff;
        font-size: 15px;
        cursor: pointer;
    }

    .chat-input button:hover {
        background: #1e40af;
    }
</style>

<?php

use League\CommonMark\CommonMarkConverter;

$converter = new CommonMarkConverter();
?>

<body>
    <form class="chat-input" action="/api/v1/send" method="post">
        <textarea name="prompt" id="prompt" rows="1" placeholder="Tulis pesan..."></textarea>
        <button type="submit">Send</button>
    </form>

    <script>
        const textarea = document.getElementById('prompt');
        const form = textarea.closest('form');

        const isMobile = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);

        textarea.addEventListener('keydown', function(e) {
            if (!isMobile && e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                form.submit();
            }
        });
    </script>

</body>

</html>