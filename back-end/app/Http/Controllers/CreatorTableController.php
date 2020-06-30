<?php

namespace App\Http\Controllers;

use App\Models\CreatorTable;
use Illuminate\Http\Request;

class CreatorTableController extends Controller
{
    private $success = false;
    private $data = null;
    private $error = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $dataRes = CreatorTable::list();
            $this->data = $dataRes;
            $this->success = true;
        } catch (\Illuminate\Database\QueryException $ex) {
            \Log::error("[" . __METHOD__ . "][" . __LINE__ . "]" . "error" . $ex->getMessage());
            $this->error = $ex->getMessage();
            //$this->error = config('message.error.database');
        } catch (\Illuminate\Exception $ex) {
            \Log::error("[" . __METHOD__ . "][" . __LINE__ . "]" . "error" . $ex->getMessage());
            $this->error = $ex->getMessage();
            //$this->error = config('message.error.internal');
        }
        return $this->doResponse($this->success, $this->data, $this->error);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\CreatorTable  $creatorTable
     * @return \Illuminate\Http\Response
     */
    public function show(CreatorTable $creatorTable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\CreatorTable  $creatorTable
     * @return \Illuminate\Http\Response
     */
    public function edit(CreatorTable $creatorTable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\CreatorTable  $creatorTable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CreatorTable $creatorTable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\CreatorTable  $creatorTable
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreatorTable $creatorTable)
    {
        //
    }
}
