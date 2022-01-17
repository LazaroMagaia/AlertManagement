<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlertRequest;
use App\Models\AlertRemember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MessageAlert;
class AlertsController extends Controller
{
    private $alert,$messageAlert;
    public function __construct(AlertRemember $alert,User $user,MessageAlert $messageAlert)
    {
        $this->alert = $alert;
        $this->user = $user;
        $this->messageAlert = $messageAlert;
    }
    public function index()
    {
        $alerts = $this->alert->all();
        return view('admin.alerts.index',[
            'alerts' => $alerts
        ]);
    }
    public function show($id){
        $alerts = $this->alert->find($id);
        $messageAlert = $this->messageAlert->where('id_alert_remember',$id)->first();
        if(!$alerts)
        {
            return redirect()->back();
        }
        else
        {
            return view('admin.alerts.show',[
            'alert'=>$alerts,
            'messageAlert'=>$messageAlert
            ]);
        }
    }
    public function create()
    {
        return view('admin.alerts.create');
    }
    public function store(AlertRequest $request)
    {
        $userKey = User::find(Auth::user()->id);
        $userId =$userKey->id;

        $data = $request->all();
        $data['user_id'] = $userId;
        $this->alert->create($data);
        return redirect()->route("alerts.home");
    }
    public function edit($id)
    {
        $alerts = $this->alert->find($id);
        return view('admin.alerts.edit',[
            "alert"=>$alerts
        ]);
    }
    public function update($id,Request $request)
    {
        $alerts = $this->alert->find($id);
        if(!$alerts)
        {
            return redirect()->back();
        }
        else{
            $data = $request->all();
            $alerts->update($data);
            return redirect()->route("alerts.home");
        }
    }
    public function delete($id)
    {
        $alerts = $this->alert->find($id);
        if(!$alerts)
        {
            return redirect()->back();
        }
        else{
            $alerts->delete();
            return redirect()->route("alerts.home");
        }
    }
}
