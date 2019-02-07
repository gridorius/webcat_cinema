let app = new Vue({
  el:'.admin-panel',
  data:{
    films:[],
    sessions:[],
    tickets:[],
    sessionConflicts: [],
    bigTimeouts:[],
    timeAndMoney:[]
  },
  methods:{
    updateFilms(){
      ffetch('/films/get').then(r=>r.json()).then(a=>app.setFilms(a));
    },
    updateSessions(){
      ffetch('/session/get').then(r=>r.json()).then(a=>app.setSessions(a));
    },
    updateTickets(){
      ffetch('/ticket/get').then(r=>r.json()).then(a=>app.setTickets(a));
    },
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
      }).then(r=>this.updateFilms());
    }
  }
});

app.updateFilms();
app.updateSessions();
app.updateTickets();
ffetch('/session/getConflicts').then(r=>r.json()).then(c=>app.sessionConflicts = c);
ffetch('/session/getBigTimeouts').then(r=>r.json()).then(t=>app.bigTimeouts = t);
ffetch('/session/timeAndMoney').then(r=>r.json()).then(t=>app.timeAndMoney = t);
/*
<td>{{ films.reduce((o, c)=o.tickets + c.tickets) }}</td>
<td>{{ films.reduce((o, c)=o.avg_from_session + c.avg_from_session) }}</td>
<td>{{ films.reduce((o, c)=o.total_price + c.total_price) }}</td>
*/
