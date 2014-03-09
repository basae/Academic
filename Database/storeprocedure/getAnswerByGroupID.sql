IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[getAnswerByIdGroup]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].getAnswerByIdGroup

GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

create procedure getAnswerByIdGroup
(
@id int
)
as
begin 
select *from answer where groupId=@id
end