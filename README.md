
# Pasos para desplegar el proyecto en local

Para correr el proyecto se uso xampp.

- Se debe clonar el proyecto a la carpeta de c:\xampp\htdocs
- Luego vamos a modificar en el proyecto el archivo config/parameters.php :
    Cambiar el valor de 'base_url'  por la ruta en donde se guardo el proyecto. Por ejemplo si se guardo el proyecto en el folder 'htdocs/konecta' entonces la ruta quedaria asi: http://localhost/konecta/
- Modificar el archivo  '.htaccess' . En la linea 4 actualizar la url por http://localhost/carpeta_donde_esta_guardado_el_proyecto/error.
    Siguiendo nuestro ejemplo. La ruta quedari asi: http://localhost/konecta/error

- Importar la base de datos en su motor de base de datos mysql. El fichero de la base de datos se encuentra en la carpeta 'database/konecta_db.sql'
- Configurar conexion a la base de datos. Para ello debe ir  al archivo 'config/db.php'  y modificar los siguientes parametros de acceso segun la configuracion de su base de datos:
    
    $databasename='konecta_db';
    $user='root';
    $password='';

- Para correr el proyecto en el navegador, escriba en su barra de direccion la ruta de acceso a su proyecto. Segun nuestro ejemplo quedaria asi:

        http://localhost/konecta/

- En la parte de arriba se encuetra el menú, hay dos opciones:
 * Productos: Alli se puiede visualizar, crear, editar y eliminar productos.
 * Generar venta: Alli se puede realizar la venta de un producto. Ver su stock y total de la venta realizada. No se pude vender si no hay stock.       




## Consultas sql


*Consulta que permite conocer cuál es el producto que más stock tiene.

SELECT `nombre` AS `Producto_con_más_stock`,  MAX(`stock`) AS `total_stock`
FROM `productos` 
GROUP BY `nombre` 
ORDER BY `stock` DESC
LIMIT 1




*Consulta que permite conocer cuál es el producto más vendido.


SELECT productos.nombre AS `Producto_más_vendido`, SUM(ventas_productos.cantidad) AS `total_unidades_vendidas`
FROM `productos` 
INNER JOIN ventas_productos ON ventas_productos.producto_id = productos.id
GROUP BY ventas_productos.producto_id
ORDER BY SUM(ventas_productos.cantidad) DESC
LIMIT 1

