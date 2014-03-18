USE [academicanswers]
GO

/****** Object:  StoredProcedure [dbo].[getGroupsBySubscriber]    Script Date: 15/03/2014 09:49:05 p.m. ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO


create procedure [dbo].[getGroupsBySubscriber]
(
@subscriberid int
)
as
begin
select groupanswer.id,subscriber.id as subscriberid,(subscriber.firstname+' '+subscriber.lastname) as subscribername,groupanswer.topic,groupanswer.creationDate
from groupanswer inner join subscriber on subscriber.id=groupanswer.subscriberId where groupanswer.subscriberId=@subscriberid order by groupanswer.topic

end
GO


