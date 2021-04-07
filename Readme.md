# **Devaway Racing Services**

**_URLS_**

**Obtener clasificación de una carrera**
`http://test-race.local/v1/race/{{ID_Carrera}}`

**Obtener clasificación de un piloto**
`http://test-race.local/v1/pilot/{{ID_PILOTO}}`

**Obtener clasificación general**
`http://test-race.local/v1/general`

**Guardar clasificación**
`http://test-race.local/v1/race/`

Estructura para guardar una competición
`[
    [
     "_id" => "5fd7dbd8ce3a40582fb9ee6b",
     "picture" => "http://placehold.it/64x64",
     "age" => 23,
     "name" => "Cooke Rivers",
     "team" => "PROTODYNE",
     "races" => [
         [
             "name" => "Race 0",
             "laps" => [
                 [
                     "time" => "00:10:31.078"
                 ],
                 [
                     "time" => "00:11:31.078"
                 ],
                 [
                     "time" => "00:09:31.078"
                 ]
             ]
         ]
     ]
    ]
]

**La aplicación tiene un token de seguridad. Este token se debe utilizar como Barear en las llamadas api que se realicen** eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyb2wiOiJhZG1pbiIsImV4cCI6MTgwNjMwNjUyMH0.T5n3amhMyqXkdWsexSWTj46Dz3GB4y8Ahx98dz2KtD8
`
