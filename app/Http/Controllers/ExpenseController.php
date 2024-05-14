<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Leads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == 1)
        {
            $expenses = Expense::latest()->paginate(10);
        }
        else
        {
            $expenses = Expense::where('user_id', Auth::user()->id)->latest()->paginate(10);
            $cost = Leads::where('user_id', Auth::user()->id)->sum('amount_paid');
        }

        return view('expenses.index', compact('expenses', 'cost'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'expense_date' => 'required|date',
            'amount' => 'required|integer',
        ]);

        Expense::create($request->all());

        return redirect()->route('budget.index')->with('success', 'Budget Added Successfully.');
    }

    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'expense_date' => 'required|date',
            'amount' => 'required|integer',
        ]);

        $expense->update($request->all());

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
