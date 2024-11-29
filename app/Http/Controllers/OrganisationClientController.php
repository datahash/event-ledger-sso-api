<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use App\Http\Requests\OrganisationStoreRequest;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Session;

class OrganisationClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Organisation::where('account_id', session()->get('account_id'))->get();

            return ResponseHelper::success('All organisations', $data);
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

            return ResponseHelper::success('Organisation created', $organisation);
        }
        catch(\Exception $e) {

            return ResponseHelper::error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $organisation = Organisation::find($id);

            return ResponseHelper::success('Organisation', $organisation);
        }
        catch(\Exception $e) {

            return ResponseHelper::error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrganisationStoreRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(OrganisationStoreRequest $request, $id)
    {
        $data = $request->validated();

        try {
            $organisation = Organisation::find($id);
            $organisation->update($data);

            return ResponseHelper::success('Success. Organisation updated.', $organisation);
        }
        catch(\Exception $e) {

            return ResponseHelper::error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $organisation = Organisation::find($id);
            $organisation->delete();

            return ResponseHelper::success('Organisation deleted', null);
        }
        catch(\Exception $e) {

            return ResponseHelper::error($e->getMessage(), $e->getCode());
        }
    }
}
