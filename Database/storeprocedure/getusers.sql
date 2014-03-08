IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[getusers]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].[getusers]

GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

create procedure getusers
as
begin
select *from subscriber
end