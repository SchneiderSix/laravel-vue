<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function register(Request $request) {
        // Show progress bar
        sleep(1);
        // Validate values from input
        $fields = $request->validate([
            'cliente_id' => ['required', 'exists:cliente,cliente_id'],
            'user_id' => ['required', 'exists:users,id'],
            'llamada_telefono' => ['required', 'max:255'],
            'llamada_fecha' => ['required', 'date'],
            'llamada_observacion' => ['required', 'max:65535']
        ]);

        // Register new call
        $call = Call::create($fields);

        // Redirect
        return redirect()->route('home');
    }

}
