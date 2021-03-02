<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Worker;
use App\Company;

class WorkerController extends Controller
{
    public function index(){    	
    	return view('worker.index', [
    		'companies' => Company::all(),
    		'workers' => Worker::all(),
    	]);
    }

     /**
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id){
    	$worker = Worker::find($id);
    	$worker->delete();
    	return redirect('/worker');
    }


    public function add(){
    	return view('worker.add',[
    		'companies' => Company::all(),
    	]);
    }

    /**
     * Create new task
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
    	//dd($request->input());
    	$worker = new Worker();    	
    	$worker->name = $request->input('name');
    	$worker->first_name = $request->input('first_name');
    	$worker->email = $request->input('email');
    	$worker->phone = $request->input('phone');
    	$worker->compny_id = $request->input('company');
    	$worker->save();
		
    	return redirect('/worker');
    }

    public function edit($id){
    	$worker = Worker::find($id);
    	return view('worker.edit',[
    		'companies' => Company::all(),
    		'worker' => $worker,

    	]);
    }
    public function update($id, Request $request){
    	$worker = Worker::where('id', '=', $id)->first();   	
    	
    	$worker->name = $request->input('name');
    	$worker->first_name = $request->input('first_name');
    	$worker->email = $request->input('email');
    	$worker->phone = $request->input('phone');
    	$worker->compny_id = $request->input('company');
    	$worker->save();
		
    	return redirect('/worker');
    }
}
