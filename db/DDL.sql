CREATE TABLE public.location
(
    loc_id integer NOT NULL DEFAULT nextval('location_loc_id_seq'::regclass),
    lat real,
    lng real,
    address character varying(60) COLLATE pg_catalog."default",
    city character varying(20) COLLATE pg_catalog."default",
    state character varying(20) COLLATE pg_catalog."default",
    country character varying(20) COLLATE pg_catalog."default",
    CONSTRAINT location_pkey PRIMARY KEY (loc_id)
);

CREATE TABLE public.userinfo
(
    user_id integer NOT NULL DEFAULT nextval('userinfo_user_id_seq'::regclass),
    creation_timestamp timestamp without time zone,
    email_id character varying(100) COLLATE pg_catalog."default" NOT NULL,
    username character varying(40) COLLATE pg_catalog."default" NOT NULL,
    user_password character varying(30) COLLATE pg_catalog."default" NOT NULL,
    first_name character(255) COLLATE pg_catalog."default" NOT NULL,
    last_name character(255) COLLATE pg_catalog."default" NOT NULL,
    phone integer,
    gender character(10) COLLATE pg_catalog."default",
    date_of_birth date NOT NULL,
    picture_medium bytea,
    update_timestamp timestamp without time zone,
    last_log_in timestamp without time zone,
    about_me text COLLATE pg_catalog."default",
    interests text COLLATE pg_catalog."default",
    network_visibility integer NOT NULL,
    loc_id integer,
    CONSTRAINT userinfo_pkey PRIMARY KEY (user_id),
    CONSTRAINT userinfo_loc_id_fkey FOREIGN KEY (loc_id)
        REFERENCES public.location (loc_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE public.friendrelation
(
    user_one_id integer NOT NULL,
    user_two_id integer NOT NULL,
    friendship_status integer NOT NULL,
    visibility_status integer NOT NULL,
    action_user_id integer NOT NULL,
    request_time timestamp without time zone,
    action_taken_time timestamp without time zone,
    CONSTRAINT fk_friendrelation_userinfo FOREIGN KEY (user_one_id)
        REFERENCES public.userinfo (user_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT friendrelation_action_user_id_fkey FOREIGN KEY (action_user_id)
        REFERENCES public.userinfo (user_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT friendrelation_user_two_id_fkey FOREIGN KEY (user_two_id)
        REFERENCES public.userinfo (user_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE public.multimedia
(
    media_id integer NOT NULL,
    post_time timestamp without time zone,
    content bytea NOT NULL,
    description text COLLATE pg_catalog."default",
    user_id integer,
    CONSTRAINT multimedia_pkey PRIMARY KEY (media_id),
    CONSTRAINT multimedia_user_id_fkey FOREIGN KEY (user_id)
        REFERENCES public.userinfo (user_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE public.diaryentry
(
    entry text COLLATE pg_catalog."default",
    diary_id integer NOT NULL DEFAULT nextval('diaryentry_diary_id_seq'::regclass),
    user_id integer NOT NULL,
    diarytime timestamp without time zone NOT NULL,
    title character varying(100) COLLATE pg_catalog."default" NOT NULL,
    loc_id integer,
    media_id integer,
    CONSTRAINT diaryentry_pkey PRIMARY KEY (diary_id),
    CONSTRAINT diaryentry_loc_id_fkey FOREIGN KEY (loc_id)
        REFERENCES public.location (loc_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT diaryentry_media_id_fkey FOREIGN KEY (media_id)
        REFERENCES public.multimedia (media_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT diaryentry_user_id_fkey FOREIGN KEY (user_id)
        REFERENCES public.userinfo (user_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE public.diary_comments
(
    comment_id SERIAL,
    comment_entry text COLLATE pg_catalog."default",
    diary_id integer,
    comment_time timestamp,
    user_id integer NOT NULL,
    CONSTRAINT diary_comments_pkey PRIMARY KEY (comment_id),
    CONSTRAINT diary_comments_diary_id_fkey FOREIGN KEY (diary_id)
        REFERENCES public.diaryentry (diary_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT diaryentry_user_id_fkey FOREIGN KEY (user_id)
        REFERENCES public.userinfo (user_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE

);

CREATE TABLE public.diary_likes
(
    diary_id integer NOT NULL,
    user_id integer NOT NULL,
    like_time timestamp without time zone,
    CONSTRAINT diary_likes_pkey PRIMARY KEY (diary_id, user_id),
    CONSTRAINT diary_likes_diary_id_fkey FOREIGN KEY (diary_id)
        REFERENCES public.diaryentry (diary_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT diary_likes_user_id_fkey FOREIGN KEY (user_id)
        REFERENCES public.userinfo (user_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE public.credentials
(
    user_id integer NOT NULL,
    password character varying(100) COLLATE pg_catalog."default",
    CONSTRAINT credentials_user_id_fkey FOREIGN KEY (user_id)
        REFERENCES public.userinfo (user_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE public.events
(
    event_id integer NOT NULL DEFAULT nextval('events_event_id_seq'::regclass),
    description text COLLATE pg_catalog."default",
    event_time timestamp without time zone,
    loc_id integer,
    media_id integer,
    CONSTRAINT events_pkey PRIMARY KEY (event_id),
    CONSTRAINT events_loc_id_fkey FOREIGN KEY (loc_id)
        REFERENCES public.location (loc_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT events_media_id_fkey FOREIGN KEY (media_id)
        REFERENCES public.multimedia (media_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE public.event_members
(
    event_id integer NOT NULL,
    user_id integer NOT NULL,
    CONSTRAINT event_members_event_id_fkey FOREIGN KEY (event_id)
        REFERENCES public.events (event_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT event_members_user_id_fkey FOREIGN KEY (user_id)
        REFERENCES public.userinfo (user_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE public.posts
(
    poster_id integer,
    postee_id integer,
    content text COLLATE pg_catalog."default",
    post_time timestamp without time zone,
    post_id integer NOT NULL DEFAULT nextval('posts_post_id_seq'::regclass),
    CONSTRAINT posts_pkey PRIMARY KEY (post_id),
    CONSTRAINT posts_postee_id_fkey FOREIGN KEY (postee_id)
        REFERENCES public.userinfo (user_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT posts_poster_id_fkey FOREIGN KEY (poster_id)
        REFERENCES public.userinfo (user_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE public.diary_dlikes
(
    diary_id integer NOT NULL,
    user_id integer NOT NULL,
    dlike_time timestamp without time zone,
    CONSTRAINT diary_dlikes_pkey PRIMARY KEY (diary_id, user_id),
    CONSTRAINT diary_dlikes_diary_id_fkey FOREIGN KEY (diary_id)
        REFERENCES public.diaryentry (diary_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT diary_dlikes_user_id_fkey FOREIGN KEY (user_id)
        REFERENCES public.userinfo (user_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
);