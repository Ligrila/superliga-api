ALTER TABLE "public"."answers" ADD COLUMN "response_seconds" decimal NOT NULL DEFAULT '10.00';

DROP TABLE IF EXISTS updated_indexes;
CREATE TABLE updated_indexes (
   table_name text PRIMARY KEY
 , ts timestamp without time zone NOT NULL DEFAULT '-infinity'
); -- possibly more details

DROP MATERIALIZED VIEW IF EXISTS correct_answers CASCADE;

DROP TABLE IF EXISTS correct_answers;
CREATE TABLE correct_answers (
    id uuid PRIMARY KEY,
    user_id uuid NOT NULL,
    question_id uuid NOT NULL,
    trivia_id uuid NOT NULL,
    points integer NOT NULL,
    selected_option options,
    lives integer NOT NULL DEFAULT 1,
    created timestamp without time zone NOT NULL,
    response_seconds numeric NOT NULL DEFAULT 10.00
);

-- Indices -------------------------------------------------------
CREATE UNIQUE INDEX correct_answers_index ON correct_answers(user_id uuid_ops,question_id uuid_ops);

DROP INDEX IF EXISTS correct_answers_latest_updated_index;
CREATE INDEX correct_answers_latest_updated_index ON answers (id, user_id, question_id, selected_option, lives, created, response_seconds) WHERE  created >= '-infinity';

-- init table --
INSERT INTO correct_answers
            SELECT answers.id as id, answers.user_id as user_id, answers.question_id as question_id, questions.trivia_id as trivia_id, questions.points as points, answers.selected_option as selected_option, answers.lives as lives, answers.created as created, answers.response_seconds as response_seconds
            FROM answers
            INNER JOIN questions ON questions.id = answers.question_id AND answers.selected_option = questions.correct_option
            WHERE questions.finished = true AND questions.canceled = false
            AND answers.created >= '-infinity'
            ON CONFLICT ON CONSTRAINT correct_answers_pkey
            DO NOTHING;


DROP MATERIALIZED VIEW IF EXISTS wrong_answers CASCADE;

DROP TABLE IF EXISTS wrong_answers;
CREATE TABLE wrong_answers (
    id uuid PRIMARY KEY,
    user_id uuid NOT NULL,
    question_id uuid NOT NULL,
    trivia_id uuid NOT NULL,
    points integer NOT NULL,
    selected_option options,
    lives integer NOT NULL DEFAULT 1,
    created timestamp without time zone NOT NULL,
    response_seconds numeric NOT NULL DEFAULT 10.00
);

CREATE UNIQUE INDEX wrong_answers_index ON correct_answers(user_id uuid_ops,question_id uuid_ops);

DROP INDEX IF EXISTS wrong_answers_latest_updated_index;
CREATE INDEX wrong_answers_latest_updated_index ON answers (id, user_id, question_id, selected_option, lives, created, response_seconds) WHERE  created >= '-infinity';

-- init table --
INSERT INTO wrong_answers
            SELECT answers.id as id, answers.user_id as user_id, answers.question_id as question_id, questions.trivia_id as trivia_id, questions.points as points, answers.selected_option as selected_option, answers.lives as lives, answers.created as created, answers.response_seconds as response_seconds
            FROM answers
            INNER JOIN questions ON questions.id = answers.question_id AND answers.selected_option != questions.correct_option
            WHERE questions.finished = true AND questions.canceled = false
            AND answers.created >= '-infinity'
            ON CONFLICT ON CONSTRAINT wrong_answers_pkey
            DO NOTHING;

-- TRIVIAS enabled field --
ALTER TABLE trivias ALTER COLUMN enabled DROP DEFAULT;
ALTER TABLE trivias ALTER enabled TYPE boolean using enabled::boolean;
ALTER TABLE trivias ALTER COLUMN enabled SET DEFAULT TRUE;


