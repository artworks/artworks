CREATE DEFINER=`root`@`localhost` PROCEDURE `migrate_prospects_to_customers`(IN profileId INT)
BEGIN
	SET SESSION TRANSACTION ISOLATION LEVEL SERIALIZABLE;
	SET @uid = '';
	START TRANSACTION;
	select uid into @uid from signup.subscribers where id=profileId;
	insert into customers (
company,
dialing_code,
email,
FKidgender,
name,
phone,
password,
password_hash,
surname,
created_at,
updated_at
  ) 
	select
		profile.company,
profile.dialing_code,
profile.email,
profile.FKidgenderfromprospect,
profile.name,
profile.phone,
profile.password,
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

END