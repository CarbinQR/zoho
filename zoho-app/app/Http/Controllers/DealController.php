<?php

namespace App\Http\Controllers;

use App\Actions\Auth\GetAccessCredentialsAction;
use App\Actions\Deal\CreateDealAction;
use App\Actions\Deal\CreateDealRequest;
use App\Actions\Task\CreateTaskWithRelationAction;
use App\Actions\Task\CreateTaskWithRelationRequest;
use App\Constant\RecordConstant;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DealController extends Controller
{
    public function createDealWithTaskRelation(
        GetAccessCredentialsAction $getAccessCredentialsAction,
        CreateDealAction $createDealAction,
        CreateTaskWithRelationAction $createTaskWithRelationAction
    ): RedirectResponse {
        $accessCredentials = $getAccessCredentialsAction->execute();

        $dealId = $createDealAction->execute(
            new CreateDealRequest(
                $accessCredentials->getAccessToken(),
                $accessCredentials->getApiDomain()
            )
        )->getRecordId();

        $createTaskWithRelationAction->execute(
            new CreateTaskWithRelationRequest(
                $accessCredentials->getAccessToken(),
                $accessCredentials->getApiDomain(),
                $dealId,
                RecordConstant::NAMES['DEAL']
            )
        )->getRecordId();

        return redirect()->route('index')->with('success', 'Записи созданы');
    }
}

