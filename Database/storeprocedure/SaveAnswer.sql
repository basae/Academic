IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[saveAnswer]') AND type in (N'P', N'PC'))
DROP PROCEDURE [dbo].saveAnswer

GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

create procedure saveAnswer
(
@id int output,
@groupId int,
@answer varchar(500),
@r1 varchar(300),
@r2 varchar(300),
@r3 varchar(300),
@r4 varchar(300),
@correctasnwer varchar(300),
@TypeAnswer varchar(50),
@points decimal
)
as
begin 
if(@id>0) 
begin
if not exists(select answer from answer where answer=@answer and TypeAnswer='PREGUNTA')
	begin
	update answer set
	answer=@answer,
	r1=@r1,
	r2=@r2,
	r3=@r3,
	r4=@r4,
	correctasnwer=@correctasnwer,
	points=@points,
	TypeAnswer=@TypeAnswer where id=@id;
	set @id=0;
	end
else
set @id=-2
end
else
begin
	if not exists(select answer from answer where answer=@answer and TypeAnswer='PREGUNTA')
	begin
		insert into answer (groupId,answer,r1,r2,r3,r4,correctasnwer,TypeAnswer,points)
		values(@groupId,@answer,@r1,@r2,@r3,@r4,@correctasnwer,@TypeAnswer,@points);
		set @id=scope_identity();
	end
	else
	set @id=-2;

end
end