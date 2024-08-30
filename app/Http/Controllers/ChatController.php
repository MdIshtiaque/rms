<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ChatController extends Controller
{
  public function sendMessage(Request $request)
  {
    $message = $request->input('message');

    try {
      $result = OpenAI::completions()->create([
        'model' => 'text-davinci-002',
        'prompt' => $message,
        'max_tokens' => 100,
      ]);

      $reply = trim($result['choices'][0]['text']);
      return back()->with('message', $reply);
    } catch (\Exception $e) {
      // Log the error
      \Log::error('OpenAI API error: ' . $e->getMessage());
      return back()->with('error', "I'm sorry, I'm having trouble processing your request right now.");
    }
  }
}
