// geocoder = new google.maps.Geocoder();
//function getCoordinate(address,callback)
//{

	$(document).ready(function()
	{
		$('form').submit(function()
		{
			$.get('/main/midpoint',function(res)
			{
				console.log(res);
//				var coordinates;
//				geocoder.geocode({address:res},function(results,status)
//				{
//					coords_obj = results[0].geometry.location;
//					coordinates = [coords_obj.A,coords_obj.F];
//					callback(coordinates);
//				})
				
			});
		// var coordinates;
		// geocoder.geocode({address:address},function(results,status)
		// {
		// 	coords_obj = results[0].geometry.location;
		// 	coordinates = [coords_obj.A,coords_obj.F];
		// 	callback(coordinates);
		// })
		return false;
		})
			
	})
	
	// return coordinates
//}
//getCoordinate('hi','hello');