
		<div class="grids_col grids_4_of_24">
			<div class="left-sidebar-wrapper" id="left_sidebar_wrapper">
				<h4><?php echo "left is here." ?></h4>

				<div class="handy-panel left expand">
					<button type="button" class="button is-fullwidth" data-left-button="height">height</button>
					<div class="handy-panelcontent is-1" data-left-content="height">
						<textarea id="disp_height" name="disp_height" class="disp_height" rows="23" placeholder="disp_height">disp_height</textarea>
					</div>
				</div>
				
				<div class="handy-panel left collapsed">
					<button type="button" class="button is-fullwidth" data-left-button="info">info</button>
					<div class="handy-panelcontent is-1" data-left-content="info">
						
						<div class="tabs_wrapper">

							<div class="tabs_list_outer">
								<div id="tabs_list_container" class="tabs_list_container">
									<div class="tabs_pull_right">
										<span id="tabs_prev"><a href="#">prev</a></span>
										<span id="tabs_next"><a href="#">next</a></span>
									</div>
									<div class="tabs_list"><a id="#tabs_seg">segments</a></div>
									<div class="tabs_list active"><a id="#tabs_path">path</a></div>
									<div class="tabs_list"><a id="#tabs_doc">doc</a></div>
								</div>
							</div>

							<div id="tabs_content_container" class="tabs_content_container">
								<div id="tabs_seg" class="tabs_content">
									<?php
										echo 'TotalSegments : '.$TotalSegments.'<br>';
										echo 'seg_controller : '.$seg_controller.'<br>';
										echo 'seg_func : '.$seg_func.'<br>';
										echo 'seg_table : '.$seg_table.'<br>';
									?>
								</div>
								<div id="tabs_path" class="tabs_content">
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
								<div id="tabs_doc" class="tabs_content">
								</div>
							</div>

						</div>
					</div>
				</div>
				
			</div>
		</div>
