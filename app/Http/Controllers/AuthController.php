<?php

namespace App\Http\Controllers;

use Ellaisys\Cognito\AwsCognitoClaim;
use Ellaisys\Cognito\Auth\AuthenticatesUsers as CognitoAuthenticatesUsers;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use App\Http\Requests\AuthLoginRequest;
use App\Models\User;

class AuthController extends Controller
{
    use CognitoAuthenticatesUsers;

     /**
     * Authenticate User
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(AuthLoginRequest $request)
    {
        $collection = collect($request->all());

        // Authenticate with Cognito Package Trait (with 'api' as the auth guard)
        if ($claim = $this->attemptLogin($collection, 'api', 'username', 'password', true)) {

            if ($claim instanceof AwsCognitoClaim) {

                return ResponseHelper::success('Authentication successful', $claim->getData());
            }
            else {

                return ResponseHelper::error($claim, 400);
            }
        }
    }

    /**
     * Get logged in user profile.
     *
     * @return JsonResponse
     */
    protected function profile()
    {
        try {
            $user =  auth()->guard('api')->user();

            return ResponseHelper::success('Get user profile successful', $user);
        }
        catch (\Exception $e) {

            return ResponseHelper::error($e->getMessage(), $e->getCode());
        }
    }
}
