<?php
// routes/channels.php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Conversation;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Channel authorization untuk conversation
Broadcast::channel('conversation.{conversationId}', function ($user, $conversationId) {
    $conversation = Conversation::find($conversationId);
    
    if (!$conversation) {
        return false;
    }
    
    // Only client or freelancer dari conversation ini yang boleh join
    return $user->id === $conversation->client_id 
        || $user->id === $conversation->freelancer_id;
});