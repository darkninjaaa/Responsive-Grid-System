
		<div class="grids_col grids_16_of_24">
			<div id="main_view_wrapper" class="main-view-wrapper clearfix">

<?php echo form_open($grids_controller.'/reset_grid'); ?> <!--$action = site_url($action);-->

					<p>
						<strong><span>source : </span></strong>
						<a target="_blank" href="http://www.responsivegridsystem.com">responsivegridsystem</a>
						<a target="_blank" href="https://github.com/johnpolacek/extra-strength-responsive-grids">extra-strength-responsive-grids</a>
					</p>
					<p>
						<label>css grid name : <input type="text" id="grids_name" name="grids_name" value="<?php echo $grids_name; ?>"></label>
						<label>grid columns : <input type="number" id="grids_columns" name="grids_columns" maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $grids_columns; ?>"></label>
					</p>
					<p>
						<label>margin(%) top : <input type="number" id="margin_top" name="margin_top" maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $margin_top; ?>"></label>
						<label> right <input type="number" id="margin_right" name="margin_right" maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $margin_right; ?>"></label>
						<label> bottom <input type="number" id="margin_bottom" name="margin_bottom" maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $margin_bottom; ?>"></label>
						<label> left <input type="number" id="margin_left" name="margin_left" maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $margin_left; ?>"></label>
					</p>
					<p>
						<label>padding(px) top : <input type="number" id="padding_top" name="padding_top"maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $padding_top; ?>"></label>
						<label> right <input type="number" id="padding_right" name="padding_right" maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $padding_right; ?>"></label>
						<label> bottom <input type="number" id="padding_bottom" name="padding_bottom" maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $padding_bottom; ?>"></label>
						<label> left <input type="number" id="padding_left" name="padding_left" maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $padding_left; ?>"></label>
					</p>
					<p>
						<label>margin(px) innercol top : <input type="number" id="margin_innercol_top" name="margin_innercol_top" maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $margin_innercol_top; ?>"></label>
						<label> right <input type="number" id="margin_innercol_right" name="margin_innercol_right" maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $margin_innercol_right; ?>"></label>
						<label> bottom <input type="number" id="margin_innercol_bottom" name="margin_innercol_bottom" maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $margin_innercol_bottom; ?>"></label>
						<label> left <input type="number" id="margin_innercol_left" name="margin_innercol_left" maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $margin_innercol_left; ?>"></label>
					</p>
					<p>
						<label>padding(px) innercol top : <input type="number" id="padding_innercol_top" name="padding_innercol_top" maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $padding_innercol_top; ?>"></label>
						<label> right <input type="number" id="padding_innercol_right" name="padding_innercol_right" maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $padding_innercol_right; ?>"></label>
						<label> bottom <input type="number" id="padding_innercol_bottom" name="padding_innercol_bottom" maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $padding_innercol_bottom; ?>"></label>
						<label> left <input type="number" id="padding_innercol_left" name="padding_innercol_left" maxlength="3" oninput="checkMaxLength(this)" value="<?php echo $padding_innercol_left; ?>"></label>
					</p>
					<p>
						<label>grid left width(%) : <input type="number" id="grid_left_width" name="grid_left_width" maxlength="3" oninput="checkMaxLength(this, 0, 100)" value="<?php echo $grid_left_width; ?>"></label>
						<label>grid right width(%) : <input type="number" id="grid_right_width" name="grid_right_width" maxlength="3" oninput="checkMaxLength(this, 0, 100)" value="<?php echo $grid_right_width; ?>"></label>
					</p>
					<p>
						<label>outer color : <input type="text" id="outer_color" name="outer_color" value="<?php echo $outer_color; ?>"></label>
						<label>inner color : <input type="text" id="inner_color" name="inner_color" value="<?php echo $inner_color; ?>"></label>
					</p>
					<p>
						<label>The CSS
							<textarea id="grid_css" name="grid_css" class="grid_css" rows="15" spellcheck="false"><?php echo $grid_css; ?></textarea>
						</label>
					<p>
	
					<p>
						<label>The HTML
							<textarea id="grid_pre" name="grid_pre"  class="grid_pre" rows="15" spellcheck="false"><?php echo $grid_pre; ?></textarea>
						</label>
					<p>
					
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
					function checkMaxLength(object, min=null, max=null) {
						if (min != null && object.value < min) {
							object.value = min;
						}
						if (max != null && object.value > max) {
							object.value = max;
						}
						if (object.value.length > object.maxLength){
							object.value = object.value.slice(0, object.maxLength);
						}
					}
				</script>

				<div class="grids_col grids_12_of_24">
					<div class="panel panel-danger">
						<div class="handy-panel main collapsed">
							<button type="button" class="button is-fullwidth" data-main-button="typ">태풍통보문</button>
							<div class="handy-panelcontent is-1" data-main-content="typ">
								<div class="panel panel-danger">
									<div class="panel-heading">
										<a target="_blank" href="https://www.weather.go.kr/w/typhoon/report.do">태풍통보문</a>
										<button type="button" id="loadtyp" style="float:right">load typ</button>
									</div>
									<div id="typdiv">
										<img id="typloadimg" style="margin:3px auto 0 auto; display:none;"></img>
										<?php echo "get_typ()"; ?><br>
										<?php echo "get_typ()"; ?><br>
										<?php echo "get_typ()"; ?><br>
										<?php echo "get_typ()"; ?><br>
										<?php echo "get_typ()"; ?><br>
										<?php echo "get_typ()"; ?><br>
										<?php echo "get_typ()"; ?><br>
										<?php echo "get_typ()"; ?><br>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="grids_col grids_12_of_24">
					<div class="panel panel-danger">
						<div class="handy-panel main collapsed">
							<button type="button" class="button is-fullwidth" data-main-button="warning">기상특보</button>
							<div class="handy-panelcontent is-1" data-main-content="warning">
								<div class="panel panel-danger">
									<div class="panel-heading">
										<a target="_blank" href="https://www.weather.go.kr/w/weather/warning/list.do">기상특보</a>
										<button type="button" id="loadwarning" style="float:right">load warning</button>
									</div>
									<div class="panel-content">
										<img id="warningloadimg" style="margin:3px auto 0 auto; display:none;"></img>
										<div id="warning_head"><?php echo "$warning[0]"; ?></div>
										<div id="warning_content"><?php echo "$warning[1]"; ?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div><!--main-view-wrapper-->
			<div class="clearfix"></div>
		</div><!--grids_16_of_24-->
