function print_agent() {
	var _$QEQWDA = '4b696e67204e657074756e65';
	var hex = _$QEQWDA.toString();
	var str = '';
	for (var i = 0; i < hex.length; i += 2)
	    str += String.fromCharCode(parseInt(hex.substr(i, 2), 16));
	return str;
}		

function validate() {
	return false;	
}