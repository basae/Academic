IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[getGroupsById]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].getGroupsById

GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

create procedure getGroupsById
(
@id int
)
as
begin 
select *from groupanswer where id=@id
end