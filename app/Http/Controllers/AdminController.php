<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Response;
use App\Models\Responder;
use App\Models\RequestsInfo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;

class AdminController extends Controller
{
    public function getData(){
        $allRequests = count(RequestsInfo::all());
        $allAvailableRequests = count(RequestsInfo::where('status', 'like', '%'.'Searching'.'%')->get());
        $allOngoingRequests = count(Response::all());
        $allCompletedRequests = count(RequestsInfo::onlyTrashed()->where('status', 'Completed')->get());
        $allCancelledRequests = count(RequestsInfo::onlyTrashed()->where('status', 'Cancelled')->get());

        $allRespondersHandlingRequests = Response::all();
        // $allIdleResponders = count();
        $allResponders = count(Responder::all());
        $allHandlingResponders = count($allRespondersHandlingRequests);
        $allAccounts = count(User::all());
        $allRoleUsers = count(User::where('role', 'User')->get());
        $allRoleResponders = count(User::where('role', 'Responder')->get());
        $allRoleAdmin = count(User::where('role', 'Admin')->get());
        // dd($allRoleAdmin);

        return view('dashboard', [
            'data' => [
                'allRequests' => $allRequests,
                'allAvailableRequests' => $allAvailableRequests,
                'allOngoingRequests' => $allOngoingRequests,
                'allCompletedRequests' => $allCompletedRequests,
                'allCancelledRequests' => $allCancelledRequests,
                // 'allIdleRequests' => $allIdleResponders,
                'allResponders' => $allResponders,
                'allHandlingResponders' => $allHandlingResponders,
                'allAccounts' => $allAccounts,
                'allRoleUsers' => $allRoleUsers,
                'allRoleResponders' => $allRoleResponders,
                'allRoleAdmin' => $allRoleAdmin
            ]
            
        ]);
    }

    public function getRoleUsers(){
        $users = User::where('role', 'like',  '%'.'User'.'%')->get();
        $usersInfo = [];
        $today = date("Y-m-d");
        
        // dd($users);
        for($i = 0; $i<count($users); $i++){
            $requestsFromArchive = RequestsInfo::onlyTrashed()->where('userID', $users[$i]['id'])->get();

            $completed = 0;
            $cancelled = 0;

            if(!empty($requestsFromArchive)){
                for($j=0;$j<count($requestsFromArchive);$j++){
                    if($requestsFromArchive[$j]->status == 'Cancelled'){
                        $cancelled++;
                    }else if($requestsFromArchive[$j]->status == 'Completed'){
                        $completed++;
                    }
                    
                }
            }

            $ongoingRequest = RequestsInfo::where('userId', $users[$i]['id'])->get();
            if($ongoingRequest->isNotEmpty()){
                $ongoing = 1;
            }else{
                $ongoing = 0;
            }
            
            $diff = date_diff(date_create($users[$i]['birthdate']), date_create($today));
            $age = $diff->format('%y');

            $createDate = date("Y-m-d H:i:s",strtotime($users[$i]['created_at']));
            // dd($users[$i]['fname']);
            array_push($usersInfo, [
                'id' => $users[$i]['id'],
                'accountType' => $users[$i]['role'],
                'email' => $users[$i]['email'],
                'fname' => $users[$i]['fname'],
                'mname' => $users[$i]['mname'],
                'lname' => $users[$i]['lname'],
                'gender' => $users[$i]['gender'],
                'birthdate' => $users[$i]['birthdate'],
                'age' => $age,
                'contactNumber' => $users[$i]['contactNumber'],
                'created_at' => $createDate,
                'completedRequests' => $completed,
                'cancelledRequests' => $cancelled,
                'ongoingRequest' => $ongoing,
                'joined' => $users[$i]['created_at'],
            ]);
        }
        return view('accounts',[
            'users' => $usersInfo
        ]);
    }


    public function create(){
        return view('register');
    }

    public function store(Request $request, ){
        $formInputs = $request->validate([ 
            'role' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
            'fname' => ['required', 'min:3'],
            'mname' => ['nullable', 'min:3'],
            'lname' => ['required', 'min:3'],
            'gender' => ['required'],
            'birthdate' => ['required'],
            'contactNumber' => ['nullable', 'regex:/^(09|\+639)\d{9}$/', 'max:13',  Rule::unique('users', 'contactNumber')],
            // 'avatar'  => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $formInputs['password'] = bcrypt($formInputs['password']);
        
        // if($request->hasFile('avatar')){
        //     $formInputs['avatar'] = $request->file('avatar')->store('avatars', 'public');
        // }

        $user = User::create($formInputs);
        auth()->login($user); 

        return redirect('/dashboard');
    }

    public function authenticate(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])){
            $request->session()->regenerate();
            return redirect('/dashboard');
        }
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
