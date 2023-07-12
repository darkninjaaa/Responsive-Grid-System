		
	</div><!--left-contents-right-container--> 

	<div class="footer-end" id="footer_end" >
		<div class="bottom-wrapper" id="bottom_wrapper">
			<div class="bottom-inner-wrapper">
				<p>
				&nbsp;<a target="_blank" href="https://www.cikorea.net/">cikorea</a>
				&nbsp;<a target="_blank" href="http://www.phpschool.com/">phpschool</a>
				&nbsp;<a target="_blank" href="https://github.com/darkninjaaa">darkninjaaa</a>
				&nbsp;<a target="_blank" href="https://codeigniter.com/download">codeigniter</a> <?php echo \CodeIgniter\CodeIgniter::CI_VERSION; ?>
				&nbsp;<a target="_blank" href="https://www.apachelounge.com/download/">apache</a> <?php echo apache_get_version(); ?>
				&nbsp;<a target="_blank" href="https://windows.php.net/">php</a> <?php echo phpversion(); ?>
				&nbsp;<a target="_blank" href="https://mariadb.org/">mariadb</a>
				<?php
					//$con = mysqli_connect("localhost","user","password","db");
					//if (mysqli_connect_errno()) {
					//	echo "Failed to connect to MySQL: " . mysqli_connect_error();
					//	exit();
					//}
					//echo mysqli_get_server_info($con);
					//mysqli_close($con);
				?>
				&nbsp;<?php echo round(memory_get_usage() / 1024).'kb' ?>
				&nbsp;<?php echo round(memory_get_peak_usage() / 1024).'peak' ?>
				&nbsp;Runtime({elapsed_time}sec)
				</p>
			</div>
		</div>
	</div><!--body-footer--> 

	<script type="text/javascript" src="<?php echo HTTP_ROOT.JS_PATH; ?>/menu.js"></script>
	<script>
        let menu = new Menu({ 
			nav_button : "nav-button",
			nav_ul : "nav-ul"
		});
	</script>

	<script type="text/javascript" src="<?php echo HTTP_ROOT.JS_PATH; ?>/handy-collapse.js"></script>
	<script type="text/javascript">
        //Basic left
        let handy_left = new HandyCollapse({
            nameSpace: "left",
            closeOthers: false
        });
        let handy_right = new HandyCollapse({
            nameSpace: "right",
            closeOthers: false
        });
	</script>

	<script type="text/javascript" src="<?php echo HTTP_ROOT.JS_PATH; ?>/simple-tabs.js"></script>
	<script type="text/javascript" charset="utf-8">
        let tabs_info = new SimpleTab({ 
			tabs_id : "tabs_info"
		});
	</script>

	<script type="text/javascript">
		function disp_height(txt){
			document.getElementById("disp_height").innerHTML  = txt;
		}

		function isScrollable() {
			var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight; 
			
			if (document.body.scrollHeight > h) 
				return true
			else
				return false;
		}

		function setheight_main_view_wrapper() {
			var main_view_wrapper = document.getElementById('main_view_wrapper');
			var main_view_wrapper_h = window.getComputedStyle(main_view_wrapper).height;
			var sh = screen.height;  
			var wih = window.innerHeight;
			var tw = document.getElementById('top_wrapper');
			var tw_h = window.getComputedStyle(tw).height;
			var bw = document.getElementById('bottom_wrapper');
			var bw_h = window.getComputedStyle(bw).height;
			tw_h = Number(tw_h.replace('px', ''));
			main_view_wrapper_h = Number(main_view_wrapper_h.replace('px', ''));
			bw_h = Number(bw_h.replace('px', ''));

			var wr_h = wih - tw_h - bw_h - 10;

			var ret = getHandyPanelsHeight();
			var panels_lr_h = ret['big_lr'];
			var panels_lswrsw_h = ret['big_lswrsw'];
			var panels_h = ret['big'];

			panels_h = panels_lswrsw_h;

			var wrapper_h = (main_view_wrapper_h > wr_h) ? main_view_wrapper_h : wr_h;
			wrapper_h = (wrapper_h > panels_h) ? wrapper_h : panels_h;

			var twrb_h = tw_h + wrapper_h + bw_h;
			var twr_h = tw_h + wrapper_h;
			var wrb_h = wrapper_h + bw_h;
			twr_h = (twr_h > wrb_h) ? twr_h : wrb_h;

			var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight; 

			var mypdf_div = document.getElementById('mypdf_div');
			if (mypdf_div) 
				main_view_wrapper = mypdf_div;

			text = "";
			text += sh + " screen h " + "&#13;&#10;";
			text += wih + " window h " + "&#13;&#10;";
			text += "&#13;&#10;";

			text += ret['lh'] + " lh " + ret['rh'] + " rh " +  "&#13;&#10;";
			text += ret['lsw_h'] + " lsw_h " + ret['rsw_h'] + " rsw_h " + "&#13;&#10;";
			text += ret['big'] + " big " + "&#13;&#10;";
			text += "&#13;&#10;";

			text += tw_h + " tw_h " + "&#13;&#10;";
			text += wrapper_h + " wrapper_h " + "&#13;&#10;";
			text += main_view_wrapper_h + " main_view_wrapper_h " + "&#13;&#10;";
			text += wr_h + " wr_h " + "&#13;&#10;";
			text += panels_h + " panels_h " + "&#13;&#10;";
			text += bw_h + " bw_h " + "&#13;&#10;";
			text += "&#13;&#10;";

			text += twrb_h + " twrb_h " + "&#13;&#10;";
			text += twr_h + " twr_h " + "&#13;&#10;";
			text += wrb_h + " wrb_h " + "&#13;&#10;";
			text += "&#13;&#10;";

			text += document.body.scrollHeight + " scrollHeight " + "&#13;&#10;";
			text += h + " h " + "&#13;&#10;";

			text += (isScrollable() ? 'scrollable' : 'none') + "&#13;&#10;";;

			if (wih >= twrb_h) { 
				if (isScrollable()) {
					if (wrapper_h > panels_h) {
						wrapper_h += 2;
						main_view_wrapper.style.height = wrapper_h + 'px';
						text += wrapper_h + " 111 " + "&#13;&#10;";
					}
					else {
						panels_h += 2;
						main_view_wrapper.style.height = panels_h + 'px';
						text += panels_h + " 112 " + "&#13;&#10;";
					}		
				}
				else {
					main_view_wrapper.style.height = wrapper_h + 'px';
					text += wrapper_h + " 12 " + "&#13;&#10;";
				}	
			}	
			else {	
				if (wih >= twr_h) { 
					if (isScrollable()) {
						if (wrapper_h > panels_h) {
							main_view_wrapper.style.height = wrapper_h + 'px';
							text += wrapper_h + " 211 " + "&#13;&#10;";
						}	
						else {
							if (ret['lh']>ret['rh']) {
								panels_h += 2;
								main_view_wrapper.style.height = panels_h + 'px';
								text += panels_h + " 2121 " + "&#13;&#10;";
							}
							else {
								panels_h += 2;
								main_view_wrapper.style.height = panels_h + 'px';
								text += panels_h + " 2122 " + "&#13;&#10;";
							}	
						}	
					}
					else {
						main_view_wrapper.style.height = twr_h + 'px';
						text += twr_h + " 221 " + "&#13;&#10;";
					}	
				}	
				else {
					if (isScrollable()) {
						if (wrapper_h > panels_h) {
							main_view_wrapper.style.height = wrapper_h + 'px';
							text += wrapper_h + " 231 " + "&#13;&#10;";
						}	
						else {
							if (ret['lh']>ret['rh']) {
								panels_h += 2;
								main_view_wrapper.style.height = panels_h + 'px';
								text += panels_h + " 2321 " + "&#13;&#10;";
							}
							else {
								panels_h += 2;
								main_view_wrapper.style.height = panels_h + 'px';
								text += panels_h + " 2322 " + "&#13;&#10;";
							}	
						}	
					}	
					else {
						//panels_h += 2;
						main_view_wrapper.style.height = panels_h + 'px';
						text += panels_h + " 24 " + "&#13;&#10;";
					}	
				}	
			}	

			disp_height(text);
		}
	</script>

	<script type="text/javascript">
		function footer_bottom() {
			var footer_end = document.getElementById('footer_end');

			footer_end.classList.remove('footer-end');
			footer_end.classList.add('footer-bottom');
		}
		
		function footer_end() {
			var footer_end = document.getElementById('footer_end');

			footer_end.classList.remove('footer-bottom');
			footer_end.classList.add('footer-end');
		}
		
		//footer_end();
		//footer_bottom();
		setheight_main_view_wrapper();
	</script>

</div><!--body-wrapper--> 

</body>
</html>
