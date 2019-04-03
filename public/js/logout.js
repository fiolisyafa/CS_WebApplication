function logout() {
	fetch('http://mochinerary.id/api/auth/logout', {
    // fetch('http://127.0.0.1:8001/api/auth/logout', {
		method: 'post',
		headers: {
			'Authorization': 'Bearer ' + localStorage.getItem('token'),
			'Accept': 'application/json'
		}
	}).then(res => {
        if (!res.ok) {
            throw Error(res.statusText);
        }
        return res.json();
      })
      .then(result => {
        localStorage.removeItem('token');
        localStorage.removeItem('itinerary');
        location.href="/login";
        // console.log('pindah ke dashboard');
      }).catch(err => {
      	alert(error);
      })
}