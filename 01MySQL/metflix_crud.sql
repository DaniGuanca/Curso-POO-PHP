/* Listado de operaciones CRUD */
/* moveseries */
    /* crear movieseries */
    INSERT INTO movieseries SET id_imdb = 'tt3749900', title = 'Gotam', plot = '', 
    author = '', actors = '', country = '', premiere = '2014', trailer = '', poster = '', 
    rating = 8.0, genres = 'Crime, Drama, Thriller', category = 'Serie', status  = 3;

    /* actualizar movieeries */
    UPDATE movieseries SET title = 'Gotham', plot = 'In crime ridden Gotham City, Thomas and Martha Wayne are murdered before young Bruce Wayne\'s eyes. Although the idealistic Gotham City Police Dept. detective James Gordon, and his cynical partner, Harvey Bullock, seem to solve the case quickly, things are not so simple. Inspired by Bruce\'s traumatized desire for justice, Gordon vows to find it amid Gotham\'s corruption. Thus begins Gordon\'s lonely quest that would set him against his own comrades and the underworld with their own deadly rivalries and mysteries. In the coming wars, innocence will be lost and compromises will be made as some criminals will fall as casualties while others will rise as supervillains. All the while, young Bruce observes this war with a growing obsession that would one day drive him to seek his own revenge as The Batman.', genres = 'Crime, Drama, Thriller', author = 'Bruno Heller', actors = 'Zabryna Guevara, Ben McKenzie, Donal Logue, David Mazouz', country = 'USA', premiere = '2014', trailer = 'https://www.youtube.com/watch?v=_axxvmMBgQk', poster = 'http://ia.media-imdb.com/images/M/MV5BMTQ1ODk3NDczNF5BMl5BanBnXkFtZTgwODE5MDQ4NjE@._V1_SX300.jpg', rating = 8.0, category = 'Serie', status  = 3 
		WHERE id_imdb = 'tt3749900';

    /* eliminar movieseries */
    DELETE FROM movieseries WHERE id_imdb = 'tt3749900';

    /* buscar todas las movieseries */
    SELECT ms.id_imdb, ms.title, ms.plot, ms.author, ms.actors, ms.country, ms.premiere, ms.poster, ms.trailer, 
    ms.genres, ms.category, s.status
        FROM movieseries AS ms
            INNER JOIN status AS s
                ON ms.status = s.id_status;    

    /* buscar una movieserie por titulos, personas, generos */
    SELECT ms.id_imdb, ms.title, ms.plot, ms.author, ms.actors, ms.country, ms.premiere, ms.poster, ms.trailer, 
    ms.rating, ms.genres, ms.category, s.status
        FROM movieseries AS ms
            INNER JOIN status AS s
                ON ms.status = s.id_status
                    WHERE MATCH(ms.title, ms.author, ms.actors, ms.genres)
                        AGAINST ('drama' IN BOOLEAN MODE);

    /* buscar movieserie por categoria */
    SELECT ms.id_imdb, ms.title, ms.plot, ms.author, ms.actors, ms.country, ms.premiere, ms.poster, ms.trailer, 
    ms.rating, ms.genres, ms.category, s.status
        FROM movieseries AS ms
            INNER JOIN status AS s
                ON ms.status = s.id_status
                    WHERE ms.category = 'Movie';

    /* buscar movieserie por status */
    SELECT ms.id_imdb, ms.title, ms.plot, ms.author, ms.actors, ms.country, ms.premiere, ms.poster, ms.trailer, 
    ms.rating, ms.genres, ms.category, s.status
        FROM movieseries AS ms
            INNER JOIN status AS s
                ON ms.status = s.id_status
                    WHERE ms.status = 1;

/* status */
    /* crear status */
    INSERT INTO status SET id_status = 0, status = 'Otro Status';
    
    /* actualizar status */
    UPDATE status SET status = 'Other Status' WHERE id_status = 6;

    /* salvar status 
    Solo para MySQL, si comparamos con word, guardar como es un INSERT y guardar es REPLACE, ya que sabe donde
    guardar lo cambios porque ya se creo el archivo
    LO QUE HACE ES: le pasas un id y los valores, busca el id si lo encuentra cambia TODOS los campos por los que
    mandaste osea un update, SI NO encuentra el id CREA el nuevo registro osea un insert (SIEMPRE HAY QUE
    ESPECIFICAR TODOS LOS CAMPOS SINO LO GUARDA COMO NULL */
    REPLACE INTO status (id_status, status) VALUES (0, 'Otro Status');
    REPLACE status SET id_status = 0, status = 'Otro Status';

    /* eliminar status */
    DELETE FROM status WHERE id_status = 6;

    /* buscar todos los status */
    SELECT * FROM status;

    /* buscar status por id_Status */
    SELECT * FROM status WHERE id_status = 3;

/* users */
    /* crear user */
    INSERT INTO users SET user = '@usuario', email = 'usuario@midominio.com', 
    nombre = 'Soy un usuario', birthday = '1988-10-09', pass = MD5('un_password'), role = 'Admin';

    /* actualizar */
        /* datos generales */
        UPDATE users SET nombre = 'Soy un Usuario', birthday = '1993-02-11', role = 'User' 
            WHERE user = '@usuario' AND email = 'usuario@midominio.com';

        /* password */
        UPDATE users SET pass = MD5('un_nuevo_password')
            WHERE user = '@usuario' AND email = 'usuario@midominio.com';

        /*Con REPLACE*/
        REPLACE users SET user = '@usuario', pass = MD5('un_nuevo_password');
		REPLACE users SET user = '@usuario', email = 'usuario@midominio.com', name = 'Soy un Usuario', birthday = '1988-09-08', pass = MD5('un_nuevo_password'), role = 'Admin';

    /* eliminar user */
    DELETE FROM users WHERE user = '@usuario' AND email = 'usuario@midominio.com';

    /* buscar todos los usuarios */
    SELECT * FROM users WHERE user = '@usuario';

    /* buscar un usuario por email */
    SELECT * FROM users WHERE email = 'usuario@midominio.com';

    /* buscar usuario por rol */
    SELECT * FROM users WHERE role = 'User';