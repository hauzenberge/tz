<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Company;
use App\Worker;

class CompanyController extends Controller
{
    public function index(){        
    	return view('company.index', [
    		'companies' => Company::all(),
    	]);
    }
    /**
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id){
       // dd(Worker::where('compny_id', '=', $id)->first());
        $worker = Worker::where('compny_id', '=', $id)->first();
        $worker->delete();
    	$company = Company::find($id);
    	$company->delete();
    	return redirect('/company');
    }

    /**
     * Create new task
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
    	$compan = new Company();    	
    	$compan->name = $request->input('name');
    	$compan->email = $request->input('email');
    	$compan->logo = $request->input('logo');
    	$compan->site = $request->input('site');
    	$compan->save();
		
    	return redirect('/company');
    }

    public function edit($id){
        //dd(Company::find($id));
    	return view('company.edit',[
    		'company' => Company::find($id),
    	]);
    }

    public function update($id, Request $request){
    	$compan = Company::where('id', '=', $id)->first();   	
    	$compan->name = $request->input('name');
    	$compan->email = $request->input('email');
    	$compan->logo = $request->input('logo');
    	$compan->site = $request->input('site');
    	$compan->save();
    	return redirect('/company');
    }
}
