<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index(){
        $totalAdminsCount = User::where('role', 'admin')->count();  // count the total number of the admins in the users table
        $totalWritersCount = User::where('role', 'writer')->count();    // count the total number of the writers in the users table
        return view('dashboard.users.index', [
            'users' => User::all(),
            'totalAdminsCount' => $totalAdminsCount,
            'totalWritersCount' => $totalWritersCount
        ]);
    }

    // #### this function to change the role of the user from writer to admin
    public function makeAdmin(User $user){     // #### the class object name must be the same name in the route
        $user->role = "admin";
        $user->save();
        // return success message in the index page
        session()->flash('success','This person has been updated to be an admin successfully');
        return redirect(route('users.index'));
    }

    // #### this function to change the role of the user from admin to writer
    public function makeWriter(User $user){      // #### the class object name must be the same name in the route
        $user->role = "writer";
        $user->save();
        // return success message in the index page
        session()->flash('success','This person has been updated to be a Writer successfully');
        return redirect(route('users.index'));
    }

    public function edit(User $user){
        $profile = $user->profile;        // #### profile here is a magic method of the 1 to 1 relation which defined in the User model
        return view('dashboard.users.profile',[
            'user' => $user,
            'profile' => $profile
        ]);
    }

    public function update(User $user, Request $request){
        $profile = $user->profile;
        $data = $request->all();

        if($request->hasFile('avatar')){
            $avatar = $request->avatar->store('profiles_pictures', 'public');

            // #### this to delete the image from the storage folder
            Storage::disk('public')->delete($profile->avatar);
            $data['avatar'] = $avatar;
        }

        // #### update the data of profile
        $profile->update($data);

        // #### this update for the data of the user in the profile page which may be updated into user table
        $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
        // return success message in the index page
        session()->flash('success','The profile has been updated successfully');
        return redirect(route('users.profileEdit', $user->id));
    }
}
