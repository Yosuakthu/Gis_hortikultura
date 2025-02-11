<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class UsrController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $users = User::all();
        return view('index',['titel' => 'Dashboard']);
    }
    public function peta()
    {
        return view('usrpeta',['titel' => 'Peta']);
    }

    public function pengguna(Request $request)
{
    if ($request->ajax()) {
        $data = User::with('level')->select('user.*')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('level_name', function($row) {
                return $row->level->level ?? 'N/A';
            })
            ->addColumn('action', function($row){
                $editBtn = '<a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-id="'.$row->id.'">Edit</a>';
                $deleteBtn = '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                return $deleteBtn . ' ' .$editBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('pengguna', ['titel' => 'Data Pengguna']);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tambah', ['titel' => 'Tambah Data Pengguna']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:user,email',
        'level_id' => 'required|integer',
        'password' => 'required|string|max:255',
    ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'level_id' => $request->level_id,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('pengguna')->with('success', 'User created successfully.');
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
        $user = User::find($id);
        if ($user) {
            return view('edit', compact('user'), ['titel' => 'Edit Pengguna']);
        } else {
            return redirect()->route('pengguna')->with('error', 'User not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
    if ($user) {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->level_id = $request->input('level_id');
        $user->save();

        return redirect()->route('pengguna')->with('success', 'User updated successfully.');
    } else {
        return redirect()->route('pengguna')->with('error', 'User not found.');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => 'User deleted successfully.']);
        } else {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        // $c = Auth::attempt($credentials);
        // dd($c);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->level_id == 1) {
                session::flash('user', $user);
                return redirect()->route('dashboard-admin');
            } else {
                // Logout pengguna dan redirect ke halaman login dengan pesan error
                Auth::logout();
                return redirect()->route('home')->with('error', 'You do not have access to the admin dashboard.');
            }
        }

        // Jika otentikasi gagal, redirect kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login atau beranda
        return redirect('/')->with('status', 'You have been logged out.');
    }
}
