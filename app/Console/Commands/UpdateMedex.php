<?php

namespace App\Console\Commands;

use App\Biodata;
use App\Medex;
use App\UserModel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class UpdateMedex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:UpdateMedex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updating Medex';

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
        $date = '2022-03-01';
        // $fourty = Carbon::now()->subYear(40);
        $fourty =  Carbon::createFromFormat('Y-m-d', $date)->subYear(40)->format('Y-m-d');

        $biodata = Biodata::with('user')->where('date_of_birth', '>=', $fourty)->get();
        // $biodata = Biodata::with('user')->where('user_id', 2195)->first();
        // return Carbon::parse($biodata->date_of_birth)->diff(Carbon::parse($date))->format('%y tahun %m bulan  %d hari');
        foreach ($biodata as $biodata) {
            $user_id[] = $biodata->user_id;
        }

        $remark[] = [1, 2];

        $user =  UserModel::whereIn('id', $user_id)->whereNotIn('remark_id',  $remark)->orderBy('name', 'asc')->get();
        foreach ($user as $user) {
            $usr_id[] = $user->id;
            $name_user[] = $user->name . "-" . $user->id;
        }

        $count = count($usr_id);

        for ($i = 0; $i < $count; $i++) {
            $medex[] = Medex::with('user')
                ->where('user_id', $usr_id[$i])
                // ->where('expired', '2022-03-20')
                ->whereBetween('expired', [$date, '2022-12-31'])
                ->get();
            if ($medex[$i]->isEmpty()) {
                unset($medex[$i]);
            }
        }

        $medex2 = array_values($medex);
        for ($j = 0; $j < count($medex2); $j++) {
            Medex::where('id', $medex2[$j][0]->id)
                ->update([
                    'expired' => Carbon::parse($medex2[$j][0]->released)->addMonth(48)->format('Y-m-d')
                ]);

            $newMedex = Medex::where('id', $medex2[$j][0]->id)->first();

            $emailReceiver = $newMedex->user->email;

            Mail::send('otentikasi.update_medex', ['medex' => $newMedex], function ($message) use ($emailReceiver) {
                $message->from('admin@proton.iatca-jakarta.or.id', 'Admin');
                $message->sender('admin@proton.iatca-jakarta.or.id', 'Admin');
                $message->to($emailReceiver);
                $message->subject('(No reply !!!) MEDEX Excemption');
            });
        }
    }
}
