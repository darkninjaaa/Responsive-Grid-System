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

	<style type="text/css">
		<?php if ($grids_name != "grids" || $grids_columns != 24) echo $grid_css; ?>
	</style>
</head>

<body>

<div class="body-wrapper">
	<?php include "top_menu.php"; ?>

	<div id="left_contents_right_container" class="left-contents-right-container">
