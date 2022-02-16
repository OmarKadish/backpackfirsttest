<?php

namespace App\Http\Controllers\Admin\Charts;

use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Charts\student_in_class;

/**
 * Class ClassroomStudentsChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ClassroomStudentsChartController extends ChartController
{
    public function setup()
    {
        // $data = \App\Models\Classroom::with('students')->get()->count();
        $data = \App\Models\Classroom::select('classrooms.name')
        ->join('students', 'classrooms.id', '=', 'students.classroom_id')
        ->get();

        $chart = new student_in_class;
        $chart->labels($data->keys());
        $chart->dataset('classroom', 'bar', $data);
        return view('welcome', ['chart' => $chart]);

        
        // $widgets['before_content'][] = [
        //     'type' => 'div',
        //     'class' => 'row',
        //     'content' => [ // widgets
        //         [
        //             'type' => 'chart',
        //             'wrapperClass' => 'mt-4 col-md-12',
        //             // 'class' => 'col-md-12',
        //             'controller' => \App\Http\Controllers\Admin\Charts\ClassroomStudentsChartController::class,
        //             'content' => [
        //                 'header' => 'Students', // optional
        //                  'body' => 'This chart should make it obvious', // optional
        //             ]
        //         ],
        //     ],
        // ];
        

        // $this->chart = new Chart();

        // // MANDATORY. Set the labels for the dataset points
        // $this->chart->labels([
        //     'Today',
        // ]);

        // // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        // $this->chart->load(backpack_url('charts/classroom-students'));

        // // OPTIONAL
        // // $this->chart->minimalist(false);
        // // $this->chart->displayLegend(true);
    }

    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return json
     */
    // public function data()
    // {
    //     $users_created_today = \App\User::whereDate('created_at', today())->count();

    //     $this->chart->dataset('Users Created', 'bar', [
    //                 $users_created_today,
    //             ])
    //         ->color('rgba(205, 32, 31, 1)')
    //         ->backgroundColor('rgba(205, 32, 31, 0.4)');
    // }
}