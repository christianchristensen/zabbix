ALTER TABLE history ALTER COLUMN itemid SET WITH DEFAULT NULL;
REORG TABLE history;
ALTER TABLE history ADD ns integer WITH DEFAULT '0' NOT NULL;
REORG TABLE history;
