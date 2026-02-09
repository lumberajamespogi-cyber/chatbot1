document.getElementById("sendBtn").addEventListener("click", () => {
    const messageInput = document.getElementById("message2");
    const message = messageInput.value.trim();
    const chatContainer = document.getElementById("output");
    const sendBtn = document.getElementById("sendBtn");

    if (!message) {
        alert("Please enter a message.");
        return;
    }

    const placeholder = chatContainer.querySelector('.message-placeholder');
    if (placeholder) placeholder.remove();

    const userMsgDiv = document.createElement('div');
    userMsgDiv.className = 'message user-message';
    userMsgDiv.textContent = message;
    chatContainer.appendChild(userMsgDiv);

    messageInput.value = "";

    const aiMsgDiv = document.createElement('div');
    aiMsgDiv.className = 'message ai-message';
    aiMsgDiv.textContent = "Thinking...";
    chatContainer.appendChild(aiMsgDiv);

    chatContainer.scrollTop = chatContainer.scrollHeight;

    sendBtn.disabled = true;

    fetch("aibackend.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ message })
    })
    .then(res => res.json())
    .then(data => {
        aiMsgDiv.textContent = data.output ?? "No response";
        chatContainer.scrollTop = chatContainer.scrollHeight;
    })
    .catch(err => {
        console.error(err);
        aiMsgDiv.textContent = "Request failed";
    })
    .finally(() => {
        sendBtn.disabled = false;
        messageInput.focus();
    });
});

document.getElementById("message2").addEventListener("keydown", (event) => {
    if (event.key === "Enter" && !event.shiftKey) {
        event.preventDefault();
        document.getElementById("sendBtn").click();
    }
});