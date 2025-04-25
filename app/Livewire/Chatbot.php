<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Chatbot extends Component
{
    public $message = '';
    public $messages = [];
    public $isCollapsed = true;
    public $isLoading = false;

    public function mount()
    {
        $this->messages = [];
    }

    public function toggleCollapse()
    {
        $this->isCollapsed = !$this->isCollapsed;
    }

    public function sendMessage()
    {
        if (trim($this->message) === '')
            return;

        $userMessage = $this->message;
        $this->messages[] = ['from' => 'user', 'text' => $userMessage];

        // Clear message field immediately - fixing the issue
        $this->reset('message');

        // Set loading state to true
        $this->isLoading = true;

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

        // Set loading state back to false
        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.chatbot');
    }
}