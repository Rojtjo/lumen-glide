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
     * @var string
     */
    private $prefix;

    /**
     * @param Server $server
     * @param Signature $signature
     * @param bool $secure
     * @param string $prefix
     */
    public function __construct(Server $server, Signature $signature, $secure = true, $prefix = null)
    {
        $this->server = $server;
        $this->signature = $signature;
        $this->secure = (bool)$secure;
        $this->prefix = $prefix;
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
            $this->validateRequest($path, $params);
            $this->validateRequest($path, $params);
        }

        return $this->server->getImageResponse($path, $params);
    }

    /**
     * @param string $path
     * @param array $params
     * @throws \League\Glide\Signatures\SignatureException
     */
    private function validateRequest($path, $params)
    {
        $path = '/' . trim($this->prefix . '/' . $path, '/');
        $this->signature->validateRequest($path, $params);
    }
}
