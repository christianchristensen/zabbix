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

#include "common.h"
#include "sysinfo.h"
#include "zbxjson.h"

int	VFS_FS_SIZE(const char *cmd, const char *param, unsigned flags, AGENT_RESULT *result)
{
	char		path[MAX_PATH], mode[20];
	LPTSTR		wpath;
	ULARGE_INTEGER	freeBytes, totalBytes;

	if (num_param(param) > 2)
		return SYSINFO_RET_FAIL;

	if (0 != get_param(param, 1, path, MAX_PATH))
		return SYSINFO_RET_FAIL;

	if (0 != get_param(param, 2, mode, sizeof(mode)))
		*mode = '\0';

	wpath = zbx_utf8_to_unicode(path);
	if (0 == GetDiskFreeSpaceEx(wpath, &freeBytes, &totalBytes, NULL))
	{
		zbx_free(wpath);
		return SYSINFO_RET_FAIL;
	}
	zbx_free(wpath);

	if ('\0' == *mode || 0 == strcmp(mode, "total"))	/* default parameter */
		SET_UI64_RESULT(result, totalBytes.QuadPart)
	else if (0 == strcmp(mode, "free"))
		SET_UI64_RESULT(result, freeBytes.QuadPart)
	else if (0 == strcmp(mode, "used"))
		SET_UI64_RESULT(result, totalBytes.QuadPart - freeBytes.QuadPart)
	else if (0 == strcmp(mode, "pfree"))
		SET_DBL_RESULT(result, (double)(__int64)freeBytes.QuadPart * 100. / (double)(__int64)totalBytes.QuadPart)
	else if (0 == strcmp(mode, "pused"))
		SET_DBL_RESULT(result, (double)((__int64)totalBytes.QuadPart - (__int64)freeBytes.QuadPart) * 100. /
				(double)(__int64)totalBytes.QuadPart)
	else
		return SYSINFO_RET_FAIL;

	return SYSINFO_RET_OK;
}

int	VFS_FS_DISCOVERY(const char *cmd, const char *param, unsigned flags, AGENT_RESULT *result)
{
	LPTSTR		buffer = NULL, p;
	char		*utf8;
	DWORD		dwSize;
	size_t		sz;
	struct zbx_json	j;

	assert(result);

	/* Make an initial call to GetLogicalDriveStrings to
	   get the necessary size into the dwSize variable */
	if (0 == (dwSize = GetLogicalDriveStrings(0, buffer)))
		return SYSINFO_RET_FAIL;

	buffer = (LPTSTR)zbx_malloc(buffer, (dwSize + 1) * sizeof(TCHAR));

	/* Make a second call to GetLogicalDriveStrings to get
	   the actual data we require */
	if (0 == (dwSize = GetLogicalDriveStrings(dwSize, buffer)))
	{
		zbx_free(buffer);
		return SYSINFO_RET_FAIL;
	}

	zbx_json_init(&j, ZBX_JSON_STAT_BUF_LEN);

	zbx_json_addarray(&j, cmd);

	for (p = buffer, sz = wcslen(p); sz > 0; p += sz + 1, sz = wcslen(p))
	{
		utf8 = zbx_unicode_to_utf8(p);

		zbx_json_addobject(&j, NULL);
		zbx_json_addstring(&j, "{#FSNAME}", utf8, ZBX_JSON_TYPE_STRING);
		zbx_json_close(&j);

		zbx_free(utf8);
	}

	zbx_free(buffer);

	zbx_json_close(&j);

	SET_STR_RESULT(result, strdup(j.buffer));

	zbx_json_free(&j);

	return SYSINFO_RET_OK;
}
