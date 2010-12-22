<?php
/*
** ZABBIX
** Copyright (C) 2000-2008 SIA Zabbix
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
?>
<?php
	global $TRANSLATION;

	$TRANSLATION=array(

	'S_DATE_FORMAT_YMDHMS'=>			'd M H:i:s',
	'S_DATE_FORMAT_YMD'=>			'd M Y',
	'S_HTML_CHARSET'=>			'UTF-8',
	'S_ACTIONS'=>			'Azioni',
	'S_ACTION_ADDED'=>			'Azione aggiunta!',
	'S_CANNOT_ADD_ACTION'=>			'Non riesco ad aggiungere l\'azione',
	'S_ACTION_UPDATED'=>			'Ho aggiornato l\'azione',
	'S_CANNOT_UPDATE_ACTION'=>			'Non posso aggiornare l\'azione',
	'S_ACTION_DELETED'=>			'Azione rimossa!',
	'S_CANNOT_DELETE_ACTION'=>			'Non posso cancellare l\'azione',
	'S_SEND_MESSAGE_TO'=>			'Manda il messaggio a:',
	'S_DELAY'=>			'Con ritardo (in sec)',
	'S_SUBJECT'=>			'Oggetto',
	'S_ON'=>			'ON',
	'S_OFF'=>			'OFF',
	'S_NO_ACTIONS_DEFINED'=>			'Nessuna azione definita',
	'S_SINGLE_USER'=>			'Utente singolo',
	'S_USER_GROUP'=>			'Gruppo di utenti',
	'S_GROUP'=>			'Gruppo',
	'S_USER'=>			'Utente',
	'S_MESSAGE'=>			'Messaggio',
	'S_NOT_CLASSIFIED'=>			'Non classificato',
	'S_INFORMATION'=>			'Solo informativo',
	'S_WARNING'=>			'Avvertimento',
	'S_AVERAGE'=>			'Allarme medio',
	'S_HIGH'=>			'Grave allarme',
	'S_DISASTER'=>			'Disastro!',
	'S_SHOW_ALL'=>			'Mostra tutti',
	'S_TIME'=>			'Data e ora',
	'S_STATUS'=>			'Stato',
	'S_DURATION'=>			'Durata',
	'S_TRUE_BIG'=>			'VERO',
	'S_FALSE_BIG'=>			'FALSO',
	'S_UNKNOWN_BIG'=>			'NON RILEVABILE',
	'S_TYPE'=>			'Tipo',
	'S_RECIPIENTS'=>			'Destinatari',
	'S_ERROR'=>			'Errore',
	'S_SENT'=>			'spedito',
	'S_NOT_SENT'=>			'non spedito',
	'S_CUSTOM_GRAPHS'=>			'Grafici',
	'S_GRAPHS_BIG'=>			'GRAFICI',
	'S_SELECT_GRAPH_TO_DISPLAY'=>			'Seleziona il grafico',
	'S_PERIOD'=>			'Periodo',
	'S_SELECT_GRAPH_DOT_DOT_DOT'=>			'Seleziona...',
	'S_CONFIGURATION_OF_ZABBIX'=>			'Configurazione di ZABBIX',
	'S_CONFIGURATION_OF_ZABBIX_BIG'=>			'CONFIGURAZIONE DI ZABBIX',
	'S_CONFIGURATION_UPDATED'=>			'Configurazione aggiornata',
	'S_CONFIGURATION_WAS_NOT_UPDATED'=>			'La configuration non è stata aggiornat',
	'S_ADDED_NEW_MEDIA_TYPE'=>			'Nuovo mezzo aggiunto',
	'S_NEW_MEDIA_TYPE_WAS_NOT_ADDED'=>			'Il nuovo mezzo non è stato aggiunto',
	'S_MEDIA_TYPE_UPDATED'=>			'Mezzo aggiornato!',
	'S_MEDIA_TYPE_WAS_NOT_UPDATED'=>			'Il mezzo non è stato aggiornato',
	'S_MEDIA_TYPE_DELETED'=>			'Il mezzo è stato rimosso',
	'S_MEDIA_TYPE_WAS_NOT_DELETED'=>			'Il mezzo non è stato rimosso',
	'S_CONFIGURATION'=>			'Configurazione',
	'S_DO_NOT_KEEP_ACTIONS_OLDER_THAN'=>			'Non mantenere le azioni più vecchie di (in giorni)',
	'S_DO_NOT_KEEP_EVENTS_OLDER_THAN'=>			'Non mantenere gli eventi più vecchi di (in giorni)',
	'S_NO_MEDIA_TYPES_DEFINED'=>			'Nessun mezzo definito',
	'S_SMTP_SERVER'=>			'SMTP server',
	'S_SMTP_HELO'=>			'SMTP helo',
	'S_SMTP_EMAIL'=>			'SMTP email',
	'S_SCRIPT_NAME'=>			'Nome script',
	'S_DELETE_SELECTED_MEDIA'=>			'Cancellare il mezzo selezionato?',
	'S_DELETE_SELECTED_IMAGE'=>			'Cancellare l\'immagine selezionata?',
	'S_HOUSEKEEPER'=>			'Pulizia database',
	'S_MEDIA_TYPES'=>			'Tipi di mezzo',
	'S_ESCALATION_RULES'=>			'Regole di escalation',
	'S_ESCALATION'=>			'Escalation',
	'S_ESCALATION_RULE'=>			'Regola di escalation',
	'S_DEFAULT'=>			'Default',
	'S_IMAGES'=>			'Immagini',
	'S_IMAGE'=>			'Immagine',
	'S_IMAGES_BIG'=>			'IMMAGINI',
	'S_ICON'=>			'Icona',
	'S_NO_IMAGES_DEFINED'=>			'Nessuna immagine definita',
	'S_BACKGROUND'=>			'Sfondo',
	'S_UPLOAD'=>			'Carica',
	'S_IMAGE_ADDED'=>			'Immagine aggiunta',
	'S_CANNOT_ADD_IMAGE'=>			'Non posso aggiongere l\'immagine',
	'S_IMAGE_DELETED'=>			'Immagine rimossa',
	'S_CANNOT_DELETE_IMAGE'=>			'Non posso rimuovere l\'immagine',
	'S_IMAGE_UPDATED'=>			'Image updated',
	'S_CANNOT_UPDATE_IMAGE'=>			'Cannot update image',
	'S_NO_PERMISSIONS'=>			'Accesso negato!',
	'S_ALL_SMALL'=>			'tutti',
	'S_GRAPH'=>			'Graph',
	'S_COPYRIGHT_BY'=>			'Copyright 2001-2006 by',
	'S_CONNECTED_AS'=>			'Connesso come utente:',
	'S_SIA_ZABBIX'=>			'SIA Zabbix',
	'S_ITEM_ADDED'=>			'Elemento agguinto!',
	'S_ITEM_UPDATED'=>			'Elemento aggiornato!',
	'S_PARAMETER'=>			'Parametro',
	'S_COLOR'=>			'Colore',
	'S_UP'=>			'S',
	'S_DOWN'=>			'Gi',
	'S_NEW_ITEM_FOR_THE_GRAPH'=>			'Aggiungi il seguente elemento',
	'S_SORT_ORDER_0_100'=>			'Posizione (0->100)',
	'S_CONFIGURATION_OF_GRAPHS'=>			'Configurazione grafici',
	'S_CONFIGURATION_OF_GRAPHS_BIG'=>			'CONFIGURAZIONE GRAFICI',
	'S_GRAPH_ADDED'=>			'Grafico aggiunto!',
	'S_GRAPH_UPDATED'=>			'Grafico aggiornato!',
	'S_CANNOT_UPDATE_GRAPH'=>			'Non posso aggiornare il grafico',
	'S_GRAPH_DELETED'=>			'Grafico rimosso!',
	'S_CANNOT_DELETE_GRAPH'=>			'Non posso rimuovere il grafico',
	'S_CANNOT_ADD_GRAPH'=>			'Non posso aggiungere il grafico',
	'S_ID'=>			'Id',
	'S_NO_GRAPHS_DEFINED'=>			'Nessun grafico definito',
	'S_DELETE_GRAPH_Q'=>			'Rimuovere il grafico?',
	'S_YAXIS_MIN_VALUE'=>			'Y minimo',
	'S_YAXIS_MAX_VALUE'=>			'Y massimo',
	'S_CALCULATED'=>			'Automatico',
	'S_FIXED'=>			'Fisso',
	'S_LAST_HOUR_GRAPH'=>			'Grafico dell\'ultima ora',
	'S_TIMESTAMP'=>			'Data e ora',
	'S_HOSTS'=>			'Dispositivi',
	'S_ITEMS'=>			'Parametri',
	'S_TRIGGERS'=>			'Inneschi',
	'S_GRAPHS'=>			'Grafici',
	'S_HOST_ADDED'=>			'Dispositivo aggiunto!',
	'S_CANNOT_ADD_HOST'=>			'Non posso aggiungere il dispositivo',
	'S_HOST_UPDATED'=>			'Dispositivo aggiornato!',
	'S_CANNOT_UPDATE_HOST'=>			'Non posso aggiornare il dispositivo',
	'S_HOST_STATUS_UPDATED'=>			'Stato del dispositivo aggiornato!',
	'S_CANNOT_UPDATE_HOST_STATUS'=>			'Non posso aggiornare lo stato del dispositivo',
	'S_HOST_DELETED'=>			'Dispositivo rimosso!',
	'S_CANNOT_DELETE_HOST'=>			'Non posso rimuovere il dispositivo',
	'S_HOST_GROUPS_BIG'=>			'GRUPPI DI DISPOSITIVI',
	'S_NO_HOST_GROUPS_DEFINED'=>			'Nessun gruppo di dispositivi definito',
	'S_NO_HOSTS_DEFINED'=>			'Nessun dispositivo definito',
	'S_HOSTS_BIG'=>			'DISPOSITIVI',
	'S_HOST'=>			'Dispositivo',
	'S_IP'=>			'IP',
	'S_PORT'=>			'Porta',
	'S_MONITORED'=>			'Abilitato',
	'S_NOT_MONITORED'=>			'Disabilitato',
	'S_TEMPLATE'=>			'Modello',
	'S_DELETED'=>			'Rimosso',
	'S_UNKNOWN'=>			'Non rilevabile',
	'S_GROUPS'=>			'Gruppi',
	'S_NEW_GROUP'=>			'Nuovo gruppo',
	'S_IP_ADDRESS'=>			'Indirizzo IP',
	'S_DELETE_SELECTED_HOST_Q'=>			'Rimuovi il dispositivo selezionato?',
	'S_GROUP_NAME'=>			'Nome del gruppo',
	'S_HOST_GROUP'=>			'Gruppo del dispositivo',
	'S_HOST_GROUPS'=>			'Gruppi del dispositivo',
	'S_UPDATE'=>			'Aggiorna',
	'S_AVAILABILITY'=>			'Disponibilit',
	'S_AVAILABLE'=>			'Disponibile',
	'S_NOT_AVAILABLE'=>			'Errore!',
	'S_TEMPLATES'=>			'Modelli',
	'S_CONFIGURATION_OF_ITEMS'=>			'Configurazione parametri',
	'S_CONFIGURATION_OF_ITEMS_BIG'=>			'CONFIGURAZIONE PARAMETRI',
	'S_CANNOT_UPDATE_ITEM'=>			'Non posso aggiornare il parametro',
	'S_STATUS_UPDATED'=>			'Stato aggiornato!',
	'S_CANNOT_UPDATE_STATUS'=>			'Non posso aggiornare lo stato!',
	'S_CANNOT_ADD_ITEM'=>			'Non posso aggiungere il parametro',
	'S_ITEM_DELETED'=>			'Parametro rimosso!',
	'S_CANNOT_DELETE_ITEM'=>			'Non posso rimuovere il parametro',
	'S_ITEMS_DELETED'=>			'Parametri rimossi!',
	'S_CANNOT_DELETE_ITEMS'=>			'Non posso rimuovere i parametri',
	'S_ITEMS_ACTIVATED'=>			'Parametro attivato',
	'S_ITEMS_DISABLED'=>			'Parametri disabilitati!',
	'S_KEY'=>			'Chiave',
	'S_DESCRIPTION'=>			'Descrizione',
	'S_UPDATE_INTERVAL'=>			'Aggiorna ogni (in sec)',
	'S_HISTORY'=>			'Storico',
	'S_TRENDS'=>			'Trends (in gg)',
	'S_ZABBIX_AGENT'=>			'Modulo ZABBIX (PASSIVO)',
	'S_ZABBIX_AGENT_ACTIVE'=>			'Modulo ZABBIX (ATTIVO)',
	'S_SNMPV1_AGENT'=>			'Modulo SNMPv1',
	'S_ZABBIX_TRAPPER'=>			'Trapper ZABBIX',
	'S_SIMPLE_CHECK'=>			'Controlli base',
	'S_SNMPV2_AGENT'=>			'Modulo SNMPv2',
	'S_SNMPV3_AGENT'=>			'Modulo SNMPv3',
	'S_ZABBIX_INTERNAL'=>			'ZABBIX interno',
	'S_ACTIVE'=>			'Attivo',
	'S_NOT_SUPPORTED'=>			'Non supportato',
	'S_EMAIL'=>			'Email',
	'S_SCRIPT'=>			'Script',
	'S_UNITS'=>			'Unit',
	'S_UPDATE_INTERVAL_IN_SEC'=>			'Intervallo di aggiornameto (in sec)',
	'S_KEEP_HISTORY_IN_DAYS'=>			'Storico da mantenere (in gg)',
	'S_KEEP_TRENDS_IN_DAYS'=>			'Trend da mantenere (in gg)',
	'S_TYPE_OF_INFORMATION'=>			'Tipo di dato',
	'S_STORE_VALUE'=>			'Memorizza il valore',
	'S_NUMERIC_UNSIGNED'=>			'Numerico (integer 64bit)',
	'S_NUMERIC_FLOAT'=>			'Numerico (float)',
	'S_CHARACTER'=>			'Alfabetico',
	'S_LOG'=>			'Log',
	'S_AS_IS'=>			'Così com\'è',
	'S_DELTA_SPEED_PER_SECOND'=>			'Come velocità (delta nell\'intervallo di tempo)',
	'S_DELTA_SIMPLE_CHANGE'=>			'Come differenza semplice tra i due ultimi valori',
	'S_ITEM'=>			'Parametro',
	'S_SNMP_COMMUNITY'=>			'SNMP community',
	'S_SNMP_OID'=>			'SNMP OID',
	'S_SNMP_PORT'=>			'SNMP port',
	'S_ALLOWED_HOSTS'=>			'Dispositivi concessi',
	'S_SNMPV3_SECURITY_NAME'=>			'SNMPv3 security name',
	'S_SNMPV3_SECURITY_LEVEL'=>			'SNMPv3 security level',
	'S_SNMPV3_AUTH_PASSPHRASE'=>			'SNMPv3 auth passphrase',
	'S_SNMPV3_PRIV_PASSPHRASE'=>			'SNMPv3 priv passphrase',
	'S_CUSTOM_MULTIPLIER'=>			'Moltiplicatore variabile',
	'S_DO_NOT_USE'=>			'Non usare',
	'S_USE_MULTIPLIER'=>			'Usa il moltiplicatore',
	'S_SELECT_HOST_DOT_DOT_DOT'=>			'Seleziona dispositivo...',
	'S_LATEST_EVENTS'=>			'Ultimi eventi',
	'S_HISTORY_OF_EVENTS_BIG'=>			'STORICO EVENTI',
	'S_LAST_CHECK'=>			'Ultimo aggiornamento',
	'S_LAST_VALUE'=>			'Ultimo dato',
	'S_LABEL'=>			'Etichetta',
	'S_X'=>			'X',
	'S_Y'=>			'Y',
	'S_LINK_STATUS_INDICATOR'=>			'Indicatore dello stato del collegamento',
	'S_OK_BIG'=>			'OK',
	'S_ZABBIX_URL'=>			'http://www.zabbix.com',
	'S_NETWORK_MAPS'=>			'Mappe di rete',
	'S_NETWORK_MAPS_BIG'=>			'MAPPE DI RETE',
	'S_BACKGROUND_IMAGE'=>			'Immagine di sfondo',
	'S_ICON_LABEL_TYPE'=>			'Tipo etichetta dell\'icona',
	'S_STATUS_ONLY'=>			'Solo lo stato',
	'S_NOTHING'=>			'Niente',
	'S_MEDIA'=>			'Mezzi',
	'S_SEND_TO'=>			'Spedisci a',
	'S_WHEN_ACTIVE'=>			'Quando è attivo',
	'S_NO_MEDIA_DEFINED'=>			'Nessun mezzo definito',
	'S_NEW_MEDIA'=>			'Nuovo mezzo',
	'S_USE_IF_SEVERITY'=>			'Usa se la severità è',
	'S_OVERVIEW'=>			'Panoramica',
	'S_OVERVIEW_BIG'=>			'PANORAMICA',
	'S_DATA'=>			'Dati',
	'S_QUEUE_BIG'=>			'CODA',
	'S_QUEUE_OF_ITEMS_TO_BE_UPDATED_BIG'=>			'CODA DEI PARAMETRI DA AGGIORNARE',
	'S_NEXT_CHECK'=>			'Prossimo controllo',
	'S_THE_QUEUE_IS_EMPTY'=>			'La coda è vuota',
	'S_TOTAL'=>			'Totale',
	'S_COUNT'=>			'Quanti?',
	'S_5_SECONDS'=>			'5 secondi',
	'S_10_SECONDS'=>			'10 secondi',
	'S_30_SECONDS'=>			'30 secondi',
	'S_1_MINUTE'=>			'1 minuto',
	'S_5_MINUTES'=>			'5 minuti',
	'S_STATUS_OF_ZABBIX'=>			'Stato del server',
	'S_STATUS_OF_ZABBIX_BIG'=>			'STATO DEL SERVER',
	'S_VALUE'=>			'Valore',
	'S_ZABBIX_SERVER_IS_RUNNING'=>			'Il server è attivo?',
	'S_NUMBER_OF_ALERTS'=>			'Numero di azioni intraprese',
	'S_NUMBER_OF_USERS'=>			'Numero di utenti',
	'S_YES'=>			'S',
	'S_NO'=>			'No',
	'S_AVAILABILITY_REPORT'=>			'Rapporto di stato',
	'S_AVAILABILITY_REPORT_BIG'=>			'RAPPORTO DI STATO',
	'S_SHOW'=>			'Mostra...',
	'S_IT_SERVICES_AVAILABILITY_REPORT_BIG'=>			'RAPPORTO SERVIZI IT',
	'S_FROM'=>			'Da',
	'S_TILL'=>			'Fino a',
	'S_OK'=>			'Ok',
	'S_PROBLEMS'=>			'Qualche problema',
	'S_PERCENTAGE'=>			'Percentuale',
	'S_SLA'=>			'SLA',
	'S_DAY'=>			'Giorno',
	'S_MONTH'=>			'Mese',
	'S_YEAR'=>			'Anno',
	'S_DAILY'=>			'Quotidianamente',
	'S_WEEKLY'=>			'Settimanalmente',
	'S_MONTHLY'=>			'Mensilmente',
	'S_YEARLY'=>			'Annuariamente',
	'S_SCREENS'=>			'Schermate',
	'S_SCREEN'=>			'Nuova schermata',
	'S_CONFIGURATION_OF_SCREENS_BIG'=>			'CONFIGURAZIONE DELLE SCHERMATE',
	'S_SCREEN_ADDED'=>			'Schermata aggiunta!',
	'S_CANNOT_ADD_SCREEN'=>			'Non posso aggiungere la schermata',
	'S_SCREEN_UPDATED'=>			'Schermata aggiornata!',
	'S_CANNOT_UPDATE_SCREEN'=>			'Non posso aggiornare la schermata',
	'S_SCREEN_DELETED'=>			'Schermata rimossa!',
	'S_CANNOT_DELETE_SCREEN'=>			'Non posso rimuovere la schermata',
	'S_COLUMNS'=>			'Colonne',
	'S_ROWS'=>			'Righe',
	'S_NO_SCREENS_DEFINED'=>			'Nessuna schermata definita',
	'S_DELETE_SCREEN_Q'=>			'Rimuovo la schermata?',
	'S_CONFIGURATION_OF_SCREEN_BIG'=>			'CONFIGURAZIONE DELLA SCHERMATA',
	'S_SCREEN_CELL_CONFIGURATION'=>			'Configurazione della cella',
	'S_RESOURCE'=>			'Risorsa',
	'S_SIMPLE_GRAPH'=>			'Grafico semplice',
	'S_GRAPH_NAME'=>			'Nome del grafico',
	'S_WIDTH'=>			'Larghezza pixels',
	'S_HEIGHT'=>			'Altezza pixels',
	'S_MAP'=>			'Mappa',
	'S_PLAIN_TEXT'=>			'In formato testo',
	'S_COLUMN_SPAN'=>			'Espandi su X colonne',
	'S_ROW_SPAN'=>			'Espandi su X righe',
	'S_RIGHT'=>			'Diritto',
	'S_CUSTOM_SCREENS'=>			'Schermate definite',
	'S_SCREENS_BIG'=>			'SCHERMATE DEFINITE',
	'S_IT_SERVICES'=>			'Servizi IT',
	'S_SERVICE_UPDATED'=>			'Servizio aggiornato!',
	'S_CANNOT_UPDATE_SERVICE'=>			'Non posso aggiornare il servizio',
	'S_SERVICE_ADDED'=>			'Servizio aggiunto!',
	'S_CANNOT_ADD_SERVICE'=>			'Non posso aggiungere il servizio',
	'S_SERVICE_DELETED'=>			'Servizio rimosso!',
	'S_CANNOT_DELETE_SERVICE'=>			'Non posso rimuovere il servizio',
	'S_STATUS_CALCULATION'=>			'Calcolo dello stato',
	'S_STATUS_CALCULATION_ALGORITHM'=>			'Algoritmo di calcolo dello stato',
	'S_NONE'=>			'Assente',
	'S_SOFT'=>			'Soft',
	'S_DO_NOT_CALCULATE'=>			'Nessun calcolo',
	'S_ACCEPTABLE_SLA_IN_PERCENT'=>			'Percentuale accettabile di SLA',
	'S_LINK_TO_TRIGGER_Q'=>			'Collegato all\'innesco?',
	'S_SORT_ORDER_0_999'=>			'Priorità (0->999)',
	'S_TRIGGER'=>			'Specifica l\'innesco collegato',
	'S_SERVER'=>			'Dispositivo',
	'S_DELETE'=>			'Rimuovi',
	'S_DEPENDS_ON'=>			'Dipende da',
	'S_IT_SERVICES_BIG'=>			'SERVIZI IT',
	'S_SERVICE'=>			'Servizio',
	'S_REASON'=>			'Causa',
	'S_CONFIGURATION_OF_TRIGGERS'=>			'Configurazione inneschi',
	'S_CONFIGURATION_OF_TRIGGERS_BIG'=>			'CONFIGURAZIONE INNESCHI',
	'S_TRIGGERS_DELETED'=>			'Inneschi rimossi!',
	'S_CANNOT_DELETE_TRIGGERS'=>			'Non posso rimuovere gli innesschi',
	'S_TRIGGER_DELETED'=>			'Innesco rimosso!',
	'S_CANNOT_DELETE_TRIGGER'=>			'Non posso rimuovere l\'innesco',
	'S_TRIGGER_ADDED'=>			'Innesco aggiunto!',
	'S_CANNOT_ADD_TRIGGER'=>			'Non posso aggiungere l\'innesco',
	'S_SEVERITY'=>			'Livello',
	'S_EXPRESSION'=>			'Formula di calcolo',
	'S_DISABLED'=>			'Disabilitato',
	'S_ENABLED'=>			'Abilitato',
	'S_CHANGE'=>			'Differenza',
	'S_TRIGGER_UPDATED'=>			'Innesco aggiornato!',
	'S_CANNOT_UPDATE_TRIGGER'=>			'Non posso aggiornare l\'innesco',
	'S_TRIGGER_COMMENTS'=>			'Note sull\'innesco',
	'S_TRIGGER_COMMENTS_BIG'=>			'NOTE SULL\'INNESCO',
	'S_COMMENT_UPDATED'=>			'Commento aggiornato!',
	'S_CANNOT_UPDATE_COMMENT'=>			'Non posso aggiornare il commento',
	'S_ADD'=>			'Aggiungi',
	'S_STATUS_OF_TRIGGERS'=>			'Stato degli inneschi',
	'S_STATUS_OF_TRIGGERS_BIG'=>			'STATO DEGLI INNESCHI',
	'S_SHOW_DETAILS'=>			'Mostra i dettagli',
	'S_SELECT'=>			'Mostra barra di selezione',
	'S_TRIGGERS_BIG'=>			'INNESCHI',
	'S_LAST_CHANGE'=>			'Ultimo innesco il',
	'S_COMMENTS'=>			'Commenti',
	'S_USERS'=>			'Utenti',
	'S_USER_ADDED'=>			'Utente aggiunto',
	'S_CANNOT_ADD_USER'=>			'Non posso aggiungere l\'utente',
	'S_CANNOT_ADD_USER_BOTH_PASSWORDS_MUST'=>			'Attenzione! Le due password devono essere uguali.',
	'S_USER_DELETED'=>			'Utente rimosso',
	'S_CANNOT_DELETE_USER'=>			'Non posso rimuovere l\'utente',
	'S_USER_UPDATED'=>			'Aggiornamento eseguito',
	'S_CANNOT_UPDATE_USER'=>			'Non posso eseguire l\'aggiornamento',
	'S_CANNOT_UPDATE_USER_BOTH_PASSWORDS'=>			'Attenzione! Le due password devono essere uguali.',
	'S_GROUP_ADDED'=>			'Gruppo aggiunto',
	'S_CANNOT_ADD_GROUP'=>			'Non posso aggiungere il gruppo',
	'S_GROUP_UPDATED'=>			'Gruppo aggiornato',
	'S_CANNOT_UPDATE_GROUP'=>			'Non posso aggiornare il gruppo',
	'S_GROUP_DELETED'=>			'Gruppo rimosso',
	'S_CANNOT_DELETE_GROUP'=>			'Non posso rimuovere il gruppo',
	'S_CONFIGURATION_OF_USERS_AND_USER_GROUPS'=>			'CONFIGURAZIONE UTENTI E GRUPPI',
	'S_USER_GROUPS_BIG'=>			'GRUPPI',
	'S_USERS_BIG'=>			'UTENTI',
	'S_USER_GROUPS'=>			'Gruppi utenti',
	'S_MEMBERS'=>			'Membri',
	'S_NO_USER_GROUPS_DEFINED'=>			'Nessun gruppo utenti definito',
	'S_ALIAS'=>			'Alias',
	'S_NAME'=>			'Nome',
	'S_SURNAME'=>			'Cognome',
	'S_IS_ONLINE_Q'=>			'E\' collegato?',
	'S_NO_USERS_DEFINED'=>			'Nessun utente definito',
	'S_READ_ONLY'=>			'Sola lettura',
	'S_READ_WRITE'=>			'Lettura-scrittura',
	'S_HIDE'=>			'Nascondi',
	'S_PASSWORD'=>			'Password',
	'S_PASSWORD_ONCE_AGAIN'=>			'Password (ripeti)',
	'S_URL_AFTER_LOGIN'=>			'URL (dopo il login)',
	'S_SCREEN_REFRESH'=>			'Refresh (in seconds)',
	'S_ACTION'=>			'Action',
	'S_DETAILS'=>			'Details',
	'S_UNKNOWN_ACTION'=>			'Unknown action',
	'S_ADDED'=>			'Added',
	'S_UPDATED'=>			'Updated',
	'S_MEDIA_TYPE'=>			'Media type',
	'S_GRAPH_ELEMENT'=>			'Graph element',
	'S_USER_PROFILE_BIG'=>			'PROFILO UTENTE',
	'S_USER_PROFILE'=>			'Profilo utente',
	'S_LANGUAGE'=>			'Lingua',
	'S_ENGLISH_GB'=>			'Inglese (GB)',
	'S_FRENCH_FR'=>			'Francese (FR)',
	'S_GERMAN_DE'=>			'Tedesco (DE)',
	'S_ITALIAN_IT'=>			'Italiano (IT)',
	'S_LATVIAN_LV'=>			'Lituano (LV)',
	'S_RUSSIAN_RU'=>			'Russo (RU)',
	'S_ZABBIX_BIG'=>			'ZABBIX',
	'S_EMPTY'=>			'Vuoto',
	'S_HELP'=>			'Aiuto',
	'S_PROFILE'=>			'Profilo',
	'S_LATEST_DATA'=>			'ULTIMI VALORI',

	);
?>
