-- Trigger 2 (Faisal)

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

CREATE OR REPLACE FUNCTION hitung_pembelian_inventori() RETURNS trigger AS $$

BEGIN

IF (TG_OP = 'INSERT')
THEN UPDATE INVENTORI SET stok = stok + NEW.jumlah
WHERE     nama = NEW.nama AND
        merk = NEW.merk;

ELSEIF (TG_OP = 'DELETE')
THEN UPDATE INVENTORI SET stok = stok - OLD.jumlah
WHERE     nama = OLD.nama AND
        merk = OLD.merk;

ELSEIF (TG_OP = 'UPDATE')
THEN UPDATE INVENTORI SET stok = stok + NEW.jumlah
WHERE    nama = NEW.nama AND
        merk = NEW.merk;

UPDATE INVENTORI SET stok = stok - OLD.jumlah
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
THEN UPDATE INVENTORI SET stok = stok - NEW.jumlah
WHERE     nama = NEW.nama AND
        merk = NEW.merk;

ELSEIF (TG_OP = 'DELETE')
THEN UPDATE INVENTORI SET stok = stok + NEW.jumlah
WHERE     nama = OLD.nama AND
        merk = OLD.merk;

ELSEIF (TG_OP = 'UPDATE')
THEN UPDATE INVENTORI SET stok = stok - NEW.jumlah
WHERE    nama = NEW.nama AND
        merk = NEW.merk;

UPDATE INVENTORI SET stok = stok + NEW.jumlah
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