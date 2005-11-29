function getAuthorsSelect(id) {
	var authorSelect;
	var ids=new Array();
	var fios=new Array();
	$authorsJSline
	authorSelect+="<option value=\"\">Выберите автора...</option>";
	for (i=1; i<=$i; i++) {
		authorSelect+="<option value=\""+ids[i]+"\"" + ((ids[i]==id) ? " selected" : "") + ">"+fios[i]+"</option>";
	}
	return authorSelect;
}