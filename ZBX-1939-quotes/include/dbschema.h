/*
** ZABBIX
** Copyright (C) 2000-2005 SIA Zabbix
**
** This program is free software; you can redistribute it and/or modify
** it under the terms of the GNU General Public License as published by
** the Free Software Foundation; either version 2 of the License, or
** (at your option) any later version.
**
** This program is distributed in the hope that it will be useful,
** but WITHOUT ANY WARRANTY; without even the implied warranty of
** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
** GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License
** along with this program; if not, write to the Free Software
** Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
**/


#ifndef ZABBIX_DBSYNC_H
#define ZABBIX_DBSYNC_H

#define ZBX_FIELD struct zbx_field_type
ZBX_FIELD
{
	char    *name;
	int	type;
	int	flags;
	char	*rel;
};

#define ZBX_MAX_FIELDS		64
#define ZBX_TABLENAME_LEN	64
#define ZBX_TABLENAME_LEN_MAX	ZBX_TABLENAME_LEN + 1
#define ZBX_FIELDNAME_LEN	64
#define ZBX_FIELDNAME_LEN_MAX	ZBX_FIELDNAME_LEN + 1

#define ZBX_TABLE struct zbx_table_type
ZBX_TABLE
{
	char    	*table;
	char		*recid;
	int		flags;
	ZBX_FIELD	fields[ZBX_MAX_FIELDS];
};

#ifdef HAVE_ORACLE
#	define ZBX_DBTYPE_INT64 "number(20)"
#elif HAVE_POSTGRESQL
#	define ZBX_DBTYPE_INT64 "bigint"
#elif HAVE_MYSQL
#	define ZBX_DBTYPE_INT64 "bigint unsigned"
#elif HAVE_SQLITE3
#	define ZBX_DBTYPE_INT64 "bigint"
#endif

extern ZBX_TABLE	tables[];
extern const char	*db_schema;

#endif
