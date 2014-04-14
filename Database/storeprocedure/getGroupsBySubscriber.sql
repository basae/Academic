USE [academicanswers]
GO

/****** Object:  StoredProcedure [dbo].[getGroupsBySubscriber]    Script Date: 15/03/2014 09:49:05 p.m. ******/
SET ANSI_NULLS ON
GO
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[getGroupsBySubscriber]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].getGroupsBySubscriber
SET QUOTED_IDENTIFIER OFF
GO


create procedure [dbo].[getGroupsBySubscriber]
(
@subscriberid int
)
as
begin
select groupanswer.id,subscriber.id as subscriberid,(subscriber.firstname+' '+subscriber.lastname) as subscribername,groupanswer.topic,groupanswer.dificultyGrade,groupanswer.creationDate
from groupanswer inner join subscriber on subscriber.id=groupanswer.subscriberId where groupanswer.subscriberId=@subscriberid order by groupanswer.topic

end
GO


