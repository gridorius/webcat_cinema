let app = new Vue({
  el:'.admin-panel',
  data:{
    films:[],
    newFilm: {},
    seans:[],
    tickets: []
  },
  methods:{
    loadFilms(){
      ffetch('php/get_films.php').then(r=>r.json()).then(films=>this.films=films);
    },
    createFilm(){
      let name = this.newFilm.name;
      let duration = this.newFilm.duration;
      let data = new FormData();
      data.append('name', name);
      data.append('duration', duration);
      ffetch('php/add_film.php', {
        method: 'post',
        body: data
      });
    },
    loadSeans(){
      fetch('php/get_seans.php').then(r=>r.json()).then(j=>this.seans=j);
    },
    createSeans(filmId, price, datitime){

    },
    loadTickets(){
      fetch('php/get_tickets.php').then(r=>r.json()).then(j=>this.tickets=j);
    },
    createTicket(seansId){

    }
  }
});

app.loadFilms();
// app.loadSeans();
// app.loadTickets();
