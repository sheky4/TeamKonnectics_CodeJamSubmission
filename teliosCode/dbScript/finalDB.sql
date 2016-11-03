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

CREATE TABLE category(
	catID int (11) AUTO_INCREMENT UNIQUE, 
	catDescription varchar (255) NOT NULL,
	primary key (catID)
);

CREATE TABLE customer(
	customerID	int(11) AUTO_INCREMENT UNIQUE NOT NULL,
	email	varchar(255) UNIQUE,
	password	varchar(255),
	activationCode varchar(255), 
	status int(11),
	primary key(customerID)
);

CREATE TABLE list(
	listID	int(11) AUTO_INCREMENT UNIQUE NOT NULL,
	listName varchar (255) NOT NULL,
	listDate	date,
	triggered int(5),
	catID int (11),
	groceryID	int(11),
	customerID int(11),
	status varchar(255),
	groceryAccess varchar(255),
	primary key(listID),
	foreign key (groceryID) REFERENCES grocery(groceryID),
	foreign key (catID) REFERENCES category(catID),
	foreign key (customerID) REFERENCES customer(customerID)
	
);

CREATE TABLE item(
	itemID	int(11)AUTO_INCREMENT UNIQUE NOT NULL,
	itemName	varchar(255),
	itemDescription	varchar(255),
	catID	int(11),
	primary key(itemID),
	FOREIGN KEY (catID) REFERENCES category(catID)
);

CREATE TABLE listItems(
	
	itemID	int(11),
	listID 		int(11),
	quantity	int(11),
	primary key(itemID,listID),
	foreign key (itemID) REFERENCES item(itemID),
	foreign key (listID) REFERENCES list(listID)
);
