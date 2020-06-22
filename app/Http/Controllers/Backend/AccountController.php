<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdatePasswordRequest;
use App\Http\Requests\Account\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller{

    public function index(){

    }

    public function edit(){

        $user = auth()->user();

        return view('backend.account.edit', compact('user'));
    }

    public function update(UpdateRequest $request){

        $user = auth()->user();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        $user->save();

        return redirect()->route('admin.account.edit')->withFlashSuccess('Account Updated Successfully!');
    }

    public function updatePassword(UpdatePasswordRequest $request){

        $user = auth()->user();


        if (Hash::check($request->password, $user->password)) {

            $user->password = $request->new_password;
            $user->save();
            return redirect()->route('admin.account.edit')->withFlashSuccess('Password changed!');

        }else{
            return redirect()->route('admin.account.edit')->withFlashWarning('Old password not match!');
        }


    }
}
