<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index (){
        $users=User::latest();
        $search=request()->search;
        if(request()->search){
            $users=$users->where("name","LIKE","%".request()->search."%")->orWhere('email','like','%'.request()->search.'%');
        }
        $users=$users->paginate(request()->per_page ?? 10) ;
        $user=new User();
        return view('user.index',compact('users','user'));
    }

    public function store(Request $request){
        $data=$request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required|confirmed',
        ]);

        $data['password']=Hash::make($request->password);
        User::create($data);

        return redirect()->back()->with('success',"New user have been created.");
    }

    public function edit (User $user){
        $users=User::latest()->paginate(request()->per_page ?? 10);
        return view('user.index',compact('users','user'));
    }

    public function update(Request $request,User $user){
        $data=$request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$user->id,
        ]);

        if($request->password){
            $data['password']=Hash::make($request->password);
        }

        $user->update($data);

        if($request->redirect){
            return redirect()->route('setting.index')->with('success',"Selected user info have been created.");
        }
        return redirect()->route('user.index')->with('success',"Selected user info have been created.");
    }

    public function delete(User $user){
        $user->delete();

        return redirect()->back()->with('success',"Selected user have been removed.");
    }

    public function show(User $user){
      return view('user.show',compact('user'));
    }

    public function changePassword(Request $request,User $user){
        $validated = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if (!Hash::check($validated['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The provided password does not match our records.'],
            ]);
        }
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        if($request->redirect){
            return redirect()->route('setting.index')->with('success',"Selected user info have been created.");
        }
        return redirect()->back()->with('success', 'Password changed successfully.');
    }

    public function syncPermissions(User $user, Request $request){
        $user->syncPermissions([]);
        if ($request->permissions) {

            foreach ($request->permissions as $permission) {
                $user->givePermissionTo($permission);
            }
        }
        // return $user->permissions;
        return redirect()->back()->with('success',"Permission changed.");
    }
}
