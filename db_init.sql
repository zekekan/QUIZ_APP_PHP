

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `final_assignment`
--
CREATE DATABASE IF NOT EXISTS `final_assignment`  DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `final_assignment`;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `login_id` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(60) NULL,
  `password` varchar(60) NOT NULL,
  `phone` varchar(70) NULL,
  `address` varchar(70) NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY (id, login_id, email, password)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

--
-- Dumping data for table `users`
--

INSERT INTO `students` (`id`, `login_id`, `fullname`, `email`, `password`, `phone`, `address`) VALUES
  (1, 'admin', 'admin name', 'admin@admin.com','827ccb0eea8a706c4c34a16891f84e7b', '6471234567', '123 King St.');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  UNIQUE KEY (category_name)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
  (1, 'CanadaQuiz'),
  (2, 'MovieQuiz');
-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `question_name` text NOT NULL,
  `choice1` varchar(250) NOT NULL,
  `choice2` varchar(250) NOT NULL,
  `choice3` varchar(250) NOT NULL,
  `choice4` varchar(250) NOT NULL,
  `answer_index` int(4) NOT NULL,
  `category_id` int(11) NOT NULL,
  FOREIGN KEY (category_id) REFERENCES categories (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_name`, `choice1`, `choice2`, `choice3`, `choice4`, `answer_index`, `category_id`) VALUES
  (1, 'When did the Trans-Canada Highway officially open?', '1962', '1902', '2005', '1981', '0', (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (2, 'In Canada, which temperature scale is used to measure temperature?', 'Celsius', 'Fahrenheit', 'Meter', 'Gram', 0, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (3, 'In 1812, which country was unsuccessful in its attempt to conquer Canada?', 'Russia', 'China', 'United States of America', 'Germany', 2, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (4, 'Who wrote the popular novel Anne of Green Gables in 1908, which has since been translated into 15 languages and inspired two films and a musical performed in Charlottetown every year?', 'Lucy Maud Montgomery', 'Margaret Atwood', 'Alice Munro', 'W.O. Mitchell', 0, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (5, 'What is the oldest English settlement in Canada?', 'Quebec, Quebec', 'Halifax, Nova Scotia', 'Ottawa, Ontario', 'St. John''s, Newfoundland and Labrador', 3, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (6, 'In 1970, there was a major change to the Canadian federal election voting system. What was that change?', 'Women gained the right to vote', 'Personal identification became a necessity to vote', 'The voting age was lowered from 21 to 18', 'Voting rights were extended to all inmates', 3, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (7, 'Newfoundland was the last province to join Confederation in 1949. What year did the province''s name officially change to include Labrador?', '1999', '1954', '2004', '2001', 3, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (8, 'Count Frontenac refused to surrender Quebec to the English in 1690, saying:', 'You have nothing to fear but yourself!', 'Let them eat French fries!', 'My only reply will be from the mouths of my cannons!', 'England expects every man will do his duty!', 2, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (9, 'Why is Remembrance Day held on November 11 of each year?', 'It was the day that the First World War officially started', 'It is the beginning of poppy season', 'It is Armistice Day when the First World War ended', 'All of the above', 2, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (10, 'What is the oldest national park in Canada?', 'Glacier National Park', 'Banff National Park', 'Fundy National Park', 'Waterton Lakes National Park', 1, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (11, 'The Canadian flag is composed of which colours?', 'Red/White/Blue', 'Red/Black', 'Red/Blue/Green', 'Red/White', 3, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (12, 'When was the most recent territory in Canada formed?', 'April 1, 1999', 'April 1, 2000', 'July 1, 1999', 'July 1, 2000', 0, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (13, 'Who was the only Canadian ever to serve as Prime Minister of Great Britain?', 'Tony Blair', 'Margaret Thatcher', 'Andrew Bonar Law', 'Sir Winston Churchill', 2, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (14, 'Who was the first governor general of Canada (serving from July 1, 1867, to November 14, 1868)?', 'Georges Vanier', 'Samuel de Champlain', 'Vincent Massey', 'Viscount Monck', 3, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (15, 'What is the approximate population of Canada?', '25,000,000', '31,000,000', '34,000,000', '40,000,000', 2, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (16, 'Who were the first people to live in Canada?', 'Europeans', 'Loyalists', 'Aboriginals', 'Norsemen', 2, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (17, 'What is Canada''s federal police force called?', 'Mounted Royal Canadian Police', 'Royal Canadian Mounted Police', 'Canada''s Elite Police Force', 'Federal Bureau of Investigation', 1, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (18, 'Which document made Confederation official and legal?', 'The British North America Act of 1867', 'The Dominion Act', 'The British Dominion Act', 'The Confederation Act', 0, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (19, 'In 1867, four provinces joined to become the country that is now Canada. Which of the following was NOT one of the first four provinces in Canada?', 'Ontario', 'Quebec', 'New Brunswick', 'Manitoba', 3, (SELECT id from categories WHERE category_name = 'CanadaQuiz')),
  (20, 'When did the Prime Minister, on behalf of the Government of Canada, officially apologize in the House of Commons for the Chinese Head Tax that was imposed on Chinese newcomers in 1885?', 'July 1, 2006', 'June 1, 2006', 'June 22, 2006', 'September 22, 2006', 2, (SELECT id from categories WHERE category_name = 'CanadaQuiz'));


INSERT INTO `questions` (`id`, `question_name`, `choice1`, `choice2`, `choice3`, `choice4`, `answer_index`, `category_id`) VALUES
  (21, 'The Moon of Barods, a diamond that Marilyn Monroe wore when singing "Diamonds Are A Girl''s Best Friend" in the film Gentlemen prefer Blondes, was auctioned off at Christies for how much in 1990?', '$97,000', '$297,000', '$497,000', '$797,000', 1, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (22, 'Which one of these Academy Awards did Gone With the Wind not win?', 'best actor', 'best actress', 'best picture', 'best supporting actor', 0, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (23, 'Which one of these talented actors did not star in the 1989 movie "Family Business"?', 'Sean Connery', 'Matthew Broderick', 'Dustin Hoffman', 'Tom Cruise', 3, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (24, 'In the 1933 movie where May West spoke the line "Come up and see me sometime" , called She Done Him Wrong, who was her co-star?', 'W.C. Fields', 'Cary Grant', 'James Stewart', 'John Wayne', 1, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (25, 'Clint Eastwood gave us the immortal line, "Go ahead... make my day", in what film?', 'Dirty Harry', 'Magnum Force', 'Sudden Impact', 'Tightrope', 0, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (26, 'In the 1951 science fiction movie, The Day The Earth Stood Still, what was the name of the robot?', 'Gort', 'Klaatu', 'Robby', 'Bender', 0, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (27, 'Jack Walsh and Jonathan Mardukas  are the names of the two main characters in what movie?', 'Midnight Cowboy', 'Midnight Express', 'Midnight Run', 'Midnight Sun', 2, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (28, 'What is the film crew''s chief electrician called?', 'big L', 'gaffer', 'sparks', 'ignition', 1, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (29, 'After winning the 1988 Oscar, who said "I never thought I''d have a nomination... I never thought anybody ever took any of my pictures seriously"?', 'Cher', 'Jonny Depp', 'Shirley Maclaine', 'Jodie Foster', 3, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (30, 'In the 1946 movie "The She-Wolf of London", who played the title role?', 'Eva Gabor','Boris Karloff', 'June Lockhart', 'Chris Coff', 0, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (31, 'In the Dirty Harry movies starring Clint Eastwood as Dirty Harry, what was Harry''s last name?', 'Callahan', 'Flint', 'Harrigan', 'Steele', 0, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (32, 'Blondie''s "Call Me" , a number one hit for her, was the theme song of which film?', 'American Gigolo', 'An Officer and a Gentleman', 'Sorry, Wrong Number', 'Bertigo', 0, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (33, 'How much of his own money did Francis Ford Coppola put up to finish the movie  "Apocalypse Now" when it ran wildly over budget?', '$1 million', '$6 million', '$16 million', '$25 million', 2, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (34, 'What was the name of the last movie that John Wayne appeared in?', 'The Green Berets', 'The Shootist', 'True Grit', 'Psycho', 1, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (35, 'In the Friday the 13th movies, what is the name of the masked killer?', 'Freddy', 'Jason', 'Merlin', 'He has no name', 1, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (36, 'What  1987 film was based on a novel called The Short Timers by Gustav Hasford?', 'Angel Heart', 'Broadcast News', 'Fatal Attraction', 'Full Metal Jacket', 3, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (37, 'Which of the following actors has the middle name "DeForest"?', 'Humphrey Bogart', 'James Cagney', 'Clint Eastwood', 'Burt Lancaster', 0, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (38, 'What was the name of the island on which King Kong was discovered in the original 1933 movie?', 'Ape Island', 'Borneo', 'Monster Island', 'Skull Island', 3, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (39, 'In the movie Who Framed Roger Rabbit, which pair of genetically similar characters perform a piano duet?', 'Bambi and Bullwinkle', 'Donald Duck and Daffy Duck', 'Garfield and Sylvester', 'Speedy Gonzales and Minnie Mouse', 1, (SELECT id from categories WHERE category_name = 'MovieQuiz')),
  (40, 'Julie Andrews won the Academy Award for  best actress in what film?', 'Mary Poppins', 'The Sound of Music', 'Victor/Victoria', 'Mandy Patinkin', 0, (SELECT id from categories WHERE category_name = 'MovieQuiz'));


-- --------------------------------------------------------

--
-- Table structure for table `testhistory`
--

CREATE TABLE IF NOT EXISTS `testhistory` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `right_answers` int(11) NOT NULL,
  `wrong_answers` int(11) NOT NULL,
  `unanswers` int(11) NOT NULL,
  `total_problems` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (category_id) REFERENCES categories(id),
  FOREIGN KEY (student_id) REFERENCES students(id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

--
-- Dumping data for table `testhistory`
--

INSERT INTO `testhistory` (`id`, `category_id`, `right_answers`, `wrong_answers`, `unanswers`, `total_problems`, `student_id`) VALUES
  (1, (SELECT id from categories WHERE category_name = 'CanadaQuiz'), 3, 7, 0, 10, (SELECT id from students WHERE login_id = 'admin'));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
