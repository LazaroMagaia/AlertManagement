<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MessageAlert;
use Illuminate\Http\Request;
use App\Models\AlertRemember;
use App\Models\CronJob;
use App\Models\CronJobChoose;
use Illuminate\Support\Facades\DB;

class AlertsMessageController extends Controller
{
    private $message,$alert,$cron,$cronc;
    public function __construct(AlertRemember $alert,MessageAlert $message,CronJob $cron,
    CronJobChoose $cronc)
    {
        $this->message = $message;
        $this->alert = $alert;
        $this->cron = $cron;
        $this->cronc = $cronc;
    }

    public function index($id)
    {
        $cron = $this->cron->all();
        $cronc = $this->cronc->where("id_messages",$id)->first();
        $message = $this->message->find($id)->first();
        return view("admin.alerts.Messages.index",[
            "message"=>$message,
            "crons" => $cron,
            "cronc" => $cronc
        ]);
    }
    public function info()
    {
        return view("admin.alerts.Messages.info");
    }
    public function edit($id)
    {
        $message = $this->message->find($id)->first();
        return view("admin.alerts.Messages.edit",[
            "message"=>$message
        ]);
    }
    public function create($id)
    {
        $alert = DB::table('alert_remembers')->where('id',$id)->first();
        return view("admin.alerts.Messages.create",[
        "alert"=>$alert
    ]);
    }
    public function store($id,Request $request)
    {
        $alert = DB::table('alert_remembers')->where('id',$id)->first();
        $data = $request->all();
        $data['id_alert_remember'] = $alert->id;
        $insert = $this->message->create($data);
        return redirect()->route("alerts.show",[
            "id"=>$alert->id
        ]);
    }
    public function update(Request $request,$id)
    {
        $message = $this->message->find($id)->first();
        $data = $request->all();
        $message->update($data);
        return redirect()->route("alert.message.index",[
            'id'=>$message->id
        ]);
    }
    public function delete($id)
    {
        $message = $this->message->find($id)->first();
        $alert = $this->alert->find($message->id_alert_remember);
        $message->delete();
        return redirect()->route("alerts.show",[
            "id"=>$alert->id
        ]);
    }
    public function cronstore($id,Request $request)
    {
        $data = $request->all();
        $data['id_messages'] = $id;
        if($insert = $this->cronc->where("id_messages",$id)->first())
        {
            $croncupdate = $this->cronc->find($insert->id)->first();
            $croncupdate->update($data);
            return redirect()->back();
        }
        $insert = $this->cronc->create($data);
        return redirect()->back();
    }
}
