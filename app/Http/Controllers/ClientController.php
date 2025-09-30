<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
  // List all clients
  public function index(Request $request)
  {
    $perPage = $request->get('per_page', 20);
    $clients = Client::orderBy('created_at', 'desc')->paginate($perPage);

    return response()->json($clients);
  }


  // Create a new client
  public function store(Request $request)
  {
    $validated = $request->validate([
      'name'   => 'required|string|max:255',
      'email'  => 'required|email|unique:clients,email',
      'status' => 'nullable|string|max:50'
    ]);
    $client = Client::create($validated);
    return response()->json($client, 201);
  }

  // Show one client
  public function show($id)
  {
    return response()->json(Client::findOrFail($id));
  }

  // Update a client
  public function update(Request $request, $id)
  {
    $client = Client::findOrFail($id);
    $validated = $request->validate([
      'name'   => 'sometimes|string|max:255',
      'email'  => 'sometimes|email|unique:clients,email,' . $id,
      'status' => 'nullable|string|max:50'
    ]);
    $client->update($validated);
    return response()->json($client);
  }

  // Delete a client
  public function destroy($id)
  {
    $client = Client::findOrFail($id);
    $client->delete();
    return response()->json(['success' => true]);
  }
}
