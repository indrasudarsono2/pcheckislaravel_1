<?php

namespace App\Http\Controllers\super;

use App\Aplication_file;
use App\Aplication_rating;
use App\Form_rating;
use App\Http\Controllers\Controller;
use App\Mc_question;
use App\Score;
use App\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function show_statistic(Session $session, Aplication_rating $aplication_rating)
    {
        $aplication_file = Aplication_file::where('session_id', $session->id)->get();
        if ($aplication_file->isEmpty()) {
            return redirect()->route('sessions.aplication_ratings.index_statistic', $session)->with('alert', 'No data available !');
        }
        foreach ($aplication_file as $aplication_file) {
            $af_id[] = $aplication_file->id;
        }

        $form_rating = Form_rating::whereIn('aplication_file_id', $af_id)
            ->where('rating_id', $aplication_rating->rating_id)->get();
        if ($form_rating->isEmpty()) {
            return redirect()->route('sessions.aplication_ratings.index_statistic', $session)->with('alert', 'No data available !');
        }
        foreach ($form_rating as $form_rating) {
            $fr_id[] = $form_rating->id;
        }
        

        $score = Score::whereIn('form_rating_id', $fr_id)->get();
        if ($score->isEmpty()) {
            return redirect()->route('sessions.aplication_ratings.index_statistic', $session)->with('alert', 'No data available !');
        }
        foreach ($score as $score) {
            $score_id[] = $score->id;
        }

        $score_id_implode = implode(",", $score_id);

        $statistic = DB::select(DB::raw("SELECT a.id, a.question, b.id, b.mc_question_id, b.answer, b.score_id,
                                COUNT(b.mc_question_id) AS appear,
                                COUNT(IF(a.key LIKE b.answer, b.answer, NULL)) AS correct,
                                ROUND((COUNT(IF(a.key LIKE b.answer, b.answer, NULL))/COUNT(b.mc_question_id))*100,2) AS persentage
                                FROM mc_questions AS a, mc_corrections AS b
                                WHERE a.id = b.mc_question_id AND b.score_id In ($score_id_implode)
                                GROUP BY a.id
                                ORDER BY persentage ASC"));


        return view('super.statistic.statistic', compact('session', 'aplication_rating', 'statistic'));
    }

    public function show_statistic_detail(Session $session, Aplication_rating $aplication_rating, Mc_question $statistic)
    {
        $aplication_file = Aplication_file::where('session_id', $session->id)->get();
        if ($aplication_file->isEmpty()) {
            return redirect()->route('sessions.aplication_ratings.index_statistic', $session)->with('alert', 'No data available !');
        }
        foreach ($aplication_file as $aplication_file) {
            $af_id[] = $aplication_file->id;
        }

        $form_rating = Form_rating::whereIn('aplication_file_id', $af_id)
            ->where('rating_id', $aplication_rating->rating_id)->get();
        foreach ($form_rating as $form_rating) {
            $fr_id[] = $form_rating->id;
        }

        $score = Score::whereIn('form_rating_id', $fr_id)->get();
        if ($score->isEmpty()) {
            return redirect()->route('sessions.aplication_ratings.index_statistic', $session)->with('alert', 'No data available !');
        }
        foreach ($score as $score) {
            $score_id[] = $score->id;
        }
        $score_id_implode = implode(",", $score_id);

        $stat_detail = DB::select(DB::raw("SELECT *,
                        COUNT(id) AS appear,
                        COUNT(answer) AS selected_answer,
                        ROUND((COUNT(answer)/(SELECT COUNT(*) FROM mc_corrections WHERE mc_question_id='$statistic->id'))*100,2) AS persentage
                        FROM mc_corrections
                        WHERE mc_question_id='$statistic->id' AND score_id In ($score_id_implode)
                        GROUP BY answer
                        ORDER BY answer ASC"));
        if ($stat_detail == null) {
            return redirect()->route('sessions.aplication_ratings.index_statistic', $session)->with('alert', 'No data available !');
        }

        return view('super.statistic.stat_detail', compact('session', 'aplication_rating', 'statistic', 'stat_detail'));
    }
}
