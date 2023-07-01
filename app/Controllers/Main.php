<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Main extends BaseController
{
    protected $request;
    protected $uri;

    protected $controllerName;

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

		$this->seg_controller = $this->uri->getTotalSegments()>=1 ? $this->uri->getSegment(1) : '/';
		$this->seg_func       = $this->uri->getTotalSegments()>=2 ? $this->uri->getSegment(2) : '';
		$this->seg_table      = $this->uri->getTotalSegments()>=3 ? $this->uri->getSegment(3) : '';
		$this->seg_index      = $this->uri->getTotalSegments()>=4 ? $this->uri->getSegment(4) : '';
	}	

    public function index()
    {
		$this->view();
	}
	
    public function view()
    {
		$top_data = Array(
			'title' => "main",
		);
		$left_data = Array(
			'TotalSegments' => $this->TotalSegments,
			'seg_controller' => $this->seg_controller,
			'seg_func' => $this->seg_func,
			'seg_table' => $this->seg_table,
			'seg_index' => $this->seg_index,
		);
		$main_data = Array(
		);
		$right_data = Array(
		);
		$bottom_data = Array(
		);

		echo view('topmain_view', $top_data);
		echo view('left_view', $left_data);
		echo view('main_view', $main_data);
		echo view('right_view', $right_data);
		echo view('bottom_view', $bottom_data);
    }

}

?>
