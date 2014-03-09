IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[getAnswerById]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].getAnswerById

GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

create procedure getAnswerById
(
@id int
)
as
begin 
select *from answer where id=@id
end