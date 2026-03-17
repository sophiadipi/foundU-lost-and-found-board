-- Create the foundU database 
DROP DATABASE IF EXISTS foundU;
CREATE DATABASE foundU;
USE foundU;

CREATE TABLE universities (
	universityID	int(11)			NOT NULL	AUTO_INCREMENT,
	fullName		varchar(100)	NOT NULL,
	shortName		varchar(20)		NOT NULL,
	city			varchar(100)	NOT NULL,
	PRIMARY KEY (universityID)
);

INSERT INTO universities
VALUES
	(1, 'Algoma University', 'AlgomaU', 'Sault Ste. Marie'),
	(2, 'Brock University', 'BrockU', 'St. Catharines'),
	(3, 'Carleton University', 'CarletonU', 'Ottawa'),
	(4, 'Lakehead University', 'LakeheadU', 'Thunder Bay'),
	(5, 'Laurentian University', 'LaurentianU', 'Sudbury'),
	(6, 'McMaster University', 'MacU', 'Hamilton'),
	(7, 'Nipissing University', 'NipissingU', 'North Bay'),
	(8, 'Northern Ontario School of Medicine', 'NOSM', 'Thunder Bay'),
	(9, 'Ontario College of Art & Design University', 'OCAD', 'Toronto'),
	(10, 'Ontario Tech University', 'OTech', 'Oshawa'),
	(11, 'Queen''s University', 'Queen''s', 'Kingston'),
	(12, 'Royal Military College of Canada', 'RMC', 'Kingston'),
	(13, 'Toronto Metropolitan University', 'TMU', 'Toronto'),
	(14, 'Trent University', 'TrentU', 'Peterborough'),
	(15, 'University of Guelph', 'UofG', 'Guelph'),
	(16, 'Université de Hearst', 'UdeH', 'Hearst'),
	(17, 'Université de l''Ontario français', 'UOF', 'Toronto'),
	(18, 'University of Ottawa', 'uOttawa', 'Ottawa'),
	(19, 'University of Toronto', 'UofT', 'Toronto'),
	(20, 'University of Waterloo', 'uWaterloo', 'Waterloo'),
	(21, 'University of Windsor', 'uWin', 'Windsor'),
	(22, 'Western University', 'UWO', 'London'),
	(23, 'Wilfrid Laurier University', 'WLU', 'Waterloo'),
	(24, 'York University', 'York', 'Toronto');
	
	CREATE TABLE users (
		userID			int(11)			NOT NULL	AUTO_INCREMENT,
		firstName		varchar(50)		NOT NULL,
		lastName		varchar(50)		NOT NULL,
		universityID	int(11)			NOT NULL,
		email			varchar(255)	NOT NULL	UNIQUE,
		phone			varchar(20)		NOT NULL,
		passwordHash	varchar(255)	NOT NULL,
		PRIMARY KEY (userID),
		FOREIGN KEY (universityID) REFERENCES universities(universityID)
	);
	
	INSERT INTO users
	VALUES
		(1, 'Sophia', 'DiPietro', 22, 'sophiad.913@gmail.com', '289-684-8843', 'testing123'),
		(2, 'Angela', 'Dakran', 6, 'angeladakran@gmail.com', '289-700-2195', 'testing123'),
		(3, 'Ariana', 'Wilson', 1, 'ariangawilson@hotmail.com', '416-389-4001', 'testing123'),
		(4, 'Jacob', 'Cullen', 2, 'j_cullen@outlook.com', '513-255-6578', 'testing123'),
		(5, 'Olivia', 'Rodrigo', 3, 'oliviarodrigo98@gmail.com', '289-987-3768', 'testing123'),
		(6, 'Andre', 'Sousa', 4, 'asousa@hotmail.com', '905-887-7135', 'testing123'),
		(7, 'Alison', 'Whitman', 5, 'alison_whitman@hotmail.com', '817-986-5543', 'testing123'),
		(8, 'Brianne', 'DeSantis', 7, 'bdesantis@outlook.com', '416-433-8890', 'testing123'),
		(9, 'Bradey', 'Paul', 8, 'bradeyp@gmail.com', '289-113-4442', 'testing123'),
		(10, 'Rita', 'Hassan', 9, 'ritahassan@hotmail.com', '905-112-2214', 'testing123'),
		(11, 'Karina', 'Smith', 10, 'ksmith@gmail.com', '613-778-9543', 'testing123'),
		(12, 'Adrian', 'Dunn', 11, 'adrian_dunn@gmail.com', '815-945-4435', 'testing123'),
		(13, 'Emilio', 'Santucci', 12, 'e_santucci@hotmail.com', '905-132-5465', 'testing123'),
		(14, 'Maya', 'LeClerc', 13, 'mayal@gmail.com', '215-886-5643', 'testing123'),
		(15, 'Justin', 'Demerling', 14, 'jdemerling@gmail.com', '453-885-4365', 'testing123'),
		(16, 'Sarah', 'DeSouza', 15, 'sarahdesouza@hotmail.com', '416-889-0756', 'testing123'),
		(17, 'Mike', 'Jones', 16, 'mike_jones@gmail.com', '905-684-3882', 'testing123'),
		(18, 'Maria', 'Scott', 17, 'mscott@gmail.com', '356-889-0085', 'testing123'),
		(19, 'Sydney', 'Smith', 18, 'sydney_smith@hotmail.com', '916-995-6785', 'testing123'),
		(20, 'Vanessa', 'Baldwin', 19, 'v_baldwin@gmail.com', '715-554-3254', 'testing123'),
		(21, 'Vince', 'Kessel', 20, 'vince_kessel@hotmail.com', '985-445-3456', 'testing123'),
		(22, 'Shania', 'Twain', 21, 'shania@hotmail.com', '905-665-4903', 'testing123'),
		(23, 'Eddie', 'Lemieux', 23, 'eddie_l@outlook.com', '865-112-1123', 'testing123'),
		(24, 'Hunter', 'Jackson', 24, 'hjackson@gmail.com', '905-111-1367', 'testing123'),
		(25, 'Peter', 'Parker', 6, 'peterp@hotmail.com', '289-005-5543', 'testing123'),
		(26, 'Patty', 'Cake', 22, 'pattyc@gamil.com', '905-998-0006', 'testing123');
	
	CREATE TABLE itemCategories (
		categoryID		int(11)			NOT NULL	AUTO_INCREMENT,
		categoryName	varchar(50)		NOT NULL	UNIQUE,
		PRIMARY KEY (categoryID)
	);

	INSERT INTO itemCategories
	VALUES 
		(1, 'Electronics'),
		(2, 'Keys'),
		(3, 'Wallets'),
		(4, 'Cards'),
		(5, 'Bags'),
		(6, 'Clothing'),
		(7, 'Jewelry'),
		(8, 'Books'),
		(9, 'Bottles'),
		(10, 'Glasses'),
		(11, 'Other');
	
	CREATE TABLE listings (
		listingID			int(11)					NOT NULL	AUTO_INCREMENT,
		itemName			varchar(100)			NOT NULL,
		itemDescription		varchar(2000)			NOT NULL,
		universityID		int(11)					NOT NULL,
		listingType			enum('lost', 'found')	NOT NULL,
		imagePath		    varchar(200),
		categoryID			int(11)					NOT NULL,
		userID				int(11)					NOT NULL,
		dateLostOrFound		datetime				NOT NULL,
		datePosted			datetime				NOT NULL	DEFAULT CURRENT_TIMESTAMP,
		status				enum('open', 'closed')	NOT NULL	DEFAULT 'open',
		PRIMARY KEY (listingID),
		FOREIGN KEY (universityID) REFERENCES universities(universityID),
		FOREIGN KEY (categoryID) REFERENCES itemCategories(categoryID),
		FOREIGN KEY (userID) REFERENCES users(userID)
	);
	
	INSERT INTO listings
	VALUES
		(1, 'Apple AirPods', 'Lost my AirPods at Thode Library. They are in a purple checkered case.', 
				6, 'lost', NULL, 1, 2, '2026-02-15 00:00:00', '2026-02-16 02:31:00', 'open'),
		(2, 'Gatorade Water Bottle', 'I found this gatorade water bottle in Shingwauk Hall. 
				There is a name written on the bottom. I will only return it if you can verify 
				the name.', 1, 'found', '/FoundUApp/images/listingImages/gatoradeBottle.jpg', 9,
				3, '2026-03-01 00:00:00', '2026-03-02 00:00:00', 'open'),
		(3, 'Gold Bee Necklace', 'I found this gold bee necklace in Currie Hall.', 12, 'found', 
				'/FoundUApp/images/listingImages/beeNecklace.jpg', 7, 13, '2026-03-01 00:00:00',
				'2026-03-01 00:00:00', 'open'),
		(4, 'Apple AirPods', 'I found these AirPods at Thode Library.', 6, 'found', 
				'/FoundUApp/images/listingImages/airpods.png', 1, 1, '2020-02-16 00:00:00', 
				'2020-02-16 00:00:00', 'open'),
		(5, 'Ontario Driver''s License', 'I found a driver''s license today in the library. I did 
				not want to post a real photo of it for privacy reasons. If you think it''s yours, 
				please submit a claim and we can get in contact.', 8, 'found', 
				'/FoundUApp/images/listingImages/driversLicense.jpg', 4, 4, '2025-01-16 00:00:00', 
				'2025-01-16 00:00:00', 'open'),
		(6, 'Genetics Textbook', 'I lost my genetics textbook at Weldon library. I don''t have a photo of it,
				but my name is written on the inside cover.', 22, 'lost', NULL, 8, 1, '2025-10-30 00:00:00', 
				'2025-10-30 00:00:00', 'open'),
		(7, 'Gold Hoop Earrings', 'I found these gold hoop earrings in the women''s changeroom at the rec centre.',
				3, 'found', '/FoundUApp/images/listingImages/goldEarrings.png', 7, 6, '2026-01-13 00:00:00', 
				'2026-01-13 00:00:00', 'open'),
		(8, 'Genetics Textbook', 'I found this textbook at Weldon Library today. There is a name printed on the inside cover.', 22,
				'found', '/FoundUApp/images/listingImages/geneticsTextbook.jpg', 8, 26, '2025-11-01 00:00:00', '2025-11-01 00:00:00',
				'open'),
		(9, 'University of Windsor Graduation Ring', 'I lost my graduation ring yesterday. I think it fell off while I was
				working out at the rec centre.', 21, 'lost', '/FoundUApp/images/listingImages/graduationRing.png', 7, 22, '2024-02-23 00:00:00',
				'2024-02-23 00:00:00', 'open'),
		(10, 'Honda Key Fob', 'I found this Honda key fob at the Goodman School of Business.', 2, 'found', 
				'/FoundUApp/images/listingImages/hondaKeyFob.png', 2, 8, '2026-02-01 00:00:00', '2026-02-01 00:00:00', 'open'),
		(11, 'Apple iPhone 15 Pro', 'I found this iPhone 15 pro in the Health Sciences Building. It is a green phone in 
				a green leather case.', 8, 'found', '/FoundUApp/images/listingImages/iPhone15Pro.png', 1, 9, 
				'2025-12-07 00:00:00', '2025-12-07 00:00:00', 'open'),
		(12, 'Kate Spade Eyeglasses', 'I lost my glasses. I think I may have taken them off while I was 
				exercising at the rec centre and forgot to put them back on.', 4, 'lost', 
				'/FoundUApp/images/listingImages/kateSpadeGlasses.png', 10, 10, '2026-01-27 00:00:00', '2026-01-28 00:00:00', 'open'),
		(13, 'Keys', 'I found these keys in the library parking lot.', 5, 'found', '/FoundUApp/images/listingImages/keys.png',
				2, 11, '2026-02-07 00:00:00', '2026-02-07 00:00:00', 'open'),
		(14, 'Navy Blue Longchamp Tote Bag', 'I lost my navy blue Longchamp tote bag. I think I left it in the library.', 
				7, 'lost', '/FoundUApp/images/listingImages/longchampBag.png', 5, 12, '2025-11-15 00:00:00', '2025-11-15 00:00:00', 'open'),
		(15, 'Lululemon Belt Bag', 'I lost found this brown lululemon fanny pack today. You will have to verify personal 
				belongings inside the bag to claim.', 9, 'found', '/FoundUApp/images/listingImages/lululemonBeltBag.png', 5, 10,
				'2026-03-03 00:00:00', '2026-03-04 00:00:00', 'open'),
		(16, 'Macbook Air Space Grey', 'I found this space grey macbook air at the Gryphon Centre.', 15, 'found', 
				'/FoundUApp/images/listingImages/macbook.jpg', 1, 16, '2026-01-22 00:00:00', '2026-01-22 00:00:00', 'open'),
		(17, 'Mackbook Pro Rose Gold with Denim Case', 'I found this rose gold macbook pro with a denim case on it at Watson Hall.',
				11, 'found', '/FoundUApp/images/listingImages/macbookWithCase.jpg', 1, 12, '2025-03-05 00:00:00', 
				'2025-03-05 00:00:00', 'open'),
		(18, 'McMaster Engineering Jacket', 'Found this engineering jacket in the men''s change room at David Braley. 
				There''s a name written on the tag.', 6, 'found', '/FoundUApp/images/listingImages/macEngineeringJacket.jpg', 6, 25,
				'2026-03-15 00:00:00', '2026-03-15 00:00:00', 'open'),
		(19, 'Mat and Nat Brown Leather Backpack', 'I found this Mat and Nat brown leather backpack in the women''s changeroom at the rec centre.',
				18, 'found', '/FoundUApp/images/listingImages/matAndNatBackpack.png', 5, 19, '2026-03-13 00:00:00', '2026-03-13 00:00:00', 'open'),
		(20, 'McMaster Football Jersey', 'I lost my Mac football jersey. I think I may have left it on the field after my game.', 6, 'lost',
				'/FoundUApp/images/listingImages/mcmasterJersey.png', 6, 25, '2026-03-07 00:00:00', '2026-03-08 00:00:00', 'open'),
		(21, 'Brown Leather Fossil Wallet', 'Found this men''s fossil wallet in the parking lot. Have to verify ID to claim.', 20, 'found', 
				'/FoundUApp/images/listingImages/menFossilWallet.jpg', 3, 21, '2025-12-12 00:00:00', '2025-12-13 00:00:00', 'open'),
		(22, 'Nalgene Water Bottle', 'I found this green Nalgene water bottle at the library.', 24, 'found', '/FoundUApp/images/listingImages/nalgene.jpg',
				9, 24, '2024-12-11 00:00:00', '2024-12-12 00:00:00', 'open'),
		(23, 'Black Nike Backpack', 'I accidentally left my black nike backpage in the bleachers after the game today, but it was gone when I went back for it.', 
				17, 'lost', '/FoundUApp/images/listingImages/nikeBackpack.png', 5, 18, '2026-02-25 00:00:00', '2026-02-25 00:00:00', 'open'),
		(24, 'Oakley Sunglasses', 'Found these Oakley sunglasses on the sidewalk near the rec centre.', 10, 'found', 
				'/FoundUApp/images/listingImages/oakleySunglasses.png', 10, 11, '2026-03-09 00:00:00', '2026-03-09 00:00:00', 'open'),
		(25, 'Computer Science Textbook', 'Found this textbook titled "Murach''s PHP and MySQL" at the library. The owner''s name is written on the inside cover.',
				20, 'found', '/FoundUApp/images/listingImages/phpAndMySQL.png', 8, 21, '2026-02-18 00:00:00', '2026-02-19 00:00:00', 'open'),
		(26, 'Intro to Psychology Textbook', 'I lost my psychology textbook. I think I left it in the lecture hall.', 23, 'lost', 
				'/FoundUApp/images/listingImages/psychologyTextbook.jpg', 8, 23, '2026-03-10 00:00:00', '2026-03-11 00:00:00', 'open'),
		(27, 'Pink Fossil Wallet', 'Found this pink fossil wallet in the bookstore today. You will have to confirm your ID to claim.', 14, 'found', 
				'/FoundUApp/images/listingImages/pinkFossilWallet.png', 3, 15, '2026-03-14 00:00:00', '2026-03-14 00:00:00', 'open'),
		(28, 'Queen''s Crewneck', 'Found this navy blue crewneck in the men''s changeroom at the rec centre.', 11, 'found', 
				'/FoundUApp/images/listingImages/queensSweater.png', 6, 12, '2026-03-08 00:00:00', '2026-03-08 00:00:00', 'open'),
		(29, 'Ralph Lauren Eyeglasses', 'I lost my purple Ralph Lauren glasses. I''m pretty sure I left them at the library.', 5, 'lost',
				'/FoundUApp/images/listingImages/ralphLaurenGlasses.png', 10, 7, '2026-03-04 00:00:00', '2026-03-04 00:00:00', 'open');
	
	CREATE TABLE claims (
		claimID			int(11)									NOT NULL	AUTO_INCREMENT,
		listingID		int(11)									NOT NULL,
		userID			int(11)									NOT NULL,
		message			varchar(2000)							NOT NULL, 
		status			enum('approved', 'rejected', 'pending')	NOT NULL	DEFAULT 'pending',
		dateSubmitted	datetime								NOT NULL	DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (claimID),
		FOREIGN KEY (listingID) REFERENCES listings(listingID),
		FOREIGN KEY (userID) REFERENCES users(userID)
	);
	
	INSERT INTO claims 
	VALUES
		(1, 1, 1, 'I think I found your AirPods. Send me an email and we can arrange a safe meetup.','pending', '2026-02-17 00:00:00');
		
		
	
	