<?hh // strict
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

namespace HHVM\UserDocumentation\Tests;

use function HHVM\UserDocumentation\{
  cidr_to_bitstring_and_bitmask,
  is_fb_ip_address,
  is_ip_in_range,
};
use function Facebook\FBExpect\expect;

final class IPUtilsTest extends \Facebook\HackTest\HackTest {

  <<DataProvider('getSubnetExamples')>>
  public function testIsInSubnet(
    string $subnet_cidr,
    vec<string> $ips_in_subnet,
    vec<string> $ips_not_in_subnet,
  ): void {
    $range = cidr_to_bitstring_and_bitmask($subnet_cidr);

    foreach($ips_in_subnet as $ip) {
      expect(is_ip_in_range($ip, $range))->toBeTrue(
        '%s is not in %s, but should be; subnet: %s, subnet mask: %s',
        $ip,
        $subnet_cidr,
        \inet_ntop($range[0]),
        \inet_ntop($range[1]),
      );
    }
    foreach($ips_not_in_subnet as $ip) {
      expect(is_ip_in_range($ip, $range))->toBeFalse(
        '%s is in %s, but should not be; subnet: %s, subnet mask: %s',
        $ip,
        $subnet_cidr,
        \inet_ntop($range[0]),
        \inet_ntop($range[1]),
      );
    }
  }

  public function getSubnetExamples(
  ): array<(string, vec<string>, vec<string>)> {
    return [
      tuple(
        '10.0.0.0/8',
        vec['10.0.0.1', '10.0.0.255', '10.255.255.255'],
        vec['127.0.0.1', '0.0.0.0', '10::', '9.0.0.1', '11.0.0.0'],
      ),
      tuple(
        '10.0.0.0/23',
        vec['10.0.0.1', '10.0.1.1', '10.0.1.255'],
        vec['10.0.10.1', '10.0.2.1'],
      ),
      tuple(
        '10.0.0.0/22',
        vec['10.0.0.1', '10.0.1.1', '10.0.1.255', '10.0.3.255'],
        vec['10.0.10.1', '10.0.4.0'],
      ),
      tuple(
        '199.201.64.0/24',
        vec['199.201.64.123'],
        vec['127.0.0.1'],
      ),
      tuple(
        'abcd::0/16',
        vec['abcd::1', 'abcd:1::0', 'abcd::'],
        vec['0.0.0.0', 'abce::1', 'abc::0' ],
      ),
      tuple(
        '2620:10d:c092::/48',
        vec['2620:10d:c092::123'],
        vec['::0'],
      ),
    ];
  }

  public function getExampleFacebookIPAddresses(): array<array<string>> {
    return [
      ['199.201.64.1'],
      ['2620:10d:c092::1'],
    ];
  }

  public function getExampleNonFacebookIPAddresses(): array<array<string>> {
    return [
      ['192.168.0.1'],
      ['127.0.0.1'],
      ['::1'],
      ['dead:beef::1'],
    ];
  }

  <<DataProvider('getExampleFacebookIPAddresses')>>
  public function testIsFacebookIPAddress(string $ip): void {
    expect(is_fb_ip_address($ip))->toBeTrue();
  }

  <<DataProvider('getExampleNonFacebookIPAddresses')>>
  public function testIsNonFacebookIPAddress(string $ip): void {
    expect(is_fb_ip_address($ip))->toBeFalse();
  }
}
