IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[getusersbyid]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].[getusersbyid]

GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

create procedure getusersbyid
(
@id int
)
as
begin
select *from subscriber where id=@id
end