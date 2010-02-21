--
-- Dumping data for table `qa_users`
--

INSERT INTO `qa_users` VALUES
(1, 'alpha@test.com', 'alpha', 'a99614ecf1f2eccbb60f986095e9be2bc9659390480534aba9', 1, 1264421571, 'http://alpha-test.com/', 'Alpha Romeo', 'France', '1968-12-01', 'I enjoy collecting alpha romeos... especially when they are still in alpha.', 'dummy-activation-key', '2010-01-27 22:15:00', '127.0.0.1', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/532.0 (KHTML, like Gecko) Chrome/4.0.202.0 Safari/532.0', '10', '2', '1', '1', '0', '6', '1', '2', '1', '3', '3', '0', '2010-01-25 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (2, 'beta@test.com', 'beta', '0d234b53b544a170bd7b0e7f46882e6eefdf9e145d9b0ebd1c', 1, 1264421591, 'http://i.am.beta/', 'Beta Better', '', '1988-12-11', 'Beta is always better than alpha.', 'dummy-activation-key', '2010-01-27 22:15:00', '127.0.0.1', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/532.0 (KHTML, like Gecko) Chrome/4.0.202.0 Safari/532.0', '1', '1', '0', '1', '0', '6', '1', '2', '1', '3', '3', '0', '2010-01-25 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (3, 'charlie@test.com', 'charlie', '2fccd9dad9f160d8b0ffd0b0c33005c3ac29820b4207948c9f', 1, 1264421608, '', '', '', '0000-00-00', '', 'dummy-activation-key', '2010-01-27 22:15:00', '127.0.0.1', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/532.0 (KHTML, like Gecko) Chrome/4.0.202.0 Safari/532.0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2010-01-25 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
;



--
-- Dumping data for table `qa_roles`
--

INSERT INTO `qa_roles` VALUES
(1, 'login', 'Login privileges, granted after account confirmation.')
, (2, 'guest', 'Guest User who don''t have a login account.')
, (3, 'mod', 'Moderator, has higher privileges to normal user but not the access to everything.')
, (4, 'admin', 'Administrative user, has access to everything.')
, (5, 'super', 'Super Administrative user.')
;



--
-- Dumping data for table `qa_roles_users`
--
INSERT INTO `qa_roles_users` VALUES
(1, 1)
, (2, 1)
, (3, 1)
;



--
-- Dumping data for table `qa_posts`
--

INSERT INTO `qa_posts` VALUES
-- Questions
(1, 1, 'what made question a question?', 'what-made-question-a-question', 'Seriously? how do you define a question? or is anything that ends with question mark is question??', 'publish', '0', 'question', 'normal', '1', '0', '3', '1', '0', '1', '2010-01-27 18:55:00',  '2010-01-22 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (2, 1, 'how do you define an answer?', 'how-do-you-define-an-answer', 'Things that is correct? if so, what is "correct"?', 'publish', '0', 'question', 'normal', '2', '1', '5', '1', '0', '1', '2010-01-27 18:55:00',  '2010-01-22 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (3, 3, 'how do you draw a circle??', 'how-do-you-draw-a-circle', '', 'publish', '0', 'question', 'normal', '2', '1', '5', '1', '0', '1', '2010-01-27 18:55:00',  '2010-01-22 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)

-- Answers
, (21, 2, '', '', 'Anything that prompts a argument response is count as a question.', 'publish', '1', 'answer', 'normal', '1', '0', '0', '0', '0', '0', '2010-01-27 19:55:00',  '2010-01-22 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)

-- Answers
, (41, 1, '', '', 'You may want to include some description on your question', 'publish', '3', 'comment', 'normal', '1', '0', '0', '0', '0', '0', '2010-01-27 19:55:00',  '2010-01-22 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
;



--
-- Dumping data for table `qa_activities`
--

INSERT INTO `qa_activities` VALUES
-- Activities by User 1
(1, 1, 1, 'view', '1', '2010-01-23 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (2, 1, 1, 'vote', '1', '2010-01-23 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (3, 2, 1, 'view', '1', '2010-01-27 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (4, 2, 1, 'vote', '-1', '2010-01-27 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
-- Activities by User 2
, (21, 1, 2, 'view', '1', '2010-01-27 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (22, 1, 2, 'answer', '1', '2010-01-27 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
;



--
-- Dumping data for table `qa_reputation_logs`
--

INSERT INTO `qa_reputation_logs` VALUES
-- Logs for User 1
(1, 1, 1, 1, 'vote', '1', '2010-01-27 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (2, 1, 1, 1, 'vote', '-1', '2010-01-27 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
-- Logs for User 2
, (3, 21, 1, 2, 'vote', '1', '2010-01-27 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
;



--
-- Dumping data for table `qa_bounties`
--

INSERT INTO `qa_bounties` VALUES
-- Activities by User 1
(1, 1, 100, 0, '0000-00-00 00:00:00', 'active', '2010-01-23 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
;



--
-- Dumping data for table `qa_badges`
--

INSERT INTO `qa_badges` VALUES
(1, 'Autobiographer', 'autobiographer', 'Completed all user profile fields', 'general', 1, 0, '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (2, 'Beta', 'beta', 'Actively participated in the website beta', 'general', 1, 0, '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (3, 'Citizen Patrol', 'citizen-patrol', 'First flagged post', 'general', 1, 0, '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (4, 'Civic Duty', 'civic-duty', 'Voted 300 times', 'general', 1, 0, '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (5, 'Cleanup', 'cleanup', 'First rollback', 'general', 1, 0, '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
;



--
-- Dumping data for table `qa_flags`
--

INSERT INTO `qa_flags` VALUES
(1, 41, 1, 'mod-attention', 'Not appropriate.', '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
;



--
-- Dumping data for table `qa_tags`
--

INSERT INTO `qa_tags` VALUES
(1, 'php', 'php', 1, '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (2, 'SEO', 'SEO', 3, '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (3, 'sydney new year', 'sydney-new-year', 1, '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
;



--
-- Dumping data for table `qa_posts_tags`
--
/*
INSERT INTO `qa_posts_tags` VALUES
(1, 1, 1, '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (2, 1, 2, '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (3, 1, 3, '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (4, 2, 1, '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
;
*/
INSERT INTO `qa_posts_tags` VALUES
(1, 1)
, (1, 2)
, (1, 3)
, (2, 1)
;



--
-- Dumping data for table `qa_tags_users`
--

INSERT INTO `qa_tags_users` VALUES
(1, 1, 1, 2, 'involved', '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (2, 1, 2, 0, 'ignored', '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
;



--
-- Dumping data for table `qa_badges_users`
--

INSERT INTO `qa_badges_users` VALUES
(1, 1)
, (1, 3)
, (2, 2)
;



--
-- Dumping data for table `qa_settings`
--

INSERT INTO `qa_settings` VALUES
(1, 'site_name', 'Quacker Q&amp;A', 1, '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (2, 'use_smilies', '0', 1, '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (3, 'user_can_register', '1', 1, '2010-01-24 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (4, 'default_locale', 'en-UK', 1, '2010-01-28 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
, (5, 'default_theme', 'default', 1, '2010-01-28 00:00:00', 'TL', '0000-00-00 00:00:00', '', 0)
;


