<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CalculationController;
use App\Models\Permission;
use App\Models\Role;
use App\Models\NoteTitle;
use App\Models\SubNoteTitle;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
// use Illuminate\Validation;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        
        $validator = Validator::make(
            $request->all(), [
                'name' => ['required','regex:/^[a-zA-Z ]+$/'],
                'email' => 'required|email|unique:users,email',
                'password' => ['required','min:6','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            ],[
                'name' => 'Name should be only string',
                'email.unique'=>'Email alredy there',
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

        // $user = User::where('email',$request->email)->get();
        $user = User::where('email',$request->email)->get();
        if($user->count() == 0)
        {
            
            $userReg = new User;
            // $userReg->name = Crypt::encryptString($request->name);
            $userReg->name = $request->name;
            // $userReg->email = Crypt::encryptString($request->email);
            $userReg->email = $request->email;
            $userReg->password = Hash::make($request->password);
            $userReg->save();

            // get register user id
            $userGet = User::where('email',$request->email)->get();
            foreach($userGet as $item)
            {
                $permission = new Permission;
                $role = new Role;
                $permission->userID = $item->id;
                $permission->save(); 

                $role->userId = $item->id;
                $role->save();
            }

            $response = [
                'success' => true,
                'user' => $userReg,
                // 'mainUser' => $mainUser
            ];
    
            return response()->json($response, 200);
        }
        else
        {
            $response = [
                'success' => false,
                'user' => $user,
            ];
    
            return response()->json($response, 200);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
                'email' => 'required|email|exists:users,email',
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

        $user = User::where('email',$request->email)->first();
        
        if (!$user) 
        {
            $response = [
                'success' => false,
                'message' => 'User not found.'
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
            $permission = Permission::where('userID',$user->id)->get();
                    $response = [
                        'success' => true,
                        'user' => $user,
                        'token' => $token,
                        'permission' => $permission,
                    ];
                
                    return response($response, 200);

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        $response = [
            'success' => true,
            'token' => 'deleted',
            'user' => $request->userToken,
        ];

        return response()->json($response, 200);

    }

    public function store(Request $request)
    {
        $calculation = new CalculationController;
        $calculation['userID'] = $request->userId;
        $calculation['first'] = $request->first;
        $calculation['second'] = $request->second;
        $calculation['add'] = $request->add;
        $calculation['sub'] = $request->sub;
        $calculation['multi'] = $request->multi;
        $calculation['div'] = $request->div;
        $calculation['percenatge'] = $request->percenatge;
        $calculation['percenatgeIntoDigit'] = $request->percenatgeIntoDigit;
        $calculation->save();

        $calcu = CalculationController::where('userID',$request->userId)->get();

        $response = [
            'success' => true,
            'calculation' => $calcu,
        ];

        return response()->json($response, 200);
    }

    public function fetch(Request $request)
    {
        $calcu = CalculationController::where('userID',$request->userId)->get();
        $response = [
            'success' => true,
            'calculation' => $calcu,
        ];

        return response()->json($response, 200);
    }

    public function delete(Request $request)
    {
        $calcu = CalculationController::where('userID',$request->userId)->where('id',$request->calId)->delete();
        $response = [
            'success' => true,
            'delete' => $calcu,
        ];

        return response()->json($response, 200);
    }

    public function permission(Request $request)
    {
        $permission = Permission::where('userID',$request->userId)->get();
        $response = [
            'success' => true,
            'permission' => $permission,
        ];

        return response()->json($response, 200);
    }

    public function title(Request $request)
    {
        $noteTitle = new NoteTitle;
        $noteTitle->title = $request->title;
        $noteTitle->userId = $request->userId;
        $noteTitle->save();

        $title = NoteTitle::where('userId',$request->userId)->get();

        $response = [
            'success' => true,
            'title' => $noteTitle,
        ];

        return response()->json($response, 200);
    }

    public function fetchTitle(Request $request)
    {
        $title = NoteTitle::where('userId',$request->userId)->get();

        $response = [
            'success' => true,
            'title' => $title,
        ];

        return response()->json($response, 200);
    }

    public function deleteTitle(Request $request)
    {
        $title = NoteTitle::where('userId',$request->userId)->where('id',$request->titleId)->delete();

        $response = [
            'success' => true,
            'delete' => $title,
            'title' => $title,
        ];

        return response()->json($response, 200);
    }

    public function fetchNotes(Request $request)
    {
      
        $title = NoteTitle::where('userId',$request->userId)->where('id',$request->titleId)->get();
        $subTitle = SubNoteTitle::where('noteTitleId',$request->titleId)->get();
       
        
        $response = [
            'success' => true,
            'title' => $title,
            'subTitle' => $subTitle
        ];

        return response()->json($response, 200);
    }

    public function noteSave(Request $request)
    {
        $subTitle = new SubNoteTitle;
        $subTitle->noteTitleId = $request->titleId;
        $subTitle->subTitle = $request->subTitle;
        $subTitle->text = $request->uidEmail;
        $subTitle->password = $request->password;
        // $subTitle->subTitle = Crypt::encryptString($request->subTitle);
        // $subTitle->text = Crypt::encryptString($request->uidEmail);
        // $subTitle->password = Crypt::encryptString($request->password);
        $subTitle->save();

        $response = [
            'success' => true,
            'subTitle' => $subTitle
        ];

        return response()->json($response, 200);
    }

    public function noteDelete(Request $request)
    {
        $subTitle = SubNoteTitle::where('id',$request->noteId)->delete();

        $response = [
            'success' => true,
            'delete' => $subTitle,
            'subTitle' => $subTitle
        ];

        return response()->json($response, 200);
    }

    public function noteUpdate(Request $request)
    {
        $subTitle = SubNoteTitle::where('id',$request->noteId)
                                ->update([
                                        'subTitle' => $request->subTitle,
                                        'text' => $request->uidEmail,
                                        'password' => $request->password,
                                    ]);

        $response = [
            'success' => true,
            'update' => $subTitle,
            'subTitle' => $subTitle
        ];

        return response()->json($response, 200);
    }



}
