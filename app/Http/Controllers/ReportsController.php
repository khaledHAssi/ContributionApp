<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Investment;
use App\Models\Member;
use App\Models\Supervisor;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
use Illuminate\Http\Request;
use App\Models\Subscribe;
use DateTime;
use Carbon\Carbon;

class ReportsController extends Controller
{
    /**
     * Summary of members
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function members()
    {
        $members = Member::all();
        $members = $members->load('supervisor');
        $pdf = PDF::loadView('reports.members.members', compact('members'));
        return $pdf->stream();
        // return $pdf->download('members.pdf');
    }
    /**
     * Summary of membersSubscribes
     * @param mixed $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function membersSubscribes($id)
    {
        $member = Member::findOrFail($id);
        $type = $member->type;
        $member = $member->load('subscribes', 'subscribes.investments');
        $pdf = PDF::loadView('reports.members.MembersSubscribes', compact('member','type'));
        return $pdf->stream();
        // return $pdf->download('members.pdf');
    }
    /**
     * Summary of investments
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function investments()
    {
        $investments = Investment::all();
        $investments = $investments->load('subscribers', 'expenses');
        $pdf = PDF::loadView('reports.investments.investment', compact('investments'));
        return $pdf->stream();
        // return $pdf->download('members.pdf');
    }
    /**
     * Summary of expenses
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function expenses()
    {
        $expenses = Expense::all();
        $expenses = $expenses->load('investment', 'expense_field');
        $pdf = PDF::loadView('reports.investments.expenses', compact('expenses'));
        return $pdf->stream();
        // return $pdf->download('members.pdf');
    }
    /**
     * Summary of supervisors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function supervisors()
    {
        $supervisors = Supervisor::all();
        $supervisors = $supervisors->load('members', 'members.subscribes');
        $pdf = PDF::loadView('reports.supervisors.index', compact('supervisors'));
        return $pdf->stream();
        // return $pdf->download('members.pdf');
    }
    /**
     * Summary of supervisorMembers
     * @param mixed $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function supervisorMembers($id)
    {
        $supervisor = Supervisor::findOrFail($id);
        $supervisor = $supervisor->load('members', 'members.subscribes');
        $pdf = PDF::loadView('reports.supervisors.supervisorMembers', compact('supervisor'));
        return $pdf->stream();
        // return $pdf->download('members.pdf');
    }
    public function subscribesIndex()
    {
        return view('reports.subscribes.index');
    }
    public function search(Request $request)
    {
        // Validate input values
        $validatedData = $request->validate([
            'day' => 'required|integer',
            'month' => 'required|integer',
            'year' => 'required|integer',
        ]);

        $day = $validatedData['day'];
        $month = $validatedData['month'];
        $year = $validatedData['year'];

        // Perform the search
        $subscribers = Subscribe::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->whereDay('date', $day)
            ->with('members') // Eager load the "members" relationship
            ->get();

        // Check if subscribers were found
        if ($subscribers->isEmpty()) {
            return response()->json(['error' => 'No subscribers found'], 404);
        }

        // Return the found subscribers as JSON
        return response()->json($subscribers);
    }



    public function calculateRemainingAmount(Subscribe $subscriber)
    {
        // Find the associated member
        $member = Member::find($subscriber->member_id);

        // Check if the member exists
        if (!$member) {
            return response()->json(['error' => 'Member not found'], 404);
        }

        // Get the current date and time

        // Calculate the difference in months between the member's creation date and the current date
        $creationDate = new DateTime($member->created_at);
        $currentDate = new DateTime();
        $interval = $creationDate->diff($currentDate);
        $monthDiff = $interval->format('%m') + 12 * $interval->format('%y');

        // Calculate the total amount based on the contribution and month difference
        $contribution = $member->contributions;
        $totalAmount = $contribution * $monthDiff;
        $member = $member->load('subscribes');
        // Calculate the total amount paid by the member's subscriptions
        $totalPaid = 0;
        foreach ($member->subscribes as $subscription) {
            $totalPaid += $subscription->value;
        }

        // Calculate the remaining amount
        $remainingAmount = $totalAmount - $totalPaid;

        // Return the remaining amount as JSON
        return response()->json(['remaining_amount' => $remainingAmount]);
    }

    // public function subscribeSearchPdf(Request $request)
    // {
    //     // Your PDF generation logic here
    //     $html = view('reports.subscribers.index')->render();

    //     // Create a new PDF instance using the alias
    //     $pdf = PDF::loadHTML($html);

    //     // Optionally, you can customize PDF settings here
    //     $pdf->setPaper('A4');

    //     // Save the PDF to a file or return it as a response
    //     return $pdf->stream('subscriber_search_results.pdf');
    // }
}
