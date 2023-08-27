<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Member;
use App\Models\subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscribe::with('members', 'investments')->whereHas('members', function ($query) {
            $query->where('type', 'subscriber');
        })->get();
        return response()->view('subscribes.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = DB::table('members')
            ->select('id', 'name', 'type')
            ->where('type', 'subscriber')
            ->get();
        $investments = DB::select('SELECT `id`, `name` FROM `investments`');
        return view('subscribes.create', compact('members', 'investments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator =
            $request->validate([
                'member_id' => 'required',
                'investment_id' => 'required',
                'value' => 'required|numeric',
                // 'date' => 'required|date_format:Y-m-d|after_or_equal:today',
                'date' => 'required|date_format:Y-m-d|',
            ]);
        $subscribe = new subscribe;
        $subscribe->name = $request->input('name');
        $subscribe->date = $request->input('date');
        $subscribe->member_id = $request->input('member_id');
        $subscribe->value = $request->input('value');
        $subscribe->investment_id = $request->input('investment_id');
        $investment = Investment::find($request->input('investment_id'));
        $investment->total += $subscribe->value;
        $saved = $subscribe->save();
        if ($saved) {
            $save = $investment->save();
            if ($save) {
                return redirect()->route('subscribes.index')->with('msg', 'ثم إنشاء إشتراك بنجاح')->with('type', 'success');
            } else {
                return redirect()->back()->with('msg', 'لم يتم إنشاء إشتراك')->with('type', 'danger');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(subscribe $subscribe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subscribe = Subscribe::findOrFail($id);
        $members = DB::select('SELECT `id`, `name` , `type`FROM `members` ');
        $subscribe = $subscribe->load('members');
        $investments = DB::select('SELECT `id`, `name` , `total`  FROM `investments`');
        $subscribe = $subscribe->load('investments');
        return view('subscribes.edit', compact('subscribe', 'members', 'investments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator =
            $request->validate([
                'member_id' => 'required',
                'value' => 'required|numeric',
                'date' => 'required|',
            ]);
        $subscribe = subscribe::findOrFail($id);
        $subscribe->value = $request->input('value');
        $subscribe->date = $request->input('date');
        $subscribe->member_id = $request->input('member_id');
        $saved = $subscribe->save();
        if ($saved) {
            return redirect()->route('subscribes.index')->with('msg', 'ثم تحديث الإشتراك بنجاح')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'لم يتم تحديث الإشتراك')->with('type', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subscribe = subscribe::findOrFail($id);
        $deleted = $subscribe->delete();
        if ($deleted) {
            return redirect()->back()->with('msg', 'ثم حذف الإشتراك بنجاح')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'لم يتم حذف الإشتراك')->with('type', 'danger');
        }
    }
}
