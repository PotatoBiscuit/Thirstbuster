--Clear All DB Information--
TRUNCATE TABLE customer;
TRUNCATE TABLE drink;
TRUNCATE TABLE tab;
TRUNCATE TABLE tab_drinks;
TRUNCATE TABLE venue;

--Create at least 2 venues, and 10 different drinks, 5 per venue--
--The following code gives each venue 6 orders, and gives each order 2-3 drinks, and creates 5 customers--

--Create Customers--
INSERT INTO `customer`(`credit`, `name`, `username`, `password`) VALUES ('5555555555555555','Adam','Adam1','1234');
INSERT INTO `customer`(`credit`, `name`, `username`, `password`) VALUES ('5555555555555555','Bob','Bob1','1234');
INSERT INTO `customer`(`credit`, `name`, `username`, `password`) VALUES ('5555555555555555','Charlie','Charlie1','1234');
INSERT INTO `customer`(`credit`, `name`, `username`, `password`) VALUES ('5555555555555555','Steve','Steve1','1234');
INSERT INTO `customer`(`credit`, `name`, `username`, `password`) VALUES ('5555555555555555','Henry','Henry1','1234');

--Create Orders--
INSERT INTO `tab`(`venue_id`, `customer_id`, `table_number`, `start_time`, `status`) VALUES (1,1,'0',NOW() - INTERVAL 5 MINUTE,'Ordered');
INSERT INTO `tab`(`venue_id`, `customer_id`, `table_number`, `start_time`, `status`) VALUES (1,2,'10',NOW() - INTERVAL 15 MINUTE,'Ordered');
INSERT INTO `tab`(`venue_id`, `customer_id`, `table_number`, `start_time`, `status`) VALUES (1,3,'14',NOW() - INTERVAL 30 MINUTE,'Ordered');
INSERT INTO `tab`(`venue_id`, `customer_id`, `table_number`, `start_time`, `status`) VALUES (1,4,'3',NOW() - INTERVAL 60 MINUTE,'Ordered');
INSERT INTO `tab`(`venue_id`, `customer_id`, `table_number`, `start_time`, `status`) VALUES (1,5,'2',NOW() - INTERVAL 0 MINUTE,'Ordered');
INSERT INTO `tab`(`venue_id`, `customer_id`, `table_number`, `start_time`, `status`) VALUES (1,1,'1',NOW() - INTERVAL 2 MINUTE,'Ordered');
INSERT INTO `tab`(`venue_id`, `customer_id`, `table_number`, `start_time`, `status`) VALUES (2,2,'11',NOW() - INTERVAL 5 MINUTE,'Ordered');
INSERT INTO `tab`(`venue_id`, `customer_id`, `table_number`, `start_time`, `status`) VALUES (2,3,'0',NOW() - INTERVAL 15 MINUTE,'Ordered');
INSERT INTO `tab`(`venue_id`, `customer_id`, `table_number`, `start_time`, `status`) VALUES (2,4,'2',NOW() - INTERVAL 30 MINUTE,'Ordered');
INSERT INTO `tab`(`venue_id`, `customer_id`, `table_number`, `start_time`, `status`) VALUES (2,5,'6',NOW() - INTERVAL 60 MINUTE,'Ordered');
INSERT INTO `tab`(`venue_id`, `customer_id`, `table_number`, `start_time`, `status`) VALUES (2,1,'9',NOW() - INTERVAL 0 MINUTE,'Ordered');
INSERT INTO `tab`(`venue_id`, `customer_id`, `table_number`, `start_time`, `status`) VALUES (2,2,'10',NOW() - INTERVAL 2 MINUTE,'Ordered');

--Create Drink Orders--
--Order 1--
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (1,6,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (1,9,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (1,7,'Waiting','');

--Order 2--
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (2,8,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (2,10,'Waiting','');

--Order 3--
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (3,9,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (3,7,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (3,6,'Waiting','');

--Order 4--
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (4,8,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (4,10,'Waiting','');

--Order 5--
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (5,6,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (5,7,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (5,8,'Waiting','');

--Order 6--
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (6,8,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (6,8,'Waiting','');

--Order 7--
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (7,1,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (7,2,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (7,3,'Waiting','');

--Order 8--
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (8,5,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (8,4,'Waiting','');

--Order 9--
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (9,3,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (9,2,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (9,1,'Waiting','');

--Order 10--
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (10,1,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (10,1,'Waiting','');

--Order 11--
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (11,2,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (11,2,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (11,2,'Waiting','');

--Order 12--
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (12,3,'Waiting','');
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES (12,3,'Waiting','');

--Placeholder Inserts For Each Table--

--Customer--
INSERT INTO `customer`(`credit`, `name`, `username`, `password`) VALUES ('','','','');

--Drink--
INSERT INTO `drink`(`venue_id`, `cost`, `name`, `type`, `description`) VALUES ('','','','','');

--Tab--
INSERT INTO `tab`(`venue_id`, `customer_id`, `table_number`, `start_time`, `status`) VALUES ('','','','','');

--Tab Drinks--
INSERT INTO `tab_drinks`(`tab_id`, `drink_id`, `drink_status`, `special_instructions`) VALUES ('','','','');

--Venue--
INSERT INTO `venue`(`address`, `city`, `state`, `zip`, `password`, `name`, `credit`, `login_name`) VALUES ('','','','','','','','')
