TRUNCATE TABLE answers;
TRUNCATE TABLE auth_token;
TRUNCATE TABLE awards;
TRUNCATE TABLE championships;
TRUNCATE TABLE championship_users;
TRUNCATE TABLE dates;
TRUNCATE TABLE generic_questions;
TRUNCATE TABLE infinite_lives;
TRUNCATE TABLE jobs;
TRUNCATE TABLE lives;
TRUNCATE TABLE live_packs;
TRUNCATE TABLE orders;
TRUNCATE TABLE payments;
TRUNCATE TABLE push_notifications;
TRUNCATE TABLE notifications;
TRUNCATE TABLE banners;
TRUNCATE TABLE questions;
TRUNCATE TABLE question_templates;
-- TRUNCATE TABLE superusers;
TRUNCATE TABLE teams;
TRUNCATE TABLE trivias;
TRUNCATE TABLE unfinished_orders;
TRUNCATE TABLE users;

TRUNCATE TABLE challenges;
TRUNCATE TABLE challenge_requests;
TRUNCATE TABLE contacts;

TRUNCATE TABLE correct_answers;
TRUNCATE TABLE wrong_answers;




-- correct/wrong answers indexes
TRUNCATE TABLE updated_indexes;
TRUNCATE TABLE correct_answers;
TRUNCATE TABLE wrong_answers;


DROP INDEX IF EXISTS wrong_answers_latest_updated_index;
CREATE INDEX wrong_answers_latest_updated_index ON answers (id, user_id, question_id, selected_option, lives, created, response_seconds) WHERE  created >= '-infinity';
DROP INDEX IF EXISTS correct_answers_latest_updated_index;
CREATE INDEX correct_answers_latest_updated_index ON answers (id, user_id, question_id, selected_option, lives, created, response_seconds) WHERE  created >= '-infinity';




REFRESH MATERIALIZED VIEW points;
REFRESH MATERIALIZED VIEW rankings;
REFRESH MATERIALIZED VIEW life;
REFRESH MATERIALIZED VIEW played_games;
REFRESH MATERIALIZED VIEW trivia_statistics;
REFRESH MATERIALIZED VIEW trivia_points;
REFRESH MATERIALIZED VIEW trivia_user_statistics;


REFRESH MATERIALIZED VIEW championships_users_points;
REFRESH MATERIALIZED VIEW championships_users_points_sums;
REFRESH MATERIALIZED VIEW championships_points;
REFRESH MATERIALIZED VIEW championships_rankings;
REFRESH MATERIALIZED VIEW championships_users_points_trivias;
REFRESH MATERIALIZED VIEW championships_users_points_trivias_sums;

INSERT INTO superusers (email, role, password, first_name, last_name, enabled, created ) VALUES('alito28@gmail.com','admin','$2y$10$bM9acIZDybWaGWNP6twJOeD/yAbMyWHu9oaKfRGTOeA2tVzi/Qt0O', 'Alex', 'Smith', 1, '2021-06-30 00:00:00');
