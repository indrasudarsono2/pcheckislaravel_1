<?php

namespace App\Http\Controllers\super;

use App\Aplication_rating;
use App\Essay;
use App\Essay_group;
use App\Http\Controllers\Controller;
use App\Performance_check;
use App\Question_group;
use App\Question_varian;
use Illuminate\Http\Request;

class Performance_checkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Aplication_rating $aplication_rating)
    {
        $performance_check = Performance_check::where('aplication_rating_id', $aplication_rating->id)->orderBy('question_varian_id', 'asc')->get();
        $persentage_total = $performance_check->sum('persentage');

        $question_group = Question_group::where('aplication_rating_id', $aplication_rating->id)->get();
        $quantity_mc = $question_group->sum('quantity');

        $essay = Essay::where('aplication_rating_id', $aplication_rating->id)->get();
        $count_essay = count($essay);

        return view('super/manageQuestions/performance_check/performance_check', compact('aplication_rating', 'performance_check', 'persentage_total', 'quantity_mc', 'count_essay'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Aplication_rating $aplication_rating)
    {
        $essay_group = Essay_group::where('aplication_rating_id', $aplication_rating->id)->get();
        $question_group = Question_group::where('aplication_rating_id', $aplication_rating->id)->get();
        if ($essay_group->isEmpty() || $question_group->isEmpty()) {
            return redirect()->route('aplication_ratings.performance_checks.index', $aplication_rating)
                ->with('alert', 'Essay group or Multiple choice group for ' . $aplication_rating->rating->rating . ' not defined');
        }
        $performance_check = Performance_check::where('aplication_rating_id', $aplication_rating->id)->get();
        if ($performance_check->isEmpty()) {
            $varian = Question_varian::all();
        } else {
            foreach ($performance_check as $pc) {
                $p_check[] = $pc->question_varian_id;
            }
            $var = Question_varian::all();
            $varian = $var->whereNotIn('id', $p_check);
        }
        return view('super/manageQuestions/performance_check/performance_checkAdd', compact('aplication_rating', 'varian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Aplication_rating $aplication_rating)
    {
        if ($request->varian == null) {
            $request->validate([
                'varian' => 'required',
                'persentage' => 'required|numeric|max:1',
                'minute' => 'required|numeric|max:120'
            ]);
        } else {
            if ($request->varian == 1) {
                $request->validate([
                    'varian' => 'required',
                    'quantity' => 'required|numeric|min:1',
                    'persentage' => 'required|numeric|max:1',
                    'minute' => 'required|numeric|max:120'
                ]);

                Performance_check::create([
                    'aplication_rating_id' => $aplication_rating->id,
                    'question_varian_id' => $request->varian,
                    'quantity' => $request->quantity,
                    'persentage' => $request->persentage,
                    'minute' => $request->minute
                ]);

                return redirect()->route('aplication_ratings.performance_checks.index', $aplication_rating)->with('status', 'Varian added successfully');
            } else {
                $request->validate([
                    'varian' => 'required',
                    'persentage' => 'required|numeric|max:1',
                    'minute' => 'required|numeric|max:120'
                ]);

                Performance_check::create([
                    'aplication_rating_id' => $aplication_rating->id,
                    'question_varian_id' => $request->varian,
                    'quantity' => $request->quantity,
                    'persentage' => $request->persentage,
                    'minute' => $request->minute
                ]);
                return redirect()->route('aplication_ratings.performance_checks.index', $aplication_rating)->with('status', 'Varian added successfully');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Performance_check  $performance_check
     * @return \Illuminate\Http\Response
     */
    public function show(Aplication_rating $aplication_rating, Performance_check $performance_check)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Performance_check  $performance_check
     * @return \Illuminate\Http\Response
     */
    public function edit(Aplication_rating $aplication_rating, Performance_check $performance_check)
    {
        return view('super/manageQuestions/performance_check/performance_checkEdit', compact('aplication_rating', 'performance_check'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Performance_check  $performance_check
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aplication_rating $aplication_rating, Performance_check $performance_check)
    {
        if ($performance_check->question_varian_id == 1) {
            $request->validate([
                'quantity' => 'required|numeric|min:1',
                'persentage' => 'required|numeric|max:1',
                'minute' => 'required|numeric|max:120'
            ]);

            Performance_check::where('id', $performance_check->id)
                ->update([
                    'quantity' => $request->quantity,
                    'persentage' => $request->persentage,
                    'minute' => $request->minute
                ]);

            return redirect()->route('aplication_ratings.performance_checks.index', $aplication_rating)->with('status', $performance_check->question_varian->varian . '`s varian edited successfully');
        } else {
            $request->validate([
                'persentage' => 'required|numeric|max:1',
                'minute' => 'required|numeric|max:120'
            ]);

            Performance_check::where('id', $performance_check->id)
                ->update([
                    'quantity' => $request->quantity,
                    'persentage' => $request->persentage,
                    'minute' => $request->minute
                ]);
            return redirect()->route('aplication_ratings.performance_checks.index', $aplication_rating)->with('status', $performance_check->question_varian->varian . '`s varian edited successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Performance_check  $performance_check
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aplication_rating $aplication_rating, Performance_check $performance_check)
    {
        Performance_check::destroy($performance_check->id);
        return redirect()->route('aplication_ratings.performance_checks.index', $aplication_rating)->with('status', $performance_check->question_varian->varian . '`s varian deleted successfully');
    }

    public function quantity(Request $request, Aplication_rating $aplication_rating)
    {
        if ($request->varian == 1) {
            $essay_group = Essay_group::where('aplication_rating_id', $aplication_rating->id)->get();
            $quantity = $essay_group->sum('quantity');
        } else {
            $question_group = Question_group::where('aplication_rating_id', $aplication_rating->id)->get();
            $quantity = $question_group->sum('quantity');
        }

        return view('super.ajax.quantity', compact('aplication_rating', 'quantity'));
    }
}
