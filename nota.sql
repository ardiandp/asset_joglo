CREATE DATABASE IF NOT EXISTS nota_db;
USE nota_db;

CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    no_invoice VARCHAR(50) NOT NULL,
    tanggal DATE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    keterangan TEXT,
    jumlah DECIMAL(15,2) NOT NULL,
    status ENUM('lunas', 'belum lunas') NOT NULL DEFAULT 'belum lunas'
);
