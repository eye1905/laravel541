-- nomor 1
select b.noNotaBeli,b.tglBeli, sum(subTotal) as total from belis b join detailbelis d on b.id=d.id_beli 
where YEAR(b.tglBeli) = 2020 AND MONTH(b.tglBeli) BETWEEN 1 and 5

--no 1 zi
SELECT b.noNotaBeli, b.tglBeli, (SUM(db.subTotal)) as totale
FROM detailbelis as db inner join belis as b on db.id_beli=b.id
WHERE YEAR(b.tglBeli)=2020 AND (MONTH(b.tglBeli)>=1 AND MONTH(b.tglBeli)<=6)
GROUP BY b.id
-- nomor 2


-- nomor 3 salah
SELECT j.* from juals j join detailjuals d on j.id=d.id_jual GROUP by YEAR(j.tglPesan)

--no 3 zi
SELECT SUM(total) as total, YEAR (tglPesan) as tahun FROM `juals` GROUP BY YEAR (tglPesan)
--berdasarkan taun
SELECT j.* from juals j join detailjuals d on j.id=d.id_jual WHERE YEAR(j.tglPesan)=2019
-- nomor 4

-- nomor 5
SELECT j.* from juals j join detailjuals d on j.id=d.id_jual GROUP by j.id_konsumen
