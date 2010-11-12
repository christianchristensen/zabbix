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
#include "symbols.h"

#include "log.h"

DWORD	(__stdcall *zbx_GetGuiResources)(HANDLE,DWORD)				= NULL;
BOOL	(__stdcall *zbx_GetProcessIoCounters)(HANDLE,PIO_COUNTERS)		= NULL;
BOOL	(__stdcall *zbx_GetPerformanceInfo)(PPERFORMANCE_INFORMATION,DWORD)	= NULL;
BOOL	(__stdcall *zbx_GlobalMemoryStatusEx)(LPMEMORYSTATUSEX)			= NULL;


static FARPROC GetProcAddressAndLog(HMODULE hModule,LPCSTR procName)
{
	FARPROC ptr;

	ptr=GetProcAddress(hModule,procName);
	if ( NULL == ptr )
		zabbix_log( LOG_LEVEL_DEBUG, "Unable to resolve symbol '%s'", procName);

	return ptr;
}

void import_symbols(void)
{
	HMODULE hModule;

	if(NULL != (hModule = GetModuleHandle("USER32.DLL")) )
	{
		zbx_GetGuiResources = (DWORD (__stdcall *)(HANDLE,DWORD))GetProcAddressAndLog(hModule,"GetGuiResources");
	}
	else
	{
		zabbix_log( LOG_LEVEL_DEBUG, "Unable to get handle to USER32.DLL");
	}

	if(NULL != (hModule=GetModuleHandle("KERNEL32.DLL")) )
	{
		zbx_GetProcessIoCounters = (BOOL (__stdcall *)(HANDLE,PIO_COUNTERS))GetProcAddressAndLog(hModule,"GetProcessIoCounters");
		zbx_GlobalMemoryStatusEx = (BOOL (__stdcall *)(LPMEMORYSTATUSEX))GetProcAddressAndLog(hModule,"GlobalMemoryStatusEx");
	}
	else
	{
		zabbix_log( LOG_LEVEL_DEBUG, "Unable to get handle to KERNEL32.DLL");
	}

	if(NULL != (hModule=GetModuleHandle("PSAPI.DLL")) )
	{
		zbx_GetPerformanceInfo = (BOOL (__stdcall *)(PPERFORMANCE_INFORMATION,DWORD))GetProcAddressAndLog(hModule,"GetPerformanceInfo");
	}
	else
	{
		zabbix_log( LOG_LEVEL_DEBUG, "Unable to get handle to PSAPI.DLL");
	}
}
