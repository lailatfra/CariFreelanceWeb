@extends(auth()->user()->role === 'freelancer' ? 'freelancer.layout.freelancer-layout' : 'client.layout.client-layout')
@section('title', 'Pesan - CariFreelance')
@section('content')

<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        background: #f0f2f5;
        overflow: hidden;
    }
    
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: #f1f5f9; }
    ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
    ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

    .chat-container {
        height: calc(100vh - 80px);
        display: flex;
        background: #f0f2f5;
        width: 100vw;
        position: relative;
    }

    /* Sidebar Styles */
    .chat-sidebar {
        width: 380px;
        background: #fff;
        border-right: 1px solid #e5e7eb;
        display: flex;
        flex-direction: column;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        z-index: 10;
    }

    .chat-sidebar.minimized {
        width: 80px;
    }

    .chat-sidebar-header {
        padding: 1.5rem 1.25rem;
        border-bottom: 1px solid #e5e7eb;
        background: linear-gradient(135deg, #1DA1F2 0%, #0d7ac9 100%);
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .sidebar-header-content {
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
    }

    .chat-sidebar.minimized .sidebar-header-content span {
        display: none;
    }

    .chat-sidebar-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0;
        transition: opacity 0.3s;
    }

    .chat-sidebar.minimized .chat-sidebar-title {
        opacity: 0;
        width: 0;
    }

    .toggle-sidebar-btn {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        flex-shrink: 0;
    }

    .toggle-sidebar-btn:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .chat-list {
        flex: 1;
        overflow-y: auto;
        padding: 0.5rem 0;
    }

    .chat-item {
        padding: 1rem 1.25rem;
        cursor: pointer;
        transition: all 0.2s;
        border-left: 3px solid transparent;
        display: flex;
        align-items: center;
        gap: 12px;
        position: relative;
    }

    .chat-sidebar.minimized .chat-item {
        padding: 1rem 0.5rem;
        justify-content: center;
    }

    .chat-item:hover {
        background: #f8fafc;
        border-left-color: #e5e7eb;
    }

    .chat-item.active {
        background: linear-gradient(90deg, #e3f2fd 0%, #f8fafc 100%);
        border-left-color: #1DA1F2;
    }

    .chat-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1DA1F2, #0d7ac9);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 18px;
        flex-shrink: 0;
    }

    .chat-item-content {
        flex: 1;
        min-width: 0;
        transition: opacity 0.3s;
    }

    .chat-sidebar.minimized .chat-item-content {
        display: none;
    }

    .chat-item-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.25rem;
        align-items: center;
    }

    .chat-item-name {
        font-weight: 600;
        color: #1f2937;
        font-size: 0.95rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .chat-item-time {
        font-size: 0.75rem;
        color: #64748b;
        white-space: nowrap;
    }

    .chat-item-preview {
        color: #6b7280;
        font-size: 0.875rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
    }

    .chat-item-preview span:first-child {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        flex: 1;
    }

    .chat-unread-badge {
        background: #1DA1F2;
        color: white;
        font-size: 0.7rem;
        padding: 2px 6px;
        border-radius: 10px;
        min-width: 20px;
        text-align: center;
        font-weight: 600;
        flex-shrink: 0;
    }

    /* Main Chat Area */
    .chat-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: #fff;
        position: relative;
    }

    .chat-header {
        padding: 1.25rem 1.5rem;
        background: #fff;
        border-bottom: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .chat-header-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 0.25rem 0;
    }

    .typing-indicator {
        font-size: 0.85rem;
        color: #10b981;
        font-style: italic;
        min-height: 20px;
    }

    .chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 1.5rem;
        background: linear-gradient(to bottom, #f8fafc 0%, #f0f2f5 100%);
        display: flex;
        flex-direction: column;
    }

    /* Message Styles */
    .message {
        margin-bottom: 1rem;
        display: flex;
        flex-direction: column;
        max-width: 65%;
        animation: slideIn 0.3s ease;
        clear: both;
    }

    .message.sent {
        align-self: flex-end;
        align-items: flex-end;
        margin-left: auto;
    }

    .message.received {
        align-self: flex-start;
        margin-right: auto;
    }

    .message-bubble {
        padding: 0.75rem 1rem;
        border-radius: 16px;
        font-size: 0.95rem;
        word-wrap: break-word;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08);
        position: relative;
    }

    .message.sent .message-bubble {
        background: linear-gradient(135deg, #1DA1F2, #0d7ac9);
        color: white;
        border-bottom-right-radius: 4px;
    }

    .message.received .message-bubble {
        background: white;
        color: #1f2937;
        border: 1px solid #e5e7eb;
        border-bottom-left-radius: 4px;
    }

    .message-footer {
        display: flex;
        align-items: center;
        gap: 4px;
        margin-top: 0.25rem;
    }

    .message-time {
        font-size: 0.7rem;
        color: #6b7280;
    }

    /* Message Status Icons */
    .message-status {
        display: inline-flex;
        align-items: center;
        font-size: 0.8rem;
    }

    .message-status.pending {
        color: #9ca3af;
    }

    .message-status.sent {
        color: #6b7280;
    }

    .message-status.delivered {
        color: #1DA1F2;
    }

    .message-status i {
        font-size: 14px;
    }

    /* Clock icon animation */
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .message-status.pending i {
        animation: spin 1s linear infinite;
    }

    /* Chat Input Area */
    .chat-input-area {
        padding: 1rem 1.5rem;
        background: white;
        border-top: 1px solid #e5e7eb;
    }

    .chat-input-container {
        display: flex;
        gap: 0.75rem;
        align-items: flex-end;
    }

    .chat-input {
        flex: 1;
        padding: 0.875rem 1.25rem;
        border: 2px solid #e5e7eb;
        border-radius: 24px;
        background: #f8fafc;
        font-size: 0.95rem;
        outline: none;
        font-family: inherit;
        resize: none;
        max-height: 120px;
        overflow-y: auto;
        line-height: 1.5;
        transition: all 0.3s;
    }

    .chat-input:focus {
        border-color: #1DA1F2;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(29, 161, 242, 0.1);
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
        cursor: pointer;
        transition: all 0.3s;
        flex-shrink: 0;
    }

    .send-btn:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(29, 161, 242, 0.4);
    }

    .send-btn:active:not(:disabled) {
        transform: translateY(0);
    }

    .send-btn:disabled {
        background: #e5e7eb;
        cursor: not-allowed;
        opacity: 0.6;
    }

    /* Empty State */
    .empty-chat {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        padding: 3rem;
    }

    .empty-chat-icon {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 1.5rem;
    }

    .empty-chat h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .empty-chat p {
        font-size: 0.95rem;
        color: #6b7280;
    }

    /* Animations */
    @keyframes slideIn {
        from { 
            opacity: 0; 
            transform: translateY(10px); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .chat-sidebar {
            width: 320px;
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            z-index: 100;
            transform: translateX(-100%);
        }

        .chat-sidebar.visible {
            transform: translateX(0);
        }

        .chat-sidebar.minimized {
            width: 320px;
        }

        .message {
            max-width: 85%;
        }
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="chat-container">
    <div class="chat-sidebar" id="chatSidebar">
        <div class="chat-sidebar-header">
            <div class="sidebar-header-content">
                <i class="fas fa-comments" style="font-size: 1.5rem;"></i>
                <h2 class="chat-sidebar-title">Pesan</h2>
            </div>
            <button class="toggle-sidebar-btn" id="toggleSidebar" title="Minimize sidebar">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>
        
        <div class="chat-list">
            @forelse($conversations as $conv)
                <div class="chat-item" data-conversation-id="{{ $conv['id'] }}">
                    <div class="chat-avatar">{{ strtoupper(substr($conv['other_user_name'], 0, 1)) }}</div>
                    <div class="chat-item-content">
                        <div class="chat-item-header">
                            <h4 class="chat-item-name">{{ $conv['other_user_name'] }}</h4>
                            <span class="chat-item-time">{{ $conv['last_message_time'] }}</span>
                        </div>
                        <div class="chat-item-preview">
                            <span>{{ Str::limit($conv['last_message'] ?? 'Belum ada pesan', 40) }}</span>
                            @if($conv['unread_count'] > 0)
                                <span class="chat-unread-badge">{{ $conv['unread_count'] }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-chat">
                    <div class="empty-chat-icon"><i class="fas fa-comments"></i></div>
                    <h3>Belum Ada Percakapan</h3>
                    <p>Mulai dengan memilih freelancer</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="chat-main" id="chatMain">
        <div class="empty-chat">
            <div class="empty-chat-icon"><i class="fas fa-comments"></i></div>
            <h3>Pilih Percakapan</h3>
            <p>Pilih percakapan dari sidebar untuk memulai chat</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentConversationId = null;
    let currentChannel = null;
    let typingTimeout = null;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const currentUserId = {{ auth()->id() }};

    // Sidebar toggle functionality
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('chatSidebar');
    
    toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('minimized');
        const icon = this.querySelector('i');
        if (sidebar.classList.contains('minimized')) {
            icon.className = 'fas fa-chevron-right';
            this.title = 'Expand sidebar';
        } else {
            icon.className = 'fas fa-chevron-left';
            this.title = 'Minimize sidebar';
        }
    });

    // Check Echo
    if (typeof window.Echo === 'undefined') {
        console.error('❌ Echo not initialized! Make sure Vite is running: npm run dev');
        return;
    }
    console.log('✅ Echo is ready');

    // Select chat handler
    document.querySelectorAll('.chat-item').forEach(item => {
        item.addEventListener('click', function() {
            const convId = parseInt(this.dataset.conversationId);
            selectChat(convId);
        });
    });

    async function selectChat(conversationId) {
        currentConversationId = conversationId;
        
        document.querySelectorAll('.chat-item').forEach(i => i.classList.remove('active'));
        document.querySelector(`[data-conversation-id="${conversationId}"]`)?.classList.add('active');
        
        await loadConversation(conversationId);
        subscribeToConversation(conversationId);
    }

    async function loadConversation(conversationId) {
        try {
            const res = await fetch(`/chat/conversations/${conversationId}`, {
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
            });
            
            const data = await res.json();
            renderChatUI(data.conversation, data.messages);
            markAsRead(conversationId);
            
        } catch (error) {
            console.error('Load error:', error);
        }
    }

    function renderChatUI(conversation, messages) {
        const chatMain = document.getElementById('chatMain');
        
        chatMain.innerHTML = `
            <div class="chat-header">
                <h3 class="chat-header-name">${conversation.other_user.name}</h3>
                <div class="typing-indicator" id="typingIndicator"></div>
                <small style="color: #64748b;">Project: ${conversation.project_title}</small>
            </div>

            <div class="chat-messages" id="chatMessages">
                ${messages.map(msg => renderMessage(msg)).join('')}
            </div>

            <div class="chat-input-area">
                <div class="chat-input-container">
                    <textarea class="chat-input" placeholder="Ketik pesan... (Shift+Enter untuk baris baru)" id="messageInput" rows="1"></textarea>
                    <button class="send-btn" id="sendBtn">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        `;
        
        const messageInput = document.getElementById('messageInput');
        const sendBtn = document.getElementById('sendBtn');
        
        // Auto-resize textarea
        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
            handleTyping();
        });
        
        // Send on Enter (Shift+Enter for new line)
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
        
        sendBtn.addEventListener('click', sendMessage);
        
        scrollToBottom();
        messageInput.focus();
    }

    function renderMessage(msg, status = 'delivered') {
        const messageClass = msg.is_own ? 'sent' : 'received';
        const statusIcon = getStatusIcon(status);
        
        return `
            <div class="message ${messageClass}" data-message-id="${msg.id}">
                <div class="message-bubble">${escapeHtml(msg.message || '')}</div>
                <div class="message-footer">
                    <span class="message-time">${msg.formatted_time}</span>
                    ${msg.is_own ? `<span class="message-status ${status}">${statusIcon}</span>` : ''}
                </div>
            </div>
        `;
    }

    function getStatusIcon(status) {
        switch(status) {
            case 'pending':
                return '<i class="far fa-clock"></i>';
            case 'sent':
                return '<i class="fas fa-check"></i>';
            case 'delivered':
                return '<i class="fas fa-check-double"></i>';
            default:
                return '';
        }
    }

    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }

    async function sendMessage() {
        const messageInput = document.getElementById('messageInput');
        const sendBtn = document.getElementById('sendBtn');
        const message = messageInput?.value.trim();
        
        if (!message || !currentConversationId) return;
        
        // Stop typing indicator immediately
        clearTimeout(typingTimeout);
        sendTypingStatus(false);
        
        // Create temporary message ID
        const tempId = 'temp_' + Date.now();
        
        // Show message immediately with pending status
        const tempMessage = {
            id: tempId,
            message: message,
            is_own: true,
            formatted_time: 'Mengirim...'
        };
        
        const chatMessages = document.getElementById('chatMessages');
        chatMessages.insertAdjacentHTML('beforeend', renderMessage(tempMessage, 'pending'));
        scrollToBottom();
        
        // Clear input
        const messageToSend = message;
        messageInput.value = '';
        messageInput.style.height = 'auto';
        
        try {
            const formData = new FormData();
            formData.append('message', messageToSend);
            
            const res = await fetch(`/chat/conversations/${currentConversationId}/send`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                body: formData
            });
            
            const data = await res.json();
            
            if (data.success) {
                // Remove temporary message
                const tempMsgElement = document.querySelector(`[data-message-id="${tempId}"]`);
                if (tempMsgElement) {
                    tempMsgElement.remove();
                }
                
                // The real message will be added via Echo broadcast
                // Update status to sent
                setTimeout(() => {
                    const realMsg = document.querySelector(`[data-message-id="${data.message.id}"]`);
                    if (realMsg) {
                        const statusElement = realMsg.querySelector('.message-status');
                        if (statusElement) {
                            statusElement.className = 'message-status sent';
                            statusElement.innerHTML = '<i class="fas fa-check"></i>';
                        }
                    }
                }, 500);
                
            } else {
                // If failed, update temp message to show error
                const tempMsgElement = document.querySelector(`[data-message-id="${tempId}"]`);
                if (tempMsgElement) {
                    tempMsgElement.querySelector('.message-bubble').style.background = '#fee';
                    tempMsgElement.querySelector('.message-time').textContent = 'Gagal terkirim';
                }
                alert('Gagal mengirim pesan');
            }
            
        } catch (error) {
            console.error('Send error:', error);
            const tempMsgElement = document.querySelector(`[data-message-id="${tempId}"]`);
            if (tempMsgElement) {
                tempMsgElement.querySelector('.message-bubble').style.background = '#fee';
                tempMsgElement.querySelector('.message-time').textContent = 'Gagal terkirim';
            }
            alert('Gagal mengirim pesan');
        } finally {
            messageInput.focus();
        }
    }

    function handleTyping() {
        clearTimeout(typingTimeout);
        sendTypingStatus(true);
        
        typingTimeout = setTimeout(() => {
            sendTypingStatus(false);
        }, 2000);
    }
    
    function sendTypingStatus(isTyping) {
        fetch(`/chat/conversations/${currentConversationId}/typing`, {
            method: 'POST',
            headers: { 
                'X-CSRF-TOKEN': csrfToken, 
                'Content-Type': 'application/json' 
            },
            body: JSON.stringify({ is_typing: isTyping })
        }).catch(() => {});
    }

    function subscribeToConversation(conversationId) {
        if (currentChannel) {
            window.Echo.leave(currentChannel);
        }
        
        currentChannel = `conversation.${conversationId}`;
        console.log('🔔 Subscribing to:', currentChannel);
        
        window.Echo.private(currentChannel)
            .listen('.message.sent', (e) => {
                console.log('📨 New message received:', e);
                appendMessage(e);
            })
            .listen('.user.typing', (e) => {
                if (e.user_id !== currentUserId) {
                    showTypingIndicator(e);
                }
            });
    }

    function appendMessage(messageData) {
        const chatMessages = document.getElementById('chatMessages');
        if (!chatMessages) return;
        
        const msg = {
            id: messageData.id,
            message: messageData.message,
            is_own: messageData.sender_id === currentUserId,
            formatted_time: messageData.formatted_time
        };
        
        chatMessages.insertAdjacentHTML('beforeend', renderMessage(msg, 'delivered'));
        scrollToBottom();
    }

    function showTypingIndicator(data) {
        const indicator = document.getElementById('typingIndicator');
        if (!indicator) return;
        
        if (data.is_typing) {
            indicator.textContent = `${data.user_name} sedang mengetik...`;
            setTimeout(() => {
                indicator.textContent = '';
            }, 3000);
        } else {
            indicator.textContent = '';
        }
    }

    async function markAsRead(conversationId) {
        try {
            await fetch(`/chat/conversations/${conversationId}/mark-read`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken }
            });
        } catch (error) {
            console.error('Mark as read error:', error);
        }
    }

    function scrollToBottom() {
        const chatMessages = document.getElementById('chatMessages');
        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    }
});
</script>

@endsection