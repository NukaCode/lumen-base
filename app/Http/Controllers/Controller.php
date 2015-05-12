<?php namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use League\Fractal\Manager;

class Controller extends BaseController
{

    /* @var Manager */
    protected $fractal;

    public function __construct()
    {
        $this->fractal = new Manager();

        // Grab any includes from the request.
        if (isset($_GET['include'])) {
            $this->fractal->parseIncludes($_GET['include']);
        }
    }

    /**
     * Overload the ValidatesRequests method to format the errors for JSON consumption.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  array                    $errors
     *
     * @return \Illuminate\Http\Response
     */
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        return new JsonResponse(['errors' => ['validation' => $errors]], 422);
    }
}
