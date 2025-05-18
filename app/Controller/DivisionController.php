<?php

namespace Controller;

use Model\Division;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class DivisionController
{
    public function list(): string
    {
        $divisions = Division::all();
        return (new View())->render('site.divisions', ['divisions' => $divisions]);
    }

    public function add(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'title' => ['required'],
                'division_type' => ['required']
            ]);

            if (!$validator->fails()) {
                Division::create($request->all());
                app()->route->redirect('/divisions');
            }
        }
        return (new View())->render('site.divisions-add');
    }
}