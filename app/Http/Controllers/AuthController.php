<?php

namespace App\Http\Controllers;

use Ellaisys\Cognito\AwsCognitoClaim;
use Ellaisys\Cognito\Auth\AuthenticatesUsers as CognitoAuthenticatesUsers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    use CognitoAuthenticatesUsers;

     /**
     * Authenticate User
     *
     * @throws \HttpException
     *
     * @return mixed
     */
    public function login(\Illuminate\Http\Request $request)
    {
        //Convert request to collection
        $collection = collect($request->all());

        //Authenticate with Cognito Package Trait (with 'api' as the auth guard)
        if ($claim = $this->attemptLogin($collection, 'api', 'username', 'password', true)) {
            if ($claim instanceof AwsCognitoClaim) {
                return $claim->getData();
            } else {
                return response()->json(['status' => 'error', 'message' => $claim], 400);
            }
        }
    }
}
