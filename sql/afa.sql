--
-- PostgreSQL database dump
--

-- Dumped from database version 13.2 (Debian 13.2-1.pgdg100+1)
-- Dumped by pg_dump version 13.2 (Debian 13.2-1.pgdg100+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: citext; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS citext WITH SCHEMA public;


--
-- Name: EXTENSION citext; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION citext IS 'data type for case-insensitive character strings';


--
-- Name: uuid-ossp; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS "uuid-ossp" WITH SCHEMA public;


--
-- Name: EXTENSION "uuid-ossp"; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION "uuid-ossp" IS 'generate universally unique identifiers (UUIDs)';


--
-- Name: options; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.options AS ENUM (
    'option_1',
    'option_2',
    'option_3'
);


--
-- Name: trivia_types; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.trivia_types AS ENUM (
    'normal',
    'trivia'
);


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: answers; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.answers (
    id uuid NOT NULL,
    user_id uuid NOT NULL,
    question_id uuid NOT NULL,
    selected_option public.options,
    lives integer DEFAULT 1 NOT NULL,
    created timestamp without time zone NOT NULL,
    response_seconds numeric DEFAULT 10.00 NOT NULL
);


--
-- Name: auth_token; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.auth_token (
    id uuid NOT NULL,
    user_id uuid NOT NULL,
    access_token character varying(512) NOT NULL,
    refresh_token character varying(512) NOT NULL,
    created timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    modified timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


--
-- Name: awards; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.awards (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    picture character varying(36) NOT NULL,
    picture_dir character varying(36) NOT NULL,
    points integer NOT NULL,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone
);


--
-- Name: awards_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.awards_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: awards_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.awards_id_seq OWNED BY public.awards.id;


--
-- Name: banners; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.banners (
    id integer NOT NULL,
    name public.citext NOT NULL,
    action character varying(255),
    action_target character varying(255),
    action_target_url character varying(255),
    data jsonb,
    picture character varying(255),
    picture_dir character varying(255),
    created timestamp without time zone,
    modified timestamp without time zone
);


--
-- Name: banners_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.banners_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: banners_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.banners_id_seq OWNED BY public.banners.id;


--
-- Name: challenge_requests; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.challenge_requests (
    id uuid NOT NULL,
    championship_id uuid,
    user_id uuid,
    challenge_championship_id uuid,
    notified boolean DEFAULT false,
    message text,
    acepted boolean DEFAULT false,
    created timestamp without time zone,
    modifed timestamp without time zone,
    accepted boolean DEFAULT false,
    challenge_user_id uuid,
    done boolean DEFAULT false
);


--
-- Name: challenges; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.challenges (
    id uuid NOT NULL,
    championship1_id uuid,
    championship2_id uuid,
    user1_id uuid,
    user2_id uuid,
    created timestamp without time zone,
    modified timestamp without time zone
);


--
-- Name: championship_dates; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.championship_dates (
    id integer NOT NULL,
    year integer DEFAULT 2018 NOT NULL,
    name character varying(255) NOT NULL,
    from_date date NOT NULL,
    to_date date,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone
);


--
-- Name: championship_dates_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.championship_dates_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: championship_dates_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.championship_dates_id_seq OWNED BY public.championship_dates.id;


--
-- Name: championship_users; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.championship_users (
    id uuid NOT NULL,
    championship_id uuid NOT NULL,
    user_id uuid NOT NULL,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone,
    enabled boolean DEFAULT true
);


--
-- Name: championships; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.championships (
    id uuid NOT NULL,
    name character varying(255) NOT NULL,
    user_id uuid NOT NULL,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone,
    users_count integer,
    picture character varying(255),
    picture_dir character varying(255)
);


--
-- Name: correct_answers; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.correct_answers (
    id uuid NOT NULL,
    user_id uuid NOT NULL,
    question_id uuid NOT NULL,
    trivia_id uuid NOT NULL,
    points integer NOT NULL,
    selected_option public.options,
    lives integer DEFAULT 1 NOT NULL,
    created timestamp without time zone NOT NULL,
    response_seconds numeric DEFAULT 10.00 NOT NULL
);


--
-- Name: trivias; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.trivias (
    id uuid NOT NULL,
    local_team_id integer,
    visit_team_id integer,
    type public.trivia_types DEFAULT 'normal'::public.trivia_types NOT NULL,
    title1 character varying(20) DEFAULT NULL::character varying,
    title2 character varying(20) DEFAULT NULL::character varying,
    award character varying(50) DEFAULT NULL::character varying,
    points_multiplier numeric(2,1) DEFAULT 1.0 NOT NULL,
    start_datetime timestamp without time zone NOT NULL,
    date_id integer,
    in_progress boolean DEFAULT false NOT NULL,
    half_time_finished boolean DEFAULT false,
    half_time_started boolean DEFAULT false,
    game_finished boolean DEFAULT false,
    finished boolean DEFAULT false NOT NULL,
    finished_datetime timestamp without time zone,
    enabled boolean DEFAULT true NOT NULL,
    notified boolean DEFAULT false NOT NULL,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone,
    notified2 boolean DEFAULT false NOT NULL,
    generic_questions_count integer
);


--
-- Name: trivia_points; Type: MATERIALIZED VIEW; Schema: public; Owner: -
--

CREATE MATERIALIZED VIEW public.trivia_points AS
 SELECT row_number() OVER (PARTITION BY correct_answers_subquery.trivia_id ORDER BY correct_answers_subquery.points DESC, correct_answers_subquery.avg) AS "position",
    correct_answers_subquery.trivia_id,
    correct_answers_subquery.user_id,
    correct_answers_subquery.points,
    correct_answers_subquery.avg,
    trivias.start_datetime AS created
   FROM (( SELECT correct_answers.trivia_id,
            correct_answers.user_id,
            sum(correct_answers.points) AS points,
            avg(correct_answers.response_seconds) AS avg
           FROM public.correct_answers
          GROUP BY correct_answers.user_id, correct_answers.trivia_id) correct_answers_subquery
     LEFT JOIN public.trivias ON ((correct_answers_subquery.trivia_id = trivias.id)))
  GROUP BY correct_answers_subquery.user_id, correct_answers_subquery.trivia_id, correct_answers_subquery.points, trivias.start_datetime, correct_answers_subquery.avg
  ORDER BY correct_answers_subquery.trivia_id
  WITH NO DATA;


--
-- Name: championships_users_points; Type: MATERIALIZED VIEW; Schema: public; Owner: -
--

CREATE MATERIALIZED VIEW public.championships_users_points AS
 SELECT championships.id AS championship_id,
    championship_users.user_id,
    sum(trivia_points.points) AS points
   FROM ((public.championship_users
     LEFT JOIN public.championships ON ((championships.id = championship_users.championship_id)))
     LEFT JOIN public.trivia_points ON (((championship_users.user_id = trivia_points.user_id) AND (trivia_points.created >= championships.created))))
  WHERE (championship_users.enabled = true)
  GROUP BY championships.id, championship_users.user_id
  WITH NO DATA;


--
-- Name: championships_users_points_sums; Type: MATERIALIZED VIEW; Schema: public; Owner: -
--

CREATE MATERIALIZED VIEW public.championships_users_points_sums AS
 SELECT championships_users_points.championship_id,
    sum(championships_users_points.points) AS points
   FROM public.championships_users_points
  GROUP BY championships_users_points.championship_id
  WITH NO DATA;


--
-- Name: championships_points; Type: MATERIALIZED VIEW; Schema: public; Owner: -
--

CREATE MATERIALIZED VIEW public.championships_points AS
 SELECT championships_users_points_sums.championship_id,
    sum(championships_users_points_sums.points) AS points
   FROM public.championships_users_points_sums
  GROUP BY championships_users_points_sums.championship_id
  WITH NO DATA;


--
-- Name: championships_rankings; Type: MATERIALIZED VIEW; Schema: public; Owner: -
--

CREATE MATERIALIZED VIEW public.championships_rankings AS
 SELECT row_number() OVER (PARTITION BY true::boolean ORDER BY COALESCE(championships_points.points, (0)::numeric) DESC) AS "position",
    championships_points.championship_id,
    COALESCE(championships_points.points, (0)::numeric) AS points
   FROM public.championships_points
  GROUP BY championships_points.championship_id, championships_points.points
  WITH NO DATA;


--
-- Name: championships_users_points_trivias; Type: MATERIALIZED VIEW; Schema: public; Owner: -
--

CREATE MATERIALIZED VIEW public.championships_users_points_trivias AS
 SELECT trivia_points.trivia_id,
    championships.id AS championship_id,
    championship_users.user_id,
    sum(trivia_points.points) AS points
   FROM ((public.championship_users
     LEFT JOIN public.championships ON ((championships.id = championship_users.championship_id)))
     LEFT JOIN public.trivia_points ON (((championship_users.user_id = trivia_points.user_id) AND (trivia_points.created >= championships.created))))
  WHERE (championship_users.enabled = true)
  GROUP BY championships.id, championship_users.user_id, trivia_points.trivia_id
  WITH NO DATA;


--
-- Name: championships_users_points_trivias_sums; Type: MATERIALIZED VIEW; Schema: public; Owner: -
--

CREATE MATERIALIZED VIEW public.championships_users_points_trivias_sums AS
 SELECT a.championship_id,
    a.trivia_id,
    sum(a.points) AS points
   FROM ( SELECT championships_users_points_trivias.trivia_id,
            championships_users_points_trivias.championship_id,
            championships_users_points_trivias.user_id,
            championships_users_points_trivias.points,
            row_number() OVER (PARTITION BY championships_users_points_trivias.trivia_id, championships_users_points_trivias.championship_id ORDER BY championships_users_points_trivias.points DESC) AS rownum
           FROM public.championships_users_points_trivias) a
  WHERE (a.rownum <= 5)
  GROUP BY a.championship_id, a.trivia_id
  WITH NO DATA;


--
-- Name: contact_topics_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.contact_topics_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


--
-- Name: contact_topics; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.contact_topics (
    id integer DEFAULT nextval('public.contact_topics_id_seq'::regclass) NOT NULL,
    name public.citext
);


--
-- Name: contacts_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.contacts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


--
-- Name: contacts; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.contacts (
    id integer DEFAULT nextval('public.contacts_id_seq'::regclass) NOT NULL,
    user_id uuid,
    contact_topic_id integer,
    body text,
    created timestamp without time zone
);


--
-- Name: dates; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.dates (
    id integer NOT NULL,
    year integer DEFAULT 2018 NOT NULL,
    name character varying(255) NOT NULL,
    from_date date NOT NULL,
    to_date date,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone
);


--
-- Name: dates_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.dates_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: dates_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.dates_id_seq OWNED BY public.dates.id;


--
-- Name: generic_questions; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.generic_questions (
    id integer NOT NULL,
    trivia_id uuid NOT NULL,
    team_id integer NOT NULL,
    question character varying(500) NOT NULL,
    option_1 character varying(255) NOT NULL,
    option_2 character varying(255) NOT NULL,
    option_3 character varying(255) NOT NULL,
    correct_option public.options,
    points integer DEFAULT 10,
    used boolean DEFAULT false NOT NULL,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone,
    "position" integer
);


--
-- Name: generic_questions_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.generic_questions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: generic_questions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.generic_questions_id_seq OWNED BY public.generic_questions.id;


--
-- Name: home_banners; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.home_banners (
    id integer NOT NULL,
    name public.citext NOT NULL,
    start_date date NOT NULL,
    end_date date,
    action character varying(255),
    action_target character varying(255),
    action_target_url character varying(255),
    data jsonb,
    picture character varying(255),
    picture_dir character varying(255),
    created timestamp without time zone,
    modified timestamp without time zone
);


--
-- Name: home_banners_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.home_banners_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: home_banners_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.home_banners_id_seq OWNED BY public.home_banners.id;


--
-- Name: infinite_lives; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.infinite_lives (
    id integer NOT NULL,
    user_id uuid NOT NULL,
    payment_id uuid,
    until timestamp without time zone NOT NULL,
    created timestamp without time zone NOT NULL
);


--
-- Name: infinite_lives_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.infinite_lives_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: infinite_lives_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.infinite_lives_id_seq OWNED BY public.infinite_lives.id;


--
-- Name: jobs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.jobs (
    id integer NOT NULL,
    queue character varying(32) NOT NULL,
    data text NOT NULL,
    priority integer NOT NULL,
    expires_at timestamp without time zone,
    delay_until timestamp without time zone,
    locked integer DEFAULT 0 NOT NULL,
    attempts character varying(255) NOT NULL,
    created_at timestamp without time zone
);


--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.jobs_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: lives; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.lives (
    id uuid NOT NULL,
    user_id uuid NOT NULL,
    lives integer NOT NULL,
    payment_id character(36) DEFAULT NULL::bpchar,
    comments character varying(255) DEFAULT NULL::character varying,
    created timestamp without time zone NOT NULL
);


--
-- Name: wrong_answers; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.wrong_answers (
    id uuid NOT NULL,
    user_id uuid NOT NULL,
    question_id uuid NOT NULL,
    trivia_id uuid NOT NULL,
    points integer NOT NULL,
    selected_option public.options,
    lives integer DEFAULT 1 NOT NULL,
    created timestamp without time zone NOT NULL,
    response_seconds numeric DEFAULT 10.00 NOT NULL
);


--
-- Name: life; Type: MATERIALIZED VIEW; Schema: public; Owner: -
--

CREATE MATERIALIZED VIEW public.life AS
 SELECT lives.user_id,
    (sum(lives.lives) - COALESCE(losed_lives.lives, (0)::bigint)) AS lives
   FROM (public.lives
     LEFT JOIN ( SELECT sum(wrong_answers.lives) AS lives,
            wrong_answers.user_id
           FROM public.wrong_answers
          GROUP BY wrong_answers.user_id) losed_lives ON ((losed_lives.user_id = lives.user_id)))
  GROUP BY lives.user_id, losed_lives.lives
  WITH NO DATA;


--
-- Name: live_packs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.live_packs (
    id integer NOT NULL,
    name character varying(50) NOT NULL,
    lives integer NOT NULL,
    infinite boolean DEFAULT false NOT NULL,
    price numeric(10,2) NOT NULL,
    currency_id character(3) DEFAULT 'ARS'::bpchar NOT NULL,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone
);


--
-- Name: live_packs_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.live_packs_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: live_packs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.live_packs_id_seq OWNED BY public.live_packs.id;


--
-- Name: loaders; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.loaders (
    id integer NOT NULL,
    email character varying(255) DEFAULT NULL::character varying,
    role character varying(10) NOT NULL,
    password character varying(255) NOT NULL,
    first_name character varying(255) DEFAULT NULL::character varying,
    last_name character varying(255) DEFAULT NULL::character varying,
    hash character varying(40) DEFAULT NULL::character varying,
    enabled smallint DEFAULT '1'::smallint,
    document character varying(55) DEFAULT NULL::character varying,
    address character varying(250) DEFAULT NULL::character varying,
    postal_code character varying(50) DEFAULT NULL::character varying,
    phone character varying(100) DEFAULT NULL::character varying,
    mobile_phone character varying(100) DEFAULT NULL::character varying,
    fax character varying(100) DEFAULT NULL::character varying,
    dir character varying(255) DEFAULT NULL::character varying,
    image character varying(255) DEFAULT NULL::character varying,
    about text,
    last_login timestamp without time zone,
    login_count integer DEFAULT 0,
    birth_date date,
    city character varying(300) DEFAULT NULL::character varying,
    province character varying(300) DEFAULT NULL::character varying,
    nationality character varying(255) DEFAULT NULL::character varying,
    deleted smallint DEFAULT '0'::smallint,
    receive_emails boolean,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone,
    created_by integer,
    modified_by integer
);


--
-- Name: loaders_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.loaders_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: loaders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.loaders_id_seq OWNED BY public.loaders.id;


--
-- Name: nodes; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.nodes (
    id integer NOT NULL,
    slug character varying(255),
    title character varying(255),
    body text,
    created timestamp without time zone,
    modified timestamp without time zone
);


--
-- Name: nodes_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.nodes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: nodes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.nodes_id_seq OWNED BY public.nodes.id;


--
-- Name: notifications; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.notifications (
    id bigint NOT NULL,
    user_id uuid NOT NULL,
    title text,
    body text,
    data jsonb,
    notified boolean DEFAULT false,
    created timestamp without time zone,
    modified timestamp without time zone,
    foreign_key text,
    model text,
    unreaded boolean DEFAULT true,
    visible boolean DEFAULT true
);


--
-- Name: notifications_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.notifications_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: notifications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.notifications_id_seq OWNED BY public.notifications.id;


--
-- Name: operators; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.operators (
    id integer NOT NULL,
    email character varying(255) DEFAULT NULL::character varying,
    role character varying(10) NOT NULL,
    password character varying(255) NOT NULL,
    first_name character varying(255) DEFAULT NULL::character varying,
    last_name character varying(255) DEFAULT NULL::character varying,
    hash character varying(40) DEFAULT NULL::character varying,
    enabled smallint DEFAULT '1'::smallint,
    document character varying(55) DEFAULT NULL::character varying,
    address character varying(250) DEFAULT NULL::character varying,
    postal_code character varying(50) DEFAULT NULL::character varying,
    phone character varying(100) DEFAULT NULL::character varying,
    mobile_phone character varying(100) DEFAULT NULL::character varying,
    fax character varying(100) DEFAULT NULL::character varying,
    dir character varying(255) DEFAULT NULL::character varying,
    image character varying(255) DEFAULT NULL::character varying,
    about text,
    last_login timestamp without time zone,
    login_count integer DEFAULT 0,
    birth_date date,
    city character varying(300) DEFAULT NULL::character varying,
    province character varying(300) DEFAULT NULL::character varying,
    nationality character varying(255) DEFAULT NULL::character varying,
    deleted smallint DEFAULT '0'::smallint,
    receive_emails boolean,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone,
    created_by integer,
    modified_by integer
);


--
-- Name: operators_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.operators_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: operators_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.operators_id_seq OWNED BY public.operators.id;


--
-- Name: orders; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.orders (
    id uuid NOT NULL,
    user_id uuid NOT NULL,
    comments character varying(255) DEFAULT NULL::character varying,
    payment_id integer,
    points integer,
    model character varying(255) DEFAULT NULL::character varying,
    foreign_key character varying(36) DEFAULT NULL::character varying,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone
);


--
-- Name: payments; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.payments (
    id uuid NOT NULL,
    method character varying(255) NOT NULL,
    user_id uuid NOT NULL,
    amount numeric(10,2) NOT NULL,
    payment_id bigint NOT NULL,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone
);


--
-- Name: questions; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.questions (
    id uuid NOT NULL,
    model character varying(50) DEFAULT 'QuestionTemplates'::character varying,
    foreign_key integer,
    trivia_id uuid NOT NULL,
    team_id integer NOT NULL,
    question character varying(500) NOT NULL,
    option_1 character varying(255) NOT NULL,
    option_2 character varying(255) NOT NULL,
    option_3 character varying(255) NOT NULL,
    correct_option public.options,
    points integer DEFAULT 10,
    finished boolean DEFAULT false NOT NULL,
    finished_datetime timestamp without time zone,
    canceled boolean DEFAULT false NOT NULL,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone,
    "position" integer,
    publicity_campaign_id integer
);


--
-- Name: played_games; Type: MATERIALIZED VIEW; Schema: public; Owner: -
--

CREATE MATERIALIZED VIEW public.played_games AS
 SELECT answers.user_id,
    count(DISTINCT questions.trivia_id) AS count
   FROM (public.answers
     JOIN public.questions ON ((questions.id = answers.question_id)))
  WHERE (questions.finished = true)
  GROUP BY answers.user_id
  WITH NO DATA;


--
-- Name: points; Type: MATERIALIZED VIEW; Schema: public; Owner: -
--

CREATE MATERIALIZED VIEW public.points AS
 SELECT row_number() OVER (PARTITION BY true::boolean ORDER BY t.points DESC) AS "position",
    t.user_id,
    t.points
   FROM ( SELECT sum(u.points) AS points,
            u.user_id
           FROM ( SELECT correct_answers.user_id,
                    correct_answers.points
                   FROM public.correct_answers
                UNION ALL
                 SELECT orders.user_id,
                    orders.points
                   FROM public.orders) u
          GROUP BY u.user_id) t
  GROUP BY t.user_id, t.points
  WITH NO DATA;


--
-- Name: posts; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.posts (
    id integer NOT NULL,
    slug character varying(255),
    title character varying(255),
    body text,
    created timestamp without time zone,
    modified timestamp without time zone
);


--
-- Name: posts_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.posts_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: posts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.posts_id_seq OWNED BY public.posts.id;


--
-- Name: publicity_campaigns; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.publicity_campaigns (
    id integer NOT NULL,
    model character varying(50) NOT NULL,
    trivia_id uuid,
    banner_id integer NOT NULL,
    model_value integer,
    enabled boolean,
    created timestamp without time zone,
    modified timestamp without time zone,
    model_used_value integer DEFAULT 0
);


--
-- Name: publicity_campaigns_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.publicity_campaigns_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: publicity_campaigns_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.publicity_campaigns_id_seq OWNED BY public.publicity_campaigns.id;


--
-- Name: push_notifications; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.push_notifications (
    id uuid NOT NULL,
    user_id uuid,
    token character(100) NOT NULL,
    enabled boolean DEFAULT true NOT NULL,
    created timestamp without time zone NOT NULL
);


--
-- Name: question_templates; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.question_templates (
    id integer NOT NULL,
    question character varying(500) NOT NULL,
    short_question character varying(20) NOT NULL,
    option_1 character varying(255) NOT NULL,
    option_2 character varying(255) NOT NULL,
    option_3 character varying(255) NOT NULL,
    points integer DEFAULT 10 NOT NULL,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone
);


--
-- Name: question_templates_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.question_templates_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: question_templates_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.question_templates_id_seq OWNED BY public.question_templates.id;


--
-- Name: rankings; Type: MATERIALIZED VIEW; Schema: public; Owner: -
--

CREATE MATERIALIZED VIEW public.rankings AS
 SELECT row_number() OVER (PARTITION BY true::boolean ORDER BY t.points DESC) AS "position",
    t.user_id,
    t.points
   FROM ( SELECT sum(u.points) AS points,
            u.user_id
           FROM ( SELECT correct_answers.user_id,
                    correct_answers.points
                   FROM public.correct_answers
                UNION ALL
                 SELECT orders.user_id,
                    orders.points
                   FROM public.orders) u
          GROUP BY u.user_id) t
  GROUP BY t.user_id, t.points
  WITH NO DATA;


--
-- Name: superusers; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.superusers (
    id integer NOT NULL,
    email character varying(255) DEFAULT NULL::character varying,
    role character varying(10) NOT NULL,
    password character varying(255) NOT NULL,
    first_name character varying(255) DEFAULT NULL::character varying,
    last_name character varying(255) DEFAULT NULL::character varying,
    hash character varying(40) DEFAULT NULL::character varying,
    enabled smallint DEFAULT '1'::smallint,
    document character varying(55) DEFAULT NULL::character varying,
    address character varying(250) DEFAULT NULL::character varying,
    postal_code character varying(50) DEFAULT NULL::character varying,
    phone character varying(100) DEFAULT NULL::character varying,
    mobile_phone character varying(100) DEFAULT NULL::character varying,
    fax character varying(100) DEFAULT NULL::character varying,
    dir character varying(255) DEFAULT NULL::character varying,
    image character varying(255) DEFAULT NULL::character varying,
    about text,
    last_login timestamp without time zone,
    login_count integer DEFAULT 0,
    birth_date date,
    city character varying(300) DEFAULT NULL::character varying,
    province character varying(300) DEFAULT NULL::character varying,
    nationality character varying(255) DEFAULT NULL::character varying,
    deleted smallint DEFAULT '0'::smallint,
    receive_emails boolean,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone,
    created_by integer,
    modified_by integer
);


--
-- Name: superusers_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.superusers_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: superusers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.superusers_id_seq OWNED BY public.superusers.id;


--
-- Name: teams; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.teams (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    picture character varying(255) DEFAULT NULL::character varying,
    picture_dir character varying(255) DEFAULT NULL::character varying,
    created timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    modified timestamp without time zone
);


--
-- Name: teams_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.teams_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: teams_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.teams_id_seq OWNED BY public.teams.id;


--
-- Name: trivia_statistics; Type: MATERIALIZED VIEW; Schema: public; Owner: -
--

CREATE MATERIALIZED VIEW public.trivia_statistics AS
 SELECT trivias.id,
    correct_answers_subquery.correct_answers_count,
    wrong_answers_subquery.wrong_answers_count
   FROM ((public.trivias
     JOIN ( SELECT correct_answers.trivia_id,
            count(correct_answers.trivia_id) AS correct_answers_count
           FROM public.correct_answers
          GROUP BY correct_answers.trivia_id) correct_answers_subquery ON ((trivias.id = correct_answers_subquery.trivia_id)))
     JOIN ( SELECT wrong_answers.trivia_id,
            count(wrong_answers.trivia_id) AS wrong_answers_count
           FROM public.wrong_answers
          GROUP BY wrong_answers.trivia_id) wrong_answers_subquery ON ((trivias.id = wrong_answers_subquery.trivia_id)))
  WITH NO DATA;


--
-- Name: trivia_user_statistics; Type: MATERIALIZED VIEW; Schema: public; Owner: -
--

CREATE MATERIALIZED VIEW public.trivia_user_statistics AS
 SELECT trivia_points."position",
    trivia_points.points,
    trivia_points.trivia_id,
    trivia_points.user_id,
    trivia_statistics_subquery.correct_answers_count,
    trivia_statistics_subquery.wrong_answers_count,
    correct_answers_subquery.correct_answers_user_count,
    wrong_answers_subquery.wrong_answers_user_count,
    points_subquery.general_position,
    points_subquery.general_points
   FROM ((((public.trivia_points
     LEFT JOIN ( SELECT trivia_statistics.id AS trivia_id,
            trivia_statistics.correct_answers_count,
            trivia_statistics.wrong_answers_count
           FROM public.trivia_statistics) trivia_statistics_subquery ON ((trivia_points.trivia_id = trivia_statistics_subquery.trivia_id)))
     LEFT JOIN ( SELECT correct_answers.trivia_id,
            correct_answers.user_id,
            count(correct_answers.trivia_id) AS correct_answers_user_count
           FROM public.correct_answers
          GROUP BY correct_answers.trivia_id, correct_answers.user_id) correct_answers_subquery ON (((trivia_points.trivia_id = correct_answers_subquery.trivia_id) AND (trivia_points.user_id = correct_answers_subquery.user_id))))
     LEFT JOIN ( SELECT wrong_answers.trivia_id,
            wrong_answers.user_id,
            count(wrong_answers.trivia_id) AS wrong_answers_user_count
           FROM public.wrong_answers
          GROUP BY wrong_answers.trivia_id, wrong_answers.user_id) wrong_answers_subquery ON (((trivia_points.trivia_id = wrong_answers_subquery.trivia_id) AND (trivia_points.user_id = wrong_answers_subquery.user_id))))
     LEFT JOIN ( SELECT points."position" AS general_position,
            points.points AS general_points,
            points.user_id
           FROM public.points) points_subquery ON ((trivia_points.user_id = points_subquery.user_id)))
  WITH NO DATA;


--
-- Name: trivias_max_connections; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.trivias_max_connections (
    trivia_id uuid NOT NULL,
    max bigint
);


--
-- Name: unfinished_orders; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.unfinished_orders (
    id uuid NOT NULL,
    user_id uuid NOT NULL,
    comments character varying(255) DEFAULT NULL::character varying,
    points integer,
    model character varying(255) DEFAULT NULL::character varying,
    foreign_key character varying(36) DEFAULT NULL::character varying,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone
);


--
-- Name: updated_indexes; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.updated_indexes (
    table_name text NOT NULL,
    ts timestamp without time zone DEFAULT '-infinity'::timestamp without time zone NOT NULL
);


--
-- Name: users; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.users (
    id uuid NOT NULL,
    username public.citext DEFAULT NULL::bpchar,
    email public.citext NOT NULL,
    password character varying(255) DEFAULT NULL::character varying,
    reset_hash character varying(255) DEFAULT NULL::character varying,
    first_name character varying(255) DEFAULT NULL::character varying,
    last_name character varying(255) DEFAULT NULL::character varying,
    picture character varying(255) DEFAULT NULL::character varying,
    picture_dir character varying(255) DEFAULT NULL::character varying,
    referral_id character(36) DEFAULT NULL::bpchar,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone,
    unreaded_notifications_count integer,
    document bigint,
    mobile_number character varying(255),
    email_verified boolean DEFAULT false,
    enabled boolean DEFAULT true,
    validation_hash character varying(255)
);


--
-- Name: awards id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.awards ALTER COLUMN id SET DEFAULT nextval('public.awards_id_seq'::regclass);


--
-- Name: banners id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.banners ALTER COLUMN id SET DEFAULT nextval('public.banners_id_seq'::regclass);


--
-- Name: championship_dates id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.championship_dates ALTER COLUMN id SET DEFAULT nextval('public.championship_dates_id_seq'::regclass);


--
-- Name: dates id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.dates ALTER COLUMN id SET DEFAULT nextval('public.dates_id_seq'::regclass);


--
-- Name: generic_questions id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.generic_questions ALTER COLUMN id SET DEFAULT nextval('public.generic_questions_id_seq'::regclass);


--
-- Name: home_banners id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.home_banners ALTER COLUMN id SET DEFAULT nextval('public.home_banners_id_seq'::regclass);


--
-- Name: infinite_lives id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.infinite_lives ALTER COLUMN id SET DEFAULT nextval('public.infinite_lives_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: live_packs id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.live_packs ALTER COLUMN id SET DEFAULT nextval('public.live_packs_id_seq'::regclass);


--
-- Name: loaders id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.loaders ALTER COLUMN id SET DEFAULT nextval('public.loaders_id_seq'::regclass);


--
-- Name: nodes id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.nodes ALTER COLUMN id SET DEFAULT nextval('public.nodes_id_seq'::regclass);


--
-- Name: notifications id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.notifications ALTER COLUMN id SET DEFAULT nextval('public.notifications_id_seq'::regclass);


--
-- Name: operators id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.operators ALTER COLUMN id SET DEFAULT nextval('public.operators_id_seq'::regclass);


--
-- Name: posts id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.posts ALTER COLUMN id SET DEFAULT nextval('public.posts_id_seq'::regclass);


--
-- Name: publicity_campaigns id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.publicity_campaigns ALTER COLUMN id SET DEFAULT nextval('public.publicity_campaigns_id_seq'::regclass);


--
-- Name: question_templates id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.question_templates ALTER COLUMN id SET DEFAULT nextval('public.question_templates_id_seq'::regclass);


--
-- Name: superusers id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.superusers ALTER COLUMN id SET DEFAULT nextval('public.superusers_id_seq'::regclass);


--
-- Name: teams id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.teams ALTER COLUMN id SET DEFAULT nextval('public.teams_id_seq'::regclass);


--
-- Data for Name: answers; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.answers (id, user_id, question_id, selected_option, lives, created, response_seconds) FROM stdin;
\.


--
-- Data for Name: auth_token; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.auth_token (id, user_id, access_token, refresh_token, created, modified) FROM stdin;
\.


--
-- Data for Name: awards; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.awards (id, name, description, picture, picture_dir, points, created, modified) FROM stdin;
\.


--
-- Data for Name: banners; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.banners (id, name, action, action_target, action_target_url, data, picture, picture_dir, created, modified) FROM stdin;
\.


--
-- Data for Name: challenge_requests; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.challenge_requests (id, championship_id, user_id, challenge_championship_id, notified, message, acepted, created, modifed, accepted, challenge_user_id, done) FROM stdin;
\.


--
-- Data for Name: challenges; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.challenges (id, championship1_id, championship2_id, user1_id, user2_id, created, modified) FROM stdin;
\.


--
-- Data for Name: championship_dates; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.championship_dates (id, year, name, from_date, to_date, created, modified) FROM stdin;
\.


--
-- Data for Name: championship_users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.championship_users (id, championship_id, user_id, created, modified, enabled) FROM stdin;
\.


--
-- Data for Name: championships; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.championships (id, name, user_id, created, modified, users_count, picture, picture_dir) FROM stdin;
\.


--
-- Data for Name: contact_topics; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.contact_topics (id, name) FROM stdin;
1	Consulta general
2	Vidas
3	Premios
4	Pagos
5	Otros
\.


--
-- Data for Name: contacts; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.contacts (id, user_id, contact_topic_id, body, created) FROM stdin;
\.


--
-- Data for Name: correct_answers; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.correct_answers (id, user_id, question_id, trivia_id, points, selected_option, lives, created, response_seconds) FROM stdin;
\.


--
-- Data for Name: dates; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.dates (id, year, name, from_date, to_date, created, modified) FROM stdin;
\.


--
-- Data for Name: generic_questions; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.generic_questions (id, trivia_id, team_id, question, option_1, option_2, option_3, correct_option, points, used, created, modified, "position") FROM stdin;
\.


--
-- Data for Name: home_banners; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.home_banners (id, name, start_date, end_date, action, action_target, action_target_url, data, picture, picture_dir, created, modified) FROM stdin;
29	Ranking torneo Cuarentena	2020-03-27	2020-05-24	link		https://www.jugadasuperliga.com/nodes/view/Clasificados%20Torneo%20final	\N	home_clasificados.jpg	1aed41e5-605d-4826-b356-d88e72bb6a80	2019-11-28 21:03:43	2020-05-08 18:55:23
32	Anuncio	2020-03-27	2020-07-15	link			\N	home_bg_demo_ (1).jpg	2b5ca7e8-be95-4cf3-9aba-5b212b8b5e61	2020-02-14 18:18:53	2020-06-08 21:48:40
30	TNT Sports Campeones	2019-12-10	2019-12-15	navigate	Home		\N	tnt_corto_low.jpg	d9a1a0dc-467a-4960-97e8-12ee5173158b	2019-12-10 18:25:54	2019-12-13 14:00:34
5	Torneo Amigos	2021-04-12	2021-07-12	link		http://jugadasuperliga.com/pages/display/torneo-amigos?no_header	\N	Banner-TA.gif	b1454249-3fb8-48e5-9dc7-b96737c3dcca	2019-04-12 23:49:04	2021-05-19 18:45:58
\.


--
-- Data for Name: infinite_lives; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.infinite_lives (id, user_id, payment_id, until, created) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.jobs (id, queue, data, priority, expires_at, delay_until, locked, attempts, created_at) FROM stdin;
\.


--
-- Data for Name: live_packs; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.live_packs (id, name, lives, infinite, price, currency_id, created, modified) FROM stdin;
\.


--
-- Data for Name: lives; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.lives (id, user_id, lives, payment_id, comments, created) FROM stdin;
\.


--
-- Data for Name: loaders; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.loaders (id, email, role, password, first_name, last_name, hash, enabled, document, address, postal_code, phone, mobile_phone, fax, dir, image, about, last_login, login_count, birth_date, city, province, nationality, deleted, receive_emails, created, modified, created_by, modified_by) FROM stdin;
1	pablo@jugada.com	contenido	$2y$10$6ZC/O2mBb3XFDksRBcRi4.ibE/z220aPPRasSUWBve8UG.5587h0.	PAblo	Jugada		1										2019-05-01 00:39:00	0	\N				0	f	2019-05-01 00:39:59	2019-05-01 00:39:59	\N	\N
2	matiasmuzio@yahoo.com.ar	Loader	$2y$10$ETeClFd65DKsyyfo3sivO.kDszQbkOaKs0foPJStrlqyQIsH0ejje	Matias	Muzio		1										2019-05-08 23:47:00	0	\N				0	f	2019-05-08 23:47:46	2019-05-08 23:47:46	\N	\N
3	javier@jugada.com	Loader	$2y$10$Xf4hSj4BqZLhpvufKQCVc.wUDTyoNuB5Mjc21PPq2dAUV5hzOQ/dS	Javier	Garcia		1										2019-06-05 20:34:00	0	\N				0	f	2019-06-05 20:34:46	2019-12-23 16:08:40	\N	\N
\.


--
-- Data for Name: nodes; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.nodes (id, slug, title, body, created, modified) FROM stdin;
3	Clasificados Torneo final	Clasificados Torneo final	<p style="text-align: center;"></p>\r\n<p style="text-align: left;"><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;CLASIFICADOS DEL TORNEO DE RECESO</strong><strong></strong></p>\r\n<ol>\r\n<ol>\r\n<li style="text-align: left;"><strong><span>Marcelo Vallejos</span> </strong>(Trivia R&uacute;sticos 28/03) 🥇&nbsp;Comodines:<span> 🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆</span></li>\r\n<li style="text-align: left;"><strong>Luis Bayonne</strong> (Trivia&nbsp; R&uacute;sticos 28/03) 🥇 Comodines:<span> 🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆</span><strong><span></span></strong></li>\r\n<li style="text-align: left;"><strong>Franco Verrando</strong> (Trivia DT's 28/03) 🥇&nbsp;Comodines:<span> 🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆</span></li>\r\n<li style="text-align: left;"><strong>Alejo Gonz&aacute;lez</strong> (Trivia DT's 28/03) <strong>🥇&nbsp;</strong><strong><span></span></strong></li>\r\n<li style="text-align: left;"><strong>Marcos S. Rodriguez</strong> (Trivia Colombianos 29/03) <strong>🥇&nbsp;</strong></li>\r\n<li style="text-align: left;"><strong><span>Mateo Redondo </span></strong>(Trivia Colombianos 29/03) <strong>🥇&nbsp;</strong>Comodines:<span> 🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆</span></li>\r\n<li style="text-align: left;"><strong>Manuel Gignone Proz </strong>(Trivia Arqueros 29/03) <strong>🥇</strong></li>\r\n<li style="text-align: left;"><strong><span>Miguel Angel Ozuna </span></strong>(Trivia Arqueros 29/03) <strong>🥇</strong></li>\r\n<li style="text-align: left;"><strong><span>Juan I. de Goycoechea</span></strong> (Trivia D&oacute;nde debut&oacute; 30/03) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Juan Arguello&nbsp;</span></strong>(Trivia D&oacute;nde debut&oacute; 30/03) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Ian Dionel Chavez</span></strong> (Trivia Uruguayos 30/03) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Franco Ginestra </span></strong>(Trivia Uruguayos 30/03) <strong><span>🥇&nbsp;</span></strong>Comodines:<span> 🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆</span></li>\r\n<li style="text-align: left;"><strong><span>Lautaro Baldi </span></strong>(Trivia River 31/03) <strong><span>🥇 </span></strong>Comodines: <strong><span>🏆🏆🏆🏆</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Santiago L. Aguirre </span></strong>(Trivia River 31/03) <strong><span>🥇&nbsp;</span></strong>Comodines:<span> 🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆🏆</span></li>\r\n<li style="text-align: left;"><strong><span>Fernando D. Vargas</span></strong> (Trivia Paraguayos 31/03) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Facundo Villanueva </span></strong>(Trivia Paraguayos 31/03) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Eze Carr&oacute;n</span></strong> (Trivia Talleres 01/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Martin Oliverio</span></strong> (Trivia Talleres 01/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Marcos Rossi </span></strong>(Trivia C.T&eacute;vez 01/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Ariel M. Diaz </span></strong>(Trivia C.T&eacute;vez 01/04) <strong><span>🥇 </span></strong>Comodines:<span> 🏆🏆🏆🏆🏆</span></li>\r\n<li style="text-align: left;"><strong><span>Luciano Guanatey </span></strong>(Trivia Argentinos Jrs. 02/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Cristian&nbsp; Sammartino </span></strong>(Trivia Argentinos Jrs. 02/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Nahuel Schmidt </span></strong>(Trivia Juanfer Quintero 02/04) <strong><span>🥇</span><span></span></strong></li>\r\n<li style="text-align: left;"><strong><span>Agustin Morasso&nbsp;</span></strong>(Trivia Juanfer Quintero 02/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Kevin H. Kozuch </span></strong>(Trivia Newell's 03/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Marcelo Blanco </span></strong>(Trivia Newell's 03/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Hernan Carnabuci </span></strong>(Trivia F&uacute;tbol&amp;M&uacute;sica 03/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Matias Garnica </span></strong>(Trivia F&uacute;tbol&amp;M&uacute;sica 03/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Gaston Bevilacqua</span></strong> (Trivia Independiente 04/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Baltazar N. Comini </span></strong>(Trivia Independiente 04/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Horacio Bauti</span></strong> (Trivia Segundos nombres 04/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Tomy Herrera </span></strong>(Trivia Segundos nombres 04/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Nahuel Lopez </span></strong>(Trivia Rosario C. 05/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Paula Corvino </span></strong>(Trivia Rosario C. 05/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Papo Da Costa</span></strong>(Trivia Retro 05/04) <strong><span>🥇&nbsp;</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Franco Calabro</span></strong> (Trivia Banfield 06/04) <strong><span> 🥇&nbsp;</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Agustin Mac Garva&nbsp;</span></strong>(Trivia Banfield 06/04) <strong><span> 🥇&nbsp;</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Ramiro Rodriguez</span></strong> (Trivia Grandes goleadores 06/04) <strong><span>🥇&nbsp;</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Marcelo Blanco </span></strong>(Trivia Grandes goleadores 06/04) <strong><span>🥇&nbsp;</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Nicolas Montalbetti</span></strong> (Trivia V&eacute;lez 07/04) <strong><span>🥇&nbsp;</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Ramiro Garc&iacute;a </span></strong>(Trivia V&eacute;lez 07/04) <strong><span>🥇&nbsp;&nbsp;</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Jony Arriola </span></strong>(Trivia Estadios 07/04) <strong><span>🥇&nbsp;&nbsp;</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Diego Lazo </span></strong>(Trivia Estadios 07/04) <strong><span>🥇 </span></strong>Comodines:<span> 🏆🏆🏆🏆🏆🏆</span></li>\r\n<li style="text-align: left;"><strong><span>Cristi&aacute;n A. Errandonea</span></strong> (Trivia Arsenal 08/04) <strong><span>🥇&nbsp;</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Demian Fregenal </span></strong>(Trivia Arsenal 08/04) <strong><span>🥇&nbsp;</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Agustin Arcos </span></strong>(Trivia Dorsales 08/04) <strong><span>🥇&nbsp;</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Tomas Cevasco </span></strong>(Trivia Dorsales 08/04)<strong><span> 🥇&nbsp;</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Ulises Gauna</span></strong> (Trivia Uni&oacute;n 09/04) <strong><span>🥇&nbsp;</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Emi Limido </span></strong>(Trivia Uni&oacute;n 09/04) <strong><span>🥇&nbsp;</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Nicolas Karolinski </span></strong>(Trivia L. L&oacute;pez 09/04)&nbsp;🥇</li>\r\n<li style="text-align: left;"><span><strong>Demian Fregenal</strong> </span>(Trivia L. L&oacute;pez 09/04)&nbsp;🥇</li>\r\n<li style="text-align: left;"><span><strong>Leandro Mercuri</strong> </span>(Trivia M.Gallardo 10/04) 🥇</li>\r\n<li style="text-align: left;"><span><strong>Agust&iacute;n Salom&oacute;n</strong> (Trivia M.Gallardo 10/04) 🥇</span></li>\r\n<li style="text-align: left;"><span><strong>Ezequiel Buceta</strong> (Trivia M.Gallardo 10/04) 🥇</span></li>\r\n<li style="text-align: left;"><span><strong>Santiago Santos</strong> (Trivia Animal 11/04) 🥇</span></li>\r\n<li style="text-align: left;"><span><strong>Nahuel Chiarini</strong> (Trivia Animal 11/04) 🥇</span></li>\r\n<li style="text-align: left;"><span><strong>Carlos Vicca</strong> (Trivia San Lorenzo 11/04) 🥇</span></li>\r\n<li style="text-align: left;"><span><strong>Gianluca Barvio</strong> (Trivia San Lorenzo 11/04) 🥇</span></li>\r\n<li style="text-align: left;"><strong>Cristian Defilippis </strong>(Trivia Hurac&aacute;n 12/04) 🥇</li>\r\n<li style="text-align: left;"><strong>Pablo Federico </strong>(Trivia Hurac&aacute;n 12/04) 🥇</li>\r\n<li style="text-align: left;"><strong>Gonzalo X. Diaz </strong>(Trivia Campeones 12/04)<strong> 🥇</strong></li>\r\n<li style="text-align: left;"><strong><span>Mauricio Fiscella&nbsp;</span></strong>(Trivia Campeones 12/04)<strong> 🥇</strong></li>\r\n<li style="text-align: left;"><strong><span>Davor Gonzalez </span></strong>(Trivia Rachas hist&oacute;ricas 13/04)<strong> 🥇</strong><strong></strong></li>\r\n<li style="text-align: left;"><strong><span>Alejandro Dominguez </span></strong>(Trivia Veteranos 13/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Diego Cyrulnik </span></strong>(Trivia Veteranos 13/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Ricardo Fern&aacute;ndez </span></strong>(Trivia Innova 14/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Facundo Leiva </span></strong>(Trivia Innova 14/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Mati Salomon </span></strong>(Trivia Col&oacute;n 14/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Marcos G. Coria </span></strong>(Trivia Col&oacute;n 14/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Matias Dopazo </span></strong>(Trivia Familiar 15/04) <strong><span>🥇&nbsp;</span></strong>Comodines:<span> 🏆</span></li>\r\n<li style="text-align: left;"><strong><span>Toto Merlo </span></strong>(Trivia Familiar 15/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Walter G. Dopazo </span></strong>(Trivia Gimnasia 15/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Franco Mittelmeier </span></strong>(Trivia Gimnasia 15/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Feliciano D. Aunzain </span></strong>(Trivia Leyendas 16/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Juan Vega </span></strong>(Trivia Estudiantes 16/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Dami Lei </span></strong>(Trivia Estudiantes 16/04) <strong><span>🥇</span></strong><strong><span></span></strong></li>\r\n<li style="text-align: left;"><strong><span>Mariano Salguero </span></strong>(Trivia Defensa y Justicia 17/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Alhely Velasquez </span></strong>(Trivia Defensa y Justicia 17/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Brian Luna </span></strong>(Trivia Defensores 18/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Nicolas de los Santos</span></strong> (Trivia&nbsp;Defensores 18/04) 🥇</li>\r\n<li style="text-align: left;"><span><strong>Adri&aacute;n Lovagnini</strong> (Trivia SAF y Libertadores 19/04) 🥇</span></li>\r\n<li style="text-align: left;"><span><strong>Orne Cecconi </strong>(Trivia Central C. 20/04) 🥇</span></li>\r\n<li style="text-align: left;"><span><strong>Marcelo Rold&aacute;n </strong>(Trivia Central C. 20/04) 🥇</span></li>\r\n<li style="text-align: left;"><strong>Cristian Puentes </strong>(Trivia D&oacute;nde naci&oacute; 20/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Jos&eacute; I. Lagraba </span></strong>(Trivia Aldosivi 21/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Dylan Molina </span></strong>(Trivia Aldosivi 21/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Diego Yagas </span></strong>(Trivia Retro 21/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Mateo Moreira&nbsp;</span></strong>(Trivia Retro 21/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Fabian Castelo </span></strong>(Trivia F&uacute;tbol y Pol&iacute;tica 22/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Hugo P. Gonzalez </span></strong>(Trivia F&uacute;tbol y Pol&iacute;ticos 22/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Pupy Gonzalez </span></strong>(Trivia Godoy Cruz 22/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Nicolas Dode </span></strong>(Trivia A.Tucum&aacute;n 23/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Braian Villagra </span></strong>(Trivia A.Tucum&aacute;n 23/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Lucio Corbacho </span></strong>(Trivia Dorsales 23/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Agus Marto </span></strong>(Trivia Dorsales 23/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Emiliano Paniagua </span></strong>(Trivia Extranjeros 24/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Frank&iacute;&iacute;tho Escudero </span></strong>(Trivia Arg. en Europa 24/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong>Thiago Acosta</strong> (Trivia Extranjeros 25/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Felipe Castellani </span></strong>(Trivia Extranjeros 25/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong>Diego Maucci </strong>(Trivia Lan&uacute;s 25/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Jose Larralde </span></strong>(Trivia Hinchas famosos26/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Mateo Ravetti</span></strong> (Trivia Hinchas famosos 26/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong>Francisco Trapaglia </strong>(Trivia De la gu&iacute;a 26/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong>Matias Geist </strong>(Trivia Patronato 27/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Marcelo Carossinu </span></strong>(Trivia Patronato 27/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong>Fernando Lacuadra </strong>(Trivia Infiltrados 27/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong>Federico Alvarez</strong> (Trivia Rivales y no tanto 28/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Kitoo Ferreyra </span></strong>(Trivia Rivales y no tanto 28/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong>Agust&iacute;n Di Carlo </strong>(Trivia SAF en ascenso 29/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong>Joaqu&iacute;n Luna</strong> (Trivia &Iacute;dolos argentinos 29/04) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Alejandro Garcia </span></strong>(Trivia Pablo Aimar 01/05) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Facundo Zadro </span></strong>(Trivia L. Martinez 02/05) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Agustin Mina</span></strong> (Trivia Tata Martino 03/05) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Ignacio Mart&iacute; </span></strong>(Trivia Tata Martino 03/05) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Marko Mart&iacute;n</span></strong> (Trivia J.Mascherano 04/05) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Matias Marin </span></strong>(Trivia J.Mascherano 04/05) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Felipe Boetto</span></strong> (Trivia Talleres 04/05) <strong><span>🥇</span></strong></li>\r\n<li style="text-align: left;"><strong><span>Facundo Lamarche </span></strong>(Trivia Coco Basile 05/05)<b> <strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Leo Garc&iacute;a</span></strong></b> (Trivia Clubes del interior 07/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Eliseo Fainberg </span></strong></b>(Trivia Boca de Bianchi 07/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Leandro J. </span></strong></b><b><strong><span>Aiello </span></strong></b>(Trivia G.Batistuta 08/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Gabo Tralice</span></strong></b> (Trivia A.Tucum&aacute;n 09/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Gonza de Prada </span></strong></b>(Trivia Dorsales 10/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Juan C. Villarreal </span></strong></b>(Trivia Cholo Gui&ntilde;az&uacute; 11/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Matias Ghiotto </span></strong></b>(Trivia F.Gago 11/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Ezequiel Williman </span></strong></b>(Trivia Arg.en Espa&ntilde;a 13/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Fernando Lacuadra </span></strong></b>(Trivia EdeLP 13/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Mati Mauri </span></strong></b>(Trivia M.Bielsa 14/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>David Caruso</span></strong></b> (Trivia Pepe Sand 15/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Alejandro Marbi </span></strong></b>(Trivia Tigre Gareca 15/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Lucio Limia </span></strong></b>(Trivia J.Pekerman 17/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Juan Carlos Paez </span></strong></b>(Trivia M.Kempes 18/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Hugo P. Ramos </span></strong></b>(Trivia Fiascos Ext. 21/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Claudia K. Lerose </span></strong></b>(Trivia &Iacute;dolos Boca 23/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Franco Soldani </span></strong></b>(Trivia Dorsales SAF 25/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Pablo Mantelli </span></strong></b>(Trivia G.Higua&iacute;n 26/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Andy Juno</span></strong></b> (Trivia R&eacute;cords 27/05) <b><strong><span>🥇</span></strong></b>Comodines: <b><strong><span>🥇🥇🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Fefo Villalba </span></strong></b>(Trivia Qui&eacute;n era el DT 29/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span>Diego Suarez </span></strong></b>(Trivia Actualidad 30/05) <b><strong><span>🥇</span></strong></b></li>\r\n<li style="text-align: left;"><b><strong><span></span></strong></b></li>\r\n</ol>\r\n</ol>	2019-06-11 18:48:49	2020-06-01 17:54:43
4	Torneo cuarentena	Torneo cuarentena	<p class="p1"></p>\r\n<p class="p1"><b>TORNEO "GANALE A LA CUARENTENA"&nbsp;</b></p>\r\n<p class="p1">Quedate en casa, pero ganale a la cuarentena. No hay f&uacute;tbol, pero te vamos a ayudar a que la pases lo mejor posible. Entr&aacute; al "Torneo Ganale a la Cuarentena", respond&eacute; las trivias diarias y vas a poder ganar juegos como el FIFA 20, FIFA points y camisetas.</p>\r\n<p class="p1"><b>&iquest;C&oacute;mo juego?</b></p>\r\n<p class="p1">Es f&aacute;cil. Todos los d&iacute;as vamos a presentar en la app dos trivias tem&aacute;ticas en vivo: una a las 13.30 y otra a las 21. Tambi&eacute;n vamos a lanzar trivias sorpresa en cualquier horario. Cada trivia te clasifica a una final en la que te podes llevar los premios. Atenci&oacute;n, el que m&aacute;s juega, m&aacute;s chances tiene.</p>\r\n<p class="p1"><strong>&iquest;Desde cu&aacute;ndo juego?</strong></p>\r\n<p class="p1">Desde el s&aacute;bado 28 de marzo pod&eacute;s jugar las trivias diarias que te clasifican a la gran final. La continuidad de la cuarentena hace que se extienda el per&iacute;odo del torneo. La final ser&aacute; el lunes 1/6 a las 21 horas.</p>\r\n<p class="p1"><strong>&iquest;C&oacute;mo clasifico a la final?</strong></p>\r\n<p class="p1">Los dos primeros de cada trivia, clasifican a la gran final. Atento, que si ya est&aacute;s clasificado y termin&aacute;s primero o segundo en otra trivia, sum&aacute;s un comod&iacute;n. En caso que los dos primeros de una trivia est&eacute;n ya clasificados, clasificar&aacute; el tercero o cuarto y as&iacute; sucesivamente hasta que haya dos nuevos clasificados por trivia. El comod&iacute;n es muy &uacute;til ya que, si hay empate de puntos en la Gran Final, se definir&aacute; a favor de quien haya sumado mayor cantidad de comodines.&nbsp;</p>\r\n<p class="p1"><b>&iquest;Si no gan&eacute; ninguna trivia o partido puedo jugar y ganar la trivia final?</b></p>\r\n<p class="p1">Claro que s&iacute;. La trivia final es abierta para todos, aunque los clasificados<span class="Apple-converted-space">&nbsp; </span>y quienes hayan sumado comodines tienen prioridad en caso de empate.<b></b></p>\r\n<p class="p1"><b>&iquest;C&oacute;mo gano los premios?</b></p>\r\n<p class="p1">El ganador de la Trivia final ser&aacute; quien conteste la mayor cantidad de preguntas correctas en el menor tiempo posible.&nbsp;</p>\r\n<p class="p1">En caso de empate, ganar&aacute; el que mayor cantidad de comodines sume.</p>\r\n<p class="p1">Si un jugador contesta m&aacute;s preguntas que nadie, pero no estaba clasificado previamente, ser&aacute; el ganador. En caso de empate, se desempata con prioridad para los clasificados y quienes acumulan mayor cantidad de comodines.&nbsp;</p>\r\n<p class="p1"><b>&iquest;</b><b>Cu&aacute;les son los premios?</b></p>\r\n<p class="p1"><b>Los 10 mejores de la final se llevan premios</b></p>\r\n<p class="p1">PRIMERO: <strong>1 Juego FIFA20 de EA Sports y un pack de 12.000 FIFA Points.</strong></p>\r\n<p class="p1">SEGUNDO: <strong>1 Juego FIFA20 de EA Sports.</strong></p>\r\n<p class="p1">TERCERO: <strong>La camiseta de tu equipo (a entregarse cuando lo permita la cuarentena).</strong></p>\r\n<p class="p1">CUARTO: <strong>Un pack de 4.600 FIFA Points.</strong></p>\r\n<p class="p1">QUINTO: <strong>Un pack de 4.600 FIFA Points.</strong></p>\r\n<p class="p2">SEXTO:<strong>. Un pack de 4.600 FIFA Points.</strong></p>\r\n<p class="p2">S&Eacute;PTIMO: <strong>Un pack de 2.200 FIFA Points.</strong></p>\r\n<p class="p2">OCTAVO:<strong>Un pack de 2.200 FIFA Points.</strong></p>\r\n<p class="p2">NOVENO:<b style="font-size: 1rem;"><strong>Un pack de 2.200 FIFA Points.</strong></b></p>\r\n<p class="p2">D&Eacute;CIMO:<b style="font-size: 1rem;"><strong>Un pack de 2.200 FIFA Points.</strong></b></p>\r\n<p class="p2"><b style="font-size: 1rem;">&iquest;C&oacute;mo s&eacute; si clasifiqu&eacute; a la final?</b></p>\r\n<p class="p1">Al final de cada trivia vas a enterarte si fuiste el ganador y si sum&aacute;s comod&iacute;n. Adem&aacute;s, la tabla de los clasificados ser&aacute; publicada en la app y en nuestras redes sociales. Dale ganale a la cuarentena y jug&aacute; a Jugada Superliga!!!</p>	2019-08-29 15:03:22	2020-05-31 15:03:47
\.


--
-- Data for Name: notifications; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.notifications (id, user_id, title, body, data, notified, created, modified, foreign_key, model, unreaded, visible) FROM stdin;
\.


--
-- Data for Name: operators; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.operators (id, email, role, password, first_name, last_name, hash, enabled, document, address, postal_code, phone, mobile_phone, fax, dir, image, about, last_login, login_count, birth_date, city, province, nationality, deleted, receive_emails, created, modified, created_by, modified_by) FROM stdin;
1	pablo@jugada.com	Operador	$2y$10$nu8VV.mY3iTAXlJ892X8vuddqqtUZF86.be5Gte1Tc5N26xg04X22	Pablo	Jugada		1										2019-04-25 22:40:00	0	\N				0	f	2019-04-25 22:40:58	2019-04-25 22:40:58	\N	\N
2	javier@jugadasuperliga.com	admin	$2y$10$rnHqO1pKUHdlH7t8vLHbQuNodDxCA0HuCwC5vwfTOH3ISFoOZeZ2q	Javier	Garcia		1										2019-05-11 20:58:00	0	\N				0	f	2019-05-11 20:59:37	2019-12-23 15:58:02	\N	\N
\.


--
-- Data for Name: orders; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.orders (id, user_id, comments, payment_id, points, model, foreign_key, created, modified) FROM stdin;
\.


--
-- Data for Name: payments; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.payments (id, method, user_id, amount, payment_id, created, modified) FROM stdin;
\.


--
-- Data for Name: posts; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.posts (id, slug, title, body, created, modified) FROM stdin;
\.


--
-- Data for Name: publicity_campaigns; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.publicity_campaigns (id, model, trivia_id, banner_id, model_value, enabled, created, modified, model_used_value) FROM stdin;
3	questions	\N	7	1000	t	2019-11-05 15:00:25	2020-04-17 16:34:20	1000
6	questions	\N	15	1000	t	2019-12-10 18:26:50	2020-01-25 23:42:42	1000
4	questions	\N	8	1000	t	2019-11-05 15:00:38	2020-04-08 00:04:14	1000
7	questions	\N	16	1000	f	2019-12-13 13:39:13	2019-12-13 13:39:13	1000
2	questions	\N	6	1000	t	2019-08-29 15:35:13	2019-10-14 16:31:03	1000
5	questions	\N	9	1000	t	2019-11-05 15:00:48	2020-04-17 00:07:07	1000
\.


--
-- Data for Name: push_notifications; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.push_notifications (id, user_id, token, enabled, created) FROM stdin;
\.


--
-- Data for Name: question_templates; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.question_templates (id, question, short_question, option_1, option_2, option_3, points, created, modified) FROM stdin;
\.


--
-- Data for Name: questions; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.questions (id, model, foreign_key, trivia_id, team_id, question, option_1, option_2, option_3, correct_option, points, finished, finished_datetime, canceled, created, modified, "position", publicity_campaign_id) FROM stdin;
\.


--
-- Data for Name: superusers; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.superusers (id, email, role, password, first_name, last_name, hash, enabled, document, address, postal_code, phone, mobile_phone, fax, dir, image, about, last_login, login_count, birth_date, city, province, nationality, deleted, receive_emails, created, modified, created_by, modified_by) FROM stdin;
\.


--
-- Data for Name: teams; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.teams (id, name, picture, picture_dir, created, modified) FROM stdin;
\.


--
-- Data for Name: trivias; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.trivias (id, local_team_id, visit_team_id, type, title1, title2, award, points_multiplier, start_datetime, date_id, in_progress, half_time_finished, half_time_started, game_finished, finished, finished_datetime, enabled, notified, created, modified, notified2, generic_questions_count) FROM stdin;
\.


--
-- Data for Name: trivias_max_connections; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.trivias_max_connections (trivia_id, max) FROM stdin;
d330df5e-4776-446c-bd47-9f17480706ea	327
4946f7e8-e604-45f6-a90b-4c96149279ef	323
aea7ae0b-9f8a-499a-9f14-cb05e74777f4	299
e9cce4e5-bc54-4684-a54b-de0c607b4177	484
c0a5c08f-2f3d-48a2-a082-2ddf1466dcf9	571
db39f8a0-0f40-42e2-8c68-d80e1e6d23b2	450
c0d71404-f9ea-4d31-ad93-2a7bc1e09d48	266
\.


--
-- Data for Name: unfinished_orders; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.unfinished_orders (id, user_id, comments, points, model, foreign_key, created, modified) FROM stdin;
\.


--
-- Data for Name: updated_indexes; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.updated_indexes (table_name, ts) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.users (id, username, email, password, reset_hash, first_name, last_name, picture, picture_dir, referral_id, created, modified, unreaded_notifications_count, document, mobile_number, email_verified, enabled, validation_hash) FROM stdin;
\.


--
-- Data for Name: wrong_answers; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.wrong_answers (id, user_id, question_id, trivia_id, points, selected_option, lives, created, response_seconds) FROM stdin;
\.


--
-- Name: awards_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.awards_id_seq', 1, false);


--
-- Name: banners_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.banners_id_seq', 16, true);


--
-- Name: championship_dates_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.championship_dates_id_seq', 1, false);


--
-- Name: contact_topics_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.contact_topics_id_seq', 5, true);


--
-- Name: contacts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.contacts_id_seq', 421, true);


--
-- Name: dates_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.dates_id_seq', 59, true);


--
-- Name: generic_questions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.generic_questions_id_seq', 21720, true);


--
-- Name: home_banners_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.home_banners_id_seq', 32, true);


--
-- Name: infinite_lives_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.infinite_lives_id_seq', 58875, true);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: live_packs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.live_packs_id_seq', 1, false);


--
-- Name: loaders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.loaders_id_seq', 3, true);


--
-- Name: nodes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.nodes_id_seq', 4, true);


--
-- Name: notifications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.notifications_id_seq', 784, true);


--
-- Name: operators_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.operators_id_seq', 2, true);


--
-- Name: posts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.posts_id_seq', 1, false);


--
-- Name: publicity_campaigns_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.publicity_campaigns_id_seq', 7, true);


--
-- Name: question_templates_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.question_templates_id_seq', 1, false);


--
-- Name: superusers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.superusers_id_seq', 6, true);


--
-- Name: teams_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.teams_id_seq', 32, true);


--
-- Name: answers answers_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.answers
    ADD CONSTRAINT answers_pkey PRIMARY KEY (id);


--
-- Name: auth_token auth_token_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.auth_token
    ADD CONSTRAINT auth_token_pkey PRIMARY KEY (id);


--
-- Name: awards awards_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.awards
    ADD CONSTRAINT awards_pkey PRIMARY KEY (id);


--
-- Name: banners banners_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.banners
    ADD CONSTRAINT banners_pkey PRIMARY KEY (id);


--
-- Name: challenge_requests challenge_requests_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.challenge_requests
    ADD CONSTRAINT challenge_requests_pkey PRIMARY KEY (id);


--
-- Name: challenges challenges_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.challenges
    ADD CONSTRAINT challenges_pkey PRIMARY KEY (id);


--
-- Name: championship_dates championship_dates_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.championship_dates
    ADD CONSTRAINT championship_dates_pkey PRIMARY KEY (id);


--
-- Name: championship_users championship_users_championship_id_user_id_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.championship_users
    ADD CONSTRAINT championship_users_championship_id_user_id_key UNIQUE (championship_id, user_id);


--
-- Name: championship_users championship_users_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.championship_users
    ADD CONSTRAINT championship_users_pkey PRIMARY KEY (id);


--
-- Name: championships championships_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.championships
    ADD CONSTRAINT championships_pkey PRIMARY KEY (id);


--
-- Name: contact_topics contact_topics_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.contact_topics
    ADD CONSTRAINT contact_topics_pkey PRIMARY KEY (id);


--
-- Name: contacts contacts_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.contacts
    ADD CONSTRAINT contacts_pkey PRIMARY KEY (id);


--
-- Name: correct_answers correct_answers_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.correct_answers
    ADD CONSTRAINT correct_answers_pkey PRIMARY KEY (id);


--
-- Name: dates dates_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.dates
    ADD CONSTRAINT dates_pkey PRIMARY KEY (id);


--
-- Name: generic_questions generic_questions_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.generic_questions
    ADD CONSTRAINT generic_questions_pkey PRIMARY KEY (id);


--
-- Name: home_banners home_banners_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.home_banners
    ADD CONSTRAINT home_banners_pkey PRIMARY KEY (id);


--
-- Name: infinite_lives infinite_lives_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.infinite_lives
    ADD CONSTRAINT infinite_lives_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: live_packs live_packs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.live_packs
    ADD CONSTRAINT live_packs_pkey PRIMARY KEY (id);


--
-- Name: lives lives_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.lives
    ADD CONSTRAINT lives_pkey PRIMARY KEY (id);


--
-- Name: loaders loaders_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.loaders
    ADD CONSTRAINT loaders_pkey PRIMARY KEY (id);


--
-- Name: nodes nodes_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.nodes
    ADD CONSTRAINT nodes_pkey PRIMARY KEY (id);


--
-- Name: notifications notifications_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT notifications_pkey PRIMARY KEY (id);


--
-- Name: operators operators_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.operators
    ADD CONSTRAINT operators_pkey PRIMARY KEY (id);


--
-- Name: orders orders_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_pkey PRIMARY KEY (id);


--
-- Name: payments payments_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.payments
    ADD CONSTRAINT payments_pkey PRIMARY KEY (id);


--
-- Name: posts posts_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_pkey PRIMARY KEY (id);


--
-- Name: publicity_campaigns publicity_campaigns_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.publicity_campaigns
    ADD CONSTRAINT publicity_campaigns_pkey PRIMARY KEY (id);


--
-- Name: push_notifications push_notifications_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.push_notifications
    ADD CONSTRAINT push_notifications_pkey PRIMARY KEY (id);


--
-- Name: question_templates question_templates_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.question_templates
    ADD CONSTRAINT question_templates_pkey PRIMARY KEY (id);


--
-- Name: questions questions_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.questions
    ADD CONSTRAINT questions_pkey PRIMARY KEY (id);


--
-- Name: superusers superusers_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.superusers
    ADD CONSTRAINT superusers_pkey PRIMARY KEY (id);


--
-- Name: teams teams_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.teams
    ADD CONSTRAINT teams_pkey PRIMARY KEY (id);


--
-- Name: trivias_max_connections trivias_max_connections_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.trivias_max_connections
    ADD CONSTRAINT trivias_max_connections_pkey PRIMARY KEY (trivia_id);


--
-- Name: trivias trivias_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.trivias
    ADD CONSTRAINT trivias_pkey PRIMARY KEY (id);


--
-- Name: unfinished_orders unfinished_orders_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.unfinished_orders
    ADD CONSTRAINT unfinished_orders_pkey PRIMARY KEY (id);


--
-- Name: updated_indexes updated_indexes_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.updated_indexes
    ADD CONSTRAINT updated_indexes_pkey PRIMARY KEY (table_name);


--
-- Name: users users_email_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: users users_username_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_key UNIQUE (username);


--
-- Name: wrong_answers wrong_answers_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.wrong_answers
    ADD CONSTRAINT wrong_answers_pkey PRIMARY KEY (id);


--
-- Name: answers_index; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX answers_index ON public.answers USING btree (user_id, question_id);


--
-- Name: answers_latest_updated_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX answers_latest_updated_index ON public.answers USING btree (id, user_id, question_id, selected_option, lives, created, response_seconds) WHERE (created >= '2021-05-21 03:53:30'::timestamp without time zone);


--
-- Name: challenge_requests_championship_id_callenge_championship_id_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX challenge_requests_championship_id_callenge_championship_id_idx ON public.challenge_requests USING btree (championship_id, challenge_championship_id);


--
-- Name: championship_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX championship_index ON public.championship_users USING btree (championship_id);


--
-- Name: championships_points_index; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX championships_points_index ON public.championships_users_points USING btree (championship_id, user_id);


--
-- Name: championships_points_trivias_index; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX championships_points_trivias_index ON public.championships_users_points_trivias USING btree (championship_id, trivia_id, user_id);


--
-- Name: championships_pointsindex; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX championships_pointsindex ON public.championships_points USING btree (championship_id);


--
-- Name: championships_rankings_index; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX championships_rankings_index ON public.championships_rankings USING btree (championship_id);


--
-- Name: championships_users_points_sums_index; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX championships_users_points_sums_index ON public.championships_users_points_sums USING btree (championship_id);


--
-- Name: championships_users_points_trivias_sums_index; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX championships_users_points_trivias_sums_index ON public.championships_users_points_trivias_sums USING btree (championship_id, trivia_id);


--
-- Name: correct_answers_index; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX correct_answers_index ON public.correct_answers USING btree (user_id, question_id);


--
-- Name: correct_answers_latest_updated_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX correct_answers_latest_updated_index ON public.answers USING btree (id, user_id, question_id, selected_option, lives, created, response_seconds) WHERE (created >= '-infinity'::timestamp without time zone);


--
-- Name: life_index; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX life_index ON public.life USING btree (user_id);


--
-- Name: played_games_index; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX played_games_index ON public.played_games USING btree (user_id);


--
-- Name: points_index; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX points_index ON public.points USING btree (user_id);


--
-- Name: rankings_index; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX rankings_index ON public.rankings USING btree (user_id);


--
-- Name: trivia_points_index; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX trivia_points_index ON public.trivia_points USING btree (user_id, trivia_id);


--
-- Name: trivia_statistics_index; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX trivia_statistics_index ON public.trivia_statistics USING btree (id);


--
-- Name: trivia_user_statistics_index; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX trivia_user_statistics_index ON public.trivia_user_statistics USING btree (trivia_id, user_id);


--
-- Name: wrong_answers_index; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX wrong_answers_index ON public.correct_answers USING btree (user_id, question_id);


--
-- Name: wrong_answers_latest_updated_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX wrong_answers_latest_updated_index ON public.answers USING btree (id, user_id, question_id, selected_option, lives, created, response_seconds) WHERE (created >= '-infinity'::timestamp without time zone);


--
-- Name: trivia_points; Type: MATERIALIZED VIEW DATA; Schema: public; Owner: -
--

REFRESH MATERIALIZED VIEW public.trivia_points;


--
-- Name: championships_users_points; Type: MATERIALIZED VIEW DATA; Schema: public; Owner: -
--

REFRESH MATERIALIZED VIEW public.championships_users_points;


--
-- Name: championships_users_points_sums; Type: MATERIALIZED VIEW DATA; Schema: public; Owner: -
--

REFRESH MATERIALIZED VIEW public.championships_users_points_sums;


--
-- Name: championships_points; Type: MATERIALIZED VIEW DATA; Schema: public; Owner: -
--

REFRESH MATERIALIZED VIEW public.championships_points;


--
-- Name: championships_rankings; Type: MATERIALIZED VIEW DATA; Schema: public; Owner: -
--

REFRESH MATERIALIZED VIEW public.championships_rankings;


--
-- Name: championships_users_points_trivias; Type: MATERIALIZED VIEW DATA; Schema: public; Owner: -
--

REFRESH MATERIALIZED VIEW public.championships_users_points_trivias;


--
-- Name: championships_users_points_trivias_sums; Type: MATERIALIZED VIEW DATA; Schema: public; Owner: -
--

REFRESH MATERIALIZED VIEW public.championships_users_points_trivias_sums;


--
-- Name: life; Type: MATERIALIZED VIEW DATA; Schema: public; Owner: -
--

REFRESH MATERIALIZED VIEW public.life;


--
-- Name: played_games; Type: MATERIALIZED VIEW DATA; Schema: public; Owner: -
--

REFRESH MATERIALIZED VIEW public.played_games;


--
-- Name: points; Type: MATERIALIZED VIEW DATA; Schema: public; Owner: -
--

REFRESH MATERIALIZED VIEW public.points;


--
-- Name: rankings; Type: MATERIALIZED VIEW DATA; Schema: public; Owner: -
--

REFRESH MATERIALIZED VIEW public.rankings;


--
-- Name: trivia_statistics; Type: MATERIALIZED VIEW DATA; Schema: public; Owner: -
--

REFRESH MATERIALIZED VIEW public.trivia_statistics;


--
-- Name: trivia_user_statistics; Type: MATERIALIZED VIEW DATA; Schema: public; Owner: -
--

REFRESH MATERIALIZED VIEW public.trivia_user_statistics;


--
-- PostgreSQL database dump complete
--

