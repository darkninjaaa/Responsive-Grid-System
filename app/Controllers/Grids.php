<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Grids extends BaseController
{
    protected $controllerName;

    protected $grids_controller = "grids";
    protected $grids_name = "grid";
	protected $grids_columns = 20;

	protected $margin_top = 0.0;
	protected $margin_right = 0;
	protected $margin_bottom = 0.2;
	protected $margin_left = 0.0;

	protected $padding_top = 2;
	protected $padding_right = 0;
	protected $padding_bottom = 2;
	protected $padding_left = 2;

	protected $margin_innercol_top = 0;
	protected $margin_innercol_right = 0;
	protected $margin_innercol_bottom = 0;
	protected $margin_innercol_left = 0;

	protected $padding_innercol_top = 0;
	protected $padding_innercol_right = 0;
	protected $padding_innercol_bottom = 0;
	protected $padding_innercol_left = 3;

	protected $grid_left_width = 45;
	protected $grid_right_width = 55;

	protected $outer_color = "#aaa";
	protected $inner_color = "#eee";

	//protected $background_color = "#1E90FF";
	//protected $background_color_left = "#FDFD96";
	//protected $background_color_right = "#028A0F";

	protected $write_css = 0;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

		// Preload any models, libraries, etc, here.
		// E.g.: $this->session = \Config\Services::session();

		helper('form');
	}	

    public function index()
    {
		$this->view();
	}
	
    public function reset_grid()
    {
		if ($this->request->getPost()) {
			$this->reset_var();
			if ($this->request->getPost('write_css') == "write") {
				$this->css_write(); 
				$this->write_css = 0;
			}	
		}	
		$this->view();
	}
	
    public function reset_var()
    {
		$this->grids_name = $this->request->getPost('grids_name');
		$this->grids_columns = $this->request->getPost('grids_columns');

		$this->margin_top = $this->request->getPost('margin_top');
		$this->margin_right = $this->request->getPost('margin_right');
		$this->margin_bottom = $this->request->getPost('margin_bottom');
		$this->margin_left = $this->request->getPost('margin_left');
				
		$this->padding_top = $this->request->getPost('padding_top');
		$this->padding_right = $this->request->getPost('padding_right');
		$this->padding_bottom = $this->request->getPost('padding_bottom');
		$this->padding_left = $this->request->getPost('padding_left');

		$this->margin_innercol_top = $this->request->getPost('margin_innercol_top');
		$this->margin_innercol_right = $this->request->getPost('margin_innercol_right');
		$this->margin_innercol_bottom = $this->request->getPost('margin_innercol_bottom');
		$this->margin_innercol_left = $this->request->getPost('margin_innercol_left');
				
		$this->padding_innercol_top = $this->request->getPost('padding_innercol_top');
		$this->padding_innercol_right = $this->request->getPost('padding_innercol_right');
		$this->padding_innercol_bottom = $this->request->getPost('padding_innercol_bottom');
		$this->padding_innercol_left = $this->request->getPost('padding_innercol_left');

		$this->grid_left_width = $this->request->getPost('grid_left_width');
		$this->grid_right_width = $this->request->getPost('grid_right_width');
	
		$this->outer_color = $this->request->getPost('outer_color');
		$this->inner_color = $this->request->getPost('inner_color');
	}	

    public function view()
    {
		$data = Array(
			'head_data' => Array(
				'title' => "grids",
				'grids_name' => $this->grids_name,
				'grids_columns' => $this->grids_columns,
				'grid_css' => $this->grid_css(),
				'TotalSegments' => $this->TotalSegments,
				'seg_controller' => $this->seg_controller,
				'seg_func' => $this->seg_func,
				'seg_table' => $this->seg_table,
				'seg_index' => $this->seg_index,
			),
			'view_data' => Array(
				'grids_controller' => $this->grids_controller,
				'grids_name' => $this->grids_name,
				'grids_columns' => $this->grids_columns,
				'margin_top' => $this->margin_top,
				'margin_right' => $this->margin_right,
				'margin_bottom' => $this->margin_bottom,
				'margin_left' => $this->margin_left,
				'padding_top' => $this->padding_top,
				'padding_right' => $this->padding_right,
				'padding_bottom' => $this->padding_bottom,
				'padding_left' => $this->padding_left,
				'margin_innercol_top' => $this->margin_innercol_top,
				'margin_innercol_right' => $this->margin_innercol_right,
				'margin_innercol_bottom' => $this->margin_innercol_bottom,
				'margin_innercol_left' => $this->margin_innercol_left,
				'padding_innercol_top' => $this->padding_innercol_top,
				'padding_innercol_right' => $this->padding_innercol_right,
				'padding_innercol_bottom' => $this->padding_innercol_bottom,
				'padding_innercol_left' => $this->padding_innercol_left,
				'outer_color' => $this->outer_color,
				'inner_color' => $this->inner_color,
				'write_css' => $this->write_css,
				'grid_css' => $this->grid_css(),
				'grid_pre' => $this->grid_pre(),
				'grid_html' => $this->grid_html(),
				'grid_left' => $this->grid_html(),
				'grid_right' => $this->grid_html(),
				'grid_left_width' => $this->grid_left_width,
				'grid_right_width' => $this->grid_right_width,
			),
			'tail_data' => Array(
				'TotalSegments' => $this->TotalSegments,
				'seg_controller' => $this->seg_controller,
				'seg_func' => $this->seg_func,
				'seg_table' => $this->seg_table,
			)
		);

		echo view('main_head', $data['head_data']);
		echo view('grids_view', $data['view_data']);
		echo view('main_tail', $data['tail_data']);
    }

	public function grid_css($test_css = true) 
	{
		$grids_width = 100 - ($this->margin_left * ($this->grids_columns-1)); //%

		$grids = "";

		$grids .= "/*  SECTIONS  */" . "\n";
		$grids .= "/*  splits up the page horizontally.  */" . "\n";
		$grids .= "/*  You'll need a few of these to break up the content, and you can use them in your main wrapper, or within other divs.  */" . "\n";
		$grids .= "." . $this->grids_name . "_section {" . "\n";
		$grids .= "\t" . "clear: both;" . "\n";
		$grids .= "\t" . "margin: 0px;" . "\n";
		$grids .= "\t" . "padding: 0px;" . "\n";
		$grids .= "}" . "\n";
		$grids .= "\n";

		$grids .= "/*  GROUPING  */" . "\n";
		$grids .= "/*  solves floating problems, by forcing the section to self clear its children (aka the clearfix hack).  */" . "\n";
		$grids .= "/*  This is good in Firefox 3.5+, Safari 4+, Chrome, Opera 9+ and IE 6+.  */" . "\n";
		$grids .= "." . $this->grids_name . "_group:before," . "\n";
		$grids .= "." . $this->grids_name . "_group:after { content:\"\"; display:table; }" . "\n";
		$grids .= "." . $this->grids_name . "_group:after { clear:both;}" . "\n";
		$grids .= "." . $this->grids_name . "_group { zoom:1; /* For IE 6/7 */ }" . "\n";
		$grids .= "\n";

		$grids .= "/*  COLUMN SETUP  */" . "\n";
		$grids .= "/*  divides the section into columns.  */" . "\n";
		$grids .= "/*  Each column has a left margin of 1.6% (around 20 pixels on a normal monitor),  */" . "\n";
		$grids .= "/*  except the first one. Using .col:first-child { margin-left: 0; } means you don't need to use class=\"last\" anywhere.  */" . "\n";
		$grids .= "/*  It works in all browsers since IE6.  */" . "\n";
		$grids .= "." . $this->grids_name . "_col {" . "\n";
		$grids .= "\t" . "clear:none;" . "\n";
		$grids .= "\t" . "display: block;" . "\n";
		$grids .= "\t" . "float:left;" . "\n";

        //test css...
		if ($test_css) {
			$grids .= "\n";
			$grids .= "\t" . "/* test css... */" . "\n";
			$grids .= "\t" . "background-color: " . $this->outer_color . ";" . "\n";
			$grids .= "\n";
		}	

		$grids .= "\t" . "margin: " . $this->margin_top . "% " . $this->margin_right . "% " . $this->margin_bottom . "% " . $this->margin_left . "% " . ";" . "\n";
		$grids .= "\t" . "padding: " . $this->padding_top . "px " . $this->padding_right . "px " . $this->padding_bottom . "px " . $this->padding_left . "px " . ";" . "\n";
		$grids .= "\t" . "-moz-box-sizing:border-box;" . "\n";
		$grids .= "\t" . "-webkit-box-sizing:border-box;" . "\n";
		$grids .= "\t" . "box-sizing:border-box;" . "\n";
		$grids .= "\t" . "*behavior:url(boxsizing.htc);" . "\n";
		$grids .= "}" . "\n";
		$grids .= "\n";

		$grids .= "/*  INNER COLUMN SETUP  */" . "\n";
		$grids .= "." . $this->grids_name . "_innercol {" . "\n";
		$grids .= "\t" . "display: block;" . "\n";

        //test css...
		if ($test_css) {
			$grids .= "\n";
			$grids .= "\t" . "/* test css... */" . "\n";
			$grids .= "\t" . "background-color: " . $this->inner_color . ";" . "\n";
			$grids .= "\n";
		}	

		$grids .= "\t" . "margin: " . $this->margin_innercol_top . "px " . $this->margin_innercol_right . "px " . $this->margin_innercol_bottom . "px " . $this->margin_innercol_left . "px " . ";" . "\n";
		$grids .= "\t" . "padding: " . $this->padding_innercol_top . "px " . $this->padding_innercol_right . "px " . $this->padding_innercol_bottom . "px " . $this->padding_innercol_left . "px " . ";" . "\n";
		$grids .= "\t" . "-moz-box-sizing:border-box;" . "\n";
		$grids .= "\t" . "-webkit-box-sizing:border-box;" . "\n";
		$grids .= "\t" . "box-sizing:border-box;" . "\n";
		$grids .= "\t" . "*behavior:url(boxsizing.htc);" . "\n";
		$grids .= "}" . "\n";
		$grids .= "\n";

		//set margin padding left value only
		$grids .= "." . $this->grids_name . "_col:first-child { margin-left: 0; }" . "\n";
		$grids .= "." . $this->grids_name . "_col:last-child { padding-right: ".$this->padding_left . "px; }" . "\n";
		$grids .= "\n";

        //test css...
		if ($test_css) {
			$grids .= "/* test css... */" . "\n";
			$grids .= "." . $this->grids_name . "_left " . "." . $this->grids_name . "_col:last-child { padding-right: 0; }" . "\n";
			if ($this->margin_left == 0 && $this->margin_bottom == 0) {
				$grids .= "." . $this->grids_name . "_left " . "." . $this->grids_name . "_col { padding-top: 0; }" . "\n";
				$grids .= "." . $this->grids_name . "_right " . "." . $this->grids_name . "_col { padding-top: 0; }" . "\n";
				$grids .= "." . $this->grids_name . "_col { padding-right: 0px; }" . "\n"; 
			}	
			else {
				$grids .= "." . $this->grids_name . "_left " . "." . $this->grids_name . "_col { padding-top: " . $this->padding_top . "px; }" . "\n"; //remove top-padding
				$grids .= "." . $this->grids_name . "_right " . "." . $this->grids_name . "_col { padding-top: " . $this->padding_top . "px; }" . "\n"; //remove top-padding
			}	
			$grids .= "\n";
		}

		$grids .= "/*  " . strtoupper($this->grids_name) . " OF " . $this->grids_columns . " */" . "\n";
	
		for ($i = 1; $i <= $this->grids_columns; $i++) {
			$g = number_format (($i / $this->grids_columns) * $grids_width, 5, '.', '');
			$grids .= "." . $this->grids_name . "_" . $i . "_of_" . $this->grids_columns . " {width : " . $g . "% }" . "\n";  
		}	
		$grids .= "\n";

		$grids .= "/*  GO FULL WIDTH BELOW 480 PIXELS */" . "\n";
		$grids .= "@media only screen and (max-width: 480px) {" . "\n";
		$grids .= "\t" . "." . $this->grids_name . "_col { " . "\n";
		$grids .= "\t\t" . "margin: ". $this->margin_top . "% " . $this->margin_right . "% " . $this->margin_bottom . "% " . $this->margin_left . "% " . ";" . "\n";
		$grids .= "\t\t" . "padding: ". $this->padding_top . "px " . $this->padding_right . "px " . $this->padding_bottom . "px " . $this->padding_left . "px " . ";" . "\n";
		$grids .= "\t" . "}" . "\n";

		for ($i = 1; $i <= $this->grids_columns; $i++) {
			$grids .= "\t" . "." . $this->grids_name . "_" . $i . "_of_" . $this->grids_columns;  
			if ($i < $this->grids_columns) 
				$grids .= "," . "\n";  
		}	
 
		$grids .= "\t" . "{ width: ". $grids_width ."%; }" . "\n";
		$grids .= "}";
	
		return $grids;
	}

	public function grid_pre() 
	{
		$ex_pre = "<div class=\"" . $this->grids_name . "_section " . $this->grids_name . "_group\">" . "\n";

		for ($i = 1; $i <= $this->grids_columns; $i++) {
			$ex_pre .= "\t" . "<div class=\"" . $this->grids_name . "_col " . $this->grids_name . "_" . "1_of_" . $this->grids_columns . "\">";  
			$ex_pre .= "<div class=\"" . $this->grids_name . "_innercol\">" . $i . "</div>";  
			$ex_pre .= "</div>" . "\n";  
		}	
		$ex_pre .= "</div>". "\n";
		
		$ex_pre .= "<div class=\"" . $this->grids_name . "_section " . $this->grids_name . "_group\">" . "\n";

		$ex_pre .= "\t" . "<div id=\"grid_left\" style=\"width:" . $this->grid_left_width . "%; float:left;\">". "\n";
		for ($i = 1; $i <= $this->grids_columns; $i++) {
			$ex_pre .= "\t" . "\t" . "<div class=\"" . $this->grids_name . "_col " . $this->grids_name . "_" . "1_of_" . $this->grids_columns . "\">";  
			$ex_pre .= "<div class=\"" . $this->grids_name . "_innercol\">" . $i . "</div>";  
			$ex_pre .= "</div>" . "\n";  
		}	
		$ex_pre .= "\t" . "</div>". "\n";
		
		$ex_pre .= "\t" . "<div id=\"grid_right\" style=\"width:" . $this->grid_right_width . "%; float:right;\">". "\n";
		for ($i = 1; $i <= $this->grids_columns; $i++) {
			$ex_pre .= "\t" . "\t" . "<div class=\"" . $this->grids_name . "_col " . $this->grids_name . "_" . "1_of_" . $this->grids_columns . "\">";  
			$ex_pre .= "<div class=\"" . $this->grids_name . "_innercol\">" . $i . "</div>";  
			$ex_pre .= "</div>" . "\n";  
		}	
		$ex_pre .= "\t" . "</div>". "\n";

		$ex_pre .= "</div>";

		return $ex_pre;
	}

	public function grid_html() 
	{
		$ex_grid = "<div class=\"" . $this->grids_name . "_section " . $this->grids_name . "_group\">";
		for ($i = 1; $i <= $this->grids_columns; $i++) {
			$ex_grid .= "<div class=\"" . $this->grids_name . "_col " . $this->grids_name . "_" . "1_of_" . $this->grids_columns . "\">";  
			$ex_grid .= "<div class=\"" . $this->grids_name . "_innercol\">" . $i . "</div>";  
			$ex_grid .= "</div>";  
		}	
		$ex_grid .= "</div>";

		return $ex_grid;
	}

	public function css_write() 
	{
		$fp = fopen($this->grids_name."_".$this->grids_columns.".css", "w");
		fwrite($fp, $this->grid_css(false));
		fclose($fp);
	}

}

?>
