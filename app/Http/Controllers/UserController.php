<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Methode 1 om beveiliging te krijgen voor backend (met constructor)
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::with('roles')->orderBy('id', 'desc')->paginate(10);
        $roles = Role::all();
        return view('backend.users.index', compact("users", "roles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::pluck('name', 'id')->all();
        return view('backend.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $messages = [
            'name.required' => 'De naam is verplicht.',
            'email.required' => 'Het e-mailadres is verplicht.',
            'email.email' => 'Voer een geldig e-mailadres in.',
            'email.unique' => 'Dit e-mailadres is al in gebruik.',
            'password.required' => 'Het wachtwoord is verplicht.',
            'password.min' => 'Het wachtwoord moet minimaal :min tekens bevatten.',
            'role_id.required' => 'Selecteer minimaal een rol voor de gebruiker.',
            'role_id.*.exists' => '1 van de geselecteerde rollen bestaat niet.',
            'role_id.array' => 'De rollen moeten een lijst van ID\'s zijn.',
            'is_active.required' => 'Selecteer of de gebruiker actief is.',
            'photo_id.image' => 'De geüploade afbeelding moet een geldig afbeeldingsbestand zijn.',
        ];

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|array|exists:roles,id',
            'is_active' => 'required|in:0,1',
            'password' => 'required|min:6',
            /*'photo_id' => 'nullable|image'*/
        ], $messages);

        /*passwoord hashen*/
        $validatedData['password'] = bcrypt($validatedData['password']);

        /*Gebruikers aanmaken*/
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'is_active' => $validatedData['is_active'],
            'password' => $validatedData['password'],
        ]);
        //sync doet detach en daarna een attach in 1 keer
        $user->roles()->sync($validatedData['role_id']);

        /*redirect naar users*/
        return redirect()->route('users.index')->with('message', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //weergave van 1 enkele user met de waarden opgehaald uit de db
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //is het overschrijven van de gewijzigde waarden uit de function edit
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete van een user
    }
}
