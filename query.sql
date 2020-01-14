-- nomor 1
select b.noNotaBeli,b.tglBeli, sum(subTotal) as total from belis b join detailbelis d on b.id=d.id_beli 
where YEAR(b.tglBeli) = 2020 AND MONTH(b.tglBeli) BETWEEN 1 and 5

-- nomor 2

-- nomor 3
SELECT j.* from juals j join detailjuals d on j.id=d.id_jual GROUP by YEAR(j.tglPesan)

-- nomor 4

-- nomor 5
SELECT j.* from juals j join detailjuals d on j.id=d.id_jual GROUP by j.id_konsumen
