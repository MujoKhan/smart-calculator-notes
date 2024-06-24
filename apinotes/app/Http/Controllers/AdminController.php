<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ApiAdmin;
use App\Models\CalculationController;
use App\Models\Permission;
use App\Models\Role;
use App\Models\NoteTitle;
use App\Models\SubNoteTitle;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
                'email' => 'required|email|exists:api_admins,email',
                'password' => ['required','min:6','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            ],[
                'email.exists'=>'Email not found',
                'password.regex'=>'Password must be 1 capital, 1 small and 1 digit',
            ]
        );

        if ($validator->fails()) 
        {
            return response()->json([
               'status' => 'error',
                'msg'    => 'Error',
                'errors' => $validator->errors(),
                ], 422);

        } 

        $user = ApiAdmin::where('email',$request->email)->first();
        
        if (!$user) 
        {
            $response = [
                'success' => false,
                'message' => 'admin not found.'
                ];
            return response($response, 400);
        }
        else if(!Hash::check($request->password, $user->password))
        {
            $response = [
                'success' => false,
                'message' => 'Password not match.'
                ];
            return response($response, 400);
        }
        
            $token = $user->createToken($request->email)->plainTextToken;
            $role = Role::where('userId',$user->id)->get();
                    $response = [
                        'success' => true,
                        'user' => $user,
                        'token' => $token,
                        'role' => $role,
                    ];
                
                    return response($response, 200);

       
    }

    public function allUser(Request $request)
    {
        $allUser = User::where('id', '<>',  $request->adminId )->get();
        $role = Role::where('userId', '<>',  $request->adminId )->get();
        $permission = Permission::all();

        $response = [
            'success' => true,
            'allUser' => $allUser,
            'role' => $role,
            'permission' => $permission
        ];
    
        return response($response, 200);

    }

    public function readPermission(Request $request)
    {
        $permission = Permission::where('userID',$request->userId)->update(['read' => $request->read]);
        $response = [
            'success' => true,
            'permissionUpdated' => $permission
        ];
    
        return response($response, 200);
    }
    public function writePermission(Request $request)
    {
        $permission = Permission::where('userID',$request->userId)->update(['write' => $request->write]);
        $response = [
            'success' => true,
            'permissionUpdated' => $permission
        ];
    
        return response($response, 200);
    }
    public function editPermission(Request $request)
    {
        $permission = Permission::where('userID',$request->userId)->update(['edit' => $request->edit]);
        $response = [
            'success' => true,
            'permissionUpdated' => $permission
        ];
    
        return response($response, 200);
    }

    public function deletePermission(Request $request)
    {
        $permission = Permission::where('userID',$request->userId)->update(['delete' => $request->delete]);
        $response = [
            'success' => true,
            'permissionUpdated' => $permission
        ];
    
        return response($response, 200);
    }

    public function addNewUser(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
                'name' => ['required','regex:/^[a-zA-Z ]+$/'],
                'email' => 'required|email|unique:users,email',
                'password' => ['required','min:6','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            ],[
                'name.regex'=>'Name should be only string',
                'email.unique'=>'Email already taken',
                'password.regex'=>'Password must be 1 capital, 1 small and 1 digit',
            ],
        );

        if ($validator->fails()) 
        {
                    return response()->json([
                    'status' => 'error',
                    'msg'    => 'Error',
                    'errors' => $validator->errors(),
                    ], 422);

        } 

        $user = User::where('email',$request->email)->get();
        if($user->count() > 1)
        {
            $response = [
                'success' => false,
                'user' => $user,
                'userExists' => $user->count()
            ];
        
            return response($response, 200);
        }
        else
        {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $userGet = User::where('email',$request->email)->first();

            $permission = new Permission;
            $permission->userID = $userGet->id;
            $permission->save();

            $role = new Role;
            $role->userId = $userGet->id;
            $role->save();

            $response = [
                'success' => true,
                'user' => $user,
                'userStore' => $user,
                'permission' => $permission,
                'role' => $role
            ];
        
            return response($response, 200);
        }
       
    }

    public function userdelete(Request $request)
    {
        $user = User::where('id',$request->userId)->delete();
        $response = [
            'success' => true,
            'delete' => $user,
            'user' => $user
        ];
    
        return response($response, 200);
    }

    public function userUpdate(Request $request)
    {
        if($request->password == "")
        {
            $validator = Validator::make(
                $request->all(), [
                    'name' => ['required','regex:/^[a-zA-Z ]+$/'],
                ],[
                    'name.regex'=>'Name should be only string',
                ],
            );
    
            if ($validator->fails()) 
            {
                        return response()->json([
                        'status' => 'error',
                        'msg'    => 'Error',
                        'errors' => $validator->errors(),
                        ], 422);
    
            } 
        }
        else
        {   
            $validator = Validator::make(
                $request->all(), [
                    'name' => ['required','regex:/^[a-zA-Z ]+$/'],
                    'password' => ['required','min:6','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
                ],[
                    'name.regex'=>'Name should be only string',
                    'password.regex'=>'Password must be 1 capital, 1 small and 1 digit',
                ],
            );
    
            if ($validator->fails()) 
            {
                        return response()->json([
                        'status' => 'error',
                        'msg'    => 'Error',
                        'errors' => $validator->errors(),
                        ], 422);
    
            } 
        }

        if($request->password == "")
        {
            $user = User::where('id',$request->id)
                        ->update([
                            'name'=>$request->name,
                        ]);
            $response = [
                 'success' => true,
                 'update' => $user,
                 'user' => $user
                ];
                    
            return response($response, 200);
        }
        else
        {
            $user = User::where('id',$request->id)
                        ->update([
                            'name'=>$request->name,
                            'password' => Hash::make($request->password)
                        ]);
           
            $response = [
                  'success' => true,
                   'update' => $user,
                   'user' => $user
                    ];
                               
            return response($response, 200);             
        }
    }
}
