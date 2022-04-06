<?php

namespace App\Console\Commands;

use App\Ielp;
use App\Log_email;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendIelpEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SendIelpEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $target = Carbon::now()->addMonth(3)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');

        // $ielpTarget = Ielp::with('user')->where('expired', $target)->get();
        $ielpTarget = Ielp::with('user')->where('user_id', 3458)->get();


        if ($ielpTarget->isEmpty()) {
            Log_email::create([
                'name' => 'null',
                'cat' => 'IELP'
            ]);
        } else {
            for ($i = 0; $i < count($ielpTarget); $i++) {
                $emailReceiver = $ielpTarget[$i]->user->email;

                Mail::send('otentikasi.email_daily_ielp', ['ielp' =>  $ielpTarget[$i]], function ($message) use ($emailReceiver) {
                    $message->from('admin@proton.iatca-jakarta.or.id', 'Admin');
                    $message->sender('admin@proton.iatca-jakarta.or.id', 'Admin');
                    $message->to($emailReceiver);
                    $message->subject('(No reply !!!) IELP Information');
                });

                Log_email::create([
                    'name' => $ielpTarget[$i]->user->name,
                    'cat' => 'IELP'
                ]);
            }
        }
    }
}
