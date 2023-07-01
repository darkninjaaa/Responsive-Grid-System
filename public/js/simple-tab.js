
var TABS_INFO = "tabs_info";
var TABS_INFO_CONTENTS = "tabs_info_contents";
var TABS_CONTENTS = "tabs_contents";
var TABS_PREV = "tabs_prev";
var TABS_NEXT = "tabs_next";
var TABS_ACTIVE = "active";
var TABS_ALINK = "alink";


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

var SimpleTab = function() 
{
    function SimpleTab() 
	{
        var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
		
        _classCallCheck(this, SimpleTab);
		
        _extends(this, {
			tabs_info : TABS_INFO,
			tabs_info_contents : TABS_INFO_CONTENTS,
			tabs_contents : TABS_CONTENTS,
			tabs_prev : TABS_PREV,
			tabs_next : TABS_NEXT,
			tabs_active : TABS_ACTIVE,
			tabs_alink : TABS_ALINK
        }, options);

		this.tabs_info = document.getElementById(this.tabs_info);
		this.tabs_info_contents = document.getElementById(this.tabs_info_contents);

		this.tabList = this.tabs_info.getElementsByTagName("li")
		this.contentList = this.tabs_info_contents.querySelectorAll("."+this.tabs_contents);

        this.init();
    }
	
    _createClass( SimpleTab, 
		[	
			{
				key: "init",
				value: function init() {
					this.setListner_Prevclick();
					this.setListner_Nextclick();
					this.setListner_aLink();
					var item = this.element_Hasclass(this.tabList, this.tabs_active);
					if (item) {
						item.querySelector("."+this.tabs_alink).click();
					}	
				}
			}, 
			{
				key: "setListner_aLink",
				value: function setListner_aLink() {
					var _thisalink = this;
					for(var i = 0; i < this.tabList.length; i++)
					{
						this.tabList[i].querySelector("."+this.tabs_alink).addEventListener('click', function(event)
						{
							event.preventDefault();
							for(var j = 0; j < _thisalink.tabList.length; j++) {
								_thisalink.tabList[j].classList.remove(_thisalink.tabs_active);
								_thisalink.contentList[j].style.display = 'none';
							}
							this.parentNode.classList.add(_thisalink.tabs_active);

							var tabs_contents_id = this.getAttribute('href');
							document.querySelector(tabs_contents_id).style.display = 'block';
							return false; 
						} );
					}
				}
			}, 
			{
				key: "setListner_Prevclick",
				value: function setListner_Prevclick() {
					var _thisprev = this;
					var tabs_prev = document.getElementById(this.tabs_prev);
					tabs_prev.addEventListener('click', function(event) 
					{
						var item = _thisprev.item_Prev(_thisprev.tabList, _thisprev.tabs_active);
						if (item) {
							item.querySelector("."+_thisprev.tabs_alink).click();
						}	
						return false;
					} );	
				}
			}, 
			{
				key: "setListner_Nextclick",
				value: function setListner_Nextclick() {
					var _thisnext = this;
					var tabs_next = document.getElementById(this.tabs_next);
					tabs_next.addEventListener('click', function(event) 
					{
						var item = _thisnext.item_Next(_thisnext.tabList, _thisnext.tabs_active);
						if (item) {
							item.querySelector("."+_thisnext.tabs_alink).click();
						}	
						return false;
					} );	
				}
			}, 
			{
				key: "element_Hasclass",
				value: function element_Hasclass(items, className) {
					//alert(JSON.stringify(items));
					for(var i = 0; i < items.length; i++) {
						var classlist = items[i].classList;
						for(var j = 0; j < classlist.length; j++) {
							if (classlist[j] == className) {
								return items[i];
							}
						}	
					}
					return false;
				}
			},
			{
				key: "item_Prev",
				value: function item_Prev(items, className) {
					var item = this.element_Hasclass(items, className);
					for(var i = 0; i < items.length; i++) {
						if (items[i] == item) {
							if (i > 0) {
								return items[i-1];
							}
						}	
					}
					return false;
				}
			},
			{
				key: "item_Next",
				value: function item_Next(items, className) {
					var item = this.element_Hasclass(items, className);
					for(var i = 0; i < items.length; i++) {
						if (items[i] == item) {
							if (i < items.length-1) {
								return items[i+1];
							}
						}	
					}
					return false;
				}
			}
		]
	);
    
	return SimpleTab;
}();

if ((typeof module === "undefined" ? "undefined" : _typeof(module)) === 'object') {
    module.exports = SimpleTab;
}
