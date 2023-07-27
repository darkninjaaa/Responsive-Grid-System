var HANDY_PANEL            = "handy-panel";
var HANDY_SUBPANEL         = "handy-subpanel";
var HANDY_PANELCONTENT     = "handy-panelcontent";

var HANDY_NAMESPACE_HEAD   = "data";
var HANDY_NAMESPACE        = "basic";

var HANDY_NAMESPACE_LEFT   = "left";
var HANDY_NAMESPACE_NESTED = "nested";
var HANDY_NAMESPACE_MROW   = "mainrow";
var HANDY_NAMESPACE_MLEFT  = "mainleft";
var HANDY_NAMESPACE_MRIGHT = "mainright";
var HANDY_NAMESPACE_MNLEFT  = "mainnleft";
var HANDY_NAMESPACE_MNRIGHT = "mainnright";
var HANDY_NAMESPACE_RIGHT  = "right";
var HANDY_NAMESPACE_NPARENT = "nestedparent";
var HANDY_NAMESPACE_NCHILD  = "nestedchild";

var HANDY_HEADING_TAG      = "button";
var HANDY_CONTENT_TAG      = "content";

var HANDY_EXPAND_CLASS     = "expand";
var HANDY_COLLAPSED_CLASS  = "collapsed";

var HANDY_COOKIE_NAME      = "handy-panels";
var HANDY_CSS_EASING       = "ease-in-out";

var HANDY_ANIMATION_DELAY  = 400; /*ms*/
var HANDY_DISPLAY_DELAY    = 0; /*ms*/

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

var HandyCollapse = function() 
{
    function HandyCollapse() 
	{
        var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
		
        _classCallCheck(this, HandyCollapse);
		
        _extends(this, {
            nameSpace: (options.nameSpace || HANDY_NAMESPACE), 
            nameSpaceLeft: (options.nameSpaceLeft || HANDY_NAMESPACE_LEFT), 
            nameSpaceNested: (options.nameSpaceNested || HANDY_NAMESPACE_NESTED), 
            nameSpaceMrow: (options.nameSpaceMrow || HANDY_NAMESPACE_MROW), 
            nameSpaceMleft: (options.nameSpaceMleft || HANDY_NAMESPACE_MLEFT), 
            nameSpaceMright: (options.nameSpaceMright || HANDY_NAMESPACE_MRIGHT), 
            nameSpaceMnleft: (options.nameSpaceMnleft || HANDY_NAMESPACE_MNLEFT), 
            nameSpaceMnright: (options.nameSpaceMnright || HANDY_NAMESPACE_MNRIGHT), 
            nameSpaceRight: (options.nameSpaceRight || HANDY_NAMESPACE_RIGHT), 
            nameSpaceNparent: (options.nameSpaceNparent || HANDY_NAMESPACE_NPARENT), 
            nameSpaceNchild: (options.nameSpaceNchild || HANDY_NAMESPACE_NCHILD), 
            toggleHeadingAttr: HANDY_NAMESPACE_HEAD + "-" + (options.nameSpace || HANDY_NAMESPACE) + "-" + HANDY_HEADING_TAG,
            toggleContentAttr: HANDY_NAMESPACE_HEAD + "-" + (options.nameSpace || HANDY_NAMESPACE) + "-" + HANDY_CONTENT_TAG,
            isAimation: true,
	        isRunCallback: true,
            closeOthers: false,
            animationDelay: HANDY_ANIMATION_DELAY,
			displayDelay: HANDY_DISPLAY_DELAY,
            cssEasing: HANDY_CSS_EASING,
			cookie_name : HANDY_COOKIE_NAME + "-" + (options.nameSpace || HANDY_NAMESPACE),
            onToggleStart: (options.onToggleStart || false), 
            onToggleEnd: (options.onToggleEnd || false), 
            onSlideStart: (options.onSlideStart || function onSlideStart() { return false; }),
            onSlideEnd: (options.onSlideEnd || function onSlideEnd() { return false; })
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
		
					// set the cookie expiration date 1 day from now
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
					var _this = this;
					Array.prototype.slice.call(this.toggleHeadingEls).forEach(function(buttonEl, index) {
						var id = buttonEl.getAttribute(_this.toggleHeadingAttr);
						if (id) {
							buttonEl.addEventListener("click", function(e) {
								e.preventDefault();
								_this.toggleSlide(id, _this.isRunCallback, _this.isAimation);
							}, false);
						}
					});
				}
			}, 
			{
				key: "setItem",
				value: function setItem() {
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
					var _this = this;
					Array.prototype.slice.call(this.toggleHeadingEls).forEach(function(buttonEl, index) {
						var id = buttonEl.getAttribute(_this.toggleHeadingAttr);
						if (id) {

							// look for the id in loaded settings, apply the normal/collapsed class
							if (_this.itemsStatus.hasOwnProperty(id)) {
								if (_this.itemsStatus[id] == HANDY_EXPAND_CLASS) {
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
								_this.itemsStatus[id] = 
									(buttonEl.parentNode.classList.contains(HANDY_EXPAND_CLASS)) ? HANDY_EXPAND_CLASS : HANDY_COLLAPSED_CLASS;
							}
						
							var expand = buttonEl.parentNode.classList.contains(HANDY_EXPAND_CLASS);

							_this.setItemStatus(id, expand ? HANDY_EXPAND_CLASS : HANDY_COLLAPSED_CLASS);
							
							if (expand) {
								_this.open(id, false, false);
							} else {
								_this.close(id, false, false);
							}
						}
					});
				}
			}, 
			{
				key: "toggleSlide",
				value: function toggleSlide(id, isRunCallback, isAimation) {
					var _this = this;
					var isRunCallback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
					var addremove = '';
					var ar = '';
					var clientHeight = 0;
					var delay = 0;
					var position = '';

					var toggleButton = document.querySelector("[" + this.toggleHeadingAttr + "='" + id + "']");
					var nestedparentchild = '';
					if (toggleButton.parentNode.classList.contains(this.nameSpaceNparent))
						nestedparentchild = 'nestedparent';
					if (toggleButton.parentNode.classList.contains(this.nameSpaceNchild))
						nestedparentchild = 'nestedchild';

					if (this.nameSpace == this.nameSpaceLeft) //"left"
						position = this.nameSpaceLeft;
					else if (this.nameSpace == this.nameSpaceNested) //"nested" left nested
						position = this.nameSpaceNested;
					else if (this.nameSpace == this.nameSpaceMrow) // "mainrow" main left right same height
						position = this.nameSpaceMrow;
					else if (this.nameSpace == this.nameSpaceMleft) //"mainleft"
						position = this.nameSpaceMleft;
					else if (this.nameSpace == this.nameSpaceMright) //"mainright"
						position = this.nameSpaceMright;
					else if (this.nameSpace == this.nameSpaceMnleft) //"mainnleft" main nested left
						position = this.nameSpaceMnleft;
					else if (this.nameSpace == this.nameSpaceMnright) //"mainnright" main nested right
						position = this.nameSpaceMnright;
					else if (this.nameSpace == this.nameSpaceRight) //"right"
						position = this.nameSpaceRight;
					if (this.itemsStatus[id] == HANDY_EXPAND_CLASS) {
						this.saveSettings(id, HANDY_COLLAPSED_CLASS);
						if (position == this.nameSpaceMleft || position == this.nameSpaceMright || position == this.nameSpaceMrow ||
							position == this.nameSpaceMnleft || position == this.nameSpaceMnright)
							addremove = 'remove';
						ar = 'remove';
						if (this.onToggleStart !== false) {
							_this.onToggleStart(addremove, position);
						}
						clientHeight = this.close(id, isRunCallback, isAimation);
						if (nestedparentchild != 'nestedchild')
							delay = this.animationDelay;
					} else {
						this.saveSettings(id, HANDY_EXPAND_CLASS);
						if (position == this.nameSpaceMleft || position == this.nameSpaceMright || position == this.nameSpaceMrow ||
							position == this.nameSpaceMnleft || position == this.nameSpaceMnright)
							addremove = 'add';
						ar = 'add';
						if (this.onToggleStart !== false) {
							_this.onToggleStart(addremove, position);
						}
						clientHeight = this.open(id, isRunCallback, isAimation);
						if (this.displayDelay != 0)
							delay = this.displayDelay;
					}
					if (this.onToggleEnd !== false) {
						setTimeout(function() { _this.onToggleEnd(clientHeight, addremove, ar, position, nestedparentchild); }, delay);
					}
				}
			}, 
			{
				key: "open",
				value: function open(id, isRunCallback, isAimation) {
					var _this = this;
					if (!id) return;
					if (this.closeOthers) {
						Array.prototype.slice.call(this.toggleHeadingEls).forEach(function(buttonEl, index) {
							var closeId = buttonEl.getAttribute(_this.toggleHeadingAttr);
							if (closeId !== id) _this.close(closeId, false, isAimation);
						});
					}
					if (isRunCallback !== false) this.onSlideStart(true, id);
					var toggleButton = document.querySelector("[" + this.toggleHeadingAttr + "='" + id + "']");
					var toggleContent = document.querySelector("[" + this.toggleContentAttr + "='" + id + "']");
					var clientHeight = this.getTargetHeight(toggleContent);
					toggleButton.parentNode.classList.remove(HANDY_COLLAPSED_CLASS);
					toggleButton.parentNode.classList.add(HANDY_EXPAND_CLASS);
					if (isAimation) {
						toggleContent.style.transition = this.animationDelay + "ms " + this.cssEasing;
						toggleContent.style.maxHeight = (clientHeight || "1000") + "px";
						setTimeout(function() {
							if (isRunCallback !== false) _this.onSlideEnd(true, id);
							toggleContent.style.maxHeight = "none";
							toggleContent.style.transition = "";
						}, this.animationDelay);
					} else {
						toggleContent.style.maxHeight = "none";
					}
					this.itemsStatus[id] = HANDY_EXPAND_CLASS;

					if (clientHeight == 0) {
						clientHeight = this.getTargetHeight(toggleContent);
					}	
					return clientHeight;
				}
			}, 
			{
				key: "close",
				value: function close(id, isRunCallback, isAimation) {
					var _this = this;
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
						toggleContent.style.transition = this.animationDelay + "ms " + this.cssEasing;
						setTimeout(function() {
							if (isRunCallback !== false) _this.onSlideEnd(false, id);
							toggleContent.style.transition = "";
						}, this.animationDelay);
					} else {
						this.onSlideEnd(false, id);
					}
					this.itemsStatus[id] = HANDY_COLLAPSED_CLASS;
					
					return toggleContent.clientHeight;
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
