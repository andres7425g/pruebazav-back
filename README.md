# Test the API
You can test the API by including header `Content-Type`,`Client-Service` & `Auth-Key` with value `application/json`,`frontend-client` & `simplerestapi` in every request

And for API except `login` you must include `id` & `token` that you get after successfully login. The header for both look like this `User-ID` & `Authorization`

List of the API :
`[POST]` `/auth/login` json `{ "username" : "admin", "password" : "Admin123$"}`

`[GET]` `/Visita`

`[POST]` `/Visita/create` json `{ 
	"nombre" : "nombre", 
	"correo" : "nombre@nomre.com",
	"celular" : "000000000", 
	"comentario" : "Comentario", 
	"motivo_visita" : "Compra"
	
}`

`[PUT]` `/Visita/update/:id` json `{ 
	"nombre" : "nombre1", 
	"correo" : "nombre1@nomre.com",
	"celular" : "000000000", 
	"comentario" : "Comentario nuevo", 
	"motivo_visita" : "Compra"
	
}`

`[GET]` `/Visita/detail/:id`

`[DELETE]` `/Visita/delete/:id`

`[POST]` `/auth/logout`
