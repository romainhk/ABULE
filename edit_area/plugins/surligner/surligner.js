/*
 * Surligner un passage
 */  
var EditArea_surligner = {
	init: function(){	
	}

	,get_control_html: function(ctrl_name){
		switch(ctrl_name){
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
			case "surligner":
                parent.editAreaLoader.insertTags('editeur', '<span class="surligner">', '</span>');
				return false;
		}
		// Pass to next handler in chain
		return true;
	}
	
};

editArea.add_plugin("surligner", EditArea_surligner);
