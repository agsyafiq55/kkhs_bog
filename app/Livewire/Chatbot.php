<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Chatbot extends Component
{
    public $message = '';
    public $messages = [];

    public function mount()
    {
        $this->messages = [];
    }

    public function sendMessage()
    {
        if (trim($this->message) === '') return;

        $userMessage = $this->message;
        $this->messages[] = ['from' => 'user', 'text' => $userMessage];
        $this->message = '';

        // Call Flask backend
        try {
            $response = Http::post('http://localhost:5000/chatbot', [
                'message' => $userMessage
            ]);

            if ($response->successful()) {
                $botReply = $response->json()['response'] ?? 'Sorry, I didn\'t understand that.';
            } else {
                $botReply = 'Sorry, the bot is unavailable.';
            }
        } catch (\Exception $e) {
            $botReply = 'Error connecting to chatbot.';
        }

        $this->messages[] = ['from' => 'bot', 'text' => $botReply];
    }

    public function render()
    {
        return view('livewire.chatbot');
    }
}

