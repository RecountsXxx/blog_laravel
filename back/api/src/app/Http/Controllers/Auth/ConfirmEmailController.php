<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Account\AccountService;

class ConfirmEmailController extends Controller
{
    public function __construct(private AccountService $accountService)
    {
    }
    public function __invoke($id, $token)
    {
        try {
            $this->accountService->ConfirmEmail($id,$token);

            return redirect('/');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
