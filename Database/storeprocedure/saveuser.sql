IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[saveuser]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].[saveuser]

GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

create procedure saveuser
(
@id int out,
@username varchar(50),
@pass varchar(50),
@firstname varchar(50),
@lastname varchar(50),
@email varchar(50),
@school varchar(50)
)
as
begin
if(@id>0)
BEGIN
update subscriber
set username=@username,
pass=@pass,
firstname=@firstname,
lastname=@lastname,
email=@email,
school=@school where id=@id;
set @id=0;
END
else
insert into subscriber(username,pass,firstname,lastname,email,school,regDate) values(
@username,@pass,@firstname,@lastname,@email,@school,GETDATE())
set @id=scope_identity(); 
end