IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[SaveLoginUser]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].SaveLoginUser

GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

create procedure SaveLoginUser
(
@subscriberid int,
token varchar(50) output
)
as
begin
if(@id>0)
BEGIN
update loginuser
set token=@token,
lastlogin=getdate()
where userid=@subscriberid;
set @token=@token;
END
else
insert into loginuser(userid,token,lastlogin) values(
@userid,@token,GETDATE())
set @token=@token; 
end