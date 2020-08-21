--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: YiiSession; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE "YiiSession" (
    id character(32) NOT NULL,
    expire integer,
    data bytea
);


ALTER TABLE "YiiSession" OWNER TO gigadb;

--
-- Name: alternative_identifiers; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE alternative_identifiers (
    id integer NOT NULL,
    sample_id integer NOT NULL,
    extdb_id integer NOT NULL,
    extdb_accession character varying(100)
);


ALTER TABLE alternative_identifiers OWNER TO gigadb;

--
-- Name: alternative_identifiers_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE alternative_identifiers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE alternative_identifiers_id_seq OWNER TO gigadb;

--
-- Name: alternative_identifiers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE alternative_identifiers_id_seq OWNED BY alternative_identifiers.id;


--
-- Name: attribute; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE attribute (
    id integer NOT NULL,
    attribute_name character varying(100),
    definition character varying(1000),
    model character varying(100),
    structured_comment_name character varying(100),
    value_syntax character varying(500),
    allowed_units character varying(100),
    occurance character varying(5),
    ontology_link character varying(1000),
    note character varying(100)
);


ALTER TABLE attribute OWNER TO gigadb;

--
-- Name: attribute_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE attribute_id_seq
    START WITH 700
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE attribute_id_seq OWNER TO gigadb;

--
-- Name: attribute_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE attribute_id_seq OWNED BY attribute.id;


--
-- Name: authassignment; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE authassignment (
    itemname character varying(64) NOT NULL,
    userid character varying(64) NOT NULL,
    bizrule text,
    data text
);


ALTER TABLE authassignment OWNER TO gigadb;

--
-- Name: authitem; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE authitem (
    name character varying(64) NOT NULL,
    type integer NOT NULL,
    description text,
    bizrule text,
    data text
);


ALTER TABLE authitem OWNER TO gigadb;

--
-- Name: author; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE author (
    id integer NOT NULL,
    surname character varying(255) NOT NULL,
    middle_name character varying(255),
    first_name character varying(255),
    orcid character varying(255),
    gigadb_user_id integer,
    custom_name character varying(100)
);


ALTER TABLE author OWNER TO gigadb;

--
-- Name: author_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE author_id_seq
    START WITH 3500
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE author_id_seq OWNER TO gigadb;

--
-- Name: author_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE author_id_seq OWNED BY author.id;


--
-- Name: author_rel; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE author_rel (
    id integer NOT NULL,
    author_id integer NOT NULL,
    related_author_id integer NOT NULL,
    relationship_id integer
);


ALTER TABLE author_rel OWNER TO gigadb;

--
-- Name: author_rel_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE author_rel_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE author_rel_id_seq OWNER TO gigadb;

--
-- Name: author_rel_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE author_rel_id_seq OWNED BY author_rel.id;


--
-- Name: contribution; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE contribution (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    source character varying(255) NOT NULL,
    description character varying(255) NOT NULL
);


ALTER TABLE contribution OWNER TO gigadb;

--
-- Name: contribution_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE contribution_id_seq
    START WITH 15
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE contribution_id_seq OWNER TO gigadb;

--
-- Name: contribution_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE contribution_id_seq OWNED BY contribution.id;


--
-- Name: curation_log; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE curation_log (
    id integer NOT NULL,
    dataset_id integer NOT NULL,
    creation_date date,
    created_by character varying(100),
    last_modified_date date,
    last_modified_by character varying(100),
    action character varying(100),
    comments character varying(1000)
);


ALTER TABLE curation_log OWNER TO gigadb;

--
-- Name: curation_log_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE curation_log_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE curation_log_id_seq OWNER TO gigadb;

--
-- Name: curation_log_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE curation_log_id_seq OWNED BY curation_log.id;


--
-- Name: dataset; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE dataset (
    id integer NOT NULL,
    submitter_id integer NOT NULL,
    image_id integer,
    identifier character varying(32) NOT NULL,
    title character varying(300) NOT NULL,
    description text DEFAULT ''::text NOT NULL,
    dataset_size bigint,
    ftp_site character varying(100) NOT NULL,
    upload_status character varying(45) DEFAULT 'AuthorReview'::character varying NOT NULL,
    excelfile character varying(50),
    excelfile_md5 character varying(32),
    publication_date date,
    modification_date date,
    publisher_id integer,
    token character varying(16) DEFAULT NULL::character varying,
    fairnuse date,
    curator_id integer,
    manuscript_id character varying(50),
    handing_editor character varying(50),
    additional_information smallint,
    funding smallint,
    is_test smallint,
    creation_date date,
    is_deleted smallint
);


ALTER TABLE dataset OWNER TO gigadb;

--
-- Name: dataset_attributes; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE dataset_attributes (
    id integer NOT NULL,
    dataset_id integer,
    attribute_id integer,
    value character varying(200),
    units_id character varying(30),
    image_id integer,
    until_date date
);


ALTER TABLE dataset_attributes OWNER TO gigadb;

--
-- Name: dataset_attributes_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE dataset_attributes_id_seq
    START WITH 2500
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE dataset_attributes_id_seq OWNER TO gigadb;

--
-- Name: dataset_attributes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE dataset_attributes_id_seq OWNED BY dataset_attributes.id;


--
-- Name: dataset_author; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE dataset_author (
    id integer NOT NULL,
    dataset_id integer NOT NULL,
    author_id integer NOT NULL,
    rank integer DEFAULT 0,
    role character varying(30),
    contribution_id integer
);


ALTER TABLE dataset_author OWNER TO gigadb;

--
-- Name: dataset_author_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE dataset_author_id_seq
    START WITH 200
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE dataset_author_id_seq OWNER TO gigadb;

--
-- Name: dataset_author_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE dataset_author_id_seq OWNED BY dataset_author.id;


--
-- Name: dataset_funder; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE dataset_funder (
    id integer NOT NULL,
    dataset_id integer NOT NULL,
    funder_id integer NOT NULL,
    grant_award text DEFAULT ''::text,
    comments text DEFAULT ''::text,
    awardee character varying(100)
);


ALTER TABLE dataset_funder OWNER TO gigadb;

--
-- Name: dataset_funder_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE dataset_funder_id_seq
    START WITH 50
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE dataset_funder_id_seq OWNER TO gigadb;

--
-- Name: dataset_funder_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE dataset_funder_id_seq OWNED BY dataset_funder.id;


--
-- Name: dataset_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE dataset_id_seq
    START WITH 50
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE dataset_id_seq OWNER TO gigadb;

--
-- Name: dataset_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE dataset_id_seq OWNED BY dataset.id;


--
-- Name: dataset_log; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE dataset_log (
    id integer NOT NULL,
    dataset_id integer NOT NULL,
    message text DEFAULT ''::text,
    created_at timestamp without time zone DEFAULT now(),
    model text,
    model_id integer,
    url text DEFAULT ''::text
);


ALTER TABLE dataset_log OWNER TO gigadb;

--
-- Name: dataset_log_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE dataset_log_id_seq
    START WITH 1200
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE dataset_log_id_seq OWNER TO gigadb;

--
-- Name: dataset_log_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE dataset_log_id_seq OWNED BY dataset_log.id;


--
-- Name: dataset_project; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE dataset_project (
    id integer NOT NULL,
    dataset_id integer,
    project_id integer
);


ALTER TABLE dataset_project OWNER TO gigadb;

--
-- Name: dataset_project_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE dataset_project_id_seq
    START WITH 20
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE dataset_project_id_seq OWNER TO gigadb;

--
-- Name: dataset_project_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE dataset_project_id_seq OWNED BY dataset_project.id;


--
-- Name: dataset_sample; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE dataset_sample (
    id integer NOT NULL,
    dataset_id integer NOT NULL,
    sample_id integer NOT NULL
);


ALTER TABLE dataset_sample OWNER TO gigadb;

--
-- Name: dataset_sample_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE dataset_sample_id_seq
    START WITH 500
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE dataset_sample_id_seq OWNER TO gigadb;

--
-- Name: dataset_sample_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE dataset_sample_id_seq OWNED BY dataset_sample.id;


--
-- Name: dataset_session; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE dataset_session (
    id integer NOT NULL,
    identifier text NOT NULL,
    dataset text,
    dataset_id text,
    datasettypes text,
    images text,
    authors text,
    projects text,
    links text,
    "externalLinks" text,
    relations text,
    samples text
);


ALTER TABLE dataset_session OWNER TO gigadb;

--
-- Name: dataset_session_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE dataset_session_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE dataset_session_id_seq OWNER TO gigadb;

--
-- Name: dataset_session_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE dataset_session_id_seq OWNED BY dataset_session.id;


--
-- Name: dataset_type; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE dataset_type (
    id integer NOT NULL,
    dataset_id integer NOT NULL,
    type_id integer
);


ALTER TABLE dataset_type OWNER TO gigadb;

--
-- Name: dataset_type_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE dataset_type_id_seq
    START WITH 50
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE dataset_type_id_seq OWNER TO gigadb;

--
-- Name: dataset_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE dataset_type_id_seq OWNED BY dataset_type.id;


--
-- Name: exp_attributes; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE exp_attributes (
    id integer NOT NULL,
    exp_id integer,
    attribute_id integer,
    value character varying(1000),
    units_id character varying(50)
);


ALTER TABLE exp_attributes OWNER TO gigadb;

--
-- Name: exp_attributes_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE exp_attributes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE exp_attributes_id_seq OWNER TO gigadb;

--
-- Name: exp_attributes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE exp_attributes_id_seq OWNED BY exp_attributes.id;


--
-- Name: experiment; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE experiment (
    id integer NOT NULL,
    experiment_type character varying(100),
    experiment_name character varying(100),
    exp_description character varying(1000),
    dataset_id integer,
    "protocols.io" character varying(200)
);


ALTER TABLE experiment OWNER TO gigadb;

--
-- Name: experiment_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE experiment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE experiment_id_seq OWNER TO gigadb;

--
-- Name: experiment_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE experiment_id_seq OWNED BY experiment.id;


--
-- Name: extdb; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE extdb (
    id integer NOT NULL,
    database_name character varying(100),
    definition character varying(1000),
    database_homepage character varying(100),
    database_search_url character varying(100)
);


ALTER TABLE extdb OWNER TO gigadb;

--
-- Name: extdb_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE extdb_id_seq
    START WITH 10
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE extdb_id_seq OWNER TO gigadb;

--
-- Name: extdb_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE extdb_id_seq OWNED BY extdb.id;


--
-- Name: external_link; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE external_link (
    id integer NOT NULL,
    dataset_id integer NOT NULL,
    url character varying(300) NOT NULL,
    external_link_type_id integer NOT NULL,
    description character varying(200)
);


ALTER TABLE external_link OWNER TO gigadb;

--
-- Name: external_link_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE external_link_id_seq
    START WITH 1000
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE external_link_id_seq OWNER TO gigadb;

--
-- Name: external_link_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE external_link_id_seq OWNED BY external_link.id;


--
-- Name: external_link_type; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE external_link_type (
    id integer NOT NULL,
    name character varying(45) NOT NULL
);


ALTER TABLE external_link_type OWNER TO gigadb;

--
-- Name: external_link_type_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE external_link_type_id_seq
    START WITH 10
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE external_link_type_id_seq OWNER TO gigadb;

--
-- Name: external_link_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE external_link_type_id_seq OWNED BY external_link_type.id;


--
-- Name: file; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE file (
    id integer NOT NULL,
    dataset_id integer NOT NULL,
    name character varying(200) NOT NULL,
    location character varying(500) NOT NULL,
    extension character varying(100) NOT NULL,
    size bigint NOT NULL,
    description text DEFAULT ''::text NOT NULL,
    date_stamp date,
    format_id integer,
    type_id integer,
    code character varying(200) DEFAULT 'FILE_CODE'::character varying,
    index4blast character varying(50),
    download_count integer DEFAULT 0 NOT NULL,
    alternative_location character varying(200)
);


ALTER TABLE file OWNER TO gigadb;

--
-- Name: file_attributes; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE file_attributes (
    id integer NOT NULL,
    file_id integer NOT NULL,
    attribute_id integer NOT NULL,
    value character varying(1000),
    unit_id character varying(30)
);


ALTER TABLE file_attributes OWNER TO gigadb;

--
-- Name: file_attributes_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE file_attributes_id_seq
    START WITH 11000
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE file_attributes_id_seq OWNER TO gigadb;

--
-- Name: file_attributes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE file_attributes_id_seq OWNED BY file_attributes.id;


--
-- Name: file_experiment; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE file_experiment (
    id integer NOT NULL,
    file_id integer,
    experiment_id integer
);


ALTER TABLE file_experiment OWNER TO gigadb;

--
-- Name: file_experiment_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE file_experiment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE file_experiment_id_seq OWNER TO gigadb;

--
-- Name: file_experiment_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE file_experiment_id_seq OWNED BY file_experiment.id;


--
-- Name: file_format; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE file_format (
    id integer NOT NULL,
    name character varying(20) NOT NULL,
    description text DEFAULT ''::text NOT NULL,
    edam_ontology_id character varying(100)
);


ALTER TABLE file_format OWNER TO gigadb;

--
-- Name: file_format_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE file_format_id_seq
    START WITH 100
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE file_format_id_seq OWNER TO gigadb;

--
-- Name: file_format_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE file_format_id_seq OWNED BY file_format.id;


--
-- Name: file_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE file_id_seq
    START WITH 6300
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE file_id_seq OWNER TO gigadb;

--
-- Name: file_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE file_id_seq OWNED BY file.id;


--
-- Name: file_number; Type: VIEW; Schema: public; Owner: gigadb
--

CREATE VIEW file_number AS
 SELECT count(file.id) AS count
   FROM file;


ALTER TABLE file_number OWNER TO gigadb;

--
-- Name: file_relationship; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE file_relationship (
    id integer NOT NULL,
    file_id integer NOT NULL,
    related_file_id integer NOT NULL,
    relationship_id integer
);


ALTER TABLE file_relationship OWNER TO gigadb;

--
-- Name: file_relationship_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE file_relationship_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE file_relationship_id_seq OWNER TO gigadb;

--
-- Name: file_relationship_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE file_relationship_id_seq OWNED BY file_relationship.id;


--
-- Name: file_sample; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE file_sample (
    id integer NOT NULL,
    sample_id integer NOT NULL,
    file_id integer NOT NULL
);


ALTER TABLE file_sample OWNER TO gigadb;

--
-- Name: file_sample_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE file_sample_id_seq
    START WITH 5800
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE file_sample_id_seq OWNER TO gigadb;

--
-- Name: file_sample_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE file_sample_id_seq OWNED BY file_sample.id;


--
-- Name: file_type; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE file_type (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    description text DEFAULT ''::text NOT NULL,
    edam_ontology_id character varying(100)
);


ALTER TABLE file_type OWNER TO gigadb;

--
-- Name: file_type_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE file_type_id_seq
    START WITH 200
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE file_type_id_seq OWNER TO gigadb;

--
-- Name: file_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE file_type_id_seq OWNED BY file_type.id;


--
-- Name: funder_name; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE funder_name (
    id integer NOT NULL,
    uri character varying(100) NOT NULL,
    primary_name_display character varying(1000),
    country character varying(128) DEFAULT ''::character varying
);


ALTER TABLE funder_name OWNER TO gigadb;

--
-- Name: funder_name_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE funder_name_id_seq
    START WITH 6200
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE funder_name_id_seq OWNER TO gigadb;

--
-- Name: funder_name_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE funder_name_id_seq OWNED BY funder_name.id;


--
-- Name: gigadb_user; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE gigadb_user (
    id integer NOT NULL,
    email character varying(64) NOT NULL,
    password character varying(128) NOT NULL,
    first_name character varying(100) NOT NULL,
    last_name character varying(100) NOT NULL,
    affiliation character varying(200),
    role character varying(30) DEFAULT 'user'::character varying NOT NULL,
    is_activated boolean DEFAULT false NOT NULL,
    newsletter boolean DEFAULT true NOT NULL,
    previous_newsletter_state boolean DEFAULT false NOT NULL,
    facebook_id text,
    twitter_id text,
    linkedin_id text,
    google_id text,
    username text NOT NULL,
    orcid_id text,
    preferred_link character varying(128) DEFAULT 'EBI'::character varying
);


ALTER TABLE gigadb_user OWNER TO gigadb;

--
-- Name: gigadb_user_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE gigadb_user_id_seq
    START WITH 20
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE gigadb_user_id_seq OWNER TO gigadb;

--
-- Name: gigadb_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE gigadb_user_id_seq OWNED BY gigadb_user.id;


--
-- Name: type; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE type (
    id integer NOT NULL,
    name character varying(32) NOT NULL,
    description text DEFAULT ''::text NOT NULL
);


ALTER TABLE type OWNER TO gigadb;

--
-- Name: homepage_dataset_type; Type: VIEW; Schema: public; Owner: gigadb
--

CREATE VIEW homepage_dataset_type AS
 SELECT type.name,
    count(dataset_type.id) AS count
   FROM dataset_type,
    type,
    dataset
  WHERE (((dataset_type.type_id = type.id) AND (dataset_type.dataset_id = dataset.id)) AND ((dataset.upload_status)::text = 'Published'::text))
  GROUP BY type.name;


ALTER TABLE homepage_dataset_type OWNER TO gigadb;

--
-- Name: image; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE image (
    id integer NOT NULL,
    location character varying(200) DEFAULT ''::character varying NOT NULL,
    tag character varying(300),
    url character varying(256),
    license text NOT NULL,
    photographer character varying(128) NOT NULL,
    source character varying(256) NOT NULL
);


ALTER TABLE image OWNER TO gigadb;

--
-- Name: image_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE image_id_seq
    START WITH 40
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE image_id_seq OWNER TO gigadb;

--
-- Name: image_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE image_id_seq OWNED BY image.id;


--
-- Name: link; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE link (
    id integer NOT NULL,
    dataset_id integer NOT NULL,
    is_primary boolean DEFAULT false NOT NULL,
    link character varying(100) NOT NULL,
    description character varying(200)
);


ALTER TABLE link OWNER TO gigadb;

--
-- Name: link_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE link_id_seq
    START WITH 80
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE link_id_seq OWNER TO gigadb;

--
-- Name: link_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE link_id_seq OWNED BY link.id;


--
-- Name: link_prefix_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE link_prefix_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE link_prefix_id_seq OWNER TO gigadb;

--
-- Name: manuscript; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE manuscript (
    id integer NOT NULL,
    identifier character varying(32) NOT NULL,
    pmid integer,
    dataset_id integer NOT NULL
);


ALTER TABLE manuscript OWNER TO gigadb;

--
-- Name: manuscript_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE manuscript_id_seq
    START WITH 500
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE manuscript_id_seq OWNER TO gigadb;

--
-- Name: manuscript_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE manuscript_id_seq OWNED BY manuscript.id;


--
-- Name: news; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE news (
    id integer NOT NULL,
    title character varying(200) NOT NULL,
    body text DEFAULT ''::text NOT NULL,
    start_date date NOT NULL,
    end_date date NOT NULL
);


ALTER TABLE news OWNER TO gigadb;

--
-- Name: news_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE news_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE news_id_seq OWNER TO gigadb;

--
-- Name: news_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE news_id_seq OWNED BY news.id;


--
-- Name: prefix; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE prefix (
    id integer DEFAULT nextval('link_prefix_id_seq'::regclass) NOT NULL,
    prefix character(20) NOT NULL,
    url text NOT NULL,
    source character varying(128) DEFAULT ''::character varying,
    icon character varying(100),
    regexp character varying(128)
);


ALTER TABLE prefix OWNER TO gigadb;

--
-- Name: project; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE project (
    id integer NOT NULL,
    url character varying(128) NOT NULL,
    name character varying(255) DEFAULT ''::character varying NOT NULL,
    image_location character varying(100)
);


ALTER TABLE project OWNER TO gigadb;

--
-- Name: project_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE project_id_seq
    START WITH 10
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE project_id_seq OWNER TO gigadb;

--
-- Name: project_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE project_id_seq OWNED BY project.id;


--
-- Name: publisher; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE publisher (
    id integer NOT NULL,
    name character varying(45) NOT NULL,
    description text DEFAULT ''::text NOT NULL
);


ALTER TABLE publisher OWNER TO gigadb;

--
-- Name: publisher_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE publisher_id_seq
    START WITH 10
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE publisher_id_seq OWNER TO gigadb;

--
-- Name: publisher_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE publisher_id_seq OWNED BY publisher.id;


--
-- Name: relation; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE relation (
    id integer NOT NULL,
    dataset_id integer NOT NULL,
    related_doi character varying(15) NOT NULL,
    relationship_id integer
);


ALTER TABLE relation OWNER TO gigadb;

--
-- Name: relation_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE relation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE relation_id_seq OWNER TO gigadb;

--
-- Name: relation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE relation_id_seq OWNED BY relation.id;


--
-- Name: relationship_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE relationship_id_seq
    START WITH 40
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE relationship_id_seq OWNER TO gigadb;

--
-- Name: relationship; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE relationship (
    id integer DEFAULT nextval('relationship_id_seq'::regclass) NOT NULL,
    name character varying(100)
);


ALTER TABLE relationship OWNER TO gigadb;

--
-- Name: rss_message; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE rss_message (
    id integer NOT NULL,
    message character varying(128) NOT NULL,
    publication_date date DEFAULT ('now'::text)::date NOT NULL
);


ALTER TABLE rss_message OWNER TO gigadb;

--
-- Name: rss_message_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE rss_message_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rss_message_id_seq OWNER TO gigadb;

--
-- Name: rss_message_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE rss_message_id_seq OWNED BY rss_message.id;


--
-- Name: sample; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE sample (
    id integer NOT NULL,
    species_id integer NOT NULL,
    name character varying(100) DEFAULT 'SAMPLE:SRS188811'::character varying NOT NULL,
    consent_document character varying(45),
    submitted_id integer,
    submission_date date,
    contact_author_name character varying(45),
    contact_author_email character varying(100),
    sampling_protocol character varying(100)
);


ALTER TABLE sample OWNER TO gigadb;

--
-- Name: sample_attribute; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE sample_attribute (
    id integer NOT NULL,
    sample_id integer NOT NULL,
    attribute_id integer NOT NULL,
    value character varying(10000),
    unit_id character varying(30)
);


ALTER TABLE sample_attribute OWNER TO gigadb;

--
-- Name: sample_attribute_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE sample_attribute_id_seq
    START WITH 30000
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sample_attribute_id_seq OWNER TO gigadb;

--
-- Name: sample_attribute_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE sample_attribute_id_seq OWNED BY sample_attribute.id;


--
-- Name: sample_experiment; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE sample_experiment (
    id integer NOT NULL,
    sample_id integer,
    experiment_id integer
);


ALTER TABLE sample_experiment OWNER TO gigadb;

--
-- Name: sample_experiment_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE sample_experiment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sample_experiment_id_seq OWNER TO gigadb;

--
-- Name: sample_experiment_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE sample_experiment_id_seq OWNED BY sample_experiment.id;


--
-- Name: sample_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE sample_id_seq
    START WITH 500
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sample_id_seq OWNER TO gigadb;

--
-- Name: sample_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE sample_id_seq OWNED BY sample.id;


--
-- Name: sample_number; Type: VIEW; Schema: public; Owner: gigadb
--

CREATE VIEW sample_number AS
 SELECT count(sample.id) AS count
   FROM sample;


ALTER TABLE sample_number OWNER TO gigadb;

--
-- Name: sample_rel; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE sample_rel (
    id integer NOT NULL,
    sample_id integer NOT NULL,
    related_sample_id integer NOT NULL,
    relationship_id integer
);


ALTER TABLE sample_rel OWNER TO gigadb;

--
-- Name: sample_rel_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE sample_rel_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sample_rel_id_seq OWNER TO gigadb;

--
-- Name: sample_rel_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE sample_rel_id_seq OWNED BY sample_rel.id;


--
-- Name: search; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE search (
    id integer NOT NULL,
    user_id integer NOT NULL,
    name character varying(128) NOT NULL,
    query text NOT NULL,
    result text
);


ALTER TABLE search OWNER TO gigadb;

--
-- Name: search_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE search_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE search_id_seq OWNER TO gigadb;

--
-- Name: search_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE search_id_seq OWNED BY search.id;


--
-- Name: show_accession; Type: VIEW; Schema: public; Owner: gigadb
--

CREATE VIEW show_accession AS
 SELECT ('DOI: '::text || (dataset.identifier)::text) AS doi_number,
    link.link AS related_accessions
   FROM (dataset
     JOIN link ON ((dataset.id = link.dataset_id)));


ALTER TABLE show_accession OWNER TO gigadb;

--
-- Name: show_manuscript; Type: VIEW; Schema: public; Owner: gigadb
--

CREATE VIEW show_manuscript AS
 SELECT ('DOI: '::text || (dataset.identifier)::text) AS doi_number,
    manuscript.identifier AS related_manuscript
   FROM (dataset
     JOIN manuscript ON ((dataset.id = manuscript.dataset_id)));


ALTER TABLE show_manuscript OWNER TO gigadb;

--
-- Name: show_project; Type: VIEW; Schema: public; Owner: gigadb
--

CREATE VIEW show_project AS
 SELECT ('DOI: '::text || (dataset.identifier)::text) AS doi_number,
    project.name AS project
   FROM ((dataset
     JOIN dataset_project ON ((dataset.id = dataset_project.dataset_id)))
     JOIN project ON ((dataset_project.project_id = project.id)));


ALTER TABLE show_project OWNER TO gigadb;

--
-- Name: species; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE species (
    id integer NOT NULL,
    tax_id integer NOT NULL,
    common_name character varying(128),
    genbank_name character varying(128),
    scientific_name character varying(128) NOT NULL,
    eol_link character varying(100)
);


ALTER TABLE species OWNER TO gigadb;

--
-- Name: species_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE species_id_seq
    START WITH 500
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE species_id_seq OWNER TO gigadb;

--
-- Name: species_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE species_id_seq OWNED BY species.id;


--
-- Name: tbl_migration; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE tbl_migration (
    version character varying(180) NOT NULL,
    apply_time integer
);


ALTER TABLE tbl_migration OWNER TO gigadb;

--
-- Name: template_attribute; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE template_attribute (
    id integer NOT NULL,
    template_name_id integer,
    attribute_id integer
);


ALTER TABLE template_attribute OWNER TO gigadb;

--
-- Name: template_attribute_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE template_attribute_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE template_attribute_id_seq OWNER TO gigadb;

--
-- Name: template_attribute_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE template_attribute_id_seq OWNED BY template_attribute.id;


--
-- Name: template_name; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE template_name (
    id integer NOT NULL,
    template_name character varying(50) NOT NULL,
    template_description character varying(255),
    notes character varying(255)
);


ALTER TABLE template_name OWNER TO gigadb;

--
-- Name: template_name_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE template_name_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE template_name_id_seq OWNER TO gigadb;

--
-- Name: template_name_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE template_name_id_seq OWNED BY template_name.id;


--
-- Name: type_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE type_id_seq
    START WITH 30
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE type_id_seq OWNER TO gigadb;

--
-- Name: type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE type_id_seq OWNED BY type.id;


--
-- Name: unit; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE unit (
    id character varying(30) NOT NULL,
    name character varying(200),
    definition character varying(500)
);


ALTER TABLE unit OWNER TO gigadb;

--
-- Name: user_command; Type: TABLE; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE TABLE user_command (
    id integer NOT NULL,
    action_label character varying(32) NOT NULL,
    requester_id integer NOT NULL,
    actioner_id integer,
    actionable_id integer NOT NULL,
    request_date timestamp without time zone,
    action_date timestamp without time zone,
    status character varying(32) NOT NULL
);


ALTER TABLE user_command OWNER TO gigadb;

--
-- Name: user_command_id_seq; Type: SEQUENCE; Schema: public; Owner: gigadb
--

CREATE SEQUENCE user_command_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE user_command_id_seq OWNER TO gigadb;

--
-- Name: user_command_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gigadb
--

ALTER SEQUENCE user_command_id_seq OWNED BY user_command.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY alternative_identifiers ALTER COLUMN id SET DEFAULT nextval('alternative_identifiers_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY attribute ALTER COLUMN id SET DEFAULT nextval('attribute_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY author ALTER COLUMN id SET DEFAULT nextval('author_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY author_rel ALTER COLUMN id SET DEFAULT nextval('author_rel_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY contribution ALTER COLUMN id SET DEFAULT nextval('contribution_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY curation_log ALTER COLUMN id SET DEFAULT nextval('curation_log_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset ALTER COLUMN id SET DEFAULT nextval('dataset_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_attributes ALTER COLUMN id SET DEFAULT nextval('dataset_attributes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_author ALTER COLUMN id SET DEFAULT nextval('dataset_author_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_funder ALTER COLUMN id SET DEFAULT nextval('dataset_funder_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_log ALTER COLUMN id SET DEFAULT nextval('dataset_log_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_project ALTER COLUMN id SET DEFAULT nextval('dataset_project_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_sample ALTER COLUMN id SET DEFAULT nextval('dataset_sample_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_session ALTER COLUMN id SET DEFAULT nextval('dataset_session_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_type ALTER COLUMN id SET DEFAULT nextval('dataset_type_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY exp_attributes ALTER COLUMN id SET DEFAULT nextval('exp_attributes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY experiment ALTER COLUMN id SET DEFAULT nextval('experiment_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY extdb ALTER COLUMN id SET DEFAULT nextval('extdb_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY external_link ALTER COLUMN id SET DEFAULT nextval('external_link_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY external_link_type ALTER COLUMN id SET DEFAULT nextval('external_link_type_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file ALTER COLUMN id SET DEFAULT nextval('file_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file_attributes ALTER COLUMN id SET DEFAULT nextval('file_attributes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file_experiment ALTER COLUMN id SET DEFAULT nextval('file_experiment_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file_format ALTER COLUMN id SET DEFAULT nextval('file_format_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file_relationship ALTER COLUMN id SET DEFAULT nextval('file_relationship_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file_sample ALTER COLUMN id SET DEFAULT nextval('file_sample_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file_type ALTER COLUMN id SET DEFAULT nextval('file_type_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY funder_name ALTER COLUMN id SET DEFAULT nextval('funder_name_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY gigadb_user ALTER COLUMN id SET DEFAULT nextval('gigadb_user_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY image ALTER COLUMN id SET DEFAULT nextval('image_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY link ALTER COLUMN id SET DEFAULT nextval('link_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY manuscript ALTER COLUMN id SET DEFAULT nextval('manuscript_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY news ALTER COLUMN id SET DEFAULT nextval('news_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY project ALTER COLUMN id SET DEFAULT nextval('project_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY publisher ALTER COLUMN id SET DEFAULT nextval('publisher_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY relation ALTER COLUMN id SET DEFAULT nextval('relation_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY rss_message ALTER COLUMN id SET DEFAULT nextval('rss_message_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY sample ALTER COLUMN id SET DEFAULT nextval('sample_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY sample_attribute ALTER COLUMN id SET DEFAULT nextval('sample_attribute_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY sample_experiment ALTER COLUMN id SET DEFAULT nextval('sample_experiment_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY sample_rel ALTER COLUMN id SET DEFAULT nextval('sample_rel_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY search ALTER COLUMN id SET DEFAULT nextval('search_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY species ALTER COLUMN id SET DEFAULT nextval('species_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY type ALTER COLUMN id SET DEFAULT nextval('type_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY user_command ALTER COLUMN id SET DEFAULT nextval('user_command_id_seq'::regclass);


--
-- Data for Name: YiiSession; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY "YiiSession" (id, expire, data) FROM stdin;
\.


--
-- Data for Name: alternative_identifiers; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY alternative_identifiers (id, sample_id, extdb_id, extdb_accession) FROM stdin;
\.


--
-- Name: alternative_identifiers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('alternative_identifiers_id_seq', 1, false);


--
-- Data for Name: attribute; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY attribute (id, attribute_name, definition, model, structured_comment_name, value_syntax, allowed_units, occurance, ontology_link, note) FROM stdin;
\.


--
-- Name: attribute_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('attribute_id_seq', 421, true);


--
-- Data for Name: authassignment; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY authassignment (itemname, userid, bizrule, data) FROM stdin;
\.


--
-- Data for Name: authitem; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY authitem (name, type, description, bizrule, data) FROM stdin;
\.


--
-- Data for Name: author; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY author (id, surname, middle_name, first_name, orcid, gigadb_user_id, custom_name) FROM stdin;
\.


--
-- Name: author_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('author_id_seq', 3788, true);


--
-- Data for Name: author_rel; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY author_rel (id, author_id, related_author_id, relationship_id) FROM stdin;
\.


--
-- Name: author_rel_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('author_rel_id_seq', 1, false);


--
-- Data for Name: contribution; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY contribution (id, name, source, description) FROM stdin;
\.


--
-- Name: contribution_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('contribution_id_seq', 1, false);


--
-- Data for Name: curation_log; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY curation_log (id, dataset_id, creation_date, created_by, last_modified_date, last_modified_by, action, comments) FROM stdin;
\.


--
-- Name: curation_log_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('curation_log_id_seq', 1, false);


--
-- Data for Name: dataset; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY dataset (id, submitter_id, image_id, identifier, title, description, dataset_size, ftp_site, upload_status, excelfile, excelfile_md5, publication_date, modification_date, publisher_id, token, fairnuse, curator_id, manuscript_id, handing_editor, additional_information, funding, is_test, creation_date, is_deleted) FROM stdin;
\.


--
-- Data for Name: dataset_attributes; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY dataset_attributes (id, dataset_id, attribute_id, value, units_id, image_id, until_date) FROM stdin;
\.


--
-- Name: dataset_attributes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('dataset_attributes_id_seq', 35, true);


--
-- Data for Name: dataset_author; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY dataset_author (id, dataset_id, author_id, rank, role, contribution_id) FROM stdin;
\.


--
-- Name: dataset_author_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('dataset_author_id_seq', 3477, true);


--
-- Data for Name: dataset_funder; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY dataset_funder (id, dataset_id, funder_id, grant_award, comments, awardee) FROM stdin;
\.


--
-- Name: dataset_funder_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('dataset_funder_id_seq', 31, true);


--
-- Name: dataset_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('dataset_id_seq', 208, true);


--
-- Data for Name: dataset_log; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY dataset_log (id, dataset_id, message, created_at, model, model_id, url) FROM stdin;
\.


--
-- Name: dataset_log_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('dataset_log_id_seq', 82, true);


--
-- Data for Name: dataset_project; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY dataset_project (id, dataset_id, project_id) FROM stdin;
\.


--
-- Name: dataset_project_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('dataset_project_id_seq', 125, true);


--
-- Data for Name: dataset_sample; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY dataset_sample (id, dataset_id, sample_id) FROM stdin;
\.


--
-- Name: dataset_sample_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('dataset_sample_id_seq', 4353, true);


--
-- Data for Name: dataset_session; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY dataset_session (id, identifier, dataset, dataset_id, datasettypes, images, authors, projects, links, "externalLinks", relations, samples) FROM stdin;
\.


--
-- Name: dataset_session_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('dataset_session_id_seq', 26, true);


--
-- Data for Name: dataset_type; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY dataset_type (id, dataset_id, type_id) FROM stdin;
\.


--
-- Name: dataset_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('dataset_type_id_seq', 254, true);


--
-- Data for Name: exp_attributes; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY exp_attributes (id, exp_id, attribute_id, value, units_id) FROM stdin;
\.


--
-- Name: exp_attributes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('exp_attributes_id_seq', 5, true);


--
-- Data for Name: experiment; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY experiment (id, experiment_type, experiment_name, exp_description, dataset_id, "protocols.io") FROM stdin;
\.


--
-- Name: experiment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('experiment_id_seq', 3, true);


--
-- Data for Name: extdb; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY extdb (id, database_name, definition, database_homepage, database_search_url) FROM stdin;
\.


--
-- Name: extdb_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('extdb_id_seq', 2, true);


--
-- Data for Name: external_link; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY external_link (id, dataset_id, url, external_link_type_id, description) FROM stdin;
\.


--
-- Name: external_link_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('external_link_id_seq', 59, true);


--
-- Data for Name: external_link_type; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY external_link_type (id, name) FROM stdin;
\.


--
-- Name: external_link_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('external_link_type_id_seq', 2, true);


--
-- Data for Name: file; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY file (id, dataset_id, name, location, extension, size, description, date_stamp, format_id, type_id, code, index4blast, download_count, alternative_location) FROM stdin;
\.


--
-- Data for Name: file_attributes; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY file_attributes (id, file_id, attribute_id, value, unit_id) FROM stdin;
\.


--
-- Name: file_attributes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('file_attributes_id_seq', 2, true);


--
-- Data for Name: file_experiment; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY file_experiment (id, file_id, experiment_id) FROM stdin;
\.


--
-- Name: file_experiment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('file_experiment_id_seq', 1, true);


--
-- Data for Name: file_format; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY file_format (id, name, description, edam_ontology_id) FROM stdin;
\.


--
-- Name: file_format_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('file_format_id_seq', 40, true);


--
-- Name: file_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('file_id_seq', 88251, true);


--
-- Data for Name: file_relationship; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY file_relationship (id, file_id, related_file_id, relationship_id) FROM stdin;
\.


--
-- Name: file_relationship_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('file_relationship_id_seq', 4, true);


--
-- Data for Name: file_sample; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY file_sample (id, sample_id, file_id) FROM stdin;
\.


--
-- Name: file_sample_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('file_sample_id_seq', 18915, true);


--
-- Data for Name: file_type; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY file_type (id, name, description, edam_ontology_id) FROM stdin;
\.


--
-- Name: file_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('file_type_id_seq', 109, true);


--
-- Data for Name: funder_name; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY funder_name (id, uri, primary_name_display, country) FROM stdin;
\.


--
-- Name: funder_name_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('funder_name_id_seq', 6171, true);


--
-- Data for Name: gigadb_user; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY gigadb_user (id, email, password, first_name, last_name, affiliation, role, is_activated, newsletter, previous_newsletter_state, facebook_id, twitter_id, linkedin_id, google_id, username, orcid_id, preferred_link) FROM stdin;
\.


--
-- Name: gigadb_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('gigadb_user_id_seq', 343, true);


--
-- Data for Name: image; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY image (id, location, tag, url, license, photographer, source) FROM stdin;
\.


--
-- Name: image_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('image_id_seq', 220, true);


--
-- Data for Name: link; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY link (id, dataset_id, is_primary, link, description) FROM stdin;
\.


--
-- Name: link_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('link_id_seq', 294, true);


--
-- Name: link_prefix_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('link_prefix_id_seq', 44, true);


--
-- Data for Name: manuscript; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY manuscript (id, identifier, pmid, dataset_id) FROM stdin;
\.


--
-- Name: manuscript_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('manuscript_id_seq', 284, true);


--
-- Data for Name: news; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY news (id, title, body, start_date, end_date) FROM stdin;
\.


--
-- Name: news_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('news_id_seq', 3, true);


--
-- Data for Name: prefix; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY prefix (id, prefix, url, source, icon, regexp) FROM stdin;
\.


--
-- Data for Name: project; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY project (id, url, name, image_location) FROM stdin;
\.


--
-- Name: project_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('project_id_seq', 15, true);


--
-- Data for Name: publisher; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY publisher (id, name, description) FROM stdin;
\.


--
-- Name: publisher_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('publisher_id_seq', 4, true);


--
-- Data for Name: relation; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY relation (id, dataset_id, related_doi, relationship_id) FROM stdin;
\.


--
-- Name: relation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('relation_id_seq', 84, true);


--
-- Data for Name: relationship; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY relationship (id, name) FROM stdin;
\.


--
-- Name: relationship_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('relationship_id_seq', 21, true);


--
-- Data for Name: rss_message; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY rss_message (id, message, publication_date) FROM stdin;
\.


--
-- Name: rss_message_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('rss_message_id_seq', 2, true);


--
-- Data for Name: sample; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY sample (id, species_id, name, consent_document, submitted_id, submission_date, contact_author_name, contact_author_email, sampling_protocol) FROM stdin;
\.


--
-- Data for Name: sample_attribute; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY sample_attribute (id, sample_id, attribute_id, value, unit_id) FROM stdin;
\.


--
-- Name: sample_attribute_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('sample_attribute_id_seq', 30059, true);


--
-- Data for Name: sample_experiment; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY sample_experiment (id, sample_id, experiment_id) FROM stdin;
\.


--
-- Name: sample_experiment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('sample_experiment_id_seq', 2, true);


--
-- Name: sample_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('sample_id_seq', 4344, true);


--
-- Data for Name: sample_rel; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY sample_rel (id, sample_id, related_sample_id, relationship_id) FROM stdin;
\.


--
-- Name: sample_rel_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('sample_rel_id_seq', 8, true);


--
-- Data for Name: search; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY search (id, user_id, name, query, result) FROM stdin;
\.


--
-- Name: search_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('search_id_seq', 27, true);


--
-- Data for Name: species; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY species (id, tax_id, common_name, genbank_name, scientific_name, eol_link) FROM stdin;
\.


--
-- Name: species_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('species_id_seq', 1128853, true);


--
-- Data for Name: tbl_migration; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY tbl_migration (version, apply_time) FROM stdin;
m000000_000000_base	1596160740
m200528_050725_create_authitem_tab	1596160740
m200528_050823_create_authassignment_tab	1596160741
m200528_052407_create_yiisession_tab	1596160741
m200528_052836_create_extdb_tab	1596160741
m200528_052850_create_species_tab	1596160741
m200528_052860_create_gigadb_user_tab	1596160741
m200528_052880_create_sample_tab	1596160741
m200528_052900_create_alternative_identifiers_tab	1596160741
m200528_053712_create_attribute_tab	1596160741
m200528_054920_create_author_tab	1596160741
m200528_054960_create_author_rel_tab	1596160741
m200528_055005_create_image_tab	1596160741
m200528_055100_create_publisher_tab	1596160741
m200528_055110_create_dataset_tab	1596160741
m200528_055350_create_curation_log_tab	1596160741
m200528_057932_create_unit_tab	1596160741
m200528_060345_create_dataset_attributes_tab	1596160741
m200528_060906_create_dataset_author_tab	1596160741
m200528_061005_create_funder_name_tab	1596160741
m200528_061339_create_dataset_funder_tab	1596160741
m200528_061933_create_dataset_log_tab	1596160741
m200528_063052_create_project_tab	1596160741
m200528_064612_create_dataset_project_tab	1596160741
m200528_065011_create_dataset_sample_tab	1596160741
m200528_065406_create_dataset_session_tab	1596160742
m200528_065513_create_type_tab	1596160742
m200528_065837_create_dataset_type_tab	1596160742
m200528_066022_create_experiment_tab	1596160742
m200528_070231_create_exp_attributes_tab	1596160742
m200528_071027_create_external_link_type_tab	1596160742
m200528_071227_create_external_link_tab	1596160742
m200528_072037_create_file_format_tab	1596160742
m200528_072552_create_file_type_tab	1596160742
m200528_075520_create_file_tab	1596160742
m200528_090557_create_file_attributes_tab	1596160742
m200528_091351_create_file_experiment_tab	1596160742
m200528_091646_create_relationship_tab	1596160742
m200528_092231_create_file_relationship_tab	1596160742
m200528_092609_create_file_sample_tab	1596160742
m200529_020859_create_link_tab	1596160742
m200529_021512_create_manuscript_tab	1596160742
m200529_022144_create_news_tab	1596160742
m200529_022516_create_prefix_tab	1596160742
m200529_023319_create_relation_tab	1596160742
m200529_024441_create_rss_message_tab	1596160742
m200529_025806_create_sample_attribute_tab	1596160742
m200529_030439_create_sample_experiment_tab	1596160742
m200529_030927_create_sample_rel_tab	1596160742
m200529_032549_create_search_tab	1596160742
m200529_032907_create_show_accession_view	1596160742
m200529_033116_create_show_manuscript_view	1596160742
m200529_033307_create_show_project_view	1596160742
m200529_034715_create_view_homepage_dataset_type	1596160742
m200529_035151_create_user_command_tab	1596160743
m200529_040000_subwiz_create_contribution_tab	1596160743
m200529_040050_subwiz_create_template_name_tab	1596160743
m200529_040100_subwiz_create_template_attribute_tab	1596160743
m200529_040150_subwiz_alter_dataset_tab	1596160743
m200529_040200_subwiz_alter_external_link_tab	1596160743
m200529_040250_subwiz_alter_prefix_tab	1596160743
m200529_040300_subwiz_alter_dataset_author_tab	1596160743
\.


--
-- Data for Name: template_attribute; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY template_attribute (id, template_name_id, attribute_id) FROM stdin;
\.


--
-- Name: template_attribute_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('template_attribute_id_seq', 1, false);


--
-- Data for Name: template_name; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY template_name (id, template_name, template_description, notes) FROM stdin;
\.


--
-- Name: template_name_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('template_name_id_seq', 1, false);


--
-- Data for Name: type; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY type (id, name, description) FROM stdin;
\.


--
-- Name: type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('type_id_seq', 16, true);


--
-- Data for Name: unit; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY unit (id, name, definition) FROM stdin;
\.


--
-- Data for Name: user_command; Type: TABLE DATA; Schema: public; Owner: gigadb
--

COPY user_command (id, action_label, requester_id, actioner_id, actionable_id, request_date, action_date, status) FROM stdin;
\.


--
-- Name: user_command_id_seq; Type: SEQUENCE SET; Schema: public; Owner: gigadb
--

SELECT pg_catalog.setval('user_command_id_seq', 1, false);


--
-- Name: YiiSession_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY "YiiSession"
    ADD CONSTRAINT "YiiSession_pkey" PRIMARY KEY (id);


--
-- Name: alternative_identifiers_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY alternative_identifiers
    ADD CONSTRAINT alternative_identifiers_pkey PRIMARY KEY (id);


--
-- Name: attribute_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY attribute
    ADD CONSTRAINT attribute_pkey PRIMARY KEY (id);


--
-- Name: authassignment_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY authassignment
    ADD CONSTRAINT authassignment_pkey PRIMARY KEY (itemname, userid);


--
-- Name: authitem_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY authitem
    ADD CONSTRAINT authitem_pkey PRIMARY KEY (name);


--
-- Name: author_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY author
    ADD CONSTRAINT author_pkey PRIMARY KEY (id);


--
-- Name: author_rel_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY author_rel
    ADD CONSTRAINT author_rel_pkey PRIMARY KEY (id);


--
-- Name: contribution_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY contribution
    ADD CONSTRAINT contribution_pkey PRIMARY KEY (id);


--
-- Name: contribution_unique_name; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY contribution
    ADD CONSTRAINT contribution_unique_name UNIQUE (name);


--
-- Name: curation_log_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY curation_log
    ADD CONSTRAINT curation_log_pkey PRIMARY KEY (id);


--
-- Name: dataset_attributes_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY dataset_attributes
    ADD CONSTRAINT dataset_attributes_pkey PRIMARY KEY (id);


--
-- Name: dataset_author_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY dataset_author
    ADD CONSTRAINT dataset_author_pkey PRIMARY KEY (id);


--
-- Name: dataset_funder_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY dataset_funder
    ADD CONSTRAINT dataset_funder_pkey PRIMARY KEY (id);


--
-- Name: dataset_log_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY dataset_log
    ADD CONSTRAINT dataset_log_pkey PRIMARY KEY (id);


--
-- Name: dataset_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY dataset
    ADD CONSTRAINT dataset_pkey PRIMARY KEY (id);


--
-- Name: dataset_project_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY dataset_project
    ADD CONSTRAINT dataset_project_pkey PRIMARY KEY (id);


--
-- Name: dataset_sample_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY dataset_sample
    ADD CONSTRAINT dataset_sample_pkey PRIMARY KEY (id);


--
-- Name: dataset_session_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY dataset_session
    ADD CONSTRAINT dataset_session_pkey PRIMARY KEY (id);


--
-- Name: dataset_type_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY dataset_type
    ADD CONSTRAINT dataset_type_pkey PRIMARY KEY (id);


--
-- Name: email_unique; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY gigadb_user
    ADD CONSTRAINT email_unique UNIQUE (email);


--
-- Name: exp_attributes_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY exp_attributes
    ADD CONSTRAINT exp_attributes_pkey PRIMARY KEY (id);


--
-- Name: experiment_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY experiment
    ADD CONSTRAINT experiment_pkey PRIMARY KEY (id);


--
-- Name: extdb_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY extdb
    ADD CONSTRAINT extdb_pkey PRIMARY KEY (id);


--
-- Name: external_link_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY external_link
    ADD CONSTRAINT external_link_pkey PRIMARY KEY (id);


--
-- Name: external_link_type_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY external_link_type
    ADD CONSTRAINT external_link_type_pkey PRIMARY KEY (id);


--
-- Name: file_attributes_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY file_attributes
    ADD CONSTRAINT file_attributes_pkey PRIMARY KEY (id);


--
-- Name: file_experiment_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY file_experiment
    ADD CONSTRAINT file_experiment_pkey PRIMARY KEY (id);


--
-- Name: file_format_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY file_format
    ADD CONSTRAINT file_format_pkey PRIMARY KEY (id);


--
-- Name: file_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY file
    ADD CONSTRAINT file_pkey PRIMARY KEY (id);


--
-- Name: file_relationship_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY file_relationship
    ADD CONSTRAINT file_relationship_pkey PRIMARY KEY (id);


--
-- Name: file_sample_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY file_sample
    ADD CONSTRAINT file_sample_pkey PRIMARY KEY (id);


--
-- Name: file_type_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY file_type
    ADD CONSTRAINT file_type_pkey PRIMARY KEY (id);


--
-- Name: funder_name_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY funder_name
    ADD CONSTRAINT funder_name_pkey PRIMARY KEY (id);


--
-- Name: gigadb_user_facebook_id_key; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY gigadb_user
    ADD CONSTRAINT gigadb_user_facebook_id_key UNIQUE (facebook_id);


--
-- Name: gigadb_user_google_id_key; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY gigadb_user
    ADD CONSTRAINT gigadb_user_google_id_key UNIQUE (google_id);


--
-- Name: gigadb_user_linked_id_key; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY gigadb_user
    ADD CONSTRAINT gigadb_user_linked_id_key UNIQUE (linkedin_id);


--
-- Name: gigadb_user_orcid_id_key; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY gigadb_user
    ADD CONSTRAINT gigadb_user_orcid_id_key UNIQUE (orcid_id);


--
-- Name: gigadb_user_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY gigadb_user
    ADD CONSTRAINT gigadb_user_pkey PRIMARY KEY (id);


--
-- Name: gigadb_user_twitter_id_key; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY gigadb_user
    ADD CONSTRAINT gigadb_user_twitter_id_key UNIQUE (twitter_id);


--
-- Name: gigadb_user_username_key; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY gigadb_user
    ADD CONSTRAINT gigadb_user_username_key UNIQUE (username);


--
-- Name: image_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY image
    ADD CONSTRAINT image_pkey PRIMARY KEY (id);


--
-- Name: link_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY link
    ADD CONSTRAINT link_pkey PRIMARY KEY (id);


--
-- Name: link_prefix_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY prefix
    ADD CONSTRAINT link_prefix_pkey PRIMARY KEY (id);


--
-- Name: manuscript_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY manuscript
    ADD CONSTRAINT manuscript_pkey PRIMARY KEY (id);


--
-- Name: news_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY news
    ADD CONSTRAINT news_pkey PRIMARY KEY (id);


--
-- Name: project_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY project
    ADD CONSTRAINT project_pkey PRIMARY KEY (id);


--
-- Name: publisher_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY publisher
    ADD CONSTRAINT publisher_pkey PRIMARY KEY (id);


--
-- Name: relation_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY relation
    ADD CONSTRAINT relation_pkey PRIMARY KEY (id);


--
-- Name: relationship_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY relationship
    ADD CONSTRAINT relationship_pkey PRIMARY KEY (id);


--
-- Name: rss_message_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY rss_message
    ADD CONSTRAINT rss_message_pkey PRIMARY KEY (id);


--
-- Name: sample_attribute_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY sample_attribute
    ADD CONSTRAINT sample_attribute_pkey PRIMARY KEY (id);


--
-- Name: sample_experiment_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY sample_experiment
    ADD CONSTRAINT sample_experiment_pkey PRIMARY KEY (id);


--
-- Name: sample_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY sample
    ADD CONSTRAINT sample_pkey PRIMARY KEY (id);


--
-- Name: sample_rel_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY sample_rel
    ADD CONSTRAINT sample_rel_pkey PRIMARY KEY (id);


--
-- Name: search_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY search
    ADD CONSTRAINT search_pkey PRIMARY KEY (id);


--
-- Name: species_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY species
    ADD CONSTRAINT species_pkey PRIMARY KEY (id);


--
-- Name: tbl_migration_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY tbl_migration
    ADD CONSTRAINT tbl_migration_pkey PRIMARY KEY (version);


--
-- Name: template_attribute_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY template_attribute
    ADD CONSTRAINT template_attribute_pkey PRIMARY KEY (id);


--
-- Name: template_name_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY template_name
    ADD CONSTRAINT template_name_pkey PRIMARY KEY (id);


--
-- Name: type_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY type
    ADD CONSTRAINT type_pkey PRIMARY KEY (id);


--
-- Name: unit_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY unit
    ADD CONSTRAINT unit_pkey PRIMARY KEY (id);


--
-- Name: user_command_pkey; Type: CONSTRAINT; Schema: public; Owner: gigadb; Tablespace: 
--

ALTER TABLE ONLY user_command
    ADD CONSTRAINT user_command_pkey PRIMARY KEY (id);


--
-- Name: fki_sample_attribute_fkey; Type: INDEX; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE INDEX fki_sample_attribute_fkey ON sample_attribute USING btree (attribute_id);


--
-- Name: identifier_idx; Type: INDEX; Schema: public; Owner: gigadb; Tablespace: 
--

CREATE UNIQUE INDEX identifier_idx ON dataset USING btree (identifier);


--
-- Name: alternative_identifiers_extdb_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY alternative_identifiers
    ADD CONSTRAINT alternative_identifiers_extdb_id_fkey FOREIGN KEY (extdb_id) REFERENCES extdb(id);


--
-- Name: alternative_identifiers_sample_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY alternative_identifiers
    ADD CONSTRAINT alternative_identifiers_sample_id_fkey FOREIGN KEY (sample_id) REFERENCES sample(id);


--
-- Name: authassignment_itemname_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY authassignment
    ADD CONSTRAINT authassignment_itemname_fkey FOREIGN KEY (itemname) REFERENCES authitem(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: curation_log_dataset_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY curation_log
    ADD CONSTRAINT curation_log_dataset_id_fkey FOREIGN KEY (dataset_id) REFERENCES dataset(id) ON DELETE CASCADE;


--
-- Name: dataset_attributes_attribute_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_attributes
    ADD CONSTRAINT dataset_attributes_attribute_id_fkey FOREIGN KEY (attribute_id) REFERENCES attribute(id);


--
-- Name: dataset_attributes_dataset_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_attributes
    ADD CONSTRAINT dataset_attributes_dataset_id_fkey FOREIGN KEY (dataset_id) REFERENCES dataset(id);


--
-- Name: dataset_attributes_units_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_attributes
    ADD CONSTRAINT dataset_attributes_units_id_fkey FOREIGN KEY (units_id) REFERENCES unit(id);


--
-- Name: dataset_author_author_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_author
    ADD CONSTRAINT dataset_author_author_id_fkey FOREIGN KEY (author_id) REFERENCES author(id) ON DELETE CASCADE;


--
-- Name: dataset_author_dataset_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_author
    ADD CONSTRAINT dataset_author_dataset_id_fkey FOREIGN KEY (dataset_id) REFERENCES dataset(id) ON DELETE CASCADE;


--
-- Name: dataset_curator_id; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset
    ADD CONSTRAINT dataset_curator_id FOREIGN KEY (curator_id) REFERENCES gigadb_user(id);


--
-- Name: dataset_funder_dataset_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_funder
    ADD CONSTRAINT dataset_funder_dataset_id_fkey FOREIGN KEY (dataset_id) REFERENCES dataset(id) ON DELETE CASCADE;


--
-- Name: dataset_funder_funder_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_funder
    ADD CONSTRAINT dataset_funder_funder_id_fkey FOREIGN KEY (funder_id) REFERENCES funder_name(id) ON DELETE CASCADE;


--
-- Name: dataset_image_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset
    ADD CONSTRAINT dataset_image_id_fkey FOREIGN KEY (image_id) REFERENCES image(id) ON DELETE SET NULL;


--
-- Name: dataset_log_dataset_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_log
    ADD CONSTRAINT dataset_log_dataset_id_fkey FOREIGN KEY (dataset_id) REFERENCES dataset(id) ON DELETE CASCADE;


--
-- Name: dataset_project_dataset_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_project
    ADD CONSTRAINT dataset_project_dataset_id_fkey FOREIGN KEY (dataset_id) REFERENCES dataset(id) ON DELETE CASCADE;


--
-- Name: dataset_project_project_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_project
    ADD CONSTRAINT dataset_project_project_id_fkey FOREIGN KEY (project_id) REFERENCES project(id) ON DELETE CASCADE;


--
-- Name: dataset_publisher_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset
    ADD CONSTRAINT dataset_publisher_id_fkey FOREIGN KEY (publisher_id) REFERENCES publisher(id) ON DELETE SET NULL;


--
-- Name: dataset_sample_dataset_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_sample
    ADD CONSTRAINT dataset_sample_dataset_id_fkey FOREIGN KEY (dataset_id) REFERENCES dataset(id) ON DELETE CASCADE;


--
-- Name: dataset_sample_sample_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_sample
    ADD CONSTRAINT dataset_sample_sample_id_fkey FOREIGN KEY (sample_id) REFERENCES sample(id) ON DELETE CASCADE;


--
-- Name: dataset_submitter_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset
    ADD CONSTRAINT dataset_submitter_id_fkey FOREIGN KEY (submitter_id) REFERENCES gigadb_user(id) ON DELETE RESTRICT;


--
-- Name: dataset_type_dataset_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_type
    ADD CONSTRAINT dataset_type_dataset_id_fkey FOREIGN KEY (dataset_id) REFERENCES dataset(id) ON DELETE CASCADE;


--
-- Name: dataset_type_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY dataset_type
    ADD CONSTRAINT dataset_type_type_id_fkey FOREIGN KEY (type_id) REFERENCES type(id) ON DELETE CASCADE;


--
-- Name: exp_attributes_attribute_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY exp_attributes
    ADD CONSTRAINT exp_attributes_attribute_id_fkey FOREIGN KEY (attribute_id) REFERENCES attribute(id);


--
-- Name: exp_attributes_exp_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY exp_attributes
    ADD CONSTRAINT exp_attributes_exp_id_fkey FOREIGN KEY (exp_id) REFERENCES experiment(id);


--
-- Name: exp_attributes_units_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY exp_attributes
    ADD CONSTRAINT exp_attributes_units_id_fkey FOREIGN KEY (units_id) REFERENCES unit(id);


--
-- Name: experiment_dataset_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY experiment
    ADD CONSTRAINT experiment_dataset_id_fkey FOREIGN KEY (dataset_id) REFERENCES dataset(id);


--
-- Name: external_link_dataset_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY external_link
    ADD CONSTRAINT external_link_dataset_id_fkey FOREIGN KEY (dataset_id) REFERENCES dataset(id) ON DELETE CASCADE;


--
-- Name: external_link_external_link_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY external_link
    ADD CONSTRAINT external_link_external_link_type_id_fkey FOREIGN KEY (external_link_type_id) REFERENCES external_link_type(id) ON DELETE CASCADE;


--
-- Name: file_attributes_attribute_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file_attributes
    ADD CONSTRAINT file_attributes_attribute_id_fkey FOREIGN KEY (attribute_id) REFERENCES attribute(id);


--
-- Name: file_attributes_file_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file_attributes
    ADD CONSTRAINT file_attributes_file_id_fkey FOREIGN KEY (file_id) REFERENCES file(id) ON DELETE CASCADE;


--
-- Name: file_attributes_unit_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file_attributes
    ADD CONSTRAINT file_attributes_unit_id_fkey FOREIGN KEY (unit_id) REFERENCES unit(id);


--
-- Name: file_dataset_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file
    ADD CONSTRAINT file_dataset_id_fkey FOREIGN KEY (dataset_id) REFERENCES dataset(id) ON DELETE CASCADE;


--
-- Name: file_experiment_experiment_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file_experiment
    ADD CONSTRAINT file_experiment_experiment_id_fkey FOREIGN KEY (experiment_id) REFERENCES experiment(id);


--
-- Name: file_experiment_file_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file_experiment
    ADD CONSTRAINT file_experiment_file_id_fkey FOREIGN KEY (file_id) REFERENCES file(id);


--
-- Name: file_format_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file
    ADD CONSTRAINT file_format_id_fkey FOREIGN KEY (format_id) REFERENCES file_format(id) ON DELETE CASCADE;


--
-- Name: file_relationship_file_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file_relationship
    ADD CONSTRAINT file_relationship_file_id_fkey FOREIGN KEY (file_id) REFERENCES file(id);


--
-- Name: file_relationship_relationship_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file_relationship
    ADD CONSTRAINT file_relationship_relationship_id_fkey FOREIGN KEY (relationship_id) REFERENCES relationship(id);


--
-- Name: file_sample_file_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file_sample
    ADD CONSTRAINT file_sample_file_id_fkey FOREIGN KEY (file_id) REFERENCES file(id);


--
-- Name: file_sample_sample_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file_sample
    ADD CONSTRAINT file_sample_sample_id_fkey FOREIGN KEY (sample_id) REFERENCES sample(id);


--
-- Name: file_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY file
    ADD CONSTRAINT file_type_id_fkey FOREIGN KEY (type_id) REFERENCES file_type(id) ON DELETE CASCADE;


--
-- Name: link_dataset_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY link
    ADD CONSTRAINT link_dataset_id_fkey FOREIGN KEY (dataset_id) REFERENCES dataset(id) ON DELETE CASCADE;


--
-- Name: manuscript_dataset_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY manuscript
    ADD CONSTRAINT manuscript_dataset_id_fkey FOREIGN KEY (dataset_id) REFERENCES dataset(id) ON DELETE CASCADE;


--
-- Name: relation_dataset_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY relation
    ADD CONSTRAINT relation_dataset_id_fkey FOREIGN KEY (dataset_id) REFERENCES dataset(id) ON DELETE CASCADE;


--
-- Name: relation_relationship_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY relation
    ADD CONSTRAINT relation_relationship_fkey FOREIGN KEY (relationship_id) REFERENCES relationship(id);


--
-- Name: sample_attribute_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY sample_attribute
    ADD CONSTRAINT sample_attribute_fkey FOREIGN KEY (attribute_id) REFERENCES attribute(id);


--
-- Name: sample_attribute_sample_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY sample_attribute
    ADD CONSTRAINT sample_attribute_sample_id_fkey FOREIGN KEY (sample_id) REFERENCES sample(id) ON DELETE CASCADE;


--
-- Name: sample_attribute_unit_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY sample_attribute
    ADD CONSTRAINT sample_attribute_unit_id_fkey FOREIGN KEY (unit_id) REFERENCES unit(id);


--
-- Name: sample_experiment_experiment_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY sample_experiment
    ADD CONSTRAINT sample_experiment_experiment_id_fkey FOREIGN KEY (experiment_id) REFERENCES experiment(id);


--
-- Name: sample_experiment_sample_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY sample_experiment
    ADD CONSTRAINT sample_experiment_sample_id_fkey FOREIGN KEY (sample_id) REFERENCES sample(id);


--
-- Name: sample_rel_relationship_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY sample_rel
    ADD CONSTRAINT sample_rel_relationship_id_fkey FOREIGN KEY (relationship_id) REFERENCES relationship(id);


--
-- Name: sample_rel_sample_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY sample_rel
    ADD CONSTRAINT sample_rel_sample_id_fkey FOREIGN KEY (sample_id) REFERENCES sample(id);


--
-- Name: sample_species_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY sample
    ADD CONSTRAINT sample_species_id_fkey FOREIGN KEY (species_id) REFERENCES species(id) ON DELETE CASCADE;


--
-- Name: sample_submitted_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY sample
    ADD CONSTRAINT sample_submitted_id_fkey FOREIGN KEY (submitted_id) REFERENCES gigadb_user(id);


--
-- Name: search_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY search
    ADD CONSTRAINT search_user_id_fkey FOREIGN KEY (user_id) REFERENCES gigadb_user(id) ON DELETE RESTRICT;


--
-- Name: template_attribute_attribute_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY template_attribute
    ADD CONSTRAINT template_attribute_attribute_id_fkey FOREIGN KEY (attribute_id) REFERENCES attribute(id) ON DELETE CASCADE;


--
-- Name: template_attribute_sample_template_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gigadb
--

ALTER TABLE ONLY template_attribute
    ADD CONSTRAINT template_attribute_sample_template_id_fkey FOREIGN KEY (template_name_id) REFERENCES template_name(id) ON DELETE CASCADE;


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: gigadb
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM gigadb;
GRANT ALL ON SCHEMA public TO gigadb;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

