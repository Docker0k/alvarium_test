<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployesController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $employes = Employee::paginate(
            $request->input('limit', 10),
            '*',
            'page',
            $request->input('page', 1)
        )
            ->withQueryString();
        if (!$employes->count()) {
            return response()->view(
                'employees.import'
            );
        }
        return response()->view(
            'employees.index',
            [
                'employes' => $employes,
                'deps' => Department::all(),
                'active' => null
            ]
        );
    }

    /**
     * @param string $department
     * @param Request $request
     * @return Response
     */
    public function department(string $department, Request $request): Response
    {
        $dep = Department::where('alias', $department)
            ->pluck('id')
            ->toArray();
        if (!$dep) {
            return abort(404);
        }
        return response()->view(
            'employees.index',
            [
                'employes' => Employee::whereIn('department_id', $dep)
                    ->paginate(
                        $request->input('limit', 10),
                        '*',
                        'page',
                        $request->input('page', 1)
                    )
                    ->withQueryString(),
                'deps' => Department::all(),
                'active' => $department
            ]);
    }

    public function import(Request $request)
    {
        $xml = simplexml_load_string(file_get_contents($request->file('import')->getPathname()));
        $json = json_encode($xml);

        $array = json_decode($json, TRUE);
        $departments = $employees = [];
        foreach ($array as $entity => $items) {
            foreach ($items['item'] as $item){
                switch ($entity){
                    case 'departments':
                        $departments[] = $item;
                        break;
                    case 'employees':
                        $employees[] = $item;
                        break;
                }
            }
        }
        Department::insertOrIgnore($departments);
        $departments = Department::all()->pluck('id', 'alias')->toArray();

        $arr = [];
        foreach ($employees as $employee) {
            $employee['department_id'] = $departments[$employee['department']];
            unset($employee['department']);
            $arr[] = $employee;
        }
        Employee::insertOrIgnore($arr);
        return redirect(route('employes.index'));
    }
}
