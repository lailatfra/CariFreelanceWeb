@extends(auth()->user()->role === 'freelancer' ? 'freelancer.layout.freelancer-layout' : 'client.layout.client-layout')
@section('title', 'Pesan - CariFreelance')
@section('content')

<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; }
    
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: #f1f5f9; }
    ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }

    .chat-container {
        height: calc(100vh - 80px);
        display: flex;
        background: #f8fafc;
        width: 100vw;
    }

    .chat-sidebar {
        width: 320px;
        background: #fff;
        border-right: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
    }

    .chat-sidebar-header {
        padding: 1.5rem 1.25rem 1rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .chat-sidebar-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 1rem 0;
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
        margin-bottom: 0.5rem;
    }

    .chat-item-name {
        font-weight: 600;
        color: #1f2937;
        font-size: 0.95rem;
    }

    .chat-item-time {
        font-size: 0.8rem;
        color: #64748b;
    }

    .chat-item-preview {
        color: #6b7280;
        font-size: 0.875rem;
        display: flex;
        justify-content: space-between;
    }

    .chat-unread-badge {
        background: #1DA1F2;
        color: white;
        font-size: 0.75rem;
        padding: 0.2rem 0.5rem;
        border-radius: 50px;
        min-width: 18px;
    }

    .chat-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: #fff;
    }

    .chat-header {
        padding: 1.25rem 1.5rem;
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
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
        background: #f8fafc;
    }

    .message {
        margin-bottom: 1.5rem;
        display: flex;
        flex-direction: column;
        max-width: 70%;
        animation: slideIn 0.3s ease;
    }

    .message.sent {
        align-self: flex-end;
        align-items: flex-end;
    }

    .message.received {
        align-self: flex-start;
    }

    .message-bubble {
        padding: 0.875rem 1.25rem;
        border-radius: 18px;
        font-size: 0.95rem;
        word-wrap: break-word;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
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
    }

    .chat-input-area {
        padding: 1.25rem 1.5rem;
        background: white;
        border-top: 1px solid #e2e8f0;
    }

    .chat-input-container {
        display: flex;
        gap: 0.75rem;
    }

    .chat-input {
        flex: 1;
        padding: 0.875rem 1.25rem;
        border: 2px solid #e2e8f0;
        border-radius: 24px;
        background: #f8fafc;
        font-size: 0.95rem;
        outline: none;
        font-family: inherit;
        resize: none;
        max-height: 120px;
        overflow-y: auto;
        line-height: 1.5;
    }

    .chat-input:focus {
        border-color: #1DA1F2;
        background: #fff;
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
    }

    .send-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(29, 161, 242, 0.3);
    }

    .send-btn:disabled {
        background: #e2e8f0;
        cursor: not-allowed;
    }

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

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="chat-container">
    <div class="chat-sidebar">
        <div class="chat-sidebar-header">
            <h2 class="chat-sidebar-title">Pesan</h2>
        </div>
        
        <div class="chat-list">
            @forelse($conversations as $conv)
                <div class="chat-item" data-conversation-id="{{ $conv['id'] }}">
                    <div class="chat-item-header">
                        <h4 class="chat-item-name">{{ $conv['other_user_name'] }}</h4>
                        <span class="chat-item-time">{{ $conv['last_message_time'] }}</span>
                    </div>
                    <div class="chat-item-preview">
                        <span>{{ $conv['project_title'] }}: {{ $conv['last_message'] ?? 'Belum ada pesan' }}</span>
                        @if($conv['unread_count'] > 0)
                            <span class="chat-unread-badge">{{ $conv['unread_count'] }}</span>
                        @endif
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
            <p>Pilih percakapan dari sidebar</p>
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
                e.preventDefault(); // Prevent new line
                sendMessage();
            }
        });
        
        sendBtn.addEventListener('click', sendMessage);
        
        scrollToBottom();
        messageInput.focus();
    }

    function renderMessage(msg) {
        const messageClass = msg.is_own ? 'sent' : 'received';
        return `
            <div class="message ${messageClass}" data-message-id="${msg.id}">
                <div class="message-bubble">${msg.message || ''}</div>
                <div class="message-time">${msg.formatted_time}</div>
            </div>
        `;
    }

    async function sendMessage() {
        const messageInput = document.getElementById('messageInput');
        const sendBtn = document.getElementById('sendBtn');
        const message = messageInput?.value.trim();
        
        if (!message || !currentConversationId) return;
        
        // Stop typing indicator immediately
        clearTimeout(typingTimeout);
        sendTypingStatus(false);
        
        // Disable input during send
        messageInput.disabled = true;
        sendBtn.disabled = true;
        
        try {
            const formData = new FormData();
            formData.append('message', message);
            
            const res = await fetch(`/chat/conversations/${currentConversationId}/send`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                body: formData
            });
            
            const data = await res.json();
            
            if (data.success) {
                messageInput.value = '';
                messageInput.style.height = 'auto'; // Reset height if multi-line
            } else {
                alert('Gagal mengirim pesan');
            }
            
        } catch (error) {
            console.error('Send error:', error);
            alert('Gagal mengirim pesan');
        } finally {
            // Re-enable input
            messageInput.disabled = false;
            sendBtn.disabled = false;
            messageInput.focus();
        }
    }

    function handleTyping() {
        clearTimeout(typingTimeout);
        
        // Send typing indicator (no await, fire and forget)
        sendTypingStatus(true);
        
        // Auto-stop after 2 seconds of no typing
        typingTimeout = setTimeout(() => {
            sendTypingStatus(false);
        }, 2000);
    }
    
    function sendTypingStatus(isTyping) {
        // Fire and forget (no await needed)
        fetch(`/chat/conversations/${currentConversationId}/typing`, {
            method: 'POST',
            headers: { 
                'X-CSRF-TOKEN': csrfToken, 
                'Content-Type': 'application/json' 
            },
            body: JSON.stringify({ is_typing: isTyping })
        }).catch(() => {}); // Ignore errors silently
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
        
        chatMessages.insertAdjacentHTML('beforeend', renderMessage(msg));
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