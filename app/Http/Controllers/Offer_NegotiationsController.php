<?php

namespace App\Http\Controllers;

use App\Models\Negotiations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Offer_NegotiationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $negotiations = Negotiations::latest()->paginate(5);
        return view('negotiations', compact('negotiations'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'price_submitted' => 'required',
                'quantity' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'bad request',
                    'message' => $validator->errors()
                ]);
            }
            Negotiations::create([
                'id_distributor' => $request->user_id,
                'id_penawaran' => $request->id_penawaran,
                'price_submitted' => $request->price_submitted,
                'quantity' => $request->quantity,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'data created success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'internal server error',
                'message' => $e->getMessage()
            ]);
        }

    }

    public function negotiationUpdate(Request $request,$id,$id_distributor){
        $negotiationsUpdate = Negotiations::where('id','=',$id)->where('id_distributor',$id_distributor)->update([
            'price_submitted' => $request->price_submitted,
        ]);

        return redirect()->route('negotiations.index')->with('success','negotions success send');
    }

    /**
     * Display the specified resource.
     */
    public function update(Request $request, $id)
    {
        Negotiations::where('id', '=', $id)->update([
            'price_submitted' => $request->price_submitted,
            'price_deal' => $request->price_deal,
            'date_approve_petani' => $request->date_approve_petani,
            'status_negotiation' => $request->status_negotiation
        ]);

        return redirect()->route('negotiations.index')->with('success','update success');
    }

    public function edit($id)
    {
        $data = Negotiations::where('id', '=', $id)->first();
        return view('negotiations.edit',['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Negotiations::where('id', '=', $id)->first();
        return view('negotiations.edit',['data'=> $data]);
    }
}
