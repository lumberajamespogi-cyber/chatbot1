<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ai.css">
    <title>AI</title>
</head>
<body>
<div class="chat-container">
    <div class="chat-header">
        <h1>AI Assistant</h1>
    </div>
    <div id="output" class="chat-messages">
        <div class="message-placeholder">How can I help you today?</div>
    </div>
    <div class="chat-input-area">
        <textarea id="message2" class="chat-input" name="message" rows="1" placeholder="Type your message here..." required></textarea>
        <button id="sendBtn" class="send-button"><img src="message/send.png" alt="Send"></button>
    </div>
</div>
<script src="ai.js"></script>
<footer>
<p>Created by <a href="https://github.com/lumberajamespogi-cyber" class="github-link">James Carlos Lumbera</a></p>
</footer>
</body>
</html>
