-- --------------------------------------------------------

/*
    LOGS:
        
        27/01/2010
            - There will be no meta tables from this date's schema design. Calculated values will be included in their parent tables
            - No GMT timestamp will be stored. All timestamp will be on server's location or user configuration (default: GMT+10).

*/



--
-- Table structure for table `qa_users`
--

CREATE TABLE IF NOT EXISTS `qa_users` (
    `id`                    bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `email`                 varchar(200)        NOT NULL DEFAULT '',
    `username`              varchar(100)        NOT NULL DEFAULT '',
    `password`              varchar(100)        NOT NULL DEFAULT '',
    `logins`                int(11) unsigned    NOT NULL DEFAULT '0',
    `last_login`            int(11) unsigned    NOT NULL DEFAULT '0',
    
    `website`               varchar(100)        NOT NULL DEFAULT '',
    `display_name`          varchar(100)        NOT NULL DEFAULT '',
    `location`              varchar(100)        NOT NULL DEFAULT '',
    `birthday`              date                NOT NULL DEFAULT '0000-00-00',
    `description`           text                NOT NULL,
    
    -- Calculated Values
    `activation_key`        varchar(100)        NOT NULL DEFAULT '',
    `last_active_date`      datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `last_ip_address`       varchar(100)        NOT NULL DEFAULT '',
    `last_user_agent`       varchar(200)        NOT NULL DEFAULT '',
    `reputation_score`      int(11)             NOT NULL DEFAULT '0',
    `question_count`        int(11) unsigned    NOT NULL DEFAULT '0',
    `answer_count`          int(11) unsigned    NOT NULL DEFAULT '0',
    `up_vote_casted`        int(11) unsigned    NOT NULL DEFAULT '0',
    `down_vote_casted`      int(11) unsigned    NOT NULL DEFAULT '0',
    `tag_count`             int(11) unsigned    NOT NULL DEFAULT '0',
    `badge_count`           int(11) unsigned    NOT NULL DEFAULT '0',
    `question_viewed`       int(11) unsigned    NOT NULL DEFAULT '0',
    `post_favorited`        int(11) unsigned    NOT NULL DEFAULT '0',
    `profile_view_count`    int(11) unsigned    NOT NULL DEFAULT '0' COMMENT 'number of times viewed by others',
    `consecutive_visit_day` int(11) unsigned    NOT NULL DEFAULT '0',
    `consecutive_answer_day` int(11) unsigned   NOT NULL DEFAULT '0',
    
    -- Package Foot
    `date_created`          datetime        NOT NULL DEFAULT '0000-00-00 00:00:00',
    `created_by`            varchar(200)    NOT NULL DEFAULT '',
    `date_modified`         datetime        NOT NULL DEFAULT '0000-00-00 00:00:00',
    `modified_by`           varchar(200)    NOT NULL DEFAULT '',
    `is_deleted`            tinyint         NOT NULL DEFAULT '0',
    
    PRIMARY KEY  (`id`),
    KEY `username` (`username`),
    KEY `email` (`email`)
);



-- --------------------------------------------------------

--
-- Table structure for table `qa_roles`
--

CREATE TABLE IF NOT EXISTS `qa_roles` (
    `id`                int(11) unsigned    NOT NULL AUTO_INCREMENT,
    `name`              varchar(32)         NOT NULL,
    `description`       varchar(255)        NOT NULL,
    
    PRIMARY KEY  (`id`),
    UNIQUE KEY `name` (`name`)
);


 
-- --------------------------------------------------------

--
-- Table structure for table `qa_roles_users`
--

CREATE TABLE IF NOT EXISTS `qa_roles_users` (
    `user_id`       bigint(20) unsigned NOT NULL,
    `role_id`       int(11) unsigned    NOT NULL,
    
    PRIMARY KEY  (`user_id`,`role_id`),
    KEY `fk_role_id` (`role_id`)
);



-- --------------------------------------------------------

--
-- Table structure for table `qa_posts`
--

CREATE TABLE IF NOT EXISTS `qa_posts` (
    `id`                    bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `user_id`               bigint(20) unsigned NOT NULL DEFAULT '0',
    `title`                 text                NOT NULL,
    `slug`                  varchar(200)        NOT NULL DEFAULT '',
    `content`               longtext            NOT NULL,
    `status`                varchar(20)         NOT NULL DEFAULT 'publish'  COMMENT 'publish|hidden|bounty(only applicable to questions)|accepted(only applicable to answers)',
    `post_parent_id`        bigint(20) unsigned NOT NULL DEFAULT '0'        COMMENT 'Parent question of an answer, or Parent of a comment',
    `post_type`             varchar(20)         NOT NULL DEFAULT ''         COMMENT 'question|answer|comment|revision',
    `post_mode`             varchar(20)         NOT NULL DEFAULT 'normal'   COMMENT 'normal|wiki|discussion',
    -- Calculated Values
    `up_vote_count`         int(11)             NOT NULL DEFAULT '0',
    `down_vote_count`       int(11)             NOT NULL DEFAULT '0',
    `view_count`            int(11)             NOT NULL DEFAULT '0',
    `answer_count`          int(11)             NOT NULL DEFAULT '0'        COMMENT 'only applicable to questions',
    `comment_count`         int(11)             NOT NULL DEFAULT '0'        COMMENT 'only applicable to questions and answers',
    `favorite_count`        int(11)             NOT NULL DEFAULT '0'        COMMENT 'only applicable to questions',    
    `last_activity_date`    datetime            NOT NULL DEFAULT '0000-00-00 00:00:00'  COMMENT 'Only applicable to questions',
    
    -- Package Foot
    `date_created`          datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `created_by`            varchar(200)        NOT NULL DEFAULT '',
    `date_modified`         datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `modified_by`           varchar(200)        NOT NULL DEFAULT '',
    `is_deleted`            tinyint             NOT NULL DEFAULT '0',
    
    PRIMARY KEY (`id`),
    KEY `slug` (`slug`),
    KEY `type_status_date` (`post_type`,`status`,`date_created`,`id`),
    KEY `post_parent_id` (`post_parent_id`)
);



-- --------------------------------------------------------

--
-- Table structure for table `qa_activities`
--

CREATE TABLE IF NOT EXISTS `qa_activities` (
    `id`                    bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `post_id`               bigint(20) unsigned NOT NULL DEFAULT '0',
    `user_id`               bigint(20) unsigned NOT NULL DEFAULT '0',
    `activity_key`          varchar(20)         NOT NULL DEFAULT '' COMMENT 'view|comment|answer|edit|vote',
    `activity_value`        varchar(100)        NOT NULL DEFAULT '' COMMENT '0|1|-1|revert|edit',
    
    -- Package Foot
    `date_created`          datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `created_by`            varchar(200)        NOT NULL DEFAULT '',
    `date_modified`         datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `modified_by`           varchar(200)        NOT NULL DEFAULT '',
    `is_deleted`            tinyint             NOT NULL DEFAULT '0',
    
    PRIMARY KEY (`id`),
    KEY `post_id` (`post_id`),
    KEY `user_id` (`user_id`),
    KEY `activity_key` (`activity_key`)
);



-- --------------------------------------------------------

--
-- Table structure for table `qa_reputation_logs`
--


CREATE TABLE IF NOT EXISTS `qa_reputation_logs` (
    `id`                    bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `post_id`               bigint(20) unsigned NOT NULL DEFAULT '0',
    `question_id`           bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'can be same reference id as post_id',
    `user_id`               bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'ID of the receiver',
    `reputation_key`        varchar(100)        NOT NULL DEFAULT '' COMMENT 'vote|bounty',
    `reputation_value`      int(11)             NOT NULL DEFAULT '0',
    
    -- Package Foot
    `date_created`          datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `created_by`            varchar(200)        NOT NULL DEFAULT '',
    `date_modified`         datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `modified_by`           varchar(200)        NOT NULL DEFAULT '',
    `is_deleted`            tinyint             NOT NULL DEFAULT '0',
    
    PRIMARY KEY (`id`),
    KEY `post_id` (`post_id`),
    KEY `question_id` (`question_id`),
    KEY `user_id` (`user_id`)
);



-- --------------------------------------------------------

--
-- Table structure for table `qa_bounties`
--

/* Does bounties need finish date? */

CREATE TABLE IF NOT EXISTS `qa_bounties` (
    `id`                        bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `question_id`               bigint(20) unsigned NOT NULL DEFAULT '0',
    `bounty_value`              int(11)             NOT NULL DEFAULT '0'        COMMENT 'Amount of reputation placed on bounty',    
    `bounty_collector_id`       bigint(20) unsigned NOT NULL DEFAULT '0'        COMMENT 'User ID that collected the bounty',
    `bounty_collection_date`    datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `status`                    varchar(20)         NOT NULL DEFAULT 'active'   COMMENT 'active|withdrawed|collected',
    
    -- Package Foot
    `date_created`              datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `created_by`                varchar(200)        NOT NULL DEFAULT '',
    `date_modified`             datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `modified_by`               varchar(200)        NOT NULL DEFAULT '',
    `is_deleted`                tinyint             NOT NULL DEFAULT '0',
    
    PRIMARY KEY (`id`),
    KEY `question_id` (`question_id`)
);



-- --------------------------------------------------------

--
-- Table structure for table `qa_badges`
--

CREATE TABLE IF NOT EXISTS `qa_badges` (
    `id`                        bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name`                      varchar(100)        NOT NULL DEFAULT '',
    `slug`                      varchar(100)        NOT NULL DEFAULT '',
    `description`               text                NOT NULL,    
    `badge_type`                varchar(20)         NOT NULL DEFAULT ''  COMMENT 'general|tag',
    `badge_value`               int(11)             NOT NULL DEFAULT '0' COMMENT '1, 2, 3 representing bronze, silver and gold',
    
    -- Calculated Values (since there's no plan to use badge_metas table
    `user_count`                int(11)             NOT NULL DEFAULT '0' COMMENT 'number of users obtained this badge',

    -- Package Foot
    `date_created`              datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `created_by`                varchar(200)        NOT NULL DEFAULT '',
    `date_modified`             datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `modified_by`               varchar(200)        NOT NULL DEFAULT '',
    `is_deleted`                tinyint             NOT NULL DEFAULT '0',
    
    PRIMARY KEY (`id`),
    KEY `slug` (`slug`)
);



-- --------------------------------------------------------

--
-- Table structure for table `qa_flags`
--

CREATE TABLE IF NOT EXISTS `qa_flags` (
    `id`                        bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `post_id`                   bigint(20) unsigned NOT NULL DEFAULT '0',
    `user_id`                   bigint(20) unsigned NOT NULL DEFAULT '0',    
    `flag_type`                 varchar(20)         NOT NULL DEFAULT ''     COMMENT 'offensive|spam|mod-attention',
    `flag_message`              text                NOT NULL,

    -- Package Foot
    `date_created`              datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `created_by`                varchar(200)        NOT NULL DEFAULT '',
    `date_modified`             datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `modified_by`               varchar(200)        NOT NULL DEFAULT '',
    `is_deleted`                tinyint             NOT NULL DEFAULT '0',
    
    PRIMARY KEY (`id`),
    KEY `post_id` (`post_id`),
    KEY `user_id` (`user_id`)
);



-- --------------------------------------------------------

--
-- Table structure for table `qa_tags`
--

CREATE TABLE IF NOT EXISTS `qa_tags` (
    `id`                        bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name`                      varchar(100)        NOT NULL DEFAULT '',
    `slug`                      varchar(100)        NOT NULL DEFAULT '',
    
    -- Calculated Values
    `post_count`                int(11)             NOT NULL DEFAULT '0' COMMENT 'Number of post that uses this tag',
    
    -- Package Foot
    `date_created`              datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `created_by`                varchar(200)        NOT NULL DEFAULT '',
    `date_modified`             datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `modified_by`               varchar(200)        NOT NULL DEFAULT '',
    `is_deleted`                tinyint             NOT NULL DEFAULT '0',
  
    PRIMARY KEY (`id`),
    UNIQUE KEY `slug` (`slug`),
    KEY `name` (`name`)
);



-- --------------------------------------------------------

--
-- Table structure for table `qa_posts_tags`
--
/*
CREATE TABLE IF NOT EXISTS `qa_posts_tags` (
    `id`                        bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `post_id`               bigint(20) unsigned NOT NULL DEFAULT '0',
    `tag_id`                    bigint(20) unsigned NOT NULL DEFAULT '0',
    
    -- Package Foot
    `date_created`              datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `created_by`                varchar(200)        NOT NULL DEFAULT '',
    `date_modified`             datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `modified_by`               varchar(200)        NOT NULL DEFAULT '',
    `is_deleted`                tinyint             NOT NULL DEFAULT '0',

    PRIMARY KEY (`id`),
    KEY `post_id` (`post_id`),
    KEY `tag_id` (`tag_id`)
);
*/

CREATE TABLE IF NOT EXISTS `qa_posts_tags` (
    `post_id`       bigint(20) unsigned NOT NULL,
    `tag_id`       int(11) unsigned    NOT NULL,
    
    PRIMARY KEY  (`post_id`,`tag_id`),
    KEY `fk_tag_id` (`tag_id`)
);



-- --------------------------------------------------------

--
-- Table structure for table `qa_tags_users`
--

CREATE TABLE IF NOT EXISTS `qa_tags_users` (
    `id`                        bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `user_id`                   bigint(20) unsigned NOT NULL DEFAULT '0',
    `tag_id`                    bigint(20) unsigned NOT NULL DEFAULT '0',
    `post_count`                int(11) unsigned    NOT NULL DEFAULT '0'    COMMENT 'Number of posts that this user involved with this tag. Applicable to involved tags',
    `tag_relation`              varchar(200)        NOT NULL DEFAULT ''     COMMENT 'involved|interested|ignored',
    
    -- Package Foot
    `date_created`              datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `created_by`                varchar(200)        NOT NULL DEFAULT '',
    `date_modified`             datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `modified_by`               varchar(200)        NOT NULL DEFAULT '',
    `is_deleted`                tinyint             NOT NULL DEFAULT '0',

    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`),
    KEY `tag_id` (`tag_id`)
);





-- --------------------------------------------------------

--
-- Table structure for table `qa_badges_users`
--
/*
CREATE TABLE IF NOT EXISTS `qa_badges_users` (
    `id`                        bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `user_id`                   bigint(20) unsigned NOT NULL DEFAULT '0',
    `badge_id`                  bigint(20) unsigned NOT NULL DEFAULT '0',
    
    -- Package Foot
    `date_created`              datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `created_by`                varchar(200)        NOT NULL DEFAULT '',
    `date_modified`             datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `modified_by`               varchar(200)        NOT NULL DEFAULT '',
    `is_deleted`                tinyint             NOT NULL DEFAULT '0',

    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`),
    KEY `badge_id` (`badge_id`)
);
*/
CREATE TABLE IF NOT EXISTS `qa_badges_users` (
    `user_id`       bigint(20) unsigned NOT NULL,
    `badge_id`      int(11) unsigned    NOT NULL,
    
    PRIMARY KEY  (`user_id`,`badge_id`),
    KEY `fk_badge_id` (`badge_id`)
);



-- --------------------------------------------------------

--
-- Table structure for table `qa_settings`
--

CREATE TABLE IF NOT EXISTS `qa_settings` (
    `id`                        bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `setting_name`              varchar(100)        NOT NULL DEFAULT '',
    `setting_value`             longtext            NOT NULL,
    `autoload`                  tinyint             NOT NULL DEFAULT '0',
    
    -- Package Foot
    `date_created`              datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `created_by`                varchar(200)        NOT NULL DEFAULT '',
    `date_modified`             datetime            NOT NULL DEFAULT '0000-00-00 00:00:00',
    `modified_by`               varchar(200)        NOT NULL DEFAULT '',
    `is_deleted`                tinyint             NOT NULL DEFAULT '0',

    PRIMARY KEY (`id`),
    KEY `setting_name` (`setting_name`)
);

-- --------------------------------------------------------

--
-- Table structure for table `qa_follows`
--
/*
id
follower_id
followee_id

*/