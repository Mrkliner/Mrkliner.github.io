function customButton(tagname) { 
        var tag = document.getElementsByTagName(tagname);
	for (var i = 0; i < tag.length; i++) {
	        tag[i].innerHTML = '<br><button style="display: flex;align-items: center;">' + tag[i].attributes.text.value + '</button>';
        }
}
function customText(tagname) {
	var tag = document.getElementsByTagName(tagname);
	for (var i = 0; i < tag.length; i++) {
		tag[i].innerHTML = '<br><h3 class="standart-text">' + tag[i].attributes.text.value + '</h3>'
	}
}
