<?php

namespace App\Http\Controllers\super;

use App\Aplication_rating;
use App\Essay;
use App\Essay_group;
use App\Http\Controllers\Controller;
use App\Performance_check;
use Illuminate\Http\Request;

class Essay_groupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Aplication_rating $aplication_rating)
    {
        $essay_group = Essay_group::where('aplication_rating_id', $aplication_rating->id)->get();
        $quantity = $essay_group->sum('quantity');

        $eg = Essay_group::where('aplication_rating_id', $aplication_rating->id)->get();
        if ($eg->isEmpty()) {
            return view('super/manageQuestions/essay/essay_group', compact('aplication_rating', 'essay_group', 'quantity'));
        }
        foreach ($eg as $eg) {
            $eg_id[] = $eg->id;
        }

        for ($i = 0; $i < count($eg_id); $i++) {
            $essay[] = Essay::where('essay_group_id', $eg_id[$i])->get();
            $count[] = count($essay[$i]);
        }
        $no = 1;
        return view('super/manageQuestions/essay/essay_group', compact('aplication_rating', 'essay_group', 'quantity', 'count', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Aplication_rating $aplication_rating)
    {
        return view('super/manageQuestions/essay/essay_groupAdd', compact('aplication_rating'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Aplication_rating $aplication_rating)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
            'group' => 'required|max:100',
        ]);

        Essay_group::create([
            'quantity' => $request->quantity,
            'group' => $request->group,
            'aplication_rating_id' => $aplication_rating->id
        ]);

        $performance_check = Performance_check::where('aplication_rating_id', $aplication_rating->id)
            ->where('question_varian_id', 1)->first();
        if ($performance_check == null) {
            return redirect()->route('aplication_ratings.essay_groups.index', $aplication_rating)
                ->with('status', $aplication_rating->rating->rating . ' group essay added successfully, next set performance check menu');
        } else {
            $essay_group = Essay_group::where('aplication_rating_id', $aplication_rating->id)->get();
            $quantity = $essay_group->sum('quantity');
            Performance_check::where('id', $performance_check->id)
                ->update([
                    'quantity' => $quantity
                ]);
            return redirect()->route('aplication_ratings.essay_groups.index', $aplication_rating)
                ->with('status', $aplication_rating->rating->rating . ' group essay added successfully, and performance check updated automatically');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Essay_group  $essay_group
     * @return \Illuminate\Http\Response
     */
    public function show(Essay_group $essay_group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Essay_group  $essay_group
     * @return \Illuminate\Http\Response
     */
    public function edit(Aplication_rating $aplication_rating, Essay_group $essay_group)
    {
        return view('super/manageQuestions/essay/essay_groupEdit', compact('aplication_rating', 'essay_group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Essay_group  $essay_group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aplication_rating $aplication_rating, Essay_group $essay_group)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
            'group' => 'required|max:100',
        ]);

        Essay_group::where('id', $essay_group->id)
            ->update([
                'quantity' => $request->quantity,
                'group' => $request->group
            ]);
        $performance_check = Performance_check::where('aplication_rating_id', $aplication_rating->id)
            ->where('question_varian_id', 1)->first();
        if ($performance_check == null) {
            return redirect()->route('aplication_ratings.essay_groups.index', $aplication_rating)
                ->with('status', $aplication_rating->rating->rating . ' group essay edited successfully, next set performance check');
        } else {
            $essay_group = Essay_group::where('aplication_rating_id', $aplication_rating->id)->get();
            $quantity = $essay_group->sum('quantity');
            Performance_check::where('id', $performance_check->id)
                ->update([
                    'quantity' => $quantity
                ]);
            return redirect()->route('aplication_ratings.essay_groups.index', $aplication_rating)
                ->with('status', $aplication_rating->rating->rating . ' group essay edited successfully and performance check updated automatically');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Essay_group  $essay_group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aplication_rating $aplication_rating, Essay_group $essay_group)
    {
        $essay = Essay::where('essay_group_id', $essay_group->id)->get();
        $performance_check = Performance_check::where('aplication_rating_id', $aplication_rating->id)
            ->where('question_varian_id', 1)->first();

        if ($essay->isEmpty()) {
            Essay_group::destroy($essay_group->id);
        } else {
            foreach ($essay as $essay) {
                $essay_id[] = $essay->id;
            }
            for ($i = 0; $i < count($essay_id); $i++) {
                Essay::where('id', $essay_id[$i])
                    ->update([
                        'essay_group_id' => ""
                    ]);
            }

            Essay_group::destroy($essay_group->id);
        }
        $essay_group = Essay_group::where('aplication_rating_id', $aplication_rating->id)->get();
        if ($essay_group->isEmpty()) {
            Performance_check::where('id', $performance_check->id)
                ->update([
                    'quantity' => 0
                ]);
        } else {
            $quantity = $essay_group->sum('quantity');
            Performance_check::where('id', $performance_check->id)
                ->update([
                    'quantity' => $quantity
                ]);
        }
        return redirect()->route('aplication_ratings.essay_groups.index', $aplication_rating)->with('status', $aplication_rating->rating->rating . ' question deleted successfully');
    }
}
