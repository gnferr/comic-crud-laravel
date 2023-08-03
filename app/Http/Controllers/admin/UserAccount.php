<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class UserAccount extends Controller
{
    public function index()
    {
        return view('admin.setting.index');
    }

    public function account($id)
    {
        $users = UsersModel::find($id);
        return view('admin.setting.account', compact('users'));
    }

    public function testing()
    {
        $users = UsersModel::all();
        dd($users);
        return view('admin.testing');
    }

    public function get()
    {
        $users = UsersModel::orderBy('id_level')->get();
        $result = array();
        $index = 0;
        // dd($users);
        foreach ($users as $val) {
            $image = url('images/' . $val['profile']);
            $index++;
            $row = array();
            $row['index'] = $index;
            $row['avatar'] = "<img src='{$image}' width='50px' height='50px' style='border:1px solid gray;border-radius:2px'> ";
            $row['name'] = $val['name'];
            $row['username'] = $val['username'];
            if ($val['id_level'] > 1) {
                if ($val['id_level'] != 2) {
                    $row['level'] = "<div class='badge badge-info m-1'><div>Guest</div></div>";
                } else {
                    $row['level'] = "<div class='badge badge-primary m-1'><div>Admin</div></div>";
                }
            } else {
                $row['level'] = "<div class='badge badge-warning text-dark m-1'><div>Super Admin</div></div>";
            }
            $row['created_at'] = date_format($val['created_at'], 'Y-m-d H:i:s');
            $btn = "<div>
            <a href='users/account-setting/{$val['id']}' class='btn btn-primary'><i class='fas fa-edit'></i></a>
            <a class='btn btn-danger'><i class='fas fa-trash'></i></a>
            </div>";
            $row['action'] = $btn;
            $result[] = (object)$row;
        }
        return json_encode([
            'data' => $result
        ]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'name' => 'required',
        ]);

        $random = Str::random(4) . "-" . Str::random(6);

        UsersModel::updateOrInsert(
            [
                'id' => $random
            ],
            [
                'name' => $request->name,
                'username' => $request->username,
                'password' => password_hash('guest12345', PASSWORD_BCRYPT),
                'id_level' => $request->level,
                'profile' => 'avatar-default.png'
            ]
        );
        return response()->json(['success' => 'User saved successfully.']);
    }

    public function update(Request $request)
    {
        //validate form
        $this->validate($request, [
            'profile'  => 'mimes:jpeg,jpg,png|max:2048',
            'name'     => 'required|min:3'
        ]);

        $id = $request->id;
        //get user by ID
        $user = UsersModel::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('profile')) {
            // Remove Old File
            if ($user->profile != 'avatar-default.png') {
                $oldfile = public_path('images/' . $user->profile);
                if (File::exists($oldfile)) {
                    unlink($oldfile);
                }
            }
            //upload new image
            $imageName = time() . '.' . $request->profile->extension();

            $request->profile->move(public_path('images'), $imageName);

            //update user with new image
            $user->update([
                'profile'  => $imageName,
                'name'     => $request->name,
            ]);
            return response()->json([
                'success' => 'User saved successfully.',
                'data' => $user
            ]);
        } else {
            //update user without image
            $user->update([
                'name'     => $request->name,
            ]);
            return response()->json([
                'success' => 'User saved successfully.'
            ]);
        }
    }
}
