/* Otra forma de hacer el INSERT y el UPDATE es:
    INSERTO INTO tabla SET campo = valor, campo2 = valor2 . . .
    UPDATE tabla SET campo = valor, campo2 = valor2... WHERE id = campo*/

INSERT INTO movieseries SET id_imdb = 'tt3749900', title = 'Gotham', genres='Crime, Drama, Thriller', premiere = '2014',
status = 3;

UPDATE movieseries SET author = 'Bruno Heller', 
actors = 'Ben McKenzie, Donal Logue, David Mazouz, Sean Pertwee', country = 'USA', 
poster = 'http://ia.media-imdb.com/images/M/MV5BMTQ1ODk3NDczNF5BMl5BanBnXkFtZTgwODE5MDQ4NjE@._V1_SX300.jpg', 
trailer = 'https://www.youtube.com/watch?v=_axxvmMBgQk', rating = 8.0 , category = 'Serie', 
plot = 'In crime ridden Gotham City, Thomas and Martha Wayne are murdered before young Bruce Wayne\'s eyes. Although the idealistic Gotham City Police Dept. detective James Gordon, and his cynical partner, Harvey Bullock, seem to solve the case quickly, things are not so simple. Inspired by Bruce\'s traumatized desire for justice, Gordon vows to find it amid Gotham\'s corruption. Thus begins Gordon\'s lonely quest that would set him against his own comrades and the underworld with their own deadly rivalrie and mysteries. In the coming wars, innocence will be lost and compromises will be made as some criminals will fall as casualties while others will rise as supervillains. All the while, young Bruce observes this war with a growing obsession that would one day drive him to seek his own revenge as The Batman.' 
WHERE id_imdb = 'tt3749900';

DELETE FROM movieseries WHERE id_imdb = 'tt3749900';

SELECT * FROM movieseries;

SELECT COUNT(*) FROM movieseries;

SELECT * FROM movieseries WHERE category = 'Serie';

SELECT title, category, country, genres, premiere, status FROM movieseries WHERE category = 'Serie';

SELECT title, category, country, genres, premiere, status FROM movieseries WHERE category = 'Serie' ORDER BY premiere;

SELECT title, category, country, genres, premiere, status FROM movieseries WHERE category = 'Movie' AND country = 'USA' ORDER BY premiere;

SELECT title, category, country, genres, premiere, status FROM movieseries WHERE category = 'Movie' AND country LIKE 'USA%' ORDER BY premiere;

SELECT title, category, country, genres, premiere, status FROM movieseries WHERE genres LIKE '%Drama%' ORDER BY premiere;

SELECT title, category, country, genres, premiere, status FROM movieseries WHERE status = 1 OR status = 2 ORDER BY premiere;


/* CONSULTAS MULTIPLES
Se usan para hacer consultas de varias tablas, para hacerlo se usa INNER JOIN 
EJEMPLOS:

    SELECT * FROM tabla1 AS t1
        INNER JOIN tabla2 AS t2 
            ON t1.claveForanea = t2.ClavePrincipal

    
    SELECT t1.campo1, t1.campo2, t1.campo3 ..., t2.campo1, t2.campo2 ...
        FROM tabla1 AS t1
            INNER JOIN tabla2 AS t2
                ON t1.claveForanea = t2.ClavePrincipal
                    WHERE t1.campo1 = 'un valor'
                        ORDER BY t1.campo3 DESC
*/

/* Esta consulta devuelve algo malo repetido porque no puse el ON que relaciona ambas claves */
SELECT * FROM movieseries AS ms INNER JOIN status AS s;

/*Asi deberia ser */
SELECT * FROM movieseries AS ms
    INNER JOIN status AS s
        ON ms.status = s.id_status;


/*Eligiendo los campos que quiero ver */
SELECT ms.title, ms.category, ms.country, ms.genres, ms.premiere, s.status
    FROM movieseries AS ms
        INNER JOIN status AS s
            ON ms.status = s.id_status
                ORDER BY ms.premiere DESC;

/*Usando WHERE*/
SELECT ms.title, ms.category, ms.country, ms.genres, ms.premiere, s.status
    FROM movieseries AS ms
        INNER JOIN status AS s
            ON ms.status = s.id_status
                WHERE s.status = 'Canceled' OR s.status = 'Coming Soon'
                    ORDER BY ms.premiere;

SELECT ms.title, ms.category, ms.country, ms.genres, ms.premiere, s.status
	FROM movieseries AS ms INNER JOIN status AS s ON ms.status = s.id_status
	WHERE s.status = 'Release' OR s.status = 'Finished' OR s.status = 'In Issue' AND ms.category = 'Serie' ORDER BY ms.premiere;

SELECT ms.title, ms.category, ms.country, ms.genres, ms.premiere, s.status
	FROM movieseries AS ms INNER JOIN status AS s ON ms.status = s.id_status
	WHERE (s.status = 'Release' OR s.status = 'Finished' OR s.status = 'In Issue') AND ms.category = 'Serie' ORDER BY ms.premiere;



/* Consulta FullText Key */
SELECT * FROM movieseries
    WHERE MATCH(title, author, actors, genres) AGAINST ('stallone' IN BOOLEAN MODE);

SELECT title, category, country, genres, premiere, status, author, actors FROM movieseries
	WHERE MATCH(title, author, actors, genres)
	AGAINST('stallone' IN BOOLEAN MODE);

SELECT ms.title, ms.category, ms.country, ms.genres, ms.premiere, s.status
	FROM movieseries AS ms
	INNER JOIN status AS s
	ON ms.status = s.id_status
	WHERE MATCH(ms.title, ms.author, ms.actors, ms.genres)
	AGAINST('drama' IN BOOLEAN MODE)
	ORDER BY ms.premiere;



/* Integridad Referencial */

SELECT COUNT(*) FROM movieseries WHERE status = 1;
SELECT COUNT(*) FROM movieseries WHERE status = 2;
SELECT COUNT(*) FROM movieseries WHERE status = 3;
SELECT COUNT(*) FROM movieseries WHERE status = 4;
SELECT COUNT(*) FROM movieseries WHERE status = 5;

/* Pongo id 0 pero como es autoincremental no le va a poner 0 le va a poner 6 e la BD*/
INSERT INTO status SET status = 'Otro Status', id_status = 0;

SELECT COUNT(*) FROM movieseries WHERE status = 6;


/* MySQL permite eliminar los registros existentes ebn la tabla movieseries del status 1 'Coming Soon' */
DELETE FROM movieseries WHERE status = 1;

/* Permite eliminar el registro con el status_id 1 porque ya no hay registros asociados en la tabla dependiente(movieseries) */
DELETE FROM status WHERE id_status = 1;

/* MySQL no me permite eliminar el status_id 2 porque existen registros asociados a él en la tabla dependiente(movieseries) */
DELETE FROM status WHERE id_status = 2;

SELECT ms.title, ms.status, s.id_status, s.status
	FROM movieseries AS ms
	INNER JOIN status AS s
	ON ms.status = s.id_status
	ORDER BY s.status, ms.title;


/* Cuando Actualizo los valores del registro del status 2, en automático se actualizan los registros vinculados en la tabla dependiente(movieseries) */
UPDATE status 
	SET id_status = 7, status = 'Estrenada'
	WHERE id_status = 2;