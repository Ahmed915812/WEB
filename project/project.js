const chatWindow = document.getElementById('chat-window');
const userInput = document.getElementById('user-input');

// Basic responses for a "small" AI
const responses = {
    "hello": "Hi there! How can I help you with the project?",
    "status": "The system is running smoothly.",
    "help": "I can answer questions about your JS code or project goals.",
    "default": "That sounds interesting! Can you tell me more?"
};

function sendMessage() {
    const text = userInput.value.toLowerCase().trim();
    if (text === "") return;

    // Display user message
    addMessage(userInput.value, 'user');
    
    // Generate and display bot response
    setTimeout(() => {
        const reply = responses[text] || responses['default'];
        addMessage(reply, 'bot');
    }, 500);

    userInput.value = "";
}

function addMessage(text, sender) {
    const msgDiv = document.createElement('div');
    msgDiv.classList.add('message', sender);
    msgDiv.innerText = text;
    chatWindow.appendChild(msgDiv);
    chatWindow.scrollTop = chatWindow.scrollHeight;
}