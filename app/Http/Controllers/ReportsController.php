<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requirement;
use App\Models\RequirementDetail;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendingTasksCount = Requirement::where('status', 0)->count();
        $inProgressTasksCount = Requirement::where('status', 1)->count();
        $completedTasksCount = Requirement::where('status', 2)->count();

        $tasksByArea = Requirement::select('area_id', DB::raw('count(*) as total'))
                                ->with('area')
                                ->groupBy('area_id')
                                ->get();

        $totalTasksCount = $tasksByArea->sum('total');

        $tasks = Requirement::with('area')->get();
        $requirements = Requirement::with(['user', 'area', 'devUser'])->get();
        $objetc = Requirement::all();
        $currentUser = auth()->user();

        // Calcular el tiempo promedio de las tareas completadas
        $averageCompletionTime = Requirement::where('status', 2)
            ->select(DB::raw('AVG(TIMESTAMPDIFF(SECOND, created_at, updated_at)) as avg_time'))
            ->first()
            ->avg_time;

        // Convertir el tiempo promedio de segundos a un formato más legible (horas, minutos, segundos)
        $averageCompletionTime = gmdate('H:i:s', $averageCompletionTime);

        // Obtener la cantidad de tareas asignadas a cada dev_user_id y el nombre del desarrollador
        $tasksByDevUser = Requirement::select('dev_user_id', DB::raw('count(*) as total'))
                                    ->with('devUser')
                                    ->groupBy('dev_user_id')
                                    ->get();

        return view('reports.index', compact('inProgressTasksCount', 'completedTasksCount', 'pendingTasksCount', 'tasksByArea', 'totalTasksCount', 'tasks', 'objetc', 'currentUser', 'averageCompletionTime', 'tasksByDevUser'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
