/**
 * Browser de fichier qui retourne le chemin du fichier choisi
 */  
var EditArea_filebrowser = {
	/**
	 * Initialisation
	 */	 	 	
	init: function(){	
        //editArea.load_css(this.baseURL+"css/filebrowser.css");
        this.liste = new Array();
	}
	/**
	 * @param {string} ctrl_name: the name of the control to add	  
	 */	
	,get_control_html: function(ctrl_name){
        if (ctrl_name == 'filebrowser') {
            return parent.editAreaLoader.get_button_html('filebrowser', 'Crystal_Clear_action_filefind.png', 'browse', false, this.baseURL);
        } else return false;
	}
	
	/**
	 * Executes a specific command, this function handles plugin commands.
	 * @param {string} cmd: the name of the command being executed
	 * @param {unknown} param: the parameter of the command	 
	 * @return true - pass to next handler in chain, false - stop chain execution
	 */
	,execCommand: function(cmd, param){
		switch(cmd) {
			case "browse":
                if (window.XMLHttpRequest) { 
                    xhr = new XMLHttpRequest();
                } else if (window.ActiveXObject) {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xhr.onreadystatechange = function() {
    if ((xhr.readyState == 4) && (xhr.status==200) ) {
        this.liste = xhr.responseText;
        win= window.open("edit_area/plugins/filebrowser/popup.html", "Browser de fichiers", "width=900,height=500,scrollbars=yes,resizable=yes,dependent=yes");
        win.focus();
    }
                };

                xhr.open("POST", "browser.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
                xhr.send('');
				return false;
		}
		return true;
	}

};

editArea.add_plugin("filebrowser", EditArea_filebrowser);
