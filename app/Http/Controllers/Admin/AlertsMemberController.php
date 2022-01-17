<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmStatus;
use App\Mail\MailConformation;
use App\Models\ReciveEmails;
use Illuminate\Http\Request;
use App\Models\MessageAlert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class AlertsMemberController extends Controller
{
    private $member,$message;
    public function __construct(ReciveEmails $member,MessageAlert $message)
    {
        $this->member = $member;
        $this->message = $message;
    }
    public function index($id)
    {
        $member = $this->member->where("id_message_alert",$id)->get();
        $message = DB::table('message_alerts')->where('id',$id)->first();
        return view("admin.alerts.Members.index",[
            "members" =>$member,
            "message" => $message
        ]);
    }
    public function create($id)
    {
        return view("admin.alerts.Members.create",[
            "id_message" => $id//Message Id pertence a tabela Message_alertas
    ]);
    }
    public function store($id,Request $request)
    {
        $member = $this->member;
        $data = $request->all();
        $data['status'] = 0;
        $data['id_message_alert'] = $id;
        $data['token'] = Str::random(120);
        //Fazer uma pesqueisa na data base para saber se ja existe esse email com essa id_message_alert
        //caso sim, não pode adicionar caso contratrio pode sim
        $member->create($data);
        $this->Mailconfirm($data['email'],$data['token']);
        return redirect()->route("alert.member.index",[
            "id" =>$id
        ]);
    }
    public function Mailconfirm($email,$token)
    {
        $member = $this->member->where("email",$email)
        ->where("token",$token)->first();
        $messageAlert = $this->message->find($member->id_message_alert)->first();//Message_alerts
        $message = DB::table('alert_remembers')
        ->where('id',$messageAlert->id_alert_remember)->first();
        $user = DB::table('users')->where("id",$message->user_id)->first();
        Mail::to($email)->send(new MailConformation($member,$messageAlert,$user));
    }
    public function edit($id)
    {   
        $member = $this->member->find($id)->first();
        $message = $this->message->find($member->id_message_alert)->first();
        return view("admin.alerts.Members.edit",[
        "member"=>$member]);
    }
    public function update($id,Request $request)
    {
        $member = $this->member->find($id)->first();
        $message = $this->message->find($member->id_message_alert)->first();
        $data = $request->all();
        $data['token'] = Str::random(120);
        $member->update($data);
        return redirect()->route("alert.member.index",$message->id);
    }
    public function delete($id)
    {
        $query = DB::table('recive_emails')->where('id',$id);
        $member = $query->first();
        $message = DB::table('message_alerts')->where('id',$member->id_message_alert)->first();
        $query->delete();
        return redirect()->route("alert.member.index",$message->id);
    }
    public function status($email,$token,Request $request)
    {
        $query = DB::table('recive_emails')->where("email",$email)
        ->where('token',$token);
        $data = $request->all();
        $data['status'] = true;
        $query->update($data);
        $this->confirmStatus($email,$token); 
        return view("welcome");//Depois enviar lhe um email a confirmar a sua subscricao
    }
    public function confirmStatus($email,$token)
    {
        $member = DB::table('recive_emails')->where("email",$email)
        ->where('token',$token)->first();
        Mail::to($email)->send(new ConfirmStatus($member));
    }
}
