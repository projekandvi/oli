<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;
use App\Customer;
use App\Http\Requests\LeadRequest;

class LeadController extends Controller
{
    private $searchParams = ['nama_lead'];

    public function getIndex(Request $request){        
        $leads = Lead::orderBy('nama_lead', 'asc');
            
        if ($request->get('nama_lead')) {
            $leads->where(function($q) use($request) {
                $q->where('nama_lead', 'LIKE', '%' . $request->get('nama_lead') . '%');
            });
        }
        return view('lead.indexLead')->withleads($leads->paginate(20));
    }

    public function postIndex(Request $request) {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('LeadController@getIndex', $params);
    }

    public function getNewLead () {
        $lead = new Lead;
        return view('lead.form', compact('lead'));
    }

    public function postLead(LeadRequest $request, Lead $lead)
    {
        $lead->nama_lead = $request->get('nama_lead');
        $lead->tanggal_lahir = $request->get('tanggal_lahir');
        $lead->alamat = $request->get('alamat');
        $lead->no_telp = $request->get('no_telp');
        $lead->no_hp = $request->get('no_hp');    
        $lead->email = $request->get('email');
        $lead->save();

        $message = 'changes saved';
        return redirect()->route('lead.index')->withMessage($message);
    }

    public function convert(LeadRequest $request, Lead $lead){
        $data['nama_customer'] = $lead->nama_lead;
        $data['no_ktp'] = $lead->nik_lead;
        $data['alamat'] = $lead->alamat_lead;
        $data['alamat_pemasangan'] = $lead->alamat_lead;
        $data['no_telp'] = $lead->no_telp_lead;
        $data['no_hp'] = $lead->no_hp_lead;
        $data['email'] = $lead->email_lead;
        Customer::create($data);

        $lead->delete();

        $message = 'changes saved';
        return redirect()->route('lead.index')->withMessage($message);
    }

    public function getEditLead(Lead $lead){ 
        return view('lead.form')->withLead($lead);  
    }

    public function getLeadDetails(Lead $lead){   
        return view('lead.detailLeads')->withLead($lead);
    }

    public function deleteLead(Lead $lead){
        $lead->delete();
        $message = 'Deleted';
        return redirect()->back()->withMessage($message);
    }
}
