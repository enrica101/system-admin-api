<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\MailPDF;
use App\Models\Response;
use App\Models\Responder;
use App\Models\RequestsInfo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class AdminController extends Controller
{

    public function getDataByDate(Request $request){
        if($request['end'] === 'null'){
            $allRequests = count(RequestsInfo::where('created_at', 'like', '%'.$request['start'].'%')->get());
            $allAvailableRequests = count(RequestsInfo::withTrashed()->where('created_at', 'like', '%'.$request['start'].'%')->where('status', 'like', '%'.'Searching'.'%')->get());
            $allOngoingRequests = count(Response::where('created_at', 'like', '%'.$request['start'].'%')->get());
            $allCompletedRequests = count(RequestsInfo::onlyTrashed()->where('updated_at', 'like', '%'.$request['start'].'%')->where('status', 'Completed')->get());
            $allCancelledRequests = count(RequestsInfo::onlyTrashed()->where('updated_at', 'like', '%'.$request['start'].'%')->where('status', 'Cancelled')->get());
            $allRespondersHandlingRequests = Response::where('created_at', 'like', '%'.$request['start'].'%')->get();
            $allIdleResponders = $allRequests;
            $allResponders = count(Responder::where('created_at', 'like', '%'.$request['start'].'%')->get());
            $allHandlingResponders = count($allRespondersHandlingRequests);
            $allAccounts = count(User::where('created_at', 'like', '%'.$request['start'].'%')->get());
            $allRoleUsers = count(User::where('created_at', 'like', '%'.$request['start'].'%')->where('role', 'User')->get());
            $allRoleResponders = count(User::where('created_at', 'like', '%'.$request['start'].'%')->where('role', 'Responder')->get());
            $allRoleAdmin = count(User::where('created_at', 'like', '%'.$request['start'].'%')->where('role', 'Admin')->get());

            return response([
                'data' => [
                    'allRequests' => $allRequests,
                    'allAvailableRequests' => $allAvailableRequests,
                    'allOngoingRequests' => $allOngoingRequests,
                    'allCompletedRequests' => $allCompletedRequests,
                    'allCancelledRequests' => $allCancelledRequests,
                    'allIdleRequests' => $allIdleResponders,
                    'allResponders' => $allResponders,
                    'allHandlingResponders' => $allHandlingResponders,
                    'allAccounts' => $allAccounts,
                    'allRoleUsers' => $allRoleUsers,
                    'allRoleResponders' => $allRoleResponders,
                    'allRoleAdmin' => $allRoleAdmin
                ]
            ]);
        }else{
            $allRequests = count(RequestsInfo::withTrashed()->whereBetween('created_at', [$request['start'],$request['end']])->get());
            $allAvailableRequests = count(RequestsInfo::whereBetween('created_at', [$request['start'],$request['end']])->where('status', 'like', '%'.'Searching'.'%')->get());
            $allOngoingRequests = count(Response::whereBetween('created_at', [$request['start'],$request['end']])->get());
            $allCompletedRequests = count(RequestsInfo::onlyTrashed()->whereBetween('updated_at', [$request['start'],$request['end']])->where('status', 'Completed')->get());
            $allCancelledRequests = count(RequestsInfo::onlyTrashed()->whereBetween('created_at', [$request['start'],$request['end']])->where('status', 'Cancelled')->get());
            $allIdleResponders = $allRequests;
            $allRespondersHandlingRequests = Response::whereBetween('created_at', [$request['start'],$request['end']])->get();
            $allResponders = count(Responder::whereBetween('created_at', [$request['start'],$request['end']])->get());
            $allHandlingResponders = count($allRespondersHandlingRequests);
            $allAccounts = count(User::whereBetween('created_at', [$request['start'],$request['end']])->get());
            $allRoleUsers = count(User::whereBetween('created_at', [$request['start'],$request['end']])->where('role', 'User')->get());
            $allRoleResponders = count(User::whereBetween('created_at', [$request['start'],$request['end']])->where('role', 'Responder')->get());
            $allRoleAdmin = count(User::whereBetween('created_at', [$request['start'],$request['end']])->where('role', 'Admin')->get());

            return response([
                'data' => [
                    'allRequests' => $allRequests,
                    'allAvailableRequests' => $allAvailableRequests,
                    'allOngoingRequests' => $allOngoingRequests,
                    'allCompletedRequests' => $allCompletedRequests,
                    'allCancelledRequests' => $allCancelledRequests,
                    'allIdleRequests' => $allIdleResponders,
                    'allResponders' => $allResponders,
                    'allHandlingResponders' => $allHandlingResponders,
                    'allAccounts' => $allAccounts,
                    'allRoleUsers' => $allRoleUsers,
                    'allRoleResponders' => $allRoleResponders,
                    'allRoleAdmin' => $allRoleAdmin
                ]
            ]);
        }
        
    }

    public function getGraphData(){
        //Takes all data from Requests DB
        $allRequests = count(RequestsInfo::all());

        //Takes all requests that are of status Searching
        $allAvailableRequests = count(RequestsInfo::where('status', 'like', '%'.'Searching'.'%')->get());

        //Takes all responses from DB
        $allOngoingRequests = count(Response::all());

        // Takes all requests that are completed
        $allCompletedRequests = count(RequestsInfo::onlyTrashed()->where('status', 'Completed')->get());

        // take all requests that were cancelled
        $allCancelledRequests = count(RequestsInfo::onlyTrashed()->where('status', 'Cancelled')->get());

        // Take all responses from DB regardless of status
        $allRespondersHandlingRequests = Response::all();
        $allIdleResponders = 0;
        $allResponders = count(Responder::all());
        $allHandlingResponders = count($allRespondersHandlingRequests);
        $allAccounts = count(User::all());
        $allRoleUsers = count(User::where('role', 'User')->get());
        $allRoleResponders = count(User::where('role', 'Responder')->get());
        $allRoleAdmin = count(User::where('role', 'Admin')->get());

        return response([
            'data' => [
                'allRequests' => $allRequests,
                'allAvailableRequests' => $allAvailableRequests,
                'allOngoingRequests' => $allOngoingRequests,
                'allCompletedRequests' => $allCompletedRequests,
                'allCancelledRequests' => $allCancelledRequests,
                'allIdleRequests' => $allIdleResponders,
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
        if(request('name')!=null){
            $users = User::where('fname', 'like',  '%'.request('name').'%')->get();
        }else{
            $users = User::where('role', 'like',  '%'.'User'.'%')->get();
        }
        $usersInfo = [];
        $today = date("Y-m-d");
        
        for($i = 0; $i<count($users); $i++){
            $requestsFromArchive = RequestsInfo::onlyTrashed()->where('userId', $users[$i]['id'])->get();

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

    public function store(Request $request){
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
        ]);

        $formInputs['password'] = bcrypt($formInputs['password']);
        

        $user = User::create($formInputs);

        auth()->login($user); 

        return redirect('/dashboard');
    }

    public function authenticate(Request $request){
        $user = User::where('email', $request->email)->first();
        if($user == null){
            return back()->withErrors(['email' => 'Does not exist.'])->onlyInput('email');
        }else if($user->role != 'Admin' && $user->role != 'admin'){
            return back()->withErrors(['email' => 'Only Admins are allowed to login.'])->onlyInput('email');
        }
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

    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function update(Request $request){
        $fields = $request->validate([
            'email' => ['nullable', 'email'],
            'password' => ['nullable', 'min:6'],
            'fname' => ['nullable', 'min:3'],
            'mname' => ['nullable', 'min:3'],
            'lname' => ['nullable', 'min:3'],
            'contactNumber' => ['nullable', 'regex:/^(09|\+639)\d{9}$/', 'max:13'],
        ]);

        $user = User::find(auth()->id());
        if($user->update($fields)){
            return back()->with('message', 'Successfully Updated');
        }else{
            return back()->with('message', 'Something went wrong.');
        }
    }

    public function exportPDF(){
        $allRequests = RequestsInfo::withTrashed()->get();
        $collection = [];

        foreach($allRequests as $singleRequest){
            $user = User::where('id', $singleRequest->userId)->first();
            $responseInfo = Response::where('requestId', $singleRequest->id)->first();
            $createDate = date("Y-m-d",strtotime($singleRequest->created_at));

            if($responseInfo == null){
                array_push($collection, [
                    'requestId' => $singleRequest->id,
                    'userId' => $singleRequest->userId,
                    'requester' => $user->fname.' '.$user->lname,
                    'responderId' => 'None',
                    'responder' =>  'None',
                    'type' => $singleRequest->type,
                    'location' => $singleRequest->location,
                    'status' => $singleRequest->status,
                    'created_at' => $createDate
                ]);
            }else{
                $responder = Responder::where('id', $responseInfo->responderId)->first();
                $responderDetails = User::find($responder->userId);
                array_push($collection, [
                    'requestId' => $singleRequest->id,
                    'userId' => $singleRequest->userId,
                    'requester' => $user->fname.' '.$user->lname,
                    'responderId' => $responder->id,
                    'responder' =>  $responderDetails->fname.' '.$responderDetails->lname,
                    'type' => $singleRequest->type,
                    'location' => $singleRequest->location,
                    'status' => $singleRequest->status,
                    'created_at' => $createDate
                ]);
            }
        }
        
        $pdf = PDF::loadView('export', [
            'requests' => $collection
        ])->setPaper('a4', 'landscape');
        return $pdf->download('91Watch-data.pdf');

    }

    public function sendEmail(Request $request){
    
        Mail::to($request->email)->send(new MailPDF());

        return redirect()->back()->with('success', 'Email Sent!');
    }
}
