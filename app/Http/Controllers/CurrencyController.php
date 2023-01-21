<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware(['auth','admin','verified']);
    }

    public function index()
    {
        $currencies = Currency::get();

        return view('admin.currencies.index')->withCurrencies($currencies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currency = new Currency;

        $currency->name = $request->name;
        $currency->code = $request->code;

        $currency->save();
        Alert::success('Success','Successfully added narration');
      return redirect()->route('currency.index')->with(['success'=>"Currency Created Successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        return view('admin.currencies.update')->withCurrency($currency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        $currency = Currency::find($currency->id)->first();

        $currency->name = $request->name;

        $currency->save();
        Alert::success('Success','Successfully updated currency');
        return redirect()->route('currency.index')->with(['success'=>"Currency Updated Successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $currency->find($currency->id);
        $currency->delete();
        Alert::success('Success','Currency Deleted');
        return redirect()->route('currency.index')->with(['success'=>"Currency Deleted Successfully"]);
    }
}
