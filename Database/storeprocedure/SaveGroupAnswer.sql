IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[saveGroup]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].saveGroup

GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

create procedure saveGroup
(
@id int output,
@subscriberid int,
@topic varchar(300),
@dificultyGrade varchar(300)
)
as
begin
if(@id>0)
begin
	update groupanswer set
	topic=@topic,
	dificultyGrade=@dificultyGrade where id=@id;
	set @id=0;
end

else

begin
	insert into groupanswer (subscriberid,topic,dificultyGrade,creationDate) values(@subscriberid,@topic,@dificultyGrade,GETDATE());
	set @id=SCOPE_IDENTITY();
end

end