--
-- Blog related queries.
--

CREATE TABLE IF NOT EXISTS `blog_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `author` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `url` varchar(128) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comment_post` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `blog_comment` (`id`, `content`, `status`, `create_time`, `author`, `email`, `url`, `post_id`) VALUES
(1, 'This is a test comment.', 2, 1230952187, 'Tester', 'tester@example.com', NULL, 2);

--

CREATE TABLE IF NOT EXISTS `blog_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `blog_lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
(1, 'Draft', 1, 'PostStatus', 1),
(2, 'Published', 2, 'PostStatus', 2),
(3, 'Archived', 3, 'PostStatus', 3),
(4, 'Pending Approval', 1, 'CommentStatus', 1),
(5, 'Approved', 2, 'CommentStatus', 2);

--

CREATE TABLE IF NOT EXISTS `blog_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `tags` text,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_post_author` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `blog_post` (`id`, `title`, `content`, `tags`, `status`, `create_time`, `update_time`, `author_id`) VALUES
(1, 'Welcome!', 'This blog system is developed using Yii. It is meant to demonstrate how to use Yii to build a complete real-world application. Complete source code may be found in the Yii releases.\r\n\r\nFeel free to try this system by writing new posts and posting comments.', 'yii, blog', 2, 1230952187, 1230952187, 1),
(2, 'A Test Post', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'test', 2, 1230952187, 1230952187, 1);

--

CREATE TABLE IF NOT EXISTS `blog_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `blog_tag` (`id`, `name`, `frequency`) VALUES
(1, 'yii', 1),
(2, 'blog', 1),
(3, 'test', 1);

--

CREATE TABLE IF NOT EXISTS `blog_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `salt` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `profile` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `blog_user` (`id`, `username`, `password`, `salt`, `email`, `profile`) VALUES
(1, 'admin', '9401b8c7297832c567ae922cc596a4dd', '28b206548469ce62182048fd9cf91760', 'webmaster@example.com', NULL), -- password admin
(2, 'demo', '2e5c7db760a33498023813489cfadc0b', '28b206548469ce62182048fd9cf91760', 'webmaster@example.com', NULL);  -- password demo

--
-- Rights related queries.
--

CREATE TABLE IF NOT EXISTS `blog_authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `blog_authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Admin', 2, NULL, NULL, 'N;'),
('Authenticated', 2, 'Authenticated user', NULL, 'N;'),
('Comment.*', 1, 'Access all comment actions', NULL, 'N;'),
('Comment.Approve', 0, 'Approve comments', NULL, 'N;'),
('Comment.Delete', 0, 'Delete comments', NULL, 'N;'),
('Comment.Update', 0, 'Update comments', NULL, 'N;'),
('CommentAdministration', 1, 'Administration of comments', NULL, 'N;'),
('Editor', 2, 'Editor', NULL, 'N;'),
('Guest', 2, 'Guest user', NULL, 'N;'),
('Post.*', 1, 'Access all post actions', NULL, 'N;'),
('Post.Admin', 0, 'Administer posts', NULL, 'N;'),
('Post.Create', 0, 'Create posts', NULL, 'N;'),
('Post.Delete', 0, 'Delete posts', NULL, 'N;'),
('Post.Update', 0, 'Update posts', NULL, 'N;'),
('Post.View', 0, 'View posts', NULL, 'N;'),
('PostAdministrator', 1, 'Administration of posts', NULL, 'N;'),
('PostUpdateOwn', 0, 'Update own posts', 'return Yii::app()->user->id==$params["userid"];', 'N;');

--

CREATE TABLE IF NOT EXISTS `blog_authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `blog_authitemchild` (`parent`, `child`) VALUES
('Editor', 'Authenticated'),
('CommentAdministration', 'Comment.*'),
('Editor', 'CommentAdministration'),
('Authenticated', 'CommentUpdateOwn'),
('Authenticated', 'Guest'),
('PostAdministrator', 'Post.Admin'),
('Authenticated', 'Post.Create'),
('PostAdministrator', 'Post.Create'),
('PostAdministrator', 'Post.Delete'),
('PostAdministrator', 'Post.Update'),
('Guest', 'Post.View'),
('PostAdministrator', 'Post.*'),
('Editor', 'PostAdministrator'),
('Authenticated', 'PostUpdateOwn');

--

CREATE TABLE IF NOT EXISTS `blog_authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `blog_authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admin', '1', NULL, 'N;'),
('Authenticated', '2', NULL, 'N;');

--

CREATE TABLE IF NOT EXISTS `blog_rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `blog_rights` (`itemname`, `type`, `weight`) VALUES
('Authenticated', 2, 1),
('Editor', 2, 0),
('Guest', 2, 2);

--

ALTER TABLE `blog_authassignment`
  ADD CONSTRAINT `blog_authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `blog_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `blog_authitemchild`
  ADD CONSTRAINT `blog_authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `blog_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `blog_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `blog_rights`
  ADD CONSTRAINT `blog_rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `blog_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;