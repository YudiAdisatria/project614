DROP VIEW IF EXISTS vwIPK;
CREATE VIEW vwIPK AS

SELECT mahasiswas.nim,
sum(nilais.nilai*matkuls.sks)/sum(matkuls.sks) AS IPK

FROM mahasiswas INNER JOIN nilais ON(mahasiswas.nim=nilais.nim) 
INNER JOIN matkuls ON (nilais.kode_matkul=matkuls.kode_matkul)
GROUP BY mahasiswas.nim;
