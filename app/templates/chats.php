<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chats</title>
</head>
<body>
<h1>Chats</h1>
<div id="chat-box"></div>
<div id="message-input">
    <input type="text" id="message" placeholder="Type your message...">
    <button onclick="sendMessage()">Send</button>
</div>

<script>
    const chatBox = document.getElementById('chat-box');
    const messageInput = document.getElementById('message');
    const ws = new WebSocket('ws://localhost:8080');

    ws.onmessage = function(event) {
        const message = document.createElement('div');
        message.textContent = event.data;
        chatBox.appendChild(message);
        chatBox.scrollTop = chatBox.scrollHeight;
    };

    function sendMessage() {
        const message = messageInput.value;
        if (message) {
            ws.send(message);
            messageInput.value = '';
        }
    }
</script>
</body>
</html>
