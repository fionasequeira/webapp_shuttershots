-- total likes
    CREATE OR REPLACE FUNCTION totalLikes(dentry1 integer)
    RETURNS integer as $likeCount$
    declare
        likeCount integer;
    BEGIN
        SELECT count(*) into likeCount FROM diary_likes where diary_id LIKE dentry1;
        RETURN likeCount;
    END
    $likeCount$ LANGUAGE plpgsql;

-- search events
    CREATE OR REPLACE FUNCTION search_event (search_query varchar(20))
    RETURNS TABLE(
        etitle VARCHAR(100),
        etime TIMESTAMP
        )
    AS $$
    BEGIN
        RETURN query SELECT
        title,
        event_time
        FROM 
        events
        where title LIKE search_query
        OR
        description LIKE search_query;
        END; $$
        LANGUAGE plpgsql;

-- search users
    CREATE OR REPLACE FUNCTION search_user (search_query varchar(20))
    RETURNS TABLE(
        fname VARCHAR(100),
        lname VARCHAR(100)
        )
    AS $$
    BEGIN
        RETURN query SELECT
        first_name,
        last_name
        FROM 
        userinfo
        where first_name LIKE search_query
        OR
        last_name LIKE search_query;
        END; $$
        LANGUAGE plpgsql;

-- search diary
    CREATE OR REPLACE FUNCTION search_diary (search_query varchar(20))
    RETURNS TABLE(
        dtitle VARCHAR(100),
        dentry TEXT
        )
    AS $$
    BEGIN
        RETURN query SELECT
        title,
        entry
        FROM 
        diaryentry
        where title LIKE search_query
        OR
        entry LIKE search_query;
        END; $$
        LANGUAGE plpgsql;

-- location user search
    CREATE OR REPLACE FUNCTION location_search_user (search_query varchar(20))
    RETURNS TABLE(
        fname VARCHAR(100),
        lname VARCHAR(100)
        )
    AS $$
    BEGIN
        RETURN query SELECT
        userinfo.first_name,
        userinfo.last_name,
        location.city,
        location.state,
        location.country
        FROM 
        userinfo, location
        WHERE userinfo.loc_id = location.loc_id 
        AND location.city LIKE search_query
        OR
        location.state LIKE search_query;
        END; $$
        LANGUAGE plpgsql;    

--location event search
    CREATE OR REPLACE FUNCTION location_search_event (search_query varchar(20))
    RETURNS TABLE(
        etitle VARCHAR(100),
        etime TIMESTAMP
        )
    AS $$
    BEGIN
        RETURN query SELECT
        events.title,
        events.event_time,
        location.city,
        location.state,
        location.country
        FROM 
        events, location
        WHERE userinfo.loc_id = location.loc_id 
        AND location.city LIKE search_query
        OR
        location.state LIKE search_query;
        END; $$
        LANGUAGE plpgsql;         