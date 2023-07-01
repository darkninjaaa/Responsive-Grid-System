
var HANDY_PANEL           = "handy-panel";
var HANDY_SUBPANEL        = "handy-subpanel";
var HANDY_PANELCONTENT    = "handy-panelcontent";

var HANDY_NAMESPACE_HEAD  = "data"
var HANDY_NAMESPACE       = "basic"
var HANDY_HEADING_TAG     = "button";
var HANDY_CONTENT_TAG     = "content";

var HANDY_EXPAND_CLASS    = "expand";
var HANDY_COLLAPSED_CLASS = "collapsed";

var HANDY_COOKIE_NAME     = "handy-panels";
var HANDY_CSS_EASING      = "ease-in-out";

var HANDY_ANIMATION_DELAY = 400; /*ms*/
var HANDY_ANIMATION_STEPS = 10;

var HANDY_PANEL_LEFT      = "left";
var HANDY_PANEL_RIGHT     = "right";

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

function getHandyPanelsHeight()
{
	var panelsList = document.getElementsByClassName(HANDY_PANEL);
	var panelsleft = new Array();
	var panelsright = new Array();
	var lh = 0;
	var rh = 0;
	var panel;

	for (var i=0; i<panelsList.length; i++)
	{
		panel = panelsList[i];
		if (panel.classList.contains(HANDY_PANEL_LEFT)) {
			lh += panel.offsetHeight;
		}	
		else if (panel.classList.contains(HANDY_PANEL_RIGHT)) {
			rh += panel.offsetHeight;
		}	
	}
	
	var lsw = document.getElementById('left_sidebar_wrapper');
	var lsw_h = window.getComputedStyle(lsw).height;
	lsw_h = Number(lsw_h.replace('px', ''));

	var rsw = document.getElementById('right_sidebar_wrapper');
	var rsw_h = window.getComputedStyle(rsw).height;
	rsw_h = Number(rsw_h.replace('px', ''));

	var big_lr = (lh>rh) ? lh : rh;
	var big_lswrsw = (lsw_h>rsw_h) ? lsw_h : rsw_h;
	var big = (big_lr>big_lswrsw) ? big_lr : big_lswrsw;

    var ret = [];
	ret['lh'] = lh;
	ret['rh'] = rh;
	ret['lsw_h'] = lsw_h;
	ret['rsw_h'] = rsw_h;
	ret['big_lr'] = big_lr;
	ret['big_lswrsw'] = big_lswrsw;
	ret['big'] = big;

	return ret;
}

var HandyCollapse = function() 
{
    function HandyCollapse() 
	{
        var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
		
        _classCallCheck(this, HandyCollapse);
		
        _extends(this, {
            nameSpace: (options.nameSpace || HANDY_NAMESPACE), 
            toggleHeadingAttr: HANDY_NAMESPACE_HEAD + "-" + (options.nameSpace || HANDY_NAMESPACE) + "-" + HANDY_HEADING_TAG,
            toggleContentAttr: HANDY_NAMESPACE_HEAD + "-" + (options.nameSpace || HANDY_NAMESPACE) + "-" + HANDY_CONTENT_TAG,
            isAimation: true,
            closeOthers: true,
            animatinSpeed: HANDY_ANIMATION_DELAY,
            cssEasing: HANDY_CSS_EASING,
			cookie_name : HANDY_COOKIE_NAME + "-" + (options.nameSpace || HANDY_NAMESPACE),
            onSlideStart: function onSlideStart() {
                return false;
            },
            onSlideEnd: function onSlideEnd() {
                return false;
            }
        }, options);
		
        this.toggleHeadingEls = document.querySelectorAll("[" + this.toggleHeadingAttr + "]");
        this.toggleContentEls = document.querySelectorAll("[" + this.toggleContentAttr + "]");
        this.itemsStatus = [];

		this.loadSettings();
        this.init();
    }
	
    _createClass( HandyCollapse, 
		[	
			{
				key: "init",
				value: function init() {
					if (this.toggleHeadingEls) {
						this.setListner();
					}
					if (this.toggleContentEls) {
						this.setItem();
					}
					this.refresh();
				}
			}, 
			{
				key: "loadSettings",
				value: function loadSettings() {
					// prepare the object that will keep the panel statuses
					this.itemsStatus = [];
					var s, state = this.getcookie();	
					if (state) {
                        try {
							s = JSON.parse(state);	
                        } catch (e1) {
                            s = null;
                        }
						if (s) {
							var sp = s.panelsData;		
							for (var i = 0; i < sp.length; i++) {
								var key = sp[i][0];
								var value = sp[i][1];
								if (key == "undefined" || key == null || key == "") {
									//alert(key + " " + value);
								}	
								else {	
									this.itemsStatus[key] = value;
								}	
							}	
						}
					}	
				}
			}, 
			{
				key: "saveSettings",
				value: function saveSettings(id, expand) {
					// put the new expanding in the object
					this.itemsStatus[id] = expand;
	
					// create an array that will keep the contentid:expanding pairs
					var panelsData = [];
					for (var cid in this.itemsStatus) {
						if (cid == "undefined" || cid == null || cid == "") {
							//alert(cid + " " + this.itemsStatus[cid]);
						}	
						else {	
							panelsData.push([cid, this.itemsStatus[cid]]);
						}	
					}	

					var state_json = {
						panelsData : panelsData
					};

					var state = JSON.stringify(state_json);
		
					// set the cookie expiration date 1 year from now
					var today = new Date();
					var expirationDate = new Date(today.getTime() + 1 * 1000 * 60 * 60 * 24);
					
					// write the cookie
					document.cookie = this.cookie_name + "=" + encodeURIComponent(state) + "; expires=" + expirationDate.toGMTString() + "; path=/";
				}
			}, 
			{
				key: "getAllcookies",
				value: function getAllcookies() {
					var c = [];
					if (document.cookie && document.cookie != '') {
						var split = document.cookie.split(';');
						for (var i = 0; i < split.length; i++) {
							var name_value = split[i].split("=");
							name_value[0] = name_value[0].replace(/^ /, '');
								
							var name = decodeURIComponent(name_value[0]);
							var value = decodeURIComponent(name_value[1]);

							c[name] = value;
						}
					}
					return c;
				}
			},	
			{
				key: "getcookie",
				value: function getcookie() {
					var c = this.getAllcookies();
					var cr = [];
					for (var key in c) {
						if (key == this.cookie_name) { 
							cr = c[key];
							break;
						}	
					}
					return cr;
				}
			},	
			{
				key: "setListner",
				value: function setListner() {
					var _this2 = this;
					Array.prototype.slice.call(this.toggleHeadingEls).forEach(function(buttonEl, index) {
						var id = buttonEl.getAttribute(_this2.toggleHeadingAttr);
						if (id) {
							buttonEl.addEventListener("click", function(e) {
								e.preventDefault();
								_this2.toggleSlide(id, buttonEl);
							}, false);
						}
					});
				}
			}, 
			{
				key: "setItem",
				value: function setItem() {
					var _this = this;
					Array.prototype.slice.call(this.toggleContentEls).forEach(function(contentEl) {
						contentEl.style.maxHeight = "none";
					});
				}
			}, 
			{
				key: "setItemStatus",
				value: function setItemStatus(id, collapsed) {
					this.itemsStatus[id] = collapsed;
				}
			}, 
			{
				key: "expandAll",
				value: function expandAll() {
					for (var id in this.itemsStatus)
						this.setItemStatus(id, HANDY_EXPAND_CLASS);
		
					this.saveSettings();
					this.refresh();
				}
			}, 
			{
				key: "collapseAll",
				value: function collapseAll() {
					for (var id in this.itemsStatus)
						this.setItemStatus(id, HANDY_COLLAPSED_CLASS);
		
					this.saveSettings();
					this.refresh();
				}
			}, 
			{
				key: "refresh",
				value: function refresh() {
					var _this2 = this;
					Array.prototype.slice.call(this.toggleHeadingEls).forEach(function(buttonEl, index) {
						var id = buttonEl.getAttribute(_this2.toggleHeadingAttr);
						if (id) {

							// look for the id in loaded settings, apply the normal/collapsed class
							if (_this2.itemsStatus.hasOwnProperty(id)) {
								if (_this2.itemsStatus[id] == HANDY_EXPAND_CLASS) {
									buttonEl.parentNode.classList.remove(HANDY_COLLAPSED_CLASS);
									buttonEl.parentNode.classList.add(HANDY_EXPAND_CLASS);
								}	
								else {
									buttonEl.parentNode.classList.remove(HANDY_EXPAND_CLASS);
									buttonEl.parentNode.classList.add(HANDY_COLLAPSED_CLASS);
								}	
							}	
							else {
								// if no saved setting, see the initial setting
								_this2.itemsStatus[id] = 
									(buttonEl.parentNode.classList.contains(HANDY_EXPAND_CLASS)) ? HANDY_EXPAND_CLASS : HANDY_COLLAPSED_CLASS;
							}
						
							var expand = buttonEl.parentNode.classList.contains(HANDY_EXPAND_CLASS);

							_this2.setItemStatus(id, expand ? HANDY_EXPAND_CLASS : HANDY_COLLAPSED_CLASS);
							
							if (expand) {
								_this2.open(id, false, false);
							} else {
								_this2.close(id, false, false);
							}
						}
					});
				}
			}, 
			{
				key: "toggleSlide",
				value: function toggleSlide(id, buttonEl) {
					var isRunCallback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;

					if (this.itemsStatus[id] == HANDY_EXPAND_CLASS) {
						this.saveSettings(id, HANDY_COLLAPSED_CLASS);
						this.close(id, isRunCallback, this.isAimation);
					} else {
						this.saveSettings(id, HANDY_EXPAND_CLASS);
						this.open(id, isRunCallback, this.isAimation);
					}
				}
			}, 
			{
				key: "open",
				value: function open(id) {
					var _this3 = this;
					var isRunCallback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
					var isAimation = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
					if (!id) return;
					if (this.closeOthers) {
						Array.prototype.slice.call(this.toggleHeadingEls).forEach(function(buttonEl, index) {
							var closeId = buttonEl.getAttribute(_this3.toggleHeadingAttr);
							if (closeId !== id) _this3.close(closeId, false, isAimation);
						});
					}
					if (isRunCallback !== false) this.onSlideStart(true, id);
					var toggleButton = document.querySelector("[" + this.toggleHeadingAttr + "='" + id + "']");
					var toggleContent = document.querySelector("[" + this.toggleContentAttr + "='" + id + "']");
					var clientHeight = this.getTargetHeight(toggleContent);
					toggleButton.parentNode.classList.remove(HANDY_COLLAPSED_CLASS);
					toggleButton.parentNode.classList.add(HANDY_EXPAND_CLASS);
					if (isAimation) {
						toggleContent.style.transition = this.animatinSpeed + "ms " + this.cssEasing;
						toggleContent.style.maxHeight = (clientHeight || "1000") + "px";
						setTimeout(function() {
							if (isRunCallback !== false) _this3.onSlideEnd(true, id);
							toggleContent.style.maxHeight = "none";
							toggleContent.style.transition = "";
						}, this.animatinSpeed);
					} else {
						toggleContent.style.maxHeight = "none";
					}
					this.itemsStatus[id] = HANDY_EXPAND_CLASS;
				}
			}, 
			{
				key: "close",
				value: function close(id) {
					var _this4 = this;
					var isRunCallback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
					var isAimation = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
					if (!id) return;
					if (isRunCallback !== false) this.onSlideStart(false, id);
					var toggleButton = document.querySelector("[" + this.toggleHeadingAttr + "='" + id + "']");
					var toggleContent = document.querySelector("[" + this.toggleContentAttr + "='" + id + "']");
					toggleButton.parentNode.classList.remove(HANDY_EXPAND_CLASS);
					toggleButton.parentNode.classList.add(HANDY_COLLAPSED_CLASS);
					toggleContent.style.maxHeight = toggleContent.clientHeight + "px";
					setTimeout(function() {
						toggleContent.style.maxHeight = "0px";
					}, 5);
					if (isAimation) {
						toggleContent.style.transition = this.animatinSpeed + "ms " + this.cssEasing;
						setTimeout(function() {
							if (isRunCallback !== false) _this4.onSlideEnd(false, id);
							toggleContent.style.transition = "";
						}, this.animatinSpeed);
					} else {
						this.onSlideEnd(false, id);
					}
					this.itemsStatus[id] = HANDY_COLLAPSED_CLASS;
				}
			}, 
			{
				key: "getTargetHeight",
				value: function getTargetHeight(targetEl) {
					if (!targetEl) return;
					var cloneEl = targetEl.cloneNode(true);
					var parentEl = targetEl.parentNode;
					cloneEl.style.maxHeight = "none";
					cloneEl.style.opacity = "0";
					parentEl.appendChild(cloneEl);
					targetEl.style.display = "block";
					var clientHeight = cloneEl.clientHeight;
					parentEl.removeChild(cloneEl);
					return clientHeight;
				}
			}
		]
	);
    
	return HandyCollapse;
}();

if ((typeof module === "undefined" ? "undefined" : _typeof(module)) === 'object') {
    module.exports = HandyCollapse;
}
