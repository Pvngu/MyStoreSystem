<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use App\Models\Address;
use App\Models\Country;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countriesData = [
            ['name' => 'Mexico'],
            ['name' => 'United States']
        ];

        Country::insert($countriesData);

        $statesData = [
            //mexico
            ['name' => 'Aguascalientes', 'country_id' => 1],
            ['name' => 'Baja California', 'country_id' => 1],
            ['name' => 'Baja California Sur', 'country_id' => 1],
            ['name' => 'Campeche', 'country_id' => 1],
            ['name' => 'Chiapas', 'country_id' => 1],
            ['name' => 'Chihuahua', 'country_id' => 1],
            ['name' => 'Coahuila', 'country_id' => 1],
            ['name' => 'Colima', 'country_id' => 1],
            ['name' => 'Durango', 'country_id' => 1],
            ['name' => 'Guanajuato', 'country_id' => 1],
            ['name' => 'Guerrero', 'country_id' => 1],
            ['name' => 'Hidalgo', 'country_id' => 1],
            ['name' => 'Jalisco', 'country_id' => 1],
            ['name' => 'Mexico City', 'country_id' => 1],
            ['name' => 'Mexico State', 'country_id' => 1],
            ['name' => 'Michoacán', 'country_id' => 1],
            ['name' => 'Morelos', 'country_id' => 1],
            ['name' => 'Nayarit', 'country_id' => 1],
            ['name' => 'Nuevo León', 'country_id' => 1],
            ['name' => 'Oaxaca', 'country_id' => 1],
            ['name' => 'Puebla', 'country_id' => 1],
            ['name' => 'Querétaro', 'country_id' => 1],
            ['name' => 'Quintana Roo', 'country_id' => 1],
            ['name' => 'San Luis Potosí', 'country_id' => 1],
            ['name' => 'Sinaloa', 'country_id' => 1],
            ['name' => 'Sonora', 'country_id' => 1],
            ['name' => 'Tabasco', 'country_id' => 1],
            ['name' => 'Tamaulipas', 'country_id' => 1],
            ['name' => 'Tlaxcala', 'country_id' => 1],
            ['name' => 'Veracruz', 'country_id' => 1],
            ['name' => 'Yucatán', 'country_id' => 1],
            ['name' => 'Zacatecas', 'country_id' => 1],

            // United States
            ['name' => 'Alabama', 'country_id' => 2],
            ['name' => 'Alaska', 'country_id' => 2],
            ['name' => 'Arizona', 'country_id' => 2],
            ['name' => 'Arkansas', 'country_id' => 2],
            ['name' => 'California', 'country_id' => 2],
            ['name' => 'Colorado', 'country_id' => 2],
            ['name' => 'Connecticut', 'country_id' => 2],
            ['name' => 'Delaware', 'country_id' => 2],
            ['name' => 'Florida', 'country_id' => 2],
            ['name' => 'Georgia', 'country_id' => 2],
            ['name' => 'Hawaii', 'country_id' => 2],
            ['name' => 'Idaho', 'country_id' => 2],
            ['name' => 'Illinois', 'country_id' => 2],
            ['name' => 'Indiana', 'country_id' => 2],
            ['name' => 'Iowa', 'country_id' => 2],
            ['name' => 'Kansas', 'country_id' => 2],
            ['name' => 'Kentucky', 'country_id' => 2],
            ['name' => 'Louisiana', 'country_id' => 2],
            ['name' => 'Maine', 'country_id' => 2],
            ['name' => 'Maryland', 'country_id' => 2],
            ['name' => 'Massachusetts', 'country_id' => 2],
            ['name' => 'Michigan', 'country_id' => 2],
            ['name' => 'Minnesota', 'country_id' => 2],
            ['name' => 'Mississippi', 'country_id' => 2],
            ['name' => 'Missouri', 'country_id' => 2],
            ['name' => 'Montana', 'country_id' => 2],
            ['name' => 'Nebraska', 'country_id' => 2],
            ['name' => 'Nevada', 'country_id' => 2],
            ['name' => 'New Hampshire', 'country_id' => 2],
            ['name' => 'New Jersey', 'country_id' => 2],
            ['name' => 'New Mexico', 'country_id' => 2],
            ['name' => 'New York', 'country_id' => 2],
            ['name' => 'North Carolina', 'country_id' => 2],
            ['name' => 'North Dakota', 'country_id' => 2],
            ['name' => 'Ohio', 'country_id' => 2],
            ['name' => 'Oklahoma', 'country_id' => 2],
            ['name' => 'Oregon', 'country_id' => 2],
            ['name' => 'Pennsylvania', 'country_id' => 2],
            ['name' => 'Rhode Island', 'country_id' => 2],
            ['name' => 'South Carolina', 'country_id' => 2],
            ['name' => 'South Dakota', 'country_id' => 2],
            ['name' => 'Tennessee', 'country_id' => 2],
            ['name' => 'Texas', 'country_id' => 2],
            ['name' => 'Utah', 'country_id' => 2],
            ['name' => 'Vermont', 'country_id' => 2],
            ['name' => 'Virginia', 'country_id' => 2],
            ['name' => 'Washington', 'country_id' => 2],
            ['name' => 'West Virginia', 'country_id' => 2],
            ['name' => 'Wisconsin', 'country_id' => 2],
            ['name' => 'Wyoming', 'country_id' => 2]
        ];
            State::insert($statesData);

        $citiesData = [
            // Mexico
            // Cities from Aguascalientes
            ['name' => 'Aguascalientes City', 'state_id' => 1],
            ['name' => 'Calvillo', 'state_id' => 1],
            ['name' => 'Jesus Maria', 'state_id' => 1],
            ['name' => 'Rincon de Romos', 'state_id' => 1],
            ['name' => 'Pabellon de Arteaga', 'state_id' => 1],
            // Cities from Baja California
            ['name' => 'Tijuana', 'state_id' => 2],
            ['name' => 'Mexicali', 'state_id' => 2],
            ['name' => 'Ensenada', 'state_id' => 2],
            ['name' => 'Rosarito', 'state_id' => 2],
            ['name' => 'Tecate', 'state_id' => 2],
            
            // Cities from Baja California Sur
            ['name' => 'La Paz', 'state_id' => 3],
            ['name' => 'Cabo San Lucas', 'state_id' => 3],
            ['name' => 'San Jose del Cabo', 'state_id' => 3],
            ['name' => 'Todos Santos', 'state_id' => 3],

            // Cities from Campeche
            ['name' => 'Campeche City', 'state_id' => 4],
            ['name' => 'Ciudad del Carmen', 'state_id' => 4],
            ['name' => 'Champoton', 'state_id' => 4],
            ['name' => 'Escarcega', 'state_id' => 4],
            
            // Cities from Chiapas
            ['name' => 'Tuxtla Gutierrez', 'state_id' => 5],
            ['name' => 'San Cristobal de las Casas', 'state_id' => 5],
            ['name' => 'Tapachula', 'state_id' => 5],
            ['name' => 'Comitan', 'state_id' => 5],
            
            // Cities from Chihuahua
            ['name' => 'Chihuahua City', 'state_id' => 6],
            ['name' => 'Juarez', 'state_id' => 6],
            ['name' => 'Delicias', 'state_id' => 6],
            ['name' => 'Cuauhtemoc', 'state_id' => 6],

            // Cities from Coahuila
            ['name' => 'Saltillo', 'state_id' => 7],
            ['name' => 'Torreon', 'state_id' => 7],
            ['name' => 'Monclova', 'state_id' => 7],
            ['name' => 'Piedras Negras', 'state_id' => 7],

            // Cities from Colima
            ['name' => 'Colima City', 'state_id' => 8],
            ['name' => 'Manzanillo', 'state_id' => 8],
            ['name' => 'Tecoman', 'state_id' => 8],
            ['name' => 'Villa de Alvarez', 'state_id' => 8],

            // Cities from Durango
            ['name' => 'Durango City', 'state_id' => 9],
            ['name' => 'Gomez Palacio', 'state_id' => 9],
            ['name' => 'Lerdo', 'state_id' => 9],
            ['name' => 'Ciudad Lerdo', 'state_id' => 9],

            // Cities from Guanajuato
            ['name' => 'Guanajuato City', 'state_id' => 10],
            ['name' => 'León', 'state_id' => 10],
            ['name' => 'Irapuato', 'state_id' => 10],
            ['name' => 'Celaya', 'state_id' => 10],

            // Cities from Guerrero
            ['name' => 'Acapulco', 'state_id' => 11],
            ['name' => 'Chilpancingo', 'state_id' => 11],
            ['name' => 'Iguala', 'state_id' => 11],
            ['name' => 'Taxco', 'state_id' => 11],

            // Cities from Hidalgo
            ['name' => 'Pachuca', 'state_id' => 12],
            ['name' => 'Tulancingo', 'state_id' => 12],
            ['name' => 'Tizayuca', 'state_id' => 12],
            ['name' => 'Ixmiquilpan', 'state_id' => 12],

            // Cities from Jalisco
            ['name' => 'Guadalajara', 'state_id' => 13],
            ['name' => 'Zapopan', 'state_id' => 13],
            ['name' => 'Tlaquepaque', 'state_id' => 13],
            ['name' => 'Tonala', 'state_id' => 13],

            // Cities from Mexico City
            ['name' => 'Mexico City', 'state_id' => 14],

            // Cities from Mexico State
            ['name' => 'Toluca', 'state_id' => 15],
            ['name' => 'Naucalpan', 'state_id' => 15],
            ['name' => 'Ecatepec', 'state_id' => 15],
            ['name' => 'Tlalnepantla', 'state_id' => 15],

            // Cities from Michoacán
            ['name' => 'Morelia', 'state_id' => 16],
            ['name' => 'Uruapan', 'state_id' => 16],
            ['name' => 'Zamora', 'state_id' => 16],
            ['name' => 'Lazaro Cardenas', 'state_id' => 16],

            // Cities from Morelos
            ['name' => 'Cuernavaca', 'state_id' => 17],
            ['name' => 'Jiutepec', 'state_id' => 17],
            ['name' => 'Temixco', 'state_id' => 17],
            ['name' => 'Yautepec', 'state_id' => 17],

            // Cities from Nayarit
            ['name' => 'Tepic', 'state_id' => 18],
            ['name' => 'Tecuala', 'state_id' => 18],
            ['name' => 'Ixtlan del Rio', 'state_id' => 18],
            ['name' => 'Compostela', 'state_id' => 18],

            // Cities from Nuevo León
            ['name' => 'Monterrey', 'state_id' => 19],
            ['name' => 'San Pedro Garza Garcia', 'state_id' => 19],
            ['name' => 'Guadalupe', 'state_id' => 19],
            ['name' => 'Apodaca', 'state_id' => 19],

            // Cities from Oaxaca
            ['name' => 'Oaxaca City', 'state_id' => 20],
            ['name' => 'Juchitan', 'state_id' => 20],
            ['name' => 'Salina Cruz', 'state_id' => 20],
            ['name' => 'Huajuapan de Leon', 'state_id' => 20],

            // Cities from Puebla
            ['name' => 'Puebla City', 'state_id' => 21],
            ['name' => 'Tehuacan', 'state_id' => 21],
            ['name' => 'Heroica Puebla de Zaragoza', 'state_id' => 21],
            ['name' => 'San Andres Cholula', 'state_id' => 21],

            // Cities from Querétaro
            ['name' => 'Santiago de Querétaro', 'state_id' => 22],
            ['name' => 'San Juan del Rio', 'state_id' => 22],
            ['name' => 'Corregidora', 'state_id' => 22],
            ['name' => 'El Marques', 'state_id' => 22],

            // Cities from Quintana Roo
            ['name' => 'Cancun', 'state_id' => 23],
            ['name' => 'Playa del Carmen', 'state_id' => 23],
            ['name' => 'Chetumal', 'state_id' => 23],
            ['name' => 'Cozumel', 'state_id' => 23],

            // Cities from San Luis Potosí
            ['name' => 'San Luis Potosí City', 'state_id' => 24],
            ['name' => 'Soledad de Graciano Sanchez', 'state_id' => 24],
            ['name' => 'Matehuala', 'state_id' => 24],
            ['name' => 'Rioverde', 'state_id' => 24],

            // Cities from Sinaloa
            ['name' => 'Culiacan', 'state_id' => 25],
            ['name' => 'Mazatlán', 'state_id' => 25],
            ['name' => 'Los Mochis', 'state_id' => 25],
            ['name' => 'Guasave', 'state_id' => 25],

            // Cities from Sonora
            ['name' => 'Hermosillo', 'state_id' => 26],
            ['name' => 'Ciudad Obregon', 'state_id' => 26],
            ['name' => 'Nogales', 'state_id' => 26],
            ['name' => 'San Luis Rio Colorado', 'state_id' => 26],

            // Cities from Tabasco
            ['name' => 'Villahermosa', 'state_id' => 27],
            ['name' => 'Cárdenas', 'state_id' => 27],
            ['name' => 'Comalcalco', 'state_id' => 27],
            ['name' => 'Huimanguillo', 'state_id' => 27],

            // Cities from Tamaulipas
            ['name' => 'Tampico', 'state_id' => 28],
            ['name' => 'Reynosa', 'state_id' => 28],
            ['name' => 'Matamoros', 'state_id' => 28],
            ['name' => 'Nuevo Laredo', 'state_id' => 28],

            // Cities from Tlaxcala
            ['name' => 'Tlaxcala City', 'state_id' => 29],
            ['name' => 'Apizaco', 'state_id' => 29],
            ['name' => 'Huamantla', 'state_id' => 29],
            ['name' => 'Chiautempan', 'state_id' => 29],

            // Cities from Veracruz
            ['name' => 'Veracruz City', 'state_id' => 30],
            ['name' => 'Xalapa', 'state_id' => 30],
            ['name' => 'Coatzacoalcos', 'state_id' => 30],
            ['name' => 'Cordoba', 'state_id' => 30],

            // Cities from Yucatán
            ['name' => 'Merida', 'state_id' => 31],
            ['name' => 'Valladolid', 'state_id' => 31],
            ['name' => 'Progreso', 'state_id' => 31],
            ['name' => 'Izamal', 'state_id' => 31],

            // Cities from Zacatecas
            ['name' => 'Zacatecas City', 'state_id' => 32],
            ['name' => 'Guadalupe', 'state_id' => 32],
            ['name' => 'Fresnillo', 'state_id' => 32],
            ['name' => 'Jerez', 'state_id' => 32],

            // United States
            // Cities from Alabama
            ['name' => 'Birmingham', 'state_id' => 33],
            ['name' => 'Montgomery', 'state_id' => 33],
            ['name' => 'Mobile', 'state_id' => 33],
            ['name' => 'Huntsville', 'state_id' => 33],

            // Cities from Alaska
            ['name' => 'Anchorage', 'state_id' => 34],
            ['name' => 'Fairbanks', 'state_id' => 34],
            ['name' => 'Juneau', 'state_id' => 34],
            ['name' => 'Sitka', 'state_id' => 34],

            // Cities from Arizona
            ['name' => 'Phoenix', 'state_id' => 35],
            ['name' => 'Tucson', 'state_id' => 35],
            ['name' => 'Mesa', 'state_id' => 35],
            ['name' => 'Chandler', 'state_id' => 35],

            // Cities from Arkansas
            ['name' => 'Little Rock', 'state_id' => 36],
            ['name' => 'Fort Smith', 'state_id' => 36],
            ['name' => 'Fayetteville', 'state_id' => 36],
            ['name' => 'Springdale', 'state_id' => 36],

            // Cities from California
            ['name' => 'Los Angeles', 'state_id' => 37],
            ['name' => 'San Diego', 'state_id' => 37],
            ['name' => 'San Francisco', 'state_id' => 37],
            ['name' => 'San Jose', 'state_id' => 37],

            // Cities from Colorado
            ['name' => 'Denver', 'state_id' => 38],
            ['name' => 'Colorado Springs', 'state_id' => 38],
            ['name' => 'Aurora', 'state_id' => 38],
            ['name' => 'Fort Collins', 'state_id' => 38],

            // Cities from Connecticut
            ['name' => 'Bridgeport', 'state_id' => 39],
            ['name' => 'New Haven', 'state_id' => 39],
            ['name' => 'Hartford', 'state_id' => 39],
            ['name' => 'Stamford', 'state_id' => 39],

            // Cities from Delaware
            ['name' => 'Wilmington', 'state_id' => 40],
            ['name' => 'Dover', 'state_id' => 40],
            ['name' => 'Newark', 'state_id' => 40],
            ['name' => 'Middletown', 'state_id' => 40],

            // Cities from Florida
            ['name' => 'Miami', 'state_id' => 41],
            ['name' => 'Tampa', 'state_id' => 41],
            ['name' => 'Orlando', 'state_id' => 41],
            ['name' => 'Jacksonville', 'state_id' => 41],

            // Cities from Georgia
            ['name' => 'Atlanta', 'state_id' => 42],
            ['name' => 'Augusta', 'state_id' => 42],
            ['name' => 'Columbus', 'state_id' => 42],
            ['name' => 'Savannah', 'state_id' => 42],

            // Cities from Hawaii
            ['name' => 'Honolulu', 'state_id' => 43],
            ['name' => 'Hilo', 'state_id' => 43],
            ['name' => 'Kailua', 'state_id' => 43],
            ['name' => 'Pearl City', 'state_id' => 43],

            // Cities from Idaho
            ['name' => 'Boise', 'state_id' => 44],
            ['name' => 'Meridian', 'state_id' => 44],
            ['name' => 'Nampa', 'state_id' => 44],
            ['name' => 'Idaho Falls', 'state_id' => 44],

            // Cities from Illinois
            ['name' => 'Chicago', 'state_id' => 45],
            ['name' => 'Aurora', 'state_id' => 45],
            ['name' => 'Rockford', 'state_id' => 45],
            ['name' => 'Joliet', 'state_id' => 45],

            // Cities from Indiana
            ['name' => 'Indianapolis', 'state_id' => 46],
            ['name' => 'Fort Wayne', 'state_id' => 46],
            ['name' => 'Evansville', 'state_id' => 46],
            ['name' => 'South Bend', 'state_id' => 46],

            // Cities from Iowa
            ['name' => 'Des Moines', 'state_id' => 47],
            ['name' => 'Cedar Rapids', 'state_id' => 47],
            ['name' => 'Davenport', 'state_id' => 47],
            ['name' => 'Sioux City', 'state_id' => 47],

            // Cities from Kansas
            ['name' => 'Wichita', 'state_id' => 48],
            ['name' => 'Overland Park', 'state_id' => 48],
            ['name' => 'Kansas City', 'state_id' => 48],
            ['name' => 'Topeka', 'state_id' => 48],

            // Cities from Kentucky
            ['name' => 'Louisville', 'state_id' => 49],
            ['name' => 'Lexington', 'state_id' => 49],
            ['name' => 'Bowling Green', 'state_id' => 49],
            ['name' => 'Owensboro', 'state_id' => 49],

            // Cities from Louisiana
            ['name' => 'New Orleans', 'state_id' => 50],
            ['name' => 'Baton Rouge', 'state_id' => 50],
            ['name' => 'Shreveport', 'state_id' => 50],
            ['name' => 'Lafayette', 'state_id' => 50],

            // Cities from Maine
            ['name' => 'Portland', 'state_id' => 51],
            ['name' => 'Lewiston', 'state_id' => 51],
            ['name' => 'Bangor', 'state_id' => 51],
            ['name' => 'South Portland', 'state_id' => 51],

            // Cities from Maryland
            ['name' => 'Baltimore', 'state_id' => 52],
            ['name' => 'Frederick', 'state_id' => 52],
            ['name' => 'Rockville', 'state_id' => 52],
            ['name' => 'Gaithersburg', 'state_id' => 52],

            // Cities from Massachusetts
            ['name' => 'Boston', 'state_id' => 53],
            ['name' => 'Worcester', 'state_id' => 53],
            ['name' => 'Springfield', 'state_id' => 53],
            ['name' => 'Cambridge', 'state_id' => 53],

            // Cities from Michigan
            ['name' => 'Detroit', 'state_id' => 54],
            ['name' => 'Grand Rapids', 'state_id' => 54],
            ['name' => 'Warren', 'state_id' => 54],
            ['name' => 'Sterling Heights', 'state_id' => 54],

            // Cities from Minnesota
            ['name' => 'Minneapolis', 'state_id' => 55],
            ['name' => 'Saint Paul', 'state_id' => 55],
            ['name' => 'Rochester', 'state_id' => 55],
            ['name' => 'Bloomington', 'state_id' => 55],

            // Cities from Mississippi
            ['name' => 'Jackson', 'state_id' => 56],
            ['name' => 'Gulfport', 'state_id' => 56],
            ['name' => 'Southaven', 'state_id' => 56],
            ['name' => 'Hattiesburg', 'state_id' => 56],

            // Cities from Missouri
            ['name' => 'Kansas City', 'state_id' => 57],
            ['name' => 'St. Louis', 'state_id' => 57],
            ['name' => 'Springfield', 'state_id' => 57],
            ['name' => 'Columbia', 'state_id' => 57],

                // Cities from Montana
            ['name' => 'Billings', 'state_id' => 58],
            ['name' => 'Missoula', 'state_id' => 58],
            ['name' => 'Great Falls', 'state_id' => 58],
            ['name' => 'Bozeman', 'state_id' => 58],

            // Cities from Nebraska
            ['name' => 'Omaha', 'state_id' => 59],
            ['name' => 'Lincoln', 'state_id' => 59],
            ['name' => 'Bellevue', 'state_id' => 59],
            ['name' => 'Grand Island', 'state_id' => 59],

            // Cities from Nevada
            ['name' => 'Las Vegas', 'state_id' => 60],
            ['name' => 'Henderson', 'state_id' => 60],
            ['name' => 'Reno', 'state_id' => 60],
            ['name' => 'North Las Vegas', 'state_id' => 60],

            // Cities from New Hampshire
            ['name' => 'Manchester', 'state_id' => 61],
            ['name' => 'Nashua', 'state_id' => 61],
            ['name' => 'Concord', 'state_id' => 61],
            ['name' => 'Dover', 'state_id' => 61],

            // Cities from New Jersey
            ['name' => 'Newark', 'state_id' => 62],
            ['name' => 'Jersey City', 'state_id' => 62],
            ['name' => 'Paterson', 'state_id' => 62],
            ['name' => 'Elizabeth', 'state_id' => 62],

            // Cities from New Mexico
            ['name' => 'Albuquerque', 'state_id' => 63],
            ['name' => 'Las Cruces', 'state_id' => 63],
            ['name' => 'Rio Rancho', 'state_id' => 63],
            ['name' => 'Santa Fe', 'state_id' => 63],

            // Cities from New York
            ['name' => 'New York City', 'state_id' => 64],
            ['name' => 'Buffalo', 'state_id' => 64],
            ['name' => 'Rochester', 'state_id' => 64],
            ['name' => 'Yonkers', 'state_id' => 64],

            // Cities from North Carolina
            ['name' => 'Charlotte', 'state_id' => 65],
            ['name' => 'Raleigh', 'state_id' => 65],
            ['name' => 'Greensboro', 'state_id' => 65],
            ['name' => 'Durham', 'state_id' => 65],

            // Cities from North Dakota
            ['name' => 'Fargo', 'state_id' => 66],
            ['name' => 'Bismarck', 'state_id' => 66],
            ['name' => 'Grand Forks', 'state_id' => 66],
            ['name' => 'Minot', 'state_id' => 66],

            // Cities from Ohio
            ['name' => 'Columbus', 'state_id' => 67],
            ['name' => 'Cleveland', 'state_id' => 67],
            ['name' => 'Cincinnati', 'state_id' => 67],
            ['name' => 'Toledo', 'state_id' => 67],

            // Cities from Oklahoma
            ['name' => 'Oklahoma City', 'state_id' => 68],
            ['name' => 'Tulsa', 'state_id' => 68],
            ['name' => 'Norman', 'state_id' => 68],
            ['name' => 'Broken Arrow', 'state_id' => 68],

            // Cities from Oregon
            ['name' => 'Portland', 'state_id' => 69],
            ['name' => 'Salem', 'state_id' => 69],
            ['name' => 'Eugene', 'state_id' => 69],
            ['name' => 'Gresham', 'state_id' => 69],

            // Cities from Pennsylvania
            ['name' => 'Philadelphia', 'state_id' => 70],
            ['name' => 'Pittsburgh', 'state_id' => 70],
            ['name' => 'Allentown', 'state_id' => 70],
            ['name' => 'Erie', 'state_id' => 70],

            // Cities from Rhode Island
            ['name' => 'Providence', 'state_id' => 71],
            ['name' => 'Warwick', 'state_id' => 71],
            ['name' => 'Cranston', 'state_id' => 71],
            ['name' => 'Pawtucket', 'state_id' => 71],

            // Cities from South Carolina
            ['name' => 'Columbia', 'state_id' => 72],
            ['name' => 'Charleston', 'state_id' => 72],
            ['name' => 'North Charleston', 'state_id' => 72],
            ['name' => 'Mount Pleasant', 'state_id' => 72],

            // Cities from South Dakota
            ['name' => 'Sioux Falls', 'state_id' => 73],
            ['name' => 'Rapid City', 'state_id' => 73],
            ['name' => 'Aberdeen', 'state_id' => 73],
            ['name' => 'Brookings', 'state_id' => 73],

            // Cities from Tennessee
            ['name' => 'Nashville', 'state_id' => 74],
            ['name' => 'Memphis', 'state_id' => 74],
            ['name' => 'Knoxville', 'state_id' => 74],
            ['name' => 'Chattanooga', 'state_id' => 74],

            // Cities from Texas
            ['name' => 'Houston', 'state_id' => 75],
            ['name' => 'San Antonio', 'state_id' => 75],
            ['name' => 'Dallas', 'state_id' => 75],
            ['name' => 'Austin', 'state_id' => 75],

            // Cities from Utah
            ['name' => 'Salt Lake City', 'state_id' => 76],
            ['name' => 'West Valley City', 'state_id' => 76],
            ['name' => 'Provo', 'state_id' => 76],
            ['name' => 'West Jordan', 'state_id' => 76],

            // Cities from Vermont
            ['name' => 'Burlington', 'state_id' => 77],
            ['name' => 'South Burlington', 'state_id' => 77],
            ['name' => 'Rutland', 'state_id' => 77],
            ['name' => 'Barre', 'state_id' => 77],

            // Cities from Virginia
            ['name' => 'Virginia Beach', 'state_id' => 78],
            ['name' => 'Norfolk', 'state_id' => 78],
            ['name' => 'Chesapeake', 'state_id' => 78],
            ['name' => 'Arlington', 'state_id' => 78],

            // Cities from Washington
            ['name' => 'Seattle', 'state_id' => 79],
            ['name' => 'Spokane', 'state_id' => 79],
            ['name' => 'Tacoma', 'state_id' => 79],
            ['name' => 'Vancouver', 'state_id' => 79],

            // Cities from West Virginia
            ['name' => 'Charleston', 'state_id' => 80],
            ['name' => 'Huntington', 'state_id' => 80],
            ['name' => 'Parkersburg', 'state_id' => 80],
            ['name' => 'Wheeling', 'state_id' => 80],

            // Cities from Wisconsin
            ['name' => 'Milwaukee', 'state_id' => 81],
            ['name' => 'Madison', 'state_id' => 81],
            ['name' => 'Green Bay', 'state_id' => 81],
            ['name' => 'Kenosha', 'state_id' => 81],

            // Cities from Wyoming
            ['name' => 'Cheyenne', 'state_id' => 82],
            ['name' => 'Casper', 'state_id' => 82],
            ['name' => 'Laramie', 'state_id' => 82],
            ['name' => 'Gillette', 'state_id' => 82]
        ];

        City::insert($citiesData);

        Address::factory(5)->create();
    }
}
