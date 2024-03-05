<?php
namespace App\Http\Controllers\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdateUserRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Account\AccountService;
use OpenApi\Attributes as OAT;

class UserChangeDataController extends Controller
{
    public function __construct(private AccountService $accountService){}
    #[OAT\Put(
        tags: ['account'],
        path: '/api/account/update-user',
        summary: 'Update user data (auth Bearer)',
        operationId: 'api.account.update.user',
        requestBody: new OAT\RequestBody(
            required: true,
            description: "update data is not required some",
            content: new OAT\JsonContent(
                properties: [
                    new OAT\Property(
                        property: 'user_id',
                        type: 'int',
                        example: '22'
                    ),
                    new OAT\Property(
                        property: 'name',
                        type: 'string',
                        example: 'REcountsx'
                    ),
                    new OAT\Property(
                        property: 'password',
                        type: 'password',
                        example: 'qwerty123'
                    ),
                ]
            )
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Admin his updated',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'status',
                            type: 'string',
                            example: 'Admin his updated'
                        ),
                    ]
                )
            ),
        ]
    )]
    public function __invoke(UpdateUserRequest $request) : BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $userData = ['user_id'=>$request->user_id, 'name'=>$request->name,'password' =>$request->password];

             $this->accountService->UpdateUserData($userData);

            return new BaseWithResponseResource(null,'Admin is updated','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

}
