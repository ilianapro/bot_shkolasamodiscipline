<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\motivator;

class MotivatorsController extends Controller
{

    public function index()
    {
        $data['title']     = 'Мотивашки';
        $data['motivators'] = motivator::get();
        return view('motivators',['data'=>$data]);
    }



    public function edit($id)
    {
        $data['motivator'] = motivator::findOrFail($id);
        //$data['motivators'] = motivator::get();
        $data['title'] = 'Редактирование текста мотивации ';
        return view('motivators_edit',['data'=>$data]);
    }

    public function update(Request $request, motivator $motivator)
    {
        //dd($motivator);
        $motivator->update(Request(['motivation','participant']));
        return redirect('/admin/motivators');
    }


    public function destroy($id)
    {
        //
    }
}
