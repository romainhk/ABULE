editAreaLoader.load_syntax["js"] = {
	'DISPLAY_NAME' : 'Javascript'
	,'COMMENT_SINGLE' : {1 : '//'}
	,'COMMENT_MULTI' : {'/*' : '*/'}
	,'QUOTEMARKS' : {1: "'", 2: '"'}
	,'KEYWORD_CASE_SENSITIVE' : false
	,'KEYWORDS' : {
		'statements' : [
			'as', 'break', 'case', 'catch', 'continue', 'decodeURI', 'delete', 'do',
			'else', 'encodeURI', 'eval', 'finally', 'for', 'if', 'in', 'is', 'item',
			'instanceof', 'return', 'switch', 'this', 'throw', 'try', 'typeof', 'void',
			'while', 'write', 'with'
		]
		,'keywords' : [
			'Anchor', 'Area', 'Array', 'assign', 'Boolean', 'Button', 'callee', 
			'Checkbox', 'class', 'closed', 'constructor', 'Date', 'default', 
			'defaultStatus', 'debugger', 'document', 'Document', 'Element', 
			'export', 'extends', 'false', 'FileUpload', 'Form', 'Frame', 
			'frames', 'function', 'Function', 'getClass', 'Hidden', 'history', 
			'History', 'Image', 'import', 'Infinity', 'innerHeight', 
			'innerWidth', 'java', 'JavaArray', 'JavaClass', 'JavaObject', 
			'JavaPackage', 'length', 'Link', 'location', 'Location', 
			'locationbar', 'Math', 'menubar', 'MimeType', 'namespace', 'NaN', 
			'navigator', 'Navigator', 'netscape', 'new', 'null', 'Number', 
			'Object', 'onBlur', 'onError', 'onFocus', 'onLoad', 'onUnload', 
			'opener', 'Option', 'outerHeight', 'outerWidth', 'package', 
			'Packages', 'pageXoffset', 'pageYoffset', 'parent', 'Password', 
			'personalbar', 'Plugin', 'private', 'protected', 'prototype', 
			'public', 'Radio', 'ref', 'RegExp', 'Reset', 'scrollbars', 
			'Select', 'self', 'statusbar', 'String', 'Submit', 'sun', 
			'super', 'Text', 'Textarea', 'toolbar', 'top', 'true', 'use', 
			'window', 'Window', 
			// New
			'abstract', 'boolean', 'byte', 'char', 'const', 'double', 'export', 
			'final', 'float', 'goto', 'implements', 'long', 'native', 'short', 
			'synchronized', 'throws', 'transient', 'var'
		]
		,'functions' : [
			// common functions for Window object
			'alert', 'arguments', 'back', 'blur', 'caller', 'captureEvents', 
			'clearInterval', 'clearTimeout', 'close', 'confirm', 'escape', 
			'eval', 'find', 'focus', 'forward', 'handleEvent', 'home', 
			'isFinite', 'isNan', 'moveBy', 'moveTo', 'name', 'navigate', 
			'onblur', 'onerror', 'onfocus', 'onload', 'onmove', 'onresize', 
			'onunload', 'open', 'parseFloat', 'parseInt', 'print', 'prompt', 
			'releaseEvents', 'resizeBy', 'resizeTo', 'routeEvent', 'scroll', 
			'scrollBy', 'scrollTo', 'setInterval', 'setTimeout', 'status',
			'stop', 'taint', 'toString', 'unescape', 'untaint', 'unwatch', 
			'valueOf', 'watch'
		]
	}
	,'OPERATORS' :[
		'+', '-', '/', '*', '=', '<', '>', '%', '!'
	]
	,'DELIMITERS' :[
		'(', ')', '[', ']', '{', '}'
	]
	,'STYLES' : {
		'COMMENTS': 'color: #AAAAAA;'
		,'QUOTESMARKS': 'color: #6381F8;'
		,'KEYWORDS' : {
			'statements' : 'color: #60CA00;'
			,'keywords' : 'color: #48BDDF;'
			,'functions' : 'color: #2B60FF;'
		}
		,'OPERATORS' : 'color: #FF00FF;'
		,'DELIMITERS' : 'color: #0038E1;'
				
	}
	,'AUTO_COMPLETION' :  {
		"default": {	// the name of this definition group. It's posisble to have different rules inside the same definition file
			"REGEXP": { "before_word": "[^a-zA-Z0-9_]|^"	// \\s|\\.|
						,"possible_words_letters": "[a-zA-Z0-9_]+"
						,"letter_after_word_must_match": "[^a-zA-Z0-9_]|$"
						,"prefix_separator": "\\."
					}
			,"CASE_SENSITIVE": true
			,"MAX_TEXT_LENGTH": 100		// the maximum length of the text being analyzed before the cursor position
			,"KEYWORDS": {
				'': [	// the prefix of thoses items
						/**
						 * 0 : the keyword the user is typing
						 * 1 : (optionnal) the string inserted in code ("{@}" being the new position of the cursor, "§" beeing the equivalent to the value the typed string indicated if the previous )
						 * 		If empty the keyword will be displayed
						 * 2 : (optionnal) the text that appear in the suggestion box (if empty, the string to insert will be displayed)
						 */
						 ['Array', '§()', '']
						,['alert', '§({@})', 'alert(String message)']
						,['document']
						,['window']
					]
				,'window' : [
						 ['location']
						,['document']
						,['scrollTo', 'scrollTo({@})', 'scrollTo(Int x,Int y)']
					]
				,'location' : [
						 ['href']
					]
			}
		}
	}
};
