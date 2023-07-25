<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Main extends BaseController
{
    protected $controllerName;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

		// Preload any models, libraries, etc, here.
		// E.g.: $this->session = \Config\Services::session();
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
			'TotalSegments' => $this->TotalSegments,
			'seg_controller' => $this->seg_controller,
			'seg_func' => $this->seg_func,
			'seg_table' => $this->seg_table,
			'seg_index' => $this->seg_index,
		);

		echo view('topmain_view', $top_data);
		echo view('left_view', $left_data);
		echo view('main_view', $main_data);
		echo view('right_view', $right_data);
		echo view('bottom_view', $bottom_data);
    }

}

?>
