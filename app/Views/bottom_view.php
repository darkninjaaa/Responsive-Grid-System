		
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
		var isScrollable = function () {
			var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight; 
			if (document.body.scrollHeight > h)
				return true
			else
				return false;
		}

		var set_height_main_view_wrapper = true;
		var delay = 0;
		if (set_height_main_view_wrapper) {
			function fmvToggleStart(addremove, position) { 
				return false;
			}
			function fmvToggleEnd(hpc_h, addremove, ar, position, nestedparentchild) { 
				setheight_main_view_wrapper(hpc_h, addremove, ar, position, nestedparentchild);
			}
		}	
		else {	
			function fmvToggleStart(addremove, position) { 
				if (isScrollable()) {
					var bw = document.getElementById('bottom_wrapper');
					bw.style.opacity = "0";
				}	
			}
			delay = 400;
			function fmvToggleEnd(hpc_h, addremove, ar, position, nestedparentchild) { 
				setheight_main_view_dummy(hpc_h, addremove, ar, position, nestedparentchild);

				//setTimeout(function() { 
					var bw = document.getElementById('bottom_wrapper');
					bw.style.opacity = "1";
				//}, 0);
			}
			//function fmvToggleEnd(hpc_h, addremove, ar, position, nestedparentchild) { 
			//	setTimeout(function() { setheight_main_view_dummy(hpc_h, addremove, ar, position, nestedparentchild); }, 100);
			//}
		}	
        let handy_left = new HandyCollapse({ nameSpace: "left",	onToggleStart: fmvToggleStart, onToggleEnd: fmvToggleEnd, displayDelay: delay });
        let handy_right = new HandyCollapse({ nameSpace: "right", onToggleStart: fmvToggleStart, onToggleEnd: fmvToggleEnd, displayDelay: delay });
	</script>
		<?php
			if (isset($handy_pannels)) {
				include DOC_ROOT.JS_PATH.'/'.$handy_pannels.'.js';
			}				
		?>

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
	</script>

	<script type="text/javascript">
		function setheight_main_view_wrapper(hpc_h=0, addremove='', ar='', position='', nestedparentchild='') {
			var px2num = function (val) {
				val = +Number(val.replace('px', '')) || 0
				return val;
			}

			var HANDY_PANEL = "handy-panel";
			var HANDY_NAMESPACE_LEFT   = "left";
			var HANDY_NAMESPACE_NESTED = "nested";
			var HANDY_NAMESPACE_MROW   = "mainrow";
			var HANDY_NAMESPACE_MLEFT  = "mainleft";
			var HANDY_NAMESPACE_MRIGHT = "mainright";
			var HANDY_NAMESPACE_MNLEFT  = "mainnleft";
			var HANDY_NAMESPACE_MNRIGHT = "mainnright";
			var HANDY_NAMESPACE_RIGHT  = "right";
			var HANDY_NAMESPACE_NESTEDPARENT = "nestedparent";
			var HANDY_NAMESPACE_NESTEDCHILD  = "nestedchild";

			var panel;
			var panelsList = document.getElementsByClassName(HANDY_PANEL);
			var panelsleft = new Array();
			var panelsright = new Array();
			var left_h = 0;
			var right_h = 0;
			var mvleft_h = 0;
			var mvright_h = 0;
			var mvnleft_h = 0;
			var mvnright_h = 0;
			var mvrow_h = 0;
			var mvg_h = 0;
			for (var i=0; i<panelsList.length; i++)
			{
				panel = panelsList[i];
				if (panel.classList.contains(HANDY_NAMESPACE_MROW)) { //"mainrow" 
					if (mvrow_h < panel.offsetHeight) 
						mvrow_h = panel.offsetHeight;
				}	
				else if (panel.classList.contains(HANDY_NAMESPACE_MLEFT)) { //"mainleft"
					mvleft_h += panel.offsetHeight;
				}	
				else if (panel.classList.contains(HANDY_NAMESPACE_MRIGHT)) { //"mainright"
					mvright_h += panel.offsetHeight;
				}	
				else if (panel.classList.contains(HANDY_NAMESPACE_MNLEFT)) { //"mainnleft"
					if (panel.classList.contains(HANDY_NAMESPACE_NESTEDCHILD)) //"nestedchild"
						continue;
					else //"nestedparent"
						mvnleft_h += panel.offsetHeight;
				}	
				else if (panel.classList.contains(HANDY_NAMESPACE_MNRIGHT)) { //"mainnright"
					if (panel.classList.contains(HANDY_NAMESPACE_NESTEDCHILD)) //"nestedchild"
						continue;
					else //"nestedparent"
						mvnright_h += panel.offsetHeight;
				}	
			}
			if (addremove=='')
				mvrow_h -= 4;
			else
				mvrow_h += 1;
			
			if (nestedparentchild == 'nestedchild' && addremove == 'remove')
				mvrow_h += 5;

			var lsw = document.getElementById('left_sidebar_wrapper');
			var rsw = document.getElementById('right_sidebar_wrapper');
			var lsw_h = window.getComputedStyle(lsw,null).getPropertyValue('height');
			var rsw_h = window.getComputedStyle(rsw,null).getPropertyValue('height');
			lsw_h = px2num(lsw_h);
			rsw_h = px2num(rsw_h);
			var lswrsw_h = (lsw_h>rsw_h) ? lsw_h : rsw_h;
			lswrsw_h += 2;

			var mvgrids_list = document.getElementsByClassName('main_view_grids_col');
			for (var i=0; i<mvgrids_list.length; i++)
				mvg_h += mvgrids_list[i].offsetHeight;

			var sh = screen.height;  
			var wih = window.innerHeight;
			var ddc_h = document.documentElement.clientHeight;
			var dbc_h = document.body.clientHeight;
			var dbs_h = document.body.scrollHeight;

			//<div id="nav" class="nav clearfix">
			//<div id="main_view_wrapper" class="main-view-wrapper clearfix">
			var tw = document.getElementById('top_wrapper');
			var tw_h = px2num(window.getComputedStyle(tw,null).getPropertyValue('height'));

			var mv = document.getElementById('main_view_wrapper');
			var mypdf_div = document.getElementById('mypdf_div');
			if (mypdf_div) 
				mv = mypdf_div;
			var mv_h = px2num(window.getComputedStyle(mv,null).getPropertyValue('height'));

			var bw = document.getElementById('bottom_wrapper');
			var bw_h = px2num(window.getComputedStyle(bw,null).getPropertyValue('height'));

			var mvleftright_h = 0;
			if (position == 'mainleft') {
				if (addremove == 'add') {
					if ((mvleft_h + hpc_h) > mvright_h) {
						mvleftright_h = mvleft_h + hpc_h;
					}	
					else {
						mvleftright_h = mvright_h;
					}	
				}
				else if (addremove == 'remove') {
					if ((mvleft_h - hpc_h) > mvright_h) {
						mvleftright_h = mvleft_h - hpc_h;
					}	
					else {
						mvleftright_h = mvright_h;
					}	
				}
			}	
			else if (position == 'mainright') {
				if (addremove == 'add') {
					if ((mvright_h + hpc_h) > mvleft_h) {
						mvleftright_h = mvright_h + hpc_h;
					}	
					else {
						mvleftright_h = mvleft_h;
					}	
				}	
				else if (addremove == 'remove') {
					if ((mvright_h - hpc_h) > mvleft_h) {
						mvleftright_h = mvright_h - hpc_h;
					}	
					else {
						mvleftright_h = mvleft_h;
					}	
				}	
			}	
			else {
				mvleftright_h = (mvleft_h > mvright_h) ? mvleft_h : mvright_h;;
			}	

			var mvnleftright_h = 0;
			if (position == 'mainnleft') {
				if (addremove == 'add') {
					if ((mvnleft_h + hpc_h) > mvnright_h) {
						mvnleftright_h = mvnleft_h + hpc_h;
					}	
					else {
						mvnleftright_h = mvnright_h;
					}	
				}
				else if (addremove == 'remove') {
					if ((mvnleft_h - hpc_h) > mvnright_h) {
						mvnleftright_h = mvnleft_h - hpc_h;
					}	
					else {
						mvnleftright_h = mvnright_h;
					}	
				}
			}	
			else if (position == 'mainnright') {
				if (addremove == 'add') {
					if ((mvnright_h + hpc_h) > mvnleft_h) {
						mvnleftright_h = mvnright_h + hpc_h;
					}	
					else {
						mvnleftright_h = mvnleft_h;
					}	
				}	
				else if (addremove == 'remove') {
					if ((mvnright_h - hpc_h) > mvnleft_h) {
						mvnleftright_h = mvnright_h - hpc_h;
					}	
					else {
						mvnleftright_h = mvnleft_h;
					}	
				}	
			}	
			else {
				mvnleftright_h = (mvnleft_h > mvnright_h) ? mvnleft_h : mvnright_h;;
			}	

			var mvheight_h = mvg_h + mvrow_h + mvleftright_h + mvnleftright_h;

			var mvnew_h = 0;
			if (addremove == 'add') {
				mvnew_h = (mv_h > mvheight_h) ? mv_h : mvheight_h;
			}	
			else if (addremove == 'remove') {
				mvnew_h = (mv_h < mvheight_h) ? mv_h : mvheight_h;
			}	
			else {
				mvnew_h = (mv_h < mvheight_h) ? mv_h : mvheight_h;
			}	

			var mvr_h = wih - tw_h - bw_h - 10;

			var wrapper_h = (mvr_h > mvnew_h) ? mvr_h : mvnew_h; //main-view handy-pannel count * 4 = 8;
			wrapper_h = (wrapper_h > lswrsw_h) ? wrapper_h : lswrsw_h;

			var twrb_h = tw_h + wrapper_h + bw_h;
			var twr_h = tw_h + wrapper_h;
			var wrb_h = wrapper_h + bw_h;
			twr_h = (twr_h > wrb_h) ? twr_h : wrb_h;

			var isScrollable = function () {
				var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight; 
				if (document.body.scrollHeight > h || mvnew_h > h)
					return true
				else
					return false;
			}

			text = "";
			text += sh + " screen.height " + "&#13;&#10;";
			text += wih + " window.innerHeight " + "&#13;&#10;";
			text += ddc_h + " documentElement.clientHeight " + "&#13;&#10;";
			text += dbc_h + " document.body.clientHeight " + "&#13;&#10;";
			text += dbs_h + " document.body.scrollHeight " + "&#13;&#10;";
			text += (isScrollable() ? 'scrollable' : 'scrollable none') + "&#13;&#10;";;
			text += "&#13;&#10;";

			text += tw_h + " tw_h " + "&#13;&#10;";
			text += mvg_h + " mvg_h " + "&#13;&#10;";
			text += mvrow_h + " mvrow_h " + "&#13;&#10;";
			text += mvleft_h + " " + mvright_h + " mvleft_h mvright_h " + "&#13;&#10;";
			text += mvnleft_h + " " + mvnright_h + " mvnleft_h mvnright_h " + "&#13;&#10;";
			text += mvleftright_h + " " + mvnleftright_h + " mvleftright_h mvnleftright_h " + "&#13;&#10;";
			text += hpc_h + " hpc_h " + "&#13;&#10;";
			text += mv_h + " mv_h " + "&#13;&#10;";
			text += mvheight_h + " " + mvnew_h + " " + mvr_h + " mvheight_h mvnew_h mvr_h " + "&#13;&#10;";
			text += lsw_h + " " + rsw_h + " lsw_h rsw_h " + "&#13;&#10;";
			text += bw_h + " bw_h " + "&#13;&#10;";
			text += addremove + " " + position + "&#13;&#10;";
			text += "&#13;&#10;";

			text += wrapper_h + " wrapper_h " + "&#13;&#10;";
			text += twrb_h + " twrb_h " + "&#13;&#10;";
			text += twr_h + " twr_h " + "&#13;&#10;";
			text += wrb_h + " wrb_h " + "&#13;&#10;";
			text += "&#13;&#10;";

			if (wih >= twrb_h) { 
				if (isScrollable()) {
					if (wrapper_h > lswrsw_h) {
						mv.style.height = wrapper_h + 'px';
						text += wrapper_h + " 111 ";
					}
					else {
						mv.style.height = lswrsw_h + 'px';
						text += lswrsw_h + " 112 ";
					}		
				}
				else {
					mv.style.height = wrapper_h + 'px';
					text += wrapper_h + " 12 ";
				}	
			}	
			else {	
				if (wih >= twr_h) { 
					if (isScrollable()) {
						if (wrapper_h > lswrsw_h) {
							mv.style.height = wrapper_h + 'px';
							text += wrapper_h + " 211 ";
						}	
						else {
							mv.style.height = lswrsw_h + 'px';
							text += lswrsw_h + " 212 ";
						}	
					}
					else {
						mv.style.height = twr_h + 'px';
						text += twr_h + " 221 ";
					}	
				}	
				else {
					if (isScrollable()) {
						if (wrapper_h > lswrsw_h) {
							mv.style.height = wrapper_h + 'px';
							text += wrapper_h + " 231 ";
						}	
						else {
							mv.style.height = lswrsw_h + 'px';
							text += lswrsw_h + " 232 ";
						}	
					}	
					else {
						mv.style.height = lswrsw_h + 'px';
						text += lswrsw_h + " 24 ";
					}	
				}	
			}	

			disp_height(text);
		}
	</script>

	<script type="text/javascript">
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
			var mvr_h = wih - tw_h - bw_h - 10;

			if (ar == '')
				mvr_h = wih - tw_h - bw_h - 4;

			if (mvr_h > lswrsw_h) {
				if (mvr_h > mvnet_h) {
					mvdummy_h = mvr_h - mvnet_h;
				}
			}				
			else if (mvr_h > mvnet_h) {
				mvdummy_h = mvr_h - mvnet_h;
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
			text += mvr_h + " mvr_h " + "&#13;&#10;";
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
			else {
				if (set_height_main_view_wrapper)
					setheight_main_view_wrapper();
				else	
					setheight_main_view_dummy();
			}	
		//} );		
	</script>

</div><!--body-wrapper--> 

</body>
</html>
