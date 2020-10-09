<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use Firebase\JWT\JWT;
use Config\Services;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();

	}

    protected function successN($message='', $exit=true)
    {
        $data = NULL;
        $this->success($data, $message, $exit);
    }

	protected function success($data, $message=NULL, $exit=TRUE){
        $result = array('success'=>TRUE, 'data'=>$data, 'message'=>$message);
        $this->response
            ->setStatusCode(200)
            ->setHeader('Cache-Control','private, max-age=0, no-cache, no-cache=Set-Cookie, proxy-revalidate')
            ->setHeader('Pragma','no-cache')
            ->setContentType('application/json')
            ->setJSON($result)
            ->send();
        if($exit){
            exit();
        }
    }

    protected function encodeToken($data)
    {
        //refer : https://github.com/firebase/php-jwt
        $encode_jwt = JWT::encode($data, $_ENV['SECRET_KEY']);
        return $encode_jwt;
    }

    protected function decodeToken($jwt)
    {
        $decode_jwt = JWT::decode($jwt, $_ENV['SECRET_KEY'],array('HS256'));
        return $decode_jwt;
    }

}
