<?php

namespace App\Http\Controllers\examinee;

use App\Activity;
use App\Aplication_file;
use App\Aplication_rating;
use App\Biodata;
use App\Branch;
use App\Checker_gain;
use App\Control;
use App\Education_owner;
use App\Form_rating;
use App\Formal_education;
use App\Gain_rating;
use App\Gender;
use App\Group;
use App\Group_member;
use App\Http\Controllers\Controller;
use App\Ielp;
use App\License;
use App\Log_book;
use App\Medex;
use App\Practical_exam;
use App\Rating;
use App\Rating_confirm;
use App\Remark_ap_file;
use App\Score;
use App\Sertificate;
use App\Sertificate_owner;
use App\Session;
use App\UserModel;
use App\Verification_data;
use App\Verification_item;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mockery\Undefined;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Aplication_filesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $aplication_file = Aplication_file::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('examinee.completeness_files.aplicationFile', compact('aplication_file'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $now = Carbon::now();
        $biodata = Biodata::where('user_id', Auth::id())->first();
        $gender = Gender::all();
        $rating2 = Rating::all();
        $activity = Activity::all();
        $formal_education = Formal_education::all();
        $education_owner = Education_owner::where('user_id', Auth::id())->get();
        $sertificate = Sertificate::all();
        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->first();
        $medex = Medex::where('user_id', Auth::id())->orderBy('id', 'desc')->first();
        $ielp = Ielp::where('user_id', Auth::id())->orderBy('id', 'desc')->first();
        $rating1 = Rating::all();
        $remark_ap_file = Remark_ap_file::all();
        $sertificate_owner = Sertificate_owner::where('user_id', Auth::id())->get();
        $sertificate_owner3 = Sertificate_owner::where('user_id', Auth::id())->get();
        $license = License::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        $logbook = Log_book::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

        if ($sertificate_owner3->isEmpty()) {
            return redirect('af')->with('alert', 'Have no enough data such as Medex, IELP, Competence Sertificate !');
        }
        foreach ($sertificate_owner3 as $sertificate_owner3) {
            $rating_id[] = $sertificate_owner3->sertificate->rating_id;
        }
        $sertificate_owner1 = Sertificate_owner::where('user_id', Auth::id())->get();
        $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)->whereIn('rating_id', $rating_id)->get();

        if ($sertificate_owner->isEmpty() || $medex == null || $ielp == null) {
            return redirect('af')->with('alert', 'Have no enough data such as Medex, IELP, Competence Sertificate !');
        } else {
            if ($license->isEmpty()) {
                return redirect()->route('licensess.index')->with('alert', 'You may not fill application file, license can not be empty !');
            } elseif ($logbook->isEmpty()) {
                return redirect()->route('logbookss.index')->with('alert', 'You may not fill application file, log book can not be empty !');
            } else {
                foreach ($sertificate_owner as $sertificate_owner) {
                    $so[] = $sertificate_owner->sertificate_id;
                }
                $years = Carbon::parse($biodata->date_of_birth);
                $age = $years->diffInYears($now);
                $rating = $rating1->whereIn('id', $so)->all();

                return view('examinee.completeness_files.createAplicationFile', compact(
                    'gender',
                    'rating',
                    'activity',
                    'session',
                    'rating2',
                    'medex',
                    'ielp',
                    'formal_education',
                    'sertificate',
                    'sertificate_owner',
                    'sertificate_owner1',
                    'education_owner',
                    'biodata',
                    'age',
                    'aplication_rating',
                    'remark_ap_file',
                    'logbook',
                    'license'
                ));
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $x = Carbon::now()->format('d-m-Y');

        $rules = [
            'activity_id' => 'required',
            'remark_ap_file_id' => 'required',
            'ats_name' => 'required',
            'address' => 'required',
            'rating_id' => 'required',
            'control_hour' => 'required',
            'license_id' => 'required',
            'logbook_id' => 'required',

            'name' => 'required',
            'user_id' => 'required',
            'date_of_birth' => 'required',
            'place_of_birth' => 'required',
            'address_user' => 'required',
            'nationality' => 'required',
            'english_confirm' => 'required|in:ya',
            'height' => 'required',
            'weight' => 'required',
            'hair' => 'required',
            'eyes' => 'required',
            'gender_id' => 'required',

            'rating_confirm' => 'required',
            'rating_confirm2' => 'required_if:rating_confirm,==,ya',
            'input_lainnya' => 'required_if:rating_confirm2,==,lainnya',
            'rating_id2' => 'required_if:rating_confirm,==,ya',
            'location' => 'required_if:rating_confirm,==,ya',

            'medex_confirm' => 'required|in:ya',
            'medex_date' => 'required_if:medex_confirm,==,ya',
            'examiner' => 'required_if:medex_confirm,==,ya',
            'medexExpired' => 'required|date|after:' . $x,

            'ielp_confirm' => 'required|in:ya',
            'rater' => 'required_if:ielp_confirm,==,ya',
            'institution' => 'required_if:ielp_confirm,==,ya',
            'ielp_date' => 'required_if:ielp_confirm,==,ya',
            'levell' => 'required_if:ielp_confirm,==,ya',
            'ielpExpired' => 'required|date|after:' . $x,

            'control_confirm' => 'required',
            'start' => 'required_if:control_confirm,==,ya',
            'finish' => 'required_if:control_confirm,==,ya',
            'control' => 'required_if:control_confirm,==,ya',
            'ojti_id' => 'required_if:control_confirm,==,ya',

            'drugs_confirm' => 'required',

            'formal_education_id' => 'required',
            'year' => 'required',

            'sertificate_id' => 'required',
            'sertificate_institution' => 'required',
            'sertificate_released' => 'required',

            'failed_confirm' => 'required'
        ];

        $message = [
            'required' => 'This field must not be empty',
            'control_hour.required' => 'Control hour is required for rating choosen above',
        ];

        $request->validate($rules, $message);

        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->first();
        $year = $session->year;
        $period = $session->period;
        $activity = Activity::where('id', $request->activity_id)->first();
        $abbr = $activity->abbr;
        $id = Auth::id();
        $rand = mt_rand(0, 999);
        $branch = Branch::where('id', Auth::user()->branch_id)->first();
        $aplication_id = $year . "/" . $period . "/" . $abbr . "/" . $branch->branch . "/" . $id . $rand;
        $rating_confirm = $request->rating_confirm2;
        $input_lain = $request->input_lainnya;
        $remark = $rating_confirm . " " . $input_lain;

        Medex::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'released' => $request->medex_date
            ],
            [
                'confirm' => $request->medex_confirm,
                'user_id' => Auth::id(),
                'released' => $request->medex_date,
                'expired' => date('Y-m-d', strtotime($request->medexExpired)),
                'examiner' => $request->examiner
            ]
        );
        $medex = Medex::where('user_id', Auth::id())->orderBy('id', 'desc')->first();

        Ielp::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'released' => $request->ielp_date
            ],
            [
                'confirm' => $request->ielp_confirm,
                'user_id' => Auth::id(),
                'rater' => $request->rater,
                'institution' => $request->institution,
                'level' => $request->levell,
                'released' => $request->ielp_date,
                'expired' => date('Y-m-d', strtotime($request->ielpExpired)),
            ]
        );
        $ielp = Ielp::where('user_id', Auth::id())->orderBy('id', 'desc')->first();

        Control::create([
            'user_id' => Auth::id(),
            'confirm' => $request->control_confirm,
            'start' => $request->start,
            'finish' => $request->finish,
            'control_hours' => $request->control,
            'ojti_id' => $request->ojti_id,
        ]);
        $control = Control::where('user_id', Auth::id())->orderBy('id', 'desc')->first();

        Aplication_file::create([
            'number' => $aplication_id,
            'remark_ap_file_id' => $request->remark_ap_file_id,
            'user_id' => Auth::id(),
            'session_id' => $request->session_id,
            'status_id' => 1,
            'activity_id' => $request->activity_id,
            'ats_name' => $request->ats_name,
            'address' => $request->address,
            'medex_id' => $medex->id,
            'ielp_id' => $ielp->id,
            'control_id' => $control->id,
            'drugs' => $request->drugs_confirm,
            'failed' => $request->failed_confirm,
            'license_id' => $request->license_id,
            'logbook_id' => $request->logbook_id
        ]);
        $aplication = Aplication_file::where('user_id', Auth::id())->orderBy('id', 'desc')->first();

        $count = count($request->rating_id);
        for ($i = 0; $i < $count; $i++) {
            Form_rating::create([
                'aplication_file_id' => $aplication->id,
                'rating_id' => $request->rating_id[$i],
                'control_hours' => $request->control_hour[$request->rating_id[$i]],
                'status_id' => 1,
            ]);
        }

        $count_fe = count($request->formal_education_id);
        for ($j = 0; $j < $count_fe; $j++) {
            Education_owner::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'formal_education_id' => $request->formal_education_id[$j]
                ],
                [
                    'user_id' => Auth::id(),
                    'formal_education_id' => $request->formal_education_id[$j],
                    'year' => $request->year[$request->formal_education_id[$j]]
                ]
            );
        }

        $count_ser = count($request->sertificate_id);
        for ($k = 0; $k < $count_ser; $k++) {
            for ($l = 0; $l <= 2; $l++) {
                Sertificate_owner::updateOrCreate(
                    [
                        'user_id' => Auth::id(),
                        'sertificate_id' => $request->sertificate_id[$k]
                    ],
                    [
                        'user_id' => Auth::id(),
                        'sertificate_id' => $request->sertificate_id[$k],
                        'institution' => $request->sertificate_institution[$request->sertificate_id[$k]],
                        'released' => $request->sertificate_released[$request->sertificate_id[$k]]
                    ]
                );
            }
        }

        Biodata::updateOrCreate(
            ['user_id' => $request->user_id],
            [
                'user_id' => $request->user_id,
                'date_of_birth' => $request->date_of_birth,
                'place_of_birth' => $request->place_of_birth,
                'address_user' => $request->address_user,
                'nationality' => $request->nationality,
                'english_confirm' => $request->english_confirm,
                'height' => $request->height,
                'weight' => $request->weight,
                'hair' => $request->hair,
                'eyes' => $request->eyes,
                'gender_id' => $request->gender_id,
            ]
        );

        UserModel::updateOrCreate(
            ['id' => $request->user_id],
            ['name' => $request->name]
        );

        if ($request->rating_confirm == "ya") {
            Rating_confirm::create([
                'confirm' => $request->rating_confirm,
                'aplication_file_id' => $aplication->id,
                'remark' => $remark,
                'rating_id' => implode(",", $request->rating_id2),
                'location' => $request->location,
                'date' => $request->freze_date
            ]);
        } else {
            Rating_confirm::create([
                'confirm' => $request->rating_confirm,
                'aplication_file_id' => $aplication->id,
                'remark' => $remark,
                'rating_id' => "",
                'location' => $request->location,
                'date' => $request->freze_date
            ]);
        }

        $gain_rating = Gain_rating::where('user_id', Auth::id())->where('session_id', $session->id)->orderBy('id', 'desc')->first();
        function group($session, $aplication)
        {
            $group = Group::where('session_id', $session->id)->get();

            if ($group->isEmpty()) {
                return redirect('af')->with('warning', 'Added successfully but you aren`t in the group, inform your checker chordinator please');
            } else {
                if (Auth::user()->branch_id != 2) {
                    foreach ($group as $group) {
                        $group_id[] = $group->id;
                    }

                    $group_member = Group_member::whereIn('group_id', $group_id)->where('user_id', Auth::id())->first();

                    if ($group_member == null) {
                        return redirect('af')->with('warning', 'Added successfully but you aren`t in the group, inform your checker chordinator please');
                    } else {
                        $form_rating = Form_rating::where('aplication_file_id', $aplication->id)->get();
                        foreach ($form_rating as $form_rating) {
                            $fr_id[] = $form_rating->id;
                        }
                        $count = count($fr_id);

                        for ($i = 0; $i < $count; $i++) {
                            Practical_exam::create([
                                'form_rating_id' => $fr_id[$i],
                                'checker_id' => $group_member->group->user_id,
                                'group_id' => $group_member->group->id,
                                'group_member_id' => $group_member->id
                            ]);
                        }
                        return redirect('af')->with('status', 'Aplication added successfuly');
                    }
                } else {
                    foreach ($group as $group) {
                        $group_id[] = $group->id;
                    }
                    $group_member = Group_member::whereIn('group_id', $group_id)->where('user_id', Auth::id())->get();
                    if ($group_member->isEmpty()) {
                        return redirect('af')->with('warning', 'Added successfully but you aren`t in the group, inform your checker chordinator please');
                    } else {
                        $form_rating = Form_rating::where('aplication_file_id', $aplication->id)->get();
                        foreach ($form_rating as $form_rating) {
                            $fr_id[] = $form_rating->id;
                            $fr_rating_id[] = $form_rating->rating_id;
                        }
                        $count = count($fr_id);

                        if ($fr_rating_id[0] == 1) {
                            $group_twr = Group::whereIn('id', $group_id)->where('name', "TWR")->get();
                            foreach ($group_twr as $group_twr) {
                                $group_twr_id[] = $group_twr->id;
                            }
                            $group_member = Group_member::whereIn('group_id', $group_twr_id)->where('user_id', Auth::id())->first();
                            Practical_exam::create([
                                'form_rating_id' => $fr_id[0],
                                'checker_id' => $group_member->group->user_id,
                                'group_id' => $group_member->group->id,
                                'group_member_id' => $group_member->id
                            ]);

                            $group_app = Group::whereIn('id', $group_id)->where('name', '!=', "TWR")->get();
                            foreach ($group_app as $group_app) {
                                $group_app_id[] = $group_app->id;
                            }
                            $group_member_app = Group_member::whereIn('group_id', $group_app_id)->where('user_id', Auth::id())->first();
                            if ($group_member_app == null) {
                                return redirect('af')->with('status', 'Aplication added successfuly');
                            }
                            for ($i = 1; $i < $count; $i++) {
                                Practical_exam::create([
                                    'form_rating_id' => $fr_id[$i],
                                    'checker_id' => $group_member_app->group->user_id,
                                    'group_id' => $group_member_app->group->id,
                                    'group_member_id' => $group_member_app->id
                                ]);
                            }
                        } else {
                            $group_app = Group::whereIn('id', $group_id)->where('name', '!=', "TWR")->get();
                            foreach ($group_app as $group_app) {
                                $group_app_id[] = $group_app->id;
                            }
                            $group_member_app = Group_member::whereIn('group_id', $group_app_id)->where('user_id', Auth::id())->first();
                            for ($i = 0; $i < $count; $i++) {
                                Practical_exam::create([
                                    'form_rating_id' => $fr_id[$i],
                                    'checker_id' => $group_member_app->group->user_id,
                                    'group_id' => $group_member_app->group->id,
                                    'group_member_id' => $group_member_app->id
                                ]);
                            }
                        }
                        return redirect('af')->with('status', 'Aplication added successfuly');
                    }
                }
            }
        }

        if ($aplication->remark_ap_file_id == 1) {
            if ($gain_rating == null) {
                return redirect('af')->with('warning', 'Added successfully but checkers hadn`t declared yet, inform your checker chordinator please');
            } else {
                $form_rating = Form_rating::where('aplication_file_id', $aplication->id)->get();
                foreach ($form_rating as $form_rating) {
                    $fr_id[] = $form_rating->id;
                }
                $count = count($fr_id);

                $checker_gain = Checker_gain::where('gain_rating_id', $gain_rating->id)->get();
                foreach ($checker_gain as $checker_gain) {
                    $checker_gain_id[] = $checker_gain->id;
                    $checker_id[] = $checker_gain->user_id;
                }
                $count_checker = count($checker_id);

                for ($i = 0; $i < $count_checker; $i++) {
                    for ($j = 0; $j < $count; $j++) {
                        Practical_exam::create([
                            'form_rating_id' => $fr_id[$j],
                            'checker_id' => $checker_id[$i],
                            'checker_gain_id' => $checker_gain_id[$i]
                        ]);
                    }
                }
                return redirect('af')->with('status', 'Aplication added successfuly');
            }
        } else {
            if ($gain_rating == null) {
                return group($session, $aplication);
            } else {
                $checker_gain = Checker_gain::where('gain_rating_id', $gain_rating->id)->get();
                foreach ($checker_gain as $checker_gain) {
                    $checker_gain_id[] = $checker_gain->id;
                }
                $practical_exam = Practical_exam::whereIn('checker_gain_id', $checker_gain_id)->where('score', null)->get();
                if ($practical_exam->isEmpty()) {
                    return group($session, $aplication);
                } else {
                    foreach ($practical_exam as $practical_exam) {
                        $checker_nm[] = $practical_exam->checker_gain->user->name;
                    }
                    $checker_name = implode(", ", $checker_nm);
                    return redirect('af')->with('warning', $checker_name . ' had not completed your score yet');
                }
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aplication_file  $aplication_file
     * @return \Illuminate\Http\Response
     */
    public function edit(Aplication_file $aplication_file)
    {
        $now = Carbon::now();
        $activity = Activity::all();
        $biodata = Biodata::where('user_id', Auth::id())->first();
        $session = Session::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->first();
        $gender = Gender::all();
        $rating = Rating::all();
        $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)->get();
        $aplication_rating = Aplication_rating::where('branch_id', Auth::user()->branch_id)->get();
        $rating_confirm = Rating_confirm::where('aplication_file_id', $aplication_file->id)->first();
        $remark_rating = explode(" ", $rating_confirm->remark);
        $rating3 = explode(",", $rating_confirm->rating_id);
        $rating2 = Rating::all();
        $remark_ap_file = Remark_ap_file::all();
        $formal_education = Formal_education::all();
        $education_owner = Education_owner::where('user_id', Auth::id())->get();
        $sertificate = Sertificate::all();
        $sertificate_owner = Sertificate_owner::where('user_id', Auth::id())->get();
        $years = Carbon::parse($biodata->date_of_birth);
        $license = License::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        $logbook = Log_book::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        $age = $years->diffInYears($now);

        return view('examinee.completeness_files.editAplicationFile', compact(
            'aplication_file',
            'activity',
            'biodata',
            'session',
            'rating',
            'rating2',
            'rating3',
            'rating_confirm',
            'form_rating',
            'gender',
            'sertificate',
            'formal_education',
            'sertificate_owner',
            'education_owner',
            'remark_rating',
            'age',
            'remark_ap_file',
            'aplication_rating',
            'license',
            'logbook'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aplication_file  $aplication_file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aplication_file $aplication_file, Form_rating $id_fr)
    {
        $x = Carbon::now()->format('d-m-Y');

        $rules = [
            'activity_id' => 'required',
            'ats_name' => 'required',
            'address' => 'required',
            'rating_id' => 'required',
            'control_hour' => 'required',

            'name' => 'required',
            'user_id' => 'required',
            'date_of_birth' => 'required',
            'place_of_birth' => 'required',
            'address_user' => 'required',
            'nationality' => 'required',
            'english_confirm' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'hair' => 'required',
            'eyes' => 'required',
            'gender_id' => 'required',

            'rating_confirm' => 'required',
            'rating_confirm2' => 'required_if:rating_confirm,==,ya',
            'input_lainnya' => 'required_if:rating_confirm2,==,lainnya',
            'rating_id2' => 'required_if:rating_confirm,==,ya',
            'location' => 'required_if:rating_confirm,==,ya',

            'medex_confirm' => 'required|in:ya',
            'medex_date' => 'required_if:medex_confirm,==,ya',
            'examiner' => 'required_if:medex_confirm,==,ya',
            'medexExpired' => 'required|date|after_or_equal:' . $x,

            'ielp_confirm' => 'required|in:ya',
            'rater' => 'required_if:ielp_confirm,==,ya',
            'institution' => 'required_if:ielp_confirm,==,ya',
            'ielp_date' => 'required_if:ielp_confirm,==,ya',
            'levell' => 'required_if:ielp_confirm,==,ya',
            'ielpExpired' => 'required|date|after_or_equal:' . $x,

            'drugs_confirm' => 'required',

            'failed_confirm' => 'required'
        ];

        $message = [
            'required' => 'This field must not be empty',
            'control_hour.*.required' => 'Control hour is required for rating choosen above',
        ];



        $request->validate($rules, $message);
        $rating_confirm = $request->rating_confirm2;
        $input_lain = $request->input_lainnya;
        $remark = $rating_confirm . " " . $input_lain;


        $id_fr = Form_rating::where('aplication_file_id', $request->aplication_file->id)->get();
        $count_fr = count($id_fr);
        foreach ($id_fr as $id) {
            $id_frt[] = $id->id;
            $frt_rating[] = $id->rating_id;
        }

        $prac_exam = Practical_exam::whereIn('form_rating_id', $id_frt)->where('score', '!=', null)->get();
        if ($prac_exam->isNotEmpty()) {
            return redirect('/af')->with('alert', 'Aplication file couldn`t be updated !!!');
        }

        $practical_exam = Practical_exam::whereIn('form_rating_id', $id_frt)->get();
        foreach ($practical_exam as $practical_exam) {
            $checker_gain_id[] = $practical_exam->checker_gain_id;
            $group_id[] = $practical_exam->group_id;
            $group_member_id[] = $practical_exam->group_member_id;
            $checker_id[] = $practical_exam->checker_id;
        }

        // // for ($i = 0; $i < $count_fr; $i++) {
        // //     Form_rating::where('id', $id_fr->modelKeys()[$i])
        // //         ->update([
        // //             'control_hours' => $request->control_hour[$i]
        // //         ]);
        // // }
        if ($aplication_file->remark_ap_file_id == 1) {
            if ($request->rating_id > 1) {
                return redirect('/af')->with('alert', 'Aplication file couldn`t be updated !!!');
            } else {
                Form_rating::where('id', $id_frt)
                    ->update([
                        'control_hours' => $request->control_hour[$id_frt]
                    ]);
            }
        } else {
            if ($frt_rating == $request->rating_id) {
                for ($d = 0; $d < count($id_frt); $d++) {
                    Form_rating::where('id', $id_frt[$d])
                        ->update([
                            'control_hours' => $request->control_hour[$frt_rating[$d]]
                        ]);
                }
            } else {
                for ($i = 0; $i < $count_fr; $i++) {
                    Form_rating::destroy('id', $id_fr->modelKeys()[$i]);
                }
                for ($j = 0; $j < count($request->rating_id); $j++) {
                    Form_rating::create([
                        'aplication_file_id' => $aplication_file->id,
                        'rating_id' => $request->rating_id[$j],
                        'control_hours' => $request->control_hour[$request->rating_id[$j]],
                        'status_id' => 1,
                    ]);
                }

                $fr_p = Form_rating::where('aplication_file_id', $aplication_file->id)->get();
                foreach ($fr_p as $fr_p) {
                    $fr_p_id[] = $fr_p->id;
                }
                for ($k = 0; $k < count($fr_p_id); $k++) {
                    Practical_exam::create([
                        'form_rating_id' => $fr_p_id[$k],
                        'group_id' => $group_id[0],
                        'group_member_id' => $group_member_id[0],
                        'checker_id' => $checker_id[0]
                    ]);
                }
            }
        }

        Aplication_file::where('id', $request->aplication_file->id)
            ->update([
                'activity_id' => $request->activity_id,
                'ats_name' => $request->ats_name,
                'address' => $request->address,
                'drugs' => $request->drugs_confirm,
                'failed' => $request->failed_confirm,
                'license_id' => $request->license_id,
                'logbook_id' => $request->logbook_id
            ]);

        Biodata::where('user_id', Auth::id())
            ->update([
                'date_of_birth' => $request->date_of_birth,
                'place_of_birth' => $request->place_of_birth,
                'address_user' => $request->address_user,
                'nationality' => $request->nationality,
                'english_confirm' => $request->english_confirm,
                'height' => $request->height,
                'weight' => $request->weight,
                'hair' => $request->hair,
                'eyes' => $request->eyes,
                'gender_id' => $request->gender_id,
            ]);

        UserModel::where('id', Auth::id())
            ->update([
                'name' => $request->name
            ]);

        if ($request->rating_confirm == "ya") {
            Rating_confirm::where('aplication_file_id', $request->aplication_file->id)
                ->update([
                    'confirm' => $request->rating_confirm,
                    'remark' => $remark,
                    'rating_id' => implode(",", $request->rating_id2),
                    'location' => $request->location,
                    'date' => $request->freze_date
                ]);
        } else {
            Rating_confirm::where('aplication_file_id', $request->aplication_file->id)
                ->update([
                    'confirm' => $request->rating_confirm,
                    'remark' => "",
                    'rating_id' => "",
                    'location' => null,
                    'date' => null
                ]);
        }

        Control::where('id', $aplication_file->control_id)
            ->update([
                'confirm' => $request->control_confirm,
                'start' => $request->start,
                'finish' => $request->finish,
                'control_hours' => $request->control,
                'user_id' => $request->ojti_id,
            ]);



        return redirect('/af')->with('status', 'Aplication file updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aplication_file  $aplication_file
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aplication_file $aplication_file)
    {
        $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)->get();
        foreach ($form_rating as $fr) {
            $fr_id[] = $fr->id;
        }
        $score = Score::whereIn('form_rating_id', $fr_id)->where('score', '!=', null)->get();

        if ($score->isEmpty()) {
            Aplication_file::destroy($aplication_file->id);
            return redirect('/af')->with('status', 'Aplication file deleted successfully');
        } else {
            return redirect('/af')->with('alert', 'Aplication file can not be deleted');
        }
    }

    public function search(Request $request)
    {
        $search = $request->ojti_id;

        $ojti = UserModel::where('id', 'like', "%{$search}%")->where('branch_id', Auth::user()->branch_id)->get();
        return view('examinee.ajax.ojtiName', compact('ojti'));
    }

    public function pdf()
    {
        $pdf = PDF::loadView('pdf.invoice');
        return $pdf->download('invoice.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aplication_file  $aplication_file
     * @return \Illuminate\Http\Response
     */
    public function show(Aplication_file $aplication_file)
    {
        $name = $aplication_file->user->name;
        $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)->get();
        $biodata = Biodata::where('user_id', Auth::id())->first();
        $rating_confirm = Rating_confirm::where('aplication_file_id', $aplication_file->id)->first();
        $rating_confirm2 = Rating_confirm::Select('rating_id')->where('aplication_file_id', $aplication_file->id)->first();
        // Str::of($rating_confirm->rating_id)->explode(",");
        $remark_rating = explode(" ", $rating_confirm->remark);
        $rating = explode(",", $rating_confirm->rating_id);
        $rat_collection = Rating::all();
        $rat = $rat_collection->whereIn('id', $rating)->all();
        $education = Education_owner::where('user_id', Auth::id())->get();
        $sertificate = Sertificate_owner::where('user_id', Auth::id())->get();
        $now = Carbon::today()->format('d-m-Y');

        $pdf = PDF::loadView('examinee.print.aplication_filePrint', compact(
            'aplication_file',
            'form_rating',
            'biodata',
            'rating_confirm',
            'rating_confirm2',
            'remark_rating',
            'rat',
            'education',
            'sertificate',
            'now'
        ))->setPaper('A4', 'portrait');
        return $pdf->stream($name . '_' . $aplication_file->number . '.pdf');
    }

    public function released(Aplication_file $aplication_file)
    {
        $name = $aplication_file->user->name;
        $biodata = Biodata::where('user_id', Auth::id())->first();
        $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)->get();
        $now = Carbon::today()->format('d F Y');

        $pdf = PDF::loadview('examinee.print.publishingPrint', compact('aplication_file', 'biodata', 'form_rating', 'now'))->setPaper('A4', 'portrait');
        return $pdf->download($name . '_' . $aplication_file->number . '-PENERBITAN.pdf');
    }

    public function index_verification(Session $sessionss, Remark_ap_file $remark_ap_file)
    {
        if ($remark_ap_file->id == 1) {
            $checker_gain = Checker_gain::where('user_id', Auth::id())->get();
            if ($checker_gain->isEmpty()) {
                return redirect()->route('sessionss.index')->with('alert', 'No data available');
            }
            foreach ($checker_gain as $checker_gain) {
                $gain_rating_id[] = $checker_gain->gain_rating_id;
            }
            $gain_rating = Gain_rating::whereIn('id', $gain_rating_id)->where('session_id', $sessionss->id)->get();
            foreach ($gain_rating as $gain_rating) {
                $usr_id[] = $gain_rating->user_id;
            }
            $aplication_file = Aplication_file::with('ielp', 'medex', 'user', 'form_rating')->whereIn('user_id', $usr_id)
                ->where('session_id', $sessionss->id)->where('remark_ap_file_id', $remark_ap_file->id)->orderBy('id', 'desc')->get();
        } else {
            $group = Group::where('user_id', Auth::id())->where('session_id', $sessionss->id)->first();
            if ($group == null) {
                return redirect()->route('sessionss.index')->with('alert', 'No data available');
            }
            $group_member = Group_member::where('group_id', $group->id)->get();
            foreach ($group_member as $group_member) {
                $usr_id[] = $group_member->user_id;
            }

            $aplication_file = Aplication_file::with('ielp', 'medex', 'user', 'form_rating')->whereIn('user_id', $usr_id)
                ->where('session_id', $sessionss->id)->where('remark_ap_file_id', $remark_ap_file->id)->orderBy('id', 'desc')->get();
            if ($aplication_file->isEmpty()) {
                return redirect()->route('sessionss.index')->with('alert', 'No data available');
            }
        }

        foreach ($aplication_file as $af) {
            $af_id[] = $af->id;
        }
        $count = count($af_id);
        for ($i = 0; $i < $count; $i++) {
            $verification_data[] = Verification_data::where('aplication_file_id', $af_id[$i])->limit(1)->get();
            if ($verification_data[$i]->isEmpty()) {
                unset($verification_data[$i]);
            }
        }
        $verification_data = array_values($verification_data);

        return view('examinee.checker_menu.verAplication_file', compact('sessionss', 'remark_ap_file', 'aplication_file', 'verification_data'));
    }

    public function verification(Request $request, Session $sessionss, Remark_ap_file $remark_ap_file, Aplication_file $aplication_file)
    {
        $verification_item = Verification_item::all();
        $count = count($verification_item);

        for ($i = 0; $i < $count; $i++) {
            if ($remark_ap_file->id == 2 && $i == 5) {
                continue;
            }

            Verification_data::create([
                'aplication_file_id' => $aplication_file->id,
                'verification_item_id' => $i + 1,
                'checker_id' => Auth::id(),
                'status' => $request->verification_status[$i + 1],
                'match' => $request->verification_match[$i + 1],
                'remark' => $request->remark[$i + 1]
            ]);
        }
        Aplication_file::where('id', $aplication_file->id)
            ->update([
                'status_id' => 2
            ]);
        return redirect()->route('aplication_file.verification', [$sessionss, $remark_ap_file])->with('status', $aplication_file->user->name . '`s file verified');
    }

    public function verification_data(Session $sessionss, Remark_ap_file $remark_ap_file, Aplication_file $aplication_file)
    {
        $verification_item = Verification_item::all();
        $count = count($verification_item);

        if ($remark_ap_file->id == 2) {
            unset($verification_item[5]);
        }
        $no = 1;

        return view('examinee.checker_menu.ver_data', compact('sessionss', 'remark_ap_file', 'aplication_file', 'verification_item', 'count', 'no'));
    }

    public function print_checklist(Session $sessionss, Remark_ap_file $remark_ap_file, Aplication_file $aplication_file)
    {
        $verification_data = Verification_data::where('aplication_file_id', $aplication_file->id)->get();
        if ($verification_data->isEmpty()) {
            return redirect()->route('af.index')->with('alert', 'No checklist recorded!!!');
        }

        $pdf = PDF::loadView('examinee.print.checklistPrint', compact(
            'remark_ap_file',
            'aplication_file',
            'verification_data',
        ))->setPaper('A4', 'portrait');
        return $pdf->stream($aplication_file->user->name . '_' . $aplication_file->number . '.pdf');
    }

    public function print_checklist_checker(Session $sessionss, Remark_ap_file $remark_ap_file, Aplication_file $aplication_file)
    {
        $verification_data = Verification_data::where('aplication_file_id', $aplication_file->id)->get();
        if ($verification_data->isEmpty()) {
            return redirect()->route('aplication_file.verification', [$sessionss, $remark_ap_file])->with('alert', 'No checklist recorded!!!');
        }

        $pdf = PDF::loadView('examinee.print.checklistPrint', compact(
            'remark_ap_file',
            'aplication_file',
            'verification_data',
        ))->setPaper('A4', 'portrait');
        return $pdf->stream($aplication_file->user->name . '_' . $aplication_file->number . '.pdf');
    }

    public function viewDocument(Session $sessionss, Remark_ap_file $remark_ap_file, Aplication_file $aplication_file)
    {
        $name = $aplication_file->user->name;
        $form_rating = Form_rating::where('aplication_file_id', $aplication_file->id)->get();
        $biodata = Biodata::where('user_id', $aplication_file->user_id)->first();
        $rating_confirm = Rating_confirm::where('aplication_file_id', $aplication_file->id)->first();
        $rating_confirm2 = Rating_confirm::Select('rating_id')->where('aplication_file_id', $aplication_file->id)->first();
        $remark_rating = explode(" ", $rating_confirm->remark);
        $rating = explode(",", $rating_confirm->rating_id);
        $rat_collection = Rating::all();
        $rat = $rat_collection->whereIn('id', $rating)->all();
        $education = Education_owner::where('user_id', $aplication_file->user_id)->get();
        $sertificate = Sertificate_owner::where('user_id', $aplication_file->user_id)->get();
        $extension = explode('.', $aplication_file->license->fileUrl);

        return view('examinee.checker_menu.viewDocument', compact(
            'aplication_file',
            'form_rating',
            'biodata',
            'rating_confirm',
            'rating_confirm2',
            'remark_rating',
            'rat',
            'education',
            'sertificate',
            'extension'
        ));
    }
}
