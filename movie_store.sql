-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2016 at 11:29 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `movie_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `added_movies`
--

CREATE TABLE IF NOT EXISTS `added_movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `yearofproduction` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `poster_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `added_movies`
--

INSERT INTO `added_movies` (`id`, `name`, `quantity`, `category`, `type`, `seller_id`, `price`, `yearofproduction`, `status`, `poster_name`, `description`) VALUES
(15, 'super man', 85, 'horror', 'dvd', 35, 100, 2016, 'new', 'superman.jpg', 'Clark Kent, one of the last of an extinguished race disguised as an unremarkable human, is forced to reveal his identity when Earth is invaded by an army of survivors who threaten to bring the planet to the brink of destruction.'),
(16, 'the dark knight', 72, 'tragedy', 'dvd', 35, 100, 2016, 'new', 'thedarkknight.jpg', 'Set within a year after the events of Batman Begins, Batman, Lieutenant James Gordon, and new district attorney Harvey Dent successfully begin to round up the criminals that plague Gotham City until a mysterious and sadistic criminal mastermind known only as the Joker appears in Gotham, creating a new wave of chaos. Batman''s struggle against the Joker becomes deeply personal, forcing him to "confront everything he believes" and improve his technology to stop him. A love triangle develops between Bruce Wayne, Dent and Rachel Dawes.'),
(17, 'daredevil', 199, 'drama', 'dvd', 29, 200, 2016, 'new', 'daredevil.jpg', 'A man blinded by toxic waste which also enhanced his remaining senses fights crime as an acrobatic martial arts superhero.'),
(18, 'aquaman', 99, 'drama', 'video', 29, 500, 2016, 'new', 'aquaman.jpg', 'Aquaman is a fictional superhero appearing in DC Comics. Created by Paul Norris and Mort Weisinger, the character debuted in More Fun Comics #73 (November 1941). Initially a backup feature in DC''s anthology titles, Aquaman later starred in several volumes of a solo title'),
(19, 'wonder woman', 199, 'horror', 'dvd', 29, 350, 2016, 'new', 'wonderwoman.jpg', 'Diana Prince is a fictional character appearing regularly in stories published by DC Comics, as secret identity of the Amazonian superheroine Wonder Woman, who bought the credentials and identity from an Army nurse named Diana Prince who went to South America and married her fiancé to become Diana White'),
(24, 'black adam', 9, 'action', 'video', 35, 500, 2019, 'new', 'blackadam.jpg', 'Black Adam is a fictional supervillain appearing in American comic books published by DC Comics, and is a primary adversary of the superhero Shazam, formerly known as Captain Marvel. Black Adam was created by Otto Binder'),
(25, 'SAW', 190, 'horror', 'dvd', 35, 40, 2002, 'new', 'saw.jpg', 'Two strangers awaken in a room with no recollection of how they got there or why, and soon discover they are pawns in a deadly game perpetrated by a notorious serial killer.'),
(26, 'Deadpool', 100, 'Action', 'dvd', 35, 100, 2015, 'new', 'deadpool.jpg', 'This is the origin story of former Special Forces operative turned mercenary Wade Wilson, who after being subjected to a rogue experiment that leaves him with accelerated healing powers, adopts the alter ego Deadpool. Armed with his new abilities and a dark, twisted sense of humor, Deadpool hunts down the man who nearly destroyed his life.'),
(27, 'x men days of future past', 100, 'Action', 'dvd', 35, 145, 2013, 'new', 'xmendaysoffuturepast.jpg', 'Sentinels, robots that were created for the purpose of hunting down mutants were released in 1973. 50 years later the Sentinels would also hunt humans who aid mutants. Charles Xavier and his X-Men try their best to deal with the Sentinels but they are able to adapt and deal with all mutant abilities. Charles decides to go back in time and change things. He asks Kitty Pryde who can send a person''s consciousness into the person''s past to send him but she can only send someone back a few weeks because if she sends someone back further it could harm them. So Logan decides to go back himself because he might be able to withstand it. So Charles tells him that it''s Mystique who''s responsible because when she learned about the Sentinels she sought out Bolivar Trask the man who created them and killed him. She would be caught and studied and her ability to change was somehow'),
(28, 'X First Class', 156, 'action', 'dvd', 35, 160, 2011, 'new', 'xfirstclass.jpg', 'In 1962, the United States government enlists the help of Mutants with superhuman abilities to stop a malicious dictator who is determined to start World War III.'),
(29, 'Horrible Bosses', 456, 'comedy', 'dvd', 35, 99, 2011, 'new', 'HorribleBosses.jpg', 'Nick hates his boss, mostly because he''s expected to work from before sunrise to after sunset and his boss, Mr. Harken, calls him out for being a minute late and blackmails him so he can''t quit. Dale hates his boss, Dr. Julia Harris, because she makes unwelcome sexual advances when he''s about to get married. But Dale is on that pesky list of child offenders so he can''t quit. Kurt actually likes his job and his boss, well, up until his boss dies and the boss''s coked-out, psychopathic son takes over. But who would be crazy enough to quit their jobs in such poor economic times? Instead Nick, Dale and Kurt drunkenly and hypothetically discuss how to kill their bosses, and before they know it, they''ve hired a murder consultant to help them pull off the three deeds.'),
(30, 'Horrible Bosses 2', 200, 'comedy', 'dvd', 35, 149, 2014, 'new', 'HorribleBosses2.jpg', 'The movie picks a little bit after the the first installment. Nick, Kurt and Dale have quit their old jobs and hit quite a break by inventing a shower head product. But the father-and-son crooked businessmen Bert and Rex Hanson swindled them off their own company. The three again think of a crime to exact vengeance on the Hansons. Failed at murder attempts, they turn to kidnapping the son Rex to be held at ransom against Bert. They first sneak into the place of Julia, Dales old boss. Julia comes unexpectedly so Kurt and Dale, who Julia already knew from the first movie, hides in the closet. Nick sacrifices himself to satisfy Julias addiction problem so that Kurt and Dale can escape unnoticed. They sneak into Rexs house with a stash of nitrogen supposedly to gas the owner. But as usual, a mishap occurs, releasing the nitrogen on themselves inside Rexs closet. The next day, Rex pulls a gag on them and then quickly escalates the situation, forcing the three to continue on the kidnapping plan, only with Rex in on it too. Rex marks up the ransom from half a million to five million dollars, claiming that his father will cooperate and not call the police'),
(31, 'gone girl', 230, 'drama', 'dvd', 35, 456, 2014, 'new', 'gonegirl.jpg', 'On the occasion of his fifth wedding anniversary, Nick Dunne reports that his wife, Amy, has gone missing. Under pressure from the police and a growing media frenzy, Nick''s portrait of a blissful union begins to crumble. Soon his lies, deceits and strange behavior have everyone asking the same dark question: Did Nick Dunne kill his wife?'),
(32, 'Inception', 30, 'action', 'dvd', 35, 199, 2010, 'new', 'Inception.jpg', 'Dom Cobb is a skilled thief, the absolute best in the dangerous art of extraction, stealing valuable secrets from deep within the subconscious during the dream state, when the mind is at its most vulnerable. Cobb''s rare ability has made him a coveted player in this treacherous new world of corporate espionage, but it has also made him an international fugitive and cost him everything he has ever loved. Now Cobb is being offered a chance at redemption. One last job could give him his life back but only if he can accomplish the impossible - inception. Instead of the perfect heist, Cobb and his team of specialists have to pull off the reverse: their task is not to steal an idea but to plant one. If they succeed, it could be the perfect crime. But no amount of careful planning or expertise can prepare the team for the dangerous enemy that seems to predict their every move. An enemy that only Cobb could have seen coming.'),
(33, 'Shutter Island', 20, 'drama', 'dvd', 35, 49, 2010, 'new', 'ShutterIsland.jpg', 'It''s 1954, and up-and-coming U.S. marshal Teddy Daniels is assigned to investigate the disappearance of a patient from Boston''s Shutter Island Ashecliffe Hospital. He''s been pushing for an assignment on the island for personal reasons, but before long he wonders whether he hasn''t been brought there as part of a twisted plot by hospital doctors whose radical treatments range from unethical to illegal to downright sinister. Teddy''s shrewd investigating skills soon provide a promising lead, but the hospital refuses him access to records he suspects would break the case wide open. As a hurricane cuts off communication with the mainland, more dangerous criminals "escape" in the confusion, and the puzzling, improbable clues multiply, Teddy begins to doubt everything - his memory, his partner, even his own sanity.'),
(34, 'Now You See Me', 70, 'action', 'dvd', 35, 50, 89, 'new', 'NowYouSeeMe.jpg', 'Four magicians each answer a mysterious summons to an obscure address with secrets inside. A year later, they are the Four Horsemen, big time stage illusionists who climax their sold out Las Vegas show with a bank apparently robbed for real. This puts agents Dylan Rhodes of the FBI and Alma Dray of Interpol on the case to find out how they did it. However, this mystery proves difficult to solve even with the insights of the professional illusion exposer, Thaddeus Bradley. What follows is a bizarre investigation where nothing is what it seems with illusions, dark secrets and hidden agendas galore as all involved are reminded of a great truth in this puzzle: the closer you look, the less you see.'),
(35, '500 Days of Summer', 100, 'drama', 'dvd', 35, 100, 2009, 'new', '500DaysofSummer.jpg', 'After it looks as if she''s left his life for good this time, Tom Hansen reflects back on the just over one year that he knew Summer Finn. For Tom, it was love at first sight when she walked into the greeting card company where he worked, she the new administrative assistant. Soon, Tom knew that Summer was the woman with whom he wanted to spend the rest of his life. Although Summer did not believe in relationships or boyfriends - in her assertion, real life will always ultimately get in the way - Tom and Summer became more than just friends. Through the trials and tribulations of Tom and Summer''s so-called relationship, Tom could always count on the advice of his two best friends, McKenzie and Paul. However, it is Tom''s adolescent sister, Rachel, who is his voice of reason. After all is said and done, Tom is the one who ultimately has to make the choice to listen or not.'),
(36, 'I Am Sam', 100, 'drama', 'dvd', 35, 100, 2001, 'new', 'IAmSam.jpg', 'Sam Dawson has the mental capacity of a 7-year-old. He works at a Starbucks and is obsessed with the Beatles. He has a daughter with a homeless woman; she abandons them as soon as they leave the hospital. He names his daughter Lucy Diamond (after the Beatles song), and raises her. But as she reaches age 7 herself, Sam''s limitations start to become a problem at school; she''s intentionally holding back to avoid looking smarter than him. The authorities take her away, and Sam shames high-priced lawyer Rita Harrison into taking his case pro bono. In the process, he teaches her a great deal about love, and whether it''s really all you need'),
(37, 'avengers age of ultron', 100, 'action', 'dvd', 35, 100, 2015, 'new', 'avengersageofultron.jpg', 'When Tony Stark and Bruce Banner try to jump-start a dormant peacekeeping program called Ultron, things go horribly wrong and it''s up to Earth''s Mightiest Heroes to stop the villainous Ultron from enacting his terrible plans.'),
(38, 'avengers', 100, 'action', 'dvd', 35, 100, 2013, 'new', 'avengers.jpg', 'Earth''s mightiest heroes must come together and learn to fight as a team if they are to stop the mischievous Loki and his alien army from enslaving humanity.'),
(39, 'face off', 100, 'action', 'dvd', 35, 100, 1997, 'new', 'faceoff.jpg', 'In order to foil an extortion plot, an FBI agent undergoes a face-transplant surgery and assumes the identity and physical appearance of a ruthless terrorist, but the plan turns from bad to worse when the same criminal impersonates the cop.'),
(40, 'hannibal', 100, 'horror', 'dvd', 35, 100, 2001, 'new', 'hannibal.jpg', 'The continuing saga of Hannibal Lecter, the murdering cannibal. He is presently in Italy and works as a curator at a museum. Clarice Starling, the FBI agent whom he aided to apprehend a serial killer, was placed in charge of an operation but when one of her men botches it, she''s called to the mat by the Bureau. One high ranking official, Paul Krendler has it in for her. But she gets a reprieve because Mason Verger, one of Lecter''s victims who is looking to get back at Lecter for what Lecter did to him, wants to use Starling to lure him out. When Lecter sends her a note she learns that he''s in Italy so she asks the police to keep an eye out for him. But a corrupt policeman who wants to get the reward that Verger placed on him, tells Verger where he is. But they fail to get him. Later Verger decides to frame Starling which makes Lecter return to the States. And the race to get Lecter begins.'),
(41, 'In the Heart of the Sea', 100, 'drama', 'dvd', 35, 100, 2015, 'new', 'intheheartofthesea.jpg', 'A recounting of a New England whaling ship''s sinking by a giant whale in 1820, an experience that later inspired the great novel Moby-Dick.'),
(42, 'Memento', 100, 'drama', 'dvd', 35, 100, 2000, 'new', 'Memento.jpg', 'Memento chronicles two separate stories of Leonard, an ex-insurance investigator who can no longer build new memories, as he attempts to find the murderer of his wife, which is the last thing he remembers. One story line moves forward in time while the other tells the story backwards revealing more each time');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'horror'),
(2, 'comedy'),
(3, 'action'),
(4, 'drama'),
(5, 'adventure'),
(6, 'documentary');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` text NOT NULL,
  `movie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `movie_id` (`movie_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `body`, `movie_id`, `user_id`, `date`) VALUES
(9, 'that was ok', 15, 35, '2016-04-30 18:06:16'),
(10, 'awesome', 15, 35, '2016-04-30 18:39:20'),
(11, 'cool', 15, 35, '2016-04-30 18:39:27'),
(12, 'syasdas', 15, 35, '2016-04-30 18:39:34'),
(13, 'hkhjmb', 29, 35, '2016-05-14 11:07:47');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `d_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Mobile` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`d_id`, `order_id`, `price`, `movie_id`, `quantity`, `Address`, `Mobile`, `email`) VALUES
(81, 60, 40, 25, 3, 'batcave', 123123, 'lithy@h.com'),
(82, 60, 100, 16, 1, 'batcave', 123123, 'lithy@h.com');

-- --------------------------------------------------------

--
-- Table structure for table `order_num`
--

CREATE TABLE IF NOT EXISTS `order_num` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ct_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `done` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `order_num`
--

INSERT INTO `order_num` (`id`, `ct_id`, `total`, `done`) VALUES
(54, 29, 700, 0),
(60, 35, 220, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE IF NOT EXISTS `tblproduct` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`id`, `name`, `code`, `image`, `price`) VALUES
(1, '3D Camera', '3DcAM01', 'product-images/camera.jpg', 1500.00),
(2, 'External Hard Drive', 'USB02', 'product-images/external-hard-drive.jpg', 800.00),
(3, 'Wrist Watch', 'wristWear03', 'product-images/watch.jpg', 300.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `name` varchar(20) NOT NULL,
  `salt` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Address` varchar(64) NOT NULL,
  `Mobile` varchar(15) NOT NULL,
  `joined` datetime NOT NULL,
  `user_type` int(11) NOT NULL,
  `fav_cat_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `fav_cat_id` (`fav_cat_id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `salt`, `email`, `Address`, `Mobile`, `joined`, `user_type`, `fav_cat_id`) VALUES
(27, 'ahmed', '4ee556387ffad15b31ac6ac6b37d7406358e73b6cbf9ab55eaa61e631fb338e8', 'ahmed', 'âÍFNEŠ¦ª´º_–g†=ÿ°1ÆSOVRn6„G‘B', 's@b.com', 'lsajdf', '+65+', '2016-03-20 22:03:05', 2, 0),
(30, 'mido', 'ad070893544eef0ccf455c83f726ad0509af7a6f83a8199b7601906438dfa325', 'mido', 'Ä|$Ô-!/†!‘?ÁÙj¥8ï®—µlQV~5õ¿}', 'b@cd.com', 'bsdy5ksdhb', '6846', '2016-03-22 07:16:29', 1, 0),
(35, 'lithy', '89b161ac1967d7c789bae70ddf10761cf3de4cf324d910f9e559955e7e964495', 'ahmed essam', 'í‰}UP~nËPÑ9Oé²¢z£´­«¾”‡ä\0î#àa/', 'lithy@h.com', 'batcave', '123123', '2016-04-14 18:15:03', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_session`
--

CREATE TABLE IF NOT EXISTS `user_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type`) VALUES
(1, 'admin'),
(2, 'seller'),
(3, 'customer');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `added_movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_session`
--
ALTER TABLE `user_session`
  ADD CONSTRAINT `user_session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
