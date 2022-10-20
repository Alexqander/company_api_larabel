<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donations;

class DonationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donations = Donations::orderBy('created_at', 'DESC')->get();
        return [
            "status" => true,
            "message" => 'Request Successfully',
            "data" => $donations
        ];
    }

    function compare_donation($don, $pay)
    {
        if ($don != $pay) {
            return 'WRONG';
        } else {
            return 'SUCCESFUL';
        }
    }
    function createReference()
    {
        date_default_timezone_set('America/Mexico_City');
        $ref = "REF";
        $padding = "000";
        $num = rand(0, 99);
        $dia = date("d");
        $mes = date("m");
        $año = date("y");
        $horas = date("s");
        return $ref . $padding . $num . $dia . $mes . $año . $horas;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $donation = new Donations();
        $donation->reference = $this->createReference();
        $donation->amount = $request->amount;
        $donation->amount_paid = 0.0;
        $donation->payment_status = 'pending';
        $donation->save();
        return [
            "status" => true,
            "message" => "Donation register",
            "data" => $donation
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donation = Donations::findOrFail($id);
        return [
            "status" => true,
            "message" => "Request Successfully",
            "data" => $donation
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *  @param  \App\Models\Donations $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $donation)
    {
        $donation->amount = $request->amount;
        $donation->amount_paid = $request->amount_paid;
        $donation->payment_status = $this->compare_donation($donation->amount, $donation->amount_paid);
        $donation->update();
        return [
            "status" => true,
            "message" => 'Donation Has been Update',
            "data" => $donation
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Donations::destroy($id);
        return [
            "status" => true,
            "message" => "Donation destroy"
        ];
    }
}
