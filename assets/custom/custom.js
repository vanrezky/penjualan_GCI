function setCookies(name, value, minutes) {
	var date = new Date();
	minutes = typeof (minutes) === 'undefined' ? 15 : minutes;
	date.setTime(date.getTime() + (minutes * 60 * 1000));
	if (typeof (value) === 'undefined' || value == '') deleteCookies(name);
	else $.cookie(name, value, {
		expires: date,
		path: '/'
	});
	return true;
}

function getCookies(name) {
	return $.cookie(name);
}

function deleteCookies(name) {
	return $.cookie(name, null, {
		expires: -1,
		path: '/'
	});
}