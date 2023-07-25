		
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

	<script type="text/javascript">
		var seg_controller = '<?php echo $seg_controller; ?>';
		var seg_func = '<?php echo $seg_func; ?>';
		var seg_table = '<?php echo $seg_table; ?>';
	</script>

	<script type="text/javascript" src="<?php echo HTTP_ROOT.JS_PATH; ?>/menu.js"></script>
	<script>
        let menu = new Menu({ 
			nav_button : "nav-button",
			nav_ul : "nav-ul"
		});
	</script>

	<script type="text/javascript" src="<?php echo HTTP_ROOT.JS_PATH; ?>/handy-collapse.js"></script>
	<script type="text/javascript">
		function fmvToggleSlider(hpc_h, addremove, ar, position, nestedparentchild) { 
			setheight_main_view_dummy(hpc_h, addremove, ar, position, nestedparentchild);
		}
		var delay = 0;
        let handy_left = new HandyCollapse({ nameSpace: "left",	onToggleSlide: fmvToggleSlider, closeOthers: false, displayDelay: delay });
        let handy_right = new HandyCollapse({ nameSpace: "right", onToggleSlide: fmvToggleSlider, closeOthers: false, displayDelay: delay });
	</script>

	<script type="text/javascript" src="<?php echo HTTP_ROOT.JS_PATH; ?>/simple-tabs.js"></script>
	<script type="text/javascript" charset="utf-8">
        let tabs_info = new SimpleTabs({ 
			tabs_id : "tabs_info"
		});
        let tabs_ci = new SimpleTabs({ 
			tabs_id : "tabs_ci"
		});
	</script>

	<script type="text/javascript">
		function disp_height(txt){
			document.getElementById("disp_height").innerHTML  = txt;
		}

		function setheight_main_view_dummy(hpc_h=0, addremove='', ar='', position='', nestedparentchild='') {
			var px2num = function (val) {
				val = +Number(val.replace('px', '')) || 0
				return val;
			}
			var sh = screen.height;  
			var wih = window.innerHeight;
			var ddc_h = document.documentElement.clientHeight;
			var dbc_h = document.body.clientHeight;
			var dbs_h = document.body.scrollHeight;

			//<div id="nav" class="nav clearfix">
			//<div id="main_view_wrapper" class="main-view-wrapper clearfix">
			var tw = document.getElementById('top_wrapper');
			var tw_h = px2num(window.getComputedStyle(tw,null).getPropertyValue('height'));
			var lsw = document.getElementById('left_sidebar_wrapper');
			var lsw_h = px2num(window.getComputedStyle(lsw,null).getPropertyValue('height'));
			var rsw = document.getElementById('right_sidebar_wrapper');
			var rsw_h = px2num(window.getComputedStyle(rsw,null).getPropertyValue('height'));
			var mv = document.getElementById('main_view_wrapper');
			var mv_h = px2num(window.getComputedStyle(mv,null).getPropertyValue('height'));
			var mvnet = document.getElementById('main_view_net');
			var mvnet_h = px2num(window.getComputedStyle(mvnet,null).getPropertyValue('height'));
			var mvdummy = document.getElementById('main_view_dummy');
			var mvdummy_h = 0;
			var bw = document.getElementById('bottom_wrapper');
			var bw_h = px2num(window.getComputedStyle(bw,null).getPropertyValue('height'));
			var lswrsw_h = (lsw_h>rsw_h) ? lsw_h : rsw_h;
			var wr_h = wih - tw_h - bw_h - 10;

			if (ar == '')
				wr_h = wih - tw_h - bw_h - 10;

			if (wr_h > lswrsw_h) {
				if (wr_h > mvnet_h) {
					mvdummy_h = wr_h - mvnet_h;
				}
			}				
			else if (wr_h > mvnet_h) {
				mvdummy_h = wr_h - mvnet_h;
			}	

			var mvnew_h = mvnet_h + mvdummy_h;
			
			mvdummy.style.height = mvdummy_h + 'px';

			text = "";
			text += sh + " screen.height " + "&#13;&#10;";
			text += wih + " window.innerHeight " + "&#13;&#10;";
			text += ddc_h + " documentElement.clientHeight " + "&#13;&#10;";
			text += dbc_h + " document.body.clientHeight " + "&#13;&#10;";
			text += dbs_h + " document.body.scrollHeight " + "&#13;&#10;";
			text += "&#13;&#10;";

			text += tw_h + " tw_h " + "&#13;&#10;";
			text += mv_h + " mv_h " + "&#13;&#10;";
			text += mvnet_h + " mvnet_h " + "&#13;&#10;";
			text += mvdummy_h + " mvdummy_h " + "&#13;&#10;";
			text += mvnew_h + " mvnew_h " + "&#13;&#10;";
			text += wr_h + " wr_h " + "&#13;&#10;";
			text += lsw_h + " " + rsw_h + " lsw_h rsw_h " + "&#13;&#10;";
			text += bw_h + " bw_h " + "&#13;&#10;";
			text += ar + " " + position + "&#13;&#10;";
			text += "&#13;&#10;";

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
		
		//document.addEventListener("DOMContentLoaded", function() {
			// Handler when the DOM is fully loaded
			if ((seg_controller == 'board' && seg_func == 'view') || (seg_controller == 'board' && seg_func == 'edit_comment')) 
				footer_end();
			else 
				setheight_main_view_dummy();
		//} );		
	</script>

</div><!--body-wrapper--> 

</body>
</html>
