CREATE DATABASE konecta_db;
USE konecta_db;


CREATE TABLE categorias(
id		int(255) auto_increment not null,
nombre		varchar(100) not null,
CONSTRAINT pk_categorias PRIMARY KEY(id)
)ENGINE=InnoDb;


INSERT INTO categorias VALUES(NULL,'Bebidas');
INSERT INTO categorias VALUES(NULL,'Panaderia');
INSERT INTO categorias VALUES(NULL,'Paquetes');



CREATE TABLE productos(
id		        int(255) auto_increment not null,
categoria_id	int(255) not null,
nombre		    varchar(100) not null,
referencia	    varchar(100) not null,
precio		    int(255) not null,
peso    	    int(255) not null,
stock		    int(255) not null,
fecha_creacion	date not null,
CONSTRAINT pk_productos PRIMARY KEY(id),
CONSTRAINT fk_producto_categorias FOREIGN KEY(categoria_id) REFERENCES categorias(id) ON DELETE CASCADE
)ENGINE=InnoDb;



CREATE TABLE ventas(
id		int(255) auto_increment not null,
costo_total		int(255) not null,
fecha		date, 
hora		time,
CONSTRAINT pk_ventas PRIMARY KEY(id)
)ENGINE=InnoDb;



CREATE TABLE ventas_productos(
id		int(255) auto_increment not null,
venta_id	int(255) not null,
producto_id	int(255) not null,
cantidad    int(255) not null,
CONSTRAINT pk_ventas_pedidos PRIMARY KEY(id),
CONSTRAINT fk_ventas FOREIGN KEY(venta_id) REFERENCES ventas(id) ON DELETE CASCADE,
CONSTRAINT fk_productos FOREIGN KEY(producto_id) REFERENCES productos(id) ON DELETE CASCADE
)ENGINE=InnoDb;










