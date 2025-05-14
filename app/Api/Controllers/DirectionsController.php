<?php

namespace App\Api\Controllers;

use App\Api\Requests\CreateDirectionRequest;
use App\Api\Requests\UpdateDirectionRequest;
use App\Domain\Actions\Directions\CreateDirection;
use App\Domain\Actions\Directions\DeleteDirection;
use App\Domain\Actions\Directions\GetDirections;
use App\Domain\Actions\Directions\UpdateDirection;
use App\Domain\Directions\Model\Diractions;
use Illuminate\Http\Request;

class DirectionsController extends Controller
{

    public function index(GetDirections $getDirections)
    {
        return $getDirections->handle();
    }

    public function store(CreateDirectionRequest $request , CreateDirection $createDirection)
    {
        return $createDirection->handle($request);
    }

    public function update(UpdateDirectionRequest $request , UpdateDirection $updateDirection , $id)
    {
        return $updateDirection->handle($request , $id);
    }

    public function destroy(DeleteDirection $deleteDirection , $id)
    {
        return $deleteDirection->handle($id);
    }
}
