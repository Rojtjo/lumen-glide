<?php

namespace Rojtjo\LumenGlide;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use League\Glide\Server;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ImageController extends Controller
{
    /**
     * @var Server
     */
    private $server;

    /**
     * @param Server $server
     */
    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    /**
     * @param Request $request
     * @param string $path
     * @return StreamedResponse
     */
    public function show(Request $request, $path)
    {
        $params = $request->query();

        return $this->server->getImageResponse($path, $params);
    }
}
