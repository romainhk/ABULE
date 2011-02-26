/*
 * Surligner un passage
 */  
var EditArea_labule = {
	init: function(){	
	}

	,get_control_html: function(ctrl_name){
		switch(ctrl_name){
			case "image":
				return parent.editAreaLoader.get_button_html('image', 'Nuvola_apps_package_graphics.png', 'image', false, this.baseURL);
			case "surligner":
				// Control id, button img, command
				return parent.editAreaLoader.get_button_html('surligner', 'Nuvola_apps_kedit.png', 'surligner', false, this.baseURL);
		}
		return false;
	}
	
	/**
	 * Executes a specific command, this function handles plugin commands.
	 *
	 * @param {string} cmd: the name of the command being executed
	 * @param {unknown} param: the parameter of the command	 
	 * @return true - pass to next handler in chain, false - stop chain execution
	 * @type boolean	
	 */
	,execCommand: function(cmd, param){
		// Handle commands
		switch(cmd){
			case "image":
                parent.editAreaLoader.insertTags('editeur', \
                        '<a href="COMME IMG" rel="lightbox"><img class="img_droite" src="', \
                        '" alt="" title="" /></a>');
				return false;
			case "surligner":
                parent.editAreaLoader.insertTags('editeur', '<span class="surligner">', '</span>');
				return false;
		}
		// Pass to next handler in chain
		return true;
	}
	
};

editArea.add_plugin("labule", EditArea_labule);
