// The Login Sequence

function login(user,pass){
	//Sende einen Loginrequest an den Server...
	sende("Auth::Login",[user,pass]);
	window.defaultStatus="Login in progress";
}

function logout() {
	// logge aus
	sende("Auth::Logout",sessionid);
}