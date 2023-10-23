
let darkButton = document.querySelector('#dark');
let theme = document.querySelector('#theme');

darkButton.addEventListener('click', () => {
	if(theme.getAttribute('data-theme') === 'light'){
		theme.setAttribute('data-theme','dark');
	}	
	else {
		theme.setAttribute('data-theme','light');
		}
	});
