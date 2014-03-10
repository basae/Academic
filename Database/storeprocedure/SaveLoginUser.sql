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
@token varchar(50) output
)
as
begin
if exists(select userid from loginuser where userid=@subscriberid)
BEGIN
update loginuser
set token=@token,
lastlogin=GETDATE() where userid=@subscriberid;
set @token=@token;
END
else
begin
insert into loginuser(userid,token,lastlogin) values(
@subscriberid,@token,GETDATE())
set @token=@token;
end
end