let form = document.forms.authorization;
form.addEventListener('submit', function(e){
  e.preventDefault();
  let login = this.login.value;
  let password = this.password.value;
  let data = {
    login,
    password
  }
  let form = new FormData();
  form.append('data', JSON.stringify(data));
  fetch('/php/authorization.php', {
    method: 'post',
    body: form
  }).then(r=>{
    if(r.ok){
        localStorage.clear();
       r.json().then(o=>{
         localStorage.setItem('token', o.token);
         location = '/';
       });
    }
    else alert(r.statusText);
  });
});
