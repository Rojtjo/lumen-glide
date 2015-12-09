<?php

namespace Rojtjo\LumenGlide;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use League\Glide\Server;
use League\Glide\Signatures\Signature;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ImageController extends Controller
{
    /**
     * @var Server
     */
    private $server;

    /**
     * @var Signature
     */
    private $signature;

    /**
     * @var bool
     */
    private $secure;

    /**
     * @param Server $server
     * @param Signature $signature
     * @param bool $secure
     */
    public function __construct(Server $server, Signature $signature, $secure = true)
    {
        $this->server = $server;
        $this->signature = $signature;
        $this->secure = (bool) $secure;
    }

    /**
     * @param Request $request
     * @param string $path
     * @return StreamedResponse
     */
    public function show(Request $request, $path)
    {
        $params = $request->query();

        if ($this->secure) {
            $this->signature->validateRequest($path, $params);
        }

        return $this->server->getImageResponse($path, $params);
    }
}
