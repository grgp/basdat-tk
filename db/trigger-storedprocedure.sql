--1. Pada table INVOICE terdapat kolom ‘Discount’ dan ‘Total’. Nilai kolom ‘Discount’ diupdate bila sudah tercatat data tamu lebih dari 10x pada table INVOICE dan nilai ‘Total’ diupdate berdasarkan harga dari semua kamar yang dipesan setelah dikalikan diskon. 

CREATE OR REPLACE FUNCTION fill_discount() RETURNS TRIGGER AS
$$
    BEGIN
        IF (TG_OP = 'INSERT') THEN
            IF (SELECT COUNT(*) FROM SILUTEL.INVOICE WHERE idtamu = NEW.idtamu) >= 10 THEN
                NEW.total = (SELECT SUM(harga)
                                FROM invoice_kamar n, kamar k, tipe_kamar t 
                                WHERE n.nomorinvoice = NEW.nomorinvoice AND n.nomorkamar = k.nomor 
                                AND n.lantaikamar = k.lantai AND k.namatipekamar = t.nama);
                NEW.discount = 10;
            END IF;
        END IF;
        IF (TG_OP = 'UPDATE') THEN
            NEW.total = NEW.total - NEW.total*(NEW.discount/100);
        RETURN NEW;
    END;
$$
LANGUAGE plpgsql;

CREATE TRIGGER diskondiskon BEFORE INSERT OR UPDATE ON silutel.invoice FOR EACH ROW EXECUTE PROCEDURE fill_discount();

CREATE OR REPLACE FUNCTION hitung_total_invoice()
RETURNS TRIGGER AS
$$
BEGIN
  IF (TG_OP = 'INSERT') THEN
    UPDATE silutel.invoice SET total =
    (SELECT SUM(harga)
    FROM invoice_kamar n, kamar k, tipe_kamar t 
    WHERE n.nomorinvoice = NEW.nomorinvoice AND n.nomorkamar = k.nomor 
          AND n.lantaikamar = k.lantai AND k.namatipekamar = t.nama)
    WHERE nomorinvoice = NEW.nomorinvoice;

  ELSEIF (TG_OP = 'DELETE') THEN
    UPDATE silutel.invoice SET total =
    (SELECT SUM(harga)
    FROM invoice_kamar n, kamar k, tipe_kamar t
    WHERE n.nomorinvoice = OLD.nomorinvoice AND n.nomorkamar = k.nomor 
          AND n.lantaikamar = k.lantai AND k.namatipekamar = t.nama)
    WHERE nomorinvoice = OLD.nomorinvoice;

  ELSEIF (TG_OP = 'UPDATE') THEN
    UPDATE silutel.invoice SET total =
    (SELECT SUM(harga)
    FROM invoice_kamar n, kamar k, tipe_kamar t
    WHERE n.nomorinvoice = NEW.nomorinvoice AND n.nomorkamar = k.nomor 
          AND n.lantaikamar = k.lantai AND k.namatipekamar = t.nama)
    WHERE nomorinvoice = NEW.nomorinvoice;

    UPDATE silutel.invoice SET total =
    (SELECT SUM(harga)
    FROM invoice_kamar n, kamar k, tipe_kamar t
    WHERE n.nomorinvoice = OLD.nomorinvoice AND n.nomorkamar = k.nomor 
          AND n.lantaikamar = k.lantai AND k.namatipekamar = t.nama)
    WHERE nomorinvoice = OLD.nomorinvoice;
    
  END IF;
  RETURN NEW;
END;
$$
LANGUAGE plpgsql;

CREATE TRIGGER total_invoice
AFTER INSERT OR DELETE OR UPDATE
ON silutel.invoice_kamar FOR EACH ROW
EXECUTE PROCEDURE hitung_total_invoice();

-- Trigger 2 (Faisal)
--Pada table LAUNDRY_STAF_LAUNDRY terdapat kolom ‘Total’. Nilai kolom ini diperoleh dari informasi banyaknya inventori yang dilaundry pada table LAUNDRY_INVENTORI.

CREATE OR REPLACE FUNCTION hitung_total_laundry()
RETURNS trigger AS
$$
 BEGIN
IF (TG_OP = 'INSERT') THEN
 UPDATE silutel.LAUNDRY_STAF_LAUNDRY SET total =
 (SELECT SUM(jumlah)
 FROM silutel.LAUNDRY_INVENTORI
 WHERE emailstaf = NEW.emailstaf AND
       waktu = NEW.waktu)
 WHERE emailstaf = NEW.emailstaf AND
       waktu = NEW.waktu;
       
ELSEIF (TG_OP = 'DELETE') THEN
 UPDATE silutel.LAUNDRY_STAF_LAUNDRY SET total =
 (SELECT SUM(jumlah)
 FROM silutel.LAUNDRY_INVENTORI
 WHERE emailstaf = OLD.emailstaf AND
       waktu = OLD.waktu)
 WHERE emailstaf = OLD.emailstaf AND
       waktu = OLD.waktu;

ELSEIF (TG_OP = 'UPDATE') THEN
 UPDATE silutel.LAUNDRY_STAF_LAUNDRY SET total =
 (SELECT SUM(jumlah)
 FROM silutel.LAUNDRY_INVENTORI
 WHERE emailstaf = NEW.emailstaf AND
       waktu = NEW.waktu)
 WHERE emailstaf = NEW.emailstaf AND
       waktu = NEW.waktu;
       
 UPDATE silutel.LAUNDRY_STAF_LAUNDRY SET total =
 (SELECT SUM(jumlah)
 FROM silutel.LAUNDRY_INVENTORI
 WHERE emailstaf = OLD.emailstaf AND
       waktu = OLD.waktu)
 WHERE emailstaf = OLD.emailstaf AND
       waktu = OLD.waktu;
END IF;
 RETURN NEW;
 END;
$$
LANGUAGE plpgsql;

CREATE TRIGGER total
AFTER INSERT OR DELETE OR UPDATE
ON LAUNDRY_INVENTORI FOR EACH ROW
EXECUTE PROCEDURE hitung_total_laundry();

-- Trigger 3 (Sabiq)
-- Pada table INVENTORI terdapat kolom ‘Stok’. Nilai kolom ini diupdate setiap kali ada INSERT/UPDATE/DELETE sebuah PEMBELIAN_INVENTORI dan/atau INSERT/UPDATE/DELETE pada table STAF_MENGGANTI_INVENTORI

CREATE OR REPLACE FUNCTION hitung_pembelian_inventori() RETURNS trigger AS $$

BEGIN

IF (TG_OP = 'INSERT')
THEN UPDATE SILUTEL.INVENTORI SET stok = stok + NEW.jumlah
WHERE     nama = NEW.nama AND
        merk = NEW.merk;

ELSEIF (TG_OP = 'DELETE')
THEN UPDATE SILUTEL.INVENTORI SET stok = stok - OLD.jumlah
WHERE     nama = OLD.nama AND
        merk = OLD.merk;

ELSEIF (TG_OP = 'UPDATE')
THEN UPDATE SILUTEL.INVENTORI SET stok = stok + NEW.jumlah
WHERE    nama = NEW.nama AND
        merk = NEW.merk;

UPDATE SILUTEL.INVENTORI SET stok = stok - OLD.jumlah
WHERE     nama = OLD.nama AND
        merk = OLD.merk;
END IF;
RETURN NEW;
END;    
$$
LANGUAGE plpgsql;

CREATE TRIGGER jumlah_stok
AFTER INSERT OR DELETE OR UPDATE
ON silutel.pembelian_inventori FOR EACH ROW
EXECUTE PROCEDURE hitung_pembelian_inventori();



CREATE OR REPLACE FUNCTION hitung_staf_mengganti_inventori() RETURNS trigger AS $$

BEGIN

IF (TG_OP = 'INSERT')
THEN UPDATE SILUTEL.INVENTORI SET stok = stok - NEW.jumlah
WHERE     nama = NEW.nama AND
        merk = NEW.merk;

ELSEIF (TG_OP = 'DELETE')
THEN UPDATE SILUTEL.INVENTORI SET stok = stok + NEW.jumlah
WHERE     nama = OLD.nama AND
        merk = OLD.merk;

ELSEIF (TG_OP = 'UPDATE')
THEN UPDATE SILUTEL.INVENTORI SET stok = stok - NEW.jumlah
WHERE    nama = NEW.nama AND
        merk = NEW.merk;

UPDATE SILUTEL.INVENTORI SET stok = stok + NEW.jumlah
WHERE     nama = OLD.nama AND
        merk = OLD.merk;
END IF;
RETURN NEW;
END;    
$$
LANGUAGE plpgsql;

CREATE TRIGGER jumlah_stok2
AFTER INSERT OR DELETE OR UPDATE
ON silutel.STAF_MENGGANTI_INVENTORI FOR EACH ROW
EXECUTE PROCEDURE hitung_staf_mengganti_inventori();
--
