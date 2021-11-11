<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\UserPaket;
use App\Models\PaketMember;
use App\Models\Kursus;
use App\Models\UserCourseProgress;
use App\Http\Resources\CourseDetailResource;

class CourseController extends Controller
{
  public function getById(Request $request, $id = null)
  {
    try {
      $valid = $this->validateMembership($request);

      if (!$valid) {
        return $this->responseError("Not Found", 404);
      }

      $course = Kursus::with(['paket'])
        ->where('id_kursus', $id)
        ->whereIn('kondisi', ['POSTING'])
        ->first();

      if (!$course) {
        return $this->responseError('Not Found', 404, [
          "message" => ["Course Not Found"]
        ]);
      }

      return $this->responseSuccess("Successfully", 200, new CourseDetailResource($course));
    } catch (\Exception $e) {
      return $this->serverError($e->getMessage());
    }
  }

  public function submitProgress(Request $request, $id = NULL)
  {
    try {
      $valid = $this->validateMembership($request);

      if (!$valid) {
        return $this->responseError("User not in membership", 400);
      }

      $user = $request->user;
      $existing = UserCourseProgress::where([
        'id_user' => $user->id_user,
        'id_kursus' => $id
      ])->first();

      if (!$existing) {
        UserCourseProgress::create([
          'id_user' => $user->id_user,
          'id_kursus' => $id
        ]);
      }
      return $this->responseSuccess("Progress submited", 201);
    } catch (\Exception $e) {
      return $this->serverError($e->getMessage());
    }
  }
}
