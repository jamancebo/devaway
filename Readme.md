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
`