function ffetch(url, settings){
  if(settings)
    if(settings.headers || addHeaders(settings))
      settings.headers['Authorization'] = localStorage.getItem('token');
  return fetch(url, settings);
}

function addHeaders(settings){
  settings.headers = {};
  return true;
}
