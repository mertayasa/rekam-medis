<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index($page = null)
    {
        $page = $page == null ?  'index' : $page;
        $data = [
            'profile' => Auth::user()
        ];

        return view('profile.'.$page, $data);
    }
    
    public function edit()
    {
        $data = [
            'profile' => Auth::user()
        ];

        return view('profile.edit', $data);
    }

    public function update(UserRequest $request)
    {
        try{
            $user = Auth::user();
            $user->update($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengubah biodata');
        }

        return redirect()->route('profile.index')->with('success', 'Berhasil mengubah biodata');
    }
    
    public function editPassword()
    {
        $data = [
            'profile' => Auth::user()
        ];

        return view('profile.edit_password', $data);
    }

    public function updatePassword(PasswordRequest $request)
    {
        try{
            $user = Auth::user();
            $data = $request->validated();

            // dd($data);
            if(!Hash::check($data['old_password'], $user->password)){
                return redirect()->back()->withInput()->with('error', 'Password lama tidak sesuai');
            }


            $user->update([
                'password' => bcrypt($data['password'])
            ]);

        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengubah password');
        }

        return redirect()->route('profile.index')->with('success', 'Berhasil mengubah password');
    }
}
