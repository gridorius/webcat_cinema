<?php
const GET_FILMS_INFO =
"SELECT name, duration, tickets, total_price, tickets/sessions as avg_from_session FROM (
SELECT
film.film_id,
film.duration as duration,
name,
COUNT(ticket.id) as tickets,
CASE WHEN count(ticket.id)>0 THEN sum(price) ELSE 0 END as total_price
FROM film
LEFT JOIN session on session.film_id=film.film_id
LEFT JOIN ticket on ticket.session_id=session.session_id
GROUP BY film.film_id, film.name) film_info
LEFT JOIN (
SELECT film.film_id,
COUNT(session.session_id) sessions
FROM film
LEFT JOIN session ON session.film_id=film.film_id
GROUP BY film.film_id, film.duration) session_info on session_info.film_id=film_info.film_id
ORDER BY total_price DESC";

const SESSION_CONFLICTS =
"SELECT
film1.name name1,
film1.start_time start1,
film1.duration duration1,
film2.name name2,
film2.start_time start2,
film2.duration duration2
FROM (
SELECT name,
TIME(session.date) start_time,
duration,
TIME(ADDDATE(session.date, INTERVAL film.duration MINUTE)) end_time
FROM film film
NATURAL JOIN session) film1
CROSS JOIN (
SELECT name,
TIME(session.date) start_time,
duration
FROM film film
NATURAL JOIN session) film2
WHERE film2.start_time > film1.start_time and film2.start_time < film1.end_time";

const BIG_TIMEOUT =
"SELECT
film1.name name1,
film1.start_time start1,
film1.duration duration1,
film2.start_time start2,
HOUR(TIMEDIFF(film1.start_time, film2.start_time))*60 + MINUTE(TIMEDIFF(film1.start_time, film2.start_time)) timeout
FROM (
SELECT name,
TIME(session.date) start_time,
duration,
TIME(ADDDATE(session.date, INTERVAL film.duration MINUTE)) end_time
FROM film film
NATURAL JOIN session) film1
CROSS JOIN (
SELECT name,
TIME(session.date) start_time,
duration
FROM film film
NATURAL JOIN session) film2
WHERE HOUR(TIMEDIFF(film1.start_time, film2.start_time))*60 + MINUTE(TIMEDIFF(film1.start_time, film2.start_time)) >= 30
AND
film1.name=film2.name";

const TIME_AND_MONEY = "SELECT
'9 - 15' time_zone,
SUM(tickets) tickets,
SUM(total_price) total_price
FROM time_and_money
WHERE HOUR(start) >= 9
AND
HOUR(start) < 15
UNION
SELECT
'15 - 18' time_zone,
SUM(tickets) tickets,
SUM(total_price) total_price
FROM time_and_money
WHERE HOUR(start) >= 15
AND
HOUR(start) < 18
UNION
SELECT
'18 - 21' time_zone,
SUM(tickets) tickets,
SUM(total_price) total_price
FROM time_and_money
WHERE HOUR(start) >= 18
AND
HOUR(start) < 21
UNION
SELECT
'21 - 00' time_zone,
SUM(tickets) tickets,
SUM(total_price) total_price
FROM time_and_money
WHERE HOUR(start) >= 21
AND
HOUR(start) < 0";
?>
