<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice = Invoice::create([
            'user_id' => $request->user_id,
            'nomor_faktur' => $request->nomor_faktur,
            'tanggal_jatoh_tempo' => $request->tanggal_jatoh_tempo,
        ]);

        foreach ($request->items as $item) {
            Item::create([
                'invoice_id' => $invoice->id,
                'nama_barang' => $item['nama_barang'],
                'quantity' => $item['quantity'],
                'harga' => $item['harga'],
            ]);
        }

        $invoice->total = $invoice->items->sum('quantity') * $invoice->items->sum('price');
        $invoice->save();

        return response()->json([
            'data' => $invoice,
            'status' => 200,
            'message' => 'Created Invoice Success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Invoice::find($id);
        if(!$data){
            return  response()->json([
                'status' => 404,
                'message' => 'Data Kosong'
            ]);
        }
        return  response()->json([
            'status' => 200,
            'message' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->fill($request->all());
        $invoice->save();

        return  response()->json([
            'status' => 200,
            'message' => 'Berhasil Berhasil Diupdate !'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Invoice::findOrFail($id);

        $data->delete();

        return  response()->json([
            'status' => 200,
            'message' => 'Data Berhasil Dihapus !'
        ]);
    }
}
