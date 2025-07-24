<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Tư Vấn Thời Trang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <style>
        :root {
            --primary-color: #333;
            --secondary-color: #666;
            --light-gray: #f5f5f5;
            --border-color: #e0e0e0;
            --hover-color: #f0f0f0;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: #333;
            line-height: 1.5;
            background: transparent;
        }

        .chat-container {
            width: 100%;
            max-width: 320px;
            max-height: 500px;
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .chat-header {
            background: white;
            color: var(--primary-color);
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(45deg, #eee, #ddd);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #555;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .ai-info h3 {
            font-size: 1.1rem;
            margin-bottom: 3px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
        }

        .ai-info h3 .ai-badge {
            background: #333;
            color: white;
            font-size: 0.6rem;
            padding: 2px 6px;
            border-radius: 20px;
            font-weight: normal;
        }

        .ai-info p {
            font-size: 0.85rem;
            color: var(--secondary-color);
        }

        .chat-messages {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background: white;
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-height: 300px;
        }

        .message {
            max-width: 85%;
            padding: 10px 14px;
            border-radius: 16px;
            font-size: 0.9rem;
            line-height: 1.4;
            animation: fadeIn 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
        }

        .ai-response ul,
        .ai-response ol {
            margin-left: 16px;
            margin-bottom: 8px;
        }

        .ai-response li {
            margin-bottom: 4px;
            font-size: 0.9rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .received {
            background: var(--light-gray);
            align-self: flex-start;
            border-bottom-left-radius: 5px;
            color: #333;
        }

        .sent {
            background: #333;
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 5px;
        }

        .typing-indicator {
            background: var(--light-gray);
            padding: 10px 14px;
            border-radius: 16px;
            align-self: flex-start;
            display: flex;
            gap: 5px;
            width: 80px;
        }

        .typing-dot {
            width: 7px;
            height: 7px;
            background: #666;
            border-radius: 50%;
            opacity: 0.7;
            animation: pulse 1.5s infinite;
        }

        .typing-dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 0.7;
            }
            50% {
                transform: scale(1.2);
                opacity: 1;
            }
        }

        .chat-input {
            padding: 12px;
            background: white;
            display: flex;
            gap: 8px;
            border-top: 1px solid var(--border-color);
        }

        .chat-input input {
            flex: 1;
            padding: 10px 16px;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            font-size: 0.9rem;
            outline: none;
            transition: var(--transition);
            background: var(--light-gray);
        }

        .chat-input input:focus {
            border-color: #999;
            box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.05);
        }

        .chat-input button {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #333;
            border: none;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-input button:hover {
            background: #444;
        }

        .quick-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 15px;
            justify-content: center;
            padding: 0 10px;
        }

        .action-btn {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 8px 15px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.03);
        }

        .action-btn:hover {
            background: var(--hover-color);
            border-color: #ccc;
        }

        .suggestions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }

        .suggestion-chip {
            background: var(--light-gray);
            color: #333;
            border-radius: 16px;
            padding: 6px 12px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: var(--transition);
            border: 1px solid var(--border-color);
        }

        .suggestion-chip:hover {
            background: #eaeaea;
        }

        .ai-response {
            position: relative;
            padding-left: 24px;
        }

        .ai-response::before {
            content: "🤖";
            position: absolute;
            left: 0;
            top: 10px;
            font-size: 1rem;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-top: 15px;
        }

        .product-card {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden;
            transition: var(--transition);
            background: white;
        }

        .product-card:hover {
            box-shadow: var(--shadow);
        }

        .product-image {
            height: 80px;
            background: #f8f8f8;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ccc;
        }

        .product-info {
            padding: 8px;
        }

        .product-name {
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 3px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price {
            font-size: 0.85rem;
            font-weight: 600;
            color: #333;
        }

        .product-badge {
            background: #333;
            color: white;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 5px;
        }

        .minimized-chat {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #333;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            cursor: pointer;
            box-shadow: var(--shadow);
            z-index: 1000;
            transition: var(--transition);
        }

        .minimized-chat:hover {
            transform: scale(1.05);
        }

        .close-chat {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #666;
            transition: var(--transition);
            border-radius: 50%;
            z-index: 10;
        }

        .close-chat:hover {
            background: var(--light-gray);
            color: #333;
        }

        .chat-visible {
            position: fixed;
            bottom: 80px;
            right: 20px;
            z-index: 1000;
        }
    </style>
</head>

<body>
    <div class="minimized-chat" id="minimized-chat">
        <i class="fas fa-comment-alt"></i>
    </div>

    <div class="chat-visible" id="chat-container" style="display: none;">
        <div class="close-chat" id="close-chat">✕</div>
        <div class="chat-container">
            <div class="chat-header">
                <div class="avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="ai-info">
                    <h3>M A G Bot <span class="ai-badge">AI</span></h3>
                    <p>Trợ lý thời trang thông minh</p>
                </div>
            </div>

            <div class="chat-messages" id="chat-messages">
                <div class="message received ai-response">
                    Xin chào! Tôi là CSKH - trợ lý thời trang. Tôi có thể giúp gì cho bạn hôm nay? 😊
                    <div class="suggestions">
                        <div class="suggestion-chip">Váy dự tiệc</div>
                        <div class="suggestion-chip">Áo khoác nam</div>
                        <div class="suggestion-chip">Tư vấn kích cỡ</div>
                        <div class="suggestion-chip">Phối đồ với jeans</div>
                    </div>
                </div>

                <!-- Product suggestions example -->
                <div class="message received ai-response">
                    Dưới đây là một số sản phẩm bạn có thể thích:
                    <div class="product-grid">
                        <div class="product-card">
                            <div class="product-image">
                                <i class="fas fa-tshirt"></i>
                            </div>
                            <div class="product-info">
                                <div class="product-name">Áo thun trơn</div>
                                <div class="product-price">249.000₫</div>
                                <div class="product-badge">Mới</div>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="product-image">
                                <i class="fas fa-vest"></i>
                            </div>
                            <div class="product-info">
                                <div class="product-name">Áo vest công sở</div>
                                <div class="product-price">1.250.000₫</div>
                                <div class="product-badge">Bán chạy</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="quick-actions">
                <div class="action-btn">
                    <i class="fas fa-tshirt"></i> Áo thun
                </div>
                <div class="action-btn">
                    <i class="fas fa-female"></i> Sơ mi
                </div>
                <div class="action-btn">
                    <i class="fas fa-male"></i> Quần
                </div>
                <div class="action-btn">
                    <i class="fas fa-shoe-prints"></i> Giày
                </div>
            </div>

            <div class="chat-input">
                <input type="text" id="message-input" placeholder="Nhập câu hỏi của bạn...">
                <button id="send-btn">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="dynamic-suggestions"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatMessages = document.getElementById('chat-messages');
            const messageInput = document.getElementById('message-input');
            const sendBtn = document.getElementById('send-btn');
            const suggestionChips = document.querySelectorAll('.suggestion-chip');
            const actionButtons = document.querySelectorAll('.action-btn');
            const dynamicSuggestions = document.getElementById('dynamic-suggestions');
            const minimizedChat = document.getElementById('minimized-chat');
            const chatContainer = document.getElementById('chat-container');
            const closeChat = document.getElementById('close-chat');

            // Toggle chat visibility
            minimizedChat.addEventListener('click', function() {
                chatContainer.style.display = 'block';
                minimizedChat.style.display = 'none';
                scrollToBottom();
            });

            closeChat.addEventListener('click', function() {
                chatContainer.style.display = 'none';
                minimizedChat.style.display = 'flex';
            });

            function scrollToBottom() {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            function addMessage(message, isReceived) {
                const messageDiv = document.createElement('div');
                messageDiv.classList.add('message');
                messageDiv.classList.add(isReceived ? 'received' : 'sent');
                if (isReceived) {
                    messageDiv.classList.add('ai-response');
                }
                if (isReceived) {
                    messageDiv.innerHTML = marked.parse(message);
                } else {
                    messageDiv.textContent = message;
                }
                chatMessages.appendChild(messageDiv);
                scrollToBottom();
            }

            async function sendMessage() {
                const message = messageInput.value.trim();
                if (message) {
                    addMessage(message, false);
                    messageInput.value = '';

                    const typingIndicator = document.createElement('div');
                    typingIndicator.classList.add('typing-indicator');
                    typingIndicator.innerHTML = `
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    `;
                    chatMessages.appendChild(typingIndicator);
                    scrollToBottom();

                    try {
                        const response = await fetch('http://127.0.0.1:8000/api/gpt-chat', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `my_instructions=${encodeURIComponent(message)}`
                        });

                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }

                        const data = await response.json();
                        if (data.status === 'success') {
                            chatMessages.removeChild(typingIndicator);
                            addMessage(data.message, true);
                            updateDynamicSuggestions(data.suggestions);
                        } else {
                            throw new Error(data.detail || 'Có lỗi xảy ra');
                        }
                    } catch (error) {
                        chatMessages.removeChild(typingIndicator);
                        addMessage(`Xin lỗi, tôi gặp sự cố khi trả lời: ${error.message}`, true);
                    }
                }
            }

            function updateDynamicSuggestions(suggestions) {
                if (suggestions && suggestions.trim() !== "") {
                    dynamicSuggestions.innerHTML = suggestions;
                    dynamicSuggestions.style.display = 'block';
                } else {
                    dynamicSuggestions.innerHTML = '';
                    dynamicSuggestions.style.display = 'none';
                }
            }

            sendBtn.addEventListener('click', sendMessage);

            messageInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });

            suggestionChips.forEach(chip => {
                chip.addEventListener('click', function () {
                    messageInput.value = this.textContent;
                    sendMessage();
                });
            });

            actionButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const text = this.textContent.trim();
                    messageInput.value = text;
                    sendMessage();
                });
            });

            scrollToBottom();
        });
    </script>
</body>

</html>
