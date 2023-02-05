<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Communication Microservice",
     *      description="This allows you to communicate with telegram bot in a telegram channel",
     *      @OA\Contact(
     *          email="esekelvin24@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Communication Microservice "
     * )

     *
     * @OA\Tag(
     *     name="Projects",
     *     description="API Endpoints of Communication Microservice"
     * )

 *



     */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
