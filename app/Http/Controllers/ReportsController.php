<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Investment;
use App\Models\Member;
use App\Models\Supervisor;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function members()
    {
        $members = Member::all();
        $members = $members->load('supervisor');
        $pdf = PDF::loadView('reports.members.members', compact('members'));
        return $pdf->stream();
        // return $pdf->download('members.pdf');
    }
    public function membersSubscribes($id){
        $member = Member::findOrFail($id);
        $member = $member->load('subscribes','subscribes.investments');
        $pdf = PDF::loadView('reports.members.MembersSubscribes', compact('member'));
        return $pdf->stream();
        // return $pdf->download('members.pdf');
    }

    public function investments(){
        $investments = Investment::all();
        $investments = $investments->load('subscribers','expenses');
        $pdf = PDF::loadView('reports.investments.investment', compact('investments'));
        return $pdf->stream();
        // return $pdf->download('members.pdf');
    }
    public function expenses(){
        $expenses = Expense::all();
        $expenses = $expenses->load('investment','expense_field');
        $pdf = PDF::loadView('reports.investments.expenses', compact('expenses'));
        return $pdf->stream();
        // return $pdf->download('members.pdf');
    }
    public function supervisors(){
        $supervisors = Supervisor::all();
        $supervisors = $supervisors->load('members','members.subscribes');
        $pdf = PDF::loadView('reports.supervisors.index', compact('supervisors'));
        return $pdf->stream();
        // return $pdf->download('members.pdf');
    }
}
