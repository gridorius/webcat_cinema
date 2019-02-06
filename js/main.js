function ffetch(url, settings = {}){
  setToken(settings);
  let query = fetch(url, settings);
  query.then(r=>{
    if(!r.ok)
      r.json().then(console.log);
  })
  return query;
}

function setToken(settings){
  if(!settings.headers)
    settings.headers = {};
  settings.headers['Authorization'] = localStorage.getItem('token');
}
