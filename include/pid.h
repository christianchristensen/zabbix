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

#ifndef ZABBIX_PID_H
#define ZABBIX_PID_H

#if defined(WIN32)
#	error "This module allowed only for Linux OS"
#endif

#if !defined(USE_PID_FILE)
#	error "To use this module use USE_PID_FILE definision before including."
#endif

int	create_pid_file(const char *pidfile);
void	drop_pid_file(const char *pidfile);

#endif
