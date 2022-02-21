<?php

namespace App\Console\Commands;

use App\Medex;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SendEmailDaily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email for IELP and MEDEX expired daily';

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
        $thirty = Carbon::now()->addMonth(1)->format('Y-m-d');
        $twentytwo = Carbon::now()->addDay(22)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');

        $medexThirty = Medex::with('user')->whereIn('expired', [$thirty, $twentytwo])->get();
        $medexToday = Medex::with('user')->where('expired', $today)->get();

        if ($medexThirty->isEmpty()) {
            return ('empty');
        } else {
            for ($i = 0; $i < count($medexThirty); $i++) {
                $emailReceiver = $medexThirty[$i]->user->email;

                Mail::send('otentikasi.email_daily', ['medex' =>  $medexThirty[$i]], function ($message) use ($emailReceiver) {
                    $message->from('admin@proton.iatca-jakarta.or.id', 'Admin');
                    $message->sender('admin@proton.iatca-jakarta.or.id', 'Admin');
                    $message->to($emailReceiver);
                    $message->subject('(No reply !!!) MEDEX Information');
                });
            }
        }

        // // $data = [];

        // // foreach ($medex as $medex) {
        // //     $data[$medex->user->email][] = $medex->toArray();
        // // }

        // Mail::send('otentikasi.email_daily', compact('medex'), function ($message) use ($medex) {
        //     $message->from('admin@proton.iatca-jakarta.or.id', 'Admin');
        //     $message->sender('admin@proton.iatca-jakarta.or.id', 'Admin');
        //     $message->to($medex->user->email);
        //     $message->subject('(No reply !!!) Essay`s score');
        // });
    }
}
