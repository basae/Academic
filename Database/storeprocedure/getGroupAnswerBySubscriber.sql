IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[getGroupsBySubscriber]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].getGroupsBySubscriber

GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

create procedure getGroupsBySubscriber
(
@subscriberid int
)
as
begin
select groupanswer.id,subscriber.id as subscriberid,(subscriber.firstname+' '+subscriber.lastname) as subscribername,groupanswer.topic,groupanswer.creationDate
from groupanswer inner join subscriber on subscriber.id=groupanswer.subscriberId where groupanswer.subscriberId=@subscriberid

end