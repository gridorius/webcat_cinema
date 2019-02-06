let app = new Vue({
  el:'.admin-panel',
  data:{
    films:[],
    sessions:[],
    tickets:[]
  },
  methods:{
    setFilms(films){
      this.films = films;
    },
    setSessions(sessions){
      this.sessions = sessions;
    },
    setTickets(tickets){
      this.tickets = tickets;
    },
    addFilm(){
      let data = new FormData(document.forms.newfilm);
      ffetch('/films/add', {
        method: 'post',
        body: data
      });
    }
  }
});

ffetch('/films/get').then(r=>r.json()).then(a=>app.setFilms(a));
ffetch('/session/get').then(r=>r.json()).then(a=>app.setSessions(a));
ffetch('/ticket/get').then(r=>r.json()).then(a=>app.setTickets(a));
