<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    protected $uri;
    protected $TotalSegments;
	protected $seg_controller;
    protected $seg_func;
    protected $seg_table;
	protected $seg_index;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

		$this->request = \Config\Services::request();
		$this->uri = $this->request->uri;
		$this->TotalSegments = $this->uri->getTotalSegments();

		//echo $uri->getScheme();         // http
		//echo $uri->getAuthority();      // snoopy:password@example.com:88
		//echo $uri->getUserInfo();       // snoopy:password
		//echo $uri->getHost();           // example.com
		//echo $uri->getPort();           // 88
		//echo $uri->getPath();           // /path/to/page
		//echo $uri->getQuery();          // foo=bar&bar=baz
		//echo $uri->getSegments();       // ['path', 'to', 'page']
		//echo $uri->getSegment(1);       // 'path'
		//echo $uri->getTotalSegments();  // 3

		$this->seg_controller = $this->uri->getTotalSegments()>=1 ? $this->uri->getSegment(1) : '/';
		$this->seg_func       = $this->uri->getTotalSegments()>=2 ? $this->uri->getSegment(2) : '';
		$this->seg_table      = $this->uri->getTotalSegments()>=3 ? $this->uri->getSegment(3) : '';
		$this->seg_index      = $this->uri->getTotalSegments()>=4 ? $this->uri->getSegment(4) : '';
    }
}
