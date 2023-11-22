<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ChecklistItem;
use App\Http\Controllers\Controller;
use App\Models\Checklist;

class ChecklistItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($checklistId)
    {
        $data = Checklist::find($checklistId);
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $checklistId)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$checklistId)
    {
        $data = Checklist::create([

            $checklistId => $request->checklistId,
            $checklistId => $request->itemName,
    ]);
    return response()->json([
        'status' => 200,
        'message' =>$data
    ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChecklistItem  $checklistItem
     * @return \Illuminate\Http\Response
     */
    public function show(ChecklistItem $checklistItem,$checklistId)
    {
        $data = Checklist::find($checklistId);
        $data2 = ChecklistItem::find($checklistItem);
        if(!$data){
            return  response()->json([
                'status' => 404,
                'message' => 'Data Kosong'
            ]);
        }
        return  response()->json([
            'status' => 200,
            'message' => [
                $data,
                $data2
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChecklistItem  $checklistItem
     * @return \Illuminate\Http\Response
     */
    public function edit(ChecklistItem $checklistItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChecklistItem  $checklistItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChecklistItem $checklistItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChecklistItem  $checklistItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChecklistItem $checklistItem)
    {
        $data = Checklist::findOrFail($checklistItem);

        $data->delete();

        return  response()->json([
            'status' => 200,
            'message' => 'Data Berhasil Dihapus !'
        ]);
    }
}
