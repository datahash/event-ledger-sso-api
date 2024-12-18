<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Requests\AccountStoreRequest;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Str;

class AccountController extends Controller
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
            $data = Account::where('id', $this->user->account_id)->first();

            return ResponseHelper::success('Your account', $data);
        }
        catch(\Exception $e) {

            return ResponseHelper::error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountStoreRequest $request)
    {
        $data = $request->validated();

        $data->uuid = Str::uuid()->toString();

        try {
            $account = Account::create($data);

            return ResponseHelper::success('Account created', $account);
        }
        catch(\Exception $e) {

            return ResponseHelper::error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountStoreRequest $request, Account $account)
    {
        $data = $request->validated();

        try {
            $account->update($data);

            return ResponseHelper::success('Account updated', $account);
        }
        catch(\Exception $e) {

            return ResponseHelper::error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        try {
            $account->delete();

            return ResponseHelper::success('Account deleted', null);
        }
        catch(\Exception $e) {

            return ResponseHelper::error($e->getMessage(), $e->getCode());
        }
    }
}
