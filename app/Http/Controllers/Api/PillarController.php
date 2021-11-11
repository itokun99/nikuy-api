<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pilar;
use App\Http\Resources\PillarDetailResource;

class PillarController extends Controller
{
    //
    public function getById(Request $request, $id = null)
    {
        try {
            $valid = $this->validateMembership($request);

            if (!$valid) {
                return $this->responseError("Not Found", 404);
            }

            $data = Pilar::with(['kursus'])
                ->where('id_pilar', $id)
                ->whereIn('kondisi', ['POSTING'])
                ->first();

            if (!$data) {
                return $this->responseError('Not Found', 404, [
                    "message" => ["Course Not Found"]
                ]);
            }

            return $this->responseSuccess("Successfully", 200, new PillarDetailResource($data));
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }
}
