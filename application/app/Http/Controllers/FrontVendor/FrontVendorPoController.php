<?php

namespace App\Http\Controllers\FrontVendor;

use App\FrontVendorPo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VendorPo;
use Illuminate\Support\Facades\Storage;

class FrontVendorPoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $userId = $user->id;
        $cats = $user->fvendor;

        $pos = VendorPo::where('user_id', auth()->user()->id)->get();

        $payload = [
            'mainmenu_user' => 'active',
            'page_title' => 'PO',
            'pos' => $pos,
            
        ];
        return view('vendor-dashboard.po.index', compact('payload'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('front.vendorPo.index');
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('front.vendorPo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendorpo =  VendorPo::where('po_ref', $id)->first();
        $payload = [
            'mainmenu_user' => 'active',
            'page_title' => 'PO Details',
            'vendorpo' => $vendorpo,
        ];
        return view('vendor-dashboard.po.show', compact('payload'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $po = VendorPo::find($id);
        $payload = [
            'mainmenu_user' => 'active',
            'page_title' => 'Create Po',
            'po' => $po,
        ];

        return view('vendor-dashboard.po.edit', compact('payload'));

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
        $po = VendorPo::find($id);

        if ($request->hasFile('upload_qtn_copy')) {
            if($po->upload_qtn_copy != ""){
                Storage::delete('public/vendor/'.$po->upload_qtn_copy);   
             }
            $file = $request->file('upload_qtn_copy');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $po->upload_qtn_copy = $fileName;
        }
        
        if($request->hasFile('upload_po_copy')){
            if($po->upload_po_copy != ""){
                Storage::delete('public/vendor/'.$po->upload_po_copy);   
             }
            $file = $request->file('upload_po_copy');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $po->upload_po_copy = $fileName;

        }
        

        $po->po_ref = request('po_ref');
        $po->issuing_date = request('issuing_date');
        $po->qtn_ref_no = request('qtn_ref_no');
        $po->category = request('category');
        $po->total_value = request('total_value');
        $po->terms_condition = request('terms_condition');
        $po->payment_method = request('payment_method');
    
        $po->save();
       
        return redirect()->route('front.vendorPo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('front.vendorInvoice.index');
    }
}
