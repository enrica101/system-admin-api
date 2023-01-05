<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Response;
use App\Models\Responder;
use App\Models\RequestsInfo;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chats = Chat::all();
        return response()->json($chats, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $requestInfo =RequestsInfo::find($id);
        $responder = Response::where('requestId', $requestInfo->id)->first();
        // dd($responder);
        if($responder){
            $fields = $request->validate([
                'message' => 'required',
                'fromRequestor' => 'required',
            ]);

            $chatMessage = Chat::create([
                'requestId' => $requestInfo->id,
                'userId' => $requestInfo->userId,
                'responderId' => $responder->responderId,
                'message' => $fields['message'],
                'fromRequestor' => $fields['fromRequestor']
            ]);

            return response()->json(['chat' => $chatMessage], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chat = Chat::find($id);
        return response()->json($chat->delete(), 200);
    }
}
