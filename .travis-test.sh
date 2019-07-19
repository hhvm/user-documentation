#!/bin/sh
set -ex
hh_server --check $(pwd)
vendor/bin/hacktest tests/
vendor/bin/hhast-lint
