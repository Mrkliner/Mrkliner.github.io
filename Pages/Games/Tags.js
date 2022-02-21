function customButton(tagname) { 
        var tag = document.getElementsByTagName(tagname);
	for (var i = 0; i < tag.length; i++) {
	        tag[i].innerHTML = '<br><button style="display: flex;align-items: center;">' + tag[i].attributes.text.value + '</button>';
        }
}
