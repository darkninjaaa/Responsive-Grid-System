<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title><?php if (isset($title)) echo strip_tags($title); ?></title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?php echo HTTP_ROOT; ?>/favicon.ico">

	<link rel="stylesheet" type="text/css" href="<?php echo HTTP_ROOT.CSS_PATH; ?>/common.css"; />
	<link rel="stylesheet" type="text/css" href="<?php echo HTTP_ROOT.CSS_PATH; ?>/menu.css"; />
	<link rel="stylesheet" type="text/css" href="<?php echo HTTP_ROOT.CSS_PATH; ?>/grids_24.css"; />
	<link rel="stylesheet" type="text/css" href="<?php echo HTTP_ROOT.CSS_PATH; ?>/handy-collapse.css"; />
	<link rel="stylesheet" type="text/css" href="<?php echo HTTP_ROOT.CSS_PATH; ?>/simple-tabs.css"; />
	<link rel="stylesheet" type="text/css" href="<?php echo HTTP_ROOT.CSS_PATH; ?>/bs-pannels.css"; />

	<style type="text/css">
		<?php if (isset($grids_name) && ($grids_name != "grids" || $grids_columns != 24)) echo $grid_css; ?>
	</style>
</head>

<body>

<div class="body-wrapper">
	<?php include "top_menu.php"; ?>

	<div id="left_contents_right_container" class="left-contents-right-container">


		<div class="grids_col grids_4_of_24">
			<div class="left-sidebar-wrapper" id="left_sidebar_wrapper">
				<h4><?php echo "left is here." ?></h4>

				<div class="handy-panel left collapsed">
					<button type="button" class="button is-fullwidth" data-left-button="info">info</button>
					<div class="handy-panelcontent is-1" data-left-content="info">

						<div id="tabs_info" class="tabs_wrapper">
							<div class="tabs_list_outer">
								<div class="tabs_list_container">
									<div class="tabs_nav clearfix">
										<a class="tabs_prev" href="#">prev</a>
										<a class="tabs_next" href="#">next</a>
									</div>
									<div class="tabs_list"><a id="#tabs_info_seg">segments</a></div>
									<div class="tabs_list active"><a id="#tabs_info_path">path</a></div>
									<div class="tabs_list"><a id="#tabs_info_doc">doc</a></div>
								</div>
							</div>

							<div class="tabs_content_container">
								<div id="tabs_info_seg" class="tabs_content">
									<?php
										echo "TotalSegments : ".$TotalSegments."<br>";
										echo "seg_controller : ".$seg_controller."<br>";
										echo "seg_func : ".$seg_func."<br>";
										echo "seg_table : ".$seg_table."<br>";
									?>
								</div>
								<div id="tabs_info_path" class="tabs_content">
									<?php
										echo "HTTP_HTTPS => ".HTTP_HTTPS."<br>";
										echo "HTTP_HOST => ".HTTP_HOST."<br>";
										echo "DOCUMENT_ROOT => ".DOCUMENT_ROOT."<br>"; 
										echo "<br>";
										echo "SCRIPT_NAME => ".SCRIPT_NAME."<br>";
										echo "<br>";
										echo "BASE_PATH => ".BASE_PATH."<br>"; 
										echo "ROOT_PATH => ".ROOT_PATH."<br>"; 
										echo "<br>";
										echo "HTTP_BASE => ".HTTP_BASE."<br>";
										echo "DOC_BASE => ".DOC_BASE."<br>";
										echo "<br>";
										echo "HTTP_ROOT => ".HTTP_ROOT."<br>";
										echo "DOC_ROOT => ".DOC_ROOT."<br>"; 
										echo "<br>";
										echo "base_url() => ".base_url()."<br>";
										echo "site_url() => ".site_url()."<br>";
										echo "<br>";
										echo "APPPATH => ".APPPATH."<br>";
									?>
								</div>
								<div id="tabs_info_doc" class="tabs_content">
								</div>
							</div>
						</div>
						
					</div>
				</div>
				
				<div class="handy-panel left expand">
					<button type="button" class="button is-fullwidth" data-left-button="height">height</button>
					<div class="handy-panelcontent is-1" data-left-content="height">
						<textarea id="disp_height" name="disp_height" class="disp_height" rows="26" placeholder="disp_height" spellcheck="false">disp_height</textarea>
					</div>
				</div>

			</div>
		</div>

		<div class="grids_col grids_16_of_24">
			<div id="main_view_wrapper" class="main-view-wrapper clearfix">
