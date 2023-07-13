
		<div class="grids_col grids_4_of_24">
			<div class="right-sidebar-wrapper" id="right_sidebar_wrapper">
				<h4><?php echo "right is here." ?></h4>

				<div class="handy-panel right collapsed">
					<button type="button" class="button is-fullwidth" data-right-button="Lazarus">Lazarus</button>
					<div class="handy-panelcontent is-1" data-right-content="Lazarus">
						<a target="_blank" href="https://www.lazarus-ide.org/index.php">lazarus</a>
						<a target="_blank" href="https://github.com/search?q=lazarus">github-lazarus</a>
						<a target="_blank" href="https://wiki.lazarus.freepascal.org/LCL_Components">lazarus lcl</a>
						<br >
					</div>
				</div>

				<div class="handy-panel right collapsed">
					<button type="button" class="button is-fullwidth" data-right-button="ci">ci</button>
					<div class="handy-panelcontent is-1" data-right-content="ci">

						<div id="tabs_ci" class="tabs_wrapper">
							<div class="tabs_list_outer">
								<div class="tabs_list_container">
									<div class="tabs_nav clearfix">
										<a class="tabs_prev" href="#">prev</a>
										<a class="tabs_next" href="#">next</a>
									</div>
									<div class="tabs_list"><a id="#tabs_ci_controller">controller</a></div>
									<div class="tabs_list active"><a id="#tabs_ci_model">model</a></div>
									<div class="tabs_list"><a id="#tabs_ci_view">view</a></div>
								</div>
							</div>

							<div class="tabs_content_container">
								<div id="tabs_ci_controller" class="tabs_content">
									<?php
										echo "Controller : home"."<br>";
									?>
								</div>
								<div id="tabs_ci_model" class="tabs_content">
									<?php
										echo "Model : model"."<br>";
									?>
								</div>
								<div id="tabs_ci_view" class="tabs_content">
								</div>
							</div>
						</div>
						
					</div>
				</div>

			</div>
		</div>
