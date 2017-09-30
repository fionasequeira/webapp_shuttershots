CREATE TABLE public.userinfo
(
    user_id serial,
    creation_timestamp timestamp without time zone,
    email_id character varying(100) COLLATE pg_catalog."default" NOT NULL,
    username character varying(40) COLLATE pg_catalog."default" NOT NULL,
    user_password character varying(30) COLLATE pg_catalog."default" NOT NULL,
    first_name character(255) COLLATE pg_catalog."default" NOT NULL,
    last_name character(255) COLLATE pg_catalog."default" NOT NULL,
    date_of_birth date NOT NULL,
    picture_medium character varying(100),
    last_log_in timestamp without time zone,
    CONSTRAINT userinfo_pkey PRIMARY KEY (user_id)
);

CREATE TABLE public.multimedia
(
    media_id serial,
    post_time timestamp without time zone,
    content character varying(100),
    description text COLLATE pg_catalog."default",
    user_id integer,
    CONSTRAINT multimedia_pkey PRIMARY KEY (media_id),
    CONSTRAINT multimedia_user_id_fkey FOREIGN KEY (user_id)
        REFERENCES public.userinfo (user_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
);