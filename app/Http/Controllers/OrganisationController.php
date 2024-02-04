<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use App\Http\Requests\OrganisationStoreRequest;
use App\Helpers\ResponseHelper;

class OrganisationController extends Controller
{
    /**
     * @var
     */
    protected $user;

    public function __construct()
    {
        if (!$this->user = auth()->guard('api')->user()) {
            return response()->json(['error' => 403], 403);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Organisation::where('account_id', $this->user->account_id)->get();

            return ResponseHelper::success('All organisations.', $data);
        }
        catch(\Exception $e) {

            return ResponseHelper::error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganisationStoreRequest $request)
    {
        $data = $request->validated();

        try {
            $organisation = Organisation::create($data);

            return ResponseHelper::success('Success. Organisation created.', $organisation);
        }
        catch(\Exception $e) {

            return ResponseHelper::error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organisation $organisation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organisation $organisation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organisation $organisation)
    {
        //
    }
}
