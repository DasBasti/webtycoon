// The Login Sequence

function login(user,pass){
	//Sende einen Loginrequest an den Server...
	sende("Auth::Login",[user,pass]);
}

function logout() {
	// logge aus
	sende("Auth::Logout",sessionid);
}