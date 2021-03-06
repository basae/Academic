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
select groupanswer.id,subscriber.id as subscriberid,(subscriber.firstname+' '+subscriber.lastname) as subscribername,groupanswer.topic,groupanswer.creationDate
from groupanswer inner join subscriber on subscriber.id=groupanswer.subscriberId

end