DROP PROCEDURE IF EXISTS migrate_prospects_to_customers;
DELIMITER |
CREATE  PROCEDURE `migrate_prospects_to_customers`(IN profileId INT)
BEGIN

	SET SESSION TRANSACTION ISOLATION LEVEL SERIALIZABLE;
	START TRANSACTION;
	insert into customers (
company,
FKiddialing_codefromcustomers,
email,
FKidgender,
name,
phone,
password,
FKidcustomer_status,
password_hash,
surname,
created_at,
updated_at
  ) 
	select
		profile.company,
profile.FKiddialing_codefromprospects,
profile.email,
profile.FKidgenderfromprospect,
profile.name,
profile.phone,
profile.password,
1,
profile.password_hash,
profile.surname,
now(),
now()
		from prospects as profile
		where profile.idprospects = profileId;
	
SET @insertedId = 0;

	
SELECT LAST_INSERT_ID() INTO @insertedId;
SELECT FKidgeolocationfromprospect INTO @geolocationID from prospects WHERE idprospects = profileId;

insert into customers_address_list (
	FKidgeolocationfromaddresslist,
  FKidcustomersfromaddresslist,
  FKidaddress_type
	) 
	select	
		profile.FKidgeolocationfromprospect,
		@insertedId,
		1    
		from prospects as profile
		where profile.idprospects = profileId;

	delete from prospects where idprospects=profileId;


	COMMIT;

	SELECT @insertedId;

END;
