IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[DeleteAnswer]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].DeleteAnswer

GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

create procedure DeleteAnswer
(
@id int
)
as
begin 
delete from answer where id=@id
end