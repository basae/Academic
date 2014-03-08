IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[deleteuser]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].deleteuser

GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

create procedure deleteuser
(
@id int
)
as
begin
delete from subscriber where id=@id
end