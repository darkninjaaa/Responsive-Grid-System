
		<div class="grids_col grids_16_of_24">
			<div id="main_view_wrapper" class="main-view-wrapper">

<?php echo form_open($grids_controller.'/reset_grid'); ?> <!--$action = site_url($action);-->

					<p>
						<strong><span>source : </span></strong>
						<a target="_blank" href="http://www.responsivegridsystem.com">responsivegridsystem</a>
						<a target="_blank" href="https://github.com/johnpolacek/extra-strength-responsive-grids">extra-strength-responsive-grids</a>
					</p>
					<p>
						<strong><span>css grid name : </span></strong>
						<input type="text" id="grids_name" name="grids_name" value="<?php echo $grids_name; ?>">
						<strong><span>grid columns : </span></strong>
						<input type="number" id="grids_columns" name="grids_columns" maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $grids_columns; ?>">
					</p>
					<p>
						<strong><span>margin(%) top : </span></strong>
						<input type="text" id="margin_top" name="margin_top" size="10" maxlength="10" value="<?php echo $margin_top; ?>">
						<strong><span> right </span></strong>
						<input type="text" id="margin_right" name="margin_right" size="10" maxlength="10" value="<?php echo $margin_right; ?>">
						<strong><span> bottom </span></strong>
						<input type="text" id="margin_bottom" name="margin_bottom" size="10" maxlength="10" value="<?php echo $margin_bottom; ?>">
						<strong><span> left </span></strong>
						<input type="text" id="margin_left" name="margin_left" size="10" maxlength="10" value="<?php echo $margin_left; ?>">
					</p>
					<p>
						<strong><span>padding(px) top : </span></strong>
						<input type="text" id="padding_top" name="padding_top" size="10" maxlength="10" value="<?php echo $padding_top; ?>">
						<strong><span> right </span></strong>
						<input type="text" id="padding_right" name="padding_right" size="10" maxlength="10" value="<?php echo $padding_right; ?>">
						<strong><span> bottom </span></strong>
						<input type="text" id="padding_bottom" name="padding_bottom" size="10" maxlength="10" value="<?php echo $padding_bottom; ?>">
						<strong><span> left </span></strong>
						<input type="text" id="padding_left" name="padding_left" size="10" maxlength="10" value="<?php echo $padding_left; ?>">
					</p>
					<p>
						<strong><span>margin(px) innercol top : </span></strong>
						<input type="text" id="margin_innercol_top" name="margin_innercol_top" size="10" maxlength="10" value="<?php echo $margin_innercol_top; ?>">
						<strong><span> right </span></strong>
						<input type="text" id="margin_innercol_right" name="margin_innercol_right" size="10" maxlength="10" value="<?php echo $margin_innercol_right; ?>">
						<strong><span> bottom </span></strong>
						<input type="text" id="margin_innercol_bottom" name="margin_innercol_bottom" size="10" maxlength="10" value="<?php echo $margin_innercol_bottom; ?>">
						<strong><span> left </span></strong>
						<input type="text" id="margin_innercol_left" name="margin_innercol_left" size="10" maxlength="10" value="<?php echo $margin_innercol_left; ?>">
					</p>
					<p>
						<strong><span>padding(px) innercol top : </span></strong>
						<input type="text" id="padding_innercol_top" name="padding_innercol_top" size="10" maxlength="10" value="<?php echo $padding_innercol_top; ?>">
						<strong><span> right </span></strong>
						<input type="text" id="padding_innercol_right" name="padding_innercol_right" size="10" maxlength="10" value="<?php echo $padding_innercol_right; ?>">
						<strong><span> bottom </span></strong>
						<input type="text" id="padding_innercol_bottom" name="padding_innercol_bottom" size="10" maxlength="10" value="<?php echo $padding_innercol_bottom; ?>">
						<strong><span> left </span></strong>
						<input type="text" id="padding_innercol_left" name="padding_innercol_left" size="10" maxlength="10" value="<?php echo $padding_innercol_left; ?>">
					</p>
					<p>
						<strong><span>grid left width(%) : </span></strong>
						<input type="text" id="grid_left_width" name="grid_left_width" size="10" maxlength="10" value="<?php echo $grid_left_width; ?>">
						<strong><span>grid right width(%) : </span></strong>
						<input type="text" id="grid_right_width" name="grid_right_width" size="10" maxlength="10" value="<?php echo $grid_right_width; ?>">
					</p>
					<p>
						<strong><span>outer color : </span></strong>
						<input type="text" id="outer_color" name="outer_color" value="<?php echo $outer_color; ?>">
						<strong><span>inner color : </span></strong>
						<input type="text" id="inner_color" name="inner_color" value="<?php echo $inner_color; ?>">
					</p>
					<p><strong><span>The CSS</span></strong></p>
					<p><textarea id="grid_css" name="grid_css" rows="15" style="width: 99.6%" spellcheck="false"><?php echo $grid_css; ?></textarea><p>
	
					<p><strong><span>The HTML</span></strong></p>
					<p><textarea id="grid_pre" name="grid_pre" rows="15" style="width: 99.6%" spellcheck="false"><?php echo $grid_pre; ?></textarea><p>
					
					<div id="grid_html" name="grid_html"><?php echo $grid_html; ?></div>
					<div class='<?php echo $grids_name . "_section " . $grids_name . "_group"; ?>'>
						<?php echo '<div class="' . $grids_name . '_left id="grid_left" style="width:' . $grid_left_width . '%; float:left;">'?><?php echo $grid_left; ?></div>
						<?php echo '<div class="' . $grids_name . '_right id="grid_right" style="width:' . $grid_right_width . '%; float:right;">'?><?php echo $grid_right; ?></div>
					</div>							

					<fieldset>
						<legend>Write css file:</legend>
						<div>
							<input type="checkbox" id="write_css" name="write_css" value="write" <?php echo ($write_css==1 ? 'checked="checked"' : '');?>>
							<label for="write_css">write</label>
						</div>
					</fieldset>

					<p><input type="submit" value="reset, submit" /></p>

<?php echo form_close(); ?>

				<script type="text/javascript">
					function checkMaxLength(object){
						if(object.value.length > object.maxLength){
							object.value = object.value.slice(0, object.maxLength);
						}
					}
				</script>

			</div><!--main-view-wrapper-->
			<div class="clearfix"></div>
		</div><!--grids_16_of_24-->
