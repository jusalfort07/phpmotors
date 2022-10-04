-- QUERY 1
INSERT INTO 
    phpmotors.clients (clientFirstName, clientLastName, clientEmail, clientPassword, comment)
VALUES
	("Tony", "Stark", "tony@starkent.com", "Iam1ronM@n", "I am the real Ironman")


-- QUERY 2
UPDATE 
	phpmotors.clients
SET
	clientLevel = "3"
WHERE
	clientFirstName = "Tony" AND clientLastName = "Stark"

-- QUERY 3
UPDATE
	phpmotors.inventory
SET
	invDescription = REPLACE(invDEscription, "small", "spacious")
WHERE
	invMake = "GM" AND invModel = "Hummer"

-- QUERY 4
SELECT
	carclassification.classificationName, inventory.invMake, inventory.invModel, inventory.invDescription
FROM
	phpmotors.inventory
INNER JOIN
	phpmotors.carclassification on inventory.classificationId = carclassification.classificationId
WHERE
	carclassification.classificationName = "SUV"

-- QUERY 5
DELETE
FROM
	phpmotors.inventory
WHERE
	invMake = "Jeep" AND invModel = "Wrangler"

-- QUERY 6
UPDATE
	phpmotors.inventory
SET
	invImage = CONCAT('/phpmotors', invImage), invThumbnail = CONCAT('/phpmotors', invThumbnail)