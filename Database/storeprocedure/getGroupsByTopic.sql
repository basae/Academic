IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[getGroupsByTopic]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].getGroupsByTopic

GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

create procedure getGroupsByTopic
(
@topic varchar(300)
)
as
begin 
select groupanswer.id,subscriber.id as subscriberid,(subscriber.firstname+' '+subscriber.lastname) as subscribername,groupanswer.topic,groupanswer.creationDate
from groupanswer inner join subscriber on subscriber.id=groupanswer.subscriberId where groupanswer.topic like @topic+'%'
end