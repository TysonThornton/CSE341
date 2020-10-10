# Creating USER table
CREATE TABLE public.user
(
	userID SERIAL NOT NULL PRIMARY KEY,
	username VARCHAR(100) NOT NULL UNIQUE,
	password VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL UNIQUE
);


# Creating the VINYL table
CREATE TABLE public.vinyl
(
	vinylID SERIAL NOT NULL PRIMARY KEY,
	band VARCHAR(100) NOT NULL,
	albumn VARCHAR(100) NOT NULL,
	year INT NOT NULL,
	condition VARCHAR(100),
	genre VARCHAR(100),
	userID INT NOT NULL REFERENCES public.user(userID)
);


# Creating the IMAGE table
CREATE TABLE public.image
(
	imageID SERIAL NOT NULL PRIMARY KEY,
	imageName VARCHAR(100) NOT NULL,
	imagePath VARCHAR(100) NOT NULL,
	vinylID INT NOT NULL REFERENCES public.vinyl(vinylID)
);


# Add foreign key constraint to VINYL table for Image
ALTER TABLE public.vinyl ADD COLUMN
imageID INT NOT NULL REFERENCES public.image(imageID);


# Creating WISHLIST table
CREATE TABLE public.wishlist
(
	wishlistID SERIAL NOT NULL PRIMARY KEY,
	price FLOAT NOT NULL,
	notes TEXT,
	vinylID INT NOT NULL REFERENCES public.vinyl(vinylid)
);
