IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[getUserByToken]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].getUserByToken

GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

create procedure getUserByToken
(
@username varchar(50),
@password varchar(50)
)
as
begin
select *from subscriber where username=@username and pass=@password
end