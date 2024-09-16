<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function register(Request $request) {
        // Show progress bar
        sleep(1);
        // Validate values from input
        $fields = $request->validate([
            'cliente_nombre' => ['required', 'max:255'],
            'cliente_correo' => ['required', 'max:255']
        ]);

        // Register new client
        $client = Client::create($fields);

        // Redirect
        return redirect()->route('home');
    }
}
