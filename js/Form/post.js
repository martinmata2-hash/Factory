export class Post
{
    constructor(){}
    ajax_call(url,data,begin,success,error,complete,cache = false)
	{	
		$.ajax(
		{
			type: "POST",
			url: url,			
			data: data,
			beforeSend:begin,
			cache:cache,
			success: success,
			error:error,
			complete:complete			
		});
	}
}