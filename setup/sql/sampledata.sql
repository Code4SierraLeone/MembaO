-- ================================================================
--
-- @package Membao
-- @Author Alan Kawamara
-- @copyright 2017.
--
-- ================================================================
-- Database data
-- ================================================================

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `title`, `slug`, `description`, `date_introduced`, `status`, `mover`, `bill_type`, `committee`, `created`, `vote_up`, `vote_down`, `metakeys`, `metadesc`, `featured`) VALUES
(1, 'Sierra Leone Water Company Act, 2017', 'sierra-leone-water-company-act-2017', '&lt;p&gt;The bill intends to&amp;nbsp;provide for the continuance in existence of the Sierra Leone Water Company, to provide for a more efficient and effective management of community and rural water supply systems in specific areas, to provide for the facilitation of water sanitation and delivery in Sierra Leone and to provide for other related matters. &lt;/p&gt;', '2017-02-27', 3, 0, 2, 2, '2017-03-12 17:28:10', 0, 0, 'provide,sierra,leone,water', 'The bill intends to&nbsp;provide for the continuance in existence of the Sierra Leone Water Company,&#8230;', 0);


--
-- Dumping data for table `bills_recent`
--

INSERT INTO `bills_recent` (`id`, `bid`, `user_id`) VALUES
(1, 1, '6b73e5ca2b37c276861e5577609332188884d7fd'),
(2, 1, 'e52cee2d0c7467177c281e8ce23d5f861d616111'),
(3, 1, '816fe3c8a7b2dc5b65794654923a23eae03e905b'),
(4, 1, '161e16eb6d22a411ef2216519f0104849ab4433d'),
(5, 1, '391e06eb22e0baebc7953139b795964b4e1b48d9'),
(6, 1, '81cf2fcad4d6908b76fd8b9887f8d2dc75932b80'),
(7, 1, '31c8f4ec57f894155c3ee568637dbbd8029c4828'),
(8, 1, 'f218d4a3c9a8891ad753734fbc464d8f891e76ae'),
(9, 1, '9975e11b8da3c7a767641be42f15cc8835f91b2e'),
(10, 1, '23885fc7fb5a2c408b51ec9c258367ed5d620847'),
(11, 1, '3f8a068f7883562084dbf0143c49b8ada4637b90');

--
-- Dumping data for table `bills_stats`
--

INSERT INTO `bills_stats` (`id`, `day`, `bid`, `hits`, `uhits`) VALUES
(1, '2017-03-15', 1, 6, 2),
(2, '2017-03-16', 1, 14, 2),
(3, '2017-03-19', 1, 51, 3),
(4, '2017-03-20', 1, 2, 1),
(5, '2017-03-21', 1, 5, 2),
(6, '2017-03-22', 1, 1, 1),
(7, '2017-03-25', 1, 1, 1),
(8, '2017-03-31', 1, 1, 1),
(9, '2017-04-03', 1, 2, 1),
(10, '2017-04-08', 1, 1, 1),
(11, '2017-04-10', 1, 1, 1);

--
-- Dumping data for table `bills_status`
--

INSERT INTO `bills_status` (`id`, `bill`, `status_date`, `status`) VALUES
(1, 1, '2017-02-28', 1),
(2, 1, '2017-03-03', 2),
(3, 1, '2017-03-21', 3);


--
-- Dumping data for table `committees`
--

INSERT INTO `committees` (`id`, `name`, `slug`, `description`, `committees_type`, `created`, `metakeys`, `metadesc`) VALUES
(1, 'Privileges and Ethics Committee', 'privileges-and-ethics-committee', '&lt;div&gt;The duty of the Committee is to oversee and uphold the&amp;nbsp;privileges, laws and customs of the House as well as the responsibilities of Members of Parliament and standards of Parliamentary conduct. It is also entrusted to investigate and report on prima facie cases of&amp;nbsp;contempt and breach of Parliamentary privilege committed to it by the House.&lt;/div&gt;', 1, '2017-02-25 11:41:48', 'nbsp,house,parliamentary', 'The duty of the Committee is to oversee and uphold the&nbsp;privileges, laws and customs of the House&#8230;'),
(2, 'Legislative Committee', 'legislative-committee', '&lt;p&gt;There shall be a Committee to be known as the legislative Committee consisting of a maximum of 16 members to be nominated by the Committee of Selection for approval by the Plenary, after the beginning of each session of parliament, but in any case not later than twenty-one days thereafter.&lt;/p&gt;&lt;div&gt;It shall &amp;nbsp;be the duty of the Committee to scrutinise bills committed to it after Second Reading passage or, as the case may be, to assess, prior to the inception of passage, their appropriateness for introduction in the House; to examine constitutional and statutory instruments laid on the table of the House pursuant to subsection (7) of Section 70 of the Constitution; and to oversee the Judiciary.&lt;/div&gt;', 1, '2017-03-12 13:43:32', 'committee,case,passage,house', 'There shall be a Committee to be known as the legislative Committee consisting of a maximum of 16 members&#8230;');


--
-- Dumping data for table `committees_meetings`
--

INSERT INTO `committees_meetings` (`id`, `name`, `slug`, `meeting_date`, `meeting_type`, `description`, `committee`, `attendance_status`, `file_id`, `created`, `metakeys`, `metadesc`) VALUES
(13, 'Morbi pretium laoreet erat ac vehicula', 'morbi-pretium-laoreet-erat-ac-vehicula', '2017-04-28', 1, '&lt;p&gt;Lorem ipsum a dolor sit amet, consectetur adipiscing elit. Vestibulum dapibus, orci ac ultrices pulvinar, justo nisl rutrum nibh, in ultricies sapien velit in augue. Fusce convallis nulla nec tellus venenatis, ut eleifend purus semper. Duis porta tincidunt velit sit amet consectetur. Morbi pretium laoreet erat ac vehicula. Nam volutpat vel est sed porttitor. Nulla nec mauris vulputate, blandit velit id, iaculis nisi. Morbi ac viverra eros. Integer ut quam augue. Aliquam accumsan sem sed elit blandit, sed scelerisque nibh varius. Ut scelerisque in velit sed molestie. Quisque et sodales ligula. Mauris quis urna vehicula, dictum justo sit amet, imperdiet sapien. &lt;/p&gt;', 1, 0, 0, '2017-03-19 09:06:37', 'amet,consectetur,elit,justo,nibh,sapien,velit,augue,nulla,morbi,vehicula,mauris,blandit,scelerisque', 'Lorem ipsum a dolor sit amet, consectetur adipiscing elit. Vestibulum dapibus, orci ac ultrices pulvinar,&#8230;'),
(24, 'Quisque et sodales ligula', 'quisque-et-sodales-ligula', '2017-03-19', 1, '&lt;p&gt;Lorem ipsum a dolor sit amet, consectetur adipiscing elit. Vestibulum dapibus, orci ac ultrices pulvinar, justo nisl rutrum nibh, in ultricies sapien velit in augue. Fusce convallis nulla nec tellus venenatis, ut eleifend purus semper. Duis porta tincidunt velit sit amet consectetur. Morbi pretium laoreet erat ac vehicula. Nam volutpat vel est sed porttitor. Nulla nec mauris vulputate, blandit velit id, iaculis nisi. Morbi ac viverra eros. Integer ut quam augue. Aliquam accumsan sem sed elit blandit, sed scelerisque nibh varius. Ut scelerisque in velit sed molestie. Quisque et sodales ligula. Mauris quis urna vehicula, dictum justo sit amet, imperdiet sapien. &lt;/p&gt;', 1, 0, 0, '2017-03-19 10:34:04', 'amet,consectetur,elit,justo,nibh,sapien,velit,augue,nulla,morbi,vehicula,mauris,blandit,scelerisque', 'Lorem ipsum a dolor sit amet, consectetur adipiscing elit. Vestibulum dapibus, orci ac ultrices pulvinar,&#8230;'),
(12, 'Meeting tipsum dolor sit amet', 'meeting-tipsum-dolor-sit-amet', '2017-03-27', 1, '&lt;p&gt;Lorem ipsum a dolor sit amet, consectetur adipiscing elit. Vestibulum dapibus, orci ac ultrices pulvinar, justo nisl rutrum nibh, in ultricies sapien velit in augue. Fusce convallis nulla nec tellus venenatis, ut eleifend purus semper. Duis porta tincidunt velit sit amet consectetur. Morbi pretium laoreet erat ac vehicula. Nam volutpat vel est sed porttitor. Nulla nec mauris vulputate, blandit velit id, iaculis nisi. Morbi ac viverra eros. Integer ut quam augue. Aliquam accumsan sem sed elit blandit, sed scelerisque nibh varius. Ut scelerisque in velit sed molestie. Quisque et sodales ligula. Mauris quis urna vehicula, dictum justo sit amet, imperdiet sapien.&lt;/p&gt;', 1, 0, 0, '2017-03-11 03:39:19', 'amet,consectetur,elit,justo,nibh,sapien,velit,augue,nulla,morbi,vehicula,mauris,blandit,scelerisque', 'Lorem ipsum a dolor sit amet, consectetur adipiscing elit. Vestibulum dapibus, orci ac ultrices pulvinar,&#8230;');


--
-- Dumping data for table `committees_meetings_attendance`
--

INSERT INTO `committees_meetings_attendance` (`id`, `meeting_id`, `leader_id`, `status`) VALUES
(33, 24, 32, 0),
(32, 24, 31, 1),
(31, 24, 30, 0),
(30, 24, 29, 1),
(29, 24, 28, 1),
(28, 24, 27, 0),
(27, 24, 26, 1),
(26, 24, 25, 1),
(25, 24, 14, 1),
(24, 24, 24, 1),
(23, 24, 23, 1),
(22, 24, 16, 1),
(21, 24, 22, 1),
(20, 24, 15, 1),
(19, 24, 21, 1),
(18, 24, 5, 1);

--
-- Dumping data for table `committees_members`
--

INSERT INTO `committees_members` (`id`, `committee`, `member`, `role`) VALUES
(96, 2, 20, 3),
(95, 2, 19, 3),
(94, 2, 18, 3),
(93, 2, 17, 3),
(92, 2, 16, 3),
(91, 2, 15, 3),
(90, 2, 1, 3),
(89, 2, 14, 3),
(88, 2, 13, 3),
(87, 2, 12, 3),
(86, 2, 11, 3),
(85, 2, 10, 3),
(84, 2, 6, 3),
(83, 2, 9, 3),
(82, 2, 8, 2),
(81, 2, 7, 1),
(112, 1, 32, 3),
(111, 1, 31, 3),
(110, 1, 30, 3),
(109, 1, 29, 3),
(108, 1, 28, 3),
(107, 1, 27, 3),
(106, 1, 26, 3),
(105, 1, 25, 3),
(104, 1, 14, 3),
(103, 1, 24, 3),
(102, 1, 23, 3),
(101, 1, 16, 3),
(100, 1, 22, 3),
(99, 1, 15, 3),
(98, 1, 21, 2),
(97, 1, 5, 1);

--
-- Dumping data for table `committees_type`
--

INSERT INTO `committees_type` (`id`, `name`, `description`) VALUES
(1, 'Standing committee', '&lt;p&gt;Standing committees operate continuously and concentrate on examining bills and issues relating to particular subjects.&amp;nbsp; &lt;/p&gt;');


--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`, `position`) VALUES
(1, 'What is a bill?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 1),
(2, 'What is a committee', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 2),
(3, 'What is the role of an MP?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 3),
(4, 'How many sittings does Parliament have?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 4),
(5, 'What is a term', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 5);

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `alias`, `filesize`, `created`, `active`) VALUES
(1, 'testfile1.zip', 'Demo File 1', '19456', '2011-07-21 15:42:11', 1),
(2, 'testfile2.zip', 'Demo File 2', '23552', '2011-07-21 15:42:21', 1),
(3, 'testfile3.zip', 'Demo File 3', '11264', '2011-07-21 15:42:29', 1),
(4, 'testfile4.zip', 'Demo File 4', '7168', '2011-07-21 15:42:37', 1),
(5, 'testfile5.zip', 'Demo File 5', '9216', '2011-07-21 15:42:49', 1),
(6, 'testpdf1.pdf', 'Demo File 6', '19456', '2011-07-21 15:47:18', 1),
(7, 'testpdf2.pdf', 'Demo File 7', '23552', '2011-07-21 15:47:29', 1),
(8, 'testpdf3.pdf', 'Demo File 8', '11264', '2011-07-21 15:47:44', 1),
(9, 'testfilems1.doc', 'Demo File 9', '19456', '2011-07-21 15:51:16', 1),
(10, 'testfilems2.docx', 'Demo File 10', '23552', '2011-07-21 15:51:24', 1),
(11, 'testfilems4.xls', 'Demo File 11', '7168', '2011-07-21 15:51:32', 1),
(12, 'testfilems5.xlsx', 'Demo File 12', '9216', '2011-07-21 15:51:43', 1);


--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `page_id`, `name`, `content_type`, `link`, `target`, `position`, `active`) VALUES
(1, 4, 'Contact', 'page', '', '', 6, 1),
(2, 1, 'Home', 'page', NULL, '', 1, 0),
(3, 2, 'About', 'page', '', '', 5, 1),
(7, 0, 'Alerts', 'web', '#', '_self', 4, 1);

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `body`, `created`, `contact`, `faq`, `home_page`, `active`) VALUES
(1, 'Welcome to Memba-O!', 'welcome-to-memba-o', '&lt;p&gt;Memba-O! aims to act as a parliamentary watchdog, enabling citizens to track what is going on in Parliament. &lt;/p&gt;', '2017-01-08 00:00:00', 0, 0, 1, 1),
(2, 'About Us', 'about-us', '&lt;p&gt;&lt;b&gt;All about us!&lt;/b&gt;&lt;br&gt;&lt;br&gt;Suspendisse vel nibh at eros blandit aliquet non vel ligula. Praesent  laoreet nibh sit amet neque imperdiet eu tempor felis pharetra. &lt;br&gt;Class  aptent taciti sociosqu ad litora torquent per conubia nostra, per  inceptos himenaeos. &lt;br&gt;&lt;br&gt;Vivamus iaculis tristique sapien quis consectetur.  Curabitur sollicitudin, ante at sagittis suscipit, nulla risus facilisis  neque, eu consectetur mi sem sed lectus. Aliquam erat volutpat. Proin  in ante risus. Etiam pulvinar vestibulum laoreet. &lt;br&gt;&lt;br&gt;Vivamus venenatis  consectetur libero quis consequat. Vivamus ut lorem diam. Cras interdum  sem sed risus dictum fringilla. Sed sagittis turpis ut nisi faucibus  pellentesque. Nunc sit amet semper erat.&lt;/p&gt;', '2014-09-02 00:00:00', 0, 0, 0, 1),
(3, 'F.A.Q.', 'faq', 'Here you can find most common questions regarding DDP', '2014-08-06 00:00:00', 0, 1, 0, 1),
(4, 'Contact Us', 'contact-us', '&lt;p style=&quot;font-family: Arial, Verdana; line-height: normal; &quot;&gt;&lt;b&gt;Need to contact us?&lt;/b&gt;&lt;/p&gt;\n&lt;p style=&quot;font-family: Arial, Verdana; line-height: normal; &quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris congue  vehicula enim id condimentum. &lt;br&gt;Integer at leo lobortis libero fermentum  cursus. Mauris nulla nibh, condimentum ac cursus ac, ullamcorper eu  orci. &lt;br&gt;&lt;br&gt;Nunc at ligula erat. Nunc tempor dictum commodo. Nulla aliquam  scelerisque luctus. Donec non suscipit enim. &lt;br&gt;Donec diam turpis,  facilisis et pretium vitae, adipiscing id nibh. Nullam vel orci vitae  erat mattis mattis. &lt;br&gt;&lt;br&gt;Quisque at vehicula ante. Pellentesque habitant  morbi tristique senectus et netus et malesuada fames ac turpis egestas.  Sed turpis felis, egestas vitae tincidunt nec, ullamcorper non nisi.&lt;/p&gt;', '2014-09-01 00:00:00', 1, 0, 0, 1),
(5, 'Other page', 'other-page', '&lt;p&gt;Sed eu lorem ut diam feugiat vulputate sed a enim. Aenean interdum, dui a  varius facilisis, metus est imperdiet justo, pharetra auctor ipsum  lorem non mauris. Mauris laoreet lectus lacus. Maecenas ut enim diam,  non malesuada sapien. Fusce ullamcorper pretium risus, eu volutpat dolor  dapibus sit amet&lt;/p&gt;', '2014-08-07 00:00:00', 0, 0, 0, 1);

