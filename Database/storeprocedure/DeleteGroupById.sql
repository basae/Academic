IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[DeleteGroupById]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].DeleteGroupById

GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

create procedure DeleteGroupById
(
@id int
)
as
begin 
delete from groupanswer where id=@id
end