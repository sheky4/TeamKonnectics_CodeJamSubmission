DROP Database IF EXISTS KitchenKonnect;
CREATE Database KitchenKonnect;
Use KitchenKonnect;

CREATE TABLE grocery(
	groceryID	int(11) AUTO_INCREMENT UNIQUE NOT NULL,
	username	varchar(255),
	password	varchar(255),
	email 		varchar(255) UNIQUE,
	supermarket	varchar(255),
	busRegCert	varchar(1000),
	other		varchar(1000),
	activationCode varchar(255), 
	status int(11),
	primary key(groceryID)
);

CREATE TABLE list(
	listID	int(11) AUTO_INCREMENT UNIQUE NOT NULL,
	listDate	date,
	customerListID	int(11),
	customerNumber 		varchar(255),
	groceryID	int(11),
	status varchar(255),
	primary key(listID),
	foreign key (groceryID) REFERENCES grocery(groceryID)
);

CREATE TABLE item(
	itemID	int(11)AUTO_INCREMENT UNIQUE NOT NULL,
	itemName	varchar(255),
	category	varchar(255),
	primary key(itemID)
);

CREATE TABLE listItems(
	listItemsID int(11)AUTO_INCREMENT UNIQUE NOT NULL,
	itemID	int(11),
	listID 		int(11),
	quantity	int(11),
	primary key(listItemsID),
	foreign key (itemID) REFERENCES item(itemID),
	foreign key (listID) REFERENCES list(listID)
);









