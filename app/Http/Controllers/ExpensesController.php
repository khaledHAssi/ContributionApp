<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Expense_field;
use App\Models\Investment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\error;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function master()
    {
        return view('master');
    }
    public function index()
    {
        //
        $expenses = Expense::all();
        $expenses = $expenses->load('investment', 'expense_field');
        return response()->view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $investments = Investment::all();
        $expense_fields = Expense_field::all();
        return view('expenses.create', compact('investments', 'expense_fields'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator =
            $request->validate([
                'name' => 'required|string|min:3|max:20|',
                'details' => 'required|string|min:20',
                'investment_id' => 'required|',
                'total_expenses' => 'required|numeric|',
            ]);
        $expenses = new Expense();
        $expenses->name = $request->input('name');
        $expenses->total_expenses = $request->input('total_expenses');
        $expenses->details = $request->input('details');
        $expenses->expenseField_id = $request->input('expenseField_id');
        // investment total ----------------------------------------------------------------
        $expenses->investment_id = $request->input('investment_id');
        $investment = Investment::find($request->input('investment_id'));
        if ($expenses->total_expenses <= $investment->total) {
            $investment->total -= $expenses->total_expenses;
        } else {
            return redirect()->back()->with('msg', 'total expense cannot be more than investment total')->with('type', 'danger');
        }
        $saved = $expenses->save();
        $save = $investment->save();
        if ($saved && $save) {
            return redirect()->route('expenses.index')->with('msg', 'تم إنشاء المصاريف بنجاح')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'لم يتم المصاريف')->with('type', 'danger');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Expense $expenses)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $expenses = Expense::find($id);
        $investments = DB::select('SELECT `id`, `name` , `total`FROM `investments` ');
        $expense_fields = DB::select('SELECT `id`, `name` ,`created_at` FROM `expense_fields` ');
        $expenses = $expenses->load('investment', 'expense_field');
        return view('expenses.edit', compact('expenses', 'investments', 'expense_fields'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validator =
            $request->validate([
                'name' => 'required|string|min:3|max:20|',
                'details' => 'required|string|min:20',
                'total_expenses' => 'required|numeric',
                'expenseField_id' => 'required|',
            ]);
        $investment = Investment::find($request->input('investment_id'));
        $expenses = Expense::findOrFail($id);
        $expenses->name = $request->input('name');
        $expenses->details = $request->input('details');
        $expenses->total_expenses = $request->input('total_expenses');
        $expenses->investment_id = $request->input('investment_id');
        $expenses->expenseField_id = $request->input('expenseField_id');
        $saved = $expenses->save();
        if ($saved) {
            return redirect()->route('expenses.index')->with('msg', 'تم تحديث المصاريف بنجاح')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', ' لم يتم تحديث المصاريف ')->with('type', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $expenses = Expense::findOrFail($id);

        $deleted = $expenses->delete();
        if ($deleted) {
            return redirect()->back()->with('msg', 'تم حذف المصاريف بنجاح')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'لم يتم حذف المصاريف')->with('type', 'danger');
        }
    }
}
