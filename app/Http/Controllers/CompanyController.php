<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\User;

class CompanyController extends Controller
{

    public function index()
    {
        return Company::all();
    }

    public function createCompany(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'bio' => 'required',
        ]);

        $request->request->add([
            'owner' => auth()->user()->id,
            'prof_pic' => '-',
            'cover_pic' => '-',
            'rating' => '1',
        ]);

        return Company::create($request->all());
        // return $request->all();
    }

    public function editCompany(Request $request, $company_id)
    {
        $request->validate([
            'name' => 'required',
            'bio' => 'required',
        ]);

        $current_company = Company::findOrFail($company_id);
        $current_company->update($request->all());
        return $current_company;
    }

    public function deleteCompany(Request $request, $company_id)
    {
        $current_event = Company::findOrFail($company_id);
        return $current_event->delete();
    }

    public function search($key)
    {
        return Company::where('name', 'like', '%' . $key . '%')
            ->orwhere('bio', 'like', '%' . $key . '%')
            ->get();
    }

    public function singleCompany(Request $request, $company_id)
    {
        return Company::findorfail($company_id);
    }



























    // 
}
