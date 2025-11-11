@extends('freelancer.layout.freelancer-layout')
@section('title', 'Pesan - CariFreelance')
@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CariFreelance - Chat</title>
    <style>
        /* Base styles matching your home page */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8fafc;
            overflow-x: hidden;
        }

        /* Hide scrollbars */
        ::-webkit-scrollbar {
            display: none;
        }
        
        html, body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Main chat container */
        .chat-container {
            height: calc(100vh - 80px);
            display: flex;
            background: #f8fafc;
            margin-top: 0;
            width: 100vw;
        }

        /* Chat sidebar */
        .chat-sidebar {
            width: 320px;
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.04);
        }

        .chat-sidebar-header {
            padding: 1.5rem 1.25rem 1rem;
            border-bottom: 1px solid #e2e8f0;
            background: #ffffff;
        }

        .chat-sidebar-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 1rem 0;
        }

        .chat-search {
            position: relative;
        }

        .chat-search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fafc;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .chat-search-input:focus {
            border-color: #1DA1F2;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(29, 161, 242, 0.1);
        }

        .chat-search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 0.9rem;
        }

        /* Chat list */
        .chat-list {
            flex: 1;
            overflow-y: auto;
            padding: 0.5rem 0;
        }

        .chat-item {
            padding: 1rem 1.25rem;
            cursor: pointer;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
            background: white;
            border-bottom: 1px solid #f1f5f9;
        }

        .chat-item:hover {
            background: #f8fafc;
            border-left-color: #e2e8f0;
        }

        .chat-item.active {
            background: #f8fafc;
            border-left-color: #1DA1F2;
        }

        .chat-item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
        }

        .chat-item-name {
            font-weight: 600;
            color: #1f2937;
            font-size: 0.95rem;
            margin: 0;
        }

        .chat-item-time {
            font-size: 0.8rem;
            color: #64748b;
            flex-shrink: 0;
            margin-left: 0.5rem;
        }

        .chat-item-preview {
            color: #6b7280;
            font-size: 0.875rem;
            line-height: 1.4;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chat-item-text {
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .chat-unread-badge {
            background: #1DA1F2;
            color: white;
            font-size: 0.75rem;
            padding: 0.2rem 0.5rem;
            border-radius: 50px;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-left: 0.5rem;
            flex-shrink: 0;
        }

        /* Main chat area */
        .chat-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #ffffff;
        }

        /* Chat header */
        .chat-header {
            padding: 1.25rem 1.5rem;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chat-header-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .chat-avatar {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #1DA1F2, #0d7ac9);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .chat-header-details {
            display: flex;
            flex-direction: column;
        }

        .chat-header-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 0.25rem 0;
        }

        .chat-header-status {
            font-size: 0.85rem;
            color: #10b981;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
        }

        .chat-header-actions {
            display: flex;
            gap: 0.75rem;
        }

        .chat-action-btn {
            background: none;
            border: 2px solid #e2e8f0;
            color: #64748b;
            font-size: 1.1rem;
            padding: 0.6rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-action-btn:hover {
            background: #f8fafc;
            color: #1DA1F2;
            border-color: #1DA1F2;
            transform: translateY(-1px);
        }

        /* Messages area */
        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
            background: #f8fafc;
            background-image: 
                radial-gradient(circle at 1px 1px, rgba(0,0,0,0.03) 1px, transparent 0);
            background-size: 20px 20px;
        }

        .message {
            margin-bottom: 1.5rem;
            display: flex;
            flex-direction: column;
            max-width: 70%;
            animation: messageSlideIn 0.3s ease;
        }

        .message.sent {
            align-self: flex-end;
            align-items: flex-end;
        }

        .message.received {
            align-self: flex-start;
            align-items: flex-start;
        }

        .message-bubble {
            padding: 0.875rem 1.25rem;
            border-radius: 18px;
            font-size: 0.95rem;
            line-height: 1.5;
            word-wrap: break-word;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .message.sent .message-bubble {
            background: linear-gradient(135deg, #1DA1F2, #0d7ac9);
            color: white;
            border-bottom-right-radius: 6px;
        }

        .message.received .message-bubble {
            background: white;
            color: #1f2937;
            border: 1px solid #e2e8f0;
            border-bottom-left-radius: 6px;
        }

        .message-time {
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 0.5rem;
            padding: 0 0.25rem;
        }

        .message.sent .message-time {
            color: #94a3b8;
        }

        /* Message input area */
        .chat-input-area {
            padding: 1.25rem 1.5rem;
            background: white;
            border-top: 1px solid #e2e8f0;
        }

        .chat-input-container {
            display: flex;
            align-items: flex-end;
            gap: 0.75rem;
        }

        .chat-input-wrapper {
            flex: 1;
            position: relative;
        }

        .chat-input {
            width: 100%;
            max-height: 120px;
            min-height: 48px;
            padding: 0.875rem 3rem 0.875rem 1.25rem;
            border: 2px solid #e2e8f0;
            border-radius: 24px;
            background: #f8fafc;
            font-size: 0.95rem;
            line-height: 1.4;
            resize: none;
            outline: none;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .chat-input:focus {
            border-color: #1DA1F2;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(29, 161, 242, 0.1);
        }

        .chat-input::placeholder {
            color: #94a3b8;
        }

        .attachment-btn {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            font-size: 1.1rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .attachment-btn:hover {
            color: #1DA1F2;
            background: rgba(29, 161, 242, 0.1);
        }

        .send-btn {
            background: linear-gradient(135deg, #1DA1F2, #0d7ac9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .send-btn:hover {
            background: linear-gradient(135deg, #0d7ac9, #1DA1F2);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(29, 161, 242, 0.3);
        }

        .send-btn:disabled {
            background: #e2e8f0;
            color: #94a3b8;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Empty state */
        .empty-chat {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #6b7280;
            padding: 3rem;
        }

        .empty-chat-icon {
            font-size: 4rem;
            color: #d1d5db;
            margin-bottom: 1.5rem;
        }

        .empty-chat-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .empty-chat-subtitle {
            font-size: 1rem;
            color: #6b7280;
        }

        /* Animations */
        @keyframes messageSlideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .chat-container {
                height: calc(100vh - 70px);
            }

            .chat-sidebar {
                width: 100%;
                position: absolute;
                left: -100%;
                transition: left 0.3s ease;
                z-index: 1020;
            }

            .chat-sidebar.show {
                left: 0;
            }

            .chat-main {
                width: 100%;
            }

            .message {
                max-width: 85%;
            }

            .chat-input-area {
                padding: 1rem;
            }

            .chat-messages {
                padding: 1rem;
            }

            .mobile-chat-toggle {
                display: block;
                background: none;
                border: 2px solid #e2e8f0;
                color: #64748b;
                font-size: 1.1rem;
                padding: 0.6rem;
                border-radius: 12px;
                margin-right: 0.75rem;
                position: absolute;
                top: 1rem;
                left: 1rem;
                z-index: 1025;
            }
        }

        @media (min-width: 769px) {
            .mobile-chat-toggle {
                display: none;
            }
        }

        /* Scrollbar styling for chat areas only */
        .chat-list::-webkit-scrollbar,
        .chat-messages::-webkit-scrollbar {
            width: 6px;
        }

        .chat-list::-webkit-scrollbar-track,
        .chat-messages::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .chat-list::-webkit-scrollbar-thumb,
        .chat-messages::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .chat-list::-webkit-scrollbar-thumb:hover,
        .chat-messages::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Animate on scroll */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.6s ease;
        }

        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <!-- Mobile chat toggle button -->
    <button class="mobile-chat-toggle" onclick="toggleChatSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <div class="chat-container">
        <!-- Chat Sidebar -->
        <div class="chat-sidebar" id="chatSidebar">
            <div class="chat-sidebar-header">
                <h2 class="chat-sidebar-title">Pesan</h2>
                <div class="chat-search">
                    <i class="fas fa-search chat-search-icon"></i>
                    <input type="text" class="chat-search-input" placeholder="Cari percakapan...">
                </div>
            </div>
            
            <div class="chat-list">
                <!-- Chat items -->
                <div class="chat-item active" onclick="selectChat('john-doe')">
                    <div class="chat-item-header">
                        <h4 class="chat-item-name">John Doe</h4>
                        <span class="chat-item-time">10:30</span>
                    </div>
                    <div class="chat-item-preview">
                        <span class="chat-item-text">Halo, saya tertarik dengan proyek Anda...</span>
                        <span class="chat-unread-badge">2</span>
                    </div>
                </div>
                
                <div class="chat-item" onclick="selectChat('sarah-wilson')">
                    <div class="chat-item-header">
                        <h4 class="chat-item-name">Sarah Wilson</h4>
                        <span class="chat-item-time">09:45</span>
                    </div>
                    <div class="chat-item-preview">
                        <span class="chat-item-text">Terima kasih atas kerjanya yang bagus!</span>
                    </div>
                </div>
                
                <div class="chat-item" onclick="selectChat('mike-johnson')">
                    <div class="chat-item-header">
                        <h4 class="chat-item-name">Mike Johnson</h4>
                        <span class="chat-item-time">Kemarin</span>
                    </div>
                    <div class="chat-item-preview">
                        <span class="chat-item-text">Kapan bisa mulai mengerjakan proyek?</span>
                        <span class="chat-unread-badge">1</span>
                    </div>
                </div>
                
                <div class="chat-item" onclick="selectChat('anna-davis')">
                    <div class="chat-item-header">
                        <h4 class="chat-item-name">Anna Davis</h4>
                        <span class="chat-item-time">2 hari lalu</span>
                    </div>
                    <div class="chat-item-preview">
                        <span class="chat-item-text">File sudah saya kirim via email</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="chat-main" id="chatMain">
            <!-- Chat Header -->
            <div class="chat-header">
                <div class="chat-header-info">
                    <div class="chat-avatar">JD</div>
                    <div class="chat-header-details">
                        <h3 class="chat-header-name">John Doe</h3>
                        <p class="chat-header-status">
                            <span class="status-dot"></span>
                            Online
                        </p>
                    </div>
                </div>
                <div class="chat-header-actions">
                    <button class="chat-action-btn" title="Panggilan Video">
                        <i class="fas fa-video"></i>
                    </button>
                    <button class="chat-action-btn" title="Informasi">
                        <i class="fas fa-info-circle"></i>
                    </button>
                </div>
            </div>

            <!-- Messages -->
            <div class="chat-messages" id="chatMessages">
                <div class="message received">
                    <div class="message-bubble">
                        Halo! Saya tertarik dengan proyek website e-commerce yang Anda posting. Saya memiliki pengalaman 5 tahun dalam pengembangan web dan sudah mengerjakan banyak proyek serupa.
                    </div>
                    <div class="message-time">10:15</div>
                </div>
                
                <div class="message sent">
                    <div class="message-bubble">
                        Halo John! Terima kasih atas minatnya. Bisa tolong kirim portfolio dan perkiraan timeline pengerjaan?
                    </div>
                    <div class="message-time">10:20</div>
                </div>
                
                <div class="message received">
                    <div class="message-bubble">
                        Tentu! Saya akan kirim portfolio saya dan untuk timeline, estimasi sekitar 4-6 minggu untuk proyek ini. Apakah ada fitur khusus yang ingin diprioritaskan?
                    </div>
                    <div class="message-time">10:25</div>
                </div>
                
                <div class="message sent">
                    <div class="message-bubble">
                        Perfect! Yang penting adalah sistem pembayaran yang aman dan dashboard admin yang user-friendly. Kita bisa diskusi lebih detail via video call?
                    </div>
                    <div class="message-time">10:28</div>
                </div>
            </div>

            <!-- Input Area -->
            <div class="chat-input-area">
                <div class="chat-input-container">
                    <div class="chat-input-wrapper">
                        <textarea class="chat-input" placeholder="Ketik pesan..." id="messageInput" rows="1"></textarea>
                        <button class="attachment-btn" title="Lampiran">
                            <i class="fas fa-paperclip"></i>
                        </button>
                    </div>
                    <button class="send-btn" id="sendBtn" onclick="sendMessage()">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-resize textarea
        const messageInput = document.getElementById('messageInput');
        const sendBtn = document.getElementById('sendBtn');
        const chatMessages = document.getElementById('chatMessages');

        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
            
            // Enable/disable send button
            sendBtn.disabled = this.value.trim() === '';
        });

        // Send message on Enter (but allow Shift+Enter for new line)
        messageInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        // Send message function
        function sendMessage() {
            const message = messageInput.value.trim();
            if (message === '') return;

            // Create message element
            const messageDiv = document.createElement('div');
            messageDiv.className = 'message sent';
            
            const currentTime = new Date().toLocaleTimeString('id-ID', { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
            
            messageDiv.innerHTML = `
                <div class="message-bubble">${message}</div>
                <div class="message-time">${currentTime}</div>
            `;

            // Append to messages
            chatMessages.appendChild(messageDiv);
            
            // Clear input
            messageInput.value = '';
            messageInput.style.height = 'auto';
            sendBtn.disabled = true;
            
            // Scroll to bottom
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Simulate received message after 2 seconds
            setTimeout(() => {
                const receivedDiv = document.createElement('div');
                receivedDiv.className = 'message received';
                receivedDiv.innerHTML = `
                    <div class="message-bubble">Terima kasih atas pesannya! Saya akan merespons segera.</div>
                    <div class="message-time">${new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })}</div>
                `;
                chatMessages.appendChild(receivedDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }, 2000);
        }

        // Select chat function
        function selectChat(chatId) {
            // Remove active class from all chat items
            document.querySelectorAll('.chat-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Add active class to selected chat
            event.currentTarget.classList.add('active');
            
            // Hide sidebar on mobile after selection
            if (window.innerWidth <= 768) {
                document.getElementById('chatSidebar').classList.remove('show');
            }
            
            // Here you would typically load the chat messages for the selected user
            // For demo purposes, we'll just update the header
            const chatName = event.currentTarget.querySelector('.chat-item-name').textContent;
            const initials = chatName.split(' ').map(n => n[0]).join('');
            
            document.querySelector('.chat-header-name').textContent = chatName;
            document.querySelector('.chat-avatar').textContent = initials;
        }

        // Toggle chat sidebar on mobile
        function toggleChatSidebar() {
            const sidebar = document.getElementById('chatSidebar');
            sidebar.classList.toggle('show');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('chatSidebar');
            const toggleBtn = document.querySelector('.mobile-chat-toggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(e.target) && 
                !toggleBtn.contains(e.target)) {
                sidebar.classList.remove('show');
            }
        });

        // Scroll to bottom on load
        document.addEventListener('DOMContentLoaded', function() {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.getElementById('chatSidebar').classList.remove('show');
            }
        });

        // Scroll animations (matching your home page)
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>

@endsection