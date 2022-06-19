<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('manage-user')) {
            abort(403);
        }

        if(request('search')){
            $user = User::where('id', 'like', '%'. request('search') . '%')
                ->orWhere('username', 'like', '%'. request('search') . '%')
                ->orWhere('nama', 'like', '%'. request('search') . '%')
                ->orWhere('jabatan', 'like', '%'. request('search') . '%')
                ->orWhere('roles', 'like', '%'. request('search') . '%')
                ->paginate(15);
            
            return view('users.index', [
                'user' => $user
            ]);
        }

        $user = User::paginate(15);

        return view('users.index', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'item' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();

        Validator([
            'noHp' => [
                'required',
                Rule::unique('users')->ignore($user->noHp, 'noHp'),
            ],
        ]);

        if($request->file('profile_photo_path')){
            $data['profile_photo_path'] = $request->file('profile_photo_path')->store('assets/user', 'public');
        }

        /*For Reset Password */
        if($data['password'] != null){
            $data['password'] = Hash::make($data['password']);
        }else{
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
