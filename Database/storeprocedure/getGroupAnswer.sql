IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[getGroups]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].getGroups

GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

create procedure getGroups
as
begin
select *from groupanswer
end