INSERT INTO clientes (nombre) VALUES 
('Carlos chinchia'),
('Yelis chinchia'),
('Ana Duran'),
('camila molina'),
('Carlos Rozado');

INSERT INTO cuentas (numero_cuenta, saldo, cliente_id) VALUES 
('12345', 6500000.00, 1),
('54321', 2850000.50, 2),
('23451', 450000.00, 3),
('32451', 8900000.00, 4),
('11111', 120000.00, 5);

INSERT INTO usuarios (cuenta_id, clave_hash) VALUES 
(1, '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5'),
(2, '0960533bc714125b2933d735076cf47c34b10b42fbc9fbba49ef2c4228994784'),
(3, 'f3b61073801f9e160e1d5225efcd110e05d21a224a1b023e601550c6b12a8427'),
(4, '8b935bf79477aa2bd4c12571e06551b9840eb142b934789df67d8f3312c3f191'),
(5, '3720970db1f471b058a5c3789a7fb383c27e909a32039aa74e87747bb771ef0a');

INSERT INTO retiros (cuenta_id, valor) VALUES 
(1, 50000.00),
(3, 100000.00),
(4, 500000.00),
(2, 200000.00),
(5, 20000.00);

INSERT INTO transferencias (cuenta_origen_id, cuenta_destino_id, valor) VALUES 
(2, 1, 150000.00),
(4, 3, 300000.00),
(1, 5, 45000.00),
(3, 2, 80000.00),
(4, 1, 120000.00);