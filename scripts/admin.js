

	        var tfeditor = CodeMirror.fromTextArea(document.getElementById("tfcodeDesc"), {
										lineNumbers: true,
								        matchBrackets: true,
								        indentUnit: 4,
								        indentWithTabs: true,
								        smartIndent: true,
								        styleActiveLine: true,
								        autoCloseBrackets: true,
								        autoCloseTags: true,
								        viewportMargin: Infinity,
								        fixedGutter: true
							});
			 var mceditor = CodeMirror.fromTextArea(document.getElementById("mccodeDesc"), {
										lineNumbers: true,
								        matchBrackets: true,
								        indentUnit: 4,
								        indentWithTabs: true,
								        smartIndent: true,
								        styleActiveLine: true,
								        autoCloseBrackets: true,
								        autoCloseTags: true,
								        viewportMargin: Infinity,
								        fixedGutter: true
							});



			 
				function lang_chosen(selectObj){
				 
					var idx = selectObj.selectedIndex;
				 
					var which = selectObj.options[idx].value;

					change_editor(which);
				}

				function change_editor(which){
					
					if(which=="cpp")
				   		var changedMode = "text/x-c++src";
				   	else if(which=="css")
					   var changedMode = "text/css";
					else if(which=="diff")
					   var changedMode = "text/x-diff";
					else if(which=="erlang")
					   var changedMode = "text/x-erlang";
					else if(which=="groovy")
					   var changedMode = "text/x-groovy";
					else if(which=="java" || which=="javafx")
					   var changedMode = "text/x-java";
					else if(which=="js")
					   var changedMode = "text/javascript";
					else if(which=="perl")
					   var changedMode = "text/x-perl";
					else if(which=="php")
					   var changedMode = "text/x-httpd-php";
					else if(which=="python")
					   var changedMode = "text/x-python";
					else if(which=="ruby")
					   var changedMode = "text/x-ruby";
					else if(which=="sass")
					   var changedMode = "text/x-sass";
					else if(which=="scala")
					   var changedMode = "text/x-scala";
					else if(which=="shell")
					   var changedMode = "text/x-sh";
					else if(which=="sql")
					   var changedMode = "text/x-sql";
					else if(which=="vbnet")
					   var changedMode = "text/x-vb";
					else if(which=="html")
					   var changedMode = "text/x-html";
					else if(which=="csharp")
					   var changedMode = "text/x-csharp";
					else if(which=="")
					   var changedMode = "text/plain";
					else
					   var changedMode = "text/plain";
					
					tfeditor.setOption("mode", changedMode);
					CodeMirror.autoLoadMode(tfeditor, changedMode);
					mceditor.setOption("mode", changedMode);
					CodeMirror.autoLoadMode(mceditor, changedMode);
				}