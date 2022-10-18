<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Queue\Worker;
use App\Models\workers;

class WorkersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = workers::orderBy("created_at", 'DESC')->get();
        return [
            "status" => true,
            "message" => "Peticion realizada",
            "data" => $workers
        ];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request)
    {
        function getCategory($salary)
        {
            $categorias = ['A', 'B', 'C'];
            if ($salary < 7000) {
                return $categorias[0];
            }
            if ($salary >= 7000 && $salary < 12000) {
                return $categorias[1];
            }
            if ($salary > 12000) {
                return $categorias[2];
            }
        }

        $workers = new workers();
        $workers->name = $request->name;
        $workers->last_name = $request->last_name;
        $workers->email = $request->email;
        $workers->job_title = $request->job_title;
        $workers->salary = $request->salary;
        $salaryt = $workers->salary * 0.84;
        $workers->salary_taxes = $salaryt;
        $workers->category = getCategory($salaryt);
        $workers->save();
        return [
            "status" => true,
            "message" => "Trabajador registrado",
            "data" => $workers
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
        $worker = workers::findOrFail($id);
        return [
            "status" => true,
            "message" => "Trabajador encontrado",
            "data" => $worker
        ];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\workers $workers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, workers $workers)
    {
        function getCategoryU($salary)
        {
            $categorias = ['A', 'B', 'C'];
            if ($salary < 7000) {
                return $categorias[0];
            }
            if ($salary >= 7000 && $salary < 12000) {
                return $categorias[1];
            }
            if ($salary > 12000) {
                return $categorias[2];
            }
        }
        $workers->name = $request->name;
        $workers->last_name = $request->last_name;
        $workers->email = $request->email;
        $workers->salary = $request->salary;
        $salaryt = $workers->salary * 0.84;
        $workers->salary_taxes = $salaryt;
        $workers->category = getCategoryU($salaryt);
        $workers->update();
        return [
            "status" => true,
            "message" => ' Your blog has been updated!',
            "data" => $workers
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
        workers::destroy($id);
        return [
            "status" => true,
            "message" => "Trabajador eliminado"
        ];
    }
}
