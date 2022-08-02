CREATE TABLE PRODUCTO(
    codpro int not null AUTO_INCREMENT,
    nompro varchar(50) null,
    despro varchar(100) null,
    prepro numeric(6,3) null,
    estado int null,
    CONSTRAINT pk_producto
    PRIMARY KEY (codpro)
);

alter table PRODUCTO add rutimapro varchar(100) null;

INSERT INTO PRODUCTO(nompro, despro, prepro, estado, rutimapro)
VALUES('Guineo Verde', 'Description', '1.200', '1', 'cebollin.png');

