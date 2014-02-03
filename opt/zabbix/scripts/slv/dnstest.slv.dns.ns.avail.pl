#!/usr/bin/perl -w
#
# DNS NS availability

use lib '/opt/zabbix/scripts';

use DNSTest;
use DNSTestSLV2;

my $cfg_key_in = 'dnstest.dns.udp.rtt[{$DNSTEST.TLD},';
my $cfg_key_out = 'dnstest.slv.dns.ns.avail[';

parse_opts();
exit_if_running();

my $config = get_dnstest_config();
set_slv_config($config);

my ($from, $till, $value_ts) = get_minute_bounds();

info("from:$from till:$till value_ts:$value_ts");

db_connect();

my $cfg_minonline = get_macro_dns_probe_online();
my $cfg_max_value = get_macro_dns_udp_rtt();

process_slv_ns_avail($tld, $cfg_key_in, $cfg_key_out, $from, $till, $value_ts, $cfg_minonline, SLV_UNAVAILABILITY_LIMIT, \&check_item_value);

slv_exit(SUCCESS);

sub check_item_value
{
    my $value = shift;

    return (is_service_error($value) == SUCCESS or $value > RTT_LIMIT_MULTIPLIER * $cfg_max_value) ? FAIL : SUCCESS;
}
