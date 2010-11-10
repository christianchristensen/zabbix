ALTER TABLE items MODIFY itemid DEFAULT NULL;
ALTER TABLE items MODIFY hostid DEFAULT NULL;
ALTER TABLE items MODIFY units nvarchar2(255);
ALTER TABLE items MODIFY templateid DEFAULT NULL;
ALTER TABLE items MODIFY templateid NULL;
ALTER TABLE items MODIFY valuemapid DEFAULT NULL;
ALTER TABLE items MODIFY valuemapid NULL;
ALTER TABLE items ADD lastns number(10) NULL;
ALTER TABLE items ADD flags number(10) DEFAULT '0' NOT NULL;
ALTER TABLE items ADD filter nvarchar2(255) DEFAULT '';
UPDATE items SET templateid=NULL WHERE templateid=0;
UPDATE items SET templateid=NULL WHERE NOT templateid IS NULL AND NOT templateid IN (SELECT itemid FROM items);
UPDATE items SET valuemapid=NULL WHERE valuemapid=0;
UPDATE items SET valuemapid=NULL WHERE NOT valuemapid IS NULL AND NOT valuemapid IN (SELECT valuemapid from valuemaps);
UPDATE items SET units='Bps' WHERE type=9 AND units='bps';
DELETE FROM items WHERE NOT hostid IN (SELECT hostid FROM hosts);
ALTER TABLE items ADD CONSTRAINT c_items_1 FOREIGN KEY (hostid) REFERENCES hosts (hostid) ON DELETE CASCADE;
ALTER TABLE items ADD CONSTRAINT c_items_2 FOREIGN KEY (templateid) REFERENCES items (itemid) ON DELETE CASCADE;
ALTER TABLE items ADD CONSTRAINT c_items_3 FOREIGN KEY (valuemapid) REFERENCES valuemaps (valuemapid);
