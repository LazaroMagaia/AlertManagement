<?php

namespace App\Console\Commands;

use App\Mail\AlertEmailUser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use stdClass;

class AlertEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email de envio de alertas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Tabela dos alertas
        //Nao entendi a logica do banco de dados por tanto fica-se por se observar
        $Alert_remembers = DB::table('alert_remembers')
        ->where('date_finish','>=',now()->format('Y-m-d'))
        ->where('date_start','<=',now()->format('Y-m-d'))
        ->orderBy("id")->get();
        $data =[];
        $messages = [];
        $remail = [];
        $i= 0;
        //Alert
        foreach($Alert_remembers as $Alert_remember)
        {
            /**
             * Pegamos o id da tabela alert_remember para podermos pegar as mensages de email 
             * e assim fazer-se o envio
             */
            $data[$Alert_remember->id] = $Alert_remembers->toArray();
        }

        foreach ($data as $projectId => $value) {
            //Messagens
            //usando o Id_alert_remember conseguimos obter as mensagens de alerta {$projectId}
            $message_alerts = DB::table('message_alerts')
            ->where('id_alert_remember',$projectId)
            ->get();

            foreach($message_alerts as $message_alert)
            {
                $messages[$message_alert->id] = $message_alerts->toArray();
            }
            /***puxar para dentro de um foreach */
            foreach ($messages as $message_id => $value){
                $email_recives = DB::table('recive_emails')
                ->where('id_message_alert',$message_id)
                ->where('status',true)->get();
                $id_message = $message_id;
            }
            foreach($email_recives as $email_recive)
            {
                $remail[$email_recive->email] = $email_recives->toArray();
            }
        }

        foreach ($remail as $emailId => $value)
        {
            //dd($remail);
            $this->sendEmailToUser($id_message,$emailId);
            //assim conseguimos obter cada usuario activo e enviar os emails
        }
    }
    
    public function sendEmailToUser($id_message,$email)
    {
        $message =DB::table('message_alerts')->where('id',$id_message)->first();
        $Alert_remember = DB::table('alert_remembers')
        ->where('id',$message->id_alert_remember)->first();
        $user = DB::table('users')->where('id',$Alert_remember->user_id)->first();
        Mail::send(new AlertEmailUser($email,$user,$message));
    }
}

