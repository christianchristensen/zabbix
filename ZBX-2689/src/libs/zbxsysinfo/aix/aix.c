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

ZBX_METRIC	parameters_specific[] = {
/*	KEY			FLAG		FUNCTION	ADD_PARAM	TEST_PARAM */
	{"kernel.maxfiles",	0,		KERNEL_MAXFILES,	NULL,	NULL},
	{"kernel.maxproc",	0,		KERNEL_MAXPROC,		NULL,	NULL},

	{"vfs.fs.size",		CF_USEUPARAM,	VFS_FS_SIZE,		NULL,	"/,free"},
	{"vfs.fs.inode",	CF_USEUPARAM,	VFS_FS_INODE,		NULL,	"/,free"},
	{"vfs.fs.discovery",	0,		VFS_FS_DISCOVERY,	NULL,	NULL},

	{"vfs.dev.read",	CF_USEUPARAM,	VFS_DEV_READ,		NULL,	"hda,ops,avg1"},
	{"vfs.dev.write",	CF_USEUPARAM,	VFS_DEV_WRITE,		NULL,	"hda,ops,avg1"},

	{"net.if.in",		CF_USEUPARAM,	NET_IF_IN,		NULL,	"lo0,bytes"},
	{"net.if.out",		CF_USEUPARAM,	NET_IF_OUT,		NULL,	"lo0,bytes"},
	{"net.if.total",	CF_USEUPARAM,	NET_IF_TOTAL,		NULL,	"lo0,bytes"},
	{"net.if.collisions",	CF_USEUPARAM,	NET_IF_COLLISIONS,	NULL,	"lo0"},
	{"net.if.discovery",	0,		NET_IF_DISCOVERY,	NULL,	NULL},

	{"net.tcp.listen",	CF_USEUPARAM,	NET_TCP_LISTEN,		NULL,	"80"},

	{"vm.memory.size",	CF_USEUPARAM,	VM_MEMORY_SIZE,		NULL,	"free"},

	{"proc.num",		CF_USEUPARAM,	PROC_NUM,		NULL,	"inetd,,"},
	{"proc.mem",		CF_USEUPARAM,	PROC_MEMORY,		NULL,	"inetd,,"},

	{"system.cpu.switches",	0,		SYSTEM_CPU_SWITCHES,	NULL,	NULL},
	{"system.cpu.intr",	0,		SYSTEM_CPU_INTR,	NULL,	NULL},
	{"system.cpu.util",	CF_USEUPARAM,	SYSTEM_CPU_UTIL,	NULL,	"all,user,avg1"},
	{"system.cpu.load",	CF_USEUPARAM,	SYSTEM_CPU_LOAD,	NULL,	"all,avg1"},
	{"system.cpu.num",	CF_USEUPARAM,	SYSTEM_CPU_NUM,		NULL,	"online"},

	{"system.swap.size",	CF_USEUPARAM,	SYSTEM_SWAP_SIZE,	NULL,	"all,free"},
	{"system.swap.in",	CF_USEUPARAM,	SYSTEM_SWAP_IN,		NULL,	"all"},
	{"system.swap.out",	CF_USEUPARAM,	SYSTEM_SWAP_OUT,	NULL,	"all,count"},

	{"system.uptime",	0,		SYSTEM_UPTIME,		NULL,	NULL},

	{"system.stat",		CF_USEUPARAM,	SYSTEM_STAT,		NULL,	"page,fi"},

	{0}
	};
