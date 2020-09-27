<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\General;

class NotificationController extends Controller
{
    /**
     * Create new class instance
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json($request->user()->notifications,200);
    }

    /**
     * Store a newly created notification in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->notify(new General($request->message));
        return response(null,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        if ($notification = $request->user()->notifications()->firstWhere('id',$id)) {
            return response()->json($notification->data,200);
        } else {
            return response()->json(['error' => "Notification not found"],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($notification = $request->user()->notifications()->firstWhere('id',$id)) {
            $notification->data = json_encode(['message' => $request->message]);
            $notification->save();
            return response()->json($notification->data,200);
        } else {
            return response()->json(['error' => "Notification not found"],404);
        }
    }

    /**
     * Remove the specified notification from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($notification = $request->user()->notifications()->firstWhere('id',$id)) {
            $notification->delete();
            return response(null,204);
        } else {
            return response()->json(['error' => "Notification not found"],404);
        }
    }
    
    /**
     * Mark specified notification as read in the database.
     * 
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function read(Request $request, $id)
    {
        if ($notification = $request->user()->notifications()->firstWhere('id',$id)) {
            $notification->markAsRead();
            return response(null,204);
        } else {
            return response()->json(['error' => "Notification not found"],404);
        }
    }
    
    /**
     * Mark specified notification as unread in the database.
     *
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function unread(Request $request, $id)
    {
        if ($notification = $request->user()->notifications()->firstWhere('id',$id)) {
            $notification->read_at = null;
            $notification->save();
            return response(null,204);
        } else {
            return response()->json(['error' => "Notification not found"],404);
        }
    }
}
