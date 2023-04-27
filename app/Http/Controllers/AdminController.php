<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $allRequests =  [];
        $allAvailableRequests =  [];
        $allOngoingRequests =  [];
        $allCompletedRequests =  [];
        $allCancelledRequests =  [];
        $allBogusRequests =  [];
        $allRespondersHandlingRequests = [];
        $allResponders =  [];
        $allHandlingResponders = $allRespondersHandlingRequests;
        $allAccounts =  [];
        $allRoleUsers = [];
        $allRoleResponders = [];
        $allRoleAdmin = [];

        if($request['end'] === 'null'){
            $allRequests = RequestsInfo::withTrashed()->where('updated_at', 'like', '%'.$request['start'].'%')->get();
            $allAvailableRequests = RequestsInfo::where('status', 'like', '%'.'Searching'.'%')->where('updated_at', 'like', '%'.$request['start'].'%')->get();
            $allOngoingRequests = Response::where('updated_at', 'like', '%'.$request['start'].'%')->get();
            $allCompletedRequests = RequestsInfo::onlyTrashed()->where('deleted_at', 'like', '%'.$request['start'].'%')->where('status', 'Completed')->get();
            $allCancelledRequests = RequestsInfo::onlyTrashed()->where('deleted_at', 'like', '%'.$request['start'].'%')->where('status', 'Cancelled')->get();
            $allBogusRequests = RequestsInfo::onlyTrashed()->where('deleted_at', 'like', '%'.$request['start'].'%')->where('status', 'Bogus')->get();
            $allRespondersHandlingRequests = Response::where('updated_at', 'like', '%'.$request['start'].'%')->orWhere('created_at', 'like', '%'.$request['start'].'%')->get();
            $allResponders = Responder::where('updated_at', 'like', '%'.$request['start'].'%')->orWhere('created_at', 'like', '%'.$request['start'].'%')->get();
            $allHandlingResponders = $allRespondersHandlingRequests;
            $allAccounts = User::where('updated_at', 'like', '%'.$request['start'].'%')->get();
            $allRoleUsers = User::where('updated_at', 'like', '%'.$request['start'].'%')->where('role', 'User')->get();
            $allRoleResponders = User::where('updated_at', 'like', '%'.$request['start'].'%')->where('role', 'Responder')->get();
            $allRoleAdmin = User::where('updated_at', 'like', '%'.$request['start'].'%')->where('role', 'Admin')->get();
        }else{
            $allRequests = RequestsInfo::withTrashed()->whereBetween('updated_at',[$request['start'].'%', $request['end'].'%'])->get();
            $allAvailableRequests = RequestsInfo::where('status', 'like', '%'.'Searching'.'%')->whereBetween('updated_at', [$request['start'].'%', $request['end'].'%'])->get();
            $allOngoingRequests = Response::whereBetween('updated_at', [$request['start'].'%', $request['end'].'%'])->get();
            $allCompletedRequests = RequestsInfo::onlyTrashed()->whereBetween('deleted_at', [$request['start'].'%', $request['end'].'%'])->where('status', 'Completed')->get();
            $allCancelledRequests = RequestsInfo::onlyTrashed()->whereBetween('deleted_at', [$request['start'].'%', $request['end'].'%'])->where('status', 'Cancelled')->get();
            $allBogusRequests = RequestsInfo::onlyTrashed()->whereBetween('deleted_at', [$request['start'].'%', $request['end'].'%'])->where('status', 'Bogus')->get();
            $allRespondersHandlingRequests = Response::whereBetween('updated_at',[$request['start'].'%', $request['end'].'%'])->get();
            $allResponders = Responder::whereBetween('updated_at', [$request['start'].'%', $request['end'].'%'])->get();
            $allHandlingResponders = $allRespondersHandlingRequests;
            $allAccounts = User::whereBetween('updated_at',[$request['start'].'%', $request['end'].'%'])->get();
            $allRoleUsers = User::whereBetween('updated_at',[$request['start'].'%', $request['end'].'%'])->where('role', 'User')->get();
            $allRoleResponders = User::whereBetween('updated_at',[$request['start'].'%', $request['end'].'%'])->where('role', 'Responder')->get();
            $allRoleAdmin = User::whereBetween('updated_at',[$request['start'].'%', $request['end'].'%'])->where('role', 'Admin')->get();
        }
            return response([
                'data' => [
                    'allRequests' => $allRequests->count(),
                    'allAvailableRequests' => $allAvailableRequests->count(),
                    'allOngoingRequests' => $allOngoingRequests->count(),
                    'allCompletedRequests' => $allCompletedRequests->count(),
                    'allCancelledRequests' => $allCancelledRequests->count(),
                    'allBogusRequests' => $allBogusRequests->count(),
                    'allIdleRequests' => ($allResponders->count()-$allHandlingResponders->count()),
                    'allResponders' => $allResponders->count(),
                    'allHandlingResponders' => $allHandlingResponders->count(),
                    'allAccounts' => $allAccounts->count(),
                    'allRoleUsers' => $allRoleUsers->count(),
                    'allRoleResponders' => $allRoleResponders->count(),
                    'allRoleAdmin' => $allRoleAdmin->count()
                ]
            ]);
    }


    public function getRoleUsers(){
        if(request('name')!=null){
            $users = User::withTrashed()->where('fname', 'like',  '%'.request('name').'%')->orWhere('id', 'like',  '%'.request('name').'%')->orderBy('created_at', 'desc')->get();
        }else{
            $users = User::withTrashed()->where('role', 'like',  '%'.'User'.'%')->orderBy('created_at', 'desc')->orderBy('deleted_at', 'desc')->get();
        }
        $usersInfo = [];
        $today = date("Y-m-d");
        $completed = 0;
        $cancelled = 0;
        $bogus = 0;
        for($i = 0; $i<count($users); $i++){
            $requestsFromArchive = RequestsInfo::onlyTrashed()->where('userId', $users[$i]['id'])->get();
            if(!empty($requestsFromArchive)){
                for($j=0;$j<count($requestsFromArchive);$j++){
                    if($requestsFromArchive[$j]->status === 'Cancelled'){
                        $cancelled++;
                    }else if($requestsFromArchive[$j]->status === 'Completed'){
                        $completed++;
                    }else{
                        $bogus++;
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
                'bogusRequests' => $bogus,
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
        $to_name = auth()->user()->fname;
        $to_email = $request['email'];
        $data = array('name'=>$to_name, "body"=> "Test Mail");
       Mail::send('emails.mail', $data, function($message) use ($to_email, $to_name){
        $message->to($to_email, $to_name)->subject('Requested PDF File');
        $message->from('91watch@uylcph.org', '91Watch Support Team');
       });
       return redirect()->back()->with('success', 'Email Sent!');
    }
}
