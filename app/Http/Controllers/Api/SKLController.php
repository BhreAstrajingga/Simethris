<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SKLResources;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Completed;
use Illuminate\Support\Str;


class SKLController extends Controller
{
	/**
	 * @OA\Get(
	 *      path="/getSKL/{no_ijin}",
	 *      operationId="getSKL",
	 *      tags={"SKL"},
	 *      summary="Get list of completed skl",
	 *      description="Returns list of skl",
	 *      security={{"simethrisToken": {}}},
	 *      @OA\Parameter(
	 *          name="no_ijin",
	 *          description="No ijin/Riph yg dicari datanya (* tanpa . & /)",
	 *          required=true,
	 *          in="path",
	 *          @OA\Schema(
	 *              type="string"
	 *          )
	 *      ),
	 *      @OA\Response(
	 *          response=200,
	 *          description="Successful operation",
	 *          @OA\JsonContent()
	 *       ),
	 *      @OA\Response(
	 *          response=401,
	 *          description="Unauthenticated"
	 *      ),
	 *      @OA\Response(
	 *          response=403,
	 *          description="Forbidden"
	 *      )
	 * )
	 */
	public function getSKL(Request $request)
	{

		$no_riph = $request->no_ijin;
		$nomor = Str::substr($no_riph, 0, 4) . '/' . Str::substr($no_riph, 4, 2) . '.' . Str::substr($no_riph, 6, 3) . '/' .
			Str::substr($no_riph, 9, 1) . '/' . Str::substr($no_riph, 10, 2) . '/' . Str::substr($no_riph, 12, 4);
		// var_dump($nomor);
		// $npwpriph = str_replace(['.', '-', '/'], '', $str);
		return new SKLResources(Completed::where('no_ijin', '=', $nomor)->get());
	}
}
