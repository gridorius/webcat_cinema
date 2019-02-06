function ffetch(url, settings = {}){
  setToken(settings);
  let query = fetch(url, settings);
  query.then(r=>{
    if(!r.ok)
      r.text().then(logError);
  });
  return query;
}

function logError(text){
  try{
    console.log(JSON.parse(text));
  }catch(err){
    console.log(text);
  }
}

function setToken(settings){
  if(!settings.headers)
    settings.headers = {};
  settings.headers['Authorization'] = localStorage.getItem('token');
}
