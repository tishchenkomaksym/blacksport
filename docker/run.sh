#!/usr/bin/env bash

service ssh start
apache2ctl -D FOREGROUND
