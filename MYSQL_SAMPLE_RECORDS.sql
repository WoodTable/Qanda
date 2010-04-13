-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 09, 2010 at 02:38 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `qanda`
--

--
-- Dumping data for table `qa_activities`
--

INSERT INTO `qa_activities` (`id`, `user_id`, `action_key`, `object_type`, `object_id`, `blurb`, `date_created`, `created_by`, `date_modified`, `modified_by`, `is_deleted`) VALUES
(1, 1, 'view', 'post', 1, 'User 1 viewed post 1, a question', '2010-02-27 11:45:00', 'TL', '0000-00-00 00:00:00', '', 0),
(2, 2, 'view', 'post', 6, 'user 2 view post 6', '2010-02-28 12:54:17', 'activity::track', '0000-00-00 00:00:00', '', 0),
(3, 2, 'view', 'post', 4, 'user 2 view post 4', '2010-02-28 12:54:24', 'activity::track', '0000-00-00 00:00:00', '', 0),
(4, 2, 'create', 'post', 7, 'user 2 create post 7', '2010-02-28 12:55:40', 'activity::track', '0000-00-00 00:00:00', '', 0),
(5, 2, 'view', 'post', 1, 'user 2 view post 1', '2010-02-28 12:56:00', 'activity::track', '0000-00-00 00:00:00', '', 0),
(6, 2, 'view', 'post', 3, 'user 2 view post 3', '2010-02-28 12:56:13', 'activity::track', '0000-00-00 00:00:00', '', 0),
(7, 2, 'create', 'post', 8, 'user 2 create post 8', '2010-02-28 12:57:03', 'activity::track', '0000-00-00 00:00:00', '', 0),
(8, 3, 'create', 'post', 9, 'user 3 create post 9', '2010-02-28 12:58:10', 'activity::track', '0000-00-00 00:00:00', '', 0),
(9, 4, 'create', 'post', 10, 'user 4 create post 10', '2010-02-28 12:59:19', 'activity::track', '0000-00-00 00:00:00', '', 0),
(10, 6, 'view', 'post', 11, 'user 6 view post 11', '2010-03-21 06:06:08', 'activity::log', '0000-00-00 00:00:00', '', 0),
(11, 6, 'create', 'post', 12, 'user 6 create post 12', '2010-03-21 06:06:19', 'activity::log', '0000-00-00 00:00:00', '', 0),
(12, 7, 'create', 'post', 13, 'user 7 create post 13', '2010-04-01 11:15:13', 'activity::log', '0000-00-00 00:00:00', '', 0);

--
-- Dumping data for table `qa_posts`
--

INSERT INTO `qa_posts` (`id`, `user_id`, `title`, `slug`, `content`, `status`, `parent_id`, `type`, `mode`, `up_vote_count`, `down_vote_count`, `view_count`, `answer_count`, `comment_count`, `bookmark_count`, `last_activity_date`, `date_created`, `created_by`, `date_modified`, `modified_by`, `is_deleted`) VALUES
(1, 1, 'what made question a question?', 'what-made-question-a-question', 'How do you define a question? is it simply by ending a sentence wtih a question mark?', 'publish', 0, 'question', 'normal', 0, 0, 2, 0, 0, 0, '2010-02-27 11:44:00', '2010-02-27 11:44:00', 'TL', '0000-00-00 00:00:00', '', 0),
(2, 1, 'Can u walk about barefoot without thinking about it in public?', 'can-u-walk-about-barefoot-without-thinking-about-it-in-public', 'hi!\r\n\r\ncan u walk about barefoot without thinking about it in public?\r\n\r\nQuestion from: http://au.answers.yahoo.com/question/index?qid=20100227041448AAAfi41', 'publish', 0, 'question', 'normal', 0, 0, 0, 0, 0, 0, '2010-02-27 12:25:17', '2010-02-27 12:25:17', 'post::add_question', '0000-00-00 00:00:00', '', 0),
(3, 1, 'how do you make a video game for free?', 'how-do-you-make-a-video-game-for-free', 'i really want to make a war game after playing cod 5 waw (call of duty 5 world at war) can anyone help me out\n\nQuestion from: http://au.answers.yahoo.com/question/index?qid=20100227041438AAyX2H8', 'publish', 0, 'question', 'normal', 0, 0, 3, 1, 0, 0, '2010-02-28 12:57:03', '2010-02-27 12:26:59', 'post::add_question', '2010-02-28 12:57:03', 'post::create_answer', 0),
(4, 1, 'Can anyone think of some chinese words which english has borrowed?', 'can-anyone-think-of-some-chinese-words-which-english-has-borrowed', 'As in title...\n\n\nhttp://au.answers.yahoo.com/question/index?qid=20100226195006AAv48eY', 'publish', 0, 'question', 'normal', 0, 0, 4, 2, 0, 0, '2010-02-28 12:58:10', '2010-02-27 12:28:07', 'post::add_question', '2010-02-28 12:58:10', 'post::create_answer', 0),
(5, 2, 'On Valentine''s day, can your date count as your gift?', 'on-valentines-day-can-your-date-count-as-your-gift', 'Many guys and gals end up spending loads of extra cash on flowers, dinner, and clothing and more to make their Valentine''s Day extra special.\n\nSo we want to know-- can this count as your gift? Why or why not?\n\nQuestion from: http://au.answers.yahoo.com/question/index?qid=20100212152656AAttLHu', 'publish', 0, 'question', 'normal', 0, 0, 5, 1, 0, 0, '2010-02-28 12:59:19', '2010-02-27 14:43:57', 'post::create_question', '2010-02-28 12:59:19', 'post::create_answer', 0),
(6, 2, 'What is your understanding of imagination?', 'what-is-your-understanding-of-imagination', 'Imagination can take you places where the physical can not travel.\nBut what exactly is imagination?\nHow does it work & from where does it arrive?\nWhy do some have an abundance while others rarely miss it?\nPlease share your understanding with me & please elaborate.\n\nQuestion from: http://au.answers.yahoo.com/question/index?qid=20100221025559AADPcRL', 'publish', 0, 'question', 'normal', 0, 0, 2, 0, 0, 0, '2010-02-27 14:46:58', '2010-02-27 14:46:58', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(7, 2, '', '', 'Gung-ho\nTyphoon\nKung fu\nWok\nFeng shui\n\nhere is a list at: http://en.wikipedia.org/wiki/List_of_English_words_of_Chinese_origin', 'publish', 4, 'answer', 'normal', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '2010-02-28 12:55:40', 'question::detail', '0000-00-00 00:00:00', '', 0),
(8, 2, '', '', 'Start by studying programming, game design and game algorithm.. you need a lot of creativity and imagination and also think that how will the game be to the one who plays it and thinks it..', 'publish', 3, 'answer', 'normal', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '2010-02-28 12:57:03', 'question::detail', '0000-00-00 00:00:00', '', 0),
(9, 3, '', '', 'what about ketchup?', 'publish', 4, 'answer', 'normal', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '2010-02-28 12:58:10', 'question::detail', '0000-00-00 00:00:00', '', 0),
(10, 4, '', '', 'If by "date" you mean the specific outing, then yes, if it is sufficiently special and romantic. Dinner at a great restaurant or a homemade picnic in a romantic location could work. Dinner at your usual place, or ordering pizza, is not special (unless, of course, you do not often get to see one another). \n\nIf by "date" you mean the specific person, then probably not. I''d be pretty put out if a guy thought he was doing me a favor simply by going out with me. Ew. \n\nNow, the "why": if it is a special occasion, like a birthday, anniversary, or V-Day, a certain amount of effort to commemorate the occasion is expected. You go out of your way to make it special. For some people, that might mean getting time off of work so you can actually be together. For others (like deployed soldiers), that might mean getting in a phone call. If you see each other regularly and go out to dinner normally, you should step it up a notch. \n\nIf you''re on a budget, focus on doing something special and romantic. Making a meal from scratch is very sweet. Even a single rose, or a bouquet of pretty flowers is nice. Basically, show them that you care and that your date is worth the effort.\n\nOriginate from: http://au.answers.yahoo.com/question/index?qid=20100212152656AAttLHu', 'publish', 5, 'answer', 'normal', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '2010-02-28 12:59:19', 'question::detail', '0000-00-00 00:00:00', '', 0),
(11, 5, 'Is the plastic, HIPS, recyclable?', 'is-the-plastic-hips-recyclable', 'High Impact Polystyrene (HIPS)\n\nOriginate from: http://au.answers.yahoo.com/question/index?qid=20100228040754AAv7AgT', 'publish', 0, 'question', 'normal', 0, 0, 6, 1, 0, 0, '2010-03-21 06:06:19', '2010-02-28 13:01:07', 'post::create_question', '2010-03-21 06:06:19', 'post::create_answer', 0),
(12, 6, '', '', 'Yes it is.', 'publish', 11, 'answer', 'normal', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '2010-03-21 06:06:19', 'question::detail', '0000-00-00 00:00:00', '', 0),
(13, 7, '', '', 'High Impact Polystyrene isn''t really plastic tho...', 'publish', 11, 'comment', 'normal', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '2010-04-01 11:15:13', 'post::create_comment', '0000-00-00 00:00:00', '', 0);

--
-- Dumping data for table `qa_posts_tags`
--

INSERT INTO `qa_posts_tags` (`post_id`, `tag_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 4),
(3, 5),
(4, 1),
(4, 6),
(4, 7),
(4, 8),
(5, 1),
(5, 9),
(5, 10),
(6, 1),
(6, 11),
(6, 12),
(11, 13),
(11, 14),
(11, 15);

--
-- Dumping data for table `qa_post_metas`
--


--
-- Dumping data for table `qa_reputations`
--


--
-- Dumping data for table `qa_roles`
--

INSERT INTO `qa_roles` (`id`, `name`, `description`) VALUES
(1, 'login', 'Login privileges, granted after account confirmation.'),
(2, 'guest', 'Guest User who don''t have a login account.'),
(3, 'mod', 'Moderator, has higher privileges to normal user but not the access to everything.'),
(4, 'admin', 'Administrative user, has access to everything.'),
(5, 'super', 'Super Administrative user.');

--
-- Dumping data for table `qa_roles_users`
--

INSERT INTO `qa_roles_users` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 2),
(6, 1),
(7, 2);

--
-- Dumping data for table `qa_settings`
--

INSERT INTO `qa_settings` (`id`, `name`, `value`, `autoload`, `date_created`, `created_by`, `date_modified`, `modified_by`, `is_deleted`) VALUES
(1, 'site_name', 'Qanda Q&amp;A', 1, '2010-02-27 11:50:00', 'TL', '0000-00-00 00:00:00', '', 0),
(2, 'users_can_register', '1', 1, '2010-04-01 21:48:00', 'TL', '0000-00-00 00:00:00', '', 0),
(3, 'site_description', 'Open Source Q&A Platform in PHP5', 1, '2010-04-01 21:48:00', 'TL', '0000-00-00 00:00:00', '', 0),
(4, 'admin_email', 'lorem@ipsum.com', 1, '2010-04-01 21:48:00', 'TL', '0000-00-00 00:00:00', '', 0),
(5, 'current_theme', 'default', 1, '2010-04-01 21:48:00', 'TL', '0000-00-00 00:00:00', '', 0),
(6, 'guests_can_question', '1', 1, '2010-04-01 21:48:00', 'TL', '0000-00-00 00:00:00', '', 0),
(7, 'guests_can_answer', '1', 1, '2010-04-01 21:48:00', 'TL', '0000-00-00 00:00:00', '', 0),
(8, 'guests_can_comment', '0', 1, '2010-04-01 21:48:00', 'TL', '0000-00-00 00:00:00', '', 0),
(9, 'date_format', 'd/m/Y', 1, '2010-04-01 21:48:00', 'TL', '0000-00-00 00:00:00', '', 0),
(10, 'time_format', 'g:i a', 1, '2010-04-01 21:48:00', 'TL', '0000-00-00 00:00:00', '', 0),
(11, 'language', 'en', 1, '2010-04-01 21:48:00', 'TL', '0000-00-00 00:00:00', '', 0),
(12, 'database_version', '10', 1, '2010-04-01 21:48:00', 'TL', '0000-00-00 00:00:00', '', 0),
(13, 'show_avatars', '1', 1, '2010-04-01 21:48:00', 'TL', '0000-00-00 00:00:00', '', 0),
(14, 'avatar_rating', 'G', 1, '2010-04-01 21:48:00', 'TL', '0000-00-00 00:00:00', '', 0),
(15, 'timezone_name', 'Australia/Sydney', 1, '2010-04-01 21:48:00', 'TL', '0000-00-00 00:00:00', '', 0);

--
-- Dumping data for table `qa_tags`
--

INSERT INTO `qa_tags` (`id`, `name`, `slug`, `post_count`, `date_created`, `created_by`, `date_modified`, `modified_by`, `is_deleted`) VALUES
(1, 'Sample Question', 'sample-question', 6, '2010-02-27 11:49:00', 'TL', '2010-02-27 14:46:58', 'post::create_question', 0),
(2, 'barefoot', 'barefoot', 1, '2010-02-27 12:25:17', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(3, 'public appearance', 'public-appearance', 1, '2010-02-27 12:25:17', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(4, 'video game', 'video-game', 1, '2010-02-27 12:26:59', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(5, 'open-source', 'open-source', 1, '2010-02-27 12:26:59', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(6, 'Chinese', 'chinese', 1, '2010-02-27 12:28:07', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(7, 'English', 'english', 1, '2010-02-27 12:28:07', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(8, 'words', 'words', 1, '2010-02-27 12:28:07', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(9, 'valentine''s day', 'valentines-day', 1, '2010-02-27 14:43:57', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(10, 'gift', 'gift', 1, '2010-02-27 14:43:57', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(11, 'imagination', 'imagination', 1, '2010-02-27 14:46:58', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(12, 'creativity', 'creativity', 1, '2010-02-27 14:46:58', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(13, 'plastic', 'plastic', 1, '2010-02-28 13:01:07', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(14, 'recycle', 'recycle', 1, '2010-02-28 13:01:07', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(15, 'HIPS', 'hips', 1, '2010-02-28 13:01:07', 'post::create_question', '0000-00-00 00:00:00', '', 0);

--
-- Dumping data for table `qa_tags_users`
--

INSERT INTO `qa_tags_users` (`id`, `user_id`, `tag_id`, `relation_type`, `post_count`, `date_created`, `created_by`, `date_modified`, `modified_by`, `is_deleted`) VALUES
(1, 1, 1, 'involved', 4, '2010-02-27 11:49:00', 'TL', '2010-02-27 12:28:07', 'post::create_question', 0),
(2, 1, 2, 'involved', 1, '2010-02-27 12:25:17', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(3, 1, 3, 'involved', 1, '2010-02-27 12:25:17', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(4, 1, 4, 'involved', 1, '2010-02-27 12:26:59', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(5, 1, 5, 'involved', 1, '2010-02-27 12:26:59', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(6, 1, 6, 'involved', 1, '2010-02-27 12:28:07', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(7, 1, 7, 'involved', 1, '2010-02-27 12:28:07', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(8, 1, 8, 'involved', 1, '2010-02-27 12:28:07', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(9, 2, 1, 'involved', 4, '2010-02-27 14:43:57', 'post::create_question', '2010-02-28 12:57:03', 'tag::set_user_involvement', 0),
(10, 2, 9, 'involved', 1, '2010-02-27 14:43:57', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(11, 2, 10, 'involved', 1, '2010-02-27 14:43:57', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(12, 2, 11, 'involved', 1, '2010-02-27 14:46:58', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(13, 2, 12, 'involved', 1, '2010-02-27 14:46:58', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(14, 2, 6, 'involved', 1, '2010-02-28 12:55:40', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0),
(15, 2, 7, 'involved', 1, '2010-02-28 12:55:40', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0),
(16, 2, 8, 'involved', 1, '2010-02-28 12:55:40', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0),
(17, 2, 4, 'involved', 1, '2010-02-28 12:57:03', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0),
(18, 2, 5, 'involved', 1, '2010-02-28 12:57:03', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0),
(19, 3, 1, 'involved', 1, '2010-02-28 12:58:10', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0),
(20, 3, 6, 'involved', 1, '2010-02-28 12:58:10', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0),
(21, 3, 7, 'involved', 1, '2010-02-28 12:58:10', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0),
(22, 3, 8, 'involved', 1, '2010-02-28 12:58:10', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0),
(23, 4, 1, 'involved', 1, '2010-02-28 12:59:19', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0),
(24, 4, 9, 'involved', 1, '2010-02-28 12:59:19', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0),
(25, 4, 10, 'involved', 1, '2010-02-28 12:59:19', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0),
(26, 5, 13, 'involved', 1, '2010-02-28 13:01:07', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0),
(27, 5, 14, 'involved', 1, '2010-02-28 13:01:07', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0),
(28, 5, 15, 'involved', 1, '2010-02-28 13:01:07', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0),
(29, 6, 13, 'involved', 1, '2010-03-21 06:06:19', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0),
(30, 6, 14, 'involved', 1, '2010-03-21 06:06:19', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0),
(31, 6, 15, 'involved', 1, '2010-03-21 06:06:19', 'tag::set_user_involvement', '0000-00-00 00:00:00', '', 0);

--
-- Dumping data for table `qa_users`
--

INSERT INTO `qa_users` (`id`, `email`, `username`, `password`, `logins`, `last_login`, `website`, `display_name`, `location`, `birthday`, `description`, `activation_key`, `last_activity_date`, `last_ip_address`, `last_user_agent`, `reputation_score`, `question_count`, `answer_count`, `up_vote_casted`, `down_vote_casted`, `badge_count`, `post_bookmarked`, `profile_view_count`, `date_created`, `created_by`, `date_modified`, `modified_by`, `is_deleted`) VALUES
(1, 'lorem@test.com', 'alpha', 'a99614ecf1f2eccbb60f986095e9be2bc9659390480534aba9', 1, 1264421571, 'http://lorem-ipsum.com/', 'Alpha Ipsum', 'France', '1988-12-01', 'Lorem ipsum dolor sit.', 'dummy-activation-key', '2010-02-27 11:38:00', '127.0.0.1', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/532.0 (KHTML, like Gecko) Chrome/4.0.202.0 Safari/532.0', 0, 4, 0, 0, 0, 0, 0, 0, '2010-02-27 11:40:00', 'TL', '0000-00-00 00:00:00', '', 0),
(2, 'benson@test.com', 'benson', '174629a11fb64cfd8c822e7283a1c9af5288687b2097fa1cb9', 2, 1267361657, '', 'Benson Harper', '', '0000-00-00', '', 'sg9mb9bulhnnvmnd7ldskpvt94mtedya', '2010-02-27 14:42:33', '127.0.0.1', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.9.1.8) Gecko/20100202 Firefox/3.5.8 GTB6', 0, 2, 2, 0, 0, 0, 0, 0, '2010-02-27 14:42:33', 'user::create_user', '2010-02-27 14:46:58', 'post::create_question', 0),
(3, 'bobby@test.com', 'bobby-rc2k', 'b4506b8a7fb96158964afd280d881243622960528c720c2778', 0, 0, '', 'Bobby Lu', '', '0000-00-00', '', '', '0000-00-00 00:00:00', '', '', 0, 0, 1, 0, 0, 0, 0, 0, '2010-02-28 12:58:10', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(4, 'julia@test.com', 'julia-jjm2', 'a63746aacd2a5c1d93b846c66e974e1c4a4fd37da1615eff20', 0, 0, '', 'Julia Junior', '', '0000-00-00', '', '', '0000-00-00 00:00:00', '', '', 0, 0, 1, 0, 0, 0, 0, 0, '2010-02-28 12:59:19', 'post::create_question', '0000-00-00 00:00:00', '', 0),
(5, 'chris@test.com', 'chris-b-rox2', '601670efbe9ba664c802c7d9173ddac9e1bf667be88b2eb798', 0, 0, '', 'Chris B.', '', '0000-00-00', '', '', '0000-00-00 00:00:00', '', '', 0, 1, 0, 0, 0, 0, 0, 0, '2010-02-28 13:01:07', 'post::create_question', '2010-02-28 13:01:07', 'post::create_question', 0),
(6, 'charlie@test.com', 'charlie', '233d41ed4cc32deda2f71dcdd6cfa941ea5a5b12b84c799ae9', 1, 1269151549, '', 'Charlie Brown', '', '0000-00-00', '', 'efpwdvoa7pjk1uvov1torhmubrixqmlp', '2010-03-21 06:05:49', '127.0.0.1', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.9.2) Gecko/20100115 Firefox/3.6 GTB6', 0, 0, 1, 0, 0, 0, 0, 0, '2010-03-21 06:05:49', 'user::create_user', '0000-00-00 00:00:00', '', 0),
(7, 'jimmy@guest.com', 'jimmy-guest-m2bj', '75ae646fa472c27e5656dd2daf35c7186b231b8005756a4d54', 0, 0, '', 'Jimmy Guest', '', '0000-00-00', '', '', '0000-00-00 00:00:00', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '2010-04-01 11:15:13', 'post::create_question', '0000-00-00 00:00:00', '', 0);

--
-- Dumping data for table `qa_user_metas`
--

