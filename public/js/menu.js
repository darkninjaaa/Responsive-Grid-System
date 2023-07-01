/**
 * Menu.js v1.0.0
 */

var MENU_NAV_BUTTON = "nav-button"
var MENU_NAV_UL     = "nav-ul"

if (!_typeof) {
	var _typeof = 
		typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? 
			function(obj) { return typeof obj; } : 
			function(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };
}


if (!_extends) {
	var _extends = Object.assign || function(target) 
	{
		for (var i = 1; i < arguments.length; i++) {
			var source = arguments[i];
			for (var key in source) {
				if (Object.prototype.hasOwnProperty.call(source, key)) {
					target[key] = source[key];
				}
			}
		}
		return target;
	};
}


if (!_createClass) {
	var _createClass = function() 
	{
		function defineProperties(target, props) {
			for (var i = 0; i < props.length; i++) {
				var descriptor = props[i];
			
				descriptor.enumerable = descriptor.enumerable || false;
				descriptor.configurable = true;
			
				if ("value" in descriptor) descriptor.writable = true;
			
				Object.defineProperty(target, descriptor.key, descriptor);
			}
		}
		return function(Constructor, protoProps, staticProps) {
			if (protoProps) defineProperties(Constructor.prototype, protoProps);
			if (staticProps) defineProperties(Constructor, staticProps);
		
			return Constructor;
		};
	}();
}

if (!_classCallCheck) {
	function _classCallCheck(instance, Constructor) 
	{
		if (!(instance instanceof Constructor)) {
			throw new TypeError("Cannot call a class as a function");
		}
	}	
}

var Menu = function() 
{
    function Menu() 
	{
        var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
        _classCallCheck(this, Menu);
        _extends(this, {
            nav_button: MENU_NAV_BUTTON, /* id */
            nav_ul: MENU_NAV_UL /* id */
        }, options);

		this.LastselectedulLi = null;
        this.init();
	}

    _createClass( Menu, 
		[	
			{
				key: "init",
				value: function init() {
					this.setListner_Navclick();
					this.setListner_NavUlLiclick();
					this.setListner_bodyclick();
					this.setListner_bodykeyup();
				}
			}, 
			{
				key: "setListner_Navclick",
				value: function setListner_Navclick() {
					var _thisNavclick = this;
					var nav_button = document.getElementById(_thisNavclick.nav_button);
					nav_button.addEventListener('click', function(event) {
						event.preventDefault();
						var nav_ul = document.getElementById(_thisNavclick.nav_ul);
						if (nav_ul.classList.contains('open')) {
							nav_ul.classList.remove('open');
						}	
						else {
							nav_ul.classList.add('open');
						}
						return false; 
					} );
				}
			},
			{
				key: "setListner_NavUlLiclick",
				value: function setListner_NavUlLiclick() {
					var _thisNavUlLi = this;
					var menuItems = document.querySelectorAll("#"+_thisNavUlLi.nav_ul+" > li > a > span")
					for (var i = 0; i < menuItems.length; i++) {
						menuItems[i].addEventListener('click', function(event) {
						    event.preventDefault();
							_thisNavUlLi.NavUlLi_open(event);
							return false;
						} );
					}	
				}
			},
			{
				key: "NavUlLi_open",
				value: function NavUlLi_open(event) {
					var	itemulLi = event.target.parentNode.parentNode;
					if( this.LastselectedulLi !== null ) {
						if (this.LastselectedulLi.classList.contains('submenuopen')) {
							this.LastselectedulLi.classList.remove('submenuopen');
						}	
					}
					if( this.LastselectedulLi == itemulLi ) {
						if (itemulLi.classList.contains('submenuopen')) {
							itemulLi.classList.remove('submenuopen');
						}	
						this.LastselectedulLi = null;
					}
					else {
						if (event.target.parentNode.getAttribute('hyperlink') != "true") { 
							itemulLi.classList.add('submenuopen');
							this.LastselectedulLi = itemulLi;
						}	
					}	
					if (event.target.parentNode.getAttribute('hyperlink') == "true") { 
						if (event.target.parentNode.getAttribute('target_blank') == "true")  
							window.open(event.target.parentNode.getAttribute('href')); 
						else 
							location.href = event.target.parentNode.getAttribute('href'); 
					}
				}
			},
			{
				key: "setListner_bodyclick", //display: none; nav-ul > li > ul
				value: function setListner_bodyclick() {
					var _thisbodyclick = this;
					var body = document.body;
					body.addEventListener('click', function(event) {
						var itemulLi = _thisbodyclick.LastselectedulLi;
						// event.target.closest('.')
						// event.target.parentNode.querySelector('.')
						if (itemulLi !== null && ! itemulLi.contains(event.target.parentNode)) {
							if (itemulLi.classList.contains('submenuopen')) {
								itemulLi.classList.remove('submenuopen');
							}	
							_thisbodyclick.LastselectedulLi = null;
						}	
					} );
				}
			},
			{
				key: "setListner_bodykeyup", //display: none; nav-ul > li > ul
				value: function setListner_bodykeyup() {
					var _thisbodykeyup = this;
					var body = document.body;
					body.addEventListener('keyup', function(event) {
						if (event.code == 'Escape') {
							var itemulLi = _thisbodykeyup.LastselectedulLi;
							if (itemulLi !== null) {
								if (itemulLi.classList.contains('submenuopen')) {
									itemulLi.classList.remove('submenuopen');
								}	
								_thisbodykeyup.LastselectedulLi = null;
							}	
						}	
					} );
				}
			}
		]
	);
    
	return Menu;
}();
	
if ((typeof module === "undefined" ? "undefined" : _typeof(module)) === 'object') {
    module.exports = Menu;
}
